<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="job.php?token=<?php echo $main; ?>">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">Add Job</li>
		</ul>
	</div>

	

	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="jobPostingAdd.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Add Job</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="jobUpdate.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update Job</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="job.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span> Job</a></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">Search for client to add job post. </h4> 		
			<br /><br />
			<div class='container-fluid content'>
				<form name="formDropdown" method="GET" action="#">
								
					<!-- empty form -->		
				</form>
							
				<form name="formJobTitle" method="POST" action="../../../config/insertJobTitleFromClient.php">
								
					<legend><a href="#">Client</a></legend>

						<div class="form-group col-md-6">
							<?php	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error());
								}
							
								mysql_select_db("$db_database", $con);
								$result = mysql_query("SELECT * FROM tbl_client ORDER BY clientName");
															
								
							?>
							<select type="position" class="form-control" id="name_searchClient" name="name_searchClient">
							<option value="" selected>Select Client</option>
							<?php		
								while ($row = mysql_fetch_array($result))
								{
									echo "<option value='" . $row['clientId'] . "'> " . $row['clientName'] . " </option>";
								}
								echo "</select>"; 
								
							?>
							
						</div>
						
						<div class="form-group col-md-6"></div>
						<br />
					
						<div class='form-group col-md-12'></div>
								
					<legend><a href="#">Job Title</a></legend>
								
								
						<div class="form-group col-md-6">
							<?php	
									
									$result = mysql_query("SELECT DISTINCT jobName FROM tbl_job_posting ORDER BY jobName");
																
									
							?>
								
							<select type="jobtitle" class="form-control" id="name_searchJob" name="name_searchJob" onChange="enableTextbox()">
							<option value="" selected>Select Job</option>
							<?php		
								while ($row = mysql_fetch_array($result))
								{
									echo "<option value='" . $row['jobName'] . "'> " . $row['jobName'] . " </option>";
								}
								
								mysql_close($con);
							?>
							<option value="others">Others</option>
							</select>
								
								
							<script type = "text/javascript">
								function enableTextbox() {
									if (document.getElementById("name_searchJob").value == "others") {
									document.getElementById("name_jobPostingTitleOthers").disabled = false;
									document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"please specify a Job");
									document.getElementById("name_searchJob").disabled = true;
									document.getElementById("SelectFromList").style.display = "block";
										document.getElementById("nameAdd_jobPostingProceed").style.display = "block";
										}
										else
										{
										document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"Others, please specify");
										}
									
									
									}
						
									function enableList(){
									
									document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"Others, please specify");
									document.getElementById("name_jobPostingTitleOthers").disabled = true;
									document.getElementById("name_searchJob").disabled = false;
									document.getElementById("name_searchJob").selectedIndex = 0;
									document.getElementById("SelectFromList").style.display = "none";
									document.getElementById("nameAdd_jobPostingProceed").style.display = "none";
									
									
									}
								</script>
								
							</div>
							
							
							
							<div class="form-group col-md-3">
								<input type="text" 
										class="form-control" 
										name="name_jobPostingTitleOthers" 
										id="name_jobPostingTitleOthers"
										value=''
										maxlength="100" 
										placeholder="Others, please specify"
										disabled
								/>
							</div>


							<div class="form-group col-md-3">
		
								<button class="btn btn-primary btn-md btn-block" 
										type="button" 
										name="SelectFromList" 
										id="SelectFromList" 
										style="display:none;" 
										onclick="enableList()">
										<span class="glyphicon glyphicon glyphicon-list"></span>&nbsp; Select job from the list
								</button>
								<br /><br /><br />
							</div>			
								
							<div class="form-group col-md-2 col-md-offset-10">
								<button type="submit" 
										class="btn btn-primary btn-md btn-block"
										name ="submit" 
										style="padding:10px; margin-bottom: 1em;" 
										>
									 	Proceed &nbsp;
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