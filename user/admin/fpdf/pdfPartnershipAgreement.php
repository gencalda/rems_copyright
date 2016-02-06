<?php
require('fpdf.php');

include ('../../../config/connection.php');
session_start();

date_default_timezone_set("Asia/Manila");


$month =  date("F");
$year = date("Y");
$day = date("d");


// ----------------------------------------
//	/ / / / / / / VARIABLES / / / / / / / / / 

$agencyName = "Goldheart";

$agencyAddBlock = "Block";
$agencyAddStreet = "Street";
$agencyAddSubdivision = "Subdivision";
$agencyAddBarangay = "Barangay";
$agencyAddDistrict = "District";
$agencyAddCity = "City";
$agencyAddProvince = "Province";
$agencyAddCountry = "Country";
$agencyAddZip = "Zip";

$typeOfBusiness = "";

$clientName ="";
$clientID = "";
$clientAddBlock = "";
$clientAddStreet = "";
$clientAddSubdivision = "";
$clientAddBarangay = "";
$clientAddDistrict = "";
$clientAddCity = "";
$clientAddProvince = "";
$clientAddCountry = "";
$clientAddZip = "";

// ----------------------------------------

			$con = mysql_connect("$db_hostname","$db_username","$db_password");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error()); 
				}
			//for the jobs
				mysql_select_db("$db_database", $con);
				
			
			$result = mysql_query("SELECT *
									FROM tbl_client
									LEFT JOIN tbl_type_of_business
									ON tbl_client.typeOfBusinessId = tbl_type_of_business.typeOfBusinessId
									LEFT JOIN tbl_contract
									ON tbl_client.clientId = tbl_contract.clientId
									LEFT JOIN tbl_address
									ON tbl_client.clientId = tbl_address.clientId
									WHERE tbl_client.clientId = $_SESSION[ses_partnerClientID]
								");
										
				while($row = mysql_fetch_array($result)) 
				{
						$typeOfBusiness  = $row['typeOfBusinessName'];
						$clientName  = $row['clientName'];
						$clientAddBlock  = $row['addBlock'];
						$clientAddStreet = $row['addStreet'];
						$clientAddSubdivision = $row['addSubdivision'];
						$clientAddBarangay  = $row['addBarangay'];
						$clientAddDistrict  = $row['addDistrict'];
						$clientAddCity  = $row['addCity'];
						$clientAddProvince  = $row['addProvince'];
						$clientAddCountry  = $row['addCountry'];
						$clientAddZip  = $row['addZip'];
				}//while	
				
				$resultInfo = mysql_query("SELECT * FROM tbl_address WHERE clientId= $_SESSION[ses_partnerClientID]");
				
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
					$clientLoc = $rowInfo['addBlock']." ".$rowInfo['addStreet']." ".$rowInfo['addBarangay']." ".$rowInfo['addCity'].", ".$rowInfo['addProvince'];
				}
				
				$resultInfo = mysql_query("SELECT content_agencyName ,content_agencyAddress, content_pdfagencyName FROM tbl_content WHERE contentId = 1
								");
								
				while($rowInfo = mysql_fetch_array($resultInfo)) 
				{
						$AgencyName  = $rowInfo['content_agencyName'];
						$AgencyAddress  = $rowInfo['content_agencyAddress'];
						$pdfAgencyName  = $rowInfo['content_pdfagencyName'];
				}//while
				
				$mysqli->query("INSERT INTO tbl_notification
								(
									notifId,
									clientId, 
									notifDesc, 
									dateCreated,
									notifStatus,
									notifUser
								)
								VALUES 
								(
									'',
									'$_SESSION[ses_partnerClientID]',
									'. Partnership was successfully done.',
									now(),
									'bagongNotif',
									'client'
								)"
							);

				
				
$pdf = new FPDF('p','mm',array(215.9,330.2));
$pdf->AddPage();
$pdf->AddFont('BarcodeFont','','BarcodeFont.php');
$pdf->AddFont('Calibri','','Calibri.php');
$pdf->AddFont('Calibri Bold','','Calibri Bold.php');
$pdf->SetAutoPageBreak(true, 5);

$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(141,141,141);
$pdf->SetY(5);
$pdf->SetX(150);
$pdf->Cell(56, 6, 'Powered By: Getchs;', 0, 0, 'R', FALSE);

$pdf->SetFont('Calibri Bold','',11);
$pdf->SetTextColor(0,0,0);
$pdf->SetY(5);
$pdf->SetX(17);
$pdf->Cell(56, 6,$pdfAgencyName, 0, 0, 'L', FALSE);


$pdf->SetFont('Calibri','',23);
$pdf->SetY(19);
$pdf->SetX(80);
$pdf->Cell(56, 6, 'Partnership Agreement', 0, 0, 'C', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(23);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'THIS PARTNERSHIP AGREEMENT is made this                   day of       ,          , by and between the' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',12);
$pdf -> SetY(23);
$pdf -> SetX(95);
$pdf->Cell(16, 23, $month ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(23);
$pdf -> SetX(122);
$pdf->Cell(16, 23, $day ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(23);
$pdf -> SetX(128);
$pdf->Cell(16, 23, $year ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(28);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'following individuals:' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(37);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'Agency Name: ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',13);
$pdf -> SetY(37);
$pdf -> SetX(50);
$pdf->Cell(16, 23, $agencyName ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(43);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'Address: ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',13);
$pdf -> SetY(45);
$pdf -> SetX(50);
$pdf->Cell(16, 23, $AgencyAddress ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(55);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'Client Name: ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',13);
$pdf -> SetY(55);
$pdf -> SetX(50);
$pdf->Cell(16, 23, $clientName ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(62);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'Address:' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',13);
$pdf -> SetY(62 	);
$pdf -> SetX(49);
$pdf->Cell(16, 23, $clientLoc ,0 , 1, 'L', FALSE);


$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(73);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '1.  Nature of Business.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(73);
$pdf -> SetX(60);
$pdf->Cell(16, 23, 'The partners listed above hereby agree that they shall be considered partners in business ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(78);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'for the following purpose:' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(83);
$pdf -> SetX(28);
$pdf->Cell(16, 23, '______________________________________________________________________________________________' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(93);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '2.  Name.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(93);
$pdf -> SetX(39);
$pdf->Cell(16, 23, 'The partnership shall be conducted under the name of _________________ and shall maintain  offices ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',12);
$pdf -> SetY(93);
$pdf -> SetX(126);
$pdf->Cell(16, 23, $clientName ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(98);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'at [STREET ADDRESS], [CITY, STATE, ZIP].' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri Bold','',11);
$pdf -> SetY(108);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '3.  Day-To-Day Operation. ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(108);
$pdf -> SetX(66);
$pdf->Cell(16, 23, 'The  partners  shall provide  their full-time  services and  best  efforts on behalf of the' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(113);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'partnership.  No partner shall receive a salary for service rendered to the partnership. Each partner shall have ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(118);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'equal  rights  to  manage and control  the  partnership  and its  business. Should there be differences between ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(123);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'partners concerning ordinary business matters, a decision shall be made by unanimous vote.  It is understood' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(128);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'that  the  partners  may  elect one  of the  partners to  conduct  the  day-to-day  business  of  the  partnership;' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(133);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'however,  no  partner  shall  be  able  to  bind  the  partnership  by  act  or  contract  to  any liability exceeding' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(138);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'P_________  without the prior written consent of each partner.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(148);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '4.  Profits and Losses.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(148);
$pdf -> SetX(59);
$pdf->Cell(16, 23, 'The  profits  and losses of the  partnership shall be divided by  the partners according to a ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(153);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'mutually agreeable schedule and at the end of each calendar year according to the proportions listed above.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(163);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '5.  Term/Termination. ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(163);
$pdf -> SetX(60);
$pdf->Cell(16, 23, 'The term  of  this  Agreement  shall be for a  period  of ______ years, unless  the  partners' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(168);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'mutually  agree in  writing  to a shorter period.  Should the partnership be terminated by unanimous vote, the' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(173);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'assets  and  cash of  the  partnership  shall  be  used  to  pay  all  creditors,  with  the  remaining amounts to be' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(178);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'distributed to the partners according to their proportionate share. ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(188);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '6.  Disputes.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(188);
$pdf -> SetX(44);
$pdf->Cell(16, 23, 'This  Partnership  Agreement  shall be governed by the laws of the  Republic  of  the  Philippine. Any' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(193);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'disputes arising between the partners as result of this Agreement shall be settled by arbitration in accordance' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(198);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'with the rules of the  American  Arbitration  Association  and  judgement  upon  the  award  rendered  may be' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(203);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'entered in any court having jurisdiction thereof.  ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(213);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '7.  Withdrawal/Death of Partner.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(213);
$pdf -> SetX(77);
$pdf->Cell(16, 23, 'In  the  event  a  partner  withdraws  or  retires  from  the  partnership  for  any' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(218);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'reason,  including  death,  the  remaining  partners  may  continue  to operate the  partnership using the same ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(223);
$pdf -> SetX(28);
$pdf->Cell(16, 23, "name.  A  withdrawing  partner  shall  be  obligated  to  give  sixty (60) days'  prior  written  notice  of  his / her" ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(228);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'intention to withdraw  or retire and shall be  obligated to  sell  his/her  interest in  the partnership. No partner' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(233);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'shall  transfer  interest in  the  partnership  to  any other  party  without  the  written consent of the remaining' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(238);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'partner(s). The  remaining  partner(s)  shall pay  the withdrawing or retiring partner, or to legal representative' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(243);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'of the deceased or disabled partner,  the  value of his interest  in the  partnership, or (a) the sum of his capital' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(248);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'account,   (b)  any   unpaid   loans  due  him,   (c)   his  proportionate  share  of  accrued  net  profits  remaining' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(253);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'undistributed  in his  capital account,  and (d) his interest  in  any  prior agreed appreciation in the value of the' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(258);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'partnership property over its book value.  No value for good will shall be included  in determining the value of' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(263);
$pdf -> SetX(28);
$pdf->Cell(16, 23, "the partner's interest." ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(273);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '8.  Non-Compete Agreement.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(273);
$pdf -> SetX(71);
$pdf->Cell(16, 23, 'A  partner  who  retires  or  withdraws  from  the  partnership shall  not  directly or ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(278);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'indirectly  engage in a business  which is or  which would  be competitive with the existing or then anticipated' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(283);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'business  of  the  partnership  for  a  period  of ____________, in those ___________ of  this  State  where the' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(288);
$pdf -> SetX(28);
$pdf->Cell(16, 23, 'partnership is currently doing or planning to do business.' ,0 , 1, 'L', FALSE);

$pdf -> Addpage();

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(7);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'IN WITNESS WHEREOF, the partners have duly executed this Agreement on the day and year set.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(12);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'forth hereinabove.' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(25);
$pdf -> SetX(30);
$pdf->Cell(16, 23, '_____________________________' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(50);
$pdf->Cell(16, 23, 'Partner' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(25);
$pdf -> SetX(120);
$pdf->Cell(16, 23, '_____________________________ ' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(141);
$pdf->Cell(16, 23, 'Partner' ,0 , 1, 'L', FALSE);

$pdf->SetFont('Calibri','',13);
$pdf -> SetY(24);
$pdf -> SetX(30);
$pdf->Cell(16, 23, $clientName ,0 , 1, 'L', FALSE);

$pdf ->Output();

?>