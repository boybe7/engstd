<?php
$this->breadcrumbs=array(
	'Prodtype Subgroups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProdtypeSubgroup','url'=>array('index')),
	array('label'=>'Manage ProdtypeSubgroup','url'=>array('admin')),
);
?>

<h1>Create ProdtypeSubgroup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>