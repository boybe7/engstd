<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contract-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>  array('class'=>'well','style'=>''),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'con_number',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'con_price',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'con_budget',array('class'=>'span5','maxlength'=>50));
       echo $form->dropDownListRow($model, 'con_status', array("0"=>"เปิด","1"=>"ปิด"),array('class'=>'span2','style'=>'height:30px;'), array('options' => array('con_status'=>array('selected'=>true)))); 
	
	 ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
