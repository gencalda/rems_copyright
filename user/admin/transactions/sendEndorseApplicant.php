<?php
	include_once ('../../../config/connection.php');
	ob_start();
	//session_start();
	
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/linkTwo.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php');
	$tran = md5('transaction');
	$sent = md5('linksent');
					

	$correctPassword = '';
	//$password = $_POST['password'];
	//$attempt = $_POST['attempt'];
	$tran = md5('transaction');

	

	if(isset($_POST['deployApplicant']))
	{
		
		echo"<script type='text/javascript' language='Javascript'>window.open('../fpdf/pdfEmployeeContract.php');</script>";
	
	?>
			<div class="container-fluid">
					
				<div class="alert-success well-lg col-md-6 col-md-offset-3" style="padding:2em; margin-top: 8em; margin-bottom: 10em;  text-align:center;">
					<strong>Congratulations!</strong>&nbsp;&nbsp; Applicant has been successfully deployed.
					<br /><br />
					
					Click <a href="endorsedApplicant.php?token=<?php echo $tran;?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
				
				</div>
			
			
			</div>
	<?php
		
	
		//insert into tbl_employee
	$mysqli->query("INSERT INTO tbl_employee
						(
							applicantId,
							jobPostingId
						)
						VALUES 
						(
							'$_POST[applicantID]',
							'$_POST[jobpostingID]'
						)"
					);
	
	
	//update
	$mysqli->query("UPDATE tbl_endorsement SET endorsementStatus ='Employed' WHERE applicantId = $_POST[applicantID]");	


	$empID = "";
	
	//getting the employeeId
		$query = "SELECT * FROM tbl_employee ORDER BY employeeId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$empID = $obj->employeeId;
				}//while
			}//if 
	


	
	$var_start_contract_to_format=date_create(mysql_real_escape_string($_POST['name_contractStart']));
	$var_start_contract_formatted=date_format($var_start_contract_to_format,'Y/m/d');
	
	$var_end_contract_to_format=date_create(mysql_real_escape_string($_POST['name_contractEnd']));
	$var_end_contract_formatted=date_format($var_end_contract_to_format,'Y/m/d');

	
	
	//insert into tbl_contract
	$mysqli->query("INSERT INTO tbl_contract
						(
							employeeId,
							contractStartDate,
							contractEndDate,
							contractStatus
						)
						VALUES 
						(
							'$empID',
							'$var_start_contract_formatted',
							'$var_end_contract_formatted',
							'on-going'
						)"
					);
	
	
		
		
		
	}
	else if (isset($_POST['renewEmployeeSubmit']))
	{
	
	
		echo"<script type='text/javascript' language='Javascript'>window.open('../fpdf/pdfEmployeeContract.php');</script>";
	
	?>
			<div class="container-fluid">
					
				<div class="alert-success well-lg col-md-6 col-md-offset-3" style="padding:2em; margin-top: 8em; margin-bottom: 10em;  text-align:center;">
					<strong>Congratulations!</strong>&nbsp;&nbsp; Employee Contract has been successfully renewed.
					<br /><br />
					
					Click <a href="endorsedApplicant.php?token=<?php echo $tran;?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
				
				</div>
			
			
			</div>
	<?php
		
		
		//update tbl contract status
								$mysqli->query("UPDATE tbl_contract SET 
											contractStatus = 'renewed'
										
										WHERE employeeId = $_POST[employeeID]");

										
	
		//insert into tbl_employee
	$mysqli->query("INSERT INTO tbl_employee
						(
							applicantId,
							jobPostingId
						)
						VALUES 
						(
							'$_POST[applicantID]',
							'$_POST[jobpostingID]'
						)"
					);
	
	
	//update
	$mysqli->query("UPDATE tbl_endorsement SET endorsementStatus ='Employed' WHERE applicantId = $_POST[applicantID]");	


	$empID = "";
	
	//getting the employeeId
		$query = "SELECT * FROM tbl_employee ORDER BY employeeId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$empID = $obj->employeeId;
				}//while
			}//if 
	


	
	$var_start_contract_to_format=date_create(mysql_real_escape_string($_POST['name_contractStart']));
	$var_start_contract_formatted=date_format($var_start_contract_to_format,'Y/m/d');
	
	$var_end_contract_to_format=date_create(mysql_real_escape_string($_POST['name_contractEnd']));
	$var_end_contract_formatted=date_format($var_end_contract_to_format,'Y/m/d');

	
	
	//insert into tbl_contract
	$mysqli->query("INSERT INTO tbl_contract
						(
							employeeId,
							contractStartDate,
							contractEndDate,
							contractStatus
						)
						VALUES 
						(
							'$empID',
							'$var_start_contract_formatted',
							'$var_end_contract_formatted',
							'not started'
						)"
					);
	
	
		
		
		
	
	}// renew contract
	else
	{
		$attempt++;
		//header('location: assessApplicant.php?attempt='.$attempt.'&token='.$tran.'');
		header('location: attemptEndorsement.php?attempt='.$attempt.'&token='.$tran.'');
		exit;
	}
	//header('location: assessApplicant.php?token='.$tran.'');
	
	
	
?>

		
 <?php
	$_SESSION['ses_applicantID'] = $_POST['applicantID'];	
	$_SESSION['ses_jobpostingID'] = $_POST['jobpostingID'];	
	$_SESSION['ses_clientID'] = $_POST['clientID'];	
	$_SESSION['ses_empID'] = $empID;	
 	include('../footer.php');
 ?> 