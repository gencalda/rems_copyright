<?php
	include_once ('../config/connection.php');
	session_start();


	$appBirthday1 = "";
	$appBirthday = "";
	$year = "";
	$month = "";
	$day = "";
	$yearBday = "";
	$monthBday = "";
	$dayBday = "";


	$con = mysql_connect("$db_hostname","$db_username","$db_password");
		
		if (!$con)
		{
			die('Could not connect: ' . mysql_error()); 
		}
		mysql_select_db("$db_database", $con);
		
		$query = mysql_query("SELECT * FROM appInformation WHERE applicantID = '".$_SESSION["ses_basicID"]."'");
			// display query results
			
			while($row = mysql_fetch_array($query))
			{
				$appBirthday1 = $row['appInfoBirthday'];
			}
			$appBirthday = strtotime($appBirthday1);
			$yearBday = date("Y", $appBirthday);
			$monthBday = date("M", $appBirthday);
			$dayBday = date("d", $appBirthday);
		
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
	
	//error
	$interval = $dateToFormat->diff(new DateTime()); //calculates the difference between two DateTime objects 
	//
	$ageObj = $interval->y;
	$age = strval($ageObj);
	echo" age: ".$age;
	
	if (!(isset($_SESSION['ses_applyPage2'])))
	{
		
		$mysqli->query("UPDATE tbl_basic_info SET 
					 basicDob='$dateFormatted_bday'
					WHERE basicId = '$_SESSION[ses_basicID]' 
					");
					

		$placeOfBirth = mysql_escape_string($_POST['name_personalPlaceOfBirth']);

		$mysqli->query("UPDATE tbl_basic_info SET 
					 basicBirthPlace='$placeOfBirth'
					WHERE basicId = '$_SESSION[ses_basicID]' 
					");
	
		$mysqli->query("INSERT INTO tbl_personal_info SET 
				basicId = '$_SESSION[ses_basicID]',
				personalQualityDesc = '$age',
				personalQualityType = 'Age'
			"); // age
		
		$mysqli->query("INSERT INTO tbl_personal_info SET 
				basicId = '$_SESSION[ses_basicID]',
				personalQualityDesc = '$_POST[name_personalGender]',
				personalQualityType = 'Gender'
			");
			
		$mysqli->query("INSERT INTO tbl_personal_info SET 
				basicId = '$_SESSION[ses_basicID]',
				personalQualityDesc = '$_POST[name_personalCivilStatus]',
				personalQualityType = 'Civil Status'
			");
		
		//height
		$height = mysql_escape_string(rtrim(ltrim($_POST['name_personalHeight'])));
		$mysqli->query("INSERT INTO tbl_personal_info SET 
				basicId = '$_SESSION[ses_basicID]',
				personalQualityDesc = '$height',
				personalQualityType = 'Height'
			");
			
		//weight
		$weight = mysql_escape_string(rtrim(ltrim($_POST['name_personalWeight'])));
		$mysqli->query("INSERT INTO tbl_personal_info SET 
				basicId = '$_SESSION[ses_basicID]',
				personalQualityDesc = '$weight',
				personalQualityType = 'Weight'
			");
			
		//religion
		if (isset($_POST[name_personalReligionOthers]))
		{	
		$otherReligion = mysql_escape_string(strtolower(rtrim(ltrim($_POST['name_personalReligionOthers']))));	
		$otherReligion2 = ucfirst($otherReligion);		
		$mysqli->query("INSERT INTO tbl_personal_info SET 
					basicId = '$_SESSION[ses_basicID]',
					personalQualityDesc ='$otherReligion2', 
					personalQualityType ='Religion'
					");
		}//if
		else if (isset($_POST[name_personalSearchReligion]))
		{
		$mysqli->query("INSERT INTO tbl_personal_info SET 
					basicId = '$_SESSION[ses_basicID]', 
					personalQualityDesc ='$_POST[name_personalSearchReligion]', 
					personalQualityType ='Religion'
					");
		}//else


		//nationality
		if (isset($_POST[name_personalNationalityOthers]))
		{		
		$otherNationality = mysql_escape_string(strtolower(rtrim(ltrim($_POST['name_personalNationalityOthers']))));	
		$otherNationality2 = ucfirst($otherNationality);		
		$mysqli->query("INSERT INTO tbl_personal_info SET 
						basicId = '$_SESSION[ses_basicID]',
						personalQualityDesc = '$otherNationality2', 
						personalQualityType ='Nationality'
						");
		}//if
		else if (isset($_POST[name_personalSearchNationality]))
		{
		$mysqli->query("INSERT INTO tbl_personal_info SET 
						basicId = '$_SESSION[ses_basicID]', 
						personalQualityDesc ='$_POST[name_personalSearchNationality]',
						personalQualityType ='Nationality'
						");
		}//else

	
		//
		// pag ayos na i-uncomment to
		//
		//$_SESSION["ses_applyPage2"] = 'yes';    
	
	}//if not set
	
	
	
	//not working pa code sa baba nito
	else if(isset($_SESSION['ses_applyPage2']))
	{
		//delete
		$query = mysql_query("DELETE FROM appqualities WHERE appQualityType='language' AND applicantID = '".$_SESSION['ses_applicantID']."'");
	
		$mysqli->query("UPDATE appInformation SET 
					 appInfoBirthday='$dateFormatted_bday'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					");
					
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$age'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'age'
					");
					
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$_POST[name_appQualityGender]'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'gender'
					");
					
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$_POST[name_appQualityCivilStatus]'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'civil status'
					");
		
		$height = rtrim(ltrim($_POST['name_appQualityHeight']));		
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$height'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'height'
					");
					
		$weight = rtrim(ltrim($_POST['name_appQualityWeight']));
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$weight'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'weight'
					");
					
				
		//religion
		if (isset($_POST[name_appQualityReligionOthers]))
		{	
		$otherReligion = mysql_escape_string(strtolower(rtrim(ltrim($_POST['name_appQualityReligionOthers']))));	
		$otherReligion2 = ucfirst($otherReligion);		
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$otherReligion2'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'religion'
					");	
		}//if
		else if (isset($_POST[name_appQualitySearchReligion]))
		{
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$_POST[name_appQualitySearchReligion]'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'religion'
					");
		}//else		
					
		
		//nationality
		if (isset($_POST[name_appQualityNationalityOthers]))
		{		
		$otherNationality = mysql_escape_string(strtolower(rtrim(ltrim($_POST['name_appQualityNationalityOthers']))));	
		$otherNationality2 = ucfirst($otherNationality);
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$otherNationality2'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'nationality'
					");
		}//if
		else if (isset($_POST[name_appQualitySearchNationality]))
		{
		$mysqli->query("UPDATE appQualities SET 
					appQualityDesc = '$_POST[name_appQualitySearchNationality]'
					WHERE applicantID = '$_SESSION[ses_applicantID]' 
					AND appQualityType = 'nationality'
					");
		}//else
		
		$languageSpoken = explode(",",strtolower($_POST['name_appQualityLanguageSpoken']));
		
		$languageSpoken2 = array();
		$languageSpoken3 = array();
		
		$num =0;							
		while($languageSpoken[$num]!='')
		{
			$languageSpoken2[$num] = rtrim(ltrim($languageSpoken[$num]));
			$languageSpoken3[$num] = ucfirst($languageSpoken2[$num]);
			$mysqli->query("INSERT INTO appQualities SET 
					applicantID = '$_SESSION[ses_applicantID]',
					appQualityDesc = '$languageSpoken3[$num]',
					appQualityType = 'language'
				");  
			
			 $num++;	
		 
		}//while
		
	}//if set
	
?>

<?php
	$_SESSION['gender']=$_POST['name_personalGender'];
	$_SESSION['age']=$age;
	$_SESSION['bday']=$dateFormatted_bday;
	$apply = md5('apply');
	header("location: ../user/guest/apply/LanguageSpoken.php?token=$apply");
?>