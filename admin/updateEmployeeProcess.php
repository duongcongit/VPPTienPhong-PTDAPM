<?php
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'admin';
    //lấy ra action
    $action     = isset($_GET['action']) ? $_GET['action'] : 'updateEmployeeProcess';
    // Trường hợp đặc biệt  là controller và action ko xuất hiện trên URL, nó mặc định là Hiển thị Danh sách người dùng
    // http://localhost/project_mvc/index.php => http://localhost/project_mvc/index.php?controller=user&action=index

    $controller = ucfirst($controller); //URL của chúng ta thiết kế luôn có dạng chữ thường > ucfirst = upper case first => Chuyển kí tự đầu tiên
    // sang chữ IN HOA
    $fileController = $controller . "Controller.php"; //Tên tệp tin muốn truy xuất

    $pathController = "../controller/$fileController"; //Đường dẫn đầy đủ tới tệp tin Controller muốn truy xuất

    if (!file_exists($pathController)) {
        die("Trang bạn tìm không tồn tại"); //Nếu đoạn này xảy ra, chương trình dừng thực hiện
    }

    // Nếu ko, gộp tệp tin Controller tương ứng vào đây
    require_once "$pathController";

    $classController = $controller."Controller"; //Xác định tên Class trong Controller đang định nghĩa

    $object = new $classController(); //Tạo ra đối tượng tương ứng với Class vừa xác định ở trên

    if (!method_exists($object, $action)) {
        die("Phương thức $action không tồn tại trong class $classController"); //Kiểm tra action có tồn tại trong Controller ko
    }
    // Nếu có thì gọi action tương ứng tên phương thức
    $object->$action();
?>