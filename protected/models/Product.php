<?php

/**
 * This is the model class for table "m_product".
 *
 * The followings are the available columns in table 'm_product':
 * @property integer $prod_id
 * @property string $prod_code
 * @property string $prod_name
 * @property integer $prot_id
 * @property string $prod_size
 * @property string $prod_unit
 * @property string $prod_sizename
 * @property integer $prod_size1
 * @property integer $prod_size2
 * @property integer $prod_size3
 */
class Product extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('prod_code, prod_name, prot_id', 'required'),
			//array('prot_id, prod_size1, prod_size2, prod_size3', 'numerical', 'integerOnly'=>true),
			array('prod_code', 'length', 'max'=>100),
			array('prod_name, prod_size,prod_sizename, prod_unit', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('prod_id, prod_code, prod_name, prot_id, prod_size, prod_unit,prod_sizename, prod_size1, prod_size2, prod_size3', 'safe', 'on'=>'search'),
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
			'prod_id' => 'Prod',
			'prod_code' => 'รหัส',
			'prod_name' => 'ชื่อท่อและอุปกรณ์',
			'prot_id' => 'ชนิดท่อและอุปกรณ์',
			'prot_sub_id'=>'กลุ่มย่อยท่อและอุปกรณ์',
			'prod_size' => 'หน่วยวัด',
			'prod_sizename'=>'ขนาดท่อและอุปกรณ์',
			'prod_unit' => 'หน่วยนับ',
			'prod_size1' => 'ขนาด 1',
			'prod_size2' => 'ขนาด 2',
			'prod_size3' => 'ขนาด 3',
			'price'=>'ราคา',
			'factor'=>'factor'
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

		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('prod_code',$this->prod_code,true);
		$criteria->compare('prod_name',$this->prod_name,true);
		$criteria->compare('prot_id',$this->prot_id);
		$criteria->compare('prod_size',$this->prod_size,true);
		$criteria->compare('prod_unit',$this->prod_unit,true);
		$criteria->compare('prod_sizename',$this->prod_sizename,true);
		$criteria->compare('prod_size1',$this->prod_size1,true);
		$criteria->compare('prod_size2',$this->prod_size2,true);
		$criteria->compare('prod_size3',$this->prod_size3,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('factor',$this->factor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array( 
                'pageSize' => 50 ,
            ),
        
		));
	}

	public function getProdtype($m)
    {
        
        $model = Prodtype::model()->findByPk($m->prot_id);
         // header('Content-type: text/plain');
         // print_r($model);                    
         // exit;
        $position = !empty($model) ? $model->prot_name: "";
        return $position;
    }

    public function getProdsubtype($m)
    {
        
        $model = ProdtypeSubgroup::model()->findByPk($m->prot_sub_id);
         // header('Content-type: text/plain');
         // print_r($model);                    
         // exit;
        $position = !empty($model) ? $model->name: "";
        return $position;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
