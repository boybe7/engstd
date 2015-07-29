<?php
$this->breadcrumbs=array(
	'Inspec Docs'=>array('index'),
	$model->doc_id=>array('view','id'=>$model->doc_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InspecDoc','url'=>array('index')),
	array('label'=>'Create InspecDoc','url'=>array('create')),
	array('label'=>'View InspecDoc','url'=>array('view','id'=>$model->doc_id)),
	array('label'=>'Manage InspecDoc','url'=>array('admin')),
);
?>

<h1>Update InspecDoc <?php echo $model->doc_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>