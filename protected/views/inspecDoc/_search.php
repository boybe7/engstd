<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'doc_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'doc_no',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'doc_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'dept_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'doc_refer',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'con_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cust_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'vend_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'prot_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'doc_detail',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'u_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'doc_date_add',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'doc_status',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
