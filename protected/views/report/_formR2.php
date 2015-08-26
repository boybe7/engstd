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


//echo "วันเริ่มต้น--".$date_start;
//echo "--วันสิ้นสุด--".$date_end;


$models=CerDoc::model()->findAll(array("condition"=>"cer_date BETWEEN '$date_start' AND '$date_end'  "));
//print_r($models);  

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cer-doc-grid',
	'dataProvider'=>$model->search(),
	'type'=>'bordered condensed',
	'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:40px'),
    'enablePagination' => true,
    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
	'columns'=>array(
		'checkbox'=> array(
        	    'id'=>'selectedID',
            	'class'=>'CCheckBoxColumn',
            	//'selectableRows' => 2, 
        		 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
	  	         'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)   	  		
        ),
		'cer_no'=>array(
			    'name' => 'cer_no',
			    'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
		'vend_id'=>array(
			    'name' => 'vend_id',
			    'filter'=>CHtml::activeTextField($model, 'vend_id',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("vend_id"))),
				'headerHtmlOptions' => array('style' => 'width:40%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left')
	  	),
	  	'cer_date'=>array(
			    'name' => 'cer_date',
			    'filter'=>CHtml::activeTextField($model, 'cer_date',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_date"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
	  	'cer_status'=>array(
			    'name' => 'cer_status',
			    'value' => array($model,'getStatus'),
			    'filter'=>CHtml::activeDropDownList($model, 'cer_status', array('1' => 'เปิด', '2' => 'ปิด','3'=>'ยกเลิก'),array('empty'=>'')),
				'headerHtmlOptions' => array('style' => 'width:13%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
			'template' => ' {update}',
	
		),
	),
));



            
?>