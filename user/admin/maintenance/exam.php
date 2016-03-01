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
				Exam
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
								<a href="exam.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Exam</a>
							</h3>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li>
							<a href="createExam.php?token=<?php echo $main; ?>"style="margin-top:.2em;"><span class="glyphicon glyphicon-plus"></span> Create</a>
						</li>
					</ul>
			  	</div>
			</nav>
			<h4 class="alert-info well-lg instruction">List of Exams.</h4>
			<br />
			<div class="container-fluid table-responsive content">
				<?php

						$examSubject = array();
						$examTitle = array();
						$examClientName = array();
						$examJobName = array();

					$con = mysql_connect("$db_hostname","$db_username","$db_password");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error()); 
					}
					mysql_select_db("$db_database", $con);
					$result = mysql_query("SELECT *
										FROM tbl_exam
										LEFT JOIN tbl_job_posting
										ON tbl_exam.jobPostingId = tbl_job_posting.jobPostingId
										LEFT JOIN tbl_client
										ON tbl_client.clientId = tbl_job_posting.clientId
										LEFT JOIN tbl_subject
										ON tbl_subject.subjectId = tbl_exam.subjectId
										");

					$ctr = 0;
					while ($row = mysql_fetch_array($result))
					{
						$examSubject[$ctr] = $row['subjectName'];
						$examTitle[$ctr] = $row['examTitle'];
						$examClientName[$ctr] = $row['clientName'];
						$examJobName[$ctr] = $row['jobName'];
						$ctr++;
					}

					$ctr =0;
					echo"<div class='outer'>
					<div class='inner'>";
					echo "<table class='table table-responsive table-hover table-striped'>";
					if (isset($examTitle[$ctr]))
					{
						echo "<thead>";
						echo "<tr class='tablehead'>
							<td>Exam Title</td>
							<td>Subject</td>
							<td>Client Name</td>
							<td>Job Name</td>
							</tr>
						</thead>";
					}
					else 
					{
						echo "<tr>
							<td>No exam available.</td>
							</tr>";
					}
				
					while(isset($examTitle[$ctr]) &&($examTitle[$ctr]!="")) 
					{
						echo"
						<tr>
						<td>$examTitle[$ctr]</td>
						<td>$examSubject[$ctr]</td>
						<td>$examClientName[$ctr]</td>
						<td>$examJobName[$ctr]</td>
						</tr>
						";
						$ctr++;
					}

					echo "</table>";
					echo"</div>
					</div>";
					mysql_close($con);
				
				?>
			</div>
		</div>



	</div>







	
	



	

<?php
	include ('../footer.php');
?>
