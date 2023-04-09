<?php
require_once _DIR_ROOT.'/app/core/Controller.php';
require_once _DIR_ROOT.'/app/models/ProductModel.php';

class Product extends Controller{
    public function index(){
        echo "INDEX";
    }

    public function detail($id=''){

        $productModel = new ProductModel();
        $productDetails = $productModel->getProductDetail($id);

        require_once _DIR_ROOT.'/app/views/product/detail.php';
        // $this->render('product/detail', $productDetails);
    }
}