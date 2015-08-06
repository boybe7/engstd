<?php
$this->breadcrumbs=array(
	'Cer Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CerDetail','url'=>array('index')),
	array('label'=>'Manage CerDetail','url'=>array('admin')),
);
?>

<h1>Create CerDetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>