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

						$result = mysql_query("SELECT *
									FROM tbl_client
									LEFT JOIN tbl_user_account
									ON tbl_client.clientId = tbl_user_account.clientId
									WHERE tbl_client.clientId = $_POST[name_searchClient]
										 ");
					
	while($row = mysql_fetch_array($result)) 
		{
								
			$contractStatus = $row['accountStatus'];
		}


	if (isset($_POST['name_jobPostingTitleOthers']))
		{
			$otherJobTitle = strtolower(rtrim(ltrim(mysql_real_escape_string($_POST['name_jobPostingTitleOthers']))));	
			$otherJobTitle2 = ucfirst($otherJobTitle);
			
			if($contractStatus=='1')
			{
			//insert into tbl client 
			$mysqli->query("INSERT INTO tbl_job_posting
						(
							clientId,
							jobName,
							jobDescription,
							jobStatus,
							jobVacancy
						)
						VALUES 
						(
							'$_POST[name_searchClient]',
							'$otherJobTitle2',
							'',
							'1',
							'$_POST[name_jobVacancy]'
						)"
					);
			}//if may contract
			else if ($contractStatus=='0')
			{
				$mysqli->query("INSERT INTO tbl_job_posting
						(
							clientId,
							jobName,
							jobDescription,
							jobStatus,
							jobVacancy
						)
						VALUES 
						(
							'$_POST[name_searchClient]',
							'$otherJobTitle2',
							'',
							'2',
							'$_POST[name_jobVacancy]'
						)"
					);
			}//walang contract
		}//if
		else if (isset($_POST['name_searchJob']))
		{
			if($contractStatus=='1')
			{
				//insert into tbl client 
				$mysqli->query("INSERT INTO tbl_job_posting
							(
								clientId,
								jobName,
								jobDescription,
								jobStatus,
								jobVacancy
							)
							VALUES 
							(
								'$_POST[name_searchClient]',
								'$_POST[name_searchJob]',
								'',
								'1',
								'$_POST[name_jobVacancy]'
							)"
						);
			}//may contract
			else if ($contractStatus=='0')
			{
				//insert into tbl client 
				$mysqli->query("INSERT INTO tbl_job_posting
							(
								clientId,
								jobName,
								jobDescription,
								jobStatus,
								jobVacancy
							)
							VALUES 
							(
								'$_POST[name_searchClient]',
								'$_POST[name_searchJob]',
								'',
								'2',
								'$_POST[name_jobVacancy]'
							)"
						);
			}//walang contract
		}//else
		
		
	$query = "SELECT * FROM tbl_job_posting ORDER BY jobPostingId DESC LIMIT 1";
			
			if ($result = $mysqli->query($query))
			{
			
				while ($obj=$result->fetch_object())
				{
					$_SESSION["ses_jobPostingID"] = $obj->jobPostingId;
					$_SESSION["ses_jobPostingTitle"] = $obj->jobName;
			
				}//while
			}//if

	


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
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='None', jobQualiType='Height'");
	}
	else
	{
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='Any', jobQualiType='Height'");
	}


	//weight
	if ((isset($_POST['name_jobPostingWeightFrom'])) && (isset($_POST['name_jobPostingWeightTo']))  )
	{
	$weightFrom = rtrim(ltrim($_POST['name_jobPostingWeightFrom']));
	$weightTo = rtrim(ltrim($_POST['name_jobPostingWeightTo']));
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightFrom', jobQualiType='Weight From'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$weightTo', jobQualiType='Weight To'");
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='None', jobQualiType='Weight'");
	}
	else
	{
	$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='Any', jobQualiType='Weight'");
	}
	

}//if set


$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingAddLanguage.php?token=$main");
exit();



?>