-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: sql308.byetcluster.com
-- Thời gian đã tạo: Th1 23, 2025 lúc 09:05 AM
-- Phiên bản máy phục vụ: 10.6.19-MariaDB
-- Phiên bản PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `b13_37913435_yame`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Áo', 'các loại áo khoác'),
(2, 'quần', 'các loại quần'),
(5, 'giày', 'các loại giày'),
(6, 'nước uống', 'nước giải khát');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(1, NULL, 'vinh', 'vinh@gmail.com', '012312412', 'shop quá xịn', '2024-12-14 01:27:31'),
(2, NULL, 'zinhdeptrai', 'zinhdeptrai@sibidigameming.com', 'zinhdeptrai', 'lolololo test sdadasdsd', '2024-12-14 15:03:01'),
(3, NULL, 'atoney', 'messi@gmail.com', '0971929098', 'a nay hay qua', '2024-12-14 15:16:21'),
(4, NULL, 'Nguyễn Mai Ngân', 'nguyenmaingan@gmail.com', '0383932084', 'Anh Việt đẹp trai', '2024-12-14 23:33:39'),
(5, NULL, 'atoneyOh', 'ComPaTaiLoc@gmail.com', '0294123003', 'thứ 4 đá banh hog ông êi', '2024-12-15 15:58:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL COMMENT 'Mã đơn hàng',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID người dùng',
  `customer_name` varchar(255) NOT NULL COMMENT 'Tên khách hàng',
  `email` varchar(255) NOT NULL COMMENT 'Email khách hàng',
  `address` varchar(255) NOT NULL COMMENT 'Địa chỉ giao hàng',
  `phone` varchar(20) NOT NULL COMMENT 'Số điện thoại',
  `total_price` decimal(12,2) NOT NULL COMMENT 'Tổng giá trị đơn hàng',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian đặt hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `customer_name`, `email`, `address`, `phone`, `total_price`, `created_at`) VALUES
(4, 7, 'fsdf', 'sdfsdf@gmail.com', 'sdfsdf', '2131232', '3055878.00', '2024-12-10 01:37:00'),
(5, 9, 'vinh', 'vinh@gmail.com', 'sg', '123039123', '12313.00', '2024-12-02 01:38:06'),
(6, NULL, '312', '312312@gmail.com', '321321', '123', '3213.00', '2024-12-06 12:24:08'),
(7, 7, 'triển', 'trien@gmail.com', 'sg', '213213', '49700000.00', '2024-12-13 12:31:39'),
(8, 7, 'sdfsf', 'fwe@gmail.com', '231', '21312', '2982000.00', '2024-12-13 12:38:16'),
(9, 7, 'vinh', 'ngovinh@gmail.com', 'sg', '0123455678', '22312.00', '2024-12-13 22:33:34'),
(10, 7, '', '', '', '', '1232131.00', '2024-12-13 22:36:30'),
(11, 7, 'rẻw', 'rưer', 'ưer', '234', '1232131.00', '2024-12-13 22:38:32'),
(12, 7, 'fwefwe', 'èwfe', 'ưeffe', '234234', '1244443.00', '2024-12-13 22:40:36'),
(13, 7, '', '', '', '', '1254443.00', '2024-12-13 22:52:24'),
(14, 7, 'vinh', 'vinh@gmail.com', 'sdfsd', '0123456789', '1232131.00', '2024-12-13 23:01:09'),
(15, 7, 'vinh', 'vinh@gmail.com', 'sg', '0123456789', '2661402.96', '2024-12-13 23:16:22'),
(16, 7, 'vinh', 'vinh@gmail.com', 'sb', '0123456789', '10800.00', '2024-12-13 23:19:05'),
(17, 7, 'vinh', 'vinh@gmail.com', 'sg', '0123456789', '324000.00', '2024-12-13 23:42:54'),
(18, 10, 'vinh', 'test@gmail.com', 'sg', '0123456789', '324000.00', '2024-12-13 23:45:35'),
(19, 10, 'vinh', 'vinh@gmail.com', 'sg', '0123456789', '100000.00', '2024-12-13 23:48:44'),
(20, 10, 'vinh', 'vinh@gmail.com', 'sg', '0123456789', '100000.00', '2024-12-13 23:48:48'),
(21, 10, 'fsfsd', 'sfsdf@gmail.com', '231', '3213123123', '432000.00', '2024-12-13 23:53:02'),
(22, 10, 'vadv', 'vsdvs@gmail.com', 'sg', '0123456789', '324000.00', '2024-12-14 15:00:09'),
(23, 11, 'cac', 'dac@gnail.com', 'shsjjs', '0303030303', '432000.00', '2024-12-14 15:02:48'),
(24, 12, 'zinhdeptrai', 'zinhdeptrai@sibidigameming.com', 'Shyintsi\r\nShyintsi', '8543810271', '648000.00', '2024-12-14 15:03:44'),
(25, 13, 'Lê Huỳnh Gia Uyên', 'lehuynhgiauyen1923@gmail.com', 'sg', '0123456789', '972000.00', '2024-12-14 15:11:07'),
(26, 15, 'Zinh', 'gay@gmail.com', '123', '0909901900', '324000.00', '2024-12-14 16:09:14'),
(27, 11, 'tài lộc', 'tailoc@sting.com', 'Thấp Lỗ', '0123456789', '388800.00', '2024-12-14 21:17:04'),
(28, 18, 'Nguyễn Mai Ngân', 'nguyenmaingan@gmail.com', '30', '0383932084', '324000.00', '2024-12-14 23:32:38'),
(29, 18, 'Hh', 'nguyenmaingan@gmail.com', 'H', '0768860172', '432000.00', '2024-12-14 23:34:28'),
(30, 19, 'An', 'an@gmail.com', '108 quận 8', '0923743947', '1404000.00', '2024-12-14 23:44:27'),
(31, 20, 'Zinh', 'zinh@gmail.com', 'Hdiwjsnnsn', '0297353836', '324000.00', '2024-12-15 14:43:22'),
(32, 7, 'test', 'test@gmail.com', 'sg', '0123456789', '1728000.00', '2024-12-15 16:11:21'),
(33, 21, 'owen', 'nguyenminhtruong8910@gmail.com', 'NewYork', '0987654321', '772200.00', '2024-12-15 17:56:37'),
(34, 22, 'atoney ', 'MessiNgo@gmail.com', '180 Cao Lo', '0989167232', '154440.00', '2024-12-15 21:09:30'),
(35, 23, 'zinhkhum', 'lehuynhgiauyen23@gmail.com', 'Phú Mỹ Hưng', '0893790017', '356400.00', '2024-12-15 21:29:31'),
(36, 24, 'Phúc', 'phuc@gmail.com', '180 Cao Lỗ', '0396895104', '324000.00', '2024-12-16 03:22:09'),
(37, 25, 'feqf', '123@gmial.com', '4645646', '1234567800', '432000.00', '2024-12-16 08:19:26'),
(38, 25, 'Ngô Quốc Zinh', '123@gmial.com', 'STU', '0123456789', '230000000.00', '2024-12-16 11:16:40'),
(39, 7, 'tiến trung', 'trung@gmail.com', 'sg', '0123456789', '1620000.00', '2024-12-16 11:31:28'),
(40, 17, 'tài', 'tai@gmail.com', 'sg', '0123456789', '324000000.00', '2024-12-17 00:04:43'),
(41, 27, 'Trần Ngọc Như', 'tranngocnhu9a1@gmail.com', '75 đường 79 Tân quy tphcm', '0778600569', '4104000.00', '2024-12-17 21:40:04'),
(42, 7, 'vinh', 'vinh@gmail.com', 'sg', '0123456789', '432000.00', '2025-01-03 20:53:26'),
(43, 17, 'vinh', 'vinh@gmail.com', 'sg\r\n', '0123456789', '538920.00', '2025-01-15 22:28:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL COMMENT 'Mã mục chi tiết',
  `order_id` int(11) NOT NULL COMMENT 'ID đơn hàng',
  `product_id` int(11) NOT NULL COMMENT 'ID sản phẩm',
  `quantity` int(11) NOT NULL COMMENT 'Số lượng',
  `price` decimal(10,2) NOT NULL COMMENT 'Đơn giá sản phẩm'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 4, 2, 6, '497000.00'),
(2, 4, 5, 6, '12313.00'),
(3, 5, 5, 1, '12313.00'),
(4, 6, 6, 1, '3213.00'),
(5, 7, 2, 100, '497000.00'),
(6, 8, 2, 6, '497000.00'),
(7, 9, 4, 1, '12312.00'),
(8, 9, 9, 1, '10000.00'),
(9, 10, 3, 1, '1232131.00'),
(10, 11, 3, 1, '1232131.00'),
(11, 12, 3, 1, '1232131.00'),
(12, 12, 4, 1, '12312.00'),
(13, 13, 4, 1, '12312.00'),
(14, 13, 9, 1, '10000.00'),
(15, 13, 3, 1, '1232131.00'),
(16, 14, 3, 1, '1232131.00'),
(17, 15, 3, 2, '1232131.00'),
(18, 16, 9, 1, '10000.00'),
(19, 17, 2, 1, '300000.00'),
(20, 18, 2, 1, '300000.00'),
(21, 21, 3, 1, '400000.00'),
(22, 22, 5, 1, '300000.00'),
(23, 23, 3, 1, '400000.00'),
(24, 24, 2, 1, '300000.00'),
(25, 24, 4, 1, '300000.00'),
(26, 25, 5, 2, '300000.00'),
(27, 25, 6, 1, '300000.00'),
(28, 26, 2, 1, '300000.00'),
(29, 27, 23, 24, '15000.00'),
(30, 28, 4, 1, '300000.00'),
(31, 29, 3, 1, '400000.00'),
(32, 30, 2, 1, '300000.00'),
(33, 30, 21, 100, '10000.00'),
(34, 31, 2, 1, '300000.00'),
(35, 32, 2, 1, '300000.00'),
(36, 32, 3, 1, '400000.00'),
(37, 32, 4, 1, '300000.00'),
(38, 32, 5, 2, '300000.00'),
(39, 33, 2, 1, '300000.00'),
(40, 33, 3, 1, '400000.00'),
(41, 33, 23, 1, '15000.00'),
(42, 34, 23, 3, '15000.00'),
(43, 34, 22, 4, '12000.00'),
(44, 34, 21, 5, '10000.00'),
(45, 35, 21, 3, '10000.00'),
(46, 35, 2, 1, '300000.00'),
(47, 36, 2, 1, '300000.00'),
(48, 37, 3, 1, '400000.00'),
(49, 38, 21, 100, '10000.00'),
(50, 38, 9, 111, '300000.00'),
(51, 38, 6, 130, '300000.00'),
(52, 38, 5, 111, '300000.00'),
(53, 38, 4, 120, '300000.00'),
(54, 38, 3, 110, '400000.00'),
(55, 38, 2, 90, '300000.00'),
(56, 39, 23, 100, '15000.00'),
(57, 40, 9, 1000, '300000.00'),
(58, 41, 2, 8, '400000.00'),
(59, 41, 6, 2, '300000.00'),
(60, 42, 3, 1, '400000.00'),
(61, 43, 16, 1, '499000.00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `category_id`) VALUES
(2, 'Áo khoác', 'Áo khoác dù chống nắng, cản gió, trượt nước - Phong cách năng động, đậm chất mùa hè.\r\n1. Kiểu sản phẩm: Áo khoác không nón dáng vừa.\r\n2. Ưu điểm:\r\nCản gió: Giữ ấm và bảo vệ khỏi gió lạnh.\r\nTrượt nước: tránh được những cơn mưa nhỏ bất chợt, và cũng có thể khoác tránh sương khi đêm về.\r\nNhẹ, nhanh khô.\r\n', '400000.00', 992, 'image_product/9e81cf89-94c5-6000-a937-001b3ee41b3d.jpg', 1),
(3, 'quần ', 'quần ', '400000.00', 12188, 'image_product/f8c4c76f-5b6f-1700-d6e5-001b10a65be0.jpg', 2),
(4, 'áo khoác', 'Áo khoác thun French Terry giữ ấm, chống nắng, phù hợp cho mùa đông.\r\n1. Kiểu sản phẩm: Áo khoác thun\r\n2. Ưu điểm:\r\n● Mặc ấm: Chất liệu thun French Terry giúp giữ ấm cho cơ thể trong thời tiết lạnh.\r\n● Chống nắng: Áo khoác có thể là một lớp bảo vệ khỏi tác động của tia UV khi bạn ra ngoài.\r\n', '300000.00', 12195, 'image_product/762e8f4f-0f4e-3400-8bda-001b8f3890fd.jpg', 1),
(5, 'áo khoác', 'Áo khoác jean chống nắng Seventy Seven - Phong cách đơn giản, năng động\r\n1.Kiểu sản phẩm: Áo khoác jean không nón dáng vừa.\r\n2. Ưu điểm: Dễ dàng phối đồ với nhiều phong cách khác nhau, từ cá tính đến thanh lịch, không chỉ mang đến vẻ thời trang mà còn có công dụng chống nắng hiệu quả.\r\n', '300000.00', 10, 'image_product/6cb6d792-0787-4301-f118-001b4eda10f6.jpg', 1),
(6, 'áo polo', 'Áo thun Polo Cool Touch: Mát lạnh, mềm mịn, phong cách thời trang.\r\n1. Kiểu sản phẩm: Áo thun Polo tay ngắn.\r\n2. Ưu điểm:\r\n Mặc Mát giúp áo thoáng mát và thoát ẩm hiệu quả, giữ bạn luôn khô ráo và thoải mái vận động\r\n', '300000.00', 31998, 'image_product/bed4c2d8-b0db-5000-f521-001ac85e140c.jpg', 1),
(9, 'áo sơ mi', 'áo sơ mi', '300000.00', 8886, 'image_product/a522768d-f383-e200-3c5a-001b3f08b2f4.jpg', 1),
(12, 'quần dài', 'quần', '400000.00', 3123, 'image_product/209ab0bd-3a51-aa00-5364-001bf09f94fc.jpg', 2),
(16, 'quần dài', 'quần ', '499000.00', 122, 'image_product/quan-tay-cong-so-nu-ong-suong-qcs01-30.webp', 2),
(21, 'sting', 'tài lộc quá lớn', '10000.00', 100, 'image_product/images (2).jpg', 6),
(22, 'sting vàng', 'tài lộc quá lớn', '12000.00', 100, 'image_product/images.jpg', 6),
(23, 'sting xanh', 'tài lộc quá lớn', '15000.00', 100, 'image_product/images (1).jpg', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'image_avata/avatar.png',
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `gender` enum('Nam','Nữ','Khác') DEFAULT 'Khác',
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`Id`, `username`, `password`, `email`, `avatar`, `role`, `gender`, `phone`, `address`) VALUES
(1, 'vinh', '$2y$10$VMfDhu8EHWOGjP/c3w3Uper', 'vinh@gmail.com', '', 'user', 'Khác', NULL, NULL),
(2, 'vinh1', '$2y$10$t0II5FpTLx1FOkW5aYMO7.E', 'vinh@gmail.com', '', 'user', 'Khác', NULL, NULL),
(3, 'quocvinh', '$2y$10$6/9ZUFO8bB9nqcG7GN9jc.i', 'vinh1@gmail.com', '', 'user', 'Khác', NULL, NULL),
(4, 'ngovinh', '$2y$10$OJ8Ekya4N3X8Mak9n5l4jeV', 'ngovinh@gmail.com', '', 'user', 'Khác', NULL, NULL),
(5, 'quocvinh1', '$2y$10$G7.Hvu9U0nPLldzT1iZ/Wuh', 'quocvinh@gmail.com', '', 'user', 'Khác', NULL, NULL),
(6, 'quocvinh2', '$2y$10$VApCcEs.YGS3s4wmaGPxn.K', 'quocvinh@gmail.com', '', 'user', 'Khác', NULL, NULL),
(7, 'quocvinh3', '$2y$10$9iCarO3hoyyFzWWo7ovqaecBH1iHN1MyExvKOTvxuYl1G1VqPmw..', 'quocvinh@gmail.com', 'image_avata/zinhdeptrai.jpg', 'user', 'Nam', '0799117548', 'sg'),
(8, 'zinhdeptrai', '$2y$10$1Dg9EyuNIh6cJDLMUH7h2OagAVGzzjEuoLg8WzmoiWBKIssQYAxcW', 'admin@gmail.com', 'image_avata/avatar.png', 'admin', 'Khác', '', ''),
(9, 'quocvinh4', '$2y$10$d5UCoKwqdPcgIm1mBbB3IOQFHwn13.rgCW9htMjzbyIvz2xrYD/96', 'vinh@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(10, 'quocvinh5', '$2y$10$aaxOyadbMLD9EIHK8lJERezgexRdif9m8oJ3OXplpSgy0vajxY6eO', 'ngovinh@gmail.com', 'image_avata/avatar.png', 'admin\r\n', 'Khác', NULL, NULL),
(11, 'dac', '$2y$10$xuQyRq08WTnN8sV2Fo21J.Cy7JrL4fTjax7bl9KYd39ZtJGmfxEyG', 'dac@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(12, 'zinhdeptrai1', '$2y$10$Q0q2HBB1kCbdOfszxunItuXrLqy4SnvjpKE5yHQz6LiF8Khnwb7Wy', 'zinhdeptrai@sibidigameming.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(13, 'Gia Uyen', '$2y$10$GRAhuQdWsQUWfYu6Jgoa2uO8O1DfewU2dNRtR1bZ44hzVWSJPTNne', 'lehuynhgiauyen1923@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(14, 'My phùng', '$2y$10$AELiqJAq2IxOzAsV63Egb.xb2nBWwg/8nRRTb3KGboy9TwvAwLYKu', 'myphung.0311@gmail', 'image_avata/avatar.png', 'user', 'Khác', '', ''),
(15, 'Zinh gay', '$2y$10$g8.KjieAjyN8BYRfI0w42OxfvkwtwLPKV1GgAVbHgiFQgzSqt65o6', 'zinhgay123456@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(16, 'admin', '$2y$10$nNID44vPx3jkQyrNWQ3xGenjGSNGww/tJc48dazQxIxxZRBRrNeRq', 'admin@gmail.com', 'image_avata/avatar.png', 'admin', 'Khác', NULL, NULL),
(17, 'vietdeptrai', '$2y$10$b54B4jLnAVSd/EyxiXx4d.Pv4fV5aRzyQKMA2AzWZ/CMP01fmTmZi', 'viet@gmail.com', 'image_avata/avatar.png', 'admin', 'Khác', NULL, NULL),
(18, 'Nguyễn Mai Ngân', '$2y$10$EpSEHMXGiG21pldN1GNvAuC7F4FtzZMO701NpiVevZSZ8so./c1WW', 'nguyenmaingan@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(19, 'An', '$2y$10$kogvGERiBLXG.lMGDdDwxuD8L8WHZ0giIGKHM.iBML.aOvcTi769q', 'an@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(20, 'Zinh', '$2y$10$psxpHFveGk1pZkehE7O25OfEuayD8Ib2LbhObAH1tU7ClC5tMb8B6', 'zinh@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(21, 'owen', '$2y$10$y0sMyF8Qg.W1Sqz8SIvvOu5OzYwkmlIJgG92rA5vtptRdohZUi0ji', 'nguyenminhtruong8910@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(22, 'kkiendibo', '$2y$10$9yD/JR6NizhmYyMLdpKm/uJIlgwSobUx1SZwwCt20mrYqdXKfOype', 'Atoney@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(23, 'zinhkhum', '$2y$10$nvBiUC9cAbflST1u2xkFm.jCfFm0HJsgnLDUUSAjoeMFqHoKQbprW', 'lehuynhgiauyen23@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(24, 'bu', '$2y$10$FA5qdq6nyr0es87.8Xtib.D4o/RammcKf5Jw0aoSW0WZis1ypLc3K', 'bu@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(25, '123', '$2y$10$kTVh82bpeqfrpOWavs9UE.Qady/amB1sAXVWgyi8SFr14oJcX408u', '123@gmial.com', 'image_avata/avatar.png', 'user', 'Khác', '', ''),
(26, '12345', '$2y$10$yvL5XQ/VwguWVyCHw0JWX.928N0aYYCP7h7KvqJ58rtvUdXTL5ry.', '123@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL),
(27, 'Như', '$2y$10$JQGm4JPPnSRz/051ZW/F1uTCw5w3r6zMelKUC4MmZlB6qD/8InwkO', 'tranngocnhu9a1@gmail.com', 'image_avata/avatar.png', 'user', 'Khác', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contacts_users` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã đơn hàng', AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mã mục chi tiết', AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_users` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
