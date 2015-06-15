<?php
$this->breadcrumbs=array(
	'Authens'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Authen','url'=>array('index')),
	array('label'=>'Create Authen','url'=>array('create')),
	array('label'=>'View Authen','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Authen','url'=>array('admin')),
);
?>

<h1>Update Authen <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>