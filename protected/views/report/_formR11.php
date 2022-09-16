
<style type="text/css">
.table-fixed thead {
  width: 100%;

}

.table-fixed tbody {
  height: 600px;

  width: 100%;
}

.table-fixed tbody td {

  
  }

.table thead > tr> th {
 
  text-align: center;
  border-bottom-width: 0;
  border-style: solid;
  border-width: thin;
  border-color: #e3e3e3;
  background-color: #f5f5f5;

}

</style>

<?php
$thai_mm=array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

$m_month=$thai_mm[(int)$month-1];
//.$thai_mm[(int)$m_m]


$date_m = $year."-".$month;

//$date_start="2558-07-01";
//$date_end="2558-10-01";

//$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
$models = Yii::app()->db->createCommand()
					//->select('sum(ct.quantity) as sum,cd.vend_id, detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name')
          ->select('cd.vend_id')
					->from('c_cer_doc cd')
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                       // ->join('m_product p', 'p.prod_name=ct.detail')
                                     //   ->join('m_prodtype t', 't.prot_id=p.prot_id')
					//->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                                        ->where('cer_date LIKE "'.$date_m.'%"')
                                        ->group('vend_id')
					->queryAll();
//print_r($m);


//echo count($models);

?>

  <table class="table-fixed">
     <thead>
      <tr style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;line-height:3">
        <th style="text-align:center;width:30%">ผู้ผลิต</th>
        <th style="text-align:center;width:50%">ผลิตภัณฑ์</th>
        <th style="text-align:center;width:10%">จำนวน</th>
        <th style="text-align:center;width:10%">หน่วย</th>
      </tr>
    </thead>
    <tbody>
          <?php

                  foreach ($models as $key => $model) {
                      echo "<tr>";
                        echo '<td style="font-weight: bold;">'.$model["vend_id"].'</td>';
                      echo "</tr>";

                        

                          $models2 = Yii::app()->db->createCommand('SELECT sub.name AS subname, SUM( ct.quantity ) AS sum, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name,factor
                                  FROM c_cer_doc cd
                                  LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                                  LEFT JOIN m_product p ON p.prod_id = ct.prod_id 
                                  LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                                  LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                                  WHERE cer_date LIKE "'.$date_m.'%"  AND cd.vend_id="'.$model["vend_id"].'"
                                  GROUP BY IFNULL( sub.id, t.prot_name ) ')->queryAll();                                  

                         
                         foreach ($models2 as $key => $model2) {

                               
                                 $test2 = Yii::app()->db->createCommand('SELECT detail, prod_unit, t.prot_name
                                      FROM c_cer_doc cd
                                      LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
                                      LEFT JOIN m_product p ON p.prod_id = ct.prod_id
                                      LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
                                      LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
                                      WHERE cer_date LIKE "'.$date_m.'%" AND t.prot_name="'.$model2["prot_name"].'" AND cd.vend_id="'.$model["vend_id"].'"
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

                               $sum = $model2["sum"];
                                if($model2["factor"]>1) 
                                { 
                                   $unit = "เมตร";
                                   $sum = $model2["sum"]*$model2["factor"];

                                }         

                                echo "<tr>";
                                  echo '<td style="text-align:center;">&nbsp;</td><td style="">'.$model2["prot_name"].":".$model2["subname"].'</td><td style="text-align:center;">'.$sum.'</td><td style="text-align:center;">'.$unit.'</td>';
                                echo "</tr>";
                          }

                          
                  }


            ?>


    </tbody>
  </table>



