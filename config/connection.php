<?php
	// connection for REMS
	
	$db_hostname = '192.168.22.20';
		// web server hostname
	$db_database = 'remsdb';
		// database used 
	$db_username = 'groot';
		// phpmyadmin username
	$db_password = '';
		// phpmyadmin password
	
	$mysqli = new mysqli($db_hostname, $db_username, $db_password,$db_database);
	$con = mysql_connect("$db_hostname","$db_username","$db_password","$db_database");
	

?>