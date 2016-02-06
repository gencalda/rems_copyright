<?php
session_start();
include_once ('../config/connection.php');



			
$query = "SELECT * FROM appInformation ORDER BY applicantID DESC LIMIT 1";
		
	if ($result = $mysqli->query($query))
	{
		
		while ($obj=$result->fetch_object())
		{
		
		
		
		$mysqli->query("INSERT INTO appChosenPosition SET 
				applicantID = '$obj->applicantID',
				jobPostingTitle = '$_POST[name_appChosenPositionFirst]',
				appChosenPositionRank = 'first'
			"); 
		
		$mysqli->query("INSERT INTO appChosenPosition SET 
				applicantID = '$obj->applicantID',
				jobPostingTitle = '$_POST[name_appChosenPositionSecond]',
				appChosenPositionRank = 'second'
			");
			
		$mysqli->query("INSERT INTO appChosenPosition SET 
				applicantID = '$obj->applicantID',
				jobPostingTitle = '$_POST[name_appChosenPositionThird]',
				appChosenPositionRank = 'third'
			");
			
		//expected salary
		$salaryExpectedFrom = rtrim(ltrim(preg_replace("/[^0-9.]/", "", $_POST['name_appQualityExpectedSalaryFrom'])));
		$salaryExpectedTo = rtrim(ltrim(preg_replace("/[^0-9.]/", "", $_POST['name_appQualityExpectedSalaryUpTo'])));
		
		$mysqli->query("INSERT INTO appQualities SET 
						applicantID = '$obj->applicantID',
						appQualityDesc ='$salaryExpectedFrom', 
						appQualityType = 'expected salary from'
						");
		
		$mysqli->query("INSERT INTO appQualities SET 
						applicantID = '$obj->applicantID',
						appQualityDesc = '$salaryExpectedTo', 
						appQualityType= 'expected salary to'
						");
		
		
		
		
		 echo "<h3> PHP List All Session Variables</h3>";
   foreach ($_SESSION as $key=>$val)
    echo $key." ".$val."<br/>";
		/*   ----------------------------------     */
		
		}//while
	}//if
 


header("location: ../user/guest/apply/applyDone.php?tab=apply");
?>