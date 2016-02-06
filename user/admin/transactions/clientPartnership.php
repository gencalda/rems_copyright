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

	
	<script type = "text/javascript">
	function enableTextbox(){
						document.getElementById("submitAddClient").disabled = false;
						document.formAddClient.submit();
						}
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
						<li><h3><a href="#?token=<?php echo $tran; ?>" style="margin-left:.5em;">Client Partnership</a></h3></li>
					</ul>
					
					<ul class="nav navbar-nav pull-right">
						<li><a href="#?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span> Client</a></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">Fill up the form with client's complete information. 
				Fields with asterisk (*) are required. </h4> 		
			<br />
			<div class='container-fluid content'>
					<form name="formAddClient" method="POST" action="clientPartnershipSuccess.php?token=<?php echo $tran; ?>">
						<div class="form-group col-md-10">
						</div>

						<fieldset class="col-md-12">
							<legend>Client Details</legend>
							<div class="form-group col-md-6">
								<label>Client Name, Branch Name: * </label>
								<?php	
											$con = mysql_connect("$db_hostname","$db_username","$db_password");
											if (!$con)
											{
												die('Could not connect: ' . mysql_error());
											}
										
											mysql_select_db("$db_database", $con);
											$result = mysql_query("SELECT tbl_client.clientId, tbl_client.clientName
																	FROM tbl_client
																	LEFT JOIN tbl_contract 
																	ON tbl_client.clientId = tbl_contract.clientId
																	WHERE tbl_contract.contractStatus = 'not started'
																	ORDER BY tbl_client.clientName");
																		
											echo "<select type='position' class='form-control' id='name_searchClientName' name='name_searchClientName' >";
								?>
								<option value="General" selected>Select Client Name</option>
								<!--<option value="any">Any</option>-->
								<?php		
									while ($row = mysql_fetch_array($result))
									{
										echo "<option value='" . $row['clientId'] . "'> " . $row['clientName'] . " </option>";	
									}//while
									
									mysql_close($con);
								?>
								<?php echo "</select >"; ?>
							</div>
							
							<div class="form-group col-md-2">
								<label>Access Code: * </label>
								<input type="text"
										class="form-control" 
										name="name_clientAccessCode" 
										value='' 
										maxlength="250"   
										
								/>
							</div>


							<div class="form-group  col-md-2">
									<label>Start of Contract: *</label>
									<input type="text" 
											autofocus="autofocus"
											class="form-control" 
											name="name_clientStartContract" 
											value="<?php echo $date;?>"  
											maxlength="11" 
											placeholder="Start of Contract" 
											readonly
									/>
							</div>
							
							<div class="form-group col-md-2">
									<label>End of Contract: *</label>
									<input type="text" 
											autofocus="autofocus"
											class="form-control" 
											id="datepicker"
											name="name_clientEndContract" 
											value='' 
											maxlength="75" 
											 
									/>
									<i class="form-control-feedback glyphicon glyphicon-calendar" style="margin-top:1.75em; margin-right:1em;"></i>
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
										>
									 	Submit &nbsp;
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