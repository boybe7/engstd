<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->prod_id,
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'Update Product','url'=>array('update','id'=>$model->prod_id)),
	array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->prod_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->prod_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'prod_id',
		'prod_code',
		'prod_name',
		'prot_id',
		'prod_size',
		'prod_unit',
		'prod_sizename',
		'prod_size1',
		'prod_size2',
		'prod_size3',
	),
)); ?>
