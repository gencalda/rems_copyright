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
	         $(wrapper).append('<div class="form-group col-md-12"><hr><div class="form-group col-md-12"><label>Company Name:</label><input type="text" class="form-control" name="name_appWorkCompanyName[]"  title="Ink Heart Inc. Philippines" style="text-transform: capitalize;" /></div><div class="form-group col-md-3"><label>Work Year:</label><input type="text" class="form-control" name="name_appWorkYear[]" title="2008-2010" id="name_appWorkYear[]" /></div><div class="form-group col-md-3"><label>Position:</label><input type="text" class="form-control" name="name_appWorkPosition[]" title="Book Keeper" style="text-transform: capitalize;" /></div><div class="form-group col-md-3"><label>Salary: </label><input type="text" class="form-control" name="name_appWorkSalary[]" /></div><div class="form-group col-md-3"><label>Immediate Supervisor:</label><input type="text" class="form-control" name="name_appWorkImmediateSupervisor[]" style="text-transform: capitalize;" /></div><div class="form-group col-md-12"><label>Reason for Leaving:</label><textarea class="form-control" name="name_appWorkReason[]" rows="5" ></textarea></div> <div class="form-group col-md-11"></div><a style="text-decoration:underline"; href="#" class="remove_field">Remove</a></div>'); //add input box
	       
		   }
	    });
	    
	    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	        e.preventDefault(); $(this).parent('div').remove(); x--;
	    })
	});
</script>

<?php
	$txtboxCtr = 0;
	$appWorkCompanyName = array();
	$appWorkYear = array();
	$appWorkPosition = array();
	$appWorkSalary = array();
	$appWorkImmediateSupervisor = array();
	$appWorkReason = array();
	
	if (isset($_SESSION['ses_applyPage5']))
	{
	
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
			
			if (!$con)
			{
				die('Could not connect: ' . mysql_error()); 
			}
			mysql_select_db("$db_database", $con);
			
		$txtboxCtr = mysql_num_rows(mysql_query("SELECT * FROM appWork WHERE applicantID = '".$_SESSION['ses_applicantID']."'"));
		
		$query = mysql_query("SELECT * FROM appWork WHERE applicantID = '".$_SESSION['ses_applicantID']."'");
		
		$ctr=0; 	// counter
			while($row = mysql_fetch_array($query))
			{
				$appWorkCompanyName[$ctr] = $row['appWorkCompanyName'];
				$appWorkYear[$ctr] = $row['appWorkYear'];
				$appWorkPosition[$ctr] = $row['appWorkPosition'];
				$appWorkSalary[$ctr] = $row['appWorkSalary'];
				$appWorkImmediateSupervisor[$ctr] = $row['appWorkImmediateSupervisor'];
				$appWorkReason[$ctr] = $row['appWorkReason'];
				$ctr++;
			}//while
			
		
	}//
	
?>

			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Employment History</li>
				</ul>
			</div>

	
				<div class="container-fluid" id="work">
					<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
						<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
								Fields with asterisk (*) are required.</h4> 		
						
						<div class="col-md-12">
							<div class="progress">
								  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
								  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:60%">
								    60% Complete
								  </div>
							</div>
						</div>

				<form method="POST" action="../../../config/insertAppWork.php" name = "myForm" onsubmit = "return validateForm()">
	
		<div class="container col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
		
								<legend>Work Experience</legend>
								
								<div class="input_fields_wrap">
									<?php
										if (!(isset($_SESSION['ses_applyPage5'])))
										{
											echo'
											<div class="form-group col-md-12">
												<div class="form-group col-md-12">
														<label for="name_appInfoCompanyName">Company Name:</label>
														<input type="text" 
																class="form-control" 
																name="name_appWorkCompanyName[]" 
																value="" 
																maxlength="250"
																id="name_appWorkCompanyName[]"
																title="Ink Heart Inc. Philippines" 
																style="text-transform: capitalize;" 
														/>
												</div>
												
												
												<div class="form-group col-md-3">
														<label for="name_appInfoWorkYear">Work Year:</label>
														<input type="text" 
																class="form-control" 
																name="name_appWorkYear[]" 
																value=""
																maxlength="9"
																title="2008-2010" 
																id="name_appWorkYear[]"
														/>
												</div>
												<div class="form-group col-md-3">
														<label for="name_appInfoPosition">Position:</label>
														<input type="text" 
																class="form-control" 
																name="name_appWorkPosition[]" 
																value=""
																maxlength="250"
																title="Book Keeper" 
																id="name_appWorkPosition[]"
																style="text-transform: capitalize;" 
														/>
												</div>
											
												<div class="form-group col-md-3">
														<label for="name_appInfoSalary">Salary: </label>
														<input type="text" 
																class="form-control" 
																name="name_appWorkSalary[]" 
																value=""
																maxlength="12"
																id="name_appWorkSalary[]"
																placeholder="Php" 
														/>
												</div>
												<div class="form-group col-md-3">
														<label for="name_appInfoImmediateSupervisor">Immediate Supervisor:</label>
														<input type="text" 
																class="form-control" 
																name="name_appWorkImmediateSupervisor[]" 
																value=""
																maxlength="100" 
																id="name_appWorkImmediateSupervisor[]"
																style="text-transform: capitalize;" 
														/>
												</div>
												
												
												
												<div class="form-group col-md-12">
														<label for="name_appInfoReasonForLeaving">Reason for Leaving:</label>
														<textarea class="form-control" 
																name="name_appWorkReason[]" 
																rows="5"
																maxlength="500" 
																id="name_appWorkReason[]"></textarea>
												</div>
												
												
												
											</div>	
											';
										}//if
										else if (isset($_SESSION['ses_applyPage5']))
										{
											$ctr=1;
											$i=0;
											while($ctr <= $txtboxCtr)
											{
													echo'
												<div class="form-group col-md-12">
													<div class="form-group col-md-12">
															<label for="name_appInfoCompanyName">Company Name:</label>
															<input type="text" 
																	class="form-control" 
																	name="name_appWorkCompanyName[]" 
																	value="'.$appWorkCompanyName[$i].'" 
																	maxlength="250"
																	id="name_appWorkCompanyName[]"
																	title="Ink Heart Inc. Philippines" 
																	style="text-transform: capitalize;" 
															/>
													</div>
													
													
													<div class="form-group col-md-3">
															<label for="name_appInfoWorkYear">Work Year:</label>
															<input type="text" 
																	class="form-control" 
																	name="name_appWorkYear[]" 
																	value="'.$appWorkYear[$i].'"
																	maxlength="9"
																	title="2008-2010" 
																	id="name_appWorkYear[]"
															/>
													</div>
													<div class="form-group col-md-3">
															<label for="name_appInfoPosition">Position:</label>
															<input type="text" 
																	class="form-control" 
																	name="name_appWorkPosition[]" 
																	value="'.$appWorkPosition[$i].'"
																	maxlength="250"
																	title="Book Keeper" 
																	id="name_appWorkPosition[]"
																	style="text-transform: capitalize;" 
															/>
													</div>
												
													<div class="form-group col-md-3">
															<label for="name_appInfoSalary">Salary: </label>
															<input type="text" 
																	class="form-control" 
																	name="name_appWorkSalary[]" 
																	value="'.$appWorkSalary[$i].'"
																	maxlength="12"
																	id="name_appWorkSalary[]"
																	placeholder="Php" 
															/>
													</div>
													<div class="form-group col-md-3">
															<label for="name_appInfoImmediateSupervisor">Immediate Supervisor:</label>
															<input type="text" 
																	class="form-control" 
																	name="name_appWorkImmediateSupervisor[]" 
																	value="'.$appWorkImmediateSupervisor[$i].'"
																	maxlength="100" 
																	id="name_appWorkImmediateSupervisor[]"
																	style="text-transform: capitalize;" 
															/>
													</div>
													
													
													
													<div class="form-group col-md-12">
															<label for="name_appInfoReasonForLeaving">Reason for Leaving:</label>
															<textarea class="form-control" 
																	name="name_appWorkReason[]" 
																	value="'.$appWorkReason[$i].'"
																	rows="5"
																	maxlength="500" 
																	id="name_appWorkReason[]">'.$appWorkReason[$i].'</textarea>
													</div>
													<div class="form-group col-md-11"></div>
													<a style="text-decoration:underline"; href="#" class="remove_field">Remove</a>
												</div>
												';
												$i++;
												$ctr++;
											}//while
										}//else if
									?>
								</div>
								<div class="form-group col-md-2 col-md-offset-10">
											<button style="margin-top:2em;" 
													class="add_field_button btn btn-default" 
													name="addSchool" 
													id="addSchool"
													>
													<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Work Experience
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
													onClick="location.href='apply4.php'" >
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