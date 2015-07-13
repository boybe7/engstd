<?php
$this->breadcrumbs=array(
	'Contractors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Contractor','url'=>array('index')),
	array('label'=>'Create Contractor','url'=>array('create')),
	array('label'=>'Update Contractor','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Contractor','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contractor','url'=>array('admin')),
);
?>

<h1>View Contractor #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
		'address',
	),
)); ?>
