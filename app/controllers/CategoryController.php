<?php

require_once _DIR_ROOT.'/app/core/Controller.php';
require_once _DIR_ROOT.'/app/models/ProductModel.php';
require_once _DIR_ROOT.'/app/models/CategoryModel.php';

class Category extends Controller{


    public function category($categorySlug){
        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();
        $categoryID = strtoupper(str_replace(array('-'), '',$categorySlug));

        $category = $categoryModel->getCategory($categoryID);
        $products = $productModel->getProductsByCategory($categoryID);


        // echo '<pre>';
        // print_r($products);
        // echo '</pre>';

        require_once _DIR_ROOT.'/app/views/category/show-product-by-category.php';

        
    }
}