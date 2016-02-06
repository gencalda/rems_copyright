<?php
	session_start();
	//connection
		include_once ('../config/connection.php');
	
	
	$updateClientName = mysql_real_escape_string ($_POST['clientName']);
	$updateBlock = mysql_real_escape_string ($_POST['name_addBlock']);
	$updateStreet = mysql_real_escape_string ($_POST['name_addStreet']);
	$updateSubd = mysql_real_escape_string ($_POST['name_addSubdivision']);
	$updateBrgy = mysql_real_escape_string ($_POST['name_addBrgy']);
	$updateDist = mysql_real_escape_string ($_POST['name_addDistict']);
	$updateCity = mysql_real_escape_string ($_POST['name_addCity']);
	$updateProvince = mysql_real_escape_string ($_POST['name_addProvince']);
	$updateCountry = mysql_real_escape_string ($_POST['name_addCountry']);
	$updateZip = mysql_real_escape_string ($_POST['name_addZipCode']);
	$updateDevice = mysql_real_escape_string ($_POST['name_device']);
	$updateNumber = mysql_real_escape_string ($_POST['name_contactNumber']);
	$updateEmail = mysql_real_escape_string ($_POST['name_clientEmail']);
	
	/*$var_end_contract_to_format=date_create($_POST['name_clientUpdateclientEndContract']);
	$var_end_contract_formatted=date_format($var_end_contract_to_format,'Y/m/d');*/
	
	$ID=$_SESSION['login_userId'];
	
	$mysqli->query("UPDATE tbl_client a, tbl_address b, tbl_contact_info c, tbl_type_of_business d SET 
					a.clientName = '$updateClientName',
					b.addBlock = '$updateBlock',
					b.addStreet = '$updateStreet',
					b.addSubdivision = '$updateSubd',
					b.addBarangay = '$updateBrgy',
					b.addDistrict = '$updateDist',
					b.addCity = '$updateCity',
					b.addProvince = '$updateProvince',
					b.addCountry = '$updateCountry',
					b.addZip = '$updateZip',
					c.contactDevice = '$updateDevice',
					c.contactNumber = '$updateNumber',
					a.clientEmail = '$updateEmail'
					WHERE a.typeOfBusinessId = d. typeOfBusinessId AND a.clientId = $ID AND b.clientId = $ID AND c.clientId = $ID AND a.clientId = b.clientId AND a.clientId = c.clientId AND c.clientId = b.clientId");
?>

<script type="text/javascript">
		window.alert('Record Updated');
</script>
<?php
		$main = md5('maintenance');
		header("Location: ../user/client/maintenance/updateClient.php?token=$main");
		exit;
?>