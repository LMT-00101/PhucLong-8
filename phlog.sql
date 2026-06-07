-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 06:12 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phlog`
--

CREATE DATABASE IF NOT EXISTS `phlog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phlog`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `address`) VALUES
(17, 15, 'Vĩnh Long 123'),
(18, 6, 'Hà Nội'),
(21, 16, 'Cầu giấy Hà Nội'),
(22, 17, 'Quận 1, HCM'),
(23, 18, 'Quân 1 HCM');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` int NOT NULL,
  `product_quantity` int NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `image`, `status`) VALUES
(1, 'Chưa có danh mục', 'tieng-anh-nguoi-moi.jpg', 1),
(2, 'Trà sữa', 'tra-sua.png', 1),
(4, 'Cà phê', 'caffe.png', 1),
(6, 'Đá xay', 'da-xay.png', 1),
(16, 'Trà trái cây', 'tra-trai-cay.png', 1),
(17, 'Kem silky', 'kenm.png', 1),
(19, 'Bánh', 'banhh.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 ẩn 1 hiện',
  `user_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `date`, `status`, `user_id`, `product_id`) VALUES
(1, 'Helllo', '2024-11-25 19:46:51', 1, 6, 26),
(2, 'Tôi là khoa nè', '2024-11-25 20:06:15', 1, 6, 21),
(3, 'Admin nè xin chào mn', '2024-11-25 20:48:50', 1, 8, 26),
(4, 'Hello', '2024-11-26 12:00:44', 1, 6, 27),
(5, 'Sản phẩm tốt đọc hay nên mua nha mn', '2024-11-29 21:11:44', 1, 6, 27),
(8, 'Ngày 12/10/2025 Hello every one', '2024-12-05 09:46:35', 1, 6, 28),
(11, 'Xin chào mọi người t', '2025-09-05 21:01:47', 1, 6, 31),
(12, 'Mua code ủng hộ nha hihi', '2025-09-05 21:06:58', 1, 6, 32),
(13, 'Sản phẩm ăn ngon ngọt, nên mua', '2025-11-06 23:04:48', 1, 16, 31),
(14, 'Sách hay nên mua. Hihi', '2025-11-07 22:55:31', 1, 16, 31),
(15, 'Xin chào, tôi đã ở đây', '2025-11-07 23:08:20', 1, 16, 31),
(16, 'Sản phẩm tốt nha', '2025-11-24 22:40:49', 1, 6, 29),
(17, 'Sản phẩm tốt nha', '2025-11-25 13:00:07', 1, 17, 30),
(18, 'San pham tot nha nen mua', '2025-11-25 13:04:26', 1, 17, 27),
(19, 'Oki nha', '2025-11-25 13:08:53', 1, 17, 29),
(20, 'Cà Phê Ngon nha nên mua', '2025-12-03 12:49:06', 1, 18, 29),
(21, 'Cappuccino Đá Xay uống rất ngon nha', '2025-12-03 12:56:51', 1, 18, 25);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderdetails_id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderdetails_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(21, 10, 24, 1, 120000),
(22, 10, 27, 1, 180000),
(23, 11, 1, 2, 110000),
(24, 11, 24, 1, 120000),
(25, 12, 23, 1, 120000),
(26, 12, 20, 1, 160000),
(27, 13, 25, 2, 160000),
(28, 13, 26, 2, 200000),
(29, 14, 25, 4, 160000),
(30, 14, 27, 1, 180000),
(31, 14, 26, 2, 200000),
(32, 15, 23, 1, 120000),
(33, 15, 26, 1, 200000),
(34, 16, 27, 1, 180000),
(35, 16, 26, 1, 200000),
(36, 16, 20, 1, 160000),
(37, 17, 29, 1, 50000),
(38, 17, 31, 1, 126000),
(39, 17, 32, 2, 100000),
(40, 18, 31, 1, 126000),
(41, 18, 24, 1, 120000),
(42, 19, 30, 1, 102000),
(48, 22, 29, 1, 50000),
(49, 22, 28, 1, 180000),
(50, 23, 1, 2, 159000),
(51, 23, 24, 1, 120000),
(52, 24, 15, 1, 95000),
(53, 24, 14, 1, 102000),
(54, 25, 21, 1, 88000),
(55, 26, 21, 4, 88000),
(56, 27, 29, 1, 50000),
(57, 27, 1, 1, 159000),
(58, 28, 28, 1, 180000),
(59, 29, 2, 1, 97000),
(60, 29, 29, 1, 50000),
(61, 29, 1, 1, 159000),
(62, 30, 31, 3, 126000),
(63, 31, 2, 2, 97000),
(64, 31, 1, 1, 159000),
(65, 32, 32, 1, 100000),
(66, 33, 21, 1, 88000),
(67, 33, 25, 1, 160000),
(68, 33, 28, 3, 180000),
(69, 34, 29, 1, 50000),
(70, 34, 31, 3, 126000),
(71, 35, 1, 1, 159000),
(72, 35, 28, 2, 180000),
(73, 36, 25, 1, 160000),
(74, 36, 27, 1, 180000),
(75, 36, 31, 2, 126000),
(76, 37, 32, 1, 100000),
(77, 38, 31, 1, 126000),
(78, 38, 30, 1, 102000),
(79, 39, 25, 1, 160000),
(80, 39, 29, 2, 50000),
(81, 39, 30, 1, 102000),
(82, 40, 17, 1, 187000),
(83, 40, 16, 1, 90000),
(84, 40, 18, 2, 120000),
(85, 41, 25, 5, 160000),
(86, 42, 29, 2, 50000),
(87, 42, 17, 1, 187000),
(88, 43, 27, 1, 180000),
(89, 43, 31, 1, 126000),
(90, 44, 1, 1, 159000),
(91, 44, 28, 1, 180000),
(92, 45, 28, 1, 180000),
(93, 45, 31, 2, 126000),
(94, 46, 6, 1, 100000),
(95, 47, 6, 5, 100000),
(96, 48, 2, 4, 97000),
(97, 48, 1, 1, 159000),
(98, 49, 31, 1, 126000),
(99, 50, 27, 3, 180000),
(100, 50, 32, 1, 100000),
(101, 51, 32, 1, 100000),
(102, 51, 26, 1, 200000),
(103, 52, 31, 1, 126000),
(104, 52, 32, 2, 100000),
(105, 53, 28, 1, 180000),
(106, 53, 30, 2, 102000),
(107, 54, 27, 1, 180000),
(108, 54, 30, 1, 102000),
(109, 54, 31, 1, 126000),
(110, 55, 24, 2, 120000),
(111, 55, 31, 1, 126000),
(112, 56, 31, 1, 126000),
(113, 56, 26, 1, 200000),
(114, 57, 31, 1, 126000),
(115, 58, 28, 1, 105000),
(116, 58, 18, 1, 120000),
(117, 58, 31, 1, 126000),
(118, 59, 28, 2, 105000),
(119, 59, 32, 1, 100000),
(120, 59, 27, 2, 95000),
(121, 60, 6, 1, 100000),
(122, 60, 21, 1, 88000),
(123, 61, 24, 1, 115000),
(124, 61, 6, 1, 100000),
(125, 62, 21, 1, 420000),
(126, 62, 24, 1, 115000),
(127, 63, 2, 1, 800000),
(128, 63, 6, 1, 100000),
(129, 64, 30, 1, 55000),
(130, 64, 26, 1, 50000),
(131, 64, 29, 1, 25000),
(132, 65, 14, 1, 60000),
(133, 65, 29, 1, 25000),
(134, 65, 2, 1, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` int NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `date`, `total`, `address`, `phone`, `note`, `status`) VALUES
(10, 6, '2024-11-27 22:13:51', 300000, 'Can tho', '0909135986', '', 2),
(11, 6, '2024-11-28 09:00:28', 340000, 'Can tho', '0909135986', 'Gói sách kĩ giúp em lần trước mua bị rách', 3),
(12, 7, '2024-11-28 09:24:42', 280000, 'Kiên Giang', '0336216654', 'Hello my friend', 3),
(13, 9, '2024-11-28 12:01:11', 720000, 'Cái Răng, Cần Thơ', '0909135969', 'Đóng gói hàng kĩ', 2),
(14, 6, '2024-11-28 14:00:19', 1220000, 'Can tho', '0909135986', 'hi', 4),
(15, 6, '2024-11-28 18:22:55', 320000, 'Can tho', '0909135986', 'Chúc 1 ngày vui', 4),
(16, 6, '2024-11-29 22:07:55', 540000, 'Can tho', '0909135986', 'Mua hang 29/11/2023', 3),
(17, 10, '2024-12-03 10:12:41', 376000, 'Ninh Kiều, Cần Thơ', '0909135985', 'Gói hàng cẩn thận giao nhanh giúp tôi ', 1),
(18, 6, '2024-12-04 18:23:31', 246000, 'Cái Răng, Cần Thơ', '0909135329', 'Giao hàng nhanh nha, đang cần gấp', 1),
(19, 6, '2024-12-04 19:43:58', 102000, 'Quận Đống Đa, Hà Nội', '0909246546', 'Mong là sách đọc hay', 4),
(22, 11, '2024-12-04 20:28:09', 230000, 'Sóc Trăng', '0336246546', 'Đóng hàng kĩ', 3),
(23, 11, '2024-12-04 20:29:51', 279000, 'Cần Thơ', '0909006764', 'Hello', 1),
(24, 11, '2024-12-04 21:49:06', 197000, 'Cần Thơ', '0909006764', '', 1),
(25, 11, '2024-12-04 21:56:40', 88000, 'Cần Thơ', '0909006764', '', 1),
(26, 11, '2024-12-04 22:00:39', 352000, 'Cần Thơ', '0909006764', '', 1),
(27, 10, '2024-12-06 22:10:19', 209000, 'Ninh Kiều, Cần Thơ', '0909135985', '', 2),
(28, 10, '2024-12-06 22:12:15', 180000, 'Long Hồ, Vĩnh Long', '0909135399', 'Mua hàng cho bạn ở quê', 1),
(29, 6, '2024-12-07 08:48:32', 306000, 'Ninh Kiều, Cần Thơ', '0909135329', '', 3),
(30, 6, '2024-12-07 08:50:28', 378000, 'Quận Mỹ Đình, Hà Nội', '0336216546', 'Hello 2023', 2),
(31, 6, '2024-12-11 17:33:40', 353000, 'Long Biên, Hà Nội', '0336216546', 'Giao hàng nhanh giúp tôi', 1),
(32, 6, '2025-10-26 19:07:50', 100000, 'Cần Thơ', '0336216546', 'Giao nhanh', 1),
(33, 11, '2025-10-27 19:13:10', 788000, 'Quận Cầu Giấy Hà Nội', '0336216546', 'Sách hay quóaa', 1),
(34, 10, '2025-10-28 19:55:09', 428000, 'Quận Cầu Giấy Hà Nội', '0909135329', 'Giao hàng nhanh giúp tôi', 4),
(35, 10, '2025-10-29 20:01:28', 519000, 'Quận Cầu Giấy Hà Nội', '0336216546', 'Giao hàng nhanh giúp tôi', 2),
(36, 6, '2025-10-30 10:11:51', 592000, 'Anh Khánh, Ninh Kiều, Cần Thơ', '0336246546', 'Đóng hàng kĩ', 1),
(37, 6, '2025-11-01 10:25:55', 100000, 'Anh Khánh, Ninh Kiều, Cần Thơ', '0909135985', 'Hello', 4),
(38, 6, '2025-11-02 10:31:24', 228000, 'Anh Khánh, Ninh Kiều, Cần Thơ', '0909135985', 'Đóng hàng kĩ', 1),
(39, 7, '2025-11-03 17:38:21', 362000, 'Số 14 Nguyễn Công Trứ, phường Vĩnh Thanh, thành phố Rạch Giá, tỉnh Kiên Giang', '0336216123', 'Sách hay', 2),
(40, 6, '2025-11-04 17:47:50', 517000, 'Số 14 Nguyễn Công Trứ, phường Vĩnh Thanh, thành phố Rạch Giá, tỉnh Kiên Giang', '0909135329', 'Đóng gói hàng kĩ', 1),
(41, 8, '2025-11-05 17:53:39', 800000, 'Anh Khánh, Ninh Kiều, Cần Thơ', '0336246546', 'Gói hàng kĩ', 1),
(42, 6, '2025-11-06 18:19:03', 287000, 'Quận Cầu Giấy Hà Nội', '0909135329', 'Mua hàng nè hihi', 2),
(43, 10, '2025-11-07 18:22:50', 306000, 'Cái Răng, Cần Thơ', '0336246546', 'Gói hàng kĩ', 1),
(44, 10, '2025-11-08 18:32:55', 339000, 'Số 14 Nguyễn Công Trứ, phường Vĩnh Thanh, thành phố Rạch Giá, tỉnh Kiên Giang', '0909135329', 'Giao hàng nhanh nha', 1),
(45, 6, '2025-11-09 15:12:18', 432000, 'Số 14 thành phố Rạch Giá, tỉnh Kiên Giang', '0336216546', 'Test mua hàng 13/12/2023', 1),
(46, 10, '2025-11-10 16:54:29', 100000, 'Ninh Kiều, Cần Thơ', '0909135985', 'Hảo mua hàng nè', 1),
(47, 10, '2025-11-11 17:01:33', 500000, 'Ninh Kiều, Cần Thơ', '0909135985', '', 1),
(48, 7, '2025-11-12 17:07:00', 547000, 'Kiên Giang', '0336216654', '', 1),
(49, 6, '2025-11-13 20:18:15', 126000, 'Ninh Kiều, Cần Thơ', '0909135329', '', 1),
(50, 6, '2025-11-14 20:20:18', 640000, 'Cần Thơ', '0336216546', '', 1),
(51, 6, '2025-11-15 20:51:54', 300000, 'Anh Khánh, Ninh Kiều, Cần Thơ', '0336216546', 'Đóng hàng kĩ', 1),
(52, 6, '2025-11-16 18:28:19', 326000, 'Ninh Kiều, Cần Thơ', '0909135329', 'Giao nhanh', 1),
(53, 6, '2025-11-17 18:45:37', 384000, 'Anh Khánh, Ninh Kiều, Cần Thơ', '0909135985', 'Đóng hàng kĩ', 1),
(54, 6, '2025-11-18 20:56:24', 408000, 'Ninh Kiều, Cần Thơ', '0909135329', 'oki', 1),
(55, 6, '2025-11-19 21:02:30', 366000, 'Ninh Kiều, Cần Thơ', '0909135329', 'Đóng hàng kĩ', 4),
(56, 6, '2025-11-20 21:09:21', 326000, 'Hà Nội', '0909135555', 'GIAO NHANH NHA', 1),
(57, 6, '2025-11-21 20:33:44', 126000, 'xin chào  0909199999', '0909199999', 'Gói hàng kĩ', 1),
(58, 16, '2025-11-22 07:07:01', 351000, 'Quận 1 HCM', '0909789456', 'giao hàng nhanh', 4),
(59, 16, '2025-11-23 08:14:19', 500000, 'Quận 1, HCM', '0909123000', 'giao hàng nhanh', 3),
(60, 16, '2025-11-24 22:59:40', 188000, 'Cầu giấy Hà Nội', '0909999999', 'Giao hàng nhanh', 4),
(61, 16, '2025-11-24 23:03:38', 215000, 'Hẻm 30 Ninh Châu Nam Định', '0909123456', 'Giao hàng gấp giúp  tôi, cảm ơn.', 3),
(62, 17, '2025-11-25 13:01:38', 535000, 'Quận 1, HCM', '0336789123', 'Giao hàng nhanh nha', 4),
(63, 17, '2025-11-25 13:06:10', 900000, 'Cau Giay, Ha Noi', '0909123456', 'Giao nhanh giúp tôi', 2),
(64, 18, '2025-12-03 12:51:16', 130000, 'Quân 1 HCM', '0336123456', 'Giao hàng nhanh nha shop ', 4),
(65, 18, '2025-12-03 12:54:19', 155000, 'Ninh Kiều, Cần Thơ', '0336123456', 'Giao hàng nhanh nhoa, thanks shop', 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int NOT NULL,
  `category_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `category_id`, `title`, `image`, `author`, `content`, `views`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ưu Đãi Hội Viên - Coupon Giảm 50% Trà Ngon', 'bv-1.png', 'Admin', '<h4><strong>Điều kiện chương trình</strong></h4><p>• &nbsp;Khách hàng là Hội viên khi mua sản phẩm nước bất kì tại cửa hàng trong thời gian từ<strong> 11 - 22.06.2025</strong> sẽ được tặng 01 coupon giảm 50% Trà Đào/ Trà Sữa Oolong/ Hồng Trà Sữa size L.</p><p><strong>• &nbsp;01 hóa đơn được tặng tối đa 01 coupon ưu đãi. Không giới hạn số lượng hóa đơn mua được tặng coupon, mỗi lần mua 01 hóa đơn có sản phẩm nước Hội viên đều được tặng 01 coupon.</strong></p><p>• &nbsp;Coupon ưu đãi được gửi được qua<strong> tài khoản “Hội Ghiền Trà Phúc Long” trên Zalopay </strong>hoặc <strong>Website của Hội Viên sau 24h</strong> từ khi hoàn tất việc mua hàng (hướng dẫn lấy coupon như hình bên dưới)</p><p>• &nbsp;Coupon có giá trị sử dụng 1 lần. Áp dụng 01 coupon/01 hóa đơn</p><p>• &nbsp;Coupon không có giá trị quy đổi thành tiền mặt.&nbsp;</p><p>• &nbsp;Sản phẩm mua thêm không được trùng sản phẩm ưu đãi.</p><p><strong>•&nbsp;</strong> Hóa đơn sử dụng coupon <strong>KHÔNG</strong> áp dụng đồng thời cùng chương trình khuyến mãi khác. KHÔNG áp dụng đồng thời giảm giá thẻ thành viên (vẫn được tích điểm nếu khách hàng có mua thêm sản phẩm khác)</p><p>• &nbsp;Áp dụng tại hệ thống cửa hàng Phúc Long trên toàn quốc (<i><strong>Ngoại trừ</strong></i> Phúc Long sân bay, WiN, Winmart, Winmart+, Premium).</p><p><strong>• &nbsp;Thời gian phát coupon: </strong>11 - 22.06.2025&nbsp;</p><p><strong>• &nbsp;Hạn sử dụng coupon:</strong> 11 - 30.06.2025&nbsp;<br><br><img src=\"https://s3-hcmc02.higiocloud.vn/phuclong/2025/06/image-20250610120045.png\" width=\"1402\" height=\"781\"></p>', 0, 1, '2023-11-29 17:13:09', '2025-12-02 22:51:49'),
(5, 2, 'MẮT BỘ SƯU TẬP MỚI: “ĐẬM CHẤT HÀ THÀNH - ĐẬM VỊ VIỆT NAM”', 'bv-2.jpg', 'Admin', '<p>Lấy cảm hứng từ tinh hoa ẩm thực đường phố Hà Nội, bộ sưu tập mới là sự giao thoa độc đáo giữa trà xanh nõn tôm Thái Nguyên cao cấp và những thức quà vặt đậm hồn Hà Nội của cốm non và mận đỏ chấm muối ớt.<br><br><img src=\"https://s3-hcmc02.higiocloud.vn/phuclong/2025/06/bhan-20250603065002.jpg\" width=\"2048\" height=\"2472\"></p>', 0, 1, '2023-11-29 17:25:47', '2025-12-02 22:52:55'),
(8, 2, 'TUYỆT PHẨM DANH TRÀ ĐÃ CÓ MẶT TẠI PHÚC LONG', 'bv-3.jpg', 'Admin', '<p>Tháng ba này, tiếp tục vững bước trên con đường mang đến những sản phẩm với nền trà đậm vị, chất lượng, Phúc Long mở ra một chương mới trong cuốn sách hương vị của mình với sự ra mắt của Bộ Sưu Tập Trà Bá Tước – một lời tri ân sâu sắc đến vẻ đẹp và sức mạnh của người phụ nữ.</p><p><img src=\"https://s3-hcmc02.higiocloud.vn/images/2024/02/lcd-seasonal-2-20240229082333.jpg\" width=\"1920\" height=\"1079\"></p><p>&nbsp;</p><p><strong>Trà Bá Tước – Từ vị ngon đầy tinh tế</strong></p><p>Lấy cảm hứng từ trà Earl Grey – loại trà đã được Charles Grey, vị Thủ tướng Anh đánh giá cao, Phúc Long đã nâng tầm hương vị truyền thống này thành một thức trà độc nhất trong hương vị.</p><p>&nbsp;</p><p>Trà Bá Tước Hoàng Gia của Phúc Long được chế tác trên nền trà đen đậm vị, được chăm sóc và thu hoạch từ những đồi chè xanh mướt tại độ cao hơn 1000 mét trên cao nguyên Bảo Lộc, với những lá trà non nhất, hòa trộn với tinh dầu vỏ Cam Bergamot có nguồn gốc từ Ý, Phúc Long đã tạo nên một thức trà thơm ngát hương hoa và ngất ngây vị giác bằng vị beo béo như bơ đậu phộng.</p><p>&nbsp;</p><p><strong>Và bộ ba món uống sáng tạo của Phúc Long trong Tháng 3</strong></p><p>Điểm nhấn trong Bộ sưu tập đồ uống Tháng 3 của Phúc Long chính là Trà Bá Tước Lựu Đỏ. Trên nền trà Earl Grey được ủ với nhiệt độ chuẩn xác, để tạo nên lớp bọt mịn như tuyết cùng màu đỏ chuyển sắc mà không đánh mất vị trà đậm trứ danh, Phúc Long đã kết hợp cùng hạt lựu đỏ, làm nên một món uống ấn tượng về thị giác và càng bùng nổ hơn về hương vị khi có thêm thạch nha đam tô điểm thêm bông hoa dâm bụt đỏ mang đến một trải nghiệm uống trọn vẹn mọi giác quan.</p><p>&nbsp;</p><p>Theo một phong cách khác, Bá Tước Sữa Chua Lựu Đỏ tạo ấn tượng với kết cấu sánh mịn khi kết hợp Earl Grey cùng sữa chua nhà làm, một phiên bản mát lạnh thơm lừng hương lựu đỏ, độ chua vừa phải mà đặc biệt là vẫn giữ được vị trà Bá Tước đậm đà. Một món uống vừa cân bằng về vị vừa đảm bảo về mặt healthy (có lợi cho sức khỏe) đúng chuẩn dành cho phái đẹp.</p><p>&nbsp;</p><p>Đối với những chị em yêu thích vị béo ngọt đậm hương trà, Phúc Long không quên giới thiệu Trà Sữa Bá Tước. Vẫn với nền trà Bá Tước Hoàng Gia, vị thơm thoang thoảng beo béo của Earl Grey kết hòa hợp tuyệt đối cùng vị ngọt của sữa, cùng kĩ thuật đánh bọt siêu mịn, gợi nhắc về nét thư thái đậm chất hoàng gia châu Âu qua những cốc trà sương mù London Fogs ngon nức tiếng.</p><p>&nbsp;</p><p>Thực đơn <strong>Bá Tước Hoàng Gia</strong> của Phúc Long chính thức ra mắt tại <strong>hệ thống cửa hàng trên toàn quốc từ ngày 01.03.2024</strong>, nếu là một tín đồ của trà đậm nói chung và của thương hiệu Phúc Long nói riêng chắc chắn bạn sẽ không muốn bỏ qua menu cầu kì, sáng tạo và độc đáo này. Đây cũng sẽ là một lựa chọn đồ uống hoàn hảo cho cánh mày râu nhằm thể hiện thông điệp yêu thương tinh tế đến phái đẹp trong tháng yêu thương và tôn vinh Phụ nữ.</p>', 0, 1, '2023-12-03 13:45:32', '2025-12-02 22:53:45'),
(9, 2, 'ƯU ĐÃI 30% CHO FAN CỨNG', 'bv-4.jpg', 'Admin', '<p>hỉ cần giữ hóa đơn và quay lại cửa hàng Phúc Long* sau 02 - 48h bạn sẽ nhận ngay ưu đãi 30% cho tất cả sản phẩm nước và bánh*</p><p>&nbsp;</p><p>&nbsp;</p><p><img src=\"https://s3-hcmc02.higiocloud.vn/images/2024/02/pos_30--20240206031909.jpg\" width=\"2251\" height=\"1601\"></p><p>&nbsp;</p><p>&nbsp;</p><p>Để tiếp thêm năng lượng cho năm mới - khởi đầu mới, Phúc Long gửi tặng các \"Fan Cứng\" của nhà Phúc Long ưu đãi đến 30% như sau:</p><p>&nbsp;</p><h3><strong>1. Chi tiết chương trình:</strong></h3><p>&nbsp;</p><ol><li>Giảm ngay 30%* cho hóa đơn tiếp theo khi khách hàng giữ hóa đơn trước đó và quay lại cửa hàng Phúc Long* sau 02 - 48 giờ tiếp theo.</li><li>Áp dụng giảm cho hóa hơn tiếp theo khi khách hàng quay lại cùng 01 cửa hàng với hóa đơn trước đó.</li><li>Áp dụng giảm tối đa 01 sản phẩm/ hóa đơn</li><li>Áp dụng cho tất cả sản phẩm nước và bánh tại cửa hàng (<strong>Ngoại trừ </strong>sản phẩm đá xay, sản phẩm thuộc BST Seasonal 2 Bá Tước Hoàng Gia và BST Cầu Phúc Long Niên: Trà Lài Mãng Cầu (Nóng), Trà Lài Mãng Cầu Jelly Dừa Sợi (Đá), Trà Sữa Mãng Cầu Jelly Dừa Sợi, Trà Lài Mãng Cầu Đá Xay, Trà Lucky)</li></ol><p><br>&nbsp;</p>', 0, 1, '2023-12-03 17:41:06', '2025-12-02 22:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`) VALUES
(1, 'Chưa có chuyên mục'),
(2, 'Tin mới'),
(9, 'Sản phẩm tốt');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `sell_quantity` int NOT NULL DEFAULT '0',
  `price` int NOT NULL,
  `sale_price` int NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int NOT NULL DEFAULT '0',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `name`, `image`, `quantity`, `sell_quantity`, `price`, `sale_price`, `create_date`, `views`, `details`, `short_description`, `status`) VALUES
(1, 16, 'Trà Nhãn Sen (L)', 'tra-nhan.png', 100, 0, 90000, 78000, '2023-11-18 08:22:03', 2, '<p>Trà Nhãn Sen (L)</p>', '<p>Trà Nhãn Sen (L)</p>', 1),
(2, 16, 'Hồng Trà Đào (L)', 'tra-dao.png', 98, 2, 80000, 70000, '2023-11-18 10:15:54', 3, '<p>Hồng Trà Đào (L)</p>', '<p>Hồng Trà Đào (L)</p>', 1),
(6, 17, 'Trà Lucky Tea (L)', 'lucky-tea.png', 497, 3, 65000, 55000, '2023-11-20 22:23:49', 4, '<p>Trà Lucky Tea (L)</p>', '<p>Trà Lucky Tea (L)</p>', 1),
(14, 2, 'Trà Lài Phúc Bồn Tử Thạch Dừa Sợi (L)', 'tra-lai-phuc-bon-tu-thach-dua-soi.png', 499, 1, 70000, 60000, '2023-11-20 22:54:49', 1, '<p>Trà Lài Phúc Bồn Tử Thạch Dừa Sợi (L)</p>', '<p>Trà Lài Phúc Bồn Tử Thạch Dừa Sợi (L)</p>', 1),
(15, 19, 'Muffin Chocolate', 'chocolte.png', 50, 0, 25000, 20000, '2023-11-20 23:05:47', 1, '', '<p>Muffin Chocolate</p>', 1),
(16, 19, 'Muffin Nho', 'mff-nho.png', 200, 0, 21000, 15000, '2023-11-20 23:09:13', 0, '<p>Muffin Nho&nbsp;</p>', '<p>Muffin Nho&nbsp;</p>', 1),
(17, 19, 'Bánh bông lan', 'bon-lan.png', 100, 0, 50000, 40000, '2023-11-20 23:12:48', 0, '<p>Bánh bông lan</p>', '<p>Bánh bông lan</p>', 1),
(18, 19, 'Bánh bông lân mix vị', 'banh-g.png', 120, 1, 50000, 40000, '2023-11-20 23:20:33', 1, '', '', 1),
(20, 19, 'Bánh kem HALLOWEEN 3', 'HALLOWEEN-M7.png', 100, 0, 500000, 450000, '2023-11-20 23:31:04', 0, '', '', 1),
(21, 19, 'Bánh kem HALLOWEEN 4', 'HALLOWEEN-M1.png', 999, 2, 250000, 200000, '2023-11-23 09:54:06', 3, '', '', 1),
(23, 19, 'Bánh kem HALLOWEEN 2', 'HALLOWEEN-M6.png', 100, 0, 130000, 120000, '2023-11-23 12:19:16', 0, '', '', 1),
(24, 19, 'Bánh kem HALLOWEEN', 'HALLOWEEN-M5.png', 148, 4, 165000, 115000, '2023-11-23 12:20:16', 6, '', '', 1),
(25, 6, 'Cappuccino Đá Xay', 'Cappuccino-da.png', 100, 0, 65000, 55000, '2023-11-23 16:21:03', 11, '<p>Cappuccino Đá Xay</p>', '<p>Cappuccino Đá Xay</p>', 1),
(26, 6, 'Đá xay Matcha', 'matca.png', 99, 2, 60000, 50000, '2023-11-23 16:23:55', 23, '<p>Đá xay Matcha</p>', '<p>Đá xay Matcha</p>', 1),
(27, 4, 'Cà Phê Sữa Kem Silky (L)', 'cafee-sua.png', 170, 3, 50000, 40000, '2023-11-23 20:31:17', 13, '<p>Cà Phê Sữa Kem Silky (L)</p>', '<p>Cà Phê Sữa Kem Silky (L)</p>', 1),
(28, 4, 'Cà phê Cappuccino (L)', 'Cappuccino.png', 1000, 4, 640000, 540000, '2023-11-29 20:36:43', 19, '<p>Cà phê Cappuccino (L)</p>', '<p>Cà phê Cappuccino (L)</p>', 1),
(29, 4, 'Cà Phê Đen Đá (M)', 'caffe.png', 198, 2, 45000, 25000, '2023-12-02 20:54:53', 28, '<p>Cà Phê Đen Đá (M)</p>', '<p>Cà Phê Đen Đá (M)</p>', 1),
(30, 16, 'Trà Ô Long Dâu (L)', 'tra-olong-dau.png', 99, 4, 65000, 55000, '2023-12-02 20:56:21', 22, '<p>Trà Ô Long Dâu (L) trà Phúc Long &nbsp;nguyên chất</p>', '<p>Trà Ô Long Dâu (L) trà Phúc Long &nbsp;nguyên chất</p>', 1),
(31, 16, 'Trà Vải Lài (L)', 'tra-vai.png', 100, 6, 75000, 65000, '2023-12-02 20:59:06', 47, '<p>Trà Vải Lài size L vải tươi &nbsp;trà Phúc Long &nbsp;nguyên chất</p>', '<p>Trà Vải Lài size L vải tươi &nbsp;trà Phúc Long &nbsp;nguyên chất</p>', 1),
(32, 2, 'Trà Sữa Ô Long (L)', 'tra-sua.png', 150, 3, 69000, 59000, '2023-12-02 21:00:48', 43, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Họ tên',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 là khách hàng 1 là nhân viên',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `image`, `email`, `phone`, `address`, `role`, `active`) VALUES
(6, 'user', '$2y$10$Cm.2KiZ85WRGUTBk8vhMaOIQt46A53HKuzPfZh2jS.fdZzAr33dTi', 'Nguyễn Tuấn', 'avatar_it.png', 'abc@gmail.com', '0909155555', 'Ninh Kiều, Cần Thơ', 0, 1),
(7, 'khahi', '$2y$10$sF.yA6lAhvCE1vhwffwijuzA3JMoVhgnxkk.FdqXR4HVHlHdnXHzK', 'Lê Châu Khả Hi', 'user-default.png', 'hilckpc524@fpt.edu.vn', '0336216654', 'Kiên Giang', 0, 1),
(8, 'admin', '$2y$10$Cm.2KiZ85WRGUTBk8vhMaOIQt46A53HKuzPfZh2jS.fdZzAr33dTi', 'Admin', 'avatar_it.png', 'khoacn03@gmail.com', '0336216111', 'Cần Thơ nè', 1, 1),
(9, 'tranvana', '$2y$10$ts748iCUjwA5HpQBMLuROuAXa70addsKmfkMh9rYIw/PjhxLLwH8i', 'Trần Văn A', 'user-default.png', 'tranvana@gmail.com', '0909135969', 'Cái Răng, Cần Thơ', 0, 1),
(10, 'haohao', '$2y$10$gcBHpzElBGDkOv5EEzJFhuoireNk2HsaloJQLy2KHvzGqx6MIyYku', 'Mai Hảo Long', 'user-default.png', 'haolong@fpt.edu.vn', '0909135985', 'Ninh Kiều, Cần Thơ', 0, 1),
(11, 'tuankiet', '$2y$10$ENy4z0Infjac7VjlKYp2A.gqCBwc8N01tKGLT9A3buGdVoyd7sXnK', 'Đặng tuấn Kiệt', 'user-default.png', 'kietliet@fpt.edu.vn', '0909006764', 'Cần Thơ', 0, 1),
(12, 'khoanguyen111', '$2y$10$ZPAY2O7ntfQ5/Huv3dUAIuY4qHuPD/DpRxiw11TurgYr3hCrWfnv2', 'Nguyễn Văn An', 'user-default.png', 'anner@gmail.com', '0336678987', 'Cần Thơ', 0, 1),
(13, 'khoanguyen001', '$2y$10$ptSvfsaT78h4LdZQNCrKdemlC.AqyZ/q5cudTk9/FKcbe6TtJDJAC', 'Nguyễn Thành Trung', 'user-default.png', 'trungnopro@gmail.com', '0336216555', 'Can tho', 0, 1),
(15, 'toan', '$2y$10$rwdD7UlOPC2XUc4d3nJ/nO0THzotlhmrKekcbBynHxTqpOmFlN79a', 'Toàn', 'user-default.png', 'toan@gmail.com', '0336256555', 'Đại Học Cửu Long', 0, 1),
(16, 'tranvana', '$2y$10$Cm.2KiZ85WRGUTBk8vhMaOIQt46A53HKuzPfZh2jS.fdZzAr33dTi', 'Tran Van A', 'user-default.png', 'tranvana@gmail.com', '0909999999', 'Quận 1, HCM', 0, 1),
(17, 'tranvanc', '$2y$10$O87eXzRKPlNuuB0sYJzdf.0VyT0vEzLHkh1spblXM9uqBugzanRWC', 'Trần Văn C', 'user-default.png', 'tranvanc@gmail.com', '0336789123', 'Hà Đông, Hà Nôi', 0, 1),
(18, 'taikhoan', '$2y$10$zzKX04pBOPu25Ne.5r0LxuBNI77nQLR05PEidmU71CNOpjEVkVW3.', 'Nguyễn Bảo Ngọc', 'avatar_it.png', 'taikhoan@gmail.com', '0336123456', 'Hà Đông Hà NỘI', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `sell` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `price`, `quantity`, `sell`, `created_at`) VALUES
(20, 'Bánh kem 1', 10000, 2000, 0, '2025-12-02 21:03:08'),
(21, 'Pate Chaud Bò', 20000, 111, 0, '2025-12-02 21:03:20'),
(22, 'Kem dâu', 120000, 2000, 0, '2025-12-02 21:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `membership_tiers`
--

CREATE TABLE `membership_tiers` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `min_accumulated_points` int NOT NULL DEFAULT 0,
  `points_per_vnd` int NOT NULL COMMENT 'So VND = 1 diem'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_tiers`
--

INSERT INTO `membership_tiers` (`id`, `name`, `min_accumulated_points`, `points_per_vnd`) VALUES
(1, 'Member', 0, 10000),
(2, 'Silver', 500, 8000),
(3, 'Gold', 2000, 5000),
(4, 'Platinum', 10000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `customer_loyalty`
--

CREATE TABLE `customer_loyalty` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `total_points` int NOT NULL DEFAULT 0,
  `accumulated_points` int NOT NULL DEFAULT 0,
  `tier_id` int NOT NULL DEFAULT 1,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `points_transactions`
--

CREATE TABLE `points_transactions` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `points_change` int NOT NULL,
  `reason` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderdetails_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_tiers`
--
ALTER TABLE `membership_tiers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_loyalty`
--
ALTER TABLE `customer_loyalty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_customer_loyalty_customer` (`customer_id`),
  ADD KEY `idx_customer_loyalty_tier` (`tier_id`);

--
-- Indexes for table `points_transactions`
--
ALTER TABLE `points_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_points_transactions_customer` (`customer_id`),
  ADD KEY `idx_points_transactions_order` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderdetails_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `membership_tiers`
--
ALTER TABLE `membership_tiers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_loyalty`
--
ALTER TABLE `customer_loyalty`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `points_transactions`
--
ALTER TABLE `points_transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
