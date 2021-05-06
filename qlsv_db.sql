-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 06, 2021 lúc 04:24 AM
-- Phiên bản máy phục vụ: 10.4.16-MariaDB
-- Phiên bản PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlsv_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(4) DEFAULT NULL COMMENT '1: admin, 0: member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`user_id`, `username`, `password`, `email`, `fullname`, `birthday`, `sex`, `level`) VALUES
(11, 'admin', '202cb962ac59075b964b07152d234b70', 'thehalfheart@gmail.com', '', '', '', 1),
(12, 'huyquantri', 'b8dc042d8cf7deefb0ec6a264c930b02', 'spaurl4@gmail.com', 'Ngô Minh Huy', '2001-01-05', 'Nam', 1),
(13, 'donatram', '4022be356ea2fce7806392244a7512c2', 'donatram@gmail.com', 'Tram', '2019-10-10', 'Nu', 0),
(14, 'donatram2', '4022be356ea2fce7806392244a7512c2', 'donatram2@gmail.com', 'Tram2', '2021-05-06', 'Nu', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tb_sinhvien`
--

CREATE TABLE `tb_sinhvien` (
  `sv_id` int(11) NOT NULL,
  `sv_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sv_sex` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sv_birthday` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tb_sinhvien`
--

INSERT INTO `tb_sinhvien` (`sv_id`, `sv_name`, `sv_sex`, `sv_birthday`) VALUES
(1, 'Nguyễn Văn Cường', 'Nam', '20-11-2015'),
(2, 'Đặng Hoàng Chương', 'Nam', '10-12-2014'),
(3, 'Nguyễn Phú Cường', 'Nam', '30-01-1990'),
(4, 'Nguyễn Thị Thập', 'Nữ¯', '20-11-2011');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `tb_sinhvien`
--
ALTER TABLE `tb_sinhvien`
  ADD PRIMARY KEY (`sv_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `tb_sinhvien`
--
ALTER TABLE `tb_sinhvien`
  MODIFY `sv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
