<?php
if(!session_id())session_start();
if(!isset($_GET['token']))
{
	$not = "../../";
}
else if($_GET['token'] == md5('index'))
{
	$not = "../../";
}
else
{
	$not = "../../../";
}

include(''.$not.'/config/connection.php');
$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);


$sql1 =  mysql_query("SELECT * FROM tbl_notification WHERE notifStatus = 'bagongNotif' AND notifUser = 'client' AND clientId = '$_SESSION[login_userId]]'");
$counter = mysql_num_rows($sql1);
?>
<?php echo $counter;?>
