<?php
	session_start();
	include_once ('../config/connection.php');
	

	$otherLanguage =  strtolower(rtrim(ltrim($_POST['name_jobPostingLanguageOthers'])));
	$otherLanguage2 = ucfirst($otherLanguage);
$mysqli->query("INSERT INTO jobQualifications SET 
			jobQualifiDesc= '$otherLanguage2', 
			jobPostingID='$_SESSION[ses_jobPostingID]',
			jobQualifiType='language',
			jobQualifiNewlyAddedDesc='yes'
			");

			
			
$main = md5('maintenance');
header("location: ../user/client/maintenance/jobPostingAddSkills.php?token=$main");
exit();

?>
