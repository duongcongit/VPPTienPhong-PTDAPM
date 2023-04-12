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
<div class="col main-right container-fluid">
<div class="col-md-12 mt-4 mb-3 nav-page">
    <h5 class="text-muted"><a href="<?php echo SITEURL; ?>employee/index">Trang nhân viên</a> / </span><a href="<?php echo SITEURL; ?>employee/report">Báo cáo</a></h5>
</div>


</div>

</div>
<?php
   include _DIR_ROOT.'/app/views/employee/partials/footer.php';  
?>