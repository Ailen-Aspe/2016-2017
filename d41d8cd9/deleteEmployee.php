<?php
	
	$dbhost ="localhost";
	$dbuser ="root";
	$dbpwd ="";
	$db = "nutritional_profiling";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $db);

	$select = "DELETE from Employee where empID='".$_GET['delete_id']."'";
	$query = mysqli_query($conn, $select) or die($select);
	header ("Location: add_updateEmp.php");
?>
