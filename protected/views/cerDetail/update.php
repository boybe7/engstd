<?php
$this->breadcrumbs=array(
	'Cer Details'=>array('index'),
	$model->detail_id=>array('view','id'=>$model->detail_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CerDetail','url'=>array('index')),
	array('label'=>'Create CerDetail','url'=>array('create')),
	array('label'=>'View CerDetail','url'=>array('view','id'=>$model->detail_id)),
	array('label'=>'Manage CerDetail','url'=>array('admin')),
);
?>

<h1>Update CerDetail <?php echo $model->detail_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>