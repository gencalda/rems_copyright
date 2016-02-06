<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include ('endorseModal.php');
	include('../adminNotifModal.php');
	$counter = 1;
	$tran = md5('transaction');
	$attempt = $_GET['attempt'];
?>

	<div class='container-fluid content'>
			<ul class="breadcrumb">
				<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li><a href="assessApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li>Confirm Endorsement</li>&nbsp;&nbsp;&nbsp;
					<ul class="pull-right">
						<li><a href="assessApplicant.php?token=<?php echo $tran; ?>"><span class='glyphicon glyphicon-arrow-left'>&nbsp;</span>Assess Applicant</a></li>
					</ul>
				</ul>
			</ul>
		</div>

	<div class="container-fluid">
	
				<div class="alert" id="login">
					<div class="alert-danger well-lg col-md-4 col-md-offset-3" style="margin-top:5em; text-align:center; padding:2em;">
						<strong> Error!</strong>&nbsp;Password incorrect. Please try again.
					</div>
				</div>

				<div class="container-fluid">
					<div class="col-md-offset-9 well well-sm" style="width:20.5em; margin-bottom:7em;">
						<h3>Confirm</h3>
						<div class="form-group">
							Enter your password to confirm.
					    </div>
						
						<form class="form center-block" role="form" action="send.php?token=<?php echo $tran; ?>" method="POST">
							<input type="hidden" name="attempt" value='<?php echo $attempt; ?>' />
					    	<div class="form-group has-feedback has-feedback-left">
							    <label class="control-label sr-only">Password</label>
							    <input type="password" 
							    		class="form-control input-lg" 
							    		placeholder="Password" 
							    		name="password"
							    		value="" 
							    		required
							    />
							    <i class="form-control-feedback glyphicon glyphicon-lock"></i>
							</div>

					    	<div class="form-group">
					     		<button type="submit" class="btn btn-primary btn-lg btn-block">
					      			<span class="glyphicon glyphicon-ok-circle"></span>&nbsp; Okay
					      		</button>
					      		<button type="reset" tabindex="-1" class="btn btn-danger btn-md btn-block">
					      			<span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Reset
					      		</button>
					    	</div>
					    	
					  	</form>
					</div>
				</div>
			</div>
	

<?php	
	include ('../footer.php');
?>