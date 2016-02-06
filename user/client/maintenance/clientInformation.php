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
					$ID=$_SESSION['login_userId'];
					$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error());
						}
					
					mysql_select_db("$db_database", $con);
					
					$query = mysql_query("SELECT * FROM tbl_client a, tbl_address b, tbl_contact_info c, tbl_type_of_business d WHERE a.typeOfBusinessId = d. typeOfBusinessId AND a.clientId = $ID AND b.clientId = $ID AND c.clientId = $ID AND a.clientId = b.clientId AND a.clientId = c.clientId AND c.clientId = b.clientId");
					
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
						$typeofbusiness = $row['typeOfBusinessName'];
					}
				?>	
			</div>
		</form>
	
	
		<div class="col-md-12 wrapper-background">
			<nav class="navbar nav2">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h2><a href="maintenanceClientAdd.php?token=<?php echo $main; ?>">Client Information</a></h2></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="updateClient.php?token=<?php echo $main; ?>&searchClient=11"><span class="glyphicon glyphicon-edit"> </span> Update Client</a></li>
					</ul>
				</div>
			</nav>

			<div class='container-fluid content'>
					<form method="POST" action="../../../config/clientInsert.php">
						<div class="form-group col-md-10">
						</div>

						<fieldset class="col-md-12">
							<legend>Client Details</legend>
							<div class="form-group col-md-8">
								<label>Client Name, Branch Name: * </label>
								<input type="text" 
										autofocus="autofocus"
										class="form-control" 
										name="clientName" 
										value='<?php echo $clientName;?>'
										maxlength="250"   
										disabled 
										
								/>
							</div>

							<div class="form-group  col-md-2">
									<label>Start of Contract: *</label>
									<input type="text" 
											autofocus="autofocus"
											class="form-control" 
											name="clientStartContract" 
											value="<?php echo $date;?>"  
											maxlength="11" 
											placeholder="Start of Contract" 
											disabled 
									/>
							</div>
							
							<div class="form-group col-md-2">
									<label>End of Contract: *</label>
									<input type="date" 
											autofocus="autofocus"
											class="form-control" 
											name="clientEndContract" 
											value='' 
											maxlength="75" 
											 disabled
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
										disabled
								/>
							</div>

					

							
							<div class="form-group col-md-8">
								<label for="name_addStreet">Type of Business: *</label>
								<input type="text" 
										class="form-control" 
										name="name_addStreet" 
										value='<?php echo $typeofbusiness; ?>' 
										maxlength="250"   
										id="name_addStreet"
										style="text-transform: capitalize;" 
										title=""
										disabled
								/>
							</div>

						<!-- insert into tbl-address -->
						
						<div class="col-md-4" style="margin-top:1.7em;">
							<strong>
								 Click <a href="jobPostingAddNew.php?token=<?php echo $main; ?>" target="_blank"><span class="btn btn-primary">here</span></a> to add job post for this client.
							</strong>
						</div>


						<div class="col-md-4">
							<br /><br />
						</div>
							
							
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
										disabled
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
										disabled
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
										disabled
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
										disabled
								/>
							</div>

							<div class="form-group col-md-3">
								<label for="name_appDistict">Disctrict Name: </label>
								<input type="text" 
										class="form-control" 
										name="name_appDistict" 
										value='<?php echo $addDistrict; ?>' 
										maxlength="250"   
										id="name_appDistict"
										style="text-transform: capitalize;" 
										title=""
										disabled
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
										disabled
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
										disabled
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
										disabled
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
										disabled
								/>
							</div>


							<!-- insert into tbl_contact_info -->

						<div class="col-md-12"><br />
							
							
							<legend>Contact Information</legend>

								<div class="form-group col-md-6">
									<label>Email: * </label>
									<input type="text" 
											autofocus="autofocus"
											class="form-control" 
											name="name_clientName" 
											value='<?php echo $clientEmail; ?>' 
											maxlength="250"   
											required
											placeholder="username@email.com"
											 disabled
									/>
								</div>
								
								<div class="form-group col-md-6 table-responsive">
									<table class="table">
										<tr>
											<td>Device </td>
											<td><?php echo $contactDevice; ?> </td>
										</tr>
										<tr>
											<td>Mobile</td>
											<td><?php echo $contactNumber; ?></td>
										</tr>
									</table>
								</div>

								
						</div>

										

									

						</fieldset>


					</form>

			</div>
		</div>
	</div>




<?php
	include ('../footer.php');
?>