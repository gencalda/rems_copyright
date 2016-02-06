<?php
	session_start();
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/config/connection.php');
	//include('clientNav.php');

			if(empty($_POST['report'])||empty($_POST['employee']))
			{
				$_SESSION['stat']="<script language='javascript'>
				alert('Sending Failed: Make sure to fill out all fields')
				 </script>";
				header("Location: sendEmpRep.php?token=f4d5b76a2418eba4baeabc1ed9142b54");
				//header("Location: sendEmpRep.php?token=$tran;");
			}
			else
			{
				$CID=$_SESSION['login_userId'];
				$connection = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$connection)
				{
					die ("No connection Established error at: " .mysql_error());
				}
				mysql_select_db($db_database,$connection);
				
				$sql = "INSERT INTO tbl_emp_reports
						(
							reportDesc,
							employeeId,
							reportDate,
							clientId,
							reportStat
						)
						VALUES 
						(
							'$_POST[report]',
							'$_POST[employee]',
							now(),
							$CID,
							'to be examined'
							
						)";
						
				$mysqli->query("INSERT INTO tbl_notification
					(
						notifId,
						clientId,
						employeeId,
						notifDesc, 
						dateCreated,
						notifStatus,
						notifUser
					)
					VALUES 
					(
						'',
						'$CID',
						'$_POST[employee]',
						'reported',
						now(),
						'bagongNotif',
						'admin'
					)"
				);
						
				if(!mysql_query($sql,$connection))
				{
					die("Error: " .mysql_error());
				}

				mysql_close($connection);
		
			   $_SESSION['stat']="<script language='javascript'>
				alert('Your report was submitted to the agency')
				 </script>";
				
				//$tran=md5('transactions');
				header("Location: sendEmpRep.php?token=f4d5b76a2418eba4baeabc1ed9142b54");
				
				//$mainte = md5('maintenance');
				//header("Location: ../user/admin/maintenance/clientContact.php?token=$mainte");
				exit;

			}
?>