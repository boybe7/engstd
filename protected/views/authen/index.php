<?php
$this->breadcrumbs=array(
	'Authens',
);

$this->menu=array(
	array('label'=>'Create Authen','url'=>array('create')),
	array('label'=>'Manage Authen','url'=>array('admin')),
);
?>

<h1>Authens</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
