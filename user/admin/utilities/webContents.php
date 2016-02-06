<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	//include('../adminNotifModal.php');
?>
					<form method="POST" action="../../../config/updateImages.php" enctype="multipart/form-data">
							<div class="col-md-12 wrapper-background">
							<h3>Image Settings</h3>
							<br/>
							<div class="form-group col-md-6">
								<label>Upload Photo Banner:</label>
								<input class="form-control" 
										style="margin:0 auto; "  
										id="uploadImage1" 
										type="file" 
										title="Select Image" 
										name="name_settingBanner" 
										onchange="PreviewImage(1); validateImage()" />
								<br />
								<p>Best banners are with the resolution of 1366x190.</p>
								
								
							</div>
							
								
								<div class="form-group col-md-6">
									<label>Upload Background Image:</label>								
									<input class="form-control" 
											style="margin:0 auto; "  
											id="uploadImage1" 
											type="file" 
											title="Select Image" 
											name="name_settingBackground" 
											onchange="PreviewImage(1); validateImage()" />
									<br />
									<p>Best background images are with the resolution of 1366x768 or higher.</p>
								</div>
								
								
							
							 <button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submit" 
								style="margin-top: 2em; ">
								Submit &nbsp;
							 <span class="glyphicon glyphicon-check"></span>
							 </button>
							</div>
							
						</form>
							