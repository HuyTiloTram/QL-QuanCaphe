<?php
	require_once('../ketnoi.php');
	if(isset($_POST['newTinhtrang'])){
	include '../libs/check-1condition.php';
	$newtinhtrang=$_POST['newTinhtrang'];$maban=$_POST['MaBan'];
	if(check_1condition('ban','MaBan',"TinhTrang='trống' AND MaBan=$maban" )){	echo '<h3 >Lỗi !</h3><p>Bàn '.$maban.' trống ! không thể hoàn thành</p>';die;}
	if(check_1condition('ban','MaBan',"TinhTrang='hoàn thành' AND MaBan=$maban" )){	echo '<h3 >Không có gì thay đổi !</h3><p>Bàn này đã hoàn thành rồi</p>';die;}
  include '../libs/update-1condition.php';
	include '../libs/get-1condition.php';
	update_1condition('ban','TinhTrang',"'$newtinhtrang'",'MaBan ='.$maban);
	$banten= get_1condition('ban','TenBan','MaBan ='.$maban);foreach ($banten as $bantenitem){ $table_name=$bantenitem['TenBan']; }
	echo '<h3>Thông báo !</h3><p>Đã hoàn thành các order của '.$table_name.'</p>';
	}
?>
