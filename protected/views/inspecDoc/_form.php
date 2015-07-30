<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#dept_id").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

        $("#vend_id").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });     
 
  });


</script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'inspec-doc-form',
	'enableAjaxValidation'=>false,
	 'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'well','style'=>''),
)); ?>
	<h4><?php echo($title);?></h4>
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


	<?php echo $form->textFieldRow($model,'con_id',array('class'=>'span3')); ?>

	<?php echo $form->textFieldRow($model,'cust_id',array('class'=>'span6')); ?>

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

	<?php echo $form->textFieldRow($model,'prot_id',array('class'=>'span6')); ?>

	<?php echo $form->textFieldRow($model,'doc_detail',array('class'=>'span6','maxlength'=>100)); ?>

	<?php
	echo $form->dropDownListRow($model, 'doc_status', array("1"=>"เปิด","2"=>"ปิด","3"=>"ยกเลิก"),array('class'=>'span2','style'=>'height:30px;'), array('options' => array('pj_work_cat'=>array('selected'=>true)))); 
	// echo $form->textFieldRow($model,'doc_status',array('class'=>'span5')); 

	 ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'บันทึก' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
