<?php
	session_start();
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../guestNav.php'); // native to admin
	
?>

<?php
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y"); // in this format
	$day = date("N"); // N = 1 = Monday, 2 = Tuesday
	
	//echo $date;
	echo "<br />";
	
	switch ($day)
	{
		case "1": 
				"Today is Monday! ";
				"<br /> You may go";
				"From: ";
				$from =  date('m/d/Y', strtotime("+1 days"));
				"<br />";
				"To: ";
				$to =  date('m/d/Y', strtotime("+3 days"));
				break;
		case "2": 
				"Today is Tuesday!";
				"<br /> You may go ";
				"From: ";
				 $from = date('m/d/Y', strtotime("+1 days"));
				"<br />";
				"To: ";
				$to =  date('m/d/Y', strtotime("+3 days"));
				break;
				
		case "3": 
				 "Today is Wednesday!";
				 "<br /> You may go ";
				 "From: ";
				 $from =  date('m/d/Y', strtotime("+1 days"));
				 "<br />";
				 "To: ";
				 $to =  date('m/d/Y', strtotime("+5 days"));
				 "<br /> except Saturday and Sunday";
				break;
				
		case "4": 
				 "Today is Thurday!";
				 "<br /> You may go ";
				 "From: ";
				 $from =  date('m/d/Y', strtotime("+1 days"));
				 "<br />";
				 "To: ";
				 $to =  date('m/d/Y', strtotime("+5 days"));
				 "<br /> except Saturday and Sunday";
				break;
				
		case "5": 
				 "Today is Friday!";
				 "<br /> You may go  ";
				 "From: ";
				 $from =  date('m/d/Y', strtotime("+3 days"));
				 "<br />";
				 "To: ";
				 $to =  date('m/d/Y', strtotime("+5 days"));
				break;
				
		case "6": 
			 "Today is Saturday!";
			 "<br />";
			 "From: ";
			 $from =  date('m/d/Y', strtotime("+2 days"));
			 "<br />";
			 "To: ";
			 $to =  date('m/d/Y', strtotime("+4 days"));
				break;
		case "7": 
				 "Today is Sunday!";
				 "<br />";
				 "From: ";
				 $from =  date('m/d/Y', strtotime("+1 days"));
				 "<br />";
				 "To: ";
				 $to =  date('m/d/Y', strtotime("+3 days"));
				break;
		default :
				echo "Wrong date";
				break;
	}
	echo "<br />";
	$_SESSION['from1'] = $from;
	$_SESSION['to1'] = $to;
	
?>

		<style type="text/css">
			
			block
			{
				display:block; 
			}
			block.a
			{
				display:none; 
			}
		</style>
		
	<div class='container-fluid content'>
			<ul class="breadcrumb">
				<li><a href="<?php echo $index;?>index.php?token=<?php echo $home;?>">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li>Application</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
				<li class="active">Application Done</li>
			</ul>
		</div>
		

	<div class='form-group col-md-2 col-md-offset-2'  id='loading'>
		<br /><br /><br /><br /><br />
		<center>
			<img src='../../../image/loading.gif' style="margin-top:.8em;" width='200px;' height='200px;' class='img-responsive img-rounded img-thumb' />
		</center>
	</div>

		<div class='alert' id='hi'>
		<br /><br /><br /><br />
					<div class='alert-info well-lg col-md-6'>
						<h3 style='text-align:center;'>
							Thank you for applying!
						</h3>
						<h4>
							Your application form has been submitted successfully. 
							<br /><br />
							Please wait while we prepare your voucher.
							<br />
						</h4>
					</div>
			</div>
		

		<div class='alert' id='his'>
			<br />
			<div class='alert-success well-lg col-md-8 col-md-offset-2'>
				<h3 style='text-align:center;'>
					Thank you for your patience.
				</h3>
				<h4>
				
				<br /><br />
				<?php
				/*
				echo $_SESSION['gender'];
				echo $_SESSION['age'];
				echo $_SESSION['bday'];
				echo $_SESSION['Name'];
				echo $_SESSION['first'];
				echo $_SESSION['second'];
				echo $_SESSION['third'];
				echo $_SESSION['date'];
				echo $_SESSION['appID'];
				*/
				?>
				
				<form method="POST" target = "_blank" action="../../../user/admin/fpdf/pdfApplicantVoucher.php">
				<input type='hidden' name='name'  value ='<?php echo $_SESSION['Name']; ?> ' >
				<input type='hidden' name='age'  value ='<?php echo $_SESSION['age']; ?> ' >
				<input type='hidden' name='bday'  value ='<?php echo $_SESSION['bday']; ?> ' >
				<input type='hidden' name='gender'  value ='<?php echo $_SESSION['gender']; ?> ' >
				<input type='hidden' name='first'  value ='<?php  $_SESSION['first']; ?> ' >
				<input type='hidden' name='second'  value ='<?php  $_SESSION['second']; ?> ' >
				<input type='hidden' name='third'  value ='<?php $_SESSION['third']; ?> ' >
				<input type='hidden' name='app'  value ='<?php $_SESSION['appID']; ?> ' >
				<input type='hidden' name='date'  value ='<?php $_SESSION['date']; ?> ' >
				
										Click<input type="submit" 
										class="btn btn-success"
										name="submit" value="here">
									 	 to view and print your voucher
				</form>
				<br /><br />
				Click <a href="../index.php?token=<?php echo $home;?>"><button class="btn btn-primary">here</button></a> to continue browsing the site.
				<br /><br /><br />
				Just a few reminders:
				<br /><br />
				1. Print the voucher and keep it on a safe place. <br /> Don't forget to bring it on the day of your interview. <br /><br />
				2. A copy of your voucher &amp; application form has been sent to your email.
			</h4> 
			</div>	
			
		</div>

		
		
	


<div class="col-md-12"> <br /><br /><br /><br /><br />
</div>
<?php
	include('../footer.php');
?> 

