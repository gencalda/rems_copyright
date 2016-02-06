<?php
	include_once ('../config/connection.php');
	session_start();
	
		
	//date year
	if (isset($_POST['year']))
	{
		$year = $_POST['year'];
	}
	else if (!(isset($_POST['year'])))
	{
		$year = $yearBday;
		echo " year not set";
	}
	
	//month
	if (isset($_POST['month']))
	{
		$month = $_POST['month'];
	}
	else if (!(isset($_POST['month'])))
	{
		$month = $monthBday;
		echo " day not set";
	}
	
	//day
	if (isset($_POST['day']))
	{
		$day = $_POST['day'];
	}
	else if (!(isset($_POST['day'])))
	{
		$day = $dayBday;
		echo " day not set";
	}
	
	$dateString = $year."-".$month."-".$day;
	$dateToFormat = date_create($dateString);
	$dateFormatted_bday = date_format($dateToFormat,"Y/m/d");
	
	$interval = $dateToFormat->diff(new DateTime()); //calculates the difference between two DateTime objects 
	//
	$ageObj = $interval->y;
	$age = strval($ageObj);

	$beneficiaryName = mysql_escape_string(strtolower($_POST['name_appInfoBenificiaryName']));
	$address = mysql_escape_string(strtolower($_POST['name_appInfoBenificiaryAddress']));
	$relationship = mysql_escape_string(strtolower($_POST['name_appInfoBenificiaryRelationship']));
	$gender = mysql_escape_string(strtolower($_POST['name_appInfoBenificiaryGender']));
	$civil = mysql_escape_string(strtolower($_POST['name_appInfoBenificiaryCivilStatus']));



	$mysqli->query("INSERT INTO tbl_insurance_info
						(
							basicId,
							benificiaryName,
							benificiaryAdd,
							benificiaryRelationship,
							benificiaryDob,
							benificiaryGender,
							benificaryAge,
							benificiaryCivil
						)
						VALUES 
						(
							'$_SESSION[ses_basicID]',
							'$beneficiaryName',
							'$address',
							'$relationship',
							'$dateFormatted_bday',
							'$gender',
							'$age',
							'$civil'
						)"
					);


	mysql_close($connection);
?>

<?php

	$apply = md5('apply');
	header("location: ../user/guest/apply/education.php?token=$apply");
	exit();

?>