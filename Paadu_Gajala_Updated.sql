-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2024 at 06:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Paadu_Gajala_Updated`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Darling', 2, 4, 'assets/images/artwork/darling.jpeg'),
(2, 'Arjun Reddy', 5, 10, 'assets/images/artwork/ad.jpeg'),
(3, 'Guntur Karam', 3, 1, 'assets/images/artwork/gk.jpg'),
(5, 'Agnaathavaasi', 1, 3, 'assets/images/artwork/agnathavasi.jpg'),
(6, 'Akhanda', 3, 6, 'assets/images/artwork/akhanda.jpg'),
(7, 'RRR', 4, 7, 'assets/images/artwork/rrr.jpg'),
(8, 'Arya', 6, 6, 'assets/images/artwork/arya.jpg'),
(9, 'Anirudh Tamil Hit Songs', 1, 1, 'assets/images/artwork/anirudh.jpg'),
(10, 'Hindi Melody', 7, 5, 'assets/images/artwork/hindi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(1, 'Anirudh Ravichander'),
(2, 'G.V. Prakash Kumar'),
(3, 'S S Thaman'),
(4, 'M M Keeravani'),
(5, 'Radhan'),
(6, 'Devi Sri Prasad'),
(7, 'Various Artists'),
(8, 'Sonu Nigam');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Hip-hop'),
(4, 'Rap'),
(5, 'R & B'),
(6, 'Classical'),
(7, 'Techno'),
(8, 'Jazz'),
(9, 'Folk'),
(10, 'Country');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(11, 'Telugu Songs', 'saran1224', '2024-04-28 22:35:58'),
(12, 'Tamil Songs', 'saran1224', '2024-04-28 22:36:07'),
(13, 'English Songs', 'saran1224', '2024-04-28 22:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `playlistSongs`
--

CREATE TABLE `playlistSongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `playlistSongs`
--

INSERT INTO `playlistSongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(3, 45, 12, 1),
(4, 46, 12, 2),
(5, 47, 12, 3),
(6, 48, 12, 4),
(7, 48, 12, 5),
(8, 49, 12, 6),
(9, 50, 12, 7),
(10, 15, 11, 1),
(11, 33, 11, 2),
(12, 20, 11, 3),
(13, 29, 11, 4),
(14, 2, 11, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Songs`
--

CREATE TABLE `Songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL,
  `Rating` int(11) NOT NULL,
  `artistdup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Songs`
--

INSERT INTO `Songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`, `Rating`, `artistdup`) VALUES
(1, 'Bulle', 2, 1, 8, '4:34', 'assets/music/Bulle.mp3', 4, 7, 2, 6),
(2, 'Aa Ante Amalapuram', 6, 8, 1, '5:05', 'assets/music/Aa Ante Amalapuram.mp3', 6, 6, 5, 7),
(3, 'Pranama', 2, 1, 2, '3:30', 'assets/music/Pranama.mp3', 5, 5, 5, 7),
(4, 'Yeyo', 2, 1, 3, '3:51', 'assets/music/Yeyo.mp3', 6, 9, 3, 6),
(5, 'You Rock My World', 6, 8, 4, '5:04', 'assets/music/You Rock My World.mp3', 1, 2, 2, 6),
(6, 'Hoshare', 2, 1, 1, '3:52', 'assets/music/Hoshare.mp3', 1, 5, 4, 7),
(8, 'Thakadimithom', 6, 8, 3, '5:36', 'assets/music/Thakadimithom.mp3', 5, 3, 2, 6),
(9, 'Inka Eedo', 2, 1, 4, '5:17', 'assets/music/Inka Eedo.mp3', 2, 8, 3, 6),
(11, 'Nuvvunte', 6, 8, 6, '5:14', 'assets/music/Nuvvunte.mp3', 2, 7, 5, 7),
(12, 'Neeve', 2, 1, 7, '4:45', 'assets/music/Neeve.mp3', 3, 10, 5, 7),
(13, 'O My Brotheru', 6, 8, 8, '5:07', 'assets/music/O My Brotheru.mp3', 4, 8, 5, 7),
(14, 'Amma Song', 3, 6, 9, '3:22', 'assets/music/Amma Song.mp3', 4, 9, 3, 6),
(15, 'Jai Balayya', 3, 6, 10, '4:24', 'assets/music/Jai Balayya.mp3', 3, 17, 5, 7),
(16, 'Akhanda Title Song', 3, 6, 1, '4:43', 'assets/music/Akhanda Title Song.mp3', 2, 8, 5, 7),
(17, 'Adigaa Adigaa', 3, 6, 2, '4:41', 'assets/music/Adigaa Adigaa.mp3', 1, 5, 4, 7),
(18, 'Komma Uyyala', 4, 7, 1, '4:44', 'assets/music/Komma Uyyala.mp3', 5, 3, 4, 7),
(19, 'Komuram Bheemudo', 4, 7, 2, '3:32', 'assets/music/Komuram Bheemudo.mp3', 4, 3, 4, 7),
(20, 'Naatu Naatu', 4, 7, 3, '3:28', 'assets/music/Naatu Naatu.mp3', 3, 6, 5, 7),
(21, 'Roar Of RRR', 4, 7, 2, '1:51', 'assets/music/Roar Of RRR.mp3', 2, 8, 2, 6),
(22, 'RRR Theme Music', 4, 7, 5, '1:15', 'assets/music/RRR Theme Music.mp3', 1, 2, 1, 6),
(23, 'Emitemitemo', 5, 2, 1, '3:23', 'assets/music/Emitemitemo.mp3', 1, 11, 4, 7),
(24, 'Madhurame', 5, 2, 2, '5:23', 'assets/music/Madhurame.mp3', 2, 10, 4, 7),
(25, 'Feel My Love', 6, 8, 3, '5:02', 'assets/music/Feel My Love.mp3', 5, 2, 4, 7),
(26, 'Dhooram', 5, 2, 4, '3:01', 'assets/music/Dhooram.mp3', 3, 13, 3, 6),
(27, 'Telisiney Na Nuvvey', 5, 2, 5, '4:12', 'assets/music/Telisiney Na Nuvvey.mp3', 4, 13, 5, 7),
(28, 'Mawaa Enthaina', 3, 3, 7, '2:28', 'assets/music/Mawaa Enthaina.mp3', 4, 8, 5, 7),
(29, 'Kurchi Madathapetti', 8, 3, 8, '3:34', 'assets/music/Kurchi Madathapetti.mp3 ', 3, 8, 5, 7),
(30, 'Oh My Baby', 3, 3, 9, '2:36', 'assets/music/Oh My Baby.mp3 ', 2, 1, 5, 7),
(31, 'Dum Masala', 3, 3, 1, '3:27', 'assets/music/Dum Masala.mp3 ', 1, 9, 5, 7),
(32, 'Baitikochi Chuste', 1, 5, 5, '3:27', 'assets/music/Baitikochi Chuste.mp3', 1, 8, 4, 7),
(33, 'Gaali Vaaluga', 1, 5, 6, '4:18', 'assets/music/Gaali Vaaluga.mp3', 2, 4, 5, 7),
(34, 'Dhaga Dhagamaney', 1, 5, 3, '4:16', 'assets/music/Dhaga Dhagamaney.mp3', 3, 10, 2, 6),
(35, 'Swagatham Krishna', 1, 5, 1, '3:24', 'assets/music/Swagatham Krishna.mp3', 4, 7, 3, 6),
(36, 'AB Yevaro Nee Baby', 1, 5, 2, '3:29', 'assets/music/AB Yevaro Nee Baby.mp3', 5, 10, 3, 6),
(37, 'Ramana Aei', 3, 3, 3, '2:35', 'assets/music/Ramana Aei.mp3', 5, 9, 5, 7),
(38, 'Mari Mari', 5, 2, 1, '2:54', 'assets/music/Mari Mari.mp3', 5, 3, 4, 7),
(39, 'Oopiri Aaguthunnadey', 5, 2, 4, '4:05', 'assets/music/Oopiri Aaguthunnadey.mp3', 6, 9, 4, 7),
(40, 'Gundelonaa', 5, 2, 3, '3:55', 'assets/music/Gundelonaa.mp3', 7, 3, 1, 6),
(45, 'Doctor-Climax-Fight', 1, 9, 1, '2:13', 'assets/music/Tamil- Doctor-Climax-Fight.mp3', 1, 1, 5, 7),
(46, 'Arabic-Kuthu', 1, 9, 1, '4:40', 'assets/music/Tamil-Arabic-Kuthu.mp3', 2, 1, 4, 6),
(47, 'Doctor-Theme', 1, 9, 1, '0:43', 'assets/music/Tamil-Doctor-Theme.mp3', 3, 1, 5, 6),
(48, 'Kannazhaga', 1, 9, 1, '3:26', 'assets/music/Tamil-Kannazhaga.mp3', 4, 0, 4, 6),
(49, 'Poo Nee Poo', 1, 9, 1, '3:43', 'assets/music/Tamil-Poo-Nee-Poo.mp3', 5, 0, 4, 7),
(50, 'Veeraraghavan', 1, 9, 1, '1:50', 'assets/music/Tamil-Veeraraghavan.mp3', 6, 1, 5, 7),
(51, 'Why-this-kolaveri-di', 1, 9, 1, '4:20', 'assets/music/Tamil-Why-this-kolaveri-di.mp3', 7, 0, 5, 7),
(52, 'AGAR TUM SATH HO', 7, 10, 5, '2:34', 'assets/music/639cc1ccec15b495b1d7d666a92609ffca3dedff36f50e32367bb97625c55d45.mp3', 8, 1, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `subscribed_users`
--

CREATE TABLE `subscribed_users` (
  `username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribed_users`
--

INSERT INTO `subscribed_users` (`username`) VALUES
('Saran1224');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(11, 'Saran1224', 'Saranteja', 'Mallela', 'Saran123@gmail.com', 'f423374d0f717549c1e8b3623ee59057', '2024-04-28 17:11:48', 'assets/images/profile-pics/head_emerald.png'),
(12, 'Purna123', 'Purnachander', 'Thoom', 'Purna4098@gmail.co', 'e0bcf3e74da190beccaf54817f46c4c7', '2024-04-29 03:48:11', 'assets/images/profile-pics/head_emerald.png'),
(13, 'Rohit3452', 'Rohit', 'Annapureddy', 'Rohithannapureddy612@gmail.com', '1db2cd81f19741d67e4c7aef245a689e', '2024-04-29 03:58:07', 'assets/images/profile-pics/head_emerald.png'),
(14, 'Praneeth456789', 'Praneeth', 'Puppala', 'Praneeth456@gmail.com', '16253bdc00118a1b2a439fa6beb26ef3', '2024-04-29 04:06:00', 'assets/images/profile-pics/head_emerald.png'),
(15, 'Tanmai567', 'Tanmai', 'Veerapaneni', 'Tanmai.veerapaneni@gmail.com', '1d1c3637ba28e0bfa5d8838a4c3cad95', '2024-04-29 04:15:43', 'assets/images/profile-pics/head_emerald.png'),
(16, 'Akshay8217367', 'Akshay', 'Saladi', 'Akshay321677@gmail.com', '50977d6b4d7d7b056427ae04b90b251d', '2024-04-29 04:16:20', 'assets/images/profile-pics/head_emerald.png'),
(17, 'Nikhil27091320', 'Nikhil', 'Tanneru', 'Nikhil73120@gmail.com', '874a615557757055fb62712d3b0d0609', '2024-04-29 04:17:01', 'assets/images/profile-pics/head_emerald.png'),
(18, 'Prajith267382', 'Prajith', 'Macha', 'Prajith263717@gmail.com', '68d369afdac988239ed659b64194f639', '2024-04-29 04:17:43', 'assets/images/profile-pics/head_emerald.png'),
(19, 'Rithvik238789', 'Rithvik', 'Kaza', 'Rithvik.kaza@gmail.com', '3d882a3008124e797293a18d500f1d0b', '2024-04-29 04:18:24', 'assets/images/profile-pics/head_emerald.png'),
(20, 'sunil367127', 'Sunil', 'Kommineni', 'Sunil3261878@gmail.com', '48ccc87cd7afb85704a63e8d5953d326', '2024-04-29 04:19:40', 'assets/images/profile-pics/head_emerald.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`artist`),
  ADD KEY `fk2` (`genre`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `songId` (`songId`),
  ADD KEY `playlistId` (`playlistId`);

--
-- Indexes for table `Songs`
--
ALTER TABLE `Songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist` (`artist`),
  ADD KEY `genre` (`genre`),
  ADD KEY `album` (`album`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Songs`
--
ALTER TABLE `Songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`artist`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`);

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`username`);

--
-- Constraints for table `playlistSongs`
--
ALTER TABLE `playlistSongs`
  ADD CONSTRAINT `playlistsongs_ibfk_1` FOREIGN KEY (`songId`) REFERENCES `Songs` (`id`),
  ADD CONSTRAINT `playlistsongs_ibfk_2` FOREIGN KEY (`playlistId`) REFERENCES `playlists` (`id`);

--
-- Constraints for table `Songs`
--
ALTER TABLE `Songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`artist`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `songs_ibfk_3` FOREIGN KEY (`album`) REFERENCES `albums` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
