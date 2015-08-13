<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#dept_id,#vend_id,#contract_no,#contractor,#prod_id").autocomplete({
       
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

	<?php echo $form->errorSummary($model); ?>

    
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
                                    url: "'.$this->createUrl('DeptOrder/GetDept').'",
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
                                            $("#CerDoc_contract_no").val(ui.item.id);
                                          
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
                                            $("#CerDoc_contractor").val(ui.item.id);
                                          
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
                                            $("#CerDoc_vend_id").val(ui.item.id);
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
				
	
	
                        $models=User::model()->findAll(array('order'=>'', 'condition'=>'position=1', 'params'=>array()));
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
						$models=User::model()->findAll(array('order'=>'', 'condition'=>'position=2', 'params'=>array()));
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
                                          'value'=>$value['name'],
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
            <legend class="the-legend">รายละเอียดการอนุมัติ</legend>
            <div class="row-fluid"> 
            <?php   
            $this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',
                  
                  'type'=>'success',
                  'label'=>'เพิ่มการอนุมัติ',
                  'icon'=>'plus-sign',
                  
                  'htmlOptions'=>array(
                    'class'=>'pull-right',
                    'style'=>'margin:0px 10px 10px 10px;',
                    //'onclick'=>'createApprove(' . $index . ')'
                 
                     'onclick'=>'
                             
                                    js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
                                        function(confirmed){
                                            //console.log("con:"+confirmed)
                                                        
                                            if(confirmed)
                                            {

                                                $.ajax({
                                                    type: "POST",
                                                    url: "../contractapprovehistory/createTemp",
                                                    dataType:"json",
                                                    data: $(".modal-body #contract-approve-history-form").serialize()
                                                    })                                  
                                                    .done(function( msg ) {
                                                     
                                                        jQuery.fn.yiiGridView.update("approve-grid");
                                                     
                                                        if(msg.status=="failure")
                                                        {
                                                            $("#modal-body2").html(msg.div);
                                                            js:bootbox.confirm($("#modal-body2").html(),"ยกเลิก","ตกลง",
                                                            function(confirmed){
                                                                
                                                                
                                                                if(confirmed)
                                                                {
                                                                    $.ajax({
                                                                        type: "POST",
                                                                        url: "../contractapprovehistory/createTemp",
                                                                        dataType:"json",
                                                                        data: $(".modal-body #contract-approve-history-form").serialize()
                                                                        })
                                                                        .done(function( msg ) {
                                                                            if(msg.status=="failure")
                                                                            {
                                                                                js:bootbox.alert("<font color=red>!!!!บันทึกไม่สำเร็จ</font>","ตกลง");
                                                                            }
                                                                            else{
                                                                                //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");
                                                                                jQuery.fn.yiiGridView.update("approve-grid");
                                                                            }
                                                                        });
                                                                }
                                                            })
                                                        }
                                                        else{
                                                            //js:bootbox.alert("บันทึกสำเร็จ","ตกลง");

                                                        }
                                                    });
                                                //$("#approve-grid").yiiGridView("update",{});
                                            
                                            }
                                        })
                                            
                                        ',
                            
                  ),
              ));

                  
                // $this->widget('bootstrap.widgets.TbGridView',array(
                //     'id'=>'approve-grid'.$index,
                    
                //     'type'=>'bordered condensed',
                //     'dataProvider'=>ContractApproveHistoryTemp::model()->searchByUser($index,1,Yii::app()->user->ID),
                //     //'filter'=>$model,
                //     'selectableRows' => 2,
                //     'enableSorting' => false,
                //     'rowCssClassExpression'=>'"tr_white"',

                //     // 'template'=>"{summary}{items}{pager}",
                //     'htmlOptions'=>array('style'=>'padding-top:40px;'),
                //     'enablePagination' => false,
                //     'summaryText'=>'',//'Displaying {start}-{end} of {count} results.',
                //     'columns'=>array(
                //             'No.'=>array(
                //                 'header'=>'ลำดับ',
                //                 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),                            
                //                 'htmlOptions'=>array(
                //                     'style'=>'text-align:center'

                //                 ),
                //                 'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                //               ),
                //             'detail'=>array(
                //                 // 'header'=>'', 
                                
                //                 'name' => 'detail',

                //                 'headerHtmlOptions' => array('style' => 'width:35%;text-align:center;background-color: #eeeeee'),                           
                //                 //'headerHtmlOptions' => array('style' => 'width: 110px'),
                //                 'htmlOptions'=>array(
                //                                     'style'=>'text-align:left'

                //                 )
                //             ),
                //             'approve by'=>array(
                //                 // 'header'=>'', 
                                
                //                 'header' => 'อนุมัติโดย/<br>ลงวันที่',
                //                 'type'=>'raw', //to use html tag
                //                 'value'=> '$data->approveBy."<br>".$data->dateApprove', 
                //                 'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                           
                //                 //'headerHtmlOptions' => array('style' => 'width: 110px'),
                //                 'htmlOptions'=>array(
                //                                     'style'=>'text-align:center'

                //                 )
                //             ),
                //             'cost'=>array(
                //                 'header'=>'วงเงิน/<br>เป็นเงินเพิ่ม', 
                                
                //                 'name' => 'cost',
                //                 // 'type'=>'raw', //to use html tag
                //                 'value'=> function($data){
                //                     return number_format($data->cost, 2);
                //                 },  
                //                 'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #eeeeee'),                           
                //                 'htmlOptions'=>array(
                //                                     'style'=>'text-align:right'

                //                 )
                //             ),
                //             'time'=>array(
                //                 'header'=>'ระยะเวลาแล้วเสร็จ/<br>ระยะเลาขอขยาย', 
                                
                //                 'name' => 'timeSpend',
                //                 // 'type'=>'raw', //to use html tag
                                    
                //                 'headerHtmlOptions' => array('style' => 'width:20%;text-align:center;background-color: #eeeeee'),                           
                //                 'htmlOptions'=>array(
                //                                     'style'=>'text-align:left'

                //                 )
                //             ),  
                //             array(
                //                 'class'=>'bootstrap.widgets.TbButtonColumn',
                //                 'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),
                //                 'template' => '{update}   {delete}',
                //                 // 'deleteConfirmation'=>'js:bootbox.confirm("Are you sure to want to delete")',
                //                 'buttons'=>array(
                //                         'delete'=>array(
                //                             'url'=>'Yii::app()->createUrl("ContractApproveHistory/deleteTemp", array("id"=>$data->id))',    

                //                         ),
                //                         'update'=>array(

                //                             'url'=>'Yii::app()->createUrl("ContractApproveHistory/updateTemp", array("id"=>$data->id))',
                //                             //'click'=>'updateApprove($data->id)'   
                                            
                //                         )

                //                     )

                                
                //             ),
                //         )

                //     ));

             ?>
            </div>
           
        </fieldset>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<div id="modal-content" class="hide">
    <div id="modal-body2">
    <?php
        $model3=new CerDetailTemp;
      
        $this->renderPartial('/cerDetail/_form',array('model'=>$model3),false); 
    ?>
    </div>
</div>
