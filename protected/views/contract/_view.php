<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('con_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->con_id),array('view','id'=>$data->con_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('con_number')); ?>:</b>
	<?php echo CHtml::encode($data->con_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('con_price')); ?>:</b>
	<?php echo CHtml::encode($data->con_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('con_budget')); ?>:</b>
	<?php echo CHtml::encode($data->con_budget); ?>
	<br />


</div>