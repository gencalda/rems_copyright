<div>
	<br /><br /><br />
</div>
		<footer class="footer container-fluid col-md-12">
			<div class="col-md-3">
				<br />
					<strong><h3>Maintenance</h3></strong>
					<hr>
				
					<p style="font-size: 1.3em;">Client</p>
						<ul>
							<li><a href="<?php echo $maintenance; ?>clientUpdate.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Update Information</a><li>
						</ul>
				<br />
					<p style="font-size: 1.3em;">Job</p>
						<ul>
							<li><a href="<?php echo $maintenance; ?>job.php?token=<?php echo $main; ?>" style="color: #c0c0c0;" >Browse Jobs</a></li>
							<li><a href="<?php echo $maintenance; ?>jobPostingAdd.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Add Job</a></li>
							<li><a href="<?php echo $maintenance; ?>jobUpdate.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Update Job</a><li>
						</ul>
			</div>
			<div class="col-md-3">
				<br />
					<strong><h3>Transactions</h3></strong>
					<hr>
				
						<ul>
							<li><a href="<?php echo $transactions; ?>clientEndorsedApplicant.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;" >Assess Applicant</a></li>
							<li><a href="<?php echo $transactions; ?>clientEmployedApplicant.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;" >Employee</a></li>
							<li><a href="<?php echo $transactions; ?>PEvaluation.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;">Performance Evaluation</a><li>
							<li><a href="<?php echo $transactions; ?>sendEmpRep.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;">Report Employee</a><li>
						</ul>

					
				
			</div>
			<div class="col-md-3">
				<br />
					<strong><h3>Transactions</h3></strong>
					<hr>
				
						<ul>
							<li><a href="<?php echo $reports; ?>endorsementSummary.php?token=<?php echo $repo; ?>" style="color: #c0c0c0;" >Endorsement</a></li>
							<li><a href="<?php echo $reports; ?>employeeSummary.php?token=<?php echo $repo; ?>" style="color: #c0c0c0;" >Employee</a></li>
						</ul>
						

					
				
			</div>
			<div class="col-md-3">
				<br />
				<strong><h3>Developers</h3></strong>
					<hr>
						
							&nbsp;&nbsp;&nbsp;View Developers
							
					<br /><br />
					<strong><h3>User Account</h3></strong>
					<hr>
						
						<ul>
							<li><a href="<?php echo $maintenance; ?>clientInformation.php?token=<?php echo $main; ?>" style="color: #c0c0c0;" >Update User Account</a></li>
						</ul>
						
			</div>
			
			
			
			<div class="col-md-12">
				
				<br />
				<p class="footerContent">
					Developed by <a href="developers.php?token=<?php echo $home; ?>" style="color: #c0c0c0;">{#getchs;}</a>&trade; 2015
				</p>
			
			</div>
		</footer>
	</body>
</html>