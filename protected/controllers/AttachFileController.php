<?php

class AttachFileController extends Controller
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
				'actions'=>array('index','view','deleteFile'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update2','download'),
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
		$model=new AttachFile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AttachFile']))
		{
				$model->attributes=$_POST['AttachFile'];
				$uploadFile = CUploadedFile::getInstance($model, 'filename');
				$filesave = '';
				//header('Content-type: text/plain');
				if($uploadFile !== null) {


					$uploadFileName = time()."_".Yii::app()->user->ID.".".$uploadFile->getExtensionName();
									
					$filesave = Yii::app()->basePath .'/../attach_files/'.iconv("UTF-8", "TIS-620",$uploadFileName);
					$model->filename = $uploadFile;
									

									if($model->filename->saveAs($filesave)){


										$model->filename = $uploadFileName;																	
										
										if($model->save())
											echo CJSON::encode(array('success' => true));
										else
											echo CJSON::encode(array('fail' => true));
										
									
									}
							
				}
				

				//print_r($model);
		   		//exit;	
		}

	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate2()
	{
		$es = new EditableSaver('AttachFile');
	    try {
	    	$es->update();
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
		$dataProvider=new CActiveDataProvider('AttachFile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AttachFile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AttachFile']))
			$model->attributes=$_GET['AttachFile'];

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
		$model=AttachFile::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='attach-file-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDownload($id)
    {

   			$model=AttachFile::model()->findByPk($id);
			$fullPath = Yii::app()->basePath .'/../attach_files/'.$model->filename;
		
			/*if (file_exists($file)) {

			    // Force the download
				header("Content-Disposition: attachment; filename=" . basename($file));
				header("Content-Length: " . filesize($file));
				header("Content-Type: application/octet-stream;");
				readfile($file);

			    exit;

			}
			else{
				echo "File $file not exist";
			}*/

			if( file_exists($fullPath) ){

			    // Parse Info / Get Extension
			    $fsize = filesize($fullPath);
			    $path_parts = pathinfo($fullPath);
			    $ext = strtolower($path_parts["extension"]);

			    // Determine Content Type
			    switch ($ext) {
			      case "pdf": $ctype="application/pdf"; break;
			      case "exe": $ctype="application/octet-stream"; break;
			      case "zip": $ctype="application/zip"; break;
			      case "doc": $ctype="application/msword"; break;
			      case "xls": $ctype="application/vnd.ms-excel"; break;
			      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
			      case "gif": $ctype="image/gif"; break;
			      case "png": $ctype="image/png"; break;
			      case "jpeg":
			      case "jpg": $ctype="image/jpg"; break;
			      default: $ctype="application/force-download";
			    }

			    header("Pragma: public"); // required
			    header("Expires: 0");
			    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			    header("Cache-Control: private",false); // required for certain browsers
			    header("Content-Type: $ctype");
			    header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
			    header("Content-Transfer-Encoding: binary");
			    header("Content-Length: ".$fsize);
			    ob_clean();
			    flush();
			    readfile( $fullPath );

			  } else
			    die('File Not Found');

             
    }

    public function actionDeleteFile($id)
	{
		
		
			$model = AttachFile::model()->findByPk($id);
			$filename = Yii::app()->basePath .'/../attach_files/'.$model->filename;
			if($model->delete())
			{
				if (file_exists($filename)) 
						unlink($filename);
											
			}
			return true;
		   // $this->redirect( $_POST['returnUrl'] );
		
	}
}
