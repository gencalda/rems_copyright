<?php
	include('guestLink.php');
	include ('../../../include/header.php');
	include ('guestNav.php');
	include ('../../../config/connection.php');
?>

<!------------- For currency ------------------->
					
				<script type="text/javascript">
				function getCaret(el) {
					var pos = -1; 
					if (el.selectionStart) { 
						pos = el.selectionStart;
					} 
					else if (document.selection) { 
						el.focus();         
						var r = document.selection.createRange(); 
						if (r != null) { 
							var re = el.createTextRange(); 
							var rc = re.duplicate(); 
							re.moveToBookmark(r.getBookmark()); 
							rc.setEndPoint('EndToStart', re);       
							pos = rc.text.length; 
						}
					}  
					return pos; 
				}

				function Input(id, immutableText) {
					this.el = document.getElementById(id);
					this.el.value = immutableText;
					this.immutableText = immutableText;
					this.el.onkeypress = keyPress(this);
				}

				function keyPress(el) {
					return function() {
						var self = el; 
						return getCaret(self.el) >= self.immutableText.length;
					}
				}

				Input.prototype.getUserText = function() {
					return this.el.value.substring(this.immutableText.length);
				};
				</script>
				<!----------------------------------------->
<?php

	
	$salaryExpectedFrom = '';
	$salaryExpectedTo = '';

	$selectedFirstJob = 'Select First Choice Position';
	$selectedSecondJob = 'Select Second Choice Position';
	$selectedThirdJob = 'Select Third Choice Position';
	
	if (isset($_SESSION['ses_applyPage8'])) 
	{
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
			
			if (!$con)
			{
				die('Could not connect: ' . mysql_error()); 
			}
			mysql_select_db("$db_database", $con);
			
			$query = mysql_query("SELECT * FROM appChosenPosition WHERE applicantID = '".$_SESSION['ses_applicantID']."'");
			
			while($row = mysql_fetch_array($query))
			{
			
				if ($row['appChosenPositionRank']=='first')
				$selectedFirstJob = $row['jobPostingTitle'];
				
				if ($row['appChosenPositionRank']=='second')
				$selectedSecondJob = $row['jobPostingTitle'];
				
				if ($row['appChosenPositionRank']=='third')
				$selectedThirdJob = $row['jobPostingTitle'];
			
			}//while
			
			$query2 = mysql_query("SELECT * FROM appQualities WHERE applicantID = '".$_SESSION['ses_applicantID']."'");
			
			while($row2 = mysql_fetch_array($query2))
			{
			
				if ($row2['appQualityType']=='expected salary from')
				$salaryExpectedFrom = $row2['appQualityDesc'];
				
				if ($row2['appQualityType']=='expected salary to')
				$salaryExpectedTo = $row2['appQualityDesc'];
				
			}//while
			
			$salaryExpectedFrom = "Php ".$salaryExpectedFrom;
			$salaryExpectedTo = "Php ".$salaryExpectedTo;
			
	}//if set
	
?>
				
				
		<div class="container-fluid col-md-12 content">
			<div class="container col-md-12">
				
				
				<form method="POST" action="../../../config/insertAppChosenPosition.php" name = "myForm">
					
					<!-- Basic Info -->
			<div class='container-fluid content'>
				<ul class="breadcrumb">
					<li><a href="../index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
					<li class="active">Desired Position</li>
				</ul>
			</div>

	
			<div class="container-fluid" id="position">
				<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 2em; padding:1em;">
					<h4 class="alert-info well-lg">Instructions: Fill up the form with complete information. <br />
							Fields with asterisk (*) are required.</h4> 		
					
					<div class="col-md-12">
						<div class="progress">
							  <div class="progress-bar  progress-bar-success progress-bar-striped active" role="progressbar"
							  		aria-valuenow="00" aria-valuemin="0" aria-valuemax="100" style="width:90%">
							    90% Complete
							  </div>
						</div>
					</div>
							
							
					<legend>What position are you looking for?</legend>
							
							
							
							<div class="form-group col-md-4">
										<label> First choice Position: </label>
										<?php	
										$con = mysql_connect("$db_hostname","$db_username","$db_password");
										if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
									
										mysql_select_db("$db_database", $con);
										$result = mysql_query("SELECT * FROM `jobPosting` WHERE jobPostingStatus=1 GROUP BY jobPostingTitle");			
										
									?>
									<select type='dropdown' class='form-control'  name='name_appChosenPositionFirst' id='name_appChosenPositionFirst' onchange='checkChosenValue()' required>
									<option value="<?php echo $selectedFirstJob ?>" selected><?php echo $selectedFirstJob ?></option>
									<?php		
										while ($row = mysql_fetch_array($result))
										{
											echo "<option value='" . $row['jobPostingTitle'] . "'> " . $row['jobPostingTitle'] . " </option>";
										}
										
										mysql_close($con);
									?>
									
									</select>
								</div>
								
								<div class="form-group col-md-4">
										<label> Second choice Position: </label>
										<?php	
										$con = mysql_connect("$db_hostname","$db_username","$db_password");
										if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
									
										mysql_select_db("$db_database", $con);
										$result = mysql_query("SELECT * FROM `jobPosting` WHERE jobPostingStatus=1 GROUP BY jobPostingTitle");
																	
										echo "<select type='position' class='form-control' id='name_appChosenPositionSecond' name='name_appChosenPositionSecond' onchange='checkValue()' required>";
										if (mysql_num_rows($result) == 1) 
										{
											echo"
											<script language='JavaScript'>
											document.getElementById('name_appChosenPositionSecond').disabled = true;
											</script>";
										}//if			
									?>
									<option value="<?php echo $selectedSecondJob ?>" selected><?php echo $selectedSecondJob ?></option>
									<!--<option value="any">Any</option> -->
									<?php		
										while ($row = mysql_fetch_array($result))
										{
											echo "<option value='" . $row['jobPostingTitle'] . "'> " . $row['jobPostingTitle'] . " </option>";
										}
										
										mysql_close($con);
									?>
									
									</select>
								</div>
								
								<div class="form-group col-md-4">
										<label> Third choice Position: </label>
										<?php	
										$con = mysql_connect("$db_hostname","$db_username","$db_password");
										if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
									
										mysql_select_db("$db_database", $con);
										$result = mysql_query("SELECT * FROM `jobPosting` WHERE jobPostingStatus=1 GROUP BY jobPostingTitle");
																	
										echo "<select type='position' class='form-control' id='name_appChosenPositionThird' name='name_appChosenPositionThird' onchange='checkValue()' required>";
										if ((mysql_num_rows($result) == 1) || (mysql_num_rows($result) == 2))
										{
										echo"
										<script language='JavaScript'>
										document.getElementById('name_appChosenPositionThird').disabled = true;
										</script>";
										}//if	
									?>
									<option value="<?php echo $selectedThirdJob ?>" selected><?php echo $selectedThirdJob ?></option>
									<!--<option value="any">Any</option> -->
									<?php		
										while ($row = mysql_fetch_array($result))
										{
											echo "<option value='" . $row['jobPostingTitle'] . "'> " . $row['jobPostingTitle'] . " </option>";
										}
										
										mysql_close($con);
									?>
									
									</select>
								</div>
								
								<!----------------- Checks the value of dropdown if the same ----------------->
								
								<script language='JavaScript'>
								
								function checkValue() 
								{
								
									var position1 = document.getElementById("name_appChosenPositionFirst").value;
									var position2 = document.getElementById("name_appChosenPositionSecond").value;
									var position3 = document.getElementById("name_appChosenPositionThird").value;
									
									if (position1==position2)  
									{
										alert("You can't choose similar positions.");
										document.getElementById("name_appChosenPositionSecond").selectedIndex = 0;
									}
									else if (position1==position3)
									{
										alert("You can't choose similar positions.");
										document.getElementById("name_appChosenPositionThird").selectedIndex = 0;
									}
									else if (position2==position3)
									{
										alert("You can't choose similar positions.");
										document.getElementById("name_appChosenPositionThird").selectedIndex = 0;
									}
									
								}//function
								
								</script>
								
								<!----------------------------------------------------------------------------->
								
								<div class="form-group col-md-6">
								<label> Expected salary ranges from: </label>
								<input type="text" 
												autofocus="autofocus"
												class="form-control" 
												name="name_appQualityExpectedSalaryFrom" 
												value='<?php echo $salaryExpectedFrom ?>' 
												maxlength="13"
												placeholder="" 
												id="name_appQualityExpectedSalaryFrom"
												required
										/>
						</div>
						
						
						<div class="form-group col-md-6">
								<label> Expected salary ranges up to: </label>
								<input type="text" 
												autofocus="autofocus"
												class="form-control" 
												name="name_appQualityExpectedSalaryUpTo" 
												value='<?php echo $salaryExpectedTo ?>' 
												maxlength="13"
												id="name_appQualityExpectedSalaryUpTo"
												required
										/>
						</div>
						
						<!--------------  CURRENCY	------------------>
						<?php
							if (!(isset($_SESSION['ses_applyPage8'])) )
							{
							echo"
							<script type='text/javascript'>
								var input = new Input('name_appQualityExpectedSalaryFrom', 'Php ');
								var userText = input.getUserText(); 
								
								var input = new Input('name_appQualityExpectedSalaryUpTo', 'Php ');
								var userText = input.getUserText(); 
								
								$('#name_appQualityExpectedSalaryFrom').keyup(function(e)
								{
									if(this.value.length < 4){
										this.value = 'Php ';
									}
									else if( this.value.indexOf('Php ') !== 0 ){ 
										this.value = 'Php '  + String.fromCharCode(e.which); 
									}
								});
								
								$('#name_appQualityExpectedSalaryUpTo').keyup(function(e)
								{
									if(this.value.length < 4){
										this.value = 'Php ';
									}
									else if( this.value.indexOf('Php ') !== 0 ){ 
										this.value = 'Php '  + String.fromCharCode(e.which); 
									}
								});
							</script> 
							";
							}//if
						?>
						<!--------------  //CURRENCY	-------------->
					
							<div class="form-group col-md-3">
								</div>
								
								<div class="form-group col-md-2">
								<button type="button" 
														class="btn btn-primary btn-md btn-block"
														name ="btnCancel" 
														id = "btnCancel" 
														style="margin-top: 2em;"
														onClick="location.href='../../../config/cancelAppForm.php'" >
														Cancel
								</button>
								</div>    
								
								<div class="form-group col-md-2">
	
									<button type="button" 
													class="btn btn-primary btn-md btn-block"
													name ="familyPrev" 
													id = "familyPrev" 
													style="margin-top: 2em;"
													onClick="location.href='apply7.php'" >
							      				<span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Previous
							      	</button>

										

								</div>
								<div class="form-group col-md-2">
								
									<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="personalNext" 
											id = "personalNext" 
											style="margin-top: 2em;">
					      				 Submit &nbsp;
												 <span class="glyphicon glyphicon-check"></span>
					      			</button>
					      		</div>
								
								<div class="form-group col-md-3">
								</div>
						
								<div class="form-group col-md-12">
								</div>
								
								<div class="form-group col-md-12">
								</div>
						
					
						</form>
						
						
					
				
				
				
			
					
					</div>
					
			</div>
			
		</div>
		
<?php
	include ('footer.php');
?>	