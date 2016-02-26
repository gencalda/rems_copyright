<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");


	$clientName ='';
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error()); 
		}
		mysql_select_db("$db_database", $con);
		
		$query = mysql_query("SELECT * FROM tbl_client WHERE ".$_SESSION["ses_clientId_forContactAdd"]."");
		
		// display query results
		while($row = mysql_fetch_assoc($query))
		{
			$clientName = $row['clientName'];
		}//while
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
			         $(wrapper).append('<div class="form-group col-md-12"><legend style="padding:0.75em;"></legend><div class="form-group col-md-3"> <label>Last Name: * </label> <input type="text" class="form-control" name="name_basicLastName[]" value="" maxlength="250"  id="name_basicLastName[]" required /></div><div class="form-group col-md-3"><label>First Name: * </label><input type="text" class="form-control" name="name_basicFirstName[]" value="" maxlength="250"  id="name_basicFirstName[]" required /></div><div class="form-group col-md-3"><label>Middle Name:  </label><input type="text" class="form-control" name="name_middleName[]" value="" maxlength="250"  id="name_middleName[]" /></div><div class="form-group col-md-3"><label>Name Ext.:  </label><input type="text" class="form-control" name="name_extName[]" value="" maxlength="250"  id="name_extName[]" /></div><div class="form-group col-md-6"><label>Position of Contact Person: *</label><input type="text" name="name_basicPosition[]" class="form-control" value="" maxlength="250" id="name_basicPosition[]" required /></div><div class="form-group  col-md-6"><label>Email Address: *</label><input type="email" autofocus="autofocus"class="form-control" name="name_basicEmail[]" value="" maxlength="75" placeholder="your.email@server.com"  id="name_basicEmail[]" required/></div><div class="form-group col-md-11"></div><a style="text-decoration:underline"; href="#" class="remove_field">Remove</a></div>'); //add input box
			       
				   }
			    });
			    
			    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
			        e.preventDefault(); $(this).parent('div').remove(); x--;
			    })
				
				
			});
		</script>


	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="client.php?token=<?php echo $mainte; ?>">Client</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="clientAdd.php?token=<?php echo $mainte; ?>">Add Client</a></li></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client Contact Person</li>
		</ul>

	</div>



	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="clientAdd.php?token=<?php echo $mainte; ?>" style="margin-left:.5em;">Client Contact Person</a></h3></li>
					</ul>
			  	</div>
			</nav>

			<h4 class="alert-info well-lg instruction">Fill up the form with client's complete information. 
				Fields with asterisk (*) are required. </h4> 		
			<br />
			<div class='container-fluid content'>
					<form method="POST" action="../../../config/clientInsertContactDetails.php">
					<!-- action="../../config/clientInsertContactDetails.php" -->
						<div class="form-group col-md-10">
						</div>

						

							<div class="form-group col-md-6">
								<label>Client Name, Branch Name:  </label>
								<input type="text" 
										autofocus="autofocus"
										class="form-control" 
										name="name_clientName" 
										value="<?php echo $clientName ?>" 
										maxlength="250"   
										required
										placeholder="Client Name"
										disabled 
								/>
								<br />
							</div>

						<fieldset class="col-md-12">
							

					

							<legend>Contact Person</legend>
							
							
						
							<div class="form-group col-md-3">
									<label>Last Name: * </label>
									<input type="text" 
											class="form-control" 
											name="name_basicLastName[]" 
											value='' 
											maxlength="250"  
											id="name_basicLastName[]"
											required
									/>
							</div>

							<div class="form-group col-md-3">
									<label>First Name: * </label>
									<input type="text" 
											class="form-control" 
											name="name_basicFirstName[]" 
											value='' 
											maxlength="250"  
											id="name_basicFirstName[]"
											required
									/>
							</div>

							<div class="form-group col-md-3">
									<label>Middle Name:  </label>
									<input type="text" 
											class="form-control" 
											name="name_basicMiddleName[]" 
											value='' 
											maxlength="250"  
											id="name_basicMiddleName[]"
									/>
							</div>

							<div class="form-group col-md-3">
									<label>Name Ext.:  </label>
									<input type="text" 
											class="form-control" 
											name="name_basicExtName[]" 
											value='' 
											maxlength="250"  
											id="name_basicExtName[]"
									/>
							</div>
							


							<div class="form-group col-md-6">
									<label>Position of Contact Person: *</label>
									<input type="text" 
											class="form-control" 
											name="name_basicPosition[]" 
											value='' 
											maxlength="250" 
											id="name_basicPosition[]"
											required
									/>
							</div>
							
							
							<div class="form-group  col-md-6">
									<label>Email Address: *</label>
									<input type="email" 
											autofocus="autofocus"
											class="form-control" 
											name="name_basicEmail[]" 
											value='' 
											maxlength="75" 
											placeholder="username@email.com"  
											id="name_basicEmail[]"
											required
									/>
									
							</div>
							
							<div class="input_fields_wrap"></div>

							<div class="form-group col-md-1 col-md-offset-10">
										<button 
											class="add_field_button btn btn-default" 
											name="addContactPerson" 
											id="addContactPerson"
											>
											<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Contact Person
										</button>
										<br /><br /><br />
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
									 	Submit &nbsp;
									 <span class="glyphicon glyphicon-check"></span>
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