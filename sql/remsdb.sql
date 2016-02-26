-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2016 at 02:08 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `addressId` int(6) NOT NULL,
  `basicId` int(6) DEFAULT NULL,
  `clientId` int(6) DEFAULT NULL,
  `addBlock` varchar(250) DEFAULT NULL,
  `addStreet` varchar(250) DEFAULT NULL,
  `addSubdivision` varchar(250) DEFAULT NULL,
  `addBarangay` varchar(250) NOT NULL,
  `addDistrict` varchar(250) DEFAULT NULL,
  `addCity` varchar(250) NOT NULL,
  `addProvince` varchar(250) DEFAULT NULL,
  `addCountry` varchar(250) NOT NULL,
  `addZip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`addressId`, `basicId`, `clientId`, `addBlock`, `addStreet`, `addSubdivision`, `addBarangay`, `addDistrict`, `addCity`, `addProvince`, `addCountry`, `addZip`) VALUES
(1, NULL, 1, '#3', 'Pananalig', '', 'J Rizal', '', 'Mandaluyong', 'Metro Manila', 'Philippines', '1800'),
(2, NULL, 2, '', 'Magsaysay St.', '', 'Brgy. Malanday', '', 'Marikina City', 'metro Manila', 'Philippines', '1123'),
(3, 4, NULL, '16', 'gumamela st.', 'sampaguita village', 'malanday', '', 'marikina city', 'metro manila', 'philippines', '1800'),
(4, 5, NULL, 'blk 50 lot 18', 'site', 'j mabini rizal', 'batia', 'j mabini rizal', 'bocaue', 'bulacan', 'philippines', '1234'),
(5, 6, NULL, '', 'majestic st.', '', 'concepcion', '', 'marikina', 'metro manila', 'philippines', '7893'),
(6, NULL, 3, '300', 'Duhat ', '', 'Manggahan', '', 'Pasig City', 'Metro Manila', 'Philippines', '1611'),
(7, 8, NULL, '302', 'duhat ext', '', 'manggahan', '', 'pasig city', 'metro manila', 'philippines', '1611');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answerkey`
--

CREATE TABLE `tbl_answerkey` (
  `answerKeyId` int(6) NOT NULL,
  `questionId` int(6) NOT NULL,
  `choiceId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant`
--

CREATE TABLE `tbl_applicant` (
  `applicantId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `applicantDate` date DEFAULT NULL,
  `applicantStatus` varchar(150) NOT NULL,
  `applicantVoucherCode` varchar(200) DEFAULT NULL,
  `resume` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_applicant`
--

INSERT INTO `tbl_applicant` (`applicantId`, `basicId`, `applicantDate`, `applicantStatus`, `applicantVoucherCode`, `resume`) VALUES
(1, 4, '2015-10-05', 'Endorsed', '2015 - 10 - 1', 'uploadFile/4.pdf'),
(2, 5, '2015-10-05', 'Endorsed', '2015 - 10 - 2', 'uploadFile/5.pdf'),
(3, 6, '2015-10-05', 'Endorsed', '2015 - 10 - 3', 'uploadFile/6.pdf'),
(4, 8, '2016-02-07', 'Active', NULL, 'uploadFile/8.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_exam`
--

CREATE TABLE `tbl_applicant_exam` (
  `applicantExamId` int(6) NOT NULL,
  `applicantId` int(6) NOT NULL,
  `examId` int(6) NOT NULL,
  `applicantExamDateTaken` date NOT NULL,
  `applicantExamScore` decimal(6,0) DEFAULT NULL,
  `examStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicant_exam_answers`
--

CREATE TABLE `tbl_applicant_exam_answers` (
  `answerId` int(255) NOT NULL,
  `questionId` int(255) NOT NULL,
  `choiceId` int(255) NOT NULL,
  `applicantId` int(255) NOT NULL,
  `applicantExamDateTaken` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_basic_info`
--

CREATE TABLE `tbl_basic_info` (
  `basicId` int(6) NOT NULL,
  `clientId` int(6) DEFAULT NULL,
  `basicPicture` varchar(250) DEFAULT NULL,
  `basicLastName` varchar(250) NOT NULL,
  `basicFirstName` varchar(250) NOT NULL,
  `basicMiddleName` varchar(250) DEFAULT NULL,
  `basicExtName` varchar(20) DEFAULT NULL,
  `basicEmail` varchar(250) NOT NULL,
  `basicDob` date DEFAULT NULL,
  `basicBirthPlace` varchar(500) DEFAULT NULL,
  `remsValue` char(250) DEFAULT NULL,
  `basicNotes` varchar(50000) DEFAULT NULL,
  `basicPosition` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_basic_info`
--

INSERT INTO `tbl_basic_info` (`basicId`, `clientId`, `basicPicture`, `basicLastName`, `basicFirstName`, `basicMiddleName`, `basicExtName`, `basicEmail`, `basicDob`, `basicBirthPlace`, `remsValue`, `basicNotes`, `basicPosition`) VALUES
(1, NULL, NULL, 'Calda', 'Gen', 'Vallez', NULL, '', NULL, NULL, NULL, NULL, NULL),
(2, 1, NULL, 'De Jesus', 'Maria Amor', '', '', 'amordejesus@gmail.com', NULL, NULL, NULL, NULL, 'President'),
(3, 2, NULL, 'Jung', 'Yujin', '', '', 'yujin.jung@yahoo.com', NULL, NULL, NULL, NULL, 'General Manager'),
(4, NULL, 'uploadImage/stephaniepacudan@gmail.com.', 'Pacudan', 'Stephanie Laraine', 'Bernas', '', 'stephaniepacudan@gmail.com', '1996-09-19', 'Marikina City', NULL, '', NULL),
(5, NULL, 'uploadImage/krystelmanuel03@gmail.com.', 'Manuel', 'Krystel', 'Sagun', '', 'krystelmanuel03@gmail.com', '1996-08-03', 'Manila', NULL, '', NULL),
(6, NULL, 'uploadImage/martyguiao@gmail.com.jpg', 'Guiao', 'Jomel Marty', 'Giron', '', 'martyguiao@gmail.com', '1995-08-11', 'Pampanga', NULL, '', NULL),
(7, 3, NULL, 'Grava', 'Eugene', '', '', 'eugenegrava.c@gmail.com', NULL, NULL, NULL, NULL, 'CEO'),
(8, NULL, 'uploadImage/sign.bookmark@yahoo.com.jpeg', 'Grava', 'Eugene', 'Cagui', '', 'sign.bookmark@yahoo.com', '1996-01-28', 'Pasig City', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_character`
--

CREATE TABLE `tbl_character` (
  `characterId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `characterName` varchar(250) NOT NULL,
  `characterJob` varchar(250) NOT NULL,
  `characterCompanyName` varchar(500) NOT NULL,
  `characterAddress` varchar(250) NOT NULL,
  `characterContact` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_character`
--

INSERT INTO `tbl_character` (`characterId`, `basicId`, `characterName`, `characterJob`, `characterCompanyName`, `characterAddress`, `characterContact`) VALUES
(1, 4, 'Josephine Tovera', 'Account Manager', 'San Miguel Corporation', 'Ortigas, Pasig City', '09123456787'),
(2, 5, 'Michael Lorenz De Castro', 'Manager', 'Michael Clothing', 'Quezon City', '09357757368'),
(3, 6, 'Imelda Calda', 'Treasury Specialist', 'Wideout', 'Paseo de Roxas, Makati City', '0936737363728'),
(4, 8, 'Adele', 'Manager', 'Adele Music', 'London', '00988564733');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child`
--

CREATE TABLE `tbl_child` (
  `childId` int(6) NOT NULL,
  `familyId` int(6) NOT NULL,
  `childName` varchar(250) DEFAULT NULL,
  `childAge` int(3) DEFAULT NULL,
  `childGender` varchar(250) DEFAULT NULL,
  `childCivil` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_child`
--

INSERT INTO `tbl_child` (`childId`, `familyId`, `childName`, `childAge`, `childGender`, `childCivil`) VALUES
(1, 1, '', 0, 'Male', ''),
(2, 2, '', 0, 'Male', ''),
(3, 3, '', 0, 'Male', ''),
(4, 4, '', 0, 'Male', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_choice`
--

CREATE TABLE `tbl_choice` (
  `choiceId` int(6) NOT NULL,
  `questionId` int(6) NOT NULL,
  `choiceDescription` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE `tbl_client` (
  `clientId` int(6) NOT NULL,
  `typeOfBusinessId` int(6) NOT NULL,
  `clientName` varchar(250) NOT NULL,
  `clientEmail` varchar(250) NOT NULL,
  `clientNotes` varchar(500) DEFAULT NULL,
  `clientAccessCode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client`
--

INSERT INTO `tbl_client` (`clientId`, `typeOfBusinessId`, `clientName`, `clientEmail`, `clientNotes`, `clientAccessCode`) VALUES
(1, 1, 'Power Mart', 'powermart@yahoo.com', '', 'AATTW1'),
(2, 2, 'Yujeans', 'yujeans@yahoo.com', '', 'NUNYE2'),
(3, 2, 'EugeneBoice', 'eugenegrava.c@gmail.com', '', 'EOUEE3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_info`
--

CREATE TABLE `tbl_contact_info` (
  `contactInfoId` int(6) NOT NULL,
  `clientId` int(6) DEFAULT NULL,
  `basicId` int(6) DEFAULT NULL,
  `contactDevice` varchar(250) NOT NULL,
  `contactNumber` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_info`
--

INSERT INTO `tbl_contact_info` (`contactInfoId`, `clientId`, `basicId`, `contactDevice`, `contactNumber`) VALUES
(1, 1, NULL, 'Mobile', '09357757348'),
(2, 2, NULL, 'Landline', '9088765'),
(3, 2, NULL, 'Landline', '9077862'),
(4, NULL, 4, 'Mobile', '09125968826'),
(5, NULL, 5, 'Mobile', '09357757364'),
(6, NULL, 6, 'Mobile', '09399085191'),
(7, 3, NULL, 'Mobile', '09473405405'),
(8, NULL, 8, 'Mobile', '09473405405');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE `tbl_content` (
  `contentId` int(6) NOT NULL,
  `content_Home` varchar(5000) NOT NULL,
  `content_About` varchar(5000) NOT NULL,
  `content_News` varchar(5000) NOT NULL,
  `content_ContactUs` varchar(5000) NOT NULL,
  `content_agencyName` varchar(250) NOT NULL,
  `content_agencyAddress` varchar(500) NOT NULL,
  `content_pdfagencyName` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`contentId`, `content_Home`, `content_About`, `content_News`, `content_ContactUs`, `content_agencyName`, `content_agencyAddress`, `content_pdfagencyName`) VALUES
(1, 'Welcome to REMS: Recruitment & Employee Performance Monitoring System', 'about', 'news', 'contact us', 'REMS Recruitment Agency', 'SM North Diliman St. West Avenue, Quezon City', 'REMS: Recruitment and Employee Performance Monitoring System');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contract`
--

CREATE TABLE `tbl_contract` (
  `contractId` int(6) NOT NULL,
  `clientId` int(6) DEFAULT NULL,
  `employeeId` int(6) DEFAULT NULL,
  `contractStartDate` date DEFAULT NULL,
  `contractEndDate` date DEFAULT NULL,
  `contractStatus` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contract`
--

INSERT INTO `tbl_contract` (`contractId`, `clientId`, `employeeId`, `contractStartDate`, `contractEndDate`, `contractStatus`) VALUES
(1, 1, NULL, '2015-10-05', '2017-10-05', 'on-going'),
(2, 2, NULL, NULL, NULL, 'not started'),
(3, NULL, 1, '2015-10-05', '2016-10-05', 'on-going'),
(4, NULL, 2, '2015-10-05', '2016-10-05', 'on-going'),
(5, 3, NULL, NULL, NULL, 'not started');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delinquent`
--

CREATE TABLE `tbl_delinquent` (
  `delinquentId` int(6) NOT NULL,
  `employeeId` int(6) NOT NULL,
  `delinquentReason` varchar(5000) NOT NULL,
  `delinquentDecision` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_desired_position`
--

CREATE TABLE `tbl_desired_position` (
  `desiredPositionId` int(6) NOT NULL,
  `applicantId` int(6) NOT NULL,
  `positionJobName` varchar(250) NOT NULL,
  `positionRank` varchar(250) NOT NULL,
  `resume` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_desired_position`
--

INSERT INTO `tbl_desired_position` (`desiredPositionId`, `applicantId`, `positionJobName`, `positionRank`, `resume`) VALUES
(1, 1, 'Cashier', 'First', NULL),
(2, 1, 'Guard', 'Second', NULL),
(3, 1, 'Sales lady', 'Third', NULL),
(4, 2, 'Sales lady', 'First', NULL),
(5, 2, 'Cashier', 'Second', NULL),
(6, 2, 'Select Third Choice Position', 'Third', NULL),
(7, 3, 'Cashier', 'First', NULL),
(8, 3, 'Guard', 'Second', NULL),
(9, 3, 'Select Third Choice Position', 'Third', NULL),
(10, 4, 'Guard', 'First', NULL),
(11, 4, '', 'Second', NULL),
(12, 4, '', 'Third', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_education`
--

CREATE TABLE `tbl_education` (
  `educationId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `schoolName` varchar(250) DEFAULT NULL,
  `schoolLevel` varchar(250) DEFAULT NULL,
  `schooAddress` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_education`
--

INSERT INTO `tbl_education` (`educationId`, `basicId`, `schoolName`, `schoolLevel`, `schooAddress`) VALUES
(1, 4, 'Holy Spirit Integrated School', 'Elementary', 'Antipolo City'),
(2, 4, 'Holy Spirit Integrated School', 'Secondary', 'Antipolo City'),
(3, 4, 'Polytechnic University of the Philippines', 'College', 'Sta. Mesa, Manila'),
(4, 5, 'Taal National Highschool', 'Secondary', 'Taal Bocaue Bulacan'),
(5, 5, 'Polytechnic University of the Philippines', 'College', 'Sta  Mesa Manila'),
(6, 6, 'Pampanga Elem. school', 'Elementary', 'Pampanga'),
(7, 6, 'St. Catherine High School', 'Secondary', 'Pampanga'),
(8, 8, 'Elementary', 'Elementary', 'Elementary Address');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employeeId` int(6) NOT NULL,
  `applicantId` int(6) NOT NULL,
  `jobPostingId` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employeeId`, `applicantId`, `jobPostingId`) VALUES
(1, 2, 1),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_reports`
--

CREATE TABLE `tbl_emp_reports` (
  `reportId` int(6) NOT NULL,
  `reportDesc` varchar(250) NOT NULL,
  `employeeId` int(6) NOT NULL,
  `reportDate` date NOT NULL,
  `clientId` int(6) NOT NULL,
  `reportStat` varchar(250) NOT NULL,
  `adminDes` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_emp_reports`
--

INSERT INTO `tbl_emp_reports` (`reportId`, `reportDesc`, `employeeId`, `reportDate`, `clientId`, `reportStat`, `adminDes`) VALUES
(1, 'Always late and sleeping in work!', 2, '2015-10-05', 1, 'examined', 'void report');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_endorsement`
--

CREATE TABLE `tbl_endorsement` (
  `endorsementId` int(6) NOT NULL,
  `applicantId` int(6) NOT NULL,
  `clientId` int(6) NOT NULL,
  `jobPostingId` int(6) NOT NULL,
  `endorsementDate` date NOT NULL,
  `endorsementDecision` varchar(150) DEFAULT NULL,
  `endorsementDecisionDate` date DEFAULT NULL,
  `endorsementStatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_endorsement`
--

INSERT INTO `tbl_endorsement` (`endorsementId`, `applicantId`, `clientId`, `jobPostingId`, `endorsementDate`, `endorsementDecision`, `endorsementDecisionDate`, `endorsementStatus`) VALUES
(1, 2, 1, 1, '2015-10-05', 'Passed', '2015-10-05', 'Employed'),
(3, 1, 1, 3, '2015-10-05', 'Passed', '2015-10-05', 'Employed'),
(4, 3, 1, 2, '2015-10-05', 'Failed', '2015-10-05', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation`
--

CREATE TABLE `tbl_evaluation` (
  `evalId` int(6) NOT NULL,
  `dateEvaluated` datetime NOT NULL,
  `remsValue` decimal(6,0) NOT NULL,
  `clientId` int(6) DEFAULT NULL,
  `employeeId` int(6) NOT NULL,
  `evalComment` varchar(1000) NOT NULL,
  `commentScore` decimal(6,0) NOT NULL,
  `quality` decimal(6,0) NOT NULL,
  `productivity` decimal(6,0) DEFAULT NULL,
  `jobknowledge` decimal(6,0) DEFAULT NULL,
  `reliability` decimal(6,0) DEFAULT NULL,
  `attendance` decimal(6,0) DEFAULT NULL,
  `initiative` decimal(6,0) DEFAULT NULL,
  `teamwork` decimal(6,0) DEFAULT NULL,
  `policy` decimal(6,0) DEFAULT NULL,
  `customer` decimal(6,0) DEFAULT NULL,
  `other` decimal(6,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_evaluation`
--

INSERT INTO `tbl_evaluation` (`evalId`, `dateEvaluated`, `remsValue`, `clientId`, `employeeId`, `evalComment`, `commentScore`, `quality`, `productivity`, `jobknowledge`, `reliability`, `attendance`, `initiative`, `teamwork`, `policy`, `customer`, `other`) VALUES
(1, '2015-10-05 21:36:41', '47', 1, 1, 'This employee is performing well and trustworthy.', '0', '3', '4', '5', '5', '5', '5', '5', '5', '5', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `examId` int(6) NOT NULL,
  `subjectId` int(6) NOT NULL,
  `jobPostingId` int(6) NOT NULL,
  `examTitle` varchar(500) NOT NULL,
  `examCode` varchar(50) NOT NULL,
  `examPassingGrade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family_background`
--

CREATE TABLE `tbl_family_background` (
  `familyId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `familySpouse` varchar(250) DEFAULT NULL,
  `familySpouseAdd` varchar(250) DEFAULT NULL,
  `familySpouseJob` varchar(250) DEFAULT NULL,
  `fatherName` varchar(250) NOT NULL,
  `fatherJob` varchar(250) DEFAULT NULL,
  `motherName` varchar(250) NOT NULL,
  `motherJob` varchar(250) DEFAULT NULL,
  `emergencyNotifyName` varchar(250) NOT NULL,
  `emergencyNotifyAddress` varchar(250) NOT NULL,
  `emergencyNotifyContact` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_family_background`
--

INSERT INTO `tbl_family_background` (`familyId`, `basicId`, `familySpouse`, `familySpouseAdd`, `familySpouseJob`, `fatherName`, `fatherJob`, `motherName`, `motherJob`, `emergencyNotifyName`, `emergencyNotifyAddress`, `emergencyNotifyContact`) VALUES
(1, 5, '', '', '', 'roberto manuel', 'roberto manuel', 'purificasion sagun', 'housewife', 'christopher manuel', 'bocaue bulacan', '09263135367'),
(2, 4, '', '', '', 'sonny boy pacudan', 'sonny boy pacudan', 'leova pacudan', 'house wife', 'marc brozo', 'montalban, rizal', '09269450664'),
(3, 6, '', '', '', 'stephen guiao', 'stephen guiao', 'fe giron guiao', 'housewife', 'andrea guiao', 'malanday, valenzuela', '09386524378'),
(4, 8, '', '', '', 'my father', 'my father', 'my mother', 'mother occupation', 'person', 'address', '11111111111');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_insurance_info`
--

CREATE TABLE `tbl_insurance_info` (
  `insuranceId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `benificiaryName` varchar(250) NOT NULL,
  `benificiaryAdd` varchar(250) NOT NULL,
  `benificiaryRelationship` varchar(250) NOT NULL,
  `benificiaryDob` varchar(250) NOT NULL,
  `benificiaryGender` varchar(250) NOT NULL,
  `benificaryAge` int(3) NOT NULL,
  `benificiaryCivil` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_insurance_info`
--

INSERT INTO `tbl_insurance_info` (`insuranceId`, `basicId`, `benificiaryName`, `benificiaryAdd`, `benificiaryRelationship`, `benificiaryDob`, `benificiaryGender`, `benificaryAge`, `benificiaryCivil`) VALUES
(1, 5, '', 'bocaue bulacan', 'sibling', '2002/05/17', 'male', 13, 'single'),
(2, 4, '', 'marikina city', 'mother', '1970/09/20', 'female', 45, 'married'),
(3, 6, '', 'malanday, valenzuela', 'sister', '1982/01/10', 'female', 33, 'single'),
(4, 8, '', 'address', 'secret', '2003/02/11', 'male', 12, 'single');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_posting`
--

CREATE TABLE `tbl_job_posting` (
  `jobPostingId` int(6) NOT NULL,
  `clientId` int(6) NOT NULL,
  `jobName` varchar(250) NOT NULL,
  `jobDescription` varchar(500) DEFAULT NULL,
  `jobStatus` int(1) NOT NULL,
  `jobVacancy` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_posting`
--

INSERT INTO `tbl_job_posting` (`jobPostingId`, `clientId`, `jobName`, `jobDescription`, `jobStatus`, `jobVacancy`) VALUES
(1, 1, 'Sales lady', '', 0, 0),
(2, 1, 'Guard', '', 1, 2),
(3, 1, 'Cashier', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_quali`
--

CREATE TABLE `tbl_job_quali` (
  `jobQualiId` int(6) NOT NULL,
  `jobPostingId` int(6) NOT NULL,
  `jobQualiDescription` varchar(250) NOT NULL,
  `jobQualiType` varchar(250) NOT NULL,
  `jobQualiNewlyAdded` varchar(10) DEFAULT NULL,
  `jobQualiPercent` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_quali`
--

INSERT INTO `tbl_job_quali` (`jobQualiId`, `jobPostingId`, `jobQualiDescription`, `jobQualiType`, `jobQualiNewlyAdded`, `jobQualiPercent`) VALUES
(1, 1, '10000', 'Expected Salary', NULL, '10'),
(2, 1, 'Female', 'Gender', NULL, '10'),
(3, 1, '21', 'Age From', NULL, NULL),
(4, 1, '26', 'Age To', NULL, '30'),
(5, 1, 'Any', 'Civil Status', NULL, '5'),
(6, 1, 'Any', 'Religion', NULL, '0'),
(7, 1, 'Any', 'Nationality', NULL, '0'),
(8, 1, 'Any', 'Height', NULL, '10'),
(9, 1, 'Any', 'Weight', NULL, '10'),
(10, 1, 'Filipino', 'Language', 'Yes', '5'),
(11, 1, 'English', 'Language', 'Yes', '5'),
(12, 1, 'Filipino', 'Language', NULL, '5'),
(13, 1, 'English', 'Language', NULL, '5'),
(14, 1, 'Well-groomed appearance', 'Quality', 'Yes', '3'),
(15, 1, 'Polite, respectful, and courteous manners', 'Quality', 'Yes', '3'),
(16, 1, 'Possess excellent communication and inter-personal skills', 'Quality', 'Yes', '3'),
(17, 1, 'Self-motivated; able to learn on own initiative', 'Quality', 'Yes', '3'),
(18, 1, 'Versatile and multi-skilled person', 'Quality', 'Yes', '3'),
(19, 1, 'Well-groomed appearance', 'Quality', NULL, '3'),
(20, 1, 'Polite, respectful, and courteous manners', 'Quality', NULL, '3'),
(21, 1, 'Possess excellent communication and inter-personal skills', 'Quality', NULL, '3'),
(22, 1, 'Self-motivated; able to learn on own initiative', 'Quality', NULL, '3'),
(23, 1, 'Versatile and multi-skilled person', 'Quality', NULL, '3'),
(24, 2, '15000', 'Expected Salary', NULL, '10'),
(25, 2, 'Any', 'Gender', NULL, '20'),
(26, 2, '30', 'Age From', NULL, NULL),
(27, 2, '45', 'Age To', NULL, '40'),
(28, 2, 'Any', 'Civil Status', NULL, '0'),
(29, 2, 'Any', 'Religion', NULL, '0'),
(30, 2, 'Any', 'Nationality', NULL, '0'),
(31, 2, 'Any', 'Height', NULL, '0'),
(32, 2, 'Any', 'Weight', NULL, '0'),
(33, 2, 'Filipino', 'Language', NULL, '5'),
(34, 2, 'English', 'Language', NULL, '5'),
(35, 2, 'Self-motivated; able to learn on own initiative', 'Quality', 'Yes', '6.66666666'),
(36, 2, 'Possess excellent communication and inter-personal skills', 'Quality', 'Yes', '6.66666666'),
(37, 2, 'Proven competence in working with others in a team effort', 'Quality', 'Yes', '6.66666666'),
(38, 2, 'Self-motivated; able to learn on own initiative', 'Quality', NULL, '6.66666666'),
(39, 2, 'Possess excellent communication and inter-personal skills', 'Quality', NULL, '6.66666666'),
(40, 2, 'Proven competence in working with others in a team effort', 'Quality', NULL, '6.66666666'),
(41, 3, '25000', 'Expected Salary', NULL, '10'),
(42, 3, 'Female', 'Gender', NULL, '30'),
(43, 3, '25', 'Age From', NULL, NULL),
(44, 3, '30', 'Age To', NULL, '20'),
(45, 3, 'Single', 'Civil Status', NULL, '10'),
(46, 3, 'Any', 'Religion', NULL, '0'),
(47, 3, 'Any', 'Nationality', NULL, '0'),
(48, 3, 'Any', 'Height', NULL, '0'),
(49, 3, 'Any', 'Weight', NULL, '0'),
(50, 3, 'Filipino', 'Language', NULL, '5'),
(51, 3, 'English', 'Language', NULL, '5'),
(52, 3, 'Excellent record of dependability and reliability', 'Quality', 'Yes', '6.66666666'),
(53, 3, 'Proficient in the use of computers', 'Quality', 'Yes', '6.66666666'),
(54, 3, 'Responsible, dependable, punctual; take pride in work', 'Quality', 'Yes', '6.66666666'),
(55, 3, 'Skilled in handling the public with diplomacy and professionalism', 'Quality', 'Yes', '6.66666666'),
(56, 3, 'Excellent record of dependability and reliability', 'Quality', NULL, '6.66666666'),
(57, 3, 'Responsible, dependable, punctual; take pride in work', 'Quality', NULL, '6.66666666'),
(58, 3, 'Skilled in handling the public with diplomacy and professionalism', 'Quality', NULL, '6.66666666');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `notifId` int(6) NOT NULL,
  `jobPostingId` int(6) DEFAULT NULL,
  `clientId` int(6) DEFAULT NULL,
  `applicantId` int(6) DEFAULT NULL,
  `employeeId` int(6) DEFAULT NULL,
  `notifDesc` varchar(1000) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `notifStatus` varchar(50) DEFAULT NULL,
  `notifUser` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`notifId`, `jobPostingId`, `clientId`, `applicantId`, `employeeId`, `notifDesc`, `dateCreated`, `notifStatus`, `notifUser`) VALUES
(1, NULL, 1, NULL, NULL, 'registered as a client.', '2015-10-05 20:43:27', 'seen', 'admin'),
(2, NULL, 1, NULL, NULL, '. Partnership was successfully done.', '2015-10-05 20:46:45', 'seen', 'client'),
(3, 1, NULL, NULL, NULL, 'posted a new job.', '2015-10-05 20:55:52', 'seen', 'admin'),
(4, 2, NULL, NULL, NULL, 'posted a new job.', '2015-10-05 21:00:40', 'seen', 'admin'),
(5, 3, NULL, NULL, NULL, 'posted a new job.', '2015-10-05 21:04:14', 'seen', 'admin'),
(6, NULL, 1, 2, NULL, 'was endorsed to', '2015-10-05 21:25:58', 'seen', 'client'),
(8, NULL, 1, 1, NULL, 'was endorsed to', '2015-10-05 21:29:23', 'seen', 'client'),
(9, NULL, 1, 3, NULL, 'was endorsed to', '2015-10-05 21:30:37', 'seen', 'client'),
(10, NULL, 1, NULL, NULL, 'accepted an applicant.', '2015-10-05 21:31:47', 'seen', 'admin'),
(11, NULL, 1, NULL, NULL, 'accepted an applicant.', '2015-10-05 21:32:07', 'seen', 'admin'),
(12, NULL, 1, NULL, NULL, 'rejected an applicant.', '2015-10-05 21:32:24', 'seen', 'admin'),
(13, NULL, 1, NULL, 1, 'is now an employee of', '2015-10-05 21:33:00', 'seen', 'client'),
(14, NULL, 1, NULL, 2, 'is now an employee of', '2015-10-05 21:34:25', 'seen', 'client'),
(15, NULL, 3, NULL, NULL, 'registered as a client.', '2016-02-07 03:17:42', 'seen', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_other`
--

CREATE TABLE `tbl_other` (
  `otherId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `otherLabelName` varchar(250) NOT NULL,
  `otherDescription` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_other`
--

INSERT INTO `tbl_other` (`otherId`, `basicId`, `otherLabelName`, `otherDescription`) VALUES
(1, 4, 'Driver License', ''),
(2, 5, 'Driver License', ''),
(3, 6, 'PhilHealth', '667655678'),
(4, 8, 'Driver License', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personal_info`
--

CREATE TABLE `tbl_personal_info` (
  `personalId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `personalQualityDesc` varchar(500) NOT NULL,
  `personalQualityType` varchar(500) NOT NULL,
  `personalQualityNewlyAdded` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_personal_info`
--

INSERT INTO `tbl_personal_info` (`personalId`, `basicId`, `personalQualityDesc`, `personalQualityType`, `personalQualityNewlyAdded`) VALUES
(1, 5, '19', 'Age', NULL),
(2, 5, 'Female', 'Gender', NULL),
(3, 5, 'Single', 'Civil Status', NULL),
(4, 5, '1.5', 'Height', NULL),
(5, 5, '60', 'Weight', NULL),
(6, 5, 'Roman catholic', 'Religion', NULL),
(7, 5, 'Filipino', 'Nationality', NULL),
(8, 5, 'Korean', 'Language', 'Yes'),
(9, 5, 'Japanese', 'Language', 'Yes'),
(10, 4, '19', 'Age', NULL),
(11, 4, 'Female', 'Gender', NULL),
(12, 4, 'Single', 'Civil Status', NULL),
(13, 4, '3', 'Height', NULL),
(14, 4, '55', 'Weight', NULL),
(15, 4, 'Roman catholic', 'Religion', NULL),
(16, 4, 'Filipino', 'Nationality', NULL),
(17, 5, 'Filipino', 'Language', NULL),
(18, 5, 'English', 'Language', NULL),
(19, 4, 'Filipino', 'Language', NULL),
(20, 4, 'English', 'Language', NULL),
(21, 6, '20', 'Age', NULL),
(22, 6, 'Male', 'Gender', NULL),
(23, 6, 'Single', 'Civil Status', NULL),
(24, 6, '3', 'Height', NULL),
(25, 6, '60', 'Weight', NULL),
(26, 6, 'Roman catholic', 'Religion', NULL),
(27, 6, 'Filipino', 'Nationality', NULL),
(28, 6, 'Filipino', 'Language', NULL),
(29, 4, '15000', 'Expected Salary', NULL),
(30, 5, '20000', 'Expected Salary', NULL),
(41, 5, 'Well-groomed appearance', 'Quality', NULL),
(42, 5, 'Polite, respectful, and courteous manners', 'Quality', NULL),
(43, 5, 'Possess excellent communication and inter-personal skills', 'Quality', NULL),
(44, 5, 'Self-motivated; able to learn on own initiative', 'Quality', NULL),
(45, 5, 'Proficient in the use of computers', 'Quality', NULL),
(46, 5, 'Responsible, dependable, punctual; take pride in work', 'Quality', NULL),
(47, 5, 'Skilled in handling the public with diplomacy and professionalism', 'Quality', NULL),
(48, 6, '', 'Expected Salary', NULL),
(49, 4, 'Well-groomed appearance', 'Quality', NULL),
(50, 4, 'Polite, respectful, and courteous manners', 'Quality', NULL),
(51, 4, 'Possess excellent communication and inter-personal skills', 'Quality', NULL),
(52, 4, 'Self-motivated; able to learn on own initiative', 'Quality', NULL),
(53, 4, 'Versatile and multi-skilled person', 'Quality', NULL),
(54, 4, 'Proven competence in working with others in a team effort', 'Quality', NULL),
(55, 4, 'Excellent record of dependability and reliability', 'Quality', NULL),
(56, 4, 'Proficient in the use of computers', 'Quality', NULL),
(57, 4, 'Responsible, dependable, punctual; take pride in work', 'Quality', NULL),
(58, 4, 'Skilled in handling the public with diplomacy and professionalism', 'Quality', NULL),
(73, 6, 'Self-motivated; able to learn on own initiative', 'Quality', NULL),
(74, 6, 'Possess excellent communication and inter-personal skills', 'Quality', NULL),
(75, 6, 'Proven competence in working with others in a team effort', 'Quality', NULL),
(76, 6, 'Excellent record of dependability and reliability', 'Quality', NULL),
(77, 6, 'Proficient in the use of computers', 'Quality', NULL),
(78, 6, 'Responsible, dependable, punctual; take pride in work', 'Quality', NULL),
(79, 6, 'Skilled in handling the public with diplomacy and professionalism', 'Quality', NULL),
(80, 8, '20', 'Age', NULL),
(81, 8, 'Male', 'Gender', NULL),
(82, 8, 'Single', 'Civil Status', NULL),
(83, 8, '1.2', 'Height', NULL),
(84, 8, '50', 'Weight', NULL),
(85, 8, 'Roman catholic', 'Religion', NULL),
(86, 8, 'Filipino', 'Nationality', NULL),
(87, 8, 'Filipino', 'Language', NULL),
(88, 8, 'English', 'Language', NULL),
(89, 8, '2223', 'Expected Salary', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_picture`
--

CREATE TABLE `tbl_picture` (
  `picId` int(1) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `picDesc` varchar(5000) NOT NULL,
  `agencyAddress` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_picture`
--

INSERT INTO `tbl_picture` (`picId`, `filename`, `picDesc`, `agencyAddress`) VALUES
(1, 'uploadImage/head.jpg', 'REMS: Recruitment and Employee Performance Monitoring System', 'The One Executive Building West Ave, Quezon City'),
(2, 'uploadImage/bg.jpg', 'daddasdsa', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_process_record`
--

CREATE TABLE `tbl_process_record` (
  `processId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `accountId` int(6) NOT NULL,
  `processName` varchar(250) NOT NULL,
  `processDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `questionId` int(6) NOT NULL,
  `examId` int(6) NOT NULL,
  `questionDesc` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `subjectId` int(6) NOT NULL,
  `subjectName` varchar(500) NOT NULL,
  `subjectStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type_of_business`
--

CREATE TABLE `tbl_type_of_business` (
  `typeOfBusinessId` int(6) NOT NULL,
  `typeOfBusinessName` varchar(250) NOT NULL,
  `typeOfBusinessStatus` int(2) NOT NULL,
  `typeOfBusinessDescription` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_type_of_business`
--

INSERT INTO `tbl_type_of_business` (`typeOfBusinessId`, `typeOfBusinessName`, `typeOfBusinessStatus`, `typeOfBusinessDescription`) VALUES
(1, 'Supermarket', 1, '24/7 Supermarket'),
(2, 'Apparel', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_account`
--

CREATE TABLE `tbl_user_account` (
  `accountId` int(6) NOT NULL,
  `basicId` int(6) DEFAULT NULL,
  `clientId` int(6) DEFAULT NULL,
  `accountRole` varchar(250) NOT NULL,
  `accountUsername` varchar(250) NOT NULL,
  `accountPassword` varchar(250) NOT NULL,
  `accountNotes` varchar(500) DEFAULT NULL,
  `accountStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_account`
--

INSERT INTO `tbl_user_account` (`accountId`, `basicId`, `clientId`, `accountRole`, `accountUsername`, `accountPassword`, `accountNotes`, `accountStatus`) VALUES
(1, 1, NULL, 'admin', 'admin', 'admin', NULL, 1),
(2, NULL, 1, 'client', '2015-CLN-00001', '2015-CLN-00001', '', 1),
(3, NULL, 2, 'client', '2015-CLN-00002', '2015-CLN-00002', '', 0),
(4, NULL, 3, 'client', '2016-CLN-00003', '2016-CLN-00003', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_work`
--

CREATE TABLE `tbl_work` (
  `workId` int(6) NOT NULL,
  `basicId` int(6) NOT NULL,
  `companyName` varchar(250) DEFAULT NULL,
  `workYear` varchar(250) DEFAULT NULL,
  `workPosition` varchar(250) DEFAULT NULL,
  `workSalary` varchar(250) DEFAULT NULL,
  `workSupervisor` varchar(250) DEFAULT NULL,
  `workLeavingReason` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_work`
--

INSERT INTO `tbl_work` (`workId`, `basicId`, `companyName`, `workYear`, `workPosition`, `workSalary`, `workSupervisor`, `workLeavingReason`) VALUES
(1, 4, '', '', '', '', '', ''),
(2, 5, '', '', '', '', '', ''),
(3, 6, 'Wideout', '2014', 'Assistant', 'Php 15,000', 'Manager', ''),
(4, 8, '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `basicId` (`basicId`),
  ADD KEY `clientId` (`clientId`);

--
-- Indexes for table `tbl_answerkey`
--
ALTER TABLE `tbl_answerkey`
  ADD PRIMARY KEY (`answerKeyId`),
  ADD KEY `questionId` (`questionId`),
  ADD KEY `choiceId` (`choiceId`);

--
-- Indexes for table `tbl_applicant`
--
ALTER TABLE `tbl_applicant`
  ADD PRIMARY KEY (`applicantId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_applicant_exam`
--
ALTER TABLE `tbl_applicant_exam`
  ADD PRIMARY KEY (`applicantExamId`),
  ADD KEY `applicantId` (`applicantId`),
  ADD KEY `examId` (`examId`);

--
-- Indexes for table `tbl_applicant_exam_answers`
--
ALTER TABLE `tbl_applicant_exam_answers`
  ADD PRIMARY KEY (`answerId`),
  ADD KEY `applicantId` (`applicantId`),
  ADD KEY `questionId` (`questionId`),
  ADD KEY `choiceId` (`choiceId`);

--
-- Indexes for table `tbl_basic_info`
--
ALTER TABLE `tbl_basic_info`
  ADD PRIMARY KEY (`basicId`);

--
-- Indexes for table `tbl_character`
--
ALTER TABLE `tbl_character`
  ADD PRIMARY KEY (`characterId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_child`
--
ALTER TABLE `tbl_child`
  ADD PRIMARY KEY (`childId`),
  ADD KEY `familyId` (`familyId`);

--
-- Indexes for table `tbl_choice`
--
ALTER TABLE `tbl_choice`
  ADD PRIMARY KEY (`choiceId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD PRIMARY KEY (`clientId`),
  ADD KEY `typeOfBusinessId` (`typeOfBusinessId`);

--
-- Indexes for table `tbl_contact_info`
--
ALTER TABLE `tbl_contact_info`
  ADD PRIMARY KEY (`contactInfoId`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`contentId`);

--
-- Indexes for table `tbl_contract`
--
ALTER TABLE `tbl_contract`
  ADD PRIMARY KEY (`contractId`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `employeeId` (`employeeId`);

--
-- Indexes for table `tbl_delinquent`
--
ALTER TABLE `tbl_delinquent`
  ADD PRIMARY KEY (`delinquentId`),
  ADD KEY `employeeId` (`employeeId`);

--
-- Indexes for table `tbl_desired_position`
--
ALTER TABLE `tbl_desired_position`
  ADD PRIMARY KEY (`desiredPositionId`),
  ADD KEY `applicantId` (`applicantId`);

--
-- Indexes for table `tbl_education`
--
ALTER TABLE `tbl_education`
  ADD PRIMARY KEY (`educationId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employeeId`),
  ADD KEY `applicantId` (`applicantId`),
  ADD KEY `jobPostingId` (`jobPostingId`);

--
-- Indexes for table `tbl_emp_reports`
--
ALTER TABLE `tbl_emp_reports`
  ADD PRIMARY KEY (`reportId`);

--
-- Indexes for table `tbl_endorsement`
--
ALTER TABLE `tbl_endorsement`
  ADD PRIMARY KEY (`endorsementId`),
  ADD KEY `applicantId` (`applicantId`),
  ADD KEY `clientId` (`clientId`);

--
-- Indexes for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  ADD PRIMARY KEY (`evalId`),
  ADD KEY `employeeId` (`employeeId`),
  ADD KEY `clientId` (`clientId`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`examId`),
  ADD KEY `subjectId` (`subjectId`),
  ADD KEY `jobPostingId` (`jobPostingId`);

--
-- Indexes for table `tbl_family_background`
--
ALTER TABLE `tbl_family_background`
  ADD PRIMARY KEY (`familyId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_insurance_info`
--
ALTER TABLE `tbl_insurance_info`
  ADD PRIMARY KEY (`insuranceId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_job_posting`
--
ALTER TABLE `tbl_job_posting`
  ADD PRIMARY KEY (`jobPostingId`),
  ADD KEY `clientId` (`clientId`);

--
-- Indexes for table `tbl_job_quali`
--
ALTER TABLE `tbl_job_quali`
  ADD PRIMARY KEY (`jobQualiId`),
  ADD KEY `jobPostingId` (`jobPostingId`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`notifId`),
  ADD KEY `jobPostingId` (`jobPostingId`),
  ADD KEY `clientId` (`clientId`),
  ADD KEY `applicantId` (`applicantId`),
  ADD KEY `employeeId` (`employeeId`);

--
-- Indexes for table `tbl_other`
--
ALTER TABLE `tbl_other`
  ADD PRIMARY KEY (`otherId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_personal_info`
--
ALTER TABLE `tbl_personal_info`
  ADD PRIMARY KEY (`personalId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_picture`
--
ALTER TABLE `tbl_picture`
  ADD PRIMARY KEY (`picId`);

--
-- Indexes for table `tbl_process_record`
--
ALTER TABLE `tbl_process_record`
  ADD PRIMARY KEY (`processId`),
  ADD KEY `accountId` (`accountId`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`questionId`),
  ADD KEY `examId` (`examId`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `tbl_type_of_business`
--
ALTER TABLE `tbl_type_of_business`
  ADD PRIMARY KEY (`typeOfBusinessId`);

--
-- Indexes for table `tbl_user_account`
--
ALTER TABLE `tbl_user_account`
  ADD PRIMARY KEY (`accountId`),
  ADD KEY `basicId` (`basicId`);

--
-- Indexes for table `tbl_work`
--
ALTER TABLE `tbl_work`
  ADD PRIMARY KEY (`workId`),
  ADD KEY `basicId` (`basicId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `addressId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_answerkey`
--
ALTER TABLE `tbl_answerkey`
  MODIFY `answerKeyId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_applicant`
--
ALTER TABLE `tbl_applicant`
  MODIFY `applicantId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_applicant_exam`
--
ALTER TABLE `tbl_applicant_exam`
  MODIFY `applicantExamId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_applicant_exam_answers`
--
ALTER TABLE `tbl_applicant_exam_answers`
  MODIFY `answerId` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_basic_info`
--
ALTER TABLE `tbl_basic_info`
  MODIFY `basicId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_character`
--
ALTER TABLE `tbl_character`
  MODIFY `characterId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_child`
--
ALTER TABLE `tbl_child`
  MODIFY `childId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_choice`
--
ALTER TABLE `tbl_choice`
  MODIFY `choiceId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_client`
--
ALTER TABLE `tbl_client`
  MODIFY `clientId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_contact_info`
--
ALTER TABLE `tbl_contact_info`
  MODIFY `contactInfoId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `contentId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_contract`
--
ALTER TABLE `tbl_contract`
  MODIFY `contractId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_delinquent`
--
ALTER TABLE `tbl_delinquent`
  MODIFY `delinquentId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_desired_position`
--
ALTER TABLE `tbl_desired_position`
  MODIFY `desiredPositionId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_education`
--
ALTER TABLE `tbl_education`
  MODIFY `educationId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employeeId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_emp_reports`
--
ALTER TABLE `tbl_emp_reports`
  MODIFY `reportId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_endorsement`
--
ALTER TABLE `tbl_endorsement`
  MODIFY `endorsementId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  MODIFY `evalId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `examId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_family_background`
--
ALTER TABLE `tbl_family_background`
  MODIFY `familyId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_insurance_info`
--
ALTER TABLE `tbl_insurance_info`
  MODIFY `insuranceId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_job_posting`
--
ALTER TABLE `tbl_job_posting`
  MODIFY `jobPostingId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_job_quali`
--
ALTER TABLE `tbl_job_quali`
  MODIFY `jobQualiId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `notifId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_other`
--
ALTER TABLE `tbl_other`
  MODIFY `otherId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_personal_info`
--
ALTER TABLE `tbl_personal_info`
  MODIFY `personalId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `tbl_picture`
--
ALTER TABLE `tbl_picture`
  MODIFY `picId` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_process_record`
--
ALTER TABLE `tbl_process_record`
  MODIFY `processId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `questionId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subjectId` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_type_of_business`
--
ALTER TABLE `tbl_type_of_business`
  MODIFY `typeOfBusinessId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user_account`
--
ALTER TABLE `tbl_user_account`
  MODIFY `accountId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_work`
--
ALTER TABLE `tbl_work`
  MODIFY `workId` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD CONSTRAINT `tbl_address_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`),
  ADD CONSTRAINT `tbl_address_ibfk_2` FOREIGN KEY (`clientId`) REFERENCES `tbl_client` (`clientId`);

--
-- Constraints for table `tbl_answerkey`
--
ALTER TABLE `tbl_answerkey`
  ADD CONSTRAINT `tbl_answerkey_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `tbl_question` (`questionId`),
  ADD CONSTRAINT `tbl_answerkey_ibfk_2` FOREIGN KEY (`choiceId`) REFERENCES `tbl_choice` (`choiceId`);

--
-- Constraints for table `tbl_applicant`
--
ALTER TABLE `tbl_applicant`
  ADD CONSTRAINT `tbl_applicant_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_applicant_exam`
--
ALTER TABLE `tbl_applicant_exam`
  ADD CONSTRAINT `tbl_applicant_exam_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `tbl_applicant` (`applicantId`),
  ADD CONSTRAINT `tbl_applicant_exam_ibfk_2` FOREIGN KEY (`examId`) REFERENCES `tbl_exam` (`examId`);

--
-- Constraints for table `tbl_applicant_exam_answers`
--
ALTER TABLE `tbl_applicant_exam_answers`
  ADD CONSTRAINT `tbl_applicant_exam_answers_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `tbl_applicant` (`applicantId`),
  ADD CONSTRAINT `tbl_applicant_exam_answers_ibfk_2` FOREIGN KEY (`questionId`) REFERENCES `tbl_question` (`questionId`),
  ADD CONSTRAINT `tbl_applicant_exam_answers_ibfk_3` FOREIGN KEY (`choiceId`) REFERENCES `tbl_choice` (`choiceId`);

--
-- Constraints for table `tbl_character`
--
ALTER TABLE `tbl_character`
  ADD CONSTRAINT `tbl_character_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_child`
--
ALTER TABLE `tbl_child`
  ADD CONSTRAINT `tbl_child_ibfk_1` FOREIGN KEY (`familyId`) REFERENCES `tbl_family_background` (`familyId`);

--
-- Constraints for table `tbl_choice`
--
ALTER TABLE `tbl_choice`
  ADD CONSTRAINT `tbl_choice_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `tbl_question` (`questionId`);

--
-- Constraints for table `tbl_client`
--
ALTER TABLE `tbl_client`
  ADD CONSTRAINT `tbl_client_ibfk_1` FOREIGN KEY (`typeOfBusinessId`) REFERENCES `tbl_type_of_business` (`typeOfBusinessId`);

--
-- Constraints for table `tbl_contact_info`
--
ALTER TABLE `tbl_contact_info`
  ADD CONSTRAINT `tbl_contact_info_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `tbl_client` (`clientId`),
  ADD CONSTRAINT `tbl_contact_info_ibfk_2` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_contract`
--
ALTER TABLE `tbl_contract`
  ADD CONSTRAINT `tbl_contract_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `tbl_client` (`clientId`),
  ADD CONSTRAINT `tbl_contract_ibfk_2` FOREIGN KEY (`employeeId`) REFERENCES `tbl_employee` (`employeeId`);

--
-- Constraints for table `tbl_delinquent`
--
ALTER TABLE `tbl_delinquent`
  ADD CONSTRAINT `tbl_delinquent_ibfk_1` FOREIGN KEY (`employeeId`) REFERENCES `tbl_employee` (`employeeId`);

--
-- Constraints for table `tbl_desired_position`
--
ALTER TABLE `tbl_desired_position`
  ADD CONSTRAINT `tbl_desired_position_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `tbl_applicant` (`applicantId`);

--
-- Constraints for table `tbl_education`
--
ALTER TABLE `tbl_education`
  ADD CONSTRAINT `tbl_education_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD CONSTRAINT `tbl_employee_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `tbl_applicant` (`applicantId`),
  ADD CONSTRAINT `tbl_employee_ibfk_2` FOREIGN KEY (`jobPostingId`) REFERENCES `tbl_job_posting` (`jobPostingId`);

--
-- Constraints for table `tbl_endorsement`
--
ALTER TABLE `tbl_endorsement`
  ADD CONSTRAINT `tbl_endorsement_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `tbl_applicant` (`applicantId`),
  ADD CONSTRAINT `tbl_endorsement_ibfk_2` FOREIGN KEY (`clientId`) REFERENCES `tbl_client` (`clientId`);

--
-- Constraints for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  ADD CONSTRAINT `tbl_evaluation_ibfk_1` FOREIGN KEY (`employeeId`) REFERENCES `tbl_employee` (`employeeId`),
  ADD CONSTRAINT `tbl_evaluation_ibfk_2` FOREIGN KEY (`clientId`) REFERENCES `tbl_client` (`clientId`);

--
-- Constraints for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD CONSTRAINT `tbl_exam_ibfk_1` FOREIGN KEY (`subjectId`) REFERENCES `tbl_subject` (`subjectId`),
  ADD CONSTRAINT `tbl_exam_ibfk_2` FOREIGN KEY (`jobPostingId`) REFERENCES `tbl_job_posting` (`jobPostingId`);

--
-- Constraints for table `tbl_family_background`
--
ALTER TABLE `tbl_family_background`
  ADD CONSTRAINT `tbl_family_background_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_insurance_info`
--
ALTER TABLE `tbl_insurance_info`
  ADD CONSTRAINT `tbl_insurance_info_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_job_posting`
--
ALTER TABLE `tbl_job_posting`
  ADD CONSTRAINT `tbl_job_posting_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `tbl_client` (`clientId`);

--
-- Constraints for table `tbl_job_quali`
--
ALTER TABLE `tbl_job_quali`
  ADD CONSTRAINT `tbl_job_quali_ibfk_1` FOREIGN KEY (`jobPostingId`) REFERENCES `tbl_job_posting` (`jobPostingId`);

--
-- Constraints for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD CONSTRAINT `tbl_notification_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `tbl_client` (`clientId`),
  ADD CONSTRAINT `tbl_notification_ibfk_2` FOREIGN KEY (`jobPostingId`) REFERENCES `tbl_job_posting` (`jobPostingId`),
  ADD CONSTRAINT `tbl_notification_ibfk_3` FOREIGN KEY (`applicantId`) REFERENCES `tbl_applicant` (`applicantId`),
  ADD CONSTRAINT `tbl_notification_ibfk_4` FOREIGN KEY (`employeeId`) REFERENCES `tbl_employee` (`employeeId`);

--
-- Constraints for table `tbl_other`
--
ALTER TABLE `tbl_other`
  ADD CONSTRAINT `tbl_other_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_personal_info`
--
ALTER TABLE `tbl_personal_info`
  ADD CONSTRAINT `tbl_personal_info_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_process_record`
--
ALTER TABLE `tbl_process_record`
  ADD CONSTRAINT `tbl_process_record_ibfk_1` FOREIGN KEY (`accountId`) REFERENCES `tbl_user_account` (`accountId`);

--
-- Constraints for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD CONSTRAINT `tbl_question_ibfk_1` FOREIGN KEY (`examId`) REFERENCES `tbl_exam` (`examId`);

--
-- Constraints for table `tbl_user_account`
--
ALTER TABLE `tbl_user_account`
  ADD CONSTRAINT `tbl_user_account_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

--
-- Constraints for table `tbl_work`
--
ALTER TABLE `tbl_work`
  ADD CONSTRAINT `tbl_work_ibfk_1` FOREIGN KEY (`basicId`) REFERENCES `tbl_basic_info` (`basicId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
