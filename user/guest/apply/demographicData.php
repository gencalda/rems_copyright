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

	$appInfoNameOfSpouse = '';
	$appInfoSpouseAddress = '';
	$appInfoSpouseOccupation = '';
	$appInfoNumberOfChildren = '';
	$appInfoAgesOfChildren = '';
	$appInfoNameOfFather = '';
	$appInfoOccupationOfFather = '';
	$appInfoNameOfMother = '';
	$appInfoOccupationOfMother = '';
	$appInfoEmergencyContactPerson = '';
	$appInfoAddressOfContactPerson = '';
	$appInfoContactNumberOfContactPerson = '';
	
	if (isset($_SESSION['ses_applyPage3'])) 
	{
	
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
		
		if (!$con)
		{
			die('Could not connect: ' . mysql_error()); 
		}
		mysql_select_db("$db_database", $con);
		
		$query = mysql_query("SELECT * FROM appInformation WHERE applicantID = '".$_SESSION['ses_applicantID']."'");
		// display query results
		
		while($row = mysql_fetch_array($query))
		{
			$appInfoNameOfSpouse = $row['appInfoNameOfSpouse'];
			$appInfoSpouseAddress = $row['appInfoSpouseAddress'];
			$appInfoSpouseOccupation = $row['appInfoSpouseOccupation'];
			$appInfoNumberOfChildren = $row['appInfoNumberOfChildren'];
			$appInfoAgesOfChildren = $row['appInfoAgesOfChildren'];
			$appInfoNameOfFather = $row['appInfoNameOfFather'];
			$appInfoOccupationOfFather = $row['appInfoOccupationOfFather'];
			$appInfoNameOfMother = $row['appInfoNameOfMother'];
			$appInfoOccupationOfMother = $row['appInfoOccupationOfMother'];
			$appInfoEmergencyContactPerson = $row['appInfoEmergencyContactPerson'];
			$appInfoAddressOfContactPerson = $row['appInfoAddressOfContactPerson'];
			$appInfoContactNumberOfContactPerson = $row['appInfoContactNumberOfContactPerson'];
		}//while
		
	}//if set

?>

			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Current Address</li>
				</ul>
			</div>


			<div class="container-fluid" id="demographic">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
						Fields with asterisk (*) are required.
					</h4> 		
				
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:20%">
							    20% Complete
							  </div>
						</div>
					</div>
				
					<form method="POST" action="../../../config/insertAppDemographicData.php" name = "myForm" onsubmit = "return validateForm()" enctype="multipart/form-data">
		
						<div class="container col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em;  padding:1em;">			
	
									<legend>Current Address</legend>
									<br/ >
										<div class="form-group col-md-3">
											<label>Blk No., Lot No., Phase No.:</label>
											<input type="text" 
													class="form-control" 
													name="name_addBlock" 
													onchange="validateAddBlock();" 
													value='' 
													maxlength="250"   
													id="name_addBlock"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>


										<div class="form-group col-md-3">
											<label> Street Name: *</label>
											<input type="text" 
													class="form-control" 
													name="name_addStreet" 
													value='' 
													onchange="validateAddStreet();" 
													maxlength="250"   
													id="name_addStreet"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>

										<div class="form-group col-md-3">
											<label>Subdivision:</label>
											<input type="text" 
													class="form-control" 
													name="name_addSubdivision" 
													value='' 
													onchange="validateAddSubdivision();" 
													maxlength="250"   
													id="name_addSubdivision"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>

										<div class="form-group col-md-3">
											<label>Barangay: *</label>
											<input type="text" 
													class="form-control" 
													name="name_addBrgy" 
													value='' 
													onchange="validateAddBarangay();" 
													maxlength="250"   
													id="name_addBrgy"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>

										<div class="form-group col-md-3">
											<label>Disctrict Name: </label>
											<input type="text" 
													class="form-control" 
													name="name_addDistrict" 
													value='' 
													onchange="validateAddDistrict();" 
													maxlength="250"   
													id="name_addDistrict"
													style="text-transform: capitalize;" 
													title="Ax'l Daniel Kim"
											/>
										</div>


										<div class="form-group col-md-3">
											<label>City/Municipality: *</label>
											<input type="text" 
													class="form-control" 
													name="name_addCity" 
													value='' 
													onchange="validateAddCity();" 
													maxlength="250"   
													id="name_addCity"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>

										<div class="form-group col-md-3">
											<label>Province: *</label>
											<input type="text" 
													class="form-control" 
													name="name_addProvince" 
													value='' 
													onchange="validateAddProvince()" 
													maxlength="250"   
													id="name_addProvince"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>

										<div class="form-group col-md-2">
											<label>Country: *</label>
											<input type="text" 
													class="form-control" 
													name="name_addCountry" 
													value='' 
													onchange="validateAddCountry()" 
													maxlength="250"   
													id="name_addCountry"
													style="text-transform: capitalize;" 
													title=""
											/>

										</div>

										<div class="form-group col-md-1">
											<label>Zip Code: *</label>
											<input type="text" 
													class="form-control" 
													name="name_addZipCode" 
													value='' 
													onchange="validateAddZip()" 
													maxlength="4"   
													id="name_addZipCode"
													style="text-transform: capitalize;" 
													title=""
											/>
										</div>

										
								
								
												
									<div class="form-group col-md-3">
									</div>
									
									<div class="form-group col-md-2">
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
														onClick="location.href='personalInformation.php'" >
								      				<span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Previous
								      			</button>

											

									</div>
									<div class="form-group col-md-2">
									
										<button type="submit" 
												class="btn btn-primary btn-md btn-block"
												name ="demographicNext" 
												id = "demographicNext" 
												disabled="true"
												style="margin-top: 2em;">
						      				 Next &nbsp;
													 <span class="glyphicon glyphicon-chevron-right"></span>
						      			</button>
						      		</div>
									
										
						</div>
					</form>
				</div>
			</div>



<?php
 	include('../footer.php');
 ?> 