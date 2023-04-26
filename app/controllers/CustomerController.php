<?php
require_once _DIR_ROOT . '/app/core/Controller.php';
require_once _DIR_ROOT . '/app/models/CustomerModel.php';
require_once _DIR_ROOT . '/app/models/ProductModel.php';
require_once _DIR_ROOT . '/app/models/CartModel.php';
require_once _DIR_ROOT . '/app/models/ReceiptModel.php';
require_once  _DIR_ROOT.'/app/sendMail.php';
class Customer extends Controller
{

    public function index()
    {
        require_once _DIR_ROOT . '/app/views/errors/404.php';
    }

    // Xem giở hàng
    public function cart()
    {
        $cartModel = new CartModel();

        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'customer/login');
            return;
        }

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
            header('Location: ' . SITEURL . 'login');
            return;
        }
        if (!isset($_POST['productID']) || !isset($_POST['quantity'])) {
            header('Location: ' . SITEURL . '404');
            return;
        }

        $customerID = $_SESSION['customerID'];
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];

        $productInfo = $productModel->getProductDetail($productID);
        $existProduct = $cartModel->getProductInCart($customerID, $productID);

        if ($existProduct == NULL) {
        }


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

        echo $msg;
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateQuantityInCart()
    {
        $cartModel = new CartModel();

        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'login');
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
    public function order($products = []){
        $receiptModel = new ReceiptModel();
        $cartModel = new CartModel();

        if (!isset($_SESSION['customerID'])) {
            header('Location: ' . SITEURL . 'login');
            return;
        }

        $customerID = $_SESSION['customerID'];

        require_once _DIR_ROOT . '/app/views/customer/order.php';

    }

    // ==================

    public function login(){
        require_once _DIR_ROOT.'/app/views/loginView.php';
    }

    public function signup(){
        require_once _DIR_ROOT.'/app/views/signupView.php';
    }

        public function logout(){
            unset($_SESSION['customerID']);
            unset($_SESSION['customerName']);
            header("Location:" .SITEURL."login");
        }

        public function loginProcess()
        {
            $customerModel = new CustomerModel();
            if (empty($_POST['user']) || empty($_POST['pass'])) {
                $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
                header("Location:" .SITEURL."customer/login");
                exit();
            }
            $user = htmlspecialchars($_POST['user']);
            $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
    
            $res = $customerModel->loginProcess($user, $password);
            if ($res == 1) {
                isset($_SESSION['customerID']);
                isset($_SESSION['customerName']);
                header("Location:" .SITEURL);
            }
            else{
                $_SESSION['error'] = 'Thông tin không chính xác, vui lòng kiểm tra lại!';
                header("Location:" .SITEURL."customer/login");
                exit();
            }
    
        }


        public function signupProcess()
        {
            $customerModel = new CustomerModel();
            if( !isset($_POST['btnSignUp']) ){
                header("Location:" .SITEURL."customer/signup");
            }
            else{
                if (empty($_POST['name']) || empty($_POST['pass'])) {
                    $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
                    header("Location:" .SITEURL."customer/signup");
                    exit();
                }
                $user = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);
                $name = htmlspecialchars($_POST['hoten']);
                $address = htmlspecialchars($_POST['diachi']);
                $phone = htmlspecialchars($_POST['sdt']); 
                $email = htmlspecialchars($_POST['email']);
                $token = md5($email).rand(10,9999);
                $pass_hash=password_hash($password,PASSWORD_DEFAULT);
                $res = $customerModel->signupProcess($name,$address,$phone,$email,$user,$pass_hash,$token);
                if ($res == 1) {
                    header("Location:" .SITEURL. "customer/login");
                }
                else{
                    $_SESSION['error'] = 'Vui lòng kiểm tra lại thông tin đã nhập!';
                    header("Location:" .SITEURL. "customer/signup");
                }
            }
        }

        

    }
?>