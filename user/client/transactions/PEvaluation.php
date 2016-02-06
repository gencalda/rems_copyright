<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
?>
	

	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Performance Evaluation</li>
		</ul>
	</div>


	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="PEvaluation.php?tab=transaction" style="margin-left:.5em;">Performance Evaluation</a></h3></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">List of employees ready for Performance Evaluation.</h4>
			<br /><br />
			<div class="container-fluid table-responsive content">
			
			<?php	
					$con = mysql_connect("$db_hostname","$db_username","$db_password");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error()); 
					}
					
					mysql_select_db("$db_database", $con);
					$clientId =$_SESSION['login_userId'];
					
					$result = mysql_query("SELECT employeeId, basicFirstName, basicLastName, jobName, clientName FROM tbl_employee a, tbl_basic_info b, tbl_client c, tbl_job_posting d, tbl_applicant e WHERE a.applicantId = e.applicantId AND e.basicId = b.basicId AND a.jobPostingId = d.jobPostingId AND d.clientId = c.clientId AND c.clientId = $clientId");
					echo "<table class='table table-hover table-striped'>";
					echo"<thead class='tablehead'>
						<tr>
							<td>Employee Name</td>
							<td>Position</td>	
							<td>Client Designation</td>	
							<td>Evaluate Now</td>
							<td>Last Evaluation<td>
						</tr>
					</thead>";
					
					$EID2='';
					while($row = mysql_fetch_array($result)) 
					{
					
						$EID = $row['employeeId'];
						
						$result2 = mysql_query("SELECT employeeId, dateEvaluated FROM tbl_evaluation WHERE employeeId = $EID");
						while($row2 = mysql_fetch_array($result2))
						{
							$EID2=$row2['employeeId'];
							date_default_timezone_set('Asia/Manila');
							$monthcur= date('m');
							$daycur= date('d');
							$monthemp= date('m', strtotime($row2['dateEvaluated']));
							$dayemp= date('d', strtotime($row2['dateEvaluated']));
							$emp=date('t', strtotime($row2['dateEvaluated']))-$dayemp;
							$difmo=$monthcur-$monthemp;
							
							$contract= mysql_query("SELECT * FROM tbl_contract WHERE employeeId = $EID");
							while($line = mysql_fetch_array($contract))
							{	
								
									date_default_timezone_set("Asia/Manila");
									$date = date("Y/m/d");
									$start = new DateTime($date);
									
									
									$end = $line['contractEndDate'];
									$end = new DateTime($end);
									
									$interval = $start ->diff($end);
									$weeks = (int)(($interval->days) / 7);
							}
							
							if($monthcur==$monthemp&&$weeks!=1)
							{
								
								$tran = md5('transaction');
								echo "<tr>";
								echo "<td>".$row['basicFirstName']." ".$row['basicLastName']."</td>";
								echo "<td>".$row['jobName']."</td>";
								echo "<td>".$row['clientName']."</td>";	
								echo "<td><a href='empEvaluation.php?token=$tran&job=".$row['jobName']."&name=".$row['basicFirstName']." ".$row['basicLastName']."&ID=".$row2['employeeId']."'>Already Evaluated(Check evaluation)</a></td>";
								echo "<td>".$row2['dateEvaluated']."</td>";
								echo "</tr>";
									
							}
							else if(($difmo==1 && $emp+$daycur>30)||($difmo==-11 && $emp+$daycur>30)||($difmo>1)||$weeks==1)
							{
								$tran = md5('transaction');
								echo "<tr>";
								echo "<td>".$row['basicFirstName']." ".$row['basicLastName']."</td>";
								echo "<td>".$row['jobName']."</td>";
								echo "<td>".$row['clientName']."</td>";	
								echo "<td><a href='performanceEvaluationSheet.php?token=$tran&ID=".$row['employeeId']."'>Click Here</a></td>";
								echo "<td>Need to evaluate</td>";
								echo "</tr>";
							}
							
						}
						if($EID!=$EID2)
						{
							$tran = md5('transaction');
							echo "<tr>";
							echo "<td>".$row['basicFirstName']." ".$row['basicLastName']."</td>";
							echo "<td>".$row['jobName']."</td>";
							echo "<td>".$row['clientName']."</td>";	
							echo "<td><a href='performanceEvaluationSheet.php?token=$tran&ID=".$row['employeeId']."'>Click Here</a></td>";
							echo "<td>Not yet evaluated</td>";
							echo "</tr>";
						}	
						
					
						
							
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