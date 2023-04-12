<?php
    // if (!isset($_SESSION)) 
    // { 
    //     session_start(); 
    // } 
    // if (!isset($_SESSION['empID'])) {
    //     header("location: ../login/loginView.php");
    // }
    include _DIR_ROOT.'/app/views/employee/partials/header.php';  
    // include 'partials/loginCheck.php';
?> 
    <div class="col main-right container-fluid row ">
        <div class="col-md-12 mt-4 mb-3 nav-page">
            <h5 class="text-muted"><a href="">Trang nhân viên</a> / </span><a href="">Quản lý đơn hàng</a></h5>
        </div>
        <form>
            <div class="input-group col-md-12 mt-5 mb-2">
                <div class=" col-lg-6 pe-4">
                    <div class="input-group mb-3">
                        <select class="form-select select-ten">
                            <option value="0" selected>Mã đơn hàng</option>
                            <option value="1">Tên khách hàng</option>
                        </select>
                        <input id="productNameSearch" type="text" class="form-control" placeholder="Nhập vào">
                    </div>
                </div>
                <div class="col-md-12 col-lg-3 pe-4">
                    <button class="btn btn-danger px-4"><i class="bi bi-search ms-auto"></i>Tìm kiếm</button>
                </div>
            </div>
        </form>
        <!--  -->
        <table class="styled-table ">
            <thead>
                <tr>
                    <th>Người dùng</th>
                    <th>Mã đơn hàng</th>
                    <th>Sản phẩm</th>
                    <th>Tổng đơn hàng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody id="table-products">
                <!--  -->
                <?php
                foreach($receiptps as $recp)
                {
                echo '<tr class="bg-white">';
                    echo "<th scope='row'>{$recp['username']}</th>";
                    echo "<th scope='row'>{$recp['receiptPID']}</th>";
                    echo '<th class="row">';
                    echo '<div style="max-width: fit-content;">';
                        echo '<img src="'.$recp['imageURL'].'" alt="" class="product-avatar-list">';
                    echo '</div>';
                    echo ' <div class="col row d-flex align-items-center">';
                        echo '<div class="col-md-12">';
                            echo '<b>' .$recp['productName']. '</b>';
                        echo '</div>';
                    echo '</div>';
                    echo '</th>';
                    echo "<th>{$recp['total']}</th>";
                    echo '<th>';
                        if(!$recp['statusR']){
                            echo '<p class= "text-secondary mb-auto">Đang chờ xác nhận</p>';
                        }
                        else if($recp['statusR']==1){
                            echo '<p class= "text-success mb-auto">Đã xác nhận</p>';
                        }
                        else if($recp['statusR']==2){
                            echo '<p class= "text-danger mb-auto">Đã hủy</p>';
                        }
                        else if($recp['statusR']==3){
                            echo '<p class= "text-success mb-auto">Đã giao</p>';
                        }
                    echo '</th>';
                    if(!$recp['statusR']){
                        echo '<th>';
                        echo '<a type="button"  class="btn ms-auto text-success" href="'.SITEURL.'employee/confirmReceiptp/'.$recp['receiptPID'].'"> <i class="bi bi-check2"></i>Xác nhận</a>';
                        echo '<a type="button"  class="btn ms-auto text-danger" href="'.SITEURL.'employee/refuseReceiptp/'.$recp['receiptPID'].'"> <i class="bi bi-x"></i>Hủy</a>';
                        echo '</th>';
                    }
                    else if($recp['statusR']==1){
                        echo '<th>';
                        echo '<a type="button"  class="btn ms-auto text-danger" href="'.SITEURL.'employee/refuseReceiptp/'.$recp['receiptPID'].'"> <i class="bi bi-x"></i>Hủy</a>';
                        echo '</th>';
                    }
                    else if($recp['statusR']==2){
                        echo '<th>';
                        echo '<a type="button"  class="btn ms-auto text-primary" href="'.SITEURL.'employee/detail/'.$recp['receiptPID'].'"> <i class="bi bi-info"></i>Xem chi tiết</a>';
                        echo '</th>';
                    }
                    else if($recp['statusR']==3){
                        echo '<th>';
                        echo '<a type="button"  class="btn ms-auto text-primary" href="'.SITEURL.'employee/detail/'.$recp['receiptPID'].'"> <i class="bi bi-info"></i>Xem chi tiết</a>';
                        echo '</th>';
                    }

                echo '</tr>';
                }
            
                ?>
                <!--  -->
            </tbody>
        </table>
        <!--  -->
        </div>
        
    </div>

</div>
        
</div>
<?php
include _DIR_ROOT."/app/views/employee/partials/footer.php";
?>