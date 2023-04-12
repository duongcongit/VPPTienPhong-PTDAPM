<?php
    require_once _DIR_ROOT.'/app/config/constants.php';

    class AdminModel{
        private $adminID;
        private $adminName;
        private $username;
        private $password;

        public function loginProcess($user,$pass){
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM admins WHERE username = '$user' AND password = '$pass'";
            $result = mysqli_query($conn,$sql);

            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result);
                if($pass == $row['password']){
                    $_SESSION['adminID']=$row['adminID'];
                    $_SESSION['adminName'] = $row['adminName'];
                    return 1;
                }
                else{
                    $_SESSION['error'] = 'Sai mật khẩu!';
                }
                    
            }
        }


        //-----------------------------
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