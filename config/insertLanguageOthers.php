<?php
	session_start();
	include_once ('../config/connection.php');
	
if(isset($_POST['name_jobPostingLanguageOthersAdd'])) 
{							

	$otherLanguage =  strtolower(rtrim(ltrim($_POST['name_jobPostingLanguageOthers'])));
	$otherLanguage2 = ucfirst($otherLanguage);
$mysqli->query("INSERT INTO tbl_job_quali SET 
			jobQualiDescription= '$otherLanguage2', 
			jobPostingId='$_SESSION[ses_jobPostingID]',
			jobQualiType='Language',
			jobQualiNewlyAdded='Yes'
			");


$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingAddLanguage.php?token=$main");
exit();
}//if insert


else if(isset($_POST['name_jobPostingLanguageOthersUpdate']))
{
	$otherLanguage =  strtolower(rtrim(ltrim($_POST['name_jobPostingLanguageOthers'])));
	$otherLanguage2 = ucfirst($otherLanguage);
	
$mysqli->query("INSERT INTO tbl_job_quali SET 
			jobQualiDescription= '$otherLanguage2', 
			jobPostingId='$_SESSION[ses_jobPostingID]',
			jobQualiType='Language',
			jobQualiNewlyAdded='Yes'
			");

			
$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingUpdateLanguage.php?token=$main");
exit();
}//if update

else if(isset($_POST['name_jobPostingLanguageOthersAddClient']))
{

$otherLanguage =  strtolower(rtrim(ltrim($_POST['name_jobPostingLanguageOthers'])));
	$otherLanguage2 = ucfirst($otherLanguage);
	
$mysqli->query("INSERT INTO tbl_job_quali SET 
			jobQualiDescription= '$otherLanguage2', 
			jobPostingId='$_SESSION[ses_jobPostingID]',
			jobQualiType='Language',
			jobQualiNewlyAdded='Yes'
			");

			
$main = md5('maintenance');
header("location: ../user/client/maintenance/clientJobPostingAddLanguage.php?token=$main");
exit();

}//job posting client


else if (isset($_POST['name_jobPostingLanguageOthersUpdateClient']))
{
	$otherLanguage =  strtolower(rtrim(ltrim($_POST['name_jobPostingLanguageOthers'])));
	$otherLanguage2 = ucfirst($otherLanguage);
	
$mysqli->query("INSERT INTO tbl_job_quali SET 
			jobQualiDescription= '$otherLanguage2', 
			jobPostingId='$_SESSION[ses_jobPostingID]',
			jobQualiType='Language',
			jobQualiNewlyAdded='Yes'
			");

			
$main = md5('maintenance');
header("location: ../user/client/maintenance/clientJobPostingUpdateLanguage.php?token=$main");
exit();

}//update job posting client Update

if (!mysql_query($query))
{
	die('Error inserting position: ' . mysql_error());
}

?>

