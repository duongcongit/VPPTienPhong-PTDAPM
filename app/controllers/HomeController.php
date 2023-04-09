<?php

require_once _DIR_ROOT.'/app/core/Controller.php';
require_once _DIR_ROOT.'/app/models/ProductModel.php';

class Home extends Controller{
    public function index(){

        $productModel = new ProductModel();
        $productsBestSold = $productModel->getProductsBestSold();
        $productsCatThietBi = $productModel->getProductsByCategory("THIETBI");

        require_once _DIR_ROOT.'/app/views/index.php';

        // $this->render('index', $products);
        
    }
}