<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
?>
	<script type="text/javascript">
				function getCaret(el) {
					var pos = -1; 
					if (el.selectionStart) { 
						pos = el.selectionStart;
					} 
					else if (document.selection) { 
						//el.focus();         
						var r = document.selection.createRange(); 
						if (r != null) { 
							var re = el.createTextRange(); 
							var rc = re.duplicate(); 
							re.moveToBookmark(r.getBookmark()); 
							rc.setEndPoint('EndToStart', re);       
							pos = rc.text.length; 
						}
					}  
					return pos; 
				}

				function Input(id, immutableText) {
					this.el = document.getElementById(id);
					this.el.value = immutableText;
					this.immutableText = immutableText;
					this.el.onkeypress = keyPress(this);
				}

				function keyPress(el) {
					return function() {
						var self = el; 
						return getCaret(self.el) >= self.immutableText.length;
					}
				}

				Input.prototype.getUserText = function() {
					return this.el.value.substring(this.immutableText.length);
				};
	</script>
	

	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="job.php?token=<?php echo $main; ?>">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Update Job</li>
		</ul>

	</div>

	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="jobPostingAdd.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Browse Job to Update</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="jobPostingAdd.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-plus"> </span> Add Job</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="job.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span> Jobs</a></li>
					</ul>
			  	</div>

			</nav>
		
	
		<h4 class="alert-info well-lg instruction">Fill up the form with job's complete information. 
				Fields with asterisk (*) are required. </h4> 		
			<br /><br />
			<div class='container-fluid content'>	
				<div class="col-md-12">
				
				<form name="formDropdown" method="GET" action="#">
				<?php
				
					
					$jobName = "";
					$jobId = "";
					$jobVacancy = "";
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

				<div class="form-group col-md-6">
					
						<?php
									
						
								$result = mysql_query("SELECT *
															FROM tbl_client
															LEFT JOIN tbl_contract 
															ON tbl_client.clientId = tbl_contract.clientId
															WHERE tbl_contract.contractStatus = 'on-going'
															AND tbl_client.clientId = $_SESSION[login_userId]
															");
															
								while ($row = mysql_fetch_array($result))
								{
								
									$clientId = $row['clientId'];
									$clientName = $row['clientName'];
								}//while

						?>
				
				
					
				</div>
				
				<div class="form-group col-md-12"></div>
				<br />
				
				
				
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
									$jobVacancy = $row['jobVacancy'];
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
				
				
				<div class="form-group col-md-6">
						<label>Select Job Name:</label>
						
						<?php
						$result = mysql_query("SELECT *
																			FROM tbl_client
																			LEFT JOIN tbl_job_posting 
																			ON tbl_client.clientId = tbl_job_posting.clientId
																			WHERE tbl_job_posting.jobStatus = 1
																			AND tbl_client.clientId = $clientId
																			ORDER BY tbl_job_posting.jobName
																			");
						?>
						
						<select type='position' class='form-control' id='name_searchJob' name='name_searchJob' onChange="document.forms['formDropdown'].submit()">
						
						<?php
						
						// ------------------ selected value for job name -------------------------
						echo'
								<script type = "text/javascript">
									setSearchJob();
									function setSearchJob(){
									document.getElementById("name_searchJob").focus();
								}
								</script>
								';
								
								echo '<option value="" selected>Select Job from '.$clientName.' </option>';
							
						
						//-----------------------------------------------------------------------
						
					
							while ($row = mysql_fetch_array($result))
										{
											echo "<option value='" . $row['jobPostingId'] . "'> " . $row['jobName'] . " </option>";	
										}//while
						
						echo '</select>';
						
						?>
				</div>
				
				<div class="form-group col-md-12"></div>
				<br />
				
				<legend style="margin-top:2.5em;"></legend>
				
				<div class="form-group col-md-3">
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
				
				
				<div class="form-group col-md-6"></div>
				<br />
				
				<input type='hidden' 
										class='form-control'
										name='name_jobId' 
										value='$jobId'
										maxlength='6' />
										
				<?php
				
				$_SESSION["ses_jobPostingID"] = $jobId;
				
				?>
				
			</form>
			
			
				
				<?php
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
				//for the jobs
	mysql_select_db("$db_database", $con);
	
	//declaration
	$jobAgeFrom = "";
	$jobAgeTo = "";
	$jobGender = "";
	$jobCivilStatus = "";
	$jobHeight = "";
	$jobHeightFrom = "";
	$jobHeightTo = "";
	$jobWeight = "";
	$jobWeightFrom = "";
	$jobWeightTo = "";
	$jobReligion = "";
	$jobNationality = "";
	$jobExpectedSalary = "";
	
	$totalJobLanguages = 0;
	$totalJobQualities = 0;
	$percentageLeft = 100;
	
	$jobGenderDisplay = "";
	
	//-------------------- Job Qualifications ---------------------
		if ($jobId!="")
		{
		
			$resultJob = mysql_query("SELECT *
									  FROM  tbl_job_quali
									  WHERE jobPostingId = $jobId
									");
													
			while($rowJob = mysql_fetch_array($resultJob)) 
			{
				//age
				if ($rowJob['jobQualiType']=='Age From')
				$jobAgeFrom = $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Age To')
				$jobAgeTo = $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Gender')
				$jobGender = $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Civil Status')
				$jobCivilStatus = $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Height')
				$jobHeight =  $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Height From')
				$jobHeightFrom =  $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Height To')
				$jobHeightTo =  $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Weight')
				$jobWeight =  $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Weight From')
				$jobWeightFrom =  $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Weight To')
				$jobWeightTo =  $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Religion')
				$jobReligion = $rowJob['jobQualiDescription'];
				
				if ($rowJob['jobQualiType']=='Nationality')
				$jobNationality = $rowJob['jobQualiDescription'];
				
				if($rowJob['jobQualiType']=='Expected Salary')
				$jobExpectedSalary = $rowJob['jobQualiDescription'];
				
			}//while
			// ------------------------------------------------------------
		
		}//if	
			
	?>
				
				
					<form method="POST" action="../../../config/updateJobQualifications.php">
									
						
							
									<div class="form-group col-md-12">
									</div>	
									<div class="form-group col-md-6">
										<label> Job Name: </label>
										<input type="text" 
											class="form-control" 
											name="name_jobPostingJobName" 
											value='<?php echo $jobName;?>' 
											placeholder="" 
											id="name_jobPostingJobName"
											required
									/>
									</div>

										<div class="form-group col-md-12">
										</div>
									
									
									<div class="form-group col-md-3">
										<label> Job Vacancy: </label>
										<input type="text" 
											class="form-control" 
											name="name_jobPostingJobVacancy" 
											value='<?php echo $jobVacancy;?>' 
											placeholder="" 
											id="name_jobPostingJobVacancy"
											required
									/>
									</div>
									
									<div class="form-group col-md-3">
										<label> Monthly salary: </label>
										<input type="text" 
											class="form-control" 
											name="name_jobPostingExpectedMonthlySalary" 
											<?php
											if ($jobId!="")
											{
											echo "value='Php $jobExpectedSalary'";
											}
											?>
											maxlength="13"
											placeholder="" 
											id="name_jobPostingExpectedMonthlySalary"
											required
									/>
									</div>

										<div class="form-group col-md-6">
										</div>
									
									
									<div class="form-group col-md-12">
									</div>		
								<div class="form-group col-md-12">
						
										<label>Qualifications for the Job:</label>
									</div>
									
										
			
									<div class="form-group col-md-2">
										<label>
											Gender: *
										</label>
											<select type="position" 
													class="form-control"  
													id="name_jobPostingGender"
													name="name_jobPostingGender">
													<?php
													if ($jobId!="")
													{
														if($jobGender=="Any")
														{
															$jobGenderDisplay = "Male/Female";
														}
														else
														{
															$jobGenderDisplay = $jobGender;
														}
													echo '<option value="'.$jobGender.'"  selected>'.$jobGenderDisplay.'</option>';
													}//if
													else
													{
													echo '<option value="Any"  selected>Male/Female</option>';
													}//else
													?>
													<option value="Any">Male/Female</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
											 </select>
									</div>

									<div class="form-group col-md-3">
										<label>Civil Status:</label>
										<select type="name_jobPostingCivilStatus" 
												class="form-control"  
												id="name_jobPostingCivilStatus"
												name="name_jobPostingCivilStatus">
												<?php
												if ($jobId!="")
												{
													echo'<option value="'.$jobCivilStatus.'" selected>'.$jobCivilStatus.'</option>';
												}//if
												else
												{
													echo'<option value="Any" selected>Any</option>';
												}//else
												?>
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Widow/Widower">Widow/Widower</option>
												<option value="Separated">Separated</option>
												<option value="Divorced">Divorced</option>
										 </select>
									</div>


									
									
										<?php 
									
										?>
											
									<div class="form-group col-md-2">
										<label for="appHeight">Age Range (from):</label>
										<input type="text" 
												class="form-control" 
												name="name_jobPostingAgeFrom" 
												value='<?php echo $jobAgeFrom;?>'  
												maxlength="2"
												id="name_jobPostingAgeFrom"

												placeholder="Age From" 
												required
										/>
									</div>
									
									<div class="form-group col-md-2">
										<label for="appHeight">Age Range (to):</label>
										<input type="text" 
												class="form-control" 
												name="name_jobPostingAgeTo" 
												value='<?php echo $jobAgeTo;?>' 
												maxlength="2"
												id="name_jobPostingAgeTo"
												placeholder="Age Up To" 
												required
										/>
									</div>
									
								<div class="form-group col-md-3">
									</div>
										

								
								
						<!--------------  CURRENCY	------------------>
								
								<script type='text/javascript'>
								<?php
									if ($jobId=="")
									{
									echo"	
										var input = new Input('name_jobPostingExpectedMonthlySalary', 'Php ');
										var userText = input.getUserText(); 
						
										$('#name_jobPostingExpectedMonthlySalary').keyup(function(e)
										{
											if(this.value.length < 4){
												this.value = 'Php ';
											}
											else if( this.value.indexOf('Php ') !== 0 ){ 
												this.value = 'Php '  + String.fromCharCode(e.which); 
											}
										});
									";
									}
								?>
								</script> 
						<!--------------  //CURRENCY	------------------>
								
							
							
								
						<div class="form-group col-md-6">
						<label>Religion: *</label>
						
						<?php	
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error());
						}
					
						mysql_select_db("$db_database", $con);
						$resultJob = mysql_query("SELECT DISTINCT jobQualiDescription FROM tbl_job_quali WHERE jobQualiType = 'Religion'");
						$resultApp = mysql_query("SELECT DISTINCT personalQualityDesc FROM tbl_personal_info WHERE personalQualityType = 'Religion'");
													
						echo "<select type='position' class='form-control' id='name_jobPostingSearchReligion' name='name_jobPostingSearchReligion' onchange = 'enableTextboxReligion()'>";
					?>
					<?php
					if ($jobId!="")
					{
						echo'<option value="'.$jobReligion.'" selected>'.$jobReligion.'</option>';
					}//if
					else
					{
						echo'<option value="Any" selected>Any</option>';
					}
					?>
					<option value="Any">Any</option>
							<?php	
								$ctr=0;
								while ($rowJob = mysql_fetch_array($resultJob))
								{
									if (($rowJob['jobQualiDescription']!='Any') && ($rowJob['jobQualiDescription']!='Others'))
									{
										$religionJobApp[$ctr] = $rowJob['jobQualiDescription'];
										$ctr++;
									}//if
								}//while
								
								while ($rowApp = mysql_fetch_array($resultApp))
								{
									$religionJobApp[$ctr] = $rowApp['personalQualityDesc'];
									$ctr++;
								}//while
								
								$religionJobAppUnique = array_values(array_unique($religionJobApp)); //getting the unique values
								
								
										$ctr=0;
										while ((isset($religionJobAppUnique[$ctr])) && ($religionJobAppUnique[$ctr]!=" "))
										{
										  echo "<option value='" . $religionJobAppUnique[$ctr] . "'> " . $religionJobAppUnique[$ctr] . " </option>";
											$ctr++;
										}//while
								
								mysql_close($con);
							?>
						<option value="Others">Others</option>
						<?php echo "</select >"; ?>
						
						</div>
											
						<div class="form-group col-md-3">
							<label></label>
							<input type="text" 
									class="form-control" 
									name="name_jobPostingReligionOthers" 
									id="name_jobPostingReligionOthers"
									value=''
									maxlength="250" 
									style="margin-top:1.5em;"
									placeholder="Others, please specify"
									style="text-transform: capitalize;"
									disabled = true
							/>
						</div>
									
						<div class="form-group col-md-3">
			
							<button class="btn btn-primary btn-md btn-block" 
								type="button" 
								name="SelectReligionFromList" 
								id="SelectReligionFromList" 
								style="display:none;  margin-top: 1.75em;" 
								onclick="enableListReligion()">
								<span class="glyphicon glyphicon glyphicon-bookmark"></span>&nbsp; Select religion from the list
							</button>
						</div>	
									
						<div class="form-group col-md-3">
						</div>
												
										
						<div class="form-group col-md-6">
							<label>Nationality: *</label>

						
					<?php	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error());
								}
							
								mysql_select_db("$db_database", $con);
								
								$resultJob = mysql_query("SELECT DISTINCT jobQualiDescription FROM tbl_job_quali WHERE jobQualiType = 'Nationality'");
								$resultApp = mysql_query("SELECT DISTINCT personalQualityDesc FROM tbl_personal_info WHERE personalQualityType = 'Nationality'");
						
													
								echo "<select type='position' class='form-control' id='name_jobPostingSearchNationality' name='name_jobPostingSearchNationality' onchange = 'enableTextboxNationality()'>";
					?>
					<?php
					if ($jobId!="")
					{
						echo'<option value="'.$jobNationality.'" selected>'.$jobNationality.'</option>';
					}//if
					else
					{
						echo'<option value="Any" selected>Any</option>';
					}
						
					?>
					<option value="Any">Any</option>
					<?php		
					
						$ctr=0;
								while ($rowJob = mysql_fetch_array($resultJob))
								{
									if (($rowJob['jobQualiDescription']!='Any') && ($rowJob['jobQualiDescription']!='Others'))
									{
										$nationalJobApp[$ctr] = $rowJob['jobQualiDescription'];
										$ctr++;
									}//if
								}//while
								
								while ($rowApp = mysql_fetch_array($resultApp))
								{
									$nationalJobApp[$ctr] = $rowApp['personalQualityDesc'];
									$ctr++;
								}//while
								
								$nationalJobAppUnique = array_values(array_unique($nationalJobApp)); //getting the unique values
								
								
										$ctr=0;
										while ((isset($nationalJobAppUnique[$ctr])) && ($nationalJobAppUnique[$ctr]!=" "))
										{
										  echo "<option value='" . $nationalJobAppUnique[$ctr] . "'> " . $nationalJobAppUnique[$ctr] . " </option>";
											$ctr++;
										}//while
						mysql_close($con);
					?>
					<option value="Others">Others</option>
					<?php echo "</select >"; ?>
											
						</div>
								
											

						<div class="form-group col-md-3">
							<label></label>
								<input type="text" 
										class="form-control" 
										name="name_jobPostingNationalityOthers" 
										id="name_jobPostingNationalityOthers"
										value=''
										maxlength="250" 
										style="margin-top:1.5em;"
										placeholder="Others, please specify"
										style="text-transform: capitalize;"
										disabled = true
								/>
						</div>
											

									
						<div class="form-group col-md-3">
					
							<button class="btn btn-primary btn-md btn-block" 
									type="button" 
									name="SelectNationalityFromList" 
									id="SelectNationalityFromList" 
									style="display:none; margin-top: 1.75em;" 
									onclick="enableListNationality()">
									<span class="glyphicon glyphicon glyphicon-bookmark"></span>&nbsp; Select nationality from the list
							</button>
						</div>	
									
						<script type = "text/javascript">
						
						
						function enableTextboxReligion() {
						if (document.getElementById("name_jobPostingSearchReligion").value == "Others") {
						document.getElementById("name_jobPostingReligionOthers").disabled = false;
						document.getElementById("name_jobPostingReligionOthers").setAttribute('placeholder',"Please specify Religion");
						document.getElementById("name_jobPostingSearchReligion").disabled = true;
						document.getElementById("SelectReligionFromList").style.display = "block";

						}
						
						}
						
						function enableListReligion(){
						document.getElementById("name_jobPostingReligionOthers").disabled = true;
						document.getElementById("name_jobPostingSearchReligion").disabled = false;
						document.getElementById("name_jobPostingSearchReligion").selectedIndex = 0;
						document.getElementById("SelectReligionFromList").style.display = "none";
						document.getElementById("name_jobPostingReligionOthers").setAttribute('placeholder',"Others, please specify");
						document.getElementById("name_jobPostingReligionOthers").value = "";
						}
						
						function enableTextboxNationality() {
						if (document.getElementById("name_jobPostingSearchNationality").value == "Others") {
						document.getElementById("name_jobPostingNationalityOthers").disabled = false;
						document.getElementById("name_jobPostingNationalityOthers").setAttribute('placeholder',"Please specify Nationality");
						document.getElementById("name_jobPostingSearchNationality").disabled = true;
						document.getElementById("SelectNationalityFromList").style.display = "block";
						
						}
						
						}
						
						function enableListNationality(){
						document.getElementById("name_jobPostingNationalityOthers").disabled = true;
						document.getElementById("name_jobPostingSearchNationality").disabled = false;
						document.getElementById("name_jobPostingSearchNationality").selectedIndex = 0;
						document.getElementById("name_jobPostingNationalityOthers").setAttribute('placeholder',"Others, please specify");
						document.getElementById("SelectNationalityFromList").style.display = "none";
						document.getElementById("name_jobPostingNationalityOthers").value = "";
						}
						
						
							function disableListNationality(status)
							{
				
							document.getElementById('name_jobPostingSearchNationality').disabled = status;
							if (status==false)
							{
							document.getElementById('name_jobPostingNationalityOthers').disabled = !status;
							}
							else
							{document.getElementById('name_jobPostingNationalityOthers').disabled = status;}
							document.getElementById("name_jobPostingSearchNationality").selectedIndex = 0;
							document.getElementById("name_jobPostingNationalityOthers").value = "";
							}
							
							function disableListReligion(status)
							{
				
							document.getElementById('name_jobPostingSearchReligion').disabled = status;
							if (status==false)
							{
							document.getElementById('name_jobPostingReligionOthers').disabled = !status;
							}
							else
							{document.getElementById('name_jobPostingReligionOthers').disabled = status;}
							document.getElementById("name_jobPostingSearchReligion").selectedIndex = 0;
							document.getElementById("name_jobPostingReligionOthers").value = "";
							}
							
						</script>

							<div class="col-md-12">
							</div>
												
												
												<div class="col-md-2">
												<label>
													Height (meters) from:
												</label>
												<input type="text"
														class="form-control" 
														name="name_jobPostingHeightFrom" 
														id="name_jobPostingHeightFrom"
														value='<?php echo $jobHeightFrom;?>'  
														maxlength="3" 
														placeholder="Height from" 
												/>
												</div>
												
												<?php
												?>
											
											<div class="col-md-2">
											<label>
												Up to:
											</label>
											<input type="text"
													class="form-control" 
													name="name_jobPostingHeightTo" 
													id="name_jobPostingHeightTo"
													value='<?php echo $jobHeightTo;?>' 
													maxlength="3" 
													placeholder="Up to" 
													
											/>
											</div>
											
											<div class="col-md-1">
											<label>
												Any
											</label>
											<br />
											<?php
											if ($jobId=="" || $jobHeight=="Any")
											{
												echo'
												<input type="checkbox" value="Any" checked="checked" 
														style="margin-left:.3em; margin-top:.75em;"
														name="name_jobPostingHeightAny" id="name_jobPostingHeightAny" onclick="enableHeightTextbox(this.checked)" >
												';
											}
											else
											{
												echo'
												<input type="checkbox" value="Any"
														style="margin-left:.3em; margin-top:.75em;"
														name="name_jobPostingHeightAny" id="name_jobPostingHeightAny" onclick="enableHeightTextbox(this.checked)" >
												';
											}
											?>
											</div>
											
											
											<?php
												//disable textbox for height
												if($jobHeightFrom=="" && $jobHeightTo=="")
												{
													echo'
													<script type = "text/javascript">
													document.getElementById("name_jobPostingHeightFrom").disabled = true;
													document.getElementById("name_jobPostingHeightTo").disabled = true;
													</script>
													';
												}//if
										
												?>
									
											
											<script language='JavaScript'>
										
										<?php
										echo"
										function enableHeightTextbox(status)
										{
										status=!status;	
										document.getElementById('name_jobPostingHeightFrom').disabled = !status;
										document.getElementById('name_jobPostingHeightTo').disabled = !status;
											if(document.getElementById('name_jobPostingHeightFrom').disabled == false && document.getElementById('name_jobPostingHeightTo').disabled == false)
											{
												document.getElementById('name_jobPostingHeightFrom').value = '".$jobHeightFrom."';
												document.getElementById('name_jobPostingHeightTo').value = '".$jobHeightTo."';
											}//if
											else
											{
												document.getElementById('name_jobPostingHeightFrom').value = '';
												document.getElementById('name_jobPostingHeightTo').value = '';
											}//if
										}//function
										";
										?>
										</script>
										
										
										
										<div class="col-md-12"><br /></div>
										
										
										
									
										<div class="col-md-2">
										<label>
												Weight (kg) from:
											</label>
											<input type="text"
													class="form-control" 
													name="name_jobPostingWeightFrom" 
													id="name_jobPostingWeightFrom"
													value='<?php echo $jobWeightFrom;?>' 
													maxlength="3" 
													placeholder="Weight from" 
											/>
											</div>
										
											<div class="col-md-2">
											<label>
												Up to:
											</label>
											<input type="text"
													class="form-control" 
													name="name_jobPostingWeightTo" 
													id="name_jobPostingWeightTo"
													value='<?php echo $jobWeightTo;?>' 
													maxlength="3" 
													placeholder="Up to" 
											/>
											</div>
											
											<div class="col-md-1">
												<label>
													Any
												</label>
												<br />
												<?php
												if ($jobId=="" || $jobWeight=="Any")
												{
													echo'
													<input type="checkbox" value="Any" checked="checked" 
															style="margin-left:.3em; margin-top:.75em;"
															name="name_jobPostingWeightAny" id="name_jobPostingWeightAny" onclick="enableWeightTextbox(this.checked)" >
													';
												}
												else
												{
													echo'
													<input type="checkbox" value="Any"
															style="margin-left:.3em; margin-top:.75em;"
															name="name_jobPostingWeightAny" id="name_jobPostingWeightAny" onclick="enableWeightTextbox(this.checked)" >
													';
												}
												?>	
											</div>
											
											
											<?php
												//disable textbox for height
												if($jobWeightFrom=="" && $jobWeightTo=="")
												{
													echo'
													<script type = "text/javascript">
													document.getElementById("name_jobPostingWeightFrom").disabled = true;
													document.getElementById("name_jobPostingWeightTo").disabled = true;
													</script>
													';
												}//if
										
												?>
										
										<script language='JavaScript'>
										
										<?php
										echo"
										function enableWeightTextbox(status)
										{
										status=!status;	
										document.getElementById('name_jobPostingWeightFrom').disabled = !status;
										document.getElementById('name_jobPostingWeightTo').disabled = !status;
											if(document.getElementById('name_jobPostingWeightFrom').disabled == false && document.getElementById('name_jobPostingWeightTo').disabled == false)
											{
												document.getElementById('name_jobPostingWeightFrom').value = '".$jobWeightFrom."';
												document.getElementById('name_jobPostingWeightTo').value = '".$jobWeightTo."';
											}//if
											else
											{
												document.getElementById('name_jobPostingWeightFrom').value = '';
												document.getElementById('name_jobPostingWeightTo').value = '';
											}//if
										}
										";
										?>
										</script>
							<div class="form-group col-md-12">
									</div>			
				
										
									
					</div>
									
										
			</div>
									
									

									
								

										<div class="form-group col-md-3">
									</div>
								
									<div class="form-group col-md-2">
									<button type="button" 
															class="btn btn-danger btn-md btn-block"
															name ="btnCancel" 
															id = "btnCancel" 
															style="margin-top: 2em;"
															onClick="location.href='#'">
															Cancel
									</button>
									</div>     	
								
									<div class="form-group col-md-1">
									</div>
								
									
									<div class="form-group col-md-2">
									<button class="btn btn-primary btn-md btn-block" 
											type="submit" 
											name = "submitFormClient" 
											id = "submitFormClient"  
											style="margin-top: 2em;"  
											onclick=""/>
											Next &nbsp;
											<span class="glyphicon glyphicon-chevron-right"></span>
											</button>
									</div>
									
									<div class="form-group col-md-4">
									</div>

										
									</form>
									
								
								
					</div>
		</div>
	
	
<?php
	include ('../footer.php');
?>