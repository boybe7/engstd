<script type="text/javascript">

	$(function(){
        //autocomplete search on focus
	    $("#con_id,#cerdoc").autocomplete({

                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

  });


</script>

<?php
$this->breadcrumbs = array(
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


<h4>รายงานใบรับรองคุณภาพท่อและอุปกรณ์ประปา</h4>

<div class="well">
    <div class="row-fluid">

        <div class="span2">
<?php
echo CHtml::label('วันที่ออกใบรับรองเริ่มต้น', 'date_start');
echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
$this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'name' => 'date_start',
            'attribute' => 'date_start',
            'options' => array(
                'mode' => 'focus',
                //'language' => 'th',
                'format' => 'dd/mm/yyyy', //กำหนด date Format
                'showAnim' => 'slideDown',
            ),
            'htmlOptions' => array('class' => 'span12'), // ใส่ค่าเดิม ในเหตุการ Update
        )
);
echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';
?>
        </div>

        <div class="span2 offset1">
            <?php
            echo CHtml::label('วันที่ออกใบรับรองสิ้นสุด', 'date_end');
            echo '<div class="input-append" style="margin-top:0px;">'; //ใส่ icon ลงไป
            $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'name' => 'date_end',
                        'attribute' => 'date_end',
                        'options' => array(
                            'mode' => 'focus',
                            //'language' => 'th',
                            'format' => 'dd/mm/yyyy', //กำหนด date Format
                            'showAnim' => 'slideDown',
                        ),
                        'htmlOptions' => array('class' => 'span12'), // ใส่ค่าเดิม ในเหตุการ Update
                    )
            );
            echo '<span class="add-on"><i class="icon-calendar"></i></span></div>';
            ?>
        </div>
    </div>

    <!--  แถว 2 //// -->
    <div class="row-fluid">

        <div class="span3">

            <?php
              echo CHtml::label('เลขที่สัญญา', 'workcat');
              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'con_id',
                            'id'=>'con_id',

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

                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',

                            ),
                           'htmlOptions'=>array(
                                'class'=>'span11'
                            ),

                        ));
            ?>

        </div>


        <div class="span3">
            <?php
         
             echo CHtml::label('เลขที่ใบรับรองคุณภาพ', 'cerdoc');
			 
             $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name'=>'cerdoc',
                            'id'=>'cerdoc',

                           // 'source'=>$this->createUrl('Ajax/GetDrug'),
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

                                           //console.log(ui.item.id)

                                     }',
                                     //'close'=>'js:function(){$(this).val("");}',

                            ),
                           'htmlOptions'=>array(
                                'class'=>'span11'
                            ),

                        ));
            ?>

        </div>
    </div>


    <!--  แถว 3 //// -->
    <div class="row-fluid">
        <div class="span3">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'link',
                'type' => 'inverse',
                'label' => 'view',
                'icon' => 'list-alt white',
                'htmlOptions' => array(
                    'class' => 'span4',
                    'style' => 'margin:25px 10px 0px 0px;',
                    'id' => 'gentReport'
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
                url: "GenR1",
                cache:false,
                data: {date_start:$("#date_start").val(),date_end:$("#date_end").val()
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
        url: "printVendor",
        data: {fiscalyear:$("#fiscalyear").val(),project: $("#project").val(),monthEnd:$("#monthEnd").val(),yearEnd:$("#yearEnd").val(),workcat:$("#workcat").val()
              },
        success:function(response){
            window.open("../tempReport.pdf", "_blank", "fullscreen=yes");

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