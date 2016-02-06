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
		$mysqli->query("INSERT INTO tbl_personal_info SET basicId='$_SESSION[ses_basicID]', personalQualityDesc='$selected', personalQualityType='Language'");
		

		
	    }//for each

	}//if not empty
}//if set

$apply = md5('apply');
header("location: ../user/guest/apply/demographicData.php?token=$apply");

?>