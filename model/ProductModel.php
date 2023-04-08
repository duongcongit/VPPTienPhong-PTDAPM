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