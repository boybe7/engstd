<?php

function renderDate($value)
{
    $th_month = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $dates = explode("-", $value);
   
    $renderDate = intval($dates[2])." ".$th_month[intval($dates[1])]." ".substr($dates[0], 2);
   
    return $renderDate;               
}


require_once($_SERVER['DOCUMENT_ROOT'].'/engstd/protected/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

		    //Page header
			private $date_start;
		    private $date_end;


		    public function setDate($start, $end) {
		        $this->date_start = $start;
		        $this->date_end = $end;
		    }

		    public function Header() {
		        
		        // Set font
		        $this->SetFont('thsarabun', 'B', 20);
		        // Title
		        //$this->Cell(0, 5, 'รายงานสรุปยอดรับรองท่อ/อุปกรณ์', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		        $this->writeHTMLCell(145, 20, 40, 10, 'รายงานสรุปท่อ/อุปกรณ์ประปาที่ผ่านการตรวจสอบคุณภาพ<br>การประปานครหลวง<div style="font-size:16px;">วันที่ออกใบรับรอง '.renderDate($this->date_start)." ถึง ".renderDate($this->date_end)."</div>", 0, 1, false, true, 'C', false);
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

		// create new PDF document
		//$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


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

	
		$pdf->setDate($date_start,$date_end);

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
		
		$html = "";
		$pdf->SetFont('thsarabun', '', 12, '', true);


		$html .= '<table width="100%" border="1">';            
        $html .= '<tr style="font-weight:bold;border-bottom: 1px solid black;"><td style="text-align:center;width:50%">ผลิตภัณฑ์</td><td style="text-align:center;width:30%">จำนวน</td><td style="text-align:center;width:20%">หน่วย</td></tr>';
              
        foreach ($test as $key => $m) {



                   $test2 = Yii::app()->db->createCommand('SELECT detail, prod_unit, t.prot_name
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND p.prot_id="'.$m["prot_id"].'" AND p.prot_sub_id="'.$m["prot_sub_id"].'"
                        GROUP BY prod_unit')->queryAll();          
              
               //echo "<br>";
               //print_r($test2);
               //echo "<br>";
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
                        //echo "<br>".$m["prot_name"].":".$m["subname"];
                        $sum2 = 0;
                        foreach ($models as $key => $m2) {
                          //echo "<br>".$m2["sum"]."*".$m2["factor"]."=".$m2["sum"]*$m2["factor"];   
                           $sum2 += $m2["sum"]*$m2["factor"]; 

                        }  
                        //echo "<br>sum=".$sum2;  
                        $sum = $sum2; 
                        
                      
                  }    
                  $html .= '<tr><td style="text-align:left;width:50%">   '.$m["prot_name"].':'.$m["subname"].'</td><td style="text-align:right;width:30%;padding-right:20px;">'.number_format($sum,0).'&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="text-align:center;width:20%">'.$unit.'</td></tr>';
              }            
              $html .= '</table>';

              //calculate cost
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
                   $html .= '<table width="100%">';
                  $html .= '<tr><td style="text-align:right;"><b>มูลค่างาน '.number_format($sumCost,0)." บาท</b></td></tr>";               
                      
                   $html .= '</table>';

			$t= date('H:i:s', time()); // 10:00:00
			$m_d = date("d");
			$m_m = date("m")-1;
			$m_y = date("Y")+543;
		$thai_mm=array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	
			$date_mm =$m_d."&nbsp;".$thai_mm[(int)$m_m]."&nbsp;".$m_y;
		$html .="<br>ออกเมื่อ&nbsp;:&nbsp;".$date_mm."&nbsp;เวลา&nbsp;".$t."&nbsp;น.";

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
