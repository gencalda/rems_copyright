<?php
include_once ('connection.php');
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
				$target_dir = "uploadImage/";
				$target_file = $target_dir . basename($_FILES["name_settingBanner"]["name"]);
				//echo $fileName = basename($_FILES["p1"]["&name"]);
				$newfilename = 'remsBanner';
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["name_settingBanner"]["tmp_name"], "../uploadImage/" . $newfilename . "." . $imageFileType);


				$uploadOk = 1;

				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) 
				{
					$check = getimagesize($_FILES["name_settingBanner"]["tmp_name"]);
					if($check !== false) 
					{
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;

					} else {
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) 
				{
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["name_settingBanner"]["size"] > 5000) 
				{
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
				{
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error

				if ($uploadOk == 0) 
				{
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} 
				else 
				{
					if (move_uploaded_file($_FILES["name_settingBanner"]["tmp_name"], $target_file)) 
					{
						echo "The file ". basename( $_FILES["name_settingBanner"]["name"]). " has been uploaded.";
					} else 
					{
						echo "Sorry, there was an error uploading your file.";
					}
				}

				$mysqli->query("UPDATE tbl_picture 
								SET filename = '$target_dir' "." '$newfilename' "." '.' "."'$imageFileType'
								WHERE picId = '1'
							");
				

		////////////////// end of banner insert
		
		////////////////////////// For Background
		
				$target_dir = "uploadImage/";
				$target_file = $target_dir . basename($_FILES["name_settingBackground"]["name"]);
				//echo $fileName = basename($_FILES["p1"]["&name"]);
				$newfilename = 'name_settingBackground';

				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["name_settingBackground"]["tmp_name"], "../uploadImage/" . $newfilename . "." . $imageFileType);


				$uploadOk = 1;

				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) 
				{
					$check = getimagesize($_FILES["name_settingBackground"]["tmp_name"]);
					if($check !== false) 
					{
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;

					}
					else {
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file)) 
				{
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["name_settingBackground"]["size"] > 5000) 
				{
					echo "Sorry, your file is too large.";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
				{
					echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error

				if ($uploadOk == 0) 
				{
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else 
				{
					if (move_uploaded_file($_FILES["name_settingBackground"]["tmp_name"], $target_file)) 
					{
						echo "The file ". basename( $_FILES["name_settingBackground"]["name"]). " has been uploaded.";
					} else 
					{
						echo "Sorry, there was an error uploading your file.";
					}
				}

				$mysqli->query("UPDATE tbl_picture 
								SET filename = '$target_dir' "." '$newfilename' "." '.' "."'$imageFileType'
								WHERE picId = '2'
							");
				
		////////////////// end of background
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
	
		mysql_select_db("$db_database", $con);
		$mysqli->query("UPDATE `tbl_picture` SET picDesc='$_POST[bannerDesc]' WHERE picId = 1");
		$mysqli->close();
		$util = md5('utilities');
		//header("Location: ../user/admin/utilities/settings.php?token=$util");
		exit;
?>	