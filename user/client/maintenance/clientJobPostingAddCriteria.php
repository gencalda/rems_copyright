<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
?>

	<script type="text/javascript">  
	 
	function doCalc(form) {  
			var ctr = 0;
			  form.criteria_percentageLeft.value = "100";
			  
			  
			   var languageArr = document.getElementsByName("criteria_language[]");
			  while (ctr < languageArr.length)
			  {
				languageArr[ctr].value = languageArr[ctr].value.replace('%','');
				ctr++;
			  }
			  
			  ctr=0;
			  var qualityArr = document.getElementsByName("criteria_quality[]");
			  while (ctr < qualityArr.length)
			  {
				qualityArr[ctr].value = qualityArr[ctr].value.replace('%','');
				ctr++;
			  }
			  
			  form.criteria_gender.value = form.criteria_gender.value.replace('%','');
			  form.criteria_age.value = form.criteria_age.value.replace('%','');
			  form.criteria_civilStatus.value = form.criteria_civilStatus.value.replace('%','');
			  form.criteria_expectedSalary.value = form.criteria_expectedSalary.value.replace('%','');
			  form.criteria_religion.value = form.criteria_religion.value.replace('%','');
			  form.criteria_nationality.value = form.criteria_nationality.value.replace('%','');
			  form.criteria_height.value = form.criteria_height.value.replace('%','');
			  form.criteria_weight.value = form.criteria_weight.value.replace('%','');
			  
			 
			  //gender
			  if (!isNaN(form.criteria_gender.value) && (form.criteria_gender.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_gender.value);  
				form.criteria_gender.value = form.criteria_gender.value +"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for gender.");
			  }
			  
			  //age
			  if (!isNaN(form.criteria_age.value) && (form.criteria_age.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_age.value);  
				form.criteria_age.value = form.criteria_age.value +"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for age.");
			  }
			  
			  
			  //civil status
			  if (!isNaN(form.criteria_civilStatus.value) && (form.criteria_civilStatus.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_civilStatus.value);  
				form.criteria_civilStatus.value = form.criteria_civilStatus.value+"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for civil status.");
			  }
			  
			  //expected salary
			  if (!isNaN(form.criteria_expectedSalary.value) && (form.criteria_expectedSalary.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_expectedSalary.value);  
				form.criteria_expectedSalary.value = form.criteria_expectedSalary.value+"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for expected salary.");
			  }
			  
			  //religion
			  if (!isNaN(form.criteria_religion.value) && (form.criteria_religion.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_religion.value);  
				form.criteria_religion.value = form.criteria_religion.value+"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for religion.");
			  }
			  
			  //nationality
			  if (!isNaN(form.criteria_nationality.value) && (form.criteria_nationality.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_nationality.value); 
				form.criteria_nationality.value = form.criteria_nationality.value+"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for nationality.");
			  }
			  
			  //height
			  if (!isNaN(form.criteria_height.value) && (form.criteria_height.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_height.value);  
				form.criteria_height.value = form.criteria_height.value+"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for height.");
			  }
			  
			  //weight
			  if (!isNaN(form.criteria_weight.value) && (form.criteria_weight.value!=""))
			  {
				form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(form.criteria_weight.value); 
				form.criteria_weight.value= form.criteria_weight.value+"%";
			  }
			  else
			  {
				alert("Please enter a valid percentage for weight.");
			  }
			  
			  
			  //language
			  ctr = 0;
			  while (ctr < languageArr.length)
			  {
				//languageArr[ctr].value = languageArr[ctr].value.replace('%','');
				if (!isNaN(languageArr[ctr].value) && (languageArr[ctr].value!=""))
				  {
					form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(languageArr[ctr].value); 
					languageArr[ctr].value = languageArr[ctr].value+"%";
				  }
				  else
				  {
					alert("Please enter a valid percentage for language.");
				  }
				ctr++;
			  }
			  
			
			
			  
			  //quality
			    ctr = 0;
			  while (ctr < qualityArr.length)
			  {
			 qualityArr[ctr].value = qualityArr[ctr].value.replace('%','');
				if (!isNaN(qualityArr[ctr].value) && (qualityArr[ctr].value!=""))
				  {
					form.criteria_percentageLeft.value = parseFloat(form.criteria_percentageLeft.value) - parseFloat(qualityArr[ctr].value); 
					qualityArr[ctr].value = qualityArr[ctr].value+"%";
				  }
				  else
				  {
					alert("Please enter a valid percentage for skill.");
				  }
				ctr++;
			  }
			
			  
			  form.criteria_percentageLeft.value = form.criteria_percentageLeft.value+"%";
	}//function  
	
	function validation() {

		if (document.getElementById('criteria_percentageLeft').value != "0%")
		{
			alert("Please allocate all the percentage properly.");
			return false;
		}
		
		
	}// validation

	</script>  

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="#">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">Add Job</li>
		</ul>
	</div>

	
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
	$jobGender = "-";
	$jobCivilStatus = "-";
	$jobHeight = "-";
	$jobHeightFrom = "";
	$jobHeightTo = "";
	$jobWeight = "-";
	$jobWeightFrom = "";
	$jobWeightTo = "";
	$jobReligion = "-";
	$jobNationality = "-";
	$jobExpectedSalary = "";
	$jobLanguages = array();
	$jobQualities = array();
	
	$totalJobLanguages = 0;
	$totalJobQualities = 0;
	$percentageLeft = 100;
	
	//-------------------- Job Qualifications ---------------------
		if (isset($_SESSION['ses_jobPostingID']))
		{
			$resultJob = mysql_query("SELECT *
									  FROM  tbl_job_quali
									  WHERE jobPostingId = $_SESSION[ses_jobPostingID]
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
		
	
<div class="container-fluid">
	<form method="POST" action="../../../config/insertJobCriteria.php" onSubmit="return validation();">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
		
			<h2>Set the Criteria for Pairing</h2>
			
			
			<br />
			
			
				<div class="form-group col-md-12">
				
				<div class="form-group col-md-7">
				<!--empty-->
				</div>
				
				
								
				<div class="form-group col-md-2">
				<!--empty-->
				</div>
				
			</div>
			
			<div class="form-group col-md-12">
				
			</div>
			
			<div class="form-group col-md-12">
				
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Gender:</label>
					<h5><?php echo"$jobGender"; ?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Gender:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_gender" 
						id="criteria_gender"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
				
			</div>
			
			
			<div class="form-group col-md-12">
			
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Age:</label>
					<h5><?php echo"$jobAgeFrom yrs. old - $jobAgeTo yrs. old "; ?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Age:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_age" 
						id="criteria_age"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
				
			</div>
			
			
			
			<div class="form-group col-md-12">
				
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Civil Status:</label>
					<h5><?php echo"$jobCivilStatus"; ?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Civil Status:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_civilStatus" 
						id="criteria_civilStatus"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
				
			</div>
			
			
			<div class="form-group col-md-12">
				
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Expected Monthly Salary:</label>
					<h5><?php echo"$jobExpectedSalary"; ?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Expected Salary:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_expectedSalary" 
						id="criteria_expectedSalary"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
				
			</div>
			
			
			<div class="form-group col-md-12">
				
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Religion:</label>
					<h5><?php echo"$jobReligion"; ?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Religion:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_religion" 
						id="criteria_religion"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
				
			</div>
			
			
			<div class="form-group col-md-12">
				
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Nationality:</label>
					<h5><?php echo"$jobNationality"; ?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Nationality:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_nationality" 
						id="criteria_nationality"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
				
			</div>
			
			
			<div class="form-group col-md-12">
			
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Height:</label>
					<h5><?php 
						if($jobHeight=='Any') 
						{		
							echo"Any";
						}
						else
						{
							echo"$jobHeightFrom cm - $jobHeightTo cm ";
						}
						?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Height:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_height" 
						id="criteria_height"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
				
			</div>
			
			
			<div class="form-group col-md-12">
			
				<div class="form-group col-md-3">
				<!--empty-->
				</div>
				
				<div class="form-group col-md-3">
					<label>Weight:</label>
					<h5><?php 
						if($jobWeight=='Any') 
						{		
							echo"Any";
						}
						else
						{
							echo"$jobWeightFrom kg - $jobWeightTo kg";
						}
						?></h5>
				</div>
				
				<div class="form-group col-md-2">
					<label>Percentage for Weight:</label>
					<input type="text" 
						class="form-control" 
						onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
						name="criteria_weight" 
						id="criteria_weight"
						value='0%'
						maxlength="5" 
						placeholder="Percentage"
						onkeyup="doCalc(this.form)"
					/>
				</div>
				
				<div class="form-group col-md-4">
				<!--empty-->
				</div>
			</div>
			
			<?php
				if (isset($_SESSION['ses_jobPostingID']))
				{
				//language	
					$resultJobLanguages = mysql_query("SELECT *
														FROM  tbl_job_quali 
														WHERE jobQualiType = 'Language'
														AND (jobQualiNewlyAdded != 'yes' 
														OR  jobQualiNewlyAdded IS NULL)
														AND jobPostingId = $_SESSION[ses_jobPostingID]
														");
						
								
							$ctr=0; 	// counter
							
							while($rowJobLanguages = mysql_fetch_array($resultJobLanguages)) 
							{
								$jobLanguages[$ctr] = $rowJobLanguages['jobQualiDescription'];
								$ctr++;
							}
											
							$ctr--;
							$totalJobLanguages = $ctr;  // counting starts at 0
							
						
							$ctr=0; 
							echo"
							<div class='form-group col-md-12'>
				
								<div class='form-group col-md-3'>
								</div>
										
								<div class='form-group col-md-3'>
									<label>Language/s:</label> 
								</div>
								<div class='form-group col-md-2'>
								</div>
								
								<div class='form-group col-md-4'>
										
								</div>
								
								
								</div>
									";
									while ($ctr <= $totalJobLanguages)
									{
										echo"
										<div class='form-group col-md-12'>
										<div class='form-group col-md-3'>
								</div>
										<div class='form-group col-md-3'>
										<h5>$jobLanguages[$ctr]</h5>";
										echo"</div>";
										?>
										<div class='form-group col-md-2'>
											<label>Percentage for this Language:</label>
											<input type='text' 
												class='form-control'
												onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%'; doCalc(this.form);}"												
												name='criteria_language[]' 
												id='criteria_language[]'
												value='0%'
												maxlength='5' 
												placeholder='Percentage'
												onkeyup='doCalc(this.form)'
											/>
										</div>
										
										<div class='form-group col-md-4'>
										</div>
									</div>
									<?php
										$ctr++; 
									}//while
									
							
			?>
								
										
				
								
							
			<?php	

				//qualities
					$resultJobQualities = mysql_query("SELECT *
														FROM  tbl_job_quali
														WHERE jobQualiType = 'quality'
														AND (jobQualiNewlyAdded != 'yes' 
														OR  jobQualiNewlyAdded IS NULL)
														AND jobPostingId = $_SESSION[ses_jobPostingID]
														");
						
								
							$ctr=0; 	// counter
							
							while($rowJobQualities = mysql_fetch_array($resultJobQualities)) 
							{
								$jobQualities[$ctr] = $rowJobQualities['jobQualiDescription'];
								$ctr++;
							}
											
							$ctr--;
							$totalJobQualities = $ctr;  // counting starts at 0
							
							$ctr=0; 
							echo"
							<div class='form-group col-md-12'>
				
								<div class='form-group col-md-3'>
								</div>
										
								<div class='form-group col-md-3'>
									<label>Skills:</label> 
								</div>
								<div class='form-group col-md-2'>
								</div>
								
								<div class='form-group col-md-4'>
										
								</div>
								
								
								</div>
									";
							
							while ($ctr <= $totalJobQualities)
									{
										echo"
										<div class='form-group col-md-12'>
										<div class='form-group col-md-3'>
								</div>
										<div class='form-group col-md-3'>
										<h5>$jobQualities[$ctr]</h5>";
										echo"</div>";
										?>
										<div class='form-group col-md-2'>
											<label>Percentage for this Skill:</label>
											<input type='text' 
												class='form-control'
												onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%'; doCalc(this.form);}"												
												name='criteria_quality[]' 
												id='criteria_quality[]'
												value='0%'
												maxlength='5' 
												placeholder='Percentage'
												onkeyup='doCalc(this.form)'
											/>
										</div>
										
										<div class='form-group col-md-4'>
										</div>
									</div>
									<?php
										$ctr++; 
									}//while
				
							
							
		
				}//if 
				else
				{
					echo"
					<div class='form-group col-md-12'>
				
						<div class='form-group col-md-3'>
						</div>
						
						<div class='form-group col-md-3'>
							<label>Languages:</label>
							<h5>-</h5>
						</div>
			";
			?>
						<div class='form-group col-md-2'>
							<label>Percentage for Languages:</label>
							<input type='text' 
								class='form-control' 
								onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
								name='criteria_language' 
								id='criteria_language'
								value='0%'
								maxlength='5' 
								placeholder='Percentage'
								onkeyup='doCalc(this.form)'
							/>
						</div>
						
						<div class='form-group col-md-4'>
						</div>
					</div>
			<?php
					echo"
					<div class='form-group col-md-12'>
				
						<div class='form-group col-md-3'>
						</div>
						
						<div class='form-group col-md-3'>
							<label>Qualities:</label>
							<h5>-</h5>
						</div>
			";
			?>
						<div class='form-group col-md-2'>
							<label>Percentage for Qualities:</label>
							<input type='text' 
								class='form-control' 
								onfocus="javascript:this.value=''" onblur="javascript: if(this.value==''){this.value='0%';}"
								name='criteria_quality' 
								id='criteria_quality'
								value='0%'
								maxlength='5' 
								placeholder='Percentage'
								onkeyup='doCalc(this.form)'
							/>
						</div>
						
						<div class='form-group col-md-4'>
						</div>
					</div>
			<?php		
				}//else
			?>
		
				<div class="form-group col-md-2 col-md-offset-5">
								
					<button type="submit" 
							style="margin-top:2em;"
							class="btn btn-primary btn-md btn-block"
							id = "submitFormClient"
							name ="submitFormClient">
							Submit &nbsp;
						 <span class="glyphicon glyphicon-check"></span>
					</button>
				
			</div>
			
			
		</div>
		
		<div class="form-group col-md-2 col-md-offset-10" style="margin-top:3em; padding-bottom:3em; z-index:5; position:fixed; background-color:#333333; color:#f0f0f0;">
			<h4>Percentage to be Allocated:</h4>
			<input type="text" 
				 
				class="form-control" 
				name="criteria_percentageLeft" 
				id="criteria_percentageLeft"
				value='100%'
				maxlength="5" 
				placeholder="Percentage"
				disabled
			/>
	</div>
	
	</form>

		
</div>


		

<?php
	$_SESSION['ses_jobLanguages'] = $jobLanguages;
	$_SESSION['ses_jobQualities'] = $jobQualities;
	include ('../footer.php');
?>