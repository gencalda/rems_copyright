<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include ('endorseModal.php');
	include('../adminNotifModal.php');
?>

	<br />

		
	<?php
	
	$basicID = $_GET['basicID'];
	$jobID = $_GET['jobID'];
			
	
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
			mysql_select_db("$db_database", $con);

			
	$name = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId = $basicID");
	while($row = mysql_fetch_array($name)) 
	{	
		$first= $row['basicFirstName'];
		$middle= $row['basicMiddleName'];
		$last= $row['basicLastName'];
	}
	
	?>
		
	<div class='container-fluid content'>
	<?php $tran = md5('transaction');
							?>
		<ul class="breadcrumb">
			<li>Transactions</li>
			<?php
			echo"
			<li><a href='assessApplicant.php?token=$tran'>Assess Applicant</a></li>
			";
			?>
			<?php 
			echo"
			<li><a href='pairingFirst.php?token=$tran&basicID=".$basicID."'>$first $middle $last </a></li>
			";
			?>
			<li class="active">Pairing Details</li>
			<ul class="pull-right">
			<?php
			echo"
				<li><a href='assessApplicant.php?token=$tran'><span class='glyphicon glyphicon-arrow-left'>&nbsp;</span>Assess Applicant</a></li>
			";
			?>
			</ul>
		</ul>
	</div>

<div class="container-fluid">	
	<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
		<div class='container-fluid content table-responsive'>
			<?php 
			
				
				//-------------------- Variables ---------------------
				$appAge = "";
				$appGender = "";
				$appCivilStatus = "";
				$appHeight = "";
				$appWeight = "";
				$appReligion = "";
				$appNationality = "";
				$appExpectedSalary = "";
				$appLanguages = array();
				$appLanguagesSame = array();
				$appLanguagesDiff = array();
				$appQualities = array();
				
				$jobAge = "";
				$jobGender = "";
				$jobCivilStatus = "";
				$jobHeight = "";
				$jobWeight = "";
				$jobReligion = "";
				$jobNationality = "";
				$jobExpectedSalary = "";
				$jobLanguages = array();
				$jobLanguagesSame = array();
				$jobLanguagesDiff = array();
				$jobQualities = array();
				
				$tempAge = 0;
				$tempHeight = 0;
				$tempWeight = 0;
				
				// ---------------------------------------------------
				
				//-------------------- App Qualifications ---------------------
				
				$resultApp = mysql_query("SELECT *
										  FROM  tbl_personal_info
										  WHERE basicId = $basicID
										");
														
				while($rowApp = mysql_fetch_array($resultApp)) 
				{
					//age
					if ($rowApp['personalQualityType']=='Age')
					$appAge = $rowApp['personalQualityDesc'];
					
					if ($rowApp['personalQualityType']=='Gender')
					$appGender = $rowApp['personalQualityDesc'];
					
					if ($rowApp['personalQualityType']=='Civil Status')
					$appCivilStatus = $rowApp['personalQualityDesc'];
					
					if ($rowApp['personalQualityType']=='Height')
					$appHeight =  $rowApp['personalQualityDesc'];
					
					if ($rowApp['personalQualityType']=='Weight')
					$appWeight =  $rowApp['personalQualityDesc'];
					
					if ($rowApp['personalQualityType']=='Religion')
					$appReligion = $rowApp['personalQualityDesc'];
					
					if ($rowApp['personalQualityType']=='Nationality')
					$appNationality = $rowApp['personalQualityDesc'];
			
					if($rowApp['personalQualityType']=='Expected Salary')
					$appExpectedSalary = $rowApp['personalQualityDesc'];
					
					
				}//while
				
				// ------------------------------------------------------------
				
				
				//-------------------- Job Qualifications ---------------------
				$resultJob = mysql_query("SELECT *
										  FROM  tbl_job_quali
										  WHERE jobPostingId = $jobID
										");
														
				while($rowJob = mysql_fetch_array($resultJob)) 
				{
					//age
					if ($rowJob['jobQualiType']=='Age From')
					$jobAgeFrom = $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Age To')
					$jobAgeTo = $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Gender')
					$jobGender = $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Civil Status')
					$jobCivilStatus = $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Height')
					$jobHeight =  $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Height From')
					$jobHeightFrom =  $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Height To')
					$jobHeightTo =  $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Weight')
					$jobWeight =  $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Weight From')
					$jobWeightFrom =  $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Weight To')
					$jobWeightTo =  $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Religion')
					$jobReligion = $rowJob['jobQualiDescription'];
					
					if ($rowJob['jobQualiType']=='Nationality')
					$jobNationality = $rowJob['jobQualiDescription'];
					
					if($rowJob['jobQualiType']=='Expected Salary')
					$jobExpectedSalary = $rowJob['jobQualiDescription'];
					
				}//while
				// ------------------------------------------------------------
			
				
				echo "<table class='table table-hover table-striped'>";
					echo "<thead class='tablehead'>";
					echo "<tr>
									<td>Qualification</td>
									<td>Applicant</td>
									<td>Job</td>
									<td> </td>
					</tr>";
					echo "</thead>";		
					
					
					// age
					echo "<tr>
									<td>Age</td>
									<td>$appAge yrs. old</td>
									<td>$jobAgeFrom - $jobAgeTo yrs. old</td>";
							
									if(intval($appAge)>=intval($jobAgeFrom))
									{
										$tempAge++;
									}// if - desc
									
									if(intval($appAge)<=intval($jobAgeTo))
									{
										$tempAge++;
									}// if - desc
							
								if ($tempAge==2)
								{
									echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									$tempAge = 0;
								}
								else
								{
									echo"<td> </td>";
									$tempAge = 0;
								}
					echo"</tr>";
					
					
					
					//gender
					echo "<tr>
									<td>Gender</td>
									<td>$appGender</td>";
									
									
									if($jobGender=='Any')
									{
										echo"<td>male or female</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// if - any
									else if ($jobGender==$appGender)
									{
										echo"<td>$jobGender</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// else if
									else
									{
										echo"<td>$jobGender</td>";
										echo"<td> </td>";
									}// else if
					echo"</tr>";
					
					
					
					//civil status
					echo "<tr>
									<td>Civil Status</td>
									<td>$appCivilStatus</td>";
									if($jobCivilStatus=='Any')
									{
										echo"<td>Any</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// if - any
									else if ($jobCivilStatus==$appCivilStatus)
									{
										echo"<td>$jobCivilStatus</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// else if
									else
									{
										echo"<td>$jobCivilStatus</td>";
										echo"<td> </td>";
									}// else if
					echo"</tr>";
					
					
					//height
					echo "<tr>
									<td>Height</td>
									<td>$appHeight cm</td>";
								
									if($jobHeight=='Any')
									{
										echo"<td>Any</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// if - any
								
									else 
									{
										if(intval($appHeight)>=intval($jobHeightFrom))
										{
											$tempHeight++;
										}// if - desc
									
										if(intval($appHeight)<=intval($jobHeightTo))
										{
											$tempHeight++;
										}// if - desc
									
										if ($tempHeight==2)
										{
										echo"<td>$jobHeightFrom cm  -  $jobHeightTo cm</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
										$tempHeight = 0;
										}
										else
										{
										echo"<td>$jobHeightFrom cm - $jobHeightTo cm</td>";
										echo"<td> </td>";
										$tempHeight = 0;
										}
									}//else
					echo"</tr>";
					
					//weight
					echo "<tr>
									<td>Weight</td>
									<td>$appWeight kg</td>";
								
									if($jobWeight=='Any')
									{
										echo"<td>Any</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// if - any
								
									else 
									{
										if(intval($appWeight)>=intval($jobWeightFrom))
										{
											$tempWeight++;
										}// if - desc
									
										if(intval($appWeight)<=intval($jobWeightTo))
										{
											$tempWeight++;
										}// if - desc
									
										if ($tempWeight==2)
										{
										echo"<td>$jobWeightFrom kg  -  $jobWeightTo kg</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
										$tempWeight = 0;
										}
										else
										{
										echo"<td>$jobWeightFrom kg  -  $jobWeightTo kg</td>";
										echo"<td> </td>";
										$tempWeight = 0;
										}
									}//else
					echo"</tr>";
					
					// religion
					echo "<tr>
									<td>Religion</td>
									<td>$appReligion</td>";
									if($jobReligion=='Any')
									{
										echo"<td>Any</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// if - any
									else if ($jobReligion==$appReligion)
									{
										echo"<td>$jobReligion</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// else if
									else
									{
										echo"<td>$jobReligion</td>";
										echo"<td> </td>";
									}// else if
					echo"</tr>";
					
					//nationality
					echo "<tr>
									<td>Nationality</td>
									<td>$appNationality</td>";
									if($jobNationality=='Any')
									{
										echo"<td>Any</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// if - any
									else if ($jobNationality==$appNationality)
									{
										echo"<td>$jobNationality</td>";
										echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
									}// else if
									else
									{
										echo"<td>$jobNationality</td>";
										echo"<td> </td>";
									}// else if
					echo"</tr>";
					
					// expected salary
					echo "<tr>
									<td>Expected Salary</td>
									<td>$appExpectedSalary</td>
									<td>$jobExpectedSalary</td>";
							
								if (floatval($appExpectedSalary)<=floatval($jobExpectedSalary))
								{
									echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
								}
					echo"</tr>";
					
					
					//   ------------------------ language  ------------------------
									$resultAppLanguages = mysql_query("SELECT *
																FROM  tbl_personal_info
																WHERE personalQualityType = 'Language'
																AND basicId = $basicID
																");
				
						
									$ctr=0; 	// counter
					
									while($rowAppLanguages = mysql_fetch_array($resultAppLanguages)) 
									{
										$appLanguages[$ctr] = $rowAppLanguages['personalQualityDesc'];
										$ctr++;
									}
									
									$ctr--;
									$totalAppLanguages = $ctr;  // counting starts at 0
								
									$resultJobLanguages = mysql_query("SELECT *
																FROM  tbl_job_quali
																WHERE jobQualiType = 'Language'
																AND (jobQualiNewlyAdded != 'Yes' 
																OR  jobQualiNewlyAdded IS NULL)
																AND jobPostingId = $jobID
																");
				
						
									$ctr=0; 	// counter
					
									while($rowJobLanguages = mysql_fetch_array($resultJobLanguages)) 
									{
										$jobLanguages[$ctr] = $rowJobLanguages['jobQualiDescription'];
										$ctr++;
									}
									
									$ctr--;
									$totalJobLanguages = $ctr;  // counting starts at 0
									
									if ($totalAppLanguages > $totalJobLanguages)
									{
										$overAll = $totalAppLanguages;
									}
									else
									{
										$overAll = $totalJobLanguages;
									}
									
										// -------- getting same values -----------
										$ctrApp = 0;
										$ctrJob = 0;
										$count = 0;
										$ctrSame = 0;
										$indApp = array();;
										$indJob = array();
										while($ctrApp <= $totalAppLanguages)
										{
											$ctrJob = 0;
											while($ctrJob <= $totalJobLanguages)
											{
												if ($appLanguages[$ctrApp]==$jobLanguages[$ctrJob])
												{
													$appLanguagesSame[$ctrSame] = $appLanguages[$ctrApp];
													$indApp[$ctrSame] = $ctrApp;
													$indJob[$ctrSame] = $ctrJob;
													$ctrSame++;
												}// 
												$ctrJob++;
												$count++;
											}
											$ctrApp++;
										}
										
										$ctrSame--;
										$sameNum = $ctrSame;
										// -----------------------------
										
										// ---- printing same values ------
									
										$ctr = 0;
										while($ctr <= $sameNum)
										{
											echo "<tr>";
											if ($ctr ==0)
											echo"<td>Language</td>";
											else
											echo"<td></td>";
											echo"<td>$appLanguagesSame[$ctr]</td>";
											echo"<td>$appLanguagesSame[$ctr]</td>";
											echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
											echo "</tr>";
											$ctr++;
										}
										// ---------------------------------
										
										
										$jobShort ="";
										$appShort = "";
										$length = 0;
										$short = 0;
										
										if (count($appLanguages) > count($jobLanguages))
										{
												$length = count($appLanguages);
												$short = count($jobLanguages);
												$length--;
												$short--;
												$jobShort = "yes";
										}
										else if (count($appLanguages) < count($jobLanguages))
										{
												$length = count($jobLanguages);
												$short = count($appLanguages);
												$length--;
												$short--;
												$appShort = "yes";
										}
										
						
										
										$ctr = $short;
										$ctr++;
										while ($ctr <= $length)
										{
											if ($jobShort == "yes")
											{
												$jobLanguages[$ctr]="-------";
											}
											if ($appShort == "yes")
											{
												$appLanguages[$ctr]="-------";
											}
											$ctr++;
										}
									
												
										// ---- printing other values ------
										$ctr = 0;
										while($ctr <= $length)
										{
											if (isset($appLanguagesSame))
											{
												if (in_array($appLanguages[$ctr], $appLanguagesSame)) 
												{
													//not print
												}
												else if (in_array($jobLanguages[$ctr], $appLanguagesSame)) 
												{	
													//not print
												}
												else 
												{
													echo "<tr>";
													if ($ctr ==0)
													echo"<td>Language</td>";
													else
													echo"<td></td>";
												
													echo"<td>$appLanguages[$ctr]</td>";
													echo"<td>$jobLanguages[$ctr]</td>";
													echo"<td></td>";
													echo "</tr>";
												}
											}//if
											else 
												{
													echo "<tr>";
													if ($ctr ==0)
													echo"<td>Language</td>";
													else
													echo"<td></td>";
												
													echo"<td>$appLanguages[$ctr]</td>";
													echo"<td>$jobLanguages[$ctr]</td>";
													echo"<td></td>";
													echo "</tr>";
												}
											$ctr++;
										}
					// ---------------------------------------------------------------------------
										
										
					
					
					//------------------------- qualities -------------------------
									$resultAppQualities = mysql_query("SELECT *
																FROM  tbl_personal_info 
																WHERE personalQualityType = 'Quality'
																AND basicId = $basicID
																");
				
						
									$ctr=0; 	// counter
					
									while($rowAppQualities = mysql_fetch_array($resultAppQualities)) 
									{
										$appQualities[$ctr] = $rowAppQualities['personalQualityDesc'];
										$ctr++;
									}
									
									$ctr--;
									$totalAppQualities = $ctr;  // counting starts at 0
								
									$resultJobQualities = mysql_query("SELECT *
																FROM  tbl_job_quali 
																WHERE jobQualiType = 'Quality'
																AND (jobQualiNewlyAdded != 'Yes' 
																OR  jobQualiNewlyAdded IS NULL)
																AND jobPostingID = $jobID
																");
				
						
									$ctr=0; 	// counter
					
									while($rowJobQualities = mysql_fetch_array($resultJobQualities)) 
									{
										$jobQualities[$ctr] = $rowJobQualities['jobQualiDescription'];
										$ctr++;
									}
									
									$ctr--;
									$totalJobQualities = $ctr;  // counting starts at 0
									
									if ($totalAppQualities > $totalJobQualities)
									{
										$overAll = $totalAppQualities;
									}
									else
									{
										$overAll = $totalJobQualities;
									}
									
										// -------- getting same values -----------
										$ctrApp = 0;
										$ctrJob = 0;
										$count = 0;
										$ctrSame = 0;
										$indApp = array();;
										$indJob = array();
										while($ctrApp <= $totalAppQualities)
										{
											$ctrJob = 0;
											while($ctrJob <= $totalJobQualities)
											{
												if ($appQualities[$ctrApp]==$jobQualities[$ctrJob])
												{
													$appQualitiesSame[$ctrSame] = $appQualities[$ctrApp];
													$indApp[$ctrSame] = $ctrApp;
													$indJob[$ctrSame] = $ctrJob;
													$ctrSame++;
												}// 
												$ctrJob++;
												$count++;
											}
											$ctrApp++;
										}
										
										$ctrSame--;
										$sameNum = $ctrSame;
										// -----------------------------
										
										// ---- printing same values ------
									
										$ctr = 0;
										while($ctr <= $sameNum)
										{
											echo "<tr>";
											if ($ctr ==0)
											echo"<td>Quality</td>";
											else
											echo"<td></td>";
											echo"<td>$appQualitiesSame[$ctr]</td>";
											echo"<td>$appQualitiesSame[$ctr]</td>";
											echo"<td> <span class='glyphicon glyphicon-ok'></span></td>";
											echo "</tr>";
											$ctr++;
										}
										// ---------------------------------
										
										
										$jobShort ="";
										$appShort = "";
										$length = 0;
										$short = 0;
										
										if (count($appQualities) > count($jobQualities))
										{
												$length = count($appQualities);
												$short = count($jobQualities);
												$length--;
												$short--;
												$jobShort = "yes";
										}
										else if (count($appQualities) < count($jobQualities))
										{
												$length = count($jobQualities);
												$short = count($appQualities);
												$length--;
												$short--;
												$appShort = "yes";
										}
										
						
										
										$ctr = $short;
										$ctr++;
										while ($ctr <= $length)
										{
											if ($jobShort == "yes")
											{
												$jobQualities[$ctr]="-------";
											}
											if ($appShort == "yes")
											{
												$appQualities[$ctr]="-------";
											}
											$ctr++;
										}
									
												
										// ---- printing other values ------
										$ctr = 0;
										while($ctr <= $length)
										{
											if (isset($appQualitiesSame))
											{
												if (in_array($appQualities[$ctr], $appQualitiesSame)) 
												{
													//not print
												}
												else if (in_array($jobQualities[$ctr], $appQualitiesSame)) 
												{	
													//not print
												}
												else 
												{
													echo "<tr>";
													if ($ctr ==0)
													echo"<td>Quality</td>";
													else
													echo"<td></td>";
												
													echo"<td>$appQualities[$ctr]</td>";
													echo"<td>$jobQualities[$ctr]</td>";
													echo"<td></td>";
													echo "</tr>";
												}
											}
											else 
												{
													echo "<tr>";
													if ($ctr ==0)
													echo"<td>Quality</td>";
													else
													echo"<td></td>";
												
													echo"<td>$appQualities[$ctr]</td>";
													echo"<td>$jobQualities[$ctr]</td>";
													echo"<td></td>";
													echo "</tr>";
												}
											$ctr++;
										}
					// ---------------------------------------------------------------------------
						
				echo "</table>";
				mysql_close($con);
			?>
		</div>
	</div>
</div>
