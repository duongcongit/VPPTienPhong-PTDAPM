<?php
require_once '../model/AdminModel.php';

class AdminController
{
    public function login()
    {
        require_once '../view/admin/login.php';
    }

    public function loginProcess(){
        $adminModel = new AdminModel();
        if(empty($_POST['admin']) || empty($_POST['pass'])) {
            $_SESSION['error'] = 'Bạn cần điền đầy đủ thông tin!';
            header('location:login.php');
            exit();
        }
        $user = htmlspecialchars($_POST['admin']);
        $password = htmlspecialchars($_POST['pass'], ENT_QUOTES);

        $res = $adminModel->loginProcess($user,$password);
        if($res==1){
            header('location:index.php');
        }

    }
    //Các hàm lấy view
    public function index()
    {
        $adminModel = new AdminModel();
        $customers = $adminModel->getAllCustomers();
        // Sau khi truy vấn được dữ liệu,đổ ra 
        //View index
        require_once '../view/admin/index.php';
    }

    public function product()
    {
        $adminModel = new AdminModel();
        $products = $adminModel->getAllProducts();
        // Sau khi truy vấn được dữ liệu,đổ ra
        //View product
        require_once '../view/admin/products.php';
    }

    public function supplier()
    {
        $adminModel = new AdminModel();
        $suppliers = $adminModel->getAllSuppliers();
        // Sau khi truy vấn được dữ liệu,đổ ra 
        //View supplier
        require_once '../view/admin/suppliers.php';
    }

    public function employee()
    {
        $adminModel = new AdminModel();
        $employees = $adminModel->getAllEmployees();
        // Sau khi truy vấn được dữ liệu,đổ ra
        //View employee
        require_once '../view/admin/employees.php';
    }

    //-------Customer--------------
    //Hàm thay đổi trạng thái khách hàng
    public function changeStatusCustomer()
    {
        $adminModel = new AdminModel();
        // Lấy ra thông tin
        if (isset($_GET['id']) && isset($_GET['choice'])) {
            $id = $_GET['id'];
            $status = $_GET['choice'];
        }

        //gọi model 
        $res = $adminModel->changeStatusCustomer($id, $status);

        if ($res) {
            $_SESSION['editSuccessStatus'] = "Thay đổi trạng thái của khách hàng có mã #$id thành công";
        }
        if ($res) {
            $_SESSION['editFailStatus'] = "Thay đổi trạng thái của khách hàng có mã #$id thất bại";
        }
        header("Location: index.php");
        exit();
    }


    //-------Product--------------
    //View thêm sản phẩm
    public function addProduct()
    {
        $adminModel = new AdminModel();
        $categories = $adminModel->getAllCategory();
        $suppliers = $adminModel->getAllSuppliers();

        //gọi view
        require_once '../view/admin/addProduct.php';
    }

    //Xử lý thêm sản phẩm CHUA XONG
    public function addProductProcess()
    {
        $adminModel = new AdminModel();
        //xử lý submit form
        if (isset($_POST['btnAddProduct'])) {
            $prodName = $_POST['prodNameAdd'];
            $prodDetail = $_POST['prodDetailAdd'];
            $prodCategory = $_POST['prodCategoryAdd'];
            $prodSKU = $_POST['prodSKUAdd'];
            $prodPrice = $_POST['prodPriceAdd'];
            $prodStock = $_POST['prodStockAdd'];
            $prodSold = 0; // Default
            $userIDPr = $_SESSION['userID'];
            $prodImg = "";
            $prodStatus = 1;

            if ($prodSKU == "") {
                $prodSKU = "NULL";
            }

            $prodID = "SELECT productID FROM products WHERE productName='$prodName'";

            // Gen random character to set name for prducts image
            $temp_word = array_merge(range('a', 'z'));
            shuffle($temp_word);
            $randChr = substr(implode($temp_word), 0, 20) . rand(000, 999) . ".";


            // Process upload product image
            // Imamge 1
            if (isset($_FILES['prodImg1Add']) && !empty($_FILES["prodImg1Add"]["name"])) {
                $targetDir = "../assets/img/products/";
                $fileName_tmp = basename($_FILES["prodImg1Add"]["name"]);
                $fileType = pathinfo($fileName_tmp, PATHINFO_EXTENSION);
                $prodImage1 = "1" . $randChr . $fileType;
                $targetFilePath = $targetDir . $prodImage1;
                $allowTypes = array('jpg', 'png', 'jpeg');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["prodImg1Add"]["tmp_name"], $targetFilePath)) {
                        $sql_insert_img1 = "INSERT INTO product_image VALUES('$prodID', '$prodImage1');";
                        $conn->query($sql_insert_img1);

                    } else {
                        $statusMsgUploadImg = "Đã xảy ra lỗi khi upload ảnh!.";
                    }
                } else {
                    $statusMsgUploadImg = 'Chỉ chấp nhận file JPG, JPEG, PNG.';
                }
            }

            // Image 2
            if (isset($_FILES['prodImg2Add']) && !empty($_FILES["prodImg2Add"]["name"])) {
                $targetDir = "../assets/img/products/";
                $fileName_tmp = basename($_FILES["prodImg2Add"]["name"]);
                $fileType = pathinfo($fileName_tmp, PATHINFO_EXTENSION);
                $prodImage2 = "";
                if (empty($_FILES["prodImg1Add"]["name"])) {
                    $prodImage2 = "1" . $randChr . $fileType;
                } else {
                    $prodImage2 = "2" . $randChr . $fileType;
                }
                $targetFilePath = $targetDir . $prodImage2;
                $allowTypes = array('jpg', 'png', 'jpeg');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["prodImg2Add"]["tmp_name"], $targetFilePath)) {
                        $sql_insert_img2 = "INSERT INTO product_image VALUES('$prodID', '$prodImage2');";
                        $conn->query($sql_insert_img2);

                    } else {
                        $statusMsgUploadImg = "Đã xảy ra lỗi khi upload ảnh!.";
                    }
                } else {
                    $statusMsgUploadImg = 'Chỉ chấp nhận file JPG, JPEG, PNG.';
                }
            }

            // Image 3
            if (isset($_FILES['prodImg3Add']) && !empty($_FILES["prodImg3Add"]["name"])) {
                $targetDir = "../assets/img/products/";
                $fileName_tmp = basename($_FILES["prodImg3Add"]["name"]);
                $fileType = pathinfo($fileName_tmp, PATHINFO_EXTENSION);
                $prodImage3 = "";
                if (empty($_FILES["prodImg1Add"]["name"]) && empty($_FILES["prodImg2Add"]["name"])) {
                    $prodImage3 = "1" . $randChr . $fileType;
                } else if (!empty($_FILES["prodImg1Add"]["name"]) && empty($_FILES["prodImg2Add"]["name"])) {
                    $prodImage3 = "2" . $randChr . $fileType;
                } else if (empty($_FILES["prodImg1Add"]["name"]) && !empty($_FILES["prodImg2Add"]["name"])) {
                    $prodImage3 = "2" . $randChr . $fileType;
                } else {
                    $prodImage3 = "3" . $randChr . $fileType;
                }
                $targetFilePath = $targetDir . $prodImage3;
                $allowTypes = array('jpg', 'png', 'jpeg');
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["prodImg3Add"]["tmp_name"], $targetFilePath)) {
                        $sql_insert_img3 = "INSERT INTO product_image VALUES('$prodID', '$prodImage3');";
                        $conn->query($sql_insert_img3);

                    } else {
                        $statusMsgUploadImg = "Đã xảy ra lỗi khi upload ảnh!.";
                    }
                } else {
                    $statusMsgUploadImg = 'Chỉ chấp nhận file JPG, JPEG, PNG.';
                }
            }

            $arr_products = [
                'hovaten' => $hoVaTen,
                'chucvu' => $chucVu,
                'phongban' => $phongBan,
                'luong' => $luong,
                'ngayvaolam' => $ngayVaoLam
            ];
            $isInsert = $adminModel->insert($arr_products);

            if ($isInsert) {
                $_SESSION['success'] = "Thêm mới sản phẩm thành công";
            } else {
                $_SESSION['error'] = "Thêm mới sản phẩm thất bại";
            }
            header("Location: index.php?controller=user&action=index");
            exit();
        }
        //gọi view
        require_once '../view/admin/products.php';
    }


    //-------------------Supplier--------------
    //Dieu huong trang them supplier
    public function addSupplier()
    {
        //gọi view
        require_once '../view/admin/addSupplier.php';
    }

    //Xu ly them supplier
    public function addSupplierProcess()
    {
        $adminModel = new AdminModel();
        $error = '';
        //xử lý 
        if (isset($_POST['btnAddSupplier'])) {
            $supplierName = $_POST['nameSupplier'];
            $supplierAddress = $_POST['addSupplier'];
            $supplierEmail = $_POST['emailSupplier'];
            $supplierPhone = $_POST['phoneSupplier'];

            //gọi phương thức để insert dữ liệu
            //nên tạo 1 mảng tạm để lưu thông tin của
            //đối tượng dựa theo cấu trúc bảng
            $supplier = [
                'supplierName' => $supplierName,
                'supplierAddress' => $supplierAddress,
                'supplierPhone' => $supplierPhone,
                'supplierEmail' => $supplierEmail
            ];
            $isInsert = $adminModel->insertSupplier($supplier);
            if ($isInsert) {
                $_SESSION['successAddSupplier'] = "Thêm mới nhà cung cấp thành công";
            } else {
                $_SESSION['errorAddSupplier'] = "Thêm mới nhà cung cấp thất bại";
            }

            header("Location: suppliers.php");
            exit();
        }
    }


    //Xu ly xoa nha cung cap
    public function deleteSupplier()
    {
        $adminModel = new AdminModel();
        //xử lý 
        if (isset($_GET['id'])) {
            $supplierId = $_GET['id'];
            $isDelete = $adminModel->deleteSupplier($supplierId);
            echo $isDelete;
            if ($isDelete) {
                $_SESSION['successDeleteSupplier'] = 'Xóa nhà cung cấp có id: ' . $supplierId . ' thành công';
            } else {
                $_SESSION['errorDeleteSupplier'] = 'Xóa nhà cung cấp có id: ' . $supplierId . ' thất bại';
            }
            header("Location: suppliers.php");
            exit();
        }
    }

    //Xu ly xoa toan bo nha cung cap
    public function deleteAllSupplier()
    {
        $adminModel = new AdminModel();
        $isDelete = $adminModel->deleteAllSupplier();
        if ($isDelete) {
            $_SESSION['successDeleteAllSupplier'] = "Xóa toàn bộ NCC thành công";
        } else {
            $_SESSION['errorDeleteAllSupplier'] = "Xóa toàn bộ NCC thất bại";
        }
        header("Location: suppliers.php");
        exit();
    }

    //Update NCC
    //Lấy dữ liệu đổ vào view
    public function updateSupplier()
    {
        $adminModel = new AdminModel();
        if (isset($_GET['id'])) {
            //lấy ra thông tin nhân viên dựa theo id đã gắn trên url
            $supplierId = $_GET['id'];
            //gọi model để lấy ra đối tượng nhân viên theo id
            $supplier = $adminModel->getSupplierById($supplierId);
        }
        //truyền ra view
        require_once '../view/admin/updateSupplier.php';
    }

    //Thực hiện update
    public function updateSupplierProcess()
    {
        $adminModel = new AdminModel();
        //xử lý 
        if (isset($_POST['btnUpdateSupplier'])) {
            $supplierId = $_POST['idSupplier'];
            $supplierName = $_POST['nameSupplier'];
            $supplierAddress = $_POST['addSupplier'];
            $supplierEmail = $_POST['emailSupplier'];
            $supplierPhone = $_POST['phoneSupplier'];

            $supplier = [
                'supplierId' => $supplierId,
                'supplierName' => $supplierName,
                'supplierAddress' => $supplierAddress,
                'supplierPhone' => $supplierPhone,
                'supplierEmail' => $supplierEmail
            ];

            $isUpdate = $adminModel->updateSupplier($supplier);
            if ($isUpdate) {
                $_SESSION['successUpdateSupplier'] = 'Update thông tin NCC có ID' . $supplierId . ' thành công';
            } else {
                $_SESSION['errorUpdateSupplier'] = 'Update thông tin NCC có ID' . $supplierId . ' thất bại';
            }

            header("Location: suppliers.php");
            exit();
        }
    }






    //---------------------Employee--------------------------
    //Gọi view thêm nhân viên
    public function addEmployee()
    {
        //gọi view
        require_once '../view/admin/addEmployee.php';
    }

    //Xử lý thêm nhân viên
    public function addEmployeeProcess()
    {
        $adminModel = new AdminModel();
        //xử lý 
        if (isset($_POST['btnAddEmployee'])) {
            $employeeName = $_POST['nameEmployee'];
            $employeeAddress = $_POST['addEmployee'];
            $employeeGender = $_POST['genderEmployee'];
            $employeeEmail = $_POST['emailEmployee'];
            $employeePhone = $_POST['phoneEmployee'];
            $employeeUsername = $_POST['username'];
            $employeePass = $_POST['password'];
            $employeeID='';

            //Random 5 character
            //x5 chuỗi -> shuffle -> 5 kí tự đầu

            // $s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
            // $temp = "NV";
            // $employeeID = $temp . $s;

            //gọi phương thức để insert dữ liệu
            //nên tạo 1 mảng tạm để lưu thông tin của
            //đối tượng dựa theo cấu trúc bảng
            $employee = [
                'employeeID' => $employeeID,
                'employeeName' => $employeeName,
                'employeeAddress' => $employeeAddress,
                'employeeGender' => $employeeGender,
                'employeePhone' => $employeePhone,
                'employeeEmail' => $employeeEmail,
                'employeeUsername' => $employeeUsername,
                'employeePass' => $employeePass,
            ];

            $isInsert = $adminModel->insertEmployee($employee);
            if ($isInsert) {
                $_SESSION['successAddEmployee'] = "Thêm mới nhân viên thành công";
            } else {
                $_SESSION['errorAddEmployee'] = "Thêm mới nhân viên thất bại";
            }

            header("Location: employees.php");
            exit();
        }
    }


    //Xử lý xóa nhân viên
    public function deleteEmployee()
    {
        $adminModel = new AdminModel();
        //xử lý 
        if (isset($_GET['id'])) {
            $employeeId = $_GET['id'];
            $isDelete = $adminModel->deleteEmployee($employeeId);
            if ($isDelete) {
                $_SESSION['successDeleteEmployee'] = 'Xóa nhà cung cấp có id: ' . $employeeId . ' thành công';
            } else {
                $_SESSION['errorDeleteEmployee'] = 'Xóa nhà cung cấp có id: ' . $employeeId . ' thất bại';
            }
            header("Location: employees.php");
            exit();
        }
    }

    //Xử lý xóa toàn bộ nhân viên
    public function deleteAllEmployee()
    {
        $adminModel = new AdminModel();
        $isDelete = $adminModel->deleteAllEmployee();
        if ($isDelete) {
            $_SESSION['successDeleteAllEmployee'] = "Xóa toàn bộ nhân viên thành công";
        } else {
            $_SESSION['errorDeleteAllEmployee'] = "Xóa toàn bộ nhân viên thất bại";
        }
        header("Location: employees.php");
        exit();
    }

    //Update nhân viên
    //Lấy dữ liệu đổ vào view
    public function updateEmployee()
    {
        $adminModel = new AdminModel();
        if (isset($_GET['id'])) {
            //lấy ra thông tin nhân viên dựa theo id đã gắn trên url
            $employeeId = $_GET['id'];
            //gọi model để lấy ra đối tượng nhân viên theo id
            $employee = $adminModel->getEmployeeById($employeeId);
        }
        //truyền ra view
        require_once '../view/admin/updateEmployee.php';
    }

    //Thực hiện update
    public function updateEmployeeProcess()
    {
        $adminModel = new AdminModel();
        //xử lý 
        if (isset($_POST['btnUpdateEmployee'])) {
            $employeeId = $_POST['idEmployee'];
            $employeeStatus = $_POST['statusEmployee'];
            $employeeName = $_POST['nameEmployee'];
            $employeeAddress = $_POST['addEmployee'];
            $employeeGender = $_POST['genderEmployee'];
            $employeeEmail = $_POST['emailEmployee'];
            $employeePhone = $_POST['phoneEmployee'];
            $employeeUsername = $_POST['username'];
            $employeePass = $_POST['password'];


            $employee = [
                'employeeId' => $employeeId,
                'employeeStatus' => $employeeStatus,
                'employeeName' => $employeeName,
                'employeeGender' => $employeeGender,
                'employeeAddress' => $employeeAddress,
                'employeePhone' => $employeePhone,
                'employeeEmail' => $employeeEmail,
                'employeeUsername' => $employeeUsername,
                'employeePass' => $employeePass
            ];

            $isUpdate = $adminModel->updateEmployee($employee);
            if ($isUpdate) {
                $_SESSION['successUpdateEmployee'] = 'Update thông tin nhân viên có ID' . $employeeId . ' thành công';
            } else {
                $_SESSION['errorUpdateEmployee'] = 'Update thông tin nhân viên có ID' . $employeeId . ' thất bại';
            }

            header("Location: employees.php");
            exit();
        }
    }


}

?>