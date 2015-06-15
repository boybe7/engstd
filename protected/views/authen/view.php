<?php
$this->breadcrumbs=array(
	'Authens'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Authen','url'=>array('index')),
	array('label'=>'Create Authen','url'=>array('create')),
	array('label'=>'Update Authen','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Authen','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Authen','url'=>array('admin')),
);
?>

<h1>View Authen #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'menu_id',
		'group_id',
	),
)); ?>
