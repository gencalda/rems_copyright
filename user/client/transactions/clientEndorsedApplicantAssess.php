<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>

<?php

						$appName = '';
						$endorseDecision = '';
						$_SESSION["ses_endorsedID"] = $_GET['endorseID'];
						
						$appDate = '';
						$basicId = '';
						
						
						$addBlock = '';
						$addStreet = '';
						$addSubdivision = '';
						$addBarangay = '';
						$addDistrict = '';
						$addCity = '';
						$addProvince = '';
						$addCountry = '';
						$addZip = '';
						
						$basicLastName = '';
						$basicFirstName = '';
						$basicMiddleName = '';
						$basicExtName = '';
						$basicEmail = '';
						$basicDOB = '';
						$basicBirthplace = '';
						
						$appQualityGender = '';
						$appQualityCivilStatus = '';
						$appQualityHeight = '';
						$appQualityWeight = '';
						$appQualitySearchReligion = '';
						$appQualitySearchNationality = '';
						
						
						$appContactDevice = array();
						$appContactNumber = array();
						
			
							
						
						$familyId = "";
						$familySpouse = "";
						$familySpouseAdd = "";
						$familySpouseJob = "";
						$fatherName = "";
						$fatherJob = "";
						$motherName = "";
						$motherJob = "";
						$emergencyNotifyName = "";
						$emergencyNotifyAddress = "";
						$emergencyNotifyContact	= "";
						
						
						$childName = array();
						$childAge = array();
						$childGender = array();
						$childCivil = array();
								
						
						$benificiaryName = "";
						$benificiaryAdd = "";
						$benificiaryRelationship = "";
						$benificiaryDob = "";
						$benificiaryGender = "";
						$benificaryAge = "";
						$benificiaryCivil = "";	
						
						
						$schoolName = array();
						$schoolLevel = array();
						$schooAddress = array();
						
						
						$schoolName = array();
						$schoolLevel = array();
						$schooAddress = array();


						$companyName = array();
						$workYear = array();
						$workPosition = array();
						$workSalary = array();
						$workSupervisor = array();
						$workLeavingReason = array();

						$positionJobName1 = "";	
						$positionJobName2 = "";	
						$positionJobName3 = "";		
						
						$applicantNotes = "";
						
	
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error()); 
						}
						
						
						mysql_select_db("$db_database", $con);
						
						$result = mysql_query("SELECT *
												FROM tbl_basic_info
												INNER JOIN tbl_applicant
												ON tbl_basic_info.basicId = tbl_applicant.basicId
												WHERE `applicantId` = $_GET[appID]");
						while($row = mysql_fetch_array($result)) 
						{
							$appName = $row['basicLastName'].", ".$row['basicFirstName']." ".$row['basicMiddleName'];
							$appDate = $row['applicantDate'];
							$basicId = $row['basicId'];
						}//while
						
						
						$result = mysql_query("SELECT *
												FROM tbl_endorsement
												WHERE `applicantId` = $_GET[appID]");
						while($row = mysql_fetch_array($result)) 
						{
							$endorseDecision = $row['endorsementDecision'];
						}//while
						
						
						// --------------------------------------------------
						// // // Basic Info, Address
						
						$result = mysql_query("SELECT *
												FROM tbl_basic_info
												LEFT JOIN tbl_address 
												ON tbl_basic_info.basicId = tbl_address.basicId
												WHERE tbl_basic_info.basicId = $basicId");
												
						while($row = mysql_fetch_array($result)) 
						{
							$addBlock = $row['addBlock'];
							$addStreet = $row['addStreet'];
							$addSubdivision = $row['addSubdivision'];
							$addBarangay = $row['addBarangay'];
							$addDistrict = $row['addDistrict'];
							$addCity = $row['addCity'];
							$addProvince = $row['addProvince'];
							$addCountry = $row['addCountry'];
							$addZip = $row['addZip'];
							
							$basicLastName = $row['basicLastName'];
							$basicFirstName = $row['basicFirstName'];
							$basicMiddleName = $row['basicMiddleName'];
							$basicExtName = $row['basicExtName'];
							$basicEmail = $row['basicEmail'];
							$basicDOB = $row['basicDob'];
							$basicBirthplace = $row['basicBirthPlace'];
						}//while
						
						// --------------------------------------------------
						
						
						// --------------------------------------------------
						/////////// personal info
						
						$resultApp = mysql_query("SELECT * FROM tbl_personal_info WHERE basicId = $basicId");
						// display query results
						
						while($rowApp = mysql_fetch_array($resultApp)) 
						{
							if ($rowApp['personalQualityType']=='Gender')
							$appQualityGender = $rowApp['personalQualityDesc'];
							
							if ($rowApp['personalQualityType']=='Civil Status')
							$appQualityCivilStatus = $rowApp['personalQualityDesc'];
							
							if ($rowApp['personalQualityType']=='Height')
							$appQualityHeight =  $rowApp['personalQualityDesc'];
							
							if ($rowApp['personalQualityType']=='Weight')
							$appQualityWeight =  $rowApp['personalQualityDesc'];
							
							if ($rowApp['personalQualityType']=='Religion')
							$appQualitySearchReligion = $rowApp['personalQualityDesc'];
							
							if ($rowApp['personalQualityType']=='Nationality')
							$appQualitySearchNationality = $rowApp['personalQualityDesc'];
						}
						// --------------------------------------------------
						
						
						// --------------------------------------------------
						/////////// contact info
					
						$result = mysql_query("SELECT * FROM tbl_contact_info WHERE basicId = $basicId");
			
					
								$ctr=0; 	// counter
				
								while($row = mysql_fetch_array($result)) 
								{
									$appContactDevice[$ctr] = $row['contactDevice'];
									$appContactNumber[$ctr] = $row['contactNumber'];
									$ctr++;
								}
						
						// --------------------------------------------------
						
						
						// --------------------------------------------------
						//////////    family background
						$result = mysql_query("SELECT *
												FROM tbl_family_background
												WHERE basicId = $basicId");
												
						while($row = mysql_fetch_array($result)) 
						{
							$familyId =  $row['familyId'];
							$familySpouse = $row['familySpouse'];
							$familySpouseAdd = $row['familySpouseAdd'];
							$familySpouseJob = $row['familySpouseJob'];
							$fatherName = $row['fatherName'];
							$fatherJob = $row['fatherJob'];
							$motherName = $row['motherName'];
							$motherJob = $row['motherJob'];
							$emergencyNotifyName = $row['emergencyNotifyName'];
							$emergencyNotifyAddress = $row['emergencyNotifyAddress'];
							$emergencyNotifyContact = $row['emergencyNotifyContact'];	
						}//while
						// --------------------------------------------------
						
						
						// --------------------------------------------------
						//////////// child
						$result = mysql_query("SELECT *
												FROM tbl_child
												WHERE familyId = $familyId");
												
						$ctr = 0;
						while($row = mysql_fetch_array($result)) 
						{
							$childName[$ctr] = $row['childName'];
							$childAge[$ctr] = $row['childAge'];
							$childGender[$ctr] = $row['childGender'];
							$childCivil[$ctr] = $row['childCivil'];
							$ctr++;
						}
						// --------------------------------------------------
						
						// --------------------------------------------------
						///////// insurance info
						$result = mysql_query("SELECT *
												FROM tbl_insurance_info
												WHERE basicId = $basicId");
												
						while($row = mysql_fetch_array($result)) 
						{
							$benificiaryName = $row['benificiaryName'];
							$benificiaryAdd = $row['benificiaryAdd'];
							$benificiaryRelationship = $row['benificiaryRelationship'];
							$benificiaryDob = $row['benificiaryDob'];
							$benificiaryGender = $row['benificiaryGender'];
							$benificaryAge = $row['benificaryAge'];
							$benificiaryCivil  = $row['benificiaryCivil'];
						}
						// --------------------------------------------------
						
						$ctr = 0;
						// --------------------------------------------------
						////////////////  education
						$result = mysql_query("SELECT *
												FROM tbl_education
												WHERE basicId = $basicId");
												
						while($row = mysql_fetch_array($result)) 
						{
							$schoolName[$ctr] = $row['schoolName'];
							$schoolLevel[$ctr] = $row['schoolLevel'];
							$schooAddress[$ctr] = $row['schooAddress'];
							$ctr++;
						}//while
						// --------------------------------------------------
						
						$ctr = 0;
						// --------------------------------------------------
						/////////////// work experience
						$result = mysql_query("SELECT *
												FROM tbl_work
												WHERE basicId = $basicId");
												
						while($row = mysql_fetch_array($result)) 
						{
							$companyName[$ctr] = $row['companyName'];
							$workYear[$ctr] = $row['workYear'];
							$workPosition[$ctr] = $row['workPosition'];
							$workSalary[$ctr] = $row['workSalary'];
							$workSupervisor[$ctr] = $row['workSupervisor'];
							$workLeavingReason[$ctr] = $row['workLeavingReason'];
							$ctr++;
						}//
						// --------------------------------------------------
						
						// --------------------------------------------------
						////////////////// desired position
						$result = mysql_query("SELECT *
												FROM tbl_desired_position
												WHERE applicantId = $_GET[appID]
											");
												
						while($row = mysql_fetch_array($result)) 
						{
							if($row['positionRank']=='First')
							{
								$positionJobName1 = $row['positionJobName'];
							}
							else if ($row['positionRank']=='Second')
							{
								$positionJobName2 = $row['positionJobName'];
							}
							else if ($row['positionRank']=='Third')
							{
								$positionJobName3 = $row['positionJobName'];
							}
						}
						// --------------------------------------------------
						
						
						// -----------------------------------------------------
						/////////////////// basic notes
						$result = mysql_query("SELECT *
												FROM tbl_basic_info
												WHERE basicId = $basicId
											");
												
						while($row = mysql_fetch_array($result)) 
						{
							$applicantNotes = $row['basicNotes'];
						}
						
						// -----------------------------------------------------
						
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Endorse Applicant</li>
		</ul>
	</div>

	
	
	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 5px; margin-top: .5em; padding:1em;">
			<h4 class="alert-info well-lg"><?php echo $appName?>'s Application Form.</h4>
			<br /><br />
		
		
		
				
				<div class="col-md-12">
					<ul class="nav nav-tabs">
					  	<li class="active"><a data-toggle="tab" href="#home">Applicant Information</a></li>
					  	<li><a data-toggle="tab" href="#menu1">Family Background</a></li>
					  	<li><a data-toggle="tab" href="#menu2">Educational Attainment</a></li>
					  	<li><a data-toggle="tab" href="#menu3">Work Experience</a></li>
					  	<li><a data-toggle="tab" href="#menu4">Desired Position</a></li>
						
					</ul>
				</div>

				<div class="tab-content">
					<br /><br /><br />
				  	<div id="home" class="container tab-pane fade in active">
					    <h3>Applicant Information</h3>
						<br />
						<legend>Basic Information</legend>
							<div class="form-group col-md-3 center" >
								<label>Picture:</label>
								<br />
								<img class="img img-thumbnail img-rounded"  
										id="uploadPreview1" 
										src="../../../image/no_image.jpg" /><br />
								
							</div>
						
							<div class="form-group col-md-2">
								<label>Application Date: </label>
								<input type="text" 
										class="form-control" 
										name="name_basicDate" 
										value="<?php echo $appDate;?>" 
										id="name_basicDate"
										readonly
										 
								/>
							</div>
						
							<div class="form-group col-md-4">
								<label for="appEmail">Email Address: *</label>
								<input type="email" 
										class="form-control" 
										name="name_basicEmail" 
										value='<?php echo $basicEmail; ?>' 
										maxlength="250" 
										id="name_basicEmail"
										title="juan.miguel_delacruz@gmail.com"
										readonly
								/>
							</div>
						
							<div class="form-group col-md-9"></div>
						
								
							<div class="form-group col-md-2">
							<label> Last Name: * </label>
							<input type="text" 
									class="form-control" 
									name="name_basicLastName" 
									value='<?php echo $basicLastName; ?>'
									maxlength="250"
									id="name_basicLastName"
									title="Dela Cruz" 
									required								 
							/>
						</div>

							<div class="form-group col-md-2">
							<label> First Name: *</label>
							<input type="text" 
									class="form-control" 
									name="name_basicFirstName" 
									value='<?php echo $basicFirstName; ?>' 
									maxlength="250"
									id="name_basicFirstName"
									title="Juan"
									style="text-transform: capitalize;"
									required
							/>
						</div>

							<div class="form-group col-md-2">
							<label> Middle Name: </label>
							<input type="text" 
									class="form-control" 
									name="name_basicMiddleName" 
									value='<?php echo $basicMiddleName; ?>'
									maxlength="250"
									id="name_basicMiddleName"
									title="Miguel"
							/>
						</div>

							<div class="form-group col-md-2">
							<label> Ext. Name: </label>
							<input type="text" 
									class="form-control" 
									name="name_basicExtName" 
									value='<?php echo $basicExtName; ?>' 
									maxlength="250"
									placeholder="Jr/Sr, IV"
									id="name_basicExtName"
									title="Jr/Sr, IV"
							/>
						</div>
						
							<div class="form-group col-md-8">
						<br />
							<?php	
									
								echo "<table class='table table-hover table-striped'>";
								echo "<th>Device</th>";
								echo "<th>Number</th>";
								
								$ctr =0;
								while(isset($appContactDevice[$ctr]) &&($appContactDevice[$ctr]!="")) 
								{
									echo"
									<tr>
									<td>$appContactDevice[$ctr]</td>
									<td>$appContactNumber[$ctr]</td>
									</tr>
									";
									
									$ctr++;
								}//while

								echo "</table>";
								
							?>
							 <br /> <br />
						</div>
						
						 
						
							<legend>Personal Data</legend>
						
							<div class="form-group col-md-3">
								<label> Date of Birth: * </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo $basicDOB; ?>' 
										required
										 
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label> Place of Birth: * </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo $basicBirthplace; ?>' 
										required
										 
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label>Gender: </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo $appQualityGender; ?>' 
										required
										 
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label> Height: </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo "$appQualityHeight ft"; ?>' 
										required
										 
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label> Weight: </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo "$appQualityWeight kg"; ?>' 
										required
										 
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label> Civil Status: </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo $appQualityCivilStatus; ?>' 
										required
										 
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label> Religion: </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo $appQualitySearchReligion; ?>' 
										required
										 
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label> Nationality: </label>
								<input type="text" 
										class="form-control" 
										name="name_personalPlaceOfBirth" 
										maxlength="250"
										id="name_personalPlaceOfBirth"
										value='<?php echo $appQualitySearchNationality; ?>' 
										required
										 
								/>
								 <br /> <br />
							</div>
						
							<legend>Current Address</legend>
							
							<div class="form-group col-md-3">
											<label for="name_appInfoNameOfSpouse">Blk No., Lot No., Phase No.:</label>
											<input type="text" 
													class="form-control" 
													name="name_addBlock" 
													value='<?php echo $addBlock; ?>' 
													maxlength="250"   
													id="name_addBlock"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>


							<div class="form-group col-md-3">
								<label for="name_addStreet"> Street Name:</label>
								<input type="text" 
										class="form-control" 
										name="name_addStreet" 
										value='<?php echo $addStreet; ?>' 
										maxlength="250"   
										id="name_addStreet"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>

							<div class="form-group col-md-3">
								<label for="name_addSubdivision">Subdivision:</label>
								<input type="text" 
										class="form-control" 
										name="name_addSubdivision" 
										value='<?php echo $addSubdivision; ?>' 
										maxlength="250"   
										id="name_addSubdivision"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>

							<div class="form-group col-md-3">
								<label for="name_addBrgy">Barangay:</label>
								<input type="text" 
										class="form-control" 
										name="name_addBrgy" 
										value='<?php echo $addBarangay; ?>' 
										maxlength="250"   
										id="name_addBrgy"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>

							<div class="form-group col-md-3">
								<label for="name_addDistrict">District Name: </label>
								<input type="text" 
										class="form-control" 
										name="name_addDistrict" 
										value='<?php echo $addDistrict; ?>' 
										maxlength="250"   
										id="name_addDistrict"
										style="text-transform: capitalize;" 
										title="Ax'l Daniel Kim"
								/>
							</div>


							<div class="form-group col-md-3">
								<label for="name_addCity">City/Municipality:</label>
								<input type="text" 
										class="form-control" 
										name="name_addCity" 
										value='<?php echo $addCity; ?>' 
										maxlength="250"   
										id="name_addCity"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>

							<div class="form-group col-md-3">
								<label for="name_addProvince">Province:</label>
								<input type="text" 
										class="form-control" 
										name="name_addProvince" 
										value='<?php echo $addProvince; ?>' 
										maxlength="250"   
										id="name_addProvince"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>

							<div class="form-group col-md-2">
								<label for="name_addCountry">Country:</label>
								<input type="text" 
										class="form-control" 
										name="name_addCountry" 
										value='<?php echo $addCountry; ?>' 
										maxlength="250"   
										id="name_addCountry"
										style="text-transform: capitalize;" 
										title=""
								/>

							</div>

							<div class="form-group col-md-1">
											<label for="name_addZipCode">Zip Code:</label>
											<input type="text" 
													class="form-control" 
													name="name_addZipCode" 
													value='<?php echo $addZip; ?>' 
													maxlength="4"   
													id="name_addZipCode"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>
						
					    <br />
						
					  </div>
					  
					  
					  
					<div id="menu1" class="container tab-pane fade">
						
						<h3>Family Background</h3>
						<br />
						<div class="form-group col-md-4">
										<label for="name_appInfoNameOfSpouse">Name of Spouse:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfSpouse" 
												value='<?php echo $familySpouse?>' 
												maxlength="250"   
												id="name_appInfoNameOfSpouse"
												style="text-transform: capitalize;" 
												title="Ax'l Daniel Kim"
										/>
									</div>		
							
						<div class="form-group col-md-4">
										<label for="name_appInfoSpouseAddress">Address:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoSpouseAddress" 
												value='<?php echo $familySpouseAdd?>' 
												maxlength="100" 
												id="name_appInfoSpouseAddress"
												style="text-transform: capitalize;" 
												title="143 Pureza St., Sta. Mesa, Manila"
										/>
									</div>
							
						<div class="form-group col-md-4">
										<label for="name_appInfoSpouseOccupation">Spouse Occupation:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoSpouseOccupation" 
												value='<?php echo $familySpouseJob?>' 
												maxlength="250"
												id="name_appInfoSpouseOccupation"
												style="text-transform: capitalize;" 
												title="Freelance Model"
										/>
									</div>
						
						<div class="form-group col-md-12">
						<br />
							<?php	
								echo "<table class='table table-hover table-striped'>";
								echo "<th>Name of Child</th>";
								echo "<th>Age</th>";
								echo "<th>Gender</th>";
								echo "<th>Civil Status</th>";
								
								$ctr =0;
								while(isset($childName[$ctr]) &&($childName[$ctr]!="")) 
								{
									echo"
									<tr>
									<td>$childName[$ctr]</td>
									<td>$childAge[$ctr]</td>
									<td>$childGender[$ctr]</td>
									<td>$childCivil[$ctr]</td>
									</tr>
									";
									
									$ctr++;
								}//while

								echo "</table>";
							?>
							 <br />
						</div>
						
						<div class="form-group col-md-8">
										<label for="name_appInfoNameOfFather">Father's Name: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfFather" 
												value='<?php echo $fatherName?>' 
												maxlength="250" 
												id="name_appInfoNameOfFather"
												style="text-transform: capitalize;" 
												title="Jose Dela Cruz"
												required
										/>
									</div>
				
						<div class="form-group col-md-4">
							<label for="name_appInfoOccupationOfFather">Father's Occupation:</label>
							<input type="text" 
									class="form-control" 
									name="name_appInfoOccupationOfFather" 
									value='<?php echo $fatherJob?>' 
									maxlength="250"
									id="name_appInfoOccupationOfFather"
									title="Programmer"
									style="text-transform: capitalize;" 
							/>
						</div>
								
								
						<div class="form-group col-md-8">
							<label for="name_appInfoNameOfMother">Mother's Maiden Name: *</label>
							<input type="text" 
									class="form-control" 
									name="name_appInfoNameOfMother" 
									value='<?php echo $motherName?>' 
									maxlength="250"
									id="name_appInfoNameOfMother"
									title="Joselita Porcalla"
									style="text-transform: capitalize;" 
							/>
						</div>
								
						<div class="form-group col-md-4">
							<label for="name_appInfoOccupationOfMother">Mother's Occupation:</label>
							<input type="text" 
									class="form-control" 
									name="name_appInfoOccupationOfMother" 
									value='<?php echo $motherJob?>' 
									maxlength="250"
									id="name_appInfoOccupationOfMother"
									title="Bank Manager"
									style="text-transform: capitalize;" 
							/>
							<br /><br />
						</div>
								
						
						<div class="form-group col-md-4">
										<label for="name_appInfoEmergencyContactPerson">Person to be notified in case of emergency: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoEmergencyContactPerson" 
												value='<?php echo $emergencyNotifyName?>' 
												maxlength="250"  
												id="name_appInfoEmergencyContactPerson"
												style="text-transform: capitalize;" 
												title="Joselita Dela Cruz" 
												required
										/>
									</div>
								
						<div class="form-group col-md-4">
							<label for="name_appInfoAddressOfContactPerson">Address: *</label>
							<input type="text" 
									class="form-control" 
									name="name_appInfoAddressOfContactPerson" 
									value='<?php echo $emergencyNotifyAddress?>' 
									maxlength="250"
									id="name_appInfoAddressOfContactPerson"
									title="143 Quirino Ave, San Bartolome, Quezon City"
									style="text-transform: capitalize;" 
									required
							/>
						</div>
						<div class="form-group col-md-4">
							<label for="name_appInfoContactNumberOfContactPerson">Contact Number: *</label>
							<input type="text" 
									class="form-control" 
									name="name_appInfoContactNumberOfContactPerson" 
									value='<?php echo $emergencyNotifyContact?>' 
									maxlength="250"
									id="name_appInfoContactNumberOfContactPerson"
									title="09123654987" 
									required
							/>
							<br /><br />
						</div>
						
						<legend>Insurance Information</legend>
								<br/ >
												
								<div class="form-group col-md-4">
														<label>Name of Benificiary: *</label>
														<input type="text" 
																class="form-control" 
																name="name_appInfoBenificiaryName" 
																value="<?php echo $benificiaryName; ?>"
																maxlength="250"   
																id="name_appInfoBenificiaryName"
																style="text-transform: capitalize;" 
																title="Ax'l Daniel Kim"
																required 
														/>
													</div>
											
											
													<div class="form-group col-md-4">
														<label >Address:</label>
														<input type="text" 
																class="form-control" 
																name="name_appInfoBenificiaryAddress" 
																value="<?php echo $benificiaryAdd; ?>"
																maxlength="100" 
																id="name_appInfoBenificiaryAddress"
																style="text-transform: capitalize;" 
																title="143 Pureza St., Sta. Mesa, Manila"
														/>
													</div>
											
													<div class="form-group col-md-4">
														<label>Relationship: *</label>
														<input type="text" 
																class="form-control" 
																name="name_appInfoBenificiaryRelationship" 
																value="<?php echo $benificiaryRelationship; ?>"
																maxlength="250"
																id="name_appInfoBenificiaryRelationship"
																style="text-transform: capitalize;" 
																required
														/>
													</div>
													
													
									<div class="form-group col-md-4">
														<label>Birthday: *</label>
														<input type="text" 
																class="form-control" 
																name="name_appInfoBenificiaryRelationship" 
																value="<?php echo $benificiaryDob; ?>"
																maxlength="250"
																id="name_appInfoBenificiaryRelationship"
																style="text-transform: capitalize;" 
																required
														/>
													</div>
													
									<div class="form-group col-md-4">
														<label>Gender:</label>
														<input type="text" 
																class="form-control" 
																name="name_appInfoBenificiaryRelationship" 
																value="<?php echo $benificiaryGender; ?>"
																maxlength="250"
																id="name_appInfoBenificiaryRelationship"
																style="text-transform: capitalize;" 
																required
														/>
													</div>
													
									
									<div class="form-group col-md-4">
														<label>Civil Status:</label>
														<input type="text" 
																class="form-control" 
																name="name_appInfoBenificiaryRelationship" 
																value="<?php echo $benificiaryCivil; ?>" 
																maxlength="250"
																id="name_appInfoBenificiaryRelationship"
																style="text-transform: capitalize;" 
																required
														/>
													</div>
	
	
						
					</div>
			  
				  
				  
					<div id="menu2" class="container tab-pane fade">
					    <h3>Educational Attainment</h3>
						<div class="form-group col-md-12">
						<br />
							<?php	
								echo "<table class='table table-hover table-striped'>";
								echo "<th>School Name</th>";
								echo "<th>Level</th>";
								echo "<th>Address</th>";
								
								$ctr =0;
								while(isset($schoolName[$ctr]) &&($schoolName[$ctr]!="")) 
								{
									echo"
									<tr>
									<td>$schoolName[$ctr]</td>
									<td>$schoolLevel[$ctr]</td>
									<td>$schooAddress[$ctr]</td>
									</tr>
									";
									
									$ctr++;
								}//while

								echo "</table>";
							?>
							 <br /> <br />
						</div>
						
					</div>
					
					
					<div id="menu3" class="container tab-pane fade">
					    <h3>Work Experience</h3>
					  <div class="form-group col-md-12">
						<br />
							<?php	
								echo "<table class='table table-hover table-striped'>";
								echo "<th>Company Name</th>";
								echo "<th>Work Year</th>";
								echo "<th>Position</th>";
								echo "<th>Salary</th>";
								echo "<th>Supervisor</th>";
								echo "<th>Reason for Leaving</th>";
								
								$ctr =0;
								while(isset($companyName[$ctr]) &&($companyName[$ctr]!="")) 
								{
									echo"
									<tr>
									<td>$companyName[$ctr]</td>
									<td>$workYear[$ctr]</td>
									<td>$workPosition[$ctr]</td>
									<td>$workSalary[$ctr]</td>
									<td>$workSupervisor[$ctr]</td>
									<td>$workLeavingReason[$ctr]</td>
									</tr>
									";
									
									$ctr++;
								}//while

								echo "</table>";	
							?>
							 <br /> <br />
						</div>
					  
					  </div>
					 
					
					
					<div id="menu4" class="container tab-pane fade">
					    <h3>Desired Position</h3>
							<br />
						<div class="form-group col-md-4">
										<label for="name_appInfoNameOfSpouse">First Position:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfSpouse" 
												value='<?php echo $positionJobName1?>' 
												maxlength="250"   
												id="name_appInfoNameOfSpouse"
												style="text-transform: capitalize;" 
												title="Ax'l Daniel Kim"
										/>
									</div>		
							
						<div class="form-group col-md-4">
										<label for="name_appInfoSpouseAddress">Second Position:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoSpouseAddress" 
												value='<?php echo $positionJobName2?>' 
												maxlength="100" 
												id="name_appInfoSpouseAddress"
												style="text-transform: capitalize;" 
												title="143 Pureza St., Sta. Mesa, Manila"
										/>
									</div>
							
						<div class="form-group col-md-4">
										<label for="name_appInfoSpouseAddress">Third Position:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoSpouseAddress" 
												value='<?php echo $positionJobName3?>' 
												maxlength="100" 
												id="name_appInfoSpouseAddress"
												style="text-transform: capitalize;" 
												title="143 Pureza St., Sta. Mesa, Manila"
										/>
									</div>						
					 				
					 
					</div>
				
				
			</div>
			
			
			<form method="POST" action="#">
				 <div class="container">
					 <div class="col-md-12">
						<br /><br />
						<label>Notes:</label>
						<textarea class="form-control" name="name_welcome_message" value=""
									rows="8" placeholder="Type your notes here ..."><?php echo $applicantNotes?></textarea>
					</div>
			
	<!--
					<div class="form-group col-md-2 col-md-offset-5">
							
						<button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submit" 
								style="margin-top: 2em; ">
								Save &nbsp;
							 <span class="glyphicon glyphicon-check"></span>
						</button>
						
					</div>
			-->
				</div>
				
	     	</form>
		
		</div>
	</div>
	
	

	<div class='container-fluid content'>
		<div class="col-md-12 wrapper-background">
			<div class="container-fluid content breadcrumbs"  style="padding-top:2em;">
				<div class="form-group col-md-5">
					<?php
					echo"<h3>$appName's &nbsp;&nbsp;&nbsp;&nbsp; Assessment Result:</h3>";
					?>
				</div>
				<div class="form-group col-md-3">
				</div>
				<?php
				if ($endorseDecision!="Passed" && $endorseDecision!="Failed")
					{
					echo'
						<div class="form-group col-md-2">
							<form method="POST" action="../../../config/clientInsertPassAssessment.php">
								<button type="submit" 
														class="btn btn-primary btn-md btn-block"
														name ="submitAddClient" 
														id="submitAddClient">
														PASSED
								</button>
								</form>
						</div>
						<div class="form-group col-md-2">
							<form method="POST" action="../../../config/clientInsertFailAssessment.php">
								<button type="submit" 
														class="btn btn-primary btn-md btn-block"
														name ="submitAddClient" 
														id="submitAddClient">
														FAILED
								</button>
								</form>
						</div>
					';
				}//if
				else
				{
					echo'
						<div class="form-group col-md-2">
						</div>
						<div class="form-group col-md-2">
						<h3>'.strtoupper($endorseDecision).'</h3>
						</div>
					';
				}//else
				?>
			</div>
		</div>
	</div>
	
	
	<br /><br /><br />
<?php
	include ('../footer.php');
?>