<?php
$this->breadcrumbs=array(
	'Inspec Docs'=>array('index'),
	$model->doc_id,
);

$this->menu=array(
	array('label'=>'List InspecDoc','url'=>array('index')),
	array('label'=>'Create InspecDoc','url'=>array('create')),
	array('label'=>'Update InspecDoc','url'=>array('update','id'=>$model->doc_id)),
	array('label'=>'Delete InspecDoc','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->doc_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InspecDoc','url'=>array('admin')),
);
?>

<h1>View InspecDoc #<?php echo $model->doc_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'doc_id',
		'doc_no',
		'doc_date',
		'dept_id',
		'doc_refer',
		'con_id',
		'cust_id',
		'vend_id',
		'prot_id',
		'doc_detail',
		'u_id',
		'doc_date_add',
		'doc_status',
	),
)); ?>
