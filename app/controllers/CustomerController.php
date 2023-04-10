<?php
require_once _DIR_ROOT . '/app/core/Controller.php';
require_once _DIR_ROOT . '/app/models/ProductModel.php';
require_once _DIR_ROOT . '/app/models/CartModel.php';

class Customer extends Controller
{

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

        $result = $cartModel->addProductToCart($data);
        echo $result;
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
}
