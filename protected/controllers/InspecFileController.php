<?php

class InspecFileController extends Controller
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
				'actions'=>array('create','update','createTemp','deleteTemp','download','downloadTemp','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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
		$model=new InspecFile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_FILES['file_attach']))
		{
			
			$file = $_FILES['file_attach'];
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/';
	            if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		        {
		            $model->ins_file = $file['name'];
		            $model->doc_id = $_POST['doc_id'];
		
		            if($model->save())
		            {	
		             	echo CJSON::encode(array(
		                'status'=>'success'
		                ));
		            }    
		        }
		        else
		        {
		            echo CJSON::encode(array(
	                'status'=>'failure'));
	                
		        }

	           
				        
	        }
	        else{
	        	
	        }		
	
		}
	}

	public function actionDownload($id)
	{
		$model = InspecFile::model()->findByPk($id);
		$filename = $model->ins_file;

		$file = $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/'.$filename;
		if (file_exists($file)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename='.basename($file));
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($file);
		    exit;
		}

	}

	public function actionDownloadTemp($id)
	{
		$model = InspecFileTemp::model()->findByPk($id);
		$filename = $model->ins_file;

		$file = $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/temp/'.$filename;
		if (file_exists($file)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename='.basename($file));
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($file);
		    exit;
		}

	}

	public function actionCreateTemp()
	{
		$model=new InspecFileTemp;

		 //header('Content-type: text/plain');
         //print_r($_POST['InspecFile']);                    
         //exit;


		if(isset($_FILES['file_attach']))
		{
			
			$file = $_FILES['file_attach'];
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/temp/';
	            if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		        {
		            $model->ins_file = $file['name'];
		            $model->doc_id = 1;
		            $model->user_id = Yii::app()->user->ID;
		            
		       //       header('Content-type: text/plain');
         // print_r($model);                    
         // exit;
		            if($model->save())
		            {	
		             	echo CJSON::encode(array(
		                'status'=>'success'
		                ));
		            }    
		        }
		        else
		        {
		            echo CJSON::encode(array(
	                'status'=>'failure'));
	                
		        }

	           
				        
	        }
	        else{
	        	
	        }		
	
		}

	}

	public function actionDeleteTemp($id)
	{
		$model = InspecFileTemp::model()->findByPk($id);
		$file = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/temp/'.$model->ins_file;
		unlink($file);
		$model->delete();

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

		if(isset($_POST['InspecFile']))
		{
			$model->attributes=$_POST['InspecFile'];

			if($model->save())
				$this->redirect(array('view','id'=>$model->ins_id));
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
		$model = InspecFile::model()->findByPk($id);
		$file = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/'.$model->ins_file;
		unlink($file);
		$model->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('InspecFile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new InspecFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InspecFile']))
			$model->attributes=$_GET['InspecFile'];

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
		$model=InspecFile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='inspec-file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
