<?php
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php'); // native to admin
	//include('../adminNotifModal.php');
?>


		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">
				<h3>Exam Verification</h3> <br />
				<h4>Please fill up the the field to take an exam.</h4>
				
				<center>
				<br /><br />
					<form method="POST" action="takeExam2.php?token=<?php echo $home;?>">
					
						
						<div class="form-group col-md-2 col-md-offset-3">
						<input type="text" 
								class="form-control" 
								name="examCode" 
								value='' 
								placeholder="Type exam code"
								maxlength="250"   
								required
								
						/>
						</div>
						
						<div class="form-group col-md-2">
						<input type="email" 
								class="form-control" 
								name="emailExaminee" 
								value='' 
								placeholder="Type your E-mail"
								maxlength="250" 
								required
								
						/>
						</div>
						
						<div class="form-group col-md-2">
							<button type="submit" class="btn btn-primary btn-md btn-block">
							<span class="glyphicon glyphicon-edit"></span>&nbsp; Submit
							</button>
						</div>
					</form>
				</center>
			</div>
		</div>
							

<?php
	include ('footer.php');
?>
