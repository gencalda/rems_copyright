<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
	
	$main = md5('maintenance');
	
?>

<script type="text/javascript" src="../../../script/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
	var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
    var add_button2     = $(".add_field_button2"); //Add button ID
    
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

<?php
// getting values from DB

	$clientID = '';
	$clientName = '';
	$clientStatus = '1';
	$clientEmail = '';
	$clientNotes = '';
	$clientBusinessTypeId = '';
	$clientTypeOfBusinessID = '';
	$clientTypeOfBusinessName = 'Select Type of Business';
	$clientStartContract = '';
	$clientEndContract = '';
	$clientContractStatus = '';
	$addBlock = '';
	$addStreet = '';
	$addSubdivision = '';
	$addBrgy = '';
	$addDistict = '';
	$addCity = '';
	$addProvince = '';
	$addCountry = '';
	$addZipCode = '';
	
	$txtboxCtr = 0;
	$contactDeviceArr = array();
	$contactNumberArr = array();

	
	if (isset($_GET['searchClient'])) 
	{
					//putting selected clientId into session variable
					$_SESSION["ses_clientId_forContactUpdate"] = $_GET['searchClient'];
					
						$query ="SELECT * FROM tbl_client WHERE clientId = '".$_SESSION['ses_clientId_forContactUpdate']."'";
						
						if ($result = $mysqli->query($query))
						{
							while($obj=$result->fetch_object())
							{
								$clientID = $obj->clientId;
								$clientName = $obj->clientName;
								$clientEmail = $obj->clientEmail;
								$clientNotes = $obj->clientNotes;
								$clientTypeOfBusinessID = $obj->typeOfBusinessId;
							}//while
						}//if
						
						$query ="SELECT * FROM tbl_type_of_business WHERE typeOfBusinessId = '".$clientTypeOfBusinessID."'";
						
						if ($result = $mysqli->query($query))
						{
							while($obj=$result->fetch_object())
							{
								$clientTypeOfBusinessName = $obj->typeOfBusinessName;
							}//while
						}//if
						
						$query ="SELECT * FROM tbl_contract WHERE clientId = '".$_SESSION['ses_clientId_forContactUpdate']."'";
						
						if ($result = $mysqli->query($query))
						{
							while($obj=$result->fetch_object())
							{
								$clientStartContract = $obj->contractStartDate;
								$clientEndContract = $obj->contractEndDate;
								$clientContractStatus = $obj->contractStatus;
							}//while
						}//if
						
						$query ="SELECT * FROM tbl_address WHERE clientId = '".$_SESSION['ses_clientId_forContactUpdate']."'";
						
						if ($result = $mysqli->query($query))
						{
							while($obj=$result->fetch_object())
							{
								$addBlock = $obj->addBlock;
								$addStreet = $obj->addStreet;
								$addSubdivision = $obj->addSubdivision;
								$addBrgy = $obj->addBarangay;
								$addDistict = $obj->addDistrict;
								$addCity = $obj->addCity;
								$addProvince = $obj->addProvince;
								$addCountry = $obj->addCountry;
								$addZipCode = $obj->addZip;
							}//while
						}//if
						
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
			
						if (!$con)
						{
							die('Could not connect: ' . mysql_error()); 
						}
						mysql_select_db("$db_database", $con);
						
						$query = mysql_query("SELECT * FROM tbl_contact_info WHERE clientId = '".$_SESSION['ses_clientId_forContactUpdate']."'");
			
						$txtboxCtr = mysql_num_rows(mysql_query("SELECT * FROM tbl_contact_info WHERE clientId = '".$_SESSION['ses_clientId_forContactUpdate']."'"));
					
						$ctr=0; 	// counter
						while($row = mysql_fetch_array($query))
						{
							$contactDeviceArr[$ctr] = $row['contactDevice'];
							$contactNumberArr[$ctr] = $row['contactNumber'];
							$ctr++;
						}//while
						
	}//if
	
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Maintenance</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="maintenanceClient.php">Client</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Update Client</li>
		</ul>

	</div>

	
	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="clientUpdate.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Browse Client to Update</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="clientAdd.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-plus"> </span> Add Client</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="client.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span> Client</a></li>
					</ul>
			  	</div>

			</nav>
	

	<h4 class="alert-info well-lg instruction">Update Client Information.
			Fields with asterisk (*) are required.</h4> 		
			<br /><br />
			<div class="container-fluid contents">
				<form name="formDropdown" method="GET" action="#">
					<div class="form-group col-md-5">
						<?php

							echo "<input type='hidden' name='token' value='$main' />";
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
										if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
									
										mysql_select_db("$db_database", $con);
										$result = mysql_query("SELECT * FROM tbl_client ORDER BY clientId");
							
							
						?>
						
						<select class="form-control" id="searchClient" name="searchClient" onChange="document.forms['formDropdown'].submit()">
						<option value="" selected>Search Client to Update</option>
						<?php	
							
							while ($row = mysql_fetch_array($result))
								{
									echo "<option value='" . $row['clientId'] . "'> " . $row['clientName'] . " </option>";	
								}//while
								
								mysql_close($con);
							echo "</select>"; 
						?>
								
					</div>


					
					<br />					
					<br />
				</form>
				</div>
								
								
				<div class='container-fluid content'>
					<form method="POST" action="../../../config/clientUpdate.php">
						<div class="form-group col-md-10">
						</div>

						<fieldset class="col-md-12">
							<legend>Client Details</legend>
							<div class="form-group col-md-6">
								<label>Client Name: * </label>
								<input type="text" 
										class="form-control" 
										name="name_clientName" 
										value='<?php echo $clientName ?>' 
										maxlength="250"   
										
								/>
							</div>
							
							<input type="hidden" 
										class="form-control" 
										name="name_clientId" 
										value='<?php echo $clientID ?>' 
										maxlength="15"   
										
								/>

							<div class="form-group  col-md-12">
								
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
																	
										echo "<select type='position' class='form-control' id='name_searchBusinessType' name='name_searchBusinessType' onchange = 'enableTextboxBusinessType()'>";
							?>
							<option value="<?php echo $clientTypeOfBusinessID ?>" selected><?php echo $clientTypeOfBusinessName ?></option>
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
								
								<!-- galing to sa select nationality -->				

						<div class="form-group col-md-3">
							<label></label>
								<input type="text" 
										class="form-control" 
										name="name_BusinessTypeOthers" 
										id="name_BusinessTypeOthers"
										value=''
										maxlength="250" 
										style="margin-top:.5em;"
										placeholder="Others, please specify"
										style="text-transform: capitalize;"
										disabled = true
								/>
						</div>
											

									
						<div class="form-group col-md-4">
					
							<button class="btn btn-primary btn-md btn-block" 
									type="button" 
									name="SelectBusinessTypeFromList" 
									id="SelectBusinessTypeFromList" 
									style="display:none; margin-top: 1.75em;" 
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
							
						<div class="col-md-12"><br /></div>
						
						

				<!-- insert into tbl-address -->	
							
							<legend>Client Address</legend>
								
							
							<div class="form-group col-md-3">
								<label for="name_addBlock">Blk No., Lot No., Phase No.:</label>
								<input type="text" 
										class="form-control" 
										name="name_addBlock" 
										value='<?php echo $addBlock ?>' 
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
										value='<?php echo $addStreet ?>' 
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
										value='<?php echo $addSubdivision ?>' 
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
										value='<?php echo $addBrgy ?>' 
										maxlength="250"   
										id="name_addBrgy"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>

							<div class="form-group col-md-3">
								<label for="name_appDistict">Disctrict Name: </label>
								<input type="text" 
										class="form-control" 
										name="name_addDistict" 
										value='<?php echo $addDistict ?>' 
										maxlength="250"   
										id="name_appDistict"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>


							<div class="form-group col-md-3">
								<label for="name_addCity">City/Municipality: *</label>
								<input type="text" 
										class="form-control" 
										name="name_addCity" 
										value='<?php echo $addCity ?>' 
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
										value='<?php echo $addProvince ?>' 
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
										value='<?php echo $addCountry ?>' 
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
										value='<?php echo $addZipCode ?>' 
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
											<label>Email: * </label>
											<input type="text" 
													class="form-control" 
													name="name_clientEmail" 
													value='<?php echo $clientEmail ?>' 
													maxlength="250"   
													required
													placeholder="username@email.com"
													 
											/>
										</div>
								<div class="input_fields_wrap">
								<?php
								
									if (isset($_GET['searchClient'])) 
									{
										$ctr=1;
										$i=0;
								
										while($ctr <= $txtboxCtr)
										{
										
												echo'
												<div class="form-group col-md-12">
													<div class="form-group col-md-5">
														<label>
															Select Device: *
														</label>
															<select type="position" 
																	class="form-control"  
																	id="name_contactDevice[]"
																	name="name_contactDevice[]">
																	<option value="'.$contactDeviceArr[$i].'" selected>'.$contactDeviceArr[$i].'</option>
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
																value="'.$contactNumberArr[$i].'"
																maxlength="250"   
																required
																placeholder=""
																 
														/>
													</div>
													
													<a href="#" class="remove_field">Remove</a>
													
												</div>
												';
												
											$i++;
											$ctr++;
											
										}//while
										echo'</div>'; //wrapper
									}//if
									else 
									{
										echo'
											<div class="form-group col-md-5">
												<label>
													Select Device: *
												</label>
													<select type="position" 
															class="form-control"  
															id="name_contactDevice[]"
															name="name_contactDevice[]">
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
														value=""
														maxlength="250"   
														required
														placeholder=""
														 
												/>
											</div>
											
											<div class="form-group col-md-1">
											</div>
										';
									}
								?>
								
										
										<div class="form-group col-md-10">
										</div>
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
													value="<?php echo $clientNotes ?>"
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
										name ="submit" 
										style="margin-top: 2em; ">
									 	Next &nbsp;
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