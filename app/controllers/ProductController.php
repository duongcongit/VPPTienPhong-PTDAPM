<?php
require_once _DIR_ROOT.'/app/core/Controller.php';
require_once _DIR_ROOT.'/app/models/ProductModel.php';
require_once _DIR_ROOT.'/app/models/CartModel.php';

class Product extends Controller{

    public function index()
    {
        require_once _DIR_ROOT . '/app/views/errors/404.php';
    }

    public function detail($productID=''){
        $productModel = new ProductModel();
        $productDetails = $productModel->getProductDetail($productID);
        $alsoLikeProducts = $productModel->getProductsByCategory($productDetails['categoryID'], "sold desc");
        require_once _DIR_ROOT.'/app/views/product/detail.php';
    }


}