<?php
	$root = realpath(dirname(__FILE__) . '/../../..'); // directs the root path to r3pv7
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include($root . '/include/clientContactDetailsModal.php');
	include('../adminNotifModal.php');
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client</li>
		</ul>
	</div>

	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			
			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="client.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Browse Clients</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="clientUpdate.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update Client</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="clientAdd.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-plus"> </span> Add Client</a></li>
					</ul>
			  	</div>

			</nav>
			

			<h4 class="alert-info well-lg instruction">List of Clients.</h4> 		
			<br />
				<div class="container-fluid table-responsive content">
					<?php
						// if (isset($_POST['submit']))
						// {
						// 	$con = mysql_connect("$db_hostname","$db_username","$db_password");
						// 	if (!$con)
						// 	{
						// 		die('Could not connect: ' . mysql_error()); 
						// 	}
						// 	mysql_select_db("$db_database", $con);
							
						// 	if ($_POST['searchClient']=="All Client")
						// 	{	
						// 		$result = mysql_query("SELECT * FROM client");
						// 	}
						// 	else if($_POST['searchClientName']=="pen")
						// 	{
						// 		$result = mysql_query("SELECT * FROM client WHERE clientName LIKE '%".$_POST['searchClientName']."%'");
						// 	}
						// 	else
						// 	{
						// 		$result = mysql_query("SELECT * FROM client WHERE clientID = '".$_POST['searchClient']."'");
						// 	}
						// 	echo"<div class='outer'>
						// 	<div class='inner'>";
						// 	echo "<table class='table  table-responsive table-hover table-striped'>";
						// 	echo "<thead class='tablehead'>";
						// 	echo "<tr>
						// 		<td>Client Name</td>
								
								
						// 		<td>Email Address</td>
						// 		<td>Start of Contract</td>
						// 		<td>End of Contract</td>
						// 		</tr>
						// 	</thead>";

						// 	while($row = mysql_fetch_array($result)) 
						// 	{
						// 		echo "<tr>";
						// 		echo "<th>" . $row['clientName'] . "</th>";
								
						// 		echo "<td>" . $row['clientZip'] . "</td>";
						// 		$clientLocation = explode("/",$row['clientLocation']);
						// 		echo "<td>" . $clientLocation[0].$clientLocation[1].", ".$clientLocation[2]. "</td>";
						// 		echo "<td>" . $row['clientLandline'] . "</td>";
						// 		echo "<td>" . $row['clientEmailAddress'] . "</td>";
						// 		echo "<td>" . $row['clientStartContract'] . "</td>";
						// 		echo "<td>" . $row['clientEndContract'] . "</td>";
						// 		echo "</tr>";
								
						// 	}

						// 	echo "</table>";
						// 	echo"</div>
						// 	</div>";
						// 	mysql_close($con);
						// }
							
						// else
						// {
							$con = mysql_connect("$db_hostname","$db_username","$db_password");
							if (!$con)
							{
								die('Could not connect: ' . mysql_error()); 
							}
							mysql_select_db("$db_database", $con);
							$result = mysql_query("SELECT *
													FROM tbl_client
													LEFT JOIN tbl_contract 
													ON tbl_client.clientId = tbl_contract.clientId
													");
							echo"<div class='outer'>
							<div class='inner'>";
							echo "<table class='table table-responsive table-hover table-striped'>";
							echo "<thead>";
							echo "<tr class='tablehead'>
								<td>Client Name</td>
								
								
								<td>Email Address</td>
								<td>Start of Contract</td>
								<td>End of Contract</td>
								<td>Status</td>
								</tr>
							</thead>";
							while($row = mysql_fetch_array($result)) 
							{
								echo "<tr>";
								echo "<td>" . $row['clientName'] . "</td>";
								
								echo "<td>" . $row['clientEmail'] . "</td>";
								
								$var_start_contract_to_format=date_create($row['contractStartDate']);
								$var_start_contract_formatted=date_format($var_start_contract_to_format,'m/d/Y');
								if(is_null($row['contractStartDate'])) {
									echo "<td> none </td>";
								}
								else {
									echo "<td>" . $var_start_contract_formatted. "</td>";
								}
								
								
								$var_start_contract_to_format=date_create($row['contractEndDate']);
								$var_start_contract_formatted=date_format($var_start_contract_to_format,'m/d/Y');
								if(is_null($row['contractEndDate'])) {
									echo "<td> none </td>";
								}
								else {
									echo "<td>" . $var_start_contract_formatted. "</td>";
								}
								echo "<td>" . $var_contract_status = ($row['contractStatus']) . "</td>";
								echo "</tr>";
								
							}

							echo "</table>";
							echo"</div>
							</div>";
							mysql_close($con);
					?>
			</div>

		</div>
	</div>
<?php
	include ('../footer.php');
?>