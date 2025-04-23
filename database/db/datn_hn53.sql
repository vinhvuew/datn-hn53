-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2025 at 03:28 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datn_hn53`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `full_name`, `email`, `phone`, `province`, `district`, `ward`, `address`, `note`, `user_id`, `is_default`, `created_at`, `updated_at`) VALUES
(11, 'trun trung', 'duc130504@gmail.com', '0388 838 472', 'Bắc Giang', 'Huyện Việt Yên', 'Xã Vân Trung', 'số 22', NULL, 7, 0, '2025-03-15 14:58:07', '2025-03-15 14:58:07'),
(13, 'trang', 'duc130504@gmail.com', '0388 838 472', 'Thanh Hóa', 'Huyện Nông Cống', 'Xã Tế Nông', 'yenmy', NULL, 8, 1, '2025-03-16 14:42:50', '2025-03-16 14:42:50'),
(14, 'Đặng Trần Trường', 'trantruong16324@gmail.com', '123456789', 'Hà Nội', 'Huyện Thanh Trì', 'Xã Liên Ninh', 'HK', NULL, 9, 0, '2025-03-25 16:12:53', '2025-03-25 16:13:08'),
(16, 'Huy', 'lytl130504@gmail.com', '0345678789', 'Hà Nội', 'Quận Thanh Xuân', 'Phường Khương Trung', 'số 234', NULL, 3, 0, '2025-04-06 13:34:55', '2025-04-06 13:34:55'),
(19, 'Huyền', 'ducltph46032@fpt.edu.vn', '0388 838 472', 'Hà Nội', 'Quận Long Biên', 'Phường Phúc Lợi', 'số 32', NULL, 4, 0, '2025-04-16 15:49:57', '2025-04-16 15:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'string',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `data_type`, `created_at`, `updated_at`) VALUES
(5, 'Màu sắc', 'string', '2025-03-15 14:23:13', '2025-03-15 14:23:13'),
(6, 'Kích cỡ', 'string', '2025-03-15 14:23:28', '2025-03-15 14:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(10, 5, 'Trắng', '2025-03-15 14:23:44', '2025-03-15 14:23:44'),
(11, 5, 'Đen', '2025-03-15 14:23:53', '2025-03-15 14:23:53'),
(12, 5, 'Xanh', '2025-03-15 14:24:04', '2025-03-15 14:24:04'),
(13, 5, 'Vàng', '2025-03-15 14:24:15', '2025-03-15 14:24:15'),
(14, 6, '38', '2025-03-15 14:24:22', '2025-03-15 14:24:22'),
(15, 6, '39', '2025-03-15 14:24:31', '2025-03-15 14:24:31'),
(16, 6, '40', '2025-03-15 14:24:37', '2025-03-15 14:24:37'),
(17, 6, '41', '2025-03-15 14:24:44', '2025-03-15 14:24:44'),
(18, 5, 'Xanh Ngọc', '2025-03-26 16:03:15', '2025-03-26 16:03:15'),
(19, 6, '42', '2025-03-26 16:03:23', '2025-03-26 16:03:23'),
(20, 5, 'Xám Xanh', '2025-03-26 16:19:05', '2025-03-26 16:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `text`, `created_at`, `updated_at`) VALUES
(2, 'PUMA', 'PUMA là một công ty đa quốc gia của Đức, được thành lập vào năm 1948 bởi Rudolf Dassler, có trụ sở chính tại Herzogenaurach, Bavaria tại Đức. PUMA là một trong những thương hiệu thể thao hàng đầu thế giới chuyên thiết kế, phát triển, định hướng và tiếp thị các mặt hàng giày dép, quần áo và phụ kiện thể thao.\r\n\r\nTrong hơn 65 năm qua, PUMA đã sản xuất ra nhiều sản phẩm có tính cải tiến dành cho các vận động viên nhanh nhất hành tinh. PUMA cung cấp các dòng sản phẩm tập luyện lấy cảm hứng từ lối sống thể thao ở các hạng mục như: Bóng đá, Chạy bộ, Rèn luyện thể hình, Golf và Đua xe thể thao. Ngoài ra, PUMA còn có những sự cộng tác thú vị với các nhà thiết kế nổi tiếng như STAPLE, STAMPD hoặc TRAPSTAR nhằm mang đến các thiết kế sáng tạo & thời thượng dành cho thế giới thể thao.', '2025-03-09 14:03:58', '2025-03-26 14:58:03'),
(3, 'NIKE', 'NIKE hoạt động trong lĩnh vực thiết kế, phát triển, sản xuất,quảng bá cũng như kinh doanh các mặt hàng giày dép, quần áo, phụ kiện, trang thiết bị và dịch vụ liên quan đến thể thao. Nike quảng bá các sản phẩm dưới nhãn hiệu này cũng như các nhãn hiệu Nike golf, Nike pro, Nike+, Air Jordan, Nike air max, Nike air force 1, Converse... Ngoài sản xuất áo quần và dụng cụ thể thao, công ty còn điều hành  các cửa hàng bán lẻ với tên Niketown. Nike đã tài trợ cho rất nhiều vận động viên và các câu lạc bộ thể thao nổi tiếng trên khắp thế giới, với thương hiệu rất dễ nhận biết là “ Just Do It “  và biểu tượng Swoosh.', '2025-03-15 10:22:04', '2025-03-26 14:59:10'),
(4, 'MLB', 'MLB là hãng thời trang nổi tiếng có xuất xứ tại Hàn Quốc. Các sản phẩm thời trang của MLB mang đậm tinh thần thể thao đường phố và được truyền cảm hứng từ môn thể thao bóng chày tạo nên một sự kết hợp đẳng cấp giữa thời trang và bóng chày. Ngay từ khi ra đời, MLB đã tạo nên một cơn sốt với giới trẻ và nhanh chóng trở thành một trong những thương hiệu giày hàng đầu trong ngành công nghiệp thời trang Hàn Quốc.\r\n\r\nMLB tập trung vào việc sản xuất và phân phối các mặt hàng quần áo và phụ kiện cho cả nam và nữ. Mỗi sản phẩm của MLB đều được chăm chút kỹ lưỡng với sự tập trung vào từng chi tiết và mang đến sự thoải mái cho người dùng.\r\n\r\nNguồn nguyên liệu để tạo nên các sản phẩm thời trang của MLB đều là nguồn nguyên liệu chuẩn, có độ mềm mịn, êm ái và thấm hút tốt, từ đó mang đến cho khách hàng những trải nghiệm tốt về sản phẩm. Giá thành các sản phẩm thời trang MLB khá cao nhưng giá trị sử dụng lại vô cùng xứng đáng.', '2025-03-15 10:23:11', '2025-03-26 15:00:40'),
(5, 'Adidas', 'Adidas là một công ty đa quốc gia đến từ Đức, chuyên sản xuất giày dép, quần áo và phụ kiện. Tiền thân của công ty là Gebruder Dassler Schuhfabrik, được thành lập vào năm 1924 bởi anh em nhà Dassler là Adi Dassler và Rudolf.\r\nBan đầu, thương hiệu đã đạt được thành công và lợi nhuận lớn. Tuy nhiên, sau Thế chiến thứ hai, do sự khác biệt, Rudolf tách ra để thành lập Công ty Ruda, sau đó được đổi tên thành Puma. Đồng thời, Adi Dassler tiếp tục điều hành công ty cũ, đặt tên là Adidas từ năm 1949.\r\nCác sản phẩm chính của thương hiệu Adidas bao gồm giày dép, quần áo, mũ, tất, túi xách thể thao… Ưu điểm của các sản phẩm thương hiệu Adidas là luôn được làm từ những chất liệu tốt nhất và được thiết kế với kiểu dáng tỉ mỉ, kín đáo và tinh tế. Từng đường may đều mang đến cho người sử dụng cảm giác thoải mái, dễ chịu.', '2025-03-26 15:03:13', '2025-03-26 15:03:13'),
(6, 'Louis Vuitton', 'Công ty này sản xuất các mặt hàng da thuộc, thời trang, prêt-à-porter, trang sức. Nhiều sản phẩm của công ty sử dụng nhãn hiệu với chất liệu màu nâu Damier và Monogram Canvas, cả hai được sử dụng lần đầu cuối thế kỷ 19. Tất cả các sản phẩm của công ty sử dụng các chữ viết tắt LV.\r\n\r\nCông ty này có hệ thống các cửa hiệu khắp thế giới, cho phép nó kiểm soát được chất lượng và giá cả sản phẩm của mình, tránh hàng giả, hàng nhái lọt vào các kênh phân phối của mình.', '2025-03-28 03:41:47', '2025-03-28 03:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(35, 10, 'pending', '2025-03-26 16:33:52', '2025-03-26 16:33:52'),
(104, 2, 'pending', '2025-04-08 15:01:58', '2025-04-08 15:01:58'),
(162, 3, 'pending', '2025-04-21 17:09:33', '2025-04-21 17:09:33');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `total_amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_selected` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `cart_id`, `product_id`, `variant_id`, `quantity`, `total_amount`, `created_at`, `updated_at`, `is_selected`) VALUES
(95, 35, NULL, 16, 1, '1850000.00', '2025-03-26 16:33:52', '2025-03-26 16:33:59', 1),
(210, 104, NULL, 26, 3, '5100000.00', '2025-04-08 15:01:58', '2025-04-20 13:49:08', 1),
(296, 104, 9, NULL, 2, '1200000.00', '2025-04-18 13:42:01', '2025-04-20 13:48:54', 0),
(297, 104, NULL, 16, 2, '3700000.00', '2025-04-18 13:42:12', '2025-04-20 13:48:53', 0),
(303, 162, NULL, 26, 1, '1700000.00', '2025-04-21 17:09:33', '2025-04-21 17:10:00', 1),
(304, 162, NULL, 5, 2, '2600000.00', '2025-04-21 17:09:52', '2025-04-23 15:21:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`, `created_at`, `updated_at`) VALUES
(1, 'Giày Jordan', NULL, '2025-03-09 14:03:12', '2025-03-26 14:44:41'),
(2, 'Giày Nike Air Force', NULL, '2025-03-09 14:03:20', '2025-03-28 03:35:54'),
(3, 'Giày Adidas Yeezy', NULL, '2025-03-15 10:20:35', '2025-03-26 14:55:31'),
(4, 'Giày MLB Mule', NULL, '2025-03-15 10:21:09', '2025-03-26 14:57:03'),
(5, 'Giày Sneaker', NULL, '2025-03-26 15:21:47', '2025-03-26 15:21:47'),
(6, 'Giày Nike Dunk', NULL, '2025-03-26 15:23:53', '2025-03-26 15:23:53'),
(7, 'Giày MLB Chunky', NULL, '2025-03-26 15:26:43', '2025-03-26 15:26:43'),
(8, 'Giày LV Trainer', NULL, '2025-03-28 03:39:59', '2025-03-28 03:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `create_news`
--

CREATE TABLE `create_news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `create_news`
--

INSERT INTO `create_news` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 'ATHLEISURE STYLISH & EASY HOBO BAG – SỰ LAI TẠO HOÀN HẢO GIỮA TINH THẦN THỂ THAO VÀ TINH TẾ THANH LỊCH', 'SỰ LINH HOẠT CỦA MỘT BIỂU TƯỢNG THỜI TRANG\r\nKhông còn đơn thuần là một chiếc túi xách thông thường, Athleisure Stylish & Easy Hobo Bag được thiết kế để thích ứng với mọi phong cách. Dáng túi mềm mại nhưng vẫn giữ được kết cấu tinh tế, mang đến sự kết hợp hoàn mỹ giữa nét phóng khoáng và sự sang trọng. Dây đeo linh hoạt giúp bạn dễ dàng chuyển đổi giữa kiểu đeo vai thanh lịch hay đeo chéo năng động, phù hợp cho cả những ngày làm việc bận rộn lẫn những buổi dạo phố cuối tuần.\r\n\r\nCHẤT LIỆU CAO CẤP – NHẸ, BỀN, THỜI THƯỢNG\r\nSử dụng 100% nylon kết hợp với lớp lót trong 100% polyester, chiếc túi không chỉ mang đến sự nhẹ nhàng, thoải mái mà còn đảm bảo độ bền vượt trội. Bề mặt vải có khả năng chống thấm nhẹ, dễ dàng làm sạch, giúp túi luôn giữ được vẻ ngoài chỉn chu. Chất liệu mềm mại nhưng vẫn giữ phom dáng, mang lại cảm giác đẳng cấp trong từng chi tiết.', 'news/1743823203.jpg', '2025-03-29 07:46:15', '2025-04-05 03:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `failed_jobs`
--

INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) VALUES
(1, 'dd0fd3b0-365f-4ca0-b721-4b38dcb6c9d4', 'database', 'default', '{\"uuid\":\"dd0fd3b0-365f-4ca0-b721-4b38dcb6c9d4\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 'Illuminate\\Database\\Eloquent\\ModelNotFoundException: No query results for model [App\\Models\\Message]. in D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Database\\Eloquent\\Builder.php:621\nStack trace:\n#0 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(109): Illuminate\\Database\\Eloquent\\Builder->firstOrFail()\n#1 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesAndRestoresModelIdentifiers.php(62): App\\Events\\MessageSent->restoreModel(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#2 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\SerializesModels.php(93): App\\Events\\MessageSent->getRestoredPropertyValue(Object(Illuminate\\Contracts\\Database\\ModelIdentifier))\n#3 [internal function]: App\\Events\\MessageSent->__unserialize(Array)\n#4 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(97): unserialize(\'O:38:\"Illuminat...\')\n#5 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\CallQueuedHandler.php(60): Illuminate\\Queue\\CallQueuedHandler->getCommand(Array)\n#6 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Jobs\\Job.php(102): Illuminate\\Queue\\CallQueuedHandler->call(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Array)\n#7 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(439): Illuminate\\Queue\\Jobs\\Job->fire()\n#8 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(389): Illuminate\\Queue\\Worker->process(\'database\', Object(Illuminate\\Queue\\Jobs\\DatabaseJob), Object(Illuminate\\Queue\\WorkerOptions))\n#9 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Worker.php(176): Illuminate\\Queue\\Worker->runJob(Object(Illuminate\\Queue\\Jobs\\DatabaseJob), \'database\', Object(Illuminate\\Queue\\WorkerOptions))\n#10 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(137): Illuminate\\Queue\\Worker->daemon(\'database\', \'default\', Object(Illuminate\\Queue\\WorkerOptions))\n#11 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Queue\\Console\\WorkCommand.php(120): Illuminate\\Queue\\Console\\WorkCommand->runWorker(\'database\', \'default\')\n#12 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(36): Illuminate\\Queue\\Console\\WorkCommand->handle()\n#13 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Util.php(41): Illuminate\\Container\\BoundMethod::Illuminate\\Container\\{closure}()\n#14 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(93): Illuminate\\Container\\Util::unwrapIfClosure(Object(Closure))\n#15 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php(35): Illuminate\\Container\\BoundMethod::callBoundMethod(Object(Illuminate\\Foundation\\Application), Array, Object(Closure))\n#16 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php(662): Illuminate\\Container\\BoundMethod::call(Object(Illuminate\\Foundation\\Application), Array, Array, NULL)\n#17 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(211): Illuminate\\Container\\Container->call(Array)\n#18 D:\\laragon\\www\\datn-hn53\\vendor\\symfony\\console\\Command\\Command.php(326): Illuminate\\Console\\Command->execute(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#19 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php(180): Symfony\\Component\\Console\\Command\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Illuminate\\Console\\OutputStyle))\n#20 D:\\laragon\\www\\datn-hn53\\vendor\\symfony\\console\\Application.php(1096): Illuminate\\Console\\Command->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#21 D:\\laragon\\www\\datn-hn53\\vendor\\symfony\\console\\Application.php(324): Symfony\\Component\\Console\\Application->doRunCommand(Object(Illuminate\\Queue\\Console\\WorkCommand), Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#22 D:\\laragon\\www\\datn-hn53\\vendor\\symfony\\console\\Application.php(175): Symfony\\Component\\Console\\Application->doRun(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#23 D:\\laragon\\www\\datn-hn53\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php(201): Symfony\\Component\\Console\\Application->run(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#24 D:\\laragon\\www\\datn-hn53\\artisan(35): Illuminate\\Foundation\\Console\\Kernel->handle(Object(Symfony\\Component\\Console\\Input\\ArgvInput), Object(Symfony\\Component\\Console\\Output\\ConsoleOutput))\n#25 {main}', '2025-04-04 16:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 3, 17, NULL, NULL),
(2, 3, 13, NULL, NULL),
(3, 8, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `has_role_permission`
--

CREATE TABLE `has_role_permission` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `has_role_permission`
--

INSERT INTO `has_role_permission` (`permission_id`, `role_id`) VALUES
(4, 3),
(6, 3),
(8, 3),
(10, 3),
(15, 3),
(16, 3),
(20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `image_galleries`
--

CREATE TABLE `image_galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_galleries`
--

INSERT INTO `image_galleries` (`id`, `product_id`, `img`, `created_at`, `updated_at`) VALUES
(1, 1, 'galleries/HydKDc8iIXJdQAgQQBmaQOevytzWQ0OqNc7eiv8F.webp', '2025-03-09 14:08:30', '2025-03-26 15:41:56'),
(2, 1, 'galleries/Nqah2JSGNRxgAKYqIGLWG4bhWfAhlvNG8cdpd98j.webp', '2025-03-09 14:08:30', '2025-03-26 15:41:56'),
(3, 1, 'galleries/N2EbSVN5pepUQ2616Kc8hXjl4o3MwpCyjZQb1be8.webp', '2025-03-09 14:08:30', '2025-03-26 15:41:56'),
(4, 1, 'galleries/eVCCyZkKZ2UkfKwRJzqDhqZHfd1BlYrDhz4B02uw.webp', '2025-03-09 14:08:30', '2025-03-15 14:48:06'),
(5, 1, 'galleries/ecImCZBUrgNvBx9jHQ0uzs1TbPOhSbvUX0UaxvYM.webp', '2025-03-09 14:08:30', '2025-03-09 14:08:30'),
(6, 2, 'galleries/id5j2kfKiJuvACovkU9l8Aqg5BjXbf8XoFrYH1nh.webp', '2025-03-09 14:12:08', '2025-03-15 14:44:24'),
(7, 2, 'galleries/mWAglx1ilFRGue8otjSEqS5gv91EDSapKlmxyKQT.webp', '2025-03-09 14:12:08', '2025-03-15 14:44:24'),
(8, 2, 'galleries/i6mB4oE8ryWqWdNQZ3iaBAlltgiaejd6RkjQVPkK.webp', '2025-03-09 14:12:08', '2025-03-15 14:44:24'),
(9, 2, 'galleries/Hvp716MMUob3ZfZwWdtJQB9CVmR0GwlmQpte3odz.webp', '2025-03-09 14:12:08', '2025-03-15 14:44:24'),
(10, 2, 'galleries/Qnz0cFqpvJyP7PhHDLCiMjJWwsEs6yxJfhCm2YlL.webp', '2025-03-09 14:12:08', '2025-03-15 14:44:24'),
(11, 3, 'galleries/r0V8EVpDWTko284QAdfST3j69obI1abltGCEaxje.webp', '2025-03-12 14:27:10', '2025-03-15 14:40:49'),
(12, 3, 'galleries/1dDwkkjDW71jUJ1A16vxvE5k1tOapZSgQSX9TfZX.webp', '2025-03-12 14:27:10', '2025-03-12 14:27:10'),
(13, 3, 'galleries/nExhrkiarYBEWPNIGDVTPhvcZILgVWRsDpam9AJH.webp', '2025-03-12 14:27:10', '2025-03-15 14:40:49'),
(14, 3, 'galleries/znnRleoWiZWz0lvVuqZpJkK8yayyxxrdEAiVVc4v.webp', '2025-03-12 14:27:10', '2025-03-15 14:40:49'),
(15, 3, 'galleries/yPOoLvefmD45X8Rc8QhWsLXOTRRAL1PWZHeMnmvG.webp', '2025-03-12 14:27:10', '2025-03-26 15:30:07'),
(16, 4, 'galleries/JvfzFzm2W8wANNKpZ61SaXlVDt35KImbI5plRgl8.jpg', '2025-03-15 14:36:12', '2025-03-15 14:36:12'),
(17, 4, 'galleries/0k8mevYNlcMLyRddQ7nnLVz7aDtIAkAZUHA5yE9c.jpg', '2025-03-15 14:36:12', '2025-03-15 14:36:12'),
(18, 4, 'galleries/8XYLB6ECjhLQYgKiYiDAXVcqHKgAytdBhzd4bCR4.jpg', '2025-03-15 14:36:12', '2025-03-15 14:36:12'),
(19, 4, 'galleries/JhevVfEyNve4XsUHjng6Ttv7NsFmGdQGWXTDEpSE.jpg', '2025-03-15 14:36:12', '2025-03-15 14:36:12'),
(20, 4, 'galleries/9OfS5weLKXrqVsQgunSbvhu4OS8NNlwnXr9DSzya.jpg', '2025-03-15 14:36:12', '2025-03-15 14:36:12'),
(21, 5, 'galleries/SBt7KSZgRaXI9goxQyyIguP4VO3ZtZnq8bUhNnt0.webp', '2025-03-15 14:55:11', '2025-03-15 14:55:11'),
(22, 5, 'galleries/HnEVQgMJ1GiLplPG1rQqnP7tuIvyxib4mFkvSF3s.webp', '2025-03-15 14:55:11', '2025-03-15 14:55:11'),
(23, 5, 'galleries/lB9Y5267CG59GG0gbP4Il6wBXSok8nvez4YHMkVB.jpg', '2025-03-15 14:55:11', '2025-03-15 14:55:11'),
(24, 6, 'galleries/KD66znnRZDZSju1hzPtIdLNUH2sHYQJC1Ikm9jYx.webp', '2025-03-18 15:41:30', '2025-03-18 15:41:30'),
(25, 6, 'galleries/DHhM58go9dAeYOxS1vgX1mNVemJiiyhHm2xis3dG.webp', '2025-03-18 15:41:30', '2025-03-18 15:41:30'),
(26, 6, 'galleries/0917eu8BZImZUxUTdeuXocQRKnsQj51QhgK3gXzo.webp', '2025-03-18 15:41:30', '2025-03-18 15:41:30'),
(27, 6, 'galleries/JefOVktmnYlAJ80vBNmUS9GxAR50dRIbMiJoZzaL.webp', '2025-03-18 15:41:30', '2025-03-18 15:41:30'),
(28, 6, 'galleries/8sRMOspX7Afv9fmdr1LZpowCRSaCL0a4NDImuMG3.webp', '2025-03-18 15:41:30', '2025-03-18 15:41:30'),
(29, 7, 'galleries/5LcMWpha6oarxJelng4PIZi52RgB3fGs7PZqtGYS.webp', '2025-03-20 15:40:22', '2025-03-28 03:01:12'),
(30, 7, 'galleries/7zn8y4PuHEWsGTMs0ZoQ111WgIPCWAXKIvzutDSL.webp', '2025-03-20 15:40:22', '2025-03-28 03:01:12'),
(31, 7, 'galleries/mM53g7k6GXIkZPiLobCZ9rNpb2VIufVkhHfom689.webp', '2025-03-20 15:40:22', '2025-03-28 03:01:12'),
(32, 7, 'galleries/1FKU2797FmMTWVrCHDu7ZMhUsuavdPaZGGHGHAQd.webp', '2025-03-20 15:40:22', '2025-03-20 15:40:22'),
(33, 8, 'galleries/mZa4VDTpzz0XZ6uq8G4VpcTnoeQoW2JZXuM1xW24.png', '2025-03-26 15:49:50', '2025-03-26 15:53:59'),
(34, 8, 'galleries/sB7fMKgsUpVeZ11Qw7PSL7Z4raJQ0tpvh9O0BDlP.png', '2025-03-26 15:49:50', '2025-03-26 15:53:59'),
(35, 8, 'galleries/fPka0Y2v7wcr2L1Z7Se3JLGv6KofNsuMCgbqZ4mj.png', '2025-03-26 15:49:50', '2025-03-26 15:53:59'),
(36, 8, 'galleries/VFOKpJVVlHVhy3LfKF13nGXq6ZcCxCRSfxe4ka3d.webp', '2025-03-26 15:49:50', '2025-03-26 15:49:50'),
(37, 9, 'galleries/fYSmnENEUDqh8nuVKhVhW3v7vAmmKO4qiSSuOba1.jpg', '2025-03-26 16:00:29', '2025-03-26 16:00:29'),
(38, 9, 'galleries/pFc7D2UcAY6MIR7OabbgsJ46LYHaMMCqbRIaRgdE.jpg', '2025-03-26 16:00:29', '2025-03-26 16:00:29'),
(39, 9, 'galleries/pexxgmBf1fZD60ZTIlx9YieNAtUJ4u3ZjwOFritt.jpg', '2025-03-26 16:00:29', '2025-03-26 16:00:29'),
(40, 9, 'galleries/wyIs3576hTRkQfY97a3oqGDhSRp1GE5ymjSc7Cl9.jpg', '2025-03-26 16:00:29', '2025-03-26 16:00:29'),
(41, 10, 'galleries/9HDjqMwKtUSzBaRPXEZOL4ANuzjBl7osJwaFX1as.jpg', '2025-03-26 16:08:57', '2025-03-26 16:08:57'),
(42, 10, 'galleries/n9J3PxbN8jkL4uFlgQpsLSYNy8fSyC7ztJQ1HvpZ.jpg', '2025-03-26 16:08:57', '2025-03-26 16:08:57'),
(43, 10, 'galleries/eXd0JTKtiSdUoxaoFAFUebMsn6j1s9xkElB2FRUk.jpg', '2025-03-26 16:08:57', '2025-03-26 16:08:57'),
(44, 10, 'galleries/LQ2fRk9NTE1bPkxYop7Ipg03IbG31ycsNIkZLHDt.jpg', '2025-03-26 16:08:57', '2025-03-26 16:08:57'),
(45, 10, 'galleries/ei3uJNWl0TQ0M4vsOqrJz4ogzBQ4oFjHhReXsGIH.jpg', '2025-03-26 16:08:57', '2025-03-26 16:08:57'),
(46, 10, 'galleries/lOisKpXTL2I8qDjNgy6xBKTodRr2S98jy4nOeI93.jpg', '2025-03-26 16:08:57', '2025-03-26 16:08:57'),
(47, 11, 'galleries/gAjBO6XmkRSzeQtD2p6fisrOrXUgCVHlhAr4KNGp.webp', '2025-03-26 16:19:57', '2025-03-26 16:33:21'),
(48, 11, 'galleries/hd3JXbgCmehQu7xABOy0JJRmsIvGFRw5Zv6whNBa.webp', '2025-03-26 16:19:57', '2025-03-26 16:33:21'),
(49, 11, 'galleries/tI9wC2ePjgaMaFK76AfctSLY578EXkeziJCf25fH.jpg', '2025-03-26 16:19:57', '2025-03-26 16:19:57'),
(50, 11, 'galleries/u8QjcxqIxs3RGZaMuLPGz4EBKCFzTdh3Vtey1R6a.jpg', '2025-03-26 16:19:57', '2025-03-26 16:19:57'),
(51, 12, 'galleries/84oIp4pTdUdvp2YOq5Pin2hJFvfP4OKV56hmc4Mc.jpg', '2025-03-26 16:27:15', '2025-03-26 16:27:15'),
(52, 12, 'galleries/igiT2LEjr40n5qj0inoqTd5LKaii4I0zjLfRNcOi.jpg', '2025-03-26 16:27:15', '2025-03-26 16:27:15'),
(53, 12, 'galleries/79rxQcUMGhluxNRsqKph5gvTec7dGBszXPGSzerJ.jpg', '2025-03-26 16:27:15', '2025-03-26 16:27:15'),
(54, 12, 'galleries/FoN15CxAl04vHGVUQfhalmhqAip4jIOoLf5upp3n.jpg', '2025-03-26 16:27:15', '2025-03-26 16:27:15'),
(55, 13, 'galleries/X2N0ZYpS6jTlxjjoWxuapcNy0vYncX0OoZOEJVjL.webp', '2025-03-28 03:08:53', '2025-03-28 03:08:53'),
(56, 13, 'galleries/4R2rM4xnmYfCePfSAHAmrBxSR7YHVwxZSBAtiWYF.jpg', '2025-03-28 03:08:53', '2025-03-28 03:08:53'),
(57, 13, 'galleries/gcqEit4FX9eIMnbrd874QtyFlYs6AyIrUa7gtTs2.webp', '2025-03-28 03:08:53', '2025-03-28 03:08:53'),
(59, 15, 'galleries/l5TFhdpyzfHV7Vz7xmj1AO9TDUUBFd2cF2ZwsP6U.webp', '2025-03-28 03:22:57', '2025-03-28 03:22:57'),
(60, 15, 'galleries/N9SDlwSmLwEiwBjlVEyUz8g22Qcl4Hbvi51bSX0N.webp', '2025-03-28 03:22:57', '2025-03-28 03:22:57'),
(61, 15, 'galleries/NSHu9USd3oJK7sp3jO4YSsNudW2Ipgg1WjtFvtzn.webp', '2025-03-28 03:22:57', '2025-03-28 03:22:57'),
(62, 16, 'galleries/Yk7Uqv1GVgNODSd40FCYUbxfBiSUbWodgh1o6rM2.webp', '2025-03-28 03:47:37', '2025-03-28 03:47:37'),
(63, 16, 'galleries/IJPGUoOPpvr7hxJ91DdLaUUQrOkcenZrRmniwrYd.webp', '2025-03-28 03:47:37', '2025-03-28 03:47:37'),
(64, 16, 'galleries/3Fgact2MlUklnN8nJhMrjio7zrEE7GGjIOJaP5Gi.webp', '2025-03-28 03:47:37', '2025-03-28 03:47:37'),
(65, 17, 'galleries/X4FFrwNYESceXuqjFVJmUXygwr2GBpeRHGTdwiNo.jpg', '2025-03-28 03:55:28', '2025-03-28 03:55:28'),
(66, 17, 'galleries/nqInlCg86vxwe7RbY9Lx7GTCvMjEeLMt8iIG0gGs.jpg', '2025-03-28 03:55:28', '2025-03-28 03:55:28'),
(67, 17, 'galleries/8zkkginrM6AgfEnoV77IhvaN5EZln99etCrjg17n.jpg', '2025-03-28 03:55:28', '2025-03-28 03:55:28'),
(68, 17, 'galleries/HDbEBmjCftggAiyKkC1j4yh6eZLBIBcroWhCHDiT.jpg', '2025-03-28 03:55:28', '2025-03-28 03:55:28'),
(69, 17, 'galleries/9vE7qWVYbjdLTDJnSVHkdfwAYPZSyRhNNuIMELi6.jpg', '2025-03-28 03:55:28', '2025-03-28 03:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint UNSIGNED NOT NULL,
  `id_variant` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `restock_level` int NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_restock_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(31, 'default', '{\"uuid\":\"8efb18ae-d716-49fc-b4a4-35229e340920\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:31;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743786014, 1743786014),
(32, 'default', '{\"uuid\":\"0f28de58-b30c-43b9-b86d-2f44bd52e830\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:32;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743815446, 1743815446),
(33, 'default', '{\"uuid\":\"2c2c0e31-438b-4015-b5fd-87e3bd7bf23b\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:33;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743815592, 1743815592),
(34, 'default', '{\"uuid\":\"5c9ec385-f6a8-4b07-b9c9-077231202623\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:34;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743816608, 1743816608),
(35, 'default', '{\"uuid\":\"ea98312d-7cff-41ea-b3f8-37441786e035\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:35;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743816821, 1743816821),
(36, 'default', '{\"uuid\":\"741c1fae-9e85-45a1-9cea-df87d0e26d25\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":1:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:36;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743817422, 1743817422),
(37, 'default', '{\"uuid\":\"1e002c02-4e8b-4a41-96ca-63e1146e2f3d\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:1;s:6:\\\"socket\\\";s:14:\\\"35559.17998142\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743937398, 1743937398),
(38, 'default', '{\"uuid\":\"c0d305e3-db2b-48c4-99cf-de2dfd5c7e5b\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:1;s:6:\\\"socket\\\";s:14:\\\"35559.17998142\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743937406, 1743937406),
(39, 'default', '{\"uuid\":\"52b5ea11-581e-458a-b40c-fe4c9b922362\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:1;s:6:\\\"socket\\\";s:12:\\\"35672.519558\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743937495, 1743937495),
(40, 'default', '{\"uuid\":\"d4b2bf97-ea8c-4c55-bba1-f5690533691c\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35352.49421229\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743937865, 1743937865),
(41, 'default', '{\"uuid\":\"7efe5eaf-26eb-44c9-b227-fd9250b311a6\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:2:\\\"đ\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743937865, 1743937865),
(42, 'default', '{\"uuid\":\"3bd8038d-946f-4919-baa1-7a27c52c70bc\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:5;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:13:\\\"35645.6794650\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938199, 1743938199),
(43, 'default', '{\"uuid\":\"d54fa2aa-3b39-4b01-af2b-09d8f90ff367\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:6;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35352.49421229\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938208, 1743938208),
(44, 'default', '{\"uuid\":\"6ce78fb8-95d3-4273-bcbb-e5841d9781a3\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:4:\\\"haha\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938208, 1743938208),
(45, 'default', '{\"uuid\":\"c0b61882-870f-4aa0-8c36-9df7390e8161\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:7;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35601.12943684\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938470, 1743938470),
(46, 'default', '{\"uuid\":\"b797dba5-04a8-4db9-a5da-85cd4a89e3b7\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:8;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35390.44671290\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938784, 1743938784),
(47, 'default', '{\"uuid\":\"1c0eed08-7d70-4daf-9b0e-b2011bd2410e\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:9;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35390.44671727\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938798, 1743938798),
(48, 'default', '{\"uuid\":\"d0ab2933-60ef-45d4-afca-2d6672a91a3e\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:2:\\\"hi\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938798, 1743938798),
(49, 'default', '{\"uuid\":\"5a86c61e-7604-4924-868a-9ef1bace8aa5\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:10;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:12:\\\"35669.677092\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938995, 1743938995),
(50, 'default', '{\"uuid\":\"e9c709ca-69a2-4adb-9ae8-9bd5c2159534\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:2:\\\"hi\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743938995, 1743938995),
(51, 'default', '{\"uuid\":\"b65ce03a-8a0c-4d53-8e35-2180fd764865\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:11;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35599.11851071\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939001, 1743939001),
(52, 'default', '{\"uuid\":\"96df4bd2-5b08-45d6-b484-910244b912c1\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:12;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35372.45737942\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939024, 1743939024),
(53, 'default', '{\"uuid\":\"93ad2e14-be03-431c-a8a0-3701b123861b\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:13;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:12:\\\"35669.677899\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939031, 1743939031),
(54, 'default', '{\"uuid\":\"a361daf0-6310-4777-8655-4c449937f653\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:2:\\\"hi\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939031, 1743939031),
(55, 'default', '{\"uuid\":\"84645c96-25a0-4c0c-aecb-73e429cea253\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:14;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35574.13938197\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939057, 1743939057),
(56, 'default', '{\"uuid\":\"3a061efd-12ba-41e1-a34a-890424960af5\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:15;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:12:\\\"35669.677899\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939064, 1743939064),
(57, 'default', '{\"uuid\":\"345934c5-72bd-4fd4-a3cb-f0dc35c53bb6\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:12:\\\"khhjklhjljhl\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939064, 1743939064),
(58, 'default', '{\"uuid\":\"1e66fc82-1d4d-4a73-aa11-45a55bf1cf2e\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:16;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35466.32564331\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939089, 1743939089),
(59, 'default', '{\"uuid\":\"a2b58345-4295-4d44-957f-e3f924d935dd\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:17;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35350.48848619\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939097, 1743939097),
(60, 'default', '{\"uuid\":\"77f549fb-c9c5-41b2-930f-4a9a5b24a392\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:6:\\\"dfsdfg\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939097, 1743939097),
(61, 'default', '{\"uuid\":\"288c6cb9-7a5c-40d8-b34c-b13ef11b479c\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:18;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35574.13940064\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939113, 1743939113),
(62, 'default', '{\"uuid\":\"7e5e0142-0b91-42c6-a0a2-88e6f48591c0\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:19;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:13:\\\"35665.2208665\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939349, 1743939349),
(63, 'default', '{\"uuid\":\"6d275fba-7749-4a29-b0ba-69b939c30e3e\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:20;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35470.32213441\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939486, 1743939486),
(64, 'default', '{\"uuid\":\"6769d285-d82d-4a46-abda-13742b508f8d\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:17:\\\"ưdưqdasascdfsfs\\\";s:8:\\\"userName\\\";s:7:\\\"Huyền\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939486, 1743939486),
(65, 'default', '{\"uuid\":\"a4264097-134a-4ebc-86e3-80dbabe2e634\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:21;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:2;s:6:\\\"socket\\\";s:14:\\\"35466.32578978\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743939496, 1743939496),
(66, 'default', '{\"uuid\":\"6f8b11fd-ace3-43d5-96ae-73c0eca40335\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:22;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:3;s:6:\\\"socket\\\";s:13:\\\"35651.5956546\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743940852, 1743940852),
(67, 'default', '{\"uuid\":\"c2a946d7-e6a5-4d09-b367-812a88b2537e\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:4:\\\"hhhh\\\";s:8:\\\"userName\\\";s:3:\\\"huy\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743940852, 1743940852),
(68, 'default', '{\"uuid\":\"90922528-9dda-4629-a911-b3bc3f3929dc\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:23;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:4;s:6:\\\"socket\\\";s:14:\\\"35372.45813880\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941295, 1743941295),
(69, 'default', '{\"uuid\":\"35a46b01-8cfa-4ff9-a717-085a2d333c77\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:6:\\\"gdfhfj\\\";s:8:\\\"userName\\\";s:3:\\\"huy\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941295, 1743941295),
(70, 'default', '{\"uuid\":\"bfddad14-63ff-4fdf-a983-c7dffb2f211d\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:24;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:4;s:6:\\\"socket\\\";s:12:\\\"35672.664862\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941306, 1743941306),
(71, 'default', '{\"uuid\":\"14ddafe3-8340-4763-82c4-78a9dfc36217\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:25;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:4;s:6:\\\"socket\\\";s:13:\\\"35654.4398462\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941339, 1743941339),
(72, 'default', '{\"uuid\":\"5fa0449d-940a-42ed-aaab-f917d7c461da\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:10:\\\"gbdfhfdhfd\\\";s:8:\\\"userName\\\";s:3:\\\"huy\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941339, 1743941339),
(73, 'default', '{\"uuid\":\"bf44efa3-ca7a-4ec4-98d5-7ca63d3e5e1f\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:26;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:4;s:6:\\\"socket\\\";s:14:\\\"35398.44391220\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941413, 1743941413);
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(74, 'default', '{\"uuid\":\"22bcb921-b34c-4d81-a5e2-58db48c8a255\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:10:\\\"dsfdgdfghh\\\";s:8:\\\"userName\\\";s:3:\\\"huy\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941413, 1743941413),
(75, 'default', '{\"uuid\":\"67e495cb-7802-4c88-a9a9-53562ed8747d\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:27;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:4;s:6:\\\"socket\\\";s:14:\\\"35350.48926265\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941420, 1743941420),
(76, 'default', '{\"uuid\":\"ad63e760-b85a-4e77-9f13-8562cf882b0b\",\"displayName\":\"App\\\\Events\\\\MessageSent\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:22:\\\"App\\\\Events\\\\MessageSent\\\":3:{s:7:\\\"message\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:18:\\\"App\\\\Models\\\\Message\\\";s:2:\\\"id\\\";i:28;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"roomId\\\";i:4;s:6:\\\"socket\\\";s:13:\\\"35651.5979439\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941543, 1743941543),
(77, 'default', '{\"uuid\":\"f789ac80-0f30-4cea-8161-898330726484\",\"displayName\":\"App\\\\Events\\\\NewMessageReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\",\"command\":\"O:38:\\\"Illuminate\\\\Broadcasting\\\\BroadcastEvent\\\":14:{s:5:\\\"event\\\";O:29:\\\"App\\\\Events\\\\NewMessageReceived\\\":2:{s:7:\\\"message\\\";s:22:\\\"hadashfsdgdgsdgsdgsade\\\";s:8:\\\"userName\\\";s:3:\\\"huy\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:7:\\\"backoff\\\";N;s:13:\\\"maxExceptions\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1743941544, 1743941544);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint UNSIGNED NOT NULL,
  `room_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `receiver_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci,
  `attachment_type` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `room_id`, `sender_id`, `receiver_id`, `message`, `attachment`, `attachment_type`, `created_at`, `updated_at`) VALUES
(73, 7, 2, 2, 'hi', NULL, NULL, '2025-04-16 15:28:27', '2025-04-16 15:28:27'),
(74, 7, 4, 4, 'chào', NULL, NULL, '2025-04-16 15:28:56', '2025-04-16 15:28:56'),
(75, 7, 4, 4, 'hi', NULL, NULL, '2025-04-16 15:36:44', '2025-04-16 15:36:44'),
(76, 7, 4, 4, 'hi', NULL, NULL, '2025-04-16 15:36:45', '2025-04-16 15:36:45'),
(77, 7, 2, 2, 'nal', NULL, NULL, '2025-04-16 15:37:05', '2025-04-16 15:37:05'),
(78, 8, 3, 3, 'hi', NULL, NULL, '2025-04-21 03:31:46', '2025-04-21 03:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_03_150529_create_brands_table', 1),
(6, '2025_01_03_164645_create_categories_table', 1),
(7, '2025_01_06_155230_create_vouchers_table', 1),
(8, '2025_01_06_164212_create_status_orders_table', 1),
(9, '2025_01_06_164439_create_orders_table', 1),
(10, '2025_01_06_165234_create_products_table', 1),
(11, '2025_01_06_165235_create_image_galleries_table', 1),
(12, '2025_01_06_170646_create_variants_table', 1),
(13, '2025_01_06_171011_create_inventories_table', 1),
(14, '2025_01_06_171144_create_carts_table', 1),
(15, '2025_01_06_171145_create_cart_details_table', 1),
(16, '2025_01_14_183042_create_attributes_names_table', 1),
(17, '2025_01_14_183325_create_attributes_values_table', 1),
(18, '2025_01_14_184310_create_variant_attributes_table', 1),
(19, '2025_01_21_025235_create_comments_table', 1),
(20, '2025_03_01_163141_create_addresses_table', 1),
(21, '2025_03_07_120041_create_order_details_table', 1),
(22, '2025_03_12_200314_add_verification_code_to_users_table', 2),
(23, '2025_03_17_230327_create_shippings_table', 2),
(24, '2025_03_18_170701_create_policies_table', 3),
(25, '2014_10_11_000000_create_roles_table', 4),
(26, '2025_03_17_222519_create_create_news_table', 5),
(27, '2025_03_26_214650_create_permissions_table', 5),
(28, '2025_03_26_215536_create_role_permission_table', 5),
(30, '2025_03_31_214023_create_jobs_table', 6),
(31, '2025_04_02_204731_add_is_admin_to_users_table', 6),
(33, '2025_04_02_171821_create_favorites_table', 8),
(35, '2025_04_05_230842_create_return_orders_table', 8),
(36, '2025_04_05_230906_create_prove_refunds_table', 8),
(37, '2025_03_28_170821_create_rooms_table', 9),
(38, '2025_03_31_212325_create_messages_table', 10),
(39, '2025_04_06_185439_add_column_to_users_table', 11),
(40, '2024_03_19_000000_create_favorites_table', 12),
(41, '2025_04_07_105518_add_voucher_details_to_orders_table', 13),
(42, '2025_04_07_112935_add_quantity_to_vouchers_table', 13),
(43, '2025_04_04_213144_create_product_reviews_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `address_id` bigint UNSIGNED NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `voucher_id` bigint UNSIGNED DEFAULT NULL,
  `voucher_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_discount_type` enum('percentage','fixed') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_discount_value` decimal(15,2) DEFAULT NULL,
  `voucher_discount_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','confirmed','shipping','delivered','completed','received','order_confirmation','canceled','admin_canceled','return_request','refuse_return','sent_information','return_approved','returned_item_received','refund_completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `completed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `address_id`, `payment_method`, `payment_status`, `order_date`, `voucher_id`, `voucher_code`, `voucher_name`, `voucher_discount_type`, `voucher_discount_value`, `voucher_discount_amount`, `created_at`, `updated_at`, `status`, `completed_at`) VALUES
(326, 3, '1350000.00', 16, 'COD', 'Thanh toán khi nhận hàng', '2025-04-15 17:39:23', 9, 'hht', 'mkl', 'fixed', '500000.00', '500000.00', NULL, NULL, 'order_confirmation', '2025-04-16 16:08:21'),
(327, 3, '950000.00', 16, 'COD', 'Thanh toán khi nhận hàng', '2025-04-15 17:40:01', 11, 'llk', 'mad', 'percentage', '50.00', '950000.00', NULL, NULL, 'order_confirmation', '2025-04-15 17:44:24'),
(329, 3, '170000.00', 16, 'VNPAY_DECOD', 'Thanh toán thành công', '2025-04-15 17:41:33', 10, '34', 'h6', 'percentage', '90.00', '1530000.00', NULL, NULL, 'refund_completed', '2025-04-16 15:57:51'),
(336, 4, '3350000.00', 19, 'COD', 'Thanh toán khi nhận hàng', '2025-04-16 15:50:51', 4, 'mxx1', 'ngày 8-3', 'fixed', '50000.00', '50000.00', NULL, NULL, 'order_confirmation', '2025-04-16 15:57:35'),
(337, 7, '4999000.00', 11, 'VNPAY_DECOD', 'Thanh toán thành công', '2025-04-20 11:02:14', 10, '34', 'h6', 'percentage', '90.00', '2000000.00', NULL, NULL, 'delivered', NULL),
(338, 8, '2100000.00', 13, 'VNPAY_DECOD', 'Thanh toán thành công', '2025-04-20 11:09:47', 9, 'hht', 'mkl', 'fixed', '500000.00', '500000.00', NULL, NULL, 'delivered', NULL),
(339, 3, '2900000.00', 16, 'COD', 'Thanh toán khi nhận hàng', '2025-04-20 14:47:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'order_confirmation', '2025-04-20 15:09:31'),
(340, 8, '3200000.00', 13, 'VNPAY_DECOD', 'Thanh toán thành công', '2025-04-22 18:07:29', 6, 'sp3', 'nguyy', 'fixed', '500000.00', '500000.00', NULL, NULL, 'completed', '2025-04-22 18:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `variant_id` bigint UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_attribute` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `variant_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `variant_id`, `price`, `quantity`, `total_price`, `created_at`, `updated_at`, `product_name`, `variant_attribute`, `variant_value`) VALUES
(259, 326, NULL, 16, '1850000.00', 1, '1850000.00', '2025-04-15 17:39:23', '2025-04-15 17:39:23', 'Giày Nike Jordan1 Low Paris – Siêu Cấp', 'Màu sắc - Kích cỡ', 'Xám Xanh - 42'),
(260, 327, NULL, 17, '950000.00', 2, '1900000.00', '2025-04-15 17:40:01', '2025-04-15 17:40:01', 'Giày Nike Air Force 1 Full White Like Auth', 'Màu sắc - Kích cỡ', 'Trắng - 40'),
(262, 329, NULL, 26, '1700000.00', 1, '1700000.00', '2025-04-15 17:41:33', '2025-04-15 17:41:33', 'Giày Louis Vuitton LV Trainer 54 Signature White Gray', 'Màu sắc - Kích cỡ', 'Trắng - 39'),
(269, 336, NULL, 26, '1700000.00', 2, '3400000.00', '2025-04-16 15:50:51', '2025-04-16 15:50:51', 'Giày Louis Vuitton LV Trainer 54 Signature White Gray', 'Màu sắc - Kích cỡ', 'Trắng - 39'),
(270, 337, NULL, 22, '1799000.00', 1, '1799000.00', '2025-04-20 11:02:14', '2025-04-20 11:02:14', 'Giày sneakers unisex cổ thấp Rebound V6', 'Kích cỡ', '41'),
(271, 337, NULL, 5, '1300000.00', 4, '5200000.00', '2025-04-20 11:02:14', '2025-04-20 11:02:14', 'MLB - Giày sneakers unisex cổ thấp', 'Màu sắc - Kích cỡ', 'Xanh - 39'),
(272, 338, NULL, 5, '1300000.00', 2, '2600000.00', '2025-04-20 11:09:47', '2025-04-20 11:09:47', 'MLB - Giày sneakers unisex cổ thấp', 'Màu sắc - Kích cỡ', 'Xanh - 39'),
(273, 339, NULL, 26, '1700000.00', 1, '1700000.00', '2025-04-20 14:47:41', '2025-04-20 14:47:41', 'Giày Louis Vuitton LV Trainer 54 Signature White Gray', 'Màu sắc - Kích cỡ', 'Trắng - 39'),
(274, 339, 9, NULL, '600000.00', 2, '1200000.00', '2025-04-20 14:47:41', '2025-04-20 14:47:41', 'Giày Yeezy 350 V2 Zebra', NULL, NULL),
(275, 340, NULL, 16, '1850000.00', 2, '3700000.00', '2025-04-22 18:07:29', '2025-04-22 18:07:29', 'Giày Nike Jordan1 Low Paris – Siêu Cấp', 'Màu sắc - Kích cỡ', 'Xám Xanh - 42');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Thêm danh mục', 'categorys.create', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(2, 'Thêm sản phẩm', 'products.create', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(3, 'Sửa sản phẩm', 'products.edit', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(4, 'Xem sản phẩm', 'products.index', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(5, 'Sửa danh mục', 'categorys.edit', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(6, 'Xem danh mục', 'categorys.index', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(7, 'Thêm thương hiệu', 'brands.create', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(8, 'Xem thương hiệu', 'brands.index', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(9, 'Sửa thương hiệu', 'brands.edit', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(10, 'Xem đơn hàng', 'orders.index', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(11, 'Sửa đơn hàng', 'orders.edit', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(12, 'Thêm đơn hàng', 'orders.create', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(13, 'Thêm thuộc tính', 'attributes.create', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(14, 'Sửa thuộc tính', 'attributes.edit', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(15, 'Xem thuộc tính', 'attributes.index', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(16, 'Xem giá trị thuộc tính', 'attribute_values.index', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(17, 'Thêm giá trị thuộc tính', 'attribute_values.create', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(18, 'Sửa giá trị thuộc tính', 'attribute_values.edit', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(19, 'Thêm khuyến mãi', 'vouchers.create', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(20, 'Xem khuyến mãi', 'vouchers.index', '2025-03-28 08:45:57', '2025-03-28 08:45:57'),
(21, 'Sửa khuyến mãi', 'vouchers.edit', '2025-03-28 08:45:57', '2025-03-28 08:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_manual` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL,
  `base_price` bigint UNSIGNED NOT NULL,
  `price_sale` bigint UNSIGNED DEFAULT NULL,
  `img_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` bigint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_good_deal` tinyint(1) NOT NULL DEFAULT '0',
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `is_show_home` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `sku`, `slug`, `description`, `content`, `user_manual`, `quantity`, `base_price`, `price_sale`, `img_thumbnail`, `view`, `is_active`, `is_good_deal`, `is_new`, `is_show_home`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 'Giày MLB Playball Mule Monogram New York Yankees Black', 'ml2312', 'giay-mlb-playball-mule-monogram-new-york-yankees-black', 'Giày MLB Playball Mule Monogram New York Yankees Black là một mẫu giày slip-on (mule) thời trang đến từ thương hiệu MLB Korea. Đây là một lựa chọn phổ biến cho những ai yêu thích phong cách thể thao kết hợp với sự tiện lợi.', 'Đặc điểm nổi bật:\r\nThiết kế Mule: Không có phần gót giúp dễ dàng mang vào và tháo ra, phù hợp cho việc di chuyển nhanh chóng.\r\n\r\nChất liệu cao cấp: Phần upper được làm từ vải canvas bền bỉ, thoáng khí, giúp tạo cảm giác thoải mái khi mang.\r\n\r\nHọa tiết Monogram: Toàn bộ giày được phủ họa tiết monogram đặc trưng của thương hiệu MLB, tạo điểm nhấn thời trang.\r\n\r\nLogo New York Yankees: Nổi bật với logo NY của đội bóng chày New York Yankees, mang đến phong cách thể thao năng động.\r\n\r\nĐế cao su chắc chắn: Giúp bám đường tốt, hạn chế trơn trượt và tăng độ bền.', 'Dùng khăn mềm hoặc bàn chải lông mềm để lau bụi bẩn trên bề mặt vải canvas.\r\n\r\nNếu giày bị bẩn, sử dụng nước ấm pha loãng với xà phòng nhẹ, sau đó dùng bàn chải mềm hoặc khăn ẩm lau nhẹ nhàng.\r\n\r\nKhông nên dùng chất tẩy rửa mạnh vì có thể làm bay màu họa tiết monogram.\r\n\r\nĐể làm sạch phần đế cao su, có thể dùng kem đánh răng hoặc baking soda để tẩy trắng hiệu quả', 15, 1220000, 1200000, 'products/j5okfNly7jcMHttBLPTqQwWvChktrVuDhfc1UJgF.webp', 0, 1, 0, 0, 0, '2025-03-09 14:08:30', '2025-04-13 14:27:51'),
(2, 7, 4, 'MLB - Giày Chunky Liner Mid Denim', 'mlb3', 'mlb-giay-chunky-liner-mid-denim', 'Với thiết kế phom dáng chunky vừa cổ điển vừa trẻ trung, đôi giày sneakers Chunky Liner Mid Denim chính là người bạn đồng hành hoàn hảo để cùng bạn thể hiện phong cách đầy năng động', 'Dây quai: Dây thắt mảnh, có thể điều chỉnh\nThoáng khí: Có lớp lót thoáng khí. \nThích hợp dùng trong các dịp: Trang trọng, phù hợp vào buổi tối.\nXu hướng theo mùa: Sử dụng được tất cả các mùa trong năm.', 'Vệ sinh bằng khăn ẩm mềm Bảo quản nơi khô thoáng Không phơi trực tiếp dưới ánh nắng mặt trời', 120, 3210000, 3100000, 'products/Mi7G2Xfz8G5jRTc5qRtMMYx4Mh0FUEwMzwNVOOs4.webp', 0, 0, 0, 0, 0, '2025-03-09 14:12:08', '2025-03-26 15:30:27'),
(3, 7, 4, 'Giày Chunky Liner Denim Monogam', 'mlb2', 'giay-chunky-liner-denim-monogam', 'Đôi giày sneakers Chunky Liner Denim Monogam là sự kết hợp hoàn hảo giữa phong cách thời trang hiện đại và thiết kế chunky đầy cá tính, mang đến vẻ ngoài năng động, trẻ trung.', 'Kiểu dáng giày sneakers đế chunky cá tính.\r\nHọa tiết monogram thời thượng.\r\nPhom ôm chân, dễ dàng di chuyển.\r\nĐế cao su với độ bền cao, chắc chắn mang lại độ ma sát tốt.\r\nGam màu hiện đại dễ dàng phối với nhiều trang phục và phụ kiện.', 'Hướng dẫn bảo quản- Khử mùi bên trong giày Bạn hãy đặt túi đựng viên chống ẩm vào bên trong giày để hút ẩm và rắc phấn rôm (có thể thay bằng cách đặt vào bên trong giày gói trà túi lọc chưa qua sử dụng) để khử mùi, giúp giày luôn khô thoáng..', 119, 3600000, 1900000, 'products/jfg1yOs4o0U9bQJuIJGdaE74Ikkxa50Sgpe5k7rK.webp', 0, 1, 0, 0, 0, '2025-03-12 14:27:10', '2025-04-13 14:27:38'),
(4, 5, 4, 'MLB - Giày sneakers unisex cổ thấp', 'mlb', 'mlb-giay-sneakers-unisex-co-thap', 'Đôi giày sneakers Chunky Liner Denim Monogam là sự kết hợp hoàn hảo giữa phong cách thời trang hiện đại và thiết kế chunky đầy cá tính, mang đến vẻ ngoài năng động, trẻ trung.', 'jjjgjgjjgjgjgjjgjg', 'Bạn hãy đặt túi đựng viên chống ẩm vào bên trong giày để hút ẩm và rắc phấn rôm (có thể thay bằng cách đặt vào bên trong giày gói trà túi lọc chưa qua sử dụng) để khử mùi, giúp giày luôn khô thoáng.', 100, 1500000, 1300000, 'products/MrKnT1siZbrVC1cPnBtLH9qiUEyNpTk0HHKHxLEg.jpg', 0, 0, 1, 1, 1, '2025-03-15 14:36:11', '2025-03-29 12:57:24'),
(5, 5, 2, 'Giày tập luyện Skechers', 'puma', 'giay-tap-luyen-skechers', 'Đôi giày tập luyện Viper Court Reload là lựa chọn hoàn hảo cho những ai đam mê bộ môn thể thao Pickleball, đem đến trải nghiệm di chuyển linh hoạt và êm ái trên từng bước chân', 'Đôi giày tập luyện Viper Court Reload là lựa chọn hoàn hảo cho những ai đam mê bộ môn thể thao Pickleball, đem đến trải nghiệm di chuyển linh hoạt và êm ái trên từng bước chân. Bên cạnh công nghệ Hands Free Slip-ins® Relaxed Fit® độc đáo giúp dễ dàng mang vào, tháo ra mà không cần tốn thời gian buộc dây', 'Vệ sinh bằng khăn mềm\r\nTránh vật sắc nhọn và nơi có nhiệt độ cao\r\nTránh tiếp xúc với môi trường xăng dầu, kiềm', 32, 2300000, 2000000, 'products/tr5913cZfFh8tfX1TwQdGAhXriAevEENOJ6KUaOR.jpg', 0, 1, 0, 0, 1, '2025-03-15 14:55:11', '2025-04-13 14:27:20'),
(6, 6, 3, 'Giày Nike Dunk Low Retro', 'nike', 'giay-nike-dunk-low-retro', 'Bạn luôn có thể tin tưởng vào một đôi giày cổ điển. Dunk Low kết hợp màu sắc biểu tượng của mình với chất liệu cao cấp và lớp đệm sang trọng để tạo nên sự thoải mái vượt trội và bền lâu.', 'Những lợi ích\r\nPhần trên bằng da thật và da tổng hợp mềm mại và mang nét cổ điển khi sử dụng.\r\nĐế giữa bằng bọt có khả năng đệm nhẹ và đàn hồi.\r\nĐế ngoài bằng cao su với vòng tròn xoay cổ điển tăng thêm độ bám đường bền bỉ và phong cách truyền thống.\r\nChi tiết sản phẩm\r\nCổ áo có đệm\r\nHộp ngón chân đục lỗ', 'Hướng dẫn bảo quản-\r\nKhử mùi bên trong giày\r\nBạn hãy đặt túi đựng viên chống ẩm vào bên trong giày để hút ẩm và rắc phấn rôm (có thể thay bằng cách đặt vào bên trong giày gói trà túi lọc chưa qua sử dụng) để khử mùi, giúp giày luôn khô thoáng.\r\n\r\nĐể hạn chế mùi hôi và sự ẩm ướt cho giày, hãy chọn vớ chân loại tốt, có khả năng thấm hút cao. Ngoài ra, dùng các loại lót giày khử mùi cũng là một phương pháp tốt.\r\n\r\nBảo quản giày khi không sử dụng\r\nKhi sử dụng giày, bạn đừng vội vứt hộp đi mà hãy cất lại để dành. Khi không sử dụng, hãy nhét một ít giấy vụn vào bên trong giày để giữ cho dáng giày luôn chuẩn, đẹp. Sau đó đặt giày vào hộp bảo quản cùng túi hút ẩm.', 45, 2929000, 2000000, 'products/lKXj3L1xaoqHtzIYHTOhjzwth67bpE7Ietk59mS6.webp', 0, 0, 1, 1, 1, '2025-03-18 15:41:29', '2025-03-29 13:15:33'),
(7, 5, 2, 'Giày sneakers unisex cổ thấp Rebound V6', 'pupu', 'giay-sneakers-unisex-co-thap-rebound-v6', 'Với sự kết hợp giữa phong cách năng động và thoải mái, đôi giày sneakers Rebound V6 đã nhanh chóng trở thành sự lựa chọn lí tưởng để cùng mọi tín đồ sneakers bứt phá thời trang street-style', 'Phom dáng ôm chân, dễ dàng di chuyển.\r\nĐế cao su cao cấp, tăng độ đàn hồi.\r\nPhối màu hiện đại dễ dàng kệt hợp với nhiều trang phục và phụ kiện.\r\nLogo: Được in nổi bật ở phần đế, lưỡi giày và lớp lót trong.\r\nMũi giày tròn, đế thấp.\r\nDây quai: Dây thắt mảnh, có thể điều chỉnh.\r\nThoáng khí: Có lớp lót thoáng khí  .\r\nThích hợp dùng trong các dịp: Đi làm, đi chơi,...\r\nXu hướng theo mùa: Sử dụng được tất cả các mùa trong năm.', 'Vệ sinh bằng khăn ẩm mềm\r\nTránh tiếp xúc trực tiếp với môi trường xăng dầu, kiềm\r\nXem thêm trên tag sản phẩm', 122, 1899000, 1799000, 'products/OYRtdplRVbdXEbOFbTg8jNyd82JsUb07PTIJTNUN.webp', 0, 1, 1, 0, 1, '2025-03-20 15:40:22', '2025-04-02 07:56:32'),
(8, 2, 3, 'Giày Nike Air Force 1 LV8 GS ‘Swoosh Pack’', 'FN4730', 'giay-nike-air-force-1-lv8-gs-swoosh-pack', 'Giày Nike Air Force 1 LV8 GS ‘Swoosh Pack’ là một phiên bản nâng cấp của dòng Air Force 1 huyền thoại, mang đến thiết kế hiện đại hơn với các chi tiết độc đáo. Đôi giày này vẫn giữ nguyên phong cách kinh điển của AF1 nhưng được làm mới với các chất liệu cao cấp, màu sắc đa dạng và công nghệ cải tiến.', 'Thiết Kế Độc Đáo: LV8 (viết tắt của “Elevate”) mang đến sự đổi mới với các họa tiết, chất liệu và phối màu độc quyền, tạo điểm nhấn khác biệt so với phiên bản AF1 cổ điển.\r\n\r\n🔹 Chất Liệu Cao Cấp: Phần upper có thể làm từ da, vải canvas hoặc da lộn, tùy vào từng phiên bản LV8. Điều này giúp tăng độ bền và tạo vẻ ngoài sang trọng, thời trang.\r\n\r\n Bộ Đệm Êm Ái: Sử dụng công nghệ Nike Air bên trong đế giữa, mang lại cảm giác êm chân, hỗ trợ di chuyển thoải mái cả ngày.\r\n\r\n Đế Cao Su Bám Đường: Đế giày với họa tiết hình tròn giúp tăng độ bám, chống trơn trượt và phù hợp với mọi bề mặt di chuyển.\r\n\r\n Logo Swoosh và Các Chi Tiết Đặc Biệt: Một số phiên bản LV8 có logo phản quang, vân nổi, hoặc họa tiết camo, tạo phong cách cá tính và hiện đại.', 'Vệ sinh thường xuyên: Dùng bàn chải lông mềm và dung dịch tẩy rửa nhẹ để làm sạch giày.\r\n Hạn chế tiếp xúc nước: Tránh đi dưới mưa hoặc ngâm nước quá lâu để bảo vệ chất liệu giày.\r\n Bảo quản nơi thoáng mát: Để giày ở nơi khô ráo, tránh nhiệt độ cao làm hỏng keo và chất liệu da.\r\n Giữ form giày: Nhét giấy báo hoặc sử dụng shoe tree khi không mang để giữ dáng giày.', 48, 2679000, 2350000, 'products/aaJ9ApBTpLuvkDIAfvpz2JbuOJqy5aObnFTk2HEZ.png', 0, 1, 1, 0, 1, '2025-03-26 15:49:50', '2025-04-02 07:56:17'),
(9, 3, 5, 'Giày Yeezy 350 V2 Zebra', 'yz0381', 'giay-yeezy-350-v2-zebra', 'Yeezy Boost 350 V2 Zebra là một trong những phối màu nổi bật nhất của dòng Yeezy 350 V2 do Kanye West hợp tác cùng Adidas. Với thiết kế độc đáo, họa tiết vằn trắng đen ấn tượng cùng bộ đệm Boost êm ái, phiên bản này luôn nằm trong danh sách \"must-have\" của các sneakerhead.', 'Thiết Kế \"Zebra\" Độc Đáo\r\n\r\nPhần upper Primeknit với họa tiết vằn trắng đen lấy cảm hứng từ ngựa vằn, tạo vẻ ngoài cực kỳ bắt mắt.\r\n\r\nChữ \"SPLY-350\" màu đỏ đặc trưng chạy dọc bên hông giày, tăng thêm điểm nhấn.\r\n\r\n Công Nghệ Boost Êm Ái\r\n\r\nĐế giày sử dụng công nghệ Boost mang lại cảm giác êm chân, đàn hồi tốt và hỗ trợ di chuyển linh hoạt.\r\n\r\n Đế Cao Su Trong Suốt & Bám Dính Tốt\r\n\r\nĐế ngoài bằng cao su có màu trắng ngà nhẹ, giúp tăng độ bền và chống trơn trượt hiệu quả.\r\n\r\nThiết Kế Ôm Chân & Thoáng Khí\r\n\r\nChất liệu Primeknit giúp giày ôm sát chân mà vẫn co giãn tốt, mang lại sự thoải mái khi di chuyển.', 'Vệ sinh đúng cách: Dùng bàn chải lông mềm, nước ấm pha loãng với xà phòng nhẹ để làm sạch phần Primeknit. Không dùng chất tẩy mạnh.\r\n Hạn chế tiếp xúc nước & bùn đất: Vì màu sắc chủ đạo là trắng, dễ bị bẩn nên tránh đi dưới mưa hoặc bùn đất.\r\nBảo quản nơi thoáng mát: Tránh ánh nắng trực tiếp vì có thể làm ố vàng phần đế Boost.\r\n Giữ form giày: Sử dụng shoe tree hoặc nhét giấy vào bên trong khi không sử dụng để giữ dáng giày.', 40, 640000, 600000, 'products/RgmCpIoJEJ5JVWHu0H0dJxT3YCo79ZUMRHFUViJ9.jpg', 0, 1, 1, 0, 1, '2025-03-26 16:00:29', '2025-04-20 14:47:41'),
(10, 1, 3, 'Giày Nike Air Jordan 1 Low ‘Island Green’ Siêu Cấp', 'jd19302', 'giay-nike-air-jordan-1-low-island-green-sieu-cap', 'Nike Air Jordan 1 Low ‘Island Green’ là một phiên bản nổi bật của dòng AJ1 Low, thu hút sự chú ý với phối màu Island Green (xanh ngọc) tươi mát kết hợp cùng trắng và đen cổ điển. Đây là lựa chọn hoàn hảo cho những ai yêu thích sự năng động nhưng vẫn muốn giữ phong cách tinh tế.', 'Phối Màu ‘Island Green’ Cá Tính\r\n\r\nMàu xanh ngọc kết hợp với trắng và đen tạo nên sự hài hòa, dễ phối đồ và phù hợp với nhiều phong cách.\r\n\r\nPhần logo Jumpman trên lưỡi gà và Wings Logo ở gót giày làm tăng thêm điểm nhấn thương hiệu.\r\n\r\n Chất Liệu Cao Cấp & Hoàn Thiện Tỉ Mỉ\r\n\r\nUpper được làm từ da tổng hợp và da lộn mềm mại, giúp giày bền bỉ nhưng vẫn thoải mái khi mang.\r\n\r\nLớp lót êm ái bên trong giúp nâng cao trải nghiệm đi lại hàng ngày.\r\n\r\n Đế Cao Su Chống Trượt & Êm Ái\r\n\r\nĐế ngoài bằng cao su với thiết kế vân tròn giúp bám đường tốt, chống trơn trượt.\r\n\r\nCông nghệ Air-Sole hỗ trợ độ êm ái, mang lại cảm giác nhẹ nhàng, thoải mái khi di chuyển.\r\n\r\n Form Dáng Cổ Thấp Linh Hoạt\r\n\r\nThiết kế cổ thấp dễ mang, phù hợp với cả nam và nữ, tiện lợi khi di chuyển và vận động.', 'Vệ sinh thường xuyên: Dùng bàn chải lông mềm và dung dịch tẩy nhẹ để làm sạch giày. Hạn chế giặt bằng nước nhiều để tránh làm hỏng chất liệu da.\r\n Tránh tiếp xúc nước & nhiệt độ cao: Không nên mang giày đi dưới trời mưa hoặc để ở nơi quá nóng để tránh hỏng keo và ố màu.\r\n Giữ form giày: Dùng shoe tree hoặc nhét giấy báo vào giày khi không sử dụng để giữ dáng chuẩn.\r\n Bảo quản nơi thoáng mát: Để giày trong hộp hoặc túi vải, tránh bụi bẩn và ẩm mốc.', 159, 1400000, 900000, 'products/s39dj236d6noSzrHqR712LlcY6hRGol55WRmUrIi.jpg', 0, 1, 1, 0, 1, '2025-03-26 16:08:57', '2025-04-13 16:13:01'),
(11, 1, 3, 'Giày Nike Jordan1 Low Paris – Siêu Cấp', 'CV3043', 'giay-nike-jordan1-low-paris-sieu-cap', 'Nike Air Jordan 1 Low ‘Paris’ là một phiên bản đặc biệt lấy cảm hứng từ thành phố Paris hoa lệ, mang đến sự kết hợp hoàn hảo giữa phong cách thể thao và thời trang cao cấp. Với thiết kế tối giản nhưng tinh tế, đôi giày này hướng đến những người yêu thích sự thanh lịch, nhẹ nhàng nhưng vẫn không kém phần cá tính.', 'Phối Màu Tinh Tế & Thanh Lịch\r\n\r\nPhối màu trắng, xám, xanh nhạt mang đến cảm giác sang trọng, dễ phối đồ.\r\n\r\nSự kết hợp giữa trắng kem (Sail), xám nhạt và xanh baby blue tạo nên tổng thể trang nhã, phù hợp với phong cách minimalist.\r\n\r\n Chất Liệu Cao Cấp & Hoàn Thiện Tỉ Mỉ\r\n\r\nUpper kết hợp da lộn cao cấp (suede), vải canvas và da mềm, giúp tăng độ bền và mang lại cảm giác thoải mái.\r\n\r\nLưỡi gà bằng vải lưới thoáng khí, giúp giảm nhiệt khi mang trong thời gian dài.\r\n\r\n Đế Cao Su Chống Trượt & Công Nghệ Air-Sole\r\n\r\nĐế giữa tích hợp công nghệ Air-Sole, mang lại cảm giác êm ái, nhẹ nhàng.\r\n\r\nĐế ngoài bằng cao su có độ bám tốt, chống trơn trượt và phù hợp với nhiều bề mặt khác nhau.\r\n\r\n Logo Jumpman & Wings Độc Quyền\r\n\r\nLogo Jumpman màu vàng gold trên lưỡi gà tăng thêm sự đẳng cấp.\r\n\r\nWings Logo ở gót giày tạo điểm nhấn đặc trưng của dòng Jordan 1.', 'Vệ sinh đúng cách: Dùng khăn mềm và bàn chải lông mềm để làm sạch da lộn, không dùng nước quá nhiều để tránh làm hỏng chất liệu.\r\n Tránh tiếp xúc nước & vết bẩn: Phối màu sáng dễ bám bẩn, nên sử dụng dung dịch bảo vệ giày (Water Repellent) trước khi mang.\r\n Giữ form giày: Dùng shoe tree hoặc nhét giấy báo vào giày khi không sử dụng để giữ dáng chuẩn.\r\n Bảo quản nơi thoáng mát: Để giày trong hộp hoặc túi vải, tránh tiếp xúc với ánh nắng trực tiếp và độ ẩm cao.', 77, 2200000, 1850000, 'products/pYnfbeuZNqJd3qOp4Y3wVHSzVhorIihVZKkKnyq4.webp', 0, 1, 1, 0, 1, '2025-03-26 16:19:57', '2025-04-02 07:55:36'),
(12, 2, 3, 'Giày Nike Air Force 1 Full White Like Auth', 'NAF01', 'giay-nike-air-force-1-full-white-like-auth', 'Nike Air Force 1 Full White là một trong những mẫu sneaker huyền thoại của Nike, nổi bật với thiết kế đơn giản, tinh tế nhưng không bao giờ lỗi mốt. Phiên bản Like Auth (chuẩn 1:1) mang đến chất lượng hoàn thiện cực cao, gần như giống hệt bản chính hãng, phù hợp cho những ai yêu thích sự tinh tế và thoải mái.', 'Thiết Kế Tối Giản, Dễ Phối Đồ\r\n\r\nFull trắng (Triple White) đơn giản nhưng cực kỳ thanh lịch, phù hợp với mọi outfit.\r\n\r\nLogo Nike Swoosh hai bên đặc trưng, tạo điểm nhấn tinh tế.\r\n\r\n Chất Liệu Da Cao Cấp\r\n\r\nUpper bằng da tổng hợp mềm mại, dễ vệ sinh và giữ form tốt.\r\n\r\nĐường may tỉ mỉ, hoàn thiện chuẩn Like Auth, tạo độ bền cao.\r\n\r\n Đế Cao Su Bền Bỉ & Công Nghệ Air-Sole\r\n\r\nCông nghệ Air-Sole giúp giảm chấn, mang lại cảm giác êm ái khi di chuyển.\r\n\r\nĐế cao su chống trơn trượt, phù hợp với mọi bề mặt.\r\n\r\n Form Giày Ôm Chân, Dễ Đi\r\n\r\nThiết kế cổ thấp giúp dễ dàng mang vào và tháo ra, phù hợp với cả nam và nữ.', 'Vệ sinh đúng cách: Dùng khăn mềm và bàn chải lông mềm để làm sạch da, không dùng nước quá nhiều để tránh làm hỏng chất liệu.\r\n Tránh tiếp xúc nước & vết bẩn: Phối màu sáng dễ bám bẩn, nên sử dụng dung dịch bảo vệ giày (Water Repellent) trước khi mang.\r\n Giữ form giày: Dùng shoe tree hoặc nhét giấy báo vào giày khi không sử dụng để giữ dáng chuẩn.\r\n Bảo quản nơi thoáng mát: Để giày trong hộp hoặc túi vải, tránh tiếp xúc với ánh nắng trực tiếp và độ ẩm cao.', 38, 1150000, 950000, 'products/OJunPo2a124rJ8QKyNYGL8Ovp3p0td21vJrEvaeC.jpg', 0, 1, 1, 0, 1, '2025-03-26 16:27:15', '2025-04-13 14:02:24'),
(13, 3, 5, 'Adidas Yeezy Boost 700 V2 \'Static\'', 'yz70221', 'adidas-yeezy-boost-700-v2-static', 'Adidas Yeezy Boost 700 V2 \'Static\' là một trong những phối màu mang tính biểu tượng nhất của dòng Yeezy 700 V2. Được ra mắt lần đầu vào năm 2018, đôi giày này nhanh chóng trở thành một trong những thiết kế chunky sneaker được săn đón nhất nhờ vào phối màu trung tính, chất liệu cao cấp và công nghệ Boost êm ái.', 'Thiết Kế Chunky Sneaker Hiện Đại\r\n\r\nForm giày bulky (chunky) mang phong cách retro nhưng vẫn cực kỳ thời thượng.\r\n\r\nPhối màu Static (trắng, xám, bạc) trung tính, dễ phối đồ và không bao giờ lỗi mốt.\r\n\r\n🔹 Chất Liệu Cao Cấp\r\n\r\nUpper kết hợp mesh thoáng khí, da lộn và da tổng hợp giúp giày vừa bền bỉ vừa nhẹ nhàng khi mang.\r\n\r\nCác đường vân phản quang 3M chạy dọc hai bên thân giày tạo hiệu ứng nổi bật khi gặp ánh sáng.\r\n\r\n🔹 Bộ Đệm Boost Êm Ái & Hỗ Trợ Tốt\r\n\r\nCông nghệ Boost trải dài toàn bộ đế giúp hoàn trả năng lượng, hỗ trợ di chuyển linh hoạt.\r\n\r\nĐế ngoài bằng cao su bám đường tốt, tăng độ ổn định khi di chuyển.\r\n\r\n🔹 Lưỡi Gà & Hệ Thống Dây Buộc Độc Đáo\r\n\r\nThiết kế lưỡi gà liền giúp ôm sát chân, tạo cảm giác chắc chắn.\r\n\r\nDây buộc tròn đặc trưng của dòng Yeezy giúp cố định giày tốt hơn.', 'Vệ sinh đúng cách: Dùng bàn chải mềm và dung dịch tẩy nhẹ để làm sạch phần mesh và da lộn. Không dùng nước quá nhiều vì có thể làm hỏng chất liệu.\r\nTránh tiếp xúc nước & bùn đất: Màu trắng dễ bẩn, nên dùng dung dịch bảo vệ giày (Water Repellent) trước khi sử dụng.\r\n Giữ form giày: Sử dụng shoe tree hoặc nhét giấy vào giày khi không sử dụng để giữ form chuẩn.\r\n Bảo quản nơi thoáng mát: Để giày trong hộp hoặc túi vải, tránh ánh nắng trực tiếp làm ố màu.', 40, 1350000, 1150000, 'products/SW8E52AEBN58nlkf6xh9Jk9tMItNGLItb3b8SHXU.webp', 0, 1, 0, 0, 0, '2025-03-28 03:08:53', '2025-04-13 14:27:05'),
(15, 1, 3, 'Nike Air Jordan 1 Low \"Washed Denim\"', 'DM8947-100', 'nike-air-jordan-1-low-washed-denim', 'Nike Air Jordan 1 Low \"Washed Denim\" là một phiên bản đặc biệt dành cho nữ, mang đến phong cách trẻ trung, năng động nhưng vẫn giữ được nét cá tính đặc trưng của dòng Jordan 1 Low. Với phần upper sử dụng chất liệu denim bạc màu (washed denim), đôi giày này tạo nên sự khác biệt đầy cuốn hút.', 'Thiết Kế Denim Độc Đáo & Phối Màu Trẻ Trung\r\n\r\nPhần upper sử dụng chất liệu denim bạc màu (Washed Denim) tạo hiệu ứng phai màu cá tính.\r\n\r\nKết hợp màu trắng tinh khiết và xanh denim giúp đôi giày dễ dàng phối đồ với nhiều phong cách khác nhau.\r\n\r\n Chất Liệu Cao Cấp – Êm Ái & Thoáng Khí\r\n\r\nDenim và da lộn kết hợp mang đến cảm giác mềm mại nhưng vẫn đảm bảo độ bền cao.\r\n\r\nLưỡi gà làm từ vải lưới giúp tăng khả năng thoáng khí, tạo sự thoải mái khi mang cả ngày.\r\n\r\n Bộ Đệm Êm Ái – Công Nghệ Air-Sole\r\n\r\nĐệm Air-Sole tích hợp trong đế giữa giúp giảm chấn động và mang lại cảm giác êm ái khi di chuyển.\r\n\r\nĐế cao su với họa tiết truyền thống giúp bám đường tốt, chống trơn trượt hiệu quả.\r\n\r\n Chi Tiết Logo Đặc Trưng\r\n\r\nLogo Jumpman thêu trên lưỡi gà tạo điểm nhấn thương hiệu.\r\n\r\nBiểu tượng Wings Logo ở gót giày, khẳng định chất lượng của dòng Air Jordan.', 'Vệ sinh cẩn thận: Sử dụng bàn chải mềm và dung dịch chuyên dụng để vệ sinh denim, không giặt bằng nước quá nhiều để tránh làm phai màu.\r\n Hạn chế tiếp xúc nước: Denim có thể bị ẩm và xuống cấp nếu gặp nước nhiều, nên sử dụng dung dịch bảo vệ giày (Water Repellent).\r\n Giữ form giày: Dùng shoe tree hoặc nhét giấy vào giày khi không sử dụng để giữ dáng chuẩn.\r\n Bảo quản nơi thoáng mát: Tránh ánh nắng trực tiếp để màu denim không bị phai nhanh.', 58, 3950000, 3650000, 'products/s2zKdxe6cFafvKRIgl2Ej5acHkMBsJcw04mEtmUY.jpg', 0, 1, 0, 0, 0, '2025-03-28 03:22:57', '2025-04-02 07:51:17'),
(16, 8, 6, 'Giày Louis Vuitton LV Trainer “Monogram Denim White Blue”', '1A9JGZ', 'giay-louis-vuitton-lv-trainer-monogram-denim-white-blue', 'Louis Vuitton LV Trainer \"Monogram Denim White Blue\" là một trong những phiên bản đặc biệt của dòng LV Trainer, được thiết kế bởi cố Giám đốc Sáng tạo Virgil Abloh. Đôi giày này mang đậm phong cách sang trọng, đẳng cấp nhưng vẫn giữ được tinh thần streetwear hiện đại, tạo nên sự pha trộn độc đáo giữa chất liệu denim monogram cổ điển của LV và kiểu dáng chunky thể thao.', 'Thiết Kế Monogram Denim Đẳng Cấp\r\n\r\nPhần upper sử dụng denim cao cấp in họa tiết Monogram LV, kết hợp với tone màu trắng – xanh navy đầy thanh lịch.\r\n\r\nĐường nét thiết kế lấy cảm hứng từ giày bóng rổ thập niên 90, nhưng được cách tân với form chunky hiện đại.\r\n\r\nChi tiết số “54” ở gót giày, tượng trưng cho năm thành lập Louis Vuitton (1854).\r\n\r\n Chất Liệu Cao Cấp & Hoàn Thiện Thủ Công\r\n\r\nUpper kết hợp denim, da bê cao cấp và da lộn, tạo cảm giác vừa sang trọng vừa bền bỉ.\r\n\r\nĐế giữa có phần đệm cao su mềm mại, giúp tăng cường độ êm ái khi di chuyển.\r\n\r\n Bộ Đế Êm Ái & Công Nghệ Hiện Đại\r\n\r\nĐế ngoài bằng cao su dẻo với họa tiết Monogram chìm, giúp tăng độ bám đường.\r\n\r\nCông nghệ cushioning tiên tiến, mang đến sự thoải mái khi mang cả ngày dài.\r\n\r\n Logo & Chi Tiết Tinh Tế\r\n\r\nLogo Louis Vuitton được in nổi ở lưỡi gà và mặt bên giày.\r\n\r\nLót giày mềm mại, có chữ ký của Virgil Abloh, tạo điểm nhấn đặc biệt.', NULL, 9, 42600000, 4150000, 'products/1hsndHKIW28rzeeBXKl8lto1JXgQaVCDJ5y3sIgk.webp', 0, 1, 0, 0, 1, '2025-03-28 03:47:37', '2025-04-04 12:01:25'),
(17, 8, 6, 'Giày Louis Vuitton LV Trainer 54 Signature White Gray', 'trainer5423', 'giay-louis-vuitton-lv-trainer-54-signature-white-gray', 'Louis Vuitton LV Trainer 54 Signature White Gray là phiên bản sneaker cao cấp, lấy cảm hứng từ giày bóng rổ thập niên 90 nhưng được thiết kế theo phong cách hiện đại và sang trọng. Với phối màu trắng – xám tinh tế, đôi giày này phù hợp với nhiều phong cách thời trang khác nhau, từ casual đến streetwear cao cấp.', 'Thiết Kế Lịch Lãm & Đậm Chất Thể Thao\r\n\r\nForm giày chunky, có đường nét sắc sảo, mang đậm phong cách basketball retro nhưng vẫn giữ vẻ thanh lịch.\r\n\r\nPhối màu trắng – xám trung tính giúp dễ dàng phối đồ trong nhiều hoàn cảnh.\r\n\r\nChi tiết số “54” ở gót giày, biểu tượng cho năm thành lập thương hiệu Louis Vuitton (1854).\r\n\r\n Chất Liệu Cao Cấp – Gia Công Tinh Xảo\r\n\r\nUpper bằng da bê cao cấp mềm mại nhưng vẫn bền bỉ, kết hợp với da lộn xám tạo điểm nhấn.\r\n\r\nĐường khâu thủ công \"Made in Italy\", thể hiện sự tỉ mỉ trong từng chi tiết.\r\n\r\nLót giày êm ái, giúp tăng độ thoải mái khi mang trong thời gian dài.\r\n\r\n Bộ Đế Êm Ái & Công Nghệ Hỗ Trợ Tốt\r\n\r\nĐế cao su chắc chắn, bám đường tốt, phù hợp cho cả di chuyển hàng ngày lẫn hoạt động nhẹ.\r\n\r\nCông nghệ cushioning tiên tiến, giúp giảm lực tác động lên chân, mang lại cảm giác thoải mái.\r\n\r\n Logo & Chi Tiết Độc Quyền\r\n\r\nLogo Louis Vuitton dập nổi trên lưỡi gà và mặt bên giày.\r\n\r\nHọa tiết Monogram LV chìm trên đế giày, tạo điểm nhấn tinh tế.\r\n\r\nChữ ký \"Louis Vuitton 54\" in bên hông giày, khẳng định dấu ấn đặc biệt của phiên bản này.', 'Vệ sinh đúng cách: Dùng khăn mềm lau nhẹ phần da, tránh sử dụng chất tẩy mạnh làm mất màu da.\r\n Tránh nước & độ ẩm cao: Da bê và da lộn dễ bị ảnh hưởng bởi nước, nên sử dụng dung dịch chống thấm chuyên dụng.\r\n Giữ form giày: Dùng shoe tree hoặc nhét giấy vào giày khi không sử dụng để tránh bị nhăn.\r\n Bảo quản nơi thoáng mát: Tránh ánh nắng trực tiếp để giữ màu sắc lâu bền.', 8, 2500000, 1700000, 'products/zO5QW20lpQJMD99qr7qmC0bqI6B61N3B6PM00vVS.jpg', 0, 1, 1, 0, 1, '2025-03-28 03:55:28', '2025-04-05 14:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_detail_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL DEFAULT '5',
  `review` text COLLATE utf8mb4_unicode_ci,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `order_detail_id`, `rating`, `review`, `is_approved`, `approved_at`, `created_at`, `updated_at`) VALUES
(4, 3, 17, 273, 5, 'ngfbhfgh', 0, NULL, '2025-04-20 16:48:43', '2025-04-20 16:48:43'),
(5, 3, 9, 274, 5, 'kgkghk', 0, NULL, '2025-04-20 16:57:29', '2025-04-20 16:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `prove_refunds`
--

CREATE TABLE `prove_refunds` (
  `id` bigint UNSIGNED NOT NULL,
  `return_order_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prove_refunds`
--

INSERT INTO `prove_refunds` (`id`, `return_order_id`, `image`, `video`, `created_at`, `updated_at`) VALUES
(11, 6, 'images_refund/lpZFlJpjzJSQK6ubGd8YSq40j6qO8PK1xvvEdrdm.gif', NULL, '2025-04-16 16:00:47', '2025-04-16 16:00:47'),
(12, 6, NULL, 'videos_refund/R2I9jyT1F7l1rHAe1hONVzIdiXm2BqiEIup3srQM.mp4', '2025-04-16 16:00:47', '2025-04-16 16:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `return_orders`
--

CREATE TABLE `return_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `refund_on` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_orders`
--

INSERT INTO `return_orders` (`id`, `order_id`, `user_id`, `reason`, `total_amount`, `refund_on`, `note`, `email`, `created_at`, `updated_at`) VALUES
(6, 329, 3, 'Khác với mô tả', '170000.00', 'MB/0987456678/LYTRUNGDUC', 'hàng lỗi đường chỉ', 'lytl130504@gmail.com', '2025-04-16 16:00:47', '2025-04-16 16:00:47');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'User', NULL, NULL, NULL),
(3, 'Staff', NULL, NULL, NULL),
(4, 'Accountant', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 4, 1, '2025-04-16 15:07:48', '2025-04-16 15:36:30'),
(8, 3, 1, '2025-04-16 17:00:54', '2025-04-23 15:21:33'),
(9, 2, 1, '2025-04-21 03:30:28', '2025-04-21 03:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `order_id`, `name`, `image`, `note`, `created_at`, `updated_at`) VALUES
(281, 326, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-15 17:39:23', '2025-04-15 17:39:23'),
(282, 327, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-15 17:40:01', '2025-04-15 17:40:01'),
(284, 329, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-15 17:41:33', '2025-04-15 17:41:33'),
(285, 329, 'Đơn hàng đã được thanh toán qua VNPAY', NULL, 'Đơn hàng đã được xác nhận', '2025-04-15 17:43:23', '2025-04-15 17:43:23'),
(286, 327, 'Đơn hàng đã được xác nhận', NULL, '', '2025-04-15 17:43:56', '2025-04-15 17:43:56'),
(287, 327, 'Chờ giao hàng', NULL, 'Đang chuẩn bị hàng gửi cho đơn vị vận chuyển', '2025-04-15 17:44:10', '2025-04-15 17:44:10'),
(288, 327, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-15 17:44:17', '2025-04-15 17:44:17'),
(289, 327, 'Giao hàng thành công', NULL, '', '2025-04-15 17:44:24', '2025-04-15 17:44:24'),
(298, 326, 'Đơn hàng đã được xác nhận', NULL, '', '2025-04-16 15:39:30', '2025-04-16 15:39:30'),
(300, 336, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-16 15:50:51', '2025-04-16 15:50:51'),
(301, 336, 'Đơn hàng đã được xác nhận', NULL, '', '2025-04-16 15:51:34', '2025-04-16 15:51:34'),
(303, 329, 'Chờ giao hàng', NULL, 'Đang đợi đơn vị vận chuyển đến lấy hàng', '2025-04-16 15:56:56', '2025-04-16 15:56:56'),
(304, 336, 'Chờ giao hàng', NULL, 'Đang đợi đơn vị vận chuyển đến lấy hàng', '2025-04-16 15:56:56', '2025-04-16 15:56:56'),
(305, 329, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-16 15:57:22', '2025-04-16 15:57:22'),
(306, 336, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-16 15:57:22', '2025-04-16 15:57:22'),
(307, 336, 'Giao hàng thành công', NULL, '', '2025-04-16 15:57:35', '2025-04-16 15:57:35'),
(308, 329, 'Giao hàng thành công', NULL, '', '2025-04-16 15:57:51', '2025-04-16 15:57:51'),
(309, 336, 'Đơn hàng đã được Xác nhận hoàn thành', NULL, '', '2025-04-16 15:58:18', '2025-04-16 15:58:18'),
(310, 329, 'Yêu cầu trả hàng', NULL, 'hàng lỗi đường chỉ', '2025-04-16 16:00:47', '2025-04-16 16:00:47'),
(311, 329, 'Yêu cầu trả hàng được xác nhận', NULL, 'Vui lòng đóng gói sản phẩm để gửi cho đơn vị vận chuyển', '2025-04-16 16:01:37', '2025-04-16 16:01:37'),
(312, 329, 'Kiểm tra hàng hoàn', NULL, 'Đang kiểm tra hàng hoàn', '2025-04-16 16:02:00', '2025-04-16 16:02:00'),
(313, 329, 'Đã hoàn tiền', 'Shipping/pTb1nQ8kp0jtEfB8oj33YJWLQdwiWugQ3IKajjH5.png', 'Đã hoàn tiền thành công', '2025-04-16 16:03:48', '2025-04-16 16:03:48'),
(314, 326, 'Chờ giao hàng', NULL, 'Đang đợi đơn vị vận chuyển đến lấy hàng', '2025-04-16 16:08:00', '2025-04-16 16:08:00'),
(315, 326, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-16 16:08:07', '2025-04-16 16:08:07'),
(316, 326, 'Giao hàng thành công', NULL, '', '2025-04-16 16:08:21', '2025-04-16 16:08:21'),
(317, 337, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-20 11:02:14', '2025-04-20 11:02:14'),
(318, 337, 'Đơn hàng đã được thanh toán qua VNPAY', NULL, 'Đơn hàng đã được xác nhận', '2025-04-20 11:03:38', '2025-04-20 11:03:38'),
(319, 338, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-20 11:09:47', '2025-04-20 11:09:47'),
(320, 338, 'Đơn hàng đã được thanh toán qua VNPAY', NULL, 'Đơn hàng đã được xác nhận', '2025-04-20 11:10:17', '2025-04-20 11:10:17'),
(321, 327, 'Đơn hàng đã được tự động xác nhận hoàn thành', NULL, 'Tự động xác nhận sau 3 ngày', '2025-04-20 14:09:13', '2025-04-20 14:09:13'),
(322, 326, 'Đơn hàng đã được tự động xác nhận hoàn thành', NULL, 'Tự động xác nhận sau 3 ngày', '2025-04-20 14:09:13', '2025-04-20 14:09:13'),
(323, 339, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-20 14:47:41', '2025-04-20 14:47:41'),
(324, 339, 'Đơn hàng đã được xác nhận', NULL, '', '2025-04-20 15:08:59', '2025-04-20 15:08:59'),
(325, 339, 'Chờ giao hàng', NULL, 'Đang chuẩn bị hàng gửi cho đơn vị vận chuyển', '2025-04-20 15:09:14', '2025-04-20 15:09:14'),
(326, 339, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-20 15:09:21', '2025-04-20 15:09:21'),
(327, 339, 'Giao hàng thành công', NULL, '', '2025-04-20 15:09:31', '2025-04-20 15:09:31'),
(328, 339, 'Đơn hàng đã được Xác nhận hoàn thành', NULL, '', '2025-04-20 16:19:06', '2025-04-20 16:19:06'),
(329, 338, 'Chờ giao hàng', NULL, 'Đang đợi đơn vị vận chuyển đến lấy hàng', '2025-04-21 03:33:28', '2025-04-21 03:33:28'),
(330, 340, 'Đơn hàng đang đợi được xác nhận', NULL, '', '2025-04-22 18:07:29', '2025-04-22 18:07:29'),
(331, 340, 'Đơn hàng đã được thanh toán qua VNPAY', NULL, 'Đơn hàng đã được xác nhận', '2025-04-22 18:08:01', '2025-04-22 18:08:01'),
(332, 337, 'Chờ giao hàng', NULL, 'Đang đợi đơn vị vận chuyển đến lấy hàng', '2025-04-22 18:10:43', '2025-04-22 18:10:43'),
(333, 340, 'Chờ giao hàng', NULL, 'Đang đợi đơn vị vận chuyển đến lấy hàng', '2025-04-22 18:10:43', '2025-04-22 18:10:43'),
(334, 340, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-22 18:11:09', '2025-04-22 18:11:09'),
(335, 340, 'Giao hàng thành công', NULL, '', '2025-04-22 18:11:15', '2025-04-22 18:11:15'),
(336, 337, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-22 18:11:46', '2025-04-22 18:11:46'),
(337, 338, 'Đang giao hàng', NULL, 'Đơn hàng sẽ sớm được giao, vui lòng để ý điện thoại', '2025-04-22 18:11:46', '2025-04-22 18:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code_sent_at` timestamp NULL DEFAULT NULL,
  `verification_code_expires_at` timestamp NULL DEFAULT NULL,
  `password_reset_sent_at` timestamp NULL DEFAULT NULL,
  `password_reset_expires_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`, `email`, `password`, `phone`, `remember_token`, `avatar`, `created_at`, `updated_at`, `verification_code`, `email_verified_at`, `verification_code_sent_at`, `verification_code_expires_at`, `password_reset_sent_at`, `password_reset_expires_at`, `is_admin`, `role_id`) VALUES
(2, 'Đức', NULL, 'duc130504@gmail.com', '$2y$12$QesoQFUoIOE3aklVAYte1usK2hEB61cgTHe374t2Jq29Axy68HgVm', NULL, NULL, 'avatars/30lRbFBLEjSBmc45WhrJGHRY8HoaVZDkLawzQqJO.webp', '2025-04-06 11:56:53', '2025-04-20 10:53:04', NULL, '2025-04-06 11:57:15', NULL, NULL, '2025-04-20 10:52:22', '2025-04-20 10:57:22', 0, 1),
(3, 'huy', NULL, 'lytl130504@gmail.com', '$2y$12$XJQQWcoo39XZ3/0Z2kblP.5BQtEx0u9/ZLhdySa0RutHVuZsZJzri', NULL, NULL, 'avatars/emjVWyietwrveMCPTNnZy7IqVdyEALKk7sT3vR6w.webp', '2025-04-06 11:57:50', '2025-04-06 11:58:17', NULL, '2025-04-06 11:58:17', NULL, NULL, NULL, NULL, 0, 2),
(4, 'Huyền', 'thanh hoa city', 'ducltph46032@fpt.edu.vn', '$2y$12$5ws879W2QCVgoxltg3T3GuchuPq9S9Gxhkh1/BY63LK9iTxX2Nfqi', '0388 838 472', NULL, 'avatars/yADSbadYAmzGiy11hjc6DqcmaUzGc2JrxiAfjWfM.webp', '2025-04-06 14:04:59', '2025-04-06 14:05:24', NULL, '2025-04-06 14:05:24', NULL, NULL, NULL, NULL, 0, 3),
(7, 'khải', NULL, 'ly7040491@gmail.com', '$2y$12$M6snC7woXZWVT2jZlBcxgeCbO6gv88tR/GO.Iq5QdZg4IzpWrmZPS', NULL, NULL, 'avatars/e5M1TKpdty4Jt6z98nX3lYQT3vSmdjORIJoTZDps.webp', '2025-04-20 10:07:20', '2025-04-20 10:58:51', NULL, '2025-04-20 10:58:51', NULL, NULL, NULL, NULL, 0, 2),
(8, 'Trường', NULL, 'truongdt12398@gmail.com', '$2y$12$1/dsjdaX/eMNO2pMXx5DkeXw/n2kded5KP4wF/9oLdbhIc5NvwCLS', NULL, NULL, 'avatars/MpvAjr68ZtQ4jhph87GOVw25p3Zbex0r9kZSVo19.gif', '2025-04-20 11:05:57', '2025-04-20 11:07:30', NULL, '2025-04-20 11:07:30', NULL, NULL, NULL, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `wholesale_price` decimal(15,2) DEFAULT NULL,
  `selling_price` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `product_id`, `sku`, `image`, `quantity`, `wholesale_price`, `selling_price`, `created_at`, `updated_at`) VALUES
(4, 4, 'mlb1', 'varians/lNqK58vEEU3tdVZYzapUIA8cwIgPJWYndv6R4VK5.jpg', 118, '1500000.00', '1300000.00', '2025-03-15 14:36:12', '2025-03-29 16:27:27'),
(5, 4, 'mlb2', 'variants/Bm89nysxG72PwMK7eCxhIkmtTGL0KUmRygOVmrWI.webp', 1294, '0.00', '1500000.00', '2025-03-15 14:49:34', '2025-04-20 11:09:47'),
(6, 5, 'puma1', 'varians/Oyd7pYRSZSKRVoGzAv0IjvUsHTg0P1b4cdS5VFV6.webp', 22, '2300000.00', '2000000.00', '2025-03-15 14:55:11', '2025-04-02 07:22:09'),
(7, 5, 'puma2', 'varians/SLhoWOeRp632vwYcDbICVVxFpoWvk13TaSJS5Bc9.webp', 900, '0.00', '1300000.00', '2025-03-15 14:55:11', '2025-03-15 14:55:11'),
(8, 6, 'nike1.1', 'varians/cF1CfhOCxjB4qYzQPiUBPS46AAB2fLL2ah4HvQjk.webp', 96, NULL, NULL, '2025-03-18 15:41:30', '2025-04-02 03:23:00'),
(9, 6, 'nike1.2', 'variants/zOXk1Hk2y7687TLEw5nGM07Ok67MtsVlkkGyZMXH.webp', 45, NULL, NULL, '2025-03-18 15:57:21', '2025-03-18 15:57:21'),
(14, 8, 'air1', 'variants/zwBDuOJBgfPZHm1Q7Wk4ewGqOkJAUeCZIXpgwSzi.png', 37, NULL, NULL, '2025-03-26 15:49:50', '2025-04-16 13:48:40'),
(15, 10, 'jd1', 'varians/L0Hj1U73pCf1pU6AGcVIY1trPbtIhobKGMrtAdlZ.jpg', 98, NULL, NULL, '2025-03-26 16:08:57', '2025-04-16 13:56:22'),
(16, 11, 'js1.paris', 'varians/YFtAIZV3X62mHjT0qi75dgi2xpOzWrtyiVyFCYZY.jpg', 57, NULL, NULL, '2025-03-26 16:19:57', '2025-04-22 18:07:29'),
(17, 12, 'full.white', 'varians/SH8B3Lco9Xrvyxk0aQyZDrF4RpD1vrdrJ4czMnKy.jpg', 27, NULL, NULL, '2025-03-26 16:27:15', '2025-04-16 13:46:30'),
(18, 13, 'yz700.1', 'varians/uwr91l0THgywQ9fX67mZHY3YD46UDZZCEL9B5dBo.webp', 13, NULL, NULL, '2025-03-28 03:08:53', '2025-04-15 03:48:43'),
(19, 13, 'yz700.2', 'varians/OyihGoE79TK8Ve21m9JK41CN6bdrSNkzdRQbcxkS.webp', 20, NULL, NULL, '2025-03-28 03:08:54', '2025-03-28 03:08:54'),
(22, 7, 'rb.v62', 'variants/MizbVnKT2lR0jwvxLL7Lq6NV0KdmLYOe6PmbnOnZ.webp', 20, NULL, NULL, '2025-03-28 03:16:08', '2025-04-20 11:02:14'),
(23, 15, 'Washed.12', 'varians/BiEjnFbtElndoVc1KN10kZ4h4RwtnYg3XzJFzDT5.jpg', 6, NULL, NULL, '2025-03-28 03:22:57', '2025-04-13 14:43:03'),
(24, 15, 'Washed.13', 'varians/x5OyVnfi7uBA06rFVTHsRE9QYY5Cp7o4OhD3jK3G.jpg', 47, NULL, NULL, '2025-03-28 03:22:57', '2025-04-13 14:54:14'),
(25, 16, 'LV Trainer.21', 'varians/PKr8mu8kNwqsbhwWzWjkSy6iElaCUJjk1RJtrjz6.webp', 7, NULL, NULL, '2025-03-28 03:47:37', '2025-04-09 16:07:45'),
(26, 17, 'LV Trainer.432', 'varians/nO1n7DvlUOIcdlFLtwUP1zszfdOeuDYLeBqfrISB.jpg', 29, NULL, NULL, '2025-03-28 03:55:28', '2025-04-20 14:47:41'),
(28, 17, 'lv22', 'variants/utCZD411jFCXhcCzrkLnDNpX15lNLe8XN7dQ8hUV.jpg', 60, NULL, NULL, '2025-04-05 01:48:49', '2025-04-05 12:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `variant_attributes`
--

CREATE TABLE `variant_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `variant_id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `attribute_value_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variant_attributes`
--

INSERT INTO `variant_attributes` (`id`, `variant_id`, `attribute_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(88, 4, 5, 10, '2025-03-29 12:57:24', '2025-03-29 12:57:24'),
(89, 4, 6, 14, '2025-03-29 12:57:24', '2025-03-29 12:57:24'),
(90, 5, 5, 12, '2025-03-29 12:57:24', '2025-03-29 12:57:24'),
(91, 5, 6, 15, '2025-03-29 12:57:24', '2025-03-29 12:57:24'),
(98, 8, 5, 11, '2025-03-29 13:15:33', '2025-03-29 13:15:33'),
(99, 8, 6, 16, '2025-03-29 13:15:33', '2025-03-29 13:15:33'),
(100, 9, 5, 12, '2025-03-29 13:15:33', '2025-03-29 13:15:33'),
(101, 9, 6, 15, '2025-03-29 13:15:33', '2025-03-29 13:15:33'),
(121, 23, 6, 19, '2025-04-02 07:51:17', '2025-04-02 07:51:17'),
(122, 24, 6, 15, '2025-04-02 07:51:17', '2025-04-02 07:51:17'),
(131, 16, 5, 20, '2025-04-02 07:55:36', '2025-04-02 07:55:36'),
(132, 16, 6, 19, '2025-04-02 07:55:36', '2025-04-02 07:55:36'),
(135, 14, 6, 17, '2025-04-02 07:56:17', '2025-04-02 07:56:17'),
(136, 22, 6, 17, '2025-04-02 07:56:32', '2025-04-02 07:56:32'),
(169, 25, 5, 13, '2025-04-06 15:57:04', '2025-04-06 15:57:04'),
(170, 25, 6, 14, '2025-04-06 15:57:04', '2025-04-06 15:57:04'),
(179, 17, 5, 10, '2025-04-13 14:02:24', '2025-04-13 14:02:24'),
(180, 17, 6, 16, '2025-04-13 14:02:24', '2025-04-13 14:02:24'),
(193, 18, 5, 10, '2025-04-13 14:27:05', '2025-04-13 14:27:05'),
(194, 18, 6, 19, '2025-04-13 14:27:05', '2025-04-13 14:27:05'),
(195, 19, 6, 17, '2025-04-13 14:27:05', '2025-04-13 14:27:05'),
(196, 6, 5, 11, '2025-04-13 14:27:20', '2025-04-13 14:27:20'),
(197, 6, 6, 16, '2025-04-13 14:27:20', '2025-04-13 14:27:20'),
(198, 7, 5, 10, '2025-04-13 14:27:20', '2025-04-13 14:27:20'),
(199, 7, 6, 17, '2025-04-13 14:27:20', '2025-04-13 14:27:20'),
(200, 15, 5, 18, '2025-04-13 16:13:01', '2025-04-13 16:13:01'),
(201, 15, 6, 19, '2025-04-13 16:13:01', '2025-04-13 16:13:01'),
(202, 26, 5, 10, '2025-04-20 13:40:01', '2025-04-20 13:40:01'),
(203, 26, 6, 15, '2025-04-20 13:40:01', '2025-04-20 13:40:01'),
(204, 28, 5, 12, '2025-04-20 13:40:01', '2025-04-20 13:40:01'),
(205, 28, 6, 16, '2025-04-20 13:40:01', '2025-04-20 13:40:01');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` enum('percentage','fixed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` decimal(15,2) NOT NULL,
  `min_order_value` decimal(15,2) DEFAULT NULL,
  `max_discount_value` decimal(15,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL COMMENT 'Số lượng voucher còn lại',
  `status` enum('active','expired','disabled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `code`, `name`, `discount_type`, `discount_value`, `min_order_value`, `max_discount_value`, `quantity`, `status`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(4, 'mxx1', 'ngày 8-3', 'fixed', '50000.00', '400000.00', NULL, 12, 'active', '2025-03-19', '2025-04-24', '2025-03-20 16:14:03', '2025-04-16 15:50:59'),
(5, 'max', 'thiếu nhi', 'percentage', '90.00', '1300000.00', '1000000.00', 14, 'active', '2025-03-19', '2025-03-21', '2025-03-20 16:31:38', '2025-03-20 16:53:36'),
(6, 'sp3', 'nguyy', 'fixed', '500000.00', '1000000.00', NULL, 12, 'active', '2025-03-28', '2025-04-24', '2025-03-29 16:26:54', '2025-04-16 13:53:45'),
(7, 'sp22', 'ngayvui', 'fixed', '150000.00', '350000.00', NULL, 31, 'active', '2025-04-04', '2025-04-07', '2025-04-05 05:11:58', '2025-04-05 05:11:58'),
(9, 'hht', 'mkl', 'fixed', '500000.00', '1500000.00', NULL, 20, 'active', '2025-04-06', '2025-04-22', '2025-04-07 11:52:24', '2025-04-16 13:46:33'),
(10, '34', 'h6', 'percentage', '90.00', '100000.00', '2000000.00', 12, 'active', '2025-04-06', '2025-04-26', '2025-04-07 15:45:12', '2025-04-16 13:45:58'),
(11, 'llk', 'mad', 'percentage', '50.00', '300000.00', '2300000.00', 48, 'active', '2025-04-06', '2025-04-23', '2025-04-07 15:50:14', '2025-04-15 17:40:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_details_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_details_product_id_foreign` (`product_id`),
  ADD KEY `cart_details_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_news`
--
ALTER TABLE `create_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`);

--
-- Indexes for table `has_role_permission`
--
ALTER TABLE `has_role_permission`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `has_role_permission_role_id_foreign` (`role_id`);

--
-- Indexes for table `image_galleries`
--
ALTER TABLE `image_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_galleries_product_id_foreign` (`product_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_id_variant_foreign` (`id_variant`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_room_id_foreign` (`room_id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_variant_id_foreign` (`variant_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_order_id_foreign` (`order_detail_id`);

--
-- Indexes for table `prove_refunds`
--
ALTER TABLE `prove_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prove_refunds_return_order_id_foreign` (`return_order_id`);

--
-- Indexes for table `return_orders`
--
ALTER TABLE `return_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_orders_order_id_foreign` (`order_id`),
  ADD KEY `return_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_user_id_foreign` (`user_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variants_sku_unique` (`sku`),
  ADD KEY `variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `variant_attributes`
--
ALTER TABLE `variant_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variant_attributes_variant_id_foreign` (`variant_id`),
  ADD KEY `variant_attributes_attribute_id_foreign` (`attribute_id`),
  ADD KEY `variant_attributes_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vouchers_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `create_news`
--
ALTER TABLE `create_news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `image_galleries`
--
ALTER TABLE `image_galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prove_refunds`
--
ALTER TABLE `prove_refunds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `return_orders`
--
ALTER TABLE `return_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `variant_attributes`
--
ALTER TABLE `variant_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_details_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `has_role_permission`
--
ALTER TABLE `has_role_permission`
  ADD CONSTRAINT `has_role_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `has_role_permission_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `image_galleries`
--
ALTER TABLE `image_galleries`
  ADD CONSTRAINT `image_galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_id_variant_foreign` FOREIGN KEY (`id_variant`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_order_id_foreign` FOREIGN KEY (`order_detail_id`) REFERENCES `order_details` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `prove_refunds`
--
ALTER TABLE `prove_refunds`
  ADD CONSTRAINT `prove_refunds_return_order_id_foreign` FOREIGN KEY (`return_order_id`) REFERENCES `return_orders` (`id`);

--
-- Constraints for table `return_orders`
--
ALTER TABLE `return_orders`
  ADD CONSTRAINT `return_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `return_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `variants`
--
ALTER TABLE `variants`
  ADD CONSTRAINT `variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `variant_attributes`
--
ALTER TABLE `variant_attributes`
  ADD CONSTRAINT `variant_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`),
  ADD CONSTRAINT `variant_attributes_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`),
  ADD CONSTRAINT `variant_attributes_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
