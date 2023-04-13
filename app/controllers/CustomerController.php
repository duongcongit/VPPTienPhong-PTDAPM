<?php
require_once _DIR_ROOT . '/app/core/Controller.php';
require_once _DIR_ROOT . '/app/models/ProductModel.php';
require_once _DIR_ROOT . '/app/models/CartModel.php';

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
            header('Location: ' . SITEURL . 'login');
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
}
