-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2026 at 02:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlhocphan`
--

-- --------------------------------------------------------

--
-- Table structure for table `giangvien`
--

CREATE TABLE `giangvien` (
  `IDGV` varchar(20) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `SumClass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `giangvien`
--

INSERT INTO `giangvien` (`IDGV`, `Fullname`, `Image`, `SumClass`) VALUES
('001', 'Đoàn Văn Nam', 'nghe nhạc.jpg', 5),
('GV01', 'Nguyễn Văn A', 'nghe nhạc.jpg', 5),
('GV02', 'Trần Thị B', 'trường cũ.jpg', 3),
('GV03', 'Lê Hoàng C', 'ảnh áo dài.jpg', 4),
('GV04', 'Phạm Tiến D', 'trường cũ.jpg', 2),
('GV05', 'Lê Anh Kiệt', 'ảnh áo dài.jpg', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `giangvien`
--
ALTER TABLE `giangvien`
  ADD PRIMARY KEY (`IDGV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
