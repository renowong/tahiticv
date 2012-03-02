-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2012 at 07:11 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `renowong_tahiticv`
--

-- --------------------------------------------------------

--
-- Table structure for table `annonces`
--

CREATE TABLE IF NOT EXISTS `annonces` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `activation` tinyint(1) NOT NULL DEFAULT '0',
  `id_annonceur` int(11) NOT NULL COMMENT 'ref table "users"',
  `id_ile` int(11) NOT NULL COMMENT 'ref. table des iles',
  `id_categorie` int(11) NOT NULL COMMENT 'ref. table categories',
  `image` varchar(50) DEFAULT NULL,
  `titre` varchar(100) NOT NULL,
  `ref_interne` varchar(15) NOT NULL COMMENT 'reference interne de l''entreprise',
  `desc_poste` text NOT NULL COMMENT 'description du poste',
  `desc_dip` varchar(100) NOT NULL COMMENT 'description des diplomes requis',
  `desc_exp` text NOT NULL COMMENT 'description experiences requises',
  `desc_comp` text NOT NULL,
  `type_contrat` tinyint(4) NOT NULL COMMENT 'ref a la table "type_contrats"',
  `date_expiration` date NOT NULL COMMENT 'date d''expiration de l''annonce',
  `lat` decimal(17,13) NOT NULL DEFAULT '-17.6292990000000',
  `lon` decimal(17,13) NOT NULL DEFAULT '-149.4545750000000',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `annonces`
--

INSERT INTO `annonces` (`ID`, `activation`, `id_annonceur`, `id_ile`, `id_categorie`, `image`, `titre`, `ref_interne`, `desc_poste`, `desc_dip`, `desc_exp`, `desc_comp`, `type_contrat`, `date_expiration`, `lat`, `lon`) VALUES
(37, 1, 54, 1, 18, NULL, 'Testeur de jeux', 'jeux', 'tester un jeu', 'pas de dipl&ocirc;me', '', '&ecirc;tre un gamer', 3, '2011-06-07', '-17.6292990000000', '-149.4545750000000'),
(55, 1, 54, 2, 14, NULL, 'Entrepreneur', '', 'Construire une maison', 'Baccalaur&eacute;at', '', 'Conna&icirc;tre les bases d&#039;un montage de maison en kit', 1, '2011-06-18', '-17.5802533986860', '-149.5936636306763'),
(56, 1, 54, 2, 18, NULL, 'Serial Noceur', 'test', 'Faire la f&ecirc;te', '', '', 'Boire comme un trou', 1, '2012-02-29', '-17.6292990000000', '-149.4545750000000');

-- --------------------------------------------------------

--
-- Table structure for table `authorisations`
--

CREATE TABLE IF NOT EXISTS `authorisations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_auth` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `authorisations`
--

INSERT INTO `authorisations` (`ID`, `code`, `id_user`, `id_auth`, `date`) VALUES
(35, '861a4fd217c1827d9f065dd74e5ac921', 54, 3, '2012-02-15'),
(34, 'f9df75ad65b04438a78a81a527bf98d1', 54, 3, '2012-02-15'),
(33, 'ff867e24e24aec93382e1c4ebedf7745', 54, 3, '2012-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` varchar(75) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `categorie`) VALUES
(7, 'Agroalimentaire - industries alimentaires'),
(6, 'Agriculture'),
(5, 'A&eacute;ronautique et espace'),
(8, 'Arm&eacute;e - D&eacute;fense - S&eacute;curit&eacute;'),
(9, 'Artisanat et m&eacute;tiers d''art'),
(10, 'Audiovisuel'),
(11, 'Audit, comptabilit&eacute;, gestion'),
(12, 'Automobile'),
(13, 'Banque, assurance'),
(14, 'B&acirc;timent et travaux publics'),
(15, 'Biologie, chimie, pharmacie'),
(16, 'Commerce, distribution'),
(17, 'Communication'),
(18, 'Cr&eacute;ation'),
(19, 'Culture'),
(20, 'Documentation, biblioth&egrave;que'),
(21, 'Droit'),
(22, 'Edition, livre'),
(23, 'Enseignement'),
(24, 'Environnement'),
(25, 'Fonction publique'),
(26, 'Foires, Salons, Congr&egrave;s'),
(27, 'H&ocirc;tellerie, restauration'),
(28, 'Humanitaire'),
(29, 'Immobilier'),
(30, 'Industrie'),
(31, 'Informatique, t&eacute;l&eacute;com, web'),
(32, 'Journalisme'),
(33, 'Langues'),
(34, 'Marketing, publicit&eacute;'),
(35, 'M&eacute;dical'),
(36, 'Mode-textile'),
(37, 'Param&eacute;dical'),
(38, 'Psychologie'),
(39, 'Ressources humaines'),
(40, 'Sciences humaines'),
(41, 'Secr&eacute;tariat'),
(42, 'Social'),
(43, 'Spectacle - M&eacute;tiers de la sc&egrave;ne'),
(44, 'Sport'),
(45, 'Tourisme'),
(46, 'Transport-Logistique');

-- --------------------------------------------------------

--
-- Table structure for table `centre_interets`
--

CREATE TABLE IF NOT EXISTS `centre_interets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cv` int(11) NOT NULL,
  `centre_interet` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `centre_interets`
--

INSERT INTO `centre_interets` (`ID`, `id_cv`, `centre_interet`) VALUES
(1, 3, ''),
(2, 3, ''),
(3, 3, ''),
(4, 3, ''),
(5, 3, ''),
(8, 3, 'Musculation'),
(11, 3, 'Internet'),
(12, 3, 'Films');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE IF NOT EXISTS `certifications` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cv` int(11) NOT NULL,
  `certificat` varchar(60) NOT NULL,
  `ecole` varchar(50) NOT NULL,
  `localisation_ecole` varchar(50) NOT NULL,
  `desc_certificat` varchar(50) NOT NULL,
  `mention` varchar(20) NOT NULL,
  `annee` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`ID`, `id_cv`, `certificat`, `ecole`, `localisation_ecole`, `desc_certificat`, `mention`, `annee`) VALUES
(1, 3, '', '', '', '', '', ''),
(2, 3, '', '', '', '', '', ''),
(19, 22, '', '', '', '', '', ''),
(18, 21, '', '', '', '', '', ''),
(15, 3, 'AA certificate', 'De Anza College', 'California', 'AA certification', 'Nulle', '1998');

-- --------------------------------------------------------

--
-- Table structure for table `competences`
--

CREATE TABLE IF NOT EXISTS `competences` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cv` int(11) NOT NULL DEFAULT '0',
  `expid` int(11) NOT NULL DEFAULT '0',
  `competence` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=180 ;

--
-- Dumping data for table `competences`
--

INSERT INTO `competences` (`ID`, `id_cv`, `expid`, `competence`) VALUES
(143, 22, 0, ''),
(142, 21, 0, ''),
(141, 0, 197, ''),
(137, 3, 0, 'Connaissance de la gamme Microsoft Office'),
(148, 0, 184, 'Travail de groupe'),
(155, 3, 0, 'Ma&icirc;trise de la Dactylographie'),
(157, 3, 0, 'Connaissance des syst&egrave;mes d&#039;exploitations Linux, Mac OS'),
(160, 0, 218, 'test2'),
(161, 26, 0, ''),
(179, 0, 221, 'tst'),
(178, 0, 221, 'test8');

-- --------------------------------------------------------

--
-- Table structure for table `contrats`
--

CREATE TABLE IF NOT EXISTS `contrats` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `contrat` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contrats`
--

INSERT INTO `contrats` (`ID`, `contrat`) VALUES
(1, 'CCD'),
(2, 'CDI'),
(3, 'Stage');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE IF NOT EXISTS `cv` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL COMMENT 'ref table "users"',
  `date_expiration` date NOT NULL DEFAULT '1900-01-01',
  `open` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'si open, annonceur peut voir sans autorisation',
  `auth_ids` varchar(500) NOT NULL DEFAULT '|',
  `image` varchar(50) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `prenom2` varchar(20) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL COMMENT 'va servir a calculer l''age',
  `adresse` varchar(250) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL COMMENT 'site web',
  `objectif` text,
  `educations_ids` varchar(100) DEFAULT NULL COMMENT 'ids sÃƒÂ©parÃƒÂ©s par pipe (|)',
  `experiences_ids` varchar(100) DEFAULT NULL COMMENT 'ids sÃƒÂ©parÃƒÂ©s par pipe (|)',
  `certifications_ids` varchar(100) DEFAULT NULL COMMENT 'ids sÃƒÂ©parÃƒÂ©s par pipe (|)',
  `competences_ids` varchar(100) DEFAULT NULL,
  `langues_ids` varchar(100) DEFAULT NULL,
  `centre_interets_ids` varchar(100) DEFAULT NULL COMMENT 'ids sÃƒÂ©parÃƒÂ©s par pipe (|)',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`ID`, `id_user`, `date_expiration`, `open`, `auth_ids`, `image`, `nom`, `prenom`, `prenom2`, `date_naissance`, `adresse`, `telephone`, `mobile`, `fax`, `email`, `web`, `objectif`, `educations_ids`, `experiences_ids`, `certifications_ids`, `competences_ids`, `langues_ids`, `centre_interets_ids`) VALUES
(1, 7, '1900-01-01', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL),
(2, 54, '1900-01-01', 0, '', NULL, 'Wong', 'test', 'J%E9rome', '1978-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '|22', NULL, '', '', NULL),
(3, 60, '2012-03-15', 0, '|54|', 'med_DSC02761..jpg', 'Wong', 'Reno', 'J&eacute;r&ocirc;me', '1978-01-23', 'bp 932023 Faa&#039;a Centre..', '420805', '282838', '420805', 'renowong@gmail.com', '', 'Gagner beaucoup de sousous!!!!\nEtre riche!!!!!!!!!\nAcheter ce que je veux :D\ntest test test test tetest st test test test test ', '|67|85|', '|221|', '|15|', '|137|155|157|', '|26|38|', '|8|11|12|'),
(4, 59, '1900-01-01', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 61, '1900-01-01', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'o@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 65, '1900-01-01', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 't', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 67, '1900-01-01', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'l', NULL, NULL, NULL, '|194|', NULL, NULL, NULL, NULL),
(21, 70, '1900-01-01', 1, '|', NULL, 'COUX', 'CLARITA', '', '1978-01-18', 'BP 61627\nFAAA', '420805', '718578', '', 'clacoux@yahoo.com', '', 'Mettre mes connaissances au profit de l&#039;entreprise', '|73|', '|198|', '|18|', '|142|', '|27|', NULL),
(22, 71, '1900-01-01', 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 's', NULL, NULL, '|74|', '|200|', '|19|', '|143|', '|28|', NULL),
(23, 72, '2011-06-06', 0, '', NULL, 'o', 'o', 'o', '1951-01-01', '', NULL, NULL, NULL, 'o', NULL, 'test', '|', NULL, NULL, NULL, NULL, NULL),
(24, 74, '2011-06-08', 0, '', NULL, 'j', 'j', 'j', NULL, 'j', '5555555', '55555', '5555', 'j2@cmai.com', NULL, 'jjjjjj', NULL, '|214|', NULL, NULL, NULL, NULL),
(25, 75, '2011-06-26', 0, '|', NULL, 'k', 'k', 'k', NULL, 'kk', NULL, NULL, NULL, 'kk', NULL, 'kk', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 76, '1900-01-01', 0, '|', 'competences', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'michel.lykui@gmail.com', NULL, NULL, NULL, '|220|', NULL, '|161|', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_ver`
--

CREATE TABLE IF NOT EXISTS `db_ver` (
  `version` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_ver`
--

INSERT INTO `db_ver` (`version`) VALUES
(26);

-- --------------------------------------------------------

--
-- Table structure for table `desc_competences_poste`
--

CREATE TABLE IF NOT EXISTS `desc_competences_poste` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_experience` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `desc_competences_poste`
--


-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE IF NOT EXISTS `educations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cv` int(11) NOT NULL,
  `ecole` varchar(50) NOT NULL,
  `localisation_ecole` varchar(50) NOT NULL,
  `type_diplome` int(11) NOT NULL DEFAULT '1' COMMENT 'ref table "type_diplomes"',
  `desc_diplome` varchar(50) NOT NULL,
  `mention` varchar(20) NOT NULL,
  `annee` varchar(4) NOT NULL DEFAULT '1950',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`ID`, `id_cv`, `ecole`, `localisation_ecole`, `type_diplome`, `desc_diplome`, `mention`, `annee`) VALUES
(67, 3, 'SJSU', 'California', 6, 'architectural design', 'Tr&egrave;s bien', '2002'),
(73, 21, 'UNIVERSITE MICHEL DE MONTAIGNE BX 3', 'BORDEAU FRANCE', 4, 'LEA ANGLAIS CHINOIS', '', '2003'),
(74, 22, '', '', 1, '', '', ''),
(85, 3, '', '', 1, 'test', '', '1950');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE IF NOT EXISTS `experiences` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cv` int(11) NOT NULL,
  `lieu` varchar(25) DEFAULT NULL,
  `entreprise` varchar(25) DEFAULT NULL,
  `secteur_id` int(11) NOT NULL DEFAULT '1' COMMENT 'ref : secteur activites',
  `debut_mois` varchar(10) NOT NULL DEFAULT '1',
  `debut_annee` varchar(4) DEFAULT '1950',
  `fin_mois` varchar(10) NOT NULL DEFAULT '1',
  `fin_annee` varchar(4) DEFAULT '1950',
  `present` tinyint(1) DEFAULT NULL COMMENT 'si vrai, alors on ignore fin_mois et fin_annee',
  `titre_poste` varchar(50) DEFAULT NULL,
  `competences_ids` varchar(25) DEFAULT NULL COMMENT 'ids des competences',
  `description` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=222 ;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`ID`, `id_cv`, `lieu`, `entreprise`, `secteur_id`, `debut_mois`, `debut_annee`, `fin_mois`, `fin_annee`, `present`, `titre_poste`, `competences_ids`, `description`) VALUES
(200, 22, NULL, NULL, 1, '1', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(198, 21, 'Faa&#039;a', 'DHL Global Forwarding', 8, '10', '2007', '1', '', 1, 'Exploitante maritime', NULL, 'Suivi des dossiers maritimes'),
(194, 20, NULL, NULL, 1, '1', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(211, 1900930, NULL, NULL, 1, '1', '1950', '1', '1950', NULL, NULL, NULL, NULL),
(212, 1900930, NULL, NULL, 1, '1', '1950', '1', '1950', NULL, NULL, NULL, NULL),
(214, 24, NULL, NULL, 1, '1', '1950', '1', '1950', NULL, 'jjjjj', NULL, NULL),
(220, 26, NULL, NULL, 1, '1', '1950', '1', '1950', NULL, NULL, NULL, NULL),
(221, 3, 'Faa&#039;a', 'Mairie de Faa&#039;a', 7, '1', '2002', '1', '1950', 1, 'Programmeur', '|178|179|', 'Charg&eacute; des &eacute;tudes et d&eacute;veloppement des applications informatique');

-- --------------------------------------------------------

--
-- Table structure for table `iles`
--

CREATE TABLE IF NOT EXISTS `iles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ile` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `iles`
--

INSERT INTO `iles` (`ID`, `ile`) VALUES
(1, 'Tahiti'),
(2, 'Moorea'),
(3, 'Raiatea'),
(4, 'Bora-Bora'),
(5, 'Huahine'),
(6, 'Maupiti'),
(7, 'Rangiroa'),
(8, 'Marquises'),
(9, 'Tuamotu'),
(10, 'Tetiaroa'),
(13, 'Tahaa'),
(12, 'Gambiers'),
(14, 'Maiao'),
(15, 'Mehetia'),
(17, 'Tubuai'),
(18, 'Raivavae'),
(19, 'Rurutu'),
(20, 'Maria'),
(21, 'Iles de Bass'),
(22, 'Iles Marotiri'),
(23, 'Motu One'),
(24, 'Maupihaa'),
(25, 'Manuae'),
(26, 'Tupai'),
(27, 'Nuku Hiva'),
(28, 'Ua Pou'),
(29, 'Hiva Oa');

-- --------------------------------------------------------

--
-- Table structure for table `langues`
--

CREATE TABLE IF NOT EXISTS `langues` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_cv` int(11) NOT NULL,
  `langue` varchar(20) NOT NULL,
  `obs` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `langues`
--

INSERT INTO `langues` (`ID`, `id_cv`, `langue`, `obs`) VALUES
(2, 3, '', ''),
(4, 3, '', ''),
(5, 3, '', ''),
(6, 3, '', ''),
(26, 3, 'Francais', 'Courant'),
(8, 3, 'langue', 'obsssss'),
(9, 3, 'test', 'test'),
(17, 3, 'uuu', 'u'),
(11, 3, 'test3', 'test23'),
(31, 3, 'Anglais', 'Courant'),
(16, 3, '', ''),
(27, 21, '', ''),
(28, 22, '', ''),
(36, 3, 'sdff', 'sdfdsf'),
(38, 3, 'Anglais', 'Fluent');

-- --------------------------------------------------------

--
-- Table structure for table `liste_competences`
--

CREATE TABLE IF NOT EXISTS `liste_competences` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `liste_competences`
--

INSERT INTO `liste_competences` (`ID`, `desc`) VALUES
(1, 'Connaissance de la gamme Microsoft Office'),
(2, 'Ma&icirc;trise de la Dactylographie'),
(3, 'Connaissance des syst&egrave;mes d&apos;exploitations Linux, Mac OS');

-- --------------------------------------------------------

--
-- Table structure for table `liste_diplomes`
--

CREATE TABLE IF NOT EXISTS `liste_diplomes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ordre` int(11) NOT NULL,
  `desc` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `liste_diplomes`
--

INSERT INTO `liste_diplomes` (`ID`, `ordre`, `desc`) VALUES
(1, 1, 'Bac non valid&eacute;'),
(2, 2, 'Lyc&eacute;e, Niveau Bac'),
(3, 3, 'Bac Professionnel, BEP, CAP'),
(4, 4, 'DUT, BTS, Bac + 2'),
(5, 5, 'Dipl&ocirc;me non valid&eacute;'),
(6, 6, 'Licence, Bac + 3'),
(7, 7, 'Ma&icirc;trise, IEP, IUP, Bac + 4'),
(8, 8, 'DESS, DEA, Grandes Ecoles, Bac + 5'),
(9, 9, 'Doctorat, 3&egrave;me cycle'),
(10, 10, 'Expert, Recherche');

-- --------------------------------------------------------

--
-- Table structure for table `liste_mois`
--

CREATE TABLE IF NOT EXISTS `liste_mois` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `liste_mois`
--

INSERT INTO `liste_mois` (`ID`, `desc`) VALUES
(1, 'Janvier'),
(2, 'F&eacute;vrier'),
(3, 'Mars'),
(4, 'Avril'),
(5, 'Mai'),
(6, 'Juin'),
(7, 'Juillet'),
(8, 'Ao&ucirc;t'),
(9, 'Septembre'),
(10, 'Octobre'),
(11, 'Novembre'),
(12, 'D&eacute;cembre');

-- --------------------------------------------------------

--
-- Table structure for table `liste_secteurs`
--

CREATE TABLE IF NOT EXISTS `liste_secteurs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ordre` int(11) NOT NULL,
  `desc` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `liste_secteurs`
--

INSERT INTO `liste_secteurs` (`ID`, `ordre`, `desc`) VALUES
(1, 1, 'Banques, Assurances et Services financiers'),
(2, 2, 'BTP et Immobilier'),
(3, 3, 'Commerce et Distribution'),
(4, 4, 'Communication, M&eacute;dias et Imprimeries'),
(5, 5, 'Etudes, Formation et Conseil'),
(6, 6, 'Industrie'),
(7, 7, 'Informatique, T&eacute;l&eacute;communication et Multim&eacute;dia'),
(8, 8, 'Services'),
(9, 9, 'Tourisme, Voyages et Loisirs');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` mediumint(9) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rs` varchar(25) DEFAULT NULL,
  `tel` varchar(6) DEFAULT NULL,
  `iles_ids` varchar(100) DEFAULT '|',
  `categories_ids` varchar(100) DEFAULT '|',
  `fav_ids` varchar(200) DEFAULT '|',
  `auth_ids` varchar(500) DEFAULT '|',
  `lat` decimal(17,13) NOT NULL DEFAULT '-17.6292990000000',
  `lon` decimal(17,13) NOT NULL DEFAULT '-149.4545750000000',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `type`, `email`, `rs`, `tel`, `iles_ids`, `categories_ids`, `fav_ids`, `auth_ids`, `lat`, `lon`) VALUES
(54, 'rwong', '92b449bccbdf5deee0907d1321526b8b', 1, 'renowong@gmail.com', 'IPE', '824873', '|', '', '|2221|221|3|21|', '|', '-17.6292990000000', '-149.4545750000000'),
(58, 'ronee', 'a6274292881595f7144f67e0e5265edc', 0, 'ronee@gmail.com', '', '', '|', '', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(59, 'jim', '5e027396789a18c37aeda616e3d7991b', 0, 'jim@gmail.com', '', '', '|', '', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(60, 'reno', '41ae5118f87c9f621ef5d66c698e0a94', 0, 'renowong@gmail.com', '', '', '|4|12|29|5|21|22|14|25|20|8|24|6|15|2|23|27|3|18|7|19|13|1|10|9|17|26|28|', '|6|10|12|14|13|16|18|19|31|32|33|36|38|40|44|', '|48|56|', '|', '-17.6292990000000', '-149.4545750000000'),
(70, 'clacoux', '28f8b609a019f75628f2980656a8dd37', 0, 'clacoux@yahoo.com', '', '', '|1|', '|6|', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(72, 'o', 'd95679752134a2d9eb61dbd7b91c4bcc', 0, 'o', '', '', '|3|1|', '|7|', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(73, 'eric', '29988429c481f219b8c5ba8c071440e1', 0, 'eric@changsang.net', '', '', '|', '|', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(74, 'j', '363b122c528f54df4a0446b6bab05515', 0, 'j', '', '', '|', '|', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(75, 'k', '8ce4b16b22b58894aa86c421e8759df3', 0, 'kk', '', '', '|', '|', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(76, 'mlykui', '53154732edb8e2141ec05b2d9e35c9e4', 0, 'michel.lykui@gmail.com', '', '', '|', '|', '|', '|', '-17.6292990000000', '-149.4545750000000'),
(77, 'mlykui1', '53154732edb8e2141ec05b2d9e35c9e4', 1, 'michel.ykui@gmail.com', 'Service Public', '712714', '|', '|', '|', '|', '-17.6292990000000', '-149.4545750000000');
