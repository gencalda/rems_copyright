<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
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
		<div class="col-md-12" style="background-color: #f0f0f0; margin-bottom: 8em; margin-top: 3em; padding:1em;">
			<h4 class="alert-info well-lg">Assess an applicant by clicking the applicant's name.</h4>
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
									autofocus="autofocus"
									class="form-control" 
									name="searchClientName" 
									value='' 
									placeholder="Type voucher code"
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
						
						$result = mysql_query("SELECT *
												FROM tbl_basic_info
												INNER JOIN tbl_applicant
												ON tbl_basic_info.basicId = tbl_applicant.basicId
												ORDER BY tbl_basic_info.basicLastName");
						echo "<table class='table table-hover table-striped'>";
						echo "<thead class='tablehead'>";
						echo "<tr>
										<td>Applicant Name</td>
						</tr>";
										
						echo "</thead>";

						//echo $result;
						
						$tran = md5('transaction');
						while($row = mysql_fetch_array($result)) 
						{
							
							echo "<tr>";
							
							
							if ($row['applicantStatus']=="Active")
							{
								echo "<td ><a style='color:black;  text-decoration: underline;' href = 'assessApplicantSkills.php?token=$tran&&appID=".$row['applicantId']."'>" .$row['basicLastName'].", ".$row['basicFirstName']." ".$row['basicMiddleName']." </a></td>";
								//--------------------------------------------
								
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