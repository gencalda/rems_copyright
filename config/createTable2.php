<?php
	//connection
	require_once 'connection.php';
	$connection = mysql_connect("$db_hostname","$db_username","$db_password", "$db_database");
	if (!$connection)
	{
		die ("No connection Established error at: " .mysql_error());
	}
	
	
	//create table
	mysql_select_db($db_database,$connection);
	
	
	

	$appPairingResults = "CREATE TABLE appPairingResults
(
appPairingID int (6) AUTO_INCREMENT NOT NULL,
applicantID int (6) not null,
jobPostingID int (6) not null,
appPairingScore varchar(30) not null,
appPairingPercentage varchar(20) not null, 
PRIMARY KEY (appPairingID),
FOREIGN KEY (applicantID) REFERENCES appInformation (applicantID),
FOREIGN KEY (jobPostingID) REFERENCES jobPosting(jobPostingID) 
)";
mysql_query($appPairingResults,$connection);





	
	mysql_close($connection);
?>