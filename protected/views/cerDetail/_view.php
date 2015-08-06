<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->detail_id),array('view','id'=>$data->detail_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cer_id')); ?>:</b>
	<?php echo CHtml::encode($data->cer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prot_id')); ?>:</b>
	<?php echo CHtml::encode($data->prot_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_size')); ?>:</b>
	<?php echo CHtml::encode($data->prod_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('serialno')); ?>:</b>
	<?php echo CHtml::encode($data->serialno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />


</div>