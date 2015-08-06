<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cer_id),array('view','id'=>$data->cer_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_no')); ?>:</b>
	<?php echo CHtml::encode($data->cer_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_id')); ?>:</b>
	<?php echo CHtml::encode($data->doc_id); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_ct_name')); ?>:</b>
	<?php echo CHtml::encode($data->cer_ct_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_di_name')); ?>:</b>
	<?php echo CHtml::encode($data->cer_di_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_notes')); ?>:</b>
	<?php echo CHtml::encode($data->cer_notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_status')); ?>:</b>
	<?php echo CHtml::encode($data->cer_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_date_add')); ?>:</b>
	<?php echo CHtml::encode($data->cer_date_add); ?>
	<br />

	*/ ?>

</div>