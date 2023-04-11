<?php

if( $_POST['email']){
    $email=$_POST['email'];
    require '../config/constants.php';
    $sql = "SELECT * FROM users WHERE  email='$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) <= 0){
        echo "";
    }
    else{ 
        echo "Email đã được đăng kí";
    }
    mysqli_close($conn); 
}

?>