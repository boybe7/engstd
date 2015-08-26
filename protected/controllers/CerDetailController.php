<?php

class CerDetailController extends Controller
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
				'actions'=>array('create','delete2','update','createTemp','createTemp2','updateTemp','updateTemp2','deleteTemp'),
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

	public function actionCreateTemp()
	{
	

		 $model=new CerDetailTemp;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		if(isset($_POST['CerDetailTemp']))
		{
			$model->attributes=$_POST['CerDetailTemp'];
			$model->cer_id = 0;
			$model->user_id = Yii::app()->user->ID;
		
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model), true)));
	                
	            exit;
				        
	        }		
			else
			  if($model->save())
				$this->redirect(array('admin'));

		}

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
            exit;               
        }

		$this->renderPartial('_form',array('model'=>$model));
	}

	public function actionCreateTemp2()
	{
        $model=new CerDetailTemp;
       if (Yii::app()->request->isAjaxRequest)
		  $this->renderPartial('_form',array('model'=>$model), false);
	}


	public function actionUpdateTemp2($id)
	{
        $model=CerDetailTemp::model()->findByPk($id);
       if (Yii::app()->request->isAjaxRequest)
		  $this->renderPartial('_form',array('model'=>$model), false);
	}

	public function actionUpdateTemp($id)
	{
		$model=CerDetailTemp::model()->findByPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CerDetailTemp']))
		{
			$model->attributes=$_POST['CerDetailTemp'];
            //$model->type = 1;
			 if (Yii::app()->request->isAjaxRequest)
	         {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model), true)));
	                
	            exit;
			}	        
	        	//$this->redirect(array('admin'));

		}

		$this->renderPartial('_form',array('model'=>$model));

	}


	public function actionDeleteTemp($id)
	{
		$model = CerDetailTemp::model()->findByPk($id);
		$model->delete();

	}

	public function actionDelete2($id)
	{
		$model = CerDetail::model()->findByPk($id);
		$model->delete();

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
	
	public function actionCreate($id)
	{
	

		 $model=new CerDetail;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);
		if(isset($_POST['CerDetail']))
		{
			$model->attributes=$_POST['CerDetail'];
			$model->cer_id = $id;
			
			if (Yii::app()->request->isAjaxRequest)
	        {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model), true)));
	                
	            exit;
				        
	        }		
			else
			  if($model->save())
				$this->redirect(array('admin'));

		}

		if (Yii::app()->request->isAjaxRequest)
        {
            echo CJSON::encode(array(
                'status'=>'failure', 
                'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
            exit;               
        }

		$this->renderPartial('_form',array('model'=>$model));
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

		if(isset($_POST['CerDetail']))
		{
			$model->attributes=$_POST['CerDetail'];
            //$model->type = 1;
			 if (Yii::app()->request->isAjaxRequest)
	         {
	           
	            if($model->save())
	            	 echo CJSON::encode(array(
	                'status'=>'success'
	                ));
	            else
	                echo CJSON::encode(array(
	                'status'=>'failure','div'=>$this->renderPartial('_form', array('model'=>$model), true)));
	                
	            exit;
			}	        
	        	//$this->redirect(array('admin'));

		}

		$this->renderPartial('_form',array('model'=>$model));
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
		$dataProvider=new CActiveDataProvider('CerDetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CerDetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CerDetail']))
			$model->attributes=$_GET['CerDetail'];

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
		$model=CerDetail::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cer-detail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
