<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>


	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">	
			<br /><br /><br />
				<div class="content-fluid" >
					<h4 class="alert alert-success well-lg">
						<br /><br />
						The type of business was successfully Updated.
						<br />
						<br />
						<br />
						Click <a href="../index.php?token=<?php echo $home?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
						</h4>
				</div>
		</div>
	</div>

<br /><br /><br />

<?php
	include ('../footer.php');
?>