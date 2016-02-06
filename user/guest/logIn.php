<?php
	ob_start();
	/*include('guestLink.php');
	include ('../../config/connection.php');
	include ('../../include/header.php');*/
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/link.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php');
	$home = md5('home');
	$sent = md5('linksent');
	
	$counter = 1;
	if(!isset($tab))
	{
		$tab = $_GET['action'];
	}
	else
	{
		header('Location: index.php?token=<?php echo $home;?>');
	}
?>


		
		<!--	<nav class="navbar nav2">
				<div class="col-md-2 pull-right" style="background-color: #f0f0f0; width: auto; margin-right:3.25em; padding-left:1em; padding-right:1em;">
					<ul class="nav navbar-nav">
						<li>
							<a href="index.php?tab=home" id="btnHome"><span class="glyphicon glyphicon-home"></span> Home</a>
						</li>
					</ul>
					<ul class="nav navbar-nav">
						<li>
							<a href="logIn.php?action=login" id="btnLog"><span class="glyphicon glyphicon-log-in"> </span> Log In</a>
						</li>
					</ul>
			  	</div>
			</nav> -->
			

	<?php
		if($tab == md5('login'))
		{
	?>
			<div class="container-fluid">
				<div class="alert" id="login">
					<div class="alert-info well-lg col-md-4 col-md-offset-3" style="margin-top:5em; padding:2em;">
					    <strong>Login</strong>&nbsp;&nbsp;Please enter your username and password to log in.
				    </div>
				</div>

				<div class="container-fluid">
					<div class="col-md-offset-9 well well-sm" style="width:20.5em; margin-bottom:7em;">
						<h3>Log In</h3>
						<form class="form center-block" role="form" action="../../config/verifyLogin.php" method="POST">
							<input type="hidden" name="attempt" value='<?php echo $counter; ?>' />
							<div class="form-group has-feedback has-feedback-left">
							    <label class="control-label sr-only">Username</label>
							    <input type="text" 
							    		class="form-control input-lg" 
							    		placeholder="Username" 
							    		name="username"
							    		value="" 
							    		autofocus
							    		required
							    />
							    <i class="form-control-feedback glyphicon glyphicon-user"></i>
							</div>
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
					      			<span class="glyphicon glyphicon-ok-circle"></span>&nbsp; Log In
					      		</button>
					      		<button type="reset" tabindex="-1" class="btn btn-danger btn-md btn-block">
					      			<span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Reset
					      		</button>
					    	</div>
					    	<div class="form-group">
					      		Forgot password? <a href="logIn.php?action=<?php echo $forgot;?>&attempt=0&token=<?php echo $home;?>">Click here</a>
					    	</div>
					  	</form>
					</div>
				</div>
			</div>
	
	<?php
		}
		else if($tab == md5('forgotpassword'))
		{	
			if(!isset($attempt))
			{ 
				$attempt = $_GET['attempt'];		
				if($attempt >= '3')
				{
	?>

					<div class="alert" id="attempt3">
						<div class="alert-danger well-lg col-md-4 col-md-offset-4" style="padding:2em;  text-align:center;">
						    <strong>Login Error!</strong>&nbsp;3 failed attempts. You must have forgotten your password!
					    </div>
					</div>

	<?php
				}
			}
	?>

			<div class="col-md-6 col-md-offset-3" style="background-color: #f0f0f0; margin-bottom:21em; margin-top:5em; ">
				<div class="container-fluid" id="forgotPassword">
				<form class="form center-block" role="form" action="logIn.php?action=<?php echo $sent;?>&token=<?php echo $home;?>" method="POST">
					
						<div class="container-fluid"  style="text-align:center;">
							<h3>Forgot Password?</h3>
							<p>Enter your email so we could help you recover your account.</p>
							
						
							<div class="form-group has-feedback has-feedback-left">
							    <label class="control-label sr-only">emailForgot</label>
							    <input type="email" 
							    		class="form-control input-lg" 
							    		placeholder="username@email.com" 
							    		style="height: 3em; font-size: 1.5em;" 
							    		name="forgotemail"
							    		id="forgot" 
							    		onchange="forgotpassword()" 
							    		autofocus
							    		required
							    />
							    <i class="form-control-feedback glyphicon glyphicon-user" 
							    	style="font-size:1.5em; padding-top: .4em;"></i>
							</div>
							
					    	
					  	
						</div>
						<div class="form-group col-md-6 col-md-offset-3" id="send">
							
							<button type="submit" 
									class="btn btn-primary btn-md btn-block"
									name ="sendLink" 
									id = "sendLink" 
									style="margin-top: 2em;"
									disabled="true" 
									>
									<span class="glyphicon glyphicon-send"></span>&nbsp; Send
			      			</button>
							      	
						</div>
					
				</form>
				</div>
			</div>
	<?php
		}
		else if($tab == md5('linksent'))
		{
	?>	

			<div class="container-fluid" style="margin-top:8em; margin-bottom:0em;">
				<div class='form-group col-md-2 col-md-offset-2'  id='loadingEmail' style="margin-top:1.5em;">
					<center>
						<img src='../../image/loading.gif' width='200px;' height='200px;' class='img-responsive img-rounded img-thumb' />
					</center>
				</div>


				<div class="alert" id='emailChecking'>
						<div class="alert-info well-lg col-md-6">
							<center>
								<strong><h3>
									Gathering some information!
								</h3></strong>
							</center>
							<h4>
								<br />
								Please wait, we're already working on it.
							</h4>
					
						</div>
				</div>
			</div>



		<?php
			
				$checkEmail = $_POST['forgotemail'];
				$email = mysql_real_escape_string($checkEmail);
				
			
				$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
					{
						die('Could not connect: ' . mysql_error());
					}
													
				mysql_select_db("$db_database", $con);
				  
				$result = mysql_query("SELECT * FROM tbl_client WHERE clientEmail = '$email'");  							
			
			// check in database if this email exist
			if(mysql_num_rows($result) != NULL) 
			{
				while($row = mysql_fetch_array($result)) 
					{
						$CID = $row['clientId'];
						
					}
				$pw1 = substr(str_shuffle(str_repeat(strtoupper("abcdefghijklmnopqrstuvwxyz"), 5)), 0, 2);
				$pw2 = substr(str_shuffle(str_repeat(strtoupper("abcdefghijklmnopqrstuvwxyz"), 5)), 0, 2);
				$pwN = rand(10, 99);
				$pwn = rand(10, 99);
				$randomPW = "$pw1"."$pwN"."$pw2"."$pwn"; 
				
				$sql = ("UPDATE tbl_user_account
				SET accountPassword  = '$randomPW'	WHERE clientId = $CID");

				if ($mysqli->query($sql) === TRUE) 
				{
					//echo "New record created successfully";
				}
				else 
				{
					echo "Error: " . $sql . "<br>" . $mysqli->error;
				}
				
				//error_reporting(E_ALL);
				error_reporting(E_STRICT);

				date_default_timezone_set('Asia/Manila');

				require_once('class.phpmailer.php');
				include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

				$mail             = new PHPMailer();

				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
														   // 1 = errors and messages
														   // 2 = messages only
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.mail.yahoo.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->IsHTML(true);
				$mail->Username   = "rems.recruitment@yahoo.com";  
				$mail->Password   = "r3pr3cruitm3nt;";            

				$mail->SetFrom("rems.recruitment@yahoo.com");

				$mail->Subject    = "Forgot Password";

				$mail->Body = "You received this message because you forgot your password, here is your temporary password: $randomPW";


				$mail->AddAddress($email);
				if(!$mail->Send()) {
				  //echo "Mailer Error: " . $mail->ErrorInfo;
		?>
				<div class="container-fluid" style="margin-top:0em; margin-bottom:15em;">
					<div class="alert" id='emailConfirmed'>
						<div class="alert-danger well-lg col-md-8 col-md-offset-2">
							<center>
								<strong><h3>
									Oops! Operation failed.
								</h3></strong>
							</center>
							<br />
								<h4>
									It seems like you're not registed.
									Your email address couldn't be found in our database. <br />
									<a href="howTo.php?tab=operationfailed" 
										target="_blank" 
										style="text-decoration:underline;
												color:#333333;">Click here</a>&nbsp; to find out why.
								</h4>
					
						</div>
					</div>
				</div>
		<?php
				} else {
				  //echo "Message sent! Please check your inbox!";
				}
			

				
		?>

			<div class="container-fluid" style="margin-top:0em; margin-bottom:15em;">
				<div class="alert" id='emailConfirmed'>
					<div class="alert-success well-lg col-md-8 col-md-offset-2">
						<center>
							<strong><h3>
							Success! Check your inbox to know how you'll recover your account.
							
							</h3></strong>
						</center>
						<br />
							<h4>
								Please check your email address. <a href="logIn.php?action=<?php echo $log; ?>&token=<?php echo $home; ?>" 
									style="text-decoration: underline;">Click here</a> 
								to log in.
						</h4>
				
					</div>
				</div>
			</div>

		<?php
			}
			else
			{
		?>

			<div class="container-fluid" style="margin-top:0em; margin-bottom:15em;">
				<div class="alert" id='emailConfirmed'>
					<div class="alert-danger well-lg col-md-8 col-md-offset-2">
						<center>
							<strong><h3>
								Oops! Operation failed.
							</h3></strong>
						</center>
						<br />
							<h4>
								It seems like you're not registed.
								Your email address couldn't be found in our database. <br />
								<a href="howTo.php?tab=operationfailed" 
									target="_blank" 
									style="text-decoration:underline;
											color:#333333;">Click here</a>&nbsp; to find out why.
							</h4>
				
					</div>
				</div>
			</div>
				
		<?php
			}
		?>


	<?php
		}
		else if($tab == md5('error'))
		{
			$attempt = $_GET['attempt'];
			{
				$counter = $attempt + 1;
				if($attempt == 3)
				{
					$forgot = md5('forgotpassword');
					//header('Location: logIn.php?action='.$forgot.'&attempt=3');
					header('Location: logIn.php?action='.$forgot.'&attempt=3&token='.$home.'');
					
				}
			}
	?>

		<div class="alert" id="loginError">
			<div class="alert-danger well-lg col-md-4 col-md-offset-3" style="margin-top:5em;">
			    <strong>Login Error!</strong>&nbsp;&nbsp;Invalid username and/or password. Try again.
		    </div>
		</div>

		<div class="container-fluid">
				
				<div class="col-md-offset-9 well well-sm" style="width:20.5em; margin-bottom:7em;">
					<h3>Log In</h3>
					<form class="form center-block" role="form" action="../../config/verifyLogin.php" method="POST">
						<input type="hidden" name="attempt" value='<?php echo $counter; ?>' />
						<div class="form-group has-feedback has-feedback-left">
						    <label class="control-label sr-only">Username</label>
						    <input type="text" 
						    		class="form-control input-lg" 
						    		placeholder="Username" 
						    		name="username"
						    		autofocus
						    		value=""
						    		required 
						    />
						    <i class="form-control-feedback glyphicon glyphicon-user"></i>
						</div>
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
				      			<span class="glyphicon glyphicon-ok-circle"></span>&nbsp; Log In
				      		</button>
				      		<button type="reset" tabindex="-1" class="btn btn-danger btn-md btn-block">
				      			<span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Reset
				      		</button>
				    	</div>
				    	<div class="form-group">
				      		Forgot password? <a href="logIn.php?action=<?php echo $forgot;?>&attempt=0&token=<?php echo $home;?>">Click here</a>

				    	</div>
				  	</form>

				</div>
			</div>
	<?php
		}
		else if($tab == md5('logout'))
		{
	?>	

			<div class="alert" id="logout">
					<div class="alert-success well-lg col-md-4 col-md-offset-3" style="margin-top:5em;">
					    <center>
					    <strong>Success!</strong>&nbsp;&nbsp;Your account has been logged out. 
					    </center>
				    </div>
				</div>

				<div class="container-fluid">
					<div class="col-md-offset-9 well well-sm" style="width:20.5em; margin-bottom:7em;">
						<h3>Log In</h3>
						<form class="form center-block" role="form" action="../../config/verifyLogin.php" method="POST">
							<input type="hidden" name="attempt" value='<?php echo $counter; ?>' />
							<div class="form-group has-feedback has-feedback-left">
							    <label class="control-label sr-only">Username</label>
							    <input type="text" 
							    		class="form-control input-lg" 
							    		placeholder="Username" 
							    		name="username"
							    		autofocus
							    		value=""
						    			required
							    />
							    <i class="form-control-feedback glyphicon glyphicon-user"></i>
							</div>
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
					      			<span class="glyphicon glyphicon-ok-circle"></span>&nbsp; Log In
					      		</button>
					      		<button type="reset" tabindex="-1" class="btn btn-danger btn-md btn-block">
					      			<span class="glyphicon glyphicon-remove-circle"></span>&nbsp; Reset
					      		</button>
					    	</div>
					    	<div class="form-group">
					      		Forgot password? <a href="logIn.php?action=<?php echo $forgot;?>&attempt=0&token=<?php echo $home;?>">Click here</a>
					    	</div>
					  	</form>

					</div>
				</div>
				



	<?php
		}
		else
		{
			header('Location: index.php?token='.$home.'');
		}
	?>
		
 <?php
 	include('footer.php');
 ?> 