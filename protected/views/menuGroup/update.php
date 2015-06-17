<?php
$this->breadcrumbs=array(
	'Menu Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MenuGroup','url'=>array('index')),
	array('label'=>'Create MenuGroup','url'=>array('create')),
	array('label'=>'View MenuGroup','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage MenuGroup','url'=>array('admin')),
);
?>

<h1>Update MenuGroup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>