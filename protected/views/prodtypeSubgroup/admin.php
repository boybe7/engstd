<?php
$this->breadcrumbs=array(
	'ProdtypeSubgroup'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('position-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>กลุ่มย่อยท่อและอุปกรณ์</h3>
<div class="row-fluid">
 
	<div class="span5">
		<?php echo CHtml::textField('newPosition', '',array('class'=>'span12','placeholder'=>'กรอกกลุ่มย่อยท่อและอุปกรณ์')); ?>
	</div>
	<div class="span3">
		<?php 
		$models=Prodtype::model()->findAll();
        $data = array();
        foreach ($models as $key => $value) {
          $data[] = array(
                          'value'=>$value['prot_id'],
                          'text'=>$value['prot_name'],
                       );
        } 
        $typelist = CHtml::listData($data,'value','text');

		echo CHtml::dropDownList('prot_id', '',$typelist,array('class'=>'span12'));

               ?>
	</div>
	<div class="span2">
		<?php
		$this->widget('bootstrap.widgets.TbButton', array(
		    'buttonType'=>'ajaxLink',
		    
		    'type'=>'success',
		    'label'=>'เพิ่มกลุ่ม',
		    'icon'=>'plus-sign',
		    'url'=>array('create'),
		    'htmlOptions'=>array('class'=>'span12','style'=>''),
		    'ajaxOptions'=>array(
		    	    //'url'=>$this->createUrl('create'),
		     	    'type' => 'POST',
                	'data' => array('name' => 'js:$("#newPosition").val()','prot_id' => 'js:$("#prot_id").val()'),
                	'success' => 'function(html){ $("#newPosition").val(""); $.fn.yiiGridView.update("position-grid"); }'
                ) 
		)); 




		?>
	</div>	
	<div class="span2">	
		<?php
		   $this->widget('bootstrap.widgets.TbButton', array(
			    'buttonType'=>'link',
			    
			    'type'=>'danger',
			    'label'=>'ลบกลุ่ม',
			    'icon'=>'minus-sign',
			    //'url'=>array('delAll'),
			    //'htmlOptions'=>array('id'=>"buttonDel2",'class'=>'pull-right'),
			    'htmlOptions'=>array(
			        //'data-toggle'=>'modal',
			        //'data-target'=>'#myModal',
			        'onclick'=>'      

			                       if($.fn.yiiGridView.getSelection("position-grid").length==0)
			                       		js:bootbox.alert("กรุณาเลือกแถวข้อมูลที่ต้องการลบ?","ตกลง");
			                       else  
			                          js:bootbox.confirm("คุณต้องการจะลบข้อมูล?","ยกเลิก","ตกลง",
						                   function(confirmed){
						               
			                                if(confirmed)
						                   	 $.ajax({
													type: "POST",
													url: "deleteSelected",
													data: { selectedID: $.fn.yiiGridView.getSelection("position-grid")}
													})
													.done(function( msg ) {
														$("#position-grid").yiiGridView("update",{});
													});
						                  })',
			        'class'=>'span12'
			    ),
			)); 
		?>
	</div>	
</div>

<?php 



$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'position-grid',
	'dataProvider'=>$model->search(),
	'type'=>'bordered condensed',
	'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:0px'),
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
		'name'=>array(
			    'name' => 'name',
			    'class' => 'editable.EditableColumn',
			    //'filter'=>CHtml::activeTextField($model, 'v_name',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("v_name"))),
				'headerHtmlOptions' => array('style' => 'width:60%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:left;padding-left:10px;'),
				'editable' => array( //editable section
					//'apply' => '$data->user_status != 4', //can't edit deleted users
					//'text'=>'Click',
					//'tooltip'=>'Click',
					'title'=>'แก้ไขกลุ่มย่อย',
					'url' => $this->createUrl('update'),
					'success' => 'js: function(response, newValue) {
									if(!response.success) return response.msg;

										$("#position-grid").yiiGridView("update",{});
									}',
					'options' => array(
						'ajaxOptions' => array('dataType' => 'json'),

					), 
					'placement' => 'right',
					'display' => 'js: function() {
					    
					    //$(this).attr( "rel", "tooltip");
					    //$(this).attr( "data-original-title", "คลิกเพื่อแก้ไข");
					    
					}'
				)
	  	),
		'prod_id'=>array(
	  	            	  		'header'=>'ชนิดท่อ/อุปกรณ์',
	  	            	  		'class' => 'editable.EditableColumn',
                                'headerHtmlOptions' => array('style' => 'width:40%;text-align:center;background-color: #f5f5f5'),
	  	            	  		'name'=> 'prod_id',
	  	            	  		//'value'=>'$data->getGroupName($data->u_group)',
	  	            	  		'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		),
	  	            	  		 'editable' => array(
										'type' => 'select',
										'title'=>'แก้ไขชนิดท่อ/อุปกรณ์',
										'url' => $this->createUrl('prodtypeSubgroup/update'),
										'source' => $this->createUrl('prodtypeSubgroup/getType'),
										'options' => array( //custom display
											'display' => 'js: function(value, sourceData) {

												var selected = $.grep(sourceData, function(o){ return o.value == value; });
												
												
												colors = {1: "green", 2: "blue", 3: "purple", 4: "gray"};
												$(this).text(selected[0].text).css("color", colors[value]);
												//$(this).attr( "title", "คลิกเพื่อแก้ไข");
												$(this).attr( "rel", "tooltip");
					    						$(this).attr( "data-original-title", "คลิกเพื่อแก้ไข");
											}'
										),
										//onsave event handler
										'onSave' => 'js: function(e, params) {
												//console && console.log("saved value: "+params.newValue);
											}',
									
								)
	  	            	  	),
	),
));


?>
