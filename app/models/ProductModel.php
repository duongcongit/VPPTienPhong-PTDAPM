<?php
require_once _DIR_ROOT . '/app/config/constants.php';


class ProductModel
{

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

    // Lấy sản phẩm theo danh mục
    public function getProductsByCategory($categoryID)
    {
        $conn = $this->connectDb();
        $arr_products = [];

        $splQuery = "SELECT products.*,categories.name
        FROM products,categories
        WHERE products.categoryID = categories.categoryID
        AND categories.categoryID = '{$categoryID}'";
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
                $imageLabel = "image" . substr($image['imageID'], 0, 1);;
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
