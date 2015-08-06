<?php
$this->breadcrumbs=array(
	'Cer Docs'=>array('index'),
	$model->cer_id=>array('view','id'=>$model->cer_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CerDoc','url'=>array('index')),
	array('label'=>'Create CerDoc','url'=>array('create')),
	array('label'=>'View CerDoc','url'=>array('view','id'=>$model->cer_id)),
	array('label'=>'Manage CerDoc','url'=>array('admin')),
);
?>

<h1>Update CerDoc <?php echo $model->cer_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>