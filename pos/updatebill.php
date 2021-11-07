<?php
	session_start();
	require_once('../ketnoi.php');
	if(isset($_POST['data'])){
		$user = $_SESSION['username'];
		$json =$_POST['data'];
		$table_id= $json['table_id'];
		$customer_id = $json['customer_id'];
		$customer_pay = $json['customer_pay'];
		$note = $json['note'];
		$mahd = $json['hoadon_mahd'];
		$status= $json['status'];
		$reduce_pay = $json['reduce_pay'];
		if($status!='Đã Hoàn thành')
			{$updatetable = "UPDATE ban SET TinhTrang ='yêu cầu' WHERE MaBan ='$table_id'";
			$resulttable = mysqli_query($conn,$updatetable);}
		include '../libs/hoadon.php';
		edit_hoadon_byMaHD($customer_pay,$reduce_pay,$customer_pay,$note,$customer_id,$mahd);
		$tempmasp = "";
		foreach ($json['detail_oder'] as $value) {

			$idproduct = $value['id'];
			$nameproduct = $value['name'];
			$quantity = $value['quantity'];
			$price = $value['price'];
			$noteproduct = $value['note']; if ($noteproduct== "Ghi chú") $noteproduct="";
			$find="SELECT MaSP FROM chitiethoadon WHERE MaHD = '$mahd' AND MaSP= '$idproduct'";
			$result = mysqli_query($conn,$find);$matchFound = mysqli_num_rows($result) > 0 ? 'yes' : 'no';
			if($matchFound=='yes'){
				$detail = "UPDATE chitiethoadon SET Soluong = '$quantity', Note='$noteproduct' WHERE MaHD='$mahd' AND MaSP='$idproduct'" ;
			}else {
				$detail = "INSERT INTO chitiethoadon (MaHD,MaSP,TenSP,Soluong,GiaSP,MaBan,Note) VALUES('$mahd','$idproduct','$nameproduct',$quantity,$price,$table_id,'$noteproduct')";
			};
			$resultdetail = mysqli_query($conn,$detail);
			$tempmasp=$tempmasp."'$idproduct',";
		}
		$tempmasp = rtrim($tempmasp, ",");
		$deletedetail = "DELETE FROM chitiethoadon WHERE MaSP NOT IN ( $tempmasp ) AND MaHD = '$mahd'";
		$resultdetail = mysqli_query($conn,$deletedetail);
		if($status=='Đã Hoàn thành') {$sql="UPDATE hoadon SET Ngaysua =now() WHERE MaHD='$mahd'"; $resulbill = mysqli_query($conn,$sql);}
		if($status=='Đã Hoàn thành') $thongbao='Sửa'; else $thongbao='Lưu';
		echo "<h3>Thông báo !</h3><p>$thongbao hóa đơn thành công</p>";
	}
?>
