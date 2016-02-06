<?php
	ob_start();
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/link.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php');
	
	$home = md5('home');
	
	if(!isset($_GET['token']))
	{
		$tab = "";
	}
	else if ($_GET['token'] == md5('register'))
	{
		$tab = $_GET['token'];
	}
	else
	{
		header('Location: index.php?token=<?php echo $home;?>');
	}
	
//echo $actual_link = strrchr(strtok($_SERVER["REQUEST_URI"],'?'),'/') ;
	
?>





		
		
			<div class="container-fluid">
				<div class="container-fluid">
					<div class="col-md-6 col-md-offset-3 well well-lg" style="margin-bottom:7em; margin-top:3em;">
						<h3>Register</h3>
						<br />
						<form class="form center-block" role="form" action="validateClient.php?token=<?php echo $reg;?>" method="POST">
							<div class="form-group has-feedback has-feedback-left">
							    <label class="control-label sr-only">Company Name: *</label>
							    <input type="text" 
							    		class="form-control input-lg" 
							    		placeholder="Company Name: *" 
							    		name="companyName"
							    		value="" 
							    		required
							    />
							    <i class="form-control-feedback glyphicon glyphicon-briefcase"></i>
							</div>
					    	<div class="form-group has-feedback has-feedback-left">
							    <label class="control-label sr-only">Email</label>
							    <input type="email" 
							    		class="form-control input-lg" 
							    		placeholder="Company Email: *" 
							    		name="companyEmail"
							    		value="" 
							    		required
							    />
							    <i class="form-control-feedback glyphicon glyphicon-envelope"></i>
							</div>

							<div class="form-group has-feedback">
							    <label class="control-label sr-only">Settings</label>
							    <select class="form-control hidden input-lg">
							    	<option selected>I am a . . .</option>
									<option value="1">Recruitment Agency</option>
									<option value="2">Partner Client</option>
								</select>
								<br />
							</div>


					    	<div class="form-group">
					    		<div class="col-md-6 col-md-offset-3">
						     		<button type="submit" class="btn btn-primary btn-lg btn-block">
						      			<span class="glyphicon glyphicon-ok-circle"></span>&nbsp; Register
						      		</button>
						      		<br />
						      	</div>
						      	<div class="col-md-6 col-md-offset-3">
						      		<button type="reset" tabindex="-1" class="btn btn-danger btn-lg btn-block">
						      			<span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Reset
						      		</button>
						      	</div>
					    	</div>
					  	</form>
					</div>
				</div>
			</div>
	
	
		
 <?php
 	include('footer.php');
 ?> 