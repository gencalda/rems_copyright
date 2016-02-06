<?php
	//connection

	include_once ('../config/connection.php');
	session_start();

	
	$jobPostingId = $_SESSION["ses_jobId"];
	$otherSubject = "";
	$otherSubject2 = "";
	$subjectID = "";
	$subjectName = "";
	$randomForExamCode = "";
	$examId = "";
	
	//subject
	if (isset($_POST['name_subjectOthers']))
	{	
		$otherSubject = strtolower(rtrim(ltrim(mysql_real_escape_string($_POST['name_subjectOthers']))));	
		$otherSubject2 = ucfirst($otherSubject);
		
		//insert to tbl_subject - others
		$mysqli->query("INSERT INTO tbl_subject SET subjectName='$otherSubject2', subjectStatus=1");
		
		$query = "SELECT * FROM tbl_subject ORDER BY subjectId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$subjectID = $obj->subjectId;
					$subjectName = $obj->subjectName;
				}//while
			}//if 

		$randomForExamCode = substr(str_shuffle(str_repeat(strtoupper($subjectName), 5)), 0, 5);
			
			//insert into tbl_exam
		$mysqli->query("INSERT INTO tbl_exam
						(
							subjectId,
							jobPostingId,
							examTitle,
							examCode,
							examPassingGrade
						)
						VALUES 
						(
							'$subjectID',
							'$jobPostingId',
							'$_POST[name_examTitle]',
							'$randomForExamCode$subjectID$jobPostingId',
							'$_POST[name_examPassingGrade]'
						)"
					);
	}//if others
	
	else if (isset($_POST['name_searchSubject']))
	{
		$randomForExamCode = substr(str_shuffle(str_repeat(strtoupper('abcdefghijklmnopqrstuv'), 5)), 0, 5);
			
			//insert into tbl_exam
		$mysqli->query("INSERT INTO tbl_exam
						(
							subjectId,
							jobPostingId,
							examTitle,
							examCode,
							examPassingGrade
						)
						VALUES 
						(
							'$_POST[name_searchSubject]',
							'$jobPostingId',
							'$_POST[name_examTitle]',
							'$randomForExamCode$subjectID$jobPostingId',
							'$_POST[name_examPassingGrade]'
						)"
					);
	
	}//if drop down
	
	
	$query = "SELECT * FROM tbl_exam ORDER BY examId DESC LIMIT 1";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$examId = $obj->examId;
				}//while
			}//if 
			
	
	$_SESSION['ses_examID'] = $examId;	
	$_SESSION['ses_questionCtr'] = 1;
	
?>


<?php
		$main = md5('maintenance');
		header("Location: ../user/client/maintenance/clientCreateExamQuestion.php?token=$main");
		exit;
?>