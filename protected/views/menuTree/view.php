<?php
$this->breadcrumbs=array(
	'Menu Trees'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List MenuTree','url'=>array('index')),
	array('label'=>'Create MenuTree','url'=>array('create')),
	array('label'=>'Update MenuTree','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete MenuTree','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MenuTree','url'=>array('admin')),
);
?>

<h1>View MenuTree #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'url',
		'parent_id',
	),
)); ?>
