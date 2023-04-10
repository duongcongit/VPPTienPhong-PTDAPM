<?php
session_start();
define('_DIR_ROOT', __DIR__);
require_once 'app/App.php';
$App = new App();

$_SESSION['customerID'] = "1"; // Test
// unset($_SESSION['customerID']);
?>