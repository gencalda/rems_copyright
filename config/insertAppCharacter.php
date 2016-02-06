<?php
	include_once ('../config/connection.php');
	session_start();
	
	$appInfoCharacterReferenceName = array();
	$appInfoCharacterReferenceOccupation = array();
	$appInfoCharacterReferenceCompanyName = array();
	$appInfoCharacterReferenceAddress = array();
	$appInfoCharacterReferenceContactNumber = array();

//insert into tbl_contact_info
	if((isset($_POST["name_appInfoCharacterReferenceName"])) && (isset($_POST["name_appInfoCharacterReferenceOccupation"])) && (isset($_POST["name_appInfoCharacterReferenceAddress"])) && (isset($_POST["name_appInfoCharacterReferenceContactNumber"])))
	{
		$ctr = 0;
		foreach($_POST["name_appInfoCharacterReferenceName"] as $key => $text_field){
			$appInfoCharacterReferenceName[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoCharacterReferenceOccupation"] as $key => $text_field){
			$appInfoCharacterReferenceOccupation[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoCharacterReferenceAddress"] as $key => $text_field){
			$appInfoCharacterReferenceAddress[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoCharacterReferenceContactNumber"] as $key => $text_field){
			$appInfoCharacterReferenceContactNumber[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoCharacterReferenceCompanyName"] as $key => $text_field){
			$appInfoCharacterReferenceCompanyName[$ctr] .= $text_field;
			$ctr++;
		}
		
		
		$ctr = 0;
			while ((isset($appInfoCharacterReferenceName[$ctr])) && ($appInfoCharacterReferenceName[$ctr]!=" "))
			{
							
				$mysqli->query("INSERT INTO tbl_character
						(
							basicId,
							characterName,
							characterJob,
							characterCompanyName,
							characterAddress,
							characterContact
						)
						VALUES 
						(
							'$_SESSION[ses_basicID]',
							'$appInfoCharacterReferenceName[$ctr]',
							'$appInfoCharacterReferenceOccupation[$ctr]',
							'$appInfoCharacterReferenceCompanyName[$ctr]',
							'$appInfoCharacterReferenceAddress[$ctr]',
							'$appInfoCharacterReferenceContactNumber[$ctr]'
						)"
					);
				$ctr++;
			}//while
		
	}//if set textbox

	mysql_close($connection);
?>

<?php
	$apply =  md5('apply');
	header("location: ../user/guest/apply/otherInformation.php?token=$apply");
	exit();
?>