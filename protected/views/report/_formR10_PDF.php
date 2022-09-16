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
		       // $this->writeHTMLCell(145, 20, 40, 10, 'การประปานครหลวง<br>', 0, 1, false, true, 'C', false);
		        //$image_file = $_SERVER['DOCUMENT_ROOT'].'/engstd/images/mwa_logo.png';
		        //$this->Image($image_file, 180, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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

		        //$this->writeHTMLCell(145, 550, 40, 287, '-'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().'-', 0, 1, false, true, 'C', false);
		        //writeHTMLCell ($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=false, $reseth=true, $align='', $autopadding=true)
		    }
		}

                            $date_m = $date_end."-".$date_start;
        $models = Yii::app()->db->createCommand()
					->select("count(cer_no) as sum,cer_name,SUM(workDay(TOTAL_WEEKDAYS(CONCAT( DATE_FORMAT( cer_date,  '%Y' ),  '-', DATE_FORMAT( cer_date,  '%m-%d' ) ) , CONCAT( DATE_FORMAT( cer_oper_date,  '%Y' ),  '-', DATE_FORMAT( cer_oper_date,  '%m-%d' ) ) ))) as date_oper")
					->from('c_cer_doc cd')
					//->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
					->where('cer_date like "'.$date_m.'%"')
          ->group('cer_name')
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
		$pdf->SetMargins(PDF_MARGIN_LEFT, 15, 10);
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
		$pdf->SetFont('thsarabun', '', 14, '', true);

		$thai_mm=array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		$m_month=$thai_mm[(int)$date_start-1];
	    $html .= '<div style="font-weight:bold;font-size:16;text-align:center;">สรุปผลการดำเนินการประจำเดือน &nbsp;'.$m_month."&nbsp;".($date_end+543).'</div><br>';
        $html .= '<b>สรุปผลการดำเนินงาน รายบุคคล</b><br>';

            $m="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	    $html .= '<table>';
	    $html .= '<thead>';
	    $html .= '  <tr style="line-height: 40px;background-color:lightblue">';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:55%">ผู้ตรวจโรงงาน</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:15%">ใบรับรอง</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:15%">วันดำเนินการ</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:15%">วัน/ใบรับรอง</th>';
	    $html .= '  </tr>';
	    $html .= '</thead>';
	    $html .= '<tbody>';

                          $sumAll=0;
                          $dateAll = 0;
	                  foreach ($models as $key => $model) {
                                   $html .= '<tr style="line-height: 30px;" >';
                                        $html .= '<td style="text-align:left;border:1px solid black;width:55%">&nbsp;'.$model["cer_name"].'</td>';
                                        $html .= '<td style="text-align:center;border:1px solid black;width:15%">&nbsp;'.$model["sum"].'</td>';
                                        $html .= '<td style="text-align:center;border:1px solid black;width:15%">&nbsp;'.$model["date_oper"].'</td>';
                                        $html .= '<td style="text-align:center;border:1px solid black;width:15%">&nbsp;'.number_format($model["date_oper"]/$model["sum"],2).'</td>';
                                   $html .= '</tr>';
                          $sumAll=$sumAll+$model["sum"];
                          $dateAll=$dateAll+$model["date_oper"];
	                  }

	                   // $html .= '<tr style="font-weight:bold;line-height: 30px;" bgcolor="#f5f5f5">';
                    //                     $html .= '<td style="text-align:center;border:1px solid black;width:55%">&nbsp;รวม</td>';
                    //                     $html .= '<td style="text-align:center;border:1px solid black;width:15%">&nbsp;'.$sumAll.'</td>';
                    //                     $html .= '<td style="text-align:center;border:1px solid black;width:15%">&nbsp;'.$dateAll.'</td>';
                    //                     $html .= '<td style="text-align:center;border:1px solid black;width:15%">&nbsp;'.number_format($dateAll/$sumAll,2).'</td>';
                    //     $html .= '</tr>';
	   
	    $html .= '</tbody>';
	    $html .= '</table><br><br>';

	     $html .= '<b>สรุปผลการดำเนินงาน กมว.ฝมส.</b><br>';
	     $html .= '<table>';
	    $html .= '<thead>';
	    $html .= '  <tr style="line-height: 40px; background-color:lightblue">';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:35%">รวมใบรับรอง</th>';	  
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:35%">รวมวันดำเนินการ</th>';
	    $html .= '    <th style="font-size:18px;font-weight:bold;border:1px solid black;text-align:center;width:30%">วัน/ใบรับรอง</th>';
	    $html .= '  </tr>';
	    $html .= '</thead>';
	    $html .= '<tbody>';

                

	                   $html .= '<tr style="font-weight:bold;line-height: 30px;" bgcolor="#f5f5f5">';
                   
                                        $html .= '<td style="text-align:center;border:1px solid black;width:35%">&nbsp;'.$sumAll.'</td>';
                                        $html .= '<td style="text-align:center;border:1px solid black;width:35%">&nbsp;'.$dateAll.'</td>';
                                        $html .= '<td style="text-align:center;border:1px solid black;width:30%">&nbsp;'.number_format($dateAll/$sumAll,2).'</td>';
                        $html .= '</tr>';
	   
	    $html .= '</tbody>';
	    $html .= '</table>';

            //---------------------------
           // $html .= '<br><br>สรุปผลการดำเนินงาน&nbsp;กมว.&nbsp;ฝมส.';
          //  $html .= '<br>รวมใบรับรอง&nbsp;&nbsp;';
           // $html .= $sumAll;
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
