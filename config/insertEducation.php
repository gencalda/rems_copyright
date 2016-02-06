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



	$mysqli->query("INSERT INTO tbl_insurance_info
					(
						educationId,
						basicId,
						schoolName,
						schoolLevel,
						schoolAddress
					)
					VALUES 
					(
						'id',
						'id',
						'date',
						'place'
					)"
				);


	


	mysql_close($connection);
?>

<?php

header("location: ../user/guest/apply/work.php?tab=apply");


?>