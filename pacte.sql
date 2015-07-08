-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 08 Juillet 2015 à 11:38
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `mois_debut` varchar(20) NOT NULL,
  `annee_debut` int(4) NOT NULL,
  `mois_fin` varchar(20) NOT NULL,
  `annee_fin` int(4) NOT NULL,
  `projet_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projet_celendrier_projet_fk_idx` (`projet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  UNIQUE KEY `date_equipe_uk` (`date_engagement`,`equipe_id`),
  KEY `demarche_equipe_fk_idx` (`equipe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  UNIQUE KEY `demarche_equipe_uk` (`demarche_id`,`phase_id`),
  KEY `demarches_demarche_phases_fk_idx` (`demarche_id`),
  KEY `phases_demarche_phases_fk_idx` (`phase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `descriptions`
--

CREATE TABLE IF NOT EXISTS `descriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nb_etp` int(11) NOT NULL DEFAULT '0',
  `fonction_id` int(11) NOT NULL,
  `projet_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projet_fonction_UK` (`projet_id`,`fonction_id`),
  KEY `fonction_description_fk_idx` (`fonction_id`),
  KEY `projet_description_fk_idx` (`projet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT1 ;

-- --------------------------------------------------------

--
-- Structure de la table `enquetes`
--

CREATE TABLE IF NOT EXISTS `enquetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(100) NOT NULL,
  `campagne` int(2) NOT NULL DEFAULT '1',
  `demarche_id` int(11) NOT NULL,
  `fonction_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demarche_enquete_fk_idx` (`demarche_id`),
  KEY `fonction_enquete_fk_idx` (`fonction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `enquete_questions`
--

CREATE TABLE IF NOT EXISTS `enquete_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `groupe` varchar(255) NOT NULL,
  `ordre` int(2) DEFAULT NULL,
  `aide` text,
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '1 : choix parmis les 5 items 2 : choix parmis 10 entiers',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `enquete_questions`
--

INSERT INTO `enquete_questions` (`id`, `name`, `groupe`, `ordre`, `aide`, `type`) VALUES
(1, 'La sécurité de la prise en charge du patient en équipe a progressé ', 'A. Depuis PACTE, j’ai le sentiment que ', 1, NULL, 1),
(2, 'Le fonctionnement de l’équipe est amélioré', 'A. Depuis PACTE, j’ai le sentiment que ', 2, NULL, 1),
(3, 'Le partenariat avec le patient et/ou de son entourage a progressé', 'A. Depuis PACTE, j’ai le sentiment que ', 3, NULL, 1),
(4, 'Ma contribution au sein de l’équipe est renforcée', 'A. Depuis PACTE, j’ai le sentiment que ', 4, NULL, 1),
(5, 'Ma pratique professionnelle, mon travail sont facilités', 'A. Depuis PACTE, j’ai le sentiment que ', 5, NULL, 1),
(6, 'Mon travail est reconnu', 'A. Depuis PACTE, j’ai le sentiment que ', 6, NULL, 1),
(7, 'Ma fonction est valorisée', 'A. Depuis PACTE, j’ai le sentiment que ', 7, NULL, 1),
(8, ':', 'B. Pacte répond à mes attentes ', 8, NULL, 1),
(9, ':', 'C. Vous recommanderiez ce projet à d’autres équipes	', 9, NULL, 1),
(10, ':', 'D. Quel est votre niveau de satisfaction global concernant le projet Pacte', 10, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `enquete_reponses`
--

CREATE TABLE IF NOT EXISTS `enquete_reponses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valeur` varchar(45) NOT NULL COMMENT 'Si type de question = 1 1 = Tout à fait d’accord 2 = Plutôt d’accord 3 = Plutôt pas d’accord 4 = Pas du tout d’accord 5 = Ne se prononce pas Si type de question = 2 : valeur de 1 à 10',
  `enquete_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enquete_reponse_enquete_fk_idx` (`enquete_id`),
  KEY `question_enquete_reponse_fk_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  KEY `equipe_etablissement_fk_idx` (`etablissement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `equipes_users`
--

CREATE TABLE IF NOT EXISTS `equipes_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `equipes_equipes_users_fk_idx` (`equipe_id`),
  KEY `users_equipes_users_fk_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etablissements`
--

CREATE TABLE IF NOT EXISTS `etablissements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `finess` varchar(20) NOT NULL,
  `numero_demarche` varchar(10) NOT NULL,
  `niveau_certification` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `indicateur` varchar(255) DEFAULT NULL,
  `type_indicateur_id` int(11) DEFAULT NULL,
  `plan_action_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_action_etape_fk_idx` (`plan_action_id`),
  KEY `indicateur_etape_fk_idx` (`type_indicateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

CREATE TABLE IF NOT EXISTS `evaluations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `synthese` text,
  `file` varchar(100) DEFAULT NULL,
  `ordre` int(1) NOT NULL DEFAULT '10',
  `demarche_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demarche_evaluation_fk_idx` (`demarche_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

CREATE TABLE IF NOT EXISTS `fonctions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `mesures`
--

CREATE TABLE IF NOT EXISTS `mesures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `resultat` text,
  `file` varchar(100) DEFAULT NULL,
  `demarche_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `demarche_evaluation_fk_idx` (`demarche_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE IF NOT EXISTS `parametres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `valeur` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `parametres`
--

INSERT INTO `parametres` (`id`, `name`, `description`, `valeur`, `created`, `modified`) VALUES
(1, 'MessageValidationInscription', 'Message qui sera affiché à la fin de l''inscription d''une équipe', 'Inscription terminée, un mail va vous être envoyé pour terminer la validation.', '2015-04-24 12:46:46', '2015-05-20 15:07:22'),
(2, 'EmailContact', 'Adresse Email de contact', 'refex@has-sante.fr', '2015-05-02 20:01:51', '2015-07-02 14:41:28'),
(3, 'SujetEmailContact', '', '[Pacte] Message utilisateur provenant du site', '2015-05-02 20:04:27', '2015-05-02 20:04:27'),
(4, 'messageAvertissementInscription', 'Message qui apparaît à l''écran à la fin de la phase d''inscription', '<p>une fois valid&eacute;e, les donn&eacute;es saisies pr&eacute;c&eacute;demment ne seront plus modifiables, mais uniquement consultables.<br />\r\nA cette &eacute;tape, vous pouvez <em>d&eacute;cider</em> de poursuivre votre d&eacute;marche, et ainsi ... Les donn&eacute;es pr&eacute;c&eacute;demment saisies seront <u>stock&eacute;es</u>, ce qui vous permet d&#39;interrompre votre saisie et de la reprendre ult&eacute;rieurement. Vous pouvez &eacute;galement d&eacute;cider de ne pas continuer, toutes les donn&eacute;es saisies <span style="color:#FF0000">auparavant</span> seront <strong>d&eacute;truites</strong>.</p>\r\n', '2015-06-18 15:13:20', '2015-07-02 15:53:20'),
(5, 'MessageScoreInferieur', 'Message apparaissant à l''utilisateur si le score est inférieur à 5 ', 'Votre score est inférieur à la moyenne ..... ', '2015-06-18 15:21:35', '2015-06-18 15:21:35'),
(6, 'MessageScoreSuperieur', 'Message apparaissant à l''utilisateur si le score est supérieur à 5 ', 'Bravo, votre score est supérieur à la moyenne ..... ', '2015-06-18 15:23:12', '2015-06-18 15:23:12'),
(7, 'MessageTitreValidation', 'Message  apparaissant à l''utilisateur lorsqu''il arrive sur la page  permettant de valider son inscription', '\r\nNoter le score obtenu', '2015-06-18 15:24:20', '2015-06-18 15:24:20'),
(8, 'MessageTitreQuestionnaire', 'Message sur la page du questionnaire d''engagement de la direction', '<p>Ces quelques <strong>questions </strong>peuvent vous aider &agrave; prendre la d&eacute;cision, pour mieux d&eacute;finir vos besoins avant de vous lancer.<br />\r\nGrille d&rsquo;auto-<em>&eacute;valuation </em>sur votre capacit&eacute; d&rsquo;engagement. R&eacute;pondez aux questions ci-dessous et visualiser les <span style="color:#FF0000">r&eacute;sultats</span></p>\r\n', '2015-07-02 14:26:07', '2015-07-02 15:55:27'),
(9, 'MessageNeSouhaitePasPoursuivre', 'Message apparaissant à l''utilisateur lorsqu''il ne souhaite pas poursuivre son engagement dans Pacte', 'Vous ne souhaitez pas poursuivre ....', '2015-07-02 14:34:41', '2015-07-02 14:34:41'),
(10, 'MessageNiveauCertifBloquant', 'Message apparaissant lorsque le niveau de certification ne permet pas de continuer l''engagement dans Pacte', 'Le niveau de certification de l''établissement ne permet pas de continuer la démarche Pacte', '2015-07-02 14:36:39', '2015-07-02 14:36:39'),
(11, 'MessageAccueilReferent', 'Message d''accueil lors de la gestion des membres référents', '<p>Constituer une &eacute;quipe, mettre en place et suivre le programme n&eacute;cessite un accompagnement et un soutien des professionnels engag&eacute;s. Des capacit&eacute;s de leadership pour assurer la motivation n&eacute;cessaire pour mener &agrave; bien le programme Pacte et en assurer la viabilit&eacute; dans le temps, n&eacute;cessite la d&eacute;signation :<br />\r\n- <strong>D&rsquo;un bin&ocirc;me (ou trin&ocirc;me)</strong> repr&eacute;sent&eacute; de pr&eacute;f&eacute;rence d&rsquo;un m&eacute;decin et d&rsquo;un cadre de sant&eacute;<br />\r\n- <strong>D&rsquo;un facilitateur</strong>, souvent repr&eacute;sent&eacute; par un <span style="color:#FF0000">coordonnateur </span>de la gestion des risques<br />\r\n- <strong>D&rsquo;un animateur pour le CRM Sant&eacute;</strong>, souvent ext&eacute;rieur &agrave; l&rsquo;&eacute;tablissement de sant&eacute; et &agrave; l&rsquo;&eacute;quipe</p>\r\n', '2015-07-03 10:59:47', '2015-07-08 10:28:38'),
(12, 'MessageAccueilMembre', 'Message d''accueil lors de la gestion des membres', '<p>Constituer une &eacute;quipe, mettre en place et suivre le programme n&eacute;cessite un accompagnement</p>\r\n', '2015-07-03 11:01:14', '2015-07-03 11:01:14'),
(13, 'MessageAccueilComite', 'Message d’accueil lors de la gestion du comité de pilotage', '<p>Constituer un comit&eacute; de pilotage ...</p>\r\n', '2015-07-03 11:02:27', '2015-07-03 11:02:27'),
(14, 'MessageAccueilPlanning', 'Message d''accueil de la page de la gestion du Macro-planning', '<p>Test&nbsp;d&#39;accueil &agrave; d&eacute;finir</p>\r\n', '2015-07-03 11:07:16', '2015-07-03 11:07:16'),
(15, 'MessageAccueilPlanActionHas', 'Message d''accueil lorsque l''équipe suit le plan d''action fournis par la HAS', '<p>Texte d&#39;accueil explicatif</p>\r\n', '2015-07-03 13:21:09', '2015-07-03 13:21:09'),
(16, 'MessageAccueilFonctionnement', 'Message d''accueil de la partie fonctionnement d''équipe', '<p>Test d&#39;accueil&nbsp;</p>\r\n', '2015-07-03 13:26:04', '2015-07-03 13:26:04'),
(17, 'MessageAccueilEvaluation', 'Message qui sera affiché à l''accueil sur la partie Évaluation à T0', '<p>Texte d&#39;accueil</p>\r\n', '2015-07-03 13:28:39', '2015-07-03 13:28:39'),
(18, 'MessageAccueilEnqueteSatisfaction', 'Message d''accueil de la partie enquête de satisfaction', '<p>Texte d&#39;acceuil</p>\r\n', '2015-07-03 13:33:45', '2015-07-03 13:33:45'),
(19, 'MessageAccueilChoixPlanAction', 'Message apparaissant lors du choix du type de plan d''action HAS ou Propre à l''équipe', '<p>Texte explicatif</p>\r\n', '2015-07-03 13:38:07', '2015-07-03 13:38:07'),
(20, 'MessageDescriptionEquipe', 'Message de présentation de la Description de l''équipe', '<p>Texte descriptif</p>\r\n', '2015-07-07 11:53:05', '2015-07-07 11:53:05'),
(21, 'MessageSecteurActivite', 'Message descriptif de la partie Secteur Activite', '<p>Texte &agrave; param&eacute;trer</p>\r\n', '2015-07-07 11:53:51', '2015-07-07 12:01:37'),
(22, 'MessageDefinitionProjet', 'Message descriptif de la partie définition du Projet', '<p>Texte descriptif &agrave; param&eacute;trer</p>\r\n', '2015-07-07 11:54:39', '2015-07-07 11:54:39'),
(23, 'MessageModaliteCommunication', 'Message descriptif de la partie Modalité de communication', '<p>Texte descriptif &agrave; param&eacute;trer</p>\r\n', '2015-07-07 11:55:20', '2015-07-07 11:55:20'),
(24, 'MessageMissionVisionValeur', 'Message descriptif de la partie Mission / Valeur', '<p>Quelle est votre raison d&rsquo;&ecirc;tre (mission) ? Qu&rsquo;est-ce qui est important pour votre &eacute;quipe (valeurs) ?</p>\r\n\r\n<p>Quelles sont vos perspectives (vision) ?</p>\r\n', '2015-07-07 12:02:10', '2015-07-07 12:02:10'),
(25, 'MessageValidationEngagement', 'Message afficher à l''utilisateur à la fin de la phase d''engagement', '<p>La validation des renseignement ci-dessus, entrainement l&#39;entr&eacute;e dans votre d&eacute;marche d&#39;accr&eacute;ditation.&nbsp;</p>\r\n\r\n<p>Suite &agrave; cette validation, vous recevrez un e-mail r&eacute;capitulatif des informations.</p>\r\n', '2015-07-07 12:59:12', '2015-07-07 12:59:12'),
(26, 'MessageAideSyntheseFonctionnement', 'Message d''aide dans l''ajout ou l''édition de la synthèse dans la phase de diagnostic > Fonctionnement d''équipe', '<p>Texte d&#39;aide &agrave; d&eacute;finir</p>\r\n', '2015-07-07 13:10:31', '2015-07-07 13:10:31'),
(27, 'MessageValidationDiagnostic', 'Message afficher à l''utilisateur à la fin de la phase de diagnostic', '<p>Votre phase de diagnostic est d&eacute;sormais termin&eacute;e ...</p>\r\n', '2015-07-07 13:28:19', '2015-07-07 13:28:19'),
(28, 'MessageAccueilAdministrateur', 'Message d''accueil lors de la connexion d''un administrateur', '<p>Bienvenue sur l&#39;interface de gestion de l&#39;application Pacte</p>\r\n', '2015-07-07 15:46:29', '2015-07-07 15:46:29'),
(29, 'MessageAccueilExpert', 'Message d''accueil lors de la connexion d''un expert visiteur', '<p>Bienvenue sur l&#39;interface de l&#39;application Pacte, vous trouverez ci-dessous les &eacute;quipe vous &eacute;tant attribu&eacute;es</p>\r\n', '2015-07-07 15:47:33', '2015-07-07 15:47:33'),
(30, 'MessageAccueilCpHas', 'Message d''accueil lors de la connexion d''un chef de projet HAS', '<p>Bienvenue sur l&#39;interface&nbsp;de l&#39;application Pacte, vous trouverez ci-dessous les &eacute;quipes vous &eacute;tant attribu&eacute;es</p>\r\n', '2015-07-07 15:48:48', '2015-07-07 15:48:48'),
(31, 'MessageAccueilEquipeEngagement', 'Message d''accueil pour une équipe en phase d''engagement', '<p>Bienvenue dans la phase d&#39;engagement de votre d&eacute;marche Pacte.</p>\r\n\r\n<p>A cette &eacute;tape .....&nbsp;</p>\r\n', '2015-07-07 15:49:56', '2015-07-07 15:49:56'),
(32, 'MessageAccueilEquipeDiagnostic', 'Message d''accueil pour la phase Diagnostic', '<p>Bienvenue dans la phase de diagnostic de votre d&eacute;marche Pacte.</p>\r\n\r\n<p>A cette &eacute;tape .....&nbsp;</p>\r\n', '2015-07-07 15:58:31', '2015-07-07 15:58:31'),
(33, 'MessageAccueilEquipeMiseEnOeuvre', 'Message d''accueil de la phase de mise en oeuvre', '<p>Bienvenue dans la phase de de mise en oeuvre de votre d&eacute;marche Pacte.</p>\r\n\r\n<p>A cette &eacute;tape .....&nbsp;</p>\r\n\r\n<p><em><span style="color:rgb(255, 0, 0)">Pensez bien &agrave; remplir l&#39;enqu&ecirc;te de satisfaction initiale</span></em></p>\r\n', '2015-07-07 16:00:01', '2015-07-07 16:00:01'),
(34, 'MessageAccueilEquipeEvaluation', 'Message d''accueil de la phase d''évaluation ', '<p>Bienvenue dans la phase d&#39;&eacute;valuation de votre d&eacute;marche Pacte.</p>\r\n\r\n<p>A cette &eacute;tape .....&nbsp;</p>\r\n', '2015-07-07 16:02:03', '2015-07-07 16:02:03'),
(35, 'MessageAccueilAjoutEnqueteSatisfaction', 'Message d''accueil lors de l''ajout d''une enquête de satisfaction', '<p>Cette enqu&ecirc;te fait partie du panel des outils propos&eacute;s pour &eacute;valuer les changements induits par le projet PACTE.</p>\r\n\r\n<p>Votre participation &agrave; cette enqu&ecirc;te va permettre de suivre le niveau de satisfaction individuel des professionnels qui participent au projet.</p>\r\n', '2015-07-07 16:45:04', '2015-07-07 16:45:04');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `name`, `texte`, `texte_aide`, `ordre`, `created`, `modified`) VALUES
(1, 'Question n°1', 'Votre établissement a-t-il clairement identifié la nécessité d’engager une équipe dans un programme d’amélioration du travail en équipe afin de renforcer la sécurité du patient ?', 'Des d’éléments d’information objectifs tels que le bilan des événements indésirables, des enquêtes auprès des patients et/ou du personnel, l’ambiance générale, un turn over important, etc ; vous permettent de définir et d’appuyer de manière factuelle l’engagement dans cette démarche.', 3, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(2, 'Question n°2', 'L’accompagnement d’une équipe dans PACTE s’inscrit dans une démarche à long terme en vue d’un changement en profondeur de la culture. Vous considérez-vous prêts à conduire ce changement ?', 'L''importance d''une culture sécurité intégrée et partagée par tous les acteurs, est largement reconnue comme un élément décisif pour parvenir à des performances durables. La culture de sécurité d''une organisation repose sur un ensemble de croyances, d''attitudes et de comportements développées et appliquées tant de la part des managers que du personnel, pour maitriser les risques inhérents aux activités ; les équipes dirigeantes, les cadres sont-ils prêts dans leurs actions à  changer sa culture et les processus pour améliorer le travail d''équipe et de la sécurité du patient.', 4, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(3, 'Question n°3', 'Vous êtes-vous assurés que la situation actuelle de l’établissement lui permet de conduire cette démarche de manière sereine ? Est-ce le bon moment pour votre établissement (par exemple, projet de fusion, de restructuration, conflit, autre changement important, situation de crise etc.) ?', 'Bien qu’il n’existe pas de moment idéal, le contexte institutionnel doit être pris en compte, d’une part pour éviter toute dispersion (encore un projet de plus)et d’autre part en termes de « pacte de confiance » des équipes dans un projet stratégique à long terme.', 5, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(4, 'Question n°4', 'Avez-vous largement partagé autour de ce projet à tous les niveaux stratégiques de votre établissement ?', 'Il est important de partager, d’expliquer afin de favoriser la compréhension et obtenir une adhésion à ce programme. Le succès de ce programme repose sur le partage de la vison et des valeurs qu’il véhicule et notamment faire de la sécurité du patient une affaire de tous, quel que soit son rôle et notamment impliquer le patient', 6, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(5, 'Question n°5', 'Votre établissement a-t-il prévu de désigner une personne (facilitateur, coach, leader, etc.) afin de soutenir la démarche ?', 'Pour augmenter les chances de succès du projet, il est important de trouver des personnes qui présenteraient des compétences au soutien de l’équipe et qui soient reconnues en tant que telles', 7, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(6, 'Question n°6', 'Etes-vous prêts à Investir dans l’équipe, c’est à dire, investir du temps afin de faciliter les interactions entre professionnels de santé, et notamment dans la formation des équipes pour acquérir de nouvelles compétences. ', 'A titre d’illustration, Il est admis que la formation au travail en équipe (tel que le Medical team training) améliore la dynamique d’équipe, ce qui suppose de dégager du temps, d’organiser le remplacement pour permettre aux membres de l’équipe de bénéficier de cette formation.', 8, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(7, 'Question n°7', 'Votre établissement est-il prêt à suivre, évaluer les progrès accomplis et améliorer en continu le processus ?', 'Améliorer la culture, faire évoluer les comportements, mettre en place des pratiques collaboratives, sont autant de challenges qu’il faut accompagner sur le long terme ; les changements et l’amélioration de la sécurité du patient doivent être visibles et partagées. La reconnaissance des progrès et changements pourront ainsi être reconnus dans le cadre d’un dispositif qui sera mis en place par la HAS ', 9, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(8, 'Question n°8', 'La valorisation et la reconnaissance sont des principes concourant à la dynamique d’équipe, votre établissement est-il en mesure de reconnaître et de distinguer les résultats positifs d’une équipe ?', 'Les équipes qui se sont investies doivent faire connaître et partager les échecs tout comme les succès afin que les pratiques s’intègrent, se diffusent progressivement auprès d’autres professionnels. Fournir du feed back (ou de la rétroaction) et distinguer les équipes efficaces sont des critères de performance du management.', 10, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(9, 'situation de crise', 'situation de crise', 'A définir', 1, '2015-05-22 16:00:08', '2015-05-22 16:00:08'),
(10, 'restructuration', 'restructuration < 6 mois', 'A définir', 2, '2015-05-22 16:00:08', '2015-05-22 16:00:08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'Membre', 1),
(2, 'Binôme', 1),
(3, 'Facilitateur', 1),
(4, 'Animateur du CRM Santé', 1),
(5, 'Membre du CP', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_indicateurs`
--

CREATE TABLE IF NOT EXISTS `type_indicateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_indicateurs`
--

INSERT INTO `type_indicateurs` (`id`, `name`) VALUES
(1, 'Efficacité clinique'),
(2, 'Organisationnel'),
(3, 'Patient');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `lastlogin` datetime NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `token` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nom`, `prenom`, `created`, `modified`, `lastlogin`, `active`, `token`) VALUES
(1, 'admin', '$2y$10$gxMkQQvFJzkvJX4nzM5dee6uoG5chAKhwF152BzCkVMIIfgGwlEO.', 'admin', 'COUE-9', 'Anthony', '2015-04-01 03:14:30', '2015-07-08 10:27:33', '2015-07-08 10:27:33', 1, '');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `calendrier_projets`
--
ALTER TABLE `calendrier_projets`
  ADD CONSTRAINT `projet_calendrier_projet_fk` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demarches`
--
ALTER TABLE `demarches`
  ADD CONSTRAINT `demarche_equipe_fk` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Contraintes pour la table `enquetes`
--
ALTER TABLE `enquetes`
  ADD CONSTRAINT `demarche_enquete_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fonction_enquete_fk` FOREIGN KEY (`fonction_id`) REFERENCES `fonctions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enquete_reponses`
--
ALTER TABLE `enquete_reponses`
  ADD CONSTRAINT `enquete_reponse_enquete_fk` FOREIGN KEY (`enquete_id`) REFERENCES `enquetes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `question_reponse_enquete_fk` FOREIGN KEY (`question_id`) REFERENCES `enquete_questions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipe_etablissement_fk` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipe_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `equipes_users`
--
ALTER TABLE `equipes_users`
  ADD CONSTRAINT `equipes_equipes_users_fk` FOREIGN KEY (`equipe_id`) REFERENCES `equipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_equipes_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `etape_plan_actions`
--
ALTER TABLE `etape_plan_actions`
  ADD CONSTRAINT `indicateur_etape_fk` FOREIGN KEY (`type_indicateur_id`) REFERENCES `type_indicateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_action_etape_fk` FOREIGN KEY (`plan_action_id`) REFERENCES `plan_actions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Contraintes pour la table `mesures`
--
ALTER TABLE `mesures`
  ADD CONSTRAINT `demarche_mesure_fk` FOREIGN KEY (`demarche_id`) REFERENCES `demarches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
