<?php
$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('vendor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>ผู้ผลิต/ผู้จัดส่ง</h3>


</div><!-- search-form -->

<?php 




$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'success',
    'label'=>'เพิ่มคู่สัญญา',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
)); 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'danger',
    'label'=>'ลบคู่สัญญา',
    'icon'=>'minus-sign',
    'htmlOptions'=>array(
        'onclick'=>'      
                     
                       if($.fn.yiiGridView.getSelection("vendor-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
                       else  
                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
			                   function(confirmed){
			                
                                if(confirmed)
			                   	 $.ajax({
										type: "POST",
										url: "deleteSelected",
										data: { selectedID: $.fn.yiiGridView.getSelection("vendor-grid")}
										})
										.done(function( msg ) {
											$("#vendor-grid").yiiGridView("update",{});
										});
			                  })',
        'class'=>'pull-right'
    ),
)); 



$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'vendor-grid',
	'dataProvider'=>$model->search(),
	'type'=>'bordered condensed',
	'dataProvider'=>$model->search(),
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
        		 'headerHtmlOptions' => array('style' => 'width:3%;text-align:center;background-color: #f5f5f5'),
	  	         'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)   	  		
        ),
		'code'=>array(
			    'name' => 'code',
			    'filter'=>CHtml::activeTextField($model, 'code',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("code"))),
				'headerHtmlOptions' => array('style' => 'width:7%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;padding-left:10px;')
	  	),
		'name'=>array(
			    'name' => 'name',
			    'filter'=>CHtml::activeTextField($model, 'name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("name"))),
				'headerHtmlOptions' => array('style' => 'width:33%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left')
	  	),
	  	'address'=>array(
			    'name' => 'address',
			    'filter'=>CHtml::activeTextField($model, 'address',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("address"))),
				'headerHtmlOptions' => array('style' => 'width:30%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left')
	  	),
	  	'type'=>array(
			    'name' => 'type',
			    'value' => array($this,'gridTypeName'),
			    'filter'=>CHtml::activeDropDownList($model, 'type', array('0' => 'ผู้ผลิต', '1' => 'ผู้จัดส่ง'),array('empty'=>'')),
				'headerHtmlOptions' => array('style' => 'width:13%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'headerHtmlOptions' => array('style' => 'width:7%;text-align:center;background-color: #f5f5f5'),
			'template' => '{view}  {update}',
	
		),
	),
));

?>
