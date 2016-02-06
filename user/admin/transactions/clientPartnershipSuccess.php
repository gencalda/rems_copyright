<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>


<?php

	$tran = md5('transaction');

	$correctAccessCode = "";
	
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
				
	
				
			$resultInfo = mysql_query("SELECT * FROM tbl_client WHERE clientId = $_POST[name_searchClientName]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$correctAccessCode  = $rowInfo['clientAccessCode'];
				}//while	
				

	if($correctAccessCode == $_POST['name_clientAccessCode'])
	{
		
		echo"<script type='text/javascript' language='Javascript'>window.open('../fpdf/pdfPartnershipAgreement.php');</script>";
	
			echo'
			<div class="container-fluid">
					
				<div class="alert-success well-lg col-md-6 col-md-offset-3" style="padding:2em; margin-top: 8em; margin-bottom: 10em;  text-align:center;">
					<strong>Congratulations!</strong>&nbsp;&nbsp; Partnership was successfully done.
					<br /><br />
					<!--
					Click <a href="assessApplicant.php?token=<?php //echo $tran;?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
					<!-->
				</div>
			
			</div>
			';
						
				$var_start_contract_to_format=date_create(mysql_real_escape_string($_POST['name_clientStartContract']));
	$var_start_contract_formatted=date_format($var_start_contract_to_format,'Y/m/d');
	
	$var_end_contract_to_format=date_create(mysql_real_escape_string($_POST['name_clientEndContract']));
	$var_end_contract_formatted=date_format($var_end_contract_to_format,'Y/m/d');

	
	//update tbl client
		$mysqli->query("UPDATE tbl_contract SET 
					contractStartDate = '$var_start_contract_formatted',
					contractEndDate =  '$var_end_contract_formatted',
					contractStatus =  'on-going'
				
				WHERE clientId = '$_POST[name_searchClientName]'
				AND contractStatus = 'not started'");

	
	//update tbl useraccount
		$mysqli->query("UPDATE tbl_user_account SET 
					accountStatus = '1'
				
				WHERE clientId = '$_POST[name_searchClientName]'
				AND accountStatus = '0'");

	//update jobPosting
		$mysqli->query("UPDATE tbl_job_posting SET 
					jobStatus = '1'
				
				WHERE clientId = '$_POST[name_searchClientName]'
				AND jobStatus = '2'");
		
	}
	else
	{
		echo'
		<div class="container-fluid">
					
				<div class="alert-danger well-lg col-md-6 col-md-offset-3" style="padding:2em; margin-top: 8em; margin-bottom: 10em;  text-align:center;">
					<strong> Error!</strong>&nbsp;Access Code incorrect.
					<br /><br />
					
					Click <a href="../transactions/clientPartnership.php?token=$tran"><button class="btn btn-danger">here</button></a> to try again.
				
				</div>
			
			
			</div>
		';
	}
	//header('location: assessApplicant.php?token='.$tran.'');
	


?>

<?php

	$_SESSION['ses_partnerClientID'] = $_POST['name_searchClientName'];
	include ('../footer.php');
?>