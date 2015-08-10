<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#dept_id,#vend_id,#cer_name,#cer_ct_name,#cer_di_name").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

  });


</script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cer-doc-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'well','style'=>''),
)); ?>
	<h4><?php  echo($title);  ?></h4>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<div class="span3">
			<?php echo $form->textFieldRow($model,'cer_no',array('class'=>'span12','maxlength'=>20)); ?>
		</div>
		<div class="span6">
			 <?php echo $form->labelEx($model,'cer_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
    			<?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'cer_date',
		                        'attribute'=>'cer_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->cer_date, 'disabled' =>true),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
		</div>
	</div>	
	<div class="row-fluid">
		<div class="span8">	
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
                                    url: "'.$this->createUrl('DeptOrder/GetDept').'",
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
                                            $("#CerDoc_dept_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
	

			?>
		</div>
	</div>		

	<div class="row-fluid">
		<div class="span8">	
			<?php 
						echo $form->hiddenField($model,'vend_id');
  						echo $form->labelEx($model,'vend_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
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
                                            $("#CerDoc_vend_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
	

			?>
		</div>
	</div>	

	<div class="row-fluid">
		<div class="span4">	
	<?php 
						  echo $form->labelEx($model,'cer_oper_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));
						 echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'cer_oper_date',
		                        'attribute'=>'cer_oper_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->cer_oper_date),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';
	

	?>

		</div>
	</div>	

	<div class="row-fluid">
		<div class="span8">	
	<?php 
						echo $form->hiddenField($model,'cer_name');
  						echo $form->labelEx($model,'cer_name',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cer_name',
                            'id'=>'cer_name',
                            'value'=>$model->cer_name,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('User/GetName/').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        level: 1
                                       
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
                                            $("#CerDoc_cer_name").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
	
	

	 ?>
	 </div>
	</div>	

	<div class="row-fluid">
		<div class="span8">	
	<?php 
						echo $form->hiddenField($model,'cer_ct_name');
  						echo $form->labelEx($model,'cer_ct_name',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cer_ct_name',
                            'id'=>'cer_ct_name',
                            'value'=>$model->cer_ct_name,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('User/GetName/').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        level: 2
                                       
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
                                            $("#CerDoc_cer_ct_name").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
	
	

	 ?>
	 </div>
	</div>

	<div class="row-fluid">
		<div class="span8">	
	<?php 
						echo $form->hiddenField($model,'cer_di_name');
  						echo $form->labelEx($model,'cer_di_name',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cer_di_name',
                            'id'=>'cer_di_name',
                            'value'=>$model->cer_di_name,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('User/GetName/').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        level: 3
                                       
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
                                            $("#CerDoc_cer_di_name").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
	
	

	 ?>
	 </div>
	</div>

	<?php echo $form->textFieldRow($model,'cer_notes',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'cer_status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cer_date_add',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
