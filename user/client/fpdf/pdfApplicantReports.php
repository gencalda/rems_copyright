<?php
session_start();
$root = realpath(dirname(__FILE__) . '/../../..');
include($root . '/config/connection.php');
require('mysql_table.php');

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
		$this->Ln(3);
		$this->SetFont('Times','B',16);
		$this->SetTextColor(0,0,0);
		$this->Cell(0,3,$pdfAgencyName,0,1,'L');
		$this->Ln(5);
		$this->SetFont('Times','B',11);
		$this->SetTextColor(131,130,139);
		$this->Cell(0,3,"Powered by Getchs;",0,1,'L');
		$this->tdheight=5;
		$this->Ln(30);
		$this->SetFont('Times','B',24);
		$this->SetTextColor(64,64,64);
		$this->Cell(0,3,"Applicant Report From: $_SESSION[start1] To: $_SESSION[end1]",0,1,'C');
		$this->Ln(5);
		//Ensure table header is output
		parent::Header();
	}
	
}

//Connect to database
mysql_connect("$db_hostname","$db_username","$db_password");
mysql_select_db('remsdb');


$pdf=new PDF("L", "mm", array(300,200));
$pdf->AddPage();
$pdf->SetTextColor(0,0,0);

$pdf->AddCol("Name",55,'Applicant Name','C');
$pdf->AddCol('basicEmail',80,'Email Address','C');
$pdf->AddCol('contactNumber',80,'Contact Number','C');
$pdf->AddCol('applicantDate',50,'Application Date','C');
$prop=array('HeaderColor'=>array(89,201,145),
			'color1'=>array(224,235,255),
			'color2'=>array(255,255,240),
			);
$pdf->SetFont('Times', 'B', 30);
$pdf->Table("SELECT CONCAT (basicLastName , ',' , basicFirstName , ' ', basicMiddleName) AS Name, basicEmail, contactNumber, applicantDate
			FROM tbl_basic_info a, tbl_applicant b, tbl_contact_info c
			WHERE a.basicId = b.applicantId and a.basicId = c.basicId AND 
			applicantDate BETWEEN '$_SESSION[start1]' AND '$_SESSION[end1]'",$prop);

$pdf->Output(); 
?>
