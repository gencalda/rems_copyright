<?php
	include_once ('../config/connection.php');
	session_start();

	$block = mysql_escape_string(strtolower($_POST['name_addBlock']));
	$street = mysql_escape_string(strtolower($_POST['name_addStreet']));
	$subdi = mysql_escape_string(strtolower($_POST['name_addSubdivision']));
	$barangay = mysql_escape_string(strtolower($_POST['name_addBrgy']));
	$district = mysql_escape_string(strtolower($_POST['name_addDistrict']));
	$city = mysql_escape_string(strtolower($_POST['name_addCity']));
	$province = mysql_escape_string(strtolower($_POST['name_addProvince']));
	$country = mysql_escape_string(strtolower($_POST['name_addCountry']));
	$zip = mysql_escape_string(strtolower($_POST['name_addZipCode']));

	$mysqli->query("INSERT INTO tbl_address
					(
						basicId, 
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
						'$_SESSION[ses_basicID]',
						'$block',
						'$street',
						'$subdi',
						'$barangay',
						'$district',
						'$city',
						'$province',
						'$country',
						'$zip'
					)"
				);


	//mysql_close($connection, );
?>

<?php
$apply = md5('apply');
header("location: ../user/guest/apply/familyBackground.php?token=$apply");

?>