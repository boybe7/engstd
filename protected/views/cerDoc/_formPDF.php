<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/engstd/protected/tcpdf/tcpdf.php');

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

	class MYPDF extends TCPDF {
			private $cer_no;
			private $contract_no;
			private $contractor;
			private $vendor;
			private $inspec_no;
			private $dept_order;
			private $prod_type;
			private $date_op;

			public function setHeaderInfo($cer_no, $contract_no,$contractor,$vendor,$inspec_no,$dept_order,$prod_type,$date_op) {
		        $this->cer_no = $cer_no;
		        $this->contract_no = $contract_no;
		        $this->contractor = $contractor;
		        $this->vendor = $vendor;
		        $this->inspec_no = $inspec_no;
		        $this->dept_order = $dept_order;
		        $this->prod_type = $prod_type;
		        $this->date_op = $date_op;
		        
		    }



			private $author1;
			private $author2;
			private $author3;
			private $pos_author2;
			private $pos_author3;

			public function setFooterInfo($author1, $author2,$author3,$pos_author2,$pos_author3){
				$this->author1 = $author1;
		        $this->author2 = $author2;
		        $this->author3 = $author3;
		        $this->pos_author2 = $pos_author2;
		        $this->pos_author3 = $pos_author3;
			}


		    //Page header
		    public function Header() {
		        
		        // Set font
		        $this->SetFont('thsarabun', '', 18);
		        $this->writeHTMLCell(145, 20, 40, 35, '<p style="font-weight:bold;">ใบรับรองท่อและอุปกรณ์ประปาเลขที่ '.$this->cer_no, 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(145, 20, 40, 43, '<p style="font-weight:bold;font-size:13">แนบท้ายหนังสือกมว.ที่..................</p>', 0, 1, false, true, 'C', false);
		        
		        $this->writeHTMLCell(145, 20, 47, 43, '<p style="font-weight:bold;font-size:13">'.$this->dept_order.'<br>'.$this->inspec_no.'</p>', 0, 1, false, true, 'R', false);
		        
		        $this->writeHTMLCell(145, 20, 15, 55, '<p style="font-size:13">สัญญา </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 40, 55, '<p style="font-size:13">'.$this->contract_no.'</p>', 0, 1, false, true, 'L', false);
		        
		        $this->writeHTMLCell(145, 20, 15, 60, '<p style="font-size:13">คู่สัญญา </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 40, 60, '<p style="font-size:13">'.$this->contractor.'</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 110, 60, '<p style="font-size:13">ผู้ผลิต/จัดส่ง</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 135, 60, '<p style="font-size:13">'.$this->vendor.'</p>', 0, 1, false, true, 'L', false);
		        		        		        

		        $this->writeHTMLCell(145, 20, 15, 65, '<p style="font-size:13">ท่อ/อุปกรณ์ </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 40, 65, '<p style="font-size:13">'.$this->prod_type.'</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 110, 65, '<p style="font-size:13">วันที่ดำเนินการ</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 135, 65, '<p style="font-size:13">'.$this->date_op.'</p>', 0, 1, false, true, 'L', false);
		        			        


		        // Title
		        //\\$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		    }

		    // Page footer
		    public function Footer() {
		        // Position at 15 mm from bottom
		        $this->SetY(-10);

		        $this->SetFont('thsarabun', '', 11);

		        $this->writeHTMLCell(50, 150, 15, 225,'.................................................................' , 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(50, 150, 15, 230,'<p style="font-size:15px;">('.$this->author1.')</p>' , 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(50, 150, 15, 235,'<p style="font-size:15px;">เจ้าหน้าที่ผู้ควบคุมการผลิต</p>' , 0, 1, false, true, 'C', false);

		        $this->writeHTMLCell(50, 150, 80, 225,'.................................................................' , 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(50, 150, 80, 230,'<p style="font-size:15px;">('.$this->author2.')</p>' , 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(50, 150, 80, 235,'<p style="font-size:15px;">'.$this->pos_author2.'</p>' , 0, 1, false, true, 'C', false);

		        $this->writeHTMLCell(50, 150, 145, 225,'.................................................................' , 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(50, 150, 145, 230,'<p style="font-size:15px;">('.$this->author3.')</p>' , 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(50, 150, 145, 235,'<p style="font-size:15px;">'.$this->pos_author2.'</p>' , 0, 1, false, true, 'C', false);

		        $this->writeHTMLCell(145, 550, 15, 250,'ข้อควรพึงปฏิบัติ' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 550, 33, 250,'1.ใบรับรองนี้ให้ถือเสมือนหนึ่งเป็นใบกำกับผลิตภัณฑ์ ให้ผู้ผลิตแนบไปพร้อมกับการส่งท่อ/อุปกรณ์ที่ได้ผ่านการตรวจสอบมาตรฐานจากกองมาตรฐานวิศวกรรม<br>  แล้วทุกครั้ง' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 550, 33, 260,'2.ท่อ/อุปกรณ์ใดที่ไม่มีใบรับรองฯ หรือมีรายละเอียดผิดไปจากใบรับรองฯ ซึ่งกำกับผลิตภัณฑ์มาด้วยนี้ จะไม่ได้รับการตรวจรับงานจากเจ้าหน้าที่ตรวจรับของ<br>  การประปานครหลวง' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 550, 33, 270,'3.ใบรับรองฯที่ส่งให้หน่วยงานของกปน. ให้หน่วยงานฯใช้ประกอบในการตรวจสอบ/ตรวจรับ ให้ถูกต้องตรงกับฉบับซึ่งมาพร้อมกับผลิตภัณฑ์จากผู้ผลิต<br>  และให้รวบรวมเก็บไว้เป็นหลักฐาน เพื่อตรวจสอบภายหลังได้' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 550, 33, 280,'4.ใบรับรองฯจะต้องไม่มีรอยขูดขีด แก้ ลบใดๆ หากมีการแก้ดังกล่าวต้องมีลายมือชื่อเจ้าหน้าที่ควบคุม กำกับทุกแห่ง ในส่วนที่เป็นอำนาจหน้าที่ของเจ้าหน้าที่นั้นๆ' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 550, 100, 285,'กองมาตรฐานวิศวกรรม<br>โทร 0-2504-0123 ต่อ 774,775' , 0, 1, false, true, 'C', false);
		       
		    }
		}

		// create new PDF document
		//$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		//set info header   
		$prod = ProdType::model()->findByPk($model->prod_id); 
		$inspec_no = "";
		$date_oper = renderDate($model->cer_oper_date);
		$pdf->setHeaderInfo($model->cer_no, $model->contract_no,$model->contractor,$model->vend_id,$inspec_no,$model->dept_id,$prod->prot_name,$date_oper);


		//set info footer   
		$pos_author2 = "หัวหน้าส่วนควบคุมการผลิตท่อและอุปกรณ์";
		$pos_author3 = "ผู้อำนวยการกองมาตรฐานวิศวกรรม";
		$pdf->setFooterInfo($model->cer_name, $model->cer_ct_name,$model->cer_di_name,$pos_author2,$pos_author3);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boybe');
		$pdf->SetTitle('TCPDF Example 001');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
		$pdf->setPrintHeader(true);
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(15, 80, 15);
		//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		
		//$pdf->AddPage();


		
		$details = Yii::app()->db->createCommand()
					->select('*')
					->from('c_cer_detail ct')	
					//->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
          			//->join('m_product p', 'p.prod_name=ct.detail')
					->where('ct.cer_id='.$model->cer_id)		
          			//->group('detail')			                   
					->queryAll();
		//print_r($model);
		$npages = ceil(count($details)/15.0);			
		$html = "";


		$pdf->SetFont('thsarabun', '', 13, '', true);
		$row = 1;
		for ($n=1; $n < $npages+1 ; $n++) { 
						# code...
					
					$html .= '<div style="text-indent: 12.7mm;">ท่อและอุปกรณ์ตามรายการต่อไปนี้ได้ผ่านการตรวจสอบจากเจ้าหน้าที่การประปานครหลวงแล้ว มีคุณภาพได้มาตรฐาน
			ตามที่ระบุไว้ในแบบ แปลนรายการละเอียดของสัญญา และได้ประทับตรารับรองคุณภาพให้ไว้เป็นที่เรียบร้อยแล้ว จึงอนุญาตให้นำส่งท่อและอุปกรณ์ประปาเหล่านี้ไปใช้งาน ของการประปานครหลวงได้</div>';

					$html .= '<br><table>';
				    $html .= '<thead>';
				    $html .= '  <tr style="line-height: 30px;backg" bgcolor="#f5f5f5">';
				    $html .= '    <th style="font-weight:bold;border:1px solid black;text-align:center;width:7%">ลำดับที่</th>';
				    $html .= '    <th style="font-weight:bold;border:1px solid black;text-align:center;width:40%">รายละเอียดท่อ/อุปกรณ์</th>';
				    $html .= '    <th style="font-weight:bold;border:1px solid black;text-align:center;width:20%">ขนาด '.TCPDF_FONTS::unichr(248).' มม.</th>';
				    $html .= '    <th style="font-weight:bold;border:1px solid black;text-align:center;width:20%">หมายเลข</th>';
				    $html .= '    <th style="font-weight:bold;border:1px solid black;text-align:center;width:13%">จำนวน</th>';
				    $html .= '  </tr>';
				    $html .= '</thead>';
				    $html .= '<tbody>';
				    
			        // foreach ($details as $key => $value) {
			        // 				 $html .= ' <tr>';
				       //               $html .= '<td style="text-align:center;border:1px solid black;width:7%"> '.($row++).'</td><td style="border:1px solid black;width:40%"> '.$value["detail"].'</td><td style="border:1px solid black;text-align:center;width:20%">'.$value["prod_size"].'</td><td style="border:1px solid black;text-align:center;width:20%">'.$value["serialno"].'</td><td style="border:1px solid black;text-align:center;width:13%">'.$value["quantity"].'</td>';
				       //               $html .= '</tr>';
			        // }
			        
			        for ($i=$row-1; $i < 15*$n  ; $i++) { 
			        			if(!empty($details[$i]))
			        			{	
			        	             $html .= ' <tr>';
				                     $html .= '<td style="text-align:center;border:1px solid black;width:7%"> '.($row++).'</td><td style="border:1px solid black;width:40%"> '.$details[$i]["detail"].'</td><td style="border:1px solid black;text-align:center;width:20%">'.$details[$i]["prod_size"].'</td><td style="border:1px solid black;text-align:center;width:20%">'.$details[$i]["serialno"].'</td><td style="border:1px solid black;text-align:center;width:13%">'.$details[$i]["quantity"].'</td>';
				                     $html .= '</tr>';
				                }
				                else
				                {     
			        				 $html .= ' <tr>';
				                     $html .= '<td style="border:1px solid black;width:7%"></td><td style="border:1px solid black;width:40%"></td><td style="border:1px solid black;text-align:center;width:20%"></td><td style="border:1px solid black;text-align:center;width:20%"></td><td style="border:1px solid black;text-align:center;width:13%"></td>';
				                     $html .= '</tr>';
				                }     
			        }
				                 
				     
				    $html .= '</tbody>';
				  	$html .= '</table>';
				  	if(empty($model->cer_notes))
				  	   $note = "จำนวน ".$npages." หน้า <br>"."จำนวนรวม ".count($details)." รายการ";
				  	else
				  	   $note = $model->cer_notes."<br>จำนวน ".$npages." หน้า <br>"."จำนวนรวม ".count($details)." รายการ"; 	
				  	$html .= '<br><br><table><tr><td width="10%"><u>หมายเหตุ</u>     </td><td>'.$note.'</td></tr></table>';
			        
			        if($n!=$npages)
			        {
			           $html .='<br pagebreak="true" />';	
			           $pdf->AddPage();
			        }

        }
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.$filename,'F');
        ob_end_clean() ;


       

?>
