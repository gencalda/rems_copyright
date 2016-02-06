<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>
	
	<div class='container-fluid content'><ul class="breadcrumb">
			<li>Reports</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client Summary</li>
		</ul>
	</div>

	
	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="endorsementSummary.php?token=<?php echo $util; ?>" style="margin-left:.5em;">Endorsement Summary</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a target="_blank" href="../fpdf/printEndorsementSummary.php" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-print"> </span> Endorsement Summary</a></li>
					</ul>
			  	</div>
			</nav>

			<h4 class="alert-info well-lg instruction">Endorsement Summary. </h4> 		
			<br />
			<div class='container-fluid content table-responsive'>
				<?php	
					/*
					$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error()); 
								}
								
							
								mysql_select_db("$db_database", $con);
								
								$result = mysql_query("SELECT * FROM endorsedapp, appinformation WHERE endorsedapp.applicantID != 0 and endorsedapp.applicantID = appinformation.applicantID");
								echo "<table class='table table-hover table-striped'>";
								echo "<thead>";
								echo "<tr>
									<th>Applicant name</th>
									<th>Position to be hired</th>
									<th>Branch</th>
									</tr>";
								echo "</thead>";

								while($row = mysql_fetch_array($result)) 
								{
									echo "<tr>";
									;
									echo "<td >" . $row['appInfoFirstName'] . "</a></td>";
									echo"<td>" . $row['jobPostingTitle'] . "</td>";
									echo"<td>" . $row['branchName'] . "</td>";
									echo "</tr>";
									
								}

								echo "</table>";
								mysql_close($con);
				*/			
				?>
			</div>
		</div>
	</div>

	<br /><br /><br />
<?php
	include ('../footer.php');
?>