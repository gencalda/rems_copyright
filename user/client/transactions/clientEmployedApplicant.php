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
			<li class="active">Deploy Applicant</li>
		</ul>
	</div>




	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
		
			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="clientEmployedApplicant.php?token=<?php echo $tran?>" style="margin-left:.5em;">Employee</a></h3></li>
					</ul>
			  	</div>

			</nav>
			<br /><br /><br /><br />

			<h4 class="alert-info well-lg">List of Employee.</h4>
	
			
			
	
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
											AND tbl_client.clientId = $_SESSION[login_userId]
										");
					echo "<table class='table table-hover table-striped'>";
					echo"<thead class='tablehead'>
						<tr>
							<td>Employee Name</td>
							<td>Position</td>	
							<td>Start of Contract</td>
							<td>End of Contract</td>
						</tr>
					</thead>";
					while($row = mysql_fetch_array($result)) 
					{
						$tran = md5('transaction');
						echo "<tr>";
						echo "<td>".$row['basicFirstName']." ".$row['basicLastName']."</td>";
						echo "<td>".$row['jobName']."</td>";
							
						
						$var_start_contract_to_format=date_create($row['contractStartDate']);
								$var_start_contract_formatted=date_format($var_start_contract_to_format,'m/d/Y');
								echo "<td>" . $var_start_contract_formatted . "</td>";
								
								
								$var_start_contract_to_format=date_create($row['contractEndDate']);
								$var_start_contract_formatted=date_format($var_start_contract_to_format,'m/d/Y');
								echo "<td>" . $var_start_contract_formatted . "</td>";
						
						echo "</tr>";
						
						
					}

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