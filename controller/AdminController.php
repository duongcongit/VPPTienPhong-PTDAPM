<?php
    require_once '../model/AdminModel.php';
    require_once '../model/CustomerModel.php';
    require_once '../model/ProductModel.php';
    require_once '../model/SupplierModel.php';
    require_once '../model/EmployeeModel.php';


    class AdminController{
        // Điều khiển về mặt logic giữa UserModel và User View
        public function index() {
            // Tôi sẽ cần gọi CustomerModel để truy vấn dữ liệu
            $customerModel = new CustomerModel();
            $customers = $customerModel->getAllCustomers();

            // Sau khi truy vấn được dữ liệu,đổ ra AdminView/index.php tương ứng
            require_once '../view/admin/index.php';
        }

        public function product() {
            // Tôi sẽ cần gọi ProductModel để truy vấn dữ liệu
            $productModel = new ProductModel();
            $products = $productModel->getAllProducts();

            // Sau khi truy vấn được dữ liệu,đổ ra AdminView/index.php tương ứng
            require_once '../view/admin/products.php';
        }

        public function supplier() {
            // Tôi sẽ cần gọi SupplierModel để truy vấn dữ liệu
            $supplierModel = new SupplierModel();
            $suppliers = $supplierModel->getAllSuppliers();

            // Sau khi truy vấn được dữ liệu,đổ ra AdminView/index.php tương ứng
            require_once '../view/admin/suppliers.php';
        }

        public function employee() {
            // Tôi sẽ cần gọi SupplierModel để truy vấn dữ liệu
            $employeeModel = new EmployeeModel();
            $employees = $employeeModel->getAllEmployees();

            // Sau khi truy vấn được dữ liệu,đổ ra AdminView/index.php tương ứng
            require_once '../view/admin/employees.php';
        }


        public function addProduct() {
            $productModel = new ProductModel();
            $categories = $productModel->getAllCategory();
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