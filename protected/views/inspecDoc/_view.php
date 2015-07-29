<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->doc_id),array('view','id'=>$data->doc_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_no')); ?>:</b>
	<?php echo CHtml::encode($data->doc_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_date')); ?>:</b>
	<?php echo CHtml::encode($data->doc_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dept_id')); ?>:</b>
	<?php echo CHtml::encode($data->dept_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_refer')); ?>:</b>
	<?php echo CHtml::encode($data->doc_refer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('con_id')); ?>:</b>
	<?php echo CHtml::encode($data->con_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cust_id')); ?>:</b>
	<?php echo CHtml::encode($data->cust_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vend_id')); ?>:</b>
	<?php echo CHtml::encode($data->vend_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prot_id')); ?>:</b>
	<?php echo CHtml::encode($data->prot_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_detail')); ?>:</b>
	<?php echo CHtml::encode($data->doc_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('u_id')); ?>:</b>
	<?php echo CHtml::encode($data->u_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_date_add')); ?>:</b>
	<?php echo CHtml::encode($data->doc_date_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doc_status')); ?>:</b>
	<?php echo CHtml::encode($data->doc_status); ?>
	<br />

	*/ ?>

</div>