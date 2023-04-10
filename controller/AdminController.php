<?php
require_once '../model/AdminModel.php';
require_once '../model/ProductModel.php';
require_once '../model/CustomerModel.php';
require_once '../model/EmployeeModel.php';
require_once '../model/SupplierModel.php';



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
        $customerModel = new CustomerModel();
        $customers = $customerModel->getAllCustomers();
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
        $supplierModel = new SupplierModel();
        $suppliers = $supplierModel->getAllSuppliers();
        // Sau khi truy vấn được dữ liệu,đổ ra 
        //View supplier
        require_once '../view/admin/suppliers.php';
    }

    public function employee()
    {
        $employeeModel = new employeeModel();
        $employees = $employeeModel->getAllEmployees();
        // Sau khi truy vấn được dữ liệu,đổ ra
        //View employee
        require_once '../view/admin/employees.php';
    }

    //-------Customer--------------
    //Hàm thay đổi trạng thái khách hàng
    public function changeStatusCustomer()
    {
        $customerModel = new CustomerModel();
        // Lấy ra thông tin
        if (isset($_GET['id']) && isset($_GET['choice'])) {
            $id = $_GET['id'];
            $status = $_GET['choice'];
        }

        //gọi model 
        $res = $customerModel->changeStatusCustomer($id, $status);

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
            $prodSupplierID = $_POST['prodSupplierAdd'];

            //Random 5 character
            //x5 chuỗi -> shuffle -> 5 kí tự đầu

            $s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
            $temp = "PROD";
            $prodID = $temp . $s;

            $prodPrice = $_POST['prodPriceAdd'];
            $prodStock = $_POST['prodStockAdd'];
            $prodSold = 0; // Default

            $prodImg1 = $_POST['imageInsert1'];;
            $prodImg2 = $_POST['imageInsert2'];;
            $prodImg3 = $_POST['imageInsert3'];;

            $prodStatus = 1;
            $arr_product = [
                'prodID'=>$prodID,
                'prodName'=>$prodName,
                'prodDetail'=>$prodDetail,
                'prodCate'=>$prodCategory,
                'prodSupplierID' =>$prodSupplierID,
                'prodPrice' => $prodPrice,
                'prodStock' => $prodStock,
                'prodSold' => $prodSold,
                'prodStatus'=>$prodStatus
            ];

            $isInsert = $adminModel->insertProduct($arr_product);
            $imageUrls = array_filter(array($_POST['imageInsert1'], $_POST['imageInsert2'], $_POST['imageInsert3']));
            $size = count($imageUrls);
            $isInsertImage = array();
            
            $temp = 'image';   
            for ($i = 0; $i < $size; $i++) {
                $imgID = $prodID.($i+1);
                $prodImgLabel = ($i+1).$temp.$prodID;
                $isInsertImage[$i] = $adminModel->insertProductImage($imageUrls[$i], $prodID,$imgID,$prodImgLabel);
            }
            
            if ($isInsert) {
                //&& !in_array(false, $isInsertImage, true)
                $_SESSION['success'] = "Thêm mới sản phẩm thành công";
            } else {
                $_SESSION['error'] = "Thêm mới sản phẩm thất bại";
            }

            // header("Location: product.php");
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
        $supplierModel = new SupplierModel();
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
            $isInsert = $supplierModel->insertSupplier($supplier);
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
        $supplierModel = new SupplierModel();
        //xử lý 
        if (isset($_GET['id'])) {
            $supplierId = $_GET['id'];
            $isDelete = $supplierModel->deleteSupplier($supplierId);
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
        $supplierModel = new SupplierModel();
        $isDelete = $supplierModel->deleteAllSupplier();
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
        $supplierModel = new SupplierModel();
        if (isset($_GET['id'])) {
            //lấy ra thông tin nhân viên dựa theo id đã gắn trên url
            $supplierId = $_GET['id'];
            //gọi model để lấy ra đối tượng nhân viên theo id
            $supplier = $supplierModel->getSupplierById($supplierId);
        }
        //truyền ra view
        require_once '../view/admin/updateSupplier.php';
    }

    //Thực hiện update
    public function updateSupplierProcess()
    {
        $supplierModel = new supplierModel();
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

            $isUpdate = $supplierModel->updateSupplier($supplier);
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
        $employeeModel = new EmployeeModel();
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

            $isInsert = $employeeModel->insertEmployee($employee);
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
        $employeeModel = new EmployeeModel();
        //xử lý 
        if (isset($_GET['id'])) {
            $employeeId = $_GET['id'];
            $isDelete = $employeeModel->deleteEmployee($employeeId);
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
        $employeeModel = new EmployeeModel();
        $isDelete = $employeeModel->deleteAllEmployee();
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
        $employeeModel = new EmployeeModel();
        if (isset($_GET['id'])) {
            //lấy ra thông tin nhân viên dựa theo id đã gắn trên url
            $employeeId = $_GET['id'];
            //gọi model để lấy ra đối tượng nhân viên theo id
            $employee = $employeeModel->getEmployeeById($employeeId);
        }
        //truyền ra view
        require_once '../view/admin/updateEmployee.php';
    }

    //Thực hiện update
    public function updateEmployeeProcess()
    {
        $employeeModel = new EmployeeModel();
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

            $isUpdate = $employeeModel->updateEmployee($employee);
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