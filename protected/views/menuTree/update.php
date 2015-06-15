<?php
$this->breadcrumbs=array(
	'Menu Trees'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MenuTree','url'=>array('index')),
	array('label'=>'Create MenuTree','url'=>array('create')),
	array('label'=>'View MenuTree','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage MenuTree','url'=>array('admin')),
);
?>

<h1>Update MenuTree <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>