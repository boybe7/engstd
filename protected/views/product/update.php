<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Update',
);


?>

<h3>แก้ไขรายละเอียดท่อและอุปกรณ์</h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>