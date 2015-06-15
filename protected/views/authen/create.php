<?php
$this->breadcrumbs=array(
	'Authens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Authen','url'=>array('index')),
	array('label'=>'Manage Authen','url'=>array('admin')),
);
?>

<h1>Create Authen</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>