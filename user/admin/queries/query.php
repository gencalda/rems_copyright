<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	//ssinclude('adminNotifModal.php');
?>
	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Queries</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Query</li>
		</ul>
	</div>

	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
	
			<h4 class="alert-info well-lg instruction" style="margin-top:1em;">Select an entity to find query.</h4> 		
			<br /><br />

		
				<?php
				/*mysql_select_db("$db_database", $con);
								$result = mysql_query("SELECT * FROM tbl_employee  ");*/
				?>
			
				<br />
				
				<nav class="navbar nav2 nav navbar-nav">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							<li style="padding-left:17em;  margin-top:1em;">&nbsp;</li>
						</ul>
						<ul class="nav navbar-nav">
							<li><a href="querypage.php?type=emp&token=<?php echo $query; ?>" style="margin-left:5em; margin-top:.2em;"><span class="glyphicon glyphicon-user"> </span>&nbsp;&nbsp;EMPLOYEES</a></li>
						</ul>
						<ul class="nav navbar-nav">
							<li><a href="querypage.php?type=client&token=<?php echo $query; ?>" style="margin-left:5em; margin-top:.2em;"><span class="glyphicon glyphicon-envelope"> </span>&nbsp;&nbsp;CLIENTS</a></li>
						</ul>
						<ul class="nav navbar-nav">
							<li><a href="querypage.php?type=job&token=<?php echo $query; ?>" style="margin-left:5em; margin-top:.2em;"><span class="glyphicon glyphicon-briefcase"> </span>&nbsp;&nbsp;JOBS</a></li>
						</ul>
						<ul class="nav navbar-nav">
							<li><a href="querypage.php?type=app&token=<?php echo $query; ?>" style="margin-left:5em; margin-top:.2em;"><span class="glyphicon glyphicon-folder-open"> </span>&nbsp;&nbsp;APPLICANTS</a></li>
						</ul>
					</div>
				</nav>
				
		
				<br /><br /><br /><br /><br /><br />
		</div>
	</div>
			
<?php
	include ('../footer.php');
?>

