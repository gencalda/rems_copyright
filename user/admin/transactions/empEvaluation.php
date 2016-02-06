<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	//include('../clientNotifModal.php');
?>
	
	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Performance Evaluation</li>
			<li class="active">Performance Evaluation Score</li>
		</ul>
	</div>

	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
		
			
				<div class="container-fluid">
					
						<?php
							echo"<h2>$_GET[name] </h2>";
							echo"<h4 style='text-align:left;'>Postition: $_GET[job] </h4>";
						?>
					
			  	</div>

		
			<br /><br />
		
		<?php
		
		$ID=$_GET['ID'];
		
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error()); 
					}
					
					mysql_select_db("$db_database", $con);
					
					$result = mysql_query("SELECT * FROM tbl_evaluation WHERE employeeID = $ID");
					while($row = mysql_fetch_array($result)) 
					{
						
						$date=date('F d, Y @ g:i A', strtotime($row['dateEvaluated']));
						echo"<p >Evaluated on:  $date </p>";
						
						$result2 = mysql_query("SELECT * FROM tbl_evaluation WHERE evalId = $row[evalId] ");
						
						while($row2 = mysql_fetch_array($result2)) 
						{
							$result3 = mysql_query("SELECT * FROM tbl_client WHERE clientId = $row2[clientId] ");
							while($row3 = mysql_fetch_array($result3))
							{
								$eva= $row3['clientName'];
							}
							echo "
									
										
									
										<h3>Evaluator: ".$eva."</h3>
									
									
										<h3>Total Score: " .$row2['remsValue']."</h3>
									
									
									";
									
							echo "<div class='col-md-6 col-md-offset-3'>";	
							echo "<table class='table'>
									<thead>
										<td><h4>Performance Factor </h4></td>
										<td><h4>Score</h4></td>
									</thead>
									<tr>
										<td><h4>Quality &nbsp; </h3></td>
										<td><h4>".$row2['quality']."</h4></td>
									</tr>
									<tr>
										<td><h4>Productivity &nbsp; </h3></td>
										<td><h4>".$row2['productivity']."</h4></td>
									</tr>
									<tr>
										<td><h4>Job Knowledge &nbsp; </h3></td>
										<td><h4>".$row2['jobknowledge']."</h4></td>
									</tr>
									<tr>
										<td><h4>Reliability &nbsp; </h3></td>
										<td><h4>".$row2['reliability']."</h4></td>
									</tr>
									<tr>
										<td><h4>Attendance &nbsp; </h3></td>
										<td><h4>".$row2['attendance']."</h4></td>
									</tr>
									<tr>
										<td><h4>Initiative/Creativity &nbsp; </h3></td>
										<td><h4>".$row2['initiative']."</h4></td>
									</tr>
									<tr>
										<td><h4>Teamwork &nbsp; </h3></td>
										<td><h4>".$row2['teamwork']."</h4></td>
									</tr>
									<tr>
										<td><h4>Customer Service &nbsp; </h3></td>
										<td><h4>".$row2['customer']."</h4></td>
									</tr>
									<tr>
										<td><h4>Others &nbsp; </h3></td>
										<td><h4>".$row2['other']."</h4></td>
									</tr>
									<tr>
										<td><h4>Comment &nbsp; </h3></td>
										<td><h4>".$row2['commentScore']."</h4></td>
									</tr>
									<tr>
										<td colspan='2'><h4>".$row2['evalComment']."</h4></td>
									</tr>
									</table>";
							echo "</div>";	
						}
					}
					
					//echo "</div>";
		
		?>
		
		</div>
	</div>
<?php
	include ('../footer.php');
?>