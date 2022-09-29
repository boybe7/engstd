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
				'actions'=>array('index','view','script','waitApprove'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('DeleteSelected','ReCheck','GenCerNo','InspecGetCerNo','GenCerNo2','close','cancel','genPDF','genPDF2','print','getCerNO','preview','preview2','previewExcel','previewExcelTest','uploadFile','updateFile','deleteFile','uploadFileTemp','updateFileTemp','deleteFileTemp','approve','approveSelected'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','DeleteSelected','ReCheck','GenCerNo','InspecGetCerNo','GenCerNo2','close','cancel','genPDF','genPDF2','print','getCerNO','preview','preview2','previewExcel','previewExcelTest'),
				'expression'=>'!Yii::app()->user->isGuest()',
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

	public function actionUploadFileTemp()
	{
		$model=new AttachFileTemp;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AttachFileTemp']))
		{
			$model->attributes=$_POST['AttachFileTemp'];
			$model->user_id = Yii::app()->user->ID;

			$model->cer_id = 0;
			
	
				$uploadFile = CUploadedFile::getInstance($model, 'filename');
				$filesave = '';
				//header('Content-type: text/plain');
				if($uploadFile !== null) {

									$model->name = CUploadedFile::getInstance($model, 'filename');
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
		else
			$this->renderPartial('_formUpload', array('model'=>$model), false, true);
	
	}

	function renderDate($value)
	{
	    $th_month = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	    $dates = explode("/", $value);
	    $d=0;
	    $mi = 0;
	    $yi = 0;
	    foreach ($dates as $key => $value) {
	         $d++;
	         if($d==2)
	            $mi = $value;
	         if($d==3)
	            $yi = $value;
	    }
	    if(substr($mi, 0,1)==0)
	        $mi = substr($mi, 1);
	    if(substr($dates[0], 0,1)==0)
	        $d = substr($dates[0], 1);
	    else
	    	$d = $dates[0];

	    $renderDate = $d." ".$th_month[$mi]." ".$yi;
	    if($renderDate==0)
	        $renderDate = "";   

	    return $renderDate;             
	}

	public function actionScript()
	{
		$details = Yii::app()->db->createCommand()
					->select('*')
					->from('c_cer_detail ct')	
					//->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
          			->join('m_product p', 'p.prod_id=ct.prod_id')
					//->where('ct.cer_id='.$model->cer_id)		
          			//->group('detail')			                   
					->queryAll();
		//print_r($details);

		foreach ($details as $key => $value) {
			$model = CerDetail::model()->findByPk($value["detail_id"]);
			$model->unit = $value["prod_unit"];
			$model->save();
		}
	}

	public function actionPreviewExcel($id)
    {
			

    	

	
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR."cerdoc_template.xls");

        $header = new PHPExcel_Style();
		$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'AngsanaUPC', 
			            'size'  => 30,   
			            'bold'  => true,           
			            'color' => array(
			            	'rgb'   => '000000'
			            	)
			       		)
			    	)  
			  ); 

		$subheader = new PHPExcel_Style();
		$subheader->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'AngsanaUPC', 
			            'size'  => 17,   
			            'bold'  => false,           
			            'color' => array(
			            	'rgb'   => '000000'
			            	)
			       		)
			    	)  
			  ); 


		$normal = new PHPExcel_Style();
	    $normal->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'AngsanaUPC', 
			            'size'  => 18,   
			             'bold'  => false,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            
			    ));

		$border = array(
		    'borders' => array(
		        'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);


		

	    




		$model = $this->loadModel($id);		 

		$sheet = 0;   

		$details = Yii::app()->db->createCommand()
					->select('*')
					->from('c_cer_detail ct')	
					//->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
          			//->join('m_product p', 'p.prod_id=ct.prod_id')
					->where('ct.cer_id='.$model->cer_id)		
          			//->group('detail')			                   
					->queryAll();
		//print_r($details);
		$npages = ceil(count($details)/15.0);	
		$step = 46;
		for ($ipage=0; $ipage < $npages; $ipage++) { 
		
					$row = 2 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue("B".$row, 'ใบรับรองคุณภาพท่อและอุปกรณ์ประปาเลขที่ '.$model->cer_no);
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($header, "B".$row);
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle("B".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					//$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B4', 'แนบท้ายหนังสือกมว.ที่..................');
					//$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($subheader, 'B4');
					//$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$row = 4 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.$row, $model->dept_id);
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($subheader, 'H'.$row);
				
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.($row+1), $model->running_no);
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($subheader, 'H'.($row+1));

					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('H'.$row.':H'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

					$row = 7 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $model->contract_no);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.($row+1), $model->contractor);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.($row+2), $model->prod_id);

					
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'C'.$row.':C'.($row+2));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('C'.$row.':C'.($row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, $model->vend_id);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.($row+1),$this->renderDate($model->cer_oper_date));

					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'F'.$row.':F'.($row+1));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('F'.$row.':F'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


					$row = 15 + ($step*$ipage);
					$irow = $row;

					$nstop = $npages == $ipage+1 ? count($details) : 15*($ipage+1);
					$nstart = 15*$ipage; 

					for ($i=$nstart; $i < $nstop; $i++) { 
							$no = ($i+1) ;
							
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$irow, $no);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$irow, $details[$i]["detail"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$irow, $details[$i]["prod_size"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.$irow, $details[$i]["serialno"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.$irow, $details[$i]["quantity"].' '.$details[$i]["unit"]);
							$irow++;
					}	
					$irow--;
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'B'.$row.':H'.($irow));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B'.$row.':B'.$irow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('E'.$row.':H'.$irow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$row.':H'.$irow)->applyFromArray($border);

					$row = 31 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, "รวม ".count($details)." รายการ".", จำนวน ".$npages." หน้า");
					

					$r = 0;
					if(!empty($model->cer_notes))
					{
						$r = $row;
						$r++;
						$n = explode("<br />", $model->cer_notes);
						foreach ($n as $key => $value) {
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$r, $value);
							$r++;
					    }	

					}	
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'C'.$row.':C'.$r);
					

					$is_acting2 = strpos($model->cer_ct_name, "รักษาการแทน");
					$name2 = str_replace("(รักษาการแทน)", "", $model->cer_ct_name);
					$author = Yii::app()->db->createCommand()
								->select('posi_name')
								->from('user')
								->join('m_position p', 'user.position=p.id')
								->where('name="'.$name2.'"')	                   
								->queryAll();
					$pos_author2 = $author[0]['posi_name'];		

					$is_acting3 = strpos($model->cer_di_name, "รักษาการแทน");	
					$name3 = str_replace("(รักษาการแทน)", "", $model->cer_di_name);
					$author = Yii::app()->db->createCommand()
								->select('posi_name')
								->from('user')
								->join('m_position p', 'user.position=p.id')
								->where('name="'.$name3.'"')	                   
								->queryAll();
					//$pos_author3 = "ผู้อำนวยการกองมาตรฐานวิศวกรรม";
					$pos_author3 = $author[0]['posi_name'];



					$row = 38 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, "(".$model->cer_name.")");
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.($row+1), "วิศวกรผู้ตรวจสอบ");

					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, "(".$name2.")");
					if($is_acting2==false)
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.($row+1), " หัวหน้าส่วนควบคุมคุณภาพท่อและอุปกรณ์");
					else
					{
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.($row+1), $pos_author2. " รน. หัวหน้าส่วนควบคุมคุณภาพท่อและอุปกรณ์");
						
					}

					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.$row, "(".$name3.")");
					if($is_acting3==false)
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.($row+1), " ผู้อำนวยการกองมาตรฐานวิศวกรรม");
					else
					{
						$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.($row+1), $pos_author3. " รน. ผู้อำนวยการกองมาตรฐานวิศวกรรม");
						
					}

					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'B'.$row.':H'.($row+1));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B'.$row.':H'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					//$objPHPExcel->getActiveSheet()->getStyle('D'.($row+1))->getAlignment()->setWrapText(true);
					

		}	

		$objPHPExcel->getActiveSheet()
				    ->getPageSetup()
				    ->setPrintArea('A1:I'.($step*$npages));	
		
/*

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
		
		}	*/

		$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		$objPHPExcel->getActiveSheet()->getProtection()->setPassword("boybe7@MWA");		

		$filename = str_replace(".", "", $model->cer_no);
		$filename = str_replace("/", "_", $filename);


				ob_end_clean();
				ob_start();

				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
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

    public function actionPreviewExcelTest($id)
    {
			

    	

	
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR."cerdoc_template.xls");

        $header = new PHPExcel_Style();
		$header->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'AngsanaUPC', 
			            'size'  => 30,   
			            'bold'  => true,           
			            'color' => array(
			            	'rgb'   => '000000'
			            	)
			       		)
			    	)  
			  ); 

		$subheader = new PHPExcel_Style();
		$subheader->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'AngsanaUPC', 
			            'size'  => 17,   
			            'bold'  => false,           
			            'color' => array(
			            	'rgb'   => '000000'
			            	)
			       		)
			    	)  
			  ); 


		$normal = new PHPExcel_Style();
	    $normal->applyFromArray(
			        array(
			            'font'  => array(
			            'name'  => 'AngsanaUPC', 
			            'size'  => 18,   
			             'bold'  => false,              
			            'color' => array(
			            'rgb'   => '000000'
			            )
			        ),
			            
			    ));

		$border = array(
		    'borders' => array(
		        'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN,
		            'color' => array('argb' => '000000'),
		        ),
		    ),
		);


		

	    




		$model = $this->loadModel($id);		 

		$sheet = 0;   

		$details = Yii::app()->db->createCommand()
					->select('*')
					->from('c_cer_detail ct')	
					//->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
          			->join('m_product p', 'p.prod_id=ct.prod_id')
					->where('ct.cer_id='.$model->cer_id)		
          			//->group('detail')			                   
					->queryAll();
		//print_r($details);
		$npages = ceil(count($details)/15.0);	
		$step = 46;
		for ($ipage=0; $ipage < $npages; $ipage++) { 
		
					$row = 2 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue("B".$row, 'ใบรับรองคุณภาพท่อและอุปกรณ์ประปาเลขที่ '.$model->cer_no);
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($header, "B".$row);
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle("B".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					//$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B4', 'แนบท้ายหนังสือกมว.ที่..................');
					//$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($subheader, 'B4');
					//$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$row = 4 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.$row, $model->dept_id);
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($subheader, 'H'.$row);
				
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.($row+1), $model->running_no);
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($subheader, 'H'.($row+1));

					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('H'.$row.':H'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

					$row = 7 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, $model->contract_no);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.($row+1), $model->contractor);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.($row+2), $model->prod_id);

					
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'C'.$row.':C'.($row+2));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('C'.$row.':C'.($row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.$row, $model->vend_id);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('F'.($row+1),$this->renderDate($model->cer_oper_date));

					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'F'.$row.':F'.($row+1));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('F'.$row.':F'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


					$row = 15 + ($step*$ipage);
					$irow = $row;

					$nstop = $npages == $ipage+1 ? count($details) : 15*($ipage+1);
					$nstart = 15*$ipage; 

					echo $nstop."---<br>";

					for ($i=$nstart; $i < $nstop; $i++) { 
							$no = ($i+1) ;
							echo $irow."<br>";
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$irow, $no);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$irow, $details[$i]["detail"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('E'.$irow, $details[$i]["prod_sizename"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.$irow, $details[$i]["serialno"]);
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('H'.$irow, $details[$i]["quantity"].' '.$details[$i]["prod_unit"]);
							$irow++;
					}	
					$irow--;
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'B'.$row.':H'.($irow));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B'.$row.':B'.$irow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('E'.$row.':H'.$irow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.$row.':H'.$irow)->applyFromArray($border);

					$row = 31 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$row, "รวม ".count($details)." รายการ".", จำนวน ".$npages." หน้า");
					

					$r = 0;
					if(!empty($model->cer_notes))
					{
						$r = $row;
						$r++;
						$n = explode("<br />", $model->cer_notes);
						foreach ($n as $key => $value) {
							$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('C'.$r, $value);
							$r++;
					    }	

					}	
					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'C'.$row.':C'.$r);
					

					$is_acting2 = strpos($model->cer_ct_name, "รักษาการแทน");
					$name2 = str_replace("(รักษาการแทน)", "", $model->cer_ct_name);
					$author = Yii::app()->db->createCommand()
								->select('posi_name')
								->from('user')
								->join('m_position p', 'user.position=p.id')
								->where('name="'.$name2.'"')	                   
								->queryAll();
					$pos_author2 = $author[0]['posi_name'];		

					$is_acting3 = strpos($model->cer_di_name, "รักษาการแทน");	
					$name3 = str_replace("(รักษาการแทน)", "", $model->cer_di_name);
					$author = Yii::app()->db->createCommand()
								->select('posi_name')
								->from('user')
								->join('m_position p', 'user.position=p.id')
								->where('name="'.$name3.'"')	                   
								->queryAll();
					//$pos_author3 = "ผู้อำนวยการกองมาตรฐานวิศวกรรม";
					$pos_author3 = $author[0]['posi_name'];



					$row = 38 + ($step*$ipage);
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.$row, "(".$model->cer_name.")");
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('B'.($row+1), "วิศวกรผู้ตรวจสอบ");

					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.$row, "(".$name2.")");
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('D'.($row+1), $pos_author2);

					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.$row, "(".$name3.")");
					$objPHPExcel->setActiveSheetIndex($sheet)->setCellValue('G'.($row+1), $pos_author3);

					$objPHPExcel->setActiveSheetIndex($sheet)->setSharedStyle($normal, 'B'.$row.':H'.($row+1));
					$objPHPExcel->setActiveSheetIndex($sheet)->getStyle('B'.$row.':H'.($row+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					

		}	



	
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

	public function actionPreview2($id){


		$this->render('preview2',array('id'=>$id,'model'=>$this->loadModel($id)));


	}

	public function actionGenPDF(){

		$id = $_GET["id"]; 
		//$filename='preview_'.date('m-d-Y_hia').'.pdf';
		$filename = Yii::app()->user->username.".pdf";
		$this->renderPartial('_formPDF',array('model'=>$this->loadModel($id),'filename'=>$filename));

		echo json_encode($filename);

	}

	public function actionGenPDF2(){

		$id = $_GET["id"]; 
		//$filename='preview_'.date('m-d-Y_hia').'.pdf';
		$filename = Yii::app()->user->username.".pdf";
		$this->renderPartial('_formPDF_test',array('model'=>$this->loadModel($id),'filename'=>$filename));

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
          $begin= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

	      $end = $_REQUEST['CerDoc']['cer_date_end'];
	      $date_end = $_REQUEST['CerDoc']['cer_date_end'];
	      $str_date = explode("/", $end);
          $end= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

	      $criteria->addBetweenCondition('cer_date', $begin, $end, 'OR');
	    }
	    else if(!empty($_REQUEST['CerDoc']['cer_date_begin'])){
	      $begin = $_REQUEST['CerDoc']['cer_date_begin'];
	      $date_begin = $_REQUEST['CerDoc']['cer_date_begin']; 
	      $str_date = explode("/", $begin);
          $begin= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

          $criteria->compare('cer_date',$begin,true);
	    }
	    else if(!empty($_REQUEST['CerDoc']['cer_date_end'])){
	      $begin = $_REQUEST['CerDoc']['cer_date_end'];
	      $date_end = $_REQUEST['CerDoc']['cer_date_end'];
	      $str_date = explode("/", $begin);
          $begin= ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

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
           
            $fiscalyear = 	date("Y")+543;//date("n")<10 ? date("Y")+543 : date("Y")+544;

       
            $v = Yii::app()->db->createCommand()
					->select('shortname')
					->from('vendor')	
					->where('name="'.$id.'"')					                   
					->queryAll();		


			$m = Yii::app()->db->createCommand()
					->select('max(strSplit(cer_no,"/", 1)) as max')
					->from('c_cer_doc')	
					->where('strSplit(strSplit(cer_no,".", 2),"/",2)='.$fiscalyear.' AND strSplit(cer_no,".", 1)="'.$v[0]['shortname'].'" ')					                   
					->queryAll();
		

			//header('Content-type: text/plain charset=utf-8');		
			//echo 'strSplit(strSplit(cer_no,".", 2),"/",2)='.$fiscalyear.' AND vend_id="'.$id.'" and cer_id!='.$cid;		
			//exit;

			


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
            $fiscalyear = date("Y")+543;//date("n")<10 ? date("Y")+543 : date("Y")+544;

              $v = Yii::app()->db->createCommand()
					->select('shortname')
					->from('vendor')	
					->where('name="'.$id.'"')					                   
					->queryAll();		


			$m = Yii::app()->db->createCommand()
					->select('max(strSplit(cer_no,"/", 1)) as max')
					->from('c_cer_doc')	
					->where('strSplit(strSplit(cer_no,".", 2),"/",2)='.$fiscalyear.' AND strSplit(cer_no,".", 1)="'.$v[0]['shortname'].'"')					                   
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

    public function actionApproveSelected()
    {
    	$autoIdAll = $_POST['selectedID'];
        if(count($autoIdAll)>0)
        {
            foreach($autoIdAll as $autoId)
            {
             
                $model = $this->loadModel($autoId);
                if(Yii::app()->user->getLevel()==1)
                	$model->approve_status = 2;
                if(Yii::app()->user->getLevel()==2)
                	$model->approve_status = 4;
                $model->save();
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
                        'label'=>$model['cer_no'],
                        'cid'=>$model['cer_id']

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
		if(!empty($m_last))
		{
			$model->cer_ct_name = $m_last[0]->cer_ct_name;
			$model->cer_di_name = $m_last[0]->cer_di_name;
        }
		//auto gen running_no
		 $fiscalyear = date("Y")+543;//date("n")<10 ? date("Y")+543 : date("Y")+544;
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


            $type = explode('-',$_POST['CerDoc']['prod_id']);
            if(!empty($type[1]))
            	$model->prod_id = $type[1]; 

            $model->cer_oper_dept = Yii::app()->user->getUserDept();

            //check cer_no match vendor
            $mVendor = Yii::app()->db->createCommand()
						                    ->select('shortname')
						                    ->from('vendor')
						                    ->where('name=:name', array(':name'=>$model->vend_id))
						                    ->queryAll();
			$checkCer = true;
			if($model->supp_id=='' && !empty($mVendor))
			{
				$cer_no = explode(".", $model->cer_no);
				if($mVendor[0]['shortname']!=$cer_no[0])
				{
					$checkCer = false;
					$model->addError('cer_no','เลขที่ใบรับรองไม่สอดคล้องกับรหัสผู้ผลิต');
				}
			}			                    


			if($checkCer && $model->save())
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
					 $modelDetail->unit = $mTemp['unit'];
                     $modelDetail->cer_id = $model->cer_id;
                    
                     $modelDetail->save();
      //                header('Content-type: text/plain');
      //                   print_r($mTemp);
					 // 	print_r($modelDetail);                    
					 // exit;

				}

				Yii::app()->db->createCommand('DELETE FROM c_cer_detail_temp WHERE user_id='.Yii::app()->user->ID)->execute();

				
				$this->redirect(array('CerDoc/preview/'.$model->cer_id));
				//$this->redirect(array('index'));
			}	


		}
		else{
			if (!Yii::app()->request->isAjaxRequest)
			{	
			   //header('Content-type: text/plain');
			   //print_r(Yii::app()->user->ID);
			   //exit;
			   Yii::app()->db->createCommand('DELETE FROM c_cer_detail_temp WHERE user_id='.Yii::app()->user->ID)->execute();
			}
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
		if(empty($model->cer_date))
		  $model->cer_date = date("d")."/".date("m")."/".(date("Y")+543);//"11/07/2526";
		if(empty($model->cer_date_add))
			 $model->cer_date_add = $model->cer_date;

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
            $model->approve_status = $_POST['CerDoc']['approve_status'];
            //$model->cer_date =  date("d")."/".date("m")."/".(date("Y")+543);
            $model->cer_oper_dept = Yii::app()->user->getUserDept();

             

            $type = explode('-',$_POST['CerDoc']['prod_id']);
            if(!empty($type[1]))
            	$model->prod_id = $type[1]; 

            $model->save();
			//if($model->save())
			//     $this->redirect(array('CerDoc/preview/'.$id));
		

			//	$this->redirect(array('index'));
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

	public function actionWaitApprove()
	{
		$model=new CerDoc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CerDoc']))
			$model->attributes=$_GET['CerDoc'];


		if(Yii::app()->user->name!="guest")
			$this->render('approve',array(
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

	public function actionApprove()
	{
		
		if(isset($_POST['id']))
		{
			$model=$this->loadModel($_POST['id']);
			$model->approve_status = $_POST['status'];
			$model->approve_comment = $_POST['comment'];
			$model->save();

			//print_r($model);
		}
	}
}
