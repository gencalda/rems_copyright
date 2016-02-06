<?php
	include_once ('../config/connection.php');
	session_start();
	
	$familyID = "";
	$appInfoNameOfChild = array();
	$appInfoAgeOfChild = array();
	$appInfoGenderOfChild = array();
	$appInfoCivilStatusOfChild = array();

	$spouse = mysql_escape_string(strtolower($_POST['name_appInfoNameOfSpouse']));
	$spouseAddress = mysql_escape_string(strtolower($_POST['name_appInfoSpouseAddress']));
	$spouseOccupation = mysql_escape_string(strtolower($_POST['name_appInfoSpouseOccupation']));
	$fatherName = mysql_escape_string(strtolower($_POST['name_appInfoNameOfFather']));
	$fatherOccupation = mysql_escape_string(strtolower($_POST['name_appInfoNameOfFather']));
	$motherName = mysql_escape_string(strtolower($_POST['name_appInfoNameOfMother']));
	$motherOccupation = mysql_escape_string(strtolower($_POST['name_appInfoOccupationOfMother']));
	$contactPerson = mysql_escape_string(strtolower($_POST['name_appInfoEmergencyContactPerson']));
	$contactPersonAddress = mysql_escape_string(strtolower($_POST['name_appInfoAddressOfContactPerson']));
	$contactPersonNumber = mysql_escape_string(strtolower($_POST['name_appInfoContactNumberOfContactPerson']));

	
		$mysqli->query("INSERT INTO tbl_family_background
						(
							basicId,
							familySpouse,
							familySpouseAdd,
							familySpouseJob,
							fatherName,
							fatherJob,
							motherName,
							motherJob,
							emergencyNotifyName,
							emergencyNotifyAddress,
							emergencyNotifyContact
						)
						VALUES 
						(
							'$_SESSION[ses_basicID]',
							'$spouse',
							'$spouseAddress',
							'$spouseOccupation',
							'$fatherName',
							'$fatherOccupation',
							'$motherName',
							'$motherOccupation',
							'$contactPerson',
							'$contactPersonAddress',
							'$contactPersonNumber'
						)"
					);
					
		//getting the FamilyID
		$query = "SELECT * FROM tbl_family_background ORDER BY familyId DESC LIMIT 1 ";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$familyID = $obj->familyId;
				}//while
			}//if 
			
					
	//insert into tbl_child
	if((isset($_POST["name_appInfoNameOfChild"])) && (isset($_POST["name_appInfoAgeOfChild"])) && (isset($_POST["name_appInfoGenderOfChild"]))  && (isset($_POST["name_appInfoCivilStatusOfChild"])))
	{
		$ctr = 0;
		foreach($_POST["name_appInfoNameOfChild"] as $key => $text_field){
			$appInfoNameOfChild[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoAgeOfChild"] as $key => $text_field){
			$appInfoAgeOfChild[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoGenderOfChild"] as $key => $text_field){
			$appInfoGenderOfChild[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoCivilStatusOfChild"] as $key => $text_field){
			$appInfoCivilStatusOfChild[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
			while ((isset($appInfoNameOfChild[$ctr])) && ($appInfoNameOfChild[$ctr]!=" "))
			{
							
				$mysqli->query("INSERT INTO tbl_child
						(
							familyId,
							childName,
							childAge,
							childGender,
							childCivil
						)
						VALUES 
						(
							'$familyID',
							'$appInfoNameOfChild[$ctr]',
							'$appInfoAgeOfChild[$ctr]',
							'$appInfoGenderOfChild[$ctr]',
							'$appInfoCivilStatusOfChild[$ctr]'
						)"
					);
				$ctr++;
			}//while
		
	}//if set textbox
			

	mysql_close($connection);
?>

<?php
	
	$apply = md5('apply');
	header("location: ../user/guest/apply/insuranceInformation.php?token=$apply");
	exit();

?>