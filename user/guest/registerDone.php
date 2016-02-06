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
	
	
	


		<div class="container-fluid" style="margin-top:0em; margin-bottom:15em;">
			<div class='alert' id='hi'>
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