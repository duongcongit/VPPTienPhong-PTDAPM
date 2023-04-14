<?php
require_once _DIR_ROOT . '/app/config/constants.php';


class ProductModel
{

    //----------------ADMIN-----------------
    //Thêm loại sản phẩm
    public function insertProductCate($cate)
    {
        $connection = $this->connectDb();
        $sql_add_category = "INSERT INTO categories VALUES('$cate')";
        $insert_category = mysqli_query($connection, $sql_add_category);
        $this->closeDb($connection);
        return $insert_category;
    }

    //Thêm sản phẩm
    public function insertProduct($arr = [])
    {
        $connection = $this->connectDb();
        $sql_add_product = "INSERT INTO products (productID, productName, detail,stock, sold, price,status, categoryID,supplierID) VALUES ('{$arr['prodID']}','{$arr['prodName']}', '{$arr['prodDetail']}', '{$arr['prodStock']}', '{$arr['prodSold']}','{$arr['prodPrice']}', '{$arr['prodStatus']}','{$arr['prodCate']}','{$arr['prodSupplierID']}');";
        $insert_product = mysqli_query($connection, $sql_add_product);
        $this->closeDb($connection);
        return $insert_product;
    }

    //Thêm ảnh sản phẩm
    public function insertProductImage($imgID, $url, $prodID)
    {
        $connection = $this->connectDb();
        $sql_add_product_image = "INSERT INTO product_image (imageID, imageURL,productID) 
            VALUES ('{$imgID}','{$url}','{$prodID}');";
        $insert_employee = mysqli_query($connection, $sql_add_product_image);
        $this->closeDb($connection);
        return $insert_employee;
    }

    //Update sản phẩm trong bảng products
    public function updateProduct($arr = [])
    {
        $connection = $this->connectDb();
        $sql_update_product = "UPDATE products set `productName` = '{$arr['prodName']}', `detail` ='{$arr['prodDetail']}',`stock`='{$arr['prodStock']}', `sold`='{$arr['prodSold']}', `price`='{$arr['prodPrice']}',
            `status` ='1'
            WHERE productID = '{$arr['prodID']}';";
        $update_product = mysqli_query($connection, $sql_update_product);
        $this->closeDb($connection);
        return $update_product;
    }

    //update ảnh trong bảng product
    public function updateProductImage($imgID, $url)
    {
        $connection = $this->connectDb();
        $sql_add_product_image = "UPDATE product_image set `imageURL` = '$url' WHERE imageID ='$imgID';";
        $insert_employee = mysqli_query($connection, $sql_add_product_image);
        $this->closeDb($connection);
        return $insert_employee;
    }

    //Kiểm tra update xem trong bảng product_image đã có ảnh chưa
    //Nếu có thì thực hiên updateProductImage
    //Không thì thực hiện insertProductImage
    public function checkImageURLByID($imgID)
    {
        $connection = $this->connectDb();
        $sql_add_product_image = "SELECT * from product_image WHERE imageID = '$imgID'";
        $result = mysqli_query($connection, $sql_add_product_image);
        if (mysqli_num_rows($result) > 0) {
            // Lấy tất cả dùng mysqli_fetch_all
            $this->closeDb($connection);
            return 1;
        }

        return 0;
    }

    // Ham xóa sản phẩm trong bảng products
    public function deleteProduct($id)
    {
        $connection = $this->connectDb();
        $queryDelete = "DELETE FROM products WHERE productID = '$id'";
        $isDelete = mysqli_query($connection, $queryDelete);
        $this->closeDb($connection);

        return $isDelete;
    }

    // Ham xóa sản phẩm trong bảng products
    public function deleteProductImage($id)
    {
        $connection = $this->connectDb();
        $queryDelete = "DELETE FROM product_image WHERE productID = '$id'";
        $isDelete = mysqli_query($connection, $queryDelete);
        $this->closeDb($connection);

        return $isDelete;
    }
    //--------------Hết ADMIN-----------------------

    

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
                $imageLabel = "image" . substr($image['imageID'], 0, 1);
                $tempImage = array($imageLabel => $image['imageURL']);
                $arr_products[$i] += $tempImage;
            }
        }

        $this->closeDb($conn);
        return $arr_products;
    }

    // Lấy sản phẩm theo danh mục
    public function getProductsByCategory($categoryID, $orderBy)
    {
        $conn = $this->connectDb();
        $arr_products = [];

        $splQuery = "SELECT products.*,categories.name
        FROM products,categories
        WHERE products.categoryID = categories.categoryID
        AND categories.categoryID = '{$categoryID}'
        ORDER BY ".$orderBy."";
        $result = $conn->query($splQuery);
        $arr_products = $result->fetch_all(MYSQLI_ASSOC);

        for ($i = 0; $i < $result->num_rows; $i++) {
            $productID = $arr_products[$i]['productID'];
            $sqlGetImages = "SELECT imageID,imageURL FROM product_image WHERE productID='{$productID}' ORDER BY imageID ASC";
            $images = $conn->query($sqlGetImages)->fetch_all(MYSQLI_ASSOC);

            foreach ($images as $image) {
                $imageLabel = "image" . substr($image['imageID'], 0, 1);
                $tempImage = array($imageLabel => $image['imageURL']);
                $arr_products[$i] += $tempImage;
            }
        }

        $this->closeDb($conn);
        return $arr_products;
    }

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
            $imageLabel = "image" . substr($image['imageID'], 0, 1);
            $tempImage = array($imageLabel => $image['imageURL']);
            $productDetails = $productDetails + $tempImage;
        }

        $this->closeDb($conn);
        return $productDetails;
    }

    // Lấy sản phẩm bán chạy
    public function getProductsBestSold()
    {
        $conn = $this->connectDb();
        $arr_products = [];

        $splQuery = "SELECT products.*,categories.name
            FROM products,categories
            WHERE products.categoryID = categories.categoryID
            ORDER BY sold DESC";
        $result = $conn->query($splQuery);
        $arr_products = $result->fetch_all(MYSQLI_ASSOC);

        for ($i = 0; $i < $result->num_rows; $i++) {
            $productID = $arr_products[$i]['productID'];
            $sqlGetImages = "SELECT imageID,imageURL FROM product_image WHERE productID='{$productID}' ORDER BY imageID ASC";
            $images = $conn->query($sqlGetImages)->fetch_all(MYSQLI_ASSOC);

            foreach ($images as $image) {
                $imageLabel = "image" . substr($image['imageID'], 0, 1);
                $tempImage = array($imageLabel => $image['imageURL']);
                $arr_products[$i] += $tempImage;
            }
        }

        $this->closeDb($conn);
        return $arr_products;
    }



    public function connectDb()
    {
        $connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$connection) {
            die("Không thể kết nối. Lỗi: " . mysqli_connect_error());
        }

        return $connection;
    }

    public function closeDb($connection = null)
    {
        mysqli_close($connection);
    }
}