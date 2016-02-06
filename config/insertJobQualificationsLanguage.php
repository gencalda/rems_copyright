<?php
	session_start();
	include_once ('../config/connection.php');


if(isset($_POST['submitQualificationsLanguage'])) 
{							

	if (!empty($_POST['name_jobPostingLanguage']))
	{

		foreach($_POST['name_jobPostingLanguage'] as $selected) 
		{
		//echo "<p>".$selected ."</p>";
		$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$selected', jobQualiType='Language'");
		

		
	    }//for each

	}//if not empty
	
	
$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingAddSkills.php?token=$main");
exit();

}//if set

else if (isset($_POST['submitQualificationsLanguageClient']))
{

	if (!empty($_POST['name_jobPostingLanguage']))
	{

		foreach($_POST['name_jobPostingLanguage'] as $selected) 
		{
		//echo "<p>".$selected ."</p>";
		$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$selected', jobQualiType='Language'");
		

		
	    }//for each

	}//if not empty
	

$main = md5('maintenance');
header("location: ../user/client/maintenance/clientjobPostingAddSkills.php?token=$main");
exit();


}//else








?>