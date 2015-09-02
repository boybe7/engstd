<?php

/**
 * This is the model class for table "c_cer_doc".
 *
 * The followings are the available columns in table 'c_cer_doc':
 * @property integer $cer_id
 * @property string $cer_no
 * @property integer $dept_id
 * @property integer $vend_id
 * @property string $cer_date
 * @property string $cer_oper_date
 * @property string $cer_name
 * @property string $cer_ct_name
 * @property string $cer_di_name
 * @property string $cer_notes
 * @property integer $cer_status
 * @property string $cer_date_add
 */
class CerDoc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'c_cer_doc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cer_no, vend_id,user_update,running_no, cer_date, cer_oper_date, cer_name, cer_ct_name, cer_di_name, cer_status, cer_date_add', 'required'),
			array('cer_status,prod_id', 'numerical', 'integerOnly'=>true),
			array('cer_no', 'length', 'max'=>20),
			array('cer_name, cer_ct_name, cer_di_name, cer_notes', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cer_id, cer_no,user_update,running_no, dept_id, vend_id,supp_id, cer_date, cer_oper_date, cer_name,contract_no,contractor,prod_id, cer_ct_name, cer_di_name, cer_notes, cer_status, cer_date_add', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cer_id' => 'Cer',
			'cer_no' => 'เลขที่ใบรับรอง',
			'dept_id' => 'หน่วยงานต้นเรื่อง',
			'vend_id' => 'ผู้ผลิต',
			'supp_id' => 'ผู้จัดส่ง',
			'cer_date' => 'วันที่ออกใบรับรอง',
			'cer_oper_date' => 'วันที่ตรวจโรงงาน',
			'cer_name' => 'เจ้าหน้าที่ผู้ควบคุมการผลิต',
			'cer_ct_name' => 'หัวหน้าส่วนควบคุมการผลิต',
			'cer_di_name' => 'ผู้อำนวยการกองมาตรฐานวิศวกรรม',
			'cer_notes' => 'หมายเหตุ',
			'cer_status' => 'สถานะ',
			'contract_no' => 'เลขที่สัญญา',
			'contractor' => 'คู่สัญญา',
			'prod_id' => 'ชนิดท่อ/อุปกรณ์',
			'cer_date_add' => 'Cer Date Add',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('cer_id',$this->cer_id);
		$criteria->compare('cer_no',$this->cer_no,true);
		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('vend_id',$this->vend_id,true);
		$criteria->compare('supp_id',$this->supp_id,true);
		$criteria->compare('cer_date',$this->cer_date,true);
		$criteria->compare('cer_oper_date',$this->cer_oper_date,true);
		$criteria->compare('cer_name',$this->cer_name,true);
		$criteria->compare('cer_ct_name',$this->cer_ct_name,true);
		$criteria->compare('cer_di_name',$this->cer_di_name,true);
		$criteria->compare('cer_notes',$this->cer_notes,true);
		$criteria->compare('contract_no',$this->contract_no,true);
		$criteria->compare('contractor',$this->contractor,true);
		$criteria->compare('cer_status',$this->cer_status);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('cer_date_add',$this->cer_date_add,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchByUser($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('cer_id',$this->cer_id);
		$criteria->compare('cer_no',$this->cer_no,true);
		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('vend_id',$this->vend_id,true);
		$criteria->compare('supp_id',$this->supp_id,true);
		$criteria->compare('cer_date',$this->cer_date,true);
		$criteria->compare('cer_oper_date',$this->cer_oper_date,true);
		$criteria->compare('cer_name',$this->cer_name,true);
		$criteria->compare('cer_ct_name',$this->cer_ct_name,true);
		$criteria->compare('cer_di_name',$this->cer_di_name,true);
		$criteria->compare('cer_notes',$this->cer_notes,true);
		$criteria->compare('contract_no',$this->contract_no,true);
		$criteria->compare('contractor',$this->contractor,true);
		$criteria->compare('cer_status',$this->cer_status);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('cer_date_add',$this->cer_date_add,true);

		if(Yii::app()->user->isUser())
		{
			
			$criteria->addCondition('cer_name="'.$id.'"');
		}	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CerDoc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getStatus($m)
    {
        $status = '';
        switch ($m->cer_status) {
        	case 1:
        		$status = "เปิด";
        		break;
        	case 2:
        		$status = "ปิด";
        		break;
        	case 3:
        		$status = "ยกเลิก";
        		break;	
        	default:
        		# code...
        		break;
        }
        return $status;
    }

    public function beforeSave()
    {
      

        $str_date = explode("/", $this->cer_date);
        if(count($str_date)>1)
        	$this->cer_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        
        $str_date = explode("/", $this->cer_oper_date);
        if(count($str_date)>1)
        	$this->cer_oper_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];

        $str_date = explode("/", $this->cer_date_add);
        if(count($str_date)>1)
        	$this->cer_date_add= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        
        return parent::beforeSave();
   }

	protected function afterSave(){
            parent::afterSave();
            $str_date = explode("-", $this->cer_date);
            if(count($str_date)>1)
            	$this->cer_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            
            $str_date = explode("-", $this->cer_oper_date);
            if(count($str_date)>1)
            	$this->cer_oper_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);

            $str_date = explode("-", $this->cer_date_add);
            if(count($str_date)>1)
            	$this->cer_date_add = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            //$this->visit_date=date('Y/m/d', strtotime(str_replace("-", "", $this->visit_date)));       
    }

	public function beforeFind()
    {
          

        $str_date = explode("/", $this->cer_date);
        if(count($str_date)>1)
        	$this->cer_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        
        $str_date = explode("/", $this->cer_oper_date);
        if(count($str_date)>1)
        	$this->cer_oper_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        
        $str_date = explode("/", $this->cer_date_add);
        if(count($str_date)>1)
        	$this->cer_date_add= $str_date[2]."-".$str_date[1]."-".$str_date[0];

        return parent::beforeSave();
   }

	protected function afterFind(){
            parent::afterFind();
    

            $str_date = explode("-", $this->cer_date);
            if($this->cer_date=='0000-00-00')
            	$this->cer_date = '';
            else if(count($str_date)>1)
            	$this->cer_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            
            $str_date = explode("-", $this->cer_oper_date);
            if($this->cer_oper_date=='0000-00-00')
            	$this->cer_oper_date = '';
            else if(count($str_date)>1)
            	$this->cer_oper_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);

            $str_date = explode("-", $this->cer_date_add);
            if($this->cer_date_add=='0000-00-00')
            	$this->cer_date_add = '';
            else if(count($str_date)>1)
            	$this->cer_date_add = $str_date[2]."/".$str_date[1]."/".($str_date[0]);

           
     }
}
