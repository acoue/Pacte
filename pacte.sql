-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Mai 2015 à 16:38
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pacte`
--

-- --------------------------------------------------------

--
-- Structure de la table `calendrier_projets`
--

CREATE TABLE IF NOT EXISTS `calendrier_projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` text NOT NULL,
  `mois` varchar(20) NOT NULL,
  `annee` int(4) NOT NULL,
  `projet_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projet_celendrier_projet_fk_idx` (`projet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `calendrier_projets`
--

INSERT INTO `calendrier_projets` (`id`, `libelle`, `mois`, `annee`, `projet_id`) VALUES
(1, '1ère étape', 'Juin', 2015, 2),
(2, '2ème étape', 'Aout', 2015, 2),
(3, '1ère étape', 'Juin', 2015, 1),
(4, '1ère étape', 'Juin', 2015, 1);

-- --------------------------------------------------------

--
-- Structure de la table `demarches`
--

CREATE TABLE IF NOT EXISTS `demarches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_engagement` date NOT NULL,
  `score` int(11) DEFAULT NULL,
  `situation_crise` tinyint(1) DEFAULT NULL,
  `restructuration` tinyint(1) DEFAULT NULL,
  `statut` int(1) NOT NULL DEFAULT '0',
  `equipe_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date_engagement_UNIQUE` (`date_engagement`),
  KEY `demarche_equipe_idx` (`equipe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `demarches`
--

INSERT INTO `demarches` (`id`, `date_engagement`, `score`, `situation_crise`, `restructuration`, `statut`, `equipe_id`, `created`, `modified`) VALUES
(9, '2015-05-23', 8, 0, NULL, 0, 9, '2015-05-06 11:47:19', '2015-05-06 11:47:19'),
(10, '2015-05-05', 8, 0, NULL, 0, 10, '2015-05-06 12:10:07', '2015-05-06 12:10:07'),
(11, '2015-05-07', 8, 0, NULL, 0, 11, '2015-05-07 07:52:44', '2015-05-07 07:52:44');

-- --------------------------------------------------------

--
-- Structure de la table `demarche_phases`
--

CREATE TABLE IF NOT EXISTS `demarche_phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demarche_id` int(11) NOT NULL,
  `phase_id` int(11) NOT NULL,
  `date_entree` date DEFAULT NULL,
  `date_validation` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `demarche_id` (`demarche_id`,`phase_id`,`date_entree`),
  KEY `demarches_demarche_phases_fk_idx` (`demarche_id`),
  KEY `phases_demarche_phases_fk_idx` (`phase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `demarche_phases`
--

INSERT INTO `demarche_phases` (`id`, `demarche_id`, `phase_id`, `date_entree`, `date_validation`) VALUES
(1, 9, 1, '2015-05-06', NULL),
(2, 10, 1, '2015-05-06', '2015-05-12'),
(3, 11, 1, '2015-05-07', NULL),
(7, 10, 2, '2015-05-12', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `descriptions`
--

CREATE TABLE IF NOT EXISTS `descriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nb_etp` int(11) NOT NULL DEFAULT '0',
  `service` varchar(255) NOT NULL,
  `fonction_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service` (`service`,`fonction_id`),
  KEY `fonction_description_fk_idx` (`fonction_id`),
  KEY `projet_description_fk_idx` (`projet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `descriptions`
--

INSERT INTO `descriptions` (`id`, `nb_etp`, `service`, `fonction_id`, `projet_id`) VALUES
(1, 2, 'Urgence', 1, 2),
(2, 3, 'Chirurgie', 2, 1),
(4, 3, 'Gynécologie', 4, 2),
(6, 2, 'Ophtalmologie Secteur 2', 8, 2);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE IF NOT EXISTS `equipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `etablissement_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `equipe_user_fk_idx` (`user_id`),
  KEY `equipe_etablissement_id_idx` (`etablissement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `equipes`
--

INSERT INTO `equipes` (`id`, `name`, `user_id`, `etablissement_id`) VALUES
(9, 'Equipe Cardio', 23, 4),
(10, 'Equipe Anesthésie', 24, 5),
(11, 'Equipe test', 25, 5);

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) DEFAULT NULL,
  `finess` varchar(20) DEFAULT NULL,
  `numero_demarche` varchar(10) DEFAULT NULL,
  `niveau_certification` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `etablissements`
--

INSERT INTO `etablissements` (`id`, `libelle`, `finess`, `numero_demarche`, `niveau_certification`, `created`, `modified`) VALUES
(2, 'CLINIQUE CONVERT- BOURG EN BRESSE', '010000156', '1952', 'Non Certification', '2015-04-10 14:49:32', '2015-04-10 14:49:32'),
(3, 'CENTRE MEDICAL REGINA', '010000206', '1337', 'Certification avec recommandations', '2015-04-10 14:49:32', '2015-04-10 14:49:32'),
(4, 'SA LE PONTET', '010000222', '3382', 'Certification sans recommandation', '2015-04-10 14:49:32', '2015-04-10 14:49:32'),
(5, 'CENTRE MEDICAL LE MODERN', '010000230', '3383', 'Certification avec réserves', '2015-04-10 14:49:32', '2015-04-10 14:49:32'),
(6, 'CENTRE MEDICAL LE MODERN COPY', '010000231', '3383', 'Certification sans recommandation', '2015-04-10 14:49:32', '2015-04-10 14:49:32');

-- --------------------------------------------------------

--
-- Structure de la table `etape_plan_actions`
--

CREATE TABLE IF NOT EXISTS `etape_plan_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `name` text,
  `pilote` varchar(100) DEFAULT NULL,
  `mois` varchar(45) DEFAULT NULL,
  `annee` int(4) DEFAULT NULL,
  `etat` varchar(45) DEFAULT NULL,
  `modalite_suivi` text,
  `resultat` text,
  `indicateur_id` int(11) DEFAULT NULL,
  `plan_action_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_action_etape_fk_idx` (`plan_action_id`),
  KEY `indicateur_etape_fk_idx` (`indicateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `synthese` text,
  `file` varchar(100) DEFAULT NULL,
  `demarche_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demarche_evaluation_fk_idx` (`demarche_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `evaluations`
--

INSERT INTO `evaluations` (`id`, `name`, `synthese`, `file`, `demarche_id`) VALUES
(1, 'CRM Santé', NULL, NULL, 9),
(2, 'Culture Sécurité', NULL, NULL, 9),
(3, 'CRM Santé', NULL, NULL, 10),
(4, 'Culture Sécurité', NULL, NULL, 10),
(5, 'CRM Santé', NULL, NULL, 11),
(6, 'Culture Sécurité', NULL, NULL, 11);

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

CREATE TABLE IF NOT EXISTS `fonctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `fonctions`
--

INSERT INTO `fonctions` (`id`, `name`) VALUES
(1, 'Médecin'),
(2, 'Infirmière'),
(3, 'Cadre de santé'),
(4, 'Sage-femme'),
(5, 'Gynécologie obstétrique'),
(6, 'Spécialiste en gastro-entérologie hépatologie'),
(7, 'Psychiatre'),
(8, 'Ophtalmologue'),
(9, 'Spécialiste en oto-rhino-laryngologie'),
(10, 'Spécialiste en pédiatrie'),
(11, 'Spécialiste en pneumologie'),
(12, 'Spécialiste en radiodiagnostic et imagerie mé'),
(13, 'Spécialiste en stomatologie'),
(14, 'Chirurgien dentiste'),
(17, 'Masseur kinésithérapeute'),
(18, 'Orthophoniste'),
(19, 'Orthoptiste'),
(20, 'Pédicure-podologue'),
(21, 'Audio prothésiste'),
(22, 'Ergothérapeute'),
(23, 'Psychomotricien');

-- --------------------------------------------------------

--
-- Structure de la table `indicateurs`
--

CREATE TABLE IF NOT EXISTS `indicateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `date_engagement` date NOT NULL,
  `numero_demarche` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `etablissement` int(11) NOT NULL,
  `situation_crise` tinyint(1) NOT NULL COMMENT '1 =pas de situation de crise, 0 = situation ',
  `restructuration` tinyint(1) NOT NULL COMMENT '1 =pas de restructuration, 0 = restructuration',
  `reponses` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `name`, `date_engagement`, `numero_demarche`, `score`, `etablissement`, `situation_crise`, `restructuration`, `reponses`, `created`, `modified`) VALUES
(18, 'Equipe Cardio', '2015-05-16', 3382, 10, 4, 0, 0, '9-N#10-N#1-O#2-O#3-O#4-O#5-O#6-O#7-O#8-O#', '2015-05-06 12:00:34', '2015-05-06 12:00:34');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `fonction` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `comite` int(1) DEFAULT NULL COMMENT '0 : non membre du comité de pilotage\n1 : membre du comité de pilotage',
  `demarche_id` int(11) DEFAULT NULL,
  `responsabilite_id` int(11) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`,`prenom`,`comite`,`demarche_id`),
  KEY `responsabilite_membres_fk_idx` (`responsabilite_id`),
  KEY `demarches_membres_fk_idx` (`demarche_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`id`, `nom`, `prenom`, `email`, `telephone`, `fonction`, `service`, `comite`, `demarche_id`, `responsabilite_id`, `created`, `modified`) VALUES
(1, 'COUE', 'Anthony', 'anthony.coue@gmail.com', '01 55 93 70 75', 'Médecin', 'Urgence', 0, 10, 2, '2015-05-07 09:29:07', '2015-05-07 09:33:34'),
(2, 'BOIVERT', 'Jean-Pierre', 'ze@ee.fr', '01 55 93 70 76', 'IDE', 'Urgence', 0, 10, 3, '2015-05-07 09:34:05', '2015-05-07 09:34:05'),
(3, 'FRESNEDA', 'Jean-Pierre', 'a.b@c.fr', '01 55 93 70 77', 'Chef de service', 'Rhumatologie', 1, 10, 5, '2015-05-07 09:37:41', '2015-05-07 09:37:41'),
(4, 'FRES', 'Mickaêl', 'ml@lk.com', '01 55 93 70 74', 'DRH', 'Direction Ressources Huamines', 1, 10, 5, '2015-05-07 09:40:41', '2015-05-07 09:40:41'),
(5, 'ROMMEL', 'Mickaêl', 'r.m@eerre.com', '01 55 93 70 73', 'Médecin', 'Gynécologie', 0, 10, 1, '2015-05-11 08:20:39', '2015-05-11 08:20:39'),
(6, 'QUERE', 'Xavier', 'x.q@gfk.fr', '01 55 93 70 70', 'Kiné', 'Urgence', 0, 10, 1, '2015-05-11 08:26:42', '2015-05-11 08:26:42'),
(7, 'NEDA', 'Jean-Paul', 'n.jp@jkjkd.org', '01 55 93 70 98', 'Directeur-Adjoint', 'Direction', 1, 10, 5, '2015-05-11 08:28:39', '2015-05-11 08:28:39');

-- --------------------------------------------------------

--
-- Structure de la table `outils`
--

CREATE TABLE IF NOT EXISTS `outils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `texte` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `phase_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `outils_phase_fk_idx` (`phase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `outils`
--

INSERT INTO `outils` (`id`, `name`, `texte`, `type`, `phase_id`) VALUES
(1, 'MEYCLUB 2014.pdf', 'a', 'pedagogiques', 1);

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE IF NOT EXISTS `parametres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `valeur` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `parametres`
--

INSERT INTO `parametres` (`id`, `name`, `valeur`, `created`, `modified`) VALUES
(1, 'MessageValidationInscription', 'Inscription terminée, un mail va vous être envoyé pour terminer la validation.', '2015-04-24 12:46:46', '2015-04-24 12:46:46'),
(2, 'EmailContact', 'refex@has-sante.fr', '2015-05-02 20:01:51', '2015-05-02 20:01:51'),
(3, 'SujetEmailContact', '[Pacte] Message utilisateur provenant du site', '2015-05-02 20:04:27', '2015-05-02 20:04:27');

-- --------------------------------------------------------

--
-- Structure de la table `phases`
--

CREATE TABLE IF NOT EXISTS `phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `phases`
--

INSERT INTO `phases` (`id`, `name`) VALUES
(4, 'Phase d''évaluation'),
(2, 'Phase de diagnostic'),
(3, 'Phase de mise en oeuvre et de suivi'),
(1, 'Phase d’engagement');

-- --------------------------------------------------------

--
-- Structure de la table `plan_actions`
--

CREATE TABLE IF NOT EXISTS `plan_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `is_has` int(1) NOT NULL DEFAULT '0',
  `demarche_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demarche_plan_action_fk_idx` (`demarche_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mission` text,
  `secteur_activite` text,
  `definition` text,
  `intitule` text NOT NULL,
  `deploiement` text NOT NULL,
  `communication` text,
  `demarche_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demarches_projet_fk_idx` (`demarche_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`id`, `mission`, `secteur_activite`, `definition`, `intitule`, `deploiement`, `communication`, `demarche_id`) VALUES
(1, NULL, NULL, NULL, '', '', NULL, 9),
(2, 'Mission', 'Secteur', 'beau projet', 'azaz', 'azazazmlkml,qfzer', 'Pour la comm', 10),
(3, NULL, NULL, NULL, '', '', NULL, 11);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `texte` text NOT NULL,
  `texte_aide` text,
  `ordre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `name`, `texte`, `texte_aide`, `ordre`) VALUES
(1, 'Question n°1', 'Votre établissement a-t-il clairement identifié la nécessité d’engager une équipe dans un programme d’amélioration du travail en équipe afin de renforcer la sécurité du patient ?', 'Des d’éléments d’information objectifs tels que le bilan des événements indésirables, des enquêtes auprès des patients et/ou du personnel, l’ambiance générale, un turn over important, etc ; vous permettent de définir et d’appuyer de manière factuelle l’engagement dans cette démarche.', 3),
(2, 'Question n°2', 'L’accompagnement d’une équipe dans PACTE s’inscrit dans une démarche à long terme en vue d’un changement en profondeur de la culture. Vous considérez-vous prêts à conduire ce changement ?', 'L''importance d''une culture sécurité intégrée et partagée par tous les acteurs, est largement reconnue comme un élément décisif pour parvenir à des performances durables. La culture de sécurité d''une organisation repose sur un ensemble de croyances, d''attitudes et de comportements développées et appliquées tant de la part des managers que du personnel, pour maitriser les risques inhérents aux activités ; les équipes dirigeantes, les cadres sont-ils prêts dans leurs actions à  changer sa culture et les processus pour améliorer le travail d''équipe et de la sécurité du patient.', 4),
(3, 'Question n°3', 'Vous êtes-vous assurés que la situation actuelle de l’établissement lui permet de conduire cette démarche de manière sereine ? Est-ce le bon moment pour votre établissement (par exemple, projet de fusion, de restructuration, conflit, autre changement important, situation de crise etc.) ?', 'Bien qu’il n’existe pas de moment idéal, le contexte institutionnel doit être pris en compte, d’une part pour éviter toute dispersion (encore un projet de plus)et d’autre part en termes de « pacte de confiance » des équipes dans un projet stratégique à long terme.', 5),
(4, 'Question n°4', 'Avez-vous largement partagé autour de ce projet à tous les niveaux stratégiques de votre établissement ?', 'Il est important de partager, d’expliquer afin de favoriser la compréhension et obtenir une adhésion à ce programme. Le succès de ce programme repose sur le partage de la vison et des valeurs qu’il véhicule et notamment faire de la sécurité du patient une affaire de tous, quel que soit son rôle et notamment impliquer le patient', 6),
(5, 'Question n°5', 'Votre établissement a-t-il prévu de désigner une personne (facilitateur, coach, leader, etc.) afin de soutenir la démarche ?', 'Pour augmenter les chances de succès du projet, il est important de trouver des personnes qui présenteraient des compétences au soutien de l’équipe et qui soient reconnues en tant que telles', 7),
(6, 'Question n°6', 'Etes-vous prêts à Investir dans l’équipe, c’est à dire, investir du temps afin de faciliter les interactions entre professionnels de santé, et notamment dans la formation des équipes pour acquérir de nouvelles compétences. ', 'A titre d’illustration, Il est admis que la formation au travail en équipe (tel que le Medical team training) améliore la dynamique d’équipe, ce qui suppose de dégager du temps, d’organiser le remplacement pour permettre aux membres de l’équipe de bénéficier de cette formation.', 8),
(7, 'Question n°7', 'Votre établissement est-il prêt à suivre, évaluer les progrès accomplis et améliorer en continu le processus ?', 'Améliorer la culture, faire évoluer les comportements, mettre en place des pratiques collaboratives, sont autant de challenges qu’il faut accompagner sur le long terme ; les changements et l’amélioration de la sécurité du patient doivent être visibles et partagées. La reconnaissance des progrès et changements pourront ainsi être reconnus dans le cadre d’un dispositif qui sera mis en place par la HAS ', 9),
(8, 'Question n°8', 'La valorisation et la reconnaissance sont des principes concourant à la dynamique d’équipe, votre établissement est-il en mesure de reconnaître et de distinguer les résultats positifs d’une équipe ?', 'Les équipes qui se sont investies doivent faire connaître et partager les échecs tout comme les succès afin que les pratiques s’intègrent, se diffusent progressivement auprès d’autres professionnels. Fournir du feed back (ou de la rétroaction) et distinguer les équipes efficaces sont des critères de performance du management.', 10),
(9, 'situation de crise', 'situation de crise', 'A définir', 1),
(10, 'restructuration', 'restructuration < 6 mois', 'A définir', 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE IF NOT EXISTS `reponses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `demarche_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demarche_reponse_fk_idx` (`demarche_id`),
  KEY `demarche_question_fk_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`id`, `libelle`, `question_id`, `demarche_id`) VALUES
(81, 'N', 9, 9),
(82, 'N', 10, 9),
(83, 'O', 1, 9),
(84, 'O', 2, 9),
(85, 'O', 3, 9),
(86, 'N', 4, 9),
(87, 'N', 5, 9),
(88, 'O', 6, 9),
(89, 'O', 7, 9),
(90, 'O', 8, 9),
(91, 'N', 9, 10),
(92, 'N', 10, 10),
(93, 'O', 1, 10),
(94, 'O', 2, 10),
(95, 'O', 3, 10),
(96, 'O', 4, 10),
(97, 'N', 5, 10),
(98, 'N', 6, 10),
(99, 'O', 7, 10),
(100, 'O', 8, 10),
(101, 'N', 9, 11),
(102, 'N', 10, 11),
(103, 'O', 1, 11),
(104, 'O', 2, 11),
(105, 'O', 3, 11),
(106, 'N', 4, 11),
(107, 'O', 5, 11),
(108, 'O', 6, 11),
(109, 'O', 7, 11),
(110, 'N', 8, 11);

-- --------------------------------------------------------

--
-- Structure de la table `responsabilites`
--

CREATE TABLE IF NOT EXISTS `responsabilites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `online` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `responsabilites`
--

INSERT INTO `responsabilites` (`id`, `name`, `online`) VALUES
(1, 'Membre', 0),
(2, 'Référents', 1),
(3, 'Facilitateurs', 1),
(4, 'Animateur du CRM Santé', 1),
(5, 'Membre du CP', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `lastlogin` datetime NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `token` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`, `lastlogin`, `active`, `token`) VALUES
(1, 'admin', '$2y$10$9w4LVW1u2zLX6ghCRpn40eB56YuMdHsoI.nDtJDi6Sv/3dtGq32Qm', 'admin', '2015-04-01 03:14:30', '2015-05-12 14:14:00', '2015-05-12 14:14:00', 1, ''),
(2, 'has', '$2y$10$/XFcwUYHBr0YsVnxwLikSOmhxOi69ejBFlttN9EHEUaFyLiEq5E6u', 'has', '2015-04-02 03:14:30', '2015-05-05 14:40:27', '2015-05-05 14:40:27', 1, ''),
(3, 'expert', '$2y$10$mNM0ii2D.1zry6PcB5UiDOB6x.AB17psN.NuP2s1.OrHDQ5rG.CG6', 'expert', '2015-04-08 14:42:50', '2015-05-05 11:11:40', '2015-05-05 11:11:40', 1, ''),
(23, '2015_3382_1', '$2y$10$9w4LVW1u2zLX6ghCRpn40eB56YuMdHsoI.nDtJDi6Sv/3dtGq32Qm', 'equipe', '2015-05-06 11:47:19', '2015-05-07 11:54:49', '2015-05-07 11:54:49', 1, 'sWqJe35iTH90rtCxSvEuIkXcgpLmRNy1'),
(24, '2015_3383_1', '$2y$10$9w4LVW1u2zLX6ghCRpn40eB56YuMdHsoI.nDtJDi6Sv/3dtGq32Qm', 'equipe', '2015-05-06 12:10:06', '2015-05-13 12:40:55', '2015-05-13 12:40:55', 1, 'cPy3DdEmu1LrKpz680QhI2eXgRfMknNJ'),
(25, '2015_3383_2', '$2y$10$Anw/LRb.QNAIDWoiPJSH0.49DDqN8gBVT69TFxhiAcrfP1XHE.L6q', 'equipe', '2015-05-07 07:52:44', '2015-05-07 07:54:51', '2015-05-07 07:54:35', 1, 'OHJdVr7XFELytZv5i1CkPnYgKlmW9M8D');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `calendrier_projets`
--
ALTER TABLE `calendrier_projets`
  ADD CONSTRAINT `projet_celendrier_projet_fk` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demarches`
--
ALTER TABLE `demarches`
  ADD CONSTRAINT `demarche_equipe` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demarche_phases`
--
ALTER TABLE `demarche_phases`
  ADD CONSTRAINT `demarches_demarche_phases_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phases_demarche_phases_fk` FOREIGN KEY (`phase_id`) REFERENCES `phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `fonction_description_fk` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projet_description_fk` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipe_etablissement_id` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipe_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etape_plan_actions`
--
ALTER TABLE `etape_plan_actions`
  ADD CONSTRAINT `plan_action_etape_fk` FOREIGN KEY (`plan_action_id`) REFERENCES `plan_actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `indicateur_etape_fk` FOREIGN KEY (`indicateur_id`) REFERENCES `indicateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `demarche_evaluation_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `membres`
--
ALTER TABLE `membres`
  ADD CONSTRAINT `demarches_membres_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `responsabilite_membres_fk` FOREIGN KEY (`responsabilite_id`) REFERENCES `responsabilites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `outils`
--
ALTER TABLE `outils`
  ADD CONSTRAINT `outils_phase_fk` FOREIGN KEY (`phase_id`) REFERENCES `phases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `plan_actions`
--
ALTER TABLE `plan_actions`
  ADD CONSTRAINT `demarche_plan_action_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `demarches_projet_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `demarche_question_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demarche_reponse_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
