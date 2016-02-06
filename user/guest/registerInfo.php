<?php
	ob_start();
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/link.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php');
	
	$home = md5('home');
	
	if(!isset($_GET['token']))
	{
		$tab = "";
	}
	else if ($_GET['token'] == md5('register'))
	{
		$tab = $_GET['token'];
	}
	else
	{
		header('Location: index.php?token=<?php echo $home;?>');
	}
	
	$companyEmail = mysql_real_escape_string($_POST['companyEmail']);

	$companyName = mysql_real_escape_string($_POST['companyName']);
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
		         $(wrapper).append('<div class="form-group col-md-12"><div class="form-group col-md-5"><select type="device" class="form-control"  id="name_contactDevice[]" name="name_contactDevice[]"> <option value="" selected>Select Device</option><option value="Landline">Landline</option> <option value="Mobile">Mobile</option> <option value="Fax">Fax</option> </select></div><div class="form-group col-md-6"><input type="text" class="form-control"  name="name_contactNumber[]" id="name_contactNumber[]"/></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
		       
			   }
		    });
		    
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent('div').remove(); x--;
		    })
			
			
		});
		
	</script>
		
		
	<script type = "text/javascript">
	function enableTextbox(){
						document.getElementById("submitAddClient").disabled = false;
						document.formAddClient.submit();
						}
	</script>
		
			<div class="container-fluid">
				<div class="container-fluid  content">
					<div class="col-md-12 well well-lg" style="margin-bottom:7em; margin-top:3em;">
						<h3>Information about <?php echo $companyName ?></h3>
						<br /><br />
						<form class="form center-block" role="form" action="../../config/insertClientRegisterDetails.php" method="POST">
						
						<fieldset class="col-md-12">
						
						<input type="hidden"
							value="<?php echo $companyName; ?>" 
							name="name_clientName"
						/>

						<legend>Type of Business:</legend>
						
						<div class="form-group col-md-5">
								<label>Type of Business: *</label>
								<?php	
											$con = mysql_connect("$db_hostname","$db_username","$db_password");
											if (!$con)
											{
												die('Could not connect: ' . mysql_error());
											}
										
											mysql_select_db("$db_database", $con);
											$result = mysql_query("SELECT * FROM tbl_type_of_business WHERE typeOfBusinessStatus = 1 ORDER BY typeOfBusinessName");
																		
											echo "<select type='position' class='form-control' id='name_searchBusinessType' name='name_searchBusinessType' onchange = 'enableTextboxBusinessType()'>";
								?>
								<option value="General" selected>Select Type of Business</option>
								<!--<option value="any">Any</option>-->
								<?php		
									while ($row = mysql_fetch_array($result))
									{
										echo "<option value='" . $row['typeOfBusinessId'] . "'> " . $row['typeOfBusinessName'] . " </option>";	
									}//while
									
									mysql_close($con);
								?>
								<option value="others">Others</option>
								<?php echo "</select >"; ?>
												
							</div>
								
							<div class="form-group col-md-3">
								<label> </label>
									<input type="text" 
											class="form-control" 
											name="name_BusinessTypeOthers" 
											id="name_BusinessTypeOthers"
											value=''
											maxlength="250" 
											style="margin-top: 1.5em;"
											placeholder="Others, please specify"
											style="text-transform: capitalize;"
											disabled
										>
							</div>
								
											

									
							<div class="form-group col-md-4">
						
								<button class="btn btn-primary btn-md btn-block" 
										type="button" 
										name="SelectBusinessTypeFromList" 
										id="SelectBusinessTypeFromList" 
										style="display:none; margin-top: 1.5em;" 
										onclick="enableListBusinessType()">
										<span class="glyphicon glyphicon glyphicon-list"></span>&nbsp; Select Type of Business from the list
								</button>
							</div>	

										
								<script type = "text/javascript">
								
								
								function enableTextboxBusinessType()
								{
									if (document.getElementById("name_searchBusinessType").value == "others") 
									{
									document.getElementById("name_BusinessTypeOthers").disabled = false;
									document.getElementById("name_BusinessTypeOthers").setAttribute('placeholder',"Please specify Business Type");
									document.getElementById("name_searchBusinessType").disabled = true;
									document.getElementById("SelectBusinessTypeFromList").style.display = "block";

									}//if
								
								}//function
								
								function enableListBusinessType(){
								document.getElementById("name_BusinessTypeOthers").disabled = true;
								document.getElementById("name_searchBusinessType").disabled = false;
								document.getElementById("name_searchBusinessType").selectedIndex = 0;
								document.getElementById("SelectBusinessTypeFromList").style.display = "none";
								document.getElementById("name_BusinessTypeOthers").setAttribute('placeholder',"Others, please specify");
								document.getElementById("name_BusinessTypeOthers").value = "";
								}
								
									
								</script>

							<!-- insert into tbl-address -->
								
							<div class="col-md-12"><br /></div>
								
								
								<legend>Client Address</legend>
									
								
								<div class="form-group col-md-3">
									<label for="name_addBlock">Blk No., Lot No., Phase No.:</label>
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
									<label for="name_addStreet"> Street Name: *</label>
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
									<label for="name_addBrgy">Barangay: *</label>
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
									<label>Disctrict Name: </label>
									<input type="text" 
											class="form-control" 
											name="name_addDistrict" 
											value='' 
											maxlength="250"   
											id="name_addDistrict"
											style="text-transform: capitalize;" 
											title=""
									/>
								</div>


								<div class="form-group col-md-3">
									<label for="name_addCity">City/Municipality: *</label>
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
									<label for="name_addProvince">Province: *</label>
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
									<label for="name_addCountry">Country: *</label>
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
									<label for="name_addZipCode">Zip Code: *</label>
									<input type="text" 
											class="form-control" 
											name="name_addZipCode" 
											value='' 
											maxlength="250"   
											id="name_addZipCode"
											style="text-transform: capitalize;" 
											title=""
									/>
								</div>


							<!-- /insert into tbl_address -->


							<!-- insert into tbl_contact_info -->

							<div class="col-md-12"><br /></div>
							
							
							<legend>Contact Information</legend>
								<div class="form-group col-md-12">
									<div class="form-group col-md-5">
										<label>Email: * </label>
										<input type="text" 
												class="form-control" 
												name="name_clientEmail" 
												value='<?php echo $companyEmail ?>' 
												maxlength="250"   
												required
												placeholder="clientemail@email.com"
												readonly
												
												 
										/>
									</div>

									<div class="col-md-12"></div>

									<div class="form-group col-md-5">
										<label>
											Select Device: *
										</label>
											<select type="position" 
													class="form-control"  
													id="name_contactDevice[]"
													name="name_contactDevice[]">
													<option value="Landline" selected>Landline</option>
													<option value="Mobile">Mobile</option>
													<option value="Fax">Fax</option>
											 </select>
									</div>

									<div class="form-group col-md-6">
										<label>Contact Number: * </label>
										<input type="text" 
												class="form-control" 
												name="name_contactNumber[]"
												id="name_contactNumber[]"
												value='' 
												maxlength="250"   
												required
												placeholder=""
												 
										/>
									</div>
										
									<div class="form-group col-md-1"></div>
								</div>
										
										<div class="input_fields_wrap"></div>

										<div class="form-group col-md-10"></div>

									<div class="form-group col-md-2">
										<button  
												class="add_field_button btn btn-default" 
												name="addDevice" 
												id="addDevice"
												>
												<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Contact Number
										</button>
									</div>
										
							


						</fieldset>

						<br /><br />
						
						<div class="form-group col-md-2 col-md-offset-4">
								
								<button type="reset" 
										class="btn btn-danger btn-md btn-block"
										name ="reset" 
										tabindex="-1" 
										style="margin-top: 2em; ">
									 	Clear &nbsp;
									 <span class="glyphicon glyphicon-remove"></span>
				      			</button>
				      		
				      	</div>

				

						<div class="form-group col-md-2">
								
								<button type="submit" 
										class="btn btn-primary btn-md btn-block"
										name ="submitAddClient" 
										id="submitAddClient"
										style="margin-top: 2em; ">
									 	Next &nbsp;
									 <span class="glyphicon glyphicon-chevron-right"></span>
				      			</button>
				      		
				      	</div>

					  	</form>
					</div>
				</div>
			</div>
	
	
		
 <?php
 	include('footer.php');
 ?> 