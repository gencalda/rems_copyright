<?php
include ('../../../config/connection.php');
session_start();


date_default_timezone_set("Asia/Manila");
$date = date("Y/m/d");




$appName = '';
$clientID = '';
$clientName = '';
$clientLoc = '';
$jobName = '';
$userName =  '';
$userBasicId = '';


		$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
				
	
				
				
			$resultInfo = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId= $_SESSION[endorsedBasicId]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$appName  = $rowInfo['basicFirstName']." ".$rowInfo['basicMiddleName']." ".$rowInfo['basicLastName'];
				}//while	

				
			$resultInfo = mysql_query("SELECT * FROM tbl_job_posting WHERE jobPostingId= $_SESSION[endorsedJobId]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$jobName  = $rowInfo['jobName'];
						$clientID  = $rowInfo['clientId'];
				}//while	

				
			$resultInfo = mysql_query("SELECT * FROM tbl_client WHERE clientId= $clientID
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$clientName = $rowInfo['clientName'];
				}//while	
				
				
			$resultInfo = mysql_query("SELECT * FROM tbl_address WHERE clientId= $clientID
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$clientLoc = $rowInfo['addBlock']." ".$rowInfo['addStreet']." ".$rowInfo['addSubdivision']." ".$rowInfo['addBarangay'];
						$clientLoc2 = $rowInfo['addDistrict']." ".$rowInfo['addCity'].", ".$rowInfo['addProvince'];
				
				}//while	
				
				
				$resultInfo = mysql_query("SELECT * FROM tbl_user_account WHERE accountId= $_SESSION[login_accountId]
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$userBasicId  = $rowInfo['basicId'];
				}//while
				
				$resultInfo = mysql_query("SELECT * FROM tbl_basic_info WHERE basicId= $userBasicId
								");
										
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$userName = $rowInfo['basicFirstName']." ".$rowInfo['basicMiddleName']." ".$rowInfo['basicLastName'];
				}//while	
				
				$resultInfo = mysql_query("SELECT content_agencyName ,content_agencyAddress FROM tbl_content WHERE contentId = 1
								");					
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$AgencyName  = $rowInfo['content_agencyName'];
						$AgencyAddress  = $rowInfo['content_agencyAddress'];
						$pdfAgencyName  = $rowInfo['content_pdfagencyName'];
				}//while


$mysqli->query("INSERT INTO tbl_endorsement(applicantId, clientId, jobPostingId, endorsementDate, endorsementStatus) VALUES ('$_SESSION[ses_AppID]','$clientID', '$_SESSION[endorsedJobId]', '$date', 'Active')");

$mysqli->query("UPDATE `tbl_applicant` SET `applicantStatus`='Endorsed' WHERE applicantId = $_SESSION[ses_AppID]");

$mysqli->query("INSERT INTO tbl_notification
					(
						notifId,
						clientId,
						applicantId,
						notifDesc, 
						dateCreated,
						notifStatus
					)
					VALUES 
					(
						'',
						'$clientID',
						'$_SESSION[ses_AppID]',
						'was endorsed to your company.',
						now(),
						'new'
					)"
				);

require("fpdf.php");

// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 0, 0, 0 );
$reportName = "ENDORSEMENT SLIP";


// End configuration


/**
  Create the title page
**/
$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();
$pdf->AddFont('BarcodeFont','','BarcodeFont.php');
$pdf->AddFont('Calibri','','Calibri.php');
$pdf->AddFont('Calibri Bold','','Calibri Bold.php');
$pdf->SetFont('Calibri Bold','',14);
$pdf -> SetY(5);
$pdf -> SetX(10.5);
$pdf->Cell(189.5, 155, '', 1,0, 'L', FALSE);

$pdf->SetFont('Calibri Bold','',12);
$pdf -> SetY(8);
$pdf -> SetX(14);
$pdf->Cell(56, 6, $pdfAgencyName, 0, 0, 'L', FALSE);

$pdf -> SetY(6);
$pdf -> SetX(14);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(144,141,141); 
$pdf->Cell(10, 20, 'Powered by getchs;', 0, 0, 'L', FALSE);

$pdf->SetFont('Calibri','',13);
$pdf->SetTextColor(0,0,0); 
$pdf -> SetY(14);
$pdf -> SetX(9.5);
$pdf->Cell(56, 6, '___________________________________________________________________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(17);
$pdf -> SetX(70);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri Bold','',24);
$pdf->Cell(108,25,"ENDORSEMENT SLIP", 0, 'R', FALSE);

$pdf -> SetY(40);
$pdf -> SetX(16);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(56, 6, "Company Name:", 0, 0, 'L', FALSE);

$pdf -> SetY(40);
$pdf -> SetX(50);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',15);
$pdf->Cell(56, 6, $clientName, 0, 0, 'L', FALSE);

$pdf -> SetY(41);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, '________________________________________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(40);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, $clientLoc, 0, 0, 'L', FALSE);

$pdf -> SetY(50);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, '________________________________________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(50);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, $clientLoc2, 0, 0, 'L', FALSE);



$pdf -> SetY(65);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Dear Sir/Madame,', 0, 0, 'L', FALSE);

$pdf -> SetY(75);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'May we respectfully introduce the bearer, Mr/Ms. ', 0, 0, 'L', FALSE);

$pdf -> SetY(85);
$pdf -> SetX(25);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, 'Applicant Name:', 0, 0, 'L', FALSE);

$pdf -> SetY(85);
$pdf -> SetX(60);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',15);
$pdf->Cell(10, 20, $appName, 0, 0, 'L', FALSE);

$pdf -> SetY(92);
$pdf -> SetX(25);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, 'Position:', 0, 0, 'L', FALSE);

$pdf -> SetY(92);
$pdf -> SetX(60);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',15);
$pdf->Cell(10, 20, $jobName, 0, 0, 'L', FALSE);

$pdf -> SetY(105);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Attached are his/her resume and other pertinent data and information for your perusal  that', 0, 0, 'L', FALSE);


$pdf -> SetY(110);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'he or she  will  meet  your  requirements  and  contribute  to  the  growth  of  your  company.', 0, 0, 'L', FALSE);

$pdf -> SetY(115);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Thank you and let us work hand in hand for the success of our partnership.', 0, 0, 'L', FALSE);


$pdf -> SetY(127);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Very truly yours,', 0, 0, 'L', FALSE);


$pdf -> SetY(140);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, '______________________', 0, 0, 'L', FALSE);

$pdf -> SetY(145);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Company Officer', 0, 0, 'L', FALSE);

$pdf -> SetY(140);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, $userName, 0, 0, 'L', FALSE);

$pdf -> SetY(155);
$pdf -> SetX(9);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, '..................................................................................................................................................................................', 0, 0, 'L', FALSE);

$pdf -> SetY(175);
$pdf -> SetX(10.5);
$pdf->Cell(189.5, 100, '', 1,0, 'L', FALSE);

$pdf -> SetY(170);
$pdf -> SetX(85);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri Bold','',20);
$pdf->Cell(108,25,"RETURN SLIP", 0, 'R', FALSE);

$pdf -> SetY(180);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(108,25,"Dear Agency,", 0, 'R', FALSE);

$pdf -> SetY(192);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'This is to inform you that Mr./Ms.  ______________________________ applying for the position of', 0, 0, 'L', FALSE);

$pdf -> SetY(191.5);
$pdf -> SetX(80);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, $appName, 0, 0, 'L', FALSE);

$pdf -> SetY(200);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, '_______________________ has ______________ our evaluation and hereby report back to you for', 0, 0, 'L', FALSE);

$pdf -> SetY(199);
$pdf -> SetX(25);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, $jobName, 0, 0, 'L', FALSE);

$pdf -> SetY(208);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'more details.', 0, 0, 'L', FALSE);

$pdf -> SetY(220);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'Thank You!', 0, 0, 'L', FALSE);

$pdf -> SetY(235);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, '_____________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(240);
$pdf -> SetX(43);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'Interviewer', 0, 0, 'L', FALSE);

$pdf -> SetY(255);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'Date: ________________________', 0, 0, 'L', FALSE);

$pdf->Output();



?>