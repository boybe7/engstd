<?php
$this->breadcrumbs=array(
	'Cer Files'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CerFile','url'=>array('index')),
	array('label'=>'Manage CerFile','url'=>array('admin')),
);
?>

<h3>เพิ่มเอกสารใบรับรองคุณภาพ</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>