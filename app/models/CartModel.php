<?php
require_once _DIR_ROOT . '/app/config/constants.php';


class CartModel
{

    // Lấy tất cả các sản phẩm trong giỏ hàng theo ID khách hàng
    // và theo thời gian thêm từ mới đến cũ
    public function getProductsInCart($customerID)
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
