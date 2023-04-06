<?php
    require_once 'model/UserModel.php';
    class UserController{
        // Điều khiển về mặt logic giữa UserModel và User View
        public function index(){
            // Tôi sẽ cần gọi UserModel để truy vấn dữ liệu
            $userModel = new UserModel();
            $users = $userModel->getAllUsers();
            // Sau khi truy vấn được dữ liệu,đổ ra UserView/index.php tương ứng
            require_once 'view/user/index.php';
        }

        public function add() {
            $error = '';
            //xử lý submit form
            if (isset($_POST['submit'])) {
                $hoVaTen = $_POST['hovaten'];
                $chucVu = $_POST['chucvu'];
                $phongBan = $_POST['phongban'];
                $luong = $_POST['luong'];
                $ngayVaoLam = $_POST['ngayvaolam'];

                //gọi model để insert dữ liệu vào database
                $userModel = new UserModel();
                //gọi phương thức để insert dữ liệu
                //nên tạo 1 mảng tạm để lưu thông tin của
                //đối tượng dựa theo cấu trúc bảng
                $arr_users = [
                    'hovaten' => $hoVaTen,
                    'chucvu' => $chucVu,
                    'phongban' => $phongBan,
                    'luong' => $luong,
                    'ngayvaolam' => $ngayVaoLam
                ];
                $isInsert = $userModel->insert($arr_users);
                if ($isInsert) {
                    $_SESSION['success'] = "Thêm mới nhân viên thành công";
                }
                else {
                    $_SESSION['error'] = "Thêm mới nhân viên thất bại";
                }
                header("Location: index.php?controller=user&action=index");
                exit();
            }
            //gọi view
            require_once 'view/user/add.php';
        }
    
        public function update() {
            //lấy ra thông tin nhân viên dựa theo id đã gắn trên url
            $id = $_GET['maNV'];
            //gọi model để lấy ra đối tượng nhân viên theo id
            $userModel = new UserModel();
            $user = $userModel->getUserById($id);
    
            //xử lý submit form, lặp lại thao tác khi submit lúc thêm mới
            $error = '';
            if (isset($_POST['submit'])) {
                $hoVaTen = $_POST['hovaten'];
                $chucVu = $_POST['chucvu'];
                $phongBan = $_POST['phongban'];
                $luong = $_POST['luong'];
                $ngayVaoLam = $_POST['ngayvaolam'];

                //xử lý update dữ liệu vào hệ thống
                $userModel = new UserModel();
                $arr_users = [
                    'maNV' => $id,
                    'hovaten' => $hoVaTen,
                    'chucvu' => $chucVu,
                    'phongban' => $phongBan,
                    'luong' => $luong,
                    'ngayvaolam' => $ngayVaoLam
                ];
                $isUpdate = $userModel->update($arr_users);
                if ($isUpdate) {
                    $_SESSION['success'] = "Update bản ghi có mã nhân viên #$id thành công";
                }
                else {
                    $_SESSION['error'] = "Update bản ghi có mã nhân viên #$id thất bại";
                }
                header("Location: index.php?controller=user&action=index");
                exit();
            }
            //truyền ra view
            require_once 'view/user/update.php';
        }
    
        public function delete() {
            //bắt id từ trình duyệt
            $id = $_GET['maNV'];
            if (!is_numeric($id)) {
                header("Location: index.php?controller=user&action=index");
                exit();
            }
    
            $userModel = new UserModel();
            $isDelete = $userModel->delete($id);
    
            if ($isDelete) {
                //chuyển hướng về trang liệt kê danh sách
                //tạo session thông báo mesage
                $_SESSION['success'] = "Xóa bản ghi nhân viên có mã #$id thành công";
            }
            else {
                //báo lỗi
                $_SESSION['error'] = "Xóa bản ghi nhân viên có mã #$id thất bại";
            }
            header("Location: index.php?controller=user&action=index");
            exit();
    
        }

    }

?>