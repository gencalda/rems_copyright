<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	//include('../clientNotifModal.php');
?>
	

	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="PEvaluation.php?token=<?php echo $tran; ?>">Performance Evaluation</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Performance Evaluation Sheet</li>
		</ul>
	</div>


	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">

			<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li><h3><a href="performanceEvaluationSheet.php?token=<?php echo $tran; ?>" style="margin-left:.5em;">Performance Evaluation Sheet</a></h3></li>
					</ul>
			  	</div>

			</nav>

			<h4 class="alert-info well-lg instruction">Monthly Performance Evaluation.</h4>
			<br /><br />
				<div class="container-fluid">
		      		<form class="form center-block" role="form"  action="demo.php?token=<?php echo $tran;?>" method='POST'>
				    	<?php
						$ID=$_GET['ID'];
						$con = mysql_connect("$db_hostname","$db_username","$db_password");
						if (!$con)
						{
							die('Could not connect: ' . mysql_error()); 
						}
						
						mysql_select_db("$db_database", $con);
						$result = mysql_query("SELECT employeeId, basicFirstName, basicLastName, jobName, clientName FROM tbl_employee a, tbl_basic_info b, tbl_client c, tbl_job_posting d, tbl_applicant e WHERE employeeId = ".$_GET['ID']." AND a.applicantId = e.applicantId AND e.basicId = b.basicId AND a.jobPostingId = d.jobPostingId AND d.clientId = c.clientId");
						while($row = mysql_fetch_array($result)) 
						{
							echo"<div class='col-md-4'>
								<label>Employee's Name:</label>
								".$row['basicFirstName']." ".$row['basicLastName']."
							</div>";
							echo"<div class='col-md-4'>
								<label>Designation:</label>
								".$row['jobName']."
							</div>";
							echo"<div class='col-md-4'>
								<label>Hiring Date:</label>
								June 13, 2014
							</div>";
							echo"<div class='col-md-4'>
								<label>Date of Evaluation:</label>
								'now()';
							</div>";
							echo"<div class='col-md-4'>
								<label>Date of Last Evaluation:</label>
								Not Applicable
							</div>";
							echo"<div class='col-md-4'>
								<label>Client Name:</label>
								".$row['clientName']."
							</div>";

							echo"<div class='col-md-12'>
								<br /><br /><br />
							</div>";
						}
						?>

						<div class="col-md-12 table-responsive">
							<table class="table table-hover table-striped">
								<thead class="tablehead" style="text-align:center">
									<td >Performance Factor</th>
									<td colspan="5">Rating Scale</td>
									
								</thead>

								<tr>
									<td><strong>1. Quality</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Work is accurate and precise.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_1_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_1_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_1_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_1_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_1_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Recognizes and points out substandard workmanship.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_1_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_1_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_1_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_1_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_1_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Displays thoroughness and completeness in work activity.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_1_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_1_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_1_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_1_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_1_c" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>d. Takes proper care of equipment/keeps work area clean.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_1_d" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_1_d" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_1_d" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_1_d" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_1_d" value="1" />
									</td>
								</tr>


								<tr>
									<td><strong>2. Productivity</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Amount of work completed (quantity).</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_2_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_2_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_2_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_2_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_2_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Utilizes time well.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_2_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_2_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_2_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_2_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_2_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Organizes in such a manner to perform responsibilities.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_2_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_2_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_2_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_2_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_2_c" value="1" />
									</td>
								</tr>


								<tr>
									<td><strong>3. Job knowledge</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Able to follow verbal and/or written instructions.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_3_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_3_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_3_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_3_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_3_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Uses proper procedures, methods and tools.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_3_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_3_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_3_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_3_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_3_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Performs work without detailed instructions.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_3_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_3_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_3_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_3_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_3_c" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>d. Shows improvement on repetitive tasks.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_3_d" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_3_d" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_3_d" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_3_d" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_3_d" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>e. Has practical/technical knowledge to perform job.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_3_e" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_3_e" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_3_e" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_3_e" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_3_e" value="1" />
									</td>
								</tr>


								<tr>
									<td><strong>4. Reliability</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Begins and finishes on time.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_4_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_4_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_4_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_4_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_4_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Requires minimum supervision; completes tasks without prompting.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_4_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_4_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_4_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_4_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_4_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Completes tasks efficiently within required time frames.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_4_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_4_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_4_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_4_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_4_c" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>d. Puts in extra time and effort.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_4_d" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_4_d" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_4_d" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_4_d" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_4_d" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>e. Does the best according to ability and within minimum job standards.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_4_e" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_4_e" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_4_e" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_4_e" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_4_e" value="1" />
									</td>
								</tr>
								

								<tr>
									<td><strong>5. Attendance</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. At work on a daily basis.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_5_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_5_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_5_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_5_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_5_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Start and finishes according to approved schedule (punctual).</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_5_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_5_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_5_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_5_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_5_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Calls to explain absence.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_5_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_5_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_5_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_5_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_5_c" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>d. Observes generally agreed work break/meal periods.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_5_d" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_5_d" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_5_d" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_5_d" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_5_d" value="1" />
									</td>
								</tr>


								<tr>
									<td><strong>6. Initiative/Creativity</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Seeks out new assignments when finished with own work.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_6_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_6_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_6_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_6_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_6_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Properly selects priorities.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_6_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_6_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_6_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_6_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_6_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Determines what must be done without being told.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_6_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_6_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_6_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_6_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_6_c" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>d. Makes suggestions on better ways of getting work done.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_6_d" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_6_d" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_6_d" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_6_d" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_6_d" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>e. Identifies and corrects errors during the work process.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_6_e" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_6_e" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_6_e" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_6_e" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_6_e" value="1" />
									</td>
								</tr>

								<tr>
									<td><strong>7. Teamwork</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Works well with supervisors, peers, and subordinates.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_7_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_7_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_7_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_7_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_7_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Sets an example with a positive and supportive attitude.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_7_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_7_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_7_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_7_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_7_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Communicates well with coworkers and supervisors.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_7_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_7_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_7_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_7_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_7_c" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>d. Promotes teamwork in the work place.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_7_d" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_7_d" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_7_d" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_7_d" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_7_d" value="1" />
									</td>
								</tr>


								<tr>
									<td><strong>8. Policy Compliance</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Practices proper safety procedures.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_8_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_8_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_8_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_8_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_8_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Adheres to all company policies and regulations.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_8_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_8_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_8_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_8_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_8_b" value="1" />
									</td>
								</tr>

								<tr>
									<td><strong>9. Customer Service</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Establishes positive relations inter/intra departmentally.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_9_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_9_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_9_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_9_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_9_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Responsive and courteous to client inquiries.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_9_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_9_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_9_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_9_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_9_b" value="1" />
									</td>
								</tr>

								<tr>
									<td><strong>10. Other</strong></td>
									<th>5</th>
									<th>4</th>
									<th>3</th>
									<th>2</th>
									<th>1</th>
								</tr>
								<tr>
									<td>
										<ul>
											<li>a. Judgment and decision-making.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_10_a" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_10_a" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_10_a" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_10_a" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_10_a" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>b. Adaptability.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_10_b" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_10_b" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_10_b" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_10_b" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_10_b" value="1" />
									</td>
								</tr>

								<tr>
									<td>
										<ul>
											<li>c. Problem Solving.</li>
										</ul>
									</td>
									<td>
										<input type="radio" name="pf_10_c" value="5" checked />
									</td>
									<td>
										<input type="radio" name="pf_10_c" value="4" />
									</td>
									<td>
										<input type="radio" name="pf_10_c" value="3" />
									</td>
									<td>
										<input type="radio" name="pf_10_c" value="2" />
									</td>
									<td>
										<input type="radio" name="pf_10_c" value="1" />
									</td>
								</tr>
							</table>
							<br />
							<input type='hidden' name='ID'  value ='<?php echo $_GET['ID'];?>' >
							<label>Recommendation:</label>
							
							
							<textarea type="submit" class="form-control" rows="8" value="" name="nm" cols="50"></textarea>
							
							<div class="form-group col-md-2 col-md-offset-4">
								
								<button type="reset" 
										class="btn btn-danger btn-md btn-block"
										name ="reset" 
										tabindex="-1" 
										style="margin-top: 2em; ">
									 	Reset &nbsp;
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
						</div>			
				  	</form>
			 </div>
		</div>
	</div>


<?php
	include ('../footer.php');
?>