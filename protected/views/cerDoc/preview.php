<script type="text/javascript" src="/engstd/themes/bootstrap/js/pdfobject.js"></script>

<?php 
	
	echo '<script type="text/javascript">
		window.onload = function (){

									$.ajax({
	                                    url: "../genPDF",
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
?>
<div id="printcontent" style="" ></div>