-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2019 at 09:02 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `summonerdata`
--

CREATE TABLE `summonerdata` (
  `UserID` int(11) NOT NULL,
  `Data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `summonerdata`
--

INSERT INTO `summonerdata` (`UserID`, `Data`) VALUES
(12, '{\"id\":\"2jG1LY_b-uo5PgnmkLivUF__8qnPhR33ZmS3P9yVJ_oE3dg\",\"accountId\":\"VK70Gox_kdQdoEr1RFYN1UsYuzfRSNzU4sBJ5N0nK0h--7U\",\"puuid\":\"tKjFMJejHGa3mU66P7ZQTV6Rgr_JyoQJ2zrNx3_9oDJnAfMuIY2wqLubEN_8DBkpeBMpDuADkcVPnw\",\"name\":\"HitMeImABardBoy\",\"profileIconId\":4031,\"revisionDate\":1557284835000,\"summonerLevel\":146}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(20, 'test', '$2y$10$jgPq.AoPoqEUhyeqBLoW3O3.Uk9FfJ2efG9EbfonSKN5u9FXsI6Ee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `summonerdata`
--
ALTER TABLE `summonerdata`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `summonerdata`
--
ALTER TABLE `summonerdata`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
