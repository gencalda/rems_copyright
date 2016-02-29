<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>
	<script type="text/javascript">
		$(function() 
		{
		    $( "#datepicker" ).datepicker();
		  });
  	</script>

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
		         $(wrapper).append('<div class="form-group col-md-12"><div class="form-group col-md-5"><select type="device" class="form-control"  id="name_contactDevice[]" name="name_contactDevice[]" required> <option value="" selected>Select Device</option><option value="Landline">Landline</option> <option value="Mobile">Mobile</option> <option value="Fax">Fax</option> </select></div><div class="form-group col-md-6"><input type="text" class="form-control"  name="name_contactNumber[]" id="name_contactNumber[]"  required /></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
		       
			   }
		    });
		    
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent('div').remove(); x--;
		    })
			
			
		});
		
	</script>
	
	<script type = "text/javascript">
	
	function addClientValidation(){
						document.getElementById("submitAddClient").disabled = false;
						
						if( (document.getElementById("name_searchBusinessType").value=="general")  || ( (document.getElementById("name_searchBusinessType").value=="others") && (document.getElementById("name_BusinessTypeOthers").value==""))) 
						{
							alert("Please enter the Type of Business.");
							return false;
						}
						
						}//function
						
	</script>


	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="../maintenance/Client.php?token=<?php echo $main; ?>">Client</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Add Client</li>
		</ul>

	</div>



	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="maintenanceClientAdd.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Add Client</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="clientUpdate.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update Client</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="client.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span> Client</a></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">Fill up the form with client's complete information. 
				Fields with asterisk (*) are required. </h4> 		
			<br />
			<div class='container-fluid content'>
					<form name="formAddClient" method="POST" action="../../../config/clientInsert.php" onsubmit=" return addClientValidation()">
						<div class="form-group col-md-10">
						</div>

						<fieldset class="col-md-12">
							<legend>Client Details</legend>
							<div class="form-group col-md-8">
								<label>Client Name, Branch Name: * </label>
								<input type="text"
										class="form-control" 
										name="name_clientName" 
										id="name_clientName"
										value='' 
										maxlength="250" 										
										required
								/>
							</div>

							<div class="form-group  col-md-4">
							</div>
							
							
							<div >
								<input type="hidden" 
										class="form-control" 
										name="name_clientStatus" 
										value='1' 
										maxlength="1" 
										placeholder="Client Status"  
										id="name_clientStatus"
										
								/>
							</div>

					

							
							<div class="form-group col-md-5">
								<label>Type of Business: *</label>

								<?php	
											$con = mysql_connect("$db_hostname","$db_username","$db_password");
											if (!$con)
											{
												die('Could not connect: ' . mysql_error());
											}
										
											mysql_select_db("$db_database", $con);
											$result = mysql_query("SELECT * FROM tbl_type_of_business WHERE typeOfBusinessStatus = 1");
																		
											echo "<select class='form-control' id='name_searchBusinessType' name='name_searchBusinessType' onchange = 'enableTextboxBusinessType()' required aria-required='true' >";
								?>
								<option value="general" >Select Type of Business</option>
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
								<label></label>
									<input type="text" 
											class="form-control" 
											name="name_BusinessTypeOthers" 
											id="name_BusinessTypeOthers"
											value=''
											maxlength="250" 
											style="margin-top:.2em;"
											placeholder="Others, please specify"
											style="text-transform: capitalize;"
											required
											disabled = true
									/>
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
											required
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
											required
									/>
								</div>

								<div class="form-group col-md-3">
									<label for="name_appDistrict">Disctrict Name: </label>
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
											required
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
											required
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
											required
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
											required
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
												id="name_clientEmail"
												value='' 
												maxlength="250"   
												required
												placeholder="clientemail@email.com"
												 
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
													name="name_contactDevice[]" required >
													 <option value="" selected>Select Device</option>
													<option value="Landline">Landline</option>
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
												placeholder=""
												 required
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
										
									<div class="form-group col-md-12">
										<label>Notes: </label>
										<textarea class="form-control" 
												name="name_clientNotes" 
												value="No description available'"
												rows="5"
												maxlength="500" 
												id="name_clientNotes"></textarea>
											<br /><br />
									</div>


						</fieldset>

						
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

<br /><br /><br />



<?php
	include ('../footer.php');
?>