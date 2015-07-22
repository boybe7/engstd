<?php
$this->breadcrumbs=array(
	'Positions'=>array('index'),
	$model->posi_id,
);

$this->menu=array(
	array('label'=>'List Position','url'=>array('index')),
	array('label'=>'Create Position','url'=>array('create')),
	array('label'=>'Update Position','url'=>array('update','id'=>$model->posi_id)),
	array('label'=>'Delete Position','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->posi_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Position','url'=>array('admin')),
);
?>

<h1>View Position #<?php echo $model->posi_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'posi_id',
		'posi_name',
		'posi_status',
	),
)); ?>
