<div>
	<br /><br /><br />
</div>
		<footer class="footer container-fluid col-md-12">
			<div class="col-md-3">
				<br />
					<strong><h3>Maintenance</h3></strong>
					<hr>
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
							<li><a href="<?php echo $transactions; ?>assessApplicant.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;" >Assess Applicant</a></li>
							<li><a href="<?php echo $transactions; ?>endorse.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;">Endorse Applicant</a></li>
							<li><a href="<?php echo $transactions; ?>deploy.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;">Deploy Applicant</a><li>
							<li><a href="<?php echo $transactions; ?>PEvaluation.php?token=<?php echo $tran; ?>" style="color: #c0c0c0;">Performance Evaluation</a><li>
						</ul>

					<strong><h3>Queries</h3></strong>
					<hr>
						
							&nbsp;&nbsp;&nbsp;Find Query
				
			</div>
			<div class="col-md-3">
				<br />
					<strong><h3>Reports</h3></strong>
					<hr>
				
							&nbsp;&nbsp;&nbsp;Client Summary
						<br />
							&nbsp;&nbsp;&nbsp;Applicant Summary
						<br />
							&nbsp;&nbsp;&nbsp;Endorsement Summary
						<br />
							&nbsp;&nbsp;&nbsp;Deployment Summary
						<br />
							&nbsp;&nbsp;&nbsp;Employee Summary

					<strong><h3>User Account</h3></strong>
					<hr>
						
							&nbsp;&nbsp;&nbsp;Update User Account
				
			</div>
			<div class="col-md-3">
				<br />
					<strong><h3>Utilities</h3></strong>
					<hr>
	
							&nbsp;&nbsp;&nbsp;Settings
			
				<br /><br />
					<strong><h3>Developers</h3></strong>
					<hr>
						
							&nbsp;&nbsp;&nbsp;View Developers
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