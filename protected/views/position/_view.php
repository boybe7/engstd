<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('posi_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->posi_id),array('view','id'=>$data->posi_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posi_name')); ?>:</b>
	<?php echo CHtml::encode($data->posi_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posi_status')); ?>:</b>
	<?php echo CHtml::encode($data->posi_status); ?>
	<br />


</div>