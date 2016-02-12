<?php
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('clientNav.php'); // native to admin
	include('clientNotifModal.php');
?>

	
	<div class='container-fluid content'>
		<ul class="breadcrumb">
			<li><a href="index.php?token=<?php echo $home?>">REMS</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
			<li class="active">Home</li>
		</ul>
	</div>



	<div class="container-fluid">
		<div class="col-md-12 wrapper-background">
			<h2 class="alert-info well-lg">Welcome to Recruitment &amp; Employee Perfomance Monitoring System!</h2> 		
			<br />
			<div class="container-fluid">
				<div class="col-md-9">
					<div class="well-lg alert alert-success well-lg">
					    <div class="clearfix">
					        <div class="col-md-2">
					            <img src="../../image/Strauss.jpg" class="img-circle" height="85px" width="" ="85px" alt="" />
					        </div>

					        <div class="col-md-7">
					        	<h2>Hello <?php echo $_SESSION['login_user'] ?>!</h2>
					       		 <span class="subtitle">
					            	Your talent amazes! This is awesome. Excited to see the final product.
					       		 </span>
					       	</div>
					    </div>
					</div>
				</div>

				<div class="col-md-3">
					<div class="widget-container widget_calendar boxed">
			    		<div class="inner">
			        		<input type="text" name="date_departure2" class="inputField" value="" id="date_departure2">
			    		</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

<?php

	
				//update tbl contract  - expired
				$mysqli->query("UPDATE tbl_contract SET 
					contractStatus = 'expired'
				
				WHERE DATE(`contractEndDate`) = DATE(NOW())");

				
					//update tbl contract  - start ng renewed
				$mysqli->query("UPDATE tbl_contract SET 
					contractStatus = 'on-going'
				
				WHERE DATE(`contractStartDate`) = DATE(NOW())");
					
				
				
	include ('footer.php');
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