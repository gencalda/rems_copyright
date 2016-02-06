<?php

//connection

	include_once ('../config/connection.php');
	session_start();
	
	$add_basicLastNameArr = array();
	$add_basicFirstNameArr = array();
	$add_basicMiddleNameArr = array();
	$add_basicExtNameArr = array();
	$add_basicPositionArr = array();
	$add_basicEmailArr = array();
	


	//insert contact person into tbl basic info 
	if((isset($_POST["name_basicFirstName"])) && (isset($_POST["name_basicEmail"])))
	{
		
		
		$ctr = 0;
		foreach($_POST["name_basicLastName"] as $key => $text_field){
			$add_basicLastNameArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_basicFirstName"] as $key => $text_field){
			$add_basicFirstNameArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_basicMiddleName"] as $key => $text_field){
			$add_basicMiddleNameArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_basicExtName"] as $key => $text_field){
			$add_basicExtNameArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_basicPosition"] as $key => $text_field){
			$add_basicPositionArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_basicEmail"] as $key => $text_field){
			$add_basicEmailArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		
		$ctr = 0;
			while ((isset($add_basicFirstNameArr[$ctr])) && ($add_basicFirstNameArr[$ctr]!=" "))
			{
						
				$mysqli->query("INSERT INTO tbl_basic_info
						(
								clientId,
								basicLastName,
								basicFirstName,
								basicMiddleName,
								basicExtName,
								basicEmail,
								basicPosition
						)
						VALUES 
						(
							'$_SESSION[ses_clientId_forContactAdd]',
							'$add_basicLastNameArr[$ctr]',
							'$add_basicFirstNameArr[$ctr]',
							'$add_basicMiddleNameArr[$ctr]',
							'$add_basicExtNameArr[$ctr]',
							'$add_basicEmailArr[$ctr]',
							'$add_basicPositionArr[$ctr]'
						)"
					);
					
				$mysqli->query("INSERT INTO tbl_notification
						(
							notifId,
							clientId, 
							notifDesc, 
							dateCreated,
							notifStatus,
							notifUser
						)
						VALUES 
						(
							'',
							'$_SESSION[ses_clientId_forContactAdd]',
							'registered as a client.',
							now(),
							'bagongNotif',
							'admin'
						)"
					);
					
				$ctr++;
			}//while
	}//if set textbox
	
?>

<?php
		$reg = md5('register');
		header("Location: ../user/guest/registerDone.php?token=$reg");
		exit;
?>