<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->prod_id),array('view','id'=>$data->prod_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_code')); ?>:</b>
	<?php echo CHtml::encode($data->prod_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_name')); ?>:</b>
	<?php echo CHtml::encode($data->prod_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prot_id')); ?>:</b>
	<?php echo CHtml::encode($data->prot_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_size')); ?>:</b>
	<?php echo CHtml::encode($data->prod_size); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_unit')); ?>:</b>
	<?php echo CHtml::encode($data->prod_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_sizename')); ?>:</b>
	<?php echo CHtml::encode($data->prod_sizename); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_size1')); ?>:</b>
	<?php echo CHtml::encode($data->prod_size1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_size2')); ?>:</b>
	<?php echo CHtml::encode($data->prod_size2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prod_size3')); ?>:</b>
	<?php echo CHtml::encode($data->prod_size3); ?>
	<br />

	*/ ?>

</div>