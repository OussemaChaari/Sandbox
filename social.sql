-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 25 avr. 2018 à 22:35
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `social`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment_body` text NOT NULL,
  `commented_by` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL,
  `commented_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `comment_body`, `commented_by`, `post_id`, `commented_on`) VALUES
(30, 'oushoihsgiohgzois', 'za4321', 36, '2018-04-04 01:50:55'),
(31, 'fbdijbspijgooq', 'samiro', 36, '2018-04-04 01:51:31'),
(32, 'wbqdkq', 'samiro', 36, '2018-04-04 01:52:01'),
(33, 'wbqdkq', 'samiro', 36, '2018-04-04 01:52:07'),
(34, 'sdoibsipijqpjqv', 'samiro', 35, '2018-04-04 01:52:17'),
(48, 'sdbskljhsddsf', 'freeman', 40, '2018-04-08 04:14:52'),
(49, 'qvqdkhqoga', 'freeman', 40, '2018-04-08 04:14:57'),
(50, 'soinjbfdÃ¹pphbe^vs', 'za4321', 44, '2018-04-13 19:45:40'),
(51, 'Yo', 'samiro', 32, '2018-04-24 20:26:09');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `likers` text NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id`, `likers`, `post_id`) VALUES
(1, 'freeman,', 40),
(2, '', 41),
(3, '', 42),
(4, '', 42),
(5, '', 43),
(6, 'za4321,', 44),
(7, '', 45),
(8, '', 46);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_between` varchar(201) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date_sent` timestamp NULL DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL,
  `opened` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `user_to` varchar(100) NOT NULL,
  `likes` int(11) NOT NULL,
  `comments` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `date_added`, `user_to`, `likes`, `comments`) VALUES
(13, 'Hello I\'m Morgan\r\n', 'freeman', '2018-04-02 23:55:01', '', 1, NULL),
(14, 'My voice is so cool\r\n\r\n', 'freeman', '2018-04-02 23:55:22', '', 0, NULL),
(15, 'Hi I\'m Oussema !!!', 'za4321', '2018-04-02 23:56:21', '', 0, NULL),
(16, 'Blah Blah Blah !!! \r\n', 'freeman', '2018-04-02 23:56:51', '', 1, NULL),
(17, 'The stranger officiates the meal.', 'za4321', '2018-04-02 23:57:36', '', 0, NULL),
(18, 'Two seats were vacant.', 'samiro', '2018-04-02 23:58:11', '', 0, NULL),
(19, 'A song can make or ruin a personâ€™s day if they let it get to them.', 'samiro', '2018-04-02 23:58:22', '', 0, NULL),
(20, 'Wow, does that work?', 'samiro', '2018-04-02 23:58:38', '', 0, NULL),
(21, 'I am happy to take your donation; any amount will be greatly appreciated.', 'hamadi', '2018-04-02 23:59:02', '', 0, NULL),
(22, 'Last Friday in three weekâ€™s time I saw a spotted striped blue worm shake hands with a legless lizard.', 'hamadi', '2018-04-02 23:59:11', '', 0, NULL),
(23, 'If the Easter Bunny and the Tooth Fairy had babies would they take your teeth and leave chocolate for you?\r\nHe said he was not there yesterday; however, many people saw him there.', 'hamadi', '2018-04-02 23:59:21', '', 0, NULL),
(24, 'I am never at home on Sundays.\r\nThey got there early, and they got really good seats.', 'garfield', '2018-04-02 23:59:52', '', 0, NULL),
(25, 'Abstraction is often one floor above you.\r\nThe old apple revels in its authority.', 'garfield', '2018-04-03 00:00:05', '', 0, NULL),
(26, 'Last Friday in three weekâ€™s time I saw a spotted striped blue worm shake hands with a legless lizard.\r\nHe didnâ€™t want to go to the dentist, yet he went anyway.', 'garfield', '2018-04-03 00:00:15', '', 0, NULL),
(27, 'This is a Japanese doll.\r\nJoe made the sugar cookies; Susan decorated them.', 'lamboo', '2018-04-03 00:00:57', '', 0, NULL),
(28, 'If the Easter Bunny and the Tooth Fairy had babies would they take your teeth and leave chocolate for you?\r\nI am counting my calories, yet I really want dessert.', 'lamboo', '2018-04-03 00:01:02', '', 0, NULL),
(29, 'Mary plays the piano.\r\nShe always speaks to him in a loud voice.\r\nThe body may perhaps compensates for the loss of a true metaphysics.', 'lamboo', '2018-04-03 00:01:10', '', 0, NULL),
(30, 'Is it free?\r\nSixty-Four comes asking for bread.\r\nThe old apple revels in its authority.', 'freeman', '2018-04-03 00:01:36', '', 0, NULL),
(31, 'Malls are great places to shop; I can find everything I need under one roof.\r\nShould we start class now, or should we wait for everyone to get here?\r\nThe river stole the gods.', 'freeman', '2018-04-03 00:01:44', '', 1, NULL),
(32, 'We have a lot of rain in June.\r\nCheck back tomorrow; I will see if the book has arrived.\r\nSometimes it is better to just walk away from things and go back to them later when youâ€™re in a better frame of mind.', 'freeman', '2018-04-03 00:01:55', '', 0, NULL),
(33, 'I will never be this young again. Ever. Oh damnâ€¦ I just got older.\r\nI love eating toasted cheese and tuna sandwiches.\r\nHow was the math test?', 'samiro', '2018-04-03 00:02:50', '', 0, NULL),
(34, 'I really want to go to work, but I am too sick to drive.\r\nShe wrote him a long letter, but he didn\'t read it.\r\nI am never at home on Sundays.', 'samiro', '2018-04-03 00:02:58', '', 0, NULL),
(35, 'Lets all be unique together until we realise we are all the same.\r\nI really want to go to work, but I am too sick to drive.\r\nWhere do random thoughts come from?', 'hamadi', '2018-04-03 00:03:38', '', 1, NULL),
(36, 'She wrote him a long letter, but he didn\'t read it.\r\nIf I donâ€™t like something, Iâ€™ll stay away from it.\r\nHe told us a very exciting adventure story.', 'hamadi', '2018-04-08 03:59:44', '', 8, NULL),
(37, 'The quick brown fox jumps over the lazy dog.\r\nIf Purple People Eaters are realâ€¦ where do they find purple people to eat?\r\nI hear that Nancy is very pretty.', 'za4321', '2018-04-08 03:59:37', '', 8, NULL),
(40, 'qgqvzzbbzqsfaga', 'za4321', '2018-04-08 04:07:23', '', 1, 3),
(41, 'khjgjsjzpol,sfpjzrpojer\r\n', 'za4321', '2018-04-08 04:37:24', '', 0, 0),
(42, 'bpjbdpijerp,dfsd', 'za4321', '2018-04-12 04:10:04', '', 0, 0),
(43, 'odfbeoisndinrosdnsinz', 'za4321', '2018-04-12 04:13:44', '', 0, 0),
(44, 'dofibeinebisqoinq ', 'za4321', '2018-04-12 04:14:21', 'freeman', 1, 1),
(45, 'szipjbspbnsÃ´jbs', 'za4321', '2018-04-13 19:48:29', '', 0, 0),
(46, 'Hi there\r\n', 'za4321', '2018-04-20 19:18:07', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `signup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) DEFAULT NULL,
  `num_likes` int(11) DEFAULT NULL,
  `friends_pending` text,
  `friends_array` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `pw`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `friends_pending`, `friends_array`) VALUES
(8, 'Oussema', 'Chaari', 'za4321', 'za4321@outlook.com', '$2y$10$ILvMdzwdt.pkKt/2Ai8aRez.5wlFJiuV/b8T6P29RxgWfRx/KNj9K', '2018-04-02 23:48:09', 'img/Profile/3.jpg', 11, 8, '', 'freeman,samiro'),
(9, 'Samir', 'Black', 'samiro', 's@abc.com', '$2y$10$LzoIePPJjvOCgzie4b7n0uSwNlGYTkgYWdgdDZmmb/QGHAOMJJIwa', '2018-04-02 23:50:08', 'img/Profile/0.jpg', 5, 0, NULL, 'za4321,freeman,'),
(10, 'Hammadi', 'Brown', 'hamadi', 'h@abc.com', '$2y$10$tT9ffFTKUGHsQf7e1TYCmuBmkCWj5ORtyI1uObuDIl5QzyyI/JWj2', '2018-04-02 23:50:46', 'img/Profile/1.jpg', 5, 0, '', ''),
(11, 'Garfield', 'Cat', 'garfield', 'g@abc.com', '$2y$10$Dd.HW2ockPnJt5mCjH4UiOuGzxlClyxk63NMZQoCy7vASPQm6j0Fi', '2018-04-02 23:51:34', 'img/Profile/6.jpg', 3, 0, NULL, NULL),
(12, 'Lambo', 'Lamb', 'lamboo', 'l@abc.com', '$2y$10$O3iWn.zDNtCryj3/Ut948Om4i9WwE0nsrL0yWS6jfUlmX/cuhyX0O', '2018-04-02 23:53:08', 'img/Profile/default.jpg', 3, 0, NULL, NULL),
(13, 'Morgan', 'Freeman', 'freeman', 'm@abc.com', '$2y$10$cPWHlzYUMbi.KTf.i9cCYOp.M84S7Wme6pxQ/hoAwrAoZlB0Jur9O', '2018-04-02 23:53:56', 'img/Profile/7.jpg', 8, 0, '', 'za4321,samiro'),
(14, 'Wavqdq', 'Vqssqdfqs', 'wazabi', 'w@abc.com', '$2y$10$M7QwwvZL8p95fTCRJNcTPucaX02SuvtDi13wmezRONXRdGDiT8Swu', '2018-04-13 19:34:35', 'img/Profile/default.jpg', 0, 0, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
