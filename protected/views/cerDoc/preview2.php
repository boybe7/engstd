<script type="text/javascript" src="/engstd/themes/bootstrap/js/pdfobject.js"></script>

<?php 
	
	echo '<script type="text/javascript">
		window.onload = function (){

									 $.ajax({
	                                    url: "../genPDF2",
	                                    dataType: "json",
	                                    data: {
	                                        id: '.$id.',
	                                       
	                                    },
	                                    success: function (response) {
	                                            //console.log(response)
	                                            file = "../../print/"+response;
	                                            $("#printcontent").html("<p>It appears you dont have Adobe Reader or PDF support in this web browser. <a href="+file+">Click here to download the PDF</a></p>")
	                                            var success = new PDFObject({ url: "../../print/"+response,height: "800px" }).embed("printcontent");     
	                                            
	                                    }
	                                })

	        
	   }; 
	</script>';

	// $details = Yii::app()->db->createCommand()
	// 				->select('*')
	// 				->from('c_cer_detail ct')	
	// 				//->join('c_cer_detail ct', 'cd.cer_id=ct.cer_id')
 //          			->join('m_product p', 'p.prod_id=ct.prod_id')
	// 				->where('ct.cer_id='.$model->cer_id)		
 //          			//->group('detail')			                   
	// 				->queryAll();
	// 	print_r($details);
?>

<div id="printcontent" style="" ></div>