<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
	include('../adminNotifModal.php');
?>

	<div class='container-fluid content'>
		<ul class="breadcrumb">
		    <li>Utilities</li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li><a href="exam.php?token=<?php echo $main; ?>">Exam</a></li>&nbsp;&nbsp;&nbsp;<span class="divider">&raquo;</span>&nbsp;&nbsp;&nbsp;
		    <li class="active">
				Create Exam
 			</li>
		</ul>
	</div>

<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
         $(wrapper).append('<div  class="form-group col-md-12"><div  class="form-group col-md-3"></div><div class="form-group col-md-6"><input type="text" class="form-control" name="name_Choices[]" value="" maxlength="250" required /></div><a href="#" class="remove_field">Remove</a><div  class="form-group col-md-3"></div>'); //add input box
       
	   }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
	
<?php
	//variables
	
	$examSubject = "";
	$examTitle = "";
?>



		<div class="container-fluid">
			<div class="col-md-12 wrapper-background">

				<nav class="navbar nav2 nav navbar-nav">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<li>
							<h3>
								<a href="createExam.php?token=<?php echo $main; ?>" style="margin-left:.5em;">Create Exam</a>
							</h3>
						</li>
					</ul>
					<ul class="nav navbar-nav pull-right">
						<li>
							<a href="exam.php?token=<?php echo $main; ?>" style="margin-top:.2em;"><span class="glyphicon glyphicon-arrow-left"></span> Exam</a>
						</li>
					</ul>
			  	</div>
			</nav>

				<h4 class="alert-info well-lg instruction">Create an exam for a client. Fields with asterisk (*) are required.</h4>
				<br /><br />
		
			<?php
				$subjectName = "";
				$examTitle = "";
										$con = mysql_connect("$db_hostname","$db_username","$db_password");
											if (!$con)
											{
												die('Could not connect: ' . mysql_error());
											}
										
											mysql_select_db("$db_database", $con);
											
											$result = mysql_query("SELECT *
																	FROM tbl_exam
																	LEFT JOIN tbl_subject
																	ON tbl_exam.subjectId = tbl_subject.subjectId
																	WHERE tbl_exam.examId = $_SESSION[ses_examID]
															");
															
											while ($row = mysql_fetch_array($result))
											{
												$subjectName = $row['subjectName'];
												$examTitle = $row['examTitle'];
											}//while
					
			
			?>
			
			<form method="POST" action="../../../config/insertExamQuestion.php">	
			
				
				<div class="form-group col-md-12">
				
					<div class="form-group col-md-3">
					</div>
					
					<div class="form-group col-md-6">
						<label>Subject: </label>
						<input type="text"
								class="form-control" 
								name="examSubject" 
								value='<?php echo $subjectName;?>' 
								maxlength="250" 
								disabled
						/>	  
					</div>
					
					<div class="form-group col-md-3">
					</div>
				</div>
				
				<div class="form-group col-md-12">
				
					<div class="form-group col-md-3">
					</div>
				
					<div class="form-group col-md-6">
						<label>Exam Title:</label>
						<input type="text"
								class="form-control" 
								name="examTitle" 
								value='<?php echo $examTitle?>' 
								maxlength="250"  
								disabled
						/>	  
					</div>
					
					<div class="form-group col-md-3">
					</div>
				</div>

				
				<div class="form-group col-md-12">
				
					<div class="form-group col-md-3">
					</div>
					
					<div class="form-group col-md-6">
						<br /><br />
						<label>Question no. <?php echo $_SESSION['ses_questionCtr']." :*"; ?></label>
						<textarea class="form-control" 
								name="name_Question" 
								value='' 
								cols="6" 
								rows="5"
								placeholder="Type your question here"
								maxlength="1000" required></textarea> 	  
					</div>
					
					<div class="form-group col-md-3">
					</div>
				</div>

				<div class="form-group col-md-12">
				
					<div class="form-group col-md-3">
					</div>
				
					<div class="form-group col-md-6">
					<label>Choices: *</label>
						<input type="text"
								class="form-control" 
								name="name_Choices[]" 
								value='' 
								maxlength="250"   
								required 
						/>
					</div>
					
					<div class="form-group col-md-3">
					</div>
				</div>
				
				<div class="input_fields_wrap">
				</div>
				
				<div class="form-group col-md-2 col-md-offset-8">
					<button type="submit" class="add_field_button btn btn-default">
		      			<span class="glyphicon glyphicon-plus"></span>&nbsp; Add Choices
		      		</button>
				</div>


				<div class="col-md-12"></div>
				


				<div class="col-md-12"><br /><br /></div>

				<div class="form-group col-md-2 col-md-offset-4">
						
						<button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submitAddQuestion" 
								style="margin-top: 2em; ">
							 	<span class="glyphicon glyphicon-plus"></span>&nbsp; Add Another Question &nbsp; &nbsp;
		      			</button>
		      		
		      	</div>

		

				<div class="form-group col-md-2">
						
						<button type="submit" 
								class="btn btn-primary btn-md btn-block"
								name ="submitExamDone" 
								style="margin-top: 2em; ">
							 	Submit &nbsp;
							 <span class="glyphicon glyphicon-check"></span>
		      			</button>
		      		
		      	

	     	</form>
	     </div>	
			
			

			

		</div>
	</div>







	
	



	

<?php
	include ('../footer.php');
?>
