<?php

/**
 * This is the model class for table "c_cer_file".
 *
 * The followings are the available columns in table 'c_cer_file':
 * @property integer $id
 * @property integer $cer_id
 * @property string $filename
 */
class CerFile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'c_cer_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cer_id, filename, type', 'required'),
			//array('cer_id', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cer_id, filename, type', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'cer_id' => 'เลขที่ใบรับรอง',
			'filename' => 'ชื่อไฟล์',
			'type'=>'ประเภท'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('cer_id',$this->cer_id,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getType($m)
    {
        $status = '';
        switch ($m->type) {
        	case 0:
        		$status = "เอกสารใบรับรองคุณภาพ";
        		break;
        	case 1:
        		$status = "เอกสารอื่น ๆ";
        		break;
        	
        	default:
        		# code...
        		break;
        }
        return $status;
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CerFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
