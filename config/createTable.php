<?php
	//connection
	require_once 'connection.php';
	$connection = mysql_connect("$db_hostname","$db_username","$db_password", "$db_database");
	if (!$connection)
	{
		die ("No connection Established error at: " .mysql_error());
	}
	
	
	//create table
	mysql_select_db($db_database,$connection);
	
	
		
$client = "CREATE TABLE client
			(
				clientID int (6) AUTO_INCREMENT	NOT NULL,
				clientName varchar (50) NOT NULL, 
				clientBusinessType varchar (50) null, 
				clientStartContract date,
				clientEndContract date, 
				clientStatus int (1) not null, 
				clientZip varchar (4) not null,
				clientLocation varchar (100) null,
				clientContactPerson varchar (50) null,
				clientContPosition varchar (30) null,
				clientMobileNumber varchar (11) null,
				clientLandline varchar (20) null,
				clientFax varchar (20) null,
				clientEmailAddress varchar (50) null,
				PRIMARY KEY (clientID)
			)";
			mysql_query($client,$connection);
			
	$branch = "CREATE TABLE branch
			(
				branchID int (6) AUTO_INCREMENT NOT NULL,
				clientID int (6) NOT NULL,
				branchName varchar (100) NOT NULL,
				branchStatus int (1) not null,
				branchZip varchar (4) not null,
				branchLocation varchar (100) null,
				branchContactPerson varchar (100) null,
				branchContPosition varchar (100) null,
				branchMobileNumber varchar (11) null,
				branchLandline varchar (20) null,
				branchFax varchar (20) null,
				branchEmailAddress varchar (100) null,
				PRIMARY KEY (branchID),
				FOREIGN KEY (clientID) REFERENCES client(clientID)
			)";
			mysql_query($branch,$connection);

			
	$userAccount = "CREATE TABLE userAccount 
			(
				userAccID int (6) AUTO_INCREMENT NOT NULL,
				branchID int (6) NULL,
				userAccRole varchar(50) not null,
				userAccUsername varchar(100) not null,
				userAccPassword varchar(100) not null,
				userAccLastName varchar(100),
				userAccFirstName varchar(100),
				userAccMiddleName varchar(100),
				userAccDOB varchar(50),
				userAccAge int(2),
				userAccCivilStatus varchar(50),
				userAccGender varchar(50),
				PRIMARY KEY (userAccID),
				FOREIGN KEY (branchID) REFERENCES branch(branchID)
			)";
			mysql_query($userAccount,$connection);

	$jobPosting = "CREATE TABLE jobPosting 
			(
				jobPostingID int (6) AUTO_INCREMENT NOT NULL,
				branchID int (6) not null,
				jobPostingTitle varchar(100) not null,
				jobPostingStatus int (1) not null,
				PRIMARY KEY (jobPostingID),
				FOREIGN KEY (branchID) REFERENCES branch(branchID)
			)";
			mysql_query($jobPosting,$connection);

	$jobQualifications = "CREATE TABLE jobQualifications 
			(
				jobQualifiID int (6) AUTO_INCREMENT NOT NULL,
				jobPostingID int (6) not null,
				jobQualifiDesc varchar(100) not null,
				jobQualifiType varchar(100) not null,
				jobQualifiNewlyAddedDesc varchar(10) NULL, 
				PRIMARY KEY (jobQualifiID),
				FOREIGN KEY (jobPostingID) REFERENCES jobPosting(jobPostingID)
			)";
			mysql_query($jobQualifications,$connection);


$appInformation = "CREATE TABLE appInformation
(
	applicantID int (6) AUTO_INCREMENT NOT NULL,
	appInfoLastName varchar(100) not null,
	appInfoFirstName varchar(100) not null,
	appInfoMiddleName varchar(100) not null,
	appInfoStatus int (1) not null,
	appInfoAddress varchar(100) not null,
	appInfoProvince varchar(100) not null,
	appInfoLandline varchar(100) not null,
	appInfoMobile varchar(100) not null,
	appInfoEmail varchar(100) not null,
	appInfoBirthday date,
	appInfoNameOfSpouse varchar(100) not null,
	appInfoSpouseAddress varchar(100) not null,
	appInfoSpouseOccupation varchar(100) not null,
	appInfoNumberOfChildren varchar(100) not null,
	appInfoAgesOfChildren varchar(100) not null,
	appInfoNameOfFather varchar(100) not null,
	appInfoOccupationOfFather varchar(100) not null,
	appInfoNameOfMother varchar(100) not null,
	appInfoOccupationOfMother varchar(100) not null,
	appInfoEmergencyContactPerson varchar(100) not null,
	appInfoAddressOfContactPerson varchar(100) not null,
	appInfoContactNumberOfContactPerson varchar(100) not null,
	appInfoPrimarySchool varchar(100) not null,
	appInfoPrimarySchoolAddress varchar(100) not null,
	appInfoSecondarySchool varchar(100) not null,
	appInfoSecondarySchoolAddress varchar(100) not null,
	appInfoCollege varchar(100) not null,
	appInfoCollegeAddress varchar(100) not null,
	appInfoCompanyName varchar(100) not null,
	appInfoWorkYear varchar(100) not null,
	appInfoPosition varchar(100) not null,
	appInfoSalary varchar(100) not null,
	appInfoImmediateSupervisor varchar(100) not null,
	appInfoReasonForLeaving varchar(100) not null,
	appInfoCharacterReferenceName varchar(100) not null, 
	appInfoCharacterReferenceOccupation varchar(100) not null,
	appInfoCharacterReferenceAddress varchar(100) not null,
	appInfoCharacterReferenceContactNumber varchar(100) not null,
	appInfoLicenseNumber varchar(100) not null,
	appInfoPagIbig varchar(100) not null,
	appInfoSSSnumber varchar(100) not null,
	appInfoTIN varchar(100) not null,
	appInfoPhilHealth varchar(100) not null,
	PRIMARY KEY (applicantID)
)";
mysql_query($appInformation,$connection);



			$appChosenPosition = "CREATE TABLE appChosenPosition 
			(
				appChosenPositionID int (6) AUTO_INCREMENT NOT NULL, 
				jobPostingTitle varchar(100) not null,
				applicantID int (6) NOT NULL,
				appChosenPositionRank varchar(100) not null,
				PRIMARY KEY (appChosenPositionID),
				FOREIGN KEY (applicantID) REFERENCES appInformation (applicantID)
		)";
			mysql_query($appChosenPosition,$connection);




$appQualities = "CREATE TABLE appQualities
(
appQualityID int (6) AUTO_INCREMENT NOT NULL,
applicantID int (6) not null,
appQualityDesc varchar(100) not null,
appQualityType varchar(100) not null,
PRIMARY KEY (appQualityID),
FOREIGN KEY (applicantID) REFERENCES appInformation (applicantID)
)";
mysql_query($appQualities,$connection);








$appPairingResults = "CREATE TABLE appPairingResults
(
appPairingID int (6) AUTO_INCREMENT NOT NULL,
applicantID int (6) not null,
jobPostingID int (6) not null,
appPairingScore varchar(30) not null,
appPairingPercentage varchar(20) not null, 
PRIMARY KEY (appPairingID),
FOREIGN KEY (applicantID) REFERENCES appInformation (applicantID),
FOREIGN KEY (jobPostingID) REFERENCES jobPosting(jobPostingID) 
)";
mysql_query($appPairingResults,$connection);





	
	mysql_close($connection);
?>