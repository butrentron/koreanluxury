-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2016 at 03:13 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luxury`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `role`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'David Lùn', 'superadmin', 'butrentron.man95@gmail.com', '$2y$10$M5XM4Q1gJR02OGXLF8N8V.E7dykuFs3ZNvm7SD.PJuewfgt4F2IoS', 'kbspTKlDA2KnKGdSqakyaXpka3r8KCfLD0hJN96k3SEGtlaL5PtxzbTP2tp3', '2016-04-11 12:25:26', '2016-04-20 04:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `set_title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `image`, `set_title`, `meta_key`, `meta_desc`, `created_at`, `updated_at`) VALUES
(7, 'Longhorn', 'longhorn', 'Longhorn', 'uploads/brands/luxu.png', 'Luxu', 'Luxu', 'Luxu', '2016-04-12 09:16:20', '2016-04-18 01:18:35'),
(9, 'Joy Luck', 'joy-luck', 'Joy Luck', 'uploads/brands/vietnamese.png', 'vietnamese', 'vietnamese', 'vietnamese', '2016-04-12 09:49:23', '2016-04-18 01:15:37'),
(10, 'Giraffe', 'giraffe', ' Giraffe', 'uploads/brands/giraffe.png', '', '', '', '2016-04-17 19:33:49', '2016-04-17 19:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `set_title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `sort_order` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `desc`, `set_title`, `meta_key`, `meta_desc`, `parent_id`, `lft`, `rgt`, `depth`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Phụ nữ', 'phu-nu', '  Sản phẩm  quần áo, dày dép, phụ kiện thời trang nữ', '', 'thời trang hàn quốc nữ', '  Sản phẩm  quần áo, dày dép, phụ kiện thời trang nữ', NULL, 1, 12, 0, 0, '2016-04-12 01:21:59', '2016-04-14 07:50:21'),
(2, 'Áo thun & phông', 'ao-thun-phong', '      Áo thun nữ cổ rộng', 'Áo thun nữ cổ rộng', 'Áo thun nữ cổ rộng', 'Áo thun nữ cổ rộng', 1, 2, 5, 1, 0, '2016-04-12 01:25:19', '2016-04-14 00:00:00'),
(3, 'Áo sơ mi', 'ao-so-mi', '  Áo sơ mi', 'Áo sơ mi', 'Áo sơ mi', 'Áo sơ mi', 1, 6, 7, 1, 0, '2016-04-12 01:27:34', '2016-04-14 00:00:00'),
(4, 'Nam', 'nam', ' Sản phẩm dành cho nam', '', '', '', NULL, 13, 16, 0, 0, '2016-04-12 20:50:36', '2016-04-14 07:50:21'),
(5, 'Quần thun', 'quan-thun', ' Quần thun nam tính', '', '', '', 4, 14, 15, 1, 0, '2016-04-12 20:51:08', '2016-04-14 07:50:21'),
(6, 'Áo thun không dây', 'ao-thun-khong-day', ' Áo thun không dây', 'Áo thun không dây', 'Áo thun không dây', 'Áo thun không dây', 2, 3, 4, 2, 0, '2016-04-14 00:00:00', '2016-04-14 00:00:00'),
(7, 'Quần', 'quan', ' Quần cho phái nữ', '', '', '', 1, 8, 9, 1, 0, '2016-04-14 00:20:22', '2016-04-14 00:20:22'),
(8, 'Váy', 'vay', ' Váy phụ nữ', '', '', '', 1, 10, 11, 1, 0, '2016-04-14 07:50:21', '2016-04-14 07:50:21'),
(9, 'Trẻ em', 'tre-em', ' Trẻ em', '', '', '', NULL, 17, 18, 0, 0, '2016-04-18 01:28:35', '2016-04-18 01:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_11_150422_create_Admins_table', 1),
('2016_04_11_174531_create_pages_table', 1),
('2016_04_12_072546_create_categories_table', 2),
('2016_04_12_100131_create_products_table', 3),
('2016_04_13_012414_alter_types_table', 4),
('2016_04_13_083208_create_slides_table', 5),
('2016_04_14_075111_alter_types_table', 5),
('2016_04_14_142301_alter_products_table', 6),
('2016_04_18_083009_create_orders_table', 7),
('2016_04_18_090617_alter_transaction_table', 8),
('2016_04_18_091846_create_transactions_table', 9),
('2016_04_20_065433_alter_slides_table', 10),
('2016_04_20_095721_alter_slides_publish_table', 11),
('2016_04_21_014339_create_settings_table', 12),
('2016_04_21_020313_alter_setting_table', 13),
('2016_04_21_082445_alter_types_table', 14),
('2016_04_21_100157_alter_pages_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` decimal(15,0) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `qty`, `amount`, `status`, `data`, `transaction_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 1, '1395000', 1, '{"colors":null,"sizes":null}', 4, 6, '2016-04-18 20:09:08', '2016-04-19 10:24:39'),
(3, 1, '323100', 1, '{"colors":"\\u0111\\u1ecf","sizes":"V\\u1eeba"}', 4, 10, '2016-04-18 20:09:08', '2016-04-19 10:24:24'),
(31, 1, '126420', 0, '{"colors":"\\u0110en","sizes":"nh\\u1ecf"}', 26, 8, '2016-04-18 21:33:01', '2016-04-18 21:33:01'),
(32, 1, '118750', 0, '{"colors":"h\\u1ed3ng","sizes":"nh\\u1ecf"}', 26, 7, '2016-04-18 21:33:01', '2016-04-18 21:33:01'),
(33, 1, '126420', 0, '{"colors":"\\u0110en","sizes":"nh\\u1ecf"}', 27, 8, '2016-04-18 21:46:57', '2016-04-18 21:46:57'),
(34, 1, '118750', 0, '{"colors":"h\\u1ed3ng","sizes":"nh\\u1ecf"}', 27, 7, '2016-04-18 21:46:57', '2016-04-18 21:46:57'),
(35, 1, '2519300', 0, '{"colors":"H\\u1ed3ng","sizes":"V\\u1eeba"}', 27, 14, '2016-04-18 21:46:57', '2016-04-18 21:46:57'),
(36, 1, '350000', 0, '{"colors":null,"sizes":null}', 28, 9, '2016-04-18 21:57:00', '2016-04-18 21:57:00'),
(37, 1, '293020', 0, '{"colors":"","sizes":""}', 29, 11, '2016-04-19 17:37:11', '2016-04-19 17:37:11'),
(40, 1, '293020', 0, '{"colors":"","sizes":""}', 32, 11, '2016-04-20 04:04:03', '2016-04-20 04:04:03'),
(42, 1, '293020', 0, '{"colors":"","sizes":""}', 34, 11, '2016-04-20 04:08:38', '2016-04-20 04:08:38'),
(43, 1, '126420', 0, '{"colors":null,"sizes":null}', 34, 8, '2016-04-20 04:08:38', '2016-04-20 04:08:38'),
(44, 1, '126420', 0, '{"colors":null,"sizes":null}', 35, 8, '2016-04-20 10:08:21', '2016-04-20 10:08:21'),
(45, 1, '2519300', 0, '{"colors":null,"sizes":null}', 36, 14, '2016-04-21 03:21:18', '2016-04-21 03:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `set_title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(160) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `uri`, `content`, `parent_id`, `lft`, `rgt`, `depth`, `template`, `hidden`, `created_at`, `updated_at`, `set_title`, `meta_key`, `meta_desc`) VALUES
(6, 'Hỗ trợ', 'ho-tro', '<h1 style="text-align: center;"><strong><u>Hướng dẫn mua hàng</u></strong></h1>\r\n<p><strong><u>Bước 1</u></strong><strong>:</strong></p>\r\n<ul>\r\n<li>Chọn sản phẩm bạn quan tâm.</li>\r\n<li>Click “ĐẶT NGAY” nếu bạn muốn thanh toán ngay sản phẩm đang xem.</li>\r\n<li>Click “GIỎ HÀNG” nếu bạn muốn thêm sản phẩm vào giỏ hàng và xem tiếp các sản phẩm khác.</li>\r\n<li>Nếu bạn ở trang chủ, Click "THÊM NGAY" để thêm ngay sản phẩm vào giỏ hàng mà không cần vào trang sản phẩm</li>\r\n</ul>\r\n<p><img src="http://stylehanquoc.com/Img/anh1.png" alt="" /></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><strong><u>Bước 2</u></strong><strong>:</strong></p>\r\n<ul>\r\n<li>Sau khi đã thêm các sản phẩm bạn muốn mua vào giỏ hàng, click vào “Giỏ hàng” để xem giỏ hàng và tiến hành thanh toán.</li>\r\n</ul>\r\n<p><img src="http://stylehanquoc.com/Img/anh2.png" alt="" /></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><strong><u>Bước 3</u></strong><strong>:</strong></p>\r\n<ul>\r\n<li>Xem lại các sản phẩm trong giỏ hàng và chọn màu sắc, kích thước, số lượng sản phẩm.</li>\r\n<li>Sau đó click “Thanh toán” để chuyển sang bước tiếp theo</li>\r\n</ul>\r\n<p><img src="http://stylehanquoc.com/Img/anh3.png" alt="" /></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><strong><u>Bước 4</u></strong><strong>:</strong></p>\r\n<ul>\r\n<li>Nếu bạn chưa đăng nhập tài khoản trên Style Hàn Quốc, hãy chọn “Đăng nhập mua hàng” để đăng nhập hoặc bạn có thể "Đăng nhập bằng Facebook".</li>\r\n<li>Nếu bạn chưa có tài khoản, bạn có thể click “Đăng ký” để tạo tài khoản, hoặc chọn “Mua hàng không cần đăng nhập” và nhập email. (Nếu bạn mua hàng không cần đăng nhập thì bạn sẽ không thể theo dõi tình trạng đơn hàng)</li>\r\n<li>Sau khi nhập đầy đủ thông tin, click “Tiếp tục” để chuyển sang bước tiếp theo.</li>\r\n</ul>\r\n<p><img src="http://stylehanquoc.com/Img/anh4.png" alt="" /></p>\r\n<p> </p>\r\n<p> </p>\r\n<p><strong><u>Bước 5</u></strong><strong>:</strong></p>\r\n<ul>\r\n<li>Điền đầy đủ thông tin theo yêu cầu.</li>\r\n<li>Xem phí vận chuyển và chọn hình thức thanh toán (Chuyển khoản hoặc tiền mặt).</li>\r\n<li>Sau đó click “Tiếp tục” để chuyển sang bước tiếp theo.</li>\r\n</ul>\r\n<p><img src="http://stylehanquoc.com/Img/anh5.png" alt="" /></p>\r\n<p> </p>\r\n<p align="left"> </p>\r\n<p align="left"><strong><u>Bước 6</u></strong><strong>:</strong></p>\r\n<ul>\r\n<li>Xem lại thông tin đơn hàng.</li>\r\n<li>Click “Đặt hàng” để hoàn tất việc đặt hàng.</li>\r\n</ul>\r\n<p><img src="http://stylehanquoc.com/Img/anh6.png" alt="" /></p>\r\n<p> </p>\r\n<p align="left"> </p>\r\n<p align="left"><strong><u>Bước 7</u></strong><strong>:</strong></p>\r\n<ul>\r\n<li>Sau khi bạn click “Hoàn tất thanh toán”, đơn hàng sẽ được gửi về trung tâm khách hàng của chúng tôi.</li>\r\n<li>Chúng tôi sẽ gọi điện cho bạn để xác nhận việc đặt hàng. Bạn vẫn có thể thay đổi thông tin đơn hàng hoặc hủy đơn hàng trước khi chúng tôi xác nhận.</li>\r\n<li>Bạn có thể vào "Đơn hàng của tôi" (Nếu bạn đăng nhập bằng Facebook hoặc tài khoản Style Hàn Quốc) để theo dõi đơn hàng của mình.</li>\r\n</ul>\r\n<p align="left"><img src="http://stylehanquoc.com/Img/anh7.png" alt="" /></p>', NULL, 1, 6, 0, NULL, 0, '2016-04-11 18:28:01', '2016-04-21 01:10:14', '', '', ''),
(7, 'Quy định đổi trả', 'quy-dinh-doi-tra', '<p align="left"><strong>1.       </strong><strong>Chính sách đổi &amp; trả hàng</strong></p>\r\n<p align="left"><strong>     1.1.  </strong><strong>Điều kiện</strong></p>\r\n<ul>\r\n<li>Khách Hàng được đổi/trả sản phẩm trong trường hợp Style Hàn Quốc giao hàng không đúng Thương Hiệu. Mẫu Mã, Màu Sắc, Kích Thước (Size) Khách Hàng yêu cầu.</li>\r\n</ul>\r\n<ul>\r\n<li>Điều kiện: Sản phẩm chưa qua sử dụng, giặt ủi, không bị dơ bẩn và còn nguyên tem, nhãn mác.</li>\r\n</ul>\r\n<ul>\r\n<li>Thời gian đổi trả: 07 ngày kể từ ngày nhận hàng.</li>\r\n</ul>\r\n<ul>\r\n<li>Trong trường hợp đúng thương hiệu, mẫu mã, màu sắc, kích thước như yêu cầu nhưng quý khách muốn đổi/trả thì phải thanh toán 50% giá trị của sản phẩm</li>\r\n</ul>\r\n<ul>\r\n<li>Chúng tôi luôn sẵn lòng tư vấn thêm thông tin về chất liệu sản phẩm, quy đổi Size chuẩn,... để Khách Hàng có thể lựa chọn được sản phẩm phù hợp nhất qua hotline: 08 3514 4598, chương trình chat trực tuyến, message facebook,... Vì vậy, đừng ngần ngại liên hệ chúng tôi để được trợ giúp.</li>\r\n</ul>\r\n<p align="left"><strong>     1.2.  </strong><strong>Phương thức hoàn trả</strong></p>\r\n<ul>\r\n<li>Đối với khách hàng tại Thành phố Hồ Chí Minh:</li>\r\n</ul>\r\n<p align="left">            Ø  Lựa chọn 1: Trực tiếp trả tại văn phòng Style Hàn Quốc:</p>\r\n<p align="left">o   Địa chỉ: 132-134 D2, P.19, Q.Bình Thạnh.</p>\r\n<p align="left">o   Điện thoại: (08) 35124049</p>\r\n<p align="left">            Ø  Lựa chọn 2: Yêu cầu Style Hàn Quốc đến lấy hàng tận nơi.</p>\r\n<p align="left">o   Chúng tôi có thể cử nhân viên đến tận nơi để nhận hàng hoàn trả.</p>\r\n<p align="left">o   Quý khách vui lòng thanh toán 20,000 đồng phí vận chuyển nếu sử dụng dịch vụ này.</p>\r\n<ul>\r\n<li>Đối với khách hàng ở các tỉnh và thành phố khác:</li>\r\n</ul>\r\n<p align="left">            Ø  Quý khách mang hàng hoàn trả đến bưu điện gần nhất và gửi đến địa chỉ của Style Hàn Quốc.</p>\r\n<p align="left">            Ø  Quý khách vui lòng thanh toán cước bưu điện.</p>\r\n<p align="left"> </p>\r\n<p align="left"><strong>     1.3.  </strong><strong>Nhận tiền hoàn tr</strong>ả</p>\r\n<ul>\r\n<li>Đối với khách hàng tại Thành phố Hồ Chí Minh: Chúng tôi sẽ hoàn trả tiền cho bạn khi bạn đến trả hàng trực tiếp hoặc khi chúng tôi đến lấy hàng hoàn trả.</li>\r\n<li>Đối với khách hàng ở các tỉnh và thành phố khác: Chúng tôi sẽ chuyển khoản cho bạn hoặc chuyển tiền qua bưu điện.</li>\r\n</ul>', 6, 4, 5, 1, NULL, 0, '2016-04-11 18:28:53', '2016-04-21 01:10:14', '', '', ''),
(8, 'Chính sách giao hàng', 'chinh-sach-giao-hang', '<p align="left"><strong>1.  </strong><strong>Phí giao hàng tận nhà:</strong></p>\r\n<p align="left">· Đối với khách hàng tại Thành phố Hồ Chí Minh:</p>\r\n<p align="left">Ø  Chúng tôi sẽ miễn phí giao hàng đối với đơn hàng từ 500,000 đồng. Đối với đơn hàng dưới 500,000 đồng, chúng tôi sẽ thu phí giao hàng là 20,000 đồng.</p>\r\n<p align="left">· Đối với khách hàng ở các tỉnh và thành phố khác:</p>\r\n<p align="left">Ø  Phí giao hàng là 20,000 đồng đối với các tỉnh thành: BR – Vũng Tàu, Bình Dương, Đồng Nai.</p>\r\n<p align="left">Ø  Phí giao hàng là 30,000 đồng đối với các tỉnh thành: Hà Nội, An Giang, Bến Tre, Bình Phước, Bình Thuận, Cần Thơ, Đắk Lắk, Đắk Nông, Đồng Tháp, Long An, Ninh Thuận, Sóc Trăng, Tây Ninh.</p>\r\n<p align="left">Ø  Phí giao hàng là 40,000 đồng đối với các tỉnh thành còn lại.</p>\r\n<p align="left">Ø  Chúng tôi sẽ miễn phí giao hàng đối với đơn hàng từ 2,500,000 đồng.</p>\r\n<p align="left"><strong>2.  </strong><strong>Phí giao hàng thu tiền:</strong></p>\r\n<p align="left">Chúng tôi thu phí dịch vụ giao hàng thu tiền (COD) đối với khách hàng không ở tại Thành phố Hồ Chí Minh theo mức giá như sau:</p>\r\n<table style="height: 247px;" border="1" width="348" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="height: 35px;">\r\n<td style="width: 208px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">SỐ TIỀN THU (VND)</p>\r\n</td>\r\n<td style="width: 134px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">PHÍ THU TIỀN (VND)</p>\r\n</td>\r\n</tr>\r\n<tr style="height: 35px; text-align: center;">\r\n<td style="width: 208px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">Đến 300,000</p>\r\n</td>\r\n<td style="width: 134px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">10,000</p>\r\n</td>\r\n</tr>\r\n<tr style="height: 35px; text-align: center;">\r\n<td style="width: 208px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">Trên 300,000 đến 600,000</p>\r\n</td>\r\n<td style="width: 134px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">15,000</p>\r\n</td>\r\n</tr>\r\n<tr style="height: 35px; text-align: center;">\r\n<td style="width: 208px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">Trên 600,000 đến 1,000,000</p>\r\n</td>\r\n<td style="width: 134px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">20,000</p>\r\n</td>\r\n</tr>\r\n<tr style="height: 35px; text-align: center;">\r\n<td style="width: 208px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">Trên 1,000,000 đến 5,000,000</p>\r\n</td>\r\n<td style="width: 134px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">25,000</p>\r\n</td>\r\n</tr>\r\n<tr style="height: 35px; text-align: center;">\r\n<td style="width: 208px; height: 35px; text-align: center;">\r\n<p style="text-align: center;" align="left">Trên 5,000,000 đến 10,000,000</p>\r\n</td>\r\n<td style="width: 134px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">30,000</p>\r\n</td>\r\n</tr>\r\n<tr style="height: 35px;">\r\n<td style="width: 208px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">Trên 10,000,000</p>\r\n</td>\r\n<td style="width: 134px; text-align: center; height: 35px;">\r\n<p style="text-align: center;" align="left">35,000</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p align="left"><strong>3.  </strong><strong>Thời gian giao hàng:</strong></p>\r\n<p align="left">Ø  Hàng được gửi từ Hàn Quốc về Việt Nam vào thứ Sáu hàng tuần. Chúng tôi sẽ vận chuyển hàng trong thời gian 4 – 10 ngày làm việc kể từ ngày chúng tôi xác nhận đơn hàng với quý khách.</p>\r\n<p align="left">Ø  Trước khi giao hàng, chúng tôi sẽ liên lạc với quý khách. Nếu trong thời gian 3 ngày chúng tôi không liên lạc được với quý khách, đơn hàng sẽ xem như đã bị hủy.</p>', 6, 2, 3, 1, NULL, 0, '2016-04-11 18:30:42', '2016-04-21 03:15:15', 'Chính sách giao hàng', 'Chính sách giao hàng', 'Chính sách giao hàng'),
(9, 'Liên hệ', 'lien-he', '<div>\r\n<h1 class="h1-reg" style="text-align: left;">LIÊN HỆ</h1>\r\n</div>\r\n<div class="lienhe">\r\n<div class="content">\r\n<p style="text-align: left;"><strong>Địa Chỉ:</strong>Tầng 5, Tòa nhà HT Building 132-134 Đường D2, Phường 25, Quận Bình Thạnh, Thành phố Hồ Chí Minh</p>\r\n<p style="text-align: left;"><strong>Điện Thoại:</strong> (08) 35124049</p>\r\n<p style="text-align: left;">Nếu bạn gặp khó khăn trong việc đặt hàng qua mạng, bạn có thể gọi đến hotline của công ty để đặt hàng trực tiếp.</p>\r\n<p style="text-align: left;">Hotline đặt hàng: <strong>(08) 35124049</strong></p>\r\n<p style="text-align: left;">Lưu ý: <strong>Hình thức đặt hàng qua điện thoại chỉ áp dụng trong giờ hành chính.</strong></p>\r\n<ul style="text-align: left;">\r\n<ul>T2 - T6</ul>\r\n</ul>\r\n<p style="text-align: left;">Sáng từ 08:30 AM đến 12:00 PM</p>\r\n<p style="text-align: left;">Chiều từ 13:00 PM đến 17:30 PM</p>\r\n<ul style="text-align: left;">\r\n<ul>T7</ul>\r\n</ul>\r\n<p style="text-align: left;">từ 08:30 AM đến 12:00 PM </p>\r\n<p style="text-align: left;">Rất sẵn lòng được phục vụ bạn</p>\r\n</div>\r\n</div>', NULL, 7, 8, 0, NULL, 0, '2016-04-11 19:54:03', '2016-04-21 01:18:12', '', '', ''),
(11, 'Blog', 'blog', '<p>Blog</p>', NULL, 9, 10, 0, NULL, 0, '2016-04-19 23:41:16', '2016-04-21 01:10:14', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `sale` tinyint(4) NOT NULL,
  `price` decimal(15,0) NOT NULL,
  `slide` enum('0','1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `set_title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price_at` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `desc`, `content`, `image`, `size`, `color`, `view`, `order`, `sale`, `price`, `slide`, `set_title`, `meta_key`, `meta_desc`, `category_id`, `brand_id`, `created_at`, `updated_at`, `price_at`) VALUES
(6, 'Áo thun nữ cổ rộng', 'ao-thun-nu-co-rong', 'Áo thun nữ cỗ rộng thương hiệu luxury ', '<p>&Aacute;o thun nữ cỗ rộng thương hiệu luxury&nbsp;</p>', 'uploads/products/ao-thun-nu-co-rong.jpg', '', '"tr\\u1eafng, xanh"', 0, 0, 0, '1395000', '1', 'Áo thun nữ cỗ rộng thương hiệu luxury ', 'Áo thun nữ cỗ rộng thương hiệu luxury ', 'Áo thun nữ cỗ rộng thương hiệu luxury ', 2, 7, '2016-04-13 00:27:39', '2016-04-13 00:27:39', '0'),
(7, 'Áo thun dây', 'ao-thun-day', 'Áo thun dây', '<p>&Aacute;o thun d&acirc;y&nbsp;&Aacute;o thun d&acirc;y&nbsp;&Aacute;o thun d&acirc;y</p>', 'uploads/products/ao-thun-day.jpg', '"V\\u1eeba, nh\\u1ecf"', '"Xanh, v\\u00e0ng, h\\u1ed3ng"', 0, 0, 5, '125000', '0', 'Áo thun dây', 'Áo thun dây', 'Áo thun dây', 2, 7, '2016-04-14 00:19:43', '2016-04-14 09:36:06', '118750'),
(8, 'Quần jean đen', 'quan-jean-den', 'Quần jean đen', '<p>Quần jean đen&nbsp;Quần jean đen&nbsp;Quần jean đen&nbsp;</p>', 'uploads/products/quan-jean-den.gif', '"V\\u1eeba, nh\\u1ecf, l\\u1edbn"', '"\\u0110en"', 0, 0, 2, '129000', '0', 'Quần jean đen ', 'Quần jean đen ', 'Quần jean đen ', 7, 9, '2016-04-14 00:21:50', '2016-04-14 09:36:25', '126420'),
(9, 'Áo phông ngắn tay ', 'ao-phong-ngan-tay', 'Áo phông ngắn tay ', '<p>&Aacute;o ph&ocirc;ng ngắn tay &nbsp;&Aacute;o ph&ocirc;ng ngắn tay&nbsp;</p>', 'uploads/products/ao-phong-ngan-tay.jpg', '"V\\u1eeba, nh\\u1ecf"', '"tr\\u1eafng, xanh"', 0, 0, 0, '350000', '0', 'Áo phông ngắn tay ', 'Áo phông ngắn tay ', 'Áo phông ngắn tay ', 2, 7, '2016-04-14 00:23:51', '2016-04-14 09:55:59', '350000'),
(10, 'Áo thun dài tay', 'ao-thun-dai-tay', 'Áo thun dài tay', '<p>&Aacute;o thun d&agrave;i tay&Aacute;o thun d&agrave;i tay</p>', 'uploads/products/ao-thun-dai-tay.jpg', '"V\\u1eeba, nh\\u1ecf"', '"\\u0111\\u1ecf , \\u0111en"', 0, 0, 10, '359000', '0', 'Áo thun dài tay', 'Áo thun dài tay', 'Áo thun dài tay', 2, 7, '2016-04-14 00:25:41', '2016-04-14 09:30:45', '323100'),
(11, 'Áo phông dài tay', 'ao-phong-dai-tay', 'Áo phông dài tay', '<p>&Aacute;o ph&ocirc;ng d&agrave;i tay&nbsp;&Aacute;o ph&ocirc;ng d&agrave;i tay&nbsp;</p>', 'uploads/products/ao-phong-dai-tay.jpg', '"V\\u1eeba, nh\\u1ecf"', '"\\u0110en, n\\u00e2u"', 0, 0, 2, '299000', '0', 'Áo phông dài tay ', 'Áo phông dài tay ', 'Áo phông dài tay ', 2, 7, '2016-04-14 00:27:21', '2016-04-14 09:36:39', '293020'),
(14, 'Váy đầm hoa tay ngắn', 'vay-dam-hoa-tay-ngan', 'Váy đầm hoa tay ngắn sang trọng cho phái nữ', '<p>V&aacute;y đầm hoa tay ngắn sang trọng cho ph&aacute;i nữ</p>', 'uploads/products/vay-dam-hoa-tay-ngan.jpg', '"V\\u1eeba, nh\\u1ecf"', '"Tr\\u1eafng, H\\u1ed3ng"', 0, 0, 30, '3599000', '0', 'Váy đầm hoa tay ngắn sang trọng cho phái nữ', 'Váy đầm hoa tay ngắn sang trọng cho phái nữ', 'Váy đầm hoa tay ngắn sang trọng cho phái nữ', 8, 7, '2016-04-14 09:22:06', '2016-04-14 09:22:06', '2519300');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `product_id`) VALUES
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 14),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 14),
(3, 7),
(3, 8),
(3, 10),
(3, 11),
(3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flickr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dribbble` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `content`, `phone`, `address`, `email`, `facebook`, `twitter`, `flickr`, `google`, `dribbble`, `title`, `description`, `keyword`, `logo`) VALUES
(14, '<h4 style="text-align: center;"><strong>STYLEHANQUOC.COM – TRANG WEB MUA SẮM THỜI TRANG HÀN QUỐC TRỰC TUYẾN HÀNG ĐẦU VIỆT NAM</strong></h4>\n<h4>BẠN YÊU THỜI TRANG HÀN QUỐC, BẠN ĐANG TÌM NHỮNG MẪU THỜI TRANG, TÚI XÁCH, GIÀY DÉP VÀ PHỤ KIỆN NHẬP KHẨU CHÍNH HÃNG TỪ HÀN QUỐC MỚI NHẤT TRÊN MẠNG? STYLEHANQUOC.COM LÀ TẤT CẢ NHỮNG GÌ BẠN CẦN</h4>\n<p><strong>STYLEHANQUOC.COM</strong> sẽ mang đến cho khách hàng những trải nghiệm mua sắm thời trang trực tuyến thú vị từ các thương hiệu thời trang<strong> HÀN QUỐC</strong> phong cách. Luôn cập nhật mới từng ngày những bộ sưu tập thời trang nữ đa dạng từ giày dép, túi xách, trang phục, phụ kiện. Bạn có thể tìm thấy những bộ trang phục mình yêu thích, từ những bộ đồ mặc nhà thật thoải mái hay tự tin trong những trang phục công sở thanh lịch, từ cao cấp đến giá cả phải chăng nhất. Đừng bỏ lỡ những trải nghiệm mua sắm thú vị tại <strong>STYLEHANQUOC.COM</strong> – trang web mua sắm thời trang Hàn Quốc hàng đầu tại Việt Nam.</p>\n<h4>THỜI TRANG HÀN QUỐC 2015 HOT NHẤT TẠI STYLEHANQUOC.COM</h4>\n<p>Mua sắm thời trang là nhu cầu thiết yếu của phái đẹp. Thấu hiểu điều này, <strong>STYLEHANQUOC.COM</strong> sẽ mang đến cho bạn nhiều bộ sưu tập thời trang 2015 hot nhất từ các thương hiệu<strong> HÀN QUỐC</strong>. Bên cạnh đó, thời trang cao cấp Hàn Quốc phù hợp với mọi đối tượng từ Doanh Nhân, Nhân Viên Văn Phòng đến các<strong> BẠN TRẺ PHONG CÁCH</strong> với đa dạng mẫu mã mới nhất cho bạn lựa chọn.</p>\n<h4>MUA SẮM THỜI TRANG HÀN QUỐC ONLINE TẠI STYLEHANQUOC.COM – THUẬN TIỆN, DỄ DÀNG VÀ HOÀN TOÀN BẢO MẬT</h4>\n<p>Bạn có thể mua sắm thời trang Hàn Quốc online thoải mái trên <strong>STYLEHANQUOC.COM</strong> mà không có bất kỳ lo lắng nào: <strong>THANH TOÁN KHI NHẬN HÀNG, TRẢ HÀNG </strong>trong vòng 7 ngày kể từ ngày nhận hàng,<strong>MIỄN PHÍ GIAO HÀNG TẠI TP HỒ CHÍ MINH </strong>áp dụng với hóa đơn từ 500,000 VNĐ. Style Hàn Quốc sẽ hoàn tiền 100% nếu giao hàng không đúng hãng, kích thước, mẫu mã, màu sắc khách hàng đặt. Nếu bạn có bất kì câu hỏi nào về các sản phẩm của Style Hàn Quốc, hãy gọi ngay tới bộ phận chăm sóc khách hàng <strong>(08) 3514 4598</strong> hoặc email: support@stylehanquoc.com để có được những giải đáp chi tiết và tận tình nhất.<strong>STYLEHANQUOC.COM</strong> luôn nỗ lực để bạn có được những trải nghiệm mua sắm thời trang Hàn Quốc online tuyệt vời với giá phải chăng nhất! Bạn sẽ tiết kiệm tiền bạc và thời gian hơn rất nhiều khi mua sắm thời trang Hàn Quốc trên <strong>STYLEHANQUOC.COM</strong>.</p>', '090xxxxxx', 'Việt Nam', 'luxurysp.info@gmail.com', 'https://www.youtube.com/watch?v=uvWhxyAYGFI', 'https://www.youtube.com/watch?v=uvWhxyAYGFI', 'https://www.youtube.com/watch?v=uvWhxyAYGFI', 'https://www.youtube.com/watch?v=uvWhxyAYGFI', 'https://www.youtube.com/watch?v=uvWhxyAYGFI', 'Luxury - Thời trang Hàn Quốc', 'Luxury.com chuyên trang mua sắm trực tuyến thời trang hàn quốc nam, nữ và trẻ em...', 'thời trang hàn quốc, thoi trang han quoc, thời trang hàn quốc 2016, thoi trang han quoc 2016, thời trang công sở, thoi trang cong so, thời trang hàn quốc cao cấp, thoi trang han quoc cao cap, thời trang công sở hàn quốc, thoi trang cong so han quoc, thời ', 'uploads/sites/luxury-thoi-trang-han-quoc.png');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `created_at`, `updated_at`, `image`, `title`, `desc`, `link`, `publish`) VALUES
(7, '2016-04-20 01:52:55', '2016-04-20 03:09:00', 'uploads/slides/mua-he-soi-dong.jpg', 'Mùa hè sôi động', '   Khuyến mãi đặc biệt mừng mùa hè sôi động', 'http://localhost:8000/p11-ao-phong-dai-tay', 0),
(11, '2016-04-20 02:52:03', '2016-04-20 03:33:03', 'uploads/slides/mua-giang-sinh-vui-ve.jpg', 'Mùa giáng sinh vui vẻ', '      Mùa giáng sinh vui vẻ cùng với quà tặng khuyến mãi cực khủng', 'http://localhost:8000/p14-vay-dam-hoa-tay-ngan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(15,0) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `message`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(4, 0, 'Kim SeolHyun', 'butrentron123@gmail.com', '0905483996', 'Seul - Korean - FNC Entertaiment', 'Good!', '1718100', 3, '2016-04-18 20:09:08', '2016-04-19 10:55:08'),
(26, 0, 'Nam Bora', 'butrentron123@gmail.com', '0905483996', 'Busan - Korean ', 'Busan - Korean ', '245170', 1, '2016-04-18 21:33:00', '2016-04-19 19:01:04'),
(27, 0, 'Co kim', 'butrentron.dn95@gmail.com', '0905483996', 'Seul - Korean - FNC Entertaiment', 'Co kim', '2764470', 3, '2016-04-17 21:46:57', '2016-04-19 11:09:07'),
(28, 0, 'Kim Ha Neul', 'butrentron.man95@gmail.com', '0905483996', 'Seul - Korean - FNC Entertaiment', 'Seul - Korean - FNC Entertaiment', '350000', 0, '2016-04-18 21:57:00', '2016-04-18 21:57:00'),
(29, 0, 'butrentron', 'butrentron123@gmail.com', '0905483996', 'dá', '', '293020', 0, '2016-04-19 17:37:11', '2016-04-19 17:37:11'),
(32, 0, 'Customs DN', 'butrentron123@gmail.com', '0905483996', 'Da Nang - Viet Nam - Home live', '', '293020', 0, '2016-04-20 04:04:03', '2016-04-20 04:04:03'),
(34, 0, 'DanaVioet', 'butrentron123@gmail.com', '0905483996', 'Da Nang - Viet Nam - Home live', '', '419440', 0, '2016-04-20 04:08:38', '2016-04-20 04:08:38'),
(35, 0, 'sad ád', 'butrentron.dn95@gmail.com', '(38)851-845-548', 'dá', '', '126420', 0, '2016-04-20 10:08:21', '2016-04-20 10:08:21'),
(36, 0, 'sad ád', 'butrentron123@gmail.com', '0905483996', 'dáv', '', '2519300', 0, '2016-04-21 03:21:18', '2016-04-21 03:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '0',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `set_title` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_desc` varchar(160) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`, `display`, `sort`, `set_title`, `meta_key`, `meta_desc`) VALUES
(1, 'Sảm phẩm Hot', 'sam-pham-hot', 'Các sản phẩm hot nhất 2016 tại luxury', '2016-04-12 18:50:42', '2016-04-14 00:58:16', 1, 3, '', '', ''),
(2, 'Sản phẩm Mới', 'san-pham-moi', 'Sản phẩm Mới nhất 2016 tại luxury', '2016-04-12 18:52:59', '2016-04-14 00:58:30', 1, 2, '', '', ''),
(3, 'Giảm giá', 'giam-gia', 'Các sản phẩm đang được giảm giá, hàng chất lượng giá rẻ tại luxury', '2016-04-12 18:53:49', '2016-04-14 01:05:55', 1, 1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kim Yeon Lee', '0905483996', '43 DakNong - Seoul - Korean', 'butrentron123@gmail.com', '$2y$10$hGr.WpqHKPhKyLQ6KyImS.q/3/dPl.2dWxtaLogrCIRVxZm7N751a', 'ed9HWgx1IpDm645MqlGaMv6RWlOaGVXVvKP6dCdvbbEsM4cDcVzpg4uWqPg6', '2016-04-15 09:04:19', '2016-04-18 01:10:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_transaction_id_foreign` (`transaction_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_uri_unique` (`uri`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD KEY `products_categories_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`,`product_id`),
  ADD KEY `product_type_product_id_foreign` (`product_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `product_type_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_type_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
