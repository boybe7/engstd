<?php
$this->breadcrumbs=array(
	'Cer Docs'=>array('index'),
	'Manage',
);

?>

<h3>ใบรับรอง</h3>


<?php 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'success',
    'label'=>'เพิ่มข้อมูล',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
)); 


if(Yii::app()->user->isExecutive() || Yii::app()->user->isAdmin())
{

// $this->widget('bootstrap.widgets.TbButton', array(
//     'buttonType'=>'link',
    
//     'type'=>'danger',
//     'label'=>'ลบข้อมูล',
//     'icon'=>'minus-sign',
//     //'url'=>array('delAll'),
//     //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
//     'htmlOptions'=>array(
//         //'data-toggle'=>'modal',
//         //'data-target'=>'#myModal',
//         'onclick'=>'      
    
//                        if($.fn.yiiGridView.getSelection("cer-doc-grid").length==0)
//                        		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
//                        else  
//                           js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
// 			                   function(confirmed){
			         
//                                 if(confirmed)
// 			                   	 $.ajax({
// 										type: "POST",
// 										url: "deleteSelected",
// 										data: { selectedID: $.fn.yiiGridView.getSelection("cer-doc-grid")}
// 										})
// 										.done(function( msg ) {
// 											$("#cer-doc-grid").yiiGridView("update",{});
// 										});
// 			                  })',
//         'class'=>'pull-right'
//     ),
// )); 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'warning',
    'label'=>'ยกเลิก',
    'icon'=>'remove-sign',
    //'url'=>array('close'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;',


				'onclick'=>'      
                       if($.fn.yiiGridView.getSelection("cer-doc-grid").length==0)
                       	  js:bootbox.alert("กรุณาเลือกใบรับแจ้งที่ต้องการยกเลิก?","ตกลง");	
                       else 
                       {  
          //                      	 $.ajax({
										// type: "POST",
										// url: "cancel",
										// data: { selectedID: $.fn.yiiGridView.getSelection("cer-doc-grid")}
										// })
										// .done(function( msg ) {
										// 	$("#cer-doc-grid").yiiGridView("update",{});
										// });

                                  

                       				 js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
                                       

                                        function(confirmed){
                                        	if(confirmed)
                                        	{
                                        		    
				                               	 	$.ajax({
														 type: "POST",
														 url: "cancel",
														 data: { selectedID: $.fn.yiiGridView.getSelection("cer-doc-grid"),data:$(".modal-body #note-form").serialize()}
													 })
													 .done(function( msg ) {
														 	$("#cer-doc-grid").yiiGridView("update",{});
													});

                                        	}	
                                        }
                                    );      		
                                         
			            }',


    	),
)); 
}

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
	'dataProvider'=>$model->searchByUser(Yii::app()->user->name),
	'type'=>'bordered condensed',
	'filter'=>$model,
	//'selectableRows' =>2,
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