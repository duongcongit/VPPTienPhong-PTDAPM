<?php
    require_once _DIR_ROOT.'/app/config/constants.php';


class CustomerModel{
    private $customerID;
    private $fullname;
    private $address;
    private $phone;
    private $email;
    private $username;
    private $password;
    private $status;

    public function connectDb() {
        $connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (!$connection) {
            die("Không thể kết nối. Lỗi: " .mysqli_connect_error());
        }

        return $connection;
    }

    public function closeDb($connection = null) {
        mysqli_close($connection);
    }

    

}

?>