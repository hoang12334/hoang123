-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 27, 2020 at 04:14 PM
-- Server version: 10.2.32-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hacklik1_cmsnt`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `stk` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `bank_name` text DEFAULT NULL,
  `chi_nhanh` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `stk`, `name`, `bank_name`, `chi_nhanh`) VALUES
(7, '0981493966', 'Momo', 'Hà Minh Quân', 'Nghệ an'),
(9, 'Quanokdz2701', 'Thẻ Siêu Rẻ', 'Hà Minh Quân', 'Nghệ An');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `amount` int(11) DEFAULT 0,
  `thucnhan` int(11) DEFAULT 0,
  `createdate` datetime DEFAULT NULL,
  `seri` varchar(64) DEFAULT NULL,
  `pin` varchar(64) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `code` varchar(128) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `note` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `code`, `img`, `note`) VALUES
(2, 'Dịch Vụ Facebook', 'dich-vu-facebook', 'https://i.imgur.com/EoRvO41.png', '<p><span style=\"font-size: 1rem;\">- Vui lòng nhập đầy đủ thông tin để chúng tôi xử lý giao dịch cho bạn.</span></p><p>- Trường hợp đơn hàng thiếu hoặc Link không hợp lệ, chúng tôi sẽ HỦY đơn hàng đó và tự động hoàn lại số dư về ví cho quý khách.</p><p>- Nếu quý khách có nhu cầu HỦY đơn hàng vì một lý do nào đó, xin vui lòng gửi hỗ trợ cho chúng tôi qua <a href=\"/ho-tro/create/\" target=\"_blank\">ĐÂY</a>, không hoàn tiền đối với trường hợp này.</p><p>- Nếu tăng <b>LIKE BÀI VIẾT</b>: vui lòng mở công khai bài viết để hệ thống tăng cho quý khách, EDIT quyền riêng tư vào <a href=\"https://www.facebook.com/settings?tab=privacy\" target=\"_blank\">ĐÂY</a>.</p><p>- Nếu tăng <b>THEO DÕI TRANG CÁ NHÂN</b>: vui lòng bật chức năng theo dõi và đảm bảo nick của bạn &gt;= 18 Tuổi, EDIT theo dõi tại <a href=\"https://www.facebook.com/settings?tab=followers\" target=\"_blank\">ĐÂY</a>.</p><p><span style=\"font-size: 1rem;\">- Nếu tăng </span><b style=\"font-size: 1rem;\">CMT</b><span style=\"font-size: 1rem;\">: vui lòng nhập cmt cần tăng tại ô </span><b style=\"font-size: 1rem;\">GHI CHÚ</b><span style=\"font-size: 1rem;\">, mỗi CMT cách nhau mỗi dấu phẩy (,).</span></p>'),
(5, 'Dịch Vụ Youtube', 'dich-vu-youtube', 'https://i.imgur.com/h4se7VH.png', ''),
(8, 'Dịch Vụ TikTok', 'dich-vu-tiktok', 'https://i.imgur.com/0rT4yUL.png', ''),
(9, 'Dịch Vụ Instagram', 'dich-vu-instagram', 'https://i.imgur.com/sRqpIt0.png', '<ul><li>Vui lòng kiểm tra thông tin trước khi chạy.</li><li>Tăng nhầm link chúng tôi sẽ không hoàn tiền.</li><li>Chúng tôi tăng theo số thứ tự đơn hàng.</li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `createdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `username`, `content`, `createdate`) VALUES
(1, 'admin', '0 + 1.000.000 = 1.000.000  lý do: test ', '2020-08-26 04:07:30'),
(2, 'admin', '1.000.000 + 500.000 = 1.500.000  lý do: testtt ', '2020-08-26 04:10:19'),
(3, 'admin', '1.500.000 - 200.000 = 1.300.000  lý do: test ', '2020-08-26 04:11:48'),
(4, 'admin', 'Đăng nhập vào hệ thống!', '2020-08-26 15:56:10'),
(5, 'admin', '1.300.000 - 45.000 = 1.255.000  lý do: Thanh Toán Đơn Tăng Follow Facebook #54D1LH', '2020-08-26 15:58:04'),
(6, 'admin', 'Đăng nhập vào hệ thống!', '2020-08-26 17:05:45'),
(7, 'admin', 'Đăng ký tài khoản!', '2020-08-27 14:08:36'),
(8, 'Admin', 'Đăng nhập vào hệ thống!', '2020-08-27 14:26:19'),
(9, 'conganhdz', 'Đăng ký tài khoản!', '2020-08-27 14:41:15'),
(10, 'letrinhankhang', 'Đăng ký tài khoản!', '2020-08-27 14:46:46'),
(11, 'Quanokdz2701', 'Đăng ký tài khoản!', '2020-08-27 15:15:45'),
(12, 'Quanokdz2701', '0 + 12.819.381 = 12.819.381  lý do:  ', '2020-08-27 15:17:18'),
(13, 'tranquanghuy', 'Đăng ký tài khoản!', '2020-08-27 15:18:52'),
(14, 'hoangdubai123', 'Đăng ký tài khoản!', '2020-08-27 15:19:53'),
(15, 'Quanokdz2701', 'Thay đổi thông tin tài khoản bởi Admin Admin', '2020-08-27 15:21:43'),
(16, 'Thinhbun2005', 'Đăng ký tài khoản!', '2020-08-27 15:49:16'),
(17, 'Quanokdz2701', '12.819.381 - 10.000 = 12.809.381  lý do: Thanh Toán Đơn Tăng Follow Facebook ( Bảo Hành ) #X10HER', '2020-08-27 16:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `momo`
--

CREATE TABLE `momo` (
  `id` int(11) NOT NULL,
  `tranId` text CHARACTER SET utf8 DEFAULT NULL,
  `partnerId` text CHARACTER SET utf8 DEFAULT NULL,
  `partnerName` text CHARACTER SET utf8 DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `comment` text CHARACTER SET utf8 DEFAULT NULL,
  `time` text CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(32) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` varchar(32) DEFAULT NULL,
  `username` text DEFAULT NULL,
  `service_name` text DEFAULT NULL,
  `category_code` varchar(128) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `money` int(32) DEFAULT 0,
  `status` varchar(255) DEFAULT 'xuly',
  `note` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `updatedate` datetime DEFAULT NULL,
  `note_status` text DEFAULT NULL,
  `ghichu` text DEFAULT NULL,
  `note_admin` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `username`, `service_name`, `category_code`, `service_id`, `amount`, `money`, `status`, `note`, `url`, `createdate`, `updatedate`, `note_status`, `ghichu`, `note_admin`) VALUES
(1, '54D1LH', 'admin', 'Tăng Follow Facebook', 'dich-vu-facebook', 23, 1000, 45000, 'xuly', '', 'https://www.facebook.com/ntgtanetwork', '2020-08-26 15:58:04', NULL, NULL, NULL, NULL),
(2, 'X10HER', 'Quanokdz2701', 'Tăng Follow Facebook ( Bảo Hành )', 'dich-vu-facebook', 23, 1000, 10000, 'xuly', 'Tess', 'https://www.facebook.com/Khang.Tricker.Infor', '2020-08-27 16:13:09', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reply_ticket`
--

CREATE TABLE `reply_ticket` (
  `id` int(11) NOT NULL,
  `id_ticket` int(11) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `createdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply_ticket`
--

INSERT INTO `reply_ticket` (`id`, `id_ticket`, `username`, `content`, `createdate`) VALUES
(58, 1, 'admin', 'aad', '2020-08-26 13:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `stt` int(11) DEFAULT NULL,
  `category` varchar(128) DEFAULT '0',
  `name` text DEFAULT NULL,
  `money` int(12) DEFAULT 0,
  `content` longtext DEFAULT NULL,
  `status` varchar(32) DEFAULT 'show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `stt`, `category`, `name`, `money`, `content`, `status`) VALUES
(23, 1, 'dich-vu-facebook', 'Tăng Follow Facebook ( Bảo Hành )', 50, '<p class=\"cl-red font-bold\" style=\"\">- Lưu ý: hệ thống hoạt động theo hình thức order tức là bạn order số lượng bao nhiêu thì hệ thống sẽ tự động lấy trong cơ sở dữ liệu ra số lượng người tương ứng để like, follow,... cho bạn.</p><p class=\"cl-red font-bold\" style=\"\">- Nên nếu nick của họ bị khóa (checkpoint) sau khi buff sẽ gây ra hiện tưởng tụt trong lúc buff là bình thường..</p><p class=\"cl-red font-bold\" style=\"\">- Do đó, vui lòng buff dư thêm 30 - 50% trên tổng số lượng để tránh tụt hoặc chọn gói bảo hành để được hoàn tiền nếu tụt.</p>', 'show'),
(24, 0, 'dich-vu-facebook', 'Like', 62, '', 'show'),
(25, 0, 'dich-vu-facebook', 'Tăng Follow Page', 60, '', 'show'),
(26, 0, 'dich-vu-youtube', 'Tăng View Youtobe', 100, '', 'show'),
(27, 0, 'dich-vu-tiktok', 'Follow Tik Tok', 60, '', 'show'),
(28, 0, 'dich-vu-tiktok', 'Tăng Like ', 35, '', 'show'),
(29, 0, 'dich-vu-instagram', 'Sub Intagram ( Không Bảo Hành )', 110, '<p><br></p>', 'show'),
(30, 0, 'dich-vu-instagram', 'Sub Íntagram ( Có Bảo Hành )', 165, '', 'show');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `tenweb` text DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `tukhoa` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `baotri` varchar(32) DEFAULT 'OFF',
  `status_top` varchar(32) DEFAULT 'ON',
  `status_order` varchar(32) DEFAULT 'ON',
  `thongbao` text DEFAULT NULL,
  `thong_bao_chay` text DEFAULT NULL,
  `id_fb` text DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `cookie` text NOT NULL,
  `idbot` text DEFAULT NULL,
  `api` text DEFAULT NULL,
  `site_callback` text DEFAULT NULL,
  `img1` text DEFAULT NULL,
  `color` text DEFAULT NULL,
  `color1` text DEFAULT NULL,
  `color_login` text DEFAULT NULL,
  `currency` text DEFAULT NULL,
  `text_xac_minh_giao_dich` longtext DEFAULT NULL,
  `text_login` text DEFAULT NULL,
  `text_nap_tien` longtext DEFAULT NULL,
  `text_mail_order` text DEFAULT NULL,
  `min_order` int(11) DEFAULT 100,
  `ck_nap_the` int(11) DEFAULT 0,
  `keyMOMO` varchar(32) DEFAULT NULL,
  `site_gmail` varchar(32) DEFAULT NULL,
  `site_favicon` text DEFAULT NULL,
  `site_img` text DEFAULT NULL,
  `bg_login` text DEFAULT NULL,
  `site_gmail_momo` text DEFAULT NULL,
  `site_pass_momo` text DEFAULT NULL,
  `site_sdt_momo` text DEFAULT NULL,
  `site_ten_momo` text DEFAULT NULL,
  `site_qr_momo` text DEFAULT NULL,
  `site_noidung_momo` text DEFAULT NULL,
  `site_color_nav` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `tenweb`, `mota`, `tukhoa`, `logo`, `baotri`, `status_top`, `status_order`, `thongbao`, `thong_bao_chay`, `id_fb`, `mail`, `phone`, `cookie`, `idbot`, `api`, `site_callback`, `img1`, `color`, `color1`, `color_login`, `currency`, `text_xac_minh_giao_dich`, `text_login`, `text_nap_tien`, `text_mail_order`, `min_order`, `ck_nap_the`, `keyMOMO`, `site_gmail`, `site_favicon`, `site_img`, `bg_login`, `site_gmail_momo`, `site_pass_momo`, `site_sdt_momo`, `site_ten_momo`, `site_qr_momo`, `site_noidung_momo`, `site_color_nav`) VALUES
(1, 'HACKLIKE06.COM', 'Dịch Vụ Mạnh Xã Hội ', 'dvmxh, vip like, tăng follow, dịch vụ fb, dịch vụ instagram, dịch vụ mang xa hoi,', 'https://i.imgur.com/44BNVQc.png', 'OFF', 'ON', 'ON', '<p>Hệ thống đang trong quá trình xây dựng</p>', 'Sub Like Giá Rẻ', 'https://www.facebook.com/Khang.Tricker.Infor', 'ntt2001811@gmail.com', '0947838128', '', NULL, '5900f9b6-d3c6-4234-ab14-5bec94a41037', 'https://hacklike06.com/callback.php', 'https://mb.dkn.tv/wp-content/uploads/2019/09/facebook-sap-bo-chuc-nang-hien-thi-luot-like-2.jpg', '#2a5792', '#2a5792', '#00172f', 'VNĐ', '<p>- Bạn có chắc chắn muốn <b>THANH TOÁN</b> đơn hàng này ?</p><p>- Sau khi <b>THANH TOÁN</b> không thể tự <b>HỦY</b> mà phải thông qua <b>ADMIN</b>.</p><p>- Vui lòng <a href=\"/ho-tro/create/\" target=\"_blank\">liên hệ</a> chúng tôi để <b>HỦY</b> trước khi đơn hàng được chạy.</p>', '<h1 style=\"text-align: center; \"><font style=\"\" color=\"#ffffff\">Chào Mừng Bạn!</font></h1><h5 style=\"text-align: center;\"><font style=\"\" color=\"#ffffff\">Vui lòng đăng nhập để sử dụng hệ thống</font></h5>', '<ul><li>Vui lòng nhập chính xác nội dung chuyển khoản.</li><li>Nếu nạp thẻ vui lòng nạp đúng mệnh giá, sai mệnh giá mất thẻ.</li></ul>', '<h1>XIN CHÀO ANH/CHỊ!</h1><p><br></p><h2>Đơn hàng của Anh/Chị đã có kết quả ạ</h2><p><br></p><p>Cảm ơn Anh/Chị đã sử dụng dịch vụ.</p>', 100, 30, 'lzOWD1TkyoB1NqXe5EaYIxicPHFRVtGj', 'Haminhquan206@gmail.com', 'https://i.imgur.com/dh6hxAp.png', 'https://i.imgur.com/dh6hxAp.png', 'https://www.wallpaperup.com/uploads/wallpapers/2013/12/15/196208/db243fd17963767a512cc1b1e56ed8f9-1000.jpg', 'haminhquan607@gmail.com', 'haminhquan27012006', '0981493966', 'Ha Minh Quan', '', 'SUBLIKEVN', '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `title` text NOT NULL,
  `content` longtext NOT NULL,
  `createdate` datetime NOT NULL,
  `status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `username`, `title`, `content`, `createdate`, `status`) VALUES
(1, 'admin', 'Yêu cầu hộ trợ', 'Vấn đề cần hỗ trợ là', '2020-08-26 13:30:54', 'xuly');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` text DEFAULT NULL,
  `money` int(11) DEFAULT 0,
  `total_nap` int(11) DEFAULT 0,
  `level` varchar(32) DEFAULT NULL,
  `banned` int(11) DEFAULT 0,
  `createdate` datetime DEFAULT NULL,
  `id_facebook` text DEFAULT NULL,
  `fullname` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `ip` text DEFAULT NULL,
  `ck` int(11) DEFAULT 0,
  `token` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `mail`, `money`, `total_nap`, `level`, `banned`, `createdate`, `id_facebook`, `fullname`, `phone`, `ip`, `ck`, `token`) VALUES
(1007, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Haminhquan607@gmail.com', 0, 0, 'admin', 0, '2020-08-27 14:08:36', NULL, NULL, NULL, '2402:800:61aa:8150:253d:c6a4:51a3:8b6c', 0, NULL),
(1008, 'conganhdz', '97999317d61f5988b261a616419b10aa', 'conganhncov@gmail.com', 0, 0, NULL, 0, '2020-08-27 14:41:15', NULL, NULL, NULL, '1.55.94.4', 0, NULL),
(1009, 'letrinhankhang', '10005e3cbffcd9f2d57731eee0aaa100', 'letrinhankhang@gmail.com', 0, 0, NULL, 0, '2020-08-27 14:46:46', NULL, NULL, NULL, '2402:9d80:3d5:f996:12b:b977:b122:1d14', 0, NULL),
(1010, 'Quanokdz2701', 'd358eeae2a4c2c6813debb16a3fd8846', 'haminhquan206@gmail.com', 12809381, 12819381, '', 0, '2020-08-27 15:15:45', '', '', '', '2402:800:61aa:8150:253d:c6a4:51a3:8b6c', 80, NULL),
(1011, 'tranquanghuy', 'f768982201375a9b982dcbe4991c3533', 'tquanghuy639@gmail.com', 0, 0, NULL, 0, '2020-08-27 15:18:52', NULL, NULL, NULL, '113.185.45.197', 0, NULL),
(1012, 'hoangdubai123', '965edfb36a8a8e0be403c805a1b459b5', 'hoangvlx160@gmail.com', 0, 0, NULL, 0, '2020-08-27 15:19:53', NULL, NULL, NULL, '2402:800:4146:fdfb:f992:624:50ca:1c23', 0, NULL),
(1013, 'Thinhbun2005', 'e49b0cdd0ec6eb8b8e745ae4921dc474', 'thinhbun19012005@gmail.com', 0, 0, NULL, 0, '2020-08-27 15:49:16', NULL, NULL, NULL, '2001:ee0:453b:ac0:4444:f108:5ac7:82d9', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`code`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `momo`
--
ALTER TABLE `momo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_2` (`code`),
  ADD KEY `code` (`code`);

--
-- Indexes for table `reply_ticket`
--
ALTER TABLE `reply_ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `momo`
--
ALTER TABLE `momo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reply_ticket`
--
ALTER TABLE `reply_ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
