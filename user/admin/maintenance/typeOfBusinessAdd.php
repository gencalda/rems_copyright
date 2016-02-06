<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
	date_default_timezone_set("Asia/Manila");
	$date = date("m/d/Y");
?>


	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="../maintenance/typeOfBusiness.php?token=<?php echo $main; ?>">Type of Business</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Add New Type of Business</li>
		</ul>
	</div>

	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="typeOfBusinessAdd.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Add Type of Business</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="typeOfBusinessUpdate.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Update Type of Business</a></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a href="typeOfBusiness.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span>  Type of Business</a></li>
					</ul>
			  	</div>

			</nav>


			<h4 class="alert-info well-lg instruction">Fill up the Type of Business with correct information.
			Fields with asterisk (*) are required.</h4>
			<br /><br />
			<div class='container-fluid content'>
					<form method="POST" action="../../../config/typeOfBusinessInsert.php">
						
						<fieldset class="col-md-12">
							<legend>Add New Type of Business</legend>
							<div class="form-group col-md-12">
								<label>Type of Business: * </label>
								<input type="text" 
										class="form-control" 
										name="typeOfBusiness" 
										value='' 
										maxlength="250"   		
								/>
							</div>

					

							<div class="form-group col-md-12">
								<label>Description: </label>
								<textarea class="form-control" 
										name="typeOfBusinessDesc" 
										value="No description available"
										rows="5"
										maxlength="500" 
										id="name_appWorkReason"></textarea>
									<br /><br />
							</div>

						
						</fieldset>

							


						<div class="form-group col-md-2 col-md-offset-4">
									
							<button type="reset" 
									class="btn btn-danger btn-md btn-block"
									name ="reset" 
									tabindex="-1" 
									style="margin-top: 2em; ">
								 	Clear &nbsp;
								 <span class="glyphicon glyphicon-remove"></span>
			      			</button>
			      		
			      		</div>

			

						<div class="form-group col-md-2">
								
								<button type="submit" 
										class="btn btn-primary btn-md btn-block"
										name ="submit" 
										style="margin-top: 2em; ">
									 	Submit &nbsp;
									 <span class="glyphicon glyphicon-check"></span>
				      			</button>
				      		
				      	</div>
						
						
					</form>

			</div>
		</div>
	</div>



<br /><br /><br />



<?php
	include ('../footer.php');
?>