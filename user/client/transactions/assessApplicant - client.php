<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>
	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Assess Applicant</li>
		</ul>
	</div>

	
	

	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<h4 class="alert-info well-lg">Here are the list of applicants endorsed to your company.</h4>
			<br /><br />
			<form method="POST" action="#">
					<div class="form-group col-md-8">
						<?php	
							
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
							if (!$con)
							{
								die('Could not connect: ' . mysql_error());
							}
						
							mysql_select_db("$db_database", $con);
							$result = mysql_query("SELECT * FROM client ORDER BY clientID");
														
							echo "<select type='position' class='form-control search' id='searchClient' name='searchClient'>";
						?>
						<option value="" selected>Search Applicant</option>
						<?php		
						echo"<option value='All Client'>All Client</option>";	
							while ($row = mysql_fetch_array($result))
							{
								echo "<option value='" . $row['clientID'] . "'> " . $row['clientName'] . " </option>";
							}
							echo "</select>"; 
							mysql_close($con);
							
						?>
					
					</div>

					<div class="form-group col-md-2">
							<input type="text"
									class="form-control" 
									name="searchClientName" 
									value='' 
									placeholder="Type endorsement code"
									maxlength="250"   
									
							/>
						</div>

					<div class="form-group col-md-2">
								
								<button type="submit" 
										class="btn btn-primary btn-md btn-block"
										name ="submit">
									 	Search &nbsp;
									 <span class="glyphicon glyphicon-search"></span>
				      			</button>
				      		
				      	</div>
					
					<br /><br /><br />
				</form>

				<div class='container-fluid content table-responsive'>
					<?php
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error()); 
						}
						
						
						mysql_select_db("$db_database", $con);
						
						//Name of User
						$fff = $_SESSION['fname'];
						$mmm = $_SESSION['mname'];
						$lll = $_SESSION['lname'];
						$user = $fff.' '.$mmm.' '.$lll;
						
						$result = mysql_query("SELECT * FROM apppairingresults ORDER BY applicantID");
						echo "<table class='table table-hover table-striped'>";
						echo "<thead class='tablehead'>";
						echo "<tr>
										<td>Endorsement Code</td>
										<td>Applicant Name</td>
										<td>Position</td>
										<td>Rating</td>
										<td>Remarks</td>
						</tr>";
										
						echo "</thead>";

						//echo $result;

						while($row = mysql_fetch_array($result)) 
						{
							$appID = $row['applicantID'];
							$jobPostingID = $row['jobPostingID'];
						
							echo "<tr>";
							
							//--------- Applicant Name ----------------
							$resultAppName = mysql_query("SELECT *
															FROM  appinformation
															WHERE applicantID  = $appID
													     ");
							while($rowAppName = mysql_fetch_array($resultAppName)) 
							{
								$appLname = $rowAppName['appInfoLastName'];
								$appFname = $rowAppName['appInfoFirstName'];
								$appMname = $rowAppName['appInfoMiddleName'];
								$appStatus = $rowAppName['appInfoStatus'];
							}
							
							if ($appStatus==0)
							{
								echo "<td ><a style='color:black;  text-decoration: underline;' href = 'pairingFirst.php?ID=".$row['applicantID']."'>" .$appLname.", ".$appFname." ".$appMname." </a></td>";
								//--------------------------------------------
								
								//-------------------- Suitable Job ----------------
								$resultSuitableJob = mysql_query("SELECT * 
																	FROM jobposting
																	WHERE jobPostingID  = $jobPostingID
																	");
								while($rowSuitableJob = mysql_fetch_array($resultSuitableJob)) 
								{
									$branch = $rowSuitableJob['branchID'];
									$jobPostingTitle = $rowSuitableJob['jobPostingTitle'];
								}
								//--------------------------------------------
								
								//-------------------- branch ----------------
								$resultBranch = mysql_query("SELECT * 
																	FROM branch
																	WHERE branchID  = $branch
																	");
								while($rowBranch = mysql_fetch_array($resultBranch)) 
								{
									$branchName = $rowBranch['branchName'];
									$branchLocation = $rowBranch['branchLocation'];
										
										//Getting the Location to display
										$branchLocation = explode("/",$branchLocation);
										
										$num =0;
										while($num <= 2)
										{
											$branchLocation[$num] = rtrim(ltrim($branchLocation[$num]));
											 $num++;	
										}//while
								}
								//--------------------------------------------
								
								echo "<td >".$jobPostingTitle." in ".$branchName."</td>";
								
								
								//---------------- Score and Percentage ------------------
								
								echo "<td >"."passed ".$row['appPairingScore']." qualifications"."</td>";
								echo "<td >".round($row['appPairingPercentage'],2)."%"."</td>";
								echo "<td ><button class='btn btn-success' data-toggle='modal' data-target='#myModal'>
											<span class='glyphicon glyphicon-ok'></span> Endorse
											</button>";
								/*echo"
									<td ><form target='_blank' action='fpdf/pdfEndorsementSlip.php' method='POST'>
						
											<input type='hidden' name='branchName' value= '$branchName'>
											<input type='hidden' name='branchLoc' value= '$branchLocation[0] $branchLocation[1], $branchLocation[2]'>
											<input type='hidden' name='appID' value= '$appID'>
											<input type='hidden' name='appFname' value= '$appFname'>
											<input type='hidden' name='appMname' value= '$appMname'>
											<input type='hidden' name='appLname' value= '$appLname'>
											<input type='hidden' name='job' value= '$jobPostingTitle'>
											<input type='hidden' name='user' value= '$user'>
											<button type='submit' name='ok3' class='btn btn-success'>
											<span class='glyphicon glyphicon-ok'></span> Endorse
											</button>

									
									</form></td >";*/
								//--------------------------------------------------
								
								
							}//if
							echo "</tr>";  // end of row
							
						}

						echo "</table>";
						mysql_close($con);
					
				?>
			</div>
		</div>
	</div>

	<br /><br /><br />

<?php
	include ('../footer.php');
?>