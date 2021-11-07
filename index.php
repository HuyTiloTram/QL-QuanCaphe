<?php
session_start();
if (!isset($_SESSION['username'])){
  header("location:dangnhap.php");die;}
if ($_SESSION['level']!=1){
  header("location: tongquan.php");die;}
  header("location: tongquan.php");die;
?>
