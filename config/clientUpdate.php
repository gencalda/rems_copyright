<?php
	//connection
		include_once ('../config/connection.php');
		session_start();
	
	
	
	$var_end_contract_to_format=date_create($_POST['name_clientUpdateclientEndContract']);
	$var_end_contract_formatted=date_format($var_end_contract_to_format,'Y/m/d');

	$updateClientId  = mysql_real_escape_string ($_POST['name_clientId']);
	$updateClientBusinessTypeId = mysql_real_escape_string ($_POST['name_searchBusinessType']);
	$updateClientName = mysql_real_escape_string ($_POST['name_clientName']);
	$updateClientEmail = mysql_real_escape_string ($_POST['name_clientEmail']);
	$updateClientNotes = mysql_real_escape_string ($_POST['name_clientNotes']);
	
	$updateAddBlock  = mysql_real_escape_string ($_POST['name_addBlock']);
	$updateAddStreet  = mysql_real_escape_string ($_POST['name_addStreet']);
	$updateAddSubdivision  = mysql_real_escape_string ($_POST['name_addSubdivision']);
	$updateAddBrgy  = mysql_real_escape_string ($_POST['name_addBrgy']);
	$updateAddDistict  = mysql_real_escape_string ($_POST['name_addDistict']);
	$updateAddCity  = mysql_real_escape_string ($_POST['name_addCity']);
	$updateAddProvince  = mysql_real_escape_string ($_POST['name_addProvince']);
	$updateAddCountry  = mysql_real_escape_string ($_POST['name_addCountry']);
	$updateAddZipCode  = mysql_real_escape_string ($_POST['name_addZipCode']);
	

	
	
	
	//Business Type
	if (isset($_POST['name_BusinessTypeOthers']))
	{	
		$otherBusinessType = strtolower(rtrim(ltrim(mysql_real_escape_string($_POST['name_BusinessTypeOthers']))));	
		$otherBusinessType2 = ucfirst($otherBusinessType);
		
		//insert to tbl business type - others
		$mysqli->query("INSERT INTO tbl_type_of_business SET typeOfBusinessName='$otherBusinessType2', typeOfBusinessStatus=1");
		
		$query = "SELECT * FROM tbl_type_of_business ORDER BY typeOfBusinessId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$businessTypeID = $obj->typeOfBusinessId;
					
				}//while
			}//if 


		//update tbl client
		$mysqli->query("UPDATE tbl_client SET 
					typeOfBusinessId = '$businessTypeID',
					clientName =  '$updateClientName',
					clientEmail =  '$updateClientEmail',
					clientNotes =  '$updateClientNotes'
				
				WHERE clientId = '$_SESSION[ses_clientId_forContactUpdate]'");

		
	}//if others
	else if (isset($_POST['name_searchBusinessType']))
	{
		//update tbl client
		$mysqli->query("UPDATE tbl_client SET 
					typeOfBusinessId = '$updateClientBusinessTypeId',
					clientName =  '$updateClientName',
					clientEmail =  '$updateClientEmail',
					clientNotes =  '$updateClientNotes'
				
				WHERE clientId = '$_SESSION[ses_clientId_forContactUpdate]'");
	
	}//if drop down
	
	
	//update tbl address
	$mysqli->query("UPDATE tbl_address SET 
					addBlock =  '$updateAddBlock',
					addStreet =  '$updateAddStreet',
					addSubdivision =  '$updateAddSubdivision',
					addBarangay =  '$updateAddBrgy',
					addDistrict =  '$updateAddDistict',
					addCity =  '$updateAddCity',
					addProvince =  '$updateAddProvince',
					addCountry =  '$updateAddCountry',
					addZip =  '$updateAddZipCode'
				
				WHERE clientId = '$_SESSION[ses_clientId_forContactUpdate]'");
				
			
	//update tbl_contact_info
	if((isset($_POST["name_contactDevice"])) && (isset($_POST["name_contactNumber"])))
	{
		
		
		$ctr = 0;
		foreach($_POST["name_contactDevice"] as $key => $text_field){
			$contactDeviceArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_contactNumber"]as $key => $text_field){
			$contactNumberArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		//delete
		$mysqli->query("DELETE FROM tbl_contact_info WHERE clientId = '$updateClientId'");
		
		$ctr = 0;
			while ((isset($contactDeviceArr[$ctr])) && ($contactDeviceArr[$ctr]!=" "))
			{
						
				$mysqli->query("INSERT INTO tbl_contact_info
						(
							clientId,
							contactDevice,
							contactNumber
						)
						VALUES 
						(
							'$_SESSION[ses_clientId_forContactUpdate]',
							'$contactDeviceArr[$ctr]',
							'$contactNumberArr[$ctr]'
						)"
					);
					echo " values to be inserted: '$_SESSION[ses_clientId_forContactUpdate]',
							'$contactDeviceArr[$ctr]',
							'$contactNumberArr[$ctr]'";
				$ctr++;
			}//while
		
		
	}//if set textbox
			
	
?>

<?php
		$main = md5('maintenance');
		header("Location: ../user/admin/maintenance/clientContactUpdate.php?token=$main");
		exit;
?>