<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>


<html>
<head>
	<style type="text/css">
	
		.scroll ul{width:100%;}
		.scroll ul{overflow:hidden;overflow-x:auto;}   
			
	</style>
</head>
<body>
	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="job.php">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd.php">Add Job</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd2.php">Job Qualifications</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li>Language Spoken</li>
		</ul>
	</div>
	

	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
			<h4 class="alert-info well-lg">Add job qualifications.</h4> 		
			<br /><br />
			<div class='container-fluid content'>
								
						
							
							
							
							<div class="form-group col-md-12">
							
							<?php
								
								$languageJob = array();
								$languageJobApp = array();
								$ctr = 0;
								$jobName = "";
								
																		
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
									{
										die('Could not connect: ' . mysql_error());
									}
																	
								mysql_select_db("$db_database", $con);
								
								
								$ctr = 0;
								
								$resultJobLanguage = mysql_query("SELECT * 
														FROM tbl_job_quali
														WHERE jobPostingId = $_SESSION[ses_jobPostingID]
														and jobQualiType = 'Language'
														AND (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
														 ");
														 
								if (isset($_SESSION['ses_jobPostingID']))	
								{
									while($rowJobLanguage = mysql_fetch_array($resultJobLanguage)) 
									{
										$languageJob[$ctr] = $rowJobLanguage['jobQualiDescription'];
										$ctr++;
									}
								}
						
								
								$result = mysql_query("SELECT DISTINCT jobQualiDescription 
								FROM tbl_job_quali
								LEFT JOIN tbl_job_posting
								ON tbl_job_quali.jobPostingId = tbl_job_posting.jobPostingId
								WHERE tbl_job_quali.jobQualiType = 'Language'
														 ");
														 
														 
								$ctr = 0;					 
								while($row = mysql_fetch_array($result)) 
								{
									$languageJobApp[$ctr] = $row['jobQualiDescription'];
									$ctr++;
								}
								
								
								$result2 = mysql_query("SELECT DISTINCT personalQualityDesc
								FROM tbl_personal_info
								WHERE personalQualityType = 'Language'
														 ");
														 
								while($row2 = mysql_fetch_array($result2)) 
								{
									$languageJobApp[$ctr] = $row2['personalQualityDesc'];
									$ctr++;
								}
								
								
								
								echo " <div class='form-group col-md-5'>
									<form  action='../../../config/insertLanguageOthers.php' method='post'>";
									echo"<label>Add Language to List:</label>";
									echo " <div class='form-group col-md-12'>
									</div>";
									echo "<p><input type='checkbox' name='name_jobPostingLanguageOthersCB' onclick='enableLanguage(this.checked)' > Others ";
									echo "<input type='text'  name='name_jobPostingLanguageOthers' id='name_jobPostingLanguageOthers' disabled = true>
							
										</br>   <input type='submit'  class='btn btn-default' name='name_jobPostingLanguageOthersUpdate'  style='display:none; margin-left:70px; margin-top:1em;'  id='name_jobPostingLanguageOthersUpdate' Value='Add to List'/></p>
										</div>";

										
									echo " <div class='form-group col-md-1'>
									</div>";
									echo "</form>";
								
								echo'<div class="form-group col-md-6">
							<label>Language Spoken: </label>';
							echo " <div class='form-group col-md-12'>
								</div>";
								echo " <form action='../../../config/updateJobQualificationsLanguage.php' method='post'>";
								echo "<div class='scroll'>
								<ul>"; 

								// run through the results from the database, generating the checkboxes 
								
								if (mysql_num_rows($result) == 0 && mysql_num_rows($result2) == 0) 
								{ 
									//echo "Note: The language list is empty. Please add a language to the list by checking the 'Others' checkbox.";
								}
								else 
								{
									
										$languageJobAppUnique = array_values(array_unique($languageJobApp)); //getting the unique values
										
										
										$ctr = 0;
										while ((isset($languageJobAppUnique[$ctr])) && ($languageJobAppUnique[$ctr]!=" "))
										{
											if(mysql_num_rows($resultJobLanguage) != 0)
											{
												if (in_array($languageJobAppUnique[$ctr], $languageJob))
												{
													echo "\n\t<li>"; 
													echo "<p><input type='checkbox' name='name_jobPostingLanguage[]' value='$languageJobAppUnique[$ctr]' checked='checked' > $languageJobAppUnique[$ctr]</p>"; 
													echo "</li>"; 
												} 
												else 
												{ 
													echo "\n\t<li>"; 
													echo "<p><input type='checkbox' name='name_jobPostingLanguage[]' value='$languageJobAppUnique[$ctr]'> $languageJobAppUnique[$ctr]</p>"; 
													echo "</li>"; 
												 }
											}//if
											else
											{
												echo "\n\t<li>"; 
													echo "<p><input type='checkbox' name='name_jobPostingLanguage[]' value='$languageJobAppUnique[$ctr]'> $languageJobAppUnique[$ctr]</p>"; 
													echo "</li>"; 
											}//else
											$ctr++;
										}
								
										
								}//else
								echo "</ul>
								</div>"; //scroll
							
								echo "<div class='form-group col-md-5'>";
								echo "<input type='submit' class='btn btn-primary glyphicon glyphicon-search form-control' name='submitQualificationsLanguage' style='margin-top:2em;' Value='Next'/>";
								echo "</div>";
								echo "<div class='form-group col-md-7'>
								</div>";
								echo "</form>"; 
								

								echo "</div>"; //-6 
								
						
								
	
								echo "<script language='JavaScript'>
								

								function enableLanguage(status)
								{
								
								document.getElementById('name_jobPostingLanguageOthers').disabled = !status;
								if (status==true)
								{
								document.getElementById('name_jobPostingLanguageOthersUpdate').style.display = 'block';
								}
								else 
								{
								document.getElementById('name_jobPostingLanguageOthersUpdate').style.display = 'none';
								}
								}
								
								</script>";
								
								
								?>
								</div>

							<div class="form-group col-md-8">
									
							</div>

							 
							
			</div>

								
									

									 
								
			</div>
		</div>
	</div>

<br /><br /><br />


<?php
	include ('../footer.php');
?>