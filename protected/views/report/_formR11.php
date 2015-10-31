
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

$m_month=$thai_mm[(int)$month-1];
//.$thai_mm[(int)$m_m]

echo"<font size='3'><b>ภาคผนวกหมายเลข 6</b></font><br><br>";

$date_m = $year."-".$month;

//$date_start="2558-07-01";
//$date_end="2558-10-01";

//$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
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
//print_r($m);


//echo count($models);

?>

  <table class="table">
     <thead>
      <tr>
        <th style="text-align:center">ผู้ผลิต</th>
        <th style="text-align:center">ผลิตภัณฑ์</th>
        <th style="text-align:center">จำนวน</th>
        <th style="text-align:center">หน่วย</th>
      </tr>
    </thead>
    <tbody>
          <?php

                  foreach ($models as $key => $model) {
                      echo "<tr>";
                        echo '<td style="">'.$model["vend_id"].'</td>';
                      echo "</tr>";

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
                          foreach ($models2 as $key => $model2) {
                              echo "<tr>";
                                echo '<td style="text-align:center;">&nbsp;</td><td style="">'.$model2["prot_name"]."&nbsp;:&nbsp;".$model2["detail"].'</td><td style="text-align:center;">'.$model2["sum"].'</td><td style="text-align:center;">'.$model2["prod_unit"].'</td>';
                              echo "</tr>";
                          }

                          
                  }


            ?>


    </tbody>
  </table>



