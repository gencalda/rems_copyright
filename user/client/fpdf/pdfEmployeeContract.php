<?php
require('fpdf.php');

include ('../../../config/connection.php');
session_start();



// -------------------------------------------------
//	/	/	/	/	/ Variables	/	/	/	/	/	 



$agencyAddress = "address ng agency";
$agencyName = "pangalan ng agency";
$contractStart = "";
$contractEnd = "";
$hrName = ""; //
$empName = "";

$clientId = "";
$basicId = "";

$empAddress = "";
$empNationality = "";

$clientName ="";
$clientAddress = "";


$empAddBlock = "";
$empAddStreet = "";
$empAddSubdivision = "";
$empAddBarangay = "";
$empAddDistrict = "";
$empAddCity = "";
$empAddProvince = "";
$empAddCountry = "";
$empAddZip = "";


$clientAddBlock = "";
$clientAddStreet = "";
$clientAddSubdivision = "";
$clientAddBarangay = "";
$clientAddDistrict = "";
$clientAddCity = "";
$clientAddProvince = "";
$clientAddCountry = "";
$clientAddZip = "";

$start = "";
$end = "";
$interval = "";
$months = "";
$years = "";


		$con = mysql_connect("$db_hostname","$db_username","$db_password");
					if (!$con)
					{
						die('Could not connect: ' . mysql_error()); 
					}
					
					mysql_select_db("$db_database", $con);
					
					$result = mysql_query("SELECT *
											FROM tbl_basic_info
											WHERE basicId = $_SESSION[login_userId]
										");
										
					while($row = mysql_fetch_array($result)) 
					{
						$hrName = $row['basicLastName'].', '.$row['basicFirstName'].' '.$row['basicMiddleName'];
					}//while
					
					$result = mysql_query("SELECT *
											FROM tbl_contract
											LEFT JOIN tbl_employee
											ON tbl_employee.employeeId = tbl_contract.employeeId
											LEFT JOIN tbl_job_posting
											ON tbl_employee.jobPostingId = tbl_job_posting.jobPostingId
											LEFT JOIN tbl_client
											ON tbl_client.clientId = tbl_job_posting.clientId
											LEFT JOIN tbl_applicant
											ON tbl_applicant.applicantId = tbl_employee.applicantId
											LEFT JOIN tbl_basic_info
											ON tbl_applicant.basicId = tbl_basic_info.basicId
											WHERE tbl_contract.employeeId IS NOT NULL
											AND tbl_contract.employeeId = $_SESSION[ses_empID]
										");
							
					echo" sessionID: $_SESSION[ses_empID]";
					
					while($row = mysql_fetch_array($result)) 
					{
						$contractStart = $row['contractStartDate'];		//
						$contractEnd = $row['contractEndDate'];			//
						$empName = $row['basicFirstName'].' '.$row['basicMiddleName'].' '.$row['basicLastName'];	//
						$clientName = $row['clientName'];				//
						$clientId = $row['clientId'];
						$basicId = $row['basicId'];
						
					}//while
					
					
					$start = new DateTime($contractStart);
					$end = new DateTime($contractEnd);
					$interval = $start ->diff($end);
					$months = (int)(($interval->days) / 30);
					$years = (int)(($interval->days) / 365);
					
					
					$result = mysql_query("SELECT *
											FROM tbl_address
											LEFT JOIN tbl_basic_info
											ON tbl_address.basicId = tbl_basic_info.basicId
											WHERE tbl_basic_info.basicId = $basicId
										");
										
					while($rowInfo = mysql_fetch_array($result)) 
					{
						$empLoc =$rowInfo['addBlock']." ".$rowInfo['addStreet']." ".$rowInfo['addSubdivision']." ".$rowInfo['addBarangay']." ".$rowInfo['addDistrict']." ".$rowInfo['addCity'].", ".$rowInfo['addProvince'];
						//
					}//while

					
					
					$result = mysql_query("SELECT *
											FROM tbl_address
											LEFT JOIN tbl_client
											ON tbl_address.clientId = tbl_client.clientId
											WHERE tbl_client.clientId = $_SESSION[ses_clientID]
										");
										
					
				
				while($row = mysql_fetch_array($result)) 
					{
						$clientLoc =$row['addStreet']." ".$row['addBarangay']."  ".$row['addCity'].", ".$row['addProvince'];
				
					}//while
					
					$result = mysql_query("SELECT *
											FROM tbl_personal_info
											WHERE basicId = $basicId
											AND personalQualityType='Nationality'
										");
					while($row = mysql_fetch_array($result)) 
					{
						$empNationality =$row['personalQualityDesc'];
				
					}//while
					
						
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
						applicantId,
						notifDesc, 
						dateCreated,
						notifStatus
					)
					VALUES 
					(
						'',
						'$_SESSION[ses_clientID]',
						'$_SESSION[ses_AppID]',
						'is now your employee.',
						now(),
						'new'
					)"
				);
			/*								
				*/
		

// -------------------------------------------------



$pdf = new FPDF('p','mm',array(215.9,330.2));
$pdf->AddPage();
$pdf->AddFont('BarcodeFont','','BarcodeFont.php');
$pdf->AddFont('Calibri','','Calibri.php');
$pdf->AddFont('Calibri Bold','','Calibri Bold.php');
$pdf->SetMargins(10,20);
$pdf->SetAutoPageBreak(true, 5);
$pdf->SetFont('Calibri','',11);
$pdf->SetTextColor(141,141,141);
$pdf->SetY(5);
$pdf->SetX(150);
$pdf->Cell(56, 6, 'Powered By: Getchs;', 0, 0, 'R', FALSE);

$pdf->SetFont('Calibri Bold','',11);
$pdf->SetTextColor(0,0,0);
$pdf->SetY(5);
$pdf->SetX(11);
$pdf->Cell(56, 6,$pdfAgencyName, 0, 0, 'L', FALSE);

$pdf->SetFont('Calibri Bold','',14);
$pdf -> SetX(16);
$pdf -> SetY(16);
$pdf->Cell(56, 6, 'FIXED TERM CONTRACT SERVICE AGREEMENT', 0, 0, 'FJ', FALSE);

$pdf->SetFont('Calibri Bold','',11);
$pdf -> SetY(20);
$pdf -> SetX(10);
$pdf->Cell(16, 23, 'KNOW ALL MEN BY THESE PRESENTS:',0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'This agreement was made and executed on  ____________ at  _________________________________________' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(95);
$pdf->Cell(16, 23, $contractStart ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(123);
$pdf->Cell(16, 23, $AgencyAddress ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(35);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'Philippines by and between:' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(45);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '______________________________________________, a corporation duly organized and existing in accordance' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(45);
$pdf -> SetX(40);
$pdf->Cell(16, 23, $clientName ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(50);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'with the laws of the Philippines and represented in this agreement by ________________________________ HR and' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(50);
$pdf -> SetX(130);
$pdf->Cell(16, 23, $hrName ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(55);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'Admin Manager / Officer and hereinafter referred to as the' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri Bold','',11);
$pdf -> SetY(55);
$pdf -> SetX(111);
$pdf->Cell(16, 23, 'CONTRACTOR.' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(62);
$pdf -> SetX(107);
$pdf->Cell(16, 23, '"And"' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(69);
$pdf -> SetX(23);
$pdf->Cell(16, 23, '__________________, a (nationality), of legal age and is residing at' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(69);
$pdf -> SetX(23);
$pdf->Cell(16, 23, $empNationality ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(75);
$pdf -> SetX(16);
$pdf->Cell(16, 23, '____________________________________________________________________ and hereinafter referred to as the' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(75);
$pdf -> SetX(16);
$pdf->Cell(16, 23, $empLoc ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri Bold','',11);
$pdf -> SetY(80);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'FIXED TERM SERVICE PROVIDER' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(87);
$pdf -> SetX(100);
$pdf->Cell(16, 23, 'WIITNESSETH: THAT -' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(94);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'WHEREAS,  the                            represented  to  the  FIXED  TERM  SERVICE  PROVIDER  that  he/she  is  in  need of' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri Bold','',11);
$pdf -> SetY(94);
$pdf -> SetX(48);
$pdf->Cell(16, 23, 'CONTRACTOR' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(99);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'an   individual  to  employ,  appoint,  assign  and  deploy  to  one  of  its  customers-clients  as  a  FIXED  TERM  SERVICE' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(104);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'PROVIDER  for  the  purpose  of  performing  a  specific  work  for  an  agreed  specific  period  of  time.' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(111);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'WHEREAS,   the  FIXED  TERM  SERVICE  PROVIDER   signifies   his  interest  and   willingness  to  voluntarily  accept' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(116);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'the offer of the EMPLOYER and has therefore offered his services to the CONTRACTOR as a FIXED TERM' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(121);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'SERVICE PROVIDER' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(126);
$pdf -> SetX(23);
$pdf->Cell(16, 23, 'NOW,  THEREFORE, for  and  in  consideration  of  the  foregoing  premises   and   of   the   stipulation  hereinafter' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(131);
$pdf -> SetX(16);
$pdf->Cell(16, 23, 'provided, the parties hereto agree as follows, to wit:' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(140);
$pdf -> SetX(29);
$pdf->Cell(16, 23, '1.     That  the   FIXED  TERM  SERVICE  PROVIDER  will  be  assigned  and  deployed  to  the  designated  client-' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(145);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "customer  of  the   CONTRACTOR    for   the  entire  duration  of  the    CONTRACTOR'S    contract  with  its " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(150);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "designated client and  or  the  entire duration   CONTRACTOR'S   client  designated  customer but  will not" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(155);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "exceed   the   period   of  (___________________)  beginning  (___________________)   and   ending   on  " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(160);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "_________________________.  Therefore the FTSP's fixed term agreement with the CONTRACTOR is  co-" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(165);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "terminous with the CONTRACTOR's  contract with its client and or (_____________________)  whichever" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(170);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "comes first.  This Fixed Term Contract Service Agreement can also be pre-terminated in accordance  with" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(175);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "the following below situations, to wit:" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(184);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "a.    When the CONTRACTOR's contract with its CLIENT was pre-terminated for whatever reason;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(189);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "b.    When the CONTRACTOR'S client reduced its operation and the FIXED TERM SERVICE PROVIDER's " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(194);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "        service was identified as no longer necessary; " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(199);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "c.    When the CONTRACTOR'S client closed a certain department(s)  or section(s) of which the FIXED" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(204);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "       TERM  SERVICE  PROVIDER  was  adversely affected because of the CONTRACTOR  have  assigned " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(209);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "       him or her in the said department(s) or section(s) that was closed by the CONTRACTOR's client; " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(214);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "d.    When the contract of the CONTRACTOR'S client to its customer(s) was terminated or pre-" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(219);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "       terminated for whatever reason and the FIXED TERM SERVICE PROVIDER happens to be assigned " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(224);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "       or deployed in the  CONTRACTOR'S  client customer whose contract has been terminated or pre-" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(229);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "       terminated;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(234);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "e.    When the service of the  FIXED TERM SERVICE PROVIDER  was requested by  the  CONTRACTOR's" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(239);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "       client to terminated or pre-terminated for just and reasonable cause or  for legally  valid  reason" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(244);
$pdf -> SetX(43);
$pdf->Cell(16, 23, "       cited but not limited to the below reasons as follows:" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(251);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "              1.  The FIXED TERM SERVICE PROVIDER'S performance is below the expected performance" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(256);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "                    standard of the CONTRACTOR'S client;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(261);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "              2.  The FIXED TERM SERVICE PROVIDER'S attitude is adversely affecting the CONTRACTOR's" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(266);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "                   client either internally or externally or both;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(271);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "              3.  The FIXED TERM SERVICE  PROVIDER'S  habitual  absenteeism,  work  abandonment and" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(276);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "                   any analogous cases that are adversely affecting the CONTRACTOR'S  client's  operation;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(281);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "              4.  The   FIXED   TERM   SERVICE   PROVIDER'S   violations   and   or   disobedience    of    the " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(286);
$pdf -> SetX(46);
$pdf->Cell(16, 23, "                   CONTRACTOR'S client's company policies, rules and regulations; " ,0 , 1, 'FJ', FALSE);

$pdf->AddPage();

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(10);
$pdf -> SetX(29);
$pdf->Cell(16, 23, '2.      The Fixed Term Employment agreement as stipulated in #1 is not extendable for any reason or purpose.' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(15);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'In  a  case  wherein  there  was  confusion  or  miscalculation  wherein  the  services  of the FIXED TERM' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(20);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'SERVICE PROVIDER was inadvertently extended for  more than (________________________) whether' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(25);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'the  said  service extension  was the result of error,  negligence or  misjudgement  on  the part of either' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'parties  does  not   mean  to  interpret  that  said  error  in  extension  is  a  waiver  of  the  rights  of  the'  ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(35);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'CONTRACTOR to terminate this  FIXED  TERM  CONTRACT  SERVICE  AGREEMENT immediately upon the' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(40);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'discovery of the erroneous service extension;' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(45);
$pdf -> SetX(29);
$pdf->Cell(16, 23, '3.      That the  FIXED  TERM  SERVICE  PROVIDER  in exchange  of  his  or  her  services will be duly paid by the' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(50);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'CONTRACTOR  in  accordance  to  both parties  agreed  compensation package as detail in "Exhibit - A".' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(55);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'Any and all  terms as regard  payment of  services and  other  benefits  as  well as the payroll cu-off and ' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(60);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'payroll releasing dates will be details in "Exhibit - A";' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(65);
$pdf -> SetX(29);
$pdf->Cell(16, 23, '4.       That the designated client-customer will be ____________________________________ ;' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(65);
$pdf -> SetX(110);
$pdf->Cell(16, 23, $clientName ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(70);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'with Home Office or business address at __________________________________________________;' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(70);
$pdf -> SetX(103);
$pdf->Cell(16, 23, $clientLoc ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(75);
$pdf -> SetX(29);
$pdf->Cell(16, 23, '5.       That the FIXED TERM  SERVICE  PROVIDER is directly employed by the CONTRACTOR and therefore the;' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(80);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "FIXED   TERM   SERVICE   PROVIDER   does  not   have   any   employee-employer  relationship  with  the " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(85);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "CONTRACTOR'S designated client-customer;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(90);
$pdf -> SetX(29);
$pdf->Cell(16, 23, '6.       That the FIXED TERM SERVICE PROVIDER is voluntarily, willingly and is openly acknowledging that he or' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(95);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "she is not employee of the CONTRACTOR'S  client and that he / she will not invoke any reason or claims" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(100);
$pdf -> SetX(38);
$pdf->Cell(16, 23, 'during and after the term of this Fixed Term Contract Service Agreement contrary to his / her open and ' ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(105);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "voluntary willingness to acknowledge that he or she is not an employee of the CONTRACTOR'S client;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(110);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "7.       That the FIXED TERM SERVICE PROVIDER is bound to follow the rules  and  regulations of CONTRACTOR" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(115);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "that any and all concern of the FIXED  TERM  SERVICE  PROVIDER  as  regards  his employment status as" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(120);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "well his compensations and other benefits should be directed by the FIXED TERM SERVICE PROVIDER to" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(125);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "the CONTRACTOR and not with  the  CONTRACTOR'S client-customer. In the event that the FIXED TERM " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(130);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "SERVICE PROVIDER have unduly annoyed the CONTRACTOR's  client-customer by asking so many things" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(135);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "in  violation  of  this  specific  provision  will  be  a  valid  reason for the  CONTRACTOR  to  terminate the" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(140);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "services of the FIXED TERM SERVICE PROVIDER and or to pre-terminate this agreement;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(145);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "8.       That  the   FIXED   TERM   SERVICE   PROVIDER   should   not   ask   any  advances  and  or  loans from the"  ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(150);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "CONTRACTOR'S client-customer and that asking for cash advance and or loans from the CONTRACTOR'S" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(155);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "client-customer is  breach  of  this  agreement and is sufficient and valid reason for the CONTRACTOR to" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(160);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "terminate  the  services of  the  FIXED  TERM  SERVICE PROVIDER  and  to pre-terminate  this agreement " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(165);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "even  though the  cash  advances or loans  granted by the CONTRACTOR'S  client-customer is due to the " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(170);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "latters' kindness or magnanimity;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(175);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "9.       That the FIXED  TERM  SERVICE  PROVIDER  should observe all rules and regulations being implemented" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(180);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "by the  CONTRACTOR'S  client-customer. It should be clear that the  FIXED  TERM  SERVICE  PROVIDER'S " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(185);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "failure  to  follow any and all the rules and regulations and or failure to meet the performance standard" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(190);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "of  the  CONTRACTOR'S  client - customer  is  a  valid  and  acceptable  reason for  the  CONTRACTOR  to" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(195);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "terminate the service of the FIXED TERM SERVICE PROVIDER and to pre-terminate this agreement." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(200);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "10.     That   the  FIXED  TERM  SERVICE  PROVIDER's   compliance   to  the   CONTRACTOR'S  client's   company " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(205);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "policies, rules by the  CONTRACTOR'S  client-customer.  It should be clear that the FIXED TERM SERVICE" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(210);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "PROVIDER'S and regulations as well as with valid  instructions of  CONTRACTOR'S  client  representative " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(215);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "should  not  be  construed  as  an  employer-employee  relationship  but  rather  as  means to be able to " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(220);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "better serve the CONTRACTOR'S client and the CONTRACTOR'S client's customers;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(225);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "11.     That any  and all  fixed  term pre-employment  requirements  should be  submitted or  complied by  the" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(230);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "FIXED  TERM  SERVICE  PROVIDER  prior to his  deployment to CONTRACTOR'S client-customer  without. " ,0 , 0, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(235);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "In the event that the FIXED TERM SERVICE PROVIDER was erroneously deployed to the  CONTRACTOR'S" ,0 , 0, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(240);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "client-customer  without  having  received  from  the  FIXED  TERM  SERVICE  PROVIDER   the  necessary" ,0 , 0, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(245);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "documents or that the FIXED TERM SERVCE PROVIDER failed to undergo some  of the  required process" ,0 , 0, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(250);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "for fixed term employment, the  EMPLOYER  reserves the right to hold  25 % to  50%  of  the  salaries or" ,0 , 0, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(255);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "compensation for the services of FIXED  TERM  SERICE  PROVIDER until such  time that the  FIXED TERM" ,0 , 0, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(260);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "SERVICE PROVIDER have complied completely to the fixed term pre-employment requisites;" ,0 , 0, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(265);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "12.     That the FIXED TERM SERVICE PROVIDER agrees to pay the COTRACTOR the following:" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(270);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "a.   Service fee of ONE HUNDRED (100) PESOS for processing the  FIXED TERM SERVICE PROVIDER's " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(275);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "Phil-health and Pag-ibig. There will be no service fee to be collected if the  FIXED TERM SERVICE" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(280);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "PROVIDER provided the Phil-health and Pag-ibig numbers;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(285);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "b.  Recruitment  and  Placement Fee equivalent to 20 % of  FIXED  TERM  SERVICE  PROVIDER's one " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(290);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "month salary in case he/she agrees to be hired directly by the  CONTRACTOR's  client-customer" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(295);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "during the  period  of  agreement  and or  after the termination or expiration of this agreement." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(300);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "Recruitment  and  Placement  Fee  is  waived  if  the  FIXED TERM SERVICE PROVIDER was  hired" ,0 , 1, 'FJ', FALSE);

$pdf->AddPage();

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(10);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "directly  by  the  CONTRACTOR's  client-customer after SIX (6) MONTHS  from  the  date  of the" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(15);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "expiration of this agreement." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(20);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "13.     That  the  FIXED  TERM  SERVICE  PROVIDER  agrees  that an amount equivalent to __________ will be " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(25);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "deducted by the  CONTRACTOR to the  FIXED TERM  SERVICE PROVIDER every payroll representing the  " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "FIXED TERM SERVICE PROVIDER's  Cash Bond.  The Cash Bond will be applied for any damage or losses" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(35);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "sustained  by  the  CONTRACTOR's  client-customer  that  are  directly  attributable to  the FIXED TERM " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(40);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "SERVICE PROVIDER  either  to  by  commission  or  omission or  negligence of the FIXED TERM SERVICE " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(45);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "PROVIDER.  The  accumulated  Cash  Bond  of the FIXED TERM SERVICE PROVIDER  will be  returned by" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(50);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "the  CONTRACTOR the  FIXED TERM SERVICE  that a PROVIDER ONE (1) MONTH after the expiration of " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(55);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "this agreement provided clearance was issued by the  CONTRACTOR'S client-customer.  However,  the" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(60);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "accumulated Cash Bond may be subject for deduction or forfeiture for valid and legal reasons such  as" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(65);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "but not limited to theft, damages and losses that are directly attributable to the  FIXED TERM SERVICE" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(70);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "PROVIDER but after a due process or investigation have been fairly conducted. Work abandonment  is" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(75);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "included in the forfeiture clause for Cash Bond where an established damage or penalty was  incurred " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(80);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "by either the CONTRACTOR or the CONTRACTOR'S designated client;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(85);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "14.     That the CONTRACTOR can also pre-terminate this agreement at any time due to just and  reasonable " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(90);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "reasons but not limited to the below reasons as follows;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(95);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "a.  The   CONTRACTOR's  client - client   have   pre-terminated   his   Service  Agreement  with  the" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(100);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "Employer or vice versa;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(105);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "b.  The  CONTRACTOR'S  client customer have closed his business for any reason or have  stopped" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(110);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "operation  in  the  branch  or   work  location  where  the  FIXED  TERM  SERVICE  PROVIDER  as " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(115);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "deployed or assigned;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(120);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "c.  The  CONTRACTOR have closed his business or have stopped operation  either  permanently or " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(125);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "temporarily for whatever reason;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(130);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "d.  That the FIXED TERM SERVICE PROVIDER have committed violation of  any or the  provision of" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(135);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "this agreement;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(140);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "e.  For  any reason or reasons  that this is  accordance  with the  laws of  the Philippines  and or in " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(145);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "accordance with any applicable local, national and  labor laws that is   existing,  prevailing  and" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(150);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "in force in the Philippines including those practices that is deemed moral;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(155);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "15.     However, both parties, for whatever reason or reasons, has the right to pre-terminate this agreement" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(160);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "by serving  ONE (1) MONTH  written  notice to the other party. However, in case of pre-termination of" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(165);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "this  Agreement  both  parties  agreed that any pecuniary or monetary responsibility of either party to" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(170);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "the other party should be settled properly and amicably;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(175);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "16.     That  any  and  all provision  of  this  Agreement must be honored by both parties  provided  that  such" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(180);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "provision or stipulation is in accordance with all the existing laws in the Philippines.  In any case where" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(185);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "a certain provision will be declared void or illegal by any court with due authority  and  jurisdiction the" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(190);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "other unaffected provisions should be honored by both parties;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(195);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "17.     That this MEMORANDUM OF AGREEMENT will be in force and effective upon the date of  signing  this " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(200);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "agreement." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(205);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "18.     In case of disputes, both parties will exert all efforts to settle all issues amiably. Exerting all efforts" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(210);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "and amicable settlement is construed in this agreement as follows:" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(215);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "a.  The aggrieved party of the party with concern should notify the other party in writing of his or" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(220);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "her issues and concerns and give the other party the right off reply within  FIVE (5)  WORKING " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(225);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "DAYS upon receipt of the follow-up letter;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(230);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "b.  Failure  of  the  other  party  to  reply  within  the required period needs  only another  written" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(235);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "follow-up from the party with concern or issues and the other party is  given  a  right off reply" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(240);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "within THREE (3) WORKING DAYS upon the receipt of follow-up letter;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(245);
$pdf -> SetX(45);
$pdf->Cell(16, 23, "c.  The  second  failure of the  other party  to  reply  gives  the  right  for  the  aggrieved  party  to" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(250);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "interpret that the issue or concerned raised is beyond amicable settlement;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(255);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "19.     Hence failure to settle the disputes amicably will entitle either one or both parties to bring the  issue" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(260);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "to  the  proper legal venue through the  proper court  established  to resolve conflicts related hereto." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(265);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "Both  parties  have the right to  seek  redress and  bring the  matter to  the proper  venue as  may  be " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(270);
$pdf -> SetX(38);
$pdf->Cell(16, 23, "deemed proper by any aggrieved party." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(285);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "IN WITNESS WHEREOF, the parties hereto have hereunto affixed their signatures on the date and the place" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(290);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "first above written." ,0 , 1, 'FJ', FALSE);

$pdf->AddPage();

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(10);
$pdf -> SetX(29);
$pdf->Cell(16, 23, "_________________________________" ,0 , 1, 'FJ', FALSE);



$pdf->SetFont('Calibri','',11);
$pdf -> SetY(15);
$pdf -> SetX(50);
$pdf->Cell(16, 23, "(CONTRACTOR)" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(9);
$pdf -> SetX(37);
$pdf->Cell(16, 23, $AgencyName ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(10);
$pdf -> SetX(125);
$pdf->Cell(16, 23, "_________________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(15);
$pdf -> SetX(130);
$pdf->Cell(16, 23, "FIXED TERM SERVICE PROVIDER" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(9);
$pdf -> SetX(135);
$pdf->Cell(16, 23, $empName,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(30);
$pdf -> SetX(83);
$pdf->Cell(16, 23, "SIGNED IN THE PRESENCE OF:" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(40);
$pdf -> SetX(40);
$pdf->Cell(16, 23, "__________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(40);
$pdf -> SetX(120);
$pdf->Cell(16, 23, "__________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(60);
$pdf -> SetX(100);
$pdf->Cell(16, 23, "ACKNOWLEDGEMENT" ,0 , 1, 'C', FALSE);

$pdf->SetFont('Calibri bold','',10);
$pdf -> SetY(70);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "Republic of the Philippines" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri bold','',10);
$pdf -> SetY(78);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "City of:  _________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(88);
$pdf -> SetX(40);
$pdf->Cell(16, 23, "BEFORE ME, a Notary Public for and in the city/municipality of ______________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(95);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "Personally appeared the following who exhibited to me their respective International Passport/Community Resident " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(100);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "Certificate as show below:" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(115);
$pdf -> SetX(36);
$pdf->Cell(16, 23, "NAME" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(115);
$pdf -> SetX(75);
$pdf->Cell(16, 23, "LEGAL ID | DOCUMENTS " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri bold','',11);
$pdf -> SetY(115);
$pdf -> SetX(151);
$pdf->Cell(16, 23, "DATE & PLACE ISSUED" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(125);
$pdf -> SetX(20);
$pdf->Cell(16, 23, "______________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(125);
$pdf -> SetX(73);
$pdf->Cell(16, 23, "________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(125);
$pdf -> SetX(147);
$pdf->Cell(16, 23, "________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(135);
$pdf -> SetX(20);
$pdf->Cell(16, 23, "______________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(135);
$pdf -> SetX(73);
$pdf->Cell(16, 23, "________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(135);
$pdf -> SetX(147);
$pdf->Cell(16, 23, "________________________" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(155);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "Both are known to me and to me known to be the same person who executed the foregoing instrument and " ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(160);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "acknowledged to me that the same is their own free act and voluntary deed as well as that of the corporations," ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(165);
$pdf -> SetX(16);
$pdf->Cell(16, 23,"which they represent." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(173);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "WITNESS MY HAND AND NOTARIAL SEAL this ________________ day of ___________ 201_." ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(180);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "Doc. Number ______________;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(185);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "Page Number ______________;" ,0 , 1, 'FJ', FALSE);

$pdf->SetFont('Calibri','',11);
$pdf -> SetY(190);
$pdf -> SetX(16);
$pdf->Cell(16, 23, "Book Number ______________; Series of  20________" ,0 , 1, 'FJ', FALSE);

ob_end_clean();
$pdf->Output();
?>