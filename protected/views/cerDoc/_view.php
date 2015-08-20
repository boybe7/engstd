<div class="view">

	
	<?php echo CHtml::link(CHtml::encode($data->cer_id),array('view','id'=>$data->cer_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_no')); ?>:</b>
	<?php echo CHtml::encode($data->cer_no); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('vend_id')); ?>:</b>
	<?php echo CHtml::encode($data->vend_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_date')); ?>:</b>
	<?php echo CHtml::encode($data->cer_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_oper_date')); ?>:</b>
	<?php echo CHtml::encode($data->cer_oper_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_name')); ?>:</b>
	<?php echo CHtml::encode($data->cer_name); ?>
	<br />

	
</div>