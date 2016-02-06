<?php
session_start();
if(!isset($_SESSION['login_user']))
{
	header('Location: ../../index.php'); // Redirecting To Home Page
}

$home = md5('index');
$main = md5('maintenance');
$tran = md5('transaction');
$repo = md5('reports');
$util = md5('utilities');


if(!isset($_GET['token']))
{
	$index = "";
	$logout = "";
	$maintenance = "maintenance/";
	$transactions = "transactions/";
	$reports = "reports/";
	$utilities = "utilities/";
}
else if($_GET['token'] == md5('index'))
{
	$index = "";
	$maintenance = "maintenance/";
	$transactions = "transactions/";
	$reports = "reports/";
	$utilities = "utilities/";
	$logout = "../../";
}
else if($_GET['token'] == md5('maintenance'))
{
	$index = "../";
	$maintenance = "";
	$transactions = "../transactions/";
	$reports = "../reports/";
	$utilities = "../utilities/";
	$logout = "../../../";
}
else if($_GET['token'] == md5('transaction'))
{
	$index = "../";
	$maintenance = "../maintenance/";
	$transactions = "";
	$reports = "../reports/";
	$utilities = "../utilities/";
	$logout = "../../../";
}
else if($_GET['token'] == md5('reports'))
{
	$index = "../";
	$maintenance = "../maintenance/";
	$transactions = "../transactions/";
	$reports = "";
	$utilities = "../utilities/";
	$logout = "../../../";
}
else if($_GET['token'] == md5('utilities'))
{
	$index = "../";
	$maintenance = "../maintenance/";
	$transactions = "../transactions/";
	$reports = "../reports/";
	$utilities = "";
	$logout = "../../../";
}
else
{
	header('Location: ../index.php?token='.$home.''); 
}


?>
<nav class="navbar navbar-default" id="sticky_navigation">
	<div class="container-fluid">
    	<div class="navbar-header">
	   		<button type="button" class="navbar-toggle cent" data-toggle="collapse" data-target="#myNavbar">
	       		<span class="icon-bar"></span>
	       		<span class="icon-bar"></span>
	       		<span class="icon-bar"></span> 
	   		</button>
			<div class="nav navbar-nav">
				<li class="thisOne"><a class="navbar-brand" href="<?php echo $index; ?>index.php?token=<?php echo $home; ?>">&nbsp; { ; } REMS</a></li>
				<li class="this"><a class="navbar-brand hidden-lg hidden-md centro" href="<?php echo $index; ?>index.php?token=<?php echo $home; ?>">&nbsp; Recruitment &amp; Employee Performance Evaluation System</a></li>
			</div>
	   	</div>
    	<div class="collapse navbar-collapse" id="myNavbar">
      		<ul class="nav navbar-nav">
      				<li>&nbsp;&nbsp;&nbsp;</li>
  					<li><a href="<?php echo $index; ?>index.php?token=<?php echo $home; ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		        	<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		          			<span class="glyphicon glyphicon-wrench"></span> Maintenance
		          			<span class="caret"></span>
		          		</a>
		          		<ul class="dropdown-menu nav">
				            <li><a href="<?php echo $maintenance; ?>job.php?token=<?php echo $main; ?>">Job Posting</a></li> 
			          	</ul>
		        	</li>
		        	<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		          			<span class="glyphicon glyphicon-tasks"></span> Transactions
		          			<span class="caret"></span>
		          		</a>
		          		<ul class="dropdown-menu nav">
				             <li><a href="<?php echo $transactions; ?>assessApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>
				            <li><a href="<?php echo $transactions; ?>endorse.php?token=<?php echo $tran; ?>">Endorse Applicant</a></li>
				            <li><a href="<?php echo $transactions; ?>deploy.php?token=<?php echo $tran; ?>">Deploy Applicant</a></li>
				            
			          	</ul>
		        	</li>		        	
		        	<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		          			<span class="glyphicon glyphicon-folder-close"></span> Reports
		          			<span class="caret"></span>
		          		</a>
		          		<ul class="dropdown-menu nav">
		          			<li><a href="<?php echo $reports; ?>clientSummary.php?token=<?php echo $repo; ?>">Client Summary</a></li>
				            <li><a href="<?php echo $reports; ?>applicantSummary.php?token=<?php echo $repo; ?>">Applicant Summary</a></li>
				            <li><a href="<?php echo $reports; ?>endorsementSummary.php?token=<?php echo $repo; ?>">Endorsement Summary</a></li>
				            <li><a href="<?php echo $reports; ?>employeeSummary.php?token=<?php echo $repo; ?>">Employee Summary</a></li>
				            <li><a href="<?php echo $reports; ?>leaveReports.php?token=<?php echo $repo; ?>">Leave Reports</a></li>
				       	</ul>
		        	</li>
					<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		          			<span class="glyphicon glyphicon-cog"></span> Utilities
		          			<span class="caret"></span>
		          		</a>
		          		<ul class="dropdown-menu nav">
				            <li><a href="<?php echo $utilities; ?>settings.php?token=<?php echo $util; ?>">Settings</a></li>
				            <li><a href="<?php echo $utilities; ?>webContents.php?token=<?php echo $util; ?>">Website Content</a></li>
			          	</ul>
		        	</li>
		        	<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		          			<span class="glyphicon glyphicon-stats"></span> Queries
		          			
		          		</a>
		        	</li>
					
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../../config/logOut.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['login_user'] ?></a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#" data-toggle="modal" data-target="#hrdNotifModal">Notifications&nbsp;&nbsp;<span class="badge badge">12</span></a>
				</li>
			</ul>
		</div>
  	</div>
</nav>

<script type="text/javascript">
	$(function() {

    // grab the initial top offset of the navigation 
    var sticky_navigation_offset_top = $('#sticky_navigation').offset().top;
    
    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var sticky_navigation = function(){
        var scroll_top = $(window).scrollTop(); // our current vertical position from the top
        
        // if we've scrolled more than the navigation, change its position to fixed to stick to top,
        // otherwise change it back to relative
        if (scroll_top > sticky_navigation_offset_top) { 
            $('#sticky_navigation').css({ 'position': 'fixed', 'top':0, 'left':0 });
        } else {
            $('#sticky_navigation').css({ 'position': 'relative' }); 
        }   
    };
    
    // run our function on load
    sticky_navigation();
    
    // and run it again every time you scroll
    $(window).scroll(function() {
         sticky_navigation();
    });

});
</script>