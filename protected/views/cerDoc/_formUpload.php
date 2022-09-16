<script type="text/javascript">
function checkFile(input){

  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if((/\.(doc|docx|xls|xlsx|pdf|jpg|jpeg|png|gif)$/i).test(input.value) ) {
     if(fileSize > 5)
     {
     	   alert('ไฟล์มีขนาดมากกว่า 5 MB !!!!');
     	   $('input[type=file]').val(null) ;
     } 
   }else {
  	 alert("อัพโหลดเฉพาะไฟล์เอกสารหรือรูปภาพเท่านั้น !!!");  
  	 $('input[type=file]').val(null) ;
   } 
}

</script> 
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'upload-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data','class'=>''),
)); ?>



	<div class="row-fluid ">
		<div class="span5">
			  <label for="attach_file1" >ไฟล์แนบ (ขนาดไม่เกิน 5 MB)</label>

			<?php
		
				echo "<input type='hidden' name='attach_file' value='".$model->filename."'>";
			
			echo $form->fileField($model,'filename',array('style'=>'width:200px;','onChange'=>'checkFile(this)','title'=>'Only document allowed'));?>
		
			
		</div>
	</div>	

	

<?php $this->endWidget(); ?>