<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>
	

	<div class='container-fluid content'><ul class="breadcrumb">
			<li>Reports</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client Summary</li>
		</ul>
	</div>

	


	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="clientSummary.php?token=<?php echo $repo; ?>" style="margin-left:.5em;">Client Summary</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a target="_blank" href="../fpdf/printClientSummary.php" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-print"> </span> Client Summary</a></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">Search for client then click the client name to view complete details.</h4> 		
			<br /><br />
			<div class='container-fluid content'>
				<form method="POST" action="#">
					<div class="form-group col-md-5">
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
						<option value="" selected>Search Client</option>
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

					<div class="form-group col-md-5">
							<input type="text" 
									autofocus="autofocus"
									class="form-control" 
									name="searchClientName" 
									value='' 
									placeholder="Type any part of client name ex. 'pen'"
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

		

				<div class="container-fluid table-responsive content">
					<?php
						if (isset($_POST['submit']))
						{
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
							if (!$con)
							{
								die('Could not connect: ' . mysql_error()); 
							}
							mysql_select_db("$db_database", $con);
							
							if ($_POST['searchClient']=="All Client")
							{	
								$result = mysql_query("SELECT * FROM client");
							}
							else if($_POST['searchClientName']=="pen")
							{
								$result = mysql_query("SELECT * FROM client WHERE clientName LIKE '%".$_POST['searchClientName']."%'");
							}
							else
							{
								$result = mysql_query("SELECT * FROM client WHERE clientID = '".$_POST['searchClient']."'");
							}
							echo"<div class='outer'>
							<div class='inner'>";
							echo "<table class='table  table-responsive table-hover table-striped'>";
							echo "<thead class='tablehead'>";
							echo "<tr>
								<td>Client Name</td>
								
								<td>Zip Code</td>
								<td>Location</td>
								<td>Contact Details</td>
								<td>Email Address</td>
								<td>Start of Contract</td>
								<td>End of Contract</td>
								</tr>
							</thead>";

							while($row = mysql_fetch_array($result)) 
							{
								echo "<tr>";
								echo "<th>" . $row['clientName'] . "</th>";
								
								echo "<td>" . $row['clientZip'] . "</td>";
								$clientLocation = explode("/",$row['clientLocation']);
								echo "<td>" . $clientLocation[0].$clientLocation[1].", ".$clientLocation[2]. "</td>";
								echo "<td>" . $row['clientLandline'] . "</td>";
								echo "<td>" . $row['clientEmailAddress'] . "</td>";
								echo "<td>" . $row['clientStartContract'] . "</td>";
								echo "<td>" . $row['clientEndContract'] . "</td>";
								echo "</tr>";
								
							}

							echo "</table>";
							echo"</div>
							</div>";
							mysql_close($con);
						}
							
						else
						{
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
							if (!$con)
							{
								die('Could not connect: ' . mysql_error()); 
							}
							mysql_select_db("$db_database", $con);
							$result = mysql_query("SELECT * FROM client");
							echo"<div class='outer'>
							<div class='inner'>";
							echo "<table class='table table-responsive table-hover table-striped'>";
							echo "<thead>";
							echo "<tr class='tablehead'>
								<td>Client Name</td>
								
								<td>Zip Code</td>
								<td>Location</td>
								<td>Contact Details</td>
								<td>Email Address</td>
								<td>Start of Contract</td>
								<td>End of Contract</td>
								</tr>
							</thead>";

							while($row = mysql_fetch_array($result)) 
							{
								echo "<tr>";
								echo "<th>" . $row['clientName'] . "</th>";
								
								echo "<td>" . $row['clientZip'] . "</td>";
								$clientLocation = explode("/",$row['clientLocation']);
								echo "<td>" . $clientLocation[0]." ".$clientLocation[1].", ".$clientLocation[2]. "</td>";
								echo "<td><a href='#' data-toggle='modal' data-target='#clientContactDetailsModal'>View Details</a></td>";
								echo "<td>" . $row['clientEmailAddress'] . "</td>";
								$var_start_contract_to_format=date_create($row['clientStartContract']);
								$var_start_contract_formatted=date_format($var_start_contract_to_format,'m/d/Y');
								echo "<td>" . $var_start_contract_formatted . "</td>";
								$var_end_contract_to_format=date_create($row['clientEndContract']);
								$var_end_contract_formatted=date_format($var_end_contract_to_format,'m/d/Y');
								echo "<td>" . $var_end_contract_formatted . "</td>";
								echo "</tr>";
								
							}

							echo "</table>";
							echo"</div>
							</div>";
							mysql_close($con);
						}
					?>
				</div>
			</div>

		</div>
	</div>

	<br /><br /><br />
<?php
	include ('../footer.php');
?>