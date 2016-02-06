<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../guestNav.php'); // native to guest

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
         $(wrapper).append('<div class="form-group col-md-12"><div class="form-group col-md-4"><input type="text" class="form-control"  name="name_appEducNameOfSchool[]"/></div><div class="form-group col-md-3"><select type="schoolLevel" class="form-control"  id="name_appEducSchoolLevel[]" name="name_appEducSchoolLevel[]"> <option value="" selected>Select School Level</option><option value="Elementary">Elementary</option> <option value="Secondary">Secondary</option> <option value="College">College</option><option value="Vocational">Vocational</option> <option value="Other">Other</option> </select></div><div class="form-group col-md-4"><input type="text" class="form-control"  name="name_appEducSchoolAddress[]"/></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
       
	   }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

<?php
	$txtboxCtr = 0;
	$selectedLevel = 'Select School Level';
	$appEducNameOfSchool = array();
	$appEducSchoolLevel = array();
	$appEducSchoolAddress = array();
	
	if (isset($_SESSION['ses_applyPage4'])) 
	{
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
			
			if (!$con)
			{
				die('Could not connect: ' . mysql_error()); 
			}
			mysql_select_db("$db_database", $con);
			
			$query = mysql_query("SELECT * FROM appEducation WHERE applicantID = '".$_SESSION['ses_applicantID']."'");
			
			$txtboxCtr = mysql_num_rows(mysql_query("SELECT * FROM appEducation WHERE applicantID = '".$_SESSION['ses_applicantID']."'"));
		//	echo "cnt: ".$cnt;
			
			$ctr=0; 	// counter
			while($row = mysql_fetch_array($query))
			{
				$appEducNameOfSchool[$ctr] = $row['appEducNameOfSchool'];
				$appEducSchoolLevel[$ctr] = $row['appEducSchoolLevel'];
				$appEducSchoolAddress[$ctr] = $row['appEducSchoolAddress'];
				$ctr++;
			}
		
	}//
	
?>

			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Educational Attainment</li>
				</ul>
			</div>

	
			<div class="container-fluid" id="education">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
							Fields with asterisk (*) are required.</h4> 		
					
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:50%">
							    50% Complete
							  </div>
						</div>
					</div>

					<form method="POST" action="../../../config/insertAppEducation.php" name = "myForm" onsubmit = "return validateForm()">
	
						<div class="container col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
						
					
								<legend>Educational Attainment</legend>
								
								<div class="input_fields_wrap">
								<?php 
									if (!(isset($_SESSION['ses_applyPage4'])))
									{
										echo'
										<div class="form-group col-md-12">
											<div class="form-group col-md-4">
													<label>Name of School:</label>
													<input type="text" 
															class="form-control" 
															name="name_appEducNameOfSchool[]" 
															value=""
															maxlength="250"
															id="name_appEducNameOfSchool[]"
															style="text-transform: capitalize;" 
															title="Rizal High School" 
															
													/>
												</div>
												
												<div class="form-group col-md-3">
													<label>School Level 
													</label>
													<select type="schoolLevel" 
													class="form-control"  
													id="name_appEducSchoolLevel[]"
													name="name_appEducSchoolLevel[]">
													<option value="'.$selectedLevel.'" selected>'.$selectedLevel.'</option>
													<option value="Elementary">Elementary</option>
													<option value="Secondary">Secondary</option>
													<option value="College">College</option>
													<option value="Vocational">Vocational</option>
													<option value="Other">Other</option>
													</select>
												</div>
										
											<div class="form-group col-md-4">
												<label for="name_appInfoSchoolAddress">School Address:</label>
												<input type="text" 
														class="form-control" 
														name="name_appEducSchoolAddress[]" 
														value=""
														maxlength="250" 
														id="name_appEducSchoolAddress[]"
														style="text-transform: capitalize;" 
														title="Pasig City" 
												/>
											</div>
											<div class="form-group col-md-1">
											</div>
										</div>
											'; 
									}//if
									else if (isset($_SESSION['ses_applyPage4']))
									{
										$ctr=1;
										$i=0;
										while($ctr <= $txtboxCtr)
										{
											echo'
										<div class="form-group col-md-12">
											<div class="form-group col-md-4">';
												if ($ctr == 1)
													{ echo'<label>Name of School:</label>';}
											echo'
													<input type="text" 
															class="form-control" 
															name="name_appEducNameOfSchool[]" 
															value="'.$appEducNameOfSchool[$i].'"
															maxlength="250"
															id="name_appEducNameOfSchool[]"
															style="text-transform: capitalize;" 
															title="Rizal High School" 
															
													/>
												</div>
												
												<div class="form-group col-md-3">';
												if ($ctr == 1)												
												{echo'<label>School Level 
													</label>';}
												echo'
													<select type="schoolLevel" 
													class="form-control"  
													id="name_appEducSchoolLevel[]"
													name="name_appEducSchoolLevel[]">
													<option value="'.$appEducSchoolLevel[$i].'" selected>'.$appEducSchoolLevel[$i].'</option>
													<option value="Elementary">Elementary</option>
													<option value="Secondary">Secondary</option>
													<option value="College">College</option>
													<option value="Vocational">Vocational</option>
													<option value="Other">Other</option>
													</select>
												</div>
										
											<div class="form-group col-md-4">';
												if ($ctr == 1)
												{echo'<label for="name_appInfoSchoolAddress">School Address:</label>';}
												echo'
												<input type="text" 
														class="form-control" 
														name="name_appEducSchoolAddress[]" 
														value="'.$appEducSchoolAddress[$i].'"
														maxlength="250" 
														id="name_appEducSchoolAddress[]"
														style="text-transform: capitalize;" 
														title="Pasig City" 
												/>
											</div>';
											if ($ctr != 1)
											{
											echo'<a href="#" class="remove_field">Remove</a>';
											}
											echo'
										</div>
											'; 
											$i++;
											$ctr++;
										}//while
										if ($i==0)
										{
											echo'
										<div class="form-group col-md-12">
											<div class="form-group col-md-4">
													<label>Name of School:</label>
													<input type="text" 
															class="form-control" 
															name="name_appEducNameOfSchool[]" 
															value=""
															maxlength="250"
															id="name_appEducNameOfSchool[]"
															style="text-transform: capitalize;" 
															title="Rizal High School" 
															
													/>
												</div>
												
												<div class="form-group col-md-3">
													<label>School Level 
													</label>
													<select type="schoolLevel" 
													class="form-control"  
													id="name_appEducSchoolLevel[]"
													name="name_appEducSchoolLevel[]">
													<option value="'.$appEducSchoolLevel[$i].'" selected>'.$appEducSchoolLevel[$i].'</option>
													<option value="Elementary">Elementary</option>
													<option value="Secondary">Secondary</option>
													<option value="College">College</option>
													<option value="Vocational">Vocational</option>
													<option value="Other">Other</option>
													</select>
												</div>
										
											<div class="form-group col-md-4">
												<label for="name_appInfoSchoolAddress">School Address:</label>
												<input type="text" 
														class="form-control" 
														name="name_appEducSchoolAddress[]" 
														value=""
														maxlength="250" 
														id="name_appEducSchoolAddress[]"
														style="text-transform: capitalize;" 
														title="Pasig City" 
												/>
											</div>
											<div class="form-group col-md-1">
											</div>
										</div>
											'; 
										}
									}//else if
								?>
									
								</div>
													
								<div class="form-group col-md-1 col-md-offset-11">
											<button style="margin-top:2em;" 
													class="add_field_button btn btn-default" 
													name="addSchool" 
													id="addSchool"
													>
													<span class="glyphicon glyphicon-plus"></span>&nbsp;Add
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
													onClick="location.href='apply3.php'" >
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