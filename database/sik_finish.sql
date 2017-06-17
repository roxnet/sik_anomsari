-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2017 at 02:59 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sik_finish`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `password` varchar(48) DEFAULT NULL,
  `nickname` varchar(25) DEFAULT NULL,
  `name` varchar(35) DEFAULT NULL,
  `profil` varchar(25) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `bloodtype` enum('AB','A','B','O') DEFAULT NULL,
  `birthplace` varchar(25) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `id_keluarga` int(11) DEFAULT NULL,
  `job` varchar(25) DEFAULT NULL,
  `level_user` enum('admin','user') DEFAULT NULL,
  `status` enum('online','offline') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `email`, `password`, `nickname`, `name`, `profil`, `gender`, `bloodtype`, `birthplace`, `birthdate`, `address`, `id_keluarga`, `job`, `level_user`, `status`) VALUES
(6, 'gg@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'fly', 'galang fly', '', 'L', 'O', 'sragen', '1995-12-25', 'yogyakarta', 1, 'Mahasiswa', '', 'online'),
(7, 'ruzel44@gmail.com', '02c75fb22c75b23dc963c7eb91a062cc', 'ruzel', 'ruzel arfan', '', 'L', 'AB', 'moscow', '1998-10-21', 'bandung', 2, 'pelajar SMA', '', 'online'),
(8, 'fadini@gmail.com', '36f17c3939ac3e7b2fc9396fa8e953ea', 'dini', 'fa dini', '', 'P', 'AB', 'sragen', '1990-07-09', 'semarang', 2, 'guru', '', 'offline'),
(12, 'hikaiJ@gmail.com', 'f5347d0170867512c26d089d7c3f7e7f', 'yuuri', 'yuuri hikai', '', 'P', 'O', 'tokyo', '1999-11-17', 'jakarta', 1, 'mahasiswa', '', 'offline'),
(14, 'gusty@gmail.com', 'a152e841783914146e4bcd4f39100686', 'gusti', 'gusti pangestu', '', 'L', 'B', 'sragen', '1994-06-16', 'sragen', 1, 'pengacara', '', 'offline'),
(15, 'azriin@gmail.com', '75c6921930950c5b92f315835884db01', 'riin', 'azuma rin', '', 'P', 'B', 'hokkaido', '1995-12-19', 'aichi', 1, 'dokter gigi', '', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `bahasan_forum`
--

CREATE TABLE `bahasan_forum` (
  `id_bahasan` int(11) NOT NULL,
  `id_forum` int(11) DEFAULT NULL,
  `topic` varchar(30) DEFAULT NULL,
  `content` text,
  `image` varchar(25) DEFAULT NULL,
  `id_creator` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `balas_komentar`
--

CREATE TABLE `balas_komentar` (
  `id_bkomentar` int(11) NOT NULL,
  `id_komentar` int(11) DEFAULT NULL,
  `komentar` text,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bcategory`
--

CREATE TABLE `bcategory` (
  `id_category` int(11) NOT NULL,
  `category` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bcategory`
--

INSERT INTO `bcategory` (`id_category`, `category`) VALUES
(1, 'hobby');

-- --------------------------------------------------------

--
-- Table structure for table `bkomentar`
--

CREATE TABLE `bkomentar` (
  `id_komentar` int(11) NOT NULL,
  `id_artikel` int(11) DEFAULT NULL,
  `komentar` text,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id_artikel` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `tittle` varchar(35) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `content` text,
  `date_post` date DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `filter` enum('nonanggota','anggota','publik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment_forum`
--

CREATE TABLE `comment_forum` (
  `id_comment` int(11) NOT NULL,
  `id_bahasan` int(11) DEFAULT NULL,
  `id_creator` int(11) DEFAULT NULL,
  `comment` text,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcategory`
--

CREATE TABLE `fcategory` (
  `id_category` int(11) NOT NULL,
  `category` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fcategory`
--

INSERT INTO `fcategory` (`id_category`, `category`) VALUES
(4, 'coba'),
(5, 'coba 2');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id_forum` int(11) NOT NULL,
  `id_fkategory` int(11) DEFAULT NULL,
  `judul_forum` varchar(25) DEFAULT NULL,
  `keterangan` text,
  `id_creator` int(11) DEFAULT NULL,
  `status` enum('online','offline') DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `edited_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image_anggota`
--

CREATE TABLE `image_anggota` (
  `id_anggota` int(11) NOT NULL,
  `link_img` varchar(25) DEFAULT NULL,
  `add_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `nama_keluarga` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`id_keluarga`, `nama_keluarga`) VALUES
(1, 'keluarga 1'),
(2, 'keluarga 2');

-- --------------------------------------------------------

--
-- Table structure for table `phone_number`
--

CREATE TABLE `phone_number` (
  `id_anggota` int(11) DEFAULT NULL,
  `phone_number` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_number`
--

INSERT INTO `phone_number` (`id_anggota`, `phone_number`) VALUES
(14, '096383639455'),
(15, '081225163475'),
(6, '081225163475');

-- --------------------------------------------------------

--
-- Table structure for table `private_message`
--

CREATE TABLE `private_message` (
  `id_anggota` int(11) DEFAULT NULL,
  `id_anggota1` int(11) DEFAULT NULL,
  `pesan` text,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `private_message`
--

INSERT INTO `private_message` (`id_anggota`, `id_anggota1`, `pesan`, `date`) VALUES
(6, 7, 'ujii coba chat\r\n', '2017-04-30'),
(7, 6, 'uji lagii dari pengirim', '2017-05-01'),
(6, 8, 'ini chat lain', '2017-05-01'),
(8, 6, 'ini lain lagi', '2017-05-01'),
(6, 7, 'hallo lagi ujii coba nihh', '2017-05-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_keluarga` (`id_keluarga`);

--
-- Indexes for table `bahasan_forum`
--
ALTER TABLE `bahasan_forum`
  ADD PRIMARY KEY (`id_bahasan`),
  ADD KEY `id_forum` (`id_forum`),
  ADD KEY `id_creator` (`id_creator`);

--
-- Indexes for table `balas_komentar`
--
ALTER TABLE `balas_komentar`
  ADD PRIMARY KEY (`id_bkomentar`),
  ADD KEY `id_komentar` (`id_komentar`);

--
-- Indexes for table `bcategory`
--
ALTER TABLE `bcategory`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `bkomentar`
--
ALTER TABLE `bkomentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_artikel` (`id_artikel`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `comment_forum`
--
ALTER TABLE `comment_forum`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_bahasan` (`id_bahasan`),
  ADD KEY `id_creator` (`id_creator`);

--
-- Indexes for table `fcategory`
--
ALTER TABLE `fcategory`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id_forum`),
  ADD KEY `id_fkategory` (`id_fkategory`),
  ADD KEY `id_creator` (`id_creator`);

--
-- Indexes for table `image_anggota`
--
ALTER TABLE `image_anggota`
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indexes for table `phone_number`
--
ALTER TABLE `phone_number`
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indexes for table `private_message`
--
ALTER TABLE `private_message`
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_anggota1` (`id_anggota1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `bahasan_forum`
--
ALTER TABLE `bahasan_forum`
  MODIFY `id_bahasan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balas_komentar`
--
ALTER TABLE `balas_komentar`
  MODIFY `id_bkomentar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bcategory`
--
ALTER TABLE `bcategory`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bkomentar`
--
ALTER TABLE `bkomentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment_forum`
--
ALTER TABLE `comment_forum`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fcategory`
--
ALTER TABLE `fcategory`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id_forum` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `image_anggota`
--
ALTER TABLE `image_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_keluarga`) REFERENCES `keluarga` (`id_keluarga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bahasan_forum`
--
ALTER TABLE `bahasan_forum`
  ADD CONSTRAINT `bahasan_forum_ibfk_1` FOREIGN KEY (`id_forum`) REFERENCES `forum` (`id_forum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bahasan_forum_ibfk_2` FOREIGN KEY (`id_creator`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `balas_komentar`
--
ALTER TABLE `balas_komentar`
  ADD CONSTRAINT `balas_komentar_ibfk_1` FOREIGN KEY (`id_komentar`) REFERENCES `bkomentar` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bkomentar`
--
ALTER TABLE `bkomentar`
  ADD CONSTRAINT `bkomentar_ibfk_1` FOREIGN KEY (`id_artikel`) REFERENCES `blog` (`id_artikel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `bcategory` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_forum`
--
ALTER TABLE `comment_forum`
  ADD CONSTRAINT `comment_forum_ibfk_1` FOREIGN KEY (`id_bahasan`) REFERENCES `bahasan_forum` (`id_bahasan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_forum_ibfk_2` FOREIGN KEY (`id_creator`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`id_fkategory`) REFERENCES `fcategory` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_ibfk_2` FOREIGN KEY (`id_creator`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_anggota`
--
ALTER TABLE `image_anggota`
  ADD CONSTRAINT `image_anggota_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phone_number`
--
ALTER TABLE `phone_number`
  ADD CONSTRAINT `phone_number_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `private_message`
--
ALTER TABLE `private_message`
  ADD CONSTRAINT `private_message_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `private_message_ibfk_2` FOREIGN KEY (`id_anggota1`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
