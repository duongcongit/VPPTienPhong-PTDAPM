<?php
    require_once './../config/constants.php';

    class EmployeeModel{
        private $employeeID;
        private $fullname;
        private $gender;
        private $address;
        private $phone;
        private $email;
        private $username;
        private $password;
        private $status;

        // Định nghĩa các phương thức để sau này nhận các thao tác tương ứng với các action
        public function getAllEmployees(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT * FROM employees";
            $result = mysqli_query($conn,$sql);

            // Tôi khai báo biến lưu kết quả trả về (dạng mảng)
            $arr_employees = [];
            // B3. Xử lý và (KO PHẢI SHOW KẾT QUẢ) TRẢ VỀ KẾT QUẢ
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_employees = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }

            return $arr_employees;
        }

        // Hàm lấy dữ liệu theo ID
        public function getUserById($id = null) {
            $connection = $this->connectDb();
            $querySelect = "SELECT * FROM nhanvien WHERE maNV='$id'";
            $results = mysqli_query($connection, $querySelect);
            $user = [];
            if (mysqli_num_rows($results) > 0) {
                $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                $user = $users[0];
            }
            $this->closeDb($connection);
    
            return $user;
        }
        

        // Hàm thêm 
        public function insert($arr = []) {
            $connection = $this->connectDb();
            $queryInsert = "INSERT INTO nhanvien(`hovaten`,`chucvu`,`phongban`,`luong`,`ngayvaolam`) 
            VALUES ('{$arr['hovaten']}','{$arr['chucvu']}','{$arr['phongban']}','{$arr['luong']}','{$arr['ngayvaolam']}')";
            $isInsert = mysqli_query($connection, $queryInsert);
            $this->closeDb($connection);
            return $isInsert;
        }

        // Hàm sửa
        public function update($arr = []) {
            $connection = $this->connectDb();
            $queryUpdate = "UPDATE nhanvien
        SET `hovaten` = '{$arr['hovaten']}',`chucvu` = '{$arr['chucvu']}',`phongban` = '{$arr['phongban']}',`luong` = '{$arr['luong']}',
        `ngayvaolam` = '{$arr['ngayvaolam']}'
        WHERE `maNV` = {$arr['maNV']}";
            $isUpdate = mysqli_query($connection, $queryUpdate);
            $this->closeDb($connection);
    
            return $isUpdate;
        }

        // Ham xóa
        public function delete($id = null) {
            $connection = $this->connectDb();
    
            $queryDelete = "DELETE FROM nhanvien WHERE maNV = '$id'";
            $isDelete = mysqli_query($connection, $queryDelete);
    
            $this->closeDb($connection);
    
            return $isDelete;
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