<?php
    require_once './../config/constants.php';

    class CategoryModel
    {

        // Lấy tất cả các danh mục      
        public function getAllCategory(){
            // B1. Khởi tạo kết nối
            $conn = $this->connectDb();
            // B2. Định nghĩa và thực hiện truy vấn
            $sql = "SELECT *
            FROM categories";
            $result = mysqli_query($conn,$sql);
            $arr_categories = [];
            // B3. Xử lý 
            if(mysqli_num_rows($result) > 0){
                // Lấy tất cả dùng mysqli_fetch_all
                $arr_categories = mysqli_fetch_all($result, MYSQLI_ASSOC); //Sử dụng MYSQLI_ASSOC để chỉ định lấy kết quả dạng MẢNG KẾT HỢP
            }
            $this->closeDb($conn);
            return $arr_categories;
        }

        public function connectDb()
        {
            $connection = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            if (!$connection) {
                die("Không thể kết nối. Lỗi: " . mysqli_connect_error());
            }

            return $connection;
        }

        public function closeDb($connection = null)
        {
            mysqli_close($connection);
        }
    }
?>