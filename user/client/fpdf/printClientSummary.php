<?php
require('mysql_table.php');
include ('../../../config/connection.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title

	$this->SetFont('Arial','B',18);
	$this->Cell(0,3,'Client Summary',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}

//Connect to database
mysql_connect("$db_hostname","$db_username","$db_password","$db_database");
mysql_select_db('rems');

$pdf=new PDF("L", "mm", array(400,200));
$pdf->AddPage();
$pdf->SetTextColor(0,0,0);
$pdf->AddCol('clientName',65,'','C');
$pdf->AddCol('clientZip',25,'','C');
$pdf->AddCol('clientLocation',75,'','C');
$pdf->AddCol('clientContactPerson',50,'','C');
$pdf->AddCol('clientMobileNumber',50,'','C');
$pdf->AddCol('clientLandline',40,'','C');
$pdf->AddCol('clientEmailAddress',70,'','C');
$prop=array('HeaderColor'=>array(255,255,240),
			'color1'=>array(255,255,240),
			'color2'=>array(255,255,240),
			'padding'=>0);
$pdf->Table('select clientName, clientZip, clientLocation, clientContactPerson, clientMobileNumber, clientLandline, clientEmailAddress from client',$prop);

$pdf->Output(); 
?>
