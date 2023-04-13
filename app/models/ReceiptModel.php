<?php
require_once _DIR_ROOT . '/app/config/constants.php';


class ReceiptModel
{

    // Lấy tất cả hóa đơn của khách hàng theo ID khách hàng
    public function getAllReceipts($customerID)
    {
        $conn = $this->connectDb();
        $receipts = [];

        $splQuery = "SELECT receiptP.*
        FROM receiptP
        WHERE customers.customerID = '{$customerID}'
        AND receiptP.customerID = customers.customerID
        ORDER BY timeBuy DESC";

        $result = $conn->query($splQuery);
        $receipts = $result->fetch_all(MYSQLI_ASSOC);

        for ($i = 0; $i < $result->num_rows; $i++) {
            $productID = $receipts[$i]['productID'];
            $sqlGetImages = "SELECT imageID,imageURL FROM product_image WHERE productID='{$productID}' ORDER BY imageID ASC";
            $images = $conn->query($sqlGetImages)->fetch_all(MYSQLI_ASSOC);

            foreach ($images as $image) {
                $imageLabel = "image" . substr($image['imageID'], 0, 1);;
                $tempImage = array($imageLabel => $image['imageURL']);
                $receipts[$i] += $tempImage;
            }
        }

        $this->closeDb($conn);
        return $receipts;
    }

    // Lấy danh sách sản phẩm trong hóa đơn (chi tiết hóa đơn) theo ID hóa đơn
    public function getDetailReceipt($receiptID)
    {
        $conn = $this->connectDb();
        $products = [];

        $splQuery = "SELECT detailReceiptP.*, products.*
        FROM detailReceiptP, products
        WHERE receiptPID = '{$receiptID}'";

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

    // Tạo hóa đơn
    public function createReceipt($data)
    {
        $conn = $this->connectDb();

        $customerID = $data['customerID'];
        $employeeID = $data['employeeID'];
        $status = 0;

        $splQuery = "INSERT INTO receiptP (customerID, employeeID, statusR) 
        VALUES (''{$customerID}'', ''{$employeeID}'', ''{$status}'');";

        $result = $conn->query($splQuery);

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