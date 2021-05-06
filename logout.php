<?php session_start();

if (isset($_SESSION['username'])){
    unset($_SESSION['username']);
    unset($_SESSION['usertype_id']); // xóa session login
    header("location: dangnhap.php");
}
?>
