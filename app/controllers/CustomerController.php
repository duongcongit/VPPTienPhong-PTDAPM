<?php
require_once _DIR_ROOT.'/app/core/Controller.php';

class Customer extends Controller{
    public function index(){
        // $this->render('index');

        require_once _DIR_ROOT.'/app/views/index.php';
        
    }

    public function cart(){
        $this->render('customer/cart', '');
    }
}