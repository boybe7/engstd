<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	 'type'=>'horizontal',
    'htmlOptions'=>  array('class'=>'well','style'=>''),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'prod_code',array('class'=>'span2','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'prod_name',array('class'=>'span5','maxlength'=>200)); ?>

	<?php 

	    $models=Prodtype::model()->findAll();
        $data = array();
        foreach ($models as $key => $value) {
          $data[] = array(
                          'value'=>$value['prot_id'],
                          'text'=>$value['prot_name'],
                       );
        } 
        $typelist = CHtml::listData($data,'value','text');
        echo $form->dropDownListRow($model, 'prot_id', $typelist,array('class'=>'span5','prompt'=>'--กรุณาเลือก--')); 
      
	

	?>

	
	<?php echo $form->textFieldRow($model,'prod_sizename',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'prod_size1',array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($model,'prod_size2',array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($model,'prod_size3',array('class'=>'span2')); ?>
	<?php echo $form->textFieldRow($model,'prod_size',array('class'=>'span2','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'prod_unit',array('class'=>'span2','maxlength'=>200)); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'บันทึก' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
