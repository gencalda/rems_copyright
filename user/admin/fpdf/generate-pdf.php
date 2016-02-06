<?php
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'Student Summary',0,1,'C');
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
//Second table: specify 3 columns
$pdf->AddCol('lastname',70,'','C');
$pdf->AddCol('firstname',70,'','C');
$prop=array('HeaderColor'=>array(255,255,204),
			'color1'=>array(255,229,204),
			'color2'=>array(229,255,204),
			'padding'=>2);
$pdf->Table('select lastname, firstname from student order by studid limit 0,10',$prop);

//$pdf->Output("C:\Users\John\Desktop/somename.pdf",'F'); 


$pdf->Output("Client-Summary".".pdf"); 
header('Location: '."Client-Summary".".pdf");
?>
