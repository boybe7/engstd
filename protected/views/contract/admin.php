<?php
$this->breadcrumbs=array(
	'Contracts'=>array('index')
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contract-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>สัญญา</h3>



<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'success',
    'label'=>'เพิ่มสัญญา',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
)); 


$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'danger',
    'label'=>'ลบสัญญา',
    'icon'=>'minus-sign',
    //'url'=>array('delAll'),
    //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
    'htmlOptions'=>array(
        //'data-toggle'=>'modal',
        //'data-target'=>'#myModal',
        'onclick'=>'      
                       //console.log($.fn.yiiGridView.getSelection("user-grid").length);
                       if($.fn.yiiGridView.getSelection("contract-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
                       else  
                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
			                   function(confirmed){
			                   	 	
			        
                                if(confirmed)
			                   	 $.ajax({
										type: "POST",
										url: "deleteSelected",
										data: { selectedID: $.fn.yiiGridView.getSelection("contract-grid")}
										})
										.done(function( msg ) {
											$("#contract-grid").yiiGridView("update",{});
										});
			                  })',
        'class'=>'pull-right'
    ),
)); 


$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'contract-grid',
    'type'=>'bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 2,
       // 'template'=>"{summary}{items}{pager}",
    'htmlOptions'=>array('style'=>'padding-top:40px'),
    'enablePagination' => true,
    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
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
		'con_number'=>array(
			
				'name' => 'con_number',
				'filter'=>CHtml::activeTextField($model, 'con_number',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("con_number"))),
				'headerHtmlOptions' => array('style' => 'width:30%;text-align:center;background-color: #f5f5f5'),  	            	  		
				//'headerHtmlOptions' => array('style' => 'width: 110px'),
				'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	        )	),
		'con_price'=>array(
			
				'name' => 'con_price',
				 'value' => 'number_format($data->con_price,2)',
				'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #f5f5f5'),  	            	  		
				//'headerHtmlOptions' => array('style' => 'width: 110px'),
				'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:right'

	  	        )	),
		'con_budget'=>array(
			
				'name' => 'con_budget',
				 'value' => 'number_format($data->con_budget,2)',
				'headerHtmlOptions' => array('style' => 'width:30%;text-align:center;background-color: #f5f5f5'),  	            	  		
				//'headerHtmlOptions' => array('style' => 'width: 110px'),
				'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:right'

	  	        )	),
		array(
							'class'=>'bootstrap.widgets.TbButtonColumn',
							'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
							'template' => '{update}',
					
						),
	),
)); ?>
