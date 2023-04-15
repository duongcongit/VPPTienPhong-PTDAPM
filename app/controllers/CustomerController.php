<?php
require_once _DIR_ROOT . '/app/core/Controller.php';
require_once _DIR_ROOT . '/app/models/CustomerModel.php';
require_once _DIR_ROOT . '/app/models/ProductModel.php';
require_once _DIR_ROOT . '/app/models/CartModel.php';
require_once _DIR_ROOT . '/app/models/ReceiptModel.php';

class Customer extends Controller
{

    public function index()
    {
        $receiptModel = new ReceiptModel();
        $productModel = new ProductModel();

        $this->checkLogin();

        $customerID = $_SESSION['customerID'];
        $receipts = [];
        $products = array("products" => []);
        $productsRaw = [];

        $receiptsRaw = $receiptModel->getReceipts($customerID);

        $total = 0;

        

        for($i = 0; $i<count($receiptsRaw); $i++){

            $receiptID = $receiptsRaw[$i]['receiptPID'];
            $productsRaw = $receiptModel->getReceiptDetail($receiptID);
            $products['products'] = $products['products'] + $productsRaw;

            $tempRe = $receiptsRaw[$i];
            

            foreach($products['products'] as $product){
                $total = $total + $product['total'];
            }

            $tempRe = $tempRe + array("total" => $total);

            $tempRe = $tempRe + $products;
            array_push($receipts, $tempRe);
            

        }

        // echo '<pre>';
        // print_r($receipts);
        // echo '</pre>';

        require_once _DIR_ROOT . '/app/views/customer/receipts.php';
    }

    private function checkLogin()
    {
        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'customer/login');
            return;
        }
    }

    // Xem giở hàng
    public function cart()
    {
        $cartModel = new CartModel();
        $this->checkLogin();
        $customerID = $_SESSION['customerID'];
        $products = $cartModel->getAllProductsInCart($customerID);
        require_once _DIR_ROOT . '/app/views/customer/cart.php';
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addProductToCart()
    {
        $productModel = new ProductModel();
        $cartModel = new CartModel();
        $msg = "";

        if (!isset($_SESSION['customerID'])) {
            // header('Location: ' . SITEURL . 'customer/login');
            $msg = "No logged";
            echo $msg;
            return;
        } else if (!isset($_POST['productID']) || !isset($_POST['quantity'])) {
            // header('Location: ' . SITEURL . '404');
            $msg = "404";
            echo $msg;
            return;
        } else {
            $customerID = $_SESSION['customerID'];
            $productID = $_POST['productID'];
            $quantity = $_POST['quantity'];

            $productInfo = $productModel->getProductDetail($productID);
            $existProduct = $cartModel->getProductInCart($customerID, $productID);

            if ($existProduct == NULL) {
                if ($quantity > $productInfo['stock']) {
                    $msg = "Exceed the available quantity";
                } else {
                    $data = array("customerID" => $customerID, "productID" => $productID, "quantity" => $quantity);
                    $result = $cartModel->addProductToCart($data);
                }
            } else {
                $quantity = $quantity + $existProduct['quantity'];
                if ($quantity > $productInfo['stock']) {
                    $msg = "Exceed the available quantity";
                } else {
                    $data = array("customerID" => $customerID, "productID" => $productID, "quantity" => $quantity);
                    $result = $cartModel->updateProductQuantity($data);
                }
            }
        }



        echo $msg;
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateQuantityInCart()
    {
        $cartModel = new CartModel();

        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . '/customer/login');
            return;
        }
        if (!isset($_POST['productID']) || !isset($_POST['quantity'])) {
            header('Location: ' . SITEURL . '404');
            return;
        }

        $customerID = $_SESSION['customerID'];
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];

        $data = array("customerID" => $customerID, "productID" => $productID, "quantity" => $quantity);

        $result = $cartModel->updateProductQuantity($data);
    }

    // Xóa một sản phẩm trong giỏ hàng
    public function removeProductFromCart()
    {
        $cartModel = new CartModel();

        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'login');
            return;
        }
        if (!isset($_POST['productID'])) {
            header('Location: ' . SITEURL . '404');
            return;
        }

        $customerID = $_SESSION['customerID'];
        $productID = $_POST['productID'];
        $data = array("customerID" => $customerID, "productID" => $productID);
        $result = $cartModel->deleteProductInCart($data);
    }

    // Xóa tất cả sản phẩm trong giỏ hàng
    public function clearCart()
    {
        $cartModel = new CartModel();

        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'login');
            return;
        }
        $customerID = $_SESSION['customerID'];
        $data = array("customerID" => $customerID);
        $result = $cartModel->deleteAllProductsInCart($data);
    }

    // Đặt hàng
    public function order($products = [])
    {

        unset($_SESSION["order"]);
        $orderDetail = [];

        $receiptModel = new ReceiptModel();
        $cartModel = new CartModel();
        $customerModel = new CustomerModel();

        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'customer/login');
            return;
        }

        if (!isset($_POST['product1'])) {
            header('Location: ' . SITEURL . 'customer/cart');
            return;
        }

        $customerID = $_SESSION['customerID'];

        $customerInfo = $customerModel->getCustomerInfo($customerID)[0];
        $deliveryInfo = array("deliveryInfo" => array(
            "consigneeName" => $customerInfo['fullname'],
            "phoneNumber" => $customerInfo['phone'],
            "deliveryAddress" => $customerInfo['address'],
        ));

        $products = [];
        $paymentMethod = array("paymentMethod" => "1");
        $total = 0;

        for ($i = 0; $i < count($_POST); $i++) {
            $product = [];
            $temp = array_filter(explode(',', $_POST['product' . $i]));
            $product += array(
                "productID" => $temp[0],
                "productName" => $temp[1],
                "image" => $temp[2],
                "price" => $temp[3],
                "quantity" => $temp[4],
                "amount" => $temp[3] * $temp[4]
            );

            array_push($products, $product);
            $total = $total + $product["amount"];
        }

        if (!isset($_POST['product1'])) {
            header('Location: ' . SITEURL . 'customer/cart');
            return;
        }

        $products = array("products" => $products);
        $total = array("total" => $total);

        $orderDetail += $deliveryInfo + $products + $paymentMethod + $total;

        $product = null;

        $_SESSION["order"] = $orderDetail;


        // echo '<pre>';
        // print_r($_SESSION["order"]);
        // echo '</pre>';

        require_once _DIR_ROOT . '/app/views/customer/order.php';
    }

    // Xử lý đặt hàng
    public function orderProcess($data = [])
    {
        $receiptModel = new ReceiptModel();
        $cartModel = new CartModel();

        if (!isset($_SESSION["order"]) || !isset($_POST['order'])) {
            header('Location: ' . SITEURL . 'customer/cart');
            return;
        }

        $customerID = $_SESSION['customerID'];
        $orderDetail = $_SESSION["order"];
        $timeBuy = date("Y-m-d H:i:s");
        $status = 0;

        $data = array(
            "customerID" => $customerID,
            "timeBuy" => $timeBuy,
            "consigneeName" => $orderDetail['deliveryInfo']['consigneeName'],
            "phoneNumber" => $orderDetail['deliveryInfo']['phoneNumber'],
            "deliveryAddress" => $orderDetail['deliveryInfo']['deliveryAddress'],
            "paymentMethod" => $orderDetail['paymentMethod'],
            "status" => $status
        );

        $receiptModel->createReceipt($data);

        $receiptID = $receiptModel->getReceiptInfo($customerID, $timeBuy)['receiptPID'];

        foreach ($orderDetail['products'] as $product) {
            $proData = array(
                "productID" => $product['productID'],
                "price" => $product['price'],
                "quantity" => $product['quantity'],
                "amount" => $product['amount']
            );

            $resultAddDetailReceipt = $receiptModel->addDetailReceipt($receiptID, $proData);
        }

        // Unset
        // unset(
        //     $receiptModel,
        //     $cartModel,
        //     $customerID,
        //     $orderDetail,
        //     $timeBuy,
        //     $status,
        //     $data,
        //     $proData
        // );

        header('Location: ' . SITEURL . 'customer/orderSuccess/' . $receiptID);
        return;
    }

    public function orderSuccess($receiptID)
    {
        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'customer/login');
            return;
        }

        // if($receiptID == NULL || $receiptID = ""){
        //     require_once _DIR_ROOT . '/app/views/errors/404.php';
        // }
        require_once _DIR_ROOT . '/app/views/customer/orderSuccess.php';
    }

    // ==================

    public function login()
    {
        require_once _DIR_ROOT . '/app/views/loginView.php';
    }

    public function signup()
    {
        require_once _DIR_ROOT . '/app/views/signupView.php';
    }

    public function logout()
    {
        unset($_SESSION['customerID']);
        unset($_SESSION['customerName']);
        header("Location:" . SITEURL);
    }

    public function loginProcess()
    {
        $customerModel = new CustomerModel();
        if (empty($_POST['user']) || empty($_POST['pass'])) {
            $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
            header("Location:" . SITEURL . "customer/login");
            exit();
        }
        $user = htmlspecialchars($_POST['user']);
        $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);

        $res = $customerModel->loginProcess($user, $password);
        if ($res == 1) {
            isset($_SESSION['customerID']);
            isset($_SESSION['customerName']);
            header("Location:" . SITEURL);
        } else {
            $_SESSION['error'] = 'Thông tin không chính xác, vui lòng kiểm tra lại!';
            header("Location:" . SITEURL . "customer/login");
            exit();
        }
    }


    public function signupProcess()
    {
        $customerModel = new CustomerModel();
        if (!isset($_POST['btnSignUp'])) {
            header("location: ../signup.php");
        } else {
            if (empty($_POST['emp']) || empty($_POST['pass'])) {
                $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
                header("Location:" . SITEURL . "signup");
                exit();
            }
            $user = htmlspecialchars($_POST['name']);
            $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
            $name = htmlspecialchars($_POST['hoten']);
            $address = htmlspecialchars($_POST['diachi']);
            $phone = htmlspecialchars($_POST['sdt']);
            $email = htmlspecialchars($_POST['email']);
            $token = md5($email) . rand(10, 9999);
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $res = $customerModel->signupProcess($name, $address, $phone, $email, $user, $pass_hash, $token);
            if ($res == 1) {
                require_once  _DIR_ROOT . '/app/sendMail.php';
                if (sendEmailForAccountActive($email, $res)) {
                    echo "Vui lòng kiểm tra hộp thư của bạn để kích hoạt tài khoản";
                } else {
                    echo "Xin lỗi email chưa được gửi đi. Vui lòng kiểm tra thông tin tài khoản";
                }
            }
        }
    }
    public function verifyMail($email, $token)
    {
        $customerModel = new CustomerModel();
        $verify = $customerModel->verifyMail($email, $token);

        require_once _DIR_ROOT . '/app/views/verifyMail.php';
    }
}
