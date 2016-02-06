<?php
	include_once ('connection.php');
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
	
			mysql_select_db("$db_database", $con);
			
			if(isset($_POST['submithome']))
			{
				$mysqli->query("UPDATE `tbl_content` SET content_Home='$_POST[home]' WHERE contentID = 1");
			}
			else if(isset($_POST['submitabout']))
			{
				$mysqli->query("UPDATE `tbl_content` SET content_About='$_POST[about]' WHERE contentID = 1");
			}
			else if(isset($_POST['submitnews']))
			{
				$mysqli->query("UPDATE `tbl_content` SET content_News='$_POST[news]' WHERE contentID = 1");
			}
			else if(isset($_POST['submitcontact']))
			{
				$mysqli->query("UPDATE `tbl_content` SET content_ContactUs='$_POST[contact]' WHERE contentID = 1");
			}
			
			else if(isset($_POST['submitagency']))
			{
				$mysqli->query("UPDATE `tbl_content` SET content_agencyName='$_POST[agencyName]' WHERE contentID = 1");
				$mysqli->query("UPDATE `tbl_content` SET content_agencyAddress='$_POST[agencyAddress]' WHERE contentID = 1");
				$mysqli->query("UPDATE `tbl_content` SET content_pdfagencyName='$_POST[pdfagencyName]' WHERE contentID = 1");
			}
			
			

			
				
/*			$sql = ("UPDATE tbl_content
					SET content_Home = '$_POST[home]', content_About = '$_POST[about]', content_News = '$_POST[news]', content_ContactUs = '$_POST[contact]'
					WHERE contentID = 1");

				if ($mysqli->query($sql) === TRUE) 
				{
					echo "New record created successfully";
					
					
				}
				else 
				{
					echo "Error: " . $sql . "<br>" . $mysqli->error;
				}
				*/
		$mysqli->close();
		$util = md5('utilities');
		header("Location: ../user/admin/utilities/settings.php?token=$util");
		exit;
?>	