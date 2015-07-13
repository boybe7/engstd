<?php
$this->breadcrumbs=array(
	'Contractors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Contractor','url'=>array('index')),
	array('label'=>'Manage Contractor','url'=>array('admin')),
);
?>

<h1>Create Contractor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>