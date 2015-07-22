<?php
$this->breadcrumbs=array(
	'Contracts'=>array('index'),
	$model->con_id=>array('view','id'=>$model->con_id),
	'Update',
);


?>

<h3>แก้ไขสัญญา</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>