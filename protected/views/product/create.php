<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);


?>

<h3>เพิ่มรายละเอียดท่อและอุปกรณ์</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>