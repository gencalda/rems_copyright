<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
	
?>


<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active"><a href="assessApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>
		</ul>
	</div>

	
	

	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 4em; margin-top: 3em; padding:1em;">
			
			<?php
			
						//  session
						$_SESSION["ses_AppID"] = $_GET['appID'];		
						
						$appName = '';
						
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
						$basicNotes = '';
						
						
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
						
						
						$examName = array();
						$examScore = array();
						$examStatus = array();
						$examhps = array();
						$examPercentage = array();
						$examPassing = array();
						
	
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
							$picture = $row['basicPicture'];
							$appName = $row['basicLastName'].", ".$row['basicFirstName']." ".$row['basicMiddleName'];
							$appDate = $row['applicantDate'];
							$basicId = $row['basicId'];
							$resume = $row['resume'];
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
							$basicNotes = $row['basicNotes'];
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
						
						$ctr = 0;
						// --------------------------------------------------
						////////////////// exam result
						$result = mysql_query("SELECT *
												FROM tbl_applicant_exam
												LEFT JOIN tbl_exam
												ON tbl_applicant_exam.examId = tbl_exam.examId
												WHERE applicantId = $_GET[appID]
											");
												
						while($row = mysql_fetch_array($result)) 
						{
							$examID[$ctr] = $row['examId'];
							$examName[$ctr] = $row['examTitle'];
							$examScore[$ctr] = $row['applicantExamScore'];
							$examStatus[$ctr] = $row['examStatus'];
							$examPassing[$ctr] =  $row['examPassingGrade'];
				

							$resultQuestions = mysql_query("SELECT COUNT(*)
												FROM tbl_question
												WHERE examId = $examID[$ctr]
											");
							$rowCount = mysql_fetch_row($resultQuestions);

							$examhps[$ctr] = $rowCount[0];

							$examPercentage[$ctr] = ($examScore[$ctr]/$examhps[$ctr]) * 100;

								
									
							$ctr++;
						}
						// --------------------------------------------------
						
			?>
			
			<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: .5em; padding:1em;">
			<h4 class="alert-info well-lg"><?php echo $appName?>'s Application Form.</h4>
			<br /><br />
		
		
		
				
				<div class="col-md-12">
					<ul class="nav nav-tabs">
					  	<li class="active"><a data-toggle="tab" href="#home">Applicant Information</a></li>
					  	<li><a data-toggle="tab" href="#menu1">Family Background</a></li>
					  	<li><a data-toggle="tab" href="#menu2">Educational Attainment</a></li>
					  	<li><a data-toggle="tab" href="#menu3">Work Experience</a></li>
					  	<li><a data-toggle="tab" href="#menu4">Desired Position</a></li>
						<li><a data-toggle="tab" href="#menu5">Exam Result</a></li>
						<li><a data-toggle="tab" href="#menu6">View Resume</a></li>
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
										src="../../../<?php echo $picture;?>" /><br />
								
								
								
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
									readonly								 
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
									readonly
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
									readonly
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
									readonly
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
										readonly
										 
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
													readonly
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
										readonly
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
													readonly
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
												readonly
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
												readonly
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
												readonly
										/>
									</div>
						<?php	
							$ctr =0;

							if(isset($childName[$ctr]))
							{
								echo'
								<div class="form-group col-md-12">
								<br />';
							}
								
								if(isset($childName[$ctr]))
								{
									echo "<table class='table table-hover table-striped'>";
									echo "<th>Name of Child</th>";
									echo "<th>Age</th>";
									echo "<th>Gender</th>";
									echo "<th>Civil Status</th>";
								}

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
							
							$ctr =0;

							if(isset($childName[$ctr]))
							{
								echo"
								<br />
								</div>";
							}
						?>
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
												readonly
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
									readonly 
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
									readonly
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
									readonly
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
												readonly
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
									readonly
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
									readonly
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
																readonly
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
																readonly
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
																readonly
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
																readonly
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
																readonly
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
																readonly
														/>
													</div>
	
	
	
					</div>
			  
				  
				  
					<div id="menu2" class="container tab-pane fade">
					    <h3>Educational Attainment</h3>
					    
						<div class="form-group col-md-12">
						<br />
							<?php	
								
								
								$ctr =0;
									echo "<table class='table table-hover table-striped'>";
									if(isset($schoolName[$ctr]))
									{
										echo "<th>School Name</th>";
										echo "<th>Level</th>";
										echo "<th>Address</th>";
									}
									else
									{
										echo "<th>No Educational Attainment available.</th>";
									}

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
								
								$ctr =0;
									echo "<table class='table table-hover table-striped'>";
									if(isset($companyName[$ctr]))
									{
										echo "<th>Company Name</th>";
										echo "<th>Work Year</th>";
										echo "<th>Position</th>";
										echo "<th>Salary</th>";
										echo "<th>Supervisor</th>";
										echo "<th>Reason for Leaving</th>";
									}
									else
									{
										echo "<th>No Work Experience available.</th>";
									}

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
												readonly
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
												readonly
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
												readonly
										/>
									</div>						
					 
					</div>
				
				
					
					
					<div id="menu5" class="container tab-pane fade">
					    <h3>Exam Result</h3>
						<br />
						<?php	
									
								$ctr =0;
								echo "<table class='table table-hover table-striped'>";
									if(isset($examName[$ctr]))
									{
										echo "<th>Exam Name</th>";
										echo "<th>&nbsp;&nbsp;&nbsp;&nbsp; Score&nbsp; </th>";
										echo "<th>Passing Grade</th>";
										echo "<th>Status</th>";
									}
									else
									{
										echo "<th>No Exam Result available.</th>";
									}

								while(isset($examName[$ctr]) &&($examName[$ctr]!="")) 
								{
									echo"
									<tr>
									<td>$examName[$ctr]</td>
									<td>$examScore[$ctr] out of $examhps[$ctr]  &nbsp; &nbsp;- &nbsp; &nbsp;$examPercentage[$ctr]%</td>
									<td>$examPassing[$ctr]%</td>
									<td>$examStatus[$ctr]</td>
									</tr>
									";
									$ctr++;
								}//while

								echo "</table>";
								
							?>
							 <br /> <br />			
					 
					</div>
					
					<div id="menu6" class="container tab-pane fade">
					    <h3>View Resume</h3>
						<br />
						
						<div class="container well well-lg col-md-10 col-md-offset-1">	
							<h2>
								<?php echo $appName;?>
							</h2>
							<br />
							<embed src="../../../<?php echo $resume;?>" width="100%" height="500em"></embed>
							
					
						</div>
					</div>
					</div>
			
				 <div class="container">
					 <div class="col-md-12">
						<br /><br />
						<legend>Assess Applicant Skills and Qualities: </legend>
						<?php
			
			
			//  --------------- Jobs ------------------
						$resultJob1 = mysql_query("SELECT * 
												FROM tbl_desired_position 
												WHERE applicantId = $_GET[appID] 
												and positionRank = 'First'
											     ");
												 
						while($rowJob1 = mysql_fetch_array($resultJob1)) 
						{
							$job1 = $rowJob1['positionJobName'];
						}
						
						
						$resultJob2 = mysql_query("SELECT * 
												FROM tbl_desired_position 
												WHERE applicantID = $_GET[appID]
												and positionRank = 'Second'
											     ");
												 
						while($rowJob2 = mysql_fetch_array($resultJob2)) 
						{
							$job2 = $rowJob2['positionJobName'];
						}
						
						
						$resultJob3 = mysql_query("SELECT * 
												FROM tbl_desired_position 
												WHERE applicantID = $_GET[appID]
												and positionRank = 'Third'
											     ");
												 
						while($rowJob3 = mysql_fetch_array($resultJob3)) 
						{
							$job3 = $rowJob3['positionJobName'];
						}
						
						//------------------------------------------
					
						$ctr = 0;
						
						$resultAppSkills = mysql_query("SELECT * 
												FROM tbl_personal_info
												WHERE basicId = $basicId
												and personalQualityType = 'Quality'
											     ");
					if (mysql_num_rows($resultAppSkills) != 0) 
					{ 							 
						while($rowAppSkills = mysql_fetch_array($resultAppSkills)) 
						{
							$skillsApp[$ctr] = $rowAppSkills['personalQualityDesc'];
							$ctr++;
						}
					}//if
										
										$result = mysql_query("SELECT DISTINCT jobQualiDescription
															FROM  tbl_job_quali
															LEFT JOIN tbl_job_posting 
															ON tbl_job_quali.jobPostingId = tbl_job_posting.jobPostingId
															WHERE (tbl_job_posting.jobName = '$job1'
															OR tbl_job_posting.jobName = '$job2'
															OR tbl_job_posting.jobName = '$job3'
															)
															AND tbl_job_quali.jobQualiType = 'Quality'
															");
																											
										echo " <form action='../../../config/insertAppQualifications.php' method='post'>";
					
						$ctr = 0;
						// run through the results from the database, generating the checkboxes 
						while ($row = mysql_fetch_assoc($result)) { 
						 if (mysql_num_rows($resultAppSkills) != 0) 
							 {
							   if (in_array($row['jobQualiDescription'], $skillsApp))
							   {
									echo "\n\t<li>"; 
									echo "<p><input type='checkbox' name='name_AppQualities[]' value='{$row['jobQualiDescription']}' checked='checked' > {$row['jobQualiDescription']}</p>"; 
									echo "</li>"; 
								} 
								else 
								{ 
									echo "\n\t<li>"; 
									echo "<p><input type='checkbox' name='name_AppQualities[]' value='{$row['jobQualiDescription']}'> {$row['jobQualiDescription']}</p>"; 
									echo "</li>"; 
								 }
							 }//if
						 else
							{
								echo "\n\t<li>"; 
									echo "<p><input type='checkbox' name='name_AppQualities[]' value='{$row['jobQualiDescription']}'> {$row['jobQualiDescription']}</p>"; 
									echo "</li>"; 
							}//else
						}//while 
			
			?>
			<br/><br/>

			
			
			
						<label>Notes:</label>
						<textarea class="form-control" name="name_ApplicantNotes" 
									rows="8" placeholder="Type your notes here ..."><?php echo $basicNotes ?></textarea>
					</div>
			

					<div class="form-group col-md-2 col-md-offset-5">
							
						<button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submitAppQualifications" 
								style="margin-top: 2em; ">
								Submit &nbsp;
							 <span class="glyphicon glyphicon-check"></span>
						</button>
						
					</div>
				</div>
				
	     	</form>
		
		</div>
	</div>
		
		</div>
	</div>

<br /><br />

<?php
	mysql_close($con);
	include ('../footer.php');
?>