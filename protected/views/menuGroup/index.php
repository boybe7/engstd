<?php
$this->breadcrumbs=array(
	'Menu Groups',
);

$this->menu=array(
	array('label'=>'Create MenuGroup','url'=>array('create')),
	array('label'=>'Manage MenuGroup','url'=>array('admin')),
);
?>

<h1>Menu Groups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
