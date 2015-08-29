<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/engstd/protected/tcpdf/tcpdf.php');

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


		    //Page header
		    public function Header() {
		        
		        // Set font
		        $this->SetFont('thsarabun', 'B', 18);
		        $this->writeHTMLCell(145, 20, 40, 10, 'ใบรับรองท่อและอุปกรณ์ประปาเลขที่ '.$this->cer_no, 0, 1, false, true, 'C', false);
		        $this->writeHTMLCell(145, 20, 40, 18, '<p style="font-size:14">แนบท้ายหนังสือกมว.ที่..................</p>', 0, 1, false, true, 'C', false);
		        
		        $this->writeHTMLCell(145, 20, 47, 18, '<p style="font-size:14">'.$this->dept_order.'<br>'.$this->inspec_no.'</p>', 0, 1, false, true, 'R', false);
		        
		        $this->writeHTMLCell(145, 20, 20, 25, '<p style="font-size:14">สัญญา </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 40, 25, '<p style="font-size:14">'.$this->contract_no.'</p>', 0, 1, false, true, 'L', false);
		        
		        $this->writeHTMLCell(145, 20, 20, 30, '<p style="font-size:14">คู่สัญญา </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 40, 30, '<p style="font-size:14">'.$this->contractor.'</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 110, 30, '<p style="font-size:14">ผู้ผลิต/จัดส่ง</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 135, 30, '<p style="font-size:14">'.$this->vendor.'</p>', 0, 1, false, true, 'L', false);
		        		        		        

		        $this->writeHTMLCell(145, 20, 20, 35, '<p style="font-size:14">ท่อ/อุปกรณ์ </p>', 0, 1, false, true, 'L', false);
		        $this->writeHTMLCell(145, 20, 40, 35, '<p style="font-size:14">'.$this->prod_type.'</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 110, 35, '<p style="font-size:14">วันที่ดำเนินการ</p>', 0, 1, false, true, 'L', false);
				$this->writeHTMLCell(145, 20, 135, 35, '<p style="font-size:14">'.$this->date_op.'</p>', 0, 1, false, true, 'L', false);
		        			        


		        // Title
		        //\\$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		    }

		    // Page footer
		    public function Footer() {
		        // Position at 15 mm from bottom
		        $this->SetY(-10);
		        // Set font
		        $this->SetFont('thsarabun', '', 20);
		        // Page number
		        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		        // Logo
		        //$image_file = 'bank/image/mwa2.jpg';
		        //$this->Image($image_file, 170, 270, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        //$this->Cell(0, 5, date("d/m/Y"), 0, false, 'R', 0, '', 0, false, 'T', 'M');

		        $this->writeHTMLCell(145, 550, 40, 287, '-'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'-', 0, 1, false, true, 'C', false);
		        //writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
		    }
		}

		// create new PDF document
		//$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		//set info header   
		$prod = ProdType::model()->findByPk($model->prod_id); 
		$inspec_no = "";
		$pdf->setHeaderInfo($model->cer_no, $model->contract_no,$model->contractor,$model->vend_id,$inspec_no,$model->dept_id,$prod->prot_name,$model->cer_oper_date);





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
		$pdf->SetMargins(PDF_MARGIN_LEFT, 10, 10);
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
		
		$pdf->AddPage();


		$model = CerDoc::model()->findByPK($_GET['id']);
		print_r($model);
		$html = "";
		$pdf->SetFont('thsarabun', '', 12, '', true);
		$html .= '<table>';
		   $html .= '<thead>';
		      $html .= '<tr>';
		   		$html .= '<th>ลำดับที่</th>';
		   		$html .= '<th>รายละเอียดท่อและอุปกรณ์</th>';
		   		$html .= '<th>ขนาด &#8709 มม.</th>';
		   		$html .= '<th>หมายเลข</th>';
		   		$html .= '<th>จำนวน</th>';
		   		
		   	  $html .= '</tr>';	
		   $html .= '</thead>';
		$html .= '</table>';
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.$filename,'F');
        ob_end_clean() ;


       

?>
