<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	
		$main = md5('maintenance');
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Utilities</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="exam.php?token=<?php echo $util; ?>">Exam</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
				Create Exam
 			</li>
		</ul>
	</div>

<?php
	//variables
	$QuestionCtr = 1;
	$dropdownClient = "Select Client";
	$dropdownJobName = "Select Job Name";
?>



		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">

				<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>
							<h3>
								<a href="createExam.php?token=<?php echo $util; ?>" style="margin-left:.5em;">Create Exam</a>
							</h3>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li>
							<a href="exam.php?token=<?php echo $util; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"></span> Exam</a>
						</li>
					</ul>
			  	</div>
			</nav>

				<h4 class="alert-info well-lg instruction">Create an exam for a client. Fields with asterisk (*) are required.</h4>
				<br /><br />
				
		
			
			<form name="formDropdown" method="GET" action="#">
				<?php
				
					
					$jobName = "";
					$jobId = "";
					$clientId = "";
					$clientName = "";
					
					echo "<input type='hidden' name='token' value='$main' />";
					$con = mysql_connect("$db_hostname","$db_username","$db_password");
											if (!$con)
											{
												die('Could not connect: ' . mysql_error());
											}
										
											mysql_select_db("$db_database", $con);
					
				?>

				<div class="form-group col-md-6 col-md-offset-3">
					<label>Select Client:</label>
							
						
						<?php
									
									$result = mysql_query("SELECT *
															FROM tbl_client
															LEFT JOIN tbl_contract 
															ON tbl_client.clientId = tbl_contract.clientId
															WHERE tbl_contract.contractStatus = 'on-going'	
															");	
						?>
						<select type='position' class='form-control' id='name_searchClient' name='name_searchClient' onChange="document.forms['formDropdown'].submit()">
						<option value="" selected>Search Client</option>
						<?php
								while ($row = mysql_fetch_array($result))
								{
									echo "<option name='name_searchClient' value='" . $row['clientId'] . "'> " . $row['clientName'] . " </option>";	
								}						
							
						echo "</select>"; 
						
						if (isset($_GET['name_searchClient']))
						{
							if($_GET['name_searchClient']!="")
							{
							
								$result = mysql_query("SELECT *
															FROM tbl_client
															LEFT JOIN tbl_contract 
															ON tbl_client.clientId = tbl_contract.clientId
															WHERE tbl_contract.contractStatus = 'on-going'
															AND tbl_client.clientId = $_GET[name_searchClient]
															");
															
								while ($row = mysql_fetch_array($result))
								{
								
									$clientId = $row['clientId'];
									$clientName = $row['clientName'];
								}//while

							}
						}// if set
						?>
				
				
					
				</div>
				
				
				
				
				<?php
				
					if	(isset($_GET['name_searchJob']))
						{
						
							if($_GET['name_searchJob']!="")
							{
						
								$result = mysql_query("SELECT *
																			FROM tbl_job_posting 
																			WHERE jobStatus = 1
																			AND jobPostingId = $_GET[name_searchJob]
																			");
															
								while ($row = mysql_fetch_array($result))
								{
								
									$jobId = $row['jobPostingId'];
									$jobName  = $row['jobName'];
								}//while
								
								
								$result = mysql_query("SELECT *
													FROM tbl_client
													LEFT JOIN tbl_job_posting 
													ON tbl_client.clientId = tbl_job_posting.clientId
													WHERE tbl_job_posting.jobPostingId = $jobId
																			");
															
								while ($row = mysql_fetch_array($result))
								{
								
									$clientId = $row['clientId'];
									$clientName = $row['clientName'];
								}//while

							
							}
						}// if set
	
				?>
				
				
				<div class="form-group col-md-6 col-md-offset-3">
						<label>Select Job Name:</label>
						
						<?php
						$result = mysql_query("SELECT *
																			FROM tbl_client
																			LEFT JOIN tbl_job_posting 
																			ON tbl_client.clientId = tbl_job_posting.clientId
																			WHERE tbl_job_posting.jobStatus = 1
																			AND tbl_client.clientId = $clientId
																			");
						?>
						
						<select type='position' class='form-control' id='name_searchJob' name='name_searchJob' onChange="document.forms['formDropdown'].submit()">
						
						<?php
						
						// ------------------ selected value for job name -------------------------
						if	(isset($_GET['name_searchClient']))
						{
						
							if($_GET['name_searchClient']!="")
							{
								echo'
								<script type = "text/javascript">
									setSearchJob();
									function setSearchJob(){
									document.getElementById("name_searchJob").focus();
								}
								</script>
								';
								
								echo '<option value="" selected>Select Job from '.$clientName.' </option>';
							}
							else
							{
								echo '<option value="" selected>Select Job</option>';
							}
						}
						
						else if (!isset($_GET['name_searchClient']))
						{
							echo'
								<script type = "text/javascript">
									setSearchJob();
									function setSearchJob(){
									document.getElementById("name_searchClient").focus();
								}
								</script>
								';
								
							echo '<option value="" selected>Select Job</option>';
						}//else
						
						
						//-----------------------------------------------------------------------
						
					
							while ($row = mysql_fetch_array($result))
										{
											echo "<option value='" . $row['jobPostingId'] . "'> " . $row['jobName'] . " </option>";	
										}//while
						
						echo '</select>';
						
						?>
				</div>
				
				
				
				<div class="form-group col-md-3 col-md-offset-3">
				<label style="margin-top: 2.5em;">Client Name:</label>
					<input class="form-control" style="margin-top: 1em;" type="text"  name="name_clientName" value="<?php echo $clientName; ?>" disabled />
				</div>
				
				
				<input type='hidden' 
										class='form-control'
										name='name_clientId' 
										value='$clientId'
										maxlength='6' />
				
				<div class="form-group col-md-3">
				<label style="margin-top:2.5em;">Job Name:</label>
					<input class="form-control" type="text"  style="margin-top: 1em;" name="name_jobName" value="<?php echo $jobName; ?>" disabled />
				</div>
				
				
				<input type='hidden' 
										class='form-control'
										name='name_jobId' 
										value='$jobId'
										maxlength='6' />
										
				<?php
				
				$_SESSION["ses_jobId"] = $jobId;
				
				?>
				
			</form>
			
			<form method="POST" action="../../../config/insertExamTitle.php">
				
				
				<div class="form-group col-md-12">
				</div>

				<div class="form-group col-md-3 col-md-offset-3">
					<label>Subject: *</label>
					<?php	
											
											$result = mysql_query("SELECT * FROM tbl_subject WHERE subjectStatus = 1");
																		
											echo "<select type='position' class='form-control' id='name_searchSubject' name='name_searchSubject' onchange = 'enableTextboxSubject()'>";
								?>
								<option value="General" selected>Select Subject</option>
								<!--<option value="any">Any</option>-->
								<?php		
									while ($row = mysql_fetch_array($result))
									{
										echo "<option value='" . $row['subjectId'] . "'> " . $row['subjectName'] . " </option>";	
									}//while
									
									mysql_close($con);
								?>
								<option value="Others">Others</option>
								<?php echo "</select >"; ?>
								
								<script type = "text/javascript">
								
								
								function enableTextboxSubject()
								{
									if (document.getElementById("name_searchSubject").value == "Others") 
									{
									document.getElementById("name_subjectOthers").disabled = false;
									document.getElementById("name_subjectOthers").setAttribute('placeholder',"Please specify subject");
									document.getElementById("name_searchSubject").disabled = true;
									document.getElementById("SelectSubjectFromList").style.display = "block";

									}//if
								
								}//function
								
								function enableListSubject(){
								document.getElementById("name_subjectOthers").disabled = true;
								document.getElementById("name_searchSubject").disabled = false;
								document.getElementById("name_searchSubject").selectedIndex = 0;
								document.getElementById("SelectSubjectFromList").style.display = "none";
								document.getElementById("name_subjectOthers").setAttribute('placeholder',"Others, please specify");
								document.getElementById("name_subjectOthers").value = "";
								}
								
									
								</script>
					
				</div>
				
				
				<div class="form-group col-md-3">
				<label></label>
									<input type="text" 
											class="form-control" 
											name="name_subjectOthers" 
											id="name_subjectOthers"
											value=''
											maxlength="250" 
											style="margin-top:.2em;"
											placeholder="Others, please specify"
											style="text-transform: capitalize;"
											disabled = true
									/>
				</div>
				
				<div class="form-group col-md-3">
				<label></label>
									<button class="btn btn-primary btn-md btn-block" 
										type="button" 
										name="SelectSubjectFromList" 
										id="SelectSubjectFromList" 
										style="display:none;" 
										onclick="enableListSubject()">
										<span class="glyphicon glyphicon glyphicon-list"></span>&nbsp; Select Subject from the list
								</button>
				</div>
			
			
				<div class="form-group col-md-4 col-md-offset-3 ">
					<label>Title: *</label>
					<input type="text" 
							class="form-control" 
							name="name_examTitle" 
							value='' 
							title="Psychological Exam"
							maxlength="250"   
							
					/>
				</div>

				<div class="form-group col-md-2">
					<label>Passing Grade (%): *</label>
					<input type="text" 
							class="form-control" 
							name="name_examPassingGrade" 
							value='' 
							title="(Correct answers / Number of items) * 100" 
							placeholder=""
							maxlength="3"   
							
					/>
					<i class="form-control-feedback" 
					    	style="font-size:1.5em; padding-top: 1.1em; margin-right:.75em;">%</i>
				</div>




				<div class="col-md-12"></div>
				


				<div class="col-md-12"><br /><br /></div>

				<div class="form-group col-md-2 col-md-offset-5">
						<button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submit" 
								style="margin-top: 2em; ">
							 	Proceed &nbsp;
							 <span class="glyphicon glyphicon-check"></span>
		      			</button>
		      	</div>

		

						
						
		      		
		      	

	     	</form>
	     </div>	
			
			

			

		</div>
	</div>







	
	



	

<?php
	include ('../footer.php');
?>
