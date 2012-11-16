-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 16 nov 2012 om 01:11
-- Serverversie: 5.5.28-log
-- PHP-versie: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `splunge_arte`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `lastedit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(255) NOT NULL,
  `submitted` varchar(1) NOT NULL DEFAULT '0',
  `publish` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `submittedon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `checked` varchar(1) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `post` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `articles`
--

INSERT INTO `articles` (`id`, `title`, `lastedit`, `author`, `submitted`, `publish`, `submittedon`, `checked`, `remarks`, `post`) VALUES
(1, 'Test', '2012-11-15 20:34:06', 'Kevin', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '<p>\n <img alt="cool" height="20" src="http://www.splunge.be/blogarticles/ckeditor/plugins/smiley/images/shades_smile.gif" title="cool" width="20" /></p>\n', '<p>\n <img alt="mail" height="20" src="http://www.splunge.be/blogarticles/ckeditor/plugins/smiley/images/envelope.gif" title="mail" width="20" /></p>\n'),
(2, 'Neveneffecten', '2012-11-15 22:32:57', 'Kevin', '1', '0000-00-00 00:00:00', '2012-11-15 23:00:00', '0', '', '<p>\n Kent u Neveneffecten al?</p>\n<p>\n Zoniet, bekijk het filmpje hieronder:</p>\n<p>\n &lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;http://www.youtube.com/embed/eprpSh4KzP8&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;</p>\n');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
