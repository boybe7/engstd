<?php
$this->breadcrumbs=array(
	'Inspec Docs',
);

$this->menu=array(
	array('label'=>'Create InspecDoc','url'=>array('create')),
	array('label'=>'Manage InspecDoc','url'=>array('admin')),
);
?>

<h1>Inspec Docs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
