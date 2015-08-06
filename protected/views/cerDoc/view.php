<?php
$this->breadcrumbs=array(
	'Cer Docs'=>array('index'),
	$model->cer_id,
);

$this->menu=array(
	array('label'=>'List CerDoc','url'=>array('index')),
	array('label'=>'Create CerDoc','url'=>array('create')),
	array('label'=>'Update CerDoc','url'=>array('update','id'=>$model->cer_id)),
	array('label'=>'Delete CerDoc','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->cer_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CerDoc','url'=>array('admin')),
);
?>

<h1>View CerDoc #<?php echo $model->cer_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'cer_id',
		'cer_no',
		'doc_id',
		'vend_id',
		'cer_date',
		'cer_oper_date',
		'cer_name',
		'cer_ct_name',
		'cer_di_name',
		'cer_notes',
		'cer_status',
		'cer_date_add',
	),
)); ?>
