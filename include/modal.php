<?php
	include('adminLink.php');
	include ('../../include/header.php');
	include ('adminNav.php');
?>

	<div class='container-fluid content'>
		<p style="text-align:right; padding-right:1em;">Hello Admin</p>
		<h2>Welcome to REMS! </h2>
	</div>


	<div class="container-fluid">
		<div class="col-md-4">
			<div class="well well-lg section">
				<a class="btn btn-link btn-md" data-toggle="modal" data-target="#myModal">
					<span class="glyphicon glyphicon-wrench"><h2> Maintenance </h2>
				</a>
				
				<div id="myModal" class="modal fade" role="dialog">
					<div class="modal-dialog modal-sm">
					  <div class="modal-content">
					      <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					          <span class="glyphicon glyphicon-wrench text-center"></span><h2> Maintenance </h2>
					      </div>
					      <div class="modal-body">
					    	<a href="maintenanceClient.php"><h4>Client</h4></a> <br />
			            	<a href="maintenanceBranch.php"><h4>Branch</h4></a> <br />
			           		<a href="maintenanceJob.php"><h4>Job Posting</h4></a> <br />
					      </div>	
				     		 <div class="modal-footer">
				        		<button type="button" class="btn btn-default" data-dismiss="modal">
				        			<span class="glyphicon glyphicon-remove"></span> Close
				        		</button>
				      		</div>
				    	</div>
			  		</div>
				</div>

			</div>
		</div>

		<div class="col-md-4">
			<div class="well well-lg section">
				<a class="btn btn-link btn-md" data-toggle="modal" data-target="#myModal2">
					<span class="glyphicon glyphicon-tasks"><h2> Transactions </h2>
				</a>

				<div id="myModal2" class="modal fade" role="dialog">
					<div class="modal-dialog modal-sm">
					  <div class="modal-content">
					      <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					          <span class="glyphicon glyphicon-tasks"></span><h2> Transactions </h2>
					      </div>
					      <div class="modal-body">
					    	<a href="transactionAssessApplicant.php"><h4>Assess Applicant</h4></a> <br />
			            	<a href="deploy.php"><h4>Deploy Applicant</h4></a> <br />
					      </div>	
				     		 <div class="modal-footer">
				        		<button type="button" class="btn btn-default" data-dismiss="modal">
				        			<span class="glyphicon glyphicon-remove"></span> Close
				        		</button>
				      		</div>
				    	</div>
			  		</div>
				</div>
			</div>
		</div>



		


		<div class="col-md-4">
			<div class="widget-container widget_calendar boxed">
	    		<div class="inner">
	        		<input type="text" name="date_departure2" class="inputField" value="" id="date_departure2">
	    		</div>
			</div>
		</div>


		<div class="col-md-4">
			<div class="well well-lg section">
				<a class="btn btn-link btn-md" data-toggle="modal" data-target="#myModal3">
					<span class="glyphicon glyphicon-folder-close"><h2> Reports </h2>
				</a>

				<div id="myModal3" class="modal fade" role="dialog">
					<div class="modal-dialog modal-sm">
					  	<div class="modal-content">
					     	 <div class="modal-header">
					       	   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					        	  <span class="glyphicon glyphicon-folder-close"><h2> Reports </h2>
					     	 </div>
					     	 <div class="modal-body">
					    		<a href="clientSummary.php"><h4>Client Summary</h4></a><br />
					            <a href="endorsementSummary.php"><h4>Endorsement Summary</h4></a><br />
					            <a href="employeeSummary.php"><h4>Employee Summary</h4></a><br />
					            <a href="leaveReports.php"><h4>Leave Reports</a></h4><br />
					            <a href="PEvaluation.php"><h4>Performance Evaluation</h4></a><br />
					      	</div>	
				     		<div class="modal-footer">
				        		<button type="button" class="btn btn-default" data-dismiss="modal">
				        			<span class="glyphicon glyphicon-remove"></span> Close
				        		</button>
				      		</div>
				    	</div>
			  		</div>
				</div>
			</div>
		</div>


		<div class="col-md-4">
			<div class="well well-lg section">
				<a class="btn btn-link btn-md" data-toggle="modal" data-target="#myModal4">
					<span class="glyphicon glyphicon-cog"><h2> Utilities </h2>
				</a>

				<div id="myModal4" class="modal fade" role="dialog">
						<div class="modal-dialog modal-sm">
						  <div class="modal-content">
						      <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						          <span class="glyphicon glyphicon-cog"></span><h2> Utilities </h2>
						      </div>
						      <div class="modal-body">
						    		<a href="#"><h4>Exams</h4></a><br />
						            <a href="#"><h4>User Role</h4></a><br />
						            <a href="#"><h4>Settings</h4></a><br />
						            <a href="#"><h4>Website Content</h4></a><br />
						      </div>	
				     		 <div class="modal-footer">
				        		<button type="button" class="btn btn-default" data-dismiss="modal">
				        			<span class="glyphicon glyphicon-remove"></span> Close
				        		</button>
				      		</div>
				    	</div>
			  		</div>
				</div>
			</div>
		</div>


	</div>


<?php
	include ('../../include/footer.php');
?>


<script>
    // <![CDATA[
    jQuery(document).ready(function($) {

        // Second Calendar
        function assignCalendar(id){
            $('<div class="calendar" />')
                    .insertAfter( $(id) )
                    .multiDatesPicker({
                        dateFormat: 'yy-mm-dd',
                        minDate: new Date(),
                        maxDate: '+1y',
                        altField: id,
                        firstDay: 1,
                        showOtherMonths: true
                    }).prev().hide();
        }
        assignCalendar('#date_departure2');

    });
    // ]]>
</script>