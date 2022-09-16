<?php
$this->breadcrumbs=array(
	'Cer Docs'=>array('index'),
	'Manage',
);

?>

<h3>อนุมัติใบรับรอง</h3>


<?php 


$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'info',
    'label'=>'ปิดงาน',
    'icon'=>'icon-ok-sign',
    //'url'=>array('close'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 0px 0px 10px;',


				'onclick'=>'      
                       if($.fn.yiiGridView.getSelection("cer-doc-grid").length==0)
                       	  js:bootbox.alert("กรุณาเลือกใบรับแจ้งที่ต้องการปิด?","ตกลง");	
                       else 
                       {  
                               	 $.ajax({
										type: "POST",
										url: "close",
										data: { selectedID: $.fn.yiiGridView.getSelection("cer-doc-grid")}
										})
										.done(function( msg ) {
											$("#cer-doc-grid").yiiGridView("update",{});
										});
			            }',


    	),
)); 



$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cer-doc-grid',
	'dataProvider'=>$model->searchByUserApprove(Yii::app()->user->getLevel()),
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
			     'type'  => 'raw',
			    'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'value' => 'CHtml::link($data->cer_no, Yii::app()->createUrl("cerDoc/preview",array("id"=>$data->cer_id)))',
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
	  
	  	'contract_no'=>array(
			    'header' => 'เลขที่สัญญา',
			    'name'=>'contract_no',
			    'value'=>'$data->contract_no',
			    'filter'=>CHtml::activeTextField($model, 'contract_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:9%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
		'vend_id'=>array(
			    'name' => 'vend_id',
			    'filter'=>CHtml::activeTextField($model, 'vend_id',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("vend_id"))),
				'headerHtmlOptions' => array('style' => 'width:25%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left')
	  	),
	  	'cer_name'=>array(
			    'name' => 'cer_name',
			    'filter'=>CHtml::activeTextField($model, 'cer_name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_name"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
	  	'cer_oper_date'=>array(
			    'name' => 'cer_oper_date',
			    'filter'=>CHtml::activeTextField($model, 'cer_oper_date',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_oper_date"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
	  	'cer_date'=>array(
			    'name' => 'cer_date',
			    'filter'=>CHtml::activeTextField($model, 'cer_date',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_date"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
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
<div id="modal-content" class="modal hide">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  
    <div id="modal-body2" class='modal-body'>
         <div>หมายเหตุ :</div> 
         <form id="note-form" accept-charset="UTF-8">
         	
         <textarea class='span5' rows=4 cols=4 name='comment' id='comment'></textarea>
        </form>
    </div>
  
</div>