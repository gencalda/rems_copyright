<?php

$root = realpath(dirname(__FILE__) . '/../../..');
	
	include($root . '/config/connection.php');

$connection = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$connection)
				{
					die ("No connection Established error at: " .mysql_error());
				}
				mysql_select_db($db_database,$connection);
				
$tran = md5('transaction');

	if($_GET['des']=='y')
	{
		$mysqli->query("UPDATE tbl_contract SET 
			
				contractStatus =  'terminated'
			
			WHERE employeeId = '$_GET[ID]'");
		
		$mysqli->query("UPDATE tbl_emp_reports SET 
			
				adminDes =  'terminate contract',
				reportStat= 'examined'
			
			WHERE employeeId = '$_GET[ID]' 
			AND reportId = '$_GET[repID]'");
			header("Location: checkReports.php?token=$tran"); 
	}
	else if($_GET['des']=='n')
	{
		$mysqli->query("UPDATE tbl_emp_reports SET 
			
				adminDes =  'void report',
				reportStat= 'examined'
			
			WHERE employeeId = '$_GET[ID]'
			AND reportId = '$_GET[repID]'");
			header("Location: checkReports.php?token=$tran"); 
	}
?>