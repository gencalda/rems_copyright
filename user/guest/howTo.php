<?php
	ob_start();
	$root = realpath(dirname(__FILE__) . '/../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('guestNav.php'); // native to admin

	if(!isset($tab))
	{
		$tab = $_GET['token'];
	}
	else
	{
		header('Location: index.php?token='.$home.'');
	}	
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li><a href="iApply.php?token=<?php echo $home?>">Quick Help</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
		    	<?php
					if($tab == md5('pdf'))
					{
						echo "How to convert Your Resume to PDF?";
					}
					else if($tab == md5('image'))
					{
						echo "How to check if I have a valid Picture File Format?";
					}
					else if($tab == md5('terms'))
					{
						echo "Terms of Use";
					}
					else if($tab == md5('failed'))
					{
						echo "Oops! Operation Failed";
					}
				?>
		    </li>
		</ul>
	</div>

	<div style="float:left; position:fixed; z-index:3">
		<br /><br />
		<a href="howTo.php?token=<?php echo $pdf?>" style="text-align:center;" class="tooltip-right" data-tooltip="PDF">
			<button type="button" 
				class="btn btn-default btn-md btn-block"
			
				style="border-radius: 0em;" 
				>
				<span class="glyphicon glyphicon-file"></span>
			</button>
		</a>
	<br /><br />

		<a href="howTo.php?token=<?php echo $image?>" style="text-align:center;" class="tooltip-right" data-tooltip="Image">
			<button type="button" 
				class="btn btn-default btn-md btn-block"
			
				style="border-radius: 0em;" 
				>
				<span class="glyphicon glyphicon-picture"></span>
			</button>
		</a>
	<br /><br />
		<a href="howTo.php?token=<?php echo $terms?>" id="btnTerms" style="text-align:center;" class="tooltip-right" data-tooltip="Terms of Use">
			<button type="button" 
				class="btn btn-default btn-md btn-block"
			
				style="border-radius: 0em;" 
				>
				<span class="glyphicon glyphicon-th-list"></span> 
			</button>
		</a>
	<br /><br />
		<a href="howTo.php?token=<?php echo $failed?>" id="btnFailed" style="text-align:center;" class="tooltip-right" data-tooltip="Operation Failed">
			<button type="button" 
				class="btn btn-default btn-md btn-block"
			
				style="border-radius: 0em;" 
				>
				<span class="glyphicon glyphicon-remove"></span> 
			</button>
		</a>
		
		
	</div>

	<div class="container-fluid col-md-12 content">		
			<div id="welcome" class="container alert alert-info  col-md-12" style="margin-bottom: 10em; margin-top: 2em;">	
				<br /><br />
				<h3 class="center">
						<?php
							if($tab == md5('pdf'))
							{
								echo "How to convert Your Resume to PDF?";
							}
							else if($tab == md5('image'))
							{
								echo "How to  check if I have a valid Picture File Format?";
							}
							else if($tab == md5('terms'))
							{
								echo "Terms of Use";
							}
							else if($tab == md5('failed'))
							{
								echo "Operation Failed";
							}
							else
							{
								header("Location: iApply.php?token=$home");
							}
						?>
				</h3>
				<br /><br />
			</div>

			<?php
				if($tab == md5('pdf'))
				{
			?>
					<div class="container well well-lg col-md-8 col-md-offset-2">	
						<h2>
							Step 1. Complete
						</h2>
						<h3>
							Make sure you have accomplished your resume.
						</h3>
						<br />
						<img src="../../image/resumeStep1.png" width="100%" class="img-responsive img-rounded">
						
					</div>
					<div class="container well well-lg col-md-8 col-md-offset-2">	
						<h2>
							Step 2. Export
						</h2>
						<h3>
							On the upper left corner. Click "File"
						</h3>
						<br />
						<img src="../../image/resumeStep2.png" width="100%" class="img-responsive img-rounded">
						<br />
						<h3>
							A navigation bar will appear. <br />
							Select "Export" then click "Create PDF/XPS"
						</h3>
						<br />
						<img src="../../image/resumeStep3.png" width="100%" class="img-responsive img-rounded">
						
					</div>
					<div class="container well well-lg col-md-8 col-md-offset-2">	
						<h2>
							Step 3. Publish
						</h2>
						<h3>
							After clicking, a publish dialog box will appear. <br />
							Type your name as the "file name", make sure the type is "PDF" and then click "Publish" button
							to save it to the location/folder where you could easily find it.
						</h3>
						<br />
						<img src="../../image/resumeStep4.png" width="100%" class="img-responsive img-rounded">
						
					</div>
					<div class="container well well-lg col-md-8 col-md-offset-2">	
						<h2>
							Here is a sample of a resume converted to PDF.
						</h2>
						<br />
						 <embed src="../../file/delacruz.juancarlos.pdf" width="100%" height="1000em;"></embed>
						
					</div>

				</div>
		<?php
			}
			if($tab == md5('image'))
			{
		?>
			<div class="container well well-lg col-md-8 col-md-offset-2">	
				<h2>
					Step 1. Find your picture
				</h2>
				<h3>
					Whenever you upload your image, the system will automatically detect if your image is
					with the valid format.
				</h3>
				<br />
				<img src="../../image/imageStep1.png" width="100%" class="img-responsive img-rounded">
				
			</div>
			<div class="container well well-lg col-md-8 col-md-offset-2">	
				<h2>
					Step 2. Error
				</h2>
				<h3>
					If you have uploaded with an invalid format, an alert message will appear.
				</h3>
				<p>In this example. An error occured because the file format is ".php"</p>
				<br />
				<img src="../../image/imageStep2.png" width="100%" class="img-responsive img-rounded">
				
			</div>
			<div class="container well well-lg col-md-8 col-md-offset-2">	
				<h2>
					Step 3. Check
				</h2>
				<h3>
					To check what your image format is...
				</h3>
				<p>Go to the folder where your picture is saved.</p>
				<br />
				<img src="../../image/imageStep5.png" width="100%" class="img-responsive img-rounded">
				
			</div>
			<div class="container well well-lg col-md-8 col-md-offset-2">	
				<h2>
					Step 4. Right Click
				</h2>
				<p>Right click on the Image and select "Properties"</p>
				<br />
				<img src="../../image/imageStep6.png" width="100%" class="img-responsive img-rounded">
				
			</div>
			<div class="container well well-lg col-md-8 col-md-offset-2">	
				<h2>
					Step 5. Properties
				</h2>
				<h3>A dialog box will appear</h3>
				<p>You can now check the image file format beside the "Type of File".</p>
				<p>Allowed file formats for uploading are .jpg, .jpeg, .png, .gif</p>
				<br />
				<center>
					<img src="../../image/imageStep7.png" width="40%" class="img-responsive img-rounded">
				</center>
				
			</div>
			<div class="col-md-12">
			</div>	
		<?php
			}
			if($tab == md5('terms'))
			{
		?>
				<div class="container well well-lg col-md-8 col-md-offset-2">	
					<pre style="font-size:1.3em; text-align: center;">
						<?php
							$fh = fopen("../../file/termsOfUse.txt", 'r') or
							die("File does not exist or you lack permission to open it");
							$text = fread($fh, 30000);
							fclose($fh);
							echo $text;
						?>
					</pre>
				</div>

		<?php
			}
			if($tab == md5('failed'))
			{
		?>
		
				<div class="container alert alert-danger col-md-8 col-md-offset-2" style="margin-bottom:8em;">	
						<h2>
							Operation Failed
						</h2>
						<h3>
							The operation failed because you are trying to log in using an unregistred account.
							Please log in using the username and password emailed to you.
						</h3>
						<br />
						<!--<img src="../../image/resumeStep4.png" width="100%" class="img-responsive img-rounded">-->
					</div>
				
		<?php
			}
		?>
		</div>	
	</div>
<?php
	include ('footer.php');
?>	