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
    $date_start = $str_date[2]."-".$str_date[1]."-".$str_date[0];

$str_date = explode("/", $date_end);
if(count($str_date)>1)
    $date_end = $str_date[2]."-".$str_date[1]."-".$str_date[0];

if(empty($date_end))
	$date_end = $date_start;
if(empty($date_start))
	$date_start = $date_end;

$date_s = new DateTime($date_start);
$date_st =(int)($date_s->format('d'))."&nbsp;".$thai_mm[(int)$date_s->format('m')-1]."&nbsp;".($date_s->format('y'));
$date_e = new DateTime($date_end);
$date_en =(int)($date_e->format('d'))."&nbsp;".$thai_mm[(int)$date_e->format('m')-1]."&nbsp;".($date_e->format('y'));

              $models_m = Yii::app()->db->createCommand()
                    ->select('p.prot_id')
                    ->from('c_cer_doc cd')
                    ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                    ->join('m_product p', 'p.prod_name = ct.detail AND p.prod_sizename LIKE CONCAT("%",ct.prod_size,"%") ')                                    
                    ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                    ->group('p.prot_id')
                    ->queryAll();

              //print_r($models_m);

                  foreach ($models_m as $key => $model_m) {
                        $type_id = $model_m['prot_id'];
                        $models = Yii::app()->db->createCommand()
                                    ->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit,pt.prot_name')
                                    ->from('c_cer_doc cd')
                                    ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                    ->join('m_product p', 'p.prod_name = ct.detail AND p.prod_sizename LIKE CONCAT("%",ct.prod_size,"%") ')
                                    ->join('m_prodtype pt', 'p.prot_id=pt.prot_id')
                                    ->where('p.prot_id="'.$type_id.'" AND cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                                    ->group('prod_code')
                                    ->queryAll();



                      

                                    ?>

                                      <table class="table">
                                        <thead>
                                          <tr style="background-color:#AAADAD">
                                            <th style="text-align:left" colspan="5"><?php echo $models[0]["prot_name"];?></th>
                                             
                                          </tr>
                                          <tr style="background-color:#D5DADB">
                                            <th style="text-align:left;width:20%">รหัสท่อ/อุปกรณ์</th>
                                            <th style="text-align:left;width:40%">รายละเอียดท่อ/อุปกรณ์</th>
                                            <th style="text-align:center;width:20%">ขนาด &#8709 มม.</th>
                                            <th style="text-align:center;width:10%">จำนวน</th>
                                            <th style="text-align:center;width:10%">หน่วย</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                              <?php

                                                      foreach ($models as $key => $model) {
                                                          echo "<tr>";
                                                            echo '<td style="">'.$model["prod_code"].'</td><td style="">'.$model["detail"].'</td><td style="text-align:center;">'.$model["size"].'</td><td style="text-align:center;">'.$model["sum"].'</td><td style="text-align:center;">'.$model["prod_unit"].'</td>';
                                                          echo "</tr>";
                                                      }

                                                echo '<tr style="background-color:#F5F7F7;font-weight:bold">';
                                                            echo '<td style="text-align:center;" colspan=3>รวม</td><td style="text-align:center;">'.count($models).'</td><td style="text-align:center;">รายการ</td>';
                                                echo "</tr>";      
                                                ?>
                                        </tbody>
                                      </table>






            <?php
                  }
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
