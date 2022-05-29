-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2022 at 02:39 PM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `biodb`
--
CREATE DATABASE IF NOT EXISTS `biodb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `biodb`;

-- --------------------------------------------------------

--
-- Table structure for table `genome`
--

CREATE TABLE IF NOT EXISTS `genome` (
  `GName` varchar(100) DEFAULT NULL,
  `GID` int(11) NOT NULL AUTO_INCREMENT,
  `GSeq` text NOT NULL,
  `UserID` int(11) NOT NULL COMMENT 'orgID',
  `OrgID` int(11) DEFAULT NULL,
  `GDes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`GID`),
  UNIQUE KEY `GName` (`GName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `genome`
--

INSERT INTO `genome` (`GName`, `GID`, `GSeq`, `UserID`, `OrgID`, `GDes`) VALUES
('genn1', 35, 'GGGGGGGGGGGGGCAAAAACTAAAGAGAGAGACTA', 12, 43, 'gene Description'),
('genn2', 36, 'GGGGGGGGGGGGGCAAAAACTTTTTTTTTTTATATATAT', 12, 44, 'This gene founded by salma'),
('Genome Reference Consortium Human Build 38 patch release 14 (GRCh38.p14)', 38, 'AGTCTCGAGAACCAAAGAATTTTTTTTACTACTATACGATAGACATAG', 12, 45, 'The DNA sequence is composed of genomic sequence, primarily finished clones that were sequenced as part of the Human Genome Project. PCR products and WGS shotgun sequence have been added where necessary to fill gaps or correct errors.'),
('CA P5+P6 CHM1 ', 40, 'GCGCGCGCGCGCGCCGCGCGCGCGCGAAAACACACACA\r\nTACTAATATCATCATACTAATATACATATTATATAT\r\nAAATAGATGATAGAT', 12, 46, 'This submission is part of an assembly evaluation organized by the Genome Reference Consortium, in which multiple assemblies derived from the same set of sequencing data will be evaluated in order to identify a precursor that will be used as the basis for continued assembly improvement and curation.'),
('BRCA1&#8194;–&#8194;BRCA1 DNA repair associated', 41, 'GCTGAGACTTCCTGGACGGGGGACAGGCTGTGGGGT\r\nTTCT\r\n', 2, 47, 'This gene encodes a 190 kD nuclear phosphoprotein that plays a role in maintaining genomic stability, and it also acts as a tumor suppressor. The BRCA1 gene contains 22 exons spanning about 110 kb of DNA. The encoded protein combines with other tumor suppressors, DNA damage sensors, and signal transducers to form a large multi-subunit protein complex known as the BRCA1-associated genome surveillance complex (BASC). This gene product associates with RNA polymerase II, and through the C-terminal d'),
('gene3', 42, 'GCGAGAGAGAGAGACACACCACA', 2, 45, 'This gene generates several transcript variants which differ in their first exons. At least three alternatively spliced variants encoding distinct proteins have been reported, two of which encode structurally related isoforms known to function as inhibitors of CDK4 kinase. The remaining transcript includes an alternate first exon located 20 Kb upstream of the remainder of the gene; this transcript contains an alternate open reading frame (ARF) that specifies a protein which is structurally unrel'),
('Xgene', 43, 'ACGCTTTCCGCGGCGACATAGCTAGTAGCTAG\r\nTCGATCGTAGCTAGCTGATCGTAGGATGCT', 10, 48, 'the gene that responsible for the gender'),
('Camelus ferus isolate YT-003-E chromosome 1, whole genome shotgun sequence.', 45, 'AAGCGCGAACGACAGACGACAGCAGCAGA\r\nCGACAGCAGACCGACAGCAGACGACGACGAC', 13, 49, ''),
('gen1', 47, '', 14, 50, 'gene description'),
('gene2', 48, 'ACGCATACAG', 14, 51, 'gene2'),
('GENEALAA', 52, '', 15, 53, 'gen');

-- --------------------------------------------------------

--
-- Table structure for table `organ`
--

CREATE TABLE IF NOT EXISTS `organ` (
  `OrgID` int(11) NOT NULL AUTO_INCREMENT,
  `OrgDes` text,
  `OrgName` varchar(200) NOT NULL,
  PRIMARY KEY (`OrgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `organ`
--

INSERT INTO `organ` (`OrgID`, `OrgDes`, `OrgName`) VALUES
(43, 'organism discription', 'organism1'),
(44, 'A new kind of bacteria being discovered ', 'bacteria'),
(45, '', 'Homo sapiens (human)'),
(46, 'a femal human have a cancer ', 'Female Human '),
(47, '', 'Human '),
(48, '', 'Cow'),
(49, '', 'Camelus ferus (Wild Bactrian camel)'),
(50, 'orgains', 'organism'),
(51, 'organ', 'gene2'),
(52, 'organism description', 'organism name'),
(53, 'gene', 'gene');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT 'password',
  `phone` decimal(10,0) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `email`, `phone`, `password`) VALUES
(1, 'Alaafathhyy', 'alaafathy426@gmail.com', '0', '123'),
(6, 'hager', 'hager@gmail,com', '0', 'usbw'),
(10, 'Hussien Fathy', 'hussienfathysroor@gmail.com', '0', '123'),
(12, 'sama', 'sama@gmai.com', '1211658108', '123'),
(13, 'Hager', 'hager@gmail.com', '1211658108', 'usbw');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
