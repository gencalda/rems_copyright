<?php
session_start();
require('fpdf.php');
	$db_hostname = 'localhost';
		// web server hostname
	$db_database = 'remsdb';
		// database used 
	$db_username = 'root';
		// phpmyadmin username
	$db_password = '';
		// phpmyadmin password
		
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
	
	$mysqli = new mysqli($db_hostname, $db_username, $db_password, $db_database);
$name = $_SESSION['Name'];
$age = $_SESSION['age'];
$bday = $_SESSION['bday'];
$gender = $_SESSION['gender'];
$first = $_SESSION['first'];
$second = $_SESSION['second'];
$third = $_SESSION['third'];
$app = $_SESSION['appID'];
$endDate = $_SESSION['to1'];


if($app>9)
{
	$newapp="00".$app;
}
else if($app>99)
{
	$newapp="0".$app;
}
else 
{
	$newapp = $app;
}
$appfinal= date("Y - m")." - ".$newapp;
$date= date("m/d/Y");
$mysqli->query("UPDATE tbl_applicant SET 
					applicantVoucherCode = '$appfinal'
					WHERE applicantId = '$app' 
					");
$resultInfo = mysql_query("SELECT content_agencyName ,content_agencyAddress, content_pdfagencyName FROM tbl_content WHERE contentId = 1
								");					
while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$AgencyName  = $rowInfo['content_agencyName'];
						$AgencyAddress  = $rowInfo['content_agencyAddress'];
						$pdfAgencyName  = $rowInfo['content_pdfagencyName'];
				}//while

$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();
$pdf->AddFont('BarcodeFont','','BarcodeFont.php');
$pdf->AddFont('Calibri','','Calibri.php');
$pdf->AddFont('Calibri Bold','','Calibri Bold.php');
$pdf->SetFont('Calibri Bold','',11);
$pdf -> SetX(16);
$pdf->Cell(56, 6, $pdfAgencyName, 0, 0, 'L', FALSE);

$pdf -> SetY(9);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(144,141,141); 
$pdf->Cell(10, 20, 'Powered by getchs;', 0, 0, 'L', FALSE);

$pdf -> SetY(18);
$pdf -> SetX(148);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('BarcodeFont','',54);
$pdf->Cell(108,25,$appfinal, 0, 'R', FALSE);

$pdf -> SetY(30);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri Bold','',24);
$pdf->Cell(56, 6, "Applicant's Copy", 0, 0, 'L', FALSE);

$pdf -> SetY(34);
$pdf -> SetX(16);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Date of Application:', 0, 0, 'L', FALSE);

$pdf -> SetY(34);
$pdf -> SetX(55);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20,$date , 0, 0, 'L', FALSE);


$pdf -> SetY(4);
$pdf -> SetX(153);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, 'Application Code', 0, 0, 'L', FALSE);

$pdf -> SetY(32);
$pdf -> SetX(148);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(108,25,"Exam Code:", 0, 'R', FALSE);

$pdf -> SetY(38);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',13);
$pdf->SetTextColor(144,141,141);
$pdf->Cell(10, 20, '______________________________________________________________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(46);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Name:', 0, 0, 'L', FALSE);

$pdf -> SetY(46);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $name , 0, 0, 'L', FALSE);

$pdf -> SetY(56);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Birthday:', 0, 0, 'L', FALSE);

$pdf -> SetY(56);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $bday , 0, 0, 'L', FALSE);

$pdf -> SetY(61);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Age:', 0, 0, 'L', FALSE);


$pdf -> SetY(61);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $age , 0, 0, 'L', FALSE);

$pdf -> SetY(66);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Gender:', 0, 0, 'L', FALSE);

$pdf -> SetY(66);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $gender , 0, 0, 'L', FALSE);

$pdf -> SetY(56);
$pdf -> SetX(100);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'First Choice:', 0, 0, 'L', FALSE); 

$pdf -> SetY(56);
$pdf -> SetX(130);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $first , 0, 0, 'L', FALSE);

$pdf -> SetY(61);
$pdf -> SetX(100);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Second Choice:', 0, 0, 'L', FALSE);

$pdf -> SetY(61);
$pdf -> SetX(130);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $second , 0, 0, 'L', FALSE);

$pdf -> SetY(66);
$pdf -> SetX(100);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Third Choice:', 0, 0, 'L', FALSE);

$pdf -> SetY(66);
$pdf -> SetX(130);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $third , 0, 0, 'L', FALSE);

$pdf -> SetY(71);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',13);
$pdf->SetTextColor(144,141,141);
$pdf->Cell(10, 20, '______________________________________________________________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(80);
$pdf -> SetX(16);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'This is your copy. Keep this in safe place. You may now report to', 0, 0, 'L', FALSE);

$pdf -> SetY(80);
$pdf -> SetX(128);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri Bold','',11);
$pdf->Cell(10, 20, $AgencyName, 0, 0, 'L', FALSE);

$pdf -> SetY(86);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri Bold','',11);
$pdf->Cell(10, 20, $AgencyAddress, 0, 0, 'L', FALSE);

$pdf -> SetY(86);
$pdf -> SetX(124);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'for your interview until', 0, 0, 'L', FALSE);

$pdf -> SetY(86);
$pdf -> SetX(165);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri bold','',11);
$pdf->Cell(10, 20, $endDate, 0, 0, 'L', FALSE);

$pdf -> SetY(92);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Three days after your Date of application. Not Including Saturday and Sunday.', 0, 0, 'L', FALSE);

$pdf -> SetY(98);
$pdf -> SetX(16);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'I expressly agree to the Term of Use, have read  and  understand  the  Private Policy, and confirm that', 0, 0, 'FJ', FALSE);

$pdf -> SetY(104);
$pdf -> SetX(16);
$pdf->Cell(10, 20, 'the  information  I  have  provided  to  REMS  Recruitment  Agency are  true  and  correct  to  the  best', 0, 0, 'FJ', FALSE);

$pdf -> SetY(110);
$pdf -> SetX(16);
$pdf->Cell(10, 20, 'of my  knowledge. My  submission  of  this  form will constitute  my consent  to the collection and use', 0, 0, 'FJ', FALSE);

$pdf -> SetY(116);
$pdf -> SetX(16);
$pdf->Cell(10, 20, 'of  my  information  and  the  transfer of  my  information  for  processing  and storage  by  the  REMS', 0, 0, 'FJ', FALSE);

$pdf -> SetY(122);
$pdf -> SetX(16);
$pdf->Cell(10, 20, "Recruitment  Agency. Furthermore,  I  agree  and  understand  that  I  am  legally  responsible  for  the " , 0, 0, 'FJ', FALSE);

$pdf -> SetY(128);
$pdf -> SetX(16);
$pdf->Cell(10, 20, "information  I  entered  in  REMS: Recruitment and Employee Monitoring System  and  if  I  violate  its ", 0, 0, 'FJ', FALSE);

$pdf -> SetY(134);
$pdf -> SetX(16);
$pdf->Cell(10, 20, "Terms and Services my application may be revoked or I will be subjected to Disciplinary Action.", 0, 0, 'FJ', FALSE);

$pdf -> SetY(148);
$pdf -> SetX(21);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, "Applicant's Signature:", 0, 0, 'L', FALSE);

$pdf -> SetY(153);
$pdf -> SetX(65);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',14);
$pdf->Cell(118, 10, "", 1, 0, 'L', FALSE);

$pdf -> SetY(158);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',13);
$pdf->SetTextColor(144,141,141);
$pdf->Cell(10, 20, '______________________________________________________________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(170);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, '- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - Cut Here - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -', 0, 0, 'L', FALSE);

$pdf->SetFont('Calibri Bold','',14);
$pdf -> SetY(189);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(56, 6, $pdfAgencyName, 0, 0, 'L', FALSE);

$pdf -> SetY(188);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(144,141,141); 
$pdf->Cell(10, 20, 'Powered by getchs;', 0, 0, 'L', FALSE);

$pdf -> SetY(183);
$pdf -> SetX(153);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',13);
$pdf->Cell(10, 20, 'Application Code', 0, 0, 'L', FALSE);

$pdf -> SetY(198);
$pdf -> SetX(148);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('BarcodeFont','',54);
$pdf->Cell(108,25, $appfinal, 0, 'R', FALSE);

$pdf -> SetY(209);
$pdf -> SetX(16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri Bold','',24);
$pdf->Cell(56, 6, "Agency's Copy", 0, 0, 'L', FALSE);

$pdf -> SetY(212);
$pdf -> SetX(16);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20, 'Date of Application:', 0, 0, 'L', FALSE);

$pdf -> SetY(212);
$pdf -> SetX(55);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(10, 20,$date , 0, 0, 'L', FALSE);

$pdf -> SetY(210);
$pdf -> SetX(148);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',12);
$pdf->Cell(108,25,"Exam Code:", 0, 'R', FALSE);

$pdf -> SetY(214);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',13);
$pdf->SetTextColor(144,141,141);
$pdf->Cell(10, 20, '______________________________________________________________________________', 0, 0, 'L', FALSE);

$pdf -> SetY(222);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Name:', 0, 0, 'L', FALSE);

$pdf -> SetY(222);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $name , 0, 0, 'L', FALSE);

$pdf -> SetY(234);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Birthday:', 0, 0, 'L', FALSE);

$pdf -> SetY(234);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $bday , 0, 0, 'L', FALSE);

$pdf -> SetY(241);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Age:', 0, 0, 'L', FALSE);

$pdf -> SetY(241);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $age , 0, 0, 'L', FALSE);

$pdf -> SetY(248);
$pdf -> SetX(20);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Gender:', 0, 0, 'L', FALSE);

$pdf -> SetY(248);
$pdf -> SetX(35);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $gender , 0, 0, 'L', FALSE);

$pdf -> SetY(234);
$pdf -> SetX(100);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'First Choice:', 0, 0, 'L', FALSE); 

$pdf -> SetY(234);
$pdf -> SetX(130);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $first , 0, 0, 'L', FALSE);

$pdf -> SetY(241);
$pdf -> SetX(100);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Second Choice:', 0, 0, 'L', FALSE);

$pdf -> SetY(241);
$pdf -> SetX(130);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $second , 0, 0, 'L', FALSE);

$pdf -> SetY(248);
$pdf -> SetX(100);
$pdf->SetTextColor(144,141,141);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, 'Third Choice:', 0, 0, 'L', FALSE);

$pdf -> SetY(248);
$pdf -> SetX(130);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Calibri','',11);
$pdf->Cell(10, 20, $third , 0, 0, 'L', FALSE);

$pdf -> SetY(256);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',13);
$pdf->SetTextColor(144,141,141);
$pdf->Cell(10, 20, '______________________________________________________________________________', 0, 0, 'L', FALSE);

$pdf->AddPage();
$pdf -> SetY(9);
$pdf -> SetX(16);
$pdf->SetFont('Calibri Bold','',13);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'KEEP A PERSONAL COPY OF THIS VOUCHER FOR FUTURE REFERENCE.', 0, 0, 'L', FALSE);

$pdf -> SetY(18);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',13);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'Checklist: What to do next?', 0, 0, 'L', FALSE);

$pdf -> SetY(24);
$pdf -> SetX(16);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10, 20, 'We are providing you with this checklist on what to do next. Follow these instructions to complete your recruitment process.', 0, 0, 'L', FALSE);

$pdf -> SetY(43);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '',1 , 0, 'L', FALSE);

$pdf -> SetY(43);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, 'Print this document and present it to the Human Resource Department upon your scheduled interview.',0 , 0, 'L', FALSE);

$pdf -> SetY(50);
$pdf -> SetX(25);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '',1 , 0, 'L', FALSE);

$pdf -> SetY(50);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, 'Requirements Check List',0 , 0, 'L', FALSE);

$pdf -> SetY(60);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] 2 pcs. 2 x 2 ID Pictures (Colored)',0 , 0, 'L', FALSE);

$pdf -> SetY(70);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] NBI Clearance (Original)/ Police Clearance (Original)' ,0 , 0, 'L', FALSE);

$pdf -> SetY(80);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] Employment Certificate of Past Work (Xerox)',0 , 0, 'L', FALSE);

$pdf -> SetY(90);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] SSS Number / E1 Form (Xerox)',0 , 0, 'L', FALSE);

$pdf -> SetY(100);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] Philhealth Number / MDR/ID (Xerox)',0 , 0, 'L', FALSE);

$pdf -> SetY(110);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] Pag Ibig Number / ID (Xerox)',0 , 0, 'L', FALSE);

$pdf -> SetY(120);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] Brgy. Clearance (Original)',0 , 0, 'L', FALSE);

$pdf -> SetY(130);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] Drivers License(Xerox)',0 , 0, 'L', FALSE);

$pdf -> SetY(140);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] Birth Certificate-NS0 (Xerox)',0 , 0, 'L', FALSE);

$pdf -> SetY(150);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] Transcript of Record / TOR (Xerox)/ High Schoo Diploma',0 , 0, 'L', FALSE);

$pdf -> SetY(160);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] White Long Folder',0 , 0, 'L', FALSE);

$pdf -> SetY(170);
$pdf -> SetX(30);
$pdf->SetFont('Calibri','',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(3, 3, '[  ] 1 pc. Long Envelop )',0 , 0, 'L', FALSE);


$pdf->Output();

?>