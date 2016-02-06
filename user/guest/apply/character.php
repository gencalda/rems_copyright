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
         $(wrapper).append('<div class="form-group col-md-12"><br><br><br><legend></legend><div class="form-group col-md-6"><label>Full Name: *</label><input type="text" class="form-control" name="name_appInfoCharacterReferenceName[]" value="" maxlength="100" id="name_appInfoCharacterReferenceName[]" required /></div><div class="form-group col-md-2"><label>Contact Number: *</label><input type="text" class="form-control" name="name_appInfoCharacterReferenceContactNumber[]" value="" maxlength="20" id="name_appInfoCharacterReferenceContactNumber[]" required /></div><div class="form-group col-md-4"><label>Position: *</label><input type="text" class="form-control" name="name_appInfoCharacterReferenceOccupation[]" value="" maxlength="100" id="name_appInfoCharacterReferenceOccupation[]" required /></div><div class="form-group col-md-6"><label>Company Name: *</label><input type="text" class="form-control" name="name_appInfoCharacterReferenceCompanyName[]" value="" id="name_appInfoCharacterReferenceCompanyName[]" required /></div><div class="form-group col-md-6"><label>Company Address: *</label><input type="text" class="form-control" name="name_appInfoCharacterReferenceAddress[]" value="" id="name_appInfoCharacterReferenceAddress[]" required /></div><a style="text-decoration:underline"; href="#" class="remove_field">Remove</a></div>'); //add input box
       
	   }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


<?php

	$appInfoCharacterReferenceName = '';
	$appInfoCharacterReferenceOccupation = '';
	$appInfoCharacterReferenceAddress = '';
	$appInfoCharacterReferenceContactNumber = '';
	
	$appInfoCharacterReferenceCompanyName = '';
	
	if (isset($_SESSION['ses_applyPage6'])) 
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
		}//while
		
	}//if set

?>


			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Character Reference</li>
				</ul>
			</div>

	
			<div class="container-fluid" id="character">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
							Fields with asterisk (*) are required.</h4> 		
					
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:70%">
							    70% Complete
							  </div>
						</div>
					</div>

					<form method="POST" action="../../../config/insertAppCharacter.php" name = "myForm" onsubmit = "return validateForm()">
	
		
								<legend>Character References </legend>
									
									<div class="form-group col-md-6">
											<label>Full Name: *</label>
											<input type="text" 
													class="form-control" 
													name="name_appInfoCharacterReferenceName[]" 
													value='<?php echo $appInfoCharacterReferenceName ?>' 
													maxlength="100" 
													id="name_appInfoCharacterReferenceName[]"
													required
											/>
									</div>

									<div class="form-group col-md-2">
										<label>Contact Number: *</label>
										<input type="text" 
												class="form-control" 
												name="name_appInfoCharacterReferenceContactNumber[]" 
												value='<?php echo $appInfoCharacterReferenceContactNumber ?>' 
												maxlength="20"
												id="name_appInfoCharacterReferenceContactNumber[]"
												required
										/>
									</div>

									<div class="form-group col-md-4">
											<label>Position: *</label>
											<input type="text" 
													class="form-control" 
													name="name_appInfoCharacterReferenceOccupation[]" 
													value='<?php echo $appInfoCharacterReferenceOccupation ?>' 
													maxlength="100" 
													id="name_appInfoCharacterReferenceOccupation[]"
													required
											/>
									</div>

									<div class="form-group col-md-6">
											<label>Company Name: *</label>
											<input type="text" 
													class="form-control" 
													name="name_appInfoCharacterReferenceCompanyName[]" 
													value='<?php echo $appInfoCharacterReferenceCompanyName ?>' 
													id="name_appInfoCharacterReferenceCompanyName[]"
													required
											/>
									</div>

									<div class="form-group col-md-6">
											<label>Company Address: *</label>
											<input type="text" 
													class="form-control" 
													name="name_appInfoCharacterReferenceAddress[]" 
													value='<?php echo $appInfoCharacterReferenceAddress ?>' 
													id="name_appInfoCharacterReferenceAddress[]"
													required
											/>
									</div>
								
									
									<div class="input_fields_wrap">
									</div>
									
									<div class="form-group col-md-2 col-md-offset-9">
											<button style="margin-top:2em;" 
													class="add_field_button btn btn-default" 
													name="addSchool" 
													id="addSchool"
													>
													<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Character Reference
											</button>
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
													onClick="location.href='apply5.php'" >
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