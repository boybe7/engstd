<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'prod_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prod_code',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'prod_name',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'prot_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prod_size',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'prod_unit',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'prod_sizename',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'prod_size1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prod_size2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prod_size3',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
