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

//echo "วันเริ่มต้น--".$date_start;
//echo "--วันสิ้นสุด--".$date_end;
          
                
                // $prod_sta = explode("-", $prod_id_sta);
                // if($prod_id_sta !=""){
                //     $prod_sta_m = $prod_sta[1];
                // }else{
                //     $prod_sta_m = "";
                // }

                // $prod_end = explode("-", $prod_id_end);
                // if($prod_id_end !=""){
                //     $prod_end_m = $prod_end[1];
                // }else{
                //     $prod_end_m = "";
                // }
                // echo "prod_sta_m=".$prod_sta_m."<br>";
                // echo "prod_end_m=".$prod_end_m."<br>";

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

//echo"เงื่อนไขรายงาน : วันที่ออกใบรับรองจาก&nbsp;".$date_st."&nbsp;ถึง&nbsp;".$date_en."<br><br>";
//echo $vend_id_sta.":".$vend_id_end;
$vend_id_sta = $vend_id_sta!="" ? $vend_id_sta : $vend_id_end;
$vend_id_end = $vend_id_end!="" ? $vend_id_end : $vend_id_sta;

               if(($vend_id_sta!="")||($vend_id_end!="")){
                    //---เลือก-----รหัสผู้ผลิต/จัดส่งเริ่มต้น
                    //echo"รหัสผู้ผลิต/จัดส่งเริ่มต้น----ไม่ว่าง----------<br>";
                    $models_m = Yii::app()->db->createCommand()
                    ->select('cd.contract_no,cd.cer_id')
                    ->from('c_cer_doc cd')
                    //->join('contractor v', 'cd.contractor=v.name')
                    ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND cd.contract_no BETWEEN "'.$vend_id_sta.'" AND "'.$vend_id_end.'"')
                    //->group('v.code')
                    ->queryAll();

                }else{
                    //echo"รหัสผู้ผลิต/จัดส่งเริ่มต้น----ว่าง------------<br>";
                    $models_m = Yii::app()->db->createCommand()
                    ->select('cd.contract_no,cd.cer_id')
                    ->from('c_cer_doc cd')
                    //->join('contractor v', 'cd.contractor=v.name')
                    ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                    //->group('v.code')
                    ->queryAll();
                }



                  foreach ($models_m as $key => $model_m) {
                        $vend_id=$model_m["contract_no"];
                        $cer_id=$model_m["cer_id"];
                       

                        $models = Yii::app()->db->createCommand()
                                    ->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit')
                                    ->from('c_cer_doc cd')
                                    ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                    ->join('m_product p', 'p.prod_name = ct.detail AND p.prod_sizename LIKE CONCAT("%",ct.prod_size,"%") ')
                                    ->where('cd.cer_id="'.$cer_id.'" AND cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                                    ->group('prod_code')
                                    ->queryAll();



                      

                                    ?>

                                      <table class="table">
                                        <thead>
                                          <tr style="background-color:#AAADAD">
                                            <th style="text-align:left" colspan="5">เลขที่สัญญา <?php echo $model_m["contract_no"];?></th>
                                             
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
echo"รายงานผลรวมการผลิตแยกตามเลขที่สัญญาจำนวน&nbsp;".count($models_m)."&nbsp;รายการ";
$t= date('H:i:s', time()); // 10:00:00
$m_d = date("d");
$m_m = date("m")-1;
$m_y = date("Y")+543;

$date_mm =$m_d."&nbsp;".$thai_mm[(int)$m_m]."&nbsp;".$m_y;
echo"<br>ออกเมื่อ&nbsp;:&nbsp;".$date_mm."&nbsp;เวลา&nbsp;".$t."&nbsp;น.";
?>
