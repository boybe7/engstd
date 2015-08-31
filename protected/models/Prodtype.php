<?php

/**
 * This is the model class for table "m_prodtype".
 *
 * The followings are the available columns in table 'm_prodtype':
 * @property integer $prot_id
 * @property string $prot_code
 * @property string $prot_name

 */
class Prodtype extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_prodtype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prot_name', 'required'),
			array('prot_code', 'length', 'max'=>25),
			array('prot_name', 'length', 'max'=>200),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('prot_id, prot_code, prot_name', 'safe', 'on'=>'search'),
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
			'prot_id' => 'Prot',
			'prot_code' => 'รหัสชนิดท่อและอุปกรณ์',
			'prot_name' => 'ชื่อชนิดท่อและอุปกรณ์',

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

		$criteria->compare('prot_id',$this->prot_id);
		$criteria->compare('prot_code',$this->prot_code,true);
		$criteria->compare('prot_name',$this->prot_name,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Prodtype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
