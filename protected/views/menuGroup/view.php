<?php
$this->breadcrumbs=array(
	'Menu Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List MenuGroup','url'=>array('index')),
	array('label'=>'Create MenuGroup','url'=>array('create')),
	array('label'=>'Update MenuGroup','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete MenuGroup','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MenuGroup','url'=>array('admin')),
);
?>

<h1>View MenuGroup #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
