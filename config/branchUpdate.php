<?php
	include_once ('../config/connection.php');
	
	
	
				$querybranchID = mysql_real_escape_string ($_POST['nameUpdate_branchID']);
				$querybranchName = mysql_real_escape_string ($_POST['nameUpdateTo_branchName']);
				$querybranchStatus = mysql_real_escape_string ($_POST['nameUpdateTo_branchStatus']);
				$querybranchZip = mysql_real_escape_string ($_POST['nameUpdateTo_branchZip']);
				$querybranchStreet = mysql_real_escape_string ($_POST['nameUpdateTo_branchStreet']);
				$querybranchCity = mysql_real_escape_string ($_POST['nameUpdateTo_branchCity']);
				$querybranchProvince = mysql_real_escape_string ($_POST['nameUpdateTo_branchProvince']);
				$querybranchContactPerson = mysql_real_escape_string ($_POST['nameUpdateTo_branchContactPerson']);
				$querybranchContPosition = mysql_real_escape_string ($_POST['nameUpdateTo_branchContPosition']);
				$querybranchMobileNumber = mysql_real_escape_string ($_POST['nameUpdateTo_branchMobileNumber']);
				$querybranchLandline = mysql_real_escape_string ($_POST['nameUpdateTo_branchLandline']);
				$querybranchFax = mysql_real_escape_string ($_POST['nameUpdateTo_branchFax']);
				$querybranchEmailAddress = mysql_real_escape_string ($_POST['nameUpdateTo_branchEmailAddress']);
				$queryuserAccUsername = mysql_real_escape_string ($_POST['nameUpdateTo_userAccUsername']);
				$queryuserAccPassword = mysql_real_escape_string ($_POST['nameUpdateTo_userAccPassword']);
	
	
	$mysqli->query("UPDATE branch SET 
			
	
				branchName = '$querybranchName',
				branchStatus = '$querybranchStatus',
				branchZip = '$querybranchZip',
				branchLocation = '$querybranchStreet/$querybranchCity/$querybranchProvince',
				branchContactPerson = '$querybranchContactPerson',
				branchContPosition = '$querybranchContPosition',
				branchMobileNumber = '$querybranchMobileNumber',
				branchLandline = '$querybranchLandline',
				branchFax = '$querybranchFax',
				branchEmailAddress = '$querybranchEmailAddress'
	
	WHERE branchID = '".$querybranchID."'");
	
	$mysqli->query("UPDATE useraccount SET 
			
				userAccUsername = '".$queryuserAccUsername."',
				userAccPassword = '".$queryuserAccPassword."'
	
	WHERE branchID = '".$querybranchID."'");

?>

<script type="text/javascript">
		window.alert('1 Record Added');
</script>

<?php
		header("Location: ../user/admin/maintenanceBranchUpdate.php");
		exit;
?>