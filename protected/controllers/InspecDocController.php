<?php

class InspecDocController extends Controller
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
				'actions'=>array('create','update','cancel','DeleteSelected','CancleSelected','CloseSelected','addCer','DeleteInspecCer'),
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

	 public function actionCancel()
    {
    	$id = $_POST['selectedID'];
        $comment = str_replace("comment=&comment=", "", urldecode($_POST['data']));
        $model=$this->loadModel($id);
        $model->doc_status = 3;
        $model->cancel_remark = $comment;
        $model->save();

    }

	public function actionCancleSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $pjModel = $this->loadModel($autoId);
                $pjModel->doc_status = 3;
                $pjModel->save();
            }
        }    
    }

    public function actionCloseSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
                $pjModel = $this->loadModel($autoId);
                $pjModel->doc_status = 2;
                $pjModel->save();
            }
        }    
    }

    public function actionAddCer()
	{
		$model=new InspecCer("search");
		if(isset($_POST['cerID']) && $_POST['cerID']!="")
		{
			$model->cer_id =$_POST['cerID'];
		    $model->inspec_id = $_POST['id'];
		
			if($model->save())
				echo "OK";//$this->redirect(array('admin'));
			else
				print_r($model);
		}

	}

	public function actionDeleteInspecCer($id)
    {
    	$model = InspecCer::model()->findByPk($id);
		$model->delete();
			 
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
		$model=new InspecDoc;

		//auto gen doc_no
		$fiscalyear = date("n")<10 ? date("Y")+543 : date("Y")+544;
		$m = Yii::app()->db->createCommand()
				->select('max(strSplit(doc_no,"/", 1)) as max')
				->from('c_inspec_doc')	
				->where('strSplit(doc_no,"/", 2)='.$fiscalyear)					                   
				->queryAll();

		$model->doc_no = ($m[0]['max']+1)."/".$fiscalyear;		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InspecDoc']))
		{
			$model->attributes=$_POST['InspecDoc'];
			$model->u_id = Yii::app()->user->ID;
			$model->doc_date_add = (date("Y")+543).date("-m-d");
			$model->doc_status = 1;
			$model->dept_id = $_POST['InspecDoc']['dept_id'];
			$model->cust_id=$_POST['InspecDoc']['cust_id'];
			$model->vend_id = $_POST['InspecDoc']['vend_id'];
			$model->con_no = $_POST['InspecDoc']['con_no'];

			     

			if($model->save())
			{

				$modelTemps = Yii::app()->db->createCommand()
						                    ->select('*')
						                    ->from('c_inspec_file_temp')
						                    ->where('user_id=:user', array(':user'=>Yii::app()->user->ID))
						                    ->queryAll();

				foreach ($modelTemps as $key => $mTemp) {

					

					 $modelFile = new InspecFile("search");
                     $modelFile->doc_id = $model->doc_id;
                     $modelFile->ins_file = $mTemp["ins_file"];
                   
                     $modelFile->save();


                     $uploaddirTemp = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/temp/';
                     $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/engstd/files/';
	                 rename($uploaddirTemp .$mTemp["ins_file"], $uploaddir .$mTemp["ins_file"]);
		       
                   	 

				}
				//header('Content-type: text/plain');
      
				//	print_r($model);                    
				//	exit;
				Yii::app()->db->createCommand('DELETE FROM c_inspec_file_temp WHERE user_id='.Yii::app()->user->ID)->execute();

				$this->redirect(array('index'));
			}	
				
		}
		else
		{
          if (!Yii::app()->request->isAjaxRequest)
			Yii::app()->db->createCommand('DELETE FROM c_inspec_file_temp WHERE user_id='.Yii::app()->user->ID)->execute();
			  
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

		if(isset($_POST['InspecDoc']))
		{
			$model->attributes=$_POST['InspecDoc'];
			$model->dept_id = $_POST['InspecDoc']['dept_id'];
			$model->cust_id=$_POST['InspecDoc']['cust_id'];
			$model->vend_id = $_POST['InspecDoc']['vend_id'];
			$model->con_no = $_POST['InspecDoc']['con_no'];

			if(isset($_POST['InspecDoc']['cancel_remark']))
				$model->cancel_remark = $_POST['InspecDoc']['cancel_remark'];

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

			Yii::app()->db->createCommand("delete * from inspec_cer where inspec_id=".$id)->query();

			$models = InspecFile::model()->findAll('doc_id=:id', array(':id' => $id)); 

			foreach ($models as $key => $model) {
				$model->delete();
			}

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
		$model=new InspecDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InspecDoc']))
			$model->attributes=$_GET['InspecDoc'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new InspecDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InspecDoc']))
			$model->attributes=$_GET['InspecDoc'];

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
		$model=InspecDoc::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='inspec-doc-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
