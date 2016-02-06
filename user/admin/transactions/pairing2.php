<?php
	$root = realpath(dirname(__FILE__) . '/../../..');
	include($root . '/include/header.php');
	include($root . '/config/connection.php');
	include ('../adminNav.php'); // native to admin
?>

	<div class='container-fluid content'>

		<ul class="breadcrumb">
			<li>Transactions</li>
			<li><a href="transactionAssessApplicant.php?token=<?php echo $tran; ?>">Assess Applicant</a></li>
			<li class="active">Pairing</li>
		</ul>

	</div>

	
	<div class='container-fluid content'>

		<?php
	$Aid = $_GET['ID'];
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error()); 
	}
	//for the jobs
	mysql_select_db("$db_database", $con);
	$queryfirst = mysql_query("SELECT * FROM appchosenposition WHERE applicantID = $Aid and appChosenPositionRank = 'first'");
	$querysecond = mysql_query("SELECT * FROM appchosenposition WHERE applicantID = $Aid and appChosenPositionRank = 'second'");
	$querythird = mysql_query("SELECT * FROM appchosenposition WHERE applicantID = $Aid and appChosenPositionRank = 'third'");
	$name = mysql_query("SELECT * FROM appinformation WHERE applicantID = $Aid");
	while($row = mysql_fetch_array($name)) 
	{	
		$first= $row['appInfoFirstName'];
		$middle= $row['appInfoMiddleName'];
		$last= $row['appInfoLastName'];
	}
	while($row = mysql_fetch_array($queryfirst)) 
	{	
		$firstjob	= $row['jobPostingID']; 	
	}
	while($row = mysql_fetch_array($querysecond)) 
	{	
		$secondjob	= $row['jobPostingID']; 	
	}
	while($row = mysql_fetch_array($querythird)) 
	{	
		$thirdjob	= $row['jobPostingID']; 	
	}
	
	$fff = $_SESSION['fname'];
	$mmm = $_SESSION['mname'];
	$lll = $_SESSION['lname'];
	$user = $fff.' '.$mmm.' '.$lll;
				$score=0;
				$score2=0;
				$score3=0;
				$result4 = mysql_query("SELECT * FROM jobqualifications, appqualities WHERE jobPostingID = $firstjob and applicantID = $Aid and jobQualifiType = appQualityType and jobQualifiNewlyAddedDesc IS NULL group by jobQualifiID");
				while($row = mysql_fetch_array($result4)) 
				{
					//for any
					if  ($row['jobQualifiDesc']=='any')
					{
						$score=$score+1;
					}
					//for match qualifications
					if  ($row['jobQualifiDesc']==$row['appQualityDesc'])
					{
						$score=$score+1;
					}
					//for height
					if ($row['jobQualifiDesc'] == null && $row['jobQualifiType']=='height')
					{	
						$queryheight=mysql_query("SELECT appQualityDesc FROM appqualities WHERE applicantID = $Aid and appQualityType= 'height'");
						while($row = mysql_fetch_array($queryheight)) 
						{
							$height=$row['appQualityDesc'];
						}
						$queryheighto1= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $firstjob and jobQualifiType= 'height to'");
						while($row = mysql_fetch_array($queryheighto1)) 
						{
							$heighto1=$row['jobQualifiDesc'];
						}
						$queryheightfrom1= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $firstjob and jobQualifiType= 'height from'");
						while($row = mysql_fetch_array($queryheightfrom1)) 
						{
							$heightfrom1=$row['jobQualifiDesc'];
						}
						
						if ($height<$heighto1 && $height>$heightfrom1)
						{
							$score=$score+1;
						}
					}
					//for weight
					if ($row['jobQualifiDesc'] == null && $row['jobQualifiType']=='weight')
					{	
						$queryweight=mysql_query("SELECT appQualityDesc FROM appqualities WHERE applicantID = $Aid and appQualityType= 'weight'");
						while($row = mysql_fetch_array($queryweight)) 
						{
							$weight=$row['appQualityDesc'];
						}
						$queryweighto1= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $firstjob and jobQualifiType= 'weight to'");
						while($row = mysql_fetch_array($queryweighto1)) 
						{
							$weighto1=$row['jobQualifiDesc'];
						}
						$queryweightfrom1= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $firstjob and jobQualifiType= 'weight from'");
						while($row = mysql_fetch_array($queryweightfrom1)) 
						{
							$weightfrom1=$row['jobQualifiDesc'];
						}
						
						if ($weight<$weighto1 && $weight>$weightfrom1)
						{
							$score=$score+1;
						}
					}
					
					
				}
				//for weight
				$queryweight=mysql_query("SELECT appQualityDesc FROM appqualities WHERE applicantID = $Aid and appQualityType= 'weight'");
						while($row = mysql_fetch_array($queryweight)) 
						{
							$weight=$row['appQualityDesc'];
						}	
			
				//for height
				$queryheight=mysql_query("SELECT appQualityDesc FROM appqualities WHERE applicantID = $Aid and appQualityType= 'height'");
						while($row = mysql_fetch_array($queryheight)) 
						{
							$height=$row['appQualityDesc'];
						}
				//for age
				$queryage=mysql_query("SELECT appQualityDesc FROM appqualities WHERE applicantID = $Aid and appQualityType= 'age'");
					while($row = mysql_fetch_array($queryage)) 
					{
						$age=$row['appQualityDesc'];
					}
				
				$queryageto1= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $firstjob and jobQualifiType= 'age to'");
				while($row = mysql_fetch_array($queryageto1)) 
				{
					$ageto1=$row['jobQualifiDesc'];
				}
				
				$queryagefrom1= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $firstjob and jobQualifiType= 'age from'");
				while($row = mysql_fetch_array($queryagefrom1)) 
				{
					$agefrom1=$row['jobQualifiDesc'];
				}
				
				if ($age<=$ageto1 && $age>=$agefrom1)
				{
					$score=$score+1;
				}
				//for score percentage
				$querypercentage= mysql_query("SELECT count(*) as total FROM jobqualifications WHERE jobPostingID = $firstjob and jobQualifiNewlyAddedDesc IS NULL and jobQualifiType != 'age from' and jobQualifiType != 'height from' and jobQualifiType != 'weight from' and jobQualifiType != 'weight to' and jobQualifiType != 'height to'");
				while($row = mysql_fetch_array($querypercentage)) 
				{
					$total=$row['total'];
				}
				$percent = ($score/$total)*100;
				
				//for branch
				$querybranch=mysql_query("SELECT * FROM branch, client, jobposting WHERE $firstjob = jobposting.jobPostingID and jobposting.branchID = branch.branchID");
				while($row = mysql_fetch_array($querybranch)) 
				{
					$branch=$row['branchName'];
					$location=$row['branchLocation'];
				}
				//for job name
				$queryjobname=mysql_query("SELECT jobPostingTitle FROM jobposting WHERE jobPostingID = $firstjob");
				while($row = mysql_fetch_array($queryjobname)) 
				{
					$jobname=$row['jobPostingTitle'];
				}
	
				
				
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
				
				$result3 = mysql_query("SELECT * FROM jobqualifications, appqualities WHERE jobPostingID = $secondjob and applicantID = $Aid and jobQualifiType = appQualityType and jobQualifiNewlyAddedDesc IS NULL group by jobQualifiID");
				while($row = mysql_fetch_array($result3)) 
				{
					//for any
					if  ($row['jobQualifiDesc']=='any')
					{
						$score2=$score2+1;
					}
					//for match qualifications
					if  ($row['jobQualifiDesc']==$row['appQualityDesc'])
					{
						$score2=$score2+1;
					}
					//for height
					if ($row['jobQualifiDesc'] == null && $row['jobQualifiType']=='height')
					{	
						
						$queryheighto2= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $secondjob and jobQualifiType= 'height to'");
						while($row = mysql_fetch_array($queryheighto2)) 
						{
							$heighto2=$row['jobQualifiDesc'];
						}
						$queryheightfrom2= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $secondjob and jobQualifiType= 'height from'");
						while($row = mysql_fetch_array($queryheightfrom2)) 
						{
							$heightfrom2=$row['jobQualifiDesc'];
						}
						
						if ($height<$heighto2 && $height>$heightfrom2)
						{
							$score2=$score2+1;
						}
					}
					//for weight
					if ($row['jobQualifiDesc'] == null && $row['jobQualifiType']=='weight')
					{	
						$queryweighto2= mysql_query("SELECT jobQualifiDesc FROM jobqualifications WHERE jobPostingID = $secondjob and jobQualifiType= 'weight to'");
						while($row = mysql_fetch_array($queryweighto2)) 
						{
							$weighto2=$row['jobQualifiDesc'];
						}
						$queryweightfrom2= mysql_query("SELECT jobQualifiDesc FROM jobqualifications WHERE jobPostingID = $secondjob and jobQualifiType= 'weight from'");
						while($row = mysql_fetch_array($queryweightfrom2)) 
						{
							$weightfrom2=$row['jobQualifiDesc'];
						}
						
						if ($weight<$weighto2 && $weight>$weightfrom2)
						{
							$score2=$score2+1;
						}
					}
					
					
				}
				//for age
				$queryageto2=mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $secondjob and jobQualifiType= 'age to'");
				while($row = mysql_fetch_array($queryageto2)) 
				{
					$ageto2=$row['jobQualifiDesc'];
				}
				
				$queryagefrom2= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $secondjob and jobQualifiType= 'age from'");
				while($row = mysql_fetch_array($queryagefrom2)) 
				{
					$agefrom2=$row['jobQualifiDesc'];
				}
				
				if ($age<=$ageto2 && $age>=$agefrom2)
				{
					$score2=$score2+1;
				}
				//for score percentage
				$querypercentage2= mysql_query("SELECT count(*) as total FROM jobqualifications WHERE jobPostingID = $secondjob and jobQualifiNewlyAddedDesc IS NULL and jobQualifiType != 'age from' and jobQualifiType != 'height from' and jobQualifiType != 'weight from' and jobQualifiType != 'weight to' and jobQualifiType != 'height to'");
				while($row = mysql_fetch_array($querypercentage2)) 
				{
					$total2=$row['total'];
				}
				$percent2 = ($score2/$total2)*100;
				
				//for branch
				$querybranch2=mysql_query("SELECT * FROM branch, client, jobposting WHERE $secondjob = jobposting.jobPostingID and jobposting.branchID = branch.branchID");
				while($row = mysql_fetch_array($querybranch2)) 
				{
					$branch2=$row['branchName'];
					$location2=$row['branchLocation'];
				}
				//for job name
				$queryjobname2=mysql_query("SELECT jobPostingTitle FROM jobposting WHERE jobPostingID = $secondjob");
				while($row = mysql_fetch_array($queryjobname2)) 
				{
					$jobname2=$row['jobPostingTitle'];
				}
		
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
				$result2 = mysql_query("SELECT * FROM jobqualifications, appqualities WHERE jobPostingID = $thirdjob and applicantID = $Aid and jobQualifiType = appQualityType and jobQualifiNewlyAddedDesc IS NULL group by jobQualifiID");
				while($row = mysql_fetch_array($result2)) 
				{
					//for any
					if  ($row['jobQualifiDesc']=='any')
					{
						$score3=$score3+1;
					}
					//for match qualifications
					if  ($row['jobQualifiDesc']==$row['appQualityDesc'])
					{
						$score3=$score3+1;
					}
					//for height
					if ($row['jobQualifiDesc'] == null && $row['jobQualifiType']=='height')
					{	
						
						$queryheighto3= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $thirdjob and jobQualifiType= 'height to'");
						while($row = mysql_fetch_array($queryheighto2)) 
						{
							$heighto3=$row['jobQualifiDesc'];
						}
						$queryheightfrom3= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $thirdjob and jobQualifiType= 'height from'");
						while($row = mysql_fetch_array($queryheightfrom2)) 
						{
							$heightfrom3=$row['jobQualifiDesc'];
						}
						
						if ($height<$heighto3 && $height>$heightfrom3)
						{
							$score3=$score3+1;
						}
					}
					//for weight
					if ($row['jobQualifiDesc'] == null && $row['jobQualifiType']=='weight')
					{	
						$queryweighto3= mysql_query("SELECT jobQualifiDesc FROM jobqualifications WHERE jobPostingID = $thirdjob and jobQualifiType= 'weight to'");
						while($row = mysql_fetch_array($queryweighto3)) 
						{
							$weighto3=$row['jobQualifiDesc'];
						}
						$queryweightfrom3= mysql_query("SELECT jobQualifiDesc FROM jobqualifications WHERE jobPostingID = $thirdjob and jobQualifiType= 'weight from'");
						while($row = mysql_fetch_array($queryweightfrom3)) 
						{
							$weightfrom3=$row['jobQualifiDesc'];
						}
						
						if ($weight<$weighto3 && $weight>$weightfrom3)
						{
							$score3=$score3+1;
						}
					}
					
					
				}
				//for age
				$queryageto3=mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $thirdjob and jobQualifiType= 'age to'");
				while($row = mysql_fetch_array($queryageto3)) 
				{
					$ageto3=$row['jobQualifiDesc'];
				}
				
				$queryagefrom3= mysql_query("SELECT jobQualifiDesc  FROM jobqualifications WHERE jobPostingID = $thirdjob and jobQualifiType= 'age from'");
				while($row = mysql_fetch_array($queryagefrom3)) 
				{
					$agefrom3=$row['jobQualifiDesc'];
				}
				
				if ($age<=$ageto3 && $age>=$agefrom3)
				{
					$score3=$score3+1;
				}
				//for score percentage
				$querypercentage3= mysql_query("SELECT count(*) as total FROM jobqualifications WHERE jobPostingID = $thirdjob and jobQualifiNewlyAddedDesc IS NULL and jobQualifiType != 'age from' and jobQualifiType != 'height from' and jobQualifiType != 'weight from' and jobQualifiType != 'weight to' and jobQualifiType != 'height to'");
				while($row = mysql_fetch_array($querypercentage3)) 
				{
					$total3=$row['total'];
				}
				$percent3 = ($score3/$total3)*100;
				
				//for branch
				$querybranch3=mysql_query("SELECT * FROM branch, client, jobposting WHERE $thirdjob = jobposting.jobPostingID and jobposting.branchID = branch.branchID");
				while($row = mysql_fetch_array($querybranch3)) 
				{
					$branch3=$row['branchName'];
					$location3=$row['branchLocation'];
				}
				//for job name
				$queryjobname3=mysql_query("SELECT jobPostingTitle FROM jobposting WHERE jobPostingID = $thirdjob");
				while($row = mysql_fetch_array($queryjobname3)) 
				{
					$jobname3=$row['jobPostingTitle'];
				}
		


?>
		
	</div>

	<nav class="navbar nav2">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><h4> &nbsp; Percentages and Jobs are based on the applicant's qualifications and job preferences.</h4></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="viewApplication.php"><span class="glyphicon glyphicon-th-list"> </span> View Application Form</a></li>
			</ul>
	  	</div>
	</nav>


	<div class="container ">
		<br />
		<h2>
			<?php
				$aname = $first.' '.$middle.' '.$last;
				echo "$first $middle $last";
			?>
		</h2>
	</div>


	<div class="well well-lg col-md-4 section">
		<?php
			echo "<br />";
			if($percent>=60)
			{
				echo"<h1 style='color:green'> ".round($percent,2)."%</h1>";
			}
			else if ($percent<=60)
			{
				echo"<h1 style='color:red'> ".round($percent,2)."%</h1>";
			}
			echo"<h3>".$jobname."</h3>";
			echo"<h3>".$branch."</h3>";
			$address = $location;
			echo"<h5>".$address."</h5>"
		?>
		
		<form target="_blank" action="fpdf/report3.php" method="POST">
			<input type="hidden" name="branch" value= "<?php echo "$branch"?>" >
			<input type="hidden" name="location" value= "<?php echo "$location"?>" >
			<input type="hidden" name="first" value= <?php echo "$first"?> >
			<input type="hidden" name="middle" value= <?php echo "$middle"?> >
			<input type="hidden" name="last" value= <?php echo "$last"?> >
			<input type="hidden" name="job" value= <?php echo "$jobname"?>>
			<input type="hidden" name="fff" value= <?php echo "$fff"?>>
			<input type="hidden" name="mmm" value= <?php echo "$mmm"?>>
			<input type="hidden" name="lll" value= <?php echo "$lll"?>>
			<input type="hidden" name="Aid" value= <?php echo "$Aid"?>>
			<input type="hidden" name="jobid" value= <?php echo "$firstjob"?>>
			<input type="hidden" name="bname" value= <?php echo "$branch2"?>>
			<input type="hidden" name="jname" value= <?php echo "$jobname2"?>>
			<!--<input type="submit" name="ok3" value="Endorse"> -->
			<br />
			<?php
				if($percent >= 60)
				{
					echo "<button type='submit' name='ok3' class='btn btn-success'>
	 						<span class='glyphicon glyphicon-ok'></span> Endorse
    						</button>" ;
    			}
    			else
    			{
    				echo "<br /><br />";
    			}

    		?>
		</form>
	</div>

	<div class="well well-lg col-md-4 section">
		<h1>
			<?php
			if($percent2>=60)
			{
				echo"<h1 style='color:green'> ".round($percent2,2)."%</h1>";
			}
			else if ($percent2<=60)
			{
				echo"<h1 style='color:red'> ".round($percent2,2)."%</h1>";
			}
			echo"<h3>".$jobname2."</h3>";
			echo"<h3>".$branch2."</h3>";
			$address2 = $location2;
			echo"<h5>".$location2."</h5>"
		?>
		</h1>
		<form target="_blank" action="fpdf/report2.php" method="POST">
			<input type="hidden" name="branchh" value= "<?php echo "$branch2"?>" >
			<input type="hidden" name= "locationn" value = "<?php echo "$location2" ?>" >
			<input type="hidden" name="first2" value= <?php echo "$first"?> >
			<input type="hidden" name="middle2" value= <?php echo "$middle"?> >
			<input type="hidden" name="last2" value= <?php echo "$last"?> >
			<input type="hidden" name="job2" value= <?php echo "$jobname2"?>>
			<input type="hidden" name="fff" value= <?php echo "$fff"?>>
			<input type="hidden" name="mmm" value= <?php echo "$mmm"?>>
			<input type="hidden" name="lll" value= <?php echo "$lll"?>>
			<input type="hidden" name="Aid" value= <?php echo "$Aid"?>>
			<input type="hidden" name="jobid2" value= <?php echo "$secondjob"?>>
			<input type="hidden" name="bname2" value= <?php echo "$branch2"?>>
			<input type="hidden" name="jname2" value= <?php echo "$jobname2"?>>
			<!--<input type="submit" name="ok3" value="Endorse"> -->
			<br />
			<?php
				if($percent2 >= 60)
				{
					echo "<button type='submit' name='ok3' class='btn btn-success'>
	 						<span class='glyphicon glyphicon-ok'></span> Endorse
    						</button>" ;
    			}
    			else
    			{
    				echo "<br /><br />";
    			}

    		?>
		</form>
	</div>

	<div class="well well-lg col-md-4 section">
		<h1>
			<?php
				if($percent3>=60)
				{
					echo"<h1 style='color:green'> ".round($percent3,2)."%</h1>";
				}
				else if ($percent3<=60)
				{
					echo"<h1 style='color:red'> ".round($percent3,2)."%</h1>";
				}
				echo"<h3>".$jobname3."</h3>";
				echo"<h3>".$branch3."</h3>";
				$address3 = $location3;
				echo"<h5>".$address3."</h5>"
		?>
		</h1>
		
		<form target="_blank" action="fpdf/report.php" method="POST">
			<input type="hidden" name="branch3" value= "<?php echo "$branch3"?>" >
			<input type="hidden" name="location3" value= "<?php echo "$location3"?>" >
			<input type="hidden" name="first3" value= <?php echo "$first"?> >
			<input type="hidden" name="middle3" value= <?php echo "$middle"?> >
			<input type="hidden" name="last3" value= <?php echo "$last"?> >
			<input type="hidden" name="job3" value= <?php echo "$jobname3"?>>
			<input type="hidden" name="fff" value= <?php echo "$fff"?>>
			<input type="hidden" name="mmm" value= <?php echo "$mmm"?>>
			<input type="hidden" name="lll" value= <?php echo "$lll"?>>
			<input type="hidden" name="Aid" value= <?php echo "$Aid"?>>
			<input type="hidden" name="jobid3" value= <?php echo "$thirdjob"?>>
			<input type="hidden" name="bname3" value= <?php echo "$branch3"?>>
			<input type="hidden" name="jname3" value= <?php echo "$jobname3"?>>
			<!--<input type="submit" name="ok3" value="Endorse">-->
			<br />
			<?php
				if($percent3 >= 60)
				{
					echo "<button type='submit' name='ok3' class='btn btn-success'>";
	 				echo "<span class='glyphicon glyphicon-ok'></span> Endorse";
    				echo "</button>" ;
    			}
    			else
    			{
    				echo "<br /><br />";
    			}

    		?>
		</form>
	</div>
	<br /><br /><br />
<?php
	include ('../footer.php');
?>