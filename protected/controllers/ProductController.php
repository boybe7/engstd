<?php

class ProductController extends Controller
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
				'actions'=>array('create','update','DeleteSelected','GetProduct','GetSubgroupByType','UpdateSubgroupSelected'),
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

	public function actionGetSubgroupByType() {        
    
        
       if( $_POST['id']!='') 
        $data = ProdtypeSubgroup::model()->findAll('prod_id=:id', array(':id' => (int) $_POST['id']));        
        else    
        $data = ProdtypeSubgroup::model()->findAll();        
    
        
        $data = CHtml::listData($data, 'id', 'name');
        
      
        echo CHtml::tag('option', array('value' => ''), CHtml::encode("--กรุณาเลือก--"), true);
  
        foreach ($data as $value => $name) {            
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
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

    public function actionUpdateSubgroupSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
    	$subgroup = isset($_POST['subgroup']) ? $_POST['subgroup']: '';
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $model = $this->loadModel($autoId);
                $model->prot_sub_id = $subgroup;
                $model->save();
            }
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
		$model=new Product;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->prod_size1 = $_POST['Product']['prod_size1'];
			$model->prod_size2 = $_POST['Product']['prod_size2'];
			$model->prod_size3 = $_POST['Product']['prod_size3'];
			$model->prot_sub_id = $_POST['Product']['prot_sub_id'];
			$model->price = $_POST['Product']['price'];
			$model->factor = $_POST['Product']['factor'];
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

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->prod_size1 = $_POST['Product']['prod_size1'];
			$model->prod_size2 = $_POST['Product']['prod_size2'];
			$model->prod_size3 = $_POST['Product']['prod_size3'];
			$model->prot_sub_id = $_POST['Product']['prot_sub_id'];
			$model->price = $_POST['Product']['price'];
			$model->factor = $_POST['Product']['factor'];
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

	public function actionGetProduct(){
            $request=trim($_GET['term']);
                    
            $models=Product::model()->findAll(array("condition"=>"prod_code like '%$request%' OR prod_name like '%$request%'  ",'order'=>'prod_name ASC,prod_size1*1 ASC'));
            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $data[] = array(
                        'id'=>$model['prod_id'],
                        'label'=>$model['prod_code'].'-'.$model['prod_name'],
                        'name'=>$model['prod_name'],
                        'size'=>$model['prod_sizename'],
                        'unit'=>$model['prod_unit'],
                        
                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

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
		$model=Product::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
