
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
  }

.table-fixed thead > tr> th {
  float: left;
  text-align: center;
  border-bottom-width: 0;
  background-color: #f5f5f5;
}


</style>

<?php
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

//$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
$m = Yii::app()->db->createCommand()
					->select('sum(ct.quantity) as sum_q')
					->from('c_cer_doc cd')	
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
					->where('cer_date BETWEEN "$date_start" AND "$date_end"')					                   
					->queryAll();
print_r($m);					

?>


  <div class="">
      
        <table class="table table-fixed ">
          <thead style="width:100%;">
            <tr style="background-color: #f5f5f5;">
              <th style="width:25%">รหัสท่อ/อุปกรณ์</th><th style="width:30%">รายละเอียดท่อ/อุปกรณ์</th><th style="width:21%">ขนาด &#8709 มม.</th><th style="width:6%">จำนวน</th><th style="width:10%">หน่วย</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="width:10%">1</td><td style="width:64%">Mike Adams</td><td style="width:20%">23</td>
            </tr>
           <tr>
              <td style="width:10%">1</td><td style="width:64%">Mike Adams</td><td style="width:20%">23</td>
            </tr>
            <tr>
              <td style="width:10%">1</td><td style="width:64%">Mike Adams</td><td style="width:20%">23</td>
            </tr>
            <tr>
              <td style="width:10%">1</td><td style="width:64%">Mike Adams</td><td style="width:20%">23</td>
            </tr>
            <tr>
              <td style="width:10%">1</td><td style="width:64%">Mike Adams</td><td style="width:20%">23</td>
            </tr>
            <tr>
              <td style="width:10%">1</td><td style="width:64%">Mike Adams</td><td style="width:20%">23</td>
            </tr>
            <tr>
              <td style="width:10%">1</td><td style="width:64%">Mike Adams</td><td style="width:20%">23</td>
            </tr>
   
          </tbody>
        </table>
     
  </div>

