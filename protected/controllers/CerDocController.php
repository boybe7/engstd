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
				'actions'=>array('create','update','DeleteSelected','ReCheck','GenCerNo','InspecGetCerNo','GenCerNo2','close','cancel','genPDF','print','getCerNO','preview'),
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

	public function actionPreview($id){


		$this->render('preview',array('id'=>$id,'model'=>$this->loadModel($id)));

		//$this->renderPartial('_formPDF',array('model'=>$this->loadModel($id),'filename'=>""));

		// $model=$this->loadModel($id);
		// $details = Yii::app()->db->createCommand()
		// 			->select('*')
		// 			->from('c_cer_detail ct')	
		// 			//->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
  //         			->join('m_product p', 'p.prod_id=ct.prod_id')
		// 			->where('ct.cer_id='.$model->cer_id)		
  //         			//->group('detail')			                   
		// 			->queryAll();
		// header('Content-type: text/plain charset=utf-8');					
		// print_r($details[0]["prod_sizename"]);
		// exit;

	}

	public function actionGenPDF(){

		$id = $_GET["id"]; 
		//$filename='preview_'.date('m-d-Y_hia').'.pdf';
		$filename = Yii::app()->user->username.".pdf";
		$this->renderPartial('_formPDF',array('model'=>$this->loadModel($id),'filename'=>$filename));

		echo json_encode($filename);

	}

	public function gridGetProd($data,$row){

	     $id = $data->prod_id;
	     //do your stuff for finding the username or name with $user
	     //for eg.
	     //$detail = ProdType::model()->findByPk($id);
	     // make sure what ever model you are calling is accessible from this controller other wise you have to import the model on top of the controller above class of the controller.
	     //return $detail->prot_name;

	     $m = Yii::app()->db->createCommand()
					->select('prot_name')
					->from('m_prodtype')	
					->where('prot_id="'.$id.'"')					                   
					->queryAll();

		 return $m[0]['prot_name'];			
	}

	public function actionPrint(){

		$criteria = new CDbCriteria();
		$date_begin = "";
		$date_end = "";
		//$date_begin = $_REQUEST['CerDoc']['cer_date_begin']; 

	    if(!empty($_REQUEST['CerDoc']['cer_date_begin'])  && !empty($_REQUEST['CerDoc']['cer_date_end']))
	    {
	      $begin = $_REQUEST['CerDoc']['cer_date_begin'];
	      $date_begin = $_REQUEST['CerDoc']['cer_date_begin']; 
	      $str_date = explode("/", $begin);
          $begin= $str_date[2]."-".$str_date[1]."-".$str_date[0];

	      $end = $_REQUEST['CerDoc']['cer_date_end'];
	      $date_end = $_REQUEST['CerDoc']['cer_date_end'];
	      $str_date = explode("/", $end);
          $end= $str_date[2]."-".$str_date[1]."-".$str_date[0];

	      $criteria->addBetweenCondition('cer_date', $begin, $end, 'OR');
	    }
	    else if(!empty($_REQUEST['CerDoc']['cer_date_begin'])){
	      $begin = $_REQUEST['CerDoc']['cer_date_begin'];
	      $date_begin = $_REQUEST['CerDoc']['cer_date_begin']; 
	      $str_date = explode("/", $begin);
          $begin= $str_date[2]."-".$str_date[1]."-".$str_date[0];

          $criteria->compare('cer_date',$begin,true);
	    }
	    else if(!empty($_REQUEST['CerDoc']['cer_date_end'])){
	      $begin = $_REQUEST['CerDoc']['cer_date_end'];
	      $date_end = $_REQUEST['CerDoc']['cer_date_end'];
	      $str_date = explode("/", $begin);
          $begin= $str_date[2]."-".$str_date[1]."-".$str_date[0];

          $criteria->compare('cer_date',$begin,true);
	    }

	    if(isset($_GET['contract_no']))
	    	$criteria->compare('contract_no',$_GET['contract_no'],true);

	    if(isset($_GET['cer_no']))
	    	$criteria->compare('cer_no',$_GET['cer_no'],true);


	    if(isset($_GET['contractor']))
	    {
	    	$cons = explode("-", $_GET['contractor']);
            if(!empty($cons[1]))
	    	$criteria->compare('contractor',$cons[1],true);
	    }

	    if(isset($_GET['vend_id']))
	    {
	    	//$cons = explode("-", $_GET['vend_id']);
            //if(!empty($cons[1]))
	    	$criteria->compare('vend_id',$_GET['vend_id'],true);
	    }

	    if(isset($_GET['supp_id']))
	    {
	    	//$cons = explode("-", $_GET['vend_id']);
            //if(!empty($cons[1]))
	    	$criteria->compare('supp_id',$_GET['supp_id'],true);
	    }

	    $dataProvider=new CActiveDataProvider("CerDoc", array('criteria'=>$criteria,'pagination'=>array('pageSize'=>10)));

		$this->render('print',array(
			'dataProvider'=>$dataProvider,'date_begin2'=>$date_begin,'date_end2'=>$date_end
		));
	}	

	 public function actionGenCerNo(){
       
            $id = $_GET['id']; 
           
            $fiscalyear = date("n")<10 ? date("Y")+543 : date("Y")+544;
			$m = Yii::app()->db->createCommand()
					->select('max(strSplit(cer_no,"/", 1)) as max')
					->from('c_cer_doc')	
					->where('strSplit(strSplit(cer_no,".", 2),"/",2)='.$fiscalyear.' AND vend_id="'.$id.'" ')					                   
					->queryAll();
			//header('Content-type: text/plain charset=utf-8');		
			//echo 'strSplit(strSplit(cer_no,".", 2),"/",2)='.$fiscalyear.' AND vend_id="'.$id.'" and cer_id!='.$cid;		
			//exit;

			$v = Yii::app()->db->createCommand()
					->select('shortname')
					->from('vendor')	
					->where('name="'.$id.'"')					                   
					->queryAll();		


			if(empty($m[0]['max']))
			{
				$cerNo = $v[0]['shortname'].".001/".$fiscalyear;	
			}
			else
			{
				$code = explode(".", $m[0]['max']);
				if($code[0]!=$v[0]['shortname'])
                   $cerNo = $v[0]['shortname'].".001/".$fiscalyear;
				else
				{
					$num = intval($code[1])+1;
	                if(strlen($num)==2)
	                    $num = "0".$num;
	                else if(strlen($num)==1)
	                    $num = "00".$num;

	                $cerNo = $code[0].".".$num."/".$fiscalyear;	
				}	
				
			}  				

            $this->layout='empty';
            echo json_encode($cerNo);
        
    }

     public function actionGenCerNo2(){
       
            $id = $_GET['id'];        
            $fiscalyear = date("n")<10 ? date("Y")+543 : date("Y")+544;
			$m = Yii::app()->db->createCommand()
					->select('max(strSplit(cer_no,"/", 1)) as max')
					->from('c_cer_doc')	
					->where('strSplit(strSplit(cer_no,".", 2),"/",2)='.$fiscalyear.' AND supp_id="'.$id.'"')					                   
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
                else if(strlen($num)==1)
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
             
				Yii::app()->db->createCommand('DELETE FROM c_cer_detail WHERE cer_id='.$autoId)->execute();
			
                $this->loadModel($autoId)->delete();
            }
        }    
    }

    public function actionCancel()
    {
    	$id = $_POST['selectedID'];
        $comment = str_replace("comment=&comment=", "", urldecode($_POST['data']));
        $model=$this->loadModel($id);
        $model->cer_status = 3;
        $model->cer_notes .= " ยกเลิก (".$comment.")";
        $model->save();

   //        header('Content-type: text/plain charset=utf-8');
    
		 // 			print_r(urldecode($_POST['data']));                    
		 // exit;
    	
        // if(count($ids)>0)
        // {
        //     foreach($ids as $id)
        //     {
        //         $model=$this->loadModel($id);
        //         $model->cer_status = 3;
        //         $model->save();
        //     }
        // }    
    }

    public function actionGetCerNO(){
            $request=trim($_GET['term']);
                    
            $models=CerDoc::model()->findAll(array("condition"=>"cer_no like '%$request%' order by cer_no"));
            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $data[] = array(
                        'id'=>$model['cer_no'],
                        'label'=>$model['cer_no']

                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }

     public function actionReCheck($id){
            
            $model = $this->loadModel($id);
            $cer_old = explode(".", $model->cer_no);
            if($model->supp_id!="")
            {
            	$supp = Vendor::model()->findAll(array("condition"=>"type=1 AND name='".$model->supp_id."'"));
            	$cernew = $supp[0]->shortname.".".$cer_old[1];
            }	               	
            else
            {
            	$vendor = Vendor::model()->findAll(array("condition"=>"type=0 AND name='".$model->vend_id."'"));
            	$cernew = $vendor[0]->shortname.".".$cer_old[1];
            }	
               

            $this->layout='empty';
            echo json_encode($cernew);
        
    }

    public function actionInspecGetCerNo(){
            $request=trim($_GET['term']);
            $con_id=trim($_GET['con_id']);
            $cust_id=trim($_GET['cust_id']);
                    
            $models=CerDoc::model()->findAll(array("condition"=>"cer_no like '%$request%' AND contract_no='".$con_id."' AND contractor='".$cust_id."' order by cer_no"));
            $data=array();
            foreach($models as $model){
                //$data[]["label"]=$get->v_name;
                //$data[]["id"]=$get->v_id;
                $data[] = array(
                        'id'=>$model['cer_no'],
                        'label'=>$model['cer_no']

                );

            }
            $this->layout='empty';
            echo json_encode($data);
        
    }

     public function actionClose()
    {
    	$ids = $_POST['selectedID'];
        if(count($ids)>0)
        {
            foreach($ids as $id)
            {
                $model=$this->loadModel($id);
                $model->cer_status = 2;
                $model->save();

                $m_contract = Contract::model()->findAll(array("condition"=>"con_number = '".$model->contract_no."' "));
                $m_contract[0]->con_status = 1;
                $m_contract[0]->save();
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

		//get last manager
		$m_last = CerDoc::model()->findAll(array('order' => 'cer_id DESC','limit' => 1));
		$model->cer_ct_name = $m_last[0]->cer_ct_name;
		$model->cer_di_name = $m_last[0]->cer_di_name;

		//auto gen running_no
		 $fiscalyear = date("n")<10 ? date("Y")+543 : date("Y")+544;
		 $m = Yii::app()->db->createCommand()
                    ->select('max(strSplit(running_no,"/", 1)) as max')
                    ->from('c_cer_doc') 
                    ->where('strSplit(running_no,"/", 2)='.$fiscalyear)                                    
                    ->queryAll();

			

			if(empty($m[0]['max']))
            {
                
                $runNo = "00001/".$fiscalyear;  
            }
            else
            {
               
                $num = intval($m[0]['max'])+1;
                if(strlen($num)==4)
                    $num = "0".$num;
                else if(strlen($num)==3)
                    $num = "00".$num;
                else if(strlen($num)==2)
                    $num = "000".$num;
                else if(strlen($num)==1)
                    $num = "0000".$num;

                $runNo = $num."/".$fiscalyear;
            }               
            				


		//$model->cer_no = ($m[0]['max']+1)."/".$fiscalyear;		

		$model->cer_date = date("d")."/".date("m")."/".(date("Y")+543);//"11/07/2526";
        $model->running_no = $runNo;
        $model->cer_name = Yii::app()->user->name;


		if(isset($_POST['CerDoc']))
		{
			$model->attributes=$_POST['CerDoc'];


			$model->user_update = Yii::app()->user->name;
			$model->cer_uid = Yii::app()->user->id;
			$model->cer_status = 1;
			$model->cer_date_add = (date("Y")+543).date("-m-d");
			$model->contractor = $_POST['CerDoc']['contractor'];
			$model->contract_no = $_POST['CerDoc']['contract_no'];
			$model->dept_id = $_POST['CerDoc']['dept_id'];
			$text = trim($_POST['CerDoc']['cer_notes']); // remove the last \n or whitespace character
            $model->cer_notes = nl2br($text); // insert <br /> before \n 
            $model->running_no = $runNo;
            $model->vend_id = $_POST["vend_id"]==$_POST['CerDoc']['vend_id'] ? $_POST["vend_id"] : '';
            $model->supp_id = $_POST["supp_id"]==$_POST['CerDoc']['supp_id'] ? $_POST["supp_id"] : '';

            $model->cer_oper_dept = Yii::app()->user->getUserDept();

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
					 $modelDetail->prod_id = $mTemp['prod_id'];
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
			$model->user_update = Yii::app()->user->name;
			$model->contractor = $_POST['CerDoc']['contractor'];
			$model->contract_no = $_POST['CerDoc']['contract_no'];
			$model->dept_id = $_POST['CerDoc']['dept_id'];
			$text = trim($_POST['CerDoc']['cer_notes']); // remove the last \n or whitespace character
            $model->cer_notes = nl2br($text); // insert <br /> before \n 
            $model->vend_id = $_POST["vend_id"]==$_POST['CerDoc']['vend_id'] ? $_POST["vend_id"] : '';
            $model->supp_id = $_POST['CerDoc']['supp_id'];

            $model->cer_oper_dept = Yii::app()->user->getUserDept();

			if($model->save())
				$this->redirect(array('index'));
		}

		$model->cer_notes = str_replace("<br />", "", $model->cer_notes);

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
			

			
			$model = $this->loadModel($id);
			$id = $model->cer_id; 

			Yii::app()->db->createCommand('DELETE FROM c_cer_detail WHERE cer_id='.$id)->execute();
			
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


		if(Yii::app()->user->name!="guest")
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
