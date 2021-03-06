<?php

class ProdtypeController extends Controller
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
				'actions'=>array('create','update','deleteSelected','getType'),
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

    public function actionGetType(){
            $request=trim($_GET['term']);
                    
            $models=Prodtype::model()->findAll(array("condition"=>"prot_code like '%$request%' OR prot_name like '%$request%'  ",'order'=>'prot_name'));
            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $data[] = array(
                        'id'=>$model['prot_id'],
                        'label'=>$model['prot_code'].'-'.$model['prot_name'],
                        'name'=>$model['prot_name'],
                        
                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
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
		$model=new Prodtype;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['name']))
		{
			$model->prot_name=$_POST['name'];
			$model->prot_code=$_POST['code'];

			$model->save();
			
		}

	
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		// $model=$this->loadModel($id);

		// // Uncomment the following line if AJAX validation is needed
		// // $this->performAjaxValidation($model);

		// if(isset($_POST['Prodtype']))
		// {
		// 	$model->attributes=$_POST['Prodtype'];
		// 	if($model->save())
		// 		$this->redirect(array('index'));
		// }

		// $this->render('update',array(
		// 	'model'=>$model,
		// ));

			$es = new EditableSaver('Prodtype');
		   // header('Content-type: text/plain');
     //        print_r($es);                    
     //     exit;
	    try {

	    	$es->update();
	    	   // header('Content-type: text/plain');
         //      print_r($es);                    
         //   exit;
	    } catch(CException $e) {
	    	echo CJSON::encode(array('success' => false, 'msg' => $e->getMessage()));
	    	return;
	    }
	    echo CJSON::encode(array('success' => true));
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
		$model=new Prodtype('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Prodtype']))
			$model->attributes=$_GET['Prodtype'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Prodtype('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Prodtype']))
			$model->attributes=$_GET['Prodtype'];

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
		$model=Prodtype::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='prodtype-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
