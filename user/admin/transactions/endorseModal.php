<?php
		include ('../../../config/connection.php');


			$clientID = '';
			$basicID = '';
			$firstName = '';
			$middleName = '';
			$lastName = '';
			$clientName = '';
			$block = '';
			$street = '';
			$subdivision = '';
			$barangay = '';
			$district = '';
			$city  = '';
			$province  = '';
			$userFname  = '';
			$userMname  = '';
			$userLname  = '';
			$usernameBasicID = '';
			
		
		$con = mysql_connect("$db_hostname","$db_username","$db_password");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error()); 
		}
	//for the jobs
		mysql_select_db("$db_database", $con);
		
		$query = "SELECT * FROM tbl_applicant WHERE applicantId = $_SESSION[ses_AppID]";
		
			if ($result = $mysqli->query($query))
			{
				
				while ($obj=$result->fetch_object())
				{
					$basicID = $obj->basicId;
				}//while
			}//if 	
		
		$queryFirstChoice = mysql_query("SELECT * FROM tbl_desired_position WHERE applicantId = $_SESSION[ses_AppID] and positionRank = 'First'");
				
				$name = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId = $basicID");
				while($row = mysql_fetch_array($name)) 
				{	
					$firstName = $row['basicFirstName'];
					$middleName = $row['basicMiddleName'];
					$lastName = $row['basicLastName'];
				}

				while($row = mysql_fetch_array($queryFirstChoice)) 
				{	
					$firstJob	= $row['positionJobName']; 	
				}
		
		
	
		//$fff = $_SESSION['fname'];
		//$mmm = $_SESSION['mname'];
		//$lll = $_SESSION['lname'];
		//$user = $fff.' '.$mmm.' '.$lll;
		
?>

		

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
	  <div class="modal-content">
	      	<div class="modal-header">
	         	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	         	<h2 class="text-center">Endorse
	         		<?php 	
						echo " $firstName $middleName $lastName"; 
					?>	
				</h2>
	      	</div>

	        <div class="modal-body">	
	        	<div class="container-fluid">
		      		<form class="form center-block" target="_blank" role="form"  action="../fpdf/pdfEndorsementSlip.php" method='POST'>
		      		<!-- ../fpdf/pdfEndorsementSlip.php -->
				    	<div class="container-fluid">
							<div class="col-md-12">
								<h4 class="alert-info well-lg">
									You are about to endorse
									<?php 	
										echo " $firstName $middleName $lastName"; 
									
									echo"as a  $firstJob in $_SESSION[ses_clientName]";
									?>
							</h4>
							<br />
								<strong>
									<p style="text-align:center;">To confirm, please enter your password and click submit.</p>
								</strong>
							<br />
							</div>
						</div>
				    	<div class="form-group col-md-9">	
				    		<label> Password: *</label>
				      		<input type="password" required class="form-control input-md" name="password" placeholder="Password">
				    	</div>
				    	<div class="form-group col-md-3">
				     		<button type="submit" class="btn btn-primary btn-md btn-block" style="margin-top: 1.7em;">
				      			<span class="glyphicon glyphicon-ok"></span> Submit
				      		</button>
				    	</div>
				  	</form>
				 </div>
	      	</div>

     		<div class="modal-footer">
     			<div class="col-md-10">
     				<p style="text-align:center;">Note: When done, applicant's name will be visible to <br /> Endorsed Applicant module.</p>
     			</div>
     			<div class="col-md-2">
	        		<button type="button" class="btn btn-default" data-dismiss="modal">
	        			<span class="glyphicon glyphicon-remove"></span> Close
	        		</button>
        		</div>
      		</div>
    	</div>
		</div>
</div>

