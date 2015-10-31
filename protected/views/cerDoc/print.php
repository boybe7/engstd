<?php
$this->breadcrumbs=array(

);

?>

<script type="text/javascript">
	
	$(function(){
        //autocomplete search on focus    	
	    $("#cer_no,#contract_no,#contractor,#vend_id,#supp_id").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

  });


</script>

<h3>ใบรับรองคุณภาพท่อและอุปกรณ์</h3>

<?php 

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'enableAjaxValidation'=>false,
    'type'=>'vertical',
    'htmlOptions'=>  array('class'=>'well','style'=>'margin:0 auto;padding-top:20px;'),
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row-fluid">
       <div class="span3">
			 <?php 

			        echo CHtml::label('วันที่ออกใบรับรองเริ่มต้น','cer_date_begin');
      			 
		                echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'cer_date_begin',
		                        //'attribute'=>'cer_date',
		                        //'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span10'),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
		</div>  
		<div class="span3">
			 <?php 

			        echo CHtml::label('วันที่ออกใบรับรองสิ้นสุด','cer_date_end');
      			 
		                echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
		                    $form->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'cer_date_end',
		                        //'attribute'=>'cer_date',
		                        //'model'=>$model,
		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span10'),  // ใส่ค่าเดิม ในเหตุการ Update 
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
		</div>  
	<div class="span2">
      <?php
           echo CHtml::label('เลขที่สัญญา','contract_no');

              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'contract_no',
                            'id'=>'contract_no',
                          
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
                                        
                                          
                                            
                                     }',
                                    
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12',
                                'placeholder'=>""
                            ),
                                  
                        ));
      ?>
      </div>
         <div class="span2"> 
        <?php 
        	
        			
        			 echo CHtml::label('เลขที่ใบรับรองคุณภาพ','cer_no');

        			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cer_no',
                            'id'=>'cer_no',
                          
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('cerDoc/GetCerNO').'",
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
                                        
                                         
                                            
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12',
                                'placeholder'=>""
                            ),
                                  
                        ));
						

         ?>
       </div>
       <div class="span2"> 
          <?php
          		$this->widget('bootstrap.widgets.TbButton', array(
				    'buttonType'=>'submit',
				    
				    'type'=>'success',
				    'label'=>'search',
				    'icon'=>'icon-search',
				    'url'=>array('create'),
				    'htmlOptions'=>array('class'=>'pull-right','style'=>'margin:22px 10px 0px 10px;'),
				)); 
          ?>
       </div>
        
    </div>


     <div class="row-fluid">
       <div class="span4">
       		<?php
       			    echo CHtml::label('ผู้ผลิต','vend_id');

        			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'vend_id',
                            'id'=>'vend_id',
                          
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
                                        
                                          
                                            
                                     }',
                                    
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12',
                                'placeholder'=>""
                            ),
                                  
                        ));

       		?>

       </div>
       <div class="span4">
       		<?php
       			    echo CHtml::label('ผู้จัดส่ง','supp_id');

        			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'supp_id',
                            'id'=>'supp_id',
                          
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
                                        
                                          
                                            
                                     }',
                                    
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12',
                                'placeholder'=>""
                            ),
                                  
                        ));

       		?>

       </div>

  
      <div class="span4">
      <?php
            echo CHtml::label('คู่สัญญา','contract_no');

              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'contractor',
                            'id'=>'contractor',
                          
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
                                        
                                          
                                            
                                     }',
                                    
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12',
                                'placeholder'=>""
                            ),
                                  
                        ));

      ?>
      </div>
    </div>  
    
<?php $this->endWidget(); ?>

<?php 


$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cer-doc-grid',
	'dataProvider'=>$dataProvider,
	'type'=>'bordered condensed',
	//'filter'=>$model,
	'selectableRows' =>2,
	'htmlOptions'=>array('style'=>'padding-top:10px'),
    'enablePagination' => true,
    'summaryText'=>'แสดงผล {start} ถึง {end} จากทั้งหมด {count} ข้อมูล',
    'template'=>"{items}<div class='row-fluid'><div class='span6'>{pager}</div><div class='span6'>{summary}</div></div>",
	'columns'=>array(
		'cer_date'=>array(
			    'header' => 'วันที่ออกใบรับรองฯ',
			    'value'=>'$data->cer_date',
			    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
		'cer_no'=>array(
			    'header' => 'เลขที่ใบรับรองฯ',
			    //'value'=>'$data->cer_no',
			    'value' => 'CHtml::link($data->cer_no, Yii::app()->createUrl("cerDoc/preview",array("id"=>$data->cer_id)))',
                'type'  => 'raw',
			    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:12%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
		'contract_no'=>array(
			    'header' => 'เลขที่สัญญา',
			    'value'=>'$data->contract_no',
			    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:9%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
	  	'contractor'=>array(
			    'header' => 'คู่สัญญา',
			    'value'=>'$data->contractor',
			    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
	  	'vend_id'=>array(
			    'header' => 'ผู้ผลิต',
			    'value'=>'$data->vend_id',
			    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
	  	'supp_id'=>array(
			    'header' => 'ผู้จัดส่ง',
			    'value'=>'$data->supp_id',
			    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
	  	// 'prod_id'=>array(
			 //    'header' => 'ประเภทท่อ/อุปกรณ์',
			 //    'value'=> array($this,'gridGetProd'),
			 //    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				// 'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				// 'htmlOptions'=>array('style'=>'text-align:center;')
	  	// ),
	  	'cer_oper_date'=>array(
			    'header' => 'วันที่ตรวจโรงงาน',
			    'value'=>'$data->cer_oper_date',
			    //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
				'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),  	            	  	
				'htmlOptions'=>array('style'=>'text-align:center;')
	  	),
	),
));

?>
