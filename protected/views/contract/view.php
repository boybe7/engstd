<?php
$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->con_id,
);

$this->menu=array(
	array('label'=>'List Contract','url'=>array('index')),
	array('label'=>'Create Contract','url'=>array('create')),
	array('label'=>'Update Contract','url'=>array('update','id'=>$model->con_id)),
	array('label'=>'Delete Contract','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->con_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contract','url'=>array('admin')),
);
?>

<h1>View Contract #<?php echo $model->con_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'con_id',
		'con_number',
		'con_price',
		'con_budget',
	),
)); ?>
