<?php
	include_once ('../config/connection.php');
	session_start();
	
	date_default_timezone_set("Asia/Manila");
	$date = date("Y/m/d");
		
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
		
		if (!$con)
		{
			die('Could not connect: ' . mysql_error()); 
		}
		mysql_select_db("$db_database", $con);
		
		
		$jobID = "";
		$vacancy = "";
		$updateVacancy = 0;
		
		$mysqli->query("UPDATE tbl_endorsement SET 
					 endorsementDecision='Passed',
					 endorsementDecisionDate ='$date'
					WHERE endorsementId = '$_SESSION[ses_endorsedID]' 
					");
		
		$mysqli->query("INSERT INTO tbl_notification
					(
						notifId,
						clientId, 
						notifDesc, 
						dateCreated,
						notifStatus,
						notifUser
					)
					VALUES 
					(
						'',
						'$_SESSION[login_userId]',
						'accepted an applicant.',
						now(),
						'bagongNotif',
						'admin'
					)"
				);
					
					
			$result = mysql_query("SELECT * FROM tbl_endorsement WHERE endorsementId = '$_SESSION[ses_endorsedID]'");
							while($row = mysql_fetch_array($result)) 
							{	
								$jobID = $row['jobPostingId'];
							}
							
		$result = mysql_query("SELECT * FROM tbl_job_posting WHERE jobPostingId = '$jobID'");
							while($row = mysql_fetch_array($result)) 
							{	
								$vacancy = $row['jobVacancy'];
							}
							
		$updateVacancy = intval($vacancy) - 1;
			
		$mysqli->query("UPDATE tbl_job_posting SET 
					 jobVacancy ='$updateVacancy'
					 
					WHERE jobPostingId = '$jobID' 
					");
					
		//check if zero
		$result = mysql_query("SELECT * FROM tbl_job_posting WHERE jobPostingId = '$jobID'");
							while($row = mysql_fetch_array($result)) 
							{	
								$vacancy = $row['jobVacancy'];
							}
							
		if (intval($vacancy)==0)
		{
			$mysqli->query("UPDATE tbl_job_posting SET 
					 jobStatus ='0'
					 
					WHERE jobPostingId = '$jobID' 
					");
		}//
		
		
		


?>


<?php
	$tran = md5('transaction');
	header("location: ../user/client/transactions/clientEndorsedApplicant.php?token=$tran");
?>