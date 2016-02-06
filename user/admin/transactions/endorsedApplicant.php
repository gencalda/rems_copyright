<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>


	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Endorse Applicant</li>
		</ul>
	</div>




	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<h4 class="alert-info well-lg">List of endorsed applicant.</h4>
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
						$decision = '';
						$status = '';
						
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error()); 
						}
						
						
						mysql_select_db("$db_database", $con);
						
						$result = mysql_query("SELECT *
												FROM tbl_endorsement
												WHERE endorsementStatus = 'Active'
												ORDER BY endorsementId");
						echo "<table class='table table-hover table-striped'>";
						echo "<thead class='tablehead'>";
						echo "<tr>
										<td>Applicant Name</td>
										<td>Endorsed as</td>
										<td>Client</td>
										<td>Status</td>
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
							$decision = $row['endorsementDecision'];
							$status =  $row['endorsementStatus'];
							
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
							
							if ($status=='Active')
							{
							
								//echo "<td ><a style='color:black;  text-decoration: underline;' href = 'endorsedApplicantAssess.php?token=$tran&&endorseID=".$row['endorsementId']."&&appID=".$row['applicantId']."'>" .$lastName.", ".$firstName." ".$middleName." </a></td>";
								echo "<td ><a style='color:black;  text-decoration: underline;' href = '#'>" .$lastName.", ".$firstName." ".$middleName." </a></td>";
								
								echo "<td>$jobName</td>";
								echo "<td>$clientName</td>";
								if ($decision=='' || $decision==' ')
								{
									echo "<td>to be interviewed</td>";
								}//for status
								else
								{
									echo "<td>$decision</td>";
								}//for status
								
								if($decision=='Passed')
								{
								
								
								echo "
								<td>
								
								<form method='POST' action='employeeContract.php?token=$tran'>
								<input type='hidden' name='applicantID' value= '$appID'>
								<input type='hidden' name='jobpostingID' value= '$jobpostingID'>
								<input type='hidden' name='clientID' value= '$clientID'>
								<button type='submit' 
														class='btn btn-success'
														name ='deployApplicant' 
														id='deployApplicant'>
														Deploy
								</button>
								</form>
								</td>";
								}
								else if($decision=='Failed')
								{
								
								echo "<td>
								<form method='POST' action='failedApplicant.php?token=$tran'>
								<input type='hidden' name='applicantID' value= '$appID'>
								<input type='hidden' name='jobpostingID' value= '$jobpostingID'>
								<input type='hidden' name='clientID' value= '$clientID'>
								<button type='submit' 
														class='btn btn-success'
														name ='deployApplicant' 
														id='deployApplicant' style='padding-left:20px; padding-right:20px;'>
														Okay
								</button>
								</form>
								</td>";
								
								}
								else 
								{
									echo "<td></td>";
								}
								//--------------------------------------------
							
							}//if not employed
							
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