-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 16 Janvier 2018 à 10:51
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `pwsb_blogpost`
--

CREATE TABLE `pwsb_blogpost` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(150) COLLATE utf8_bin NOT NULL,
  `content` varchar(5000) COLLATE utf8_bin NOT NULL,
  `image` varchar(250) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `pwsb_blogpost`
--

INSERT INTO `pwsb_blogpost` (`id`, `date`, `title`, `content`, `image`) VALUES
(1, '2016-01-01 18:05:00', 'Ouverture du Blog !', '\r\nBienvenue à tous, le Blog est désormais ouvert ! N\'hésitez pas à commenter mes articles :D\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc cursus, leo vitae congue ullamcorper, diam risus mattis justo, eget blandit sem ligula vehicula odio. Suspendisse nec enim nec erat dapibus porttitor. Nam sed ex orci. In scelerisque maximus viverra. Phasellus eu lectus pharetra, pulvinar sapien non, rhoncus purus. Sed vitae metus et lacus ultricies lobortis vel eu erat. Integer eget malesuada lorem, id vehicula erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus tincidunt, sem gravida suscipit gravida, leo erat luctus lectus, id finibus nibh ex vel risus. Fusce et ligula iaculis, dapibus neque id, tristique massa. Morbi nec imperdiet augue. Quisque mattis nibh eu pellentesque mattis. Nunc ornare, eros ut placerat bibendum, odio dui vestibulum ex, quis mattis sem libero sed tellus. Etiam tincidunt imperdiet mi, at rhoncus erat mollis sed. Etiam in ex ac neque venenatis efficitur. Vestibulum tincidunt augue eu lorem aliquam posuere.\r\nSed euismod urna nunc, id convallis nisl mollis eu. Proin ultrices feugiat nisl vel mattis. Ut eget gravida quam. Sed tincidunt arcu quis bibendum dictum. Nulla porta elit nec libero faucibus suscipit. Etiam et ullamcorper purus. Morbi ut fermentum leo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent auctor vulputate sodales. Praesent faucibus bibendum volutpat. Integer bibendum arcu ut laoreet pharetra. Nam eget urna quis neque vulputate pulvinar. Maecenas massa magna, laoreet nec volutpat ac, tincidunt id nisi.\r\n', 'inauguration.png'),
(2, '2017-12-24 15:30:00', 'Les Licornes', '\r\nArticle sur les licornes et leur existence prouvée\r\nAliquam pharetra tellus purus, in varius diam aliquam non. Phasellus tempus tincidunt dignissim. Aliquam at erat a sem malesuada egestas. Integer eros nulla, porttitor vitae pretium vel, accumsan vel nisl. Morbi convallis dui in diam eleifend consectetur. Duis sit amet erat nibh. Sed et neque vel mauris aliquam ornare ut nec elit. In venenatis sed massa nec tincidunt. Pellentesque id nulla eget massa dignissim bibendum pharetra vitae mauris. Morbi viverra malesuada nisi, in porta nisi porta in. Cras lectus orci, luctus eu fringilla ac, pulvinar sed lectus. Donec lobortis imperdiet justo, eget semper justo pellentesque nec. Sed accumsan vitae risus nec fringilla. Maecenas ut orci ac turpis ultrices posuere. Integer augue sapien, ornare at fermentum a, rhoncus ut leo.\r\nVestibulum sagittis orci sed lectus consectetur gravida. Aliquam pharetra faucibus dolor. Suspendisse vulputate, nulla non egestas convallis, nibh ipsum congue nisl, ac pulvinar sapien eros vel dolor. Pellentesque bibendum malesuada pellentesque. Vivamus vitae eleifend lectus. Integer sed nulla non tellus dapibus pulvinar. Nam id leo neque. Cras aliquam sit amet arcu id elementum. Duis vitae erat quis ante aliquam pulvinar. Pellentesque in quam mauris. Morbi feugiat condimentum blandit. Praesent in tempus diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis pretium porta risus id pretium. Phasellus quis viverra massa, at volutpat sem. Nulla ut est sed quam laoreet placerat vitae sit amet tellus.\r\n', 'licornes.jpg'),
(3, '2018-01-01 23:30:00', 'L\'absence d\'image', '<p>Cet article est sans image, vous pouvez l&#39;&eacute;diter pour en ajouter une.</p>\r\n\r\n<p>- I thought it would be funny without image.<br />\r\n- Non &ccedil;a ne l&#39;est pas.<br />\r\n- Bilingual schizophrenia, is funny.<br />\r\n- Certes, je l&#39;admet.<br />\r\n- Thank you.</p>\r\n\r\n<p>Aliquam pharetra tellus purus, in varius diam aliquam non. Phasellus tempus tincidunt dignissim. Aliquam at erat a sem malesuada egestas. Integer eros nulla, porttitor vitae pretium vel, accumsan vel nisl. Morbi convallis dui in diam eleifend consectetur. Duis sit amet erat nibh<span style="font-size:11px">. Sed et neque vel mauris aliquam ornare ut nec elit. In venenatis sed massa nec tincidunt. Pellentesque id nulla eget massa dignissim bibendum pharetra vitae mauris. Morbi viverra malesuada nisi, in porta nisi porta in. Cras lectus orci, luctus eu fringilla ac, pu<span style="color:#2ecc71">lvinar sed lectus. Donec lobortis imperdiet justo, eget semper justo pellentesque nec. Sed accumsan vitae risus nec fringilla. Maecenas ut orci ac turpis ultrices posuere</span></span><span style="color:#2ecc71">. Integer augue sapien, ornare at fermentum a, rhoncus<span style="background-color:#e74c3c"> ut leo. Vestibulum </span></span><span style="background-color:#e74c3c">sagittis orci sed</span> lectus consectetur gravida. Aliquam pha<strong>retra faucibus dolor. Suspendi<em>sse</em></strong><em> vulputate, nulla non egestas convallis, <s>nibh ipsum co</s></em><s>ngue nisl, ac pulvinar sapien eros</s> vel dolor. Pellentesque bibendum malesuada pellentesque. Vivamus vitae eleifend lectus. Integer sed nulla non tellus dapibus pulvinar. Nam id leo neque. Cras aliquam sit amet arcu id elementum. Duis vitae erat quis ante aliquam pulvinar. Pellentesque in quam mauris. Morbi feugiat condimentum blandit. Praesent in tempus diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Duis pretium porta risus id pretium. Phasellus quis viverra massa, at volutpat sem. Nulla ut est sed quam laoreet placerat vitae sit amet tellus.</p>\r\n', NULL),
(5, '2030-01-16 10:15:26', 'La décomposition du compost interstellaire', '<p>Aujourd&#39;hui, nous allons parler d&#39;un sujet de plus en plus important aux yeux de la <em>Conf&eacute;d&eacute;ration Spatiale Interuniverselle</em>, <strong>le compost interstellaire</strong>.</p>\r\n\r\n<p>Tout d&#39;abord, qu&#39;est-ce que le compost interstellaire ? C&#39;est l&#39;ensemble des d&eacute;bris de nos activit&eacute;s, toutes races confondues (humains, m&eacute;thaniens, sterniens, ...), depuis des mill&eacute;naires. Il a &eacute;t&eacute; d&eacute;cid&eacute; il y a un si&egrave;cle lunaire de compacter et composter tout cet amas de d&eacute;bris, pour nettoyer l&#39;espace et r&eacute;soudre la crise des mat&eacute;riaux.</p>\r\n\r\n<p>La CSI (<em>Conf&eacute;d&eacute;ration Spatiale Interuniverselle</em>) a d&eacute;cid&eacute; de placer ce projet en tant que projet majeur de cette nouvelle ann&eacute;e solaire, car la crise est grandissante.</p>\r\n\r\n<p>Voici quelques liens, pour les plus curieux d&#39;entre vous :</p>\r\n\r\n<ul>\r\n	<li><a href="http://csi.multiverse/compost/faq">FAQ Compost sur le site du CSI</a></li>\r\n	<li><a href="http://stellar-objects.multiverse/livemap">Carte des&nbsp;d&eacute;bris stellaire en temps r&eacute;el</a></li>\r\n</ul>\r\n\r\n<p>N&#39;h&eacute;sitez pas &agrave; donner votre avis sur le sujet en commentaires !<br />\r\nJe reviens vers vous d&#39;ici peu avec plus d&#39;informations, je serais en d&eacute;placement toute la semaine pour en apprendre plus sur tout &ccedil;a !</p>\r\n', 'pia13121-16.jpg'),
(7, '2018-01-16 11:34:00', 'Kaamelott quotes', '<h2>Aujourd&#39;hui, quelques jolies citations de la s&eacute;rie mythique qui me tiens tant &agrave; coeur, <em>Kaamelott</em> !</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p><em>Tempora mori, tempora mundis recorda</em>. Voil&agrave;. Eh bien &ccedil;a, par exemple, &ccedil;a veut absolument rien dire, mais l&rsquo;effet reste le m&ecirc;me, et pourtant j&rsquo;ai jamais foutu les pieds dans une salle de classe attention&nbsp;!</p>\r\n\r\n<p>- le Roi Loth</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>Pour faire court, vous &ecirc;tes ici chez les salopards. C&rsquo;est admis. On n&#39;a pas des id&eacute;es bien jojos, et on n&rsquo;a pas peur de le dire&nbsp;! On fomente, on ren&eacute;gate, on laisse libre cours &agrave; notre fantaisie.<br />\r\n- Le&nbsp;Roi Loth</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>J&#39;te pr&eacute;sente vos hommages au roi Arthur.<br />\r\n- Kadoc</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>J&#39;ai le droit d&#39;&ecirc;tre 4 jours pas chez moi, et apr&egrave;s chez moi. Mais y a du voyage qui se pr&eacute;pare, et pour soigner les b&ecirc;tes, y a pas que ma tante, y a moi aussi.<br />\r\n- Kadoc</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>Elle est o&ugrave; la poulette&nbsp;?<br />\r\n- Kadoc</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>JE NE MANGE PAS DE GRAINES&nbsp;!<br />\r\n- Le ma&icirc;tre d&rsquo;armes</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Gloire &agrave; Astier ! <span style="font-size:10px">Et vivement les films !</span></p>\r\n', 'Kaamelott_frequence_medievale_William_blanc.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pwsb_comment`
--

CREATE TABLE `pwsb_comment` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `content` varchar(2000) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `pwsb_comment`
--

INSERT INTO `pwsb_comment` (`id`, `id_post`, `id_user`, `date`, `content`) VALUES
(1, 1, 1, '2016-01-01 00:32:02', 'Génial, un nouveau blog !'),
(3, 2, 3, '2017-12-25 00:30:06', '<p>Je n&#39;y crois pas.&nbsp;Monsieur, vous &ecirc;tes un Charlatan ! Joyeux No&euml;l tout de m&ecirc;me.</p>\r\n'),
(4, 1, 4, '2016-02-01 14:24:40', 'Encore un blog voué à l\'échec...'),
(10, 1, 3, '2016-02-01 14:24:40', '<p>Bonne chance &agrave; vous pour cette nouvelle aventure !</p>\r\n'),
(12, 2, 4, '2017-12-24 18:30:20', 'J\'en ai vu une hier :O :D'),
(13, 7, 2, '2018-01-16 11:35:57', '<p>Moi, une fois, j&#39;&eacute;tais so&ucirc;l comme cochon, je me suis fait tatouer &quot;J&#39;aime le raisin de table&quot; sur la miche droite, et &ccedil;a y est toujours&nbsp;!</p>\r\n'),
(14, 5, 2, '2018-01-16 11:36:37', '<p>Sujet int&eacute;ressant, h&acirc;te d&#39;en savoir plus ! Bon voyage &agrave; toi, @Admin ;)</p>\r\n'),
(15, 7, 3, '2018-01-16 11:40:06', '<p>Toujours aussi mythique ces citations !</p>\r\n\r\n<p>Vous les prenez sur&nbsp;https://fr.wikiquote.org/wiki/Kaamelott ?</p>\r\n'),
(16, 3, 3, '2018-01-16 11:41:21', '<p>Il va falloir penser &agrave; consulter...</p>\r\n'),
(17, 1, 1, '2018-01-16 11:47:22', '<p>http://ekladata.com/G0E3BUh5T8LLD2gxQh-oCCVeEMQ@597x311.jpg</p>\r\n'),
(18, 5, 1, '2018-01-16 11:48:03', '<p>Merci @TBG ! Avec mon nouveau transporteur &agrave; hypervitesse, &ccedil;a devrait bien se passer !</p>\r\n'),
(19, 5, 5, '2018-01-16 11:48:50', '<p>Comment voyagez-vous dans le temps ?</p>\r\n'),
(20, 1, 5, '2018-01-16 11:49:21', '<p>Admin, vous commentez le mauvais post, j&#39;ai l&#39;impression...</p>\r\n'),
(21, 7, 5, '2018-01-16 11:50:06', '<p>&quot;J&#39;pensais &agrave; une chose, en toute amiti&eacute;, un gros pain dans votre t&ecirc;te, &ccedil;a serait de nature &agrave; vous convenir&nbsp;?&quot;</p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `pwsb_user`
--

CREATE TABLE `pwsb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` varchar(150) COLLATE utf8_bin NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `pwsb_user`
--

INSERT INTO `pwsb_user` (`id`, `username`, `password`, `admin`) VALUES
(1, 'Admin', 'Admin', 1),
(2, 'TBG', 'azerty', 1),
(3, 'Jean', '11', 0),
(4, 'Hubert', '11', 0),
(5, 'JeSuisInscrit', '123', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `pwsb_blogpost`
--
ALTER TABLE `pwsb_blogpost`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pwsb_comment`
--
ALTER TABLE `pwsb_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_PostComments` (`id_post`),
  ADD KEY `FK_UserComments` (`id_user`);

--
-- Index pour la table `pwsb_user`
--
ALTER TABLE `pwsb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `pwsb_blogpost`
--
ALTER TABLE `pwsb_blogpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `pwsb_comment`
--
ALTER TABLE `pwsb_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `pwsb_user`
--
ALTER TABLE `pwsb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `pwsb_comment`
--
ALTER TABLE `pwsb_comment`
  ADD CONSTRAINT `FK_PostComments` FOREIGN KEY (`id_post`) REFERENCES `pwsb_blogpost` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_UserComments` FOREIGN KEY (`id_user`) REFERENCES `pwsb_user` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
