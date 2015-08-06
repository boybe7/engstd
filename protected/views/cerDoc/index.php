<?php
$this->breadcrumbs=array(
	'Cer Docs',
);

$this->menu=array(
	array('label'=>'Create CerDoc','url'=>array('create')),
	array('label'=>'Manage CerDoc','url'=>array('admin')),
);
?>

<h1>Cer Docs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
