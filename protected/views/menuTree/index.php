<?php
$this->breadcrumbs=array(
	'Menu Trees',
);

$this->menu=array(
	array('label'=>'Create MenuTree','url'=>array('create')),
	array('label'=>'Manage MenuTree','url'=>array('admin')),
);
?>

<h1>Menu Trees</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
