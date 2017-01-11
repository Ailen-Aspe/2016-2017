<?php
	
	
	$dbhost ="localhost";
	$dbuser ="root";
	$dbpwd ="";
	$db = "nutritional_profiling";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $db);

	if(!$conn){
		die("Could not connect:" .mysql_error());

	}
	//dependent with html file
	
	
	if(isset($_POST['btn-addDCC'])){
		$name =$_POST['school'];	
		$id =$_POST['id'];
		$locale=$_POST['barangay'];
	
		
		$sql = "INSERT INTO Daycare_Center(DayCareID, Center_name, Barangay) values( '$id','$name', '$locale')";

		
		if($name == "" or $id ==""){


				echo "<script>alert('Empty value'); </script>";

		}
		else{
			$data = mysqli_query($conn, $sql) or die("error");
			echo "<script>alert('Successfully Added'); </script>";
		}
		
	
	}

	else if(isset($_POST['btn-updateDCC'])){
		$name =$_POST['school'];	
		$id =$_POST['id'];
		$locale=$_POST['barangay'];
	
		function connect($sql){
			$result = mysqli_query($conn, $sql);
			if($result){
				echo "Updated!";
			}
		}
		if($dccname !=""){
			$sql = "Update Daycare_Center set Center_name ='$dccname' where DayCareID ='$daycareID'";
			connect($sql, $conn);
		
		}
		if($locale !=""){
			$sql = "Update Daycare_Center set Barangay ='$locale' where DayCareID ='$daycareID'";
			connect($sql, $conn);
		}
		
		
		
	}

	$query = "SELECT * from Daycare_Center";
	$result = mysqli_query($conn, $query);
	
	if (!$result) die ("Database access failed: " . mysql_error());
    	$rows = mysqli_num_rows($result);

	$var ='';
	for ($j = 0; $j < $rows; ++$j){
        $row = mysqli_fetch_row($result);       

        $var = $var . 
                    "<tr>" . 
                       
                        "<td class=''>$row[0]</td>" . 
                        "<td class=''>$row[1]</td>" . 
                      	"<td class=''>$row[2]</td>" . 
			
 			"<td><button class='btn btn-danger'><a href=deleteDCC.php?delete_id=$row[0] style ='color:white;' ><strong>Delete</strong></a></button></td>".
 																			
                        
                    "</tr>";

										
    }
echo <<<_A
	<html>

		<head>
			<link rel="stylesheet" href="css/bootstrap.min.css"> 
			<link rel="stylesheet" href="css/bootstrap-theme.min.css"> 
			<link rel="stylesheet" href="try.css">
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

                <!-- Collect the nav links, forms, and other content for toggling -->
                
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
	<div class="container4">
			<form class ="form-inline" action ="add_updateDCC.php" method ="post">
				<div class="form-group">
					<input name="id" style = "width:225px" class="form-control"  placeholder="ID">
					<input name="school" style = "width:225px" class="form-control"  placeholder="SCHOOL">
					<input name="barangay" style = "width:225px" class="form-control"  placeholder="BARANGGAY">
				
					<button type="submit" name = "btn-addDCC" class="btn btn-primary" style="width:85px" >Add</button>
					<button type="submit" name = "btn-updateDCC" class="btn btn-primary" style="width:85px">Update</button>
				</div>
			</form>
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>DayCare Center</th>
						<th>Barangay</th>
						<th>Action</th>
				</tr>
				</thead>
				<tbody>	$var</tbody>
		</div>
		</body>
	</html>
_A;
?>

