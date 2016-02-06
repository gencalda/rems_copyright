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
	header('Location: ../index.php?tab=index'); 
}
?>

<script type="text/javascript">
	<?php
		$mysqli->query("UPDATE tbl_notification
			SET notifStatus = 'seen'
			WHERE notifStatus = 'bagongNotif'
			AND notifUser = 'client'"
			);
	?>
</script>

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
				<li class="this"><a class="navbar-brand hidden-lg hidden-md centro" href="<?php echo $index; ?>index.php?token=<?php echo $home; ?>">&nbsp; Recruitment &amp; Employee Performance Monitoring System</a></li>
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
				            <li><a href="<?php echo $maintenance; ?>clientInformation.php?token=<?php echo $main; ?>">Client</a></li>
				            <li><a href="<?php echo $maintenance; ?>clientJob.php?token=<?php echo $main; ?>">Job Posting</a></li> 
							<li class="divider"></li> 
							<li><a href="<?php echo $maintenance; ?>clientExam.php?token=<?php echo $main; ?>">Exams</a></li>
			          	</ul>
		        	</li>
		        	<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		          			<span class="glyphicon glyphicon-tasks"></span> Transactions
		          			<span class="caret"></span>
		          		</a>
		          		<ul class="dropdown-menu nav">
				            <li><a href="<?php echo $transactions; ?>clientEndorsedApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>
							<li><a href="<?php echo $transactions; ?>clientEmployedApplicant.php?token=<?php echo $tran; ?>">Employee</a></li>
				            <li class="divider"></li> 
				            <li><a href="<?php echo $transactions; ?>PEvaluation.php?token=<?php echo $tran; ?>">Performance Evaluation</a></li>
							<li><a href="<?php echo $transactions; ?>sendEmpRep.php?token=<?php echo $tran; ?>">Report Employee</a></li>
			          	</ul>
		        	</li>
		        	
		        	<li class="dropdown">
		          		<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		          			<span class="glyphicon glyphicon-folder-close"></span> Reports
		          			<span class="caret"></span>
		          		</a>
		          		<ul class="dropdown-menu nav">
				            
				            <li><a href="<?php echo $reports; ?>employeeReports.php?token=<?php echo $repo; ?>">Employee</a></li>
				            
			          	</ul>
		        	</li>
					
		        
					
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo $logout; ?>config/logOut.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo $maintenance; ?>clientInformation.php?token=<?php echo $main; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['login_user'] ?></a></li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#" data-toggle="modal" onclick="resetNotif();" id="notif" data-target="#adminNotifModal">Notifications&nbsp;&nbsp;<span class="badge badge">
					<div id="content">
					<?php include ('notif.php');?>
					</div>
					</span></a>
				</li>
			</ul>
		</div>
  	</div>
</nav>

<div id="adminNotifModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
	  <div class="modal-content">
	      	<div class="modal-header">
	         	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	         	<h3 class="text-center">Notifications
				</h3>
	      	</div>

	        <div class="modal-body">	
				
				<?php	
					 include ('notifbody.php');
				?>
				
	      	</div>

     		<div class="modal-footer">
     			<div>
	        		<button type="button" class="btn btn-default" data-dismiss="modal">
	        			<span class="glyphicon glyphicon-remove"></span> Close
	        		</button>
        		</div>
      		</div>
    	</div>
		</div>
</div>

<?php
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/config/connection.php');
	//include ('new.php');
	$token = $_GET['token'];
	if($token == md5('index'))
	{
		$toks = "../client";
	}
	else
	{
		$toks = "..";
	}
?>

<script type="text/javascript">

	setInterval(
	function()
	{
	$('#content').load('notif.php');}, 1000);
	$(function() {
		
	setInterval(
	function()
	{
	//$('#content').fadeOut("Slow").load('notif.php').fadeIn("Slow");}, 1000);
	$('#content2').load('notifbody.php');}, 3000);

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