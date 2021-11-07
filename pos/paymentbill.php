<?php
	session_start();
	require_once('../ketnoi.php');
	if(isset($_POST['data'])){
	include '../libs/get-1condition.php';
	include '../libs/docso.php';

		$user = $_SESSION['username'];
		$json =$_POST['data'];
		$mahd= $json['hoadon_mahd'];
		$table_id= $json['table_id'];
		$customer_id = $json['customer_id'];
		$customer_total = $json['customer_total'];
		$customer_pay = $json['customer_pay'];
		$customer_reduce = $json['customer_reduce'];
		$note = $json['note'];
		$hinhthucthanhtoan= 'Cash';
		$action= $json['action'];
		if($action=='Thanh toán'){
			$updatebill = "UPDATE hoadon SET Status =0, NgayLap= now(), Tongtien=$customer_pay, HinhThucThanhToan='$hinhthucthanhtoan'  WHERE MaHD = '$mahd'";
			$result2=mysqli_query($conn,$updatebill);
			if(isset($result2)){
				$updatetable = "UPDATE ban SET TinhTrang ='trống', ThoigianDen= Null WHERE MaBan ='$table_id'";
				$result3=mysqli_query($conn,$updatetable);
			}
		}	?>
			<style>tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid b;
}
.mytd td, .mytd th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid black;
}
.infor h3, .infor h4 {
	font-weight: bold;
}

			 </style>
			 <div class="infor" style="width:100%;">
				 <img style="display: inline-block;width:170px;max-width:100%" src="../logo3.jpg">
				 <div style="display: inline-block;margin-left:auto;text-align:left">
					 <h3> Cà phê Ngọc Xanh - website:sapiablue.com</h3>
					 <h4> Địa chỉ:97 Ngô Quyền, Sơn Trà, Đà Nẵng - email:chutichgiavogiau@gmail.com</h4>

			 </div>
		 </div>
			<hr  width="100%" align="center" size="2px" />
			<h2 style="text-align:center">HÓA ĐƠN BÁN HÀNG</h2><br>
<?php $hdngaylap= get_1condition('hoadon','NgayLap',"MaHD= '$mahd'");foreach ($hdngaylap as $hdngaylapitem){ $ngaylap=$hdngaylapitem['NgayLap']; };
			if( (!empty($customer_id)) || ($customer_id!='') ){
			$khachhang= get_1condition('khachhang','*',"MaKH= '$customer_id'");foreach ($khachhang as $khachhangitem){ $khachhang_ten=$khachhangitem['TenKH'];$khachhang_sdt=$khachhangitem['SDT']; };
		}else {$khachhang_ten="";$khachhang_sdt="";}?>
			<h3 style="text-align:center"> Mã HD:<?php echo $mahd.' - Bàn: '.$table_id.' - Thời gian: '.$ngaylap; ?> </h3><br>
			<h4 style="text-align:left">Khách hàng:<?php echo ' '.$customer_id.'|'.$khachhang_ten; ?> </h4>
			<h4 style="text-align:left">SĐT:<?php echo $khachhang_sdt; ?> </h4>
			<table class="table mytable " style="width:100%;border-collapse">
			<thead class="thead-light" >
				<tr>
					<th scope="col" align="left" style="width:30px;">STT</th>
					<th  scope="col" style="width:40%;">Tên món</th>
					<th scope="col" align="left" style="width:70px;">DVT</th>
					<th scope="col" align="left" style="width:30px;">SL</th>
					<th scope="col" align="right" style="width:123px;">Đơn giá</th>
					<th scope="col" align="right" style="width:140px;">Giá bán</th>
				</tr>
			</thead>
			<tbody>
<?php	$selectoder = "SELECT * FROM chitiethoadon
			INNER JOIN 	sanpham ON chitiethoadon.MaSP = sanpham.MaSP WHERE MaHD ='$mahd'";
			$resultdetail = mysqli_query($conn,$selectoder);
			$stt=0;
			while ($rows = mysqli_fetch_array($resultdetail)) {
				$stt++;
			?>
				<tr class="tr-content mytd">
					<td scope="row" ><?php echo $stt; ?></td>
					<td ><?php echo $rows['TenSP'];?></td>
					<td > <?php $masp=$rows['MaSP'];$spdvt= get_1condition('sanpham','DVT,SLquydoi',"MaSP= '$masp'");foreach ($spdvt as $spdvtitem){
						if($spdvtitem['SLquydoi']==1) echo $spdvtitem['DVT']; else echo '('.$spdvtitem['SLquydoi'].') '.$spdvtitem['DVT']; }  ?> </td>
					<td ><?php echo $rows['Soluong']; ?></td>
					<td align="right"><?php echo number_format($rows['GiaSP'],0);?> </td>
					<td align="right" ><?php echo number_format($rows['GiaSP']*$rows['Soluong'],0);?></td>
				</tr>
		<?php } ?>
				<tr class="mytd">
					<td style="font-weight:bold;" align="right" colspan="5">Cộng tiền hàng:</td>
					<td style="font-weight:bold;" align="right"> <?php echo number_format($customer_total); ?></td>
				</tr>
				<tr>
					<td style="font-weight:bold;" align="right" colspan="5">Chiết khấu:</td>
					<td style="font-weight:bold;" align="right"> 0</td>
				</tr>
				<tr>
					<td style="font-weight:bold;" align="right" colspan="5">Giảm giá:</td>
					<td style="font-weight:bold;" align="right"> <?php echo number_format($customer_reduce); ?></td>
				</tr>
				<tr>
					<td style="font-weight:bold;" align="right" colspan="5">Tổng Cộng:</td>
					<td style="font-weight:bold;" align="right"><?php echo number_format($customer_total-$customer_reduce) ?></td>
				</tr>
				<tr>
					<td  align="right" colspan="5">Tiền khách đưa:</td>
					<td  align="right"><?php echo number_format($customer_pay); ?></td>
				</tr>
				<tr>
					<td  align="right" colspan="5">Tiền thừa:</td>
					<td  align="right"><?php echo number_format($customer_pay-$customer_total+$customer_reduce); ?></td>
				</tr>

			</tbody></table>
			<h4 style="text-align:left;"><?php echo VndText($customer_total-$customer_reduce); ?></h4>
			<h4 style="text-align:center;font-style:italic;">Xin cảm ơn và hẹn gặp lại </h4>
			<?php

		}
?>
