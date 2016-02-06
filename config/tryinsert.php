<?php
	//connection
	include_once ('../config/connection.php');
	session_start();
	
	$nameOfClient = ''; 
	$idOfClient = '';
	$random = '';
	
	$var_start_contract='';
	$var_end_contract='';
	
	$var_start_contract=$_POST['name_clientStartContract'];
	$var_end_contract=$_POST['name_clientEndContract'];
	
	$var_start_contract_to_format=date_create($_POST['name_clientStartContract']);
	$var_start_contract_formatted=date_format($var_start_contract_to_format,'Y/m/d');
	
	$var_end_contract_to_format=date_create($_POST['name_clientEndContract']);
	$var_end_contract_formatted=date_format($var_end_contract_to_format,'Y/m/d');
	
	
	$mysqli->query("INSERT INTO jobposting
			(
				branchID,
				jobPostingTitle,
				jobPostingStatus
				
			)
			VALUES 
			(
				'1',
				'$_SESSION[ses_jobPostingTitle]',
				'1'
			)");    
			
		
?>

<script type="text/javascript">
		window.alert('1 Record Added');
</script>
