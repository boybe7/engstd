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
          $begin2= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

	      $end = $_GET['cer_date_end'];
	      $str_date = explode("/", $end);
          $end2= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

	      $criteria->addBetweenCondition('cer_date', $begin2, $end2, 'OR');
	    }
	    else if(!empty($_GET['cer_date_begin'])){
	      $begin = $_GET['cer_date_begin'];
	      $str_date = explode("/", $begin);
          $begin2= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

          $criteria->compare('cer_date',$begin2,true);
	    }
	    else if(!empty($_GET['cer_date_end'])){
	      $begin = $_GET['cer_date_end'];
	      $str_date = explode("/", $begin);
          $begin2= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

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
		    $date_start = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

		$str_date = explode("/", $date_end);
		if(count($str_date)>1)
		    $date_end = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

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
		


				$sheet = 0;
			    $objPHPExcel->createSheet(0);
				$objPHPExcel->setActiveSheetIndex($sheet)->setTitle("sheet1");
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

				$prod_code = empty($m[0]) ? "ข้อมูลถูกลบ": $m[0]['prod_code'];	
				$prod_unit = empty($m[0]) ? "ข้อมูลถูกลบ": $m[0]['prod_unit'];	


				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, $model['vend_id']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, $model['cer_no']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $model['running_no']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $model['cer_date']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, $model['cer_oper_date']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, $model['contract_no']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.$row, $prod_code);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.$row, $model['detail']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('I'.$row, $model['size']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('J'.$row, $model['serialno']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('K'.$row, $model['quantity']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('L'.$row, $prod_unit);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('M'.$row, $model['cer_name']);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('N'.$row, $model['dept_id']);

				$row++;
		
		}	

		$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setPassword("password");		

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
	    $date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];
        $vend_id_sta   = $_GET["vend_id_sta"];
        $vend_id_end   = $_GET["vend_id_end"];

        if($_GET["con_id"]=="")
        	  $vend_id_sta = "";

        if($_GET["con_id2"]=="")
        	  $vend_id_end = "";	

		$this->renderPartial('_formR8', array(

            'date_start'=>$date_start,
            'date_end'=>$date_end,
            'vend_id_sta'=>$vend_id_sta,
            'vend_id_end'=>$vend_id_end,
            'display' => 'block',
        ), false, true);
	}

	public function actionPrintR8()
    {
        	
	    $date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];
        $vend_id_sta   = $_GET["vend_id_sta"];
        $vend_id_end   = $_GET["vend_id_end"];

         if($_GET["con_id"]=="")
        	  $vend_id_sta = "";

        if($_GET["con_id2"]=="")
        	  $vend_id_end = "";	

		$this->renderPartial('_formR8_PDF', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,
                'vend_id_sta'=>$vend_id_sta,
                'vend_id_end'=>$vend_id_end,
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

		$this->renderPartial('_formR9_PDF', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
        }


     public function actionR9Excel()
    {
			

    	$date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];

        $str_date = explode("/", $date_start);
		if(count($str_date)>1)
		    $date_start = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

		$str_date = explode("/", $date_end);
		if(count($str_date)>1)
		    $date_end = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

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
		

		

				$sheet = 0;
			    $objPHPExcel->createSheet(0);
				$objPHPExcel->setActiveSheetIndex($sheet)->setTitle("sheet1");
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('A')->setWidth(50);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('B')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('C')->setWidth(20);	
				

				//$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells("A1:E1");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A1', "ผลิตภัณฑ์");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B1', "จำนวน");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C1', "หน่วย");
				


				//$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($header, 'A1:N1');
				//$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A1:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$row = 2;
		
		if(empty($date_end) && empty($date_start))
		{
				$models_m = Yii::app()->db->createCommand('SELECT p.prot_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id    
                        GROUP BY p.prot_id ORDER BY cd.cer_id ')->queryAll();  

                $test = Yii::app()->db->createCommand('SELECT sub.name AS subname, SUM( ct.quantity ) AS sum, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                       
                        GROUP BY  IFNULL( sub.id, t.prot_name )  ORDER BY t.prot_name ')->queryAll();              
		}	
		else 
		{


			  $models_m = Yii::app()->db->createCommand('SELECT p.prot_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id                         
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"
                        GROUP BY p.prot_id ORDER BY cd.cer_id ')->queryAll();    

              $test = Yii::app()->db->createCommand('SELECT sub.name AS subname, SUM( ct.quantity ) AS sum, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"
                        GROUP BY  IFNULL( sub.id, t.prot_name )  ORDER BY t.prot_name ')->queryAll();              
		}			
		foreach ($test as $key => $m) {

			   $test2 = Yii::app()->db->createCommand('SELECT detail, prod_unit, t.prot_name
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND p.prot_id="'.$m["prot_id"].'" AND p.prot_sub_id="'.$m["prot_sub_id"].'"
                        GROUP BY prod_unit')->queryAll();  

			   	$unit = "";
                $i = 0;        
                foreach ($test2 as $key => $m2) {
                      if($i==0)
                         $unit = $m2["prod_unit"];
                      else 
                         $unit .= "/".$m2["prod_unit"]; 

                      $i++;        
                }

                $sum = $m["sum"];

                if($m["subname"]=="ท่อ") 
                  {    
                      $unit = "เมตร";  
                       $models = Yii::app()->db->createCommand('SELECT sub.name AS subname, SUM( ct.quantity ) AS sum, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND p.prot_id="'.$m["prot_id"].'" AND p.prot_sub_id="'.$m["prot_sub_id"].'"
                        GROUP BY  p.prod_id ORDER BY p.prod_name ASC')->queryAll();      
                      
                        $sum2 = 0;
                        foreach ($models as $key => $m2) {
                         
                           $sum2 += $m2["sum"]*$m2["factor"]; 

                        }  
                        
                        $sum = $sum2; 
                        
                      
                  }    
              

				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, $m["prot_name"].":".$m["subname"]);
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, number_format($sum,0));
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $unit);
				
				$row++;
		
		}		

		$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B2:B'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('C2:C'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sumCost = 0;
                  foreach ($models_m as $key => $model_m) {
                        $type_id = $model_m['prot_id'];
                        /*$models = Yii::app()->db->createCommand()
                                    ->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit,pt.prot_name,price,factor')
                                    ->from('c_cer_doc cd')
                                    ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                    ->join('m_product p', 'p.prod_name = ct.detail AND p.prod_sizename LIKE CONCAT("%",ct.prod_size,"%") ')
                                    ->join('m_prodtype pt', 'p.prot_id=pt.prot_id')
                                    ->where('p.prot_id="'.$type_id.'" AND cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                                    ->group('prod_code')
                                    ->queryAll();*/

                         $models = Yii::app()->db->createCommand('SELECT sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name,price,factor
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND p.prot_id="'.$type_id.'"
                        GROUP BY prod_code')->queryAll();                   
                           
                        foreach ($models as $key => $mm) {
                           
                       

                           $price = $mm["sum"]*$mm["price"];
                            $sumCost += $price;

                           //echo $mm["detail"]." | ".$mm["size"]." |จำนวน: ".$mm["sum"]." |ราคา ".$mm["price"]." = ".number_format($price)."<br>";  
                        }            
                                  
                        
                        //$sumCost += $models[0]["sum"]*      
                  }   

                  $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.($row+2),  "มูลค่างาน ");
                  $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.($row+2),  number_format($sumCost,0));
                  $objPHPExcel->setActiveSheetIndex($sheet)->getStyle('C'.($row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                  $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.($row+2),  " บาท");


				ob_end_clean();
				ob_start();

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="r9_report.xls"');
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
    

    public function actionR9MonthlyExcel()
    {
			

    	$date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];

        $str_date = explode("/", $date_start);
		if(count($str_date)>1)
		    $date_start = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

		$str_date = explode("/", $date_end);
		if(count($str_date)>1)
		    $date_end = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

		if(empty($date_end))
			$date_end = $date_start;
		if(empty($date_start))
			$date_start = $date_end;


	
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load("report/template_monthly.xlsx");

        $header = new PHPExcel_Style();
		$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 16,   
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
		

		

				$sheet = 0;
		
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A2', "1. ผลงานประจำเดือน ".$_GET["date_start"].' ถึง '.$_GET["date_end"]);
																
			$sum_cost = 0;	
			if(!empty($_GET["date_start"]) && !empty($_GET["date_end"]))
			{


               $models = Yii::app()->db->createCommand('SELECT sub.name AS subname, SUM( ct.quantity*factor ) AS sum,SUM( ct.quantity*price) AS sum_price,price, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"
                        
                        GROUP BY  IFNULL( sub.id, t.prot_name )  ORDER BY t.prot_name,sub.name DESC')->queryAll();              
				// AND p.prot_sub_id NOT IN (2,15,19,22,23,25,28,29,30,38)
				$row = 8;			
				foreach ($models as $key => $m) {
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, $m['prot_name'].":".$m["subname"]);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $m["sum"]);
					if($m["prot_sub_id"]==32 || $m["prot_sub_id"]==8)
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, "ชุด/ตัว/แผ่น");
					else if($m["prot_sub_id"]==34)
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, "ชุด/ตัว");
					else if($m["subname"]=="ท่อ")
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, "เมตร");
					else	
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, $m["prod_unit"]);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, ($m["sum_price"]));
					$sum_cost += $m["sum_price"];
					$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0');
					$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode('#,##0.00');


					//พี วี ซี:ท่อ
					if($m['prot_id']==15 && $m['prot_sub_id']==12)
					{
						//SELECT sub.name AS subname,ct.quantity , detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id FROM c_cer_doc cd LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id LEFT JOIN m_product p ON p.prod_id = ct.prod_id LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id WHERE cer_date BETWEEN "2021-12-01" AND "2021-12-31" AND t.prot_id=15 AND p.prot_sub_id=12 ORDER BY p.prod_id ASC

						$model_temp = Yii::app()->db->createCommand('SELECT sub.name AS subname,prod_size1, SUM( ct.quantity*factor ) AS sum,SUM( ct.quantity*price) AS sum_price, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id
                        	FROM c_cer_doc cd
                        	LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        	LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                        	LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        	LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        	WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND t.prot_id=15 AND p.prot_sub_id=12 GROUP BY p.prod_id ORDER BY p.prod_id ASC')->queryAll(); 
						$row++;
						$detail = "";
						//$size = array('100','150','200','300','400');

						foreach ($model_temp as $key => $value) {
							if($detail!=$value["detail"])
							{
								$str = explode(" ",$value["detail"]);
								$details = $str[1]." ".$str[2];
								$detail = $value["detail"];
								$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, $details);
								$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
							}

							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $value["prod_size1"]." มม.");
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $value["sum"]);
							//if($value["subname"]=="ท่อ")
							//	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, "เมตร");
							//else
							//	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, $value["prod_unit"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, ($value["sum_price"]));
							$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
							$row++;
						}

						//$row = $row + 10;
					}
					else if($m['prot_id']==39 && $m['prot_sub_id']==35)  //เหล็กหล่อ:ประตูน้ำ 
					{
						
						$model_temp = Yii::app()->db->createCommand('SELECT sub.name AS subname,prod_size1, SUM( ct.quantity*factor ) AS sum,SUM( ct.quantity*price) AS sum_price, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id,p.prod_id 
                        	FROM c_cer_doc cd
                        	LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        	LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                        	LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        	LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        	WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND t.prot_id=39 AND p.prot_sub_id=35 GROUP BY p.prod_id ORDER BY prod_size1 ASC')->queryAll(); 
						$row++;
						$detail = "";
						//$size = array('100','150','200','300','400');

						foreach ($model_temp as $key => $value) {
							if($detail!=$value["detail"])
							{
								$str = explode(" ",$value["detail"]);
								//$details = $str[0]." ".$str[2];
								$detail = $value["detail"];
								$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, $detail);
								$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
							}

							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $value["prod_size1"]." มม.");
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $value["sum"]);
							//$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, $value["prod_unit"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, ($value["sum_price"]));
							$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0');
							$objPHPExcel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()->setFormatCode('#,##0.00');
							$row++;
						}

						//$row = $row + 10;
					}
					else 
						$row++;
				}

				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, "(ภาคผนวกหมายเลข 6)"); $row++;
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, "มูลค่างาน");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $sum_cost/1000000);
				
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, "ล้านบาท");
				$objPHPExcel->getActiveSheet()->setSharedStyle($header,'A'.$row.":F".$row);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0');

		    }

				ob_end_clean();
				ob_start();

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="monthly_export.xls"');
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
    public function actionR10()
	{
		$this->render('r10');
	}

	public function actionR10Excel()
    {
			

    	$date_start = $_GET["date_start"];
        $date_end   = $_GET["date_end"];

        $str_date = explode("/", $date_start);
		if(count($str_date)>1)
		    $date_start = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

		$str_date = explode("/", $date_end);
		if(count($str_date)>1)
		    $date_end = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

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
		

		

				$sheet = 0;
			    $objPHPExcel->createSheet(0);
				$objPHPExcel->setActiveSheetIndex($sheet)->setTitle("sheet1");
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('A')->setWidth(15);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('B')->setWidth(15);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('C')->setWidth(15);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('E')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('G')->setWidth(15);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('H')->setWidth(25);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('I')->setWidth(10);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('J')->setWidth(20);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('K')->setWidth(10);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('L')->setWidth(20);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('M')->setWidth(20);	
				

				//$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells("A1:E1");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A1', "ข้อมูลตั้งแต่วันที่ ".$_GET["date_start"].' ถึง '.$_GET["date_end"]);
																

				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A2', "วันที่ออกใบรับรอง");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B2', "เลขที่");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C2', "สัญญา");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D2', "คู่สัญญา");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E2', "ผู้ผลิต/ผู้จัดส่ง");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F2', "ประเภท");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G2', "วันที่ดำเนินการ");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H2', "รายละเอียดท่อ/อุปกรณ์");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('I2', "ขนาด มม.");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('J2', "หมายเลข");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('K2', "จำนวน");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('L2', "หน่วยงานต้นเรื่อง");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('M2', "ผู้ออกใบรับรอง");
				
				$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A2:M2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


				//$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($header, 'A1:N1');
				//$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A1:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$row = 3;

				$models_m = Yii::app()->db->createCommand('SELECT *,cd.prod_id as product_type
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id                   
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"
                        ORDER BY cd.cer_date ')->queryAll();  

				foreach ($models_m as $key => $value) {

				 	$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, $value['cer_date']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, $value['cer_no']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $value['contract_no']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, $value['contractor']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row, $value['vend_id']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, $value['product_type']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.$row, $value['cer_oper_date']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.$row, $value['detail']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('I'.$row, $value['prod_size']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('J'.$row, $value['serialno']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('K'.$row, $value['quantity']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('L'.$row, $value['dept_id']);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('M'.$row, $value['cer_name']);

					$row++;
				 } 
		
		

				ob_end_clean();
				ob_start();

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="r10_export.xls"');
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