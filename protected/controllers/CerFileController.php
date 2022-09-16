<?php

class CerFileController extends Controller
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
				'actions'=>array('create','create2','update','download','delete'),
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

	public function actionDownload($id)
	{
		$model = CerFile::model()->findByPk($id);
		$filename = $model->filename;

		$file = $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/cer/'.$filename;
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
		$model=new CerFile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['cid']) && $_POST['cid']!="" && isset($_FILES['file_attach']))
		{
			
			$file = $_FILES['file_attach'];
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/cer/';
	            $cer_id =  $_POST['cid'];
	            $model2 = CerFile::model()->findAll(array("condition"=>"cer_id ='$cer_id'"));
		        	if(empty($model2))
		        	{	
				            if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
					        {
					            
					        	
						            $model->filename = $file['name'];
						            $model->cer_id = $_POST['cid'];
						            $model->type = $_POST['type'];
						             if($model->save())
						            {	
						             	echo CJSON::encode(array(
						                'status'=>'success'
						                ));
						            }    
					           
					            //$model->user_id = Yii::app()->user->ID;
					            
					             // header('Content-type: text/plain');
			         // print_r($model);                    
			         // exit;
					           
					        }
					        else
					        {
					            echo CJSON::encode(array(
				                'status'=>'failure'));
				                
					        }
					 }
					 else
					 {
					            	


					            	rename($uploaddir .$model2[0]->filename, $uploaddir .basename($file['name']));  //move file

					            	$model2[0]->filename = $file['name'];
						            $model2[0]->cer_id = $_POST['cid'];
						            $model2[0]->type = $_POST['type'];

						            
						             if($model2[0]->save())
						            {	
						             	
						          //    	  header('Content-type: text/plain');
							         // print_r($model2[0]);                    
							         // exit;

						             	echo CJSON::encode(array(
						                'status'=>'success'
						                ));
						            }    
					 }        

		        	

	            //$this->redirect(array('index'));
				        
	        }
	        else{
	        	
	        }		
	
		}

		
	
	}

	public function actionCreate2()
	{
		$model=new CerFile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


		if(isset($_POST['cid']) && $_POST['cid']!="" && isset($_FILES['file_attach']))
		{
			
			$file = $_FILES['file_attach'];
			
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/cer/';
	            if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		        {
		            $model->filename = $file['name'];
		            $model->cer_id = $_POST['cid'];
		            $model->type = $_POST['type'];
		            //$model->user_id = Yii::app()->user->ID;
		      
		           
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

	            //$this->redirect(array('index'));
				        
	        }
	        else{
	      

	        }		
	
		}
		else{
			    	  // header('Content-type: text/plain');
         // print_r($_FILES['file_attach']);                    
         // exit;
		}

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

		if(isset($_POST['CerFile']))
		{
			$model->attributes=$_POST['CerFile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$model = CerFile::model()->findByPk($id);
		$file = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/cer/'.$model->filename;
		unlink($file);
		$model->delete();

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new CerFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CerFile']))
			$model->attributes=$_GET['CerFile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CerFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CerFile']))
			$model->attributes=$_GET['CerFile'];

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
		$model=CerFile::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cer-file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
