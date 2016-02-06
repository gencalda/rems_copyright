<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../clientNav.php'); // native to admin
	include('../clientNotifModal.php');
?>

	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Maintenace</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAddNew.php?token=<?php echo $main; ?>">Job Posting</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd.php?token=<?php echo $main; ?>">Add Job</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd2.php?token=<?php echo $main; ?>">Job Qualifications</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd3.php?token=<?php echo $main; ?>">Language Spoken</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="jobPostingAdd4.php?token=<?php echo $main; ?>">Skills and Qualities</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li>Done</li>
		</ul>

	</div>

	
	<div class="container-fluid">
		<div class="col-md-6 col-md-offset-3">	
			<br /><br /><br />
				<div class="content-fluid" >
					<h4 class="alert alert-success well-lg">
						Thank you! <br /><br />
						The job has been posted successfully.
						<br />
						<br />
						<br />
						Click <a href="../index.php?token=<?php echo $home;?>"><button class="btn btn-success">here</button></a> to continue browsing the site.
						</h4>
				</div>
		</div>
	</div>

<br /><br /><br />

<?php
	include ('../footer.php');
?>