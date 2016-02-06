<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Utilities</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
				Exam
 			</li>
		</ul>
	</div>


	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>
							<h3>
								<a href="ClientExam.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Exam</a>
							</h3>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li>
							<a href="clientCreateExam.php?token=<?php echo $main; ?>"style="margin-top:.2em;"><span class="glyphicon glyphicon-plus"></span> Create</a>
						</li>
					</ul>
			  	</div>
			</nav>
			<h4 class="alert-info well-lg instruction">List of Exams.</h4>
			<br />
			<form method="POST" action="#">
				<div class="form-group col-md-4">
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
					<option value="" selected>Search By Client</option>
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


				<div class="form-group col-md-4">
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
					<option value="" selected>Search By Subject</option>
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
							placeholder="Type exam code"
							maxlength="250"   
							
					/>
				</div>

				<div class="form-group col-md-2">
					<button type="submit" class="btn btn-primary btn-md btn-block">
		      			<span class="glyphicon glyphicon-search"></span>&nbsp; Search
		      		</button>
				</div>
				<br />
			</form>


			<br /><br />

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
						<td>Exam Code</td>
						<td>Subject</td>
						<td>Client Name</td>
						</tr>
					</thead>";

					while($row = mysql_fetch_array($result)) 
					{
						echo "<tr>";						
						echo "<td>" . $row['clientStartContract'] . "</td>";
						echo "<td>" . $row['clientEmailAddress'] . "</td>";
						echo "<th>" . $row['clientName'] . "</th>";
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
					$result = mysql_query("SELECT * FROM tbl_exam");
					echo"<div class='outer'>
					<div class='inner'>";
					echo "<table class='table table-responsive table-hover table-striped'>";
					echo "<thead>";
					echo "<tr class='tablehead'>
						<td>Exam  Name</td>
						
						<td>Client Name</td>
						
						</tr>
					</thead>";

					while($row = mysql_fetch_array($result)) 
					{
						echo "<tr>";						
						echo "<td>" . $row['examTitle'] . "</td>";
						
						echo "<th>" . $_POST['searchClientName'] . "</th>";
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







	
	



	

<?php
	include ('../footer.php');
?>
