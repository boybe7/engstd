<?php

/**
 * This is the model class for table "c_cer_detail".
 *
 * The followings are the available columns in table 'c_cer_detail':
 * @property integer $detail_id
 * @property integer $cer_id
 * @property string $detail
 * @property integer $prod_size
 * @property integer $quantity
 * @property string $serialno
 */
class CerDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'c_cer_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cer_id, detail, prod_size, quantity, serialno', 'required'),
			array('cer_id, quantity', 'numerical', 'integerOnly'=>true),
			array('detail', 'length', 'max'=>500),
			array('serialno', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('detail_id, cer_id, detail, prod_size, quantity, serialno', 'safe', 'on'=>'search'),
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
			'detail_id' => 'Detail',
			'cer_id' => 'Cer',
			'detail' => 'รายละเอียด',
			'prod_size' => 'ขนาด &#8709 มม.',
			'quantity' => 'จำนวน',
			'serialno' => 'หมายเลข',
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

		$criteria->compare('detail_id',$this->detail_id);
		$criteria->compare('cer_id',$this->cer_id);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('prod_size',$this->prod_size);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('serialno',$this->serialno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchByID($id) {

		$criteria=new CDbCriteria;
		$criteria->select = '*';
		//$criteria->join = 'JOIN foodType food ON foodtype = food.foodtype '; 
		$criteria->condition = "cer_id='$id'";
		//$criteria->group = 'foodtype ';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CerDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
