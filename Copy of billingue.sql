-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 02:34 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billingue`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `Numagent` int(11) NOT NULL,
  `Nomagent` varchar(20) NOT NULL,
  `Postnom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Phoneagent` varchar(15) NOT NULL,
  `Genreagent` varchar(15) NOT NULL,
  `Numfonction` int(11) NOT NULL,
  `Codeagent` varchar(20) DEFAULT NULL,
  `Mot_de_passe` varchar(65) NOT NULL,
  `compte_cree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`Numagent`, `Nomagent`, `Postnom`, `Prenom`, `Phoneagent`, `Genreagent`, `Numfonction`, `Codeagent`, `Mot_de_passe`, `compte_cree`) VALUES
(1, 'Aluma', 'Aluma', 'Nicole', '+243815470239', 'Feminin', 1, 'F1AG1', '61d401d87241eb2f65d7d46f6d64c2db', 1),
(2, 'Mufungizi', 'Sapience', 'Claudia', '+243825474394', 'Feminin', 2, 'F2AG2', '61d401d87241eb2f65d7d46f6d64c2db', 1),
(3, 'Mufungizi', 'Bharungu', 'Bénit', '+243823476545', 'Masculin', 3, 'M3AG3', '61d401d87241eb2f65d7d46f6d64c2db', 1),
(4, 'Mufungizi', 'Ishwa', 'Louange', '+243825654346', 'Masculin', 4, 'M4AG4', '61d401d87241eb2f65d7d46f6d64c2db', 0),
(5, 'Yagungu', 'Kosande', 'Nathalie', '+243824376345', 'Feminin', 9, 'F5AG9', '61d401d87241eb2f65d7d46f6d64c2db', 0);

-- --------------------------------------------------------

--
-- Table structure for table `annee_scolaire`
--

CREATE TABLE `annee_scolaire` (
  `IdAnneeScolaire` int(11) NOT NULL,
  `AnneeScolaire` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `annee_scolaire`
--

INSERT INTO `annee_scolaire` (`IdAnneeScolaire`, `AnneeScolaire`) VALUES
(1, '2021-2022');

-- --------------------------------------------------------

--
-- Table structure for table `avance`
--

CREATE TABLE `avance` (
  `Numavance` int(11) NOT NULL,
  `Montantavance` float NOT NULL,
  `devise` varchar(10) NOT NULL,
  `Dateavance` date NOT NULL,
  `Libelleavance` text NOT NULL,
  `Numagent` int(11) NOT NULL,
  `Mois` varchar(15) NOT NULL,
  `IdAnneeScolaire` int(11) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `avance`
--

INSERT INTO `avance` (`Numavance`, `Montantavance`, `devise`, `Dateavance`, `Libelleavance`, `Numagent`, `Mois`, `IdAnneeScolaire`, `etat`) VALUES
(1, 5, 'USD', '2021-10-22', 'Frais scolaire', 3, 'Novembre', 1, 0),
(2, 30, 'USD', '2021-10-25', 'Divers besoins', 2, 'Octobre', 1, 0),
(3, 50000, 'CDF', '2021-10-26', 'Affaire personnelle', 4, 'Octobre', 1, 0),
(4, 200, 'USD', '2021-10-26', 'Financer une AGR', 1, 'Octobre', 1, 0),
(5, 50, 'USD', '2021-10-28', 'Affaire privee', 3, 'Octobre', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `Numclasse` int(11) NOT NULL,
  `Libelleclasse` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`Numclasse`, `Libelleclasse`) VALUES
(1, 'Maternelle'),
(2, 'Primaire'),
(3, 'Secondaire'),
(4, 'Humanité');

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `Idcompte` int(11) NOT NULL,
  `Numcompte` varchar(6) NOT NULL,
  `Libellecompte` varchar(70) NOT NULL,
  `Num_sous_type_compte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`Idcompte`, `Numcompte`, `Libellecompte`, `Num_sous_type_compte`) VALUES
(1, '10', 'Capital', 2),
(2, '41', 'Client', 1),
(3, '42', 'Personnel', 1),
(4, '706', 'Vente des services', 4),
(5, '66', 'Charge de personnel', 3),
(6, '57', 'Caisse', 1),
(7, '421', 'Personnel, Avance et Acomptes', 1),
(8, '4211', 'Personnel, avance', 1),
(9, '2', 'Comptes d\'Actif Immobilisé', 1),
(10, '21', 'Immobilisations imcorporelles', 1),
(11, '52', 'banque', 1);

-- --------------------------------------------------------

--
-- Table structure for table `compte_agent`
--

CREATE TABLE `compte_agent` (
  `Numcompte_agent` int(11) NOT NULL,
  `mois` varchar(14) NOT NULL,
  `IdAnneeScolaire` int(11) NOT NULL,
  `Numagent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

CREATE TABLE `eleve` (
  `Numeleve` int(11) NOT NULL,
  `Matriceleve` varchar(10) DEFAULT NULL,
  `Nomeleve` varchar(15) NOT NULL,
  `Postnomeleve` varchar(15) NOT NULL,
  `Prenomeleve` varchar(15) NOT NULL,
  `Sexeeleve` varchar(13) NOT NULL,
  `Numclasse` int(11) NOT NULL,
  `degre` int(11) NOT NULL,
  `options` int(11) NOT NULL,
  `inscrit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`Numeleve`, `Matriceleve`, `Nomeleve`, `Postnomeleve`, `Prenomeleve`, `Sexeeleve`, `Numclasse`, `degre`, `options`, `inscrit`) VALUES
(1, 'M1ELV', 'Lawiyo', 'LagoA', 'Tabitha', 'Masculin', 3, 7, 0, 0),
(2, 'F2ELV', 'Yagungu', 'Kosande', 'Nathalie', 'Feminin', 3, 7, 0, 0),
(3, 'M3ELV', 'Mufungizi', 'Mirindi', 'Grâce de Dieu', 'Masculin', 2, 2, 0, 0),
(4, 'M4ELV', 'Mufungizi', 'LagoA', 'Tabitha', 'Masculin', 2, 3, 0, 0),
(5, 'F5ELV', 'Lawiyo', 'LagoA', 'Grâce de Dieu', 'Feminin', 4, 3, 1, 0),
(6, 'F6ELV', 'karungi', 'kabuya', 'sarah', 'Feminin', 4, 2, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fonction`
--

CREATE TABLE `fonction` (
  `Numfonction` int(11) NOT NULL,
  `Libellefonction` varchar(30) NOT NULL,
  `montant_fonction` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonction`
--

INSERT INTO `fonction` (`Numfonction`, `Libellefonction`, `montant_fonction`) VALUES
(1, 'Gestionnaire', 300),
(2, 'Comptable', 275),
(3, 'Préfet', 250),
(4, 'Caissier', 250),
(5, 'Sécretaire', 225),
(6, 'Coordonateur', 225),
(7, 'Disciplinaire', 180),
(8, 'Directeur des études', 200),
(9, 'Enseigant(e)', 200),
(10, 'Chauffeur', 120),
(11, 'Ouvrier', 100),
(12, 'Préfet', 250);

-- --------------------------------------------------------

--
-- Table structure for table `inscription`
--

CREATE TABLE `inscription` (
  `NumInscription` int(11) NOT NULL,
  `DateInscription` date NOT NULL,
  `Numeleve` int(11) NOT NULL,
  `Numclasse` int(11) NOT NULL,
  `Numoption` int(11) NOT NULL,
  `Numannee` int(11) NOT NULL,
  `compte_cree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inscription`
--

INSERT INTO `inscription` (`NumInscription`, `DateInscription`, `Numeleve`, `Numclasse`, `Numoption`, `Numannee`, `compte_cree`) VALUES
(1, '2021-10-23', 1, 4, 1, 1, 1),
(2, '2021-10-23', 2, 3, 0, 1, 1),
(3, '2021-10-26', 3, 2, 0, 1, 1),
(4, '2021-10-26', 4, 2, 0, 1, 0),
(5, '2021-10-26', 5, 2, 0, 1, 0),
(6, '2021-10-28', 6, 4, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
  `NumOperation` int(11) NOT NULL,
  `DateOperation` date NOT NULL,
  `montant` float NOT NULL,
  `devise` varchar(5) NOT NULL,
  `NumTypeOperation` int(11) NOT NULL,
  `IdAnneeScolaire` int(11) NOT NULL,
  `debit` varchar(10) NOT NULL,
  `credit` varchar(10) NOT NULL,
  `Codeagent` varchar(20) NOT NULL,
  `Matriceleve` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` (`NumOperation`, `DateOperation`, `montant`, `devise`, `NumTypeOperation`, `IdAnneeScolaire`, `debit`, `credit`, `Codeagent`, `Matriceleve`) VALUES
(1, '2021-10-28', 10, 'USD', 1, 1, '57', '41', '', 'M1ELV'),
(2, '2021-10-28', 15, 'USD', 2, 1, '57', '41', '', 'M1ELV'),
(3, '2021-10-28', 5, 'USD', 3, 1, '57', '41', '', 'M1ELV'),
(4, '2021-10-28', 50, 'USD', 5, 1, '4211', '57', 'M4AG4', '');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `NumOption` int(11) NOT NULL,
  `LibelleOption` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`NumOption`, `LibelleOption`) VALUES
(1, 'Pédagogie Générale'),
(2, 'Commerciale informatique'),
(3, 'Technique sociale'),
(4, 'Biologie-Chimie'),
(5, 'Mathématique-Physique');

-- --------------------------------------------------------

--
-- Table structure for table `sous_compte`
--

CREATE TABLE `sous_compte` (
  `Numsouscompte` int(11) NOT NULL,
  `IdCompte` int(11) NOT NULL,
  `Num_sous_compte` varchar(10) NOT NULL,
  `Identifiant` int(11) NOT NULL,
  `montant_charge` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sous_compte`
--

INSERT INTO `sous_compte` (`Numsouscompte`, `IdCompte`, `Num_sous_compte`, `Identifiant`, `montant_charge`) VALUES
(1, 3, '42.1', 1, 0),
(2, 3, '42.2', 2, 0),
(3, 2, '41.1', 1, 0),
(4, 2, '41.3', 3, 0),
(5, 3, '42.3', 3, 0),
(6, 2, '41.2', 2, 0),
(7, 2, '41.6', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sous_type_compte`
--

CREATE TABLE `sous_type_compte` (
  `Num_sous_type_compte` int(11) NOT NULL,
  `Libelle_sous_type_compte` varchar(35) NOT NULL,
  `NumTypeCompte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sous_type_compte`
--

INSERT INTO `sous_type_compte` (`Num_sous_type_compte`, `Libelle_sous_type_compte`, `NumTypeCompte`) VALUES
(1, 'Actif du bilan', 1),
(2, 'Passif du bilan', 1),
(3, 'Compte des charges', 2),
(4, 'Compte des produits', 2);

-- --------------------------------------------------------

--
-- Table structure for table `taux`
--

CREATE TABLE `taux` (
  `IdTaux` int(11) NOT NULL,
  `CoursDeChange` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `taux`
--

INSERT INTO `taux` (`IdTaux`, `CoursDeChange`) VALUES
(1, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `NumTransaction` int(11) NOT NULL,
  `DebitTransaction` float NOT NULL,
  `CreditTransaction` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `typeoperation`
--

CREATE TABLE `typeoperation` (
  `Num_type_operation` int(11) NOT NULL,
  `LibelleTypeOperation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `typeoperation`
--

INSERT INTO `typeoperation` (`Num_type_operation`, `LibelleTypeOperation`) VALUES
(1, 'Paiement frais inscription'),
(2, 'Paiement frais de collation'),
(3, 'Paiement frais de bus'),
(4, 'Subvention'),
(5, 'Avance sur salaire'),
(6, 'Rémunération du personnel'),
(7, 'Autre approvisionnement');

-- --------------------------------------------------------

--
-- Table structure for table `type_compte`
--

CREATE TABLE `type_compte` (
  `Numtypecompte` int(11) NOT NULL,
  `Libelletypecompte` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_compte`
--

INSERT INTO `type_compte` (`Numtypecompte`, `Libelletypecompte`) VALUES
(1, 'Compte du bilan'),
(2, 'Compte de gestion');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD UNIQUE KEY `Numagent` (`Numagent`);

--
-- Indexes for table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  ADD PRIMARY KEY (`IdAnneeScolaire`);

--
-- Indexes for table `avance`
--
ALTER TABLE `avance`
  ADD PRIMARY KEY (`Numavance`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`Numclasse`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`Idcompte`);

--
-- Indexes for table `compte_agent`
--
ALTER TABLE `compte_agent`
  ADD PRIMARY KEY (`Numcompte_agent`);

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`Numeleve`);

--
-- Indexes for table `fonction`
--
ALTER TABLE `fonction`
  ADD PRIMARY KEY (`Numfonction`);

--
-- Indexes for table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`NumInscription`);

--
-- Indexes for table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`NumOperation`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`NumOption`);

--
-- Indexes for table `sous_compte`
--
ALTER TABLE `sous_compte`
  ADD PRIMARY KEY (`Numsouscompte`);

--
-- Indexes for table `sous_type_compte`
--
ALTER TABLE `sous_type_compte`
  ADD PRIMARY KEY (`Num_sous_type_compte`);

--
-- Indexes for table `taux`
--
ALTER TABLE `taux`
  ADD PRIMARY KEY (`IdTaux`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`NumTransaction`);

--
-- Indexes for table `typeoperation`
--
ALTER TABLE `typeoperation`
  ADD PRIMARY KEY (`Num_type_operation`);

--
-- Indexes for table `type_compte`
--
ALTER TABLE `type_compte`
  ADD PRIMARY KEY (`Numtypecompte`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `Numagent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  MODIFY `IdAnneeScolaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `avance`
--
ALTER TABLE `avance`
  MODIFY `Numavance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `Numclasse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `Idcompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `compte_agent`
--
ALTER TABLE `compte_agent`
  MODIFY `Numcompte_agent` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `Numeleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fonction`
--
ALTER TABLE `fonction`
  MODIFY `Numfonction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `NumInscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `operation`
--
ALTER TABLE `operation`
  MODIFY `NumOperation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `NumOption` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sous_compte`
--
ALTER TABLE `sous_compte`
  MODIFY `Numsouscompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sous_type_compte`
--
ALTER TABLE `sous_type_compte`
  MODIFY `Num_sous_type_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taux`
--
ALTER TABLE `taux`
  MODIFY `IdTaux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `NumTransaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typeoperation`
--
ALTER TABLE `typeoperation`
  MODIFY `Num_type_operation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `type_compte`
--
ALTER TABLE `type_compte`
  MODIFY `Numtypecompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
