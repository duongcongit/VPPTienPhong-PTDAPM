<?php

    include "./partials/loginCheck.php";
    include "../config/constants.php";
    if(isset($_POST['btnDel'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM product_image WHERE productID='$id'";
        $res = mysqli_query($conn,$sql);
        $sql1="DELETE FROM products WHERE productID='$id'";
        $res1 = mysqli_query($conn,$sql1);
        
        if($res >0){
            if($res1 >0){
                $_SESSION['success'] = 'Xóa sản phẩm thành công!';
                header("location: products.php"); 
                exit();
            }
            else{
                $_SESSION['error'] = 'Có lỗi';
                header("location: products.php"); 
                exit();
            }
        }else{
            $_SESSION['error'] = 'Xóa sản phẩm thất bại!';
            header("location: products.php"); 
            exit();
        }
    
        mysqli_close($conn);
    }

?>