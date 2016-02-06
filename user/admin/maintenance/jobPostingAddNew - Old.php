<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include('../adminNotifModal.php');
	include ('../adminNav.php'); // native to admin
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="maintenanceJob.php?token=<?php echo $main; ?>">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">Add Job</li>
		</ul>
	</div>

	<nav class="navbar nav2">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><h2><a href="#">Add Job</a></h2></li>
			</ul>
	  	</div>
	</nav>



	<div class='container-fluid content'>
			<form name="formDropdown" method="GET" action="#">						
						<form name="formJobTitle" method="POST" action="../../../config/insertJobTitle.php">
						
									<div class='form-group col-md-12'>
									</div>
									<legend>
										<a href="#">Browse Job Title</a>
									</legend>
									
									
										<div class="form-group col-md-12">
											<label>Client Name, Branch Name:  </label>
											<input type="text" 
													autofocus="autofocus"
													class="form-control" 
													name="clientName" 
													value='' 
													maxlength="250"   
													required
													placeholder="galing sa db"
													disabled 
											/>
										</div>
									
									<div class="form-group col-md-6">
									<?php	
												$con = mysql_connect("$db_hostname","$db_username","$db_password");
												if (!$con)
												{
													die('Could not connect: ' . mysql_error());
												}
											
												mysql_select_db("$db_database", $con);
												$result = mysql_query("SELECT DISTINCT jobPostingTitle FROM jobPosting");
																			
												
											?>
											<select type="jobtitle" class="form-control" id="searchJob" name="searchJob" onChange="enableTextbox()">
											<option value="" selected>Search Job</option>
											<?php		
												while ($row = mysql_fetch_array($result))
												{
													echo "<option value='" . $row['jobPostingTitle'] . "'> " . $row['jobPostingTitle'] . " </option>";
												}
												
												
											?>
											<option value="others">Others</option>
											</select>
											
											
										<script type = "text/javascript">
								function enableTextbox() {
									if (document.getElementById("searchJob").value == "others") {
									document.getElementById("name_jobPostingTitleOthers").disabled = false;
									document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"Others, please specify");
									document.getElementById("searchJob").disabled = true;
									document.getElementById("SelectFromList").style.display = "block";
									document.getElementById("nameAdd_jobPostingProceed").style.display = "block";
									}
									else
									{
									document.getElementById("name_jobPostingTitleOthers").setAttribute('placeholder',"please specify");
									}
								
								
								}
								
								function enableList(){
								document.getElementById("name_jobPostingTitleOthers").disabled = true;
								document.getElementById("searchJob").disabled = false;
								document.getElementById("searchJob").selectedIndex = 0;
								document.getElementById("SelectFromList").style.display = "none";
								document.getElementById("nameAdd_jobPostingProceed").style.display = "none";
								document.getElementById("name_jobPostingTitleOthers").value = "";
								
								
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
												placeholder="please specify"
												disabled
										/>
										</div>
									
								
									<div class="form-group col-md-3">
								
									<input  class="btn btn-success glyphicon glyphicon-plus form-control" type="button" name="SelectFromList" id="SelectFromList" style="display:none;"  onclick="enableList()" value="Select Job from the List"/>
									</div>
									
									<div class="form-group col-md-9">
									</div>
								
									
								<div class="form-group col-md-12">
									<div class="form-group col-md-2">
									<input class="btn btn-primary glyphicon glyphicon-search form-control" type="submit" name = "submit" id = "submit" value="Proceed"/>
									</div>
									
									<div class="form-group col-md-10">
									</div>
								</div>
									
								
								
					</form>
							
						
						
	</div>


<?php
	include ('../footer.php');
?>