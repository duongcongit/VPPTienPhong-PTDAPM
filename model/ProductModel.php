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

        // Lấy tất cả sản phẩm
        public function getAllProducts()
        {
            $conn = $this->connectDb();
            $arr_products = [];
    
            $splQuery = "SELECT products.*,categories.name
            FROM products,categories
            WHERE products.categoryID = categories.categoryID";
            $result = $conn->query($splQuery);
            $arr_products = $result->fetch_all(MYSQLI_ASSOC);
    
            for ($i = 0; $i < $result->num_rows; $i++) {
                $productID = $arr_products[$i]['productID'];
                $sqlGetImages = "SELECT imageID,imageURL FROM product_image WHERE productID='{$productID}' ORDER BY imageID ASC";
                $images = $conn->query($sqlGetImages)->fetch_all(MYSQLI_ASSOC);
    
                foreach ($images as $image) {
                    $imageLabel = "image" . substr($image['imageID'], 0, 1);;
                    $tempImage = array($imageLabel => $image['imageURL']);
                    $arr_products[$i] += $tempImage;
                }

            }
    
            $this->closeDb($conn);
            return $arr_products;
        }

    

        //----------------ADMIN-----------------
        //Thêm loại sản phẩm
        public function insertProductCate($cate) {
            $connection = $this->connectDb();
            $sql_add_category = "INSERT INTO categories VALUES('$cate')";
            $insert_category = mysqli_query($connection,$sql_add_category);
            $this->closeDb($connection);
            return $insert_category;
        }

        //Thêm sản phẩm
        public function insertProduct($arr = []) {
            $connection = $this->connectDb();
            $sql_add_product = "INSERT INTO products (productID, productName, detail,stock, sold, price,status, categoryID,supplierID) VALUES ('{$arr['prodID']}','{$arr['prodName']}', '{$arr['prodDetail']}', '{$arr['prodStock']}', '{$arr['prodSold']}','{$arr['prodPrice']}', '{$arr['prodStatus']}','{$arr['prodCate']}','{$arr['prodSupplierID']}');";
            $insert_product = mysqli_query($connection,$sql_add_product);
            $this->closeDb($connection);
            return $insert_product;
        }

        //Thêm ảnh sản phẩm
        public function insertProductImage($imgID,$url,$prodID) {
            $connection = $this->connectDb();
            $sql_add_product_image = "INSERT INTO product_image (imageID, imageURL,productID) 
            VALUES ('{$imgID}','{$url}','{$prodID}');";
            $insert_employee = mysqli_query($connection,$sql_add_product_image);
            $this->closeDb($connection);
            return $insert_employee;
        }

        //----------------------------

        // Lấy ra chi tiết sản phẩm theo ID
        public function getProductDetail($productID)
        {
            $conn = $this->connectDb();
            $productDetails = [];
    
            $splQuery = "SELECT products.*,categories.name,suppliers.supplierName
            FROM products,categories,suppliers
            WHERE products.productID = '{$productID}' AND products.categoryID = categories.categoryID
            AND products.supplierID = suppliers.supplierID";
    
            // Lấy chi tiết sản phẩm
            $productDetails = $conn->query($splQuery)->fetch_all(MYSQLI_ASSOC)[0];
    
            // Lấy danh sách ảnh
            $sqlGetImages = "SELECT imageID,imageURL FROM product_image WHERE productID='{$productID}' ORDER BY imageID ASC";
            $images = $conn->query($sqlGetImages)->fetch_all(MYSQLI_ASSOC);
    
            foreach ($images as $image) {
                $imageLabel = "image" . substr($image['imageID'], 0, 1);;
                $tempImage = array($imageLabel => $image['imageURL']);
                $productDetails = $productDetails + $tempImage;
            }
    
            $this->closeDb($conn);
            return $productDetails;

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