<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
?>

<?php

if (PHP_SAPI != 'cli') 
{
	echo "<pre>";
}


$strings = $_POST["nm"] ;

require_once __DIR__ . '/autoload.php';
$sentiment = new \PHPInsight\Sentiment();


	// calculations:
	$scores = $sentiment->score($strings);
	$class = $sentiment->categorise($strings);

	// output:
	//echo "String: $strings\n";
	//echo "Dominant: $class, scores: ";
	//print_r($scores);
	//echo "\n";
	$empID=$_POST['ID'];
	$negative=0;
	$positive=0;
	$negative=$scores['neg'];
	$positive=$scores['pos'];
	
	$quality=     ($_POST['pf_1_a']+$_POST['pf_1_b']+$_POST['pf_1_c']+$_POST['pf_1_d'])/4;
	$productivity=($_POST['pf_2_a']+$_POST['pf_2_b']+$_POST['pf_2_c'])/3;
	$jobknowledge=($_POST['pf_3_a']+$_POST['pf_3_b']+$_POST['pf_3_c']+$_POST['pf_3_d']+$_POST['pf_3_e'])/5;
	$reliability= ($_POST['pf_4_a']+$_POST['pf_4_b']+$_POST['pf_4_c']+$_POST['pf_4_d']+$_POST['pf_4_e'])/5;
	$attendance=  ($_POST['pf_5_a']+$_POST['pf_5_b']+$_POST['pf_5_c']+$_POST['pf_5_d'])/4;
	$initiative=  ($_POST['pf_6_a']+$_POST['pf_6_b']+$_POST['pf_6_c']+$_POST['pf_6_d']+$_POST['pf_6_e'])/5;
	$teamwork=    ($_POST['pf_7_a']+$_POST['pf_7_b']+$_POST['pf_7_c']+$_POST['pf_7_d'])/4;
	$policy=      ($_POST['pf_8_a']+$_POST['pf_8_b'])/2;
	$customer=    ($_POST['pf_9_a']+$_POST['pf_9_b'])/2;
	$other=       ($_POST['pf_10_a']+$_POST['pf_10_b']+$_POST['pf_10_c'])/3;
	
	
	if($class=='neg')
	{
		$Comment=$negative-$positive;
		$Comment=$Comment*10;
		$evaluation=($quality+$productivity+$jobknowledge+$reliability+$attendance+$initiative+$teamwork+$policy+$customer+$other)-$Comment;
	}
	else if ($class=='pos')
	{
		$Comment=$positive-$negative;
		$Comment=$Comment*10;
		$evaluation=$quality+$productivity+$jobknowledge+$reliability+$attendance+$initiative+$teamwork+$policy+$customer+$other+$Comment;
	}
	else
	{
	    $Comment=0;
		$evaluation=$quality+$productivity+$jobknowledge+$reliability+$attendance+$initiative+$teamwork+$policy+$customer+$other;
	}
	echo "</pre>";
	
	
	$connection = mysql_connect("$db_hostname","$db_username","$db_password");
	if (!$connection)
	{
		die ("No connection Established error at: " .mysql_error());
	}
	mysql_select_db($db_database,$connection);
	
	$sql = "INSERT INTO tbl_evaluation
			(
				dateEvaluated,
				remsValue,
				evaluator,
				employeeId,
				evalComment,
				commentScore,
				quality,
				productivity,
				jobknowledge,
				reliability,
				attendance,
				initiative,
				teamwork,
				policy,
				customer,
				other
			)
			VALUES 
			(
				now(),
				'$evaluation',
				'$_SESSION[login_user]',
				'$empID',
				'$strings',
				'$Comment',
				'$quality',
				'$productivity',
				'$jobknowledge',
				'$reliability',
				'$attendance',
				'$initiative',
				'$teamwork',
				'$policy',
				'$customer',
				'$other'
			)";
			
	if(!mysql_query($sql,$connection))
	{
		die("Error: " .mysql_error());
	}

	mysql_close($connection);
	
	echo $_POST['ID'];
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li>Transactions</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="PEvaluation.php?token=<?php echo $tran; ?>">Performance Evaluation</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li><a href="performanceEvaluationSheet.php?token=<?php echo $tran; ?>">Performance Evaluation Sheet</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Performance Evaluation Score</li>
		</ul>
	</div>
	
	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
		<?php
		
					
			$connection = mysql_connect("$db_hostname","$db_username","$db_password");
			if (!$connection)
			{
				die ("No connection Established error at: " .mysql_error());
			}
			mysql_select_db($db_database,$connection);	
			
			$result2 = mysql_query("SELECT employeeId, basicFirstName, basicLastName, jobName, clientName FROM tbl_employee a, tbl_basic_info b, tbl_client c, tbl_job_posting d, tbl_applicant e WHERE employeeId = ".$_POST['ID']." AND a.applicantId = e.applicantId AND e.basicId = b.basicId AND a.jobPostingId = d.jobPostingId AND d.clientId = c.clientId");
			while($row = mysql_fetch_array($result2)) 
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
								<label>Client Name:</label>
								".$row['clientName']."
							</div>";

							echo"<div class='col-md-12'>
								<br /><br /><br />
							</div>";
						}
				$date=date("M d, Y");
				echo"<h4>Date of Evaluation: $date</h4>";
				echo"<h4>Evaluator: $_SESSION[login_user]</h4>";
				echo"<h4>Quality: $quality</h4>";
				echo"<h4>Productivity: $productivity</h4>";
				echo"<h4>Job Knowledge: $jobknowledge</h4>";
				echo"<h4>Reliability: $reliability</h4>";
				echo"<h4>Attendance: $attendance</h4>";
				echo"<h4>Initiative/Creativity: $initiative</h4>";
				echo"<h4>Teamwork: $teamwork</h4>";
				echo"<h4>Policy Compliance: $policy</h4>";
				echo"<h4>Customer Servive: $customer</h4>";
				echo"<h4>Other: $other</h4>";
				echo"<h4>Comment: $strings</h4>";
				echo"<h4>Comment Score: $Comment</h4>";
				echo"<h2>Evaluation Score: $evaluation</h2>";
				
			
			?>
		</div>
	</div>

<?php
	include ('../footer.php');
?>	
	
	
	
	
	
	
