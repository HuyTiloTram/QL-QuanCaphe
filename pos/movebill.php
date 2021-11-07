<?php
	session_start();
	require_once('../ketnoi.php');
	if(isset($_POST['table_id'])){
			if(isset($_POST['table_id2'])){;} else {echo "<h3>Thông báo !</h3><p>Bạn chưa chọn bàn muốn chuyển</p>";die;}
		include '../libs/get-1condition.php';
		include '../libs/update-1condition.php';
		include '../libs/check-1condition.php';
		$user = $_SESSION['username'];
		$table_id=$_POST['table_id'];
		$table_id2=$_POST['table_id2'];
		if($table_id == $table_id2) {echo "<h3>Thông báo !</h3><p>Không có gì thay đổi, vui lòng chọn bàn khác bàn cũ</p>";die;}
		$tinhtrang= check_1condition('ban','MaBan',"Maban=$table_id2 AND TinhTrang='trống'");
		$hoadon2= get_1condition('hoadon','*',"MaBan= $table_id2 AND Status=1");foreach($hoadon2 as $hd2item){$mahd2=$hd2item['MaHD'];$giamgia2=$hd2item['Giamgia'];$tongtien2=$hd2item['Tongtien'];}
		$hoadon1= get_1condition('hoadon','*',"MaBan= $table_id AND Status=1");foreach($hoadon1 as $hd1item){$mahd1=$hd1item['MaHD'];$giamgia1=$hd1item['Giamgia'];$tongtien1=$hd1item['Tongtien'];}
		if ($tinhtrang==0) {
	$giamgia=$giamgia2+$giamgia1;$tongtien=$tongtien2+$tongtien1;
		$sql= "UPDATE hoadon SET Giamgia=$giamgia, Tongtien=$tongtien,  Maban=$table_id2 WHERE MaHD='$mahd1'";
		$updatehoadon= $result= mysqli_query($conn,$sql);
		$detailhd1= get_1condition('chitiethoadon','*',"MaHD='$mahd1'");
		$detailhd2= get_1condition('chitiethoadon','*',"MaHD='$mahd2'");
		foreach($detailhd2 as $detailhd2item){
			$soluong1=0;
			$cachxuly=0;
			foreach($detailhd1 as $detailhd1item){
			if ($detailhd2item['MaSP']== $detailhd1item['MaSP']) {$cachxuly=1;$soluong1=$detailhd1item['Soluong']; break;}
			}
			$soluong=$detailhd2item['Soluong']+$soluong1;
			if ($cachxuly==1)
				{$masp= $detailhd2item['MaSP'];
					$sql="UPDATE chitiethoadon SET Soluong=$soluong WHERE MaHD='$mahd1' AND MaSP='$masp'";$update_soluong= mysqli_query($conn,$sql);}
			else
				{$masp=$detailhd2item['MaSP']; $tensp=$detailhd2item['TenSP'];$giasp=$detailhd2item['GiaSP']; $note=$detailhd2item['Note'];
					$sql = " INSERT INTO chitiethoadon(MaHD, MaSP,TenSP,Soluong,GiaSP,MaBan,Note) VALUES
			            ('$mahd1','$masp','$tensp',$soluong,$giasp,$table_id,'$note') ";
				$insert_detail= mysqli_query($conn,$sql);
			};
		}
		$sql= "UPDATE hoadon SET Status=0 WHERE MaHD='$mahd2'";
		$updatehoadon2= mysqli_query($conn,$sql);
		$ban1= get_1condition('ban','*',"MaBan= $table_id");foreach($ban1 as $ban1item){$tinhtrang=$ban1item['TinhTrang'];$thoigianden=$ban1item['ThoigianDen'];$makh=$ban1item['MaKH'];}
		$sql= "UPDATE ban SET TinhTrang='$tinhtrang', ThoigianDen='$thoigianden', MaKH='$makh' WHERE MaBan=$table_id2";
		$updateban2= mysqli_query($conn,$sql);
		$sql= "UPDATE ban SET TinhTrang='trống', ThoigianDen=NULL, MaKH='' WHERE MaBan=$table_id";
		$updateban1= mysqli_query($conn,$sql);
		echo "<h3>Thông báo !</h3><p>Chuyển sang bàn $table_id2 thành công</p>";
		}
		else
		{
			$hoadon1= get_1condition('hoadon','MaHD',"MaBan= $table_id AND Status=1");foreach($hoadon1 as $hd1item){$mahd1=$hd1item['MaHD'];}
			$sql= "UPDATE hoadon SET Maban=$table_id2 WHERE MaHD='$mahd1'";
			$updatehoadon= mysqli_query($conn,$sql);
			$ban1= get_1condition('ban','*',"MaBan= $table_id");foreach($ban1 as $ban1item){$tinhtrang=$ban1item['TinhTrang'];$thoigianden=$ban1item['ThoigianDen'];$makh=$ban1item['MaKH'];}
			$sql= "UPDATE ban SET TinhTrang='$tinhtrang', ThoigianDen='$thoigianden', MaKH='$makh' WHERE MaBan=$table_id2";
			$updateban2= mysqli_query($conn,$sql);
			$sql= "UPDATE ban SET TinhTrang='trống', ThoigianDen=NULL, MaKH='' WHERE MaBan=$table_id";
			$updateban1= mysqli_query($conn,$sql);
		echo "<h3>Thông báo !</h3><p>Chuyển bàn thành công</p>";

		}
	}
?>
