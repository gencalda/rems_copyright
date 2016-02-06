<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');

	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>

	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client Information</li>
		</ul>

	</div>



	<div class="container-fluid">
		<form method="POST" action="#">
			<div class="form-group col-md-10">
				<?php	
					$ID=$_SESSION['login_userId'] ;
					$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error());
						}
					
					mysql_select_db("$db_database", $con);
					
					$query = mysql_query("SELECT * FROM tbl_client a, tbl_address b, tbl_contact_info c WHERE a.clientId = $ID AND b.clientId = $ID AND c.clientId = $ID AND a.clientId = b.clientId AND a.clientId = c.clientId AND c.clientId = b.clientId");
					
					while ($row = mysql_fetch_array($query))
					{
						$clientName = $row['clientName'];
						$clientEmail = $row['clientEmail'];
						$addBlock = $row['addBlock'];
						$addStreet = $row['addStreet']; 
						$addSubdivision = $row['addSubdivision'];
						$addBarangay = $row['addBarangay'];
						$addDistrict = $row['addDistrict'];
						$addCity = $row['addCity'];
						$addProvince = $row['addProvince'];
						$addCountry = $row['addCountry'];
						$addZip = $row['addZip'];
						$contactDevice = $row['contactDevice'];
						$contactNumber = $row['contactNumber'];
					}
				?>	
			</div>
		</form>
	
	
		<div class="col-md-12 wrapper-background">
			<nav class="navbar nav2">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h2><a href="clientInformation.php?token=<?php echo $main; ?>">Client Information</a></h2></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="clientInformation.php?token=<?php echo $main; ?>"><span class="glyphicon glyphicon-arrow-left"></span> Client Information</a></li>
					</ul>
				</div>
			</nav>

			<div class='container-fluid content'>
					<form method="POST" action="../../../config/clientUpdate.php">
						<div class="form-group col-md-10">
						</div>

						<fieldset class="col-md-12">
							<legend>Client Details</legend>
							<div class="form-group col-md-8">
								<label>Client Name, Branch Name: * </label>
								<input type="text" 
										class="form-control" 
										name="clientName" 
										value='<?php echo $clientName;?>' 
										maxlength="250"   
										
								/>
							</div>

							<div class="form-group  col-md-2">
									<label>Start of Contract: *</label>
									<input type="text" 
											class="form-control" 
											name="clientStartContract" 
											value="<?php echo $date;?>"  
											maxlength="11" 
											disabled
											placeholder="Start of Contract" 
									/>
							</div>
							
							<div class="form-group col-md-2">
									<label>End of Contract: *</label>
									<input type="date" 
											disabled
											class="form-control" 
											name="clientEndContract" 
											value='' 
											maxlength="75" 
									/>
							</div>
							
							
							<div >
								<input type="hidden" 
										class="form-control" 
										name="clientStatus" 
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
											style="margin-top: .3em;"
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
								
							<!--<div class="form-group col-md-8">
								<label for="name_addStreet">Type of Business: *</label>
								<input type="text" 
										class="form-control" 
										name="name_addStreet" 
										value='' 
										maxlength="250"   
										id="name_addStreet"
										style="text-transform: capitalize;" 
										title=""
								/>
								<br /><br />
							</div>-->

						<!-- insert into tbl-address -->
						
						

					
							
							<legend>Client Address</legend>
								
							
							<div class="form-group col-md-3">
								<label for="name_addBlock">Blk No., Lot No., Phase No.:</label>
								<input type="text" 
										class="form-control" 
										name="name_addBlock" 
										value='<?php echo $addBlock; ?>' 
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
										value='<?php echo $addStreet; ?>' 
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
										value='<?php echo $addSubdivision; ?>' 
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
										value='<?php echo $addBarangay; ?>' 
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
										value='<?php echo $addDistrict; ?>' 
										maxlength="250"   
										id="name_addDistict"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>


							<div class="form-group col-md-3">
								<label for="name_addCity">City/Municipality: *</label>
								<input type="text" 
										class="form-control" 
										name="name_addCity" 
										value='<?php echo $addCity; ?>' 
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
										value='<?php echo $addProvince; ?>' 
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
										value='<?php echo $addCountry; ?>' 
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
										value='<?php echo $addZip; ?>' 
										maxlength="250"   
										id="name_addZipCode"
										style="text-transform: capitalize;" 
										title=""
								/>
							</div>


							<!-- insert into tbl_contact_info -->

					<div class="col-md-12"><br /></div>
							
							
							<legend>Contact Information</legend>


								<div class="form-group col-md-3">
											<label>Device: * </label>
											<input type="text" 
													class="form-control" 
													name="name_device" 
													value='<?php echo $contactDevice; ?>' 
													maxlength="250"   
													required
													placeholder=""
											/>
										</div>

										<div class="form-group col-md-3">
											<label>Contact Number: * </label>
											<input type="text" 
													class="form-control" 
													name="name_contactNumber" 
													value='<?php echo $contactNumber; ?>' 
													maxlength="250"   
													required
													placeholder=""
											/>
										</div>


										<div class="form-group col-md-6">
											<label>Email: * </label>
											<input type="text" 
													class="form-control" 
													name="name_clientEmail" 
													value='<?php echo $clientEmail; ?>' 
													maxlength="250"   
													required
													placeholder="username@email.com"
											/>
										</div>

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
										style="margin-top: 2em; "
										onclick="enableTextbox()">
									 	Next &nbsp;
									 <span class="glyphicon glyphicon-chevron-right"></span>
				      			</button>
				      		
				      	</div>
										
										


						</fieldset>


					</form>

			</div>
		</div>
	</div>




<?php
	include ('../footer.php');
?>