<?php
	session_start();
	if(isset($_POST['newTrangthai'])){
	require_once('ketnoi.php');
	include 'libs/update-1condition.php';
	update_1condition($_POST['table'],'Trangthai',$_POST['newTrangthai'],$_POST['condition1']);
	echo '<h3 class="success1">Thay đổi trạng thái thành công </h3>';
	}
?>
