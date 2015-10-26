<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contract-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>  array('class'=>'well','style'=>''),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldRow($model,'con_number',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'con_price',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'con_budget',array('class'=>'span5','maxlength'=>10)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
