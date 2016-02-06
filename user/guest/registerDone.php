<?php
	ob_start(); 
	$root = realpath(dirname(__FILE__) . '/../..');
	//include($root . '/include/link.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php'); // native to guest
?>
	

		<div class="container-fluid" style="margin-top:5em; margin-bottom:10em;">
			<div class='alert' id='hello'>
						<div class='alert-success well-lg col-md-8 col-md-offset-2'>
							<h3 style='text-align:center;'>
								Congratulations! You've successfully registered. <br /><br />
								Please check your company email.
							</h3>
					
						</div>
				</div>
		</div>



 <?php
 	include('footer.php');
 ?> 