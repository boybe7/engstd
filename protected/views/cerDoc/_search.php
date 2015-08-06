<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'cer_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cer_no',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'doc_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'vend_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cer_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cer_oper_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cer_name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'cer_ct_name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'cer_di_name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'cer_notes',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'cer_status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cer_date_add',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
