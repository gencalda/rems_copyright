
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
		    <li><a href="job.php">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd.php">Add Job</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd2.php">Job Qualifications</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd3.php">Language Spoken</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li>Skills and Qualities</li>
		</ul>
	</div>

	

	<div class="container-fluid">
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
			<h4 class="alert-info well-lg">Add job qualifications.</h4> 		
			<br />
				<div class='container-fluid content'>
			

								 
							<div class="form-group col-md-12">
									
								
							
								<?php  

							// connect to the database  
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
									if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
								
							mysql_select_db("$db_database", $con);
									$sql = "SELECT DISTINCT jobQualiDescription 
									FROM tbl_job_quali
									LEFT JOIN tbl_job_posting
									ON tbl_job_quali.jobPostingID = tbl_job_posting.jobPostingID
									WHERE jobName = '".$_SESSION["ses_jobPostingTitle"]."' AND jobQualiType = 'Quality'";   
									$result = mysql_query($sql) or die(mysql_error() . "<br/>$sql");  
							
							echo " <div class='form-group col-md-5'>";
							echo " <form  action='../../../config/insertQualitiesOthers.php' method='post'>";
							echo"<label>Add Skill/Quality to List:</label>";
									echo " <div class='form-group col-md-12'>
									</div>";
									
							
							echo "<p><input type='checkbox' name='name_jobPostingQualitiesOthersCB' onclick='enableQualities(this.checked)' > Others ";
							echo "</br><textarea cols='40' rows='5' style='margin-left:20px; margin-top:5px;' name='name_jobPostingQualitiesOthers' id='name_jobPostingQualitiesOthers' disabled=true> </textarea>";


		
							echo "</br><input type='submit'  class='btn btn-default' name='name_jobPostingQualitiesOthersAddClient' id='name_jobPostingQualitiesOthersAddClient'  style='display:none; margin-left:20px; margin-top:1em;'  Value='Add to List'/></p>";
							echo "</div>";
							echo "<div class='form-group col-md-1'>
							</div>
							</form>";
					
					
							echo'<div class="form-group col-md-6">
							<label>Skills and Qualities: </label>';
							echo " <div class='form-group col-md-12'>
									</div>";
							echo " <form action='../../../config/insertJobQualificationsQualities.php' method='post'>";
							echo "<div class='navQualities'>
							"; 
					
							// run through the results from the database, generating the checkboxes 
							
							if (mysql_num_rows($result) == 0) 
							{ 
									echo "Note: The skills and qualities list is empty. Please add a skill / quality to the list by checking the 'Others' checkbox.";
							}
							else 
							{
									while ($row = mysql_fetch_assoc($result)) { 
									 
									  echo "\n\t<li>"; 
										
									   echo "<p><input type='checkbox' name='name_jobPostingQualities[]' value='{$row['jobQualiDescription']}'> {$row['jobQualiDescription']}</p>"; 
									   echo "</li>"; 
									} 
							}//else
							echo"</div>";
							echo "<div class='form-group col-md-5'>
							<input type='submit'  class='btn btn-primary glyphicon glyphicon-search form-control'  name='submitQualificationsQualitiesClient' style='margin-top:2em;' Value='Next'/>";
							echo "</div>"; 
							echo "<div class='form-group col-md-7'>
								</div>";
							
							echo "</form>"; 
								echo "</div>"; 
							
							
							//echo "<input type='submit' name='submit' Value='Add Position'/>";
							
							 
							
								echo "<script language='JavaScript'>
									

									function enableQualities(status)
									{
										
										document.getElementById('name_jobPostingQualitiesOthers').disabled = !status;
										if (status==true)
										{
										document.getElementById('name_jobPostingQualitiesOthersAddClient').style.display = 'block';
										}
										else
										{
										document.getElementById('name_jobPostingQualitiesOthersAddClient').style.display = 'none';
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


<br /><br /><br />


<?php
	include ('../footer.php');
?>