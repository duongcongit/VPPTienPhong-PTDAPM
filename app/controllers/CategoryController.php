<?php

require_once _DIR_ROOT . '/app/core/Controller.php';
require_once _DIR_ROOT . '/app/models/ProductModel.php';
require_once _DIR_ROOT . '/app/models/CategoryModel.php';

class Category extends Controller
{

    public function index()
    {
        require_once _DIR_ROOT . '/app/views/errors/404.php';
    }


    public function category($categorySlug, $orderBy = "sold desc")
    {
        $categoryModel = new CategoryModel();
        $productModel = new ProductModel();
        $categoryID = strtoupper(str_replace(array('-'), '', $categorySlug));
        switch ($orderBy) {
            case 'product name asc':
                $orderBy = "productName desc";
                break;

            case 'product name desc':
                $orderBy = "productName asc";
                break;
        }

        $arrFilter = ["sold desc", "productName asc", "productName desc", "price asc", "price desc"];
        if (in_array($orderBy, $arrFilter)) {
            $categories = $categoryModel->getAllCategories();
            $category = $categoryModel->getCategory($categoryID);
            $products = $productModel->getProductsByCategory($categoryID, $orderBy);
            require_once _DIR_ROOT . '/app/views/category/show-product-by-category.php';
        } else {
            $this->index();
        }





        // echo '<pre>';
        // print_r($products);
        // echo '</pre>';


    }
}
