<?php
	session_start();
	if(isset($_POST['table'])){
		require_once('ketnoi.php');
		include 'check-1condition.php';
		$table=$_POST['table'];$condition1=$_POST['condition1'];
		if ($table=='sanpham'){
			if(isset($_POST['masp'])) $masp=$_POST['masp'];
			if (check_1condition('sanpham','MaSP',"MaSP='$masp'")==0)
				{echo '<h3 class="success1" style="background: rgba(255,106,106,.20);color:red;padding:7px;">Không tìm thấy mã sản phẩm muốn xóa</h3>';die;}
	 		if (check_1condition('chitiethoadon','MaSP',"MaSP='$masp'")==1)
				{echo '<h3 class="success1" style="background: rgba(255,106,106,.20);color:red;padding:7px;">Sản phẩm Vẫn tồn tại trong chi tiết hóa đơn không thể xóa</h3>';die;}
		}
		if(isset($_POST['img'])){
			$img=$_POST['img'];
			$sql="SELECT $img FROM $table WHERE $condition1";
			$query = mysqli_query($conn, $sql);
			while ($row= mysqli_fetch_array($query)) {$hinhanh=$row[$img]; if($hinhanh!='') unlink($_POST['diachi'].$hinhanh);}
		}
		$sql = "DELETE FROM $table WHERE $condition1 ";
		$result = mysqli_query($conn, $sql);
		echo '<h3 class="success1" style="background: green;color:white;padding:7px;">Xóa sản phẩm thành công</h3>';
	};
?>
