<?php
	session_start();
	include_once ('../config/connection.php');
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
									{
										die('Could not connect: ' . mysql_error());
									}
																	
								mysql_select_db("$db_database", $con);
	$ageFrom = "";	
	$ageTo = "";	
	$salaryOffered = "";
	$otherReligion = "";
	$otherReligion2 = "";
	$otherNationality = "";
	$otherNationality2 = "";
	$heightFrom = "";
	$heightTo = "";
	$weightFrom = "";
	$weightTo = "";
	$add_jobQualiLanguage = array();

if(isset($_POST['submitForm'])) 
{							


	//expected salary
	$salaryOffered = rtrim(ltrim(preg_replace("/[^0-9.]/", "", $_POST['name_jobPostingExpectedMonthlySalary'])));
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$salaryOffered', jobQualiType='Expected Salary'");
	
	//gender
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$_POST[name_jobPostingGender]', jobQualiType='Gender'");

	//age
	$ageFrom = rtrim(ltrim($_POST['name_jobPostingAgeFrom']));
	$ageTo = rtrim(ltrim($_POST['name_jobPostingAgeTo']));
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$ageFrom', jobQualiType='Age From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$ageTo', jobQualiType='Age To'");

	//civil status
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingID='$_SESSION[ses_jobPostingID]', jobQualiDescription='$_POST[name_jobPostingCivilStatus]', jobQualiType='Civil Status'");

	//religion
	if (isset($_POST[name_jobPostingReligionOthers]))
	{	
	$otherReligion = strtolower(rtrim(ltrim($_POST['name_jobPostingReligionOthers'])));	
	$otherReligion2 = ucfirst($otherReligion);		
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$otherReligion2', jobQualiType='Religion'");
	}
	else if (isset($_POST[name_jobPostingSearchReligion]))
	{
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$_POST[name_jobPostingSearchReligion]', jobQualiType='Religion'");
	}


	//nationality
	if (isset($_POST[name_jobPostingNationalityOthers]))
	{		
	$otherNationality = strtolower(rtrim(ltrim($_POST['name_jobPostingNationalityOthers'])));	
	$otherNationality2 = ucfirst($otherNationality);		
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$otherNationality2', jobQualiType='Nationality'");
	}
	else if (isset($_POST[name_jobPostingSearchNationality]))
	{
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$_POST[name_jobPostingSearchNationality]', jobQualiType='Nationality'");
	}



	//height 
	if ((isset($_POST['name_jobPostingHeightFrom'])) && (isset($_POST['name_jobPostingHeightTo']))  )
	{
	$heightFrom = rtrim(ltrim($_POST['name_jobPostingHeightFrom']));
	$heightTo = rtrim(ltrim($_POST['name_jobPostingHeightTo']));		
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$heightFrom', jobQualiType='Height From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$heightTo', jobQualiType='Height To'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='none', jobQualiType='Height'");
	}
	else
	{
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='any', jobQualiType='Height'");
	}


	//weight
	if ((isset($_POST['name_jobPostingWeightFrom'])) && (isset($_POST['name_jobPostingWeightTo']))  )
	{
	$weightFrom = rtrim(ltrim($_POST['name_jobPostingWeightFrom']));
	$weightTo = rtrim(ltrim($_POST['name_jobPostingWeightTo']));
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightFrom', jobQualiType='Weight From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightTo', jobQualiType='Weight To'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='none', jobQualiType='Weight'");
	}
	else
	{
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='any', jobQualiType='Weight'");
	}
	

}//if set



$main = md5('maintenance');
header("location: ../user/client/maintenance/jobPostingAddLanguage.php?token=$main");
exit();
?>