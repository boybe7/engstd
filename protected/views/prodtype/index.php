<?php
$this->breadcrumbs=array(
	'Prodtypes',
);

$this->menu=array(
	array('label'=>'Create Prodtype','url'=>array('create')),
	array('label'=>'Manage Prodtype','url'=>array('admin')),
);
?>

<h1>Prodtypes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
