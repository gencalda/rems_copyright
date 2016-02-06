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
		<li class="active">Update Type of Business</li>
	</ul>

</div>


					
<div class="container-fluid">
	<div class="col-md-12 wrapper-background">
		<nav class="navbar nav2 nav navbar-nav">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><h3><a href="typeOfBusinessUpdate.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Update Type of Business</a></h3></li>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li><a href="typeOfBusinessAdd.php?token=<?php echo $main; ?>" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-edit"> </span> Add Type of Business</a></li>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li><a href="typeOfBusiness.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"> </span> Type of Business</a></li>
				</ul>
			</div>

		</nav>

		<h4 class="alert-info well-lg instruction">Update the Type of Business.
			Fields with asterisk (*) are required.</h4>
		<br /><br />
		<div class='container-fluid content'>
			
				<div class="form-group col-md-10">
				</div>

				<fieldset class="col-md-12">
					<legend>Update Type of Business</legend>

					<form name="formDropdown" method="GET" action="#">
						<div class="form-group col-md-10">
							<?php
								echo "<input type='hidden' name='token' value='$main' />";
								$typeID = "";
								$typeOfBusinessName = "";
								$typeOfBusinessDesc = "";
								
								$con = mysql_connect("$db_hostname","$db_username","$db_password");
								if (!$con)
								{
									die('Could not connect: ' . mysql_error());
								}
							
								mysql_select_db("$db_database", $con);
								$result = mysql_query("SELECT * FROM tbl_type_of_business ORDER BY typeOfBusinessId");
							?>
							
							<select type="typeOfBusiness" 
								class="form-control"  
								id="search_typeOfBusiness"
								name="search_typeOfBusiness"
								onChange="document.forms['formDropdown'].submit()">
								<option value="" selected>Select Type of Business</option>
								
								<?php	
					
									while ($row = mysql_fetch_array($result))
										{
											echo "<option value='" . $row['typeOfBusinessId'] . "'> " . $row['typeOfBusinessName'] . " </option>";	
										}//while
										
										
									echo "</select>"; 
								?>
						</div>

						
					</form>
					
					<?php
					if (isset($_GET['search_typeOfBusiness'])) 
					{
					
						
						$result = mysql_query("SELECT *
												FROM tbl_type_of_business
												WHERE typeOfBusinessId = $_GET[search_typeOfBusiness]");
						while($row = mysql_fetch_array($result)) 
						{
							$typeID = $row['typeOfBusinessId'];
							$typeOfBusinessName = $row['typeOfBusinessName'];
							$typeOfBusinessDesc = $row['typeOfBusinessDescription'];
						}//while
						
								
								mysql_close($con);
					}//if
					?>
					
				<form method="POST" action="../../../config/typeOfBusinessUpdate.php">	
				
				<input type="hidden" 
										class="form-control" 
										name="name_typeID" 
										value='<?php echo $typeID ?>' 
										maxlength="15"   
								/>
				
					<div class="form-group col-md-12">
						<label>Type of Business: * </label>
						<input type="text" 
								class="form-control" 
								name="typeOfBusinessName" 
								value='<?php echo $typeOfBusinessName?>' 
								maxlength="250"   		
						/>
					</div>

					<div class="form-group col-md-12">
						<label>Description: </label>
						<textarea class="form-control" 
								name="businessDescription" 
								value="No description available"
								rows="5"
								maxlength="500" 
								id="businessDescription"><?php echo $typeOfBusinessDesc?></textarea>
								<br /><br />
					</div>
				

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

<?php
	include ('../footer.php');
?>