<?php
$this->breadcrumbs=array(
	'Cer Docs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CerDoc','url'=>array('index')),
	array('label'=>'Create CerDoc','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cer-doc-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cer Docs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cer-doc-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cer_id',
		'cer_no',
		'doc_id',
		'vend_id',
		'cer_date',
		'cer_oper_date',
		/*
		'cer_name',
		'cer_ct_name',
		'cer_di_name',
		'cer_notes',
		'cer_status',
		'cer_date_add',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
