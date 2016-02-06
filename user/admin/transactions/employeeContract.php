<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	
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

			
			<h4 class="alert-info well-lg instruction">Fill up the form with the contract details. 
				Fields with asterisk (*) are required. </h4> 		
			<br />
			
			
			<?php
							$appID = "";
							$appName = "";
							$jobID = "";
							$jobName = "";
							$clientID = "";
							$clientName = "";
							$employeeID = "";
							
							$renewStartDate = "";
						
							
							$appID = $_POST['applicantID'];
							
							if (isset($_POST['jobpostingID']))
							{
							$jobID = $_POST['jobpostingID'];
							}
							
							if (isset($_POST['employeeID']))
							{
							$employeeID = $_POST['employeeID'];
							}
							
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error()); 
								}
								
								mysql_select_db("$db_database", $con);
								
								$result = mysql_query("SELECT *
														FROM tbl_basic_info
														LEFT JOIN tbl_applicant
														ON tbl_applicant.basicId = tbl_basic_info.basicId
														WHERE tbl_applicant.applicantId = $appID
														");
														
								while($row = mysql_fetch_array($result)) 
								{
										$appName = $row['basicLastName'].', '.$row['basicFirstName'].' '.$row['basicMiddleName'];
								}//while	
								
								
								$result = mysql_query("SELECT *
														FROM tbl_client
														LEFT JOIN tbl_job_posting
														ON tbl_job_posting.clientId = tbl_client.clientId
														WHERE tbl_job_posting.jobPostingId = $jobID
														");
														
								while($row = mysql_fetch_array($result)) 
								{
										$jobName = $row['jobName'];
										$clientName = $row['clientName'];
										$clientID = $row['clientId'];
								}//while	
								
								
								//contract start
							if (isset($_POST['employeeID']))
							{
								$result = mysql_query("SELECT *
														FROM tbl_contract
														WHERE employeeId = $employeeID
														");
														
								while($row = mysql_fetch_array($result)) 
								{
									$renewStartDate = $row['contractEndDate'];
								}//while	
								
								//update tbl contract status
								$mysqli->query("UPDATE tbl_contract SET 
											contractStatus = 'renewed'
										
										WHERE employeeId = '$employeeID'");
								
							}
			
			?>
			
			<div class='container-fluid content'>
			<form name="formAddClient" method="POST" action="sendEndorseApplicant.php?token=<?php echo $tran; ?>">
						<div class="form-group col-md-10">
						</div>

						<fieldset class="col-md-12">
							<?php
							if(isset($_POST['renewEmployee']))
							{
								echo'
								<legend>Renew Employee Contract</legend>
								';
								$dateToFormat =date_create($renewStartDate);
								$date =date_format($dateToFormat,'m/d/Y');
							}
							else
							{
								echo'
								<legend>Employee Contract</legend>
								';
								$date = date("m/d/Y");
							}
							?>
							
							<input type='hidden' name='applicantID' value= '<?php echo $appID; ?>'>
							
							<input type='hidden' name='clientID' value= '<?php echo $clientID; ?>'>
							
							<input type='hidden' name='jobpostingID' value= '<?php echo $jobID; ?>'>
							
							<input type='hidden' name='employeeID' value= '<?php echo $employeeID; ?>'>
							
							
							<div class="form-group col-md-6">
								<label>Applicant Name: </label>
								<input type="text"
										class="form-control" 
										name="name_contractAppName" 
										value='<?php echo $appName; ?>' 
										maxlength="250"   
										disabled
										
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label>Client Name: </label>
								<input type="text"
										class="form-control" 
										name="name_contractClientName" 
										value='<?php echo $clientName; ?>' 
										maxlength="250"
										disabled
										
								/>
							</div>
							
							<div class="form-group col-md-3">
								<label>Job Name: </label>
								<input type="text"
										class="form-control" 
										name="name_contractJobName" 
										value='<?php echo $jobName; ?>' 
										maxlength="250" 
										disabled										
										
								/>
							</div>


							<div class="form-group  col-md-6">
									<label>Start of Contract: *</label>
									<input type="text" 
											class="form-control" 
											name="name_contractStart" 
											value="<?php echo $date;?>"  
											maxlength="11" 
											placeholder="Start of Contract" 
											readonly
									/>
							</div>
							
							<div class="form-group col-md-6">
									<label>End of Contract: *</label>
									<input type="text" 
											class="form-control" 
											id="datepicker"
											name="name_contractEnd" 
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
							
							<?php
								if (isset($_POST['renewEmployee']))
								{
									echo'
									<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="renewEmployeeSubmit" 
											id="renewEmployeeSubmit"
											style="margin-top: 2em; "
											>
											Submit &nbsp;
										 <span class="glyphicon glyphicon-chevron-right"></span>
									</button>
									';
								}
								else
								{
									echo'
									<button type="submit" 
										class="btn btn-primary btn-md btn-block"
										name ="deployApplicant" 
										id="deployApplicant"
										style="margin-top: 2em; "
										>
									 	Submit &nbsp;
									 <span class="glyphicon glyphicon-chevron-right"></span>
				      			</button>
								';
								}
							?>
				      		
				      	</div>

					</form>

				</div>
			</div>
	</div>

<br /><br /><br />



<?php
	include ('../footer.php');
?>