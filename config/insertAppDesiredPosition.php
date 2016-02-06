<?php
session_start();
include_once ('../config/connection.php');

	date_default_timezone_set("Asia/Manila");
	$date = date("Y/m/d");

	$ApplicantID = "";
	
	// upload change

			$target_dir = "uploadFile/";
		    $target_file = $target_dir . basename($_FILES["uploadResume"]["name"]);
		 
		    $newfilename = $_SESSION['ses_basicID'];

		    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		    move_uploaded_file($_FILES["uploadResume"]["tmp_name"], "../uploadFile/" . $newfilename . "." . $imageFileType);


			$filename =  $target_dir . "" . $newfilename . "." . $imageFileType;
	// end upload
	
	$mysqli->query("INSERT INTO tbl_applicant
					(
						basicId,
						applicantDate,
						applicantStatus
					)
					VALUES 
					(
						'$_SESSION[ses_basicID]',
						'$date',
						'Active'
					)"
				);
	
	
		//getting the ApplicantID
		$query = "SELECT * FROM tbl_applicant ORDER BY applicantId DESC LIMIT 1 ";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$ApplicantID = $obj->applicantId;
				}//while
			}//if 
	
		
		$mysqli->query("INSERT INTO tbl_desired_position SET 
				applicantId = '$ApplicantID',
				positionJobName = '$_POST[name_appChosenPositionFirst]',
				positionRank = 'First'
			"); 
		
		$mysqli->query("INSERT INTO tbl_desired_position SET 
				applicantId = '$ApplicantID',
				positionJobName = '$_POST[name_appChosenPositionSecond]',
				positionRank = 'Second'
			");
			
		$mysqli->query("INSERT INTO tbl_desired_position SET 
				applicantId = '$ApplicantID',
				positionJobName = '$_POST[name_appChosenPositionThird]',
				positionRank = 'Third'
			");
		
		$mysqli->query("UPDATE tbl_applicant SET 
				resume = '$filename' Where
				applicantId = '$ApplicantID'
			");
			
		//expected salary
		$salaryExpected = rtrim(ltrim(preg_replace("/[^0-9.]/", "", $_POST['name_appQualityExpectedSalary'])));
		
		$mysqli->query("INSERT INTO tbl_personal_info SET 
						basicId = '$_SESSION[ses_basicID]',
						personalQualityDesc ='$salaryExpected', 
						personalQualityType = 'Expected Salary'
						");
		$_SESSION['first'] = $_POST['name_appChosenPositionFirst'];
		$_SESSION['second'] = $_POST['name_appChosenPositionSecond'];
		$_SESSION['third'] = $_POST['name_appChosenPositionThird'];
		$_SESSION['date'] = $date;
		$_SESSION['appID'] = $ApplicantID; 
		
$apply = md5('apply');
//header("location: ../user/guest/apply/applyDone.php?AppID=$ApplicantID&&firstjob=$first&&secondjob=$second&&thirdjob=$third&&token=$apply");
header("location: ../user/guest/apply/applyDone.php?token=$apply");

exit();
?>