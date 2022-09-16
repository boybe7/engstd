<?php
$this->breadcrumbs=array(
	'Cer Files'=>array('index')
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cer-file-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#cerID").autocomplete({
       
                minLength: 2
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

 
  });


</script>

<h3>เอกสารใบรับรองคุณภาพ</h3>


<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cer-file-form',
	'enableAjaxValidation'=>false,
)); 
 				echo CHtml::label('เลขที่ใบรับรอง *','checkbox-id');
                  echo $form->hiddenField($model,'cer_id');
                  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cer_id',
                            'id'=>'cer_id',
                            'value'=>'',                      
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('CerDoc/GetCerNo').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                      
                                    },
                                    success: function (data) {
                                            response(data);

                                        //console.log("load source")
                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>2,
                                     'select'=>'js: function(event, ui) {
                                         $("#CerFile_cer_id").val(ui.item.id);
                                         $("#cid").val(ui.item.id);
                                         $("#cid2").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span5'
                            ),
                                  
                        ));

   $this->endWidget();           


echo "เอกสารใบรับรอง";
echo '<form action="../cerFile/createTemp/"  method="post" enctype="multipart/form-data" id="inspec-doc-form-upload2">';
echo '<input type="hidden" name="type" value="0">';
echo '<input type="hidden" name="cid" id="cid">';
echo '<input type="file" name="file-attach" name="file-attach2">';
//echo CHtml::submitButton('Submit');  
 $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link',
            'type'=>'success',
            'label'=>'upload',
            'htmlOptions'=>array(
                'onclick'=>'
                    var formData = new FormData($("#inspec-doc-form-upload2")[0]);
                    formData.append("file_attach", $("input[name=file-attach]")[0].files[0]);
                    //console.log($("input[name=file-attach]")[0].files[0])
                    $.ajax({
                            type: "POST",
                            processData : false,
                            contentType : false,
                            url: "../cerFile/create/",
                            dataType:"json",
                            data: formData
                    })                                  
                    .done(function( msg ) {
                            //console.log(msg)
                    	$("input[name=file-attach]").val("").clone(true);
                             jQuery.fn.yiiGridView.update("cer-file-grid");
                    });

                '
            )    
        )); 

echo '</form><br>'; 


echo "เอกสารอื่น ๆ";
echo '<form action="../cerFile/createTemp/"  method="post" enctype="multipart/form-data" id="inspec-doc-form-upload">';
echo '<input type="hidden" name="type" value="1">';
echo '<input type="hidden" name="cid" id="cid2">';
echo '<input type="file" name="file-attach2" id="file-attach2" >';
//echo CHtml::submitButton('Submit');  
 $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link',
            'type'=>'success',
            'label'=>'upload',
            'htmlOptions'=>array(
                'onclick'=>'
                    var formData = new FormData($("#inspec-doc-form-upload")[0]);
                    formData.append("file_attach", $("input[name=file-attach2]")[0].files[0]);
                    //console.log($("input[name=file-attach]")[0].files[0])
                    $("input[name=file-attach]").val("").clone(true);
                    $.ajax({
                            type: "POST",
                            processData : false,
                            contentType : false,
                            url: "../cerFile/create2/",
                            dataType:"json",
                            data: formData
                    })                                  
                    .done(function( msg ) {
                            //console.log(msg)
                    	$("input[name=file-attach2]").val("").clone(true);
                             jQuery.fn.yiiGridView.update("cer-file-grid");
                    });

                '
            )    
        )); 

echo '</form>'; 

// $this->widget('bootstrap.widgets.TbButton', array(
//     'buttonType'=>'link',
    
//     'type'=>'success',
//     'label'=>'เพิ่มข้อมูล',
//     'icon'=>'plus-sign',
//     'url'=>array('create'),
//     'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:0px 10px 0px 10px;'),
// )); 

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cer-file-grid',
	'dataProvider'=>$model->search(),
	'type'=>'bordered condensed',
	'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:40px'),
    'enablePagination' => true,
    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
	'columns'=>array(
		'checkbox'=> array(
        	    'id'=>'selectedID',
            	'class'=>'CCheckBoxColumn',
            	//'selectableRows' => 2, 
        		 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #f5f5f5'),
	  	         'htmlOptions'=>array(
	  	            	  			'style'=>'text-align:center'

	  	            	  		)   	  		
        ),
        'cer'=>array(
                                //'type'=>'raw',
                                'header'=>'เลขที่ใบรับรอง',
                               // 'value'=>'CHtml::link($data->ins_file, "download", array("id"=>$data->ins_id)',

                                'name' => 'cer_id',

                                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:left'

                                )
                            ),
		'detail'=>array(
                                //'type'=>'raw',
                                'header'=>'ชื่อไฟล์',
                               // 'value'=>'CHtml::link($data->ins_file, "download", array("id"=>$data->ins_id)',

                                'name' => 'filename',
                                
                                'headerHtmlOptions' => array('style' => 'width:55%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:left'

                                )
                            ),
                            'type'=>array(
                                //'type'=>'raw',
                                'header'=>'ประเภท',
                               // 'value'=>'CHtml::link($data->ins_file, "download", array("id"=>$data->ins_id)',

                                'name' => 'type',
                                'value' => array($model,'getType'),
                                 'filter'=>CHtml::activeDropDownList($model, 'type', array('0' => 'เอกสารใบรับรองคุณภาพ', '1'=>'เอกสารอื่น ๆ'),array('empty'=>'')),
                                'headerHtmlOptions' => array('style' => 'width:17%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:center'

                                )
                            ),
                            
                            array(
                                'class'=>'bootstrap.widgets.TbButtonColumn',
                                'headerHtmlOptions' => array('style' => 'width:13%;text-align:center;background-color: #eeeeee'),
                                'template' => '{view}{delete}',
                                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                                'buttons'=>array(
                                        'delete'=>array(
                                            'url'=>'Yii::app()->createUrl("CerFile/delete", array("id"=>$data->id))', 

                                        ),
                                        'view'=>array(
                                            'url'=>'Yii::app()->createUrl("CerFile/download", array("id"=>$data->id))', 

                                        )

                                    )

                                
                            ),
	),
));



?>
