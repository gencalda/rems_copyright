<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>

<?php

	$selectedMonth = 'Month';
	$selectedDay = 'Day';
	$selectedYear = 'Year';
	$selectedCivilStatus = 'Select Civil Status';
	$selectedReligion = 'Select Religion';
	$selectedNationality = 'Select Nationality';


?>

<script type = "text/javascript">
	
	function formValidation(){
						
						if( (document.getElementById("name_searchJob").value=="general")  || ( (document.getElementById("name_searchJob").value=="others") && (document.getElementById("name_jobPostingTitleOthers").value==""))) 
						{
							alert("Please enter the Job Title.");
							return false;
						}
						
						else if(document.getElementById("name_jobPostingExpectedMonthlySalary").value=="Php ")
						{
							alert("Please enter Monthly Salary.");
							return false;
						}
						
						else if ( parseInt(document.getElementById("name_jobPostingAgeFrom").value) > parseInt(document.getElementById("name_jobPostingAgeTo").value))
						{
							alert("Invalid Age Range.");
							return false;
						}
						
						else if (parseInt(document.getElementById("name_jobPostingAgeFrom").value) < 18)
						{
							alert("Age should be 18 yrs old and above.");
							return false;
						}
						
						else if (( document.getElementById("name_jobPostingSearchReligion").value=="Others" ) && ( document.getElementById("name_jobPostingReligionOthers").value=="" ))
						{
							alert("Please enter Religion.");
							return false;
						}
						
						else if (( document.getElementById("name_jobPostingSearchNationality").value=="Others" ) && ( document.getElementById("name_jobPostingNationalityOthers").value=="" ))
						{
							alert("Please enter Nationality.");
							return false;
						}
						
						else if ( (document.getElementById("name_jobPostingHeightAny").checked==false) && ( (parseInt(document.getElementById("name_jobPostingHeightFrom").value)) > (parseInt(document.getElementById("name_jobPostingHeightTo").value)) ) )
						{
							alert("Invalid Height Range.");
							return false;
						}
						
						else if ((document.getElementById("name_jobPostingHeightAny").checked==false) && ((document.getElementById("name_jobPostingHeightFrom").value=="") && (document.getElementById("name_jobPostingHeightTo").value=="") ) )
						{
							alert("Please enter Height Range.");
							return false;
						}
						
						
						else if ( (document.getElementById("name_jobPostingWeightAny").checked==false) && ( parseInt(document.getElementById("name_jobPostingWeightFrom").value) > parseInt(document.getElementById("name_jobPostingWeightTo").value)) )
						{
							alert("Invalid Weight Range.");
							return false;
						}
						
						else if ((document.getElementById("name_jobPostingWeightAny").checked==false) && ((document.getElementById("name_jobPostingWeightFrom").value=="") && (document.getElementById("name_jobPostingWeightTo").value=="") ) )	
						{
							alert("Please enter Weight Range.");
							return false;
						}
						
						
					}//function
						
	</script>

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
		    <li><a href="job.php">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd.php">Add Job</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li>Job Qualifications</li>
		</ul>
	</div>

	

	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
		
		<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="maintenanceClientAdd.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Add Job</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="jobUpdate.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update Job</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="job.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span> Job</a></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">Fill up the form with job's complete information. 
				Fields with asterisk (*) are required. </h4> 		
			<br /><br />
			<div class='container-fluid content'>	
				<div class="col-md-12">
					
					<form name="formDropdown" method="GET" action="#">			

						
								<div class="form-group col-md-12">
						
										
									</div>
								
								<legend><a href="#">Client</a></legend>

						<div class="form-group col-md-6">
							<?php	
							
								$clientId = "";
								$clientName = "";
									
								$jobName  = array();
									
								echo "<input type='hidden' name='token' value='$main' />";	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error());
								}
								mysql_select_db("$db_database", $con);
								
								$result = mysql_query("SELECT * FROM tbl_client ORDER BY clientName");
															
								
							?>
							<select type="position" class="form-control" id="name_clientDropDown" name="name_clientDropDown" autofocus onChange="document.forms['formDropdown'].submit()">
							<option value="" selected>Select Client</option>
							<?php		
								while ($row = mysql_fetch_array($result))
								{
									echo "<option value='" . $row['clientId'] . "'> " . $row['clientName'] . " </option>";
								}
								echo "</select>"; 
								
								
						if (isset($_GET['name_clientDropDown']))
						{
							if($_GET['name_clientDropDown']!="")
							{
							
								$result = mysql_query("SELECT *
															FROM tbl_client
															WHERE clientId = $_GET[name_clientDropDown]
															");
															
								while ($row = mysql_fetch_array($result))
								{
								
									$clientId = $row['clientId'];
									$clientName = $row['clientName'];
								}//while
								
								
								$result = mysql_query("SELECT * FROM tbl_job_posting LEFT JOIN tbl_client ON tbl_client.clientId = tbl_job_posting.clientId WHERE tbl_job_posting.jobStatus = 1
							AND tbl_client.clientId = $clientId");
												
								$ctr = 0;
								while($row = mysql_fetch_array($result)) 
								{
									$jobName[$ctr] = $row['jobName'];
									$ctr++;
								}
								
								

								//echo" clientID: $clientId </br> clientName: $clientName";
								
								
								
								if (mysql_num_rows($result) > 0) 
								{
									echo'
									</br>
									Available Jobs in '.$clientName.'
									</br>
									';
									$ctr =0;
									echo"<ul>";
									while(isset($jobName[$ctr]) &&($jobName[$ctr]!="")) 
									{
										echo"
										</br>$jobName[$ctr]";
										
										$ctr++;
									}//while
									echo"</ul>";
								}//
								else
								{
									echo "</br>Currently there are no available jobs in $clientName";
								}
								
									$ctr =0;	
							echo"	
							<select type='jobtitle' class='form-control' id='name_JobsAvailable' name='name_JobsAvailable' style='display: none;'>";
								
								while (isset($jobName[$ctr]) &&($jobName[$ctr]!=""))
								{
									echo"<option value='".$jobName[$ctr]."'> " . $jobName[$ctr] . " </option>";
									
									$ctr++;
								}
								
							echo"
							</select>
							";
							
							echo"
							<script type = 'text/javascript'>
							
							
										window.name_JobsAvailableArray= new Array();
										var name_JobsAvailable = document.getElementById('name_JobsAvailable');
										for (i = 0; i < name_JobsAvailable.options.length; i++) {
										   window.name_JobsAvailableArray[i] = name_JobsAvailable.options[i].value;
										}
									
							</script>
							";
								
							}
						}// if set
								
							?>
							
						</div>
						
						
						<div class="form-group col-md-6"></div>
						<br />
						
						
						
				
				</form>
				
				
				<form name="formAddJobPosting" method="POST" action="../../../config/insertJobQualifications.php" onsubmit=" return formValidation()">
					
					<input type="hidden" name="name_searchClient" value="<?php echo $clientId?>" />
					
						<div class='form-group col-md-12'></div>
								
					<legend><a href="#">Job Title *</a></legend>
								
								
						<div class="form-group col-md-6">
							<?php	
									
									$result = mysql_query("SELECT DISTINCT jobName FROM tbl_job_posting ORDER BY jobName");
																
									
							?>
								
							<select type="jobtitle" class="form-control" id="name_searchJob" name="name_searchJob" onChange="enableTextbox()">
							<option value="general">Select Job</option>
							<?php		
								while ($row = mysql_fetch_array($result))
								{
									echo "<option value='" . $row['jobName'] . "'> " . $row['jobName'] . " </option>";
								}
								
							?>
							<option value="others">Others</option>
							</select>
								
								
							<script type = "text/javascript">
								function enableTextbox() {
								
										if (document.getElementById("name_searchJob").value == "others")
										{
										document.getElementById("name_jobPostingTitleOthers").disabled = false;
										document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"please specify a Job");
										document.getElementById("name_searchJob").disabled = true;
										document.getElementById("SelectFromList").style.display = "block";
										document.getElementById("nameAdd_jobPostingProceed").style.display = "block";
										}
										else
										{
										document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"Others, please specify");
										}
										
										window.name_JobsAvailableArray.toString();
										
										//alert(document.getElementById("name_searchJob").value+" <- value ng ddJobs");
										
										
										for (i = 0; i < window.name_JobsAvailableArray.length; i++) {
										
										   if(window.name_JobsAvailableArray[i]==document.getElementById("name_searchJob").value)
										   {
										   alert("This job is already posted. Please select another job.");
										   document.getElementById("name_searchJob").selectedIndex = 0;
										   break;
										   }//
										}
										
										
										
									}
						
									function enableList(){
									
									document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"Others, please specify");
									document.getElementById("name_jobPostingTitleOthers").disabled = true;
									document.getElementById("name_searchJob").disabled = false;
									document.getElementById("name_searchJob").selectedIndex = 0;
									document.getElementById("SelectFromList").style.display = "none";
									document.getElementById("nameAdd_jobPostingProceed").style.display = "none";
									
									
									}
								</script>
								
							</div>
							
							
							
							<div class="form-group col-md-3">
								<input type="text" 
										class="form-control" 
										name="name_jobPostingTitleOthers" 
										id="name_jobPostingTitleOthers"
										value=''
										maxlength="100" 
										placeholder="Others, please specify"
										disabled
								/>
							</div>


							<div class="form-group col-md-3">
		
								<button class="btn btn-primary btn-md btn-block" 
										type="button" 
										name="SelectFromList" 
										id="SelectFromList" 
										style="display:none;" 
										onclick="enableList()">
										<span class="glyphicon glyphicon glyphicon-list"></span>&nbsp; Select job from the list
								</button>
								<br /><br /><br />
							</div>
									
						
									
									<div class="form-group col-md-3">
										<label> Job Vacancy: * </label>
										<input type="number" 
											class="form-control" 
											name="name_jobVacancy" 
											value='' 
											maxlength="13"
											placeholder="" 
											id="name_jobVacancy"
											required
									/>
									</div>
									
									
									
									<div class="form-group col-md-6">
										<label> Monthly salary: *</label>
										<input type="text" 
											autofocus="autofocus"
											class="form-control" 
											name="name_jobPostingExpectedMonthlySalary" 
											value='' 
											maxlength="13"
											placeholder="" 
											id="name_jobPostingExpectedMonthlySalary"
											required
									/>
									</div>
									
									<div class="form-group col-md-3">
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
											Gender: 
										</label>
											<select type="position" 
													class="form-control"  
													id="name_jobPostingGender"
													name="name_jobPostingGender">
													<option value="Any"  selected>Male/Female</option>
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
												<option value="Any" selected>Any</option>
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
										<label for="appHeight">Age Range (from): *</label>
										<input type="number" 
												class="form-control" 
												name="name_jobPostingAgeFrom" 
												value='' 
												maxlength="2"
												id="name_jobPostingAgeFrom"

												placeholder="Age From" 
												required
										/>
									</div>
									
									<div class="form-group col-md-2">
										<label for="appHeight">Age Range (to): *</label>
										<input type="number" 
												class="form-control" 
												name="name_jobPostingAgeTo" 
												value='' 
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
									
									
								</script> 
						<!--------------  //CURRENCY	------------------>
								
							
							
								
						<div class="form-group col-md-6">
						<label>Religion: </label>
						
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
					<option value="Any" selected>Any</option>
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
									style="margin-top:.5em;"
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
							<label>Nationality: </label>

						
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
					<option value="Any" selected>Any</option>
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
										style="margin-top:.5em;"
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
												<input type="number"
														class="form-control" 
														name="name_jobPostingHeightFrom" 
														id="name_jobPostingHeightFrom"
														value='' 
														maxlength="3" 
														placeholder="Height from" 
														disabled
												/>
												</div>
											
											<div class="col-md-2">
											<label>
												Up to:
											</label>
											<input type="number"
													class="form-control" 
													name="name_jobPostingHeightTo" 
													id="name_jobPostingHeightTo"
													value='' 
													maxlength="3" 
													placeholder="Up to" 
													disabled
													
											/>
											</div>
											
											<div class="col-md-1">
											<label>
												Any
											</label>
											<br />
											<input type='checkbox' value="Any" checked="checked" 
													style="margin-left:.3em; margin-top:.75em;"
													name='name_jobPostingHeightAny' id='name_jobPostingHeightAny' onclick='enableHeightTextbox(this.checked)' >
											</div>
											
											<script language='JavaScript'>
										

										function enableHeightTextbox(status)
										{
										status=!status;	
										document.getElementById('name_jobPostingHeightFrom').disabled = !status;
										document.getElementById('name_jobPostingHeightTo').disabled = !status;
										document.getElementById("name_jobPostingHeightFrom").value = "";
										document.getElementById("name_jobPostingHeightTo").value = "";
										}
										
										</script>
										
										
										<div class="col-md-12"><br /></div>
										
										
										
									
										<div class="col-md-2">
										<label>
												Weight (kg) from:
											</label>
											<input type="number"
													class="form-control" 
													name="name_jobPostingWeightFrom" 
													id="name_jobPostingWeightFrom"
													value='' 
													maxlength="3" 
													placeholder="Weight from" 
													disabled
											/>
											</div>
										
											<div class="col-md-2">
											<label>
												Up to:
											</label>
											<input type="number"
													class="form-control" 
													name="name_jobPostingWeightTo" 
													id="name_jobPostingWeightTo"
													value='' 
													maxlength="3" 
													placeholder="Up to" 
													disabled
											/>
											</div>
											
											<div class="col-md-1">
												<label>
													Any
												</label>
												<br />
												<input type='checkbox' value="Any" checked="checked" 
														style="margin-left:.3em; margin-top:.75em;"
														 name='name_jobPostingWeightAny' id='name_jobPostingWeightAny' onclick='enableWeightTextbox(this.checked)' > 
											</div>
										
										<script language='JavaScript'>
										

										function enableWeightTextbox(status)
										{
										status=!status;	
										document.getElementById('name_jobPostingWeightFrom').disabled = !status;
										document.getElementById('name_jobPostingWeightTo').disabled = !status;
										document.getElementById("name_jobPostingWeightFrom").value = "";
										document.getElementById("name_jobPostingWeightTo").value = "";
										}
										
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
											name = "submitForm" 
											id = "submitForm"  
											style="margin-top: 2em;"  
											
											>
											Next &nbsp;
											<span class="glyphicon glyphicon-chevron-right"></span>
											</button>
									</div>
									
									<div class="form-group col-md-4">
									</div>

										
				</form>
									
								
								
					</div>
		</div>


<br /><br /><br />

<?php
	include ('../footer.php');
?>