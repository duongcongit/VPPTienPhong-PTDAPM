<?php
    require_once './../config/constants.php';

    class ProductModel{
        private $productID;
        private $productName;
        private $detail;
        private $image;
        private $stock;
        private $sold;
        private $price;
        private $status;
        private $categoryID;
        private $supplierID;

        // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
        public function getAllProducts(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT products.*,categories.name,product_image.imageURL
            FROM products,categories,product_image
            WHERE products.categoryID = categories.categoryID AND products.productID = product_image.productID";
            $result = mysqli_query($conn,$sql);

            // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
            $arr_products = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_products = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }
            $this->closeDb($conn);

            return $arr_products;
        }

        // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
        public function getAllCategory(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT *
            FROM categories";
            $result = mysqli_query($conn,$sql);
        
            // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
            $arr_categories = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_categories = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }
            $this->closeDb($conn);
            return $arr_categories;
        }

        public function insertProduct($arr = []) {
            $connection = $this->connectDb();
            $sql_add_product = "INSERT INTO products (productID, productSKU, productName, categoryID, detail, price, stock, sold, status) VALUES (NULL, '$prodSKU', '$prodName', '$prodCategory', '$prodDetail', '$prodPrice', '$prodStock', '$prodSold', '$prodStatus');";
            $insert_product = mysqli_query($connection,$sql_add_product);
            $this->closeDb($connection);
            return $insert_product;
        }
    
        public function connectDb() {
            $connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if (!$connection) {
                die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
            }
    
            return $connection;
        }
    
        public function closeDb($connection = null) {
            mysqli_close($connection);
        }
    }


?>