<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Utilities</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="exam.php?token=<?php echo $main; ?>">Exam</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
				Create Exam Answer Key
 			</li>
		</ul>
	</div>


<?php 

	
	$questionId = array();
	$choicesId = array();
	$choicesDescription = array();
	$questionDescription = array();
	$ctr = 0;
	$questionNumber = 1;
	$currentQuestion = "";
	$questionKeyId = array();
	$answerKeyVariable = "";

?>


		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">

				<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>
							<h3>
								<a href="createExam.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Create Exam Answer Key</a>
							</h3>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li>
							<a href="updateExam.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update</a>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li>
							<a href="exam.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"></span> Exam</a>
						</li>
					</ul>
			  	</div>
			</nav>

				<h4 class="alert-info well-lg instruction">Please choose the correct answer for each questions.</h4>
				<br /><br />
				<form method="POST" action="../../../config/insertAnswerKey.php">
				<div class="form-group col-md-6 col-md-offset-3">
					<label>EXAM</label>
						<?php	
							
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
							if (!$con)
							{
								die('Could not connect: ' . mysql_error());
							}
						
							mysql_select_db("$db_database", $con);
							$result = mysql_query("SELECT *
													FROM tbl_question
													LEFT JOIN tbl_choice 
													ON tbl_question.questionId = tbl_choice.questionId
													LEFT JOIN tbl_exam
													ON tbl_exam.examId = tbl_question.examId
													WHERE tbl_exam.examId = $_SESSION[ses_examID]
													ORDER BY tbl_choice.choiceId");
														
			
							$ctr = 0;
							while ($row = mysql_fetch_array($result))
							{
								
								$questionId[$ctr] = $row['questionId'];
								$questionDescription[$ctr] = $row['questionDesc'];
								$choicesId[$ctr] = $row['choiceId'];
								$choicesDescription[$ctr] = $row['choiceDescription'];
								$ctr++;
							}
							
							
							mysql_close($con);
							
							$key = 0;
							$ctr = 0;
							while (isset($questionId[$ctr]) && ($questionId[$ctr]!=""))
							{
								if($questionId[$ctr]!=$currentQuestion)
								{
									echo" </br></br> </br>Question no. $questionNumber: </br>$questionDescription[$ctr]";
									$currentQuestion = $questionId[$ctr];
									
									$questionKeyId[$key] = $questionId[$ctr];
									$key++;
									$answerKeyVariable = "name_answerKey"+$key;
									$questionNumber++;
									echo"</br></br> Choices:";
								}//if
									echo' </br><input type="radio" 
												name="'.$answerKeyVariable.'"
												value="'.$choicesId[$ctr].'" 
												id="name_appQualityGender" />'.$choicesDescription[$ctr].'';
								$ctr++;
							}//while
							
							$_SESSION['ses_questionKeyId'] = $questionKeyId;
						?>
					
					</div>


				<div class="col-md-12"><br /><br /></div>

				<div class="form-group col-md-2 col-md-offset-4">
						
						<button type="reset" 
								class="btn btn-danger btn-md btn-block"
								name ="reset" 
								tabindex="-1" 
								style="margin-top: 2em; ">
							 	Reset &nbsp;
							 <span class="glyphicon glyphicon-remove"></span>
		      			</button>
		      		
		      	</div>

		

				<div class="form-group col-md-2">
						
						<button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submit" 
								style="margin-top: 2em; ">
							 	Submit &nbsp;
							 <span class="glyphicon glyphicon-check"></span>
		      			</button>
		      		
		      	

	     	</form>
	     </div>	
			
			
		<?php
			//if(isset(submit))
			//{
				
			//}
		?>
			

		</div>
	</div>



<?php
	include ('../footer.php');
?>
