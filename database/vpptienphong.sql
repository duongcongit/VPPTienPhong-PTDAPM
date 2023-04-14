-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 14, 2023 lúc 06:26 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vpptienphong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`adminID`, `adminName`, `email`, `username`, `password`) VALUES
(1, 'Administrator', 'administrator@gmail.com', 'administrator', 'administrator'),
(2, 'Dương Công', 'duongcong@gmail.com', 'duongcong', 'duongcong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `customerID` int(11) NOT NULL,
  `productID` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `timeAdd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`customerID`, `productID`, `quantity`, `timeAdd`) VALUES
(1, 'SPBK50LA', 2, '2023-04-14 13:41:58'),
(1, 'SPCOMPAKT', 3, '2023-04-14 13:43:46'),
(1, 'SPGA4DA70', 5, '2023-04-14 13:42:58'),
(1, 'SPMGENIUS', 2, '2023-04-14 13:42:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `categoryID` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categoryID`, `name`) VALUES
('BUT', 'Bút viết'),
('DUNGCU', 'Dụng cụ văn phòng'),
('GIAYINAN', 'Giấy In Ấn - Photo'),
('LUUTRU', 'Lưu trữ'),
('THIETBI', 'Thiết bị văn phòng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customerID`, `fullname`, `address`, `phone`, `email`, `username`, `password`, `status`, `token`) VALUES
(1, 'Dương Công', 'Tây Sơn, Hà Nội', '0987654321', 'duongcong@gmail.com', 'duongcong', '$2y$10$B5I.Tn9807qhhF9N7vhH7u4eLqYtn2z6QieBvlAOb4Pe17RnWE/q2', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detailReceiptP`
--

CREATE TABLE `detailReceiptP` (
  `receiptPID` int(11) NOT NULL,
  `productID` varchar(10) NOT NULL,
  `price` int(20) NOT NULL,
  `quantityBuy` int(20) NOT NULL,
  `total` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

CREATE TABLE `employees` (
  `employeeID` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`employeeID`, `fullname`, `gender`, `address`, `phone`, `email`, `username`, `password`, `status`) VALUES
(1, 'Nhân Viên', 'Nam', 'Tây Sơn, Hà Nội', '0987654321', 'nhanvien@gmail.com', 'nhanvien', 'nhanvien', 1),
(2, 'Dương Công', 'Nam', 'HN', '894651230', 'duongcong@egklhn.com', 'duongcong', 'duongcong', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `productID` varchar(10) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `detail` varchar(3000) NOT NULL,
  `stock` int(20) NOT NULL,
  `sold` int(20) NOT NULL,
  `price` int(20) NOT NULL,
  `status` int(5) NOT NULL,
  `categoryID` varchar(30) NOT NULL,
  `supplierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`productID`, `productName`, `detail`, `stock`, `sold`, `price`, `status`, `categoryID`, `supplierID`) VALUES
('SPBK50LA', 'Bấm kim 50LA', '', 2, 100, 320000, 1, 'DUNGCU', 1),
('SPCOMPAKT', 'Compa kỹ thuật', '', 100, 12, 50000, 1, 'DUNGCU', 1),
('SPGA4DA70', 'Giấy A4 Double A 70 Gsm', 'Giấy in A4 là đồ dùng văn phòng phẩm không thể thiếu đối với bất kỳ cơ quan, doanh nghiệp nào. Nó chính là phương tiện chứa đựng mọi thông tin về công việc, làm tư liệu hay mang nhiều công dụng hữu ích khác. Hôm nay, Văn phòng phẩm FAST mang đến cho bạn những thông tin cần thiết về dòng giấy A4 của Thái Lan - Double A, cùng tìm hiểu ngay nào.\r\n<br>\r\nĐặc điểm:\r\n<br>\r\n- Chất giấy láng mịn, bám mực tốt\r\n<br>\r\n- Độ cản quang tốt, thích hợp dùng để in hai mặt\r\n<br>\r\n- Phù hợp với tất cả các dòng máy in và photo', 1000, 250, 66500, 1, 'GIAYINAN', 1),
('SPGA5EX80', 'Giấy A5 Excel 80 Gsm', '', 1000, 260, 28000, 1, 'GIAYINAN', 1),
('SPMGENIUS', 'Chuột máy tính có dây Genius', '', 1000, 40, 152600, 1, 'THIETBI', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_image`
--

CREATE TABLE `product_image` (
  `imageID` varchar(255) NOT NULL,
  `imageURL` varchar(1000) NOT NULL,
  `productID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_image`
--

INSERT INTO `product_image` (`imageID`, `imageURL`, `productID`) VALUES
('1imageSPBK50LA', 'http://mauweb.monamedia.net/vanphongphamfast/wp-content/uploads/2018/06/bk-50la-600x600.jpg', 'SPBK50LA'),
('1imageSPCOMPAKT', 'http://mauweb.monamedia.net/vanphongphamfast/wp-content/uploads/2018/06/compa.png', 'SPCOMPAKT'),
('1imageSPGA4DA70', 'https://cdn.fast.vn/tmp/20200716114159-3.jpg', 'SPGA4DA70'),
('1imageSPGA5EX80', 'https://cdn.fast.vn/tmp/20221026132948-z3830392318118_9c4f34eeadac9a88775d64847af8a9be.jpg', 'SPGA5EX80'),
('1imageSPMGENIUS', 'https://cdn.fast.vn/image/cache/data/7/77690chuot-600x450.jpg', 'SPMGENIUS');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `receiptP`
--

CREATE TABLE `receiptP` (
  `receiptPID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `timeBuy` datetime NOT NULL,
  `statusR` int(11) NOT NULL,
  `consigneeName` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `deliveryAddress` varchar(255) NOT NULL,
  `paymentMethod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`supplierID`, `supplierName`, `address`, `phone`, `email`, `status`) VALUES
(1, 'Văn phòng phẩm Tiền Phong', '175 Tây Sơn, Đống Đa, Hà Nội', '024036548795', 'vpptienphong@gmail.com', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`customerID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `detailReceiptP`
--
ALTER TABLE `detailReceiptP`
  ADD PRIMARY KEY (`receiptPID`,`productID`),
  ADD KEY `productID` (`productID`);

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Chỉ mục cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `productID` (`productID`);

--
-- Chỉ mục cho bảng `receiptP`
--
ALTER TABLE `receiptP`
  ADD PRIMARY KEY (`receiptPID`),
  ADD KEY `customerID` (`customerID`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplierID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `receiptP`
--
ALTER TABLE `receiptP`
  MODIFY `receiptPID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Các ràng buộc cho bảng `detailReceiptP`
--
ALTER TABLE `detailReceiptP`
  ADD CONSTRAINT `detailReceiptP_ibfk_1` FOREIGN KEY (`receiptPID`) REFERENCES `receiptP` (`receiptPID`),
  ADD CONSTRAINT `detailReceiptP_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplierID`) REFERENCES `suppliers` (`supplierID`);

--
-- Các ràng buộc cho bảng `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Các ràng buộc cho bảng `receiptP`
--
ALTER TABLE `receiptP`
  ADD CONSTRAINT `receiptP_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`),
  ADD CONSTRAINT `receiptP_ibfk_2` FOREIGN KEY (`employeeID`) REFERENCES `employees` (`employeeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
