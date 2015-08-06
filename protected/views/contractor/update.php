<?php
$this->breadcrumbs=array(
	'Contractors'=>array('index'),
	'Update',
);


?>

<h3>แก้ไขคู่สัญญา</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>