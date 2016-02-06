<div>
	<br />
</div>
		<footer class="footer container-fluid col-md-12">
			<div class="col-md-3">
				<br />
					<strong><h3>Maintenance</h3></strong>
					<hr>
				
					<p style="font-size: 1.3em;">Client</p>
						<ul>
							<li><a href="<?php echo $maintenance; ?>client.php?token=<?php echo $main; ?>" style="color: #c0c0c0;" >Browse Clients</a></li>
							<li><a href="<?php echo $maintenance; ?>clientAdd.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Add Client</a></li>
							<li><a href="<?php echo $maintenance; ?>clientUpdate.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Update Client</a><li>
						</ul>
				<br />
					<p style="font-size: 1.3em;">Job</p>
						<ul>
							<li><a href="<?php echo $maintenance; ?>job.php?token=<?php echo $main; ?>" style="color: #c0c0c0;" >Browse Jobs</a></li>
							<li><a href="<?php echo $maintenance; ?>jobPostingAdd.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Add Job</a></li>
							<li><a href="<?php echo $maintenance; ?>jobUpdate.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Update Job</a><li>
						</ul>
				<br />
					<p style="font-size: 1.3em;">Type of Business</p>
						<ul>
							<li><a href="<?php echo $maintenance; ?>typeOfBusiness.php?token=<?php echo $main; ?>" style="color: #c0c0c0;" >Browse Type of Business</a></li>
							<li><a href="<?php echo $maintenance; ?>typeOfBusinessAdd.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Add New Type of Business</a></li>
							<li><a href="<?php echo $maintenance; ?>typeOfBusinessUpdate.php?token=<?php echo $main; ?>" style="color: #c0c0c0;">Update Type of Business</a><li>
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

					
				
			</div>
			<div class="col-md-3">
				<br />
					<strong><h3>Reports</h3></strong>
					<hr>
						<ul>
							<li><a href="<?php echo $reports; ?>clientSummary.php?token=<?php echo $repo; ?>" style="color: #c0c0c0;">Client</a></li>
				            <li><a href="<?php echo $reports; ?>applicantSummary.php?token=<?php echo $repo; ?>" style="color: #c0c0c0;">Applicant</a></li>
				            <li><a href="<?php echo $reports; ?>endorsementSummary.php?token=<?php echo $repo; ?>" style="color: #c0c0c0;">Endorsement</a></li>
				            <li><a href="<?php echo $reports; ?>employeeSummary.php?token=<?php echo $repo; ?>" style="color: #c0c0c0;">Employee</a></li>
						</ul>

					<strong><h3>Queries</h3></strong>
					<hr>
						
						<ul>
							<li><a href="<?php echo $queries; ?>query.php?token=<?php echo $query; ?>"style="color: #c0c0c0;"> Queries</a></li>

						</ul>
				
			</div>
			<div class="col-md-3">
				<br />
					<strong><h3>Utilities</h3></strong>
					<hr>
						<ul>
							 <li><a href="<?php echo $utilities; ?>settings.php?token=<?php echo $util; ?>" style="color: #c0c0c0;">Settings</a></li>
						</ul>
				<br /><br />
					<strong><h3>Developers</h3></strong>
					<hr>
						
							<a href="developers.php?token=<?php echo $home; ?>" style="color: #c0c0c0;">View Developers</a>
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