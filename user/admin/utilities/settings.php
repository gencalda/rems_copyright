<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Utilities</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
				Settings
 			</li>
		</ul>
	</div>





		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">

				<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>
							<h3>
								<a href="createExam.php?token=<?php echo $util; ?>" style="margin-left:.5em;">Settings</a>
							</h3>
						</li>
					</ul>
			  	</div>
			</nav>

				<h4 class="alert-info well-lg instruction">Set and update system settings.</h4>
				<br /><br />
				<form method="POST" action="../../../config/updateSystemContent.php" enctype="multipart/form-data">
				
					<div class="col-md-12">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
							<li><a data-toggle="tab" href="#menu1">About</a></li>
							<li><a data-toggle="tab" href="#menu2">News &amp; Information</a></li>
							<li><a data-toggle="tab" href="#menu3">Contact Us</a></li>	
							<li><a data-toggle="tab" href="#menu4">Agency</a></li>	
						</ul>
					</div>

					<div class="tab-content">
						<br /><br /><br />
						<div id="home" class="container tab-pane fade in active">
							<h3>HOME</h3>
							<div class="col-md-12">
								<br />
								<label>Set Welcome message:</label>
								<textarea class="form-control" name="home" value=""
											rows="5"></textarea>
							</div>
							
							<div class="col-md-5"><br /><br /><br /></div>
							<div class="col-md-2">
								<button type="submit" 
									class="btn btn-primary btn-lg btn-block"
									name ="submithome" 
									style="margin-top: 2em; ">
									Submit &nbsp;
								 <span class="glyphicon glyphicon-check"></span>
								 </button>
							</div>
						  </div>
						  
						  
						  
						  
						  <div id="menu1" class="container tab-pane fade">
							<div class="form-group col-md-8">
								<label>About </label>
								<textarea class="form-control" name="about" value=""
											rows="5" placeholder="About"></textarea>
							</div>
							<div class="col-md-5"><br /><br /><br /></div>
							<div class="col-md-2">
								<button type="submitabout" 
									class="btn btn-primary btn-lg btn-block"
									name ="submitabout" 
									style="margin-top: 2em; ">
									Submit &nbsp;
								 <span class="glyphicon glyphicon-check"></span>
								 </button>
							</div>
						  </div>
						  
						  
						  <div id="menu2" class="container tab-pane fade">
							<label>News & Information </label>
								<textarea class="form-control" name="news" value=""
											rows="5" placeholder="input news here"></textarea>
											
											
								<div class="col-md-5"><br /><br /><br /></div>
							<div class="col-md-2">
								<button type="submitabout" 
									class="btn btn-primary btn-lg btn-block"
									name ="submitnews" 
									style="margin-top: 2em; ">
									Submit &nbsp;
								 <span class="glyphicon glyphicon-check"></span>
								 </button>
							</div>
						  </div>
						  
						  
						   <div id="menu3" class="container tab-pane fade">
							<label>Contact Us </label>
								<textarea class="form-control" name="contact" value=""
											rows="5" placeholder="contact "></textarea>
							
								<div class="col-md-5"><br /><br /><br /></div>
							<div class="col-md-2">
								<button type="submitabout" 
									class="btn btn-primary btn-lg btn-block"
									name ="submitcontact" 
									style="margin-top: 2em; ">
									Submit &nbsp;
								 <span class="glyphicon glyphicon-check"></span>
								 </button>
							</div>
							
						  </div>
						  
						   <div id="menu4" class="container tab-pane fade">
							<label>Agency Name</label>
								<textarea class="form-control" name="agencyName" value=""
											rows="5" placeholder="Agency Name"></textarea>
							
								<br>
								<label>Agency Address</label>
								<textarea class="form-control" name="agencyAddress" value=""
											rows="5" placeholder="Agency Address "></textarea>
								<br>
								
								<label>Agency Name on PDF</label>
								<textarea class="form-control" name="pdfagencyName" value=""
											rows="5" placeholder="Agency in PDF "></textarea>
							<div class="col-md-2">
								<button type="submitabout" 
									class="btn btn-primary btn-lg btn-block"
									name ="submitagency" 
									style="margin-top: 2em; ">
									Submit &nbsp;
								 <span class="glyphicon glyphicon-check"></span>
								 </button>
							</div>
							
						  </div>

						  <br />
						  					</div>
							


	     	</form>
	     </div>	
			
			

			

		</div>
	</div>







	
	



	

<?php
	include ('../footer.php');
?>
