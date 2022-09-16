<?php
$this->breadcrumbs=array(
	'Cer Files',
);

$this->menu=array(
	array('label'=>'Create CerFile','url'=>array('create')),
	array('label'=>'Manage CerFile','url'=>array('admin')),
);
?>

<h1>Cer Files</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
