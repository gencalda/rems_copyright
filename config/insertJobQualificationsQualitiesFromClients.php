<?php
	session_start();
	include ('../config/connection.php');


if(isset($_POST['submitQualificationsQualities'])) 
{							
	

	if (!empty($_POST['name_jobPostingQualities']))
	{

		foreach($_POST['name_jobPostingQualities'] as $selected) 
		{
		//echo "<p>".$selected ."</p>";
		$mysqli->query("INSERT INTO tbl_job_quali 
								SET 
								jobPostingID='$_SESSION[ses_jobPostingID]', 
								jobQualiDescription='$selected', 
								jobQualiType='Quality'");
	
	    }//for each
		
		if ($mysqli->connect_error) {
		die("Connection failed: " . $mysqli->connect_error);
	} 

	$sql = "INSERT INTO tbl_notification (notifId, jobPostingId, notifDesc, dateCreated,notifStatus)
	VALUES ('', '$_SESSION[ses_jobPostingID]', 'posted a new job.', now(), 'new')";

	if ($mysqli->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $mysqli->error;
	}

	$mysqli->close();
	}//if not empty
	
	
	echo "inserted";
}//if set

$main = md5('maintenance');
header("location: ../user/client/maintenance/jobPostingAddDone.php?token=$main");
exit();
?>