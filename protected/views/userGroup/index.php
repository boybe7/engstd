<?php
$this->breadcrumbs=array(
	'User Groups',
);

$this->menu=array(
	array('label'=>'Create UserGroup','url'=>array('create')),
	array('label'=>'Manage UserGroup','url'=>array('admin')),
);
?>

<h1>User Groups</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
