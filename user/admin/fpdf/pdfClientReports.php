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
		function header()
		{
		
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
$pdf->Cell(0,3,"Client Contract Report From: $_SESSION[start1] To: $_SESSION[end1]",0,1,'C');
$pdf->Ln(10);



$pdf->AddCol('clientName',70,'Client Name','L');
$pdf->AddCol('clientEmail',80,'Email Address','L');
$pdf->AddCol('contactNumber',55,'Contact Number','C');
$pdf->AddCol('contractStartDate',50,' Start of Contract','C');
$pdf->AddCol('contractEndDate',50,' End of Contract','C');
$pdf->AddCol('contractStatus',40,'Contract Status','C');
$prop=array('HeaderColor'=>array(164,219,254),
			'color2'=>array(224,235,255),
			'color1'=>array(255,255,255),
			);
$pdf->SetFont('Times', 'B', 24);
$pdf->Table("SELECT * FROM tbl_contract a, tbl_client b , tbl_contact_info c, tbl_basic_info d
				WHERE a.clientId = b.clientId  and b.clientId = c.clientId and b.clientId = d.basicId and
				contractStartDate >= '$_SESSION[start1]' AND contractEndDate <= '$_SESSION[end1]' GROUP BY clientName ORDER BY contractStartDate",$prop);

$pdf->Output(); 
?>
