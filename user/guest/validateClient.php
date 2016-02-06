<?php
	ob_start(); // para sa warning na cannont modify header...
	/*include('guestLink.php');
	include ('../../include/header.php');
	include ('guestNav.php');
	include ('../../config/connection.php');
	*/
	$root = realpath(dirname(__FILE__) . '/../..');
	//include($root . '/include/link.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php'); // native to guest
?>
	
	
	<?php

	$apply = md5('apply');						
	$checkEmail = $_POST['companyEmail'];
	$email = mysql_real_escape_string($checkEmail);
	$companyName = mysql_real_escape_string($_POST['companyName']);
	
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
									{
										die('Could not connect: ' . mysql_error());
									}
																	
								mysql_select_db("$db_database", $con);
								
								$sql = "SELECT *
								FROM tbl_client
								WHERE clientEmail = '$email'";   
								$result = mysql_query($sql) or die(mysql_error() . "<br/>$sql");  							
	
	// check in database if this email exist
	if(mysql_num_rows($result) == 0) 
	{

?>
		<div class="container-fluid" style="margin-top:3em; margin-bottom:0em;">
			<div class='form-group col-md-2 col-md-offset-2'  id='loading' style="margin-top:1.5em;">
				<center>
					<img src='../../image/loading.gif' width='200px;' height='200px;' class='img-responsive img-rounded img-thumb' />
				</center>
				</div>

			<div class='alert' id='hi'>
				<div class='alert-info well-lg col-md-6'>
					<h3 style='text-align:center;'>
					 <?php echo "Hi $email!"; ?>
					</h3>
					<h4>
						<br />
						Please wait while we prepare your registration form.
					</h4>
				</div>
			</div>
		</div>


		<div class="container-fluid" style="margin-top:0em; margin-bottom:15em;">
			<div class='alert' id='his'>
						<div class='alert-success well-lg col-md-8 col-md-offset-2'>
							<h3 style='text-align:center;'>
								Success! Your registration form is ready click Proceed
							</h3>
					
					
					<form method='POST' action='registerInfo.php?token=<?php echo $reg;?>'>
						<div class='form-group col-md-2 col-md-offset-5'>
						
							<?php echo "<input type='hidden' name='companyName' value='$companyName' />"; ?>
							<?php echo "<input type='hidden' name='companyEmail' value='$email' />"; ?>
							<button type='submit' 
									class='btn btn-success btn-md btn-block'
									style='margin-top: 2em;'
									>
									<span class='glyphicon glyphicon-check'></span> Proceed
			      			</button>
		  		
				     	</div>
			      	</form>
						</div>
				</div>
		</div>

<?php	
	}
	else
	{
?>
		<div class="container-fluid" style="margin-top:3em; margin-bottom:15em;">
			<div class="alert" id="thankYou">
					<div class='alert-info well-lg col-md-8 col-md-offset-2'>
					<h2 style='text-align:center;'>
					Thank your for your interest!
				</h2>
				<h4>
					<br />
					We have detected that you have already submitted your application form. <br />
					A link to update your application form has been sent to <br /><br />
					<?php echo "<a style='font-size:1.5em;' href=updateAppForm?email=$email>$email</a> <br /><br />"; ?>
					Please check your email address. <br />
				</h4>
					</div>
			</div>
		</div>


		
<?php
	}
		
?>


		<div class="container-fluid" style="margin-top:0em; margin-bottom:15em;">
			<div class='alert' id='his'>
						<div class='alert-success well-lg col-md-8 col-md-offset-2'>
							<h3 style='text-align:center;'>
								Congratulations! You've successfully registered. <br /><br />
								Please check your company email for the username and password
							</h3>
					
					
					<form method='POST' action='logIn.php?action=<?php echo $log;?>&token=<?php echo $log;?>'>
						<div class='form-group col-md-2 col-md-offset-5'>
						
							<?php echo "<input type='hidden' name='companyName' value='$companyName' />"; ?>
							<?php echo "<input type='hidden' name='companyEmail' value='$email' />"; ?>
							<button type='submit' 
									class='btn btn-success btn-md btn-block'
									style='margin-top: 2em;'
									>
									<span class='glyphicon glyphicon-log-in'></span>&nbsp;Log in
			      			</button>
		  		
				     	</div>
			      	</form>
						</div>
				</div>
		</div>



 <?php
 	include('footer.php');
 ?> 