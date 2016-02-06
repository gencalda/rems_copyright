<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>

<script type="text/javascript">			
	$(document).ready(function () {
		var start1 = $('#start1');      
		var end1 = $('#end1');       

		start1.datepicker({ onClose: clearEndDate });      
		end1.datepicker({ beforeShow: setMinDateForEndDate });       

		function setMinDateForEndDate() {          
			var d = start1.datepicker('getDate');          
			if (d) return { minDate: d }      
		}      
		function clearEndDate(dateText, inst) {          
			end1.val('');      
		}  
	});
</script>

	<div class='container-fluid content'><ul class="breadcrumb">
			<li>Reports</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Client Report</li>
		</ul>
	</div>
	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="clientReports.php?token=<?php echo $util; ?>" style="margin-left:.5em;">Client Reports</a></h3></li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li><a target="_blank" href="../fpdf/pdfClientReports.php" style="margin-left:2.5em; margin-top:.2em;"><span class="glyphicon glyphicon-print"> </span>&nbsp; Print Report</a></li>
					</ul>
				</div>
			</nav>
	
			<h4 class="alert-info well-lg instruction">Client Report </h4> 		
			<br />
	
			<form name="calz" method="post">
				<div class="form-group col-md-2 col-md-offset-6">
					Start Date: <input class="col-md-2 form-control" id="start1" name="start1" type="text" size="10"> 
				</div>
				<div class="form-group col-md-2">
					End Date: <input class="col-md-2 form-control" id="end1" name="end1" type="text" size="10">
				</div>
				<div class="form-group col-md-1">
					<input class="btn btn-primary" id="button" type="submit" style="margin-top: 1.3em;" value="Generate">
				</div>
			</form>
			<form name="calz" method="post">
				<div class="form-group col-md-1">
					<input class="btn btn-success" name = "submitall" id="buttonall" type="submit" style="margin-top: 1.3em;" value="View All">
				</div>
			</form>
			
			
	
			  <?php
					if(isset($_POST['start1']) && isset($_POST['end1'])){
				$start = (isset($_POST['start1'])) ? date("Y-m-d",strtotime($_POST['start1'])) : date("Y-m-d");
				$end   = (isset($_POST['end1'])) ? date("Y-m-d",strtotime($_POST['end1'])) : date("Y-m-d");
				$con = mysql_connect("$db_hostname","$db_username","$db_password");
				
				$_SESSION['start1'] = $start;
				$_SESSION['end1'] = $end;
				
				
				
				if (!$con)  { 
					   die('Could not connect: ' . mysql_error()); 
				 } 
				mysql_select_db("remsdb", $con); 
							 
				$sql = "SELECT * FROM tbl_contract a, tbl_client b , tbl_contact_info c, tbl_basic_info d
				WHERE a.clientId = b.clientId  and b.clientId = c.clientId and b.clientId = d.basicId and
				contractStartDate >= '$start' AND contractEndDate <= '$end' GROUP BY clientName ORDER BY contractStartDate";
				
				echo "Client Records From $start To $end Contract";
				echo "<table class='table table-hover'> 
					  <tr> 
					
					<th>Client Name</th> 
					<th>Email Address</th> 
					<th>Contact Number</th> 
					<th>Start of Contract</th> 
					<th>End of Contract</th> 
					<th>Status</th> 
					</tr>"; 
							 
				$res = mysql_query($sql) or die(__LINE__.' '.$sql.' '.mysql_error());
				while($row = mysql_fetch_array($res)){
							 
					echo "<tr>"; 
					 
					 echo "<td>" . $row['clientName'] . "</td>"; 
					 echo "<td>" . $row['clientEmail'] . "</td>"; 
					 echo "<td>" . $row['contactNumber'] . "</td>"; 

					  //echo "<td>" . $row['addBlock'] . ", " . $row['addStreet'] . " " . $row['addSubdivision'] . " " . $row['addBarangay'] . " " . $row['addDistrict'] . " " . $row['addCity'] . $row['addProvince'] . "</td>";
					 echo "<td>" . $row['contractStartDate'] . "</td>"; 
					echo "<td>" . $row['contractEndDate'] . "</td>"; 
					 echo "<td>" . $row['contractStatus'] . "</td>"; 
					 echo "</tr>"; 
				 } 
				echo "</table>"; 
							 
				mysql_close($con); 
						
				   }
				   
				   
			if(isset($_POST['submitall']))
			{
			
				$con = mysql_connect("$db_hostname","$db_username","$db_password");
			
				if (!$con) 
				{ 
					die('Could not connect: ' . mysql_error()); 
				}	 
				mysql_select_db("remsdb", $con); 
				
				$sql = "SELECT * FROM tbl_contract a , tbl_client b , tbl_contact_info c, tbl_basic_info d
						WHERE a.clientId = b.clientId  and b.clientId = c.clientId and b.clientId = d.basicId
						GROUP BY clientName
						ORDER BY contractStartDate";
				
				echo "List of all Clients";
					echo "<table class='table table-hover'> 
						  <tr> 
						
						<th>Client Name</th> 
						<th>Email Address</th> 
						<th>Contact Number</th> 
						<th>Start of Contract</th> 
						<th>End of Contract</th> 
						<th>Status</th> 
						</tr>"; 
								 
					$res = mysql_query($sql) or die(__LINE__.' '.$sql.' '.mysql_error());
					while($row = mysql_fetch_array($res)){
								 
						echo "<tr>"; 
						 
						 echo "<td>" . $row['clientName'] . "</td>"; 
						 echo "<td>" . $row['clientEmail'] . "</td>"; 
						 echo "<td>" . $row['contactNumber'] . "</td>"; 

						  //echo "<td>" . $row['addBlock'] . ", " . $row['addStreet'] . " " . $row['addSubdivision'] . " " . $row['addBarangay'] . " " . $row['addDistrict'] . " " . $row['addCity'] . $row['addProvince'] . "</td>";
						 echo "<td>" . $row['contractStartDate'] . "</td>"; 
						echo "<td>" . $row['contractEndDate'] . "</td>"; 
						 echo "<td>" . $row['contractStatus'] . "</td>"; 
						 echo "</tr>"; 
					 } 
					echo "</table>"; 
							 
				mysql_close($con); 
				
			?>
			<form name="calz" method="post" target="_blank" action="../fpdf/pdfClientSummary.php" >
				<div class="form-group col-md-1 col-md-offset-10">
					<input class="btn btn-success"					
							name = "submitall" 
							id="buttonall" 
							type="submit" 
							style="margin-top: 1.3em;" 
							value="Print Summary">
				</div>
			</form>
				
			<?php
	
			}
			
			
					
				
			 ?>
			 
			 
			 
			 <input type='hidden' name='name'  value ='<?php echo $_SESSION['start1']; ?> ' >
			<input type='hidden' name='age'  value ='<?php echo $_SESSION['end1']; ?> ' >
		</div>
	</div>
							
<?php
	include ('../footer.php');
?>