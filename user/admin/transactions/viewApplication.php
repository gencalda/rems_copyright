<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
?>


	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="assessApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><?php echo "echo name of applicant"; ?></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Application Form</li>
		</ul>
	</div>


	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
			<h4 class="alert-info well-lg">Yujin Jung's Application Form.</h4>
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
										value="<?php echo $date;?>" 
										id="name_basicDate"
										readonly
										 
								/>
							</div>
						
							<div class="form-group col-md-4">
								<label for="appEmail">Email Address: *</label>
								<input type="email" 
										class="form-control" 
										name="name_basicEmail" 
										value='<?php echo $_POST['email'] ?>' 
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
									maxlength="250"
									id="name_basicLastName"
									onchange ="validateLastName()" 
									title="Dela Cruz" 
									data-toggle="tooltip"
									required								 
							/>
						</div>

							<div class="form-group col-md-2">
							<label> First Name: *</label>
							<input type="text" 
									class="form-control" 
									name="name_basicFirstName" 
									value='' 
									maxlength="250"
									id="name_basicFirstName"
									data-toggle="tooltip"
									onchange="validateFirstName()" 
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
									value='' 
									maxlength="250"
									onchange="validateMiddleName()" 
									data-toggle="tooltip"
									id="name_basicMiddleName"
									title="Miguel"
							/>
						</div>

							<div class="form-group col-md-2">
							<label> Ext. Name: </label>
							<input type="text" 
									class="form-control" 
									name="name_basicExtName" 
									value='' 
									maxlength="250"
									onchange="validateMiddleName()" 
									data-toggle="tooltip"
									placeholder="Jr/Sr, IV"
									id="name_basicExtName"
									title="Jr/Sr, IV"
							/>
						</div>
						
							<div class="form-group col-md-8">
						<br />
							<?php	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error()); 
								}
								
								mysql_select_db("$db_database", $con);
								
								$result = mysql_query("SELECT * FROM tbl_client a, tbl_notification b, tbl_job_posting c WHERE a.clientId = c.clientId AND c.jobPostingId = b.jobPostingId group by dateCreated");
								echo "<table class='table table-hover table-striped'>";
								echo "<th>Device</th>";
								echo "<th>Number</th>";

								while($row = mysql_fetch_array($result)) 
								{
								
									$desc = $row['notifDesc'];
									
									if($desc == 'posted a new job.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									else if($desc == 'endorsed and applicant.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									
								}

								echo "</table>";
								mysql_close($con);
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
										onchange ="validateLastName()" 
										title="Quezon City" 
										data-toggle="tooltip"
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
													value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
													value='' 
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
												value='<?php echo $appInfoNameOfSpouse?>' 
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
												value='<?php echo $appInfoSpouseAddress?>' 
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
												value='<?php echo $appInfoSpouseOccupation?>' 
												maxlength="250"
												id="name_appInfoSpouseOccupation"
												style="text-transform: capitalize;" 
												title="Freelance Model"
										/>
									</div>
						
						<div class="form-group col-md-12">
						<br />
							<?php	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error()); 
								}
								
								mysql_select_db("$db_database", $con);
								
								$result = mysql_query("SELECT * FROM tbl_client a, tbl_notification b, tbl_job_posting c WHERE a.clientId = c.clientId AND c.jobPostingId = b.jobPostingId group by dateCreated");
								echo "<table class='table table-hover table-striped'>";
								echo "<th>Name of Child</th>";
								echo "<th>Age</th>";
								echo "<th>Gender</th>";
								echo "<th>Civil Status</th>";

								while($row = mysql_fetch_array($result)) 
								{
								
									$desc = $row['notifDesc'];
									
									if($desc == 'posted a new job.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									else if($desc == 'endorsed and applicant.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									
								}

								echo "</table>";
								mysql_close($con);
							?>
							 <br />
						</div>
						
						<div class="form-group col-md-8">
										<label for="name_appInfoNameOfFather">Father's Name: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfFather" 
												value='<?php echo $appInfoNameOfFather?>' 
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
									value='<?php echo $appInfoOccupationOfFather?>' 
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
									value='<?php echo $appInfoNameOfMother?>' 
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
									value='<?php echo $appInfoOccupationOfMother?>' 
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
												value='<?php echo $appInfoEmergencyContactPerson?>' 
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
									value='<?php echo $appInfoAddressOfContactPerson?>' 
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
									value='<?php echo $appInfoContactNumberOfContactPerson?>' 
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
																value='' 
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
																value='' 
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
																value='' 
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
																value='' 
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
																value='' 
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
																value='' 
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
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error()); 
								}
								
								mysql_select_db("$db_database", $con);
								
								$result = mysql_query("SELECT * FROM tbl_client a, tbl_notification b, tbl_job_posting c WHERE a.clientId = c.clientId AND c.jobPostingId = b.jobPostingId group by dateCreated");
								echo "<table class='table table-hover table-striped'>";
								echo "<th>School Name</th>";
								echo "<th>Level</th>";
								echo "<th>Address</th>";

								while($row = mysql_fetch_array($result)) 
								{
								
									$desc = $row['notifDesc'];
									
									if($desc == 'posted a new job.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									else if($desc == 'endorsed and applicant.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									
								}

								echo "</table>";
								mysql_close($con);
							?>
							 <br /> <br />
						</div>
						
						
					</div>
					
					
					<div id="menu3" class="container tab-pane fade">
					    <h3>Work Experience</h3>
					    <div class="form-group col-md-12">
						<br />
							<?php	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error()); 
								}
								
								mysql_select_db("$db_database", $con);
								
								$result = mysql_query("SELECT * FROM tbl_client a, tbl_notification b, tbl_job_posting c WHERE a.clientId = c.clientId AND c.jobPostingId = b.jobPostingId group by dateCreated");
								echo "<table class='table table-hover table-striped'>";
								echo "<th>Company Name</th>";
								echo "<th>Work Year</th>";
								echo "<th>Position</th>";
								echo "<th>Salary</th>";
								echo "<th>Supervisor</th>";
								echo "<th>Reason for Leaving</th>";

								while($row = mysql_fetch_array($result)) 
								{
								
									$desc = $row['notifDesc'];
									
									if($desc == 'posted a new job.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/job.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									else if($desc == 'endorsed and applicant.')
									{
										$tran = md5('transactions');
										echo "<tr>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
										echo "<td><a style='color:black;  
													text-decoration: none;'
													href = '../transactions/assessApplicant.php?token=$tran&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
													
										echo "</tr>";
									}
									
								}

								echo "</table>";
								mysql_close($con);
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
												value='<?php echo $appInfoNameOfSpouse?>' 
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
												value='<?php echo $appInfoSpouseAddress?>' 
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
												value='<?php echo $appInfoSpouseAddress?>' 
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
									rows="8" placeholder="Type your notes here ..."></textarea>
					</div>
			

					<div class="form-group col-md-2 col-md-offset-5">
							
						<button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submit" 
								style="margin-top: 2em; ">
								Save &nbsp;
							 <span class="glyphicon glyphicon-check"></span>
						</button>
						
					</div>
				</div>
				
	     	</form>
		
		</div>
	</div>


<?php
	include ('../footer.php');
?>