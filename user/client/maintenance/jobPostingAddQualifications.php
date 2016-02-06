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
						el.focus();         
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
		    <li><a href="jobPostingAdd.php?token=<?php echo $main; ?>">Add Job</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li>Job Qualifications</li>
		</ul>
	</div>

	

	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
			<h4 class="alert-info well-lg">Add job qualifications.</h4> 		
			<br /><br />
			<div class='container-fluid content'>	
				<div class="col-md-12"><br />
					<form method="POST" action="../../../config/insertJobQualificationsFromClient.php">
									
								<div class="form-group col-md-12">
						
										
									</div>
									
								<?php	
								
								
								$addJobPostingJobID= '';
								$addJobPostingJobName = '';
								
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
												if (!$con)
												{
													die('Could not connect: ' . mysql_error()); 
												}
												mysql_select_db("$db_database", $con);
											if(isset($_SESSION["ses_jobPostingID"]))
											{
												$query = mysql_query("SELECT * FROM tbl_job_posting WHERE ".$_SESSION["ses_jobPostingID"]."");
												
												// display query results
												while($row = mysql_fetch_assoc($query))
												{
													$addJobPostingJobID = $row['jobPostingId'];
													$addJobPostingJobName = $row['jobName'];
													$addJobPostingClientID = $row['clientId'];
												}//while
												
												
												
											}//if
												mysql_close($con);
									
									?>
									
								<div class="form-group col-md-6">
										<label>Job Title:</label>
										<input type="text" 
												class="form-control" 
												name="name_jobPostingName" 
												id="name_jobPostingName"
												value='<?php echo $addJobPostingJobName ?>'
												maxlength="100" 
												placeholder="Job Name"
												disabled = true
										/>
										</div>

										<div class="form-group col-md-6">
										</div>
									
									<div class="form-group col-md-12">
									</div>	
									
									<div class="form-group col-md-6">
										<label> Monthly salary: </label>
										<input type="text" 
											class="form-control" 
											name="name_jobPostingExpectedMonthlySalary" 
											value='' 
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
										<label for="appHeight">Age Range (from):</label>
										<input type="text" 
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
										<label for="appHeight">Age Range (to):</label>
										<input type="text" 
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
							<label>Religion: *</label>
							<?php	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error());
								}
							
								mysql_select_db("$db_database", $con);
								$result = mysql_query("SELECT DISTINCT jobQualiDescription FROM tbl_job_quali WHERE jobQualiType = 'Religion'");
															
								echo "<select type='position' class='form-control' id='name_jobPostingSearchReligion' name='name_jobPostingSearchReligion' onchange = 'enableTextboxReligion()'>";
							?>
							<option value="Any" selected>Any</option>
									<?php		
										while ($row = mysql_fetch_array($result))
										{
											if (($row['jobQualiDescription']!='Any') && ($row['jobQualiDescription']!='Others'))
											{
											echo "<option value='" . $row['jobQualiDescription'] . "'> " . $row['jobQualiDescription'] . " </option>";
											}//if
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
										$result = mysql_query("SELECT DISTINCT jobQualiDescription FROM tbl_job_quali WHERE jobQualiType = 'Nationality'");
																	
										echo "<select type='position' class='form-control' id='name_jobPostingSearchNationality' name='name_jobPostingSearchNationality' onchange = 'enableTextboxNationality()'>";
							?>
							<option value="Any" selected>Any</option>
							<!--<option value="any">Any</option>-->
							<?php		
								while ($row = mysql_fetch_array($result))
								{
									if (($row['jobQualiDescription']!='Any') && ($row['jobQualiDescription']!='Others'))
									{
									echo "<option value='" . $row['jobQualiDescription'] . "'> " . $row['jobQualiDescription'] . " </option>";
									}//if
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
											<input type="text"
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
											<input type="text"
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
											<input type="text"
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
	</div>


<br /><br /><br />

<?php
	include ('../footer.php');
?>