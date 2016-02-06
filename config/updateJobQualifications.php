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
	
	$contractStatus = "";

if(isset($_POST['submitForm'])) 
{



	//job name && vacancy
	$mysqli->query("UPDATE tbl_job_posting SET 
					jobName='$_POST[name_jobPostingJobName]', 
					jobVacancy='$_POST[name_jobPostingJobVacancy]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'");
				
				
	//--------------------------------------------------

	//expected salary
	$salaryOffered = rtrim(ltrim(preg_replace("/[^0-9.]/", "", $_POST['name_jobPostingExpectedMonthlySalary'])));
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$salaryOffered'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Expected Salary'");
	
	
	//gender
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingGender]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Gender'");
				
	//civil status
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingCivilStatus]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Civil Status'");

	//age
	$ageFrom = rtrim(ltrim($_POST['name_jobPostingAgeFrom']));
	$ageTo = rtrim(ltrim($_POST['name_jobPostingAgeTo']));
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$ageFrom'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Age From'");

	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$ageTo'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Age To'");

	
	//religion
	if (isset($_POST[name_jobPostingReligionOthers]))
	{	
	$otherReligion = strtolower(rtrim(ltrim($_POST['name_jobPostingReligionOthers'])));	
	$otherReligion2 = ucfirst($otherReligion);		
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$otherReligion2'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Religion'");
	}
	else if (isset($_POST[name_jobPostingSearchReligion]))
	{
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingSearchReligion]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Religion'");
	}


	//nationality
	if (isset($_POST[name_jobPostingNationalityOthers]))
	{		
	$otherNationality = strtolower(rtrim(ltrim($_POST['name_jobPostingNationalityOthers'])));	
	$otherNationality2 = ucfirst($otherNationality);		
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$otherNationality2'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Nationality'");
	}
	else if (isset($_POST[name_jobPostingSearchNationality]))
	{
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingSearchNationality]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Nationality'");
	}



	//height 
	if ((isset($_POST['name_jobPostingHeightFrom'])) && (isset($_POST['name_jobPostingHeightTo']))  )
	{
	
	$heightFrom = rtrim(ltrim($_POST['name_jobPostingHeightFrom']));
	$heightTo = rtrim(ltrim($_POST['name_jobPostingHeightTo']));
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Height'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$heightFrom', jobQualiType='Height From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$heightTo', jobQualiType='Height To'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='None', jobQualiType='Height', jobQualiPercent='$varResult'");
	
	}
	else
	{
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Height'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
	
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='Any', jobQualiType='Height', jobQualiPercent='$varResult'");
		
	}


	//weight
	if ((isset($_POST['name_jobPostingWeightFrom'])) && (isset($_POST['name_jobPostingWeightTo']))  )
	{
	$weightFrom = rtrim(ltrim($_POST['name_jobPostingWeightFrom']));
	$weightTo = rtrim(ltrim($_POST['name_jobPostingWeightTo']));
				
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Weight'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
				
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightFrom', jobQualiType='Weight From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightTo', jobQualiType='Weight To'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='None', jobQualiType='Weight', jobQualiPercent='$varResult'");
	
	}
	else
	{
	
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Weight'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='Any', jobQualiType='Weight', jobQualiPercent='$varResult'");
	}
	
$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingUpdateLanguage.php?token=$main");
exit();
	
}//if set



if(isset($_POST['submitFormClient']))
{



	//job name && vacancy
	$mysqli->query("UPDATE tbl_job_posting SET 
					jobName='$_POST[name_jobPostingJobName]', 
					jobVacancy='$_POST[name_jobPostingJobVacancy]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'");
				
				
	//--------------------------------------------------

	//expected salary
	$salaryOffered = rtrim(ltrim(preg_replace("/[^0-9.]/", "", $_POST['name_jobPostingExpectedMonthlySalary'])));
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$salaryOffered'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Expected Salary'");
	
	
	//gender
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingGender]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Gender'");
				
	//civil status
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingCivilStatus]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Civil Status'");

	//age
	$ageFrom = rtrim(ltrim($_POST['name_jobPostingAgeFrom']));
	$ageTo = rtrim(ltrim($_POST['name_jobPostingAgeTo']));
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$ageFrom'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Age From'");

	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$ageTo'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Age To'");

	
	//religion
	if (isset($_POST[name_jobPostingReligionOthers]))
	{	
	$otherReligion = strtolower(rtrim(ltrim($_POST['name_jobPostingReligionOthers'])));	
	$otherReligion2 = ucfirst($otherReligion);		
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$otherReligion2'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Religion'");
	}
	else if (isset($_POST[name_jobPostingSearchReligion]))
	{
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingSearchReligion]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Religion'");
	}


	//nationality
	if (isset($_POST[name_jobPostingNationalityOthers]))
	{		
	$otherNationality = strtolower(rtrim(ltrim($_POST['name_jobPostingNationalityOthers'])));	
	$otherNationality2 = ucfirst($otherNationality);		
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$otherNationality2'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Nationality'");
	}
	else if (isset($_POST[name_jobPostingSearchNationality]))
	{
	$mysqli->query("UPDATE tbl_job_quali SET 
					jobQualiDescription='$_POST[name_jobPostingSearchNationality]'
				
				WHERE jobPostingId='$_SESSION[ses_jobPostingID]'
				AND jobQualiType='Nationality'");
	}



	//height 
	if ((isset($_POST['name_jobPostingHeightFrom'])) && (isset($_POST['name_jobPostingHeightTo']))  )
	{
	
	$heightFrom = rtrim(ltrim($_POST['name_jobPostingHeightFrom']));
	$heightTo = rtrim(ltrim($_POST['name_jobPostingHeightTo']));
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Height'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$heightFrom', jobQualiType='Height From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$heightTo', jobQualiType='Height To'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='None', jobQualiType='Height', jobQualiPercent='$varResult'");
	
	}
	else
	{
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Height'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
	
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Height'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='Any', jobQualiType='Height', jobQualiPercent='$varResult'");
		
	}


	//weight
	if ((isset($_POST['name_jobPostingWeightFrom'])) && (isset($_POST['name_jobPostingWeightTo']))  )
	{
	$weightFrom = rtrim(ltrim($_POST['name_jobPostingWeightFrom']));
	$weightTo = rtrim(ltrim($_POST['name_jobPostingWeightTo']));
				
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Weight'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
				
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightFrom', jobQualiType='Weight From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightTo', jobQualiType='Weight To'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='None', jobQualiType='Weight', jobQualiPercent='$varResult'");
	
	}
	else
	{
	
	$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Weight'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
										$varResult = $row['jobQualiPercent'];
									}
	
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight From'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight To'");
	$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Weight'");
	
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='Any', jobQualiType='Weight', jobQualiPercent='$varResult'");
	}
	
$main = md5('maintenance');
header("location: ../user/client/maintenance/clientJobPostingUpdateLanguage.php?token=$main");
exit();


}//update Job posting Client




?>