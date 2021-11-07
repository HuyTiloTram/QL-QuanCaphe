<?php
	session_start();
	require_once('../ketnoi.php');
	if(isset($_POST['newCustomer'])){
	include '../libs/update-1condition.php';
	$newcustomer=$_POST['newCustomer'];$maban=$_POST['MaBan'];
	update_1condition('ban','MaKH',"'$newcustomer'","MaBan = $maban");
	}
?>
