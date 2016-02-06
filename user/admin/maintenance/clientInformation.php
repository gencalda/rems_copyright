<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>

	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="client.php?token=<?php echo $main; ?>">Client</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client Information</li>
		</ul>

	</div>




	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h2><a href="maintenanceClientAdd.php?token=<?php echo $main; ?>">Client Information</a></h2></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="clientUpdate.php?token=<?php echo $main; ?>&searchClient=11" target="_blank"><span class="glyphicon glyphicon-edit"> </span> Update Client</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="client.php?token=<?php echo $main; ?>"><span class="glyphicon glyphicon-arrow-left"> </span> Client</a></li>
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
										value='' 
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
										value='' 
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
								 Click <a href="jobPostingAdd.php" target="_blank"><span class="btn btn-primary">here</span></a> to add job post for this client.
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
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
										value='' 
										maxlength="250"   
										id="name_addZipCode"
										style="text-transform: capitalize;" 
										title=""
										disabled
								/>
							</div>


							<!-- insert into tbl_contact_info -->

					<div class="col-md-12"><br /></div>
							
							
							<legend>Contact Information</legend>


								<div class="form-group col-md-3">
											<label>Device: * </label>
											<input type="text" 
													class="form-control" 
													name="name_contactNumber" 
													value='' 
													maxlength="250"   
													required
													placeholder=""
													disabled
											/>
										</div>

										<div class="form-group col-md-3">
											<label>Contact Number: * </label>
											<input type="text" 
													class="form-control" 
													name="name_contactNumber" 
													value='' 
													maxlength="250"   
													required
													placeholder=""
													disabled
											/>
										</div>


										<div class="form-group col-md-6">
											<label>Email: * </label>
											<input type="text" 
													autofocus="autofocus"
													class="form-control" 
													name="name_clientName" 
													value='' 
													maxlength="250"   
													required
													placeholder="username@email.com"
													 disabled
											/>
										</div>

										<div class="form-group col-md-12">
											<label>Notes: </label>
											<textarea class="form-control" 
													name="name_notes" 
													value="No Description'"
													rows="5"
													maxlength="500" 
													disabled
													id="name_notes"></textarea>
												<br /><br />

										</div>


						</fieldset>


					</form>

			</div>
		</div>
	</div>


<br /><br /><br />



<?php
	include ('../footer.php');
?>