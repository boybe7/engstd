<?php
$this->breadcrumbs=array(
	'Cer Files'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CerFile','url'=>array('index')),
	array('label'=>'Create CerFile','url'=>array('create')),
	array('label'=>'Update CerFile','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CerFile','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CerFile','url'=>array('admin')),
);
?>

<h1>View CerFile #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cer_id',
		'filename',
		'type',
	),
)); ?>
