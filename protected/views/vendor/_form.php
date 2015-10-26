<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vendor-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>  array('class'=>'well','style'=>''),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
					
					//$typelist = CHtml::listData(array('' => , );,'id','name');
	//$model->type =  $model->type =="ผู้ผลิต" ? 0 : 1;
    echo $form->dropDownListRow($model, 'type', array('0' => 'ผู้ผลิต', '1' => 'ผู้จัดส่ง'),array('class'=>'span2'), array('options' => array('type'=>array('selected'=>true)))); 
             

	?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>500)); ?>
	<?php echo $form->textFieldRow($model,'shortname',array('class'=>'span3','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textAreaRow($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'บันทึก',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
