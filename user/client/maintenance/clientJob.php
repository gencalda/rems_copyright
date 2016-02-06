<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
?>

<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">Job Posting</li>
		</ul>
	</div>



	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			
		
			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="job.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Browse Jobs</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="clientJobUpdate.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update Job</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="clientJobPostingAdd.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-plus"> </span>Add Job</a></li>
					</ul>
			  	</div>

			</nav>
			

			<h4 class="alert-info well-lg instruction">Job Posting.</h4> 		
			<br /><br />
			<div class='container-fluid content'>
				<form method="POST" action="#">
					<div class="form-group col-md-5">
						<?php	
							
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
							if (!$con)
							{
								die('Could not connect: ' . mysql_error());
							}
						
							mysql_select_db("$db_database", $con);
							$result = mysql_query("SELECT * FROM client ORDER BY clientID");
														
							echo "<select type='position' class='form-control search' id='searchClient' name='searchClient'>";
						?>
						<option value="" selected>Search Client</option>
						<?php		
						echo"<option value='All Client'>All Client</option>";	
							while ($row = mysql_fetch_array($result))
							{
								echo "<option value='" . $row['clientID'] . "'> " . $row['clientName'] . " </option>";
							}
							echo "</select>"; 
							mysql_close($con);
							
						?>
					
					</div>

					<div class="form-group col-md-5">
							<input type="text"
									class="form-control" 
									name="searchClientName" 
									value='' 
									placeholder="Type any part of client name ex. 'pen'"
									maxlength="250"   
									
							/>
						</div>


					
						<div class="form-group col-md-2">
								
								<button type="submit" 
										class="btn btn-primary btn-md btn-block"
										name ="submit">
									 	Search &nbsp;
									 <span class="glyphicon glyphicon-search"></span>
				      			</button>
				      		
				      	</div>
					<br /><br /><br />
				</form>

		

				<div class="container-fluid table-responsive content">
					<?php
						
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
							if (!$con)
							{
								die('Could not connect: ' . mysql_error()); 
							}
							mysql_select_db("$db_database", $con);
							$result = mysql_query("SELECT * FROM tbl_job_posting LEFT JOIN tbl_client ON tbl_client.clientId = tbl_job_posting.clientId WHERE tbl_job_posting.jobStatus = 1
							AND tbl_client.clientId = $_SESSION[login_userId]");
							echo"<div class='outer'>
							<div class='inner'>";
							echo "<table class='table table-responsive table-hover table-striped'>";
							echo "<thead>";
							echo "<tr class='tablehead'>
								<td>Job Name</td>
								
								
								</tr>
							</thead>";

							while($row = mysql_fetch_array($result)) 
							{
								echo "<tr>";
								echo "<th>" . $row['jobName'] . "</th>";
								echo "</tr>";
								
							}

							echo "</table>";
							echo"</div>
							</div>";
							mysql_close($con);
						
					?>
				</div>
			</div>

		</div>
	</div>


<?php
	include ('../footer.php');
?>