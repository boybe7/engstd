<?php
$this->breadcrumbs=array(
	'Contractors',
);

$this->menu=array(
	array('label'=>'Create Contractor','url'=>array('create')),
	array('label'=>'Manage Contractor','url'=>array('admin')),
);
?>

<h1>Contractors</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
