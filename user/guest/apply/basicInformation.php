<?php

	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../guestNav.php');

	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
	$formNum = date("Y-m") . "-";
	$formNum .= rand(1,9999);

	$appInfoLastName = '';
	$appInfoFirstName = '';
	$appInfoMiddleName = '';
	$appInfoStatus = '';
	$appInfoZip = '';
	$appInfoAddress = '';
	$appInfoLandline = '';
	$appInfoMobile = '';
	$appInfoEmail = '';
	
	$address = array();
	$address[0] = '';
	$address[1] = '';
	$address[2] = '';
	
	$appLanguages = array();
	
	if (isset($_SESSION['ses_applyPage1'])) 
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
			$appInfoLastName = $row['appInfoLastName'];
			$appInfoFirstName = $row['appInfoFirstName'];
			$appInfoMiddleName = $row['appInfoMiddleName'];
			$appInfoStatus = $row['appInfoStatus'];
			$appInfoZip = $row['appInfoZip'];
			$appInfoAddress = $row['appInfoAddress'];
			$appInfoLandline = $row['appInfoLandline'];
			$appInfoMobile = $row['appInfoMobile'];
			$appInfoEmail = $row['appInfoEmail'];
		}
		
		//$address = explode("/",$appInfoAddress);
		
	}//isset
	

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
		         $(wrapper).append('<div class="form-group col-md-12"><div class="form-group col-md-3"></div><div class="form-group col-md-3"><select type="device" class="form-control"  id="name_basic_contactDevice[]" name="name_basic_contactDevice[]"><option value="Landline">Landline</option> <option value="Mobile" selected>Mobile</option> <option value="Fax">Fax</option></select></div><div class="form-group col-md-3"><input type="text" class="form-control" name="name_basic_contactNumber[]" id="name_basic_contactNumber2[]" onchange="validateContact2()" value="" maxlength="250" required /></div><a href="#" class="remove_field" onclick="enableButton()">Remove</a><div class="form-group col-md-3"></div></div>'); //add input box
		       
			   }
		    });
		    
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent('div').remove(); x--;
		    })
			
			
		});

		
		</script>

						

	<!-- START OF THE BODY -->

			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php?tab=home">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Basic Information</li>
				</ul>
			</div>

	
		
			<div class="container-fluid" id="basic">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">I
							Instructions: Fill up the form with complete information. <br />
							Fields with asterisk (*) are required.
					</h4> 		
					<br /><br />

					<form method="POST" action="../../../config/insertAppBasicInformation.php" name = "myForm" onsubmit = "return validateForm()" enctype="multipart/form-data">
					
						<legend>Basic Information</legend>
						
						<div class="form-group col-md-3 center" >
							<label>Picture:</label>
							<br />
							<img class="img img-thumbnail img-rounded"  
									id="uploadPreview1" 
									src="../../../image/no_image.jpg" /><br />
							<br />
							<input class="form-control"   
									id="uploadImage1" 
									type="file" 
									name="name_basicPicture" 
									onchange="PreviewImage(1); validateImage()" />
						</div>
					
						

						<div class="form-group col-md-3">
							<label>Date: </label>
							<input type="text" 
									class="form-control" 
									name="name_basicDate" 
									value="<?php echo $date;?>" 
									id="name_basicDate"
									readonly
									 
							/>
						</div>



						<div class="form-group col-md-3">
							<label for="appEmail">Email Address: *</label>
							<input type="email" 
									class="form-control" 
									name="name_basicEmail" 
									value='<?php echo $_POST['email'] ?>' 
									maxlength="250" 
									id="name_basicEmail"
									title="juan.miguel_delacruz@gmail.com"
									readonly
							/>
						</div>

							
						<div class="form-group col-md-9"></div>
						
								
						<div class="form-group col-md-3">
							<label> Surname: * </label>
							<input type="text" 
									class="form-control" 
									name="name_basicLastName" 
									maxlength="250"
									id="name_basicLastName"
									onchange="validateLastName()"
									title="Dela Cruz" 
									required								 
							/>
						</div>

						<div class="form-group col-md-3">
							<label> Given Name: *</label>
							<input type="text" 
									class="form-control" 
									name="name_basicFirstName" 
									value='' 
									maxlength="250"
									id="name_basicFirstName"
									onchange="validateFirstName()" 
									title="Juan"
									style="text-transform: capitalize;"
									required
							/>
						</div>

						<div class="form-group col-md-2">
							<label> Middle Name: </label>
							<input type="text" 
									class="form-control" 
									name="name_basicMiddleName" 
									value='' 
									maxlength="250"
									onchange="validateMiddleName()" 
									id="name_basicMiddleName"
									style="text-transform: capitalize;"
									title="Miguel"
							/>
						</div>

						<div class="form-group col-md-1">
							<label> Ext. Name: </label>
							<input type="text" 
									class="form-control" 
									name="name_basicExtName" 
									value='' 
									maxlength="250"
									onchange="validateExtName()" 
									style="text-transform: capitalize;"
									placeholder="Jr/Sr, IV"
									id="name_basicExtName"
									title="Jr/Sr, IV"
							/>
						</div>
			
						<!--insert into tbl_contact_info -->

						<div class="form-group col-md-3">
							<label>
								Select Device: * 
							</label>
							<select type="device" 
									class="form-control"  
									id="name_basic_contactDevice[]"
									name="name_basic_contactDevice[]">
									<option value="Landline" selected>Landline</option>
									<option value="Mobile">Mobile</option>
									<option value="Fax">Fax</option>
							 </select>
						</div>

						<div class="form-group col-md-3">
							<label>Contact Number: * </label>
							<input type="text" 
									class="form-control" 
									name="name_basic_contactNumber[]" 
									id="name_basic_contactNumber[]"
									value='' 
									onchange="validateContact()" 
									maxlength="250"   
									required								 
							/>
						</div>
						
						<div class="form-group col-md-6"></div>
						
						<div class="input_fields_wrap">
						</div>
						
						<div class="form-group col-md-9"></div>

						<div class="form-group col-md-3">
							<button style="margin-top:2px;" 
									class="add_field_button btn btn-default" 
									name="addContactDevice" 
									id="addContactDevice"
									onclick="disable()"
									>
									<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Contact Number
							</button>
						</div>		

						<!--/insert into tbl_contact_info -->		

						
						<div class="form-group col-md-2 col-md-offset-5">
							
								<button type="submit" 
										class="btn btn-primary btn-md btn-block"
										name ="basicNext" 
										id = "basicNext" 
										disabled="true"
										style="margin-top: 2em; ">
									 	Next &nbsp;
									 <span class="glyphicon glyphicon-chevron-right"></span>
				      			</button>	
				      	</div>
					
					</form>
				</div>

			</div>




<?php
	include('../footer.php');
?> 
