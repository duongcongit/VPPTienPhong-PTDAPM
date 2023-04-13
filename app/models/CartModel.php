<?php
require_once _DIR_ROOT . '/app/config/constants.php';


class CartModel
{

    // Lấy tất cả các sản phẩm trong giỏ hàng theo ID khách hàng
    // và theo thời gian thêm từ mới đến cũ
    public function getAllProductsInCart($customerID)
    {
        $conn = $this->connectDb();
        $products = [];

        $splQuery = "SELECT products.*,cart.*
        FROM products,cart,customers
        WHERE customers.customerID = '{$customerID}'
        AND cart.customerID = customers.customerID
        AND products.productID = cart.productID
        ORDER BY timeAdd DESC";

        $result = $conn->query($splQuery);
        $products = $result->fetch_all(MYSQLI_ASSOC);

        for ($i = 0; $i < $result->num_rows; $i++) {
            $productID = $products[$i]['productID'];
            $sqlGetImages = "SELECT imageID,imageURL FROM product_image WHERE productID='{$productID}' ORDER BY imageID ASC";
            $images = $conn->query($sqlGetImages)->fetch_all(MYSQLI_ASSOC);

            foreach ($images as $image) {
                $imageLabel = "image" . substr($image['imageID'], 0, 1);;
                $tempImage = array($imageLabel => $image['imageURL']);
                $products[$i] += $tempImage;
            }
        }

        $this->closeDb($conn);
        return $products;
    }

    // Lấy một sản phẩm trong giỏ hàng của khách hàng theo ID sản phẩm
    public function getProductInCart($customerID, $productID)
    {
        $conn = $this->connectDb();
        $productDetails = [];

        $splQuery = "SELECT products.*,cart.*
        FROM products,cart,customers
        WHERE customers.customerID = '{$customerID}'
        AND cart.customerID = customers.customerID
        AND products.productID = cart.productID
        AND products.productID='{$productID}';";

        $result = $conn->query($splQuery)->fetch_all(MYSQLI_ASSOC);

        if ($result != NULL) {
            $productDetails = $result[0];
            // Lấy danh sách ảnh
            $sqlGetImages = "SELECT imageID,imageURL FROM product_image WHERE productID='{$productID}' ORDER BY imageID ASC";
            $images = $conn->query($sqlGetImages)->fetch_all(MYSQLI_ASSOC);

            foreach ($images as $image) {
                $imageLabel = "image" . substr($image['imageID'], 0, 1);;
                $tempImage = array($imageLabel => $image['imageURL']);
                $productDetails = $productDetails + $tempImage;
            }

            return $productDetails;
        }

        $this->closeDb($conn);
        return $result;
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addProductToCart($data)
    {
        $conn = $this->connectDb();
        $customerID = $data['customerID'];
        $productID = $data['productID'];
        $quantity = $data['quantity'];
        $currentTime = date("Y-m-d H:i:s");

        $msg = "";

        $splInsert = "INSERT INTO cart (customerID, productID, quantity, timeAdd) 
            VALUES ('{$customerID}', '{$productID}', '{$quantity}', '{$currentTime}');";
        $result = $conn->query($splInsert);

        $this->closeDb($conn);
        return $result;
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateProductQuantity($data)
    {
        $conn = $this->connectDb();
        $customerID = $data['customerID'];
        $productID = $data['productID'];
        $quantity = $data['quantity'];
        $currentTime = date("Y-m-d H:i:s");

        $msg = "";

        $sqlUpdate = "UPDATE cart SET quantity='{$quantity}', timeAdd='{$currentTime}' 
        WHERE customerID='{$customerID}' AND productID = '{$productID}'";
        $result = $conn->query($sqlUpdate);

        $this->closeDb($conn);
        return $result;
    }

    // Xóa một sản phẩm trong giỏ hàng
    public function deleteProductInCart($data)
    {
        $conn = $this->connectDb();
        $customerID = $data['customerID'];
        $productID = $data['productID'];

        $msg = "";

        $sqlDelete = "DELETE FROM cart WHERE customerID='{$customerID}' AND productID = '{$productID}'";
        $result = $conn->query($sqlDelete);

        $this->closeDb($conn);
        return $result;
    }

    // Xóa tất cả các sản phẩm trong giỏ hàng
    public function deleteAllProductsInCart($data)
    {
        $conn = $this->connectDb();
        $customerID = $data['customerID'];

        $msg = "";

        $sqlDelete = "DELETE FROM cart WHERE customerID='{$customerID}';";
        $result = $conn->query($sqlDelete);

        $this->closeDb($conn);
        return $result;
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
