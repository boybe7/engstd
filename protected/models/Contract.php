<?php

/**
 * This is the model class for table "m_contract".
 *
 * The followings are the available columns in table 'm_contract':
 * @property integer $con_id
 * @property string $con_number
 * @property string $con_price
 * @property string $con_budget
 */
class Contract extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_contract';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('con_number', 'required'),
			array('con_id', 'numerical', 'integerOnly'=>true),
			array('con_number', 'length', 'max'=>500),
			array('con_price, con_budget', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('con_id, con_number,con_status, con_price, con_budget', 'safe', 'on'=>'search'),
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
			'con_id' => 'Con',
			'con_number' => 'เลขที่สัญญา',
			'con_price' => 'ค่างาน',
			'con_budget' => 'งบประมาณโครงการ',
			'con_status' => 'สถานะ'
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

		$criteria->compare('con_id',$this->con_id);
		$criteria->compare('con_number',$this->con_number,true);
		$criteria->compare('con_price',$this->con_price,true);
		$criteria->compare('con_budget',$this->con_budget,true);
		$criteria->compare('con_status',$this->con_status,true);
		$criteria->order = 'con_id DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contract the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
