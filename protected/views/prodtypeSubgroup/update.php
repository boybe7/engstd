<?php
$this->breadcrumbs=array(
	'Prodtype Subgroups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProdtypeSubgroup','url'=>array('index')),
	array('label'=>'Create ProdtypeSubgroup','url'=>array('create')),
	array('label'=>'View ProdtypeSubgroup','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ProdtypeSubgroup','url'=>array('admin')),
);
?>

<h1>Update ProdtypeSubgroup <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>