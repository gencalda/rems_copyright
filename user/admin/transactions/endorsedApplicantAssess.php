<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>


	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Endorse Applicant</li>
		</ul>
	</div>


	<div class='container-fluid content'>
		<div class="container-fluid content breadcrumbs"  style="padding-top:2em;">
			<div class="form-group col-md-2">
				<h4>Decision:</h4>
			</div>
			<div class="form-group col-md-6">
			</div>
			<div class="form-group col-md-2">
				<form method="POST" action="#">
					<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="submitAddClient" 
											id="submitAddClient">
											PASS
					</button>
					</form>
			</div>
			<div class="form-group col-md-2">
				<form method="POST" action="#">
					<button type="submit" 
											class="btn btn-primary btn-md btn-block"
											name ="submitAddClient" 
											id="submitAddClient">
											FAIL
					</button>
					</form>
			</div>
		</div>
	</div>
	
	<br /><br /><br />
<?php
	include ('../footer.php');
?>