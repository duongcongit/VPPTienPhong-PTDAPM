<?php

if( $_POST['name']){
    $username=$_POST['name'];
    require '../config/constants.php';
    $sql = "SELECT * FROM users WHERE  username ='$username'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) <= 0){
        echo "";
    }
    else{ 
        echo "Username đã được đăng kí";
    }
    mysqli_close($conn); 
}

?>