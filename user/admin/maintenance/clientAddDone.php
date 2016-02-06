<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>

	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="client.php?token=<?php echo $main; ?>">Client</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="clientA.php?token=<?php echo $main; ?>">Add Client</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="clientContact.php?token=<?php echo $main; ?>">Client Contact Person</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Done</li>
		</ul>

	</div>


	<br /><br /><br />

	<div class='form-group col-md-2 col-md-offset-2'  id='loading'>
		<center>
			<img src='../../../image/loading.gif' style="margin-top:2em;" width='200px;' height='200px;' class='img-responsive img-rounded img-thumb' />
		</center>
	</div>

		<div class='alert' id='hi'>
					<div class='alert-info well-lg col-md-6'>
						<h3 style='text-align:center;'>
							Congratulations!
						</h3>
						<h4>
							Please wait while we add the new client to the databasee. 
							<br /><br />
						</h4>
					</div>
			</div>
		

		<div class='alert' id='his'>
			<div class='alert-success well-lg col-md-8 col-md-offset-2'>
				<h3 style='text-align:center;'>
					Thank you for your patience.
				</h3>
				<h4>
					<br />
					Click <a href="../index.php?tab=index"><button class="btn btn-success">here</button></a> to continue browsing the site.
				</h4> 


			</div>		
		</div>

<div class="col-md-12"> <br /><br /><br /><br /><br /><br /><br /><br />
</div>


<?php
	include('../footer.php');
?> 

