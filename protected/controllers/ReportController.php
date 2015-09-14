<?php


class ReportController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	//public $layout='//layouts/column2';

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
        
       

	/**
	 * Displays the progress page
	 */
        public function actionR1()
	{
		$this->render('r1');
	}

	public function actionGenR1()
	{

		//$vid = $_GET["r1"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR1', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
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
        //-----------------------------
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
	
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();

        $header = new PHPExcel_Style();
		$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'TH SarabunPSK', 
			            'size'  => 18,   
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
			            'size'  => 16,   
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
			            'size'  => 16,   
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
			            'size'  => 16,   
			                          
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
			            'size'  => 16,   
			                          
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
			            'size'  => 16,   
			                          
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			    ));
		

		
		$month_th = array("1" => "มกราคม", "2" => "กุมภาพันธ์", "3" => "มีนาคม","4" => "เมษายน", "5" => "พฤษภาคม", "6" => "มิถุนายน","7" => "กรกฎาคม", "8" => "สิงหาคม", "9" => "กันยายน","10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");

	

				$sheet = 0;
			    $objPHPExcel->createSheet(0);
				$objPHPExcel->setActiveSheetIndex($sheet)->setTitle("ใบรับรอง");
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('B')->setWidth(50);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('C')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('D')->setWidth(20);	
				$objPHPExcel->setActiveSheetIndex($sheet)->getColumnDimension('E')->setWidth(20);	
						   	      

				$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells("A1:E1");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A1', "ฝ่ายบริการวิศวกรรม การไฟฟ้าส่วนภูมิภาค");
				$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells('A2:E2');
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A2', "งบกำไรขาดทุน");
				$objPHPExcel->setActiveSheetIndex($sheet)->mergeCells('A3:E3');
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A3', "ประจำเดือน ".$monthBetween);
				$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($header, 'A1:E3');
				$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('A1:E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				//table header
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D4', "จำนวนเงิน (บาท)");
				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E4', "หมายเหตุ");

				$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A5', "รายได้ :");

				// $row = 6;
			

				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"รายได้จากกองบริการวิศวกรรมระบบส่ง");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($tsd_sum,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"1");
				// $row++;


				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"รายได้จากกองบริการบำรุงรักษา");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($msd_sum,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"2");
				// $row++;

				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"รายได้จากกองบริการวิศวกรรมระบบจำหน่าย");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($dsd_sum,2));
				// $income = $dsd_sum+$tsd_sum+$msd_sum;
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row,number_format($income,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'D'.$row);
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"3");
				// $row++;

				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, "หักค่าใช้จ่าย :");
				// $row++;

			
	             
	   //                $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"ค่าใช้จ่ายในการดำเนินงาน-กองบริการวิศวกรรมระบบส่ง");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($m_tsd,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"1");
				// $row++;


				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"ค่าใช้จ่ายในการดำเนินงาน-กองบริการบำรุงรักษา");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($m_msd,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"2");
				// $row++;

				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"ค่าใช้จ่ายในการดำเนินงาน-กองบริการวิศวกรรมระบบจำหน่าย");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($m_dsd,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"3");
				// $row++;     

    //             $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"ค่าใช้จ่ายในการบริหารงาน-กองบริการวิศวกรรมระบบส่ง");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($tsd_sap,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"1");
				// $row++;


				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"ค่าใช้จ่ายในการบริหารงาน-กองบริการบำรุงรักษา");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($msd_sap,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"2");
				// $row++;

				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row,"ค่าใช้จ่ายในการบริหารงาน-กองบริการวิศวกรรมระบบจำหน่าย");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row,number_format($dsd_sap,2));
				//  $outcome = $dsd_sap+$tsd_sap+$msd_sap+$dsd_sum+$tsd_sum+$msd_sum+$m_tsd+$m_msd+$m_dsd;
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row,number_format($outcome,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsum, 'D'.$row);
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$row,"3");
				// $row++;
        

				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('A'.$row, "กำไรสุทธิ :");
				// $objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row,"=D8-D".($row-1).")");//number_format($income - $outcome,2));
				// $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($cashsumAll, 'D'.$row);
				// //$row++;

				// $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($tableHead, 'A4:E5');
				// $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($tableHead, 'A4:A10');
				
				// $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'B6:C20');
				// $objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B4:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				
	   //          $objPHPExcel->setActiveSheetIndex($sheet)->getStyle('C4:D20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	   //          $objPHPExcel->setActiveSheetIndex($sheet)->getStyle('D'.$row)->getNumberFormat()->setFormatCode('#,##0.00'); 
				
	            
	   //          $objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'E6:E20');
	   //          $objPHPExcel->setActiveSheetIndex($sheet)->getStyle('E6:E20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				// ///header('Content-type: text/plain');
		         //   echo($pj_sheetname);                    
		         //exit;
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
        public function actionR3()
	{
		$this->render('r3');
	}

	public function actionGenR3()
	{

		$vid = $_GET["r3"];
		$modelV = Vendor::model()->findByPk($vid);

		$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));

		$this->renderPartial('_formR3', array(
            'model' => $model,
            'display' => 'block',
        ), false, true);
	}


        //-----------------------------
        public function actionR4()
	{
		$this->render('r4');
	}

	public function actionGenR4()
	{
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR4', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
	}

	public function actionPrintR4()
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
        public function actionR5()
	{
		$this->render('r5');
	}

	public function actionGenR5()
	{
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR5', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
            'display' => 'block',
        ), false, true);
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

		$this->renderPartial('_formR6', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

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


		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR7', array(

                'date_start'=>$date_start,
                'date_end'=>$date_end,

            //'model' => $model,
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

		//$vid = $_GET["r9"];
		//$modelV = Vendor::model()->findByPk($vid);

		//$model = InspecDoc::model()->findAll(array('order'=>'', 'condition'=>'vend_id="'.$modelV->name.'"', 'params'=>array()));
                $date_start = $_GET["date_start"];
                $date_end   = $_GET["date_end"];

		$this->renderPartial('_formR9', array(

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