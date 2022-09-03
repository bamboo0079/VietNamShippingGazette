-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2022 at 04:30 AM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shipping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@gmail.com', '2022-07-05 01:47:29', '$2y$10$9jb9UBph1M9cf4nbFdyBleTRR4Po/wjoES7W7Knm5.iviAh86BzsO', NULL, NULL, '2022-07-05 01:47:33', '2022-07-05 01:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `agent_nm_vn` varchar(1024) DEFAULT NULL,
  `agent_nm_en` varchar(1024) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agent_nm_vn`, `agent_nm_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WANHAI LINES VIETNAM', 'WANHAI LINES VIETNAM', 1, '2022-07-05 04:00:48', '2022-08-07 05:58:30'),
(2, 'INTERASIA HERITAGE', 'INTERASIA HERITAGE', 1, '2022-07-04 23:04:23', '2022-08-07 05:58:10'),
(3, 'WANHAI LINES VIETNAM', 'WANHAI LINES VIETNAM', 1, '2022-08-07 05:57:48', '2022-08-18 04:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name_vn` varchar(1024) DEFAULT NULL,
  `name_en` varchar(1024) DEFAULT NULL,
  `show_menu` tinyint(4) DEFAULT '1',
  `order` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '1' COMMENT '1: tin tuc;2:giao thuong;3: tuyen dung',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_vn`, `name_en`, `show_menu`, `order`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Sự Kiện', 'Events', 0, 0, 1, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(2, 'Bảng Tin VSG', 'Shipping Gazette Viet Name News', 0, 0, 1, NULL, '2022-07-03 02:29:01', '2022-07-04 21:40:16'),
(3, 'Yêu Cầu Báo Giá', 'Request a quote', 1, 2, 2, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(4, 'Chào Mua', 'For Buy', 1, 3, 2, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(5, 'Chào Bán', 'For Sell', 1, 4, 2, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(6, 'Tin Đường Bộ', 'Road News', 0, 5, 1, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(7, 'Tin Xuất Nhập Khẩu', 'Import Export News', 0, 6, 1, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(8, 'Tin Ga - Cảng - Cửa Khẩu', 'News Station - Port - Border Gate', 0, 7, 1, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(9, 'Tin Đầu Tư', 'Investment News', 0, 8, 1, NULL, '2022-07-03 02:29:01', '2022-07-03 02:29:02'),
(10, 'Tin Khác', 'Other News', 1, 9, 1, '2022-08-23 16:06:22', '2022-07-03 02:29:01', '2022-08-23 16:06:22'),
(12, 'Logictics', 'Logictics', 1, 1, 1, NULL, '2022-07-03 02:29:01', '2022-07-04 21:29:24'),
(13, 'Chuỗi Cung Ứng', 'Supply Chain', 1, 2, 1, NULL, '2022-07-03 02:29:01', '2022-08-18 15:58:01'),
(14, 'Xuất Nhập Khẩu', 'Import Export News', 1, 3, 1, NULL, '2022-07-03 02:29:01', '2022-08-18 15:57:50'),
(15, 'Hàng Không', 'Aircraft', 1, 4, 1, NULL, '2022-07-03 02:29:01', '2022-08-18 15:57:41'),
(16, 'Hàng Hải', 'Shipping', 1, 5, 1, NULL, '2022-07-03 02:29:01', '2022-08-18 15:57:34'),
(17, 'Tuyển dụng', 'Recruitments', 0, 1, 3, NULL, '2022-07-03 02:29:01', '2022-08-07 05:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(12) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `title` varchar(1024) DEFAULT NULL,
  `content` longtext,
  `is_read` tinyint(4) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `name`, `phone`, `title`, `content`, `is_read`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'trongsau.info@gmail.com', 'Sáu Nguyễn Trọng', '0908940948', '111', '222', 0, NULL, '2022-07-30 18:36:14', '2022-07-30 18:36:14'),
(2, 'trongsau.info@gmail.com', 'Sáu Nguyễn Trọng', '0908940948', '111', '222', 0, NULL, '2022-07-30 18:36:30', '2022-07-30 18:36:30'),
(3, 'minhnhut0079@gmail.com', 'NGUYEN MINH NHUT', '0969411898', 'Hỏi về báo giá sản phẩm', 'Tôi cần báo giá sản phẩm', 0, NULL, '2022-08-07 05:12:39', '2022-08-07 05:12:39'),
(4, 'letriphuc18@gmail.com', 'Lê Trí Phúc', '0944304612', 'abcd', 'efghijklmn', 0, NULL, '2022-08-18 04:28:43', '2022-08-18 04:28:43'),
(5, 'minhnhut0079@gmail.com', 'NGUYEN MINH NHUT', '0969411898', 'Cần đăng tin báo giá', 'Tôi cần hỏi về cách đăng tin báo giá', 1, NULL, '2022-08-18 15:20:37', '2022-08-18 16:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(12) NOT NULL,
  `country_nm_vn` varchar(1024) DEFAULT NULL,
  `country_nm_en` varchar(1024) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_nm_vn`, `country_nm_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Việt Nam', 'Viet Nam', 1, '2022-07-04 23:28:36', '2022-07-04 23:29:07'),
(2, 'Singapore', 'Singapore', 1, '2022-07-04 23:29:19', '2022-07-04 23:29:19'),
(3, 'Lào', 'Lao', 1, '2022-07-04 23:29:56', '2022-07-04 23:29:56'),
(4, 'Trung Quốc', 'China', 1, '2022-08-07 05:24:00', '2022-08-07 05:24:00'),
(5, 'Nhật Bản', 'JAPAN', 1, '2022-08-07 05:24:16', '2022-08-07 05:24:16'),
(6, 'NEW ZEALEN', 'NEW ZEALEN', 1, '2022-08-07 05:24:41', '2022-08-07 05:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `phone`, `block`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Sáu Nguyễn Trọng', 'trongsau.info@gmail.com', '0908940948', '0', '2022-07-30 20:48:03', '4297f44b13955235245b2497399d7a93', '2022-07-30 22:48:03', '2022-07-30 22:48:03'),
(2, 'Nguyễn Minh Nhưt', 'minhnhut0079@gmail.com', '0969411898', '0', '2022-08-07 02:35:52', '8c50f39e32986f69c4f210b40e0be29c', '2022-08-07 04:35:52', '2022-08-07 04:35:52'),
(3, 'Lê Trí Phúc', 'letriphuc18@gmail.com', '0944304612', '0', '2022-08-18 00:48:35', '4209ab3be9524adade3ed952ba26b21b', '2022-08-18 02:48:35', '2022-08-18 02:48:35'),
(5, 'Tran Van Tien', 'vantien@gmail.com', '0969411898', '0', '2022-08-18 12:32:32', 'e10adc3949ba59abbe56e057f20f883e', '2022-08-18 14:32:32', '2022-08-18 14:32:32'),
(6, 'Nguyen Minh Nhut', 'minhnhut0079@gmai.com', '098989898', '0', '2022-08-23 11:42:58', '8c50f39e32986f69c4f210b40e0be29c', '2022-08-23 13:42:58', '2022-08-23 13:42:58'),
(7, 'Thái Phương Nam', 'namabc@gmail.com', '090909009', '0', '2022-08-29 13:24:24', '4297f44b13955235245b2497399d7a93', '2022-08-29 15:24:24', '2022-08-29 15:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(12) NOT NULL,
  `category_id` int(12) DEFAULT '0',
  `product_category_id` int(12) DEFAULT '0',
  `img` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `title_vn` varchar(1024) DEFAULT NULL,
  `title_en` varchar(1024) DEFAULT NULL,
  `youtube_url` varchar(1024) DEFAULT NULL,
  `content_vn` longtext,
  `content_en` longtext,
  `approved` int(1) DEFAULT '1',
  `is_hot` int(1) DEFAULT '0',
  `is_new` int(1) DEFAULT '0',
  `is_paid` int(1) DEFAULT '0',
  `member_id` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category_id`, `product_category_id`, `img`, `price`, `title_vn`, `title_en`, `youtube_url`, `content_vn`, `content_en`, `approved`, `is_hot`, `is_new`, `is_paid`, `member_id`, `created_at`, `updated_at`) VALUES
(109, 12, 0, '/certificates/HTy0ImX9UEeDe5f8kchAzSCHtYno4k8qheSFWqbf.jpeg', NULL, '[VN]MSC Tessa phá kỷ lục tàu container lớn nhất thế giới với sức chở 24.116 TEU', '[EN]MSC Tessa phá kỷ lục tàu container lớn nhất thế giới với sức chở 24.116 TEU', NULL, '<p>[VN] Nhà máy đóng tàu Hudong Zhonghua (Hudong-Zhonghua Shipbuilding (Group) Co Ltd) của Trung Quốc đang tăng cường thêm số chỗ container trong các thiết kế cho loại tàu megamax của mình để phá vỡ các kỷ lục mới về kích thước trong vận tải container.</p><p>Tàu MSC Tessa đã được hạ thủy tại Nhà máy đóng tàu Trường Hưng Giang Nam trong tuần này. Mặc dù có cùng kích thước với tàu Ever Alot, con tàu đầu tiên trên thế giới đạt mốc 24.000 TEU. Tàu vận chuyển container mới sẽ đạt kỷ lục mới khi có thêm 112 chỗ. Tàu MSC Tessa có sức chở 24.116 TEU.</p><p>Tàu MSC Tessa dài 399,99 m là một trong bốn tàu của hãng tàu MSC (Mediterranean Shipping Co) đã đặt hàng tại nhà máy đóng tàu thuộc Tổng công ty Đóng tàu Nhà nước Trung Quốc (CSSC).</p><p>Theo CSSC, số chỗ được bổ sung cho loại tàu container đóng tại nhà máy Hudong Zhonghua so với tàu Ever Alot, được chế tạo bởi cùng một nơi, đã đạt được tối ưu hóa về cấu trúc và cột radar, theo CSSC.</p><p>Các kỷ lục về kích thước tàu chở hàng bằng container đã nhiều lần bị phá vỡ trong những năm gần đây, lần đầu tiên vượt lên trên mốc 20.000 TEU vào năm 2017. Các tàu container đã tăng hơn gấp ba lần về kích thước về khả năng chuyên chở kể từ đầu thế kỷ này.</p>', '<p>Nhà máy đóng tàu Hudong Zhonghua (Hudong-Zhonghua Shipbuilding (Group) Co Ltd) của Trung Quốc đang tăng cường thêm số chỗ container trong các thiết kế cho loại tàu megamax của mình để phá vỡ các kỷ lục mới về kích thước trong vận tải container.</p><p>[EN] Tàu MSC Tessa đã được hạ thủy tại Nhà máy đóng tàu Trường Hưng Giang Nam trong tuần này. Mặc dù có cùng kích thước với tàu Ever Alot, con tàu đầu tiên trên thế giới đạt mốc 24.000 TEU. Tàu vận chuyển container mới sẽ đạt kỷ lục mới khi có thêm 112 chỗ. Tàu MSC Tessa có sức chở 24.116 TEU.</p><p>Tàu MSC Tessa dài 399,99 m là một trong bốn tàu của hãng tàu MSC (Mediterranean Shipping Co) đã đặt hàng tại nhà máy đóng tàu thuộc Tổng công ty Đóng tàu Nhà nước Trung Quốc (CSSC).</p><p>Theo CSSC, số chỗ được bổ sung cho loại tàu container đóng tại nhà máy Hudong Zhonghua so với tàu Ever Alot, được chế tạo bởi cùng một nơi, đã đạt được tối ưu hóa về cấu trúc và cột radar, theo CSSC.</p><p>Các kỷ lục về kích thước tàu chở hàng bằng container đã nhiều lần bị phá vỡ trong những năm gần đây, lần đầu tiên vượt lên trên mốc 20.000 TEU vào năm 2017. Các tàu container đã tăng hơn gấp ba lần về kích thước về khả năng chuyên chở kể từ đầu thế kỷ này.</p>', 1, 1, 1, 0, 0, '2022-08-07 04:54:41', '2022-08-07 04:54:41'),
(110, 13, 0, '/certificates/QBUXAN0UvcNMmkLyHrulBCgtNNP16DQxj14YreUl.jpeg', NULL, '[VN] CHUỖI CUNG ỨNG LÀ GÌ? CÁCH VẬN HÀNH CHUỖI CUNG ỨNG HIỆU QUẢ', '[EN] CHUỖI CUNG ỨNG LÀ GÌ? CÁCH VẬN HÀNH CHUỖI CUNG ỨNG HIỆU QUẢ', NULL, '<p>Chuỗi cung ứng (Supply Chain) là một hệ thống những tổ chức, hoạt động, thông tin, con người và các nguồn lực liên quan trực tiếp hay gián tiếp đến vận chuyển hàng hóa hay dịch vụ từ nhà sản xuất, nhà cung cấp đến tay người tiêu dùng. Chuỗi cung ứng không chỉ bao gồm nhà sản xuất, nhà cung cấp mà còn liên quan đến nhà vận chuyển, nhà kho, nhà bán lẻ và khách hàng.</p><p>Chuỗi cung ứng của một công ty là bao gồm những phòng ban trong công ty (phòng marketing, phòng kinh doanh, phòng hậu cần, phòng dịch vụ khách hàng,…). Các phòng ban này sẽ được liên kết chặt chẽ với nhau, để cùng đi đến mục đích là đáp ứng những nhu cầu của khách hàng.</p><p><img src=\"/certificates/yLuDtNIjviBWkyd4rHJ4kzf89OXN0IIYdPJFiMta.jpeg\" style=\"width: 626px;\"></p><p>CHUỖI CUNG ỨNG GỒM NHỮNG THÀNH PHẦN NÀO?</p><p>Một chuỗi cung ứng hoàn chỉnh được cấu tạo từ 5 thành phần cơ bản. Sau đây là 5 thành phần cấu tạo nên một chuỗi cung ứng.</p><p>Nhà cung cấp nguyên liệu thô</p><p>Một nhà cung cấp nguyên liệu thô được xem là một phần quan trọng trong 1 chuỗi cung ứng, vì có nguyên liệu thì mới có thể sản xuất.</p><p>Nhà sản xuất</p><p>Nếu ta chỉ có nguyên liệu thô thì không thể nào bán được cho khách hàng, vì thế một nhà sản xuất sẽ giúp ta hoàn thiện những nguyên liệu thô đó thành một thành phẩm. Nhà cung cấp nguyên liệu thô và nhà sản xuất có mối liên kết chặt chẽ với nhau, một trong 2 nhà gặp trục trặc sẽ ảnh hưởng đến một chuỗi cung ứng.</p><p>Nhà phân phố</p><p>Sau khi đã có được sản phẩm, một mình chúng ta sẽ không thể nào đưa sản phẩm đến tay từng khách hàng. Một nhà phân phối sẽ giúp chúng ta làm việc này.</p><p>Một nhà phân phối cũng không thể nào đưa sản phẩm đến được tất cả khách hàng trên thị trường. Vì họ thường giao hàng hóa với số lượng nhiều, ít khi bán lẻ cho khách hàng. Vì vậy thường các nhà phân phối sẽ liên kết với đại lý bán lẻ (tạp hóa, siêu thị, cửa hàng tiện lợi,…) của họ đến phân phối hàng hóa đến tay người dùng.</p><p>Đại lý bán l</p><p>Đại lý bán lẻ sẽ có nhiệm vụ bán lẻ các hàng hóa đó cho người dùng, họ thường sẽ nhập một lượng lớn hàng hóa trong tồn kho, sau đó sẽ bán lẻ cho từng khách hàng. Ví dụ: các tạp hóa, siêu thị, cửa hàng tiện lợi,…</p><p>Khách hàn</p><p>Khách hàng sẽ là người cuối cùng tiêu thụ hàng hóa. Khách hàng cũng có thể mua hàng tại nhà phân phối nếu họ mua với số lượng nhiều, nhưng tỉ lệ này khá thấp. Đa số họ chỉ mua hàng tại các đại lý bán lẻ, và nhà phân phối họ cũng ít khi bán hàng cho khách hàng lẻ.</p><p>Với 5 thành phần này, cứ xoay vòng sẽ tạo thành một chuỗi cung ứng như hiện nay.</p>', '<p>Chuỗi cung ứng (Supply Chain) là một hệ thống những tổ chức, hoạt động, thông tin, con người và các nguồn lực liên quan trực tiếp hay gián tiếp đến vận chuyển hàng hóa hay dịch vụ từ nhà sản xuất, nhà cung cấp đến tay người tiêu dùng. Chuỗi cung ứng không chỉ bao gồm nhà sản xuất, nhà cung cấp mà còn liên quan đến nhà vận chuyển, nhà kho, nhà bán lẻ và khách hàng.</p><p>Chuỗi cung ứng của một công ty là bao gồm những phòng ban trong công ty (phòng marketing, phòng kinh doanh, phòng hậu cần, phòng dịch vụ khách hàng,…). Các phòng ban này sẽ được liên kết chặt chẽ với nhau, để cùng đi đến mục đích là đáp ứng những nhu cầu của khách hàng.</p><p><img src=\"http://128.199.138.195/certificates/yLuDtNIjviBWkyd4rHJ4kzf89OXN0IIYdPJFiMta.jpeg\" style=\"width: 626px;\"></p><p>CHUỖI CUNG ỨNG GỒM NHỮNG THÀNH PHẦN NÀO?</p><p>Một chuỗi cung ứng hoàn chỉnh được cấu tạo từ 5 thành phần cơ bản. Sau đây là 5 thành phần cấu tạo nên một chuỗi cung ứng.</p><p>Nhà cung cấp nguyên liệu thô</p><p>Một nhà cung cấp nguyên liệu thô được xem là một phần quan trọng trong 1 chuỗi cung ứng, vì có nguyên liệu thì mới có thể sản xuất.</p><p>Nhà sản xuất</p><p>Nếu ta chỉ có nguyên liệu thô thì không thể nào bán được cho khách hàng, vì thế một nhà sản xuất sẽ giúp ta hoàn thiện những nguyên liệu thô đó thành một thành phẩm. Nhà cung cấp nguyên liệu thô và nhà sản xuất có mối liên kết chặt chẽ với nhau, một trong 2 nhà gặp trục trặc sẽ ảnh hưởng đến một chuỗi cung ứng.</p><p>Nhà phân phố</p><p>Sau khi đã có được sản phẩm, một mình chúng ta sẽ không thể nào đưa sản phẩm đến tay từng khách hàng. Một nhà phân phối sẽ giúp chúng ta làm việc này.</p><p>Một nhà phân phối cũng không thể nào đưa sản phẩm đến được tất cả khách hàng trên thị trường. Vì họ thường giao hàng hóa với số lượng nhiều, ít khi bán lẻ cho khách hàng. Vì vậy thường các nhà phân phối sẽ liên kết với đại lý bán lẻ (tạp hóa, siêu thị, cửa hàng tiện lợi,…) của họ đến phân phối hàng hóa đến tay người dùng.</p><p>Đại lý bán l</p><p>Đại lý bán lẻ sẽ có nhiệm vụ bán lẻ các hàng hóa đó cho người dùng, họ thường sẽ nhập một lượng lớn hàng hóa trong tồn kho, sau đó sẽ bán lẻ cho từng khách hàng. Ví dụ: các tạp hóa, siêu thị, cửa hàng tiện lợi,…</p><p>Khách hàn</p><p>Khách hàng sẽ là người cuối cùng tiêu thụ hàng hóa. Khách hàng cũng có thể mua hàng tại nhà phân phối nếu họ mua với số lượng nhiều, nhưng tỉ lệ này khá thấp. Đa số họ chỉ mua hàng tại các đại lý bán lẻ, và nhà phân phối họ cũng ít khi bán hàng cho khách hàng lẻ.</p><p>Với 5 thành phần này, cứ xoay vòng sẽ tạo thành một chuỗi cung ứng như hiện nay.</p>', 1, 1, 1, 1, 0, '2022-08-07 04:58:00', '2022-08-07 04:58:00'),
(111, 14, 0, '/certificates/bK4aHw1CVoS9wH4kx9XqCne35gK3ztUbHRR0RBxg.jpeg', NULL, '[VN] Thêm nhiều tuyến vận tải mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc', '[EN] Thêm nhiều tuyến vận tải mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc', NULL, '<div class=\"article-detail-desc f2 fw lt clearfix\" style=\"margin: 0px 0px 15px; padding: 0px; width: 710px; float: left; font-family: Arial, sans-serif; font-weight: 600; font-size: 18px;\">Nhiều chuyến tàu vận tải tuyến quốc tế vừa cập hệ thống cảng của Tổng công ty Tân cảng Sài Gòn, mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc.</div><div class=\"__MASTERCMS_CONTENT fw lt f2 mb clearfix\" style=\"margin: 0px 0px 15px; padding: 0px; width: 710px; float: left; font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;\"><div class=\"fw clearfix\" style=\"margin: 0px; padding: 0px; width: 710px;\"><table class=\"__MB_ARTICLE_A\" style=\"margin: 10px 0px; padding: 5px; vertical-align: top; line-height: 1.4; width: 710px; max-width: 100%; background: rgb(245, 245, 245);\"><tbody style=\"margin: 0px; padding: 0px;\"><tr style=\"margin: 0px; padding: 0px;\"><td align=\"left\" style=\"margin: 0px; padding: 5px 15px;\"><a href=\"https://congthuong.vn/ho-tro-doanh-nghiep-dien-tu-tham-gia-chuoi-cung-ung-183462.html\" title=\"Hỗ trợ doanh nghiệp điện tử tham gia chuỗi cung ứng\" style=\"margin: 0px 0px 5px; padding: 5px 0px 0px 10px; border: 0px; color: rgb(0, 51, 102); clear: both; float: left; font-style: italic; background-image: url(&quot;../images/bl-square-blue.png&quot;); background-position: left 12px; background-size: initial; background-repeat: no-repeat; background-attachment: initial; background-origin: initial; background-clip: initial;\">Hỗ trợ doanh nghiệp điện tử tham gia chuỗi cung ứng</a><a href=\"https://congthuong.vn/tham-gia-chuoi-cung-ung-toan-cau-dia-phuong-giu-vai-tro-quan-trong-216165.html\" title=\"Tham gia chuỗi cung ứng toàn cầu: Địa phương giữ vai trò quan trọng\" style=\"margin: 5px 0px; padding: 5px 0px 0px 10px; border: none; color: rgb(0, 51, 102); clear: both; float: left; font-style: italic; background-image: url(&quot;../images/bl-square-blue.png&quot;); background-position: left 12px; background-size: initial; background-repeat: no-repeat; background-attachment: initial; background-origin: initial; background-clip: initial;\">Tham gia chuỗi cung ứng toàn cầu: Địa phương giữ vai trò quan trọng</a></td></tr></tbody></table><table class=\"MASTERCMS_TPL_TABLE\" style=\"margin: 10px 0px; padding: 5px; vertical-align: top; line-height: 14px; width: 710px; max-width: 100%; background: none 0px 0px repeat scroll; font-size: 12px;\"><tbody style=\"margin: 0px; padding: 0px;\"><tr style=\"margin: 0px; padding: 0px;\"><td style=\"margin: 0px; padding: 0px; text-align: center; vertical-align: middle;\"><img src=\"https://congthuong.vn/stores/news_dataimages/minhnguyet/082022/06/09/2520-cang20220806092259.3710690.jpg?rt=20220806092658\" data-src=\"https://congthuong.vn/stores/news_dataimages/minhnguyet/082022/06/09/2520-cang20220806092259.3710690.jpg?rt=20220806092658\" class=\"__img_mastercms mastercms_lazyload\" alt=\"Thêm nhiều tuyến vận tải mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc\" title=\"Thêm nhiều tuyến vận tải mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc\" style=\"margin: 0px; padding: 0px; border-width: initial; border-color: initial; border-image: initial; max-width: 100%; width: 710px; overflow: hidden; height: auto !important;\"></td></tr><tr style=\"margin: 0px; padding: 0px;\"><td style=\"margin: 0px; padding: 8px; background-color: rgb(229, 229, 229); color: rgb(85, 85, 85); font-style: italic; text-align: center; font-size: 13px; line-height: 1.3;\">Tân Cảng - Hiệp Phước vừa đón thành công đón tuyến dịch vụ mới TVT2. Ảnh: Q.K</td></tr></tbody></table><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\"><a href=\"https://congthuong.vn/dua-vao-khai-thac-cang-tan-cang-hiep-phuoc-51553.html\" title=\"Xem thêm tin về Cảng Tân Cảng\" style=\"margin: 0px; padding: 0px; border: none; color: blue;\">Cảng Tân Cảng</a>&nbsp;- Hiệp Phước vừa đón thành công tuyến dịch vụ mới TVT2 do Taicang Container Lines (Taicang) khai thác nhằm duy trì thông suốt chuỗi cung ứng Việt Nam – Trung Quốc.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">TVT2 là tuyến dịch vụ thứ 2 của Hãng tàu Taicang cập dài hạn tại cảng Tân Cảng – Hiệp Phước với tần suất 1 chuyến/tuần, nâng tổng số tuyến dịch vụ hiện hữu tại cảng Tân Cảng – Hiệp Phước lên tổng số 8 tuyến quốc tế và 1 tuyến nội địa.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">Trước đó, ngày 30/7/2022, cảng Container Quốc tế Tân&nbsp;<a href=\"https://congthuong.vn/tag/cang-hai-phong-4279.tag\" title=\"Xem thêm tin về Cảng Hải Phòng\" style=\"margin: 0px; padding: 0px; border: none; color: blue;\">Cảng Hải Phòng</a>&nbsp;(TC-HICT) thuộc hệ thống cảng của Tổng công ty Tân Cảng Sài Gòn cũng tiếp nhận tuyến dịch vụ đầu tiên CKV2 của hãng tàu SITC khai thác tại cảng.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">Chuyến tàu đầu tiên mang tên SITC GUANGXI thuộc tuyến dịch vụ CKV2 của hãng tàu SITC có sức chở 1.800 Teu, tải trọng 21.400 DWT, LOA 172m.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">CKV2 là tuyến dịch vụ nội Á, được đưa vào khai thác hàng tuần tại cảng TC-HICT với hải trình: Qingzhou - Xiamen - Incheon - Qingdao - Shanghai - Hongkong - Sihanoukville - Bangkok - Laem Chabang, kết nối thị trường Việt Nam – Trung Quốc – Thái Lan – Singapore, đáp ứng nhu cầu giao thương, xuất nhập khẩu hàng hóa cho các nước trong khu vực Đông Nam Á.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">Theo Tổng công ty Tân cảng Sài Gòn, tuyến CKV2 khai thác tại TC-HICT đã nâng tổng số tuyến dịch vụ quốc tế của TC-HICT hiện tại lên đến 14 tuyến, góp phần gia tăng vị thế, vai trò của cảng nước sâu TC-HICT không chỉ tại Việt Nam mà vươn tầm vai trò kết nỗi chuỗi dịch vụ logistics toàn cầu.</p></div></div>', '<div class=\"article-detail-desc f2 fw lt clearfix\" style=\"margin: 0px 0px 15px; padding: 0px; width: 710px; float: left; font-family: Arial, sans-serif; font-weight: 600; font-size: 18px;\">Nhiều chuyến tàu vận tải tuyến quốc tế vừa cập hệ thống cảng của Tổng công ty Tân cảng Sài Gòn, mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc.</div><div class=\"__MASTERCMS_CONTENT fw lt f2 mb clearfix\" style=\"margin: 0px 0px 15px; padding: 0px; width: 710px; float: left; font-family: Arial, sans-serif; font-size: 18px; line-height: 1.6;\"><div class=\"fw clearfix\" style=\"margin: 0px; padding: 0px; width: 710px;\"><table class=\"__MB_ARTICLE_A\" style=\"margin: 10px 0px; padding: 5px; vertical-align: top; line-height: 1.4; width: 710px; max-width: 100%; background: rgb(245, 245, 245);\"><tbody style=\"margin: 0px; padding: 0px;\"><tr style=\"margin: 0px; padding: 0px;\"><td align=\"left\" style=\"margin: 0px; padding: 5px 15px;\"><a href=\"https://congthuong.vn/ho-tro-doanh-nghiep-dien-tu-tham-gia-chuoi-cung-ung-183462.html\" title=\"Hỗ trợ doanh nghiệp điện tử tham gia chuỗi cung ứng\" style=\"margin: 0px 0px 5px; padding: 5px 0px 0px 10px; border: 0px; color: rgb(0, 51, 102); clear: both; float: left; font-style: italic; background-image: url(&quot;../images/bl-square-blue.png&quot;); background-position: left 12px; background-size: initial; background-repeat: no-repeat; background-attachment: initial; background-origin: initial; background-clip: initial;\">Hỗ trợ doanh nghiệp điện tử tham gia chuỗi cung ứng</a><a href=\"https://congthuong.vn/tham-gia-chuoi-cung-ung-toan-cau-dia-phuong-giu-vai-tro-quan-trong-216165.html\" title=\"Tham gia chuỗi cung ứng toàn cầu: Địa phương giữ vai trò quan trọng\" style=\"margin: 5px 0px; padding: 5px 0px 0px 10px; border: none; color: rgb(0, 51, 102); clear: both; float: left; font-style: italic; background-image: url(&quot;../images/bl-square-blue.png&quot;); background-position: left 12px; background-size: initial; background-repeat: no-repeat; background-attachment: initial; background-origin: initial; background-clip: initial;\">Tham gia chuỗi cung ứng toàn cầu: Địa phương giữ vai trò quan trọng</a></td></tr></tbody></table><table class=\"MASTERCMS_TPL_TABLE\" style=\"margin: 10px 0px; padding: 5px; vertical-align: top; line-height: 14px; width: 710px; max-width: 100%; background: none 0px 0px repeat scroll; font-size: 12px;\"><tbody style=\"margin: 0px; padding: 0px;\"><tr style=\"margin: 0px; padding: 0px;\"><td style=\"margin: 0px; padding: 0px; text-align: center; vertical-align: middle;\"><img src=\"https://congthuong.vn/stores/news_dataimages/minhnguyet/082022/06/09/2520-cang20220806092259.3710690.jpg?rt=20220806092658\" data-src=\"https://congthuong.vn/stores/news_dataimages/minhnguyet/082022/06/09/2520-cang20220806092259.3710690.jpg?rt=20220806092658\" class=\"__img_mastercms mastercms_lazyload\" alt=\"Thêm nhiều tuyến vận tải mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc\" title=\"Thêm nhiều tuyến vận tải mở rộng kết nối chuỗi cung ứng Việt Nam và Trung Quốc\" style=\"margin: 0px; padding: 0px; border-width: initial; border-color: initial; border-image: initial; max-width: 100%; width: 710px; overflow: hidden; height: auto !important;\"></td></tr><tr style=\"margin: 0px; padding: 0px;\"><td style=\"margin: 0px; padding: 8px; background-color: rgb(229, 229, 229); color: rgb(85, 85, 85); font-style: italic; text-align: center; font-size: 13px; line-height: 1.3;\">Tân Cảng - Hiệp Phước vừa đón thành công đón tuyến dịch vụ mới TVT2. Ảnh: Q.K</td></tr></tbody></table><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\"><a href=\"https://congthuong.vn/dua-vao-khai-thac-cang-tan-cang-hiep-phuoc-51553.html\" title=\"Xem thêm tin về Cảng Tân Cảng\" style=\"margin: 0px; padding: 0px; border: none; color: blue;\">Cảng Tân Cảng</a>&nbsp;- Hiệp Phước vừa đón thành công tuyến dịch vụ mới TVT2 do Taicang Container Lines (Taicang) khai thác nhằm duy trì thông suốt chuỗi cung ứng Việt Nam – Trung Quốc.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">TVT2 là tuyến dịch vụ thứ 2 của Hãng tàu Taicang cập dài hạn tại cảng Tân Cảng – Hiệp Phước với tần suất 1 chuyến/tuần, nâng tổng số tuyến dịch vụ hiện hữu tại cảng Tân Cảng – Hiệp Phước lên tổng số 8 tuyến quốc tế và 1 tuyến nội địa.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">Trước đó, ngày 30/7/2022, cảng Container Quốc tế Tân&nbsp;<a href=\"https://congthuong.vn/tag/cang-hai-phong-4279.tag\" title=\"Xem thêm tin về Cảng Hải Phòng\" style=\"margin: 0px; padding: 0px; border: none; color: blue;\">Cảng Hải Phòng</a>&nbsp;(TC-HICT) thuộc hệ thống cảng của Tổng công ty Tân Cảng Sài Gòn cũng tiếp nhận tuyến dịch vụ đầu tiên CKV2 của hãng tàu SITC khai thác tại cảng.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">Chuyến tàu đầu tiên mang tên SITC GUANGXI thuộc tuyến dịch vụ CKV2 của hãng tàu SITC có sức chở 1.800 Teu, tải trọng 21.400 DWT, LOA 172m.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">CKV2 là tuyến dịch vụ nội Á, được đưa vào khai thác hàng tuần tại cảng TC-HICT với hải trình: Qingzhou - Xiamen - Incheon - Qingdao - Shanghai - Hongkong - Sihanoukville - Bangkok - Laem Chabang, kết nối thị trường Việt Nam – Trung Quốc – Thái Lan – Singapore, đáp ứng nhu cầu giao thương, xuất nhập khẩu hàng hóa cho các nước trong khu vực Đông Nam Á.</p><p style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; padding: 0px;\">Theo Tổng công ty Tân cảng Sài Gòn, tuyến CKV2 khai thác tại TC-HICT đã nâng tổng số tuyến dịch vụ quốc tế của TC-HICT hiện tại lên đến 14 tuyến, góp phần gia tăng vị thế, vai trò của cảng nước sâu TC-HICT không chỉ tại Việt Nam mà vươn tầm vai trò kết nỗi chuỗi dịch vụ logistics toàn cầu.</p></div></div>', 1, 1, 1, 1, 0, '2022-08-07 05:00:00', '2022-08-07 05:00:00'),
(112, 1, 0, '/certificates/MXKU2461tbQlp2kTQeGSF2US9sraBxQjLpms3KFd.png', NULL, '[VN] [MINI GAME] LẬP SIÊU PHẨM VỚI 6 CẦU THỦ NOSTALGIA MỚI', '[EN] [MINI GAME] LẬP SIÊU PHẨM VỚI 6 CẦU THỦ NOSTALGIA MỚI', NULL, '<p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Xin chào các HLV,</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">6 cầu thủ mới trong mùa thẻ Nostalgia đã tái xuất tại FIFA Online 4. Với mong muốn tạo sân chơi thú vị hơn cho các HLV, FIFA Online 4 đem đến Mini game lập những siêu phẩm với 6 cầu thủ Nostalgia vừa ra mắt trong bản cập nhật ngày 04.08.2022 vừa qua. 5 HLV với bài thi ấn tượng sẽ nhận được gói NTG T8/2022 cùng 500FC vô cùng giá trị.</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><img loading=\"lazy\" class=\"aligncenter size-full wp-image-22607\" src=\"https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080.png\" alt=\"\" width=\"1080\" height=\"1080\" srcset=\"https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080.png 1080w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-300x300.png 300w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-1024x1024.png 1024w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-150x150.png 150w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-768x768.png 768w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-320x320.png 320w\" sizes=\"(max-width: 1080px) 100vw, 1080px\" style=\"clear: both; max-width: 100%; display: block; outline: none !important; margin: 0px auto !important; width: auto !important; height: auto !important;\"></p><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">1/ THỜI GIAN CUỘC THI:</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Từ ngày 06.08 đến 23h59 ngày 14.08.2022</span></p><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">2/ ĐỐI TƯỢNG THAM GIA:</span></h1><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Tất cả HLV đang sinh sống tại Việt Nam.</span></li></ul><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">3/ CÁCH THỨC THAM GIA:</span></h1><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Chơi sự kiện Đường Đến Khung Thành NTG tại&nbsp;</span><a href=\"https://ntg.fo4.garena.vn/\" style=\"color: rgb(138, 79, 255); outline: none !important;\">https://ntg.fo4.garena.vn/</a><span style=\"outline: none !important;\">&nbsp;để nhận về 6 cầu thủ NTG và ICONS mới ra mắt.</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Sử dụng cầu thủ đó thi đấu để ghi bàn và quay lại tình huống ghi bàn đó</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Bài dự thi phải được gửi ở dưới dạng video</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Một người có thể đăng tải nhiều video ở cả hai hạng mục, nhưng BTC chỉ trao giải cho bài thi tốt nhất của thí sinh đó.</span></li></ul><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><img loading=\"lazy\" class=\"aligncenter size-full wp-image-22611\" src=\"https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080.png\" alt=\"\" width=\"1080\" height=\"1080\" srcset=\"https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080.png 1080w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-300x300.png 300w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-1024x1024.png 1024w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-150x150.png 150w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-768x768.png 768w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-320x320.png 320w\" sizes=\"(max-width: 1080px) 100vw, 1080px\" style=\"clear: both; max-width: 100%; display: block; outline: none !important; margin: 0px auto !important; width: auto !important; height: auto !important;\"></p><table style=\"margin-top: 0px; margin-bottom: 0.83333vw; border: 0.05208vw solid rgb(0, 0, 0); width: 614.4px; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><tbody style=\"outline: none !important;\"><tr style=\"outline: none !important;\"><td colspan=\"3\" style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">DANH SÁCH NTG T8/2022</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">GEORGE BEST</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">ROBERTO BAGGIO</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">CHA BUM KUN</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">GARY LINEKER</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">SOCRATES</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">CHRISTIAN VIERI</span></td></tr></tbody></table><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\">&nbsp;</p><table style=\"margin-top: 0px; margin-bottom: 0.83333vw; border: 0.05208vw solid rgb(0, 0, 0); width: 614.4px; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><tbody style=\"outline: none !important;\"><tr style=\"outline: none !important;\"><td colspan=\"3\" style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">DANH SÁCH ICONS T7/2022</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">RUUD GULLIT</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">LOTHAR MATTHAUS</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">ALAN SHEARER</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">RUUD VAN NISTELROOY</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">RYAN GIGGS</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">BOBBY MOORE</span></td></tr></tbody></table><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">4/ TIÊU CHÍ ĐÁNH GIÁ</span></h1><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Lập siêu phẩm cùng ICONS và NTG mới: Ở hạng mục này, thí sinh sẽ dùng 1 trong 12 cầu thủ NTG và ICONS để ghi những bàn thắng bất kỳ mà các HLV yêu thích và tự tin giành chiến thắng tại Minigame.</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Đảm bảo chất lượng video: Độ phân giải 720p trở lên (Sử dụng tổ hợp Windows + Alt + R hoặc sử dụng các phần mềm quay màn hình khác:&nbsp;</span><a href=\"https://bizflycloud.vn/tin-tuc/top-10-phan-mem-quay-man-hinh-may-tinh-nhe-mien-phi-chat-luong-cao-20201029145831115.htm\" style=\"color: rgb(138, 79, 255); outline: none !important;\">Link tham khảo</a><span style=\"outline: none !important;\">)</span></li></ul><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">5/ HÌNH THỨC CHIA SẺ</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Bước 1: Đăng tải video ở chế độ công khai ở&nbsp;<a href=\"https://www.facebook.com/groups/officialfo4vn/\" style=\"color: rgb(138, 79, 255); outline: none !important;\">Group Garena FIFA Online 4 Việt Nam</a>&nbsp;cùng với nội dung post:</span></p><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Caption: Mô tả (nếu có) + tên HLV + UID + video dự thi</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Hashtag: #MinigameNTG #FIFAOnline4 #SieuphamNTG</span></li></ul><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">6/ GIẢI THƯỞNG</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">FIFA Online 4 sẽ chọn ra 5 bài thi ấn tượng nhất:</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Mỗi phần thưởng là: 1 Gói NTG T8/2022 &amp; 500 FC</span></p><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">7/ THÔNG BÁO KẾT QUẢ</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Thông tin người thắng giải sẽ được công bố trên Fanpage EA Sports FIFA Online 4 Việt Nam trong vòng 7 ngày sau khi thời gian cuộc thi kết thúc (Tức ngày 21/08).&nbsp;</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Giải thưởng sẽ được BTC liên hệ và gửi tới các HLV trúng giải.</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Các HLV nhớ thường xuyên theo dõi Fanpage để có thể cập nhật thông tin liên lạc khi trúng giải nhé.</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Trân trọng.</span></p>', '<p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Xin chào các HLV,</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">6 cầu thủ mới trong mùa thẻ Nostalgia đã tái xuất tại FIFA Online 4. Với mong muốn tạo sân chơi thú vị hơn cho các HLV, FIFA Online 4 đem đến Mini game lập những siêu phẩm với 6 cầu thủ Nostalgia vừa ra mắt trong bản cập nhật ngày 04.08.2022 vừa qua. 5 HLV với bài thi ấn tượng sẽ nhận được gói NTG T8/2022 cùng 500FC vô cùng giá trị.</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><img loading=\"lazy\" class=\"aligncenter size-full wp-image-22607\" src=\"https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080.png\" alt=\"\" width=\"1080\" height=\"1080\" srcset=\"https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080.png 1080w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-300x300.png 300w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-1024x1024.png 1024w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-150x150.png 150w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-768x768.png 768w, https://fo4.garena.vn/wp-content/uploads/2022/08/NTG_MINIGAME_1080-320x320.png 320w\" sizes=\"(max-width: 1080px) 100vw, 1080px\" style=\"clear: both; max-width: 100%; display: block; outline: none !important; margin: 0px auto !important; width: auto !important; height: auto !important;\"></p><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">1/ THỜI GIAN CUỘC THI:</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Từ ngày 06.08 đến 23h59 ngày 14.08.2022</span></p><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">2/ ĐỐI TƯỢNG THAM GIA:</span></h1><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Tất cả HLV đang sinh sống tại Việt Nam.</span></li></ul><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">3/ CÁCH THỨC THAM GIA:</span></h1><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Chơi sự kiện Đường Đến Khung Thành NTG tại&nbsp;</span><a href=\"https://ntg.fo4.garena.vn/\" style=\"color: rgb(138, 79, 255); outline: none !important;\">https://ntg.fo4.garena.vn/</a><span style=\"outline: none !important;\">&nbsp;để nhận về 6 cầu thủ NTG và ICONS mới ra mắt.</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Sử dụng cầu thủ đó thi đấu để ghi bàn và quay lại tình huống ghi bàn đó</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Bài dự thi phải được gửi ở dưới dạng video</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Một người có thể đăng tải nhiều video ở cả hai hạng mục, nhưng BTC chỉ trao giải cho bài thi tốt nhất của thí sinh đó.</span></li></ul><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><img loading=\"lazy\" class=\"aligncenter size-full wp-image-22611\" src=\"https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080.png\" alt=\"\" width=\"1080\" height=\"1080\" srcset=\"https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080.png 1080w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-300x300.png 300w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-1024x1024.png 1024w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-150x150.png 150w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-768x768.png 768w, https://fo4.garena.vn/wp-content/uploads/2022/08/Banner_Slide10_NTG-082022-Minigame_1080x1080-320x320.png 320w\" sizes=\"(max-width: 1080px) 100vw, 1080px\" style=\"clear: both; max-width: 100%; display: block; outline: none !important; margin: 0px auto !important; width: auto !important; height: auto !important;\"></p><table style=\"margin-top: 0px; margin-bottom: 0.83333vw; border: 0.05208vw solid rgb(0, 0, 0); width: 614.4px; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><tbody style=\"outline: none !important;\"><tr style=\"outline: none !important;\"><td colspan=\"3\" style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">DANH SÁCH NTG T8/2022</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">GEORGE BEST</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">ROBERTO BAGGIO</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">CHA BUM KUN</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">GARY LINEKER</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">SOCRATES</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">CHRISTIAN VIERI</span></td></tr></tbody></table><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\">&nbsp;</p><table style=\"margin-top: 0px; margin-bottom: 0.83333vw; border: 0.05208vw solid rgb(0, 0, 0); width: 614.4px; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><tbody style=\"outline: none !important;\"><tr style=\"outline: none !important;\"><td colspan=\"3\" style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">DANH SÁCH ICONS T7/2022</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">RUUD GULLIT</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">LOTHAR MATTHAUS</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">ALAN SHEARER</span></td></tr><tr style=\"outline: none !important;\"><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">RUUD VAN NISTELROOY</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">RYAN GIGGS</span></td><td style=\"border: 0.05208vw solid rgb(0, 0, 0); padding: 0.41667vw; text-align: center; outline: none !important; height: 2.1875vw !important;\"><span style=\"outline: none !important;\">BOBBY MOORE</span></td></tr></tbody></table><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">4/ TIÊU CHÍ ĐÁNH GIÁ</span></h1><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Lập siêu phẩm cùng ICONS và NTG mới: Ở hạng mục này, thí sinh sẽ dùng 1 trong 12 cầu thủ NTG và ICONS để ghi những bàn thắng bất kỳ mà các HLV yêu thích và tự tin giành chiến thắng tại Minigame.</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Đảm bảo chất lượng video: Độ phân giải 720p trở lên (Sử dụng tổ hợp Windows + Alt + R hoặc sử dụng các phần mềm quay màn hình khác:&nbsp;</span><a href=\"https://bizflycloud.vn/tin-tuc/top-10-phan-mem-quay-man-hinh-may-tinh-nhe-mien-phi-chat-luong-cao-20201029145831115.htm\" style=\"color: rgb(138, 79, 255); outline: none !important;\">Link tham khảo</a><span style=\"outline: none !important;\">)</span></li></ul><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">5/ HÌNH THỨC CHIA SẺ</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Bước 1: Đăng tải video ở chế độ công khai ở&nbsp;<a href=\"https://www.facebook.com/groups/officialfo4vn/\" style=\"color: rgb(138, 79, 255); outline: none !important;\">Group Garena FIFA Online 4 Việt Nam</a>&nbsp;cùng với nội dung post:</span></p><ul style=\"margin-bottom: 0.83333vw; padding-left: 2.08333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Caption: Mô tả (nếu có) + tên HLV + UID + video dự thi</span></li><li aria-level=\"1\" style=\"outline: none !important;\"><span style=\"outline: none !important;\">Hashtag: #MinigameNTG #FIFAOnline4 #SieuphamNTG</span></li></ul><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">6/ GIẢI THƯỞNG</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">FIFA Online 4 sẽ chọn ra 5 bài thi ấn tượng nhất:</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Mỗi phần thưởng là: 1 Gói NTG T8/2022 &amp; 500 FC</span></p><h1 style=\"margin-bottom: 0.83333vw; font-size: 1.66667vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; outline: none !important;\"><span style=\"outline: none !important;\">7/ THÔNG BÁO KẾT QUẢ</span></h1><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Thông tin người thắng giải sẽ được công bố trên Fanpage EA Sports FIFA Online 4 Việt Nam trong vòng 7 ngày sau khi thời gian cuộc thi kết thúc (Tức ngày 21/08).&nbsp;</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Giải thưởng sẽ được BTC liên hệ và gửi tới các HLV trúng giải.</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Các HLV nhớ thường xuyên theo dõi Fanpage để có thể cập nhật thông tin liên lạc khi trúng giải nhé.</span></p><p style=\"margin-bottom: 0.83333vw; color: rgb(0, 0, 0); font-family: &quot;Roboto Condensed&quot;, sans-serif; font-size: 14.4px; outline: none !important;\"><span style=\"outline: none !important;\">Trân trọng.</span></p>', 1, 1, 0, 0, 0, '2022-08-07 05:05:23', '2022-08-07 05:05:23');
INSERT INTO `news` (`id`, `category_id`, `product_category_id`, `img`, `price`, `title_vn`, `title_en`, `youtube_url`, `content_vn`, `content_en`, `approved`, `is_hot`, `is_new`, `is_paid`, `member_id`, `created_at`, `updated_at`) VALUES
(113, 17, 0, '/certificates/cfeSjjaz6km2OlrbQU0rBpCKOx2ffQuyTYIpAeHa.jpeg', NULL, '[VN] NHÂN VIÊN KẾ TOÁN (TIẾNG ANH / TIẾNG HÀN)', '[EN] NHÂN VIÊN KẾ TOÁN (TIẾNG ANH / TIẾNG HÀN)', NULL, '<div class=\"py-4 border-bottom-mb\" style=\"color: rgb(14, 18, 37); font-family: Montserrat, sans-serif;\"><h5 class=\"h4 title large mb-3 text-primary font-weight-bolder\" style=\"letter-spacing: -1px; color: rgb(0, 105, 219) !important;\">Mô tả công việc</h5><div class=\"raw-content\"><p style=\"text-align: justify;\">- Xuất hóa đơn điện tử cho khách hàng ./ Issue invoice</p><p style=\"text-align: justify;\">- Tính lương, công cho công nhân, nhân sự, bảo hiểm… / Calculating salary, wages for workers, HR, insurance...</p><p style=\"text-align: justify;\">- Thực hiện giao dịch ngân hàng / Perform banking transactions</p><p style=\"text-align: justify;\">- Thực hiện công việc theo sự phân công của giám đốc ./ Perform duties as assigned by the director</p></div></div><div class=\"py-4 border-bottom-mb\" style=\"color: rgb(14, 18, 37); font-family: Montserrat, sans-serif;\"><h5 class=\"h4 title large mb-3 text-primary font-weight-bolder\" style=\"letter-spacing: -1px; color: rgb(0, 105, 219) !important;\">Kinh nghiệm / Kỹ năng chi tiết</h5><div class=\"raw-content\"><p>- Tốt nghiệp Đại học các ngành kinh tế, ngoại ngữ / Graduated from University of Economics and Foreign Languages</p><p>- Giao tiếp Tiếng Anh hoặc Tiếng Hàn tốt / Good communication in English or Korean</p><p>- Số Năm Kinh Nghiệm / Experience Level: 1-2 năm / 1-2 year</p><p>- Ưu tiên có kinh nghiệm ngành kế toán / Preferably with experience in accounting</p><p>- Ưu tiên những người sống tại Long Thành, Nhơn Trạch / Priority is given to people living in Long Thanh, Nhon Trach</p></div></div>', '<div class=\"py-4 border-bottom-mb\" style=\"color: rgb(14, 18, 37); font-family: Montserrat, sans-serif;\"><h5 class=\"h4 title large mb-3 text-primary font-weight-bolder\" style=\"letter-spacing: -1px; color: rgb(0, 105, 219) !important;\">Mô tả công việc</h5><div class=\"raw-content\"><p style=\"text-align: justify;\">- Xuất hóa đơn điện tử cho khách hàng ./ Issue invoice</p><p style=\"text-align: justify;\">- Tính lương, công cho công nhân, nhân sự, bảo hiểm… / Calculating salary, wages for workers, HR, insurance...</p><p style=\"text-align: justify;\">- Thực hiện giao dịch ngân hàng / Perform banking transactions</p><p style=\"text-align: justify;\">- Thực hiện công việc theo sự phân công của giám đốc ./ Perform duties as assigned by the director</p></div></div><div class=\"py-4 border-bottom-mb\" style=\"color: rgb(14, 18, 37); font-family: Montserrat, sans-serif;\"><h5 class=\"h4 title large mb-3 text-primary font-weight-bolder\" style=\"letter-spacing: -1px; color: rgb(0, 105, 219) !important;\">Kinh nghiệm / Kỹ năng chi tiết</h5><div class=\"raw-content\"><p>- Tốt nghiệp Đại học các ngành kinh tế, ngoại ngữ / Graduated from University of Economics and Foreign Languages</p><p>- Giao tiếp Tiếng Anh hoặc Tiếng Hàn tốt / Good communication in English or Korean</p><p>- Số Năm Kinh Nghiệm / Experience Level: 1-2 năm / 1-2 year</p><p>- Ưu tiên có kinh nghiệm ngành kế toán / Preferably with experience in accounting</p><p>- Ưu tiên những người sống tại Long Thành, Nhơn Trạch / Priority is given to people living in Long Thanh, Nhon Trach</p></div></div>', 1, 0, 0, 0, 0, '2022-08-07 05:10:48', '2022-08-07 05:10:48'),
(114, 5, 0, '/certificates/mr4w3b00KLTGwpkmxFLiRBRv2UvYlWlifkV7kMqS.jpeg', NULL, 'Bán ABC', 'Bán ABC', NULL, 'Test tin bán', 'Test tin bán', 0, 0, 0, 0, 0, '2022-08-07 08:21:59', '2022-08-18 05:09:57'),
(115, 4, 0, '/certificates/4vSTAB5nvUKMuo6Zq3ZLOJmi4uSd42T6MVFtCpch.jpeg', NULL, 'Cần mua nhà cấp 4 ở  Q.1, TPHCM', 'Cần mua nhà cấp 4 ở  Q.1, TPHCM', NULL, 'Mình cần mua nhà cấp 4 ở trung tâm quận 1.', 'Mình cần mua nhà cấp 4 ở trung tâm quận 1.', 0, 0, 0, 0, 0, '2022-08-18 14:56:22', '2022-08-18 16:41:47'),
(116, 17, 0, '/certificates/fFayStYnYUspoHnKaZANayVSJAv7IvYSD71Gs9YU.png', NULL, 'Nhân Viên Hành Chính Nhân Sự', '[EN] Nhân Viên Hành Chính Nhân Sự', NULL, '<p><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 14px; white-space: pre-line;\">• Đảm nhận các công việc hành chính nhân sự như quản lý dữ liệu hành chính, chấm công, BHXH, giấy phép lao động, visa, hợp đồng lao động.\r\n• Xây dựng kế hoạch ngân sách hoạt động nhân sự, định mức lao động, quỹ lương, quỹ chế độ đãi ngộ với Người lao động. Đề xuất các chính sách, cơ chế đãi ngộ với Người lao động.\r\n• Thực hiện các nghiệp vụ liên quan đến Kỷ luật lao động, quan hệ lao động theo Nội quy lao động và quy định pháp luật, Công ty.\r\n• Biên, phiên dịch Tiếng Nhật sang Tiếng Việt và ngược lại.\r\n• Các công việc trợ lý cho Ban Giám đốc và các công việc hành chính khác theo yêu cầu của trưởng bộ phận.</span><br></p>', '<p>[EN]&nbsp;<span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 14px; white-space: pre-line;\">• Đảm nhận các công việc hành chính nhân sự như quản lý dữ liệu hành chính, chấm công, BHXH, giấy phép lao động, visa, hợp đồng lao động.</span></p><span style=\"color: rgb(32, 33, 36); font-family: arial, sans-serif; font-size: 14px; white-space: pre-line;\">&nbsp;• Xây dựng kế hoạch ngân sách hoạt động nhân sự, định mức lao động, quỹ lương, quỹ chế độ đãi ngộ với Người lao động. Đề xuất các chính sách, cơ chế đãi ngộ với Người lao động.\r\n• Thực hiện các nghiệp vụ liên quan đến Kỷ luật lao động, quan hệ lao động theo Nội quy lao động và quy định pháp luật, Công ty.\r\n• Biên, phiên dịch Tiếng Nhật sang Tiếng Việt và ngược lại.\r\n• Các công việc trợ lý cho Ban Giám đốc và các công việc hành chính khác theo yêu cầu của trưởng bộ phận.</span>', 1, 0, 0, 0, 0, '2022-08-23 16:14:47', '2022-08-23 16:14:47'),
(117, 16, 0, '/certificates/lNcqjXrjMzGHsFRPlDSF3cln9flqjo7DYKyKIusU.jpeg', NULL, 'Đề xuất xây cảng tạm ở Vũng Áng, Cục Hàng hải nói gì?', '[EN] Đề xuất xây cảng tạm ở Vũng Áng, Cục Hàng hải nói gì?', NULL, '<p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\"><span style=\"font-weight: 700;\">Bến cảng hoạt động không quá 36 tháng</span></p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Tin từ Cục&nbsp;<a class=\"seokwl\" href=\"https://www.baogiaothong.vn/hang-hai/\" title=\"hàng hải\" style=\"color: rgb(204, 3, 0);\">Hàng hải</a>&nbsp;VN, cơ quan này vừa nhận được văn bản của Công ty TNHH Xây dựng Công trình Cảng Trung Quốc đề nghị thỏa thuận đầu tư xây dựng kết cấu hạ tầng cảng biển tạm thời phục vụ xây dựng Dự án Nhà máy Nhiệt điện Vũng Áng II.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Được biết, Công ty TNHH Xây dựng Công trình Cảng Trung Quốc là nhà thầu phụ của Tổng thầu – EPC JV tham gia thiết kế, mua sắm và thi công cảng của Dự án Nhà máy Nhiệt điện Vũng Áng II. Hạng mục cảng tạm và bãi đúc cấu kiện đúc sẵn là một trong những hạng mục công trình thuộc biện pháp thi công của nhà thầu này.</p><section class=\"bnrBt txtCent\" style=\"color: rgb(80, 80, 80); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 13px;\"></section><div style=\"color: rgb(80, 80, 80); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 13px; width: 689px; text-align: center;\"><p class=\"image\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif;\"><img url-img-full=\"https://cdn.baogiaothong.vn/upload/images/2022-3/article_img/2022-07-08/image_1280/img-bgt-2021-6-1657248046-width700height434.jpg\" src=\"https://cdn.baogiaothong.vn/upload/images/2022-3/article_img/2022-07-08/img-bgt-2021-6-1657248046-width700height434.jpg\" data-original=\"https://cdn.baogiaothong.vn/upload/images/2022-3/article_img/2022-07-08/img-bgt-2021-6-1657248046-width700height434.jpg\" alt=\"Đề xuất xây cảng tạm ở vũng Áng, cục hàng hải nói gì?\" class=\"width100 initial loaded\" data-was-processed=\"true\" style=\"border: 0px; width: 689px; max-width: 100%; display: table; margin: 0px auto; cursor: zoom-in;\"></p><p class=\"img_chu_thich\" style=\"font-style: italic; color: rgb(0, 0, 0); font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; margin-top: 3px; font-size: 21px; text-align: justify;\">Đề xuất xây Bến cảng tạm thời để phục vụ việc thi công, xây dựng công trình thuộc Dự án Nhà máy Nhiệt điện Vũng Áng II. Ảnh minh họa</p></div><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Cụ thể, công ty này đề nghị thỏa thuận đầu tư xây dựng kết cấu hạ tầng cảng biển tạm thời tại vị trí giữa Bến số 4 và Bến số 5 Khu bến Vũng Áng. Bến cảng có cầu cảng dạng nhô, tiếp nhận tàu trọng tải đến 2.500 tấn.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Công trình nhằm phục vụ hoạt động bốc xếp cấu kiện đúc sẵn của hạng mục đường ống lấy và đường ống xả nước làm mát trong quá trình thi công xây dựng Dự án Nhà máy Nhiệt điện Vũng Áng II.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Theo đề xuất, thời hạn hoạt động công trình không quá 36 tháng hoặc sau khi hoàn thành mục đích sử dụng công trình nêu trên. Sau thời hạn hoạt động, công trình sẽ được dỡ bỏ và mặt bằng khu vực công trình sẽ được hoàn trả nguyên trạng.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\"><span style=\"font-weight: 700;\">Có thể xem xét vị trí đề nghị</span></p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Theo Cục Hàng hải VN, đề nghị của Công ty TNHH Xây dựng Công trình Cảng Trung Quốc phù hợp với quy định về điều kiện thiết lập kết cấu hạ tầng cảng biển tạm thời tại khoản 1 Điều 25 Nghị định số 58 ngày 10/5/2017 của Chính phủ. Đồng thời, đề xuất về thời hạn hoạt động công trình cũng phù hợp với quy định của pháp luật.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Tuy nhiên, Quyền Cục trưởng Cục Hàng hải VN Nguyễn Đình Việt cho biết, vị trí đề xuất công trình lại trùng với phạm vi định hướng xây dựng khu bến thủy đội cảng, phục vụ hoạt động quản lý cảng biển trong không gian Quy hoạch khu bến Vũng Áng giai đoạn hoàn thiện thuộc “Quy hoạch chi tiết khu bến cảng biển Vũng Áng, Sơn Dương thuộc cảng biển Sơn Dương - Vũng Áng (tỉnh Hà Tĩnh) giai đoạn đến năm 2020”.</p>', '<p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\"><span style=\"font-weight: 700;\">[EN]Bến cảng hoạt động không quá 36 tháng</span></p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Tin từ Cục&nbsp;<a class=\"seokwl\" href=\"https://www.baogiaothong.vn/hang-hai/\" title=\"hàng hải\" style=\"color: rgb(204, 3, 0);\">Hàng hải</a>&nbsp;VN, cơ quan này vừa nhận được văn bản của Công ty TNHH Xây dựng Công trình Cảng Trung Quốc đề nghị thỏa thuận đầu tư xây dựng kết cấu hạ tầng cảng biển tạm thời phục vụ xây dựng Dự án Nhà máy Nhiệt điện Vũng Áng II.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Được biết, Công ty TNHH Xây dựng Công trình Cảng Trung Quốc là nhà thầu phụ của Tổng thầu – EPC JV tham gia thiết kế, mua sắm và thi công cảng của Dự án Nhà máy Nhiệt điện Vũng Áng II. Hạng mục cảng tạm và bãi đúc cấu kiện đúc sẵn là một trong những hạng mục công trình thuộc biện pháp thi công của nhà thầu này.</p><section class=\"bnrBt txtCent\" style=\"color: rgb(80, 80, 80); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 13px;\"></section><div style=\"color: rgb(80, 80, 80); font-family: Tahoma, Helvetica, Arial, sans-serif; font-size: 13px; width: 689px; text-align: center;\"><p class=\"image\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif;\"><img url-img-full=\"https://cdn.baogiaothong.vn/upload/images/2022-3/article_img/2022-07-08/image_1280/img-bgt-2021-6-1657248046-width700height434.jpg\" src=\"https://cdn.baogiaothong.vn/upload/images/2022-3/article_img/2022-07-08/img-bgt-2021-6-1657248046-width700height434.jpg\" data-original=\"https://cdn.baogiaothong.vn/upload/images/2022-3/article_img/2022-07-08/img-bgt-2021-6-1657248046-width700height434.jpg\" alt=\"Đề xuất xây cảng tạm ở vũng Áng, cục hàng hải nói gì?\" class=\"width100 initial loaded\" data-was-processed=\"true\" style=\"border: 0px; width: 689px; max-width: 100%; display: table; margin: 0px auto; cursor: zoom-in;\"></p><p class=\"img_chu_thich\" style=\"font-style: italic; color: rgb(0, 0, 0); font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; margin-top: 3px; font-size: 21px; text-align: justify;\">Đề xuất xây Bến cảng tạm thời để phục vụ việc thi công, xây dựng công trình thuộc Dự án Nhà máy Nhiệt điện Vũng Áng II. Ảnh minh họa</p></div><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Cụ thể, công ty này đề nghị thỏa thuận đầu tư xây dựng kết cấu hạ tầng cảng biển tạm thời tại vị trí giữa Bến số 4 và Bến số 5 Khu bến Vũng Áng. Bến cảng có cầu cảng dạng nhô, tiếp nhận tàu trọng tải đến 2.500 tấn.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Công trình nhằm phục vụ hoạt động bốc xếp cấu kiện đúc sẵn của hạng mục đường ống lấy và đường ống xả nước làm mát trong quá trình thi công xây dựng Dự án Nhà máy Nhiệt điện Vũng Áng II.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Theo đề xuất, thời hạn hoạt động công trình không quá 36 tháng hoặc sau khi hoàn thành mục đích sử dụng công trình nêu trên. Sau thời hạn hoạt động, công trình sẽ được dỡ bỏ và mặt bằng khu vực công trình sẽ được hoàn trả nguyên trạng.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\"><span style=\"font-weight: 700;\">Có thể xem xét vị trí đề nghị</span></p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Theo Cục Hàng hải VN, đề nghị của Công ty TNHH Xây dựng Công trình Cảng Trung Quốc phù hợp với quy định về điều kiện thiết lập kết cấu hạ tầng cảng biển tạm thời tại khoản 1 Điều 25 Nghị định số 58 ngày 10/5/2017 của Chính phủ. Đồng thời, đề xuất về thời hạn hoạt động công trình cũng phù hợp với quy định của pháp luật.</p><p style=\"text-align: justify; font-size: 21px; font-family: &quot;Calibri Light&quot;, Tahoma, Arial, sans-serif; color: rgb(80, 80, 80);\">Tuy nhiên, Quyền Cục trưởng Cục Hàng hải VN Nguyễn Đình Việt cho biết, vị trí đề xuất công trình lại trùng với phạm vi định hướng xây dựng khu bến thủy đội cảng, phục vụ hoạt động quản lý cảng biển trong không gian Quy hoạch khu bến Vũng Áng giai đoạn hoàn thiện thuộc “Quy hoạch chi tiết khu bến cảng biển Vũng Áng, Sơn Dương thuộc cảng biển Sơn Dương - Vũng Áng (tỉnh Hà Tĩnh) giai đoạn đến năm 2020”.</p>', 1, 1, 1, 0, 0, '2022-08-23 16:17:26', '2022-08-23 16:17:26'),
(118, 0, 5, '/certificates/QNxJ5QUTcFZ5xjglQBA0JvEeXUneRYIurPDO1ZUt.jpeg', 'Liên hệ', 'Dijkstra - Ấn Phẩm Chuyên Đề Cho Kỹ Sư Phần Mềm Người Việt - Tập 2', '[EN] Dijkstra - Ấn Phẩm Chuyên Đề Cho Kỹ Sư Phần Mềm Người Việt - Tập 2', NULL, '<h2 class=\"BlockTitle__Wrapper-sc-qpz3fo-0 eHltcn\" style=\"font-size: 20px; line-height: 32px; padding: 8px 16px; text-transform: capitalize; display: flex; -webkit-box-pack: justify; justify-content: space-between; -webkit-box-align: center; align-items: center; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: Roboto, Helvetica, Arial, sans-serif;\">Mô Tả Sản Phẩm</h2><div class=\"content\" style=\"width: 920px; padding: 0px 16px 16px; display: inline-block; color: rgb(36, 36, 36); text-align: justify; border-radius: 4px; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 14px;\"><div class=\"ToggleContent__Wrapper-sc-1dbmfaw-1 cqXrJr\"><div class=\"ToggleContent__View-sc-1dbmfaw-0 wyACs\" style=\"position: relative;\"><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Dijkstra - Ấn Phẩm Chuyên Đề Cho Kỹ Sư Phần Mềm Người Việt - Tập 2</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Bạn đọc thân mến!</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Kể từ sau tập đầu tiên của ấn phẩm Dijkstra, ban biên soạn Grokking đã nhận được nhiều phản hồi tích cực từ đông đảo bạn đọc. Có thể nói sự ủng hộ của bạn đọc là nguồn động viên vô cùng lớn đến Grokking. Sau một thời gian dài chuẩn bị, ban biên soạn Grokking xin giới thiệu tới bạn đọc tập thứ 2 của Dijkstra.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Trong tập này, toàn bộ các bài viết đều được viết bởi các thành viên của Grokking với các nội dung xoay quanh các chủ đề quen thuộc từ Database, Distributed System, Operating System, … cùng một số chủ đề liên quan đến kỹ năng mềm. Hy vọng những bài viết này sẽ giúp củng cố kiến thức cũng như mang đến những thông tin hữu ích cho bạn đọc trên con đường sự nghiệp của mình.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Trong số Dijkstra tập 2 này, bạn sẽ được tiếp cận đến các bài viết:</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Gobench - một benchmark framework</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Bài toán đồng thuận trong hệ thống phân tán và thuật toán Raft</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Memory Abstraction - Làm thế nào để nhiều chương trình có thể cùng truy cập RAM cùng lúc</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Thiết bị I/O và các giao thức I/O căn bản</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Trình biên dịch câu truy vấn</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Làm thế nào để xây dựng Resume chuẩn Fang</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Sách hay nên đọc</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Mặc dù đã dành rất nhiều thời gian để biên soạn nhưng sơ suất là điều khó tránh, nhóm biên soạn rất mong nhận được những ý kiến đóng góp để có thể không ngừng nâng cao chất lượng bài viết trong các tập tiếp theo.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Trân trọng,<br>BBS Grokking</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">&nbsp;Giá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, thuế nhập khẩu (đối với đơn hàng giao từ nước ngoài có giá trị trên 1 triệu đồng).....</p></div></div></div>', '<h2 class=\"BlockTitle__Wrapper-sc-qpz3fo-0 eHltcn\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 32px; font-size: 20px; padding: 8px 16px; text-transform: capitalize; display: flex; -webkit-box-pack: justify; justify-content: space-between; -webkit-box-align: center; align-items: center; font-family: Roboto, Helvetica, Arial, sans-serif;\">[EN] Mô Tả Sản Phẩm</h2><div class=\"content\" style=\"width: 920px; padding: 0px 16px 16px; display: inline-block; color: rgb(36, 36, 36); text-align: justify; border-radius: 4px; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 14px;\"><div class=\"ToggleContent__Wrapper-sc-1dbmfaw-1 cqXrJr\"><div class=\"ToggleContent__View-sc-1dbmfaw-0 wyACs\" style=\"position: relative;\"><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Dijkstra - Ấn Phẩm Chuyên Đề Cho Kỹ Sư Phần Mềm Người Việt - Tập 2</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Bạn đọc thân mến!</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Kể từ sau tập đầu tiên của ấn phẩm Dijkstra, ban biên soạn Grokking đã nhận được nhiều phản hồi tích cực từ đông đảo bạn đọc. Có thể nói sự ủng hộ của bạn đọc là nguồn động viên vô cùng lớn đến Grokking. Sau một thời gian dài chuẩn bị, ban biên soạn Grokking xin giới thiệu tới bạn đọc tập thứ 2 của Dijkstra.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Trong tập này, toàn bộ các bài viết đều được viết bởi các thành viên của Grokking với các nội dung xoay quanh các chủ đề quen thuộc từ Database, Distributed System, Operating System, … cùng một số chủ đề liên quan đến kỹ năng mềm. Hy vọng những bài viết này sẽ giúp củng cố kiến thức cũng như mang đến những thông tin hữu ích cho bạn đọc trên con đường sự nghiệp của mình.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Trong số Dijkstra tập 2 này, bạn sẽ được tiếp cận đến các bài viết:</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Gobench - một benchmark framework</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Bài toán đồng thuận trong hệ thống phân tán và thuật toán Raft</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Memory Abstraction - Làm thế nào để nhiều chương trình có thể cùng truy cập RAM cùng lúc</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Thiết bị I/O và các giao thức I/O căn bản</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Trình biên dịch câu truy vấn</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Làm thế nào để xây dựng Resume chuẩn Fang</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">- Sách hay nên đọc</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Mặc dù đã dành rất nhiều thời gian để biên soạn nhưng sơ suất là điều khó tránh, nhóm biên soạn rất mong nhận được những ý kiến đóng góp để có thể không ngừng nâng cao chất lượng bài viết trong các tập tiếp theo.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Trân trọng,<br>BBS Grokking</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">&nbsp;Giá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, thuế nhập khẩu (đối với đơn hàng giao từ nước ngoài có giá trị trên 1 triệu đồng).....</p></div></div></div>', 1, 0, 0, 0, 0, '2022-08-23 16:22:38', '2022-08-23 16:22:38'),
(119, 3, 0, '/certificates/68U6bH4cP1hwrKElB7puLgAqcZUz0t3vFpd9dd9l.jpeg', NULL, 'Tôi Cần Báo Giá Tạp Chí ABC', 'Tôi Cần Báo Giá Tạp Chí ABC', NULL, 'Báo giá cho tôi tạp chí ABCD Nhé', 'Báo giá cho tôi tạp chí ABCD Nhé', 1, 0, 0, 0, 0, '2022-08-23 16:30:45', '2022-08-23 16:33:38'),
(120, 0, 2, '/certificates/lANXs4J6Ak1QMvYTiuhxNmiPV6y0tbBMZsKgiYK3.png', 'Liên hệ', 'Tạp chí ELLE tháng 02/2022', '[EN] Tạp chí ELLE tháng 02/2022', NULL, '<h2 class=\"BlockTitle__Wrapper-sc-qpz3fo-0 eHltcn\" style=\"font-size: 20px; line-height: 32px; padding: 8px 16px; text-transform: capitalize; display: flex; -webkit-box-pack: justify; justify-content: space-between; -webkit-box-align: center; align-items: center; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: Roboto, Helvetica, Arial, sans-serif;\">Mô Tả Sản Phẩm</h2><div class=\"content\" style=\"width: 920px; padding: 0px 16px 16px; display: inline-block; color: rgb(36, 36, 36); text-align: justify; border-radius: 4px; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 14px;\"><div class=\"ToggleContent__Wrapper-sc-1dbmfaw-1 cqXrJr\"><div class=\"ToggleContent__View-sc-1dbmfaw-0 wyACs\" style=\"position: relative;\"><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Sau nhiều chộn rộn của những ngày đón năm mới, tháng 2 là tháng của Tình yêu, và cũng là lúc để chúng ta tạm lắng lại, dành nhiều thời gian hơn cho chính mình, cho những người quan trọng và những điều thật sự có ý nghĩa trong cuộc sống. Trong ấn phẩm này, ELLE cũng mời bạn cùng gặp lại Jennie (BlackPink) trong một không gian vô cùng ấm cúng và gần gũi khi cô diện lên mình những thiết kế thời trang và trang sức mới nhất của thương hiệu Chanel; cùng hai người phụ nữ có mối tương quan đặc biệt với hoa cỏ trong chuyên mục ELLE Voices với chủ đề \"Flower Therapy\" - Chữa lành với hoa. Chuyên mục Thời trang: Cá nhân hoá và thể hiện cá tính với trang sức; Cảm hứng mặc đẹp cho những mẹ bầu từ các ngôi sao; Bộ hình đặc biệt: \"The Stories of Crush\" Chuyên mục Làm Đẹp: Bộ hình Làm đẹp lấy cảm hứng từ vẻ đẹp của những mỹ nhân Hồng Kông nổi tiếng; BTV ELLE lựa<br>chọn những sản phẩm làm đẹp mới đáng thử nhất cho tháng 2; Nước hoa: Vì Tình - Tình yêu có vị gì?<br>Chuyên mục Văn hoá - Phong cách sống: ELLE Voices - Liệu pháp chữa lành với hoa; Du lịch: ELLE 4 gợi ý 4 điểm đến lý<br>thú cho năm 2022.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Giá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, thuế nhập khẩu (đối với đơn hàng giao từ nước ngoài có giá trị trên 1 triệu đồng).....</p></div></div></div>', '<h2 class=\"BlockTitle__Wrapper-sc-qpz3fo-0 eHltcn\" style=\"font-size: 20px; line-height: 32px; padding: 8px 16px; text-transform: capitalize; display: flex; -webkit-box-pack: justify; justify-content: space-between; -webkit-box-align: center; align-items: center; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: Roboto, Helvetica, Arial, sans-serif;\">[EN]Mô Tả Sản Phẩm</h2><div class=\"content\" style=\"width: 920px; padding: 0px 16px 16px; display: inline-block; color: rgb(36, 36, 36); text-align: justify; border-radius: 4px; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 14px;\"><div class=\"ToggleContent__Wrapper-sc-1dbmfaw-1 cqXrJr\"><div class=\"ToggleContent__View-sc-1dbmfaw-0 wyACs\" style=\"position: relative;\"><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Sau nhiều chộn rộn của những ngày đón năm mới, tháng 2 là tháng của Tình yêu, và cũng là lúc để chúng ta tạm lắng lại, dành nhiều thời gian hơn cho chính mình, cho những người quan trọng và những điều thật sự có ý nghĩa trong cuộc sống. Trong ấn phẩm này, ELLE cũng mời bạn cùng gặp lại Jennie (BlackPink) trong một không gian vô cùng ấm cúng và gần gũi khi cô diện lên mình những thiết kế thời trang và trang sức mới nhất của thương hiệu Chanel; cùng hai người phụ nữ có mối tương quan đặc biệt với hoa cỏ trong chuyên mục ELLE Voices với chủ đề \"Flower Therapy\" - Chữa lành với hoa. Chuyên mục Thời trang: Cá nhân hoá và thể hiện cá tính với trang sức; Cảm hứng mặc đẹp cho những mẹ bầu từ các ngôi sao; Bộ hình đặc biệt: \"The Stories of Crush\" Chuyên mục Làm Đẹp: Bộ hình Làm đẹp lấy cảm hứng từ vẻ đẹp của những mỹ nhân Hồng Kông nổi tiếng; BTV ELLE lựa<br>chọn những sản phẩm làm đẹp mới đáng thử nhất cho tháng 2; Nước hoa: Vì Tình - Tình yêu có vị gì?<br>Chuyên mục Văn hoá - Phong cách sống: ELLE Voices - Liệu pháp chữa lành với hoa; Du lịch: ELLE 4 gợi ý 4 điểm đến lý<br>thú cho năm 2022.</p><p style=\"margin: 5px 0px 12px; line-height: 21px;\">Giá sản phẩm trên Tiki đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như phí vận chuyển, phụ phí hàng cồng kềnh, thuế nhập khẩu (đối với đơn hàng giao từ nước ngoài có giá trị trên 1 triệu đồng).....</p></div></div></div>', 1, 0, 0, 0, 0, '2022-08-23 16:50:18', '2022-08-23 16:50:18'),
(121, 12, 0, '/certificates/W1jCnJFZ8ykCM40EuPovIozITxR1Pg3iOd1PeCBW.jpeg', NULL, 'PHÁT TRIỂN THƯƠNG MẠI BIÊN GIỚI TỈNH ĐỒNG THÁP GIAI ĐOẠN 2021 – 2025', 'BORDER TRADE DEVELOPMENT DONG THAP PROVINCE FOR 2021 – 2025', NULL, '<div class=\"l7ghb35v kjdc1dyq kmwttqpk gh25dzvf jikcssrz n3t5jt4f\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">UBND tỉnh Đồng Tháp vừa ban hành Kế hoạch Phát triển thương mại biên giới tỉnh Đồng Tháp giai đoạn 2021 - 2025. Kế hoạch được triển khai thực hiện trên phạm vi huyện Tân Hồng, Hồng Ngự và TP Hồng Ngự. </div><div dir=\"auto\" style=\"font-family: inherit;\">Mục tiêu cụ thể của kế hoạch nhằm đưa tổng mức bán lẻ hàng hóa và dịch vụ ở địa bàn khu vực biên giới đạt mức tăng trưởng từ 11% - 12% hàng năm trong giai đoạn 2021 - 2025.</div></div><div class=\"l7ghb35v kjdc1dyq kmwttqpk gh25dzvf jikcssrz n3t5jt4f\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\"> <span style=\"font-family: inherit;\"><a tabindex=\"-1\" style=\"color: rgb(56, 88, 152); cursor: pointer; font-family: inherit;\"></a></span>Giai đoạn 2021 - 2025, giá trị kim ngạch xuất nhập khẩu hàng hóa biên mậu qua các cửa khẩu tăng 8%/năm. Đến năm 2025, kim ngạch xuất nhập khẩu hàng hóa biên mậu đạt 300 triệu USD; trong đó, kim ngạch xuất khẩu hàng hóa biên mậu đạt 174,8 triệu USD và kim ngạch nhập khẩu hàng hóa biên mậu đạt 125 triệu USD.</div></div><div class=\"l7ghb35v kjdc1dyq kmwttqpk gh25dzvf jikcssrz n3t5jt4f\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Bên cạnh đó, hoàn thành cơ bản hạ tầng kỹ thuật khu kinh tế cửa khẩu Đồng Tháp và các cửa khẩu, nhất là hai cửa khẩu quốc tế. Hoàn thành việc nâng cấp cửa khẩu Thường Phước thành cửa khẩu quốc tế đường bộ, đường sông; cặp cửa khẩu Thường Phước (Đồng Tháp) - KohRoKa (Prây-veng) được bổ sung vào Nghị định thư vận tải đường bộ giữa hai nước Việt Nam và Campuchia; hoàn chỉnh hồ sơ nâng cấp cửa khẩu chính Mộc Rá trình Thủ tướng Chính phủ.</div></div><div class=\"l7ghb35v kjdc1dyq kmwttqpk gh25dzvf jikcssrz n3t5jt4f\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Để đạt được những mục tiêu đề ra, UBND tỉnh sẽ rà soát, tích hợp quy hoạch phát triển thương mại trong đó có thương mại biên giới vào quy hoạch tỉnh, quy hoạch vùng và quốc gia; xây dựng và hoàn thiện cơ chế, chính sách về phát triển thương mại biên giới; phát triển kết cấu hạ tầng thương mại khu vực biên giới. Đồng thời duy trì các hoạt động xúc tiến thương mại qua biên giới Đồng Tháp - Campuchia; phát triển đội ngũ thương nhân, doanh nghiệp hoạt động tại địa bàn khu vực biên giới; nâng cao chất lượng nguồn nhân lực làm công tác phát triển thương mại biên giới.</div></div><div class=\"l7ghb35v kjdc1dyq kmwttqpk gh25dzvf jikcssrz n3t5jt4f\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">Song song đó, triển khai các hoạt động khuyến khích, thúc đẩy phát triển các mặt hàng tiềm năng, lợi thế của địa phương; phát triển thương mại hàng hóa và dịch vụ khu vực gắn với hoạt động du lịch; phát triển hệ thống dịch vụ hỗ trợ thương mại khu vực biên giới; kiểm tra, giám sát hoạt động thương mại biên giới..</div></div><div class=\"l7ghb35v kjdc1dyq kmwttqpk gh25dzvf jikcssrz n3t5jt4f\" style=\"overflow-wrap: break-word; margin: 0.5em 0px 0px; white-space: pre-wrap; font-family: &quot;Segoe UI Historic&quot;, &quot;Segoe UI&quot;, Helvetica, Arial, sans-serif; color: rgb(5, 5, 5); font-size: 15px;\"><div dir=\"auto\" style=\"font-family: inherit;\">BAN BIÊN TẬP</div></div>', '<p>Dong Thap Provincial People\'s Committee has just issued the Dong Thap Provincial Border Trade Development Plan for the period of 2021 - 2025. The plan is implemented in Tan Hong, Hong Ngu and Hong Ngu districts.</p><p>The specific goal of the plan is to bring the total retail sales of goods and services in the border area to an annual growth rate of 11% - 12% in the period 2021 - 2025.</p><p>&nbsp;In the period of 2021 - 2025, the value of import and export turnover of cross-border goods through border gates will increase by 8% per year. By 2025, the import-export turnover of cross-border goods will reach 300 million USD; in which, the export turnover of cross-border goods reached 174.8 million USD and the import turnover of border goods reached 125 million USD.</p><p>Besides, basically completing technical infrastructure of Dong Thap border gate economic zone and border gates, especially two international border gates. Completing the upgrading of Thuong Phuoc border gate into an international border gate by road and river; the border gate pair of Thuong Phuoc (Dong Thap) - KohRoKa (Pray-veng) was added to the Road Transport Protocol between Vietnam and Cambodia; complete the dossier to upgrade Moc Ra main border gate and submit it to the Prime Minister.</p><p>In order to achieve the set objectives, the Provincial People\'s Committee will review and integrate the commercial development planning including border trade into the provincial, regional and national planning; formulating and perfecting mechanisms and policies on border trade development; development of commercial infrastructure in border areas. At the same time, maintaining trade promotion activities across the Dong Thap - Cambodia border; develop a contingent of traders and enterprises operating in border areas; improve the quality of human resources for border trade development.</p><p>Simultaneously, implementing activities to encourage and promote the development of potential products and local advantages; develop regional trade in goods and services associated with tourism activities; develop a system of services to support trade in border areas; inspect and supervise border trade activities..</p><p>EDITORIAL BOARD</p>', 1, 0, 1, 0, 0, '2022-08-25 04:06:29', '2022-08-25 04:07:36'),
(122, 1, 0, '/certificates/7HyZGRjE0Ve9FpzOMyZun7kyTseCl5u7LHSzuyQB.png', NULL, 'Triển lãm và hội nghị liên phương thức Châu Phi 2022 - Intermodal Africa', 'Intermodal Africa King Fahd Palace Hotel Dakar, Senegal Tuesday 28 to Thursday 30 June 2022', NULL, '<p>Intermodal Africa tiếp tục là Triển lãm và Hội nghị Logistics về Cảng, Vận tải biển và Vận tải hàng năm lớn nhất trên lục địa Châu Phi, sau 27 năm thành công.</p><p>Triển lãm và Hội nghị liên phương thức Châu Phi 2022 lần thứ 27 sẽ diễn ra tại Senegal từ thứ Ba ngày 28 đến thứ Năm ngày 30 tháng 6 tại khách sạn 5 sao sang trọng King Fahd Palace Hotel Dakar trong một môi trường khách sạn 5 sao chuyên nghiệp.</p><p>Sự kiện vinh dự được tổ chức bởi PORT AUTONOME de DAKAR (PAD) / PORT AUTHORITY of DAKAR và được sự hỗ trợ hoàn toàn của DP WORLD.</p><p>Chương trình Hội nghị kéo dài hai ngày sẽ có 30 diễn giả hội nghị giao thông vận tải và hậu cần đẳng cấp thế giới giải quyết các vấn đề thời sự và thách thức về thương mại và đầu tư toàn cầu và khu vực với sự tham dự của 300 quan chức chính phủ cấp cao, hiệu trưởng ngành, học giả, thạc sĩ điều hành cảng cao cấp, kỹ sư bến cảng. , kỹ sư cảng, giám sát bảo trì và người ra quyết định mua sắm cùng với các chủ hàng hàng đầu khu vực, chủ hàng, nhà nhập khẩu / xuất khẩu, hãng tàu, công ty giao nhận, công ty hậu cần, cảng, công ty vận hành nhà ga, nhà khai thác đường sắt, nhà cung cấp thiết bị cảng và dịch vụ từ các quốc gia trên toàn Châu Âu, Trung Đông và Châu Phi (EMEA).</p><p>Sẽ có cơ hội thương mại cho 40 nhà triển lãm và nhà tài trợ kết nối an toàn với các đại biểu Trực tiếp tại sự kiện thương mại Hội nghị và Triển lãm hàng hải quốc tế hàng năm lớn dành cho Châu Phi này.</p><p>Đặt trước lựa chọn gian hàng triển lãm đầu tiên của bạn từ sơ đồ tầng triển lãm và đăng ký một phái đoàn hội nghị.</p><p>Chúng tôi mong được chào đón bạn đến với Dakar và đến với Triển lãm và Hội nghị Hậu cần Vận tải, Vận chuyển và Cảng biển lớn nhất Châu Phi diễn ra từ Thứ Ba ngày 28 đến Thứ Năm ngày 30 tháng 6 tại khách sạn 5 sao sang trọng King Fahd Palace Hotel Dakar trong một môi trường khách sạn 5 sao chuyên nghiệp .</p>', '<p>Intermodal Africa continues to be the biggest annual Ports, Shipping and Transport Logistics Exhibition and Conference on the African continent now in its 27th successful year.</p><p>The 27th Intermodal Africa 2022 Exhibition and Conference will take place in Senegal from Tuesday 28 to Thursday 30 June at the luxurious 5 star King Fahd Palace Hotel Dakar in a professional 5 star hotel environment.</p><p>The event is honoured to be hosted by the PORT AUTONOME de DAKAR (PAD) / PORT AUTHORITY of DAKAR and fully supported by DP WORLD.</p><p>A two days Conference Programme will feature 30 world-class transportation and logistics conference speakers addressing topical issues and challenges on global and regional trade and investment attended by a gathering of 300 senior government officials, industry principals, academics, senior executive harbour masters, harbour engineers, port engineers, maintenance supervisors and procurement decision makers together with the region’s leading shippers, cargo owners, importers / exporters, shipping lines, freight forwarders, logistics companies, ports, terminal operating companies, railway operators, port equipment and services suppliers from countries throughout Europe, Middle East and Africa (EMEA).</p><p>There will be the commercial opportunity for 40 exhibitors and sponsors to network safely with the delegates In Person at this major annual international maritime transport Exhibition and Conference trade event for Africa.</p><p>Reserve your first choice of exhibition stand from the exhibition floorplan and register a conference delegation.</p><p>We look forward to welcoming you to Dakar and to the biggest annual Ports, Shipping and Transport Logistics Exhibition and Conference in Africa taking place from Tuesday 28 to Thursday 30 June at the luxurious 5 star King Fahd Palace Hotel Dakar in a professional 5 star hotel environment.</p><p><br></p>', 1, 0, 1, 0, 0, '2022-08-25 04:48:51', '2022-08-25 04:50:04'),
(123, 1, 0, '/certificates/omxbKDThQd2O3DNdfHUVQsPrzkq1sqRrOX7aGpEV.png', NULL, 'Triển lãm và Hội nghị Philippine Ports and Shipping', 'Philippine Ports and Shipping', NULL, '<p>Philippine Ports and Shipping là Triển lãm và Hội nghị B2B về Cảng, Vận tải biển và Giao thông Vận tải hai năm một lần lớn nhất trong BIMP EAGA - Brunei Indonesia Malaysia Khu vực tăng trưởng Đông ASEAN của Philippines hiện đã bước sang năm thứ 11 thành công.</p><p>Chúng tôi rất vui mừng được mời bạn tham gia Hội nghị và Triển lãm Cảng và Vận tải biển Philippine 2022 lần thứ 11 diễn ra từ Thứ Ba ngày 21 đến Thứ Năm ngày 23 tháng 6 tại khách sạn 5 sao Sofitel Manila sang trọng trong một môi trường khách sạn 5 sao chuyên nghiệp.</p><p>Chương trình Hội nghị kéo dài hai ngày sẽ có sự tham gia của 30 diễn giả hội nghị tầm cỡ thế giới giải quyết các vấn đề thời sự và thách thức đối với BIMP EAGA - Brunei Indonesia Malaysia Philippines Khu vực tăng trưởng Đông ASEAN Giao thông vận tải và hậu cần khu vực với sự tham dự của 300 quan chức chính phủ cấp cao, các hiệu trưởng ngành, các nhà hoạch định, học giả, thạc sĩ bến cảng, kỹ sư bến cảng, kỹ sư cảng, giám sát bảo trì và người ra quyết định mua sắm cùng với các chủ hàng hàng đầu trong khu vực, chủ hàng, nhà nhập khẩu / xuất khẩu, hãng tàu, công ty giao nhận vận tải, công ty hậu cần, cảng, công ty vận hành nhà ga, nhà khai thác đường sắt, cảng các nhà cung cấp thiết bị và dịch vụ từ các nước trong BIMP EAGA - Brunei Indonesia Malaysia Philippines Khu vực tăng trưởng Đông ASEAN.</p><p>Sẽ có Triển lãm quy tụ 40 hãng tàu quốc tế, cảng container, công ty hậu cần, công ty CNTT, thiết bị cảng container, nhà cung cấp dịch vụ và nhà tài trợ sự kiện.</p><p>Bạn được mời tham gia sự kiện này bằng cách đặt trước gian hàng triển lãm và đăng ký các đại biểu hội nghị tham dự chương trình hội nghị diễn ra đồng thời trong hai ngày.</p><p>Chúng tôi mong đợi sự tham gia của bạn tại Triển lãm và Hội nghị Hậu cần Vận tải, Vận tải biển và Cảng biển hai năm một lần lớn nhất tại BIMP EAGA - Brunei Indonesia Malaysia Philippines Khu vực tăng trưởng Đông ASEAN diễn ra trong năm nay từ Thứ Ba ngày 21 đến Thứ Năm ngày 23 tháng 6 tại khách sạn 5 sao sang trọng Sofitel Manila trong môi trường khách sạn 5 sao chuyên nghiệp.</p>', '<p>Philippine Ports and Shipping is the biggest biennial Ports, Shipping and Transport Logistics B2B Exhibition and Conference in BIMP EAGA – Brunei Indonesia Malaysia Philippines East ASEAN Growth Area now in its 11th successful year.</p><p>We are delighted to invite you to participate in the 11th Philippine Ports and Shipping 2022 Exhibition and Conference taking place from Tuesday 21 to Thursday 23 June at the luxurious 5 star Sofitel Manila in a professional 5 star hotel environment.</p><p>A two days Conference Programme will feature 30 world-class conference speakers addressing topical issues and challenges for BIMP EAGA – Brunei Indonesia Malaysia Philippines East ASEAN Growth Area regional transportation and logistics attended by a gathering of 300 senior government officials, industry principals, decision makers, academics, harbour masters, harbour engineers, port engineers, maintenance supervisors and procurement decision makers together with the region’s leading shippers, cargo owners, importers / exporters, shipping lines, freight forwarders, logistics companies, ports, terminal operating companies, railway operators, port equipment and services suppliers from countries throughout the BIMP EAGA – Brunei Indonesia Malaysia Philippines East ASEAN Growth Area region.</p><p>There will be an Exhibition of 40 international shipping lines, container ports, logistics companies, IT companies, container terminal equipment, services providers and event sponsors.</p><p>You are invited to participate in this event by reserving an exhibition stand and registering conference delegates to attend the concurrent two days conference programme.</p><p>We look forward to your participation at the biggest biennial Ports, Shipping and Transport Logistics Exhibition and Conference in BIMP EAGA – Brunei Indonesia Malaysia Philippines East ASEAN Growth Area region taking place this year from Tuesday 21 to Thursday 23 June at the luxurious 5 star Sofitel Manila in a professional 5 star hotel environment.</p><div><br></div>', 1, 0, 1, 0, 0, '2022-08-25 06:16:20', '2022-08-25 06:16:20');
INSERT INTO `news` (`id`, `category_id`, `product_category_id`, `img`, `price`, `title_vn`, `title_en`, `youtube_url`, `content_vn`, `content_en`, `approved`, `is_hot`, `is_new`, `is_paid`, `member_id`, `created_at`, `updated_at`) VALUES
(124, 5, 0, '/certificates/WHA8fJnsWw0Gm9xFV9pq4IsRYQr7dAMrvnDeFjRo.jpeg', NULL, 'BẢNG GIÁ SUNRISE CITY- CITY VIEW CẬP NHẬT GIÁ BÁN T8.2022 (1PN-2.55TỶ), (2PN-3.5TỶ), (3PN-4.3TỶ)', 'BẢNG GIÁ SUNRISE CITY- CITY VIEW CẬP NHẬT GIÁ BÁN T8.2022 (1PN-2.55TỶ), (2PN-3.5TỶ), (3PN-4.3TỶ)', NULL, '<p><span class=\"re__section-title\" style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box; font-size: 18px; margin-bottom: 24px; line-height: 28px; border-width: initial; border-style: none; color: rgb(44, 44, 44); display: block; font-family: &quot;Nunito Bold&quot; !important;\">Thông tin mô tả</span></p><div class=\"re__section-body re__detail-content js__section-body js__pr-description js__tracking\" trackingid=\"lead-phone-ldp\" trackinglabel=\"loc=Sale-Listing Details-body,prid=32960725\" style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box; font-family: &quot;Roboto Regular&quot;; font-size: 14px; line-height: 24px; border-width: initial; border-style: none; color: rgb(0, 0, 0);\">Sunrise City View.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ OT 38m2 giá 1.7 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Ot 45m2 giá 1.8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 2PN 74m2 giá 3.3 tỷ thô.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 2PN 74 m2 - 76m2 giá 3.7 tỷ full.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 3PN 105m2 giá 4.8 tỷ full.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 3PN 109m2 giá 4.45 tỷ thô.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 3PN 109m2 giá 5.2 tỷ full.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Sunrise City:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Khu North:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 40m2 - 56m2 giá 1.9 - 2.7 tỷ. Hỗ trợ vay ngân hàng 70% giá trị căn hộ trong 20 năm.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 65m2 giá 3,2 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 77m2 giá 3,3 - 3.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 95m2 giá 3,8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 97m2 giá 3,9 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 108m2 giá 4.3 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 112m2 giá 4.2 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 124m2 giá 4.9 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Khu Central:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 76m2 giá 3.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 99m2 giá 4 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 120m2 giá 5,2 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 147m2 giá 5.7 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Khu South:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 59m2, 1PN. Giá bán: 2.8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 69m2, 2PN. Giá bán: 3 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 99m2, giá bán 4 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 102m2, 2PN, 2WC. Giá bán: 4.05 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 106m2, 2PN. Giá bán 4.4 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 130m2, 3PN. Giá bán: 5.3 - 6.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 162m2, 4PN. Giá bán: 6.5 - 8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ 288m2 nhà mới 100% bán giá 11 tỷ, nhà thô.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ 288m2 nội thất cao cấp Châu Âu, sân vườn rộng, vào ở liền giá 14 - 15 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Diện tích 347m2 + 75m2 sân vườn = 422m2, có hồ bơi, giao nhà thô, giá 18,5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">- Diện tích 308m2 + 232m2 sân vườn = 540m2, giá 20 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">- Căn penthouse thông tầng diện tích 295m2, giá 12 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ penthouse đẹp rộng nhất Sunrise City 550m2 + 200m2 sân vườn, nhà mới 100% bán giá 22.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ penthouse đẹp nhất Sunrise 850m2 có 5 ban công căn góc view toàn thành phố bán 32 tỷ. Tiện ích 5 sao: Ngân hàng, siêu thị, spa, hồ bơi tràn, trung tâm thương mại...<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Vì sao quý khách nên chọn chúng tôi để mua hoặc thuê căn hộ Sunrise City.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\"><br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Bằng kinh nghiệm hơn 10 năm trong lĩnh vực BĐS chúng tôi cam kết.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Luôn thương lượng cho anh/chị giá cả tốt nhất.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Hỗ trợ thủ tục pháp lý nhanh gọn, chuyên nghiệp.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Tư vấn thiết kế nội thất hoàn toàn miễn phí.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Giảm từ 5 - 10% trên các hóa đơn thanh toán mua hàng điện máy và thiết bị điện tử.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Uy tín - nhiệt tình - giá tốt nhất.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Nắm nhiều key, xem nhà ngay. 24/7.</div>', '<p><span class=\"re__section-title\" style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box; font-size: 18px; margin-bottom: 24px; line-height: 28px; border-width: initial; border-style: none; color: rgb(44, 44, 44); display: block; font-family: &quot;Nunito Bold&quot; !important;\">Thông tin mô tả</span></p><div class=\"re__section-body re__detail-content js__section-body js__pr-description js__tracking\" trackingid=\"lead-phone-ldp\" trackinglabel=\"loc=Sale-Listing Details-body,prid=32960725\" style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box; font-family: &quot;Roboto Regular&quot;; font-size: 14px; line-height: 24px; border-width: initial; border-style: none; color: rgb(0, 0, 0);\">Sunrise City View.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ OT 38m2 giá 1.7 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Ot 45m2 giá 1.8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 2PN 74m2 giá 3.3 tỷ thô.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 2PN 74 m2 - 76m2 giá 3.7 tỷ full.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 3PN 105m2 giá 4.8 tỷ full.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 3PN 109m2 giá 4.45 tỷ thô.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 3PN 109m2 giá 5.2 tỷ full.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Sunrise City:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Khu North:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 40m2 - 56m2 giá 1.9 - 2.7 tỷ. Hỗ trợ vay ngân hàng 70% giá trị căn hộ trong 20 năm.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 65m2 giá 3,2 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 77m2 giá 3,3 - 3.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 95m2 giá 3,8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 97m2 giá 3,9 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 108m2 giá 4.3 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 112m2 giá 4.2 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 124m2 giá 4.9 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Khu Central:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 76m2 giá 3.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 99m2 giá 4 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 120m2 giá 5,2 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 147m2 giá 5.7 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Khu South:<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 59m2, 1PN. Giá bán: 2.8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 69m2, 2PN. Giá bán: 3 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 99m2, giá bán 4 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 102m2, 2PN, 2WC. Giá bán: 4.05 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 106m2, 2PN. Giá bán 4.4 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 130m2, 3PN. Giá bán: 5.3 - 6.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ 162m2, 4PN. Giá bán: 6.5 - 8 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ 288m2 nhà mới 100% bán giá 11 tỷ, nhà thô.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ 288m2 nội thất cao cấp Châu Âu, sân vườn rộng, vào ở liền giá 14 - 15 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Diện tích 347m2 + 75m2 sân vườn = 422m2, có hồ bơi, giao nhà thô, giá 18,5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">- Diện tích 308m2 + 232m2 sân vườn = 540m2, giá 20 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">- Căn penthouse thông tầng diện tích 295m2, giá 12 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ penthouse đẹp rộng nhất Sunrise City 550m2 + 200m2 sân vườn, nhà mới 100% bán giá 22.5 tỷ.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Căn hộ penthouse đẹp nhất Sunrise 850m2 có 5 ban công căn góc view toàn thành phố bán 32 tỷ. Tiện ích 5 sao: Ngân hàng, siêu thị, spa, hồ bơi tràn, trung tâm thương mại...<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Vì sao quý khách nên chọn chúng tôi để mua hoặc thuê căn hộ Sunrise City.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\"><br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">Bằng kinh nghiệm hơn 10 năm trong lĩnh vực BĐS chúng tôi cam kết.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Luôn thương lượng cho anh/chị giá cả tốt nhất.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Hỗ trợ thủ tục pháp lý nhanh gọn, chuyên nghiệp.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Tư vấn thiết kế nội thất hoàn toàn miễn phí.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Giảm từ 5 - 10% trên các hóa đơn thanh toán mua hàng điện máy và thiết bị điện tử.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Uy tín - nhiệt tình - giá tốt nhất.<br style=\"-webkit-tap-highlight-color: transparent; box-sizing: border-box;\">+ Nắm nhiều key, xem nhà ngay. 24/7.</div>', 0, 0, 0, 0, 6, '2022-08-29 14:31:41', '2022-08-29 14:31:41'),
(125, 4, 0, '/certificates/PfD0xfNZ6APHhOf0VRfkQDbt8JAel5Zwdn24dBW0.jpeg', NULL, 'Cần Mua ACD', 'Cần Mua ACD', NULL, '<p>Test noi dung can mua</p>', '<p>Test noi dung can mua</p>', 1, 0, 0, 0, 7, '2022-08-29 15:28:09', '2022-08-29 15:30:31'),
(126, 2, 0, '/certificates/EARGmfEmIut4zB7Hy6jrR4sAZkMma8TG0oY5Vvxh.png', NULL, 'Test Tin VSG', '[EN] Test New VSG', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/RsooRrsmYkk\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-29 15:37:12', '2022-09-01 15:26:39'),
(127, 13, 0, '/certificates/klLaHTwtR9E8jzstytbRRPfzFEGdG42GJSVDnLsr.png', NULL, 'CHUỖI CUNG ỨNG LÀ GÌ? CÁCH VẬN HÀNH CHUỖI CUNG ỨNG HIỆU QUẢ', '[EN] CHUỖI CUNG ỨNG LÀ GÌ? CÁCH VẬN HÀNH CHUỖI CUNG ỨNG HIỆU QUẢ', NULL, '<p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 14px; text-size-adjust: none; line-height: 1.5; text-align: justify; color: rgb(33, 37, 41); font-family: Roboto, sans-serif;\">Chuỗi cung ứng (Supply Chain) là một hệ thống những tổ chức, hoạt động, thông tin, con người và các nguồn lực liên quan trực tiếp hay gián tiếp đến vận chuyển hàng hóa hay dịch vụ từ nhà sản xuất, nhà cung cấp đến tay người tiêu dùng. Chuỗi cung ứng không chỉ bao gồm nhà sản xuất, nhà cung cấp mà còn liên quan đến nhà vận chuyển, nhà kho, nhà bán lẻ và khách hàng.</p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 14px; text-size-adjust: none; line-height: 1.5; text-align: justify; color: rgb(33, 37, 41); font-family: Roboto, sans-serif;\">Chuỗi cung ứng của một công ty là bao gồm những phòng ban trong công ty (phòng marketing, phòng kinh doanh, phòng hậu cần, phòng dịch vụ khách hàng,…). Các phòng ban này sẽ được liên kết chặt chẽ với nhau, để cùng đi đến mục đích là đáp ứng những nhu cầu của khách hàng.</p>', '<p>[EN]&nbsp;<span style=\"color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 14px; text-align: justify;\">Chuỗi cung ứng (Supply Chain) là một hệ thống những tổ chức, hoạt động, thông tin, con người và các nguồn lực liên quan trực tiếp hay gián tiếp đến vận chuyển hàng hóa hay dịch vụ từ nhà sản xuất, nhà cung cấp đến tay người tiêu dùng. Chuỗi cung ứng không chỉ bao gồm nhà sản xuất, nhà cung cấp mà còn liên quan đến nhà vận chuyển, nhà kho, nhà bán lẻ và khách hàng.</span></p><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 14px; text-size-adjust: none; line-height: 1.5; text-align: justify; color: rgb(33, 37, 41); font-family: Roboto, sans-serif;\">Chuỗi cung ứng của một công ty là bao gồm những phòng ban trong công ty (phòng marketing, phòng kinh doanh, phòng hậu cần, phòng dịch vụ khách hàng,…). Các phòng ban này sẽ được liên kết chặt chẽ với nhau, để cùng đi đến mục đích là đáp ứng những nhu cầu của khách hàng.</p>', 1, 0, 0, 0, 0, '2022-08-29 15:46:05', '2022-08-29 15:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(10) NOT NULL,
  `type` int(10) DEFAULT '1',
  `name` varchar(1024) DEFAULT NULL,
  `img` varchar(1024) DEFAULT NULL,
  `link` varchar(1024) DEFAULT NULL,
  `is_show` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `type`, `name`, `img`, `link`, `is_show`, `created_at`, `updated_at`) VALUES
(4, 1, 'Công Ty Cổ Phầm APSCD', '/certificates/cb0ruxRheu9YgCwN2Man68QXC7xouYcLgBonSdsZ.jpeg', '#', 1, '2022-07-11 19:24:27', '2022-08-18 16:30:14'),
(5, 2, 'Ấn phẩm mới nhất 2022', '/certificates/IaOb1lC9EMleCbasNKefA4N146SYsTfxNRN1ABHk.png', '#', 1, '2022-07-11 19:24:27', '2022-08-29 15:50:15'),
(6, 1, 'Công Ty APCSD', '/certificates/jQYr5yNKwemsdHpu3cLUaHKhmRGAMHnRMP4MVmRk.jpeg', '#', 1, '2022-08-07 06:18:29', '2022-08-18 16:30:02'),
(8, 1, 'TRANSPORT EVENTS', '/certificates/uMLHcGOq4mbNola5zq0Q4VG13RC2yBVT5vjkUdTC.png', 'www.transportevents.com', 1, '2022-08-25 04:37:26', '2022-08-25 04:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `ports`
--

CREATE TABLE `ports` (
  `id` int(10) NOT NULL,
  `port_nm_vn` varchar(1024) DEFAULT NULL,
  `port_nm_en` varchar(1024) DEFAULT NULL,
  `country_id` int(1) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ports`
--

INSERT INTO `ports` (`id`, `port_nm_vn`, `port_nm_en`, `country_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ALGER (DZALG), DZ', 'ALGER (DZALG), DZ', 1, 0, '2022-07-05 03:44:50', '2022-07-05 03:44:52'),
(2, 'VLORE (ALVOA), AL', 'VLORE (ALVOA), AL', 1, 0, '2022-07-05 03:44:50', '2022-07-05 03:44:53'),
(3, 'ANNABA (DZAAE), DZ', 'ANNABA (DZAAE), DZ', 1, 0, '2022-07-05 03:44:52', '2022-07-05 03:44:54'),
(4, 'VLORE (ALVOA)', 'VLORE (ALVOA)', 1, 0, '2022-07-05 03:44:51', '2022-07-04 23:38:09'),
(5, 'NANSHA', 'NANSHA', 4, 1, '2022-08-07 05:26:51', '2022-08-07 05:26:51'),
(6, 'NAOETSU', 'NAOETSU', 5, 1, '2022-08-07 05:27:31', '2022-08-07 05:27:31'),
(7, 'NAPIER', 'NAPIER', 6, 1, '2022-08-07 05:28:06', '2022-08-07 05:28:06'),
(8, 'HOCHIMINH', 'HOCHIMINH', 1, 1, '2022-08-07 05:28:34', '2022-08-07 05:28:34'),
(9, 'HAIPHONG', 'HAIPHONG', 1, 1, '2022-08-07 05:28:44', '2022-08-07 05:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(10) NOT NULL,
  `name_vn` varchar(1024) DEFAULT NULL,
  `name_en` varchar(1024) DEFAULT NULL,
  `show_menu` tinyint(4) DEFAULT '1',
  `order` int(11) DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `name_vn`, `name_en`, `show_menu`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Poster', 'Poster', 1, 2, '2022-08-07 06:08:59', '2022-07-03 03:50:36', '2022-08-07 06:08:59'),
(2, 'Tạp Chí', 'Magazines', 1, 1, NULL, '2022-07-03 03:50:36', '2022-08-23 16:19:56'),
(4, 'báo', NULL, 1, 0, '2022-08-18 04:57:49', '2022-08-18 04:57:42', '2022-08-18 04:57:49'),
(5, 'Ấn Phẩm', 'Publications', 1, 0, NULL, '2022-08-18 16:00:11', '2022-08-23 16:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `recruitments`
--

CREATE TABLE `recruitments` (
  `id` int(12) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `title_vn` varchar(1024) DEFAULT NULL,
  `title_en` varchar(1024) DEFAULT NULL,
  `content_vn` longtext,
  `content_en` longtext,
  `approved` int(1) DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recruitments`
--

INSERT INTO `recruitments` (`id`, `img`, `title_vn`, `title_en`, `content_vn`, `content_en`, `approved`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06'),
(2, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06'),
(3, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06'),
(4, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06'),
(5, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06'),
(6, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06'),
(7, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06'),
(8, 'https://smartmag.theme-sphere.com/pro-mag/wp-content/uploads/sites/18/2021/01/Depositphotos_482807598_xl-2015-1-450x293.jpg', 'coder', 'coder', 'coder', 'coder', 1, NULL, '2022-07-30 16:06:05', '2022-07-30 16:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `scenarios`
--

CREATE TABLE `scenarios` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `boss_port_id` int(11) DEFAULT NULL COMMENT '#cảng dỡ',
  `unloading_port_id` int(11) DEFAULT NULL COMMENT '#cảng dỡ',
  `transit_port_id` int(11) DEFAULT NULL,
  `ship_id` int(11) DEFAULT NULL COMMENT '#tàu id',
  `agent_id` int(11) DEFAULT NULL,
  `departure_day` date DEFAULT NULL COMMENT '#ngày khởi hành',
  `arrival_date` date DEFAULT NULL COMMENT '#ngày đến',
  `total_date` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scenarios`
--

INSERT INTO `scenarios` (`id`, `country_id`, `boss_port_id`, `unloading_port_id`, `transit_port_id`, `ship_id`, `agent_id`, `departure_day`, `arrival_date`, `total_date`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 2, 1, 1, 1, '2022-08-12', '2022-08-15', 3, NULL, '2022-08-23 16:56:14', '2022-08-23 16:56:14'),
(9, 1, 3, 8, 8, 2, 1, '2022-08-01', '2022-08-12', 11, NULL, '2022-08-23 16:57:41', '2022-08-23 16:57:41'),
(10, 1, 3, 9, 3, 3, 3, '2022-08-11', '2022-08-20', 9, NULL, '2022-08-23 16:58:20', '2022-08-23 16:58:20'),
(11, 1, 1, 2, 2, 2, 1, '2022-12-11', '2023-01-15', 35, NULL, '2022-08-29 15:41:01', '2022-08-29 15:41:48'),
(12, 1, 1, 8, 1, 1, 1, '2022-09-01', '2022-09-05', 4, NULL, '2022-09-03 06:22:10', '2022-09-03 06:22:10'),
(13, 1, 3, 8, 4, 4, 3, '2022-09-01', '2022-09-07', 6, NULL, '2022-09-03 06:23:03', '2022-09-03 06:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `id` int(11) NOT NULL,
  `ship_nm_vn` varchar(1024) DEFAULT NULL,
  `ship_nm_en` varchar(1024) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ships`
--

INSERT INTO `ships` (`id`, `ship_nm_vn`, `ship_nm_en`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AEL', 'AEL', 0, '2022-07-05 03:42:50', NULL),
(2, 'APLS', 'APLS', 0, '2022-07-05 03:42:51', '2022-08-07 06:13:56'),
(3, 'IHE', 'IHE', 1, '2022-07-04 23:11:46', '2022-08-07 06:06:51'),
(4, 'APL', 'APL', 1, '2022-08-07 06:13:46', '2022-08-07 06:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` int(10) NOT NULL,
  `name` varchar(1024) DEFAULT NULL,
  `zalo` varchar(1024) DEFAULT NULL,
  `skype` varchar(1024) DEFAULT NULL,
  `is_show` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `name`, `zalo`, `skype`, `is_show`, `created_at`, `updated_at`) VALUES
(2, 'Ms Linh', '0909 999 999', 'abc@xyz', 1, '2022-07-11 18:05:16', '2022-07-11 20:22:18'),
(3, 'Ms An', '0908940948', 'abcxyz', 1, '2022-07-11 20:22:09', '2022-08-29 15:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chapter_id` int(11) DEFAULT '1',
  `role` tinyint(4) DEFAULT '1' COMMENT '1: member; 2: admin',
  `block` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `register_date` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `tel`, `chapter_id`, `role`, `block`, `email_verified_at`, `password`, `register_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '1111', 1, 2, '0', '2022-07-05 01:54:54', '$2y$10$HJamQxNyVzzFCMD3QshO2.yZfDGeZ3X//2LUoDHVoWhjnmV20fLUK', '2022-07-05', NULL, '2022-07-05 01:54:59', '2022-07-05 01:55:01'),
(2, 'nguyen minh nhut', 'minhnhut0079@gmail.com', '', 1, 2, '0', NULL, '$2y$10$YRCP4Ghtb5CzdCUS4vAFaOkfChIPduvZsE.LNudyXjlzS/6CBvaF2', NULL, NULL, '2022-07-04 21:15:02', '2022-07-11 15:25:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `admins_email_unique` (`email`) USING BTREE,
  ADD UNIQUE KEY `admins_api_token_unique` (`api_token`) USING BTREE;

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `ports`
--
ALTER TABLE `ports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `scenarios`
--
ALTER TABLE `scenarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ports`
--
ALTER TABLE `ports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recruitments`
--
ALTER TABLE `recruitments`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `scenarios`
--
ALTER TABLE `scenarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
