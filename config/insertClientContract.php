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
	
	
	
	$var_start_contract_to_format=date_create(mysql_real_escape_string($_POST['name_clientStartContract']));
	$var_start_contract_formatted=date_format($var_start_contract_to_format,'Y/m/d');
	
	$var_end_contract_to_format=date_create(mysql_real_escape_string($_POST['name_clientEndContract']));
	$var_end_contract_formatted=date_format($var_end_contract_to_format,'Y/m/d');

	
	
	//insert into tbl_contract
	$mysqli->query("INSERT INTO tbl_contract
						(
							clientId,
							contractStartDate,
							contractEndDate,
							contractStatus
						)
						VALUES 
						(
							'$_POST[name_searchClientName]',
							'$var_start_contract_formatted',
							'$var_end_contract_formatted',
							'on-going'
						)"
					);
	
	
	//getting the year contract Started -- to be used in user account
		$query = "SELECT * FROM tbl_contract ORDER BY contractId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$yearStarted = explode("-",$obj->contractStartDate);
					
				}//while
			}//if 
			
	
	// insert into tbl_user_account
		$userPass  = $_POST['name_searchClientName'];
		$userPass = str_pad($userPass, 5, '0', STR_PAD_LEFT);
				
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
							'$yearStarted[0]-CLN-$userPass',
							'$yearStarted[0]-CLN-$userPass',
							'',
							'1'
						)"
					);
	
	
		//session variable
		
	
?>


<?php
		$mainte = md5('maintenance');
		header("Location: ../user/admin/maintenance/clientContact.php?token=$mainte");
		exit;
?>