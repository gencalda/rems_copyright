<?php
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php');
	$email=$_POST['email'];
	$examID=$_POST['examID'];

			$con = mysql_connect("$db_hostname","$db_username","$db_password");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
				
			mysql_select_db("$db_database", $con);

$result = mysql_query("SELECT applicantId FROM tbl_basic_info a, tbl_applicant b WHERE a.basicEmail = '$email' AND a.basicId = b.basicId ");
while ($row = mysql_fetch_array($result))
{
	$applicant=$row['applicantId'];
}

				$score=0;
				$totalquest=0;
				$result3 = mysql_query("SELECT * FROM tbl_question WHERE examId = $examID");
				while ($row3 = mysql_fetch_array($result3))
				{
					$row3['questionDesc']; 
					$qid=$row3['questionId'];
					$result4 = mysql_query("SELECT * FROM tbl_choice WHERE questionId = $qid");
					while ($row4 = mysql_fetch_array($result4))
					{
						
						
						$answer= $_POST[$row4['questionId']];
						

					}
					
					$insert_row = $mysqli->query("INSERT INTO tbl_applicant_exam_answers
						(
							questionId,
							choiceId,
							applicantId,
							applicantExamDateTaken
						)
						VALUES 
						(
							'$qid',
							'$answer',
							'$applicant',
							now()
							
						)"
					);
					
					$result2 = mysql_query("SELECT * FROM tbl_answerkey WHERE questionId = $qid");
					while ($row2 = mysql_fetch_array($result2))
					{
						$answerkey=$row2['choiceId'];
					}
					$totalquest++;
					if($answer==$answerkey)
						{
							$score++;
						}
						
					
					echo"</br>";
				}
				
				$result5 = mysql_query("SELECT examPassingGrade FROM tbl_exam WHERE examId =  $examID");
				while ($row5 = mysql_fetch_array($result5))
				{
					$passing=$row5['examPassingGrade'];
				}
				$percentscore=($score/$totalquest)*100;
				
				if($percentscore>$passing)
				{
					$examstat = "Passed";
				}
				else if($percentscore=$passing)
				{
					$examstat = "Passed";
				}
				else
				{
					$examstat = "Failed";
				}
				
					$mysqli->query("INSERT INTO tbl_applicant_exam
						(
							applicantId,
							examId,
							applicantExamDateTaken,
							applicantExamScore,
							examStatus
						)
						VALUES 
						(
							'$applicant',
							'$examID',
							now(),
							'$score',
							'$examstat'							
						)"
				);
				
?>

		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
				<br />
				<div class="alert alert-success col-md-6 col-md-offset-3">
					<center>
						<h3>
							Congratulations! Your examination was recorded.
						</h3>
						Please <a href="index.php">click here</a> to go back.
					</center>
				</div>
			</div>
		</div>

<?php
	include ('footer.php');
?>