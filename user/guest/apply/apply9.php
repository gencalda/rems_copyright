<?php
	include('guestLink.php');
	include ('../../../include/header.php');
	include ('guestNav.php');
	include ('../../../config/connection.php');
?>
	
		

		<div class="container-fluid col-md-12 content">
			<div class="container col-md-12">
	
							<div class='container-fluid content'>
									<ul class="breadcrumb">
									    <li>Application Form</li>
									    <li class="active">Skills and Qualities</li>
									</ul>
								</div>
								<div class="col-md-12">
									<div class="progress">
										  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
										  		aria-valuenow="0" aria-valuemin="60" aria-valuemax="100" style="width:100%">
										    100% 
										  </div>
									</div>
									<br/ >
								</div>
							<legend>Skills and Qualities</legend>
							
							<div class="form-group col-md-12">
						<?php
						
						mysql_select_db("$db_database", $con);	// connection
						
						
						
						//  --------------- Jobs ------------------
						$resultJob1 = mysql_query("SELECT * 
												FROM appchosenposition 
												WHERE applicantID = '".$_SESSION['ses_applicantID']."' 
												and appChosenPositionRank = 'first'
											     ");
												 
						while($rowJob1 = mysql_fetch_array($resultJob1)) 
						{
							$job1 = $rowJob1['jobPostingTitle'];
						}
						
						
						$resultJob2 = mysql_query("SELECT * 
												FROM appchosenposition 
												WHERE applicantID = '".$_SESSION['ses_applicantID']."'
												and appChosenPositionRank = 'second'
											     ");
												 
						while($rowJob2 = mysql_fetch_array($resultJob2)) 
						{
							$job2 = $rowJob2['jobPostingTitle'];
						}
						
						
						$resultJob3 = mysql_query("SELECT * 
												FROM appchosenposition 
												WHERE applicantID = '".$_SESSION['ses_applicantID']."'
												and appChosenPositionRank = 'third'
											     ");
												 
						while($rowJob3 = mysql_fetch_array($resultJob3)) 
						{
							$job3 = $rowJob3['jobPostingTitle'];
						}
						
						//------------------------------------------
					
						
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
										if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
									
										mysql_select_db("$db_database", $con);
									
										
										$result = mysql_query("SELECT DISTINCT jobQualifiDesc
															FROM  jobQualifications
															LEFT JOIN jobPosting 
															ON jobQualifications.jobPostingID = jobPosting.jobPostingID
															WHERE (jobPosting.jobPostingTitle = '$job1'
															OR jobPosting.jobPostingTitle = '$job2'
															OR jobPosting.jobPostingTitle = '$job3'
															)
															AND jobQualifications.jobQualifiType = 'quality'
															");
																											
										echo " <form action='../../../config/insertAppQualifications.php' method='post'>";
						echo "<div class='navQualities'>
						"; 
				
						// run through the results from the database, generating the checkboxes 
						while ($row = mysql_fetch_assoc($result)) { 
						 
						  echo "\n\t<li>"; 
							
						   echo "<p><input type='checkbox' name='name_AppQualities[]' value='{$row['jobQualifiDesc']}'> {$row['jobQualifiDesc']}</p>"; 
						   echo "</li>"; 
						} 
						?>
						
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
													onClick="location.href='apply8.php'" >
							      				<span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Previous
							      	</button>

										

								</div>
								<div class="form-group col-md-2">
								
									<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="personalNext" 
											id = "personalNext" 
											style="margin-top: 2em;">
					      				Submit
					      			</button>
					      		</div>
								
								<div class="form-group col-md-3">
								</div>
						
								<div class="form-group col-md-12">
								</div>
								
								<div class="form-group col-md-12">
								</div>
						<?php
						echo "</div>
						</div>"; 
						
						echo "</form>
						</div>"; 
										
										
						?>
						
		
					
					
					
			</div>
			
		</div>
<?php
	include ('../../include/footer.php');
?>			