<?php
$this->breadcrumbs=array(
	'Contractors'=>array('index'),
	'Create',
);

?>

<h3>เพิ่มคู่สัญญา</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>