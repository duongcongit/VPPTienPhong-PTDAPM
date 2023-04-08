<?php
    require_once '../model/AdminModel.php';
    
    class AdminController{
        public function index() {
            $adminModel = new AdminModel();
            $customers = $adminModel->getAllCustomers();
            // Sau khi truy vấn được dữ liệu,đổ ra 
            //View index
            require_once '../view/admin/index.php';
        }

        public function product() {
            $adminModel = new AdminModel();
            $products = $adminModel->getAllProducts();
            // Sau khi truy vấn được dữ liệu,đổ ra
            //View product
            require_once '../view/admin/products.php';
        }

        public function supplier() {
            $adminModel = new AdminModel();
            $suppliers = $adminModel->getAllSuppliers();
            // Sau khi truy vấn được dữ liệu,đổ ra 
            //View supplier
            require_once '../view/admin/suppliers.php';
        }

        public function employee() {
            $adminModel = new AdminModel();
            $employees = $adminModel->getAllEmployees();
            // Sau khi truy vấn được dữ liệu,đổ ra
            //View employee
            require_once '../view/admin/employees.php';
        }

        //-------Customer--------------
        //Hàm thay đổi trạng thái khách hàng
        public function changeStatusCustomer() {
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
        public function addProduct() {
            $adminModel = new AdminModel();
            //Lay category
            $categories = $adminModel->getAllCategory();
            $error = '';
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
                $randChr = substr(implode($temp_word), 0, 20) . rand(000, 999).".";


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
                        $prodImage2 = "1".$randChr . $fileType;
                    } else {
                        $prodImage2 = "2".$randChr . $fileType;
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
                        $prodImage3 = "1".$randChr . $fileType;
                    } else if (!empty($_FILES["prodImg1Add"]["name"]) && empty($_FILES["prodImg2Add"]["name"])) {
                        $prodImage3 = "2".$randChr . $fileType;
                    } else if (empty($_FILES["prodImg1Add"]["name"]) && !empty($_FILES["prodImg2Add"]["name"])) {
                        $prodImage3 = "2".$randChr . $fileType;
                    } else {
                        $prodImage3 = "3".$randChr . $fileType;
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

                //gọi model để insert dữ liệu vào database
                $productModel = new ProductModel();
                //gọi phương thức để insert dữ liệu
                //nên tạo 1 mảng tạm để lưu thông tin của
                //đối tượng dựa theo cấu trúc bảng
                $arr_products = [
                    'hovaten' => $hoVaTen,
                    'chucvu' => $chucVu,
                    'phongban' => $phongBan,
                    'luong' => $luong,
                    'ngayvaolam' => $ngayVaoLam
                ];
                $isInsert = $productModel->insert($arr_products);

                if ($isInsert) {
                    $_SESSION['success'] = "Thêm mới sản phẩm thành công";
                }
                else {
                    $_SESSION['error'] = "Thêm mới sản phẩm thất bại";
                }
                header("Location: index.php?controller=user&action=index");
                exit();
            }
            //gọi view
            require_once '../view/admin/addProduct.php';
        }


        //-------------------Supplier--------------
        //Dieu huong trang them supplier
        public function addSupplier() {
            //gọi view
            require_once '../view/admin/addSupplier.php';
        }   

        //Xu ly them supplier
        public function addSupplierProcess() {
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
                }
                else {
                    $_SESSION['errorAddSupplier'] = "Thêm mới nhà cung cấp thất bại";
                }

                header("Location: suppliers.php");
                exit();
            }
        }


        //Xu ly xoa nha cung cap
        public function deleteSupplier() {
            $adminModel = new AdminModel();
            //xử lý 
            if (isset($_GET['id'])) {
                $supplierId = $_GET['id'];
                $isDelete = $adminModel->deleteSupplier($supplierId);
                echo $isDelete;
                if ($isDelete) {
                    $_SESSION['successDeleteSupplier'] = 'Xóa nhà cung cấp có id: ' . $supplierId . ' thành công';
                }
                else {
                    $_SESSION['errorDeleteSupplier'] = 'Xóa nhà cung cấp có id: ' . $supplierId . ' thất bại';
                }
                header("Location: suppliers.php");
                exit();
            }
        }

        //Xu ly xoa toan bo nha cung cap
        public function deleteAllSupplierProcess() {
            $adminModel = new AdminModel();
            $isDelete = $adminModel->deleteAllSupplier();
            if ($isDelete) {
                $_SESSION['successDeleteAllSupplier'] = "Xóa toàn bộ NCC thành công";
            }
            else {
                    $_SESSION['errorDeleteAllSupplier'] = "Xóa toàn bộ NCC thất bại";
                }
            header("Location: suppliers.php");
            exit();
        }
        
        //Update NCC
        //Lấy dữ liệu đổ vào view
        public function updateSupplier() {
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
        public function updateSupplierProcess() {
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
                    $_SESSION['successUpdateSupplier'] = 'Update thông tin NCC có ID'.$supplierId.' thành công';
                }
                else {
                    $_SESSION['errorUpdateSupplier'] = 'Update thông tin NCC có ID'.$supplierId.' thất bại';
                }

                header("Location: suppliers.php");
                exit();
            }
        }
    }

?>