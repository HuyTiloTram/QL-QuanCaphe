-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 11, 2021 lúc 10:02 AM
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
-- Cơ sở dữ liệu: `qlquancaphe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

CREATE TABLE `ban` (
  `MaBan` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenBan` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TinhTrangChoNgoi` varchar(50) COLLATE utf8mb4_vietnamese_ci DEFAULT 'Trống',
  `SizeBan` int(11) NOT NULL,
  `Hinhanh` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `ban`
--

INSERT INTO `ban` (`MaBan`, `TenBan`, `TinhTrangChoNgoi`, `SizeBan`, `Hinhanh`) VALUES
('1', 'Bàn phía trước sân', 'Trống', 2, 'ban1.jpg'),
('2', 'Bàn trong', 'Trống', 4, 'ban2.jpg'),
('3', 'Bàn trong', 'Trống', 4, 'ban3.jpg'),
('4', 'Bàn trong số 4', 'Trống', 6, 'ban4.jpg'),
('5', 'Bàn ngoài số 5', 'Trống', 8, 'ban5.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `Stt` int(11) NOT NULL,
  `MaHD` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `MaSP` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenSP` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Soluong` int(11) NOT NULL,
  `Dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `NgayLap` datetime NOT NULL,
  `MaNV` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Tien` int(11) NOT NULL,
  `Giamgia` int(11) NOT NULL,
  `Tongtien` int(11) NOT NULL,
  `HinhThucThanhToan` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `MaBan` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khonguyenlieu`
--

CREATE TABLE `khonguyenlieu` (
  `MaNL` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenNL` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `ConLai` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `CacMaNCC` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MaLoai` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenLoai` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`MaLoai`, `TenLoai`) VALUES
('1', 'Cà phê'),
('2', 'Sữa'),
('3', 'Trà sữa'),
('4', 'Nước ngọt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luong`
--

CREATE TABLE `luong` (
  `Stt` int(11) NOT NULL,
  `MaNV` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Socatruc1thang` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `luongthang` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenNCC` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Diachi` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `SDT` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `CacNL` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNV` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenNV` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `username` char(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `SDT` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `CCCD` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Diachi` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Congviec` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Namvao` date NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `TenSP` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `Hinhanh` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `LoaiSP` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `GiaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `CacMaNL` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `Hinhanh`, `LoaiSP`, `GiaSP`, `SoLuong`, `CacMaNL`) VALUES
('001', 'Cà phê đen', 'capheden.jpg', '1,2', 10000, 20, '1,2'),
('002', 'Cà phê đen sài gòn', 'caphedensaigon.jpg', '1,2,3,', 10000, 20, '2,3');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`MaBan`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`Stt`),
  ADD KEY `MaHD` (`MaHD`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`),
  ADD KEY `MaNV` (`MaNV`),
  ADD KEY `MaBan` (`MaBan`);

--
-- Chỉ mục cho bảng `khonguyenlieu`
--
ALTER TABLE `khonguyenlieu`
  ADD PRIMARY KEY (`MaNL`);

--
-- Chỉ mục cho bảng `luong`
--
ALTER TABLE `luong`
  ADD KEY `MaNV` (`MaNV`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MaNCC`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`MaHD`) REFERENCES `hoadon` (`MaHD`),
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`),
  ADD CONSTRAINT `hoadon_ibfk_2` FOREIGN KEY (`MaBan`) REFERENCES `ban` (`MaBan`);

--
-- Các ràng buộc cho bảng `luong`
--
ALTER TABLE `luong`
  ADD CONSTRAINT `luong_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `nhanvien` (`MaNV`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`CacMaNL`) REFERENCES `mathang` (`MaMH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
