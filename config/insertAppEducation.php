<?php
	include_once ('../config/connection.php');
	session_start();


	$appEducNameOfSchool = array();
	$appEducSchoolLevel = array();
	$appEducSchoolAddress = array();

	//insert into tbl_contact_info
	if((isset($_POST["name_appEducNameOfSchool"])) && (isset($_POST["name_appEducSchoolLevel"])) && (isset($_POST["name_appEducSchoolAddress"])))
	{
		$ctr = 0;
		foreach($_POST["name_appEducNameOfSchool"] as $key => $text_field){
			$appEducNameOfSchool[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appEducSchoolLevel"] as $key => $text_field){
			$appEducSchoolLevel[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appEducSchoolAddress"] as $key => $text_field){
			$appEducSchoolAddress[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
			while ((isset($appEducNameOfSchool[$ctr])) && ($appEducNameOfSchool[$ctr]!=" "))
			{
							
				$mysqli->query("INSERT INTO tbl_education
						(
							basicId,
							schoolName,
							schoolLevel,
							schooAddress
						)
						VALUES 
						(
							'$_SESSION[ses_basicID]',
							'$appEducNameOfSchool[$ctr]',
							'$appEducSchoolLevel[$ctr]',
							'$appEducSchoolAddress[$ctr]'
						)"
					);
				$ctr++;
			}//while
		
	}//if set textbox

	


	mysql_close($connection);
?>

<?php
	$apply = md5('apply');
	header("location: ../user/guest/apply/work.php?token=$apply");
	exit();

?>