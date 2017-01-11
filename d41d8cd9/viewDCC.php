<!DOCTYPE html>
<?php
			$con=mysqli_connect("localhost","root","","nutritional_profiling");

					if(isset($_POST['btn-search'])){
						$data =$_POST['data'];
				
						$result1 =mysqli_query($con, "Select * from Daycare_Center where DayCareID = '$data' or Center_name= '$data'");
						
						
			
						
						//$row2 = mysqli_fetch_array($result2);
				
									
							while($row = mysqli_fetch_array($result1))
							{
					
							$id = $row[0];
							$fname= $row[1];
							$lname = $row[2];
							$query2 =mysqli_query($con, "Select count(studID) from studyin where daycareID = '$id'");
							$row2 =mysqli_fetch_array($query2);
							$studs =$row2[0];	
							
						echo<<<A
								<div class="basin alert-success">
									<h2>Results</h2>
									
									<form class ="form-inline ">
											<label for="contain" name="name1">ID</label>
											<input class="form-control" id ='cid' type="text" />
											<label for="contain" name="name1">School</label>
											<input class="form-control" id ='school' type="text" />
											<label for="contain" name="name1">Barangay</label>
											<input class="form-control" id ='barangay' type="text" />
											<label for="contain" name="name1">No. of Students</label>
											<input class="form-control" id ='studs' type="text" />		
									</form>
									<br>
							</div>	
											<script>
															document.getElementById('cid').value = '$id';
															document.getElementById('school').value = '$fname';
															document.getElementById('barangay').value = '$lname';
															document.getElementById('studs').value = '$studs';					
											</script>


A;
								
							}
					}
				
					if (mysqli_connect_errno())
					  {
					  echo "Failed to connect to MySQL: " . mysqli_connect_error();
					  }

					$result = mysqli_query($con,"SELECT * FROM Daycare_Center");
					$var ='';
					while($row = mysqli_fetch_array($result)){
						 	$var = $var. 
								"<tr>" . 
						    			 "<td class=''>$row[0]</td>" .
						                 "<td class=''>$row[1]</td>" . 
						                 "<td class=''>$row[2]</td>" . 
						          
															
				             	"</tr>";
					}	
					

mysqli_close($con);

?>
<?php
echo<<<A
<html>
		<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="css/bootstrap.min.css"> 
				<link rel="stylesheet" href="css/bootstrap-theme.min.css"> 
				<link rel="stylesheet" href="try.css"> </link>
				<script src="js/bootstrap.min.js"></script>
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
				<div class="container">
				        <div class="row">
				            <h3 style='color:Skyblue;'>Lists of Daycare Center</h3>
						</div>
							<div align = "right">
								<form method ="POST" action ="viewDCC.php">
										<input name ="data" style='color:black;'>
										<button name ="btn-search" class= "btn btn-primary" style='color:black;'>Search</button>
								</form>
				<hr>
				</div>
				        <div class="row">
				            <table class="table table-bordered">
				              <thead>
				                <tr>
								  <th>ID</th>
				                  <th>School Name</th>
				                  <th>Barangay</th>							
				                </tr>
				              </thead>
				              <tbody>
												$var
				              </tbody>
								    </table>
								</div>
				</div> <!-- /container -->
			</body>
</html>
A;

?>
