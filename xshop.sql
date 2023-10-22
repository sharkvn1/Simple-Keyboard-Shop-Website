-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 22, 2023 lúc 03:23 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `xshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `Id` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `ImagePath` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`Id`, `CategoryName`, `ImagePath`) VALUES
(5, 'Mỡ Lube', 'img/menu/lube.png'),
(6, 'Dụng Cụ Lube', 'img/menu/dungculube.png'),
(7, 'Rk', 'img/menu/rk.jpg'),
(8, 'Bao Đựng Phím', 'img/menu/tuidung.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `Id` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CommentContent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufacturer`
--

CREATE TABLE `manufacturer` (
  `Id` int(11) NOT NULL,
  `ManufacturerName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ImagePath` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Discount` int(11) NOT NULL DEFAULT 0,
  `IdCategory` int(11) NOT NULL,
  `IdManufacturer` int(11) NOT NULL,
  `DateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `ProductDescriptions` text NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SpecialStatus` bit(1) NOT NULL DEFAULT b'0',
  `View` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Fullname` varchar(50) DEFAULT NULL,
  `ImagePath` varchar(50) DEFAULT 'img/deAva.jpg',
  `Email` varchar(50) NOT NULL,
  `UserRole` bit(1) DEFAULT b'0',
  `DateAdd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`Id`, `Username`, `Password`, `Fullname`, `ImagePath`, `Email`, `UserRole`, `DateAdd`) VALUES
(6, 'NhatAnhVu', '111111111', NULL, 'img/deAva.jpg', 'gawrgurashark1@gmail.com', b'0', '2023-10-21 23:51:39'),
(7, 'Mary Johnson', '444444444', NULL, 'img/deAva.jpg', 'mary.johnson@email.com', b'0', '2023-10-21 23:51:39'),
(8, 'Robert Davis', '555555555', NULL, 'img/deAva.jpg', 'robert.davis@email.com', b'0', '2023-10-21 23:51:39');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Product Comment` (`ProductId`),
  ADD KEY `Customer Comment` (`UserId`);

--
-- Chỉ mục cho bảng `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`Id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Product Manufacturer` (`IdManufacturer`),
  ADD KEY `Product Category` (`IdCategory`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `Customer Comment` FOREIGN KEY (`UserId`) REFERENCES `users` (`Id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `Product Comment` FOREIGN KEY (`ProductId`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Product Category` FOREIGN KEY (`IdCategory`) REFERENCES `category` (`Id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `Product Manufacturer` FOREIGN KEY (`IdManufacturer`) REFERENCES `manufacturer` (`Id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
