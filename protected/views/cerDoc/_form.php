<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#dept_id,#vend_id,#contract_no,#contractor,#prod_id,#detail,#supp_id").autocomplete({
       
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

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cer-doc-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'well','style'=>''),
)); ?>
	<h4><?php  echo($title);  ?></h4>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model);
    
     ?>

    <div class="pull-right"><?php echo $model->running_no;?></div>
	<div class="row-fluid">
		<div class="span3">
			<?php echo $form->textFieldRow($model,'cer_no',array('class'=>'span12','maxlength'=>20,'readonly'=>true)); ?>
		</div>
		<div class="span6">
			 <?php echo $form->labelEx($model,'cer_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));?>
    					
    			<?php 

      			 
		                echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'cer_date',
		                        'attribute'=>'cer_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->cer_date, 'disabled' =>true),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
		</div>
	</div>	
   
	<div class="row-fluid">
		<div class="span8">	
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
                                    url: "'.$this->createUrl('deptorder/getdept').'",
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
                                            $("#CerDoc_dept_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
	                

			?>
		</div>
	</div>		
     <div class="row-fluid">
        <div class="span8"> 
            <?php 
                  
                        echo $form->hiddenField($model,'contract_no');
                        echo $form->labelEx($model,'contract_no',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
                         
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'contract_no',
                            'id'=>'contract_no',
                            'value'=>$model->contract_no,
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
                                            $("#CerDoc_contract_no").val(ui.item.label);
                                          
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
    

            ?>
        </div>
    </div>  
     <div class="row-fluid">
        <div class="span8"> 
            <?php 
                  
                        echo $form->hiddenField($model,'contractor');
                        echo $form->labelEx($model,'contractor',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
                         
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'contractor',
                            'id'=>'contractor',
                            'value'=>$model->contractor,
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
                                            $("#CerDoc_contractor").val(ui.item.name);
                                          
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
    

            ?>
        </div>
    </div>  
	 <div class="row-fluid">
        <div class="span8"> 
            <?php 
                       // $code = explode(".", "จว.011");
                        
                       

                        echo $form->hiddenField($model,'vend_id');
                        echo $form->labelEx($model,'vend_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
                         
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'vend_id',
                            'id'=>'vend_id',
                            'value'=>$model->vend_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Vendor/GetVendor2').'",
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
                                        
                                           console.log($("#supp_id").val())
                                            $("#CerDoc_vend_id").val(ui.item.id);

                                            if($("#supp_id").val()=="")
                                            $.ajax({
                                                url: "'.$this->createUrl('cerDoc/GenCerNo').'",
                                                dataType: "json",
                                                data: {
                                                    id: ui.item.id,
                                                   
                                                },
                                                success: function (data) {
                                                        $("#CerDoc_cer_no").val(data);

                                                }
                                            })
                                          
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
    

            ?>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span8"> 
            <?php 
                       // $code = explode(".", "จว.011");
                        
                       

                        echo $form->hiddenField($model,'supp_id');
                        echo $form->labelEx($model,'supp_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
                         
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'supp_id',
                            'id'=>'supp_id',
                            'value'=>$model->supp_id,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('Vendor/GetSupplier').'",
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
                                            $("#CerDoc_supp_id").val(ui.item.id);
                                            $.ajax({
                                                url: "'.$this->createUrl('cerDoc/GenCerNo2').'",
                                                dataType: "json",
                                                data: {
                                                    id: ui.item.id,
                                                   
                                                },
                                                success: function (data) {
                                                        $("#CerDoc_cer_no").val(data);

                                                }
                                            })
                                          
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
    

            ?>
        </div>
    </div>  
     <div class="row-fluid">
        <div class="span8"> 
            <?php 
                  
                        echo $form->hiddenField($model,'prod_id');
                        echo $form->labelEx($model,'prod_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;margin-bottom:-5px'));
                         
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'prod_id',
                            'id'=>'prod_id',
                            'value'=>$model->prod_id,
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
                                            $("#CerDoc_prod_id").val(ui.item.id);
                                          
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),
                                  
                        ));
    

            ?>
        </div>
    </div>  
	<div class="row-fluid">
		<div class="span4">	
	<?php 
						  echo $form->labelEx($model,'cer_oper_date',array('class'=>'span12','style'=>'text-align:left;padding-right:10px;'));
						 echo '<div class="input-append" style="margin-top:-10px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'cer_oper_date',
		                        'attribute'=>'cer_oper_date',
		                        'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12', 'value'=>$model->cer_oper_date),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';
	

	?>

		</div>
	</div>	

	<div class="row-fluid">
		<div class="span8">	
	<?php 
				
	
	
                        $models=User::model()->with(array(
                                      'position' => array(
                                        //'join' => 'JOIN m_position ON m_position.id = user.position', 
                                        'condition' => "posi_level = 1 OR posi_level = 2",
                                      )
                                    ))->findAll(array('order'=>'name', 'condition'=>'', 'params'=>array()));
                        $data = array();
                        foreach ($models as $key => $value) {
                          $data[] = array(
                                          'value'=>$value['name'],
                                          'text'=>$value['name'],
                                       );
                        } 
                        $typelist = CHtml::listData($data,'value','text');
                        echo $form->dropDownListRow($model, 'cer_name', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--')); 
                          
	 ?>
	 </div>
	</div>	

	<div class="row-fluid">
		<div class="span8">	
	<?php 
						$models=$models=User::model()->with(array(
                                      'position' => array(
                                        //'join' => 'JOIN m_position ON m_position.id = user.position', 
                                        'condition' => "posi_level = 2",
                                      )
                                    ))->findAll(array('order'=>'', 'condition'=>'', 'params'=>array()));
                        $data = array();
                        foreach ($models as $key => $value) {
                          $data[] = array(
                                          'value'=>$value['name'],
                                          'text'=>$value['name'],
                                       );
                        } 
                        $models=User::model()->findAll(array('order'=>'', 'condition'=>'position=3 OR position2=3', 'params'=>array()));
        
                        foreach ($models as $key => $value) {
                          $data[] = array(
                                          'value'=>$value['name']."(รักษาการแทน)",
                                          'text'=>$value['name']."(รักษาการแทน)",
                                       );
                        } 
                        $typelist = CHtml::listData($data,'value','text');
                        echo $form->dropDownListRow($model, 'cer_ct_name', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--')); 
                          

	 ?>
	 </div>
	</div>

	<div class="row-fluid">
		<div class="span8">	
	<?php 
					    $models=User::model()->findAll(array('order'=>'', 'condition'=>'position=4', 'params'=>array()));
                        $data = array();
                        foreach ($models as $key => $value) {
                          $data[] = array(
                                          'value'=>$value['name'],
                                          'text'=>$value['name'],
                                       );
                        } 
                        $models=User::model()->findAll(array('order'=>'', 'condition'=>'position=5 OR position2=5', 'params'=>array()));
        
                        foreach ($models as $key => $value) {
                          $data[] = array(
                                          'value'=>$value['name']."(รักษาการแทน)",
                                          'text'=>$value['name']."(รักษาการแทน)",
                                       );
                        } 
                        $typelist = CHtml::listData($data,'value','text');
                        echo $form->dropDownListRow($model, 'cer_di_name', $typelist,array('class'=>'span12','prompt'=>'--กรุณาเลือก--')); 
                          

	

	 ?>
	 </div>
	</div>
    <div class="row-fluid">
        <div class="span8"> 
	       <?php echo $form->textAreaRow($model,'cer_notes',array('class'=>'span12','rows'=>4)); ?>
        </div>
    </div>


        <fieldset class="well the-fieldset">
            <legend class="the-legend">รายละเอียดท่อ/อุปกรณ์</legend>
            <div class="row-fluid"> 
            <?php  


            $this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',
                  
                  'type'=>'success',
                  'label'=>'เพิ่มข้อมูล',
                  'icon'=>'plus-sign',
                  
                  'htmlOptions'=>array(
                    'class'=>'pull-right',
                    'style'=>'margin:-20px 10px 10px 10px;',
                    //'onclick'=>'createApprove(' . $index . ')'
                 
                     'onclick'=>'
                             //$("#modal-body2").load("../cerDetail/createTemp2");

                                  // console.log($("#modal-body2")[0])
                                   if($("#modal-body2")[0]==null)
                                   {

                                       $("#modal-content").append("<div id=modal-body2></div>")
                                        //console.log($("#modal-body2")[0])
                                   }    
                                   v = $("#modal-body2").load("../cerDetail/createTemp2")
                                   
                                    js:bootbox.confirm(v,"ยกเลิก","ตกลง",
                                       

                                        function(confirmed){
                                         
                                                        
                                            if(confirmed)
                                            {

                                                $.ajax({
                                                    type: "POST",
                                                    url: "../cerDetail/createTemp",
                                                    dataType:"json",
                                                    data: $(".modal-body #cer-detail-form").serialize()
                                                    })                                  
                                                    .done(function( msg ) {
                                                     
                                                        jQuery.fn.yiiGridView.update("detail-grid");
                                                     
                                                        if(msg.status=="failure")
                                                        {
                                                            
                                                            //$("#modal-body2").load("../cerDetail/createTemp2")
                                                            js:bootbox.confirm($("#modal-body2").html(msg.div),"ยกเลิก","ตกลง",
                                                            function(confirmed){
                                                                
                                                                
                                                                if(confirmed)
                                                                {
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "../cerDetail/createTemp",
                                                                        dataType:"json",
                                                                        data: $(".modal-body #cer-detail-form").serialize()
                                                                        })
                                                                        .done(function( msg ) {
                                                                            if(msg.status=="failure")
                                                                            {
                                                                                js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
                                                                            }
                                                                            else{
                                                                                //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
                                                                                jQuery.fn.yiiGridView.update("detail-grid");
                                                                            }
                                                                        });
                                                                }
                                                            })
                                                        }
                                                        else{
                                                            //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");

                                                        }
                                                    });
                                             
                                            
                                            }
                                        })
                                            
                                        ',
                            
                  ),
              ));


            // $this->widget('bootstrap.widgets.TbButton', array(
            //       'buttonType'=>'link',
                  
            //       'type'=>'success',
            //       'label'=>'เพิ่มข้อมูล',
            //       'icon'=>'plus-sign',
                  
            //       'htmlOptions'=>array(
            //         'class'=>'pull-right',
            //         'style'=>'margin:-20px 10px 10px 10px;',
            //         //'onclick'=>'createApprove(' . $index . ')'
                 
            //          'onclick'=>'
                        
            //                 $("#modal-content").show()

            //                             ',
                            
            //       ),
            //   ));


                  
                $this->widget('bootstrap.widgets.TbGridView',array(
                    'id'=>'detail-grid',
                    
                    'type'=>'bordered condensed',
                    'dataProvider'=>CerDetailTemp::model()->searchByUser(Yii::app()->user->ID),
                    //'filter'=>$model,
                    'selectableRows' => 2,
                    'enableSorting' => false,
                    'rowCssClassExpression'=>'"tr_white"',

                    // 'template'=>"{summary}{items}{pager}",
                    'htmlOptions'=>array('style'=>'padding-top:20px;'),
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
                            'detail'=>array(
                                // 'header'=>'', 
                                
                                'name' => 'detail',

                                'headerHtmlOptions' => array('style' => 'width:40%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:left'

                                )
                            ),
                            'quantity'=>array(
                                // 'header'=>'', 
                                
                                'name' => 'quantity',

                                'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:center'

                                )
                            ),
                            'serialno'=>array(
                                // 'header'=>'', 
                                
                                'name' => 'serialno',

                                'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:center'

                                )
                            ),
                            'prod_size'=>array(
                                 'header'=>'ขนาด &#8709 มม.', 
                                
                                'name' => 'prod_size',


                                'headerHtmlOptions' => array('style' => 'width:10%;text-align:center;background-color: #eeeeee'),                           
                                //'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'htmlOptions'=>array(
                                                    'style'=>'text-align:center'

                                )
                            ),
                            
                            array(
                                'class'=>'bootstrap.widgets.TbButtonColumn',
                                'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),
                                'template' => '{update}   {delete}',
                                // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                                'buttons'=>array(
                                        'delete'=>array(
                                            'url'=>'Yii::app()->createUrl("cerDetail/deleteTemp", array("id"=>$data->detail_id))',    

                                        ),
                                        'update'=>array(

                                            'url'=>'Yii::app()->createUrl("cerDetail/updateTemp", array("id"=>$data->detail_id))',
                                            //'click'=>'updateApprove($data->id)'   
                                            
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
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'บันทึก' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<div id="modalApprove"  class="modal hide fade">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>แก้ไขข้อมูล</h3>
    </div>
    <div class="modal-body" id="bodyApprove">
      <?php 
    
      ?>
   

    </div>
    <div class="modal-footer">
    <a href="#" class="btn btn-danger" id="modalCancel">ยกเลิก</a>
    <a href="#" class="btn btn-primary" id="modalSubmit">บันทึก</a>
    </div>
</div>
<div id="modal-content" class="modal hide">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  
    <div id="modal-body2" class='modal-body'>    
    <?php
        //$model3=new CerDetailTemp;

        //$this->renderPartial('/cerDetail/_form',array('model'=>$model3),false); 
    ?>
    </div>
    <!--  <div class="modal-footer">
        <a href="#" class="btn btn-danger" id="modalCancel" data-dismiss="modal-content">ยกเลิก</a>
        <a href="#" class="btn btn-primary" id="modalSubmit">บันทึก</a>
    </div> -->
</div>
<script type="text/javascript">
    $(function () {
    
});
</script>

<?php

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('edit','
    var link;
    var myBackup2;
    
    $("#modalCancel").click(function(e){
        
        myBackup2 = $("#modalApprove").clone();
                        $("#modalApprove").modal("hide");
                        $("#bodyApprove").html();
                     
    });


    $("#modalSubmit").click(function(e){
      
       $.ajax( {
            type: "POST",
            url: link,
            dataType:"json",
            data: $("#cer-detail-form").serialize(),
            success: function( msg ) {
                //console.log(msg.status);

                //$("#modalApprove").modal("hide");

                if(msg.status=="failure")                                   
                {
                    //js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
                    $("#cer-detail-form").html(msg.div);
                }
                else{
                    
                    //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
                       myBackup2 = $("#modalApprove").clone();
                        $("#modalApprove").modal("hide");
                        $("#bodyApprove").html();
                        
                }
                jQuery.fn.yiiGridView.update("detail-grid");
              
            }
        } 
        );

    });

    


    
    $("body").on("click","#detail-grid .update,#link",function(e){
                link = $(this).attr("href");
                //console.log(link)
                                    if($("#modal-body2")[0]==null)
                                   {

                                       $("#modal-content").append("<div id=modal-body2></div>")
                                        //console.log($("#modal-body2")[0])
                                   }    
                                   v = $("#modal-body2").load(link)
                                   
                                    js:bootbox.confirm(v,"ยกเลิก","ตกลง",
                                       

                                        function(confirmed){
                                                $.ajax({
                                                    type: "POST",
                                                    url: link,
                                                    dataType:"json",
                                                    data: $(".modal-body #cer-detail-form").serialize()
                                                    })                                  
                                                    .done(function( msg ) {
                                                     
                                                        jQuery.fn.yiiGridView.update("detail-grid");
                                                    })
                                                  
                                        }
                                        )
                // $.ajax({
                //  type:"GET",
                //  cache: false,
                //  url:$(this).attr("href"),
                //  success:function(data){
                         
                //             $("#bodyApprove").html(data);
                          
                           
                //              $("#modalApprove").modal("show");

                        
                //  },

                // });
            return false;
    });


');
?>


