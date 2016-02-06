<?php
	//connection
	include_once ('../config/connection.php');
	
	
	$type=mysql_real_escape_string($_POST['typeOfBusiness']);
	$description=mysql_real_escape_string($_POST['typeOfBusinessDesc']);

				
	$mysqli->query("INSERT INTO tbl_type_of_business
					(
						typeOfBusinessId,
						typeOfBusinessName,
						typeOfBusinessStatus,
						typeOfBusinessDescription
					)
					VALUES 
					(
						'',
						'$type',
						'1',
						'$description'
					)"
				);
				
?>


<?php
		$main = md5('maintenance');
		header("Location: ../user/admin/maintenance/typeOfBusinessAddDone.php?token=$main&add=success");
		exit;
		
?>