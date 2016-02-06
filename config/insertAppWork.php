<?php
	include_once ('../config/connection.php');
	session_start();

	$appWorkCompanyName = array();
	$appWorkYear = array();
	$appWorkPosition = array();
	$appWorkSalary = array();
	$appWorkImmediateSupervisor = array();
	$appWorkReason = array();
	
	//insert into tbl_work
	if((isset($_POST["name_appWorkCompanyName"])) && (isset($_POST["name_appWorkYear"])) && (isset($_POST["name_appWorkPosition"])) && (isset($_POST["name_appWorkSalary"])) && (isset($_POST["name_appWorkImmediateSupervisor"])) && (isset($_POST["name_appWorkReason"])))
	{
		$ctr = 0;
		foreach($_POST["name_appWorkCompanyName"] as $key => $text_field){
			$appWorkCompanyName[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appWorkYear"] as $key => $text_field){
			$appWorkYear[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appWorkPosition"] as $key => $text_field){
			$appWorkPosition[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appWorkSalary"] as $key => $text_field){
			$appWorkSalary[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appWorkImmediateSupervisor"] as $key => $text_field){
			$appWorkImmediateSupervisor[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_appWorkReason"] as $key => $text_field){
			$appWorkReason[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
			while ((isset($appWorkCompanyName[$ctr])) && ($appWorkCompanyName[$ctr]!=" "))
			{
							
				$mysqli->query("INSERT INTO tbl_work
						(
							basicId,
							companyName,
							workYear,
							workPosition,
							workSalary,
							workSupervisor,
							workLeavingReason
						)
						VALUES 
						(
							'$_SESSION[ses_basicID]',
							'$appWorkCompanyName[$ctr]',
							'$appWorkYear[$ctr]',
							'$appWorkPosition[$ctr]',
							'$appWorkSalary[$ctr]',
							'$appWorkImmediateSupervisor[$ctr]',
							'$appWorkReason[$ctr]'
						)"
					);
				$ctr++;
			}//while
		
	}//if set textbox


	


	mysql_close($connection);
?>

<?php
	$apply = md5('apply');	
	header("location: ../user/guest/apply/character.php?token=$apply");
	exit();

?>