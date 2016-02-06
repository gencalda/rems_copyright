<?php
	session_start();
	include_once ('../config/connection.php');

	
			$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
	
				mysql_select_db("$db_database", $con);
				
	
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
				$totalPercent2 = 0;
				$totalPercent3 = 0;

if(isset($_POST['submitAppQualifications'])) 
{		
	
	$basicID = '';

	//getting the BasicID
		$query = "SELECT * FROM tbl_applicant WHERE applicantId = $_SESSION[ses_AppID]";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$basicID = $obj->basicId;
				}//while
			}//if 				

	if (!empty($_POST['name_AppQualities']))
	{
		
		$mysqli->query("DELETE FROM tbl_personal_info WHERE basicId = '$basicID' AND personalQualityType = 'Quality'");
		
		
		foreach($_POST['name_AppQualities'] as $selected) 
		{
		
			$mysqli->query("INSERT INTO `tbl_personal_info`(`basicId`, `personalQualityDesc`, `personalQualityType`) VALUES ('$basicID','$selected','Quality')");
		

		
	    }//for each

	}//if not empty
	
	
	//appNotes
	$mysqli->query("UPDATE tbl_basic_info SET basicNotes = '$_POST[name_ApplicantNotes]' WHERE basicId = $basicID");	

	
	
	//	/	/	/	/	/	/	/	/	first choice	/	/	/	/	/	/	/	/	/	/
		$queryFirstChoice = mysql_query("SELECT * FROM tbl_desired_position WHERE applicantId = $_SESSION[ses_AppID] and positionRank = 'First'");
		while($row = mysql_fetch_array($queryFirstChoice)) 
				{	
					$firstJob	= $row['positionJobName']; 	
				}
				
				
			if (mysql_num_rows($queryFirstChoice) != 0) 
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
						$totalPercent=0;
						$maxPercentage=0;
					
						
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
							
							
								//---------------------------------------------------------------------	
								
								
								echo" first: $totalPercent";
								if ($totalPercent > $maxPercentage)
								{
									$maxPercentage = $totalPercent;
									$_SESSION['ses_suggestedJob'] = $jobPostingID[$i];
								}// if - getting the highest
								
								
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
												
			}//else
	
	//	/	/	/	/	/	/	/	/ -- first choice -- /	/	/	/	/	/	/	/	/	/
	
	
	// ----------------------------- second choice ---------------------------------------------------------
	
		$queryFirstChoice = mysql_query("SELECT * FROM tbl_desired_position WHERE applicantId = $_SESSION[ses_AppID] and positionRank = 'Second'");
		while($row = mysql_fetch_array($queryFirstChoice)) 
				{	
					$firstJob	= $row['positionJobName']; 	
				}
				
				
			if (mysql_num_rows($queryFirstChoice) != 0) 
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
							
							
								//---------------------------------------------------------------------	
								echo" second: $totalPercent";
								if ($totalPercent > $maxPercentage)
								{
									$maxPercentage = $totalPercent;
									$_SESSION['ses_suggestedJob'] = $jobPostingID[$i];
								}// if - getting the highest
								
								
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
												
			}//else
	
	// ----------------------------------------------------------------------------------------------------
	
	
	
	// ----------------------------- third choice ---------------------------------------------------------
	
		$queryFirstChoice = mysql_query("SELECT * FROM tbl_desired_position WHERE applicantId = $_SESSION[ses_AppID] and positionRank = 'Third'");
		while($row = mysql_fetch_array($queryFirstChoice)) 
				{	
					$firstJob	= $row['positionJobName']; 	
				}
				
				
			if (mysql_num_rows($queryFirstChoice) != 0) 
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
							
							echo" third: $totalPercent";
								//---------------------------------------------------------------------	
								
								if ($totalPercent > $maxPercentage)
								{
									$maxPercentage = $totalPercent;
									$_SESSION['ses_suggestedJob'] = $jobPostingID[$i];
								}// if - getting the highest
								
								
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
	// ----------------------------------------------------------------------------------------------------

	
	echo" job: $firstJob";
	echo" appID: $_SESSION[ses_AppID]";
	echo "max: $maxPercentage";
	echo" suggested job: $_SESSION[ses_suggestedJob]";
	
}//if set

$tran = md5('transaction');
header("location: ../user/admin/transactions/pairingFirst.php?token=$tran");

?>