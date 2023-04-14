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
        private $token;

        // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
        public function loginProcess($user,$pass){
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM customers WHERE username = '$user' or email = '$user'";
            $result = mysqli_query($conn,$sql);

            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result);
                if($row['status']==1){
                    if(password_verify($pass,$row['password'])){
                        $_SESSION['cusID']=$row['customerID'];
                        $_SESSION['cusName'] = $row['fullname'];
                        return 1;
                    }
                    else{
                        $_SESSION['error'] = 'Sai mật khẩu!';
                    }
                }
                else{
                    $_SESSION['error'] = 'Vui lòng kích hoạt tài khoản';  
                }   
            }
        }

    

        public function signupProcess($name,$address,$phone,$email,$user,$pass,$token){
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "INSERT INTO users (fullname,address, phone,email,username,password,token) VALUES('$name', '$address', '$phone', '$email' ,'$user', '$pass_hash' , '$token')";
            $result = mysqli_query($conn,$sql);
            $link = "<a href='".SITEURL."/verifyMail/".$email."/".$token."'>Kích hoạt tài khoản</a>";
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if($result == true){
                return $link;
            }
        }

        public function verifyMail($email,$token){
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM customers WHERE token ='$token' and email ='$email'";
            $result = mysqli_query($conn,$sql);
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) >0){
                $row = mysqli_fetch_array($result);
                if(!$row['status']){
                    $sql1="UPDATE customers set status= 1 WHERE email='$email'";
                    mysqli_query($conn,$sql1);
                    $msg = "Chúc mừng! Tài khoản của bạn đã được kích hoạt.";
                }else{
                    $msg = "Tài khoản của bạn đã được kích hoạt rồi!!!";
                }
            }
            else {
                $msg = "Tài khoản này chưa được đăng kí với chúng tôi. Vui lòng đăng ký lại!";
            }
            $this->closeDb($conn);
            return $msg;
        }



        
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