<?php
	
	$dbhost ="localhost";
	$dbuser ="root";
	$dbpwd ="";
	$db = "nutritional_profiling";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $db);

	$select = "DELETE from Daycare_Center where DayCareID='".$_GET['delete_id']."'";
	$query = mysqli_query($conn, $select) or die($select);
	echo "<script>alert('Successfully Deleted'); </script>";
	header ("Location:add_updateDCC.php");
?>
