<?php
include "../../config/constants.php";
unset($_SESSION['adminID']);
unset($_SESSION['adminName']);
header("location: ../login.php");

?>