<?php
	include_once ('../config/connection.php');
	session_start();

	$date_to_format="";
	$date_formatted="";
	$contactDeviceArr = array();
	$contactNumber = array();
	

	$lastName = (mysql_real_escape_string($_POST['name_basicLastName']));
	$firstName = (mysql_real_escape_string($_POST['name_basicFirstName']));
	$middleName = (mysql_real_escape_string($_POST['name_basicMiddleName']));
	$extName = (mysql_real_escape_string($_POST['name_basicExtName']));
	$email = (mysql_real_escape_string($_POST['name_basicEmail']));
	


	// upload change

			$target_dir = "uploadImage/";
		    $target_file = $target_dir . basename($_FILES["name_basicPicture"]["name"]);
		 
		    $newfilename = $email;

		    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		    move_uploaded_file($_FILES["name_basicPicture"]["tmp_name"], "../uploadImage/" . $newfilename . "." . $imageFileType);


			$filename =  $target_dir . "" . $newfilename . "." . $imageFileType;
	// end upload

	
	$mysqli->query("INSERT INTO tbl_basic_info
					(
						basicPicture,
						basicLastName,
						basicFirstName,
						basicMiddleName,
						basicExtName,
						basicEmail
					)
					VALUES 
					(
						'$filename', 
						'$lastName',
						'$firstName',
						'$middleName',
						'$extName',
						'$email'
					)"
				);
	
		
		//getting the BasicID
		$query = "SELECT * FROM tbl_basic_info WHERE clientId IS NULL ORDER BY basicId DESC LIMIT 1 ";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$basicID = $obj->basicId;
				}//while
			}//if 
	
	
	
	
		//setting session variable for basicID
		$_SESSION["ses_basicID"] = $basicID;
		
				
				
				
				
				
	//insert into tbl_contact_info
	if((isset($_POST["name_basic_contactDevice"])) && (isset($_POST["name_basic_contactNumber"])))
	{
		$ctr = 0;
		foreach($_POST["name_basic_contactDevice"] as $key => $text_field){
			$contactDeviceArr[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
		foreach($_POST["name_basic_contactNumber"] as $key => $text_field){
			$contactNumber[$ctr] .= $text_field;
			$ctr++;
		}
		
		$ctr = 0;
			while ((isset($contactDeviceArr[$ctr])) && ($contactDeviceArr[$ctr]!=" "))
			{
							
				$mysqli->query("INSERT INTO tbl_contact_info
						(
							basicId,
							contactDevice,
							contactNumber
						)
						VALUES 
						(
							'$_SESSION[ses_basicID]',
							'$contactDeviceArr[$ctr]',
							'$contactNumber[$ctr]'
						)"
					);
				$ctr++;
			}//while
		
	}//if set textbox

	$_SESSION['Name'] = $lastName." ".$extName." ".$firstName." ".$middleName;
	mysql_close($con);
?>

<?php
	$apply = md5('apply');
	header("location: ../user/guest/apply/personalInformation.php?token=$apply");
?>