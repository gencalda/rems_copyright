<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	//include('../clientNotifModal.php');
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
				clientId,
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
?>

<?php
	include ('../footer.php');
?>	
	
	
	
	
	
	
