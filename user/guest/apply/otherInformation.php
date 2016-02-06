<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../guestNav.php'); // native to admin
?>

<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
         $(wrapper).append("<div class='form-group col-md-12'><div class='form-group col-md-6' style='padding-top: .2em;'><select type='position' class='form-control'  id='name_appInfoLicenseName[]' name='name_appInfoLicenseName[]'><option value='Driver License' selected>Driver's License</option><option value='PhilHealth'>PhilHealth</option><option value='PAG IBIG'>PAG IBIG</option><option value='GSIS'>GSIS</option><option value='SSS'>SSS</option><option value='TIN'>TIN</option><option value='NBI'>NBI</option></select></div><div class='form-group col-md-5'><input type='text' class='form-control' name='name_appInfoLicenseDescription[]' value='' maxlength='25' placeholder='' id='name_appInfoLicenseDescription[]'/></div><a href='#'class='remove_field'>Remove</a></div>"); //add input box
       
	   }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>



<?php

	$appInfoDriversLicense = '';
	$appInfoLicenseRestriction = '';
	$appInfoPassport = '';
	$appInfoSSS = '';
	$appInfoGSIS = '';
	$appInfoTIN = '';
	$appInfoNBI = '';
	$appInfoPAGIBIG = '';
	$appInfoPhilHealth = '';
	
	if (isset($_SESSION['ses_applyPage7'])) 
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
			$appInfoCharacterReferenceName = $row['appInfoCharacterReferenceName'];
			$appInfoCharacterReferenceOccupation = $row['appInfoCharacterReferenceOccupation'];
			$appInfoCharacterReferenceAddress = $row['appInfoCharacterReferenceAddress'];
			$appInfoCharacterReferenceContactNumber = $row['appInfoCharacterReferenceContactNumber'];
			$appInfoDriversLicense = $row['appInfoDriversLicense'];
			$appInfoLicenseRestriction = $row['appInfoLicenseRestriction'];
			$appInfoPassport = $row['appInfoPassport'];
			$appInfoSSS = $row['appInfoSSS'];
			$appInfoGSIS = $row['appInfoGSIS'];
			$appInfoTIN = $row['appInfoTIN'];
			$appInfoNBI = $row['appInfoNBI'];
			$appInfoPAGIBIG = $row['appInfoPAGIBIG'];
			$appInfoPhilHealth = $row['appInfoPhilHealth'];
		}//while
		
	}//if set

?>


			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Other Information</li>
				</ul>
			</div>

	
			<div class="container-fluid" id="other">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
							Fields with asterisk (*) are required.</h4> 		
					
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:80%">
							    80% Complete
							  </div>
						</div>
					</div>

					<form method="POST" action="../../../config/insertAppOtherInformation.php" name = "myForm" onsubmit = "return validateForm()">
	
								<legend>Other Information </legend>
									
								
								<div class="input_fields_wrap">
									
								<div class="form-group col-md-12">
									<div class="form-group col-md-6" style="padding-top: .2em;">
										<label>
											Select Other Information:
										</label>
											<select type="position" 
													class="form-control"  
													id="name_appInfoLicenseName[]"
													name="name_appInfoLicenseName[]">
													<option value="Driver License" Selected>Driver's License</option>
													<option value="PhilHealth">PhilHealth</option>
													<option value="PAG IBIG">PAG IBIG</option>
													<option value="GSIS">GSIS</option>
													<option value="SSS">SSS</option>
													<option value="TIN">TIN</option>
													<option value="NBI">NBI</option>
													
											 </select>
									</div>	
									<div class="form-group col-md-5">
												<label>Number/Details:</label>
												<input type="text" 
														class="form-control" 
														name="name_appInfoLicenseDescription[]" 
														value='<?php echo $appInfoLicenseRestriction ?>' 
														maxlength="25" 
														placeholder=""
														id="name_appInfoLicenseDescription[]"
												/>
									</div>
								</div>	
									
								</div>
									
								<div class="form-group col-md-1 col-md-offset-11">
											<button style="margin-top:1em;" 
													class="add_field_button btn btn-default" 
													name="addSchool" 
													id="addSchool"
													>
													<span class="glyphicon glyphicon-plus"></span>&nbsp;Add
											</button>
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
													onClick="location.href='apply6.php'" >
							      				<span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Previous
							      	</button>

										

								</div>
								<div class="form-group col-md-2">
								
									<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="personalNext" 
											id = "personalNext" 
											style="margin-top: 2em;">
					      				 Next &nbsp;
												 <span class="glyphicon glyphicon-chevron-right"></span>
					      			</button>
					      		</div>
								
								<div class="form-group col-md-3">
								</div>
						
								<div class="form-group col-md-12">
								</div>
								
								<div class="form-group col-md-12">
								</div>
								
		</div>
			
	</form>
					</div>
				</div>




<?php
 	include('../footer.php');
 ?> 