<?php
	session_start();
	require_once('../ketnoi.php');
	if(isset($_POST['newNote'])){
	include '../libs/update-1condition.php';
	$newnote=$_POST['newNote'];$mahd=$_POST['MaHD'];$masp=$_POST['MaSP'];
	update_1condition('chitiethoadon','Note',"'$newnote'","MaHD='$mahd' AND MaSP='$masp'");
	}
?>
