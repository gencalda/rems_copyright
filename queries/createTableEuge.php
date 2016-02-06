<?php
	//connection
	require_once '../config/connection.php';
	$connection = mysql_connect("$db_hostname","$db_username","$db_password", "$db_database");
	if (!$connection)
	{
		die ("No connection Established error at: " .mysql_error());
	}
	
	
	//create table
	mysql_select_db($db_database,$connection);
	
	
		
	$typeOfBusiness = "CREATE TABLE tbl_type_of_business
		(
			typeOfBusinessId 			int (6) AUTO_INCREMENT	NOT NULL,
			typeOfBusinessName			varchar (250) 			NOT NULL, 
			typeOfBusinessStatus 		int (2) 				NOT NULL, 
			typeOfBusinessDescription	varchar (500) 			NULL,
			PRIMARY KEY (typeOfBusinessId)
		)";
		mysql_query($typeOfBusiness,$connection);


	$client = "CREATE TABLE tbl_client
		(
			clientId int (6) AUTO_INCREMENT NOT NULL,
			typeOfBusinessId int (6) NOT NULL,
			clientName varchar (250) NOT NULL,
			clientStatus int (1) NOT NULL,
			clientEmail varchar (250) NOT NULL,
			clientNotes varchar (500) NULL,
			PRIMARY KEY (clientId),
			FOREIGN KEY (typeOfBusinessId) REFERENCES tbl_type_of_business(typeOfBusinessId)
		)";
		mysql_query($client,$connection);

	$basicInfo = "CREATE TABLE tbl_basic_info
		(
			basicId int (6) AUTO_INCREMENT NOT NULL,
			clientId int (6) NULL,
			basicDate date NOT NULL,
			basicPicture varchar (250) NULL,
			basicLastName varchar (250) NOT NULL,
			basicFirstName varchar (250) NOT NULL,
			basicMiddleName varchar (250) NULL,
			basicExtName varchar (20) NULL,
			basicEmail varchar (250) NOT NULL,
			basicStatus int (1) NOT NULL,
			basicCode varchar (250) NOT NULL,
			personalDob date NULL,
			personalBirthPlace varchar (250) NULL,
			currentPosition varchar (250) NULL,
			remsValue char (250) NULL,
			basicNotes varchar (500) NULL,
			PRIMARY KEY (basicId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId)
		)";
		mysql_query($basicInfo,$connection);



	$contractStart = "CREATE TABLE tbl_contract_start
		(
			contractStartId int (6) AUTO_INCREMENT NOT NULL,
			clientId int (6) NULL,
			basicId int (6) NULL,
			startDate date NOT NULL,
			PRIMARY KEY (contractStartId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($contractStart,$connection);


	$contractEnd = "CREATE TABLE tbl_contract_end
		(
			contractEndId int (6) AUTO_INCREMENT NOT NULL,
			clientId int (6) NULL,
			basicId int (6) NULL,
			endDate date NOT NULL,
			PRIMARY KEY (contractEndId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($contractEnd,$connection);


	$address = "CREATE TABLE tbl_address
		(
			addressId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NULL,
			clientId int (6) NULL,
			addBlock varchar (250)  NULL,
			addStreet varchar (250) NULL,
			addSubdivision varchar (250) NULL,
			addBarangay varchar (250) NOT NULL,
			addDistrict varchar (250) NULL,
			addCity varchar (250) NOT NULL,
			addProvince varchar (250) NULL,
			addCountry varchar (250) NOT NULL,
			addZip int (4) NOT NULL,
			PRIMARY KEY (addressId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId)
		)";
		mysql_query($address,$connection);


	$contactInfo = "CREATE TABLE tbl_contact_info
		(
			contactInfoId int (6) AUTO_INCREMENT NOT NULL,
			clientId int (6) NULL,
			basicId int (6) NOT NULL,
			contactDevice varchar (250) NULL,
			contactNumber varchar (250) NOT NULL,
			PRIMARY KEY (contactInfoId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($contactInfo,$connection);


	$jobPosting = "CREATE TABLE tbl_job_posting
		(
			jobPostingId	int	(6) AUTO_INCREMENT NOT NULL,
			clientId int (6) NOT NULL,
			jobName varchar (250) NOT NULL,
			jobDescription varchar (500) NULL,
			jobStatus int (1) NOT NULL,
			PRIMARY KEY (jobPostingId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId)
		)";
		mysql_query($jobPosting,$connection);



	$jobQualification = "CREATE TABLE tbl_job_quali
		(
			jobQualiId int (6) AUTO_INCREMENT NOT NULL,
			jobPostingId int (6) NOT NULL,
			jobQualiDescription varchar (250) NOT NULL,
			jobQualiType varchar (250) NOT NULL,
			jobQualiPercent varchar (10) NOT NULL,
			PRIMARY KEY (jobQualiId),
			FOREIGN KEY (jobPostingId) REFERENCES tbl_job_posting(jobPostingId)
		)";
		mysql_query($jobQualification,$connection);


	$personalInfo = "CREATE TABLE tbl_personal_info
		(
			personalId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			personalQualityDesc varchar (500) NOT NULL,
			personalQualityType varchar (500) NOT NULL,
			PRIMARY KEY (personalId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($personalInfo,$connection);


	$family = "CREATE TABLE tbl_family_background
		(
			familyId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			familySpouse varchar (250)  NULL,
			familySpouseAdd varchar (250) NULL,
			familySpouceJob varchar (250) NULL,
			fatherName varchar (250) NOT NULL,
			fatherJob varchar (250) NULL,
			motherName varchar (250) NOT NULL,
			motherJob varchar (250) NULL,
			emergencyNotifyName varchar (250) NOT NULL,
			emergencyNotifyAddress varchar (250) NOT NULL,
			emergencyNotifyContact varchar (250) NOT NULL,
			PRIMARY KEY (familyId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($family,$connection);


	$child = "CREATE TABLE tbl_child
		(
			childId	int	(6) AUTO_INCREMENT NOT NULL,
			familyId int (6) NOT NULL,
			childName varchar (250)  NULL,
			childAge int (3) NULL,
			childGender varchar (250) NULL,
			childCivil varchar (250) NULL,
			PRIMARY KEY (childId),
			FOREIGN KEY (familyId) REFERENCES tbl_family_background(familyId)
		)";
		mysql_query($child,$connection);


	$insurance = "CREATE TABLE tbl_insurance_info
		(
			insuranceId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			benificiaryName varchar (250)  NOT NULL,
			benificiaryAdd varchar (250) NOT NULL,
			benificiaryRelationship varchar (250) NOT NULL,
			benificiaryDob varchar (250) NOT NULL,
			benificiaryGender varchar (250) NOT NULL,
			benificaryAge int (3) NOT NULL,
			benificiaryCivil varchar (250) NOT NULL,
			PRIMARY KEY (insuranceId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($insurance,$connection);


	$education = "CREATE TABLE tbl_education
		(
			educationId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			schoolName varchar (250)  NULL,
			schoolLevel varchar (250) NULL,
			schooAddress varchar (250) NULL,
			PRIMARY KEY (educationId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($education,$connection);


	$work = "CREATE TABLE tbl_work
		(
			workId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			contractStartId int (6) NULL,
			contractEndId int (6) NULL,
			companyName varchar (250)  NULL,
			workYear varchar (250) NULL,
			workPosition varchar (250) NULL,
			workSalary varchar (250) NULL,
			workSupervisior varchar (250) NULL,
			workLeavingReason varchar (500) NULL,
			PRIMARY KEY (workId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId),
			FOREIGN KEY (contractStartId) REFERENCES tbl_contract_start(contractStartId),
			FOREIGN KEY (contractEndId) REFERENCES tbl_contract_end(contractEndId)
		)";
		mysql_query($work,$connection);


	$character = "CREATE TABLE tbl_character
		(
			characterId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			characterName varchar (250) NOT NULL,
			characterJob varchar (250) NOT NULL,
			characterAddress varchar (250) NOT NULL,
			characterContact varchar (250) NOT NULL,
			PRIMARY KEY (characterId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($character,$connection);



	$desiredPosition = "CREATE TABLE tbl_desired_position
		(
			desiredPositionId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			dateOfApplication date NOT NULL,
			positionOne varchar (250) NOT NULL,
			positionTwo varchar (250) NOT NULL,
			positionThree varchar (250) NOT NULL,
			monthlySalary varchar (250) NOT NULL,
			resume varchar (250) NOT NULL,
			otherQualification varchar (500) NOT NULL,
			PRIMARY KEY (desiredPositionId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($desiredPosition,$connection);



	$otherInfo = "CREATE TABLE tbl_other_info
		(
			otherId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			labelName varchar (250) NOT NULL,
			description varchar (250) NOT NULL,
			PRIMARY KEY (otherId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($otherInfo,$connection);


	$account = "CREATE TABLE tbl_user_account
		(
			accountId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NULL,
			clientId int (6) NULL,
			accountRole varchar (250) NOT NULL,
			username varchar (250) NOT NULL,
			password varchar (250) NOT NULL,
			accountNotes varchar (500) NOT NULL,
			accountStatus int (1) NOT NULL,
			PRIMARY KEY (accountId),
			FOREIGN KEY (basicId) REFERENCES tbl_desired_position(basicId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId)
		)";
		mysql_query($account,$connection);


	$voucher = "CREATE TABLE tbl_voucher
		(
			voucherCode varchar (12) NOT NULL
			basicId int (6) NOT NULL,
			desiredPositionId int (6) NOT NULL,
			PRIMARY KEY (voucherCode),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId),
			FOREIGN KEY (desiredPositionId) REFERENCES tbl_basic_info(desiredPositionId)
		)";
		mysql_query($voucher,$connection);


	$processRecord = "CREATE TABLE tbl_process_record
		(
			processId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			accountId int (6) NOT NULL,
			voucherCode varchar (12) NOT NULL,
			processName varchar (250) NOT NULL,
			processDate date NOT NULL,
			PRIMARY KEY (processId),
			FOREIGN KEY (accountId) REFERENCES tbl_user_account(accountId),
			FOREIGN KEY (voucherCode) REFERENCES tbl_voucher(voucherCode)
		)";
		mysql_query($processRecord,$connection);




		//////////////////////////////////////////////////////////
		//
		//
		//	processName 
		//
		//	Assessed by, Endorsed by, Approved by, Disapproved by, 
		//	Deployed by, Renewed by, 
		//
		//////////////////////////////////////////////////////////




	mysql_close($connection);
?>