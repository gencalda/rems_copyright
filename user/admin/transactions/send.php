<?php
	include_once ('../../../config/connection.php');
	ob_start();
	//session_start();

	date_default_timezone_set("Asia/Manila");
	$date = date("Y/m/d");
	
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/linkTwo.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php');
	$tran = md5('transaction');
	$sent = md5('linksent');
					

	$correctPassword = '';
	$password = $_POST['password'];
	$attempt = $_POST['attempt'];
	$tran = md5('transaction');
	/////////////////////
	//
	// check password from database.
	//
	/////////////////////
	//../fpdf/pdfEndorsementSlip.php
	
	$appName = '';
$clientID = '';
$clientName = '';
$clientLoc = '';
$jobName = '';
$userName =  '';
$userBasicId = '';


		$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
				
	
				
				
			$resultInfo = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId= $_SESSION[endorsedBasicId]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$appName  = $rowInfo['basicFirstName']." ".$rowInfo['basicMiddleName']." ".$rowInfo['basicLastName'];
				}//while	

				
			$resultInfo = mysql_query("SELECT * FROM tbl_job_posting WHERE jobPostingId= $_SESSION[endorsedJobId]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$jobName  = $rowInfo['jobName'];
						$clientID  = $rowInfo['clientId'];
				}//while	

				
			$resultInfo = mysql_query("SELECT * FROM tbl_client WHERE clientId= $clientID
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$clientName = $rowInfo['clientName'];
				}//while	
				
				
			$resultInfo = mysql_query("SELECT * FROM tbl_address WHERE clientId= $clientID
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$clientLoc = $rowInfo['addBlock']." ".$rowInfo['addStreet']." ".$rowInfo['addSubdivision']." ".$rowInfo['addBarangay'];
						$clientLoc2 = $rowInfo['addDistrict']." ".$rowInfo['addCity'].", ".$rowInfo['addProvince'];
				
				}//while	
				
				
				$resultInfo = mysql_query("SELECT * FROM tbl_user_account WHERE accountId= $_SESSION[login_accountId]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$userBasicId  = $rowInfo['basicId'];
				}//while
				
				$resultInfo = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId= $userBasicId
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$userName = $rowInfo['basicFirstName']." ".$rowInfo['basicMiddleName']." ".$rowInfo['basicLastName'];
				}//while	
				
				$resultInfo = mysql_query("SELECT content_agencyName ,content_agencyAddress, content_pdfagencyName FROM tbl_content WHERE contentId = 1
								");					
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$AgencyName  = $rowInfo['content_agencyName'];
						$AgencyAddress  = $rowInfo['content_agencyAddress'];
						$pdfAgencyName  = $rowInfo['content_pdfagencyName'];
				}//while

	
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
				

	if($password == $correctPassword)
	{

		$mysqli->query("INSERT INTO tbl_endorsement(applicantId, clientId, jobPostingId, endorsementDate, endorsementStatus) VALUES ('$_SESSION[ses_AppID]','$clientID', '$_SESSION[endorsedJobId]', '$date', 'Active')");

		$mysqli->query("UPDATE `tbl_applicant` SET `applicantStatus`='Endorsed' WHERE applicantId = $_SESSION[ses_AppID]");

		$mysqli->query("INSERT INTO tbl_notification
							(
								notifId,
								clientId,
								applicantId,
								notifDesc, 
								dateCreated,
								notifStatus,
								notifUser
							)
							VALUES 
							(
								'',
								'$clientID',
								'$_SESSION[ses_AppID]',
								'was endorsed to',
								now(),
								'bagongNotif',
								'client'
							)"
						);

		
		echo"<script type='text/javascript' language='Javascript'>window.open('../fpdf/pdfEndorsementSlip.php');</script>";
	
	?>
			<div class="container-fluid">
					
				<div class="alert-success well-lg col-md-6 col-md-offset-3" style="padding:2em; margin-top: 8em; margin-bottom: 10em;  text-align:center;">
					<strong>Congratulations!</strong>&nbsp;&nbsp; Applicant has been successfully endorsed.
					<br /><br />
					Click <a href="assessApplicant.php?token=<?php echo $tran;?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
				
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