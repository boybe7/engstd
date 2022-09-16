<?php
$this->breadcrumbs=array(
	'Cer Files'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CerFile','url'=>array('index')),
	array('label'=>'Create CerFile','url'=>array('create')),
	array('label'=>'View CerFile','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CerFile','url'=>array('admin')),
);
?>

<h1>Update CerFile <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>