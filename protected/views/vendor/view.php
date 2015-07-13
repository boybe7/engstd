<?php
$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Vendor','url'=>array('index')),
	array('label'=>'Create Vendor','url'=>array('create')),
	array('label'=>'Update Vendor','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Vendor','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Vendor','url'=>array('admin')),
);
?>

<h3>ข้อมูลผู้ผลิต/ผู้จัดส่ง #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'code',
		'address',
	),
)); ?>
