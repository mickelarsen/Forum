-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 20 oktober 2011 kl 13:05
-- Serverversion: 5.1.52
-- PHP-version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `forum`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subforum_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Data i tabell `categories`
--

INSERT INTO `categories` (`id`, `name`, `subforum_id`) VALUES
(1, 'c, c#, c++...', 1),
(2, 'php, java..', 1),
(3, 'Adventure and platform', 2),
(4, 'All things RPG', 2);

-- --------------------------------------------------------

--
-- Struktur för tabell `friends_list`
--

CREATE TABLE IF NOT EXISTS `friends_list` (
  `user1` varchar(255) NOT NULL,
  `user2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data i tabell `friends_list`
--

INSERT INTO `friends_list` (`user1`, `user2`) VALUES
('toker', 'Boss'),
('Boss', 'toker');

-- --------------------------------------------------------

--
-- Struktur för tabell `friend_request`
--

CREATE TABLE IF NOT EXISTS `friend_request` (
  `user1` varchar(255) NOT NULL,
  `user2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data i tabell `friend_request`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `ignore_user`
--

CREATE TABLE IF NOT EXISTS `ignore_user` (
  `user` varchar(255) NOT NULL,
  `ignored_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data i tabell `ignore_user`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Data i tabell `messages`
--

INSERT INTO `messages` (`message_id`, `sender`, `receiver`, `message`, `date`, `read`) VALUES
(2, 'toker', 'Boss', 'Baws', '2011-10-06 14:48:17', 0),
(3, 'Boss', 'toker', 'hahahahaha', '2011-10-17 15:09:34', 0),
(4, 'Boss', 'toker', 'hi this is spam just so you know. want dick enlargement? lol like a true spammer ey? wanna buy vigara?', '2011-10-17 15:10:27', 1);

-- --------------------------------------------------------

--
-- Struktur för tabell `subforums`
--

CREATE TABLE IF NOT EXISTS `subforums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data i tabell `subforums`
--

INSERT INTO `subforums` (`id`, `name`) VALUES
(1, 'Programming'),
(2, 'Gaming');

-- --------------------------------------------------------

--
-- Struktur för tabell `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `title` varchar(80) NOT NULL,
  `op` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Data i tabell `topics`
--

INSERT INTO `topics` (`id`, `author`, `title`, `op`, `category_id`, `creation_date`, `sticky`, `locked`) VALUES
(2, 'Boss', 'hohohoho', 'hehehe', 1, '2011-10-10 14:15:54', 1, 1),
(3, 'Boss', 'another troll topic', 'lol', 1, '2011-10-10 14:16:50', 0, 0),
(4, 'Boss', 'why does zelda always try to rescue the princess', 'i dont get it', 1, '2011-10-10 14:17:33', 1, 0),
(5, 'toker', 'unrelated', 'why is link always so quiet', 2, '2011-10-10 14:18:04', 0, 0),
(6, 'Boss', 'spamtrain engage', 'hi', 1, '2011-10-20 14:32:24', 0, 0),
(7, 'Boss', 'rrraaaaaaaaa', 'white ra that is', 1, '2011-10-20 14:35:21', 0, 0),
(8, 'Boss', 'so uh', 'whats up', 1, '2011-10-20 14:35:39', 0, 0),
(9, 'Boss', 'hot dawgs', 'cheeli hawt dawgs', 1, '2011-10-20 14:36:06', 0, 0),
(10, 'Boss', 'joker', 'said batman', 1, '2011-10-20 14:36:19', 0, 0),
(11, 'Boss', 'justice', 'for all', 1, '2011-10-20 14:36:27', 0, 0),
(12, 'Boss', 'pastor', 'of muppets', 1, '2011-10-20 14:36:34', 0, 0),
(13, 'Boss', 'spamtrain inc', 'great', 1, '2011-10-20 14:36:48', 0, 0),
(14, 'Boss', '12', 'heh', 1, '2011-10-20 14:37:09', 0, 0),
(15, 'Boss', 'thirteen', 'is how old i am', 1, '2011-10-20 14:37:19', 0, 0),
(16, 'Boss', '1+4', 'is not 14 ', 1, '2011-10-20 14:37:29', 0, 0),
(17, 'Boss', 'oh dear', 'i ran over a 15 year old', 1, '2011-10-20 14:37:48', 0, 0),
(18, 'Boss', 'new page?', 'maybe=?', 1, '2011-10-20 14:37:58', 0, 0);

-- --------------------------------------------------------

--
-- Struktur för tabell `topic_responses`
--

CREATE TABLE IF NOT EXISTS `topic_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `response` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Data i tabell `topic_responses`
--

INSERT INTO `topic_responses` (`id`, `user`, `response`, `topic_id`, `date`) VALUES
(3, 'Boss', 'scumbag', 4, '2011-10-17 14:40:28'),
(4, 'Boss', 'Zelda is the princess you tard. Link is the hero.', 4, '2011-10-17 14:43:34');

-- --------------------------------------------------------

--
-- Struktur för tabell `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `real_name` varchar(255) DEFAULT NULL,
  `real_lastname` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gravatar` varchar(500) DEFAULT NULL,
  `signature` varchar(120) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `real_name`, `real_lastname`, `location`, `email`, `birthday`, `gravatar`, `signature`, `admin`) VALUES
(1, 'toker', 'toker', 'tokri', 'dwarf', 'GGville, Scrubstreet 55', 'tokridwarfi@gmail.com', '1945-07-24', '', 'Godblastem kids of today dont know anythin abut hard work i say', 0),
(2, 'Boss', 'boss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'baller', 'baller', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(4, 'greg', 'greg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
