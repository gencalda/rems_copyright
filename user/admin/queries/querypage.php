<?php
		$root = realpath(dirname(__FILE__) . '/../../..');
		include($root . '/include/header.php');
		include($root . '/config/connection.php');
		include ('../adminNav.php');	
		$type = $_GET['type'];
		$where=array();
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
			
		mysql_select_db("$db_database", $con);

?>

		<div class='container-fluid content'>
			<ul class="breadcrumb">
				<li>Queries</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li class="active"><?php echo $type;?></li>
			</ul>
		</div>

<?php
	if($type=='emp')
	{
?>
		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">		
				
				<nav class="navbar nav2 nav navbar-nav">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							<li><h3><a href="client.php?token=<?php echo $main; ?>" style="margin-left:.5em;">All Employees</a></h3></li>
						</ul>
						<ul class="nav navbar-nav pull-right">
							<li><a href="query.php?token=<?php echo $query; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span>&nbsp; Query</a></li>
						</ul>
					</div>
				</nav>
			
				<h4 class="alert-info well-lg instruction">Find Query for all employees.</h4> 		
				<br /><br />
				
		
				<p style="font-size:1.5em;"<strong>Contstraints </strong></p>
				<form method="POST" action="">
					<div class="col-md-2">
						<p style="font-size:1.2em;">Select Client: </p>
						<select class="form-control" id="client" name="client">
						<option value="">Client name</option>
					
						<?php		
								
							$result = mysql_query("SELECT clientId, clientName FROM tbl_client");
							while ($row = mysql_fetch_array($result))
							{
								echo "<option value='" . $row['clientId'] . "'> " . $row['clientName'] . " </option>";	
							}
							
						?>
						</select>
					</div>
					
					<div class="col-md-2">
						<p style="font-size:1.2em;">Select Job: </p>
						<select class="form-control col-md-3" id="job" name="job">
						<option value="">Job name</option>
					
						<?php		
								
							$result1 = mysql_query("SELECT jobName FROM tbl_job_posting");
							while ($row1 = mysql_fetch_array($result1))
							{
								echo "<option value='" . $row1['jobName'] . "'> " . $row1['jobName'] . " </option>";	
							}
							
						?>
						</select>
					</div>
					
					<div class="col-md-2">
						<p style="font-size:1.2em;">Gender: </p>
					
						<input type="radio" name="gender" value="" checked> Any
						<input type="radio" name="gender" value="Male"> Male
						<input type="radio" name="gender" value="Female"> Female
					</div>
					
					
					<div class="col-md-2">
						<p style="font-size:1.2em;">Sort by: </p>
						<select class="form-control col-md-3" id="sort" name="sort">
							<option value="">None</option>
							<option value="jobName">Job name</option>
							<option value="basicFirstName">First Name</option>
							<option value="basicLastName">Last Name</option>
						</select>
					</div>
					
					<div class="col-md-2">
						<p style="font-size:1.2em;">Order by: </p>
					
						<input type="radio" name="sorting" value="ASC" checked> Ascending
						<input type="radio" name="sorting" value="DESC"> Descending
					
					</div>
					
					<div class="form-group col-md-2">
							
							<button type="submit" 
									style="margin-top:2em;"
									class="btn btn-default btn-md btn-block"
									name ="submit">
									Refresh &nbsp;
								 <span class="glyphicon glyphicon-refresh"></span>
							</button>
						
					</div>
				</form>
			</div>
		</div>
<?php
		if(isset($_POST['submit']))
			{
			
				if($_POST['client'] != ""){ $where[] = " AND c.clientId = $_POST[client]";}
				if($_POST['gender'] != ""){ $where[] = " AND personalQualityDesc = '$_POST[gender]'";}
				if($_POST['job'] != ""){ $where[] = " AND jobName = '$_POST[job]'";}
				if($_POST['sort'] != ""){ $where[] = " ORDER BY $_POST[sort] $_POST[sorting]";}
			}
			$whereStr = implode($where);
			$mainquery= "SELECT * 
			FROM tbl_employee a, 
				 tbl_applicant b, 
				 tbl_job_posting c, 
				 tbl_basic_info d,
				 tbl_personal_info e
			WHERE a.applicantId = b.applicantId AND
				  b.basicId = d.basicId AND
				  d.basicId = e.basicId AND
				  personalQualityType = 'gender' AND
				  a.jobPostingId = c.jobPostingId"." ".$whereStr;
			
			$result5 = mysql_query("$mainquery");
?>
				
			<div class="container-fluid table-responsive">
				<div class="col-md-12 wrapper-background">
				
<?php
					echo"<table class='table table-hover table-striped'>";
					echo"<thead class='tablehead'>";
					echo"<th>Last name</th>";
					echo"<th>First name</th>";
					echo"<th>Gender</th>";
					echo"<th>Job</th>";
				
					echo"</thead>";
					while ($row5 = mysql_fetch_array($result5))
					{	
						echo"<tr>";
						echo"<td>".$row5['basicLastName']."</td>";
						echo "<td>".$row5['basicFirstName']."</td>";
						echo "<td>".$row5['personalQualityDesc']."</td>";
						echo "<td>".$row5['jobName']."</td>";
						echo"</tr>";
					}
					echo"</table>";
							
?>
				</div>
			</div>
<?php					

	}
	else if($type=='client')
	{
?>
		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
			
				<nav class="navbar nav2 nav navbar-nav">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							<li><h3><a href="client.php?token=<?php echo $main; ?>" style="margin-left:.5em;">All Client</a></h3></li>
						</ul>
						<ul class="nav navbar-nav pull-right">
							<li><a href="query.php?token=<?php echo $query; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span>&nbsp; Query</a></li>
						</ul>
					</div>
				</nav>
			
				<h4 class="alert-info well-lg instruction">Find Query for all client.</h4> 		
				<br /><br />

			
				<p style="font-size:1.5em;"<strong>Contstraints </strong></p>
				<form method="POST" action="">
					<div class="col-md-3">
						<p style="font-size:1.2em;">Type of business: </p>
							<select class="form-control" id="btype" name="btype">
							<option value="">Business type</option>		
							
							<?php		
									
								$result = mysql_query("SELECT typeOfBusinessId, typeOfBusinessName FROM tbl_type_of_business");
								while ($row = mysql_fetch_array($result))
								{
									echo "<option value='" . $row['typeOfBusinessId'] . "'> " . $row['typeOfBusinessName'] . " </option>";	
								}
								
							?>
							</select>
					</div>
					
					<div class="col-md-3">
						<p style="font-size:1.2em;">Contract Status: </p>
						<input type="radio" name="stat" value="" checked> Any
						<input type="radio" name="stat" value="on-going"> On-going
						<input type="radio" name="stat" value="not started"> Not started
						<input type="radio" name="stat" value="expired"> Expired
					</div>
					
					
					
					
					<div class="col-md-2">
						<p style="font-size:1.2em;">Contract Status: </p>
						<select class="form-control col-md-2" id="sort" name="sort">
							<option value="">None</option>
							<option value="clientName">Client Name</option>
							<option value="contractStartDate">Start of Contract</option>
							<option value="contractEndDate">End of Contract</option>
						</select>
					</div>
					
					<div class="col-md-2">
						<p style="font-size:1.2em;">Order by: </p>
					
						<input type="radio" name="sorting" value="ASC" checked> Ascending
						<input type="radio" name="sorting" value="DESC"> Descending
					
					</div>
					
					<div class="form-group col-md-2">
							
							<button type="submit" 
									style="margin-top:2em;"
									class="btn btn-default btn-md btn-block"
									name ="submit">
									Refresh &nbsp;
								 <span class="glyphicon glyphicon-refresh"></span>
							</button>
						
					</div>
					
				</form>
			</div>
		</div>
	
<?php
			
		if(isset($_POST['submit']))
		{		
			if($_POST['btype'] != ""){ $where[] = " AND b.typeOfBusinessId = $_POST[btype]";}
			if($_POST['stat'] != ""){ $where[] = " AND contractStatus = '$_POST[stat]'";}
			if($_POST['sort'] != ""){ $where[] = " ORDER BY $_POST[sort] $_POST[sorting]";}
		}
		$whereStr = implode($where);
		$mainquery= "SELECT * 
		FROM tbl_client a, 
			 tbl_type_of_business b,
			 tbl_contact_info c,
			 tbl_contract d
		WHERE a.clientId = c.clientId AND  
			  contactDevice = 'Landline' AND
			  a.clientId = d.clientId AND
			  a.typeOfBusinessId = b.typeOfBusinessId "." ".$whereStr;
		
		$result4 = mysql_query("$mainquery");
?>
		
		<div class="container-fluid table-responsive">
			<div class="col-md-12 wrapper-background">

<?php
			echo"<table class='table table-hover table-striped'>";
			echo"<thead class='tablehead'>";
			echo"<th>Client Name</th>";
			echo"<th>Type of business</th>";
			echo"<th>Contact number</th>";
			echo"<th>Contract start</th>";
			echo"<th>Contract end</th>";
			echo"</thead>";
			while ($row4 = mysql_fetch_array($result4))
			{	
				echo"<tr>";
				echo"<td>".$row4['clientName']."</td>";
				echo "<td>".$row4['typeOfBusinessName']."</td>";
				echo "<td>".$row4['contactNumber']."</td>";
				echo "<td>".$row4['contractStartDate']."</td>";
				echo "<td>".$row4['contractEndDate']."</td>";
				echo"</tr>";
			}
			echo"</table>";
?>			
			

			</div>
		</div>
	
<?php
	}
	else if($type=='job')
	{
?>

		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
			
				<nav class="navbar nav2 nav navbar-nav">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							<li><h3><a href="client.php?token=<?php echo $main; ?>" style="margin-left:.5em;">All Job</a></h3></li>
						</ul>
						<ul class="nav navbar-nav pull-right">
							<li><a href="query.php?token=<?php echo $query; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span>&nbsp; Query</a></li>
						</ul>
					</div>
				</nav>
			
				<h4 class="alert-info well-lg instruction">Find Query for all jobs.</h4> 		
				<br /><br />
			
				<p style="font-size:1.5em;"<strong>Contstraints </strong></p>
			
					<form method="POST" action="">
						<div class="col-md-3">
							<p style="font-size:1.2em;">Select Client: </p>
							<select class="form-control" id="client2" name="client2">
							<option value="">Client Name</option>
							
							<?php		
									
								$result = mysql_query("SELECT clientId, clientName FROM tbl_client");
								while ($row = mysql_fetch_array($result))
								{
									echo "<option value='" . $row['clientId'] . "'> " . $row['clientName'] . " </option>";	
								}
								
							?>
							</select>
						</div>
						
						<div class="col-md-3">
							<p style="font-size:1.2em;">Job Status: </p>
							<input type="radio" name="jstat" value="" checked> Any
							<input type="radio" name="jstat" value="1"> Active
							<input type="radio" name="jstat" value="0"> No vacancy
							 
						</div>
						
						<div class="col-md-2">
							<p style="font-size:1.2em;">Sort By: </p>
							<select class="form-control" id="sort" name="sort">
								<option value="">None</option>
								<option value="jobName">Job Name</option>
								<option value="clientName">Client Name</option>
							</select>
						</div>
						
							
						<div class="col-md-2">
							<p style="font-size:1.2em;">Order by: </p>
						
							<input type="radio" name="sorting" value="ASC" checked> Ascending
							<input type="radio" name="sorting" value="DESC"> Descending
						
						</div>
						
						<div class="form-group col-md-2">
								
								<button type="submit" 
										style="margin-top:2em;"
										class="btn btn-default btn-md btn-block"
										name ="submit">
										Refresh &nbsp;
									 <span class="glyphicon glyphicon-refresh"></span>
								</button>
							
						</div>
					</form>
			</div>
		</div>
	
<?php
			if(isset($_POST['submit']))
			{		
				if($_POST['client2'] != ""){ $where[] = " AND b.clientId = $_POST[client2]";}
				if($_POST['jstat'] != ""){ $where[] = " AND jobStatus = '$_POST[jstat]'";}
				if($_POST['sort'] != ""){ $where[] = " ORDER BY $_POST[sort] $_POST[sorting]";}
			}
			$whereStr = implode($where);
			$mainquery= "SELECT * 
			FROM tbl_job_posting a, 
				 tbl_client b
			WHERE a.clientId = b.clientId"." ".$whereStr; 
			
			$result3 = mysql_query("$mainquery");
?>
			<div class="container-fluid table-responsive">
				<div class="col-md-12 wrapper-background">
<?php
					echo"<table class='table table-hover table-striped'>";
					echo"<thead class='tablehead'>"; 
					echo"<th>Job Name</th>";
					echo"<th>Client Name</th>";
					echo"</thead>";
					while ($row3 = mysql_fetch_array($result3))
					{	
						echo"<tr>";
						echo"<td>".$row3['jobName']."</td>";
						echo "<td>".$row3['clientName']."</td>";
						echo"</tr>";
					}
					echo"</table>";
			
?>
				</div>
			</div>
<?php	
	}
	else if($type=='app')
	{
?>

		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
			
				<nav class="navbar nav2 nav navbar-nav">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							<li><h3><a href="client.php?token=<?php echo $main; ?>" style="margin-left:.5em;">All Applicant</a></h3></li>
						</ul>
						<ul class="nav navbar-nav pull-right">
							<li><a href="query.php?token=<?php echo $query; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span>&nbsp; Query</a></li>
						</ul>
					</div>
				</nav>
			
				<h4 class="alert-info well-lg instruction">Find Query for all applicant.</h4> 		
				<br /><br />
			
				<p style="font-size:1.5em;"<strong>Contstraints </strong></p>
	
					<form method="POST" action="">
						<div class="col-md-3">
							<p style="font-size:1.2em;">Applicant Status: </p>
							<input type="radio" name="astat" value="" checked> Any
							<input type="radio" name="astat" value="Active"> Active
							<input type="radio" name="astat" value="Endorsed"> Endorsed
						</div>
						
						<div class="col-md-3">
							<p style="font-size:1.2em;">Gender: </p>
							<input type="radio" name="gender" value="" checked> Any
							<input type="radio" name="gender" value="Male"> Male
							<input type="radio" name="gender" value="Female"> Female
						</div>
						
						<div class="col-md-2">
							<p style="font-size:1.2em;">Sort By: </p>
						
							<select class="form-control" id="sort" name="sort">
								<option value="">None</option>
								<option value="basicLastName">Name</option>
								<option value="applicantDate">Date of application</option>
								<option value="applicantStatus">Applicant Status</option>
							</select>
						</div>
						
						<div class="col-md-2">
							<p style="font-size:1.2em;">Order by: </p>
						
							<input type="radio" name="sorting" value="ASC" checked> Ascending
							<input type="radio" name="sorting" value="DESC"> Descending
						
						</div>
					
						<div class="form-group col-md-2">
								
								<button type="submit" 
										style="margin-top:2em;"
										class="btn btn-default btn-md btn-block"
										name ="submit">
										Refresh &nbsp;
									 <span class="glyphicon glyphicon-refresh"></span>
								</button>
							
						</div>
					</form>
				</div>
		</div>
<?php
			if(isset($_POST['submit']))
			{		
				if($_POST['astat'] != ""){ $where[] = " AND applicantStatus = '$_POST[astat]'";}
				if($_POST['gender'] != ""){ $where[] = " AND personalQualityDesc = '$_POST[gender]'";}
				if($_POST['sort'] != ""){ $where[] = " ORDER BY $_POST[sort] $_POST[sorting]";}
			}
			$whereStr = implode($where);
			$mainquery= "SELECT * 
			FROM tbl_applicant a, 
				 tbl_basic_info b,
				 tbl_contact_info c,
				 tbl_personal_info d
			WHERE a.basicId = b.basicId AND
				  (contactDevice = 'Mobile' OR contactDevice = 'Landline') AND
				  a.basicId = d.basicId AND
				  personalQualityType = 'gender' AND
				  b.basicId = c.basicId"." ".$whereStr; 
			
			$result2 = mysql_query("$mainquery");
?>
			<div class="container-fluid table-responsive">
				<div class="col-md-12 wrapper-background">

<?php
					echo"<table class='table table-hover table-striped'>";
					echo"<thead class='tablehead'>";
					echo"<th>Applicant Name</th>";
					echo"<th>Applicant Status</th>";
					echo"<th>Date of Application</th>";
					echo"<th>Contact Number</th>";
					echo"<th>Gender</th>";
					
					echo"</thead>";
					while ($row2 = mysql_fetch_array($result2))
					{	
						echo"<tr>";
						
						echo"<td>".$row2['basicLastName']." ".$row2['basicFirstName']." ".$row2['basicMiddleName']."</td>";
						echo "<td>".$row2['applicantStatus']."</td>";
						echo "<td>".$row2['applicantDate']."</td>";
						echo "<td>".$row2['contactNumber']."</td>";
						echo "<td>".$row2['personalQualityDesc']."</td>";
						echo"</tr>";
					}
					echo"</table>";
?>
				</div>
			</div>
<?php
}
?>
	

	
<?php
	include ('../footer.php');
?>
