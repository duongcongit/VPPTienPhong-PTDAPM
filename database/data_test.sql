-- Admin
INSERT INTO `admins` (`adminID`, `adminName`, `email`, `username`, `password`) VALUES (NULL, 'Administrator', 'administrator@gmail.com', 'administrator', 'administrator');

-- Customer
INSERT INTO `customers` (`customerID`, `fullname`, `address`, `phone`, `email`, `username`, `password`, `status`, `token`) VALUES (NULL, 'Dương Công', 'Tây Sơn, Hà Nội', '0987654321', 'duongcong@gmail.com', 'duongcong', 'duongcong', '1', NULL);

INSERT INTO `employees` (`employeeID`, `fullname`, `gender`, `phone`, `email`, `username`, `password`, `status`) VALUES (NULL, 'Nhân Viên', 'Nam', '0987654321', 'nhanvien@gmail.com', 'nhanvien', 'nhanvien', '1');

INSERT INTO `suppliers` (`supplierID`, `supplierName`, `address`, `phone`, `email`) VALUES (NULL, 'Văn phòng phẩm Tiền Phong', '175 Tây Sơn, Đống Đa, Hà Nội', '024036548795', 'vpptienphong@gmail.com');


INSERT INTO `categories` (`categoryID`, `name`) VALUES ('GIAYINAN', 'Giấy In Ấn - Photo');
INSERT INTO `categories` (`categoryID`, `name`) VALUES ('THIETBI', 'Thiết bị văn phòng');
INSERT INTO `categories` (`categoryID`, `name`) VALUES ('BUT', 'Bút viết');
INSERT INTO `categories` (`categoryID`, `name`) VALUES ('TBCHOTHUE', 'Thiết bị cho thuê');
INSERT INTO `categories` (`categoryID`, `name`) VALUES ('Lưu trữ', 'Giấy In Ấn - Photo');


INSERT INTO `products` (`productID`, `productName`, `detail`, `stock`, `sold`, `price`, `status`, `categoryID`, `supplierID`) 
VALUES ('SPGA4DA70', 'Giấy A4 Double A 70 Gsm', 'Giấy in A4 là đồ dùng văn phòng phẩm không thể thiếu đối với bất kỳ cơ quan, doanh nghiệp nào. Nó chính là phương tiện chứa đựng mọi thông tin về công việc, làm tư liệu hay mang nhiều công dụng hữu ích khác. Hôm nay, Văn phòng phẩm FAST mang đến cho bạn những thông tin cần thiết về dòng giấy A4 của Thái Lan - Double A, cùng tìm hiểu ngay nào.\r\n<br>\r\nĐặc điểm:\r\n<br>\r\n- Chất giấy láng mịn, bám mực tốt\r\n<br>\r\n- Độ cản quang tốt, thích hợp dùng để in hai mặt\r\n<br>\r\n- Phù hợp với tất cả các dòng máy in và photo', '1000', '250', '66500', '1', 'GIAYINAN', '1');

INSERT INTO `products` (`productID`, `productName`, `detail`, `stock`, `sold`, `price`, `status`, `categoryID`, `supplierID`) 
VALUES ('SPGA5EX70', 'Giấy A5 Excel 80 Gsm', '', '1000', '260', '28000', '1', 'GIAYINAN', '1');

INSERT INTO `products` (`productID`, `productName`, `detail`, `stock`, `sold`, `price`, `status`, `categoryID`, `supplierID`) 
VALUES ('SPMGENIUS', 'Chuột máy tính có dây Genius', '', '1000', '40', '152600', '1', 'THIETBI', '1');

INSERT INTO `products` (`productID`, `productName`, `detail`, `stock`, `sold`, `price`, `status`, `categoryID`, `supplierID`) 
VALUES ('SPBK50LA', 'Bấm kim 50LA', '', '500', '100', '320000', '1', 'DUNGCU', '1');

INSERT INTO `products` (`productID`, `productName`, `detail`, `stock`, `sold`, `price`, `status`, `categoryID`, `supplierID`) 
VALUES ('SPCOMPAKT', 'Compa kỹ thuật', '', '100', '12', '50000', '1', 'DUNGCU', '1');


INSERT INTO `product_image` (`imageID`, `imageURL`, `productID`) 
VALUES ('1imageSPGA4DA70', 'https://cdn.fast.vn/tmp/20200716114159-3.jpg', 'SPGA4DA70');

INSERT INTO `product_image` (`imageID`, `imageURL`, `productID`) 
VALUES ('1imageSPBK50LA', 'http://mauweb.monamedia.net/vanphongphamfast/wp-content/uploads/2018/06/bk-50la-600x600.jpg', 'SPBK50LA');

INSERT INTO `product_image` (`imageID`, `imageURL`, `productID`) 
VALUES ('1imageSPMGENIUS', 'https://cdn.fast.vn/image/cache/data/7/77690chuot-600x450.jpg', 'SPMGENIUS');

INSERT INTO `product_image` (`imageID`, `imageURL`, `productID`) 
VALUES ('1imageSPGA5EX70', 'https://cdn.fast.vn/tmp/20221026132948-z3830392318118_9c4f34eeadac9a88775d64847af8a9be.jpg', 'SPGA5EX70');

INSERT INTO `product_image` (`imageID`, `imageURL`, `productID`) 
VALUES ('1imageSPCOMPAKT', 'http://mauweb.monamedia.net/vanphongphamfast/wp-content/uploads/2018/06/compa.png', 'SPCOMPAKT');
