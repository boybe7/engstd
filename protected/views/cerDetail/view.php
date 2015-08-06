<?php
$this->breadcrumbs=array(
	'Cer Details'=>array('index'),
	$model->detail_id,
);

$this->menu=array(
	array('label'=>'List CerDetail','url'=>array('index')),
	array('label'=>'Create CerDetail','url'=>array('create')),
	array('label'=>'Update CerDetail','url'=>array('update','id'=>$model->detail_id)),
	array('label'=>'Delete CerDetail','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->detail_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CerDetail','url'=>array('admin')),
);
?>

<h1>View CerDetail #<?php echo $model->detail_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'detail_id',
		'cer_id',
		'prot_id',
		'prod_size',
		'quantity',
		'serialno',
		'user_id',
	),
)); ?>
