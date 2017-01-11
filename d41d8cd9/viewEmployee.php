<!DOCTYPE html>
<?php
			$con=mysqli_connect("localhost","root","","nutritional_profiling");

					if(isset($_POST['btn-search'])){
						$data =$_POST['data'];
						$result =mysqli_query($con, "Select * from Employee where FirstName = '$data' or LastName = '$data' or Position ='$data'");
							while($row = mysqli_fetch_array($result))
							{
								function displayresult($id, $name, $lname, $pos){
echo <<<_data
<div>
											<h4><b>Search Results</b></h4>
											<form>
												<table>
													<tr>
														<td align="right">ID</td>
														<td align="left"><input type="text" id='id' /></td>
													</tr>
													<tr>
														<td align="right">First Name:</td>
														<td align="left"><input type="text" id='fname' /></td>
													</tr>
													<tr>
														<td align="right">Last Name:</td>
														<td align="left"><input type="text" id ='lname' /></td>
													</tr>
													<tr>
														<td align="right">Email:</td>
														<td align="left"><input type="text" id = 'pos' /></td>
													</tr>
													
												</table>
											</form>
										
									
											<script>
												document.getElementById('id').value = '$id';
												document.getElementById('fname').value = '$name';
												document.getElementById('lname').value = '$lname';
												document.getElementById('pos').value = '$pos';
											</script>

										</div>
										


_data;
}
									if($row['FirstName']==$data){
											$id =$row['empID'];
											$name =$data;
											$lname =$row['LastName'];
											$pos =$row['Position'];

											displayresult($id, $name, $lname, $pos);
									}
									else if($row['LastName']==$data){
											$id =$row['empID'];
											$name =$row['FirstName'];
											$lname =$data;
											$pos =$row['Position'];

											displayresult($id, $name, $lname, $pos);
									}
									else if($row['Position']==$data){
											$id =$row['empID'];
											$name =$row['FirstName'];
											$lname =$_POST['LastName'];
											$pos =$data;

											displayresult($id, $name, $lname, $pos);
									}
								

						}
					}
				
					if (mysqli_connect_errno())
					  {
					  echo "Failed to connect to MySQL: " . mysqli_connect_error();
					  }

					$result = mysqli_query($con,"SELECT * FROM Employee");
					
					$rows = mysqli_num_rows($result);

					$var = '';
					for ($j = 0; $j < $rows; ++$j){
						  $row = mysqli_fetch_row($result);       

						  $var = $var . 
						              "<tr>" . 
						    			"<td class=''>$row[0]</td>" .
						                "<td class=''>$row[1]</td>" . 
						                "<td class=''>$row[2]</td>" . 
						                "<td class=''>$row[3]</td>" . 
										"<td><button class='btn btn-danger'><a href=deleteEmployee.php?delete_id=$row[0] style ='color:white;' ><strong>Delete</strong></a></button></td>".
 												
                        					
				              		"</tr>";
				
					}
					
					

mysqli_close($con);

?>
<?php
echo <<<_A
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
				            <h3 style='color:Skyblue;'>LIST of EMPLOYEES</h3>
								</div>
									<div align = "right">
										<form method ="POST" action ="viewEmployee.php">
											<input style='color:black;' name ="data">
											<button name ="btn-search" class="btn btn-primary" style='color:black;'>Search</button>
										</form>
									</div>
				        
				        <div class="row">
				            <table class="table">
				              <thead>
				                <tr>
							      <th>ID</th>
				                  <th>First Name</th>
				                  <th>Last Name</th>
				                  <th>Position</th>							
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
_A;
?>
