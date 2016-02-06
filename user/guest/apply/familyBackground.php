<?php
	/*include('guestLink.php');
	include ('../../../include/header.php');
	include ('guestNav.php');
	include ('../../../config/connection.php');
	*/
	$root = realpath(dirname(__FILE__) . '/../../..');
	
	include($root . '/include/header.php');
	//include($root . '/include/linkTwo.php');
	include($root . '/config/connection.php');
	include ('../guestNav.php'); // native to admin
?>

	<script type="text/javascript">
		$(document).ready(function() {
		    var max_fields      = 20; //maximum input boxes allowed
		    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		    var add_button      = $(".add_field_button"); //Add button ID
		    
		    var x = 1; //initlal text box count
		    $(add_button).click(function(e){ //on add input button click
		        e.preventDefault();
		        if(x < max_fields){ //max input box allowed
		            x++; //text box increment
		         $(wrapper).append('<div class="form-group col-md-12"><div class="form-group col-md-4"><input type="text" class="form-control" name="name_appInfoNameOfChild[]" maxlength="250" id="name_appInfoNameOfChild[]"  /></div><div class="form-group col-md-2"><input type="text" class="form-control" name="name_appInfoAgeOfChild[]" maxlength="250" placeholder=""  id="name_appInfoAgeOfChild[]" /></div><div class="form-group col-md-2"><select type="position" class="form-control"  id="name_appInfoGenderOfChild[]" name="name_appInfoGenderOfChild[]"><option value="Male" selected>Male</option><option value="Female">Female</option></select></div><div class="form-group col-md-3"><select type="appCivilStatus" class="form-control"  id="name_appInfoCivilStatusOfChild[]" name="name_appInfoCivilStatusOfChild[]"><option value="" selected>Civil Status</option><option value="Single">Single</option><option value="Married">Married</option><option value="Widowed">Widowed</option><option value="Legally Separated">Legally Separated</option><option value="Annulled">Annulled</option></select></div>	<div class="form-group col-md-1"></div>  <a href="#" class="remove_field">Remove</a></div>'); //add input box
		       
			   }
		    });
		    
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent('div').remove(); x--;
		    })
			
			
		});
		</script>


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
					<li class="active">Family Background</li>
				</ul>
			</div>

				
			<div class="container-fluid" id="family">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
							Fields with asterisk (*) are required.</h4> 		
					
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:30%">
							    30% Complete
							  </div>
						</div>
					</div>
					<form method="POST" action="../../../config/insertAppFamilyBackground.php" name = "myForm" enctype="multipart/form-data">
	
						<div class="container col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; padding:1em;">			
								<legend>Family Background</legend>
								<br/ >
									<div class="form-group col-md-4">
										<label>Name of Spouse:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfSpouse" 
												value='<?php echo $appInfoNameOfSpouse?>' 
												maxlength="250"   
												onchange="validateSpouse()"
												id="name_appInfoNameOfSpouse"
												style="text-transform: capitalize;" 
												title="Ax'l Daniel Kim"
										/>
									</div>
							
							
									<div class="form-group col-md-4">
										<label>Address:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoSpouseAddress" 
												value='<?php echo $appInfoSpouseAddress?>' 
												maxlength="100" 
												onchange="validateSpouseAddress()"
												id="name_appInfoSpouseAddress"
												style="text-transform: capitalize;" 
												title="143 Pureza St., Sta. Mesa, Manila"
										/>
									</div>
							
									<div class="form-group col-md-4">
										<label>Spouse Occupation:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoSpouseOccupation" 
												value='<?php echo $appInfoSpouseOccupation?>' 
												maxlength="250"
												onchange="validateSpouseOcc()"
												id="name_appInfoSpouseOccupation"
												style="text-transform: capitalize;" 
												title="Freelance Model"
										/>
									</div>
									<div class="form-group col-md-4">
										<label>Name of Child:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfChild[]" 
												value='<?php echo $appInfoNumberOfChildren?>' 
												id="name_appInfoNameOfChild[]"
												maxlength="250" 
												onchange="validateChildName()"
												
										/>
									</div>

									<div class="form-group col-md-2">
										<label>Age:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoAgeOfChild[]" 
												value='<?php echo $appInfoAgesOfChildren?>' 
												maxlength="2" 
												placeholder=""  
												id="name_appInfoAgeOfChild[]"
												onchange="validateChildAge()"
												
										/>
									</div>

									<div class="form-group col-md-2">
										<label>
											Gender:
										</label>
											<select type="position" 
													class="form-control"  
													id="name_appInfoGenderOfChild[]"
													name="name_appInfoGenderOfChild[]">
													<option value="Male" selected>Male</option>
													<option value="Female">Female</option>
											 </select>
									</div>	

									


									<div class="form-group col-md-3">
										<label>Civil Status: </label>
										<select type="appCivilStatus" 
												class="form-control"  
												id="name_appInfoCivilStatusOfChild[]"
												name="name_appInfoCivilStatusOfChild[]"
												onchange ="childCivilStatus()">
												<option value="" selected>Civil Status</option>
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Widowed">Widowed</option>
												<option value="Legally Separated">Legally Separated</option>
												<option value="Annulled">Annulled</option>
										 </select>
									</div>	

									<div class="form-group col-md-1">
										<button type="button" 
												class="add_field_button btn btn-default"
												name ="add" 
												id = "add" 
												style="margin-top: 1.75em;"
												>
												Add 
										</button>
									</div>   

									<div class="form-group col-md-12">
									</div>
									
									<div class="input_fields_wrap">
									</div>

								
									<div class="form-group col-md-8">
										<label>Father's Name: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfFather" 
												value='<?php echo $appInfoNameOfFather?>' 
												maxlength="250" 
												id="name_appInfoNameOfFather"
												style="text-transform: capitalize;" 
												title="Jose Dela Cruz"
												onchange="validateFatherName()"
												required
										/>
									</div>
									<div class="form-group col-md-4">
										<label>Father's Occupation:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoOccupationOfFather" 
												value='<?php echo $appInfoOccupationOfFather?>' 
												maxlength="250"
												id="name_appInfoOccupationOfFather"
												title="Programmer"
												style="text-transform: capitalize;" 
												onchange="validateFatherOcc()"
										/>
									</div>
								
								
									<div class="form-group col-md-8">
										<label>Mother's Maiden Name: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoNameOfMother" 
												value='<?php echo $appInfoNameOfMother?>' 
												maxlength="250"
												id="name_appInfoNameOfMother"
												title="Joselita Porcalla"
												style="text-transform: capitalize;" 
												onchange="validateMotherName()"
										/>
									</div>
								
									<div class="form-group col-md-4">
										<label>Mother's Occupation:</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoOccupationOfMother" 
												value='<?php echo $appInfoOccupationOfMother?>' 
												maxlength="250"
												id="name_appInfoOccupationOfMother"
												title="Bank Manager"
												style="text-transform: capitalize;" 
												onchange="validateMotherOcc()"
										/>
									</div>
								
									<div class="form-group col-md-4">
										<label>Person to be notified in case of emergency: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoEmergencyContactPerson" 
												value='<?php echo $appInfoEmergencyContactPerson?>' 
												maxlength="250"  
												id="name_appInfoEmergencyContactPerson"
												style="text-transform: capitalize;" 
												title="Joselita Dela Cruz" 
												required
												onchange="validateNotifName()"
										/>
									</div>
								
									<div class="form-group col-md-4">
										<label>Address: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoAddressOfContactPerson" 
												value='<?php echo $appInfoAddressOfContactPerson?>' 
												maxlength="250"
												id="name_appInfoAddressOfContactPerson"
												title="143 Quirino Ave, San Bartolome, Quezon City"
												style="text-transform: capitalize;" 
												required
												onchange="validateNotifAdd()"
										/>
									</div>
									<div class="form-group col-md-4">
										<label>Contact Number: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoContactNumberOfContactPerson" 
												value='<?php echo $appInfoContactNumberOfContactPerson?>' 
												maxlength="250"
												id="name_appInfoContactNumberOfContactPerson"
												title="09123654987" 
												required
												onchange="validateNotifCont()"
										/>
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
													onClick="location.href='apply2.php'" >
							      				<span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Previous
							      			</button>

										

								</div>
								<div class="form-group col-md-2">
								
									<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="familyNext" 
											id = "familyNext" 
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