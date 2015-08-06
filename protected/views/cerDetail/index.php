<?php
$this->breadcrumbs=array(
	'Cer Details',
);

$this->menu=array(
	array('label'=>'Create CerDetail','url'=>array('create')),
	array('label'=>'Manage CerDetail','url'=>array('admin')),
);
?>

<h1>Cer Details</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
