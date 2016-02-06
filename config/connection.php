<?php
	// connection for REMS
	
	$db_hostname = 'localhost';
		// web server hostname
	$db_database = 'remsdb';
		// database used 
	$db_username = 'root';
		// phpmyadmin username
	$db_password = '';
		// phpmyadmin password
	
	$mysqli = new mysqli($db_hostname, $db_username, $db_password,$db_database);
	$con = mysql_connect("$db_hostname","$db_username","$db_password","$db_database");
	

?>