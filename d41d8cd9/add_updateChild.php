<?php
	
	$dbhost ="localhost";
	$dbuser ="root";
	$dbpwd ="";
	$db = "nutritional_profiling";
	$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $db);

	if(!$conn){
		die("Could not connect:" .mysql_error());

	}



	if(isset($_POST['btn-add']))	
	
	{
	
		$ethnicity =$_POST['ethnicity'];	
		$firstname =$_POST['fname'];
		$lastname = $_POST['lname'];
		$birthday = $_POST['bday'];
		$assistance = $_POST['assistance'];
		$ID = $_POST['id'];
		$gender = $_POST['sex'];
		$status = $_POST['status'];
		$weight = $_POST['weight'];
		
		
		if($ID == "" and $firstname =""){
				echo "<h1>Error</h1>";
		}
		else{
		
		$sql = "INSERT INTO Children (ethnicity, firstname, lastname, birthday, assistance, studID, gender, status, weight) VALUES ('$ethnicity', '$firstname', '$lastname', '$birthday', '$assistance', '$ID', '$gender', '$status', '$weight')";

		$newData = mysqli_query($conn, $sql);
		
	
		
		}

	}

	else if(isset($_POST['btn-update'])){
		
		$ethnicity =$_POST['ethnicity'];	
		$firstname =$_POST['fname'];
		$lastname = $_POST['lname'];
		$birthday = $_POST['bday'];
		$assistance = $_POST['assistance'];
		$ID = $_POST['id'];
		$gender = $_POST['sex'];
		$status = $_POST['status'];
		$weight = $_POST['weight'];

		function connect($sql, $conn){
			$result = mysqli_query($conn, $sql) or die("error");
			
			
		}

		if($firstname != ""){
			$sql = "UPDATE Children SET firstname ='$firstname' where studID ='$ID'";
			connect($sql, $conn);
		}

		if($lastname != ""){
			$sql = "UPDATE Children SET lastname ='$lastname' where studID ='$ID'";
			connect($sql, $conn);
		}

		if($ethnicity != ""){
			$sql = "UPDATE Children SET ethnicity ='$ethnicity' where studID ='$ID'";
			connect($sql, $conn);
		}
		if($assistance != ""){
			$sql = "UPDATE Children SET assistance ='$assistance' where studID ='$ID'";
			connect($sql, $conn);
		}
		
		if($gender !=""){
			$sql = "UPDATE Children SET gender ='$gender' where studID ='$ID'";
			connect($sql, $conn);
		}

		if($status != ""){
			$sql = "UPDATE Children SET status ='$status' where studID ='$ID'";
			connect($sql, $conn);
		}
		
		if($weight != ""){
			$sql = "UPDATE Children SET weight ='$weight' where studID ='$ID'";
			connect($sql, $conn);
		}
		
		if($birthday != ""){
			$sql = "UPDATE Children SET birthday ='$birthday' where studID ='$ID'";
			connect($sql, $conn);
		}


	}
			   	
	$query3 = "SELECT * FROM Children";
    $result = mysqli_query($conn, $query3);

    if (!$result) die ("Database access failed: " . mysql_error());
    $rows = mysqli_num_rows($result);

    $var = '';
    for ($j = 0; $j < $rows; ++$j){
        $row = mysqli_fetch_row($result);       

        $var = $var . 
                    "<tr>" . 
                       	"<td class=''>$row[0]</td>" . 
                        "<td class=''>$row[1]</td>" . 
                        "<td class=''>$row[2]</td>" . 
                      	"<td class=''>$row[4]</td>" . 
						"<td class=''>$row[3]</td>" . 
						"<td class=''>$row[6]</td>" .
                        "<td class=''>$row[5]</td>" . 
                       	"<td class=''>$row[8]</td>" . 
                        "<td class=''>$row[7]</td>" . 
						"<td><button type='button' class='btn btn-success btn-edit'>Edit </button> | <button class='btn btn-danger'><a href=deleteChild.php?delete_id=$row[0] style ='color:white;';><strong>Delete</strong></a></button></td>".		
                    "</tr>";					
    }
 

	echo <<<_R


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
		<div class="container1">  
			<div>
	            <form role="form" action ="add_updateChild.php" method ="post" class = "form-inline" >
	              <div class="box-body" >
	                  <input name="id" style = "width:200px" class="form-control"  placeholder="ID">
	                  <input name="fname" style = "width:200px" class="form-control"  placeholder="Given Name">      
	                  <input name ="lname" style = "width:200px" class="form-control" placeholder="Last Name">
	                  <input name="bday" style = "width:200px" class="form-control" placeholder="YYYY-MM-DD">
					  <input name="ethnicity" style = "width:200px" class="form-control" placeholder="Enthnicity">				
					  <select name="sex" style = "width:200px" class = "form-control"> 
						<option value = "N/A">Gender</option>
						<option value="Female">Female</option>
						<option value="Female">Male</option>
					  </select>				
					  <select name="assistance" style = "width:200px" class = "form-control"> 
						<option value = "N/A">Assistance</option>
						<option value="4Ps">4Ps</option>
					    <option value="Non-4Ps">Non-4Ps</option>
					  </select>				
	                  <input name="weight" class="form-control" style = "width:200px" placeholder="Weight in kg">			
					  <select name="status" style = "width:200px" class = "form-control"> 
						<option value = "N/A">Status</option>
						<option value="Normal">Normal</option>
						<option value="Underweight">Underweight</option>
						<option value="Overweight">Overweight</option>	
						<option value="Severely Underweight">Severely Underweight</option>
					  </select>
						<button name = "btn-add" type="submit" class="btn btn-primary" style="width:100px;">Add</button>
						<button type="submit" name ="btn-update" class="btn btn-primary" style="width:96px;">Update</button>
             		</div>
				</form>
		</div>
		<script>
			$(document).on('click', '.btn-edit',function(){
				_trEdit = $(this).closest('tr');
				var _id = $(_trEdit).find('td:eq(0)').text();
				var _fname = $(_trEdit).find('td:eq(1)').text();
				var _lname = $(_trEdit).find('td:eq(2)').text();
				var _bday = $(_trEdit).find('td:eq(4)').text();
				var _ethnicity = $(_trEdit).find('td:eq(3)').text();
				var _sex = $(_trEdit).find('td:eq(5)').text();
				var _assistance = $(_trEdit).find('td:eq(6)').text();
				var _weight = $(_trEdit).find('td:eq(8)').text();
				var _status = $(_trEdit).find('td:eq(8)').text();
				
				$('input[name="id"]').val(_id);
				$('input[name="fname"]').val(_fname);
				$('input[name="lname"]').val(_lname);
				$('input[name="bday"]').val(_bday);
				$('input[name="ethnicity"]').val(_ethnicity);
				$('input[name="sex"]').val(_sex);
				$('input[name="assistance"]').val(_assistance);
				$('select[name="weight"]').val(_weight);
				$('input[name="status"]').val(_status);
				alert("Added to the database");
	}); 
		</script>
		<div>
			<table class="table">
				<thead>
					<tr>
						<th>IDq</th>
						<th>FirstName</th>
						<th>LastName</th>
						<th>Ethnicity</th>
						<th>Birthday</th>
						<th>Gender</th>
						<th>Assistance</th>
						<th>Weight</th>
						<th>Status</th>
				</tr>
				</thead>
				<tbody>$var</tbody>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript" src = "basin.js"></script>
	</body>
</html>



_R;
?>
