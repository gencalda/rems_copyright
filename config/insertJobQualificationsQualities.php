<?php
	session_start();
	include_once ('../config/connection.php');


if(isset($_POST['submitQualificationsQualities'])) 
{		

	if (!empty($_POST['name_jobPostingQualities']))
	{

		foreach($_POST['name_jobPostingQualities'] as $selected) 
		{
		//echo "<p>".$selected ."</p>";
		$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingID='$_SESSION[ses_jobPostingID]', jobQualiDescription='$selected', jobQualiType='Quality'");
		

		
	    }//for each

	}//if not empty
	

$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingAddCriteria.php?token=$main");
exit();
	

}//if set


else if (isset($_POST['submitQualificationsQualitiesClient']))
{

	
	if (!empty($_POST['name_jobPostingQualities']))
	{

		foreach($_POST['name_jobPostingQualities'] as $selected) 
		{
		//echo "<p>".$selected ."</p>";
		$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingID='$_SESSION[ses_jobPostingID]', jobQualiDescription='$selected', jobQualiType='Quality'");
		

		
	    }//for each

	}//if not empty
	

$main = md5('maintenance');
header("location: ../user/client/maintenance/clientJobPostingAddCriteria.php?token=$main");
exit();
	
}//client job posting

?>