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


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cer-file-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
                  
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
                                         $("#CerFile_cer_id").val(ui.item.cid);
                                         $("#cid").val(ui.item.cid);
                                         $("#cid2").val(ui.item.cid);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span5'
                            ),
                                  
                        ));

                   ?>


<?php 
$this->endWidget(); 


echo "เอกสารใบรับรองปป";
echo '<form action="../cerFile/createTemp/"  method="post" enctype="multipart/form-data" id="inspec-doc-form-upload2">';
echo '<input type="hidden" name="type" value="0">';
echo '<input type="hidden" name="cid" id="cid">';
echo '<input type="file" name="file-attach">';
//echo CHtml::submitButton('Submit');  
 $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link',
            'type'=>'success',
            'label'=>'upload',
            'htmlOptions'=>array(
                'onclick'=>'
                    var formData = new FormData($("#inspec-doc-form-upload2")[0]);
                    formData.append("file_attach", $("input[name=file-attach]")[0].files[0]);
                    console.log($("input[name=file-attach]")[0].files[0])
                    $.ajax({
                            type: "POST",
                            processData : false,
                            contentType : false,
                            url: "../cerFile/createTemp/",
                            dataType:"json",
                            data: formData
                    })                                  
                    .done(function( msg ) {
                            console.log("cccc"+$("input[name=file-attach]"))
                    	$("input[name=file-attach]").val('').clone(true);

                             jQuery.fn.yiiGridView.update("upload-grid");
                    });

                '
            )    
        )); 

echo '</form><br>'; 


echo "เอกสารอื่น ๆ";
echo '<form action="../cerFile/createTemp/"  method="post" enctype="multipart/form-data" id="inspec-doc-form-upload">';
echo '<input type="hidden" name="type" value="1">';
echo '<input type="hidden" name="cid" id="cid2">';
echo '<input type="file" name="file-attach2">';
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
                    $.ajax({
                            type: "POST",
                            processData : false,
                            contentType : false,
                            url: "../cerFile/createTemp/",
                            dataType:"json",
                            data: formData
                    })                                  
                    .done(function( msg ) {
                            //console.log(msg)
                    	$("input[name=file-attach2]")[0].files[0] = "";
                             jQuery.fn.yiiGridView.update("upload-grid");
                    });

                '
            )    
        )); 

echo '</form>'; 

$this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'upload-grid',
                    
                    'type'=>'bordered condensed',
                    'dataProvider'=>CerFileTemp::model()->searchByUser(Yii::app()->user->ID),
                    //'filter'=>$model,
                    'selectableRows' => 2,
                    'enableSorting' => false,
                    'rowCssClassExpression'=>'"tr_white"',
                    'htmlOptions'=>array('style'=>'padding-bottom:10px;width:80%'),
                    'enablePagination' => false,
                    'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
                    'columns'=>array(
                            
                            'detail'=>array(
                                //'type'=>'raw',
                                'header'=>'ชื่อไฟล์',
                               // 'value'=>'CHtml::link($data->ins_file, "download", array("id"=>$data->ins_id)',

                                'name' => 'filename',

                                'headerHtmlOptions' => array('style' => 'width:60%;text-align:center;background-color: #eeeeee'),                           
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
                                'headerHtmlOptions' => array('style' => 'width:27%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:center'

                                )
                            ),
                            
                            array(
                                'class'=>'bootstrap.widgets.TbButtonColumn',
                                'headerHtmlOptions' => array('style' => 'width:13%;text-align:center;background-color: #eeeeee'),
                                'template' => '{delete}',
                                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                                'buttons'=>array(
                                        'delete'=>array(
                                            'url'=>'Yii::app()->createUrl("CerFile/deleteTemp", array("id"=>$data->id))', 

                                        ),
                                        /*'view'=>array(
                                            'url'=>'Yii::app()->createUrl("CerFile/downloadTemp", array("id"=>$data->id))', 

                                        )*/

                                    )

                                
                            ),
                        )

                    ));
?>
<br>
<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'บันทึก' : 'Save',
      'htmlOptions'=>array(
                'onclick'=>'
                    $("#cer-file-form").submit();
                '
                )
		)); ?>
	</div>