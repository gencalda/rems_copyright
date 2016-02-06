
				<div id="content2">
					<?php
						if(!session_id())session_start();
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
				
					//CLIENT NOTIF
					$clientpartnership = mysql_query("SELECT * FROM tbl_client a, tbl_contract b, tbl_notification c WHERE a.clientId = b.clientId AND a.clientId = c.clientId AND notifDesc = '. Partnership was successfully done.' AND c.clientId = '$_SESSION[login_userId]]' group by dateCreated DESC");
					$endorsement = mysql_query("SELECT * FROM tbl_applicant a, tbl_basic_info b, tbl_client c, tbl_notification d WHERE a.basicId = b.basicId AND a.applicantId = d.applicantId AND c.clientId = d.clientId AND notifDesc = 'was endorsed to' AND d.clientId = '$_SESSION[login_userId]]' group by dateCreated DESC");
					$deployment = mysql_query("SELECT * FROM tbl_applicant a, tbl_basic_info b, tbl_client c, tbl_notification d, tbl_employee e, tbl_job_posting f WHERE a.basicId = b.basicId AND a.applicantId = e.applicantId AND e.employeeId = d.employeeId AND c.clientId = d.clientId AND notifDesc = 'is now an employee of' AND d.clientId = '$_SESSION[login_userId]]' group by dateCreated DESC");
																	
					echo "<table class='table table-hover table-striped'>";
					
					while($row = mysql_fetch_array($deployment)) 
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>" . $row['basicFirstName'] . " " . $row['basicMiddleName'] . " " . $row['basicLastName'] . " " . $row['basicExtName'] . " " . $row['notifDesc'] . " " . $row['clientName'] ."</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";	
					}
					
					while($row = mysql_fetch_array($endorsement)) 
					{
						//$main = md5('maintenance');
						echo "<tr>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>" . $row['basicFirstName'] . " " . $row['basicMiddleName'] . " " . $row['basicLastName'] . " " . $row['basicExtName'] . " " . $row['notifDesc'] . " " . $row['clientName'] . "</a></td>";
						echo "<td><a style='color:black;  
									text-decoration: none;'
									href = '#'>". $row['dateCreated'] . "</a></td>";
									
						echo "</tr>";	
					}
					
					while($row = mysql_fetch_array($clientpartnership)) 
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
				
