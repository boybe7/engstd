<style type="text/css">
.table-fixed thead {
  width: 100%;

}

.table-fixed tbody {
  height: 600px;
  overflow-y: auto;
  width: 100%;
}
.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
  display: block;
}
.table-fixed tbody td {
  float: left;
  border-bottom-width: 0;
  border-style: solid;
  border-width: thin;
  border-color: #e3e3e3;
  }



.table-fixed thead > tr> th {
  float: left;
  text-align: center;

  background-color: #f5f5f5;

}


</style>


<?php
$thai_mm=array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

//print_r($model);
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

// $date_s = new DateTime($date_start);
// $date_st =(int)($date_s->format('d'))."&nbsp;".$thai_mm[(int)$date_s->format('m')-1]."&nbsp;".($date_s->format('y'));
// $date_e = new DateTime($date_end);
// $date_en =(int)($date_e->format('d'))."&nbsp;".$thai_mm[(int)$date_e->format('m')-1]."&nbsp;".($date_e->format('y'));

              /*$models_m = Yii::app()->db->createCommand()
                    ->select('p.prot_id')
                    ->from('c_cer_doc cd')
                    ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                    ->join('m_product p', 'p.prod_name = ct.detail AND p.prod_sizename LIKE CONCAT("%",ct.prod_size,"%") ')                                    
                    ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                    ->group('p.prot_id')
                    ->queryAll();*/
              $models_m = Yii::app()->db->createCommand('SELECT p.prot_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id                         
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"
                        GROUP BY p.prot_id ORDER BY cd.cer_id ')->queryAll();       

              /*$models = Yii::app()->db->createCommand()
                          ->select('sub.name as subname,sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name')
                          ->from('c_cer_doc cd')  
                          ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                          ->join('m_product p', 'p.prod_name = ct.detail AND p.prod_sizename LIKE CONCAT("%",ct.prod_size,"%") ')                                    
                          ->join('m_prodtype t', 't.prot_id=p.prot_id')
                          ->join('m_prodtype_subgroup sub', 'sub.id = p.prot_sub_id')
                          ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')   
                          ->group('p.prot_id,sub.id')
                          ->order('t.prot_id')
                          ->queryAll(); */


               $test = Yii::app()->db->createCommand('SELECT sub.name AS subname, SUM( ct.quantity ) AS sum, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor,p.prot_id,p.prot_sub_id
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"
                        GROUP BY  IFNULL( sub.id, t.prot_name ) ORDER BY t.prot_name ')->queryAll();                 
              
              //echo "<pre>";
              //print_r($models_m);
              //echo "</pre>";

              echo "<table width='90%'>";            
              echo "<tr style='font-weight:bold;border-bottom: thin double #000000;'><td style='text-align:left;width:50%'>ผลิตภัณฑ์</td><td style='text-align:right;width:30%'>จำนวน</td><td style='text-align:center;width:20%'>หน่วย</td></tr>";
              
              foreach ($test as $key => $m) {

                 /* $models2 = Yii::app()->db->createCommand()
                          ->select('detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name')
                          ->from('c_cer_doc cd')  
                          ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                          ->join('m_product p', 'p.prod_name = ct.detail AND p.prod_sizename LIKE CONCAT("%",ct.prod_size,"%") ')                                    
                          ->join('m_prodtype t', 't.prot_id=p.prot_id')
                          ->join('m_prodtype_subgroup sub', 'sub.id = p.prot_sub_id')
                          ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND t.prot_name="'.$m["prot_name"].'"')   
                          ->group('prod_unit')
                          ->order('t.prot_id')
                          ->queryAll();  */    

                  


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
                  /*if($m["factor"]>1) 
                  { 
                     $unit = "เมตร";
                     $sum = $m["sum"]*$m["factor"];
                    

                  } */ 

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
                        echo "<br>".$m["prot_name"].":".$m["subname"];
                        $sum2 = 0;
                        foreach ($models as $key => $m2) {
                          echo "<br>".$m2["sum"]."*".$m2["factor"]."=".$m2["sum"]*$m2["factor"];   
                           $sum2 += $m2["sum"]*$m2["factor"]; 

                        }  
                        echo "<br>sum=".$sum2;  
                        $sum = $sum2; 
                        
                      
                  }    
                  
                  if(empty($m["prot_name"]))
                  {
                     echo "SUM = ".$sum;
                     echo   'SELECT detail, prod_unit, t.prot_name
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND p.prot_id="'.$m["prot_id"].'" AND p.prot_sub_id="'.$m["prot_sub_id"].'"
                         GROUP BY prod_unit';  
                  }

                  echo "<tr><td style='text-align:left;width:50%'>".$m["prot_name"].":".$m["subname"]."</td><td style='text-align:right;width:30%'>".number_format($sum,0)."</td><td style='text-align:center;width:20%'>".$unit."</td></tr>";
              }            
              echo "</table><hr>";

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

                         $models = Yii::app()->db->createCommand('SELECT sub.name AS subname,t.prot_name,sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name,price,factor
                        FROM c_cer_doc cd
                        LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                        LEFT JOIN m_product p ON p.prod_id = ct.prod_id
                        LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                        LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                        WHERE cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND p.prot_id="'.$type_id.'"
                        GROUP BY prod_code ORDER BY p.prot_id,prot_sub_id')->queryAll();                   
                        $olddata = "";   
                        $sumOld = 0;
                        foreach ($models as $key => $mm) {
                           
                       

                          $price = $mm["sum"]*$mm["price"];
                          $sumCost += $price;

                          /*if($olddata!=$mm["prot_name"].":".$mm["subname"])
                          {
                             $olddata =$mm["prot_name"].":".$mm["subname"];
                            $sumOld = 0;

                          }
                          else
                          {
                             $sumOld += $price;
                              echo "<br>sum = ".$sumOld."<br>";
                            
                          }*/

                           echo $mm["prot_name"].":".$mm["subname"]."|".$mm["detail"]." | ".$mm["size"]." |จำนวน: ".$mm["sum"]." |ราคา ".$mm["price"]." = ".number_format($price)."<br>";  
                        }            
                                  
                        
                        //$sumCost += $models[0]["sum"]*      
                  }   

                  echo "<hr><b>มูลค่างาน ".number_format($sumCost,0)." บาท</b><br>";               
                      

                                    ?>

                                      <!-- <table class="table">
                                        <thead>
                                          <tr style="background-color:#AAADAD">
                                            <th style="text-align:left" colspan="5"><?php //echo $models[0]["prot_name"];?></th>
                                             
                                          </tr>
                                          <tr style="background-color:#D5DADB">
                                            <th style="text-align:left;width:20%">รหัสท่อ/อุปกรณ์</th>
                                            <th style="text-align:left;width:40%">รายละเอียดท่อ/อุปกรณ์</th>
                                            <th style="text-align:center;width:20%">ขนาด &#8709 มม.</th>
                                            <th style="text-align:center;width:10%">จำนวน</th>
                                            <th style="text-align:center;width:10%">หน่วย</th>
                                          </tr>
                                        </thead>
                                        <tbody> -->
                                              <?php

                                                      // foreach ($models as $key => $model) {
                                                      //     echo "<tr>";
                                                      //       echo '<td style="">'.$model["prod_code"].'</td><td style="">'.$model["detail"].'</td><td style="text-align:center;">'.$model["size"].'</td><td style="text-align:center;">'.$model["sum"].'</td><td style="text-align:center;">'.$model["prod_unit"].'</td>';
                                                      //     echo "</tr>";
                                                      // }

                                                // echo '<tr style="background-color:#F5F7F7;font-weight:bold">';
                                                //             echo '<td style="text-align:center;" colspan=3>รวม</td><td style="text-align:center;">'.count($models).'</td><td style="text-align:center;">รายการ</td>';
                                                // echo "</tr>";      
                                                // ?>
                                       <!--  </tbody>
                                      </table>
 -->





            <?php
                // }
            ?>


<?php
//echo"รายงานผลรวมการผลิตแยกตามเลขที่สัญญาจำนวน&nbsp;".count($models_m)."&nbsp;รายการ";
$t= date('H:i:s', time()); // 10:00:00
$m_d = date("d");
$m_m = date("m")-1;
$m_y = date("Y")+543;

$date_mm =$m_d."&nbsp;".$thai_mm[(int)$m_m]."&nbsp;".$m_y;
echo"<br>ออกเมื่อ&nbsp;:&nbsp;".$date_mm."&nbsp;เวลา&nbsp;".$t."&nbsp;น.";
?>
