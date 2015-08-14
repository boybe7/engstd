<?php

class CerDocController extends Controller
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
				'actions'=>array('create','update','DeleteSelected','GenCerNo'),
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

	 public function actionGenCerNo(){
       
            $id = $_GET['id'];        
            $fiscalyear = date("n")<10 ? date("Y")+543 : date("Y")+544;
			$m = Yii::app()->db->createCommand()
					->select('max(strSplit(cer_no,"/", 1)) as max')
					->from('c_cer_doc')	
					->where('strSplit(strSplit(cer_no,".", 2),"/",2)='.$fiscalyear.' AND vend_id="'.$id.'"')					                   
					->queryAll();

			

			if(empty($m[0]['max']))
			{
				$v = Yii::app()->db->createCommand()
					->select('shortname')
					->from('vendor')	
					->where('name="'.$id.'"')					                   
					->queryAll();
				$cerNo = $v[0]['shortname'].".001/".$fiscalyear;	
			}
			else
			{
				$code = explode(".", $m[0]['max']);
				$num = intval($code[1])+1;
                if(strlen($num)==2)
                    $num = "0".$num;
                else
                    $num = "00".$num;

                $cerNo = $code[0].".".$num."/".$fiscalyear;
			}  				

            $this->layout='empty';
            echo json_encode($cerNo);
        
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
		$model=new CerDoc;

		//auto gen doc_no
		$fiscalyear = date("n")<10 ? date("Y")+543 : date("Y")+544;
		$m = Yii::app()->db->createCommand()
				->select('max(strSplit(cer_no,"/", 1)) as max')
				->from('c_cer_doc')	
				->where('strSplit(cer_no,"/", 2)='.$fiscalyear)					                   
				->queryAll();

		//$model->cer_no = ($m[0]['max']+1)."/".$fiscalyear;		

		$model->cer_date = date("d")."/".date("m")."/".(date("Y")+543);//"11/07/2526";


		if(isset($_POST['CerDoc']))
		{
			$model->attributes=$_POST['CerDoc'];

			$model->user_update = Yii::app()->user->name;
			$model->cer_status = 1;
			$model->cer_date_add = (date("Y")+543).date("-m-d");
			$model->contractor = $_POST['CerDoc']['contractor'];
			$model->contract_no = $_POST['CerDoc']['contract_no'];
			$model->dept_id = $_POST['CerDoc']['dept_id'];

			if($model->save())
			{	
				$modelTemps = Yii::app()->db->createCommand()
						                    ->select('*')
						                    ->from('c_cer_detail_temp')
						                    ->where('user_id=:user', array(':user'=>Yii::app()->user->ID))
						                    ->queryAll();

				foreach ($modelTemps as $key => $mTemp) {

					 $modelDetail = new CerDetail("search");
					 $modelDetail->detail = $mTemp['detail'];
					 $modelDetail->prod_size = $mTemp['prod_size'];
					 $modelDetail->quantity = $mTemp['quantity'];
					 $modelDetail->serialno = $mTemp['serialno'];
                     $modelDetail->cer_id = $model->cer_id;
                    
                     $modelDetail->save();
      //                header('Content-type: text/plain');
      //                   print_r($mTemp);
					 // 	print_r($modelDetail);                    
					 // exit;

				}

				$this->redirect(array('index'));
			}	


		}
		else{
			if (!Yii::app()->request->isAjaxRequest)
			   Yii::app()->db->createCommand('DELETE FROM c_cer_detail_temp WHERE user_id='.Yii::app()->user->ID)->execute();
			
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

		if(isset($_POST['CerDoc']))
		{
			$model->attributes=$_POST['CerDoc'];
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
		$model=new CerDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CerDoc']))
			$model->attributes=$_GET['CerDoc'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CerDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CerDoc']))
			$model->attributes=$_GET['CerDoc'];

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
		$model=CerDoc::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cer-doc-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
