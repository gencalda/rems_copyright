<?php
	/*include('guestLink.php');
	include ('../../../include/header.php');
	include ('guestNav.php');
	include ('../../../config/connection.php');
	*/
	$root = realpath(dirname(__FILE__) . '/../../..');
	//include($root . '/include/linkTwo.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../guestNav.php'); // native to admin
?>

<?php

	$appQualityGender = '';
	$appQualityCivilStatus = '';
	$appQualityHeight = '';
	$appQualityWeight = '';
	$appQualitySearchReligion = '';
	$appQualitySearchNationality = '';
	
	$appLanguages = array();
	$appLanguagesStr = '';
	$religionJobApp = array();
	$nationalJobApp = array();
	$religionJobAppUnique = array();
	$nationalJobAppUnique = array();
	
	$selectedMonth = 'Month';
	$selectedDay = 'Day';
	$selectedYear = 'Year';
	$selectedCivilStatus = 'Select Civil Status';
	$selectedReligion = 'Select Religion';
	$selectedNationality = 'Select Nationality';


	if (isset($_SESSION['ses_applyPage2'])) 
		{
		
			/*$con = mysql_connect("$db_hostname","$db_username","$db_password");
			
			if (!$con)
			{
				die('Could not connect: ' . mysql_error()); 
			}
			mysql_select_db("$db_database", $con);*/
			
			$query = mysql_query("SELECT * FROM appInformation WHERE applicantID = '".$_SESSION['ses_applicantID']."'");
			// display query results
			
			while($row = mysql_fetch_array($query))
			{
				$appBirthday1 = $row['appInfoBirthday'];
			}
			$appBirthday = strtotime($appBirthday1);
			$selectedYear = date("Y", $appBirthday);
			$selectedMonth = date("M", $appBirthday);
			$selectedDay = date("d", $appBirthday);
			
			$resultApp = mysql_query("SELECT * FROM appQualities WHERE applicantID = '".$_SESSION['ses_applicantID']."'");
			// display query results
			
			while($rowApp = mysql_fetch_array($resultApp)) 
			{
				if ($rowApp['appQualityType']=='gender')
				$appQualityGender = $rowApp['appQualityDesc'];
				
				if ($rowApp['appQualityType']=='civil status')
				$appQualityCivilStatus = $rowApp['appQualityDesc'];
				
				if ($rowApp['appQualityType']=='height')
				$appQualityHeight =  $rowApp['appQualityDesc'];
				
				if ($rowApp['appQualityType']=='weight')
				$appQualityWeight =  $rowApp['appQualityDesc'];
				
				if ($rowApp['appQualityType']=='religion')
				$appQualitySearchReligion = $rowApp['appQualityDesc'];
				
				if ($rowApp['appQualityType']=='nationality')
				$appQualitySearchNationality = $rowApp['appQualityDesc'];
			}
		
			$appQualityGender = strtolower($appQualityGender);
			$selectedCivilStatus = $appQualityCivilStatus;
			$selectedReligion = $appQualitySearchReligion;
			$selectedNationality = $appQualitySearchNationality;
			
			
			//for language
			$resultAppLanguages = mysql_query("SELECT *
															FROM  appqualities 
															WHERE appQualityType = 'language'
															AND applicantID = '".$_SESSION['ses_applicantID']."'
															");
			
					
								$ctr=0; 	// counter
				
								while($rowAppLanguages = mysql_fetch_array($resultAppLanguages)) 
								{
									$appLanguages[$ctr] = $rowAppLanguages['appQualityDesc'];
									$ctr++;
								}
								
								$appLanguagesStr  = implode(', ',$appLanguages);
			
		}//isset

?>
	
			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Personal Information</li>
				</ul>
			</div>

	
			<div class="container-fluid" id='personal'>
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">
						Instructions: Fill up the form with complete information. <br />
						Fields with asterisk (*) are required.
					</h4> 		
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:10%">
							    10% Complete
							  </div>
						</div>
					</div>

					<form method="POST" action="../../../config/insertPersonalInformation.php" name = "myForm" onsubmit = "return validateForm()">
			
						<legend>Personal Data</legend>
					<br/ >
								
									
									
				<div class="form-group col-md-2" style="padding-top: .2em;">
					<label>
						Birthday: *
					</label>
						<select type="position" 
								class="form-control"  
								id="month"
								onchange="validateMonth();"
								name="month">
								<option value="<?php echo $selectedMonth ?>" selected><?php echo $selectedMonth ?></option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
						 </select>
				</div>							
									
				<div class="form-group col-md-2" style="padding-top: 2em;">
					<?php
						for ($i = 1; $i <= 31; $i++)
						{
						$arDays[] = $i;
						}
						echo '<select name="day" id="day" onchange="validateDay();" class="form-control" >
						<option value='.$selectedDay.' selected>'.$selectedDay.'</option>';
						foreach ($arDays as $option) {
							echo '<option value="'.$option.'">'.$option.'</option>';
						}
						echo '</select>';
					?>
				</div>

				<div class="form-group col-md-2" style="padding-top: 2em;">
					<?php
						$currentYear = date("Y");
						for ($i = $currentYear; $i >= 1930; $i--)
						{
						$arYears[] = $i;
						}
						echo '<select name="year" id="year" onchange="validateYear();" class="form-control" >
						<option value='.$selectedYear.' selected>'.$selectedYear.'</option>';
						foreach ($arYears as $option) {
							echo '<option value="'.$option.'">'.$option.'</option>';
						}
						echo '</select>';
					?>
				</div>	

				<div class="form-group col-md-6">
					<label> Place of Birth: * </label>
					<input type="text" 
							class="form-control" 
							name="name_personalPlaceOfBirth" 
							maxlength="250"
							id="name_personalPlaceOfBirth"
							onchange ="validateBplace();" 
							title="Quezon City"
							required
							 
					/>
				</div>

				<div class="col-md-12">
				</div>

				<div class="form-group col-md-2">
					<label>
						Gender: *
					</label>
						<select type="position" 
								class="form-control"  
								id="name_personalGender"
								name="name_personalGender">
								<option value="Male" selected>Male</option>
								<option value="Female">Female</option>
						 </select>
				</div>	

				<div class="form-group col-md-2">
					<label for="name_appQualityHeight">Height (in Meters): *</label>
					<input type="text"  
							class="form-control" 
							name="name_personalHeight" 
							value='<?php echo $appQualityHeight?>' 
							maxlength="4"
							id="name_personalHeight"
							onchange="validateHeight();"
							title="5.6"
							required
					/>
				</div>
						
				<div class="form-group col-md-2">
					<label >Weight (in kg): *</label>
						<input type="text" 
								class="form-control" 
								name="name_personalWeight" 
								value='<?php echo $appQualityWeight?>' 
								maxlength="3" 
								id="name_personalWeight"
								onchange="validateWeight();"
								title="65"
								required
						/>
				</div> 


				<div class="form-group col-md-6">
					<label >Civil Status: *</label>
					<select type="appCivilStatus" 
							class="form-control"  
							onchange="validateCivil();"
							id="name_personalCivilStatus"
							name="name_personalCivilStatus">
							<option value="<?php echo $selectedCivilStatus ?>" selected><?php echo $selectedCivilStatus ?></option>
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="Widowed">Widowed</option>
							<option value="Legally Separated">Legally Separated</option>
							<option value="Annulled">Annulled</option>
					 </select>
				</div>	
									
									
									
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
													
						echo "<select type='religion' onchange='validateReligion();' class='form-control' id='name_personalSearchReligion' name='name_personalSearchReligion' onchange = 'enableTextboxReligion()'>";
					?>
					<option value="<?php echo $selectedReligion ?>" selected><?php echo $selectedReligion ?></option>
							<!--<option value="any">Any</option> -->
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
							name="name_personalReligionOthers" 
							id="name_personalReligionOthers"
							value=''
							onchange="validateReligionOthers();"
							maxlength="250" 
							style="margin-top:.3em;"
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
						<span class="glyphicon glyphicon glyphicon-list"></span>&nbsp; Select religion from the list
					</button>
				</div>	
							
				<div class="form-group col-md-12">
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
						
													
								echo "<select type='position' class='form-control' onchange='validateNationality();' id='name_personalSearchNationality' name='name_personalSearchNationality' onchange = 'enableTextboxNationality()'>";
					?>
					<option value="<?php echo $selectedNationality ?>" selected><?php echo $selectedNationality ?></option>
					<!--<option value="any">Any</option>-->
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
								name="name_personalNationalityOthers" 
								id="name_personalNationalityOthers"
								value=''
								maxlength="250" 
								onchange="validateNationalityOthers();"
								style="margin-top:.3em;"
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
							<span class="glyphicon glyphicon glyphicon-list"></span>&nbsp; Select nationality from the list
					</button>
				</div>	
							
				<script type = "text/javascript">
				
				
				function enableTextboxReligion() {
				if (document.getElementById("name_personalSearchReligion").value == "Others") {
				document.getElementById("name_personalReligionOthers").disabled = false;
				document.getElementById("name_personalReligionOthers").setAttribute('placeholder',"Please specify Religion");
				document.getElementById("name_personalSearchReligion").disabled = true;
				document.getElementById("SelectReligionFromList").style.display = "block";

				}
				
				}
				
				function enableListReligion(){
				document.getElementById("name_personalReligionOthers").disabled = true;
				document.getElementById("name_personalSearchReligion").disabled = false;
				document.getElementById("name_personalSearchReligion").selectedIndex = 0;
				document.getElementById("SelectReligionFromList").style.display = "none";
				document.getElementById("name_personalReligionOthers").setAttribute('placeholder',"Others, please specify");
				document.getElementById("name_personalReligionOthers").value = "";
				}
				
				function enableTextboxNationality() {
				if (document.getElementById("name_personalSearchNationality").value == "Others") {
				document.getElementById("name_personalNationalityOthers").disabled = false;
				document.getElementById("name_personalNationalityOthers").setAttribute('placeholder',"Please specify Nationality");
				document.getElementById("name_personalSearchNationality").disabled = true;
				document.getElementById("SelectNationalityFromList").style.display = "block";
				
				}
				
				}
				
				function enableListNationality(){
				document.getElementById("name_personalNationalityOthers").disabled = true;
				document.getElementById("name_personalSearchNationality").disabled = false;
				document.getElementById("name_personalSearchNationality").selectedIndex = 0;
				document.getElementById("name_personalNationalityOthers").setAttribute('placeholder',"Others, please specify");
				document.getElementById("SelectNationalityFromList").style.display = "none";
				document.getElementById("name_personalNationalityOthers").value = "";
				}
				
				
					function disableListNationality(status)
					{
		
					document.getElementById('name_personalSearchNationality').disabled = status;
					if (status==false)
					{
					document.getElementById('name_personalNationalityOthers').disabled = !status;
					}
					else
					{document.getElementById('name_personalNationalityOthers').disabled = status;}
					document.getElementById("name_personalSearchNationality").selectedIndex = 0;
					document.getElementById("name_personalNationalityOthers").value = "";
					}
					
					function disableListReligion(status)
					{
		
					document.getElementById('name_personalReligionOthers').disabled = status;
					if (status==false)
					{
					document.getElementById('name_appQualityReligionOthers').disabled = !status;
					}
					else
					{document.getElementById('name_appQualityReligionOthers').disabled = status;}
					document.getElementById("name_personalReligionOthers").selectedIndex = 0;
					document.getElementById("name_personalReligionOthers").value = "";
					}
					
				</script>
					
							
							
				<div class="col-md-12"></div>
							
				<div class="form-group col-md-12">
				</div>
								
				<div class="form-group col-md-2 col-md-offset-3">
				<button type="button" 
										class="btn btn-primary btn-md btn-block"
										name ="btnCancel" 
										id = "btnCancel" 
										style="margin-top: 2em;"
										onClick="location.href='../../config/cancelAppForm.php'" >
										Cancel
				</button>
				</div>    
								
				<div class="form-group col-md-2">

					<button type="button" 
									class="btn btn-primary btn-md btn-block"
									name ="familyPrev" 
									id = "familyPrev" 
									style="margin-top: 2em;"
									onClick="location.href='basicInformation.php'" >
			      				<span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Previous
			      			</button>

						

				</div>
				<div class="form-group col-md-2">
				
					<button type="submit" 
							class="btn btn-primary btn-md btn-block"
							name ="personalNext" 
							id = "personalNext" 
							disabled="true"
							style="margin-top: 2em;">
	      				 Next &nbsp;
								 <span class="glyphicon glyphicon-chevron-right"></span>
	      			</button>
	      		</div>
				
	</form>
				</div>
			</div>

<?php
 	include('../footer.php');
 ?> 