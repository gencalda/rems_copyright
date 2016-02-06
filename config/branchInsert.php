<?php
	//connection
	require_once ('../config/connection.php');
	$connection = mysql_connect("$db_hostname","$db_username","$db_password");
	if (!$connection)
	{
		die ("No connection Established error at: " .mysql_error());
	}
	mysql_select_db($db_database,$connection);
	
	$query = "SELECT * FROM client WHERE clientID = '".$_POST['nameAdd_clientID']."'";
	
	if ($result = $mysqli->query($query))
	{
		while ($obj=$result->fetch_object())
		{
		$yearStarted = explode("-",$obj->clientStartContract);
		}//while
	}//if
	
	$sql = "INSERT INTO branch
			(
				clientID,
				branchName,
				branchStatus,
				branchZip,
				branchLocation,
				branchContactPerson,
				branchContPosition,
				branchMobileNumber,
				branchLandline,
				branchFax,
				branchEmailAddress
			)
			VALUES 
			(
				'$_POST[nameAdd_clientID]',
				'$_POST[nameAdd_branchName]',
				'$_POST[nameAdd_branchStatus]',
				'$_POST[nameAdd_branchZip]',
				'$_POST[nameAdd_branchStreet]/$_POST[nameAdd_branchCity]/$_POST[nameAdd_branchProvince]',
				'$_POST[nameAdd_branchContactPerson]',
				'$_POST[nameAdd_branchContPosition]',
				'$_POST[nameAdd_branchMobileNumber]',
				'$_POST[nameAdd_branchLandline]',
				'$_POST[nameAdd_branchFax]',
				'$_POST[nameAdd_branchEmailAddress]'
			)";
			
	if(!mysql_query($sql,$connection))
	{
		die("Error: " .mysql_error());
	}

	mysql_close($connection);

	// user account
		$query = "SELECT * FROM branch ORDER BY branchID DESC LIMIT 1";
		
		if ($result = $mysqli->query($query))
		{
		
			while ($obj=$result->fetch_object())
			{
			
			$idOfBranch = $obj->branchID;
			
			$username = $idOfBranch;
			$username = str_pad($username, 5, '0', STR_PAD_LEFT);
			
			$mysqli->query("INSERT INTO userAccount
				(
					branchID,
					userAccRole,
					userAccUsername,
					userAccPassword
				)
				VALUES 
				(
					'$obj->branchID',
					'client',
					'$yearStarted[0]-CLN-$username',
					'$yearStarted[0]-CLN-$username'
				)");
			}//while
		}//if
	
?>

<script type="text/javascript">
		window.alert('1 Record Added');
</script>
<?php
		header("Location: ../user/admin/maintenanceBranchAdd.php");
		exit;
?>