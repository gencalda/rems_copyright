<?php
		session_start();
		require_once 'connection.php';
		$attempt = $_POST['attempt'];
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
		if (!$con) 
		{
			die('Could not connect: ' . mysql_error()); 
		}
		mysql_select_db($db_database,$con);	
		
		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);
		
		$role = '';
		$infoId = '';
		$clientId = '';
		$fname = '';
		$lname = '';
		$clientName = '';
		
		$result = mysql_query("SELECT * 
								FROM  tbl_user_account  
								WHERE accountUsername = '$username'
								AND accountPassword = '$password'
							");
									
		while($row = mysql_fetch_array($result)) 
		{
				$role = $row['accountRole'];
				$infoId = $row['basicId'];
				$clientId = $row['clientId'];
				$accountId = $row['accountId'];
		}//while
		
		$rows = mysql_num_rows($result);
		
		// --------------- if valid username and password -------------------
		if ($rows == 1) 
		{
		
			$index = md5('index');
		
			if ($role=='admin')
			{
				$resultInfo = mysql_query("SELECT * 
									FROM  tbl_basic_info  
									WHERE basicId = '$infoId'
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$fname = $rowInfo['basicFirstName'];
						$lname = $rowInfo['basicLastName'];
				}//while
			
				
				$_SESSION['login_user'] = $fname." ".$lname; // username displayed
				$_SESSION['role'] = $role;					//role
				$_SESSION['login_userId'] = $infoId;		//basicId ng user
				$_SESSION['login_accountId'] = $accountId;		//accountId ng user
				
				header('Location: ../user/admin/index.php?token='.$index.'');
				
			}//if admin
			else if ($role=='client')
			{
			
				$resultInfo = mysql_query("SELECT * 
									FROM  tbl_client
									WHERE clientId = '$clientId'
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$clientName = $rowInfo['clientName'];
				}//while
				
				$_SESSION['login_user'] = $clientName; // username displayed
				$_SESSION['role'] = $role;					//role
				$_SESSION['login_userId'] = $clientId;		//clientId ng user
				$_SESSION['login_accountId'] = $accountId;		//accountId ng user
			
			header('location:../user/client/index.php?token='.$index.'');
			
			}//if client
			
			
			else if ($role=='hrd')
			{

				$resultInfo = mysql_query("SELECT * 
					FROM  tbl_client
					WHERE clientId = '$clientId'
				");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$clientName = $rowInfo['clientName'];
				}//while
				
				$_SESSION['login_user'] = $clientName; // username displayed
				$_SESSION['role'] = $role;					//role
				$_SESSION['login_userId'] = $clientId;		//clientId ng user
				$_SESSION['login_accountId'] = $accountId;		//accountId ng user
			
			header('location:../user/hrd/index.php?token='.$index.'');

					
			}


			
			/*  	----- before ----
			$_SESSION['fname'] = $fname;
			$_SESSION['mname'] = $mname;
			$_SESSION['lname'] = $lname;
			*/
			
	
		}//if rows = 1
		// ----------------------------------------------------------------
		
		else 
		{
			$error = md5('error');
			$home = md5('home');
			echo"<h4 class='text-center'>Username or Password is invalid</h4>";
			header('location:../user/guest/logIn.php?action='.$error.'&attempt='.$attempt.'&token='.$home.'');
		}
		
		
		
	
?>