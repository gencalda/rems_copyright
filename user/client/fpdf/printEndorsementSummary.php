<?php
require('mysql_table.php');
include ('../../../config/connection.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title

	$this->SetFont('Arial','B',18);
	$this->Cell(0,3,'Endorsement Summary',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}
//Connect to database
mysql_connect("$db_hostname","$db_username","$db_password","$db_database");
mysql_select_db('rems');

$pdf=new PDF("P", "mm","A4" );
$pdf->AddPage();
$pdf->SetTextColor(0,0,0);
$pdf->AddCol('Name',60,'Name','C');
$pdf->AddCol('jobPostingTitle',60,'Position','C');
$pdf->AddCol('branchName',75,'Branch','C');
$prop=array('HeaderColor'=>array(255,255,240),
			'color1'=>array(255,255,240),
			'color2'=>array(255,255,240),
			'padding'=>0);
$pdf->Table('select jobPostingTitle, branchName, CONCAT(appInfoFirstName, " " ,appInfoLastName, " ", appInfoMiddleName) as Name FROM appinformation, endorsedapp WHERE appinformation.applicantID = endorsedapp.applicantID',$prop);

$pdf->Output(); 
?>
