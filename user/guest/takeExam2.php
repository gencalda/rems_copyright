<?php
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php'); // native to admin
	//include('../adminNotifModal.php');
?>

<?php 
			
			$checkCode="not matched";
			$checkEmail="not matched";
			$examName = "";
			$con = mysql_connect("$db_hostname","$db_username","$db_password");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
				
			mysql_select_db("$db_database", $con);
			$result = mysql_query("SELECT * FROM tbl_basic_info");
			while ($row = mysql_fetch_array($result))
			{
				if($_POST['emailExaminee']==$row['basicEmail'])
				{
					$checkEmail="matched";
					$bID=$row['basicId'];
				}
			}
			
			$result2 = mysql_query("SELECT * FROM tbl_exam ");
			while ($row2 = mysql_fetch_array($result2))
			{
				if($row2['examCode']==$_POST['examCode'])
				{
					$checkCode= "matched";
					$examID=$row2['examId'];
					$examName=$row2['examTitle'];
				}
			}
		
?>
	

		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
				<h3><?php echo $examName;?> </h3>
				<br /><br />
<?php
			if($checkEmail=="matched"&&$checkCode=="matched")
			{		
					$home = md5('home');
					echo"<form method='POST' action='insertExamAnswers.php?token=$home'>";
					$result3 = mysql_query("SELECT * FROM tbl_question WHERE examId = $examID");
					while ($row3 = mysql_fetch_array($result3))
					{
						 echo $row3['questionDesc']; echo"</br>";
						$qid=$row3['questionId'];
						$result4 = mysql_query("SELECT * FROM tbl_choice WHERE questionId = $qid");
						while ($row4 = mysql_fetch_array($result4))
						{
							/*
							echo"</br><input type='radio' 
							name=".$row4['questionId']."
							value=".$row4['choiceId']." 
							id='name_appQualityGender' />".$row4['choiceDescription']."
							*/
							echo
							"
								<table class='table'>
									<tr>
										<td>
											<input type='radio' 
													name=".$row4['questionId']."
													value=".$row4['choiceId']." 
													id='name_appQualityGender' />".$row4['choiceDescription']."
										</td>
									</tr>
								</table>
							";

						}
						echo"</br>";
					}
					echo"<div class='form-group col-md-2'>
						<button type='submit' class='btn btn-primary btn-md btn-block' style='margin-top:2em;'>
		      			Submit Exam
						</button>
					</div>";
					echo"<input type='hidden' name='email'  value='$_POST[emailExaminee]'>";
					echo"<input type='hidden' name='examID'  value='$examID'>";
					echo"</form>";
					
			}
			else
			{
				echo
				"
					<div class='alert alert-danger'> 
						<center>
							<h3>You cant take the exam, Please check your email for your exam code</h3>
							<br /><br />
							Please <a href='takeExam.php?token=$home'>click here</a> to go back.
						</center>
					</div>
				";
			}
?>
			
			</div>
		</div>
<?php
	include ('footer.php');
?>
