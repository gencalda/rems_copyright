<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../clientContactDetailsModal.php');
	include('../adminNotifModal.php');
?>

<?php
	$Eid = $_GET['ID'];
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error()); 
	}
	mysql_select_db("$db_database", $con);
	
	$queryfirst = mysql_query("SELECT * FROM appinformation , endorsedapp WHERE endappID=$Eid and endorsedapp.applicantID= appinformation.applicantID");
	while($row = mysql_fetch_array($queryfirst)) 
	{	
		$Aid	= $row['applicantID']; 	
	}
	$querysec = mysql_query("SELECT * FROM endorsedapp, jobposting WHERE endappID=$Eid and jobposting.jobPostingID=endorsedapp.jobPostingID ");
	while($row = mysql_fetch_array($querysec)) 
	{	
		$jobID = $row['jobPostingID'];
		$jname	= $row['jobPostingTitle']; 	
	}
	$querythird = mysql_query("SELECT * FROM  jobposting, branch WHERE jobPostingID=$jobID and jobposting.branchID=branch.branchID ");
	while($row = mysql_fetch_array($querythird)) 
	{
		$bname	= $row['branchName']; 	
		$bID	= $row['branchID'];
	}

	$query="INSERT INTO empinfo  
			SELECT * FROM appinformation
			WHERE applicantID = '$Aid'
			";
	if(!mysql_query($query,$con))
	{
		die("Error: " .mysql_error());
	}
	$sql = "Insert into empjob
		(
			empID,branchID, jobPostingTitle
		)
		Values
		(
			'$Aid',
			'$bID',
			'$jname'
		)";
	if(!mysql_query($sql,$con))
	{
		die("Error: " .mysql_error());
	}
	$sql2 = "DELETE FROM endorsedapp
			WHERE applicantID='$Aid'";
	if(!mysql_query($sql2,$con))
	{
		die("Error: " .mysql_error());
	}
	/*$sql3 = "DELETE appinformation, appchosenposition FROM appinformation LEFT JOIN appchosenposition ON  appinformation.applicantID= appchosenposition.applicantID='$Aid' WHERE appinformation.applicantID='$Aid'";
	if(!mysql_query($sql3,$con))
	{
		die("Error: " .mysql_error());
	}*/
	
	mysql_close($con);
?>
<h1>DONE!</h1>
<?php
	include ('../footer.php');
?>