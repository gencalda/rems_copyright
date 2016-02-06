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

class PDF extends PDF_MySQL_Table
{
	function Header()
	{
		//Title
		
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
$pdf->SetFont('Times','B',14);
$pdf->SetY(8);
$pdf->SetX(10);
$pdf->Cell(0,3,$pdfAgencyName,0,1,'L');

$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->SetTextColor(131,130,139);
$pdf->Cell(0,3,"Powered by Getchs;",0,1,'L');
$pdf->tdheight=5;
$pdf->Ln(30);
$pdf->SetFont('Times','B',24);
$pdf->SetTextColor(64,64,64);
$pdf->Cell(0,3,"LIST OF ALL ENDORSED APPLICANT",0,1,'C');
$pdf->Ln(10);


$pdf->AddCol("Name",80,'Applicant Name','L');
$pdf->AddCol('clientName',70,'Client Name','L');
$pdf->AddCol('endorsementDate',60,'Application Date','L');
$pdf->AddCol('endorsementStatus',50,'Applicant Status','L');
$prop=array('HeaderColor'=>array(89,201,145),
			'color1'=>array(224,235,255),
			'color2'=>array(255,255,240),
			);
$pdf->SetFont('Times', 'B', 24);
$pdf->Table("SELECT CONCAT (basicLastName , ',' , basicFirstName , ' ', basicMiddleName) AS Name, clientName, endorsementDate, endorsementStatus
			FROM tbl_endorsement a, tbl_applicant b, tbl_basic_info c, tbl_client d, tbl_job_posting e
			WHERE a.applicantId = b.applicantId 
					AND c.basicId = b.basicId
					AND a.clientId = d.clientId
					AND a.jobPostingId = e.jobPostingId",$prop);

$pdf->Output(); 
?>
