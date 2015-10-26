<?php
$this->breadcrumbs=array(
	'Prodtype Subgroups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProdtypeSubgroup','url'=>array('index')),
	array('label'=>'Create ProdtypeSubgroup','url'=>array('create')),
	array('label'=>'Update ProdtypeSubgroup','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProdtypeSubgroup','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProdtypeSubgroup','url'=>array('admin')),
);
?>

<h1>View ProdtypeSubgroup #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'prod_id',
	),
)); ?>
