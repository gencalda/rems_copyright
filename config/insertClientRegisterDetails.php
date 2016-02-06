<?php

//connection

	include_once ('../config/connection.php');
	session_start();
	
	$var_start_contract_to_format="";
	$var_start_contract_formatted="";
	$var_end_contract_to_format="";
	$var_end_contract_formatted="";
	$yearStarted = "";
	$otherBusinessType = "";
	$otherBusinessType2 = "";
	$businessTypeID = "";
	$addClientName = "";
	$addClientEmail = "";
	$addClientNotes = "";
	$userPass = "";
	$voucherCodeClean = "";
	$voucherCode = "";
	
	
	$voucherCodeClean = rtrim(ltrim(preg_replace("/[^ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890]/", "", $_POST['name_clientName'])));
	$voucherCode = substr(str_shuffle(str_repeat(strtoupper($voucherCodeClean), 5)), 0, 5);
	
	
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

			
				
			//insert into tbl client 
		$mysqli->query("INSERT INTO tbl_client
						(
							typeOfBusinessId,
							clientName,
							clientEmail,
							clientNotes,
							clientAccessCode
						)
						VALUES 
						(
							'$businessTypeID',
							'$_POST[name_clientName]',
							'$_POST[name_clientEmail]',
							'$_POST[name_clientNotes]',
							''
						)"
					);
					
					
		//getting the clientID
		$query = "SELECT * FROM tbl_client ORDER BY clientId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$clientID = $obj->clientId;
					
				}//while
			}//if 
			
			//update voucher code
			$mysqli->query("UPDATE tbl_client SET clientAccessCode ='$voucherCode$clientID' WHERE clientId = $clientID");	

					
	}//if others
	
	else if (isset($_POST['name_searchBusinessType']))
	{
		//insert into tbl client
		$mysqli->query("INSERT INTO tbl_client
						(
							typeOfBusinessId,
							clientName,
							clientEmail,
							clientNotes,
							clientAccessCode
						)
						VALUES 
						(
							'$_POST[name_searchBusinessType]',
							'$_POST[name_clientName]',
							'$_POST[name_clientEmail]',
							'$_POST[name_clientNotes]',
							''
						)"
					);
	
	//getting the clientID
		$query = "SELECT * FROM tbl_client ORDER BY clientId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$clientID = $obj->clientId;
					
				}//while
			}//if 
	
		//update voucher code
			$mysqli->query("UPDATE tbl_client SET clientAccessCode ='$voucherCode$clientID' WHERE clientId = $clientID");	

	
	}//if drop down
	
	
	
	//insert into tbl address
	
	$mysqli->query("INSERT INTO tbl_address
					(
						clientId, 
						addBlock,
						addStreet,
						addSubdivision,
						addBarangay,
						addDistrict,
						addCity,
						addProvince,
						addCountry,
						addZip
					)
					VALUES 
					(
						'$clientID',
						'$_POST[name_addBlock]',
						'$_POST[name_addStreet]',
						'$_POST[name_addSubdivision]',
						'$_POST[name_addBrgy]',
						'$_POST[name_addDistrict]',
						'$_POST[name_addCity]',
						'$_POST[name_addProvince]',
						'$_POST[name_addCountry]',
						'$_POST[name_addZipCode]'
					)"
				);
	
	//insert into tbl_contact_info
	if((isset($_POST["name_contactDevice"])) && (isset($_POST["name_contactNumber"])))
	{
		$ctr = 0;
		foreach($_POST["name_contactDevice"] as $key => $text_field){
			$contactDeviceArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_contactNumber"] as $key => $text_field){
			$contactNumber[$ctr] .= $text_field;
			$ctr++;
		}
		
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
							'$clientID',
							'$contactDeviceArr[$ctr]',
							'$contactNumber[$ctr]'
						)"
					);
				$ctr++;
			}//while
		
	}//if set textbox
	
	
	//insert into tbl_contract
	$mysqli->query("INSERT INTO tbl_contract
						(
							clientId,
							contractStatus
						)
						VALUES 
						(
							'$clientID',
							'not started'
						)"
					);
	
	
	//insert into tbl_useraccount
	$userPass  = $clientID;
	$userPass = str_pad($userPass, 5, '0', STR_PAD_LEFT);
	$year = date("Y");
	
	$mysqli->query("INSERT INTO tbl_user_account
						(	
							clientId,
							accountRole,
							accountUsername,
							accountPassword,
							accountNotes,
							accountStatus
						)
						VALUES 
						(
							'$clientID',
							'client',
							'$year-CLN-$userPass',
							'$year-CLN-$userPass',
							'',
							'0'
						)"
					);
	
	
		//session variable
		$_SESSION["ses_clientId_forContactAdd"] = $clientID;
	
?>


<?php
		$reg = md5('register');
		header("Location: ../user/guest/registerInfoContact.php?token=$reg");
		exit;
?>