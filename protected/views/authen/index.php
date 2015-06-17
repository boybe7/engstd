<?php
$this->breadcrumbs=array(
	'สิทธิการเข้าถึงข้อมูล',
);

?>

<script type="text/javascript">
	$(function(){
        //autocomplete search on focus    	
		    $("#pj_vendor_id").autocomplete({
	       
	                minLength: 0
	            }).bind('focus', function () {
	                $(this).autocomplete("search");
	      });
	 
	  });
</script>

<h3>สิทธิการเข้าถึงข้อมูล</h3>
<div class="row-fluid">
	<div class="span3">กลุ่มผู้ใช้งาน</div>
	<div class="span9">
		<?php

						$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'pj_vendor_id',
                            'id'=>'pj_vendor_id',
                           // 'value'=>$model->pj_name,
                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
                           'source'=>'js: function(request, response) {
                                $.ajax({
                                    url: "'.$this->createUrl('userGroup/GetGroup').'",
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
                                            $("#Project_pj_vendor_id").val(ui.item.id);
                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',
                                     
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span6'
                            ),
                                  
                        ));

		?>
	</div>
</div>
