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

<?php
	//values from db
	$txtboxCtr = 0;
	$add_basicLastNameArr = array();
	$add_basicFirstNameArr = array();
	$add_basicMiddleNameArr = array();
	$add_basicExtNameArr = array();
	$add_basicPositionArr = array();
	$add_basicEmailArr = array();
	
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
					
								if (!$con)
								{
									die('Could not connect: ' . mysql_error()); 
								}
								mysql_select_db("$db_database", $con);
						
						$txtboxCtr = mysql_num_rows(mysql_query("SELECT * FROM tbl_basic_info WHERE clientId = '".$_SESSION['ses_clientId_forContactUpdate']."'"));
						
						$query = mysql_query("SELECT * FROM  tbl_basic_info WHERE clientId = '".$_SESSION['ses_clientId_forContactUpdate']."'");
						
					
						$ctr=0; 	// counter
						while($row = mysql_fetch_array($query))
						{
							$add_basicLastNameArr[$ctr] = $row['basicLastName'];
							$add_basicFirstNameArr[$ctr] = $row['basicFirstName'];
							$add_basicMiddleNameArr[$ctr] = $row['basicMiddleName'];
							$add_basicExtNameArr[$ctr] = $row['basicExtName'];
							$add_basicPositionArr[$ctr] = $row['basicPosition'];
							$add_basicEmailArr[$ctr] = $row['basicEmail'];
							$ctr++;
						}//while

?>

<script type="text/javascript" src="../../../script/jquery.js"></script>
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
         $(wrapper).append('<div class="form-group col-md-12"><legend style="padding:0.75em;"></legend><div class="form-group col-md-3"> <label>Last Name: * </label> <input type="text" class="form-control" name="name_basicLastName[]" value="" maxlength="250"  id="name_basicLastName[]" /></div><div class="form-group col-md-3"><label>First Name: * </label><input type="text" class="form-control" name="name_basicFirstName[]" value="" maxlength="250"  id="name_basicFirstName[]"/></div><div class="form-group col-md-3"><label>Middle Name:  </label><input type="text" class="form-control" name="name_middleName[]" value="" maxlength="250"  id="name_middleName[]" /></div><div class="form-group col-md-3"><label>Name Ext.:  </label><input type="text" class="form-control" name="name_extName[]" value="" maxlength="250"  id="name_extName[]" /></div><div class="form-group col-md-6"><label>Position of Contact Person: </label><input type="text" name="name_basicPosition[]" class="form-control" value="" maxlength="250" id="name_basicPosition[]" /></div><div class="form-group  col-md-6"><label>Email Address: </label><input type="email" autofocus="autofocus"class="form-control" name="name_basicEmail[]" value="" maxlength="75" placeholder="your.email@server.com"  id="name_basicEmail[]"/></div><div class="form-group col-md-11"></div><a style="text-decoration:underline"; href="#" class="remove_field">Remove</a></div>'); //add input box
       
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
			<li><a href="client.php">Client</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="clientAdd.php">Add Client</a></li></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client Contact Person</li>
		</ul>

	</div>


	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; padding:.5em;">
			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="clientAdd.php" style="margin-left:.5em;">Client Contact Person</a></h3></li>
					</ul>
			  	</div>
			</nav>
		</div>
	</div>

	

	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
			<h4 class="alert-info well-lg">Update the information of client's contact person. 
				Fields with asterisk (*) are required. </h4> 		
			<br />
			<div class='container-fluid content'>
					<form method="POST" action="../../../config/clientUpdateContactDetails.php">
					<!-- action="../../config/clientInsertContactDetails.php" -->
						<div class="form-group col-md-10">
						</div>

						<fieldset class="col-md-12">
							

						<!-- insert into tbl-basic_info -->

							<legend>Contact Person</legend>
							<div class="input_fields_wrap">
							<?php
								
									
										$ctr=1;
										$i=0;
								
										while($ctr <= $txtboxCtr)
										{
										
												echo'
												<div class="form-group col-md-12"><legend style="padding:0.75em;"></legend>
														<div class="form-group col-md-3">
														<label>Last Name: * </label>
														<input type="text" 
														class="form-control" 
														name="name_basicLastName[]" 
														value="'.$add_basicLastNameArr[$i].'"
														maxlength="250"  
														id="name_basicLastName[]"
																		/>
																</div>

													<div class="form-group col-md-3">
															<label>First Name: * </label>
															<input type="text" 
																	class="form-control" 
																	name="name_basicFirstName[]" 
																	value="'.$add_basicFirstNameArr[$i].'" 
																	maxlength="250"  
																	id="name_basicFirstName[]"
															/>
													</div>

													<div class="form-group col-md-3">
															<label>Middle Name:  </label>
															<input type="text" 
																	class="form-control" 
																	name="name_basicMiddleName[]" 
																	value="'.$add_basicMiddleNameArr[$i].'" 
																	maxlength="250"  
																	id="name_basicMiddleName[]"
															/>
													</div>

													<div class="form-group col-md-3">
															<label>Name Ext.:  </label>
															<input type="text" 
																	class="form-control" 
																	name="name_basicExtName[]" 
																	value="'.$add_basicExtNameArr[$i].'"  
																	maxlength="250"  
																	id="name_basicExtName[]"
															/>
													</div>
													


													<div class="form-group col-md-6">
															<label>Position of Contact Person: </label>
															<input type="text" 
																	class="form-control" 
																	name="name_basicPosition[]" 
																	value="'.$add_basicPositionArr[$i].'" 
																	maxlength="250" 
																	id="name_basicPosition[]"
															/>
													</div>
													
													
													<div class="form-group  col-md-6">
															<label>Email Address: </label>
															<input type="email" 
																	class="form-control" 
																	name="name_basicEmail[]" 
																	value="'.$add_basicEmailArr[$i].'"  
																	maxlength="75" 
																	placeholder="your.email@server.com"  
																	id="name_basicEmail[]"
															/>
															
													</div>
													
													<div class="form-group  col-md-11">
													</div>
													<a href="#" class="remove_field">Remove</a>
												</div>	
												';
												
											$i++;
											$ctr++;
											
										}//while
										echo'</div>'; //wrapper
										
								?>
								
								<div class="form-group col-md-10">
										</div>
										<div class="form-group col-md-2">
										<button 
												class="add_field_button btn btn-default" 
												name="addContactPerson" 
												id="addContactPerson"
												style="margin-top: 1em; "
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
										class="btn btn-success btn-md btn-block"
										name ="submit" 
										style="margin-top: 2em; ">
									 	Update &nbsp;
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