<?php
$this->breadcrumbs=array(
	'Prodtype Subgroups',
);

$this->menu=array(
	array('label'=>'Create ProdtypeSubgroup','url'=>array('create')),
	array('label'=>'Manage ProdtypeSubgroup','url'=>array('admin')),
);
?>

<h1>Prodtype Subgroups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
