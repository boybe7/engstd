<?php
$this->breadcrumbs=array(
	'Products'=>array('index')
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h3>รายละเอียดท่อและอุปกรณ์</h3>

<?php 

 $models=Prodtype::model()->findAll();
        $data = array();
        foreach ($models as $key => $value) {
          $data[] = array(
                          'value'=>$value['prot_id'],
                          'text'=>$value['prot_name'],
                       );
        } 
        $typelist2 = CHtml::listData($data,'value','text');
        echo CHtml::dropDownList('prot_id','', $typelist2,array('class'=>'span3','style'=>'margin:0px 0px 0px 0px;','ajax' => 
                            array(
                                'type'=>'POST', 
                                'url'=>CController::createUrl('GetSubgroupByType'),
                                'data'=>array('id' => 'js:this.value'),
                                'update'=>'#prot_sub_id', 
                            ))); 
        
        $models=ProdtypeSubgroup::model()->findAll(array('order'=>'', 'condition'=>'prod_id=:id', 'params'=>array('id'=>13)));
        $data = array();
        foreach ($models as $key => $value) {
          $data[] = array(
                          'value'=>$value['id'],
                          'text'=>$value['name'],
                       );
        } 

        $typelist = CHtml::listData($data,'value','text');
         echo CHtml::dropDownList('prot_sub_id','', $typelist,array('class'=>'span2','style'=>'margin:0px 10px 0px 10px;')); 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'success',
    'label'=>'เพิ่มข้อมูล',
    'icon'=>'plus-sign',
    'url'=>array('create'),
    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
)); 

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'warning',
    'label'=>'แก้ไขกลุ่มย่อย',
    'icon'=>'ok-sign',
    //'url'=>array('delAll'),
    //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
    'htmlOptions'=>array(
        //'data-toggle'=>'modal',
        //'data-target'=>'#myModal',
        'onclick'=>'      
    
                       if($.fn.yiiGridView.getSelection("product-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการแก้ไข?","ตกลง");
                       else  
                         
			                   	 $.ajax({
										type: "POST",
										url: "updateSubgroupSelected",
										data: { selectedID: $.fn.yiiGridView.getSelection("product-grid"),subgroup:$("#prot_sub_id").val()}
										})
										.done(function( msg ) {
											$("#product-grid").yiiGridView("update",{});
										});
			                 ',
        'class'=>''
    ),
)); 



$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    
    'type'=>'danger',
    'label'=>'ลบข้อมูล',
    'icon'=>'minus-sign',
    //'url'=>array('delAll'),
    //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
    'htmlOptions'=>array(
        //'data-toggle'=>'modal',
        //'data-target'=>'#myModal',
        'onclick'=>'      
    
                       if($.fn.yiiGridView.getSelection("product-grid").length==0)
                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
                       else  
                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
			                   function(confirmed){
			         
                                if(confirmed)
			                   	 $.ajax({
										type: "POST",
										url: "deleteSelected",
										data: { selectedID: $.fn.yiiGridView.getSelection("product-grid")}
										})
										.done(function( msg ) {
											$("#product-grid").yiiGridView("update",{});
										});
			                  })',
        'class'=>'pull-right'
    ),
)); 


$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'type'=>'bordered condensed',
	'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:20px'),
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
		'prod_code'=>array(
			    'name' => 'prod_code',
			    'filter'=>CHtml::activeTextField($model, 'prod_code',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("prod_code"))),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
		'prod_name'=>array(
			    'name' => 'prod_name',
			    'filter'=>CHtml::activeTextField($model, 'prod_name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("prod_name"))),
				'headerHtmlOptions' => array('style' => 'width:29%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left')
	  	),
	  	// 'prot_id'=>array(
			 //    'name' => 'prot_id',
			 //    //'filter'=>CHtml::activeTextField($model, 'prot_id',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("prot_id"))),
				// 'filter'=>CHtml::activeDropDownList($model, 'prot_id', $typelist2,array('empty'=>'')),
				// 'headerHtmlOptions' => array('style' => 'width:12%;text-align:center;background-color: #f5f5f5'),  	
				// 'value' => array($model,'getProdtype'),            	  	
				// 'htmlOptions'=>array('style'=>'text-align:center')
	  	// ),
	  	// 'protsub_id'=>array(
			 //    'name' => 'prot_sub_id',
			 //    'filter'=>false,
			 //    //'filter'=>CHtml::activeTextField($model, 'prot_id',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("prot_id"))),
				// 'headerHtmlOptions' => array('style' => 'width:12%;text-align:center;background-color: #f5f5f5'),  	
				// 'value' => array($model,'getProdsubtype'),            	  	
				// 'htmlOptions'=>array('style'=>'text-align:center')
	  	// ),
	  	'price'=>array(
			    'name' => 'price',
			    'filter'=>CHtml::activeTextField($model, 'price',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("price"))),
				'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:right;')
	  	),
	  	'factor'=>array(
			    'name' => 'factor',
			    'filter'=>CHtml::activeTextField($model, 'factor',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("factor"))),
				'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
	  	'prod_sizename'=>array(
			    'name' => 'prod_sizename',
			    'filter'=>CHtml::activeTextField($model, 'prod_sizename',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("prod_sizename"))),
				'headerHtmlOptions' => array('style' => 'width:12%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center')
	  	),
	  	'prod_unit'=>array(
			    'name' => 'prod_unit',
			    'filter'=>CHtml::activeTextField($model, 'prod_unit',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("prod_unit"))),
				'headerHtmlOptions' => array('style' => 'width:7%;text-align:center;background-color: #f5f5f5'),  	            	  	
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
