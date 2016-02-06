<?php
	include_once ('../config/connection.php');

		//connection
	//////////////////////////////////////////////////////////
	//
	//	This is not working :)
	//
	//  mysql_real_escape_string($_POST['']);
	//
	//
	//
	//
	//
	//	
	//////////////////////////////////////////////////////////
	
	//$positionNumber = $_POST['randomPosition'];
	//$dateString = "".$_POST['month']."/".$_POST['day']."/".$_POST['year']."";

	//$dateToFormat = date_create($dateString);
	//$dateFormatted_bday = date_format($dateToFormat,'Y/m/d');

	//$interval = $dateToFormat->diff(new DateTime); //calculates the difference between two DateTime objects 
	//$ageObj = $interval->y;
	//$age = strval($ageObj);



	$mysqli->query("INSERT INTO tbl_basic_info
					(
						basicId,
						clientId,
						basicDate,
						basicPicture,
						basicLastName,
						basicFirstName,
						basicMiddleName,
						basicExtName,
						basicEmail,
						basicStatus,
						basicCode,
						currentPosition
					)
					VALUES 
					(
						'id',
						'Null kasi di naman sya personnel',
						'date kung kelan pinasok sa db',
						'null',
						'last name',
						'fist name',
						'middle name',
						'ext name',
						'email',
						'1',
						'APP',
						'NUll kasi di pa sya employee'

					)"
				);


	$mysqli->query("INSERT INTO tbl_contact_info
					(
						contactInfoId,
						clientId,
						basicId,
						contactDevice,
						contactNumber
					)
					VALUES 
					(
						'id',
						'Null kasi di naman sya personnel',
						'date kung kelan pinasok sa db',
						'null',
						'last name'

					)"
				);


	mysql_close($connection);
?>

<?php

header("location: ../user/guest/apply/personalInformation.php?tab=apply");


?>