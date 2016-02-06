<?php
	ob_start();
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/link.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php'); // native to admin
	

?>


<?php
	if(!isset($tab))
	{
		$tab = $_GET['token'];
	}
?>
	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li><a href="index.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
					<?php

						if($tab == md5('home'))
						{
							echo "Home";
						}
						else if($tab == md5('about'))
						{
							echo "About";
						}
						else if($tab == md5('newsandinformation'))
						{
							echo "News and Information";
						}
						else if($tab == md5('jobopportunities'))
						{
							echo "Job Opportunities";
						}
						else if($tab == md5('contact'))
						{
							echo "Contact Us";
						}
						else
						{	
							header('Location: index.php?token='.$home.'');
						}
					?>
 			</li>
		</ul>
	</div>


	<?php
		if($tab == md5('home'))
		{
				//echo $home;
	?>

			<div class="container-fluid" id="indexHome">
				<div class="alert-success well-lg col-md-12" style="padding: 7em; margin-bottom: 3em; margin-top: 3em;">
					<center>
						<h3>
							<?php
									$con = mysql_connect("$db_hostname","$db_username","$db_password");
									if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
								
									mysql_select_db("$db_database", $con);
							$sql = mysql_query("SELECT * FROM tbl_content WHERE contentID = 1");
							while($row = mysql_fetch_array($sql)) 
									{
										echo "".$row['content_Home']."";
									}
							?>
						</h3>
					</center>

				</div>
				<div class="col-md-12 content" style="margin-bottom:3em;">
		<br />
		<div class="container-fluid well well-lg" style="margin:1.5em;">
			<div id="carousel-example-generic" class="carousel slide">
                    <!-- Indicators -->
                    <ol class="carousel-indicators hidden-xs">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <center>
                        <div class="carousel-inner">
                        	
                            <div class="item active">
                        		<div class="alert alert-info" style="padding:2em;">	
									<h3>1. Fill-up the online application form with complete information.</h3>
								</div>
                                <img class="img-responsive img-full" src="../../image/fillup.png" width="75%">
                               
                            </div>
                            <div class="item">
                            	<div class="alert alert-info" style="padding:2em;">	
									<h3>2. Review your application form before submitting.</h3>
								</div>
                                <img class="img-responsive img-full" src="../../image/review.png" width="75%">
                                
                            </div>
                            <div class="item">
                            	<div class="alert alert-info" style="padding:2em;">	
									<h3>3. Print your voucher and bring it on the date of your interview.</h3>
								</div>
                                <img class="img-responsive img-full" src="../../image/voucher.png" width="48%">
                                
                            </div>
                        </div>
                     </center>
                     
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                    </a>
            </div>
                <center>
                	<br />
                   <h2 class="brand-before">
                        <strong>iApply 3 Easy Steps</strong>
                    </h2>
                    <div class="col-md-4 col-md-offset-4">
	                    <hr class="tagline-divider">
	                    <h3>
	                        <small>By
	                            <strong>REMS</strong>
	                        </small>
	                    </h3>
	                </div>
                </center>
		</div>
		<br />
	</div>
				<br /><br /><br />
		
			</div>



	<?php
		}
		else if($tab == md5('about'))
		{
	?>

			<div class="container-fluid" id="indexAbout">
				
				<div class="well well-lg col-md-12" style="margin-bottom: 8em; margin-top: 3em;">
					<center>
						<h3>
							<?php
									$con = mysql_connect("$db_hostname","$db_username","$db_password");
									if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
								
									mysql_select_db("$db_database", $con);
							$sql = mysql_query("SELECT * FROM tbl_content WHERE contentID = 1");
							while($row = mysql_fetch_array($sql)) 
									{
										echo "".$row['content_About']."";
									}
							?>
						<h3>
					</center>
				</div>
				<br /><br /><br />
		
			</div>	

	<?php
		}
		else if($tab == md5('newsandinformation'))
		{
	?>	

			<div class="container-fluid" id="indexNews">
				
				<div class="well well-lg col-md-12" style="margin-bottom: 8em; margin-top: 3em;">
					<center>
						<h3>
						<?php
										$con = mysql_connect("$db_hostname","$db_username","$db_password");
										if (!$con)
											{
												die('Could not connect: ' . mysql_error());
											}
									
										mysql_select_db("$db_database", $con);
								$sql = mysql_query("SELECT * FROM tbl_content WHERE contentID = 1");
								while($row = mysql_fetch_array($sql)) 
										{
											echo "".$row['content_News']."";
										}
								?>
							<h3>
					</center>
					
				</div>
				
				<br /><br /><br />
			</div>	


	<?php
		}
		else if($tab == md5('jobopportunities'))
		{
	?>


			<div class="container-fluid" id="indexJob">
				
				<div class="well well-lg col-md-12" style="margin-bottom: 8em; margin-top: 3em;">
					<h3> 
						<?php
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
									if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
								
									mysql_select_db("$db_database", $con);
							$sql = mysql_query("SELECT DISTINCT * FROM tbl_job_posting");
							while($row = mysql_fetch_array($sql)) 
									{
										echo "".$row['jobName']."";	
									}
						?>
					</h3>
				</div>
				
				<br /><br /><br />
			</div>	

	<?php
		}
		else if($tab == md5('contact'))
		{
	?>


			<div class="container-fluid" id="indexContact">
				
				<div class="well well-lg col-md-12" style="margin-bottom: 8em; margin-top: 3em;">
					<h3>
					<?php
									$con = mysql_connect("$db_hostname","$db_username","$db_password");
									if (!$con)
										{
											die('Could not connect: ' . mysql_error());
										}
								
									mysql_select_db("$db_database", $con);
							$sql = mysql_query("SELECT * FROM tbl_content WHERE contentID = 1");
							while($row = mysql_fetch_array($sql)) 
									{
										echo "".$row['content_ContactUs']."";
									}
					?>
					</h3>
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
 
 
 	
				//update tbl contract  - expired
				$mysqli->query("UPDATE tbl_contract SET 
					contractStatus = 'expired'
				
				WHERE DATE(`contractEndDate`) = DATE(NOW())");

				
					//update tbl contract  - start ng renewed
				$mysqli->query("UPDATE tbl_contract SET 
					contractStatus = 'on-going'
				
				WHERE DATE(`contractStartDate`) = DATE(NOW())");
			
 
 
 	include('footer.php');
 ?> 
 
 
 <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })

    </script>
