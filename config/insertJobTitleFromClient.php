<?php
	include_once ('../config/connection.php');
	session_start();

	$otherJobTitle = "";
	$otherJobTitle2 = "";
	
	if(isset($_POST['submit'])) 
	{
	
		if (isset($_POST['name_jobPostingTitleOthers']))
		{
			$otherJobTitle = strtolower(rtrim(ltrim(mysql_real_escape_string($_POST['name_jobPostingTitleOthers']))));	
			$otherJobTitle2 = ucfirst($otherJobTitle);
			
			//insert into tbl client 
			$mysqli->query("INSERT INTO tbl_job_posting
						(
							clientId,
							jobName,
							jobDescription,
							jobStatus
						)
						VALUES 
						(
							'$_POST[name_searchClient]',
							'$otherJobTitle2',
							'',
							'1'
						)"
					);
		}//if
		else if (isset($_POST['name_searchJob']))
		{
			//insert into tbl client 
			$mysqli->query("INSERT INTO tbl_job_posting
						(
							clientId,
							jobName,
							jobDescription,
							jobStatus
						)
						VALUES 
						(
							'$_POST[name_searchClient]',
							'$_POST[name_searchJob]',
							'',
							'1'
						)"
					);
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

	}//if set


echo 'id: '.$_SESSION["ses_jobPostingID"].' title: '.$_SESSION["ses_jobPostingTitle"].' ';


$main = md5('maintenance');
header("location: ../user/client/maintenance/jobPostingAddQualifications.php?token=$main");
exit();
?>