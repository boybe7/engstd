<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#con_id,#cust_id,#prot_id,#dept_id,#vend_id,#cerID").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

 
  });


</script>
<style type="text/css">
    
.the-legend {
    
    font: 16px/1.6em 'Boon700',sans-serif;
    font-weight: bold;
    margin-bottom: 0;
    width:inherit; /* Or auto */
    padding:0 0px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}
.the-fieldset {
    background-color: whiteSmoke;
    border: 1px solid #E3E3E3;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}
</style>
<div class="well">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'inspec-doc-form',
	'enableAjaxValidation'=>false,
	 'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'','style'=>''),
)); ?>
	<h4><?php 
      echo($title);


  ?></h4>
	<hr style="margin-top:-10px;border-top: 1px solid #6F6E6E;">
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row-fluid">
		<div class="span6">
				<?php 
        echo CHtml::activeHiddenField($model, 'doc_id'); 
        echo $form->textFieldRow($model,'doc_no',array('class'=>'span12','maxlength'=>20)); ?>
		</div>	

		<div class="span6">
		        <?php echo $form->labelEx($model,'doc_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
    			<?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'doc_date',
		                        'attribute'=>'doc_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->doc_date),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
		</div>	
		
	</div>	
	
	<div class="row-fluid">
		<div class="span6">
			<?php 

						echo $form->hiddenField($model,'dept_id');
  						echo $form->labelEx($model,'dept_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
    					 
  						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'dept_id',
                            'id'=>'dept_id',
                            'value'=>$model->dept_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Deptorder/GetDept').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_dept_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
			 ?>
		</div>
		<div class="span4">
			<?php echo $form->textFieldRow($model,'doc_refer',array('class'=>'span12','maxlength'=>200)); ?>
		</div>
	</div>		

  <div class="row-fluid">
        <div class="span6">
	<?php 

  //echo $form->textFieldRow($model,'con_id',array('class'=>'span3'));
              echo $form->hiddenField($model,'con_id');
              echo $form->labelEx($model,'con_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:0px'));
              $m =  Contract::model()->findByPk($model->con_id);
              $contract = !empty($m) ?  $m->con_number : "" ;
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'con_id',
                            'id'=>'con_id',
                            'value'=>$contract,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Contract/GetContract').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_con_id").val(ui.item.label);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));


   ?>
    </div>
        <div class="span2">
            <?php echo $form->textFieldRow($model,'con_no',array('class'=>'span12','maxlength'=>10)); ?>
        </div>
    </div> 

  <?php 
    //echo $form->textFieldRow($model,'cust_id',array('class'=>'span6')); 
              echo $form->hiddenField($model,'cust_id');
              echo $form->labelEx($model,'cust_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:0px'));
              $m =  Contractor::model()->findByPk($model->cust_id);
              $contractor = !empty($m) ?  $m->name : "" ; 
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cust_id',
                            'id'=>'cust_id',
                            'value'=>$contractor, 
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Contractor/GetContractor').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_cust_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span6'
                            ),
                                  
                        ));

    ?>

  <?php 

              echo $form->hiddenField($model,'vend_id');
              echo $form->labelEx($model,'vend_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;'));
              
              //echo "v:".$model->vend_id;
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'vend_id',
                            'id'=>'vend_id',
                            'value'=>$model->vend_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Vendor/GetVendor').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);
                                           

                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_vend_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span6'
                            ),
                                  
                        ));

   ?>

  <?php 

  //echo $form->textFieldRow($model,'prot_id',array('class'=>'span6'));

              echo $form->hiddenField($model,'prot_id');
              echo $form->labelEx($model,'prot_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:0px'));
              $m = Prodtype::model()->findByPk($model->prot_id);   
              $type = !empty($m) ? $m->prot_code."-".$m->prot_name: '';
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'prot_id',
                            'id'=>'prot_id',
                            'value'=>$type,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Prodtype/GetType').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                       
                                    },
                                    success: function (data) {
                                            response(data);
                                           
                                    }
                                })
                             }',
                            // additional javascript options for the autocomplete plugin
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                           //console.log(ui.item.id)
                                            $("#InspecDoc_prot_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span6',
                                'value'=>$model->prot_id,
                            ),
                                  
                        ));



   ?>

	<?php echo $form->textFieldRow($model,'doc_detail',array('class'=>'span6','maxlength'=>100)); ?>

	<?php
	
  if(Yii::app()->user->isExecutive() || Yii::app()->user->isAdmin())
  {  
   echo $form->dropDownListRow($model, 'doc_status', array("1"=>"เปิด","2"=>"ปิด","3"=>"ยกเลิก"),array('class'=>'span2','style'=>'height:30px;'), array('options' => array('pj_work_cat'=>array('selected'=>true)))); 
    
   echo $form->textFieldRow($model,'cancel_remark',array('class'=>'span6')); 
  } 
	 ?>


<?php $this->endWidget(); ?>
    
<?php 
echo "เอกสารแนบ";
echo '<form enctype="multipart/form-data" id="inspec-doc-form-upload">';
echo '<input type="file" name="file-attach">';
//echo CHtml::submitButton('Submit');  
 $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'link',
            'type'=>'success',
            'label'=>'upload',
            'htmlOptions'=>array(
                'onclick'=>'
                    var formData = new FormData($("#inspec-doc-form-upload")[0]);
                    formData.append("file_attach", $("input[name=file-attach]")[0].files[0]);
                    formData.append("doc_id", $("#InspecDoc_doc_id").val());
                    //console.log($("input[name=file-attach]")[0].files[0])
                    $.ajax({
                            type: "POST",
                            processData : false,
                            contentType : false,
                            url: "../../inspecFile/create/",
                            dataType:"json",
                            data: formData
                    })                                  
                    .done(function( msg ) {
                            //console.log(msg)
                             jQuery.fn.yiiGridView.update("upload-grid");
                    });

                '
            )    
        )); 

echo '</form>'; 

$this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'upload-grid',
                    
                    'type'=>'bordered condensed',
                    'dataProvider'=>InspecFile::model()->search($model->doc_id),
                    //'filter'=>$model,
                    'selectableRows' => 2,
                    'enableSorting' => false,
                    'rowCssClassExpression'=>'"tr_white"',
                    'htmlOptions'=>array('style'=>'padding-bottom:10px;width:50%'),
                    'enablePagination' => false,
                    'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
                    'columns'=>array(
                            
                            'detail'=>array(
                                //'type'=>'raw',
                                'header'=>'',
                               // 'value'=>'CHtml::link($data->ins_file, "download", array("id"=>$data->ins_id)',

                                'name' => 'ins_file',

                                'headerHtmlOptions' => array('style' => 'width:87%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:left'

                                )
                            ),
                            
                            array(
                                'class'=>'bootstrap.widgets.TbButtonColumn',
                                'headerHtmlOptions' => array('style' => 'width:13%;text-align:center;background-color: #eeeeee'),
                                'template' => '{view} {delete}',
                                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                                'buttons'=>array(
                                        'delete'=>array(
                                            'url'=>'Yii::app()->createUrl("InspecFile/delete", array("id"=>$data->ins_id))', 

                                        ),
                                        'view'=>array(
                                            'url'=>'Yii::app()->createUrl("InspecFile/download", array("id"=>$data->ins_id))', 

                                        )

                                    )

                                
                            ),
                        )

                    ));


// $formUpload = $form->beginWidget('bootstrap.widgets.TbActiveForm',array(
//     'id'=>'inspec-doc-form-upload',
//     'htmlOptions' => array('enctype' => 'multipart/form-data'),
// ));

//echo $formUpload->fileFieldRow($model2, 'ins_file'); 




?>


  <fieldset class="well the-fieldset">
            <legend class="the-legend">ผูกใบรับรอง</legend>
            <div class="row-fluid"> 
                <div class="span9">
                  <?php 
                  //echo CHtml::textField('cerID', '',array('class'=>'span12','placeholder'=>'เลือกใบรับรอง'));

                  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cerID',
                            'id'=>'cerID',
                            'value'=>'',                      
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('CerDoc/InspecGetCerNo').'",
                                    dataType: "json",
                                    data: {
                                        term: request.term,
                                        con_id: $("#InspecDoc_con_id").val(),
                                        cust_id:"'.$contractor.'"
                                       
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
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));

                   ?>
                </div>
                <div class="span3">
                  <?php  


                       $this->widget('bootstrap.widgets.TbButton', array(
                          'buttonType'=>'ajaxLink',
                          
                          'type'=>'success',
                          'label'=>'เพิ่ม',
                          'icon'=>'plus-sign',
                          'url'=>array('addCer'),
                          'htmlOptions'=>array('class'=>'span6','style'=>''),
                          'ajaxOptions'=>array(
                                //'url'=>$this->createUrl('create'),
                                'type' => 'POST',
                                    'data' => array('cerID' => 'js:$("#cerID").val()','id'=>$model->doc_id),
                                    'success' => 'function(html){ $("#cerID").val(""); $.fn.yiiGridView.update("detail-grid"); }'
                                  ) 
                      )); 


                  ?>
                  </div>
          </div> 
           <div class="row-fluid">        
          <?php        
                  
                $this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'detail-grid',
                    
                    'type'=>'bordered condensed',
                    'dataProvider'=>InspecCer::model()->searchByInspecID($model->doc_id),
                    //'filter'=>$model,
                    'selectableRows' => 2,
                    'enableSorting' => false,
                    'rowCssClassExpression'=>'"tr_white"',

                    // 'template'=>"{summary}{items}{pager}",
                    'htmlOptions'=>array('style'=>'padding-top:0px;'),
                    'enablePagination' => true,
                    'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
                    'columns'=>array(
                            'No.'=>array(
                                'header'=>'ลำดับ',
                                'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),                            
                                'htmlOptions'=>array(
                                    'style'=>'text-align:center'

                                ),
                                'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                              ),
                            'cer_id'=>array(
                                // 'header'=>'', 
                                
                                'name' => 'cer_id',

                                'headerHtmlOptions' => array('style' => 'width:80%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:left'

                                )
                            ),
                            
                            
                            array(
                                'class'=>'bootstrap.widgets.TbButtonColumn',
                                'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),
                                'template' => '{delete}',
                                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                                'buttons'=>array(
                                        'delete'=>array(
                                            'url'=>'Yii::app()->createUrl("inspecDoc/deleteInspecCer", array("id"=>$data->id))',    

                                        )
                                        
                                    )

                                
                            ),
                        )

                    ));

             ?>
            </div>
           
        </fieldset>




	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'primary',
			'label'=>'บันทึก',
      'htmlOptions'=>array(
                'onclick'=>'
                    $("#inspec-doc-form").submit();
                '
                )
		)); ?>
	</div>

</div>