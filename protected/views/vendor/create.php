<?php
$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Vendor','url'=>array('index')),
	array('label'=>'Manage Vendor','url'=>array('admin')),
);
?>

<h3>เพิ่มผู้ผลิต/ผู้จัดส่ง</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>