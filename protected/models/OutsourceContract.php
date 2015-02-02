<?php

/**
 * This is the model class for table "outsource_contract".
 *
 * The followings are the available columns in table 'outsource_contract':
 * @property integer $oc_id
 * @property string $oc_code
 * @property integer $oc_proj_id
 * @property integer $oc_vendor_id
 * @property string $oc_detail
 * @property string $oc_sign_date
 * @property string $oc_end_date
 * @property string $oc_approve_date
 * @property double $oc_cost
 * @property integer $oc_T_percent
 * @property integer $oc_A_percent
 * @property string $oc_guarantee
 * @property string $oc_guarantee_cf
 * @property string $oc_adv_guarantee
 * @property string $oc_adv_guarantee_cf
 * @property string $oc_insurance
 * @property string $oc_letter
 * @property integer $oc_user_create
 * @property integer $oc_user_update
 */
class OutsourceContract extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */

	private $_oldattributes = array();

	public function tableName()
	{
		return 'outsource_contract';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oc_code, oc_proj_id, oc_vendor_id, oc_end_date, oc_cost,oc_user_update,oc_last_update', 'required'),
			array('oc_proj_id, oc_vendor_id, oc_T_percent, oc_A_percent, oc_user_create, oc_user_update', 'numerical', 'integerOnly'=>true),
			//array('oc_cost', 'numerical'),
			array('oc_T_percent', 'application.extensions.numericRangeValidator', 'min'=>0, 'max'=>100),
			array('oc_A_percent', 'application.extensions.numericRangeValidator', 'min'=>0, 'max'=>100),
			
			array('oc_code', 'length', 'max'=>30),
			array('oc_guarantee', 'length', 'max'=>100),
			array('oc_guarantee_cf, oc_adv_guarantee, oc_adv_guarantee_cf, oc_insurance, oc_letter,oc_PO', 'length', 'max'=>200),
			array('oc_detail', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('oc_id,oc_PO,oc_insurance_start,oc_insurance_end, oc_code, oc_proj_id, oc_vendor_id, oc_detail, oc_sign_date, oc_end_date, oc_approve_date, oc_cost, oc_T_percent, oc_A_percent, oc_guarantee, oc_guarantee_cf, oc_adv_guarantee, oc_adv_guarantee_cf, oc_insurance, oc_letter, oc_user_create, oc_user_update', 'safe', 'on'=>'search'),
		);
		
		// return array(
		// 	array('oc_code, oc_proj_id, oc_vendor_id, oc_end_date, oc_cost', 'required'),
		// 	array('oc_proj_id, oc_vendor_id, oc_T_percent, oc_A_percent, oc_user_create, oc_user_update', 'numerical', 'integerOnly'=>true),
		// 	//array('oc_cost', 'numerical'),
		// 	array('oc_T_percent', 'application.extensions.numericRangeValidator', 'min'=>0, 'max'=>100),
		// 	array('oc_A_percent', 'application.extensions.numericRangeValidator', 'min'=>0, 'max'=>100),
		// 	array('oc_code', 'length', 'max'=>30),
		// 	array('oc_guarantee','oc_guarantee_cf', 'length', 'max'=>100),
		// 	array('oc_adv_guarantee,oc_adv_guarantee_cf, oc_insurance, oc_letter', 'length', 'max'=>200),
		// 	array('oc_detail', 'safe'),
		// 	// The following rule is used by search().
		// 	// @todo Please remove those attributes that should not be searched.
		// 	array('oc_id, oc_code, oc_proj_id, oc_vendor_id, oc_detail, oc_sign_date, oc_end_date, oc_approve_date, oc_cost, oc_T_percent, oc_A_percent, oc_guarantee, oc_adv_guarantee, oc_insurance, oc_letter, oc_user_create, oc_user_update', 'safe', 'on'=>'search'),
		// );
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
	public function beforeSave()
    {
   //       if($this->oc_cost!="")
		 // {
		 //     $this->oc_cost = str_replace(",", "", $this->oc_cost); 
		 // }
		//$this->oc_cost = str_replace(",", "", $this->oc_cost);
		 $this->oc_cost = Yii::app()->format->unformatNumber($this->oc_cost); 

        $str_date = explode("/", $this->oc_sign_date);
        if(count($str_date)>1)
        	$this->oc_sign_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        $str_date = explode("/", $this->oc_end_date);
        if(count($str_date)>1)
        	$this->oc_end_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        $str_date = explode("/", $this->oc_approve_date);
        if(count($str_date)>1)
        	$this->oc_approve_date= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        $str_date = explode("/", $this->oc_insurance_start);
        if(count($str_date)>1)
        	$this->oc_insurance_start= $str_date[2]."-".$str_date[1]."-".$str_date[0];
        $str_date = explode("/", $this->oc_insurance_end);
        if(count($str_date)>1)
        	$this->oc_insurance_end= $str_date[2]."-".$str_date[1]."-".$str_date[0];

        //check record is updated
        $newattributes = $this->Owner->getAttributes();
        $oldattributes = $this->getOldAttributes();
        // compare old and new
        $difference = false;
        if($oldattributes!=null)
        foreach ($newattributes as $name => $value) {
                $old = $oldattributes[$name]; 
                if ($value != $old) 
                {  
                    $difference = true;
                    
                }  

        }	

        if($difference)
            	$this->oc_user_update = "boybe";


        return parent::beforeSave();
   }


    public function behaviors()  {
    	return array( 'CCompare'); // <-- and other behaviors your model may have
  	}
 
    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }
 
    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }

   public function afterFind() {
	    // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());


	    $this->oc_cost = Yii::app()->format->number($this->oc_cost);
	    $str_date = explode("-", $this->oc_sign_date);
        if(count($str_date)>1)
        	$this->oc_sign_date= $str_date[2]."/".$str_date[1]."/".$str_date[0];
        $str_date = explode("-", $this->oc_end_date);
        if(count($str_date)>1)
        	$this->oc_end_date= $str_date[2]."/".$str_date[1]."/".$str_date[0];
        $str_date = explode("-", $this->oc_approve_date);
        if(count($str_date)>1)
        	$this->oc_approve_date= $str_date[2]."/".$str_date[1]."/".$str_date[0];
        $str_date = explode("-", $this->oc_insurance_start);
        if(count($str_date)>1)
        	$this->oc_insurance_start= $str_date[2]."/".$str_date[1]."/".$str_date[0];
        $str_date = explode("-", $this->oc_insurance_end);
        if(count($str_date)>1)
        	$this->oc_insurance_end= $str_date[2]."/".$str_date[1]."/".$str_date[0];
                


	    return parent::afterFind();
	}
	public function afterSave() {
	    $this->oc_cost = Yii::app()->format->number($this->oc_cost);
	    $str_date = explode("-", $this->oc_sign_date);
        if(count($str_date)>1)
        	$this->oc_sign_date= $str_date[2]."/".$str_date[1]."/".$str_date[0];
        $str_date = explode("-", $this->oc_end_date);
        if(count($str_date)>1)
        	$this->oc_end_date= $str_date[2]."/".$str_date[1]."/".$str_date[0];
        $str_date = explode("-", $this->oc_approve_date);
        if(count($str_date)>1)
        	$this->oc_approve_date= $str_date[2]."/".$str_date[1]."/".$str_date[0];
		$str_date = explode("-", $this->oc_insurance_start);
        if(count($str_date)>1)
        	$this->oc_insurance_start= $str_date[2]."/".$str_date[1]."/".$str_date[0];
        $str_date = explode("-", $this->oc_insurance_end);
        if(count($str_date)>1)
        	$this->oc_insurance_end= $str_date[2]."/".$str_date[1]."/".$str_date[0];
                

	    return parent::afterSave();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'oc_id' => 'id สัญญา',
			'oc_code' => 'เลขที่สัญญา',
			'oc_PO' => 'เลขที่ PO',
			'oc_proj_id' => 'id project',
			'oc_vendor_id' => 'บริษัท',
			'oc_detail' => 'รายละเอียดสัญญา',
			'oc_sign_date' => 'วันที่ลงนาม',
			'oc_end_date' => 'วันที่ครบกำหนด',
			'oc_approve_date' => 'วันที่รับรองงบ',
			'oc_cost' => 'วงเงิน',
			'oc_T_percent' => '%ความก้าวหน้าด้านเทคนิค',
			'oc_A_percent' => '%ความก้าวหน้าการจ่ายเงิน',
			'oc_guarantee' => 'หนังสือค้ำประกันสัญญา',
			'oc_adv_guarantee' => 'หนังสือค้ำประกันล่วงหน้า',
			'oc_guarantee_cf' => 'หนังสือยืนยันค้ำประกันสัญญา',
			'oc_adv_guarantee_cf' => 'หนังสือยืนยันค้ำประกันล่วงหน้า',
			'oc_insurance' => 'เลขที่กรมธรรม์ประกันภัย',
			'oc_insurance_start' => 'วันที่เริ่มต้นกรมธรรม์',
			'oc_insurance_end' => 'วันที่สิ้นสุดกรมธรรม์',
			'oc_letter' => 'เลขที่หนังสือสั่งจ้าง',
			'oc_user_create' => 'ผู้สร้างสัญญา',
			'oc_user_update' => 'ผู้บันทึก',
			'oc_last_update' => 'แก้ไขล่าสุดเมื่อ',
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

		$criteria->compare('oc_id',$this->oc_id);
		$criteria->compare('oc_code',$this->oc_code,true);
		$criteria->compare('oc_PO',$this->oc_PO,true);
		$criteria->compare('oc_proj_id',$this->oc_proj_id);
		$criteria->compare('oc_vendor_id',$this->oc_vendor_id);
		$criteria->compare('oc_detail',$this->oc_detail,true);
		$criteria->compare('oc_sign_date',$this->oc_sign_date,true);
		$criteria->compare('oc_end_date',$this->oc_end_date,true);
		$criteria->compare('oc_approve_date',$this->oc_approve_date,true);
		$criteria->compare('oc_cost',$this->oc_cost);
		$criteria->compare('oc_T_percent',$this->oc_T_percent);
		$criteria->compare('oc_A_percent',$this->oc_A_percent);
		$criteria->compare('oc_guarantee',$this->oc_guarantee,true);
		$criteria->compare('oc_guarantee_cf',$this->oc_guarantee_cf,true);
		$criteria->compare('oc_adv_guarantee',$this->oc_adv_guarantee,true);
		$criteria->compare('oc_adv_guarantee_cf',$this->oc_adv_guarantee_cf,true);
		$criteria->compare('oc_insurance',$this->oc_insurance,true);
		$criteria->compare('oc_letter',$this->oc_letter,true);
		$criteria->compare('oc_user_create',$this->oc_user_create);
		$criteria->compare('oc_user_update',$this->oc_user_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OutsourceContract the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
