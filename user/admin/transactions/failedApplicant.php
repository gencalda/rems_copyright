<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	$date = date("Y/m/d");
?>

<?php

				$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
									{
										die('Could not connect: ' . mysql_error());
									}
																	
								mysql_select_db("$db_database", $con);
								
				$basicID = "";
				$job1  = "";
				$job2 = "";
				$job3 = "";
				
				
				//tbl_endorsemet
				$mysqli->query("UPDATE tbl_endorsement SET
							endorsementStatus = 'Failed'
							WHERE applicantId = $_POST[applicantID]
							");
				
				
				$result = mysql_query("SELECT * 
														FROM tbl_desired_position
														WHERE applicantId = $_POST[applicantID]
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
									
										if($row['positionRank']=='First')
										{
											$job1  = $row['positionJobName'];
										}//if
										else if ($row['positionRank']=='Second')
										{
											$job2 = $row['positionJobName'];
										}//else if
										else if ($row['positionRank']=='Third')
										{
											$job3 = $row['positionJobName'];
										}//else if
									}
									
				$result = mysql_query("SELECT * 
														FROM tbl_applicant
														WHERE applicantId = $_POST[applicantID]
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
									
										$basicID = $row['basicId'];
									}
			
				
				//tbl_applicant
				$mysqli->query("INSERT INTO tbl_applicant SET 
								basicId='$basicID', 
								applicantDate='$date',
								applicantStatus='Active'");
								
				$appID = "";				
								
				//getting the appID
				$query = "SELECT * FROM tbl_applicant WHERE applicantStatus = 'Active' ORDER BY applicantId DESC LIMIT 1";
				
					if ($result = $mysqli->query($query))
					{
						
						while ($obj=$result->fetch_object())
						{
							$appID = $obj->applicantId;
						}//while
					}//if 
	
	
			
			
				//tbl_desired position
				$mysqli->query("INSERT INTO tbl_desired_position SET 
								positionJobName = '$job1',
								applicantId='$appID',
								PositionRank='First'");
				
				$mysqli->query("INSERT INTO tbl_desired_position SET 
								positionJobName = '$job2',
								applicantId='$appID',
								PositionRank='Second'");
				
								
				$mysqli->query("INSERT INTO tbl_desired_position SET 
								positionJobName = '$job3',
								applicantId='$appID',
								PositionRank='Third'");
								
?>

	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="job.php?token=<?php echo $main; ?>">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd.php?token=<?php echo $main; ?>">Add Job</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd2.php?token=<?php echo $main; ?>">Job Qualifications</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd3.php?token=<?php echo $main; ?>">Language Spoken</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd4.php?token=<?php echo $main; ?>">Skills and Qualities</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li>Done</li>
		</ul>

	</div>

	
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">	
			<br /><br /><br />
				<div class="content-fluid" >
					<h4 class="alert alert-success well-lg">
						<br /><br />
						Applicant is now ready to be assessed.
						<br />
						<br />
						<br />
						Click <a href="../index.php?token=<?php echo $home?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
						</h4>
				</div>
		</div>
	</div>

<br /><br /><br />

<?php
	include ('../footer.php');
?>