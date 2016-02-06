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
	/////////////////////
	//
	// check password from database.
	//
	/////////////////////
	//../fpdf/pdfEndorsementSlip.php
	
	
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
				
	
				
				
			$resultInfo = mysql_query("SELECT * FROM tbl_user_account WHERE accountId= $_SESSION[login_accountId]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$correctPassword  = $rowInfo['accountPassword'];
				}//while	
				

	if(isset($_POST['deployApplicant']))
	{
		
		//echo"<script type='text/javascript' language='Javascript'>window.open('../fpdf/pdfEmployeeContract.php');</script>";
		
		//$mysqli->query("INSERT INTO tbl_endorsement(applicantId, clientId, jobPostingId, endorsementDate) VALUES ('$_SESSION[ses_AppID]','$clientID', '$_SESSION[endorsedJobId]', '$date')");

		//$mysqli->query("UPDATE `tbl_applicant` SET `applicantStatus`='Endorsed' WHERE applicantId = $_SESSION[ses_AppID]");	

		//echo " appID: $_POST[applicantID]"; jobpostingID
		
		$mysqli->query("INSERT INTO tbl_employee (applicantId, jobPostingId) VALUES ('$_POST[applicantID]','$_POST[jobpostingID]')");
		$mysqli->query("UPDATE tbl_endorsement SET endorsementStatus ='Employed' WHERE applicantId = $_POST[applicantID]");	

	
	?>
			<div class="container-fluid">
					
				<div class="alert-success well-lg col-md-6 col-md-offset-3" style="padding:2em; margin-top: 8em; margin-bottom: 10em;  text-align:center;">
					<strong>Congratulations!</strong>&nbsp;&nbsp; Applicant has been successfully deployed.
					<br /><br />
					Click <a href="endorsedApplicant.php?token=<?php echo $tran;?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
				
				</div>
			
			
			</div>
			
			
	<?php
		
		
		
		
		
	}
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
 	include('../footer.php');
 ?> 