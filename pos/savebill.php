<?php
	session_start();
	require_once('../ketnoi.php');
	if(isset($_POST['data'])){
		include '../libs/update-1condition.php';
		$user = $_SESSION['username'];
		$json =$_POST['data'];
		$sql ="SELECT hoadon_id FROM hoadon ORDER BY hoadon_id DESC LIMIT 1	";
		$query= mysqli_query($conn,$sql);
		if($query){
        while ($row = mysqli_fetch_assoc($query)){
            $temp1=$row['hoadon_id'];
						if ($temp1 <=9) $temp2="HD00000000"; elseif ($temp1 >9) $temp2="HD0000000"; elseif ($temp1>99) $temp2="HD000000"; elseif ($temp1>999) $temp2="HD00000"; elseif ($temp1>9999) $temp2="HD0000"; elseif ($temp1>99999) $temp2="HD000"; elseif ($temp1>999999) $temp2="HD00"; elseif ($temp1>9999999) $temp2="HD0"; else $temp2="HD";
						$temp1=$temp1+1;
						$idbill=$temp2.$temp1;
        }
    }
		$table_id= $json['table_id'];
		$customer_id = $json['customer_id'];
		$customer_pay = $json['customer_pay'];
		$reduce_pay = $json['reduce_pay'];
		$note = $json['note'];

		update_1condition('ban','TinhTrang',"'yêu cầu'",'MaBan ='.$table_id);
		include '../libs/hoadon.php';
		add_hoadon($idbill,$user,'now()',$customer_pay,$reduce_pay,$customer_pay,NULL,$table_id,1,$note,$customer_id);

		update_1condition('ban','ThoigianDen','now()','MaBan ='.$table_id);
		foreach ($json['detail_oder'] as $value) {
			$idproduct = $value['id'];
			$nameproduct = $value['name'];
			$quantity = $value['quantity'];
			$price = $value['price'];
			$noteproduct = $value['note']; if ($noteproduct== "Ghi chú") $noteproduct="";
			$insertdetail = "INSERT INTO chitiethoadon (MaHD,MaSP,TenSP,Soluong,GiaSP,MaBan,Note) VALUES('$idbill','$idproduct','$nameproduct',$quantity,$price,$table_id,'$noteproduct')";
			$resultdetail = mysqli_query($conn,$insertdetail);

		}
		echo "<h3>Thông báo !</h3><p>Thêm hóa đơn thành công</p>";
	}
?>
