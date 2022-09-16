   <script type="text/javascript">
    
    $(function(){
        //autocomplete search on focus      
        $("#detail").autocomplete({
       
                minLength: 3
            }).bind('focus', function () {
                 
                $(this).autocomplete("search");
      });
    
  });
    </script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cer-detail-form',
	'enableAjaxValidation'=>false,
)); ?>
    
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	
	<?php 
	//echo $form->textFieldRow($model,'detail',array('class'=>'span5','maxlength'=>500));
	          echo $form->hiddenField($model,'detail');
              echo $form->hiddenField($model,'prod_id');
             // echo $form->hiddenField($model,'unit');
              echo $form->labelEx($model,'detail',array('class'=>'span5','style'=>'text-align:left;margin-left:-1px;margin-bottom:0px'));
              
             

              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'detail',
                            'id'=>'detail',
                            'value'=>$model->detail,                      
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "../Product/GetProduct",
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
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {
                                        
                                            $("#CerDetailTemp_prod_id").val(ui.item.id);
                                            $("#CerDetailTemp_detail").val(ui.item.name);
                                            $("#CerDetailTemp_prod_size").val(ui.item.size);
                                            $("#CerDetailTemp_unit").val(ui.item.size);
                                           
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span5'
                            ),
                                  
                        ));


	 ?>

	

	<?php echo $form->textFieldRow($model,'quantity',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'serialno',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'prod_size',array('class'=>'span5')); ?>
    <?php echo $form->textFieldRow($model,'unit',array('class'=>'span5')); ?>

<?php $this->endWidget(); ?>
