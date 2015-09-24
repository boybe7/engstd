<?php
$this->breadcrumbs=array(
    'รายงาน',
);

?>

<script type="text/javascript">
    
    $(function(){
        //autocomplete search on focus      
        $("#cer_no,#contract_no").autocomplete({
       
                minLength: 0
            }).bind('focus', function () {
                $(this).autocomplete("search");
      });

  });


</script>

<h3>สรุปใบรับรองคุณภาพ ตามช่วงเวลา</h3>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
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
                                'value'=>$begin,
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
                                'value'=>$end,
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
      
        <div class="span4">
          <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'type' => 'inverse',
                    'label' => 'view',
                    'icon' => 'list-alt white',
                    'url'=>array('create'),
                    'htmlOptions'=>array('class' => 'span4',
                    'style' => 'margin:25px 10px 0px 0px;',),
                )); 

                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'link',
                    'type' => 'success',
                    'label' => 'Excel',
                    'icon' => 'excel',
                    'htmlOptions' => array(
                        'class' => 'span4',
                        'style' => 'margin:25px 10px 0px 0px;padding-left:0px;padding-right:0px',
                        'id' => 'exportExcel'
                    ),
                ));

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
        'No.'=>array(
                    'header'=>'ลำดับ',
                    'headerHtmlOptions' => array('style' => 'width:5%;text-align:center;background-color: #eeeeee'),                        
                'htmlOptions'=>array(
                            'style'=>'text-align:center'

                      ),
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                  ),
        'cer_date'=>array(
                'header' => 'วันที่ออกใบรับรองฯ',
                'value'=>'$data->cer_date',
                //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),                       
                'htmlOptions'=>array('style'=>'text-align:center;')
        ),
        'cer_no'=>array(
                'header' => 'เลขที่',
                'value'=>'$data->cer_no',
                //'value' => 'CHtml::link($data->cer_no, Yii::app()->createUrl("cerDoc/preview",array("id"=>$data->cer_id)))',
                'type'  => 'raw',
                //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
                'headerHtmlOptions' => array('style' => 'width:12%;text-align:center;background-color: #f5f5f5'),                       
                'htmlOptions'=>array('style'=>'text-align:center;')
        ),
        'contract_no'=>array(
                'header' => 'สัญญา',
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
                'htmlOptions'=>array('style'=>'text-align:left;')
        ),
        'vend_id'=>array(
                'header' => 'ผู้ผลิต/ผู้จัดส่ง',
                'value'=>'$data->vend_id',
                //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),                       
                'htmlOptions'=>array('style'=>'text-align:left;')
        ),
        'prod_id'=>array(
                'header' => 'ประเภท',
                'value'=> array($this,'gridGetProd'),
                //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),                       
                'htmlOptions'=>array('style'=>'text-align:center;')
        ),
        'cer_oper_date'=>array(
                'header' => 'วันที่ตรวจโรงงาน',
                'value'=>'$data->cer_oper_date',
                //'filter'=>CHtml::activeTextField($model, 'cer_no',array("placeholder"=>"ค้นหาตาม".$model->getAttributeLabel("cer_no"))),
                'headerHtmlOptions' => array('style' => 'width:15%;text-align:center;background-color: #f5f5f5'),                       
                'htmlOptions'=>array('style'=>'text-align:center;')
        ),
    ),
));


Yii::app()->clientScript->registerScript('printReport', '
$("#printReport").click(function(e){
    e.preventDefault();

    $.ajax({
        url: "printR2",
        data: {date_start:$("#cer_date_begin").val(),date_end:$("#cer_date_end").val()
              },
        success:function(response){
            window.open("../print/tempReport.pdf", "_blank", "fullscreen=yes");

        }

    });

});
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('exportExcel', '
$("#exportExcel").click(function(e){
    e.preventDefault();
    window.location.href = "R2Excel?date_start="+$("#cer_date_begin").val()+"&date_end="+$("#cer_date_end").val();



});
', CClientScript::POS_END);
?>