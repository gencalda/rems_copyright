<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>
	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Assess Applicant</li>
		</ul>
	</div>

	
	

<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<h4 class="alert-info well-lg">List of assessed applicant.</h4>
			<br /><br />
		
				<div class='container-fluid content table-responsive'>
						<?php
						
						$appID = '';
						$basicID = '';
						$firstName = '';
						$middleName = '';
						$lastName = '';
						$jobpostingID = '';
						$jobName = '';
						$clientID = '';
						$clientName = '';
						$status = '';
						
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error()); 
						}
						
						
						mysql_select_db("$db_database", $con);
						
						$result = mysql_query("SELECT *
												FROM tbl_endorsement
												WHERE clientId = $_SESSION[login_userId]
												ORDER BY endorsementId");
						echo "<table class='table table-hover table-striped'>";
						echo "<thead class='tablehead'>";
						echo "<tr>
										<td>Applicant Name</td>
										<td>Position Applying</td>
										<td></td>
						</tr>";
										
						echo "</thead>";

						//echo $result;
						
						$tran = md5('transaction');
						while($row = mysql_fetch_array($result)) 
						{
						
							$appID = $row['applicantId'];
							$jobpostingID = $row['jobPostingId'];
							$clientID = $row['clientId'];
							$status =  $row['endorsementDecision'];
							
							$resultBasicID = mysql_query("SELECT * FROM tbl_applicant WHERE applicantId =$appID");
							while($rowBasicID = mysql_fetch_array($resultBasicID)) 
							{	
								$basicID = $rowBasicID['basicId'];
							}
							
							
							$resultName = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId = $basicID");
							while($rowName = mysql_fetch_array($resultName)) 
							{	
								$firstName = $rowName['basicFirstName'];
								$middleName = $rowName['basicMiddleName'];
								$lastName = $rowName['basicLastName'];
							}
							
							$resultjobName = mysql_query("SELECT * FROM tbl_job_posting WHERE jobPostingId = $jobpostingID");
							while($rowjobName = mysql_fetch_array($resultjobName)) 
							{	
								$jobName = $rowjobName['jobName'];
							}
							
							$resultClientName = mysql_query("SELECT * FROM tbl_client WHERE clientId = $clientID");
							while($rowClientName = mysql_fetch_array($resultClientName)) 
							{	
								$clientName = $rowClientName['clientName'];
							}
							
							
							echo "<tr>";
							
								echo "<td ><a style='color:black;  text-decoration: underline;' href = '#?token=$tran'>" .$lastName.", ".$firstName." ".$middleName." </a></td>";
								echo "<td>$jobName</td>";
								echo"<td>$status</td>";
								//--------------------------------------------
						
							echo "</tr>";  // end of row
							
						}//while

						echo "</table>";
						mysql_close($con);
					
				?>
			</div>
		</div>
	</div>

	<br /><br /><br />

<?php
	include ('../footer.php');
?>