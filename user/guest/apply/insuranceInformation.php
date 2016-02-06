<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
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
					<li class="active">Insurance Information</li>
				</ul>
			</div>

			<div class="container-fluid" id="insurance">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
							Fields with asterisk (*) are required.</h4> 		
					
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:40%">
							    40% Complete
							  </div>
						</div>
					</div>
					<form method="POST" action="../../../config/insertAppInsuranceInformation.php" name="insuranceForm" >
			
		
								<legend>Insurance Information</legend>
								<br/ >
												
								<div class="form-group col-md-4">
									<label>Name of Beneficiary: *</label>
									<input type="text" 
											class="form-control" 
											name="name_appInfoBeneficiaryName" 
											id="name_appInfoBenifeciaryName"
											maxlength="250"   
											style="text-transform: capitalize;" 
											title="Ax'l Daniel Kim"
											value=""										
											onchange="ValidateBenName()"
									/>
								</div>
											
						
								<div class="form-group col-md-4">
									<label >Address:</label>
									<input type="text" 
											class="form-control" 
											name="name_appInfoBenificiaryAddress" 
											value='' 
											maxlength="100" 
											id="name_appInfoBenificiaryAddress"
											style="text-transform: capitalize;" 
											title="143 Pureza St., Sta. Mesa, Manila"
											onchange="ValidateBenAdd()"
									/>
								</div>
											
								<div class="form-group col-md-4">
									<label>Relationship: *</label>
									<input type="text" 
											class="form-control" 
											name="name_appInfoBenificiaryRelationship" 
											value='' 
											maxlength="250"
											id="name_appInfoBenificiaryRelationship"
											style="text-transform: capitalize;" 
											required
											onchange="ValidateBenRel()"
									/>
								</div>
													
								<div class="form-group col-md-2" style="padding-top: .2em;">
									<label>
										Birthday: *
									</label>
										<select type="position" 
												class="form-control"  
												id="month"
												onchange="ValidateBenMonth()"
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
										echo '<select name="day" onchange="ValidateBenDay()" class="form-control" >
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
										echo '<select name="year"  onchange="ValidateBenYear()" class="form-control" >
										<option value='.$selectedYear.' selected>'.$selectedYear.'</option>';
										foreach ($arYears as $option) {
											echo '<option value="'.$option.'">'.$option.'</option>';
										}
										echo '</select>';
									?>
								</div>	

								


								<div class="form-group col-md-2">
									<label>
										Gender: *
									</label>
										<select type="position" 
												class="form-control"  
												id="name_appInfoBenificiaryGender"
												name="name_appInfoBenificiaryGender">
												<option value="Male" selected>Male</option>
												<option value="Female">Female</option>
										 </select>
								</div>	

								
												
							

								<div class="form-group col-md-4">
									<label>Civil Status: *</label>
									<select type="appCivilStatus" 
											class="form-control"  
											id="name_appInfoBenificiaryCivilStatus"
											name="name_appInfoBenificiaryCivilStatus"
											onchange="ValidateBenCivil()">
											<option value="<?php echo $selectedCivilStatus ?>" selected><?php echo $selectedCivilStatus ?></option>
											<option value="Single">Single</option>
											<option value="Married">Married</option>
											<option value="Widowed">Widowed</option>
											<option value="Legally Separated">Legally Separated</option>
											<option value="Annulled">Annulled</option>
									 </select>
								</div>	

						
								

									
												
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
													onClick="location.href='apply1.php'" >
							      				<span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Previous
							      			</button>

										

								</div>
								<div class="form-group col-md-2">
								
									<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="insuranceNext" 
											id = "insuranceNext" 
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
