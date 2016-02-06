<?php
	$root = realpath(dirname(__FILE__) . '/../..');
	//include($root . '/include/link.php');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php'); // native to guest

?>
	

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li><a href="iApply.php">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
		    	iApply
		    </li>
		</ul>
	</div>

	<div style="float:left; position:fixed; z-index:3">
	<br /><br /><br /><br />
		<a href="#top" id="tops" style="text-align:center; margin-bottom:1em;" class="tooltip-right" data-tooltip="Welcome">
			<button type="button" 
				class="btn btn-default btn-md btn-block"
				style="border-radius: 0em;" >
				<span class="glyphicon glyphicon-chevron-up"></span> 
			</button>
		</a>
	<br /> <br />
		<a href="#3steps" id="btnEasy1"  style="text-align:center;" class="tooltip-right" data-tooltip="3 Easy Steps">
			<button type="button" 
				class="btn btn-default btn-md btn-block"
			
				style="border-radius: 0em;" 
				>
				<span class="glyphicon glyphicon-thumbs-up"></span> 
			</button>
		</a>
	<br /> <br />
		<a href="#apply" id="btnApply1"  style="text-align:center;" class="tooltip-right" data-tooltip="Apply">
			<button type="button" 
				class="btn btn-default btn-md btn-block"
			
				style="border-radius: 0em;" 
				>
				<span class="glyphicon glyphicon-pencil"></span>
			</button>
		</a>
		
	</div>



	<div class="container-fluid" id="iApply">	
		<div class="alert-info well-lg col-md-12" style="margin-bottom: 7em; margin-top: 3em; padding:5em; ">
			<center>
				<h3>
					Welcome to REMS iApply, with our 3 easy steps online job application will never be that easy.
				</h3>
			</center>
		</div>
		<br /><br /><br />
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

	

	<div class="container-fluid" id="onlineApplication" >
		<br /><br /><br />
		<div class="container col-md-6 col-md-offset-3" style="background-color:#f0f0f0; margin-bottom:7em;">	
			<form method="POST" action="validate.php?token=<?php echo $home;?>">
				<br />
				<h3 style="text-align:center;">Before you proceed, please make sure that you have:</h3>
				<br />
				<strong>
					<p  style="text-align:center;">* &nbsp; Type your e-mail address and select the checkbox to activate "Apply" button.</p>
				</strong>
				<br />
				<div class="container-fluid">
						<input type="email" 
								class="form-control" 
								name="name_appInfoEmail" 
								value='' 
								onchange ="validateEmail()" 
								style="height: 3em; width: 100%; font-size: 1.5em;" 
								maxlength="250" 
								placeholder="username@email.com"
								id="name_appInfoEmail" 
								required
						/>
				</div>

				<ul>
					<li>
						<br />
					</li>					
					<li>
						<input type="checkbox" 
								onchange="enableProceed()" 
								id="pic" /> &nbsp;
							
							Your colored picture taken not more than 3 months. 
							<a href="howTo.php?token=<?php echo $image?>" 
								target="_blank" 
								tabindex="-1" 
							>(.jpg, .jpeg, .png, .gif)</a>

					</li>
					<li>
						<input type="checkbox" 
								onchange="enableProceed()" 
								id="resume" /> &nbsp;
							Softcopy of your resume in Portable Document Format <a href="howTo.php?token=<?php echo $pdf?>" target="_blank" tabindex="-1" data-toggle="tooltip" title="Create PDF">(.pdf)</a>
					</li>
					<li>
						<input type="checkbox" 
								onchange="enableProceed()" 
								id="terms" /> &nbsp;
							Read the Terms of Use. <a href="howTo.php?token=<?php echo $terms?>" target="_blank" tabindex="-1" data-toggle="tooltip" title="Terms of Use">Click Here</a>
					</li>
				</ul>

				<fieldset id='apply' >
						<div class="form-group col-md-4 col-md-offset-4">
							
							<button type="submit" 
									class="btn btn-primary btn-md btn-block"
									name ="proceed" 
									id = "proceed" 
									style="margin-top: 2em;"
									disabled="true" 
									>
									<span class="glyphicon glyphicon-pencil"></span> Apply
			      			</button>
					      </div>
				</fieldset>
			</form>
		</div>
	</div>

	
<?php
	include ('footer.php');
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

    