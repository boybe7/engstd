<?php
$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	'Create',
);


?>

<h3>เพิ่มสัญญา</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>