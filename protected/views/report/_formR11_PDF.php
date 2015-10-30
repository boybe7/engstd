<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/engstd/protected/tcpdf/tcpdf.php');

	class MYPDF extends TCPDF {

		    //Page header
		    private $date_start;
		    private $date_end;


//		    public function setDate($start, $end) {
//		        $this->date_start = $start;
//		        $this->date_end = $end;
//		    }

		    public function Header() {
		        
		        // Set font
		        $this->SetFont('thsarabun', 'B', 20);
		        // Title
		        //$this->Cell(0, 5, 'รายงานสรุปยอดรับรองท่อ/อุปกรณ์', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		        $this->writeHTMLCell(145, 20, 40, 10, 'การประปานครหลวง<br>ภาคผนวกหมายเลข&nbsp;6', 0, 1, false, true, 'C', false);
		        $image_file = $_SERVER['DOCUMENT_ROOT'].'/engstd/images/mwa_logo.png';
		        $this->Image($image_file, 180, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		    }   

		    // Page footer
		    public function Footer() {
		        // Position at 15 mm from bottom
		        $this->SetY(-10);
		        // Set font
		        $this->SetFont('thsarabun', '', 11);
		        // Page number
		        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		        // Logo
		        //$image_file = 'bank/image/mwa2.jpg';
		        //$this->Image($image_file, 170, 270, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		        $this->Cell(0, 5, date("d/m/Y"), 0, false, 'R', 0, '', 0, false, 'T', 'M');

		        $this->writeHTMLCell(145, 550, 40, 287, '-'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'-', 0, 1, false, true, 'C', false);
		        //writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
		    }
		}

                            $date_m = $date_end."-".$date_start;
                            $models = Yii::app()->db->createCommand()
					->select('sum(ct.quantity) as sum,cd.vend_id, detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name')
					->from('c_cer_doc cd')
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                        ->join('m_product p', 'p.prod_name=ct.detail')
                                        ->join('m_prodtype t', 't.prot_id=p.prot_id')
					//->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                                        ->where('cer_date LIKE "'.$date_m.'%"')
                                        ->group('vend_id')
					->queryAll();

		//$pdf->setDate($date_start,$date_end);
                $pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
		$pdf->SetMargins(PDF_MARGIN_LEFT, 40, 10);
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


		
		$html = "";
		$pdf->SetFont('thsarabun', '', 12, '', true);
		
	    //$html .= 'สรุปผลงานตั้งแต่วันที่&nbsp;'.$date_st.'&nbsp;ถึงวันที่&nbsp;'.$date_en.'<br>';
            //$html .= 'รายละเอียดท่อและอุปกรณ์ประปาที่ผ่านการตรวจสอบควบคุมคุณภาพ&nbsp;ดังนี้<br><br>';

            $m="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	    $html .= '<table>';
	    $html .= '<thead>';
	    $html .= '  <tr style="line-height: 40px;backg" bgcolor="#f5f5f5">';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:20%">ผู้ผลิต</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:50%">ผลิตภัณฑ์</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:15%">จำนวน</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:15%">หน่วย</th>';
	    $html .= '  </tr>';
	    $html .= '</thead>';
	    $html .= '<tbody>';

            
	                  foreach ($models as $key => $model) {
                                   $html .= '<tr>';
                                        $html .= '<td style="border:1px solid black;width:100%">&nbsp;'.$model["vend_id"].'</td>';
                                   $html .= '</tr>';

                                              $models2 = Yii::app()->db->createCommand()
                                              ->select('sum(ct.quantity) as sum,cd.vend_id, detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name')
                                              ->from('c_cer_doc cd')
                                              ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                                                            ->join('m_product p', 'p.prod_name=ct.detail')
                                                                            ->join('m_prodtype t', 't.prot_id=p.prot_id')
                                              //->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                                                                            ->where('cer_date LIKE "'.$date_m.'%" AND cd.vend_id="'.$model["vend_id"].'"')
                                                                            ->group('detail')
                                                                            ->queryAll();
                                              //-----------------------------------
                                              foreach ($models2 as $key => $model2) {
                                                     $html .= ' <tr>';
                                                     $html .= '<td style="border:1px solid black;width:70%">'.$m.$model2["prot_name"]."&nbsp;:&nbsp;".$model2["detail"].'</td><td style="border:1px solid black;text-align:center;width:15%">'.$model2["sum"].'</td><td style="border:1px solid black;text-align:center;width:15%">'.$model2["prod_unit"].'</td>';
                                                     $html .= '</tr>';
                                              }
                                              //-----------------------------------

	                  }
	    



	    $html .= '</tbody>';
	    $html .= '</table>';

            //---------------------------
            //$html .= '<br><br>รายงานสรุปยอดรับรองท่อ/อุปกรณ์จำนวน&nbsp;'.count($models).'&nbsp;รายการ';
            //$html .= '<br>ออกเมื่อ&nbsp;:&nbsp;'.$date_mm.'&nbsp;เวลา&nbsp;'.$t.'&nbsp;น.';
            //---------------------------

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

       

        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf'))
		{    
		    if(unlink($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf'))
		        $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf','F');
		}else{
		   $pdf->Output($_SERVER['DOCUMENT_ROOT'].'/engstd/print/'.'tempReport.pdf','F');
		}

		
		ob_end_clean() ;

		exit;


       

?>
