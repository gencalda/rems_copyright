<?php
	if(!isset($_GET['token']))
	{
		$index = "";
	}
	else if($_GET['token'] == md5('apply'))
	{
		$index = "../";
		$home = md5('home');
		$about = md5('about');
		$news = md5('newsandinformation');
		$job = md5('jobopportunities');
		$contact = md5('contact');
		$application = md5('application');
		$log = md5('login');
		$logout = md5('logout');
		$forgot = md5('forgotpassword');
		$sent = md5('linksent');
		$image = md5('image');
		$pdf = md5('pdf');
		$terms = md5('terms');
		$failed = md5('failed');
	}
	else
	{
		$index = "";
		$home = md5('home');
		$about = md5('about');
		$news = md5('newsandinformation');
		$job = md5('jobopportunities');
		$contact = md5('contact');
		$application = md5('application');
		$log = md5('login');
		$reg = md5('register');
		$logout = md5('logout');
		$forgot = md5('forgotpassword');
		$sent = md5('linksent');
		$image = md5('image');
		$pdf = md5('pdf');
		$terms = md5('terms');
		$failed = md5('failed');
	}
		
?>


<nav class="navbar navbar-default" id="sticky_navigation">
	<div class="container-fluid" >
	   	<div class="navbar-header">
	   		<button type="button" class="navbar-toggle cent" data-toggle="collapse" data-target="#myNavbar">
	       		<span class="icon-bar"></span>
	       		<span class="icon-bar"></span>
	       		<span class="icon-bar"></span> 
	   		</button>
			<div class="nav navbar-nav">
				<li class="thisOne"><a class="navbar-brand" href="<?php echo $index;?>index.php?token=<?php echo $home;?>">&nbsp; { ; } REMS</a></li>
				<li class="this"><a class="navbar-brand hidden-lg hidden-md centro" href="<?php echo $index;?>index.php?token=<?php echo $home;?>">&nbsp; Recruitment &amp; Employee Performance Monitoring System</a></li>
			</div>
	   	</div>
	
    	<div class="collapse navbar-collapse" id="myNavbar">
      		<ul class="nav navbar-nav">
  				<li>&nbsp;&nbsp;&nbsp;</li>
				<li><a href="<?php echo $index;?>index.php?token=<?php echo $home;?>"><span class="glyphicon glyphicon-home"></span> &nbsp;Home</a></li>
				<li><a href="<?php echo $index;?>index.php?token=<?php echo $about;?>"><span class="glyphicon glyphicon-th"></span> &nbsp;About</a></li>
				<li><a href="<?php echo $index;?>index.php?token=<?php echo $news;?>"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; News &amp; Information</a></li>
				<li><a href="<?php echo $index;?>index.php?token=<?php echo $job;?>"><span class="glyphicon glyphicon-briefcase"></span> &nbsp;Job Opportunities</a></li>
				<li><a href="<?php echo $index;?>index.php?token=<?php echo $contact;?>"><span class="glyphicon glyphicon-phone-alt"></span> &nbsp;Contact Us</a></li>
				<li><a href="<?php echo $index;?>iApply.php?token=<?php echo $application;?>"><span class="glyphicon glyphicon-pencil"></span>&nbsp; iApply</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo $index;?>takeExam.php?token=<?php echo $reg;?>"><span class="glyphicon glyphicon-th-list"></span> &nbsp;Exam</a></li>
				<li><a href="<?php echo $index;?>register.php?token=<?php echo $reg;?>"><span class="glyphicon glyphicon-edit"></span> &nbsp;Register</a></li>
				<li><a href="<?php echo $index;?>logIn.php?action=<?php echo $log;?>&token=<?php echo $log;?>"><span class="glyphicon glyphicon-log-in"></span> &nbsp;Login</a></li>
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