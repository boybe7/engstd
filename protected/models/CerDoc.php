<?php

/**
 * This is the model class for table "c_cer_doc".
 *
 * The followings are the available columns in table 'c_cer_doc':
 * @property integer $cer_id
 * @property string $cer_no
 * @property integer $deptorder
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
			array('cer_no, vend_id, cer_date, cer_oper_date, cer_name, cer_ct_name, cer_di_name, cer_status, cer_date_add', 'required'),
			array('deptorder, vend_id, cer_status', 'numerical', 'integerOnly'=>true),
			array('cer_no', 'length', 'max'=>20),
			array('cer_name, cer_ct_name, cer_di_name, cer_notes', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cer_id, cer_no, deptorder, vend_id, cer_date, cer_oper_date, cer_name, cer_ct_name, cer_di_name, cer_notes, cer_status, cer_date_add', 'safe', 'on'=>'search'),
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
			'deptorder' => 'หน่วยงานต้นเรื่อง',
			'vend_id' => 'ออกให้กับ',
			'cer_date' => 'วันที่ออกใบรับรอง',
			'cer_oper_date' => 'Cer Oper Date',
			'cer_name' => 'Cer Name',
			'cer_ct_name' => 'Cer Ct Name',
			'cer_di_name' => 'Cer Di Name',
			'cer_notes' => 'Cer Notes',
			'cer_status' => 'สถานะ',
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
		$criteria->compare('deptorder',$this->deptorder,true);
		$criteria->compare('vend_id',$this->vend_id);
		$criteria->compare('cer_date',$this->cer_date,true);
		$criteria->compare('cer_oper_date',$this->cer_oper_date,true);
		$criteria->compare('cer_name',$this->cer_name,true);
		$criteria->compare('cer_ct_name',$this->cer_ct_name,true);
		$criteria->compare('cer_di_name',$this->cer_di_name,true);
		$criteria->compare('cer_notes',$this->cer_notes,true);
		$criteria->compare('cer_status',$this->cer_status);
		$criteria->compare('cer_date_add',$this->cer_date_add,true);

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
}
