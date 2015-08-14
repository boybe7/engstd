<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cer-detail-form',
	'enableAjaxValidation'=>false,
)); ?>
    
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<?php echo $form->textFieldRow($model,'detail',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'prod_size',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'serialno',array('class'=>'span5','maxlength'=>100)); ?>

	

<?php $this->endWidget(); ?>
