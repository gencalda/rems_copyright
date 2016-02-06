<?php
session_start();
$root = realpath(dirname(__FILE__) . '/../../..');
include($root . '/config/connection.php');
require('mysql_table.php');
		
	$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
	$resultInfo = mysql_query("SELECT content_agencyName ,content_agencyAddress, content_pdfagencyName FROM tbl_content WHERE contentId = 1
								");					
while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$AgencyName  = $rowInfo['content_agencyName'];
						$AgencyAddress  = $rowInfo['content_agencyAddress'];
						$pdfAgencyName  = $rowInfo['content_pdfagencyName'];
				}//while
$date= date("m/d/Y");

class PDF extends PDF_MySQL_Table
{
	function Header()
	{
		
		

		
		//Ensure table header is output
		parent::Header();
	}
	
}

//Connect to database
mysql_connect("$db_hostname","$db_username","$db_password");
mysql_select_db('remsdb');


$pdf=new PDF("L", "mm", array(400,200));
$pdf->AddPage();
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times','B',16);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times','B',15);
$pdf->SetY(8);
$pdf->SetX(10);
$pdf->Cell(0,3,$pdfAgencyName,0,1,'L');

$pdf->Ln(5);
$pdf->SetFont('Times','B',12);

$pdf->Cell(0,3,"Powered by Getchs;",0,1,'L');
$pdf->SetFont('Times','',14);
$pdf->SetY(18);
$pdf->SetX(350);
$pdf->Cell(0,3,$date,0,1,'L');

$pdf->tdheight=10;
$pdf->Ln(30);
$pdf->SetFont('Times','B',24);
$pdf->SetTextColor(64,64,64);
$pdf->Cell(0,3,"Applicant Report From: $_SESSION[start1] To: $_SESSION[end1]",0,1,'C');
$pdf->Ln(10);

$pdf->AddCol("Name",100,'Applicant Name','L');
$pdf->AddCol('basicEmail',90,'Email Address','L');
$pdf->AddCol('contactNumber',50,'Contact Number','C');
$pdf->AddCol('applicantDate',50,'Application Date','C');
$prop=array('HeaderColor'=>array(164,219,254),
			'color2'=>array(224,235,255),
			'color1'=>array(255,255,255),
			);
$pdf->SetFont('Times', 'B', 30);
$pdf->Table("SELECT CONCAT (basicLastName , ',' , basicFirstName , ' ', basicMiddleName) AS Name, basicEmail, contactNumber, applicantDate
			FROM tbl_basic_info a, tbl_applicant b, tbl_contact_info c
			WHERE a.basicId = b.basicId and a.basicId = c.basicId AND 
			applicantDate BETWEEN '$_SESSION[start1]' AND '$_SESSION[end1]' GROUP BY basicEmail ORDER BY applicantDate",$prop);
			

$pdf->Output(); 
?>
