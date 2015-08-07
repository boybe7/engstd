<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#con_id,#cust_id,#prot_id,#dept_id,#vend_id").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

  });


</script>
<div class="well">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'inspec-doc-form',
	'enableAjaxValidation'=>false,
	 'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'','style'=>''),
)); ?>
	<h4><?php  echo($title);  ?></h4>
	<hr style="margin-top:-10px;border-top: 1px solid #6F6E6E;">
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<div class="span6">
				<?php echo $form->textFieldRow($model,'doc_no',array('class'=>'span12','maxlength'=>20)); ?>
		</div>	

		<div class="span6">
		        <?php echo $form->labelEx($model,'doc_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
    			<?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'doc_date',
		                        'attribute'=>'doc_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->doc_date),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
		</div>	
		
	</div>	
	
	<div class="row-fluid">
		<div class="span6">
			<?php 

						echo $form->hiddenField($model,'dept_id');
  						echo $form->labelEx($model,'dept_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'dept_id',
                            'id'=>'dept_id',
                            'value'=>$model->dept_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Deptorder/GetDept').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_dept_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
			 ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($model,'doc_refer',array('class'=>'span12','maxlength'=>200)); ?>
		</div>
	</div>		


	<?php 

  //echo $form->textFieldRow($model,'con_id',array('class'=>'span3'));
              echo $form->hiddenField($model,'con_id');
              echo $form->labelEx($model,'con_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:0px'));
               
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'con_id',
                            'id'=>'con_id',
                            'value'=>$model->con_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Contract/GetContract').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_con_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span3'
                            ),
                                  
                        ));


   ?>

	<?php 
    //echo $form->textFieldRow($model,'cust_id',array('class'=>'span6')); 
              echo $form->hiddenField($model,'cust_id');
              echo $form->labelEx($model,'cust_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:0px'));
               
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cust_id',
                            'id'=>'cust_id',
                            'value'=>$model->cust_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Contractor/GetContractor').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_cust_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span6'
                            ),
                                  
                        ));

    ?>

	<?php 

	                    echo $form->hiddenField($model,'vend_id');
  						echo $form->labelEx($model,'vend_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;'));
    					 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'vend_id',
                            'id'=>'vend_id',
                            'value'=>$model->vend_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Vendor/GetVendor').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_vend_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span6'
                            ),
                                  
                        ));

	 ?>

	<?php 

  //echo $form->textFieldRow($model,'prot_id',array('class'=>'span6'));

              echo $form->hiddenField($model,'prot_id');
              echo $form->labelEx($model,'prot_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:0px'));
               
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'prot_id',
                            'id'=>'prot_id',
                            'value'=>$model->prot_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Prodtype/GetType').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_prot_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span6'
                            ),
                                  
                        ));



   ?>

	<?php echo $form->textFieldRow($model,'doc_detail',array('class'=>'span6','maxlength'=>100)); ?>

	<?php
	echo $form->dropDownListRow($model, 'doc_status', array("1"=>"เปิด","2"=>"ปิด","3"=>"ยกเลิก"),array('class'=>'span2','style'=>'height:30px;'), array('options' => array('pj_work_cat'=>array('selected'=>true)))); 
	// echo $form->textFieldRow($model,'doc_status',array('class'=>'span5')); 

	 ?>


<?php $this->endWidget(); ?>
    
<?php 
echo "เอกสารแนบ";
echo '<form action="../inspecFile/createTemp/"  method="post" enctype="multipart/form-data" id="inspec-doc-form-upload">';
echo '<input type="file" name="file-attach">';
//echo CHtml::submitButton('Submit');  
 $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link',
            'type'=>'success',
            'label'=>'upload',
            'htmlOptions'=>array(
                'onclick'=>'
                    var formData = new FormData($("#inspec-doc-form-upload")[0]);
                    formData.append("file_attach", $("input[name=file-attach]")[0].files[0]);
                    //console.log($("input[name=file-attach]")[0].files[0])
                    $.ajax({
                            type: "POST",
                            processData : false,
                            contentType : false,
                            url: "../inspecFile/createTemp/",
                            dataType:"json",
                            data: formData
                    })                                  
                    .done(function( msg ) {
                            //console.log(msg)
                             jQuery.fn.yiiGridView.update("upload-grid");
                    });

                '
            )    
        )); 

echo '</form>'; 

$this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'upload-grid',
                    
                    'type'=>'bordered condensed',
                    'dataProvider'=>InspecFileTemp::model()->searchByUser(Yii::app()->user->ID),
                    //'filter'=>$model,
                    'selectableRows' => 2,
                    'enableSorting' => false,
                    'rowCssClassExpression'=>'"tr_white"',
                    'htmlOptions'=>array('style'=>'padding-bottom:10px;width:50%'),
                    'enablePagination' => false,
                    'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
                    'columns'=>array(
                            
                            'detail'=>array(
                                //'type'=>'raw',
                                'header'=>'',
                               // 'value'=>'CHtml::link($data->ins_file, "download", array("id"=>$data->ins_id)',

                                'name' => 'ins_file',

                                'headerHtmlOptions' => array('style' => 'width:87%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:left'

                                )
                            ),
                            
                            array(
                                'class'=>'bootstrap.widgets.TbButtonColumn',
                                'headerHtmlOptions' => array('style' => 'width:13%;text-align:center;background-color: #eeeeee'),
                                'template' => '{view} {delete}',
                                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                                'buttons'=>array(
                                        'delete'=>array(
                                            'url'=>'Yii::app()->createUrl("InspecFile/deleteTemp", array("id"=>$data->ins_id))', 

                                        ),
                                        'view'=>array(
                                            'url'=>'Yii::app()->createUrl("InspecFile/downloadTemp", array("id"=>$data->ins_id))', 

                                        )

                                    )

                                
                            ),
                        )

                    ));


// $formUpload = $form->beginWidget('bootstrap.widgets.TbActiveForm',array(
//     'id'=>'inspec-doc-form-upload',
//     'htmlOptions' => array('enctype' => 'multipart/form-data'),
// ));

//echo $formUpload->fileFieldRow($model2, 'ins_file'); 
?>



	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'บันทึก' : 'Save',
      'htmlOptions'=>array(
                'onclick'=>'
                    $("#inspec-doc-form").submit();
                '
                )
		)); ?>
	</div>

</div>