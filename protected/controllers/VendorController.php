<?php

class VendorController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','DeleteSelected','GetVendor','GetVendor2','GetSupplier','excel'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Vendor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vendor']))
		{
			$model->attributes=$_POST['Vendor'];
			$model->type = $_POST['Vendor']['type'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vendor']))
		{
			$model->attributes=$_POST['Vendor'];
			$model->type = $_POST['Vendor']['type'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Vendor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vendor']))
			$model->attributes=$_GET['Vendor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	protected function gridTypeName($data,$row) 
    {
        $data->type =  $data->type==0 ? "ผู้ผลิต" : "ผู้จัดส่ง";
        return  CHtml::encode($data->type);
    }

    public function actionGetVendor(){
            $request=trim($_GET['term']);
                    
            $models=Vendor::model()->findAll(array("condition"=>"name like '%$request%' OR code like '%$request%'",'order'=>'name'));
            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $data[] = array(
                        'id'=>$model['name'],
                        'label'=>$model['name'],
                        'vid'=>$model['id'],
                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }

    public function actionGetVendor2(){
            $request=trim($_GET['term']);
                    
            $models=Vendor::model()->findAll(array("condition"=>"(name like '%$request%' OR code like '%$request%') AND type=0 ",'order'=>'name'));
            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $data[] = array(
                        'id'=>$model['name'],
                        'label'=>$model['name'],
                        'vid'=>$model['id'],
                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }

    public function actionGetSupplier(){
            $request=trim($_GET['term']);
                    
            $models=Vendor::model()->findAll(array("condition"=>"(name like '%$request%' OR code like '%$request%') AND type=1 ",'order'=>'name'));
            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $data[] = array(
                        'id'=>$model['name'],
                        'label'=>$model['name'],
                        'vid'=>$model['id'],
                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }
 

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Vendor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vendor']))
			$model->attributes=$_GET['Vendor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Vendor::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionDeleteSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $this->loadModel($autoId)->delete();
            }
        }
    }

    public function actionExcel()
    {
			

	
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();

        $header = new PHPExcel_Style();

				$sheet = 0;
			    $objPHPExcel->createSheet(0);
				$objPHPExcel->setActiveSheetIndex($sheet)->setTitle("sheet1");
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('A')->setWidth(50);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('B')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('C')->setWidth(120);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('D')->setWidth(30);	


				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A1', "ผู้ผลิต/ผู้จัดส่ง");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B1', "รหัส");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C1', "ที่อยู่");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D1', "ประเภท");


				$row = 2;

				$model = Vendor::model()->findAll();

				foreach ($model as $key => $value) {

					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, $value->name);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, $value->code);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $value->address);
					$type = $value->type==0 ? "ผู้ผลิต" : "ผู้จัดส่ง" ;
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $type);

					$row++;
				}
		
	
				ob_end_clean();
				ob_start();

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="vendor_export.xls"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0
		        
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');  //
				Yii::app()->end(); 
    }    

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vendor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
