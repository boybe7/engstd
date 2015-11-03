
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
$date_st =(int)($date_s->format('d'))."&nbsp;".$thai_mm[(int)$date_s->format('m')-1]."&nbsp;".($date_s->format('Y'));
$date_e = new DateTime($date_end);
$date_en =(int)($date_e->format('d'))."&nbsp;".$thai_mm[(int)$date_e->format('m')-1]."&nbsp;".($date_e->format('Y'));
echo"สรุปผลงานตั้งแต่วันที่&nbsp;".$date_st."&nbsp;ถึงวันที่&nbsp;".$date_en."<br>";
echo"รายละเอียดท่อและอุปกรณ์ประปาที่ผ่านการตรวจสอบควบคุมคุณภาพ&nbsp;ดังนี้"."<br><br>";

//$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
$models = Yii::app()->db->createCommand()
					->select('sub.name,sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit,t.prot_name')
					->from('c_cer_doc cd')	
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
                                        ->join('m_product p', 'p.prod_name=ct.detail')
                                        ->join('m_prodtype t', 't.prot_id=p.prot_id')
                                         ->join('m_prodtype_subgroup sub', 'sub.id = p.prot_sub_id')
					->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')		
                                        ->group('sub.id')
					->queryAll();
//print_r($m);					
// SELECT sub.name, SUM( ct.quantity ) AS sum, detail, prod_code, ct.prod_size AS size, prod_unit, t.prot_name
// FROM c_cer_doc cd
// LEFT JOIN c_cer_detail ct ON cd.cer_id = ct.cer_id
// LEFT JOIN m_product p ON p.prod_name = ct.detail
// LEFT JOIN m_prodtype t ON t.prot_id = p.prot_id
// LEFT JOIN m_prodtype_subgroup sub ON sub.id = p.prot_sub_id
// GROUP BY sub.id
echo "xxx:";
print_r($models);          
?>

  <table class="table">
    <tbody>
          <?php
                 
                  foreach ($models as $key => $model) {
                      echo "<tr>";
                        echo '<td style="">'.$model["prot_name"]."&nbsp;:&nbsp;".$model["detail"].'</td><td style="text-align:center;">จำนวน</td><td style="text-align:center;">'.$model["sum"].'</td><td style="text-align:center;">'.$model["prod_unit"].'</td>';
                      echo "</tr>";
                  }
                

            ?> 
            
     
    </tbody>
  </table>

