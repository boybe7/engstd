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
               // echo "vend_id_all=".$vend_id_all."<br>";
                echo "vend_id_sta=".$vend_id_sta."<br>";
                echo "vend_id_end=".$vend_id_end."<br>";
               // echo "prot_id_all=".$prot_id_all."<br>";
                echo "prod_id_sta=".$prod_id_sta."<br>";
                echo "prod_id_end=".$prod_id_end."<br>";
                
                $prod_sta = explode("-", $prod_id_sta);
                if($prod_id_sta !=""){
                    $prod_sta_m = $prod_sta[1];
                }else{
                    $prod_sta_m = "";
                }

                $prod_end = explode("-", $prod_id_end);
                if($prod_id_end !=""){
                    $prod_end_m = $prod_end[1];
                }else{
                    $prod_end_m = "";
                }
                echo "prod_sta_m=".$prod_sta_m."<br>";
                echo "prod_end_m=".$prod_end_m."<br>";

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

echo"เงื่อนไขรายงาน : วันที่ออกใบรับรองจาก&nbsp;".$date_st."&nbsp;ถึง&nbsp;".$date_en."<br><br>";


//-----------------------
/*
//sql1
select v.code,cd.vend_id
from c_cer_doc cd,vendor v
where cd.vend_id=v.name
and cer_date BETWEEN "2558-07-01" AND "2558-10-01"
group by v.code

//sql2
select v.code,cd.vend_id
from c_cer_doc cd,vendor v
where cd.vend_id=v.name
and cer_date BETWEEN "2558-07-01" AND "2558-10-01"
and cd.vend_id BETWEEN "บริษัท อุตสาหกรรมท่อสตีมเหล็กกล้า จำกัด" AND "บริษัท อุตสาหกรรมท่อสตีมเหล็กกล้า จำกัด"
group by v.code

*/

//                echo "vend_id_all=".$vend_id_all."<br>";
//                echo "vend_id_sta=".$vend_id_sta."<br>";
//                echo "vend_id_end=".$vend_id_end."<br>";
//                echo "prot_id_all=".$prot_id_all."<br>";
//                echo "prot_id_sta=".$prot_id_sta."<br>";
//                echo "prot_id_end=".$prot_id_end."<br>";
/*
                    $models_m = Yii::app()->db->createCommand()
                    ->select('v.code,cd.vend_id')
                    ->from('c_cer_doc cd')
                    ->join('vendor v', 'cd.vend_id=v.name')
                    ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                    ->group('v.code')
                    ->queryAll();
*/

               if(($vend_id_sta!="")||($vend_id_end!="")){
                    //---เลือก-----รหัสผู้ผลิต/จัดส่งเริ่มต้น
                    echo"รหัสผู้ผลิต/จัดส่งเริ่มต้น----ไม่ว่าง----------<br>";
                    $models_m = Yii::app()->db->createCommand()
                    ->select('v.code,cd.vend_id')
                    ->from('c_cer_doc cd')
                    ->join('vendor v', 'cd.vend_id=v.name')
                    ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" AND cd.vend_id BETWEEN "'.$vend_id_sta.'" AND "'.$vend_id_end.'"')
                    ->group('v.code')
                    ->queryAll();

                }else{
                    echo"รหัสผู้ผลิต/จัดส่งเริ่มต้น----ว่าง------------<br>";
                    $models_m = Yii::app()->db->createCommand()
                    ->select('v.code,cd.vend_id')
                    ->from('c_cer_doc cd')
                    ->join('vendor v', 'cd.vend_id=v.name')
                    ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')
                    ->group('v.code')
                    ->queryAll();
                }

                  foreach ($models_m as $key => $model_m) {
                        $vend_id=$model_m["vend_id"];
                        

                                                                            if(($prod_sta_m!="")||($prod_end_m!="")){
                                                                                //----ถ้า----รหัสท่อ/อุปกรณ์เริ่มต้น---ไม่ว่าง
                                                                                echo"<br>รหัสท่อ/อุปกรณ์เริ่มต้น----ไม่ว่าง----------<br>";
                                                                                $models = Yii::app()->db->createCommand()
                                                                                ->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit')
                                                                                ->from('c_cer_doc cd')
                                                                                ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                                                                ->join('m_product p', 'p.prod_name=ct.detail')
                                                                                ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" and cd.vend_id="'.$vend_id.'" AND ct.detail BETWEEN "'.$prod_sta_m.'" AND "'.$prod_end_m.'"')
                                                                                ->group('ct.prod_size')
                                                                                ->queryAll();
                                                                            }else{
                                                                                //----ถ้า----รหัสท่อ/อุปกรณ์เริ่มต้น---ว่าง
                                                                                echo"<br>รหัสท่อ/อุปกรณ์เริ่มต้น----ว่าง----------<br>";
                                                                                $models = Yii::app()->db->createCommand()
                                                                                ->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit')
                                                                                ->from('c_cer_doc cd')
                                                                                ->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                                                                ->join('m_product p', 'p.prod_name=ct.detail')
                                                                                ->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'" and cd.vend_id="'.$vend_id.'"')
                                                                                ->group('ct.prod_size')
                                                                                ->queryAll();
                                                                            }
                                                                            


                                    //-------table2----------------------------------------------------
                                    //$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
                                                                            /*
                                                                            select sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit
                                                                            from c_cer_doc cd,c_cer_detail ct,m_product p
                                                                            where cd.cer_id=ct.cer_id
                                                                            and p.prod_name=ct.detail
                                                                            and cer_date BETWEEN "2558-07-01" AND "2558-10-01"
                                                                            and vend_id="บริษัท อุตสาหกรรมท่อสตีมเหล็กกล้า จำกัด"
                                                                            group by detail
                                                                             */
                                                                            //$prod_id_sta="สลักเกลียวและแป้นเกลียวอลูมินั่มบรอนซ์";
                                                                            //$prod_id_end="สลักเกลียวและแป้นเกลียวอลูมินั่มบรอนซ์";



                                    //print_r($m);

                                    ?>

                                      <table class="table">
                                        <thead>
                                          <tr style="background-color:#AAADAD">
                                            <th style="text-align:left"><?php echo $model_m["code"];?></th>
                                            <th style="text-align:left" colspan="4"><?php echo $vend_id;?></th> 
                                          </tr>
                                          <tr style="background-color:#D5DADB">
                                            <th style="text-align:left">รหัสท่อ/อุปกรณ์</th>
                                            <th style="text-align:left">รายละเอียดท่อ/อุปกรณ์</th>
                                            <th style="text-align:center">ขนาด &#8709 มม.</th>
                                            <th style="text-align:center">จำนวน</th>
                                            <th style="text-align:center">หน่วย</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                              <?php

                                                      foreach ($models as $key => $model) {
                                                          echo "<tr>";
                                                            echo '<td style="">'.$model["prod_code"].'</td><td style="">'.$model["detail"].'</td><td style="text-align:center;">'.$model["size"].'</td><td style="text-align:center;">'.$model["sum"].'</td><td style="text-align:center;">'.$model["prod_unit"].'</td>';
                                                          echo "</tr>";
                                                      }


                                                ?>
                                        </tbody>
                                      </table>






            <?php
                  }
            ?>


<?php
echo"รายงานผลรวมการผลิตแยกตามผู้ผลิตจำนวน&nbsp;".count($models_m)."&nbsp;รายการ";
$t= date('H:i:s', time()); // 10:00:00
$m_d = date("d");
$m_m = date("m")-1;
$m_y = date("Y")+543;

$date_mm =$m_d."&nbsp;".$thai_mm[(int)$m_m]."&nbsp;".$m_y;
echo"<br>ออกเมื่อ&nbsp;:&nbsp;".$date_mm."&nbsp;เวลา&nbsp;".$t."&nbsp;น.";
?>
