<?php


class ReportBController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        
       


        //-----------------------------
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
    public function actionR2()
	{
		$criteria = new CDbCriteria();
		$begin = "";
		$end = "";

	    if(!empty($_GET['cer_date_begin'])  && !empty($_GET['cer_date_end']))
	    {
	      $begin = $_GET['cer_date_begin'];
	      $str_date = explode("/", $begin);
          $begin2= $str_date[2]."-".$str_date[1]."-".$str_date[0];

	      $end = $_GET['cer_date_end'];
	      $str_date = explode("/", $end);
          $end2= $str_date[2]."-".$str_date[1]."-".$str_date[0];

	      $criteria->addBetweenCondition('cer_date', $begin2, $end2, 'OR');
	    }
	    else if(!empty($_GET['cer_date_begin'])){
	      $begin = $_GET['cer_date_begin'];
	      $str_date = explode("/", $begin);
          $begin2= $str_date[2]."-".$str_date[1]."-".$str_date[0];

          $criteria->compare('cer_date',$begin2,true);
	    }
	    else if(!empty($_GET['cer_date_end'])){
	      $begin = $_GET['cer_date_end'];
	      $str_date = explode("/", $begin);
          $begin2= $str_date[2]."-".$str_date[1]."-".$str_date[0];

          $criteria->compare('cer_date',$begin2,true);
	    }

	    // if(isset($_GET['contract_no']))
	    // 	$criteria->compare('contract_no',$_GET['contract_no'],true);

	    // if(isset($_GET['cer_no']))
	    // 	$criteria->compare('cer_no',$_GET['cer_no'],true);



	    $dataProvider=new CActiveDataProvider("CerDoc", array('criteria'=>$criteria,'pagination'=>array('pageSize'=>10)));

		$this->render('r2',array(
			'dataProvider'=>$dataProvider,'begin'=>$begin,'end'=>$end
		));
	}

	public function actionGenR2()
	{

		//$vid = $_GET["r2"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR2', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}

	public function actionPrintR2()
    {
        	
	    
	        $date_start = $_GET["date_start"];
            $date_end   = $_GET["date_end"];

			$this->renderPartial('_formR2_PDF', array(

	                'date_start'=>$date_start,
	                'date_end'=>$date_end,

	            //'model' => $model,
	            'display' => 'block',
	        ), false, true);

        
    }

    public function actionR2Excel()
    {
			

    	$date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];

        $str_date = explode("/", $date_start);
		if(count($str_date)>1)
		    $date_start = $str_date[2]."-".$str_date[1]."-".$str_date[0];

		$str_date = explode("/", $date_end);
		if(count($str_date)>1)
		    $date_end = $str_date[2]."-".$str_date[1]."-".$str_date[0];

		if(empty($date_end))
			$date_end = $date_start;
		if(empty($date_start))
			$date_start = $date_end;


	
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();

        $header = new PHPExcel_Style();
		$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 12,   
			            'bold'  => true,           
			            'color' => array(
			            	'rgb'   => '000000'
			            	)
			       		)
			    	)  
			  ); 
		$tableHead = new PHPExcel_Style();
	    $tableHead->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 12,   
			             'bold'  => true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            
			    ));

		$tableHeadOne = new PHPExcel_Style();
	    $tableHeadOne->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 12,   
			             'bold'  => true,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            'fill'  => array(
			            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			            //'color' => array('rgb' =>'FA9D8E')
			        ),
			         'borders' => array(
			            	'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_DOTTED ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'left'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
				           	'right'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	)             
			        	)
			    ));

		$cashsum = new PHPExcel_Style();
	    $cashsum->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 12,   
			                          
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			         
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_THIN ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
			        	)
			    ));

	    $cashsumAll = new PHPExcel_Style();
	    $cashsumAll->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 12,   
			                          
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			         
			            'borders' => array(
				            'bottom'    => array(
				            	'style'   => PHPExcel_Style_Border::BORDER_DOUBLE ,
				            	'color'   => array(
				            		'rgb'     => '000000'
				              	)
				           	),
			        	)
			    ));


		$normal = new PHPExcel_Style();
	    $normal->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 12,   
			                          
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			    ));
		

		
		$month_th = array("1" => "Á¡ÃÒ¤Á", "2" => "¡ØÁÀÒ¾Ñ¹¸ì", "3" => "ÁÕ¹Ò¤Á","4" => "àÁÉÒÂ¹", "5" => "¾ÄÉÀÒ¤Á", "6" => "ÁÔ¶Ø¹ÒÂ¹","7" => "¡Ã¡®Ò¤Á", "8" => "ÊÔ§ËÒ¤Á", "9" => "¡Ñ¹ÂÒÂ¹","10" => "µØÅÒ¤Á", "11" => "¾ÄÈ¨Ô¡ÒÂ¹", "12" => "¸Ñ¹ÇÒ¤Á");

	

				$sheet = 0;
			    $objPHPExcel->createSheet(0);
				$objPHPExcel->setActiveSheetIndex($sheet)->setTitle("ãºÃÑºÃÍ§");
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('A')->setWidth(50);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('B')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('C')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('D')->setWidth(30);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('E')->setWidth(30);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('F')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('G')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('H')->setWidth(50);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('J')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('K')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('L')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('M')->setWidth(30);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('N')->setWidth(20);
						   	      

				//$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells("A1:E1");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A1', "ผู้ผลิต/ผู้จัดส่ง");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B1', "เลขที่");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C1', "Running No.");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D1', "วันที่ดำเนินการ");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E1', "วันตรวจโรงงาน");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F1', "สัญญา");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G1', "รหัสท่อ/อุปกรณ์");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H1', "รายละเอียดท่อ/อุปกรณ์");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('I1', "ขนาด");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('J1', "Serial No.");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('K1', "ปริมาณ");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('L1', "หน่วยนับ");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('M1', "ผู้ตรวจโรงงาน");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('N1', "หน่วยงานต้นเรื่อง");


				//$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($header, 'A1:N1');
				//$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A1:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$row = 2;
		
		if(empty($date_end) && empty($date_start))
		{
				$models = Yii::app()->db->createCommand()
					->select('vend_id,cer_no,running_no,cer_date,cer_oper_date,contract_no,detail,ct.prod_size as size,serialno,quantity,cer_name,dept_id')
					->from('c_cer_doc cd')	
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
         			//->join('m_product p', 'p.prod_name=ct.detail')
					//->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')				                   
					->queryAll();
		}	
		else 
		{


			$models = Yii::app()->db->createCommand()
					->select('vend_id,cer_no,running_no,cer_date,cer_oper_date,contract_no,detail,ct.prod_size as size,serialno,quantity,cer_name,dept_id')
					->from('c_cer_doc cd')	
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
         			//->join('m_product p', 'p.prod_name=ct.detail')
					->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')				                   
					->queryAll();
		}			
		foreach ($models as $key => $model) {

			   $m = Yii::app()->db->createCommand()
					->select('prod_code,prod_unit')
					->from('m_product')	
					->where('prod_name="'.$model['detail'].'"')				                   
					->queryAll();
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, $model['vend_id']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, $model['cer_no']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $model['running_no']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $model['cer_date']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, $model['cer_oper_date']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, $model['contract_no']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.$row, $m[0]['prod_code']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.$row, $model['detail']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('I'.$row, $model['size']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('J'.$row, $model['serialno']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('K'.$row, $model['quantity']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('L'.$row, $m[0]['prod_unit']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('M'.$row, $model['cer_name']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('N'.$row, $model['dept_id']);

				$row++;
		
		}			

				ob_end_clean();
				ob_start();

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="r2_report.xls"');
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

  
    //-----------------------------
    public function actionR6()
	{
		$this->render('r6');
	}

	public function actionGenR6()
	{
		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

                //$vend_id_all   = $_GET["vend_id_all"];
                $vend_id_sta   = $_GET["vend_id_sta"];
                $vend_id_end   = $_GET["vend_id_end"];

                //$prot_id_all   = $_GET["prot_id_all"];
               // $prod_id_sta   = $_GET["prod_id_sta"];
               // $prod_id_end   = $_GET["prod_id_end"];

		$this->renderPartial('_formR6', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,
                //'vend_id_all'=>$vend_id_all,
                'vend_id_sta'=>$vend_id_sta,
                'vend_id_end'=>$vend_id_end,
                //'prot_id_all'=>$prot_id_all,
                //'prod_id_sta'=>$prod_id_sta,
                //'prod_id_end'=>$prod_id_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}

	public function actionPrintR6()
    {
        	
	             $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

                //$vend_id_all   = $_GET["vend_id_all"];
                $vend_id_sta   = $_GET["vend_id_sta"];
                $vend_id_end   = $_GET["vend_id_end"];

                //$prot_id_all   = $_GET["prot_id_all"];
               // $prod_id_sta   = $_GET["prod_id_sta"];
               // $prod_id_end   = $_GET["prod_id_end"];

		$this->renderPartial('_formR6_PDF', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,
                //'vend_id_all'=>$vend_id_all,
                'vend_id_sta'=>$vend_id_sta,
                'vend_id_end'=>$vend_id_end,
                //'prot_id_all'=>$prot_id_all,
                //'prod_id_sta'=>$prod_id_sta,
                //'prod_id_end'=>$prod_id_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);

        
    }
        //-----------------------------
    public function actionR7()
	{
		$this->render('r7');
	}

	public function actionGenR7()
	{
	    $date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];
        $vend_id_sta   = $_GET["vend_id_sta"];
        $vend_id_end   = $_GET["vend_id_end"];

        if($_GET["con_id"]=="")
        	  $vend_id_sta = "";

        if($_GET["con_id2"]=="")
        	  $vend_id_end = "";	

		$this->renderPartial('_formR7', array(

            'date_start'=>$date_start,
            'date_end'=>$date_end,
            'vend_id_sta'=>$vend_id_sta,
            'vend_id_end'=>$vend_id_end,
            'display' => 'block',
        ), false, true);
	}

	public function actionPrintR7()
    {
        	
	    $date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];
        $vend_id_sta   = $_GET["vend_id_sta"];
        $vend_id_end   = $_GET["vend_id_end"];

         if($_GET["con_id"]=="")
        	  $vend_id_sta = "";

        if($_GET["con_id2"]=="")
        	  $vend_id_end = "";	

		$this->renderPartial('_formR7_PDF', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,
                'vend_id_sta'=>$vend_id_sta,
                'vend_id_end'=>$vend_id_end,
            'display' => 'block',
        ), false, true);

        
    }
        //-----------------------------
        public function actionR8()
	{
		$this->render('r8');
	}

	public function actionGenR8()
	{

		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR8', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        
        public function actionR9()
	{
		$this->render('r9');
	}

	public function actionGenR9()
	{
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR9', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}
	public function actionPrintR9()
        {


	        $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR4_PDF', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
        }

        //-----------------------------
        public function actionR10()
	{
		$this->render('r10');
	}

	public function actionGenR10()
	{

		
                $month = $_GET["monthEnd"];
                $year = $_GET["yearEnd"];

		
		$this->renderPartial('_formR10', array(
           
            'month'=>$month,
            'year'=>$year,

            'display' => 'block',
        ), false, true);
	}
        //-----------------------------
        public function actionR11()
	{
		$this->render('r11');
	}

	public function actionGenR11()
	{


                $month = $_GET["monthEnd"];
                $year = $_GET["yearEnd"];


		$this->renderPartial('_formR11', array(

            'month'=>$month,
            'year'=>$year,

            'display' => 'block',
        ), false, true);
	}
        //-----------------------------



        //////////////////////////////
	public function actionVendor()
	{
		$this->render('vendor');
	}

	public function actionGenVendor()
	{
		
		$vid = $_GET["vendor"];
		$modelV = Vendor::model()->findByPk($vid);

		$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));	

		$this->renderPartial('_formVendor', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);
	}


}

?>