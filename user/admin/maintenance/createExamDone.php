<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>


<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
		</div>
</div>



<?php
	include ('../footer.php');
?>
