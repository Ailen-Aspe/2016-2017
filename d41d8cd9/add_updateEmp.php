<?php
	
	
	$dbhost ="localhost";
	$dbuser ="root";
	$dbpwd ="";
	$db = "nutritional_profiling";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $db);
	
	if(!$conn){
		die('Could not connect:' .mysql_error());
	}
	

	
	//dependent with html file
	
	if(isset($_POST['btn-addEmp'])){
		$empID =$_POST['id'];
		$fname =$_POST['firstname'];
		$lname = $_POST['lastname'];	
		$position =$_POST['position'];

		$sql = "INSERT INTO Employee (empID, FirstName, LastName, Position) values('$empID', '$fname', '$lname', '$position')";

		
		if($empID == "" or $fname ==""){
			"alert('Empty Data')";
		}
		else{
			$data = mysqli_query($conn, $sql);
			echo "Added";
		}
	
	}

	else if(isset($_POST['btn-updateEmp'])){
		$empID =$_POST['id'];
		$fname =$_POST['firstname'];
		$lname = $_POST['lastname'];	
		$position =$_POST['position'];

		function connect($sql, $conn){
			$result = mysqli_query($conn, $sql) or die("error");
			
			
		}
		if($fname!= ""){
			$sql = "UPDATE Employee SET FirstName ='$fname' where empID ='$empID'";
			connect($sql, $conn);
		}

		if($lname != ""){
			$sql = "UPDATE Employee SET LastName ='$lname' where empID ='$empID'";
			connect($sql, $conn);
		}

		if($position != ""){
			$sql = "UPDATE Employee SET Position ='$position' where empID ='$empID'";
			connect($sql, $conn);
		}
		


	}
		$query3 = "SELECT * FROM Employee";
		$result = mysqli_query($conn, $query3);

		if (!$result) die ("Database access failed: " . mysql_error());
		$rows = mysqli_num_rows($result);

		$var = '';
		for ($j = 0; $j < $rows; ++$j){
		    $row = mysqli_fetch_row($result);       

		    $var = $var . 
		                "<tr>" . 
		             
		                    "<td class=''>$row[1]</td>" . 
		                    "<td class=''>$row[2]</td>" . 
		                  	"<td class=''>$row[3]</td>" . 
							"<td><button class='btn btn-danger'><a href=deleteEmployee.php?delete_id=$row[0] style ='color:white;';><strong>Delete</strong></a></button></td>".						
		                    
		                "</tr>";

										
		}

echo <<<_A
	<html>

		<head>
			<link rel="stylesheet" href="css/bootstrap.min.css"> 
		<link rel="stylesheet" href="css/bootstrap-theme.min.css"> 
		<link rel="stylesheet" href="try.css"> </link>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script type="text/javascript" src = "basin.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse">        
              <div class="container-fluid">
               <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a id = "home" class="navbar-brand" href="#"><strong>Nutritional Status </strong><small>Information System</small></a>
                </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav"> </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                      <a href="CSC151.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-inverse btn-ms"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></button></a>
          
                      <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Log out</a></li>
                      </ul>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
          </nav>
       <div id="wrapper">
        <!-- Sidebar -->
          <div id="sidebar-wrapper">
              <ul class="sidebar-nav">
                  <li class="sidebar-brand alert-success" role="alert"><a href="#"> Welcome!</a></li>
                   <nav class="navigation">
                    <ul class="mainmenu">
                      <li><a href="try.html">Home</a></li>
                      <br>
                      <li><a href="">Children</a>
                        <ul class="submenu">
                          <li><a id="add" href="add_updateChild.php">Add a Child</a></li>
                          <li><a id="search_child" href="viewChildren.php">Search Child</a></li>
                        </ul>
                      </li>
                      <br>
                      <li><a href="">Daycare Center</a>
                        <ul class="submenu">
                          <li><a id="daycare_add" href="add_updateDCC.php">Add a Daycare Center</a></li>
                          <li><a id="info_daycare" href="viewDCC.php">Information of Daycare Center</a></li>
                        </ul>
                      </li>
                      <br>
                      <li><a href="">Employee</a>
                        <ul class="submenu">
                          <li><a id = "employee_add" href="add_updateEmp.php">Add Employee</a></li>
                          <li><a id ="employee_search"  href="viewEmployee.php">Search Employee</a></li>
                        </ul>
                      </li>
                      <br>
                    <li><a href="">Contact us</a></li>
                 </ul>
                </nav>        
              </ul>     
          </div>
	<div class="container3">
			<form class ="form-inline" action ="add_updateEmp.php" method ="post">
				<div class="form-group">
					<input name="id" style = "width:200px" class="form-control"  placeholder="ID">
					<input name="firstname" style = "width:200px" class="form-control"  placeholder="First Name">
					<input name="lastname" style = "width:200px" class="form-control"  placeholder="Last Name">
					<input name="position" style = "width:200px" class="form-control"  placeholder="Position">
					<button type="submit" name = "btn-addEmp" class="btn btn-primary">Add</button>
					<button type="submit" name = "btn-updateEmp" class="btn btn-primary">Update</button>
				</div>
			</form>
			<hr>
			<table class="table">
				<thead>
					<tr>
						
						<th>FirstName</th>
						<th>LastName</th>
						<th>Position</th>
						
				</tr>
				</thead>
				<tbody>$var</tbody>
		</div>
		</body>
	</html>
_A;

?>
