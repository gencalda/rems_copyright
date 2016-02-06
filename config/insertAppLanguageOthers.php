<?php
	session_start();
	include_once ('../config/connection.php');
	

	$otherLanguage = "";
	$otherLanguage2 = "";
	
	$otherLanguage =  mysql_escape_string(strtolower(rtrim(ltrim($_POST['name_jobPostingLanguageOthers']))));
	$otherLanguage2 = ucfirst($otherLanguage);
$mysqli->query("INSERT INTO tbl_personal_info SET 
			personalQualityDesc= '$otherLanguage2', 
			basicId='$_SESSION[ses_basicID]',
			personalQualityType='Language',
			personalQualityNewlyAdded='Yes'
			");


$apply = md5('apply');
header("location: ../user/guest/apply/LanguageSpoken.php?token=$apply");
if (!mysql_query($query))
{
	die('Error inserting position: ' . mysql_error());
}

?>
