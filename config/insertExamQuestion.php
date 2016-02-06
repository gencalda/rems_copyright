<?php
	//connection

	include_once ('../config/connection.php');
	session_start();

	
	$jobPostingId = "1";
	$otherSubject = "";
	$otherSubject2 = "";
	$subjectID = "";
	$subjectName = "";
	$randomForExamCode = "";
	$examId = "";
	
	
	$questionId = "";
	$questionChoices  = array();
	$questionAnswer  = array();
	
	//subject
	if (isset($_POST['submitAddQuestion']))
	{	
		
		$mysqli->query("INSERT INTO tbl_question
						(
							examId,
							questionDesc
						)
						VALUES 
						(
							'$_SESSION[ses_examID]',
							'$_POST[name_Question]'
						)"
					);
		
		
		$query = "SELECT * FROM tbl_question ORDER BY questionId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$questionId = $obj->questionId;
				}//while
			}//if 

		if(isset($_POST["name_Choices"]))
		{
		
			$ctr = 0;
			foreach($_POST["name_Choices"] as $key => $text_field){
			$questionChoices[$ctr] .= $text_field;
			$ctr++;
			}//foreach
			
			$ctr = 0;
			while ((isset($questionChoices[$ctr])) && ($questionChoices[$ctr]!=" "))
			{
			
				$mysqli->query("INSERT INTO tbl_choice
						(
							questionId,
							choiceDescription
						)
						VALUES 
						(
							'$questionId',
							'$questionChoices[$ctr]'
						)"
					);
				
				$ctr++;
			}//while
		}//if
	
		$_SESSION['ses_questionCtr'] = $_SESSION['ses_questionCtr'] + 1;
		
		$main = md5('maintenance');
		header("Location: ../user/admin/maintenance/createExamQuestion.php?token=$main");
		exit;
	
	}//if add another question

	
	else if (isset($_POST['submitExamDone']))
	{
	$mysqli->query("INSERT INTO tbl_question
						(
							examId,
							questionDesc
						)
						VALUES 
						(
							'$_SESSION[ses_examID]',
							'$_POST[name_Question]'
						)"
					);
		
		
		$query = "SELECT * FROM tbl_question ORDER BY questionId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$questionId = $obj->questionId;
				}//while
			}//if 

		if(isset($_POST["name_Choices"]))
		{
		
			$ctr = 0;
			foreach($_POST["name_Choices"] as $key => $text_field){
			$questionChoices[$ctr] .= $text_field;
			$ctr++;
			}//foreach
			
			$ctr = 0;
			while ((isset($questionChoices[$ctr])) && ($questionChoices[$ctr]!=" "))
			{
			
				$mysqli->query("INSERT INTO tbl_choice
						(
							questionId,
							choiceDescription
						)
						VALUES 
						(
							'$questionId',
							'$questionChoices[$ctr]'
						)"
					);
				
				$ctr++;
			}//while
		}//if
	
		$main = md5('maintenance');
		header("Location: ../user/admin/maintenance/createExamAnswerKeys.php?token=$main");
		exit;
	}//if drop down
	

?>


<?php
		
?>