<?php
	$root = realpath(dirname(__FILE__) . '/..');
	include($root . '/config/connection.php');
	
		if (!$con)
		{
			die('Could not connect: ' . mysql_error()); 
		}
		mysql_select_db("remsdb", $con); 
		
		$query1= mysql_query("SELECT * FROM tbl_picture WHERE picId = 1");
		// display query results
		
		while($row = mysql_fetch_array($query1))
		{
			
				$filename = $row['filename'];
	
		}
	
		$query = mysql_query("SELECT * FROM tbl_picture WHERE picId = 2");
		// display query results
		
		while($row = mysql_fetch_array($query))
		{
			//$id = $row['picId'];
			$bgimage = $row['filename'];
			
		}
?>
<link rel='shortcut icon' type='image/x-icon' href="../../image/favicon.ico"/>
<link rel="stylesheet" href="../../stylesheet/bootstrap.min.css">
<link href="../../stylesheet/style.css" media="screen" rel="stylesheet">
<link href="../../stylesheet/jquery-ui-1.8.20.custom.css" rel="stylesheet">

<script src="../../script/jquery.min.js"></script>
<script src="../../script/bootstrap.min.js"></script>
<script src="../../script/applyscript.js"></script>
<script src="../../script/validateApply.js"></script>
<script src="../../script/smoothscroll.js"></script>
<script src="../../script/indexscript.js"></script>
<script src="../../script/jquery-ui.min.js"></script>
<script src="../../script/jquery-ui.multidatespicker.js"></script>

<center>
	<img class="img-responsive" src="../../<?php echo $filename;?>"  width="100%">
</center>
<style type="text/css">
	body
	{
		background-image: url('../../<?php echo $bgimage;?>');
	}
</style>
<!-- /style -->
