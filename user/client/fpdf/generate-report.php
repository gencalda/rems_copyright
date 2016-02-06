<?php
require('mysql_table.php');
class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'PDF From mysql',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}
//Connect to database
mysql_connect('localhost','root','');
mysql_select_db('record');
$pdf=new PDF();
$pdf->AddPage();
//First table: put all columns automatically
$pdf->Table('SELECT `studid`, `lastname`,`firstname`,`midname` from student order by `studid`');
$pdf->AddPage();
//Second table: specify 3 columns
$pdf->AddCol('studid',40,'','C');
$pdf->AddCol('lastname',40,'record','C');
$pdf->AddCol('firstname',40,'','C');
$pdf->AddCol('middlename',40,'','C');
//$pdf->AddCol('info',40,'','C');
$prop=array('HeaderColor'=>array(255,150,100),
			'color1'=>array(210,245,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
$pdf->Table('select studid, lastname,firstname, midname from student order by studid',$prop);
//$pdf->Output("C:\Users\John\Desktop/somename.pdf",'F'); 
header('Content-type: record/pdf');
$pdf->Output('record'.".pdf", 'I'); 
//header('Location: '.projekter.".pdf");
?>