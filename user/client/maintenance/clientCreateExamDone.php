<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>


<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
		</div>
</div>



<?php
	include ('../footer.php');
?>
