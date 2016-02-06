<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include ('endorseModal.php');
	include('../adminNotifModal.php');
?>

	
		<?php
			
			
			$genderPercent = '0';
				$agePercent = '0';
				$civilStatusPercent = '0';
				$expectedSalaryPercent = '0';
				$religionPercent = '0';
				$nationalityPercent = '0';
				$heightPercent = '0';
				$weightPercent = '0';
				$languagePercent = '0';
				$qualityPercent = '0';
				
				$languageCtr = 0;
				$qualitiesCtr = 0;
				$totalPercent = 0;
			
			$basicID = '';
			$firstName = '';
			$middleName = '';
			$lastName = '';
			$clientName = '';
			$block = '';
			$street = '';
			$subdivision = '';
			$barangay = '';
			$district = '';
			$city  = '';
			$province  = '';
			$userFname  = '';
			$userMname  = '';
			$userLname  = '';
			$usernameBasicID = '';
			
			$appID = $_SESSION['ses_AppID'];
			
				$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
				
				
					//getting the BasicID
			$query = "SELECT * FROM tbl_applicant WHERE applicantId = $_SESSION[ses_AppID]";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$basicID = $obj->basicId;
				}//while
			}//if 				

				
				$queryFirstChoice = mysql_query("SELECT * FROM tbl_desired_position WHERE applicantId = $_SESSION[ses_AppID] and positionRank = 'First'");
				
				$name = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId = $basicID");
				while($row = mysql_fetch_array($name)) 
				{	
					$firstName = $row['basicFirstName'];
					$middleName = $row['basicMiddleName'];
					$lastName = $row['basicLastName'];
				}

				while($row = mysql_fetch_array($queryFirstChoice)) 
				{	
					$firstJob	= $row['positionJobName']; 	
				}
				
	?>
	

	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="assessApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><?php echo "$firstName $middleName $lastName"; ?></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">First Choice is <?php echo "$firstJob"; ?></li>
			<ul class="pull-right">
				<li><a href="assessApplicant.php?token=<?php echo $tran; ?>"><span class='glyphicon glyphicon-arrow-left'>&nbsp;</span>Assess Applicant</a></li>
			</ul>
		</ul>
	</div>



	<div class="container-fluid">
	
	<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
			<h4 class="alert-info well-lg">
				<?php
					echo "Pairing results for <strong> $firstName $middleName $lastName </strong>'s first choice."; 
				?> 
				<br /><br />
				Pairing results are based on the client's job qualifications.
			</h4>
			<br />

			<nav class="breadcrumbs">
					<div class="container-fluid">
						<?php
						$tran = md5('transaction');
							
							echo"
							<ul class='nav navbar-nav aktibo'>
								<li><a href='pairingFirst.php?token=$tran'><span class='glyphicon glyphicon-tasks'> </span> First Choice</a></li>
							</ul>
							<ul class='nav navbar-nav'>
								<li><a href='pairingSecond.php?token=$tran'><span class='glyphicon glyphicon-tasks'> </span> Second Choice</a></li>
							</ul>
							<ul class='nav navbar-nav'>
								<li><a href='pairingThird.php?token=$tran'><span class='glyphicon glyphicon-tasks'> </span> Third Choice</a></li>
							</ul>
							
							";
						?>
				  	</div>
				</nav>


			<div class="col-md-6">
				<br />
					<?php 	
						echo "<h2> $firstName $middleName $lastName </h2>"; 
						echo "<h3> First choice: $firstJob </h3>"; 
					?>	
				<br /><br />
			</div>
			<div class="col-md-6">
				<br /><br />
					<h4>
					
			
						
						<?php $tran = md5('transaction');?>
								<form target='_self' action='confirmEndorsement.php?attempt=0&token=<?php echo $tran;?>' method='POST'>
									<?php 
										$suggestJobName = '';
								$suggestClientName ='';
								$resultJobPosting = mysql_query("SELECT *
															FROM tbl_job_posting
															LEFT JOIN tbl_client 
															ON tbl_job_posting.clientId = tbl_client.clientId
															WHERE tbl_job_posting.jobPostingId = $_SESSION[ses_suggestedJob]
													     ");
					
							
							$i=0; 	// counter
			
							while($rowJobPosting = mysql_fetch_array($resultJobPosting)) 
							{
								
								$suggestJobName = $rowJobPosting['jobName'];
								$suggestClientName = $rowJobPosting['clientName'];
								$suggestJobId = $rowJobPosting['jobPostingId'];
							}
										echo "
										<input type='hidden' name='clientName' value= '$suggestClientName'>
										<input type='hidden' name='appFname' value= '$firstName'>
										<input type='hidden' name='appMname' value= '$middleName'>
										<input type='hidden' name='appLname' value= '$lastName'>
										<input type='hidden' name='jobName' value= '$suggestJobName'>
										<input type='hidden' name='basicID' value= '$basicID'>
										<input type='hidden' name='jobID' value= '$suggestJobId'>
										Suggestion: 
										<button class='btn btn-success'>
										Endorse</button> as $suggestJobName in $suggestClientName. </h4>	
								</form>";
						?>
				<br /><br />
			</div>




			<br /><br />
			
			<div class='container-fluid content'>
			<?php
			
			if (mysql_num_rows($queryFirstChoice) == 0) 
			{ 
				echo "Note: The applicant doesn't have a first choice position";
			}
			else 
			{
			
						// Declaration of arrays to be used
						$clientID = array();
						$jobPostingID = array();
						$tempJobPostingID = '';
						$scoreOfApplicant = array();
						$appLanguages = array();
						$appQualities = array();
						$totalNumJobQualifications = array();
						$score=0;
						$percent=0;
				
					
						
						// -------- getting all the JobPostingID & BranchID with the same jobtitle ----------
						$resultJobPostingID = mysql_query("SELECT *
															FROM  tbl_job_posting
															WHERE jobName = '$firstJob'
															AND jobStatus = 1
															ORDER BY jobPostingId
													     ");
					
							
							$i=0; 	// counter
			
							while($rowJobPostingID = mysql_fetch_array($resultJobPostingID)) 
							{
								$jobPostingID[$i] = $rowJobPostingID['jobPostingId'];
								$clientID[$i] = $rowJobPostingID['clientId'];
								//echo 'i='.$i.' ID='.$jobPostingID[$i].' ';
								$i++;
							}
							
							$i--;
							$totalSameJob = $i;  // counting starts at 0
						//---------------------------------------------------------------------	


							//name here
							
							
								
					// ------ getting the score of passed qualifications in each job posting ID that has same Jobtitle as the 1st choice -------------		
							$i=0;
							while($i <= $totalSameJob)
							{
								
								// declaration
								$tempAge = 0;
								$tempHeight = 0;
								$tempWeight = 0;
								$totalNumJobQualifications[$i] = 0; 
								$scoreOfApplicant[$i] = 0;  
								$totalPercent = 0;
								
								$result = mysql_query("SELECT * 
														FROM  tbl_job_quali
														WHERE (jobQualiNewlyAdded != 'Yes' 
														OR  jobQualiNewlyAdded IS NULL)
														AND jobPostingId = $jobPostingID[$i]
														ORDER BY jobQualiId
													     ");
														 
								while($row = mysql_fetch_array($result)) 
								{
								//echo $row['jobQualifiType'].'   ';
								//echo $row['jobQualifiDesc'].'   ';
								
									//--------------- gender ---------------- 1
									
									$resultGender = mysql_query("SELECT *
															FROM  tbl_personal_info 
															WHERE personalQualityType = 'Gender'
															AND basicId = $basicID
															");
									while($rowGender = mysql_fetch_array($resultGender)) 
									{
										$appGender = $rowGender['personalQualityDesc'];
									}
															
									if ($row['jobQualiType']=='Gender')
									{
										if($row['jobQualiDescription']=='Any')
										{
											$scoreOfApplicant[$i]++;
											$genderPercent = $row['jobQualiPercent']; //percentage of gender
											$totalPercent = $totalPercent + intval($genderPercent);	
										}// if - any
										else if ($row['jobQualiDescription']==$appGender)
										{
											$scoreOfApplicant[$i]++;
											$genderPercent = $row['jobQualiPercent']; //percentage of gender
											$totalPercent = $totalPercent + intval($genderPercent);
										}// else if
										
										$totalNumJobQualifications[$i]++; 
									}//if - gender
									
									//------------------------------------
									
									//--------------- age ---------------- 2
								
									
									$resultAge = mysql_query("SELECT *
															FROM  tbl_personal_info
															WHERE personalQualityType = 'Age'
															AND basicId = $basicID
															");
															
									while($rowAge = mysql_fetch_array($resultAge)) 
									{
										$appAge = $rowAge['personalQualityDesc'];
									}//while
									
									if ($row['jobQualiType']=='Age From')
									{
										if(intval($appAge)>=intval($row['jobQualiDescription']))
										{
											$tempAge++;
										}// if - desc
										
										$totalNumJobQualifications[$i]++;   // add to 'from'
									}// if - type
									
									if ($row['jobQualiType']=='Age To')
									{
										if(intval($appAge)<=intval($row['jobQualiDescription']))
										{
											$tempAge++;
										}// if - desc
									}// if - type
									
									if ($tempAge==2)
									{
										$scoreOfApplicant[$i]++;
										$agePercent = $row['jobQualiPercent']; 	
										$totalPercent = $totalPercent +  intval($agePercent);
										$tempAge = 0;
									}
									//------------------------------------
									
									
									//--------------- civil status ---------------- 3
									$resultCivilStatus = mysql_query("SELECT *
															FROM  tbl_personal_info
															WHERE personalQualityType = 'Civil Status'
															AND basicId = $basicID
															");
									while($rowCivilStatus = mysql_fetch_array($resultCivilStatus)) 
									{
										$appCivilStatus = $rowCivilStatus['personalQualityDesc'];
									}
									
									if ($row['jobQualiType']=='Civil Status')
									{
										if($row['jobQualiDescription']=='Any')
										{
											$scoreOfApplicant[$i]++;
											$civilStatusPercent = $row['jobQualiPercent']; 
											$totalPercent = $totalPercent +  intval($civilStatusPercent);
										}// if - any
										else if ($row['jobQualiDescription']==$appCivilStatus)
										{
											$scoreOfApplicant[$i]++;
											$civilStatusPercent = $row['jobQualiPercent']; 
											$totalPercent = $totalPercent +  intval($civilStatusPercent);
										}// else if
										
										$totalNumJobQualifications[$i]++;  
									}//if - civil status
									//-------------------------------------------
									
									
									//--------------- expected salary ---------------- 4
									$resultExpectedSalary = mysql_query("SELECT *
															FROM  tbl_personal_info
															WHERE personalQualityType = 'Expected Salary'
															AND basicId = $basicID
															");
									while($rowExpectedSalary = mysql_fetch_array($resultExpectedSalary)) 
									{
										// this is appExpectedSalary, changed to resultExpectedSalary
										$appExpectedSalary = $rowExpectedSalary['personalQualityDesc'];
									}
									
									if ($row['jobQualiType']=='Expected Salary')
									{
										if(intval($appExpectedSalary)<=intval($row['jobQualiDescription']))
										{
											$scoreOfApplicant[$i]++;
											$expectedSalaryPercent = $row['jobQualiPercent']; 
											$totalPercent = $totalPercent +  intval($expectedSalaryPercent);
										}// if - desc
										
										$totalNumJobQualifications[$i]++;   
									}// if - type
									
									
									//------------------------------------------------
									
									
									//------------------- religion ------------------- 5
									$resultReligion = mysql_query("SELECT *
															FROM  tbl_personal_info
															WHERE personalQualityType = 'Religion'
															AND basicId = $basicID
															");
									while($rowReligion = mysql_fetch_array($resultReligion)) 
									{
										$appReligion = $rowReligion['personalQualityDesc'];
									}
									
									if ($row['jobQualiType']=='Religion')
									{
										if($row['jobQualiDescription']=='Any')
										{
											$scoreOfApplicant[$i]++;
											$religionPercent = $row['jobQualiPercent']; 	
											$totalPercent = $totalPercent +  intval($religionPercent);
										}// if - any
										else if ($row['jobQualiDescription']==$appReligion)
										{
											$scoreOfApplicant[$i]++;
											$religionPercent = $row['jobQualiPercent']; 	
											$totalPercent = $totalPercent +  intval($religionPercent);
										}// else if
										
										$totalNumJobQualifications[$i]++;   
									}//if - 
									
									
									//------------------------------------------------
									
									
									//------------------- nationality ------------------- 6
									$resultNationality = mysql_query("SELECT *
															FROM  tbl_personal_info
															WHERE personalQualityType = 'Nationality'
															AND basicId = $basicID
															");
									while($rowNationality = mysql_fetch_array($resultNationality)) 
									{
										$appNationality = $rowNationality['personalQualityDesc'];
									}
									
									if ($row['jobQualiType']=='Nationality')
									{
										if($row['jobQualiDescription']=='Any')
										{
											$scoreOfApplicant[$i]++;
											$nationalityPercent =  $row['jobQualiPercent']; 	
											$totalPercent = $totalPercent +  intval($nationalityPercent);
										}// if - any
										else if ($row['jobQualiDescription']==$appNationality)
										{
											$scoreOfApplicant[$i]++;
											$nationalityPercent =  $row['jobQualiPercent']; 	
											$totalPercent = $totalPercent +  intval($nationalityPercent);
										}// else if
										
										$totalNumJobQualifications[$i]++;   
									}//if - 
									
									//------------------------------------------------
									
									//------------------- height ------------------- 7
									$resultHeight = mysql_query("SELECT *
															FROM  tbl_personal_info
															WHERE personalQualityType = 'Height'
															AND basicId = $basicID
															");
									while($rowHeight = mysql_fetch_array($resultHeight)) 
									{
										$appHeight = $rowHeight['personalQualityDesc'];
									}
									
									if ($row['jobQualiType']=='Height')
									{
										if($row['jobQualiDescription']=='Any')
										{
											$scoreOfApplicant[$i]++;
											$heightPercent =  $row['jobQualiPercent']; 
											$totalPercent = $totalPercent +  intval($heightPercent);
										}// if - any
										
										$totalNumJobQualifications[$i]++;  
									}//if - 
									if ($row['jobQualiType']=='Height From')
									{
												if(intval($appHeight)>=intval($row['jobQualiDescription']))
												{
													$tempHeight++;
												}// if - desc
									}// if - type
											
									if ($row['jobQualiType']=='Height To')
									{
												if(intval($appHeight)<=intval($row['jobQualiDescription']))
												{
													$tempHeight++;
												}// if - desc
									}// if - type
											
									if ($tempHeight==2)
									{
												$scoreOfApplicant[$i]++;
												$heightPercent =  $row['jobQualiPercent']; 
												$totalPercent = $totalPercent +  intval($heightPercent);
												$tempHeight = 0;
									}
									//------------------------------------------------
									
									
									//------------------- weight ------------------- 8
									$resultWeight = mysql_query("SELECT *
															FROM  tbl_personal_info
															WHERE personalQualityType = 'Weight'
															AND basicId = $basicID
															");
									while($rowWeight = mysql_fetch_array($resultWeight)) 
									{
										$appWeight = $rowWeight['personalQualityDesc'];
									}
									
									if ($row['jobQualiType']=='Weight')
									{
										if($row['jobQualiDescription']=='Any')
										{
											$scoreOfApplicant[$i]++;
											$weightPercent = $row['jobQualiPercent']; 	
											$totalPercent = $totalPercent +  intval($weightPercent);
										}// if - any
										
										$totalNumJobQualifications[$i]++;   
									}//if - 
									if ($row['jobQualiType']=='Weight From')
									{
												if(intval($appWeight)>=intval($row['jobQualiDescription']))
												{
													$tempWeight++;
												}// if - desc
									}// if - type
											
									if ($row['jobQualiType']=='Weight To')
									{
												if(intval($appWeight)<=intval($row['jobQualiDescription']))
												{
													$tempWeight++;
												}// if - desc
									}// if - type
											
									if ($tempWeight==2)
									{
												$scoreOfApplicant[$i]++;
												$weightPercent = $row['jobQualiPercent']; 	
												$totalPercent = $totalPercent +  intval($weightPercent);
												$tempWeight = 0;
									}
									//------------------------------------------------
									
									//------------------- language ------------------- 9
									$resultLanguages = mysql_query("SELECT *
																	FROM tbl_personal_info
																	WHERE personalQualityType = 'Language'
																	AND basicId = $basicID
																	");
					
							
									$ctr=0; 	// counter
					
									while($rowLanguages = mysql_fetch_array($resultLanguages)) 
									{
										$appLanguages[$ctr] = $rowLanguages['personalQualityDesc'];
										$ctr++;
									}
									
									$ctr--;
									$totalAppLanguages = $ctr;  // counting starts at 0
									
									if ($row['jobQualiType']=='Language')
									{
										
										$ctr = 0;
										while($ctr <= $totalAppLanguages)
										{
											if ($row['jobQualiDescription']==$appLanguages[$ctr])
											{
												$scoreOfApplicant[$i]++;
												$languagePercent = $row['jobQualiPercent'];
												$totalPercent = $totalPercent +  intval($languagePercent);
											}// else if
											$ctr++;
										}//while
										
										$totalNumJobQualifications[$i]++;   
									}//if -
									//------------------------------------------------
									
									//------------------- qualities ------------------- 10
									$resultQualities = mysql_query("SELECT *
																	FROM tbl_personal_info
																	WHERE personalQualityType = 'Quality'
																	AND basicId = $basicID
																	");
					
							
									$ctr=0; 	// counter
					
									while($rowQualities = mysql_fetch_array($resultQualities)) 
									{
										$appQualities[$ctr] = $rowQualities['personalQualityDesc'];
										$ctr++;
									}
									
									$ctr--;
									$totalAppQualities = $ctr;  // counting starts at 0
									
									
									if ($row['jobQualiType']=='Quality')
									{
										
										$ctr = 0;
										while($ctr <= $totalAppQualities)
										{
											if ($row['jobQualiDescription']==$appQualities[$ctr])
											{
												$scoreOfApplicant[$i]++;
												$qualityPercent = $row['jobQualiPercent']; 
												$totalPercent = $totalPercent +  intval($qualityPercent);
											}// else if
											$ctr++;
										}//while
										
										$totalNumJobQualifications[$i]++;   
									}//if -
									//------------------------------------------------
									
								}//while						 
							
							
							// ------------------ getting the BranchDetails ---------------------------
							$resultClient = mysql_query("SELECT *
															FROM tbl_client
															WHERE clientId = $clientID[$i]
															 ");
						
							
								while($rowClient = mysql_fetch_array($resultClient)) 
								{
									$clientName = $rowClient['clientName'];
								
								}
							
							$resultLocation = mysql_query("SELECT *
															FROM tbl_address
															WHERE clientId = $clientID[$i]
															 ");
								
								while($rowLocation = mysql_fetch_array($resultLocation)) 
								{
									$block  = $rowLocation['addBlock'];
									$street  = $rowLocation['addStreet'];
									$subdivision  = $rowLocation['addSubdivision'];
									$barangay  = $rowLocation['addBarangay'];
									$district  = $rowLocation['addDistrict'];
									$city  = $rowLocation['addCity'];
									$province  = $rowLocation['addProvince'];
								}//Location
								
							//---------------------------------------------------------------------	
				
							echo "<div class='well well-lg col-md-12 section'>";
							
							if($totalPercent>=60)
							{
							echo"<h1 style='color:green'> ".round($totalPercent,2)."%</h1>";
							}
							else if ($totalPercent<=60)
							{
							echo"<h1 style='color:red'> ".round($totalPercent,2)."%</h1>";
							}
							//echo "<h5> passed ".$scoreOfApplicant[$i]." out of ".$totalNumJobQualifications[$i]." qualifications </h5>";
							$tran = md5('transaction');
							echo "<td ><a style='color:black;  text-decoration: underline;' href = 'pairingDetails.php?token=$tran&basicID=".$basicID."&jobID=".$jobPostingID[$i]."'>" ."passed ".$scoreOfApplicant[$i]." out of ".$totalNumJobQualifications[$i]." qualifications</a></td>";
					
							echo "<h2> ".$clientName."</h2>";
							echo "<h4> ".$city.", ".$province."</h4>";
							
							
							
							//-------------------------------------------------------------------
							
							//		Fullname of user	
							//
								$resultUsernameID = mysql_query("SELECT *
															FROM tbl_user_account
															WHERE accountId = $_SESSION[login_userId]
															 ");
								
								while($rowUsernameID = mysql_fetch_array($resultUsernameID)) 
								{
									$usernameBasicID =   $rowUsernameID['basicId'];
								}//Location
							
							
								$resultUsername = mysql_query("SELECT *
															FROM tbl_basic_info
															WHERE basicId = $usernameBasicID
															 ");
								
								while($rowUsername = mysql_fetch_array($resultUsername)) 
								{
									$userFname  =  $rowUsername['basicFirstName'];
									$userMname  =  $rowUsername['basicMiddleName'];
									$userLname  = $rowUsername['basicLastName'];
								}//Location
							
							//-------------------------------------------------------------------
							?>
							
							<?php $tran = md5('transaction');?>
								<form target='_self' action='confirmEndorsement.php?attempt=0&token=<?php echo $tran;?>' method='POST'>
									<?php 
										echo "<input type='hidden' name='clientId' value= ' $clientID[$i]'>
										<input type='hidden' name='clientName' value= '$clientName'>
										<input type='hidden' name='clientLoc' value= '$block $street $subdivision $barangay $district $city, $province'>
										<input type='hidden' name='appID' value= '$_SESSION[ses_AppID]'>
										<input type='hidden' name='basicID' value= '$basicID'>
										<input type='hidden' name='appFname' value= '$firstName'>
										<input type='hidden' name='appMname' value= '$middleName'>
										<input type='hidden' name='appLname' value= '$lastName'>
										<input type='hidden' name='jobID' value= '$jobPostingID[$i]'>
										<input type='hidden' name='jobName' value= '$firstJob'>
										<input type='hidden' name='user' value= '$userFname $userMname $userLname'>
								
										<button class='btn btn-success'>
										Endorse</button> </h4>	
								</form>";
								echo "</div>";
							
	
										
							$genderPercent = '0';
							$agePercent = '0';
							$civilStatusPercent = '0';
							$expectedSalaryPercent = '0';
							$religionPercent = '0';
							$nationalityPercent = '0';
							$heightPercent = '0';
							$weightPercent = '0';
							$languagePercent = '0';
							$qualityPercent = '0';
							
							$languageCtr = 0;
							$qualitiesCtr = 0;
							$totalPercent = 0;	
								
							
							$i++;
							}//  while statement - loop through all the job posting ID with the same jobtitle as the first choice
					//----------------------------------------------------------------------------------------------------------------------------
							echo "</table>";
					mysql_close($con);
												
			}//else
			
		   ?>
				
			</div>
		</div>
	
	</div>


	<br /><br /><br />
<?php
	include ('../footer.php');
?>