<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("Y/m/d");
?>


	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Deploy Applicant</li>
		</ul>
	</div>




	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<h4 class="alert-info well-lg">List of Employed Applicant.</h4>
			<br /><br />
	
			<div class='container-fluid content'>
					<div class="container-fluid table-responsive content">
			<br /><br />
			<?php	
					$con = mysql_connect("$db_hostname","$db_username","$db_password");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error()); 
					}
					
					mysql_select_db("$db_database", $con);
					
					
					//update tbl contract  - expired
				$mysqli->query("UPDATE tbl_contract SET 
					contractStatus = 'expired'
				WHERE DATE(`contractEndDate`) < DATE(NOW())");

				
					//update tbl contract  - start ng renewed
				$mysqli->query("UPDATE tbl_contract SET 
					contractStatus = 'on-going'
				
				WHERE DATE(`contractStartDate`) >= DATE(NOW())");

				
					
					$appID = '';
					$jobpostingID = '';
					$employeeID = '';
					$contractStatus = '';
					
					$result = mysql_query("SELECT *
											FROM tbl_contract
											LEFT JOIN tbl_employee
											ON tbl_employee.employeeId = tbl_contract.employeeId
											LEFT JOIN tbl_job_posting
											ON tbl_employee.jobPostingId = tbl_job_posting.jobPostingId
											LEFT JOIN tbl_client
											ON tbl_client.clientId = tbl_job_posting.clientId
											LEFT JOIN tbl_applicant
											ON tbl_applicant.applicantId = tbl_employee.applicantId
											LEFT JOIN tbl_basic_info
											ON tbl_applicant.basicId = tbl_basic_info.basicId
											WHERE tbl_contract.employeeId IS NOT NULL
											AND tbl_contract.contractStatus = 'on-going'
											OR tbl_contract.contractStatus = 'renewed'
										");
					echo "<table class='table table-hover table-striped'>";
					echo"<thead class='tablehead'>
						<tr>
							<td>Employee Name</td>
							<td>Position</td>	
							<td>Client Designation</td>
							<td>Start of Contract</td>
							<td>End of Contract</td>
							<td></td>
						</tr>
					</thead>";
					while($row = mysql_fetch_array($result)) 
					{
						$tran = md5('transaction');
						
						$appID = $row['applicantId'];
						$jobpostingID = $row['jobPostingId'];
						$employeeID = $row['employeeId'];
						$contractStatus = $row['contractStatus'];
						
						
						echo "<tr>";
						echo "<td>".$row['basicFirstName']." ".$row['basicLastName']."</td>";
						echo "<td>".$row['jobName']."</td>";
						echo "<td>".$row['clientName']."</td>";	
						
						$var_start_contract_to_format=date_create($row['contractStartDate']);
								$var_start_contract_formatted=date_format($var_start_contract_to_format,'m/d/Y');
								echo "<td>" . $var_start_contract_formatted . "</td>";
								
								
								$var_start_contract_to_format=date_create($row['contractEndDate']);
								$var_start_contract_formatted=date_format($var_start_contract_to_format,'m/d/Y');
								echo "<td>" . $var_start_contract_formatted . "</td>";
						
					
						date_default_timezone_set("Asia/Manila");
						$date = date("Y/m/d");
						$start = new DateTime($date);
											
					
						$end = $row['contractEndDate'];
						$end = new DateTime($end);
						
						$interval = $start ->diff($end);
						$weeks = (int)(($interval->days) / 7);
						
						//echo"weeks: $weeks";
						if($weeks<=1 && $contractStatus=="on-going")
						{
							echo "
							<td>
								
								<form method='POST' action='renewEmployeeContract.php?token=$tran'>
								<input type='hidden' name='applicantID' value= '$appID'>
								<input type='hidden' name='jobpostingID' value= '$jobpostingID'>
								<input type='hidden' name='employeeID' value= '$employeeID'>
								<button type='submit' 
														class='btn btn-success'
														name ='renewEmployee' 
														id='renewEmployee'>
														Renew Contract
								</button>
								</form>
								</td>";
								
						}//
						else if ($weeks<=1 && $contractStatus=="renewed")
						{
							echo "<td>Contract Renewed</td>";
						}
						else
						{
							echo "<td></td>";
						}
						echo "</tr>";
						
						
					}//while

					echo "</table>";
					mysql_close($con);
				?>
			</div>
			</div>
		</div>
	</div>
	<br /><br /><br />
<?php
	include ('../footer.php');
?>