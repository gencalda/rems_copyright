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
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Type of Business</li>
			
		</ul>

	</div>

	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="typeOfBusiness.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Type of Business</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="typeOfBusinessUpdate.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update Type of Business</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="typeOfBusinessAdd.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-plus"> </span> Add Type of Business</a></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">List of Type of Business</h4>
			<br />				
	<?php
	
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error()); 
					}
					
					mysql_select_db("$db_database", $con);
					
	$result = mysql_query("SELECT *
											FROM tbl_type_of_business ORDER BY typeOfBusinessName
										");
	
	?>

			<div class="container-fluid table-responsive content">
				<table class='table  table-responsive table-hover table-striped'>
					<thead class='tablehead'>
						<tr>
							<td>Type of Business</td>
							<td>Description</td>						
						</tr>
					</thead>
					
					<?php
					while($row = mysql_fetch_array($result)) 
					{
						echo "<tr>";
						echo "<td>".$row['typeOfBusinessName']."</td>";
						echo "<td>".$row['typeOfBusinessDescription']."</td>";
						echo "<tr>";
					}//while
					
					?>
				</table>
			</div>
		</div>
	</div>

<?php
	include ('../footer.php');
?>