<?php
require_once _DIR_ROOT.'/app/core/Controller.php';
require_once _DIR_ROOT.'/app/models/ProductModel.php';
require_once _DIR_ROOT.'/app/models/CartModel.php';

class Product extends Controller{
    public function index(){
        echo "INDEX";
    }

    public function detail($id=''){

        $productModel = new ProductModel();
        $productDetails = $productModel->getProductDetail($id);
        $alsoLikeProducts = $productModel->getProductsByCategory($productDetails['categoryID']);

        require_once _DIR_ROOT.'/app/views/product/detail.php';
        // $this->render('product/detail', '');
    }

    public function addProductToCart(){
        $productModel = new ProductModel();
        $cartModel = new CartModel();

        $customerID = $_POST['customerID'];
        $productID = $_POST['productID'];
        $quantity = $_POST['quantity'];

        $data = array("customerID"=>$customerID, "productID"=>$productID, "quantity"=>$quantity);

        $result = $cartModel->addProductToCart($data);
        echo $result;

    }
}