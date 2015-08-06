<?php
$this->breadcrumbs=array(
	'Cer Docs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CerDoc','url'=>array('index')),
	array('label'=>'Manage CerDoc','url'=>array('admin')),
);
?>

<h1>Create CerDoc</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>