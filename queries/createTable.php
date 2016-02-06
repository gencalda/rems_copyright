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
			clientEmail varchar (250) NOT NULL,
			clientNotes varchar (500) NULL,
			clientAccessCode varchar (20) NULL,
			PRIMARY KEY (clientId),
			FOREIGN KEY (typeOfBusinessId) REFERENCES tbl_type_of_business(typeOfBusinessId)
		)";
		mysql_query($client,$connection);

	$basicInfo = "CREATE TABLE tbl_basic_info
		(
			basicId int (6) AUTO_INCREMENT NOT NULL,
			clientId int (6) NULL,
			basicPicture varchar (250) NULL,
			basicLastName varchar (250) NOT NULL,
			basicFirstName varchar (250) NOT NULL,
			basicMiddleName varchar (250) NULL,
			basicExtName varchar (20) NULL,
			basicEmail varchar (250) NOT NULL,
			basicDob date NULL,
			basicBirthPlace varchar (500) NULL,
			remsValue char (250) NULL,
			basicNotes varchar (500) NULL,
			basicPosition  varchar (250) NULL,
			PRIMARY KEY (basicId)
		)";
		mysql_query($basicInfo,$connection);


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
			basicId int (6) NULL,
			contactDevice varchar (250) NOT NULL,
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
			jobQualiNewlyAdded varchar (10) NULL,
			jobQualiPercent varchar (10) NULL,
			PRIMARY KEY (jobQualiId),
			FOREIGN KEY (jobPostingId) REFERENCES tbl_job_posting(jobPostingId)
		)";
		mysql_query($jobQualification,$connection);


	$personalInfo = "CREATE TABLE tbl_personal_info
		(
			personalId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			personalQualityDesc varchar (500) NOT NULL,
			personalQualityType varchar (250) NOT NULL,
			personalQualityNewlyAdded varchar (10) NULL,
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
			familySpouseJob varchar (250) NULL,
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
			companyName varchar (250)  NULL,
			workYear varchar (250) NULL,
			workPosition varchar (250) NULL,
			workSalary varchar (250) NULL,
			workSupervisor varchar (250) NULL,
			workLeavingReason varchar (500) NULL,
			PRIMARY KEY (workId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
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



	$other = "CREATE TABLE tbl_other
		(
			otherId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			otherLabelName varchar (250) NOT NULL,
			otherDescription varchar (250) NOT NULL,
			PRIMARY KEY (otherId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($other,$connection);


	$account = "CREATE TABLE tbl_user_account
		(
			accountId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NULL,
			clientId int (6) NULL,
			accountRole varchar (250) NOT NULL,
			accountUsername varchar (250) NOT NULL,
			accountPassword varchar (250) NOT NULL,
			accountNotes varchar (500) NULL,
			accountStatus int (1) NOT NULL,
			PRIMARY KEY (accountId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($account,$connection);


	$processRecord = "CREATE TABLE tbl_process_record
		(
			processId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			accountId int (6) NOT NULL,
			processName varchar (250) NOT NULL,
			processDate date NOT NULL,
			PRIMARY KEY (processId),
			FOREIGN KEY (accountId) REFERENCES tbl_user_account(accountId)
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
		

	
	
	$applicant = "CREATE TABLE tbl_applicant
		(
			applicantId	int	(6) AUTO_INCREMENT NOT NULL,
			basicId int (6) NOT NULL,
			applicantDate date NULL,
			applicantStatus varchar (150) NOT NULL,
			PRIMARY KEY (applicantId),
			FOREIGN KEY (basicId) REFERENCES tbl_basic_info(basicId)
		)";
		mysql_query($applicant,$connection);
		
		
	$desiredPosition = "CREATE TABLE tbl_desired_position
		(
			desiredPositionId	int	(6) AUTO_INCREMENT NOT NULL,
			applicantId int (6) NOT NULL,
			positionJobName varchar (250) NOT NULL,
			positionRank varchar (250) NOT NULL,
			resume varchar (250) NULL,
			PRIMARY KEY (desiredPositionId),
			FOREIGN KEY (applicantId) REFERENCES tbl_applicant(applicantId)
		)";
		mysql_query($desiredPosition,$connection);


		
		
	$endorsement = "CREATE TABLE tbl_endorsement
		(
			endorsementId	int	(6) AUTO_INCREMENT NOT NULL,
			applicantId int (6) NOT NULL,
			clientId int (6) NOT NULL,
			jobPostingId  int (6) NOT NULL,
			endorsementDate date NOT NULL,
			endorsementDecision varchar (150) NULL,
			endorsementDecisionDate date NULL,
			endorsementStatus varchar (150) NOT NULL,
			PRIMARY KEY (endorsementId),
			FOREIGN KEY (applicantId) REFERENCES tbl_applicant(applicantId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId),
			FOREIGN KEY (jobPostingId) REFERENCES tbl_job_posting(jobPostingId)
		)";
		mysql_query($endorsement,$connection);
		
	
	$employee = "CREATE TABLE tbl_employee
		(
			employeeId	int	(6) AUTO_INCREMENT NOT NULL,
			applicantId  int (6) NOT NULL,
			jobPostingId  int (6) NOT NULL,
			PRIMARY KEY (employeeId),
			FOREIGN KEY (applicantId) REFERENCES tbl_applicant(applicantId),
			FOREIGN KEY (jobPostingId) REFERENCES tbl_job_posting(jobPostingId)
		)";
		mysql_query($employee,$connection);
	
	$contract = "CREATE TABLE tbl_contract
		(
			contractId	int	(6) AUTO_INCREMENT NOT NULL,
			clientId int (6) NULL,
			employeeId int (6) NULL,
			contractStartDate date NOT NULL,
			contractEndDate  date NOT NULL,
			contractStatus varchar (150) NOT NULL,
			PRIMARY KEY (contractId),
			FOREIGN KEY (clientId) REFERENCES tbl_client(clientId),
			FOREIGN KEY (employeeId) REFERENCES tbl_employee(employeeId)
		)";
		mysql_query($contract,$connection);
		
	
	$delinquent = "CREATE TABLE tbl_delinquent
		(
			delinquentId	int	(6) AUTO_INCREMENT NOT NULL,
			employeeId int (6) NOT NULL,
			delinquentReason varchar (5000) NOT NULL,
			delinquentDecision varchar (150) NOT NULL,
			PRIMARY KEY (delinquentId),
			FOREIGN KEY (employeeId) REFERENCES tbl_employee(employeeId)
		)";
		mysql_query($delinquent,$connection);

	mysql_close($connection);
	
	
	//---------------------
	
	$subject = "CREATE TABLE tbl_subject
		(
			subjectId	int	(6) AUTO_INCREMENT NOT NULL,
			subjectName varchar (500) NOT NULL,
			subjectStatus 		int (1) 				NOT NULL, 
			PRIMARY KEY (subjectId)
		)";
		mysql_query($subject,$connection);
		
		
	$exam = "CREATE TABLE tbl_exam
		(
			examId	int	(6) AUTO_INCREMENT NOT NULL,
			subjectId int (6) NOT NULL,
			jobPostingId int (6) NOT NULL,
			examTitle  varchar (500) NOT NULL,
			examCode varchar (50) NOT NULL,
			examPassingGrade varchar (50) NOT NULL,
			PRIMARY KEY (examId),
			FOREIGN KEY (subjectId) REFERENCES tbl_subject(subjectId),
			FOREIGN KEY (jobPostingId) REFERENCES tbl_job_posting(jobPostingId)
		)";
		mysql_query($exam,$connection);
		
		
	$question = "CREATE TABLE tbl_question
		(
			questionId	int	(6) AUTO_INCREMENT NOT NULL,
			examId int (6) NOT NULL,
			questionDesc varchar (5000) NOT NULL,
			PRIMARY KEY (questionId),
			FOREIGN KEY (examId) REFERENCES tbl_exam(examId)
		)";
		mysql_query($question,$connection);
		
	
	$answer = "CREATE TABLE tbl_choice
		(
			choiceId	int	(6) AUTO_INCREMENT NOT NULL,
			questionId int (6) NOT NULL,
			choiceDescription varchar (5000) NOT NULL,
			PRIMARY KEY (choiceId),
			FOREIGN KEY (questionId) REFERENCES tbl_question(questionId)
		)";
		mysql_query($answer,$connection);
		
		
	$answer = "CREATE TABLE tbl_answerKey
		(
			answerKeyId	int	(6) AUTO_INCREMENT NOT NULL,
			questionId int (6) NOT NULL,
			choiceId int (6) NOT NULL,
			PRIMARY KEY (answerKeyId),
			FOREIGN KEY (questionId) REFERENCES tbl_question(questionId),
			FOREIGN KEY (choiceId) REFERENCES tbl_choice(choiceId)
		)";
		mysql_query($answer,$connection);
	

	$applicantExam = "CREATE TABLE tbl_applicant_exam
		(
			applicantExamId	int	(6) AUTO_INCREMENT NOT NULL,
			applicantId int (6) NOT NULL,
			examId int (6) NOT NULL,
			applicantExamDateTaken date NOT NULL,
			applicantExamScore decimal(6,0) NULL,
			PRIMARY KEY (applicantExamId),
			FOREIGN KEY (applicantId) REFERENCES tbl_applicant(applicantId),
			FOREIGN KEY (examId) REFERENCES tbl_exam(examId)
		)";
		mysql_query($applicantExam,$connection);
?>