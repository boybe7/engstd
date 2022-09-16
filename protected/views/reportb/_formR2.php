
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
//print_r($model);
$str_date = explode("/", $date_start);
if(count($str_date)>1)
    $date_start = ($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

$str_date = explode("/", $date_end);
if(count($str_date)>1)
    $date_end = $($str_date[2]-543)."-".$str_date[1]."-".$str_date[0];

if(empty($date_end))
	$date_end = $date_start;
if(empty($date_start))
	$date_start = $date_end;


//$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
$models = Yii::app()->db->createCommand()
					->select('sum(ct.quantity) as sum, detail,prod_code,ct.prod_size as size,prod_unit')
					->from('c_cer_doc cd')	
					->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
          ->join('m_product p', 'p.prod_name=ct.detail')
					->where('cer_date BETWEEN "'.$date_start.'" AND "'.$date_end.'"')		
          ->group('detail')			                   
					->queryAll();
//print_r($m);					

?>


  <!-- <div>
      
        <table class="table table-fixed ">
          <thead style="width:100%;">
            <tr style="background-color: #f5f5f5;">
              <th style="width:25%;border-color: #e3e3e3;border-left-style: solid;border-top-style: solid;border-width: thin;">รหัสท่อ/อุปกรณ์</th><th style="width:30%;border-top-style: solid;border-width: thin;border-color: #e3e3e3">รายละเอียดท่อ/อุปกรณ์</th><th style="width:21%;border-top-style: solid;border-width: thin;border-color: #e3e3e3">ขนาด &#8709 มม.</th><th style="width:6%;border-top-style: solid;border-width: thin;border-color: #e3e3e3">จำนวน</th><th style="width:10%;border-top-style: solid;border-width: thin;border-color: #e3e3e3;border-right-style: solid;">หน่วย</th>
            </tr>
          </thead>
          <tbody>
 -->
            <?php
                 
                  // foreach ($models as $key => $model) {
                  //     echo "<tr>";
                  //       echo '<td style="width:25%;">'.$model["prod_code"].'</td><td style="width:30%">'.$model["detail"].'</td><td style="width:21%;text-align:center;">'.$model["size"].'</td><td style="width:6%;text-align:center;">'.$model["sum"].'</td><td style="width:9.3%;text-align:center;">'.$model["prod_unit"].'</td>';
                  //     echo "</tr>";
                  // }
                

            ?> 
            
   <!--       
          </tbody>
        </table>
     
  </div> -->


  <table class="table">
    <thead>
      <tr>
        <th style="text-align:center">รหัสท่อ/อุปกรณ์</th>
        <th style="text-align:center">รายละเอียดท่อ/อุปกรณ์</th>
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

