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
		
		
		$mysqli->query("UPDATE tbl_endorsement SET 
					 endorsementDecision='Failed',
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
						'rejected an applicant.',
						now(),
						'bagongNotif',
						'admin'
					)"
				);

?>


<?php
	$tran = md5('transaction');
	header("location: ../user/client/transactions/clientEndorsedApplicant.php?token=$tran");
?>