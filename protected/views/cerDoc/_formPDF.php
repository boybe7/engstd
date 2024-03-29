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
			private $is_acting2;
			private $is_acting3;
			private $sign1;
			private $sign2;
			private $sign3;

			public function setFooterInfo($author1, $author2,$author3,$pos_author2,$pos_author3,$is_acting2,$is_acting3,$sign1,$sign2,$sign3){
				$this->author1 = $author1;
		        $this->author2 = $author2;
		        $this->author3 = $author3;
		        $this->pos_author2 = $pos_author2;
		        $this->pos_author3 = $pos_author3;
		        $this->is_acting2 = $is_acting2;
		        $this->is_acting3 = $is_acting3;
		        $this->sign1 = $sign1;
		        $this->sign2 = $sign2;
		        $this->sign3 = $sign3;


		  

			}


		    //Page header
		    public function Header() {
		        
		        // Set font
		        //$this->SetFont('thsarabun', '', 18);

		        $this->Image($_SERVER['DOCUMENT_ROOT'].'/'.Yii::app()->baseUrl.'/images/mwa_logo.png', 7, 11, 26, 26, 'PNG', '', '', true, 300, '', false, false, 0, false, false, false);
		        $this->SetFont('angsanaupc', '', 18);
		        $this->writeHTMLCell(180, 20, 40, 10, '<p style="font-weight:bold;font-size:18">กองมาตรฐานวิศวกรรม ฝ่ายมาตรฐานวิศวกรรมและสารสนเทศภูมิศาสตร์ การประปานครหลวง</p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(180, 20, 40, 18, '<p style="font-weight:bold;font-size:16">400 ถนนประชาชื่น แขวงทุ่งสองห้อง เขตหลักสี่ กรุงเทพฯ 10210</p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(180, 20, 40, 25, '<p style="font-weight:bold;font-size:16">ENGINEERING STANDARD DIVISION METROPOLITAN WATERWORK AUTHORITY</p>', 0, 1, false, true, 'L', false);

		        $this->writeHTMLCell(145, 20, 40, 41, '<p style="font-weight:bold;">ใบรับรองคุณภาพท่อและอุปกรณ์ประปาเลขที่ '.$this->cer_no, 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(145, 20, 40, 53, '<p style="font-weight:bold;font-size:12">แนบท้ายหนังสือกมว.ที่..................</p>', 0, 1, false, true, 'C', false);
		        
		        $this->writeHTMLCell(150, 20, 47, 53, '<p style="font-weight:bold;font-size:12">'.$this->dept_order.'</p>', 0, 1, false, true, 'R', false);
		        $this->writeHTMLCell(150, 20, 47, 60, '<p style="font-weight:bold;font-size:12">'.$this->inspec_no.'</p>', 0, 1, false, true, 'R', false);
				
		        $this->writeHTMLCell(145, 20, 15, 65, '<p style="font-weight:bold;font-size:12">สัญญา </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 30, 65, '<p style="font-weight:bold;font-size:12">'.$this->contract_no.'</p>', 0, 1, false, true, 'L', false);
		        
		        $this->writeHTMLCell(145, 20, 15, 70, '<p style="font-weight:bold;font-size:12">คู่สัญญา </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 30, 70, '<p style="font-weight:bold;font-size:12">'.$this->contractor.'</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 110, 70, '<p style="font-weight:bold;font-size:12">ผู้ผลิต/จัดส่ง</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 129, 70, '<p style="font-weight:bold;font-size:12">'.$this->vendor.'</p>', 0, 1, false, true, 'L', false);
		        		        		        

		        $this->writeHTMLCell(145, 20, 15, 75, '<p style="font-weight:bold;font-size:12">ท่อ/อุปกรณ์ </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 30, 75, '<p style="font-weight:bold;font-size:12">'.$this->prod_type.'</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 110, 75, '<p style="font-weight:bold;font-size:12">วันที่ดำเนินการ</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 129, 75, '<p style="font-weight:bold;font-size:12">'.$this->date_op.'</p>', 0, 1, false, true, 'L', false);
		        			        


		        // Title
		        //\\$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		    }

		    // Page footer
		    public function Footer() {
		        // Position at 15 mm from bottom
		        $this->SetY(-10);

		        //$this->SetFont('thsarabun', '', 11);
		        $this->SetFont('angsanaupc', '', 10);

		        $this->writeHTMLCell(50, 150, 12, 230,'.................................................................' , 0, 1, false, true, 'C', false);
		        if(!empty($this->sign1))
		        $this->Image($_SERVER['DOCUMENT_ROOT'].'/'.Yii::app()->baseUrl.'/images/'.$this->sign1, 25, 228,20,5, 'PNG', '', '', true, 300, '', false, false, 0, false, false, false);
		        $this->writeHTMLCell(50, 150, 12, 235,'<p style="font-weight:bold;font-size:14px;">('.$this->author1.')</p>' , 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(50, 150, 12, 240,'<p style="font-weight:bold;font-size:14px;">วิศวกรผู้ตรวจสอบ</p>' , 0, 1, false, true, 'C', false);

		        if($this->is_acting2==false)
		        {	
		        	$this->writeHTMLCell(50, 150, 80, 230,'.................................................................' , 0, 1, false, true, 'C', false);
		        	if(!empty($this->sign2))
		        	$this->Image($_SERVER['DOCUMENT_ROOT'].'/'.Yii::app()->baseUrl.'/images/'.$this->sign2, 80+10, 228,20,5, 'PNG', '', '', true, 300, '', false, false, 0, false, false, false);
		        	$this->writeHTMLCell(50, 150, 80, 235,'<p style="font-weight:bold;font-size:14px;">('.$this->author2.')</p>' , 0, 1, false, true, 'C', false);
		        	$this->writeHTMLCell(50, 150, 80, 240,'<p style="font-weight:bold;font-size:14px;">หัวหน้าส่วนควบคุมคุณภาพท่อและอุปกรณ์</p>' , 0, 1, false, true, 'C', false);
		        }
		        else
		        {
		        	$this->writeHTMLCell(50, 170, 80, 230,'.................................................................' , 0, 1, false, true, 'C', false);
		        	if(!empty($this->sign2))
		        	$this->Image($_SERVER['DOCUMENT_ROOT'].'/'.Yii::app()->baseUrl.'/images/'.$this->sign2, 80+10, 228,20,5, 'PNG', '', '', true, 300, '', false, false, 0, false, false, false);
		        	$this->writeHTMLCell(50, 170, 80, 235,'<p style="font-weight:bold;font-size:14px;">('.$this->author2.')</p>' , 0, 1, false, true, 'C', false);
		        	$this->writeHTMLCell(50, 170, 80, 240,'<p style="font-weight:bold;font-size:14px;">'.$this->pos_author2.'  รน.</p>' , 0, 1, false, true, 'C', false);
		        	$this->writeHTMLCell(50, 170, 80, 244,'<p style="font-weight:bold;font-size:14px;">หัวหน้าส่วนควบคุมคุณภาพท่อและอุปกรณ์' , 0, 1, false, true, 'C', false);
		        	
		        }

		        if($this->is_acting3==false)
		        {	
			        $this->writeHTMLCell(50, 150, 147, 230,'.................................................................' , 0, 1, false, true, 'C', false);
			        if(!empty($this->sign3))
			        $this->Image($_SERVER['DOCUMENT_ROOT'].'/'.Yii::app()->baseUrl.'/images/'.$this->sign3, 147+10, 228,20,5, 'PNG', '', '', true, 300, '', false, false, 0, 'CM', false, false);
			        $this->writeHTMLCell(50, 150, 147, 235,'<p style="font-weight:bold;font-size:14px;">('.$this->author3.')</p>' , 0, 1, false, true, 'C', false);
			        $this->writeHTMLCell(50, 150, 147, 240,'<p style="font-weight:bold;font-size:14px;"> ผู้อำนวยการกองมาตรฐานวิศวกรรม</p>' , 0, 1, false, true, 'C', false);
			    }
			    else
			    {
			    	$this->writeHTMLCell(50, 150, 147, 230,'.................................................................' , 0, 1, false, true, 'C', false);
			    	if(!empty($this->sign3))
			    	$this->Image($_SERVER['DOCUMENT_ROOT'].'/'.Yii::app()->baseUrl.'/images/'.$this->sign3, 147+10, 228,20,5, 'PNG', '', '', true, 300, 'C', false, false, 0, false, false, false);
			        $this->writeHTMLCell(50, 150, 147, 235,'<p style="font-weight:bold;font-size:14px;">('.$this->author3.')</p>' , 0, 1, false, true, 'C', false);
			        $this->writeHTMLCell(50, 150, 147, 240,'<p style="font-weight:bold;font-size:14px;">วิศวกร 7 รักษาการแทน</p>' , 0, 1, false, true, 'C', false);
			    	$this->writeHTMLCell(50, 150, 147, 244,'<p style="font-weight:bold;font-size:14px;">ผู้อำนวยการกองมาตรฐานวิศวกรรม' , 0, 1, false, true, 'C', false);
		        	
			    }
			        
		        $this->writeHTMLCell(145, 550, 10, 258,'<p style="font-weight:bold;">ข้อควรพึงปฏิบัติ</p>' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 750, 28, 258,'<p style="font-weight:bold;">1.ใบรับรองนี้ให้ถือเสมือนหนึ่งเป็นใบกำกับผลิตภัณฑ์ ให้ผู้ผลิตแนบไปพร้อมกับการส่งท่อ/อุปกรณ์ที่ได้ผ่านการตรวจสอบมาตรฐานจากกองมาตรฐานวิศวกรรมแล้วทุกครั้ง</p>' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 750, 28, 263,'<p style="font-weight:bold;">2.ท่อ/อุปกรณ์ใดที่ไม่มีใบรับรองฯ หรือมีรายละเอียดผิดไปจากใบรับรองฯ ซึ่งกำกับผลิตภัณฑ์มาด้วยนี้ จะไม่ได้รับการตรวจรับงานจากเจ้าหน้าที่ตรวจรับของการประปานครหลวง</p>' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 750, 28, 268,'<p style="font-weight:bold;">3.ใบรับรองฯที่ส่งให้หน่วยงานของกปน. ให้หน่วยงานฯใช้ประกอบในการตรวจสอบ/ตรวจรับ ให้ถูกต้องตรงกับฉบับซึ่งมาพร้อมกับผลิตภัณฑ์จากผู้ผลิตและให้รวบรวมเก็บไว้เป็น<br>  หลักฐานเพื่อตรวจสอบภายหลังได้</p>' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(170, 750, 28, 278,'<p style="font-weight:bold;">4.ใบรับรองฯจะต้องไม่มีรอยขูดขีด แก้ ลบใดๆ หากมีการแก้ดังกล่าวต้องมีลายมือชื่อเจ้าหน้าที่ควบคุม กำกับทุกแห่ง ในส่วนที่เป็นอำนาจหน้าที่ของเจ้าหน้าที่นั้นๆ</p>' , 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 550, 100, 283,'<p style="font-weight:bold;">กองมาตรฐานวิศวกรรม</p>' , 0, 1, false, true, 'C', false);


		        $this->writeHTMLCell(145, 550, 15, 293,'<p style="font-weight:bold;">กองมาตรฐานวิศวกรรม โทร 0 2504 0123 ต่อ 1773, 2701</p>' , 0, 1, false, true, 'L', false);
			    
		       
		    }
		}

		// create new PDF document
		//$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$width = 210;
		$height = 305 ;
		$pagelayout = array($width, $height); //  or array($height, $width) 
        //new TCPDF('p', 'pt', $pageLayout, true, 'UTF-8', false);
		//$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new MYPDF('P', PDF_UNIT, $pagelayout, true, 'UTF-8', false);	


		//set info header   
		//$prod = ProdType::model()->findByPk($model->prod_id); 
		/*$m = Yii::app()->db->createCommand()
					->select('prot_name')
					->from('m_prodtype')	
					->where('prot_id="'.$model->prod_id.'"')					                   
					->queryAll();*/
					
		$inspec_no = $model->running_no;
		$date_oper = renderDate($model->cer_oper_date);
		$pdf->setHeaderInfo($model->cer_no, $model->contract_no,$model->contractor,$model->vend_id,$inspec_no,$model->dept_id,$model->prod_id,$date_oper);


		//set info footer   
		//$pos_author2 = "หัวหน้าส่วนควบคุมคุณภาพท่อและอุปกรณ์";
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
		//$pdf->setFooterInfo($model->cer_name, $name2,$name3,$pos_author2,$pos_author3,$is_acting2,$is_acting3);

		      $author = Yii::app()->db->createCommand()
					->select('signature')
					->from('user')
					->where('name="'.$model->cer_name.'"')	                   
					->queryAll();
				$sign1 = ($model->approve_status>=1) ?  $author[0]['signature'] : "";	

				$author = Yii::app()->db->createCommand()
					->select('signature')
					->from('user')
					->where('name="'.$name2.'"')	                   
					->queryAll();
				
				$sign2 = ($model->approve_status==2 || $model->approve_status==4) ?  $author[0]['signature'] : "";	

				$author = Yii::app()->db->createCommand()
					->select('signature')
					->from('user')
					->where('name="'.$name3.'"')	                   
					->queryAll();
				$sign3 =  ($model->approve_status==4) ?  $author[0]['signature'] : "";		
		$pdf->setFooterInfo($model->cer_name, $name2,$name3,$pos_author2,$pos_author3,$is_acting2,$is_acting3,$sign1,$sign2,$sign3);

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
		$pdf->SetMargins(10, 80, 8);
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


		 $pdf->AddPage();



		$html = "";


		//$pdf->SetFont('thsarabun', '', 13, '', true);
		$pdf->SetFont('angsanaupc', '', 12, '', true);
		$row = 1;
		for ($n=1; $n < $npages+1 ; $n++) { 
						# code...
					// $pdf->AddPage();
			
					$html .= '<br><div style="font-weight:bold;text-indent: 10.7mm;">ท่อและอุปกรณ์ตามรายการต่อไปนี้ได้ผ่านการตรวจสอบจากเจ้าหน้าที่การประปานครหลวงแล้ว มีคุณภาพได้มาตรฐาน
			ตามที่ระบุไว้ในแบบแปลนรายการ ละเอียดของสัญญา และได้ประทับตรารับรองคุณภาพให้ไว้เป็นที่เรียบร้อยแล้ว จึงอนุญาตให้นำส่งท่อและอุปกรณ์ประปาเหล่านี้ไปใช้งานของการประปานครหลวงได้</div>';

					$html .= '<br><table>';
				    $html .= '<thead>';
				    $html .= '  <tr style="line-height: 30px;backg" bgcolor="#BEC3C4">';
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
			        	             $html .= ' <tr style="font-weight:bold;">';
				                     $html .= '<td style="text-align:center;border:1px solid black;width:7%"> '.($row++).'</td><td style="border:1px solid black;width:40%"> '.$details[$i]["detail"].'</td><td style="border:1px solid black;text-align:center;width:20%"> '.$details[$i]["prod_size"].'</td><td style="border:1px solid black;text-align:center;width:20%">'.$details[$i]["serialno"].'</td><td style="border:1px solid black;text-align:center;width:13%">'.$details[$i]["quantity"].' '.$details[$i]["unit"].'</td>';
				                     $html .= '</tr>';
				                }
				                else
				                {     
			        				 $html .= ' <tr style="font-weight:bold;">';
				                     $html .= '<td style="border:1px solid black;width:7%"></td><td style="border:1px solid black;width:40%"></td><td style="border:1px solid black;text-align:center;width:20%"></td><td style="border:1px solid black;text-align:center;width:20%"></td><td style="border:1px solid black;text-align:center;width:13%"></td>';
				                     $html .= '</tr>';
				                }     
			        }
				                 
				     
				    $html .= '</tbody>';
				  	$html .= '</table>';
				  	if(empty($model->cer_notes))
				  	   $note = "รวม ".count($details)." รายการ".", จำนวน ".$npages." หน้า";
				  	else
				  	   $note = "รวม ".count($details)." รายการ, จำนวน ".$npages." หน้า <br>".$model->cer_notes; 	
				  	$html .= '<br><br><table width="100%"><tr style="font-weight:bold;"><td width="10%"><u>หมายเหตุ</u>     </td><td width="90%">'.$note.'</td></tr></table>';
			        
			        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			        //$pdf->AddPage();
					//$pdf->setPage($pdf->getPage());  

			        if($n!=$npages)
			        {
			           
			           $html .='<br pagebreak="true" />';	
			           //if($n!=1 )
			           //$pdf->AddPage();
			        }

        }
        
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


		//--------watermark--------------------//
		if($model->cer_status==3)
		{
				$width = $pdf->GetStringWidth(trim("ยกเลิก"), "angsanaupc", "B", 90, false );
				$factor = round(($width * sin(deg2rad(45))) / 2 ,0);
				// Get the page width/height
				$myPageWidth = $pdf->getPageWidth();
				$myPageHeight = $pdf->getPageHeight();
				// Find the middle of the page and adjust.
				$myX = ( $myPageWidth / 2 ) - $factor;
				$myY = ( $myPageHeight / 2 ) + $factor;
				// Set the transparency of the text to really light
				$pdf->SetAlpha(0.09);
				// Rotate 45 degrees and write the watermarking text
				$pdf->StartTransform();
				$pdf->Rotate(45, $myX-20, $myY);
				$pdf->SetFont("angsanaupc", "B", 90);
				$pdf->Text($myX, $myY ,trim("ยกเลิก"));
				$pdf->StopTransform();
				// Reset the transparency to default
				$pdf->SetAlpha(1); 
		}

		//---------end--------------------------//

        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.$filename,'F');
        ob_end_clean() ;


       

?>
