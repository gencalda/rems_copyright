<?php
	include_once ('../config/connection.php');
	session_start();

	$appInfoLicenseName = array();
	$appInfoLicenseDescription = array();

	//insert into tbl_contact_info
	if((isset($_POST["name_appInfoLicenseName"])) && (isset($_POST["name_appInfoLicenseDescription"])))
	{
		$ctr = 0;
		foreach($_POST["name_appInfoLicenseName"] as $key => $text_field){
			$appInfoLicenseName[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appInfoLicenseDescription"] as $key => $text_field){
			$appInfoLicenseDescription[$ctr] .= $text_field;
			$ctr++;
		}
		
		
		$ctr = 0;
			while ((isset($appInfoLicenseName[$ctr])) && ($appInfoLicenseName[$ctr]!=" "))
			{
							
				$mysqli->query("INSERT INTO tbl_other
						(
							basicId,
							otherLabelName,
							otherDescription
						)
						VALUES 
						(
							'$_SESSION[ses_basicID]',
							'$appInfoLicenseName[$ctr]',
							'$appInfoLicenseDescription[$ctr]'
						)"
					);
				$ctr++;
			}//while
		
	}//if set textbox

	


	mysql_close($connection);
?>

<?php
	$apply = md5('apply');
	header("location: ../user/guest/apply/desiredPosition.php?token=$apply");
	exit();

?>