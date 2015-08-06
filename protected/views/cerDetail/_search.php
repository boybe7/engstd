<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'detail_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cer_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prot_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prod_size',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'quantity',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'serialno',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
