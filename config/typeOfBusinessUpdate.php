<?php
	//connection
		include_once ('../config/connection.php');
		session_start();
		
		
		//update tbl client
		$mysqli->query("UPDATE tbl_type_of_business SET 
					typeOfBusinessName= '$_POST[typeOfBusinessName]',
					typeOfBusinessDescription =  '$_POST[businessDescription]'
					
				
				WHERE typeOfBusinessId  = '$_POST[name_typeID]'");	
				echo"desc: $_POST[businessDescription] id: $_POST[name_typeID]";
?>
<?php
		$main = md5('maintenance');
		header("Location: ../user/admin/maintenance/typeOfBusinessUpdateDone.php?token=$main");
		exit;
?>