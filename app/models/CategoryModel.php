<?php
require_once _DIR_ROOT . '/app/config/constants.php';


class CategoryModel
{

    // Lấy tất cả các danh mục
    public function getAllCategories()
    {
        $conn = $this->connectDb();
        $categories = [];

        $splQuery = "SELECT products.*,categories.name
        FROM categories";
        $result = $conn->query($splQuery);
        $categories = $result->fetch_all(MYSQLI_ASSOC);

        $this->closeDb($conn);
        return $categories;
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
