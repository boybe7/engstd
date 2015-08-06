<?php

/**
 * This is the model class for table "c_inspec_doc".
 *
 * The followings are the available columns in table 'c_inspec_doc':
 * @property integer $doc_id
 * @property string $doc_no
 * @property string $doc_date
 * @property integer $dept_id
 * @property string $doc_refer
 * @property integer $con_id
 * @property integer $cust_id
 * @property integer $vend_id
 * @property integer $prot_id
 * @property string $doc_detail
 * @property integer $u_id
 * @property string $doc_date_add
 * @property integer $doc_status
 */
class InspecDoc extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'c_inspec_doc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_no, doc_date, u_id, doc_date_add, doc_status', 'required'),
			array('con_id, prot_id, u_id, doc_status', 'numerical', 'integerOnly'=>true),
			array('doc_no', 'length', 'max'=>20),
			array('doc_refer', 'length', 'max'=>200),
			array('doc_detail', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_id, doc_no, doc_date, dept_id, doc_refer, con_id, cust_id, vend_id, prot_id, doc_detail, u_id, doc_date_add, doc_status', 'safe', 'on'=>'search'),
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
			'doc_id' => 'Doc',
			'doc_no' => 'เลขที่ลงรับ',
			'doc_date' => 'วันที่รับแจ้ง',
			'dept_id' => 'หน่วยงานต้นเรื่อง',
			'doc_refer' => 'อ้างอิง',
			'con_id' => 'เลขที่สัญญา',
			'cust_id' => 'คู่สัญญา',
			'vend_id' => 'ผู้ผลิต/ผู้จัดส่ง',
			'prot_id' => 'ชนิดท่อและอุปกรณ์',
			'doc_detail' => 'รายละเอียด',
			'u_id' => 'U',
			'doc_date_add' => 'Doc Date Add',
			'doc_status' => 'สถานะ',
		);
	}

	public function getStatus($m)
    {
        $status = '';
        switch ($m->doc_status) {
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

		$criteria->compare('doc_id',$this->doc_id);
		$criteria->compare('doc_no',$this->doc_no,true);
		$criteria->compare('doc_date',$this->doc_date,true);
		$criteria->compare('dept_id',$this->dept_id);
		$criteria->compare('doc_refer',$this->doc_refer,true);
		$criteria->compare('con_id',$this->con_id);
		$criteria->compare('cust_id',$this->cust_id);
		$criteria->compare('vend_id',$this->vend_id);
		$criteria->compare('prot_id',$this->prot_id);
		$criteria->compare('doc_detail',$this->doc_detail,true);
		$criteria->compare('u_id',$this->u_id);
		$criteria->compare('doc_date_add',$this->doc_date_add,true);
		$criteria->compare('doc_status',$this->doc_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
    {
      

        $str_date = explode("/", $this->doc_date);
        if(count($str_date)>1)
        	$this->doc_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        $str_date = explode("/", $this->doc_date_add);
        if(count($str_date)>1)
        	$this->doc_date_add= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        return parent::beforeSave();
   }

	protected function afterSave(){
            parent::afterSave();
            $str_date = explode("-", $this->doc_date);
            if(count($str_date)>1)
            	$this->doc_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
             $str_date = explode("-", $this->doc_date_add);
            if(count($str_date)>1)
            	$this->doc_date_add = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            //$this->visit_date=date('Y/m/d', strtotime(str_replace("-", "", $this->visit_date)));       
    }

	public function beforeFind()
    {
          

        $str_date = explode("/", $this->doc_date);
        if(count($str_date)>1)
        	$this->doc_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        $str_date = explode("/", $this->doc_date_add);
        if(count($str_date)>1)
        	$this->doc_date_add= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        return parent::beforeSave();
   }

	protected function afterFind(){
            parent::afterFind();
    

            $str_date = explode("-", $this->doc_date);
            if($this->doc_date=='0000-00-00')
            	$this->doc_date = '';
            else if(count($str_date)>1)
            	$this->doc_date = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
            
            $str_date = explode("-", $this->doc_date_add);
            if($this->doc_date_add=='0000-00-00')
            	$this->doc_date_add = '';
            else if(count($str_date)>1)
            	$this->doc_date_add = $str_date[2]."/".$str_date[1]."/".($str_date[0]);
     }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InspecDoc the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
