<?php
include ('../../../config/connection.php');
$branch3 = $_POST['branch3'];
$location3 = $_POST['location3'];
$first = $_POST['first3'];
$mid = $_POST['middle3'];
$last = $_POST['last3'];
$job = $_POST['job3'];
$fff = $_POST['fff'];
$mmm = $_POST['mmm'];
$lll = $_POST['lll'];
$Aid = $_POST['Aid'];
$jobid3 = $_POST['jobid3'];
$bname3 = $_POST['bname3'];
$jname3 = $_POST['jname3'];

		$con = mysql_connect("$db_hostname","$db_username","$db_password");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
						
			mysql_select_db("rems", $con);
			
			$query="INSERT INTO endorsedapp  
				(
					applicantID,
					jobPostingID,
					branchName,
					jobPostingTitle
				)
				VALUES
				(
				'$Aid',
				'$jobid3',
				'$bname3',
				'$jname3'
				)
			";
			mysql_query($query);

require_once("fpdf/fpdf.php");


// Begin configuration

$textColour = array( 0, 0, 0 );
$headerColour = array( 0, 0, 0 );
$reportName = "DEPLOYMENT SLIP";


// End configuration


/**
  Create the title page
**/

$pdf = new FPDF( 'P', 'mm', 'A5' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );

/**
  Create the page header, main heading, and intro text
**/

$pdf->AddPage();
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetFont( 'TIMES', 'B', 18);
$pdf->Cell( 0,7, $reportName,0 , 0, 'C' );
$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
$pdf->SetFont( 'HELVETICA', '', 9 );
$pdf->Ln( 5 );
$pdf->Write( 19, $branch3);
$pdf->Ln( 5 );
$pdf->Write( 19, $location3);
$pdf->Ln( 15);
$pdf->SetFont( 'HELVETICA', "", 9);
$pdf->Write( 9, "Sir/Madame," );
$pdf->Ln( 10 );
$pdf->Write( 9, "May we respectfully introduce the bearer, Mr/Ms. ");
$pdf->Write( 9, $first );
$pdf->Write( 9, " " );
$pdf->Write( 9, $mid) ;
$pdf->Write( 9, " " );
$pdf->Write( 9, $last);
$pdf->Ln( 1);
$pdf->Write( 9, "                                                                              ______________________");
$pdf->Ln( 8 );
$pdf->Write( 9, "on a position of ");
$pdf->Write( 9, $job);
$pdf->Ln( 1);
$pdf->Write( 9, "                        _______________");
$pdf->Ln( 8 );
$pdf->Write( 9, "Attached are his/her resume and other pertinent data and information for your perusal that");
$pdf->Ln( 5 );
$pdf->Write( 9, "he/she will meet your requirements and contribute to the growth of your esteem");
$pdf->Ln( 8 );
$pdf->Write( 9, "Thank you and let us work hand in hand for the success of our partnership.");
$pdf->Ln( 8 );
$pdf->Write( 9, "Very truly yours,");
$pdf->Ln( 8 );
$pdf->SetFont( 'HELVETICA', '', 9 );
$pdf->Write( 9, $fff );
$pdf->Write( 9, " " );
$pdf->Write( 9, $mmm) ;
$pdf->Write( 9, " " );
$pdf->Write( 9, $lll);
$pdf->Ln( 1);
$pdf->Write( 9, "______________________");
$pdf->Ln( 5 );
$pdf->SetFont( 'HELVETICA', '', 9 );
$pdf->Write( 9, "Company Officer");
$pdf->Ln( 15 );
$pdf->SetFont( 'HELVETICA', 'B', 10 );
$pdf->Write( 5, "................................................................................................................................");
$pdf->Ln(5);
$pdf->SetFont( 'HELVETICA', 'B',10);
$pdf->Write( 9, "                                                    RETURN SLIP");
$pdf->Ln( 7 );
$pdf->SetFont( 'HELVETICA', "", 9);
$pdf->Write( 9, "Dear Agency," );
$pdf->Ln( 7 );
$pdf->Write( 9, "This is to inform you that Mr./Ms.  ______________________________ applying for" );
$pdf->Ln( 8 );
$pdf->Write( 9, "the position of ______________________ has passed/failed our evaluation and hereby" );
$pdf->Ln( 5 );
$pdf->Write( 9, "report back to you for more details." );
$pdf->Ln( 9 );
$pdf->Write( 9, "Thank You," );
$pdf->Ln( 8 );
$pdf->Write( 9, "_____________________________" );
$pdf->Ln( 5);
$pdf->SetFont( 'HELVETICA', "", 9 );
$pdf->Ln( 1);
$pdf->Write( 9, "Interviewer" );
$pdf->Ln( 10);
$pdf->Write( 9, "Date: ________________________" );


$pdf->Output( "report.pdf", "I" );

?>