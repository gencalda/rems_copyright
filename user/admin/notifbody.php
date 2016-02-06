
				<div id="content2">
					<?php
				/*	
					if(!isset($_GET['token']))
					{
						$not = "../../";
					}
					else if($_GET['token'] == md5('index'))
					{
						$not = "../../";
					}
					else
					{
						$not = "../../../";
					}
										
					
					//$toks = "";
					//$main = "";
	
					include(''.$not.'/config/connection.php');
					*/
					
					
					
						if(!isset($_GET['token']))
						{
							$not = "../..";
							$toks = "";
							$main = "";
							$tran = "";
							
						}
						else if ($_GET['token'] == md5('index'))
						{
							$not = "../..";
							//include(''.$not.'/config/connection.php');
						}
						else
						{
							$not = "../../..";
							
						}
					
						include(''.$not.'/config/connection.php');
						
					
					
					$con = mysql_connect("$db_hostname","$db_username","$db_password");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error()); 
					}
					
					mysql_select_db("$db_database", $con);
					
					$postedajob = mysql_query("SELECT * FROM tbl_client a, tbl_notification b, tbl_job_posting c WHERE a.clientId = c.clientId AND c.jobPostingId = b.jobPostingId AND notifDesc = 'posted a new job.' group by dateCreated DESC");
					$failedapplicant = mysql_query("SELECT * FROM tbl_endorsement a, tbl_client b, tbl_notification c WHERE c.clientId = b.clientId AND a.clientId = b.clientId AND notifDesc = 'rejected an applicant.' group by dateCreated DESC");
					$passedapplicant = mysql_query("SELECT * FROM tbl_endorsement a, tbl_client b, tbl_notification c WHERE c.clientId = b.clientId AND a.clientId = b.clientId AND notifDesc = 'accepted an applicant.' group by dateCreated DESC");
					$clientregister  = mysql_query("SELECT * FROM tbl_client a, tbl_notification b WHERE a.clientId = b.clientId AND notifDesc = 'registered as a client.' group by dateCreated DESC");
					$evaluation = mysql_query("SELECT * FROM tbl_applicant a, tbl_basic_info b, tbl_client c, tbl_notification d, tbl_employee e, tbl_evaluation f WHERE a.basicId = b.basicId AND a.applicantId = e.applicantId AND e.employeeId = d.employeeId AND c.clientId = d.clientId AND f.employeeId = e.employeeId AND notifDesc = 'evaluated' group by dateCreated DESC");
					$reportedemp = mysql_query("SELECT * FROM tbl_applicant a, tbl_basic_info b, tbl_client c, tbl_notification d, tbl_employee e, tbl_emp_reports f WHERE a.basicId = b.basicId AND a.applicantId = e.applicantId AND e.employeeId = d.employeeId AND c.clientId = d.clientId AND f.employeeId = e.employeeId AND notifDesc = 'reported' group by dateCreated DESC");
					
					
					echo "<table class='table table-hover table-striped'>";
					
					while($row = mysql_fetch_array($reportedemp))
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>" . $row['clientName'] . " " . $row['notifDesc'] . " " . $row['basicFirstName'] . " " . $row['basicMiddleName'] . " " . $row['basicLastName'] . "</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";	
					}
					
					while($row = mysql_fetch_array($evaluation))
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>" . $row['clientName'] . " " . $row['notifDesc'] . " " . $row['basicFirstName'] . " " . $row['basicMiddleName'] . " " . $row['basicLastName'] . "</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";	
					}
					
					while($row = mysql_fetch_array($failedapplicant))
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";	
					}
					
					while($row = mysql_fetch_array($passedapplicant)) 
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";	
					}
					
					while($row = mysql_fetch_array($postedajob)) 
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '$toks/maintenance/job.php?token=$main&ID=".$row['clientId']."'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '$toks/maintenance/job.php?token=$main&ID=".$row['clientId']."'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";
						
					}
					
					while($row = mysql_fetch_array($clientregister)) 
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>" . $row['clientName'] . " " . $row['notifDesc'] . "</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";	
					}

					echo "</table>";
					mysql_close($con);
					
				?>
				</div>
				
