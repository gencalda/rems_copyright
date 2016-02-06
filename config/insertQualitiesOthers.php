<?php
	session_start();
	include_once ('../config/connection.php');


if(isset($_POST['name_jobPostingQualitiesOthersAdd'])) 
{	
	$otherQualities = "";
	$otherQualities = "";
	$otherQualities = strtolower(rtrim(ltrim($_POST['name_jobPostingQualitiesOthers'])));
	$otherQualities2 = ucfirst($otherQualities);

	$mysqli->query("INSERT INTO tbl_job_quali SET 
			jobQualiDescription= '$otherQualities2 ', 
			jobPostingId='$_SESSION[ses_jobPostingID]',
			jobQualiType='Quality',
			jobQualiNewlyAdded='Yes'
			");

$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingAddSkills.php?token=$main");
exit();
}//if insert


else if (isset($_POST['name_jobPostingQualitiesOthersUpdate']))
{

$otherQualities = "";
	$otherQualities = "";
	$otherQualities = strtolower(rtrim(ltrim($_POST['name_jobPostingQualitiesOthers'])));
	$otherQualities2 = ucfirst($otherQualities);
$mysqli->query("INSERT INTO tbl_job_quali SET 
				jobQualiDescription='$otherQualities2',
				 jobPostingID='$_SESSION[ses_jobPostingID]',
				 jobQualiType='Quality',
				 jobQualiNewlyAdded='Yes'
 ");

$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingUpdateSkills.php?token=$main");
exit();

}//if update

else if (isset($_POST['name_jobPostingQualitiesOthersAddClient']))
{

	
$otherQualities = "";
	$otherQualities = "";
	$otherQualities = strtolower(rtrim(ltrim($_POST['name_jobPostingQualitiesOthers'])));
	$otherQualities2 = ucfirst($otherQualities);
$mysqli->query("INSERT INTO tbl_job_quali SET 
				jobQualiDescription='$otherQualities2',
				 jobPostingID='$_SESSION[ses_jobPostingID]',
				 jobQualiType='Quality',
				 jobQualiNewlyAdded='Yes'
 ");


$main = md5('maintenance'); 
header("location: ../user/client/maintenance/clientJobPostingAddSkills.php?token=$main");
exit();

}//client jobposting


else if (isset($_POST['name_jobPostingQualitiesOthersUpdateClient']))
{

$otherQualities = "";
	$otherQualities = "";
	$otherQualities = strtolower(rtrim(ltrim($_POST['name_jobPostingQualitiesOthers'])));
	$otherQualities2 = ucfirst($otherQualities);
$mysqli->query("INSERT INTO tbl_job_quali SET 
				jobQualiDescription='$otherQualities2',
				 jobPostingID='$_SESSION[ses_jobPostingID]',
				 jobQualiType='Quality',
				 jobQualiNewlyAdded='Yes'
				");

 
 echo" session: $_SESSION[ses_jobPostingID] </br> other: $otherQualities2";

$main = md5('maintenance'); 
header("location: ../user/client/maintenance/clientJobPostingUpdateSkills.php?token=$main");
exit();

}//client job posting Update



?>