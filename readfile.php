<html>
<meta charset="UTF-8" />
<body>
<?php



function connect_database()
{
	$server = "localhost";
	$username ="root";
	$sqlpassword = "P@ssw0rd";
	$webdb ="engstd";
	   $link = mysql_connect($server,$username,$sqlpassword);
	   mysql_query("SET NAMES UTF8");
	   if ($link)
	   {
	      if (!mysql_select_db("$webdb"))
	      {
	         print( "Error  :  Can't Open Database");   
	      }
	   }
	   else
	   {
	      print("Error  :  Can't connected Mysql Server");
	   }
		//$strSQL = 'SET CHARACTER SET tis620';
		//$dbquery = mysql_query($strSQL, $link);  
	   return $link;
}
function close_database($link)
{
   if (!mysql_close($link))
   {
      print("Error  :  Can't not close database");
   }
}


$conn = connect_database();

// while ($data = mysql_fetch_array($dbquery)) {
// 	echo '<pre>';
//     print_r ($data).'</pre>';
// }

$text = file('price.txt');
foreach($text as $value){
	$data2 = preg_split('/\s+/', $value);
	$strSQL = 'select prod_id from m_product where prod_code="'.$data2[0].'" ';
	$dbquery = mysql_query($strSQL, $conn) or die(mysql_error());  
	//echo($strSQL);
	echo '<pre>';
    	print_r ($data2).'</pre>';
    $data = mysql_fetch_array($dbquery);
    if(!empty($data))
    {
    	 $id = $data[0];
    	 $sql = "update m_product set price = '".$data2[1]."',factor = '".$data2[2]."' where prod_id='$id'";
         mysql_query($sql) or die(mysql_error());  
    }
    $strSQL = 'select * from m_product where prod_code="'.$data2[0].'" ';
	$dbquery = mysql_query($strSQL, $conn) or die(mysql_error());  
	$data = mysql_fetch_array($dbquery);
    //if(empty($data))
    //{
    	echo '<pre>';
    	print_r ($data).'</pre>';
    //}
}



close_database($conn);
?>
</body></html>