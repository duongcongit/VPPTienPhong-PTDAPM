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
        $timeBuy = $data['timeBuy'];
        $consigneeName = $data['consigneeName'];
        $phoneNumber = $data['phoneNumber'];
        $deliveryAddress = $data['deliveryAddress'];
        $paymentMethod = $data['paymentMethod'];
        $status = $data['status'];

        $splQuery = "INSERT INTO receiptP (customerID, timeBuy, consigneeName, phoneNumber, deliveryAddress, paymentMethod, statusR) 
        VALUES ('{$customerID}', '{$timeBuy}', '{$consigneeName}', '{$phoneNumber}', '{$deliveryAddress}', '{$paymentMethod}', '{$status}');";

        $result = $conn->query($splQuery);

        $this->closeDb($conn);

        return $result;
    }

    // Tạo chi tiết hóa đơn
    public function addDetailReceipt($receiptID, $product)
    {
        $conn = $this->connectDb();

        $productID = $product['productID'];
        $price = $product['price'];
        $quantityBuy = $product['quantity'];
        $total = $product['amount'];

        $splQuery = "INSERT INTO detailReceiptP (receiptPID, productID, price, quantityBuy, total) 
        VALUES ('{$receiptID}', '{$productID}', '{$price}', '{$quantityBuy}', '{$total}');";

        $result = $conn->query($splQuery);

        $this->closeDb($conn);
        return $result;
    }

    // 
    public function getReceiptInfo($customerID, $timeBuy)
    {
        $conn = $this->connectDb();

        $sql = "SELECT * FROM receiptP WHERE customerID = '{$customerID}' AND timeBuy = '{$timeBuy}'";

        $result = $conn->query($sql)->fetch_all(MYSQLI_ASSOC)[0];

        $this->closeDb($conn);
        return $result;
    }

    // Lấy các đơn hàng của khách hàng
    public function getReceipts($customerID)
    {

        $conn = $this->connectDb();
        $sql = "SELECT c.username, c.fullname, r.*, r.statusR
            FROM receiptP AS r
            INNER JOIN customers AS c ON r.customerID = c.customerID
            WHERE c.customerID = '{$customerID}';";
        $result = mysqli_query($conn, $sql);

        $arr_receipt = [];
        if (mysqli_num_rows($result) > 0) {

            $arr_receipt = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
        }

        return $arr_receipt;
    }

    // Lấy thông tin một đơn hàng
    public function getReceiptDetail($id)
    {
        $conn = $this->connectDb();
        $sql = "SELECT d.*,p.productName,pi.imageURL 
                FROM receiptP AS r
                INNER JOIN detailReceiptP AS d ON r.receiptPID = d.receiptPID
                INNER JOIN customers AS c ON r.customerID = c.customerID
                INNER JOIN products AS p ON d.productID= p.productID
                INNER JOIN product_image AS pi ON p.productID=pi.productID
                WHERE r.receiptPID = '{$id}' ";
        $result = mysqli_query($conn, $sql);
        // Lấy chi tiết đơn hàng

        $receiptDetail = [];
        // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
        if (mysqli_num_rows($result) > 0) {
            // Lấy tất cả dùng mysqli_fetch_all
            $receiptDetail = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
        }

        $this->closeDb($conn);
        return $receiptDetail;
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
