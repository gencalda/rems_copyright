<?php
	session_start();
	include_once ('../config/connection.php');

		$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
									{
										die('Could not connect: ' . mysql_error());
									}
																	
								mysql_select_db("$db_database", $con);

if(isset($_POST['submitQualificationsLanguage'])) 
{							


$resultCtr = "";
$varResult = "";
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
														and jobQualiType = 'Language'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
									
										$varResult = $row['jobQualiPercent'];
									}
		$resultCtr = mysql_num_rows($result);	

		$totalPercent = floatval($resultCtr) * floatval($varResult);
				

$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Language' AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)");

	if (!empty($_POST['name_jobPostingLanguage']))
	{

		foreach($_POST['name_jobPostingLanguage'] as $selected) 
		{
		//echo "<p>".$selected ."</p>";
		$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$selected', jobQualiType='Language'");
		

		
	    }//for each

	}//if not empty
	
	$perQualification = "";
	
	
	$resultCriteria = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
														and jobQualiType = 'Language'
														 ");
														 
		$resultCtrCriteria = mysql_num_rows($resultCriteria);	

		$perQualification = floatval($totalPercent) / floatval($resultCtrCriteria);
		
		//language
			$mysqli->query("UPDATE tbl_job_quali  SET
							jobQualiPercent = '$perQualification'
							WHERE jobPostingId = $_SESSION[ses_jobPostingID]
							AND jobQualiType = 'Language'
							AND (jobQualiNewlyAdded != 'Yes' 
								OR  jobQualiNewlyAdded IS NULL)
							");

							

$main = md5('maintenance');
header("location: ../user/admin/maintenance/jobPostingUpdateSkills.php?token=$main");
exit();


}//if set


if(isset($_POST['submitQualificationsLanguageClient']))
{



$resultCtr = "";
$varResult = "";

$languagePercentUpdate = array();
$languageUpdate = array();
	$result = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
														and jobQualiType = 'Language'
														 ");
														 
									while($row = mysql_fetch_array($result)) 
									{
									
										$varResult = $row['jobQualiPercent'];
									}
									
									$result = mysql_query("SELECT *
														FROM  tbl_job_quali 
														WHERE jobQualiType = 'Language'
														AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
														AND jobPostingId = $_SESSION[ses_jobPostingID]
														");
														
														//echo"jobID: $_SESSION[ses_jobPostingID]";
														//echo"</br> language $jobLanguages[$ctr]";
											$ctr=0;
											while($row = mysql_fetch_array($result)) 
											{	
												$languagePercentUpdate[$ctr] = $row['jobQualiPercent'];
												$languageUpdate[$ctr] = $row['jobQualiDescription'];
												$ctr++;
											}			
									
									
		$resultCtr = mysql_num_rows($result);	

		$totalPercent = floatval($resultCtr) * floatval($varResult);
				

$mysqli->query("DELETE FROM `tbl_job_quali` WHERE `jobPostingId` ='$_SESSION[ses_jobPostingID]' AND `jobQualiType` = 'Language' AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)");

	if (!empty($_POST['name_jobPostingLanguage']))
	{

		foreach($_POST['name_jobPostingLanguage'] as $selected) 
		{
		//echo "<p>".$selected ."</p>";
		$mysqli->query("INSERT INTO tbl_job_quali SET jobPostingId='$_SESSION[ses_jobPostingID]', jobQualiDescription='$selected', jobQualiType='Language'");
		

		
	    }//for each

	}//if not empty
	
	$perQualification = "";
	
	
	$resultCriteria = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
														and jobQualiType = 'Language'
														 ");
														 
		$resultCtrCriteria = mysql_num_rows($resultCriteria);	

		$perQualification = floatval($totalPercent) / floatval($resultCtrCriteria);
		
		//language
			$mysqli->query("UPDATE tbl_job_quali  SET
							jobQualiPercent = '$perQualification'
							WHERE jobPostingId = $_SESSION[ses_jobPostingID]
							AND jobQualiType = 'Language'
							AND (jobQualiNewlyAdded != 'Yes' 
								OR  jobQualiNewlyAdded IS NULL)
							");
														
		$ctr = 0;
		while($row = mysql_fetch_array($resultCriteria)) 
											{	
											
												$mysqli->query("UPDATE tbl_job_quali  SET
													jobQualiPercent = '$languagePercentUpdate[$ctr]'
													WHERE jobPostingId = $_SESSION[ses_jobPostingID]
													AND jobQualiType = 'Quality'
													AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
													AND jobQualiDescription = '$languageUpdate[$ctr]'
													");
												$ctr++;
											}

							

$main = md5('maintenance');
header("location: ../user/client/maintenance/clientJobPostingUpdateSkills.php?token=$main");
exit();

}//update job posting Client


?>