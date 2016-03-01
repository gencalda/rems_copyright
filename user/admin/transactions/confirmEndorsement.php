<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include ('endorseModal.php');
	include('../adminNotifModal.php');
	$counter = 1;
	$tran = md5('transaction');
	$attempt = $_GET['attempt'];
?>

	<div class='container-fluid content'>
			<ul class="breadcrumb">
				<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li><a href="assessApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li><a href='pairingFirst.php?token=<?php echo $tran; ?>&basicID=<?php echo $_POST["basicID"]; ?>'><?php echo $_POST['appFname']." ".$_POST['appMname']." ".$_POST['appLname'] ?></a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li>Confirm Endorsement</li>&nbsp;&nbsp;&nbsp;
				</ul>
			</ul>
		</div>

	<div class="container-fluid">
	
			<?php
			
				$examCode = array();
				$examID = array();
				$examCodeAppTaken = array();
				$examToBeTaken = 0;
				$examAppTaken = 0;
				$appFailed = 0;
				$appPassed = 0;
				$ctr = 0;
			
				$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
									{
										die('Could not connect: ' . mysql_error());
									}
																	
								mysql_select_db("$db_database", $con);
								
								$sql = "SELECT *
								FROM tbl_exam
								WHERE jobPostingId = $_POST[jobID]";   
								$result = mysql_query($sql) or die(mysql_error() . "<br/>$sql");  		

								$ctr=0; 	// counter
								while($row = mysql_fetch_array($result)) 
								{
									$examCode[$ctr] =  $row['examCode'];
									$examID[$ctr] =  $row['examId'];
									
									$resultAppTaken = mysql_query("SELECT *
												FROM tbl_applicant_exam
												WHERE applicantId = $_SESSION[ses_AppID]
												AND examId = $examID[$ctr]");
												
									while($rowAppTaken = mysql_fetch_array($resultAppTaken)) 
									{
										if ($rowAppTaken['examStatus']=='Passed')
										{
											$appPassed++;
											$examAppTaken++;
											$examCodeAppTaken[$ctr] = $examCode[$ctr];
										}//passed
										else if($rowAppTaken['examStatus']=='Failed')
										{
											$appFailed++;
											$examAppTaken++;
											$examCodeAppTaken[$ctr] = $examCode[$ctr];
										}//failed
										
									}//while
									
									
									$ctr++;
								}//Location
							
							$examToBeTaken = mysql_num_rows($result);
							
				// check in database if this email exist
				if ((mysql_num_rows($result) == 0) || ($examAppTaken==$examToBeTaken))
				{
			
			?>
		
					<div class="alert" id="login">
					<div class="alert-info well-lg col-md-4 col-md-offset-3" style="margin-top:5em; text-align:center; padding:2em;">
					<?php
					  echo"<strong>Endorse</strong> Are you sure you want to endorse <br />$_POST[appFname] $_POST[appMname] $_POST[appLname] as $_POST[jobName] in <br /> $_POST[clientName]? ";
				    ?>
					</div>
					</div>

					<div class="container-fluid">
						<div class="col-md-offset-9 well well-sm" style="width:20.5em; margin-bottom:7em;">
							<h3>Confirm</h3>
							<div class="form-group">
								Enter your password to confirm.
							</div>
							
							<form class="form center-block" role="form" action="send.php?token=<?php echo $tran; ?>" method="POST">
								<input type="hidden" name="attempt" value='<?php echo $attempt; ?>' />
								<div class="form-group has-feedback has-feedback-left">
									<label class="control-label sr-only">Password</label>
									<input type="password" 
											class="form-control input-lg" 
											placeholder="Password" 
											name="password"
											value="" 
											required
									/>
									<i class="form-control-feedback glyphicon glyphicon-lock"></i>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg btn-block">
										<span class="glyphicon glyphicon-ok-circle"></span>&nbsp; Okay
									</button>
									<button type="reset" tabindex="-1" class="btn btn-danger btn-md btn-block">
										<span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Reset
									</button>
								</div>
								
							</form>
						</div>
					</div>
			<?php
				}
				else if (mysql_num_rows($result) > 0)
				{
			
					?>
					<div class="alert" id="login">
						<div class="alert-warning well-lg col-md-6 col-md-offset-3" style="margin-top:3em; text-align:center; padding:2em;">
						<?php
						if(mysql_num_rows($result) == 1) 
						{
						  echo"<strong>Wait! </strong> An exam must be taken by $_POST[appFname] $_POST[appMname] $_POST[appLname] before endorsing to <br />  $_POST[clientName] as $_POST[jobName]  <br /><br /> ";
						  echo"Here is the exam code. <br /><strong> <br/> <br/>Exam Code</strong></p>";
						 }
						else 
						{
							 echo"<strong>Wait! </strong> Exams must be taken by $_POST[appFname] $_POST[appMname] $_POST[appLname] before endorsing to <br />  $_POST[clientName] as $_POST[jobName]  <br /><br /> ";
							echo"Here are the exam code. <br /><strong> <br/> <br/>Exam Code</strong></p>";
						}
						  $ctr =0;
									while(isset($examCode[$ctr]) && ($examCode[$ctr]!=""))
									{
										if (!(in_array($examCode[$ctr], $examCodeAppTaken)))
										{
										 echo" <br /> <p style='font-size: 2em;'> $examCode[$ctr] ";
										 }
										$ctr++;
									}//while
						?>
						</div>
						<div class="alert-info well-lg col-md-6 col-md-offset-3" style="margin-top:3em; margin-bottom:8em; text-align:center; padding:2em;">
							<p><strong>Note </strong> Please write the exam code to the applicant's voucher <br /> then re-assess the applicant once the exam is done. </p>
							<br />
							<?php $tran = md5('transaction'); ?>
							<a href="assessApplicant.php?token=<?php echo $tran;?>">Click here</a> to go back to assess applicant.
						</div>
					</div>
					<?php
					
					
			
				}
				?>
	
	</div>
	

<?php
	$_SESSION['endorsedJobId'] = $_POST['jobID'];	
	$_SESSION['endorsedBasicId'] = $_POST['basicID'];	
	include ('../footer.php');
?>