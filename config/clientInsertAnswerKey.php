<?php

	include_once ('../config/connection.php');
	session_start();

	
	$ctr = 0;
	$key = 1;
	$questionId = "";
	$choiceId = "";
	foreach($_SESSION['ses_questionKeyId'] as $index => $questionId)
	{
     //put the index value to buildingid
    $buildingId = $index;
    echo " qId: ".$questionId; //the actual value of the array
	echo" choiceID: ".+$_POST['name_Question'+$key];
	$choiceId = $_POST['name_Question'+$key];
	$ctr++;
	$key++;
	
	
	/*$mysqli->query("INSERT INTO tbl_notification 
						(
							notifId,
							jobPostingId, 
							notifDesc, 
							dateCreated,
							notifStatus,
							notifUser
						)
						VALUES
						(
							'',
							'$_SESSION[ses_jobPostingID]'
							'posted a new exam for the job', 
							now(), 
							'bagongNotif'
							'admin'
						)"
					);*/
	
		$mysqli->query("INSERT INTO tbl_answerKey
						(
							questionId,
							choiceId
						)
						VALUES 
						(
							'$questionId',
							'$choiceId'
						)"
					);
	}//foreach
	
	$main = md5('maintenance');
		header("Location: ../user/client/maintenance/clientCreateExamDone.php?token=$main");
		exit;
	
?>