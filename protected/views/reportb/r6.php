<script type="text/javascript">

	$(function(){
        //autocomplete search on focus
	    $("#prod_id,#prod_id2,#vend_id,#vend_id2").autocomplete({

                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
            });
        /*
        //--------ผู้ผลิต/จัดส่งทั้งหมด------------
        $('#vend_id_all').click(function() {
            if($('#vend_id_all') .attr( 'checked' ) )
            {
                $("#vend_id").prop('disabled', true);
                $("#vend_id2").prop('disabled', true);
                $("#vend_id").val("");
                $("#vend_id2").val("");
            }
            else
            {

                $("#vend_id").prop('disabled', false);
                $("#vend_id2").prop('disabled', false);
            }
        });
        //--------ท่อ/อุปกรณ์ทั้งหมด------------
        $('#prot_id_all').click(function() {
            if($('#prot_id_all') .attr( 'checked' ) )
            {
                $("#prot_id").prop('disabled', true);
                $("#prot_id2").prop('disabled', true);
            }
            else
            {

                $("#prot_id").prop('disabled', false);
                $("#prot_id2").prop('disabled', false);
            }
        });
        */
  });


</script>
<?php
$this->breadcrumbs=array(
	'รายงาน',
	 //----ไม่ต้องแก้-----
);


?>

<style>

.reportTable thead th {
	text-align: center;
	font-weight: bold;
	background-color: #eeeeee;
	vertical-align: middle;
	}

.reportTable td {
	
}

</style>
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdfobject.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/pdf.js"></script> -->
<!-- <script type="text/javascript" src="/pea_track/themes/bootstrap/js/compatibility.js"></script> -->


<h4>รายงานผลรวมการผลิตแยกตามผู้ผลิต</h4>
<div class="well">
  <div class="row-fluid">

    <div class="span3">
			<?php

                                echo CHtml::label('วันที่ออกใบรับรองเริ่มต้น','date_start');
		                echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
		                    $this->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'date_start',
		                        'attribute'=>'date_start',

		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12'),  // ใส่ค่าเดิม ในเหตุการ Update
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
      </div>

      <div class="span3 offset1">
			<?php

                                echo CHtml::label('วันที่ออกใบรับรองสิ้นสุด','date_end');
		                echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
		                    $this->widget('zii.widgets.jui.CJuiDatePicker',

		                    array(
		                        'name'=>'date_end',
		                        'attribute'=>'date_end',

		                        'options' => array(
		                                          'mode'=>'focus',
		                                          //'language' => 'th',
		                                          'format'=>'dd/mm/yyyy', //กำหนด date Format
		                                          'showAnim' => 'slideDown',
		                                          ),
		                        'htmlOptions'=>array('class'=>'span12'),  // ใส่ค่าเดิม ในเหตุการ Update
		                     )
		                );
		                echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';

		      	?>
     </div>
  </div>

<!--  แถว 2 //// -->

<div class="row-fluid">

        <div class="span4">
		<?php



//            echo CHtml::label('รหัสผู้ผลิต/จัดส่งเริ่มต้น','workcat');
//            echo CHtml::dropDownList('workcat', '',
//                            array(0=>"ผู้ผลิต",1=>"ผู้จัดส่ง"),array('empty' => 'ทั้งหมด','class'=>'span12'
//                            	,
//                              	'ajax' => array(
//  							                'type' => 'POST', //request type
//  							                'url' => CController::createUrl('ajax/getVendor'), //url to call.
//  							                'update' => '#vendor', //selector to update
//  							                'data' => array('workcat_id' => 'js:this.value'),
//  							                 )
//                            	));
                            echo CHtml::label('รหัสผู้ผลิต/จัดส่งเริ่มต้น','workcat');
	                    //echo $form->hiddenField($model,'vend_id');
  			    //echo $form->labelEx($model,'vend_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;'));

  			    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'vend_id',
                            'id'=>'vend_id',
                            //'value'=>$model->vend_id,
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
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {

                                     }',
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span12'
                            ),

                        ));
		?>

	</div>
	<div class="span4">
		<?php

//            $vendors = Vendor::model()->findAll();
//            $list = CHtml::listData($vendors,'id','name');
//
//            echo CHtml::label('รหัสผู้ผลิต/จัดส่งสิ้นสุด','vendor');
//            echo CHtml::dropDownList('vendor', '',
//                            $list,array('empty' => 'ทั้งหมด','class'=>'span12'
//            ));
                            echo CHtml::label('รหัสผู้ผลิต/จัดส่งสิ้นสุด','workcat');
	                    //echo $form->hiddenField($model,'vend_id');
  			    //echo $form->labelEx($model,'vend_id',array('class'=>'span12','style'=>'text-align:left;margin-left:-1px;'));

  			    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'vend_id2',
                            'id'=>'vend_id2',
                            //'value'=>$model->vend_id,
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
                            'options'=>array(
                                     'showAnim'=>'fold',
                                     'minLength'=>0,
                                     'select'=>'js: function(event, ui) {

                                     }',
                            ),
                           'htmlOptions'=>array(
                                'class'=>'span13'
                            ),

                        ));

		?>

	</div>


	<div class="span4">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                  'buttonType'=>'link',

                  'type'=>'inverse',
                  'label'=>'view',
                  'icon'=>'list-alt white',

                  'htmlOptions'=>array(
                    'class'=>'span4',
                    'style'=>'margin:25px 10px 0px 0px;',
                    'id'=>'gentReport'
                  ),
              ));
            ?>
            <?php
            // $this->widget('bootstrap.widgets.TbButton', array(
            //     'buttonType' => 'link',
            //     'type' => 'success',
            //     'label' => 'Excel',
            //     'icon' => 'excel',
            //     'htmlOptions' => array(
            //         'class' => 'span4',
            //         'style' => 'margin:25px 10px 0px 0px;padding-left:0px;padding-right:0px',
            //         'id' => 'exportExcel'
            //     ),
            // ));

            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'link',
                'type' => 'info',
                'label' => '',
                'icon' => 'print white',
                'htmlOptions' => array(
                    'class' => 'span3',
                    'style' => 'margin:25px 0px 0px 0px;',
                    'id' => 'printReport'
                ),
            ));
            ?>

    </div>
  </div>


</div>


<div id="printcontent" style=""></div>


<?php
//Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScript('gentReport', '
$("#gentReport").click(function(e){
    e.preventDefault();

       
        $.ajax({
            url: "GenR6",
            cache:false,
                       data: {date_start:$("#date_start").val(),date_end:$("#date_end").val(),vend_id_sta:$("#vend_id").val(),vend_id_end:$("#vend_id2").val()
            },
            success:function(response){
               
               $("#printcontent").html(response);                 
            }

        });
    
});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('printReport', '
$("#printReport").click(function(e){
    e.preventDefault();

    $.ajax({
        url: "printR6",
        data: {date_start:$("#date_start").val(),date_end:$("#date_end").val(),vend_id_sta:$("#vend_id").val(),vend_id_end:$("#vend_id2").val()},
        success:function(response){
            window.open("../print/tempReport.pdf", "_blank", "fullscreen=yes");              
            
        }

    });

});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('exportExcel', '
$("#exportExcel").click(function(e){
    e.preventDefault();
    window.location.href = "genVendorExcel?fiscalyear="+$("#fiscalyear").val()+"&project="+$("#project").val()+"&monthEnd="+$("#monthEnd").val()+"&yearEnd="+$("#yearEnd").val()+"&workcat="+$("#workcat").val();
              


});
', CClientScript::POS_END);


?>