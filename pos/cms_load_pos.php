
<?php
	include '../ketnoi.php';
	if(isset($_POST['id_table'])){
		include '../libs/get-1condition.php';
		$idtable= $_POST['id_table'];
		$sql = "SELECT * FROM hoadon WHERE MaBan ='$idtable' AND Status=1";
		$result=mysqli_query($conn,$sql);
if ($bill = mysqli_fetch_assoc($result)) {$idbill= $bill['MaHD']; echo '<input class="d-none reduce-pay2" value="'.$bill['Giamgia'].'"/>';}
	 else {echo '<div style="display:none"> <textarea id="load-ghichu"></textarea><div id="load-customer" temp-makh="" ></div><div>'; die;}
		$sql = "SELECT MaKH FROM ban WHERE  MaBan='$idtable'"; $query= mysqli_query($conn,$sql);
		if($query){
				while ($row = mysqli_fetch_assoc($query)){$idkh=$row['MaKH'];}
		};
		if ($idkh!=''){
			$khachhang= get_1condition('khachhang','*',"MaKH= '$idkh'");
			foreach ($khachhang as $khachhangitem){$customeritem1=$khachhangitem['MaKH'];$customeritem2=$khachhangitem['Diemthuong'];$customeritem3=$khachhangitem['Duno'];$customeritem4=$khachhangitem['TenKH'];}
		}
		else {$customeritem1='';$customeritem2='';$customeritem3='';$customeritem4='';}
	?> <div class="some-load d-none"><textarea id="load-ghichu"><?php echo $bill['Note']?> </textarea>
			<div  id="load-customer" temp-makh="<?php echo $customeritem1; ?>" temp-diemthuong="<?php echo $customeritem2; ?>" temp-duno="<?php echo $customeritem3; ?>" temp-tenkh="<?php echo $customeritem4; ?>">
				<div id="load-hoadon" temp-mahd="<?php echo $idbill; ?>" ></div></div></div>
	<?php
	if(mysqli_num_rows($result)>0){
			$selectoder = "SELECT * FROM chitiethoadon
			INNER JOIN 	sanpham ON chitiethoadon.MaSP = sanpham.MaSP WHERE MaHD ='$idbill'";
			$chitiethoadon = mysqli_query($conn,$selectoder);
			while ($cthditem = mysqli_fetch_array($chitiethoadon)) { ?>
				<tr temp-masp="<?php echo $cthditem['MaSP']; ?>" temp-tensp="<?php echo $cthditem['TenSP']; ?>">
					<td>
						<i class="far fa-bell red has-pointer" title="Cập nhật số lượng đã hoàn thành"></i>
					</td>
					<td class="text-left p-0">
						<div >
							<span  style="font-size: 14px;"><?php echo $cthditem['TenSP']; ?></span>
							<div style="white-space: pre-line;word-wrap:break-word;" tempdata-mahd="<?php echo $idbill; ?>" tempdata-masp="<?php echo $cthditem['MaSP']; ?>" class="gridNote get-ghichu has-pointer" data-toggle="modal" data-target="#Modal-ghichu" placeholder="Ghi chú" ><i class="fa fa-edit" ></i><?php
							 if ( ($cthditem['Note']=='') || (empty($cthditem['Note'])) ) echo "Ghi chú"; else echo ' '.$cthditem['Note']; ?></div>

						</div>
					</td>
					<td><?php if($cthditem['SLquydoi']==1) echo $cthditem['DVT']; else echo '('.$cthditem['SLquydoi'].') '.$cthditem['DVT']; ?></td>
					<td><div class="input-group spinner">
							<button class="input-group-prepend btn btn-style2"><i class="fa fas fa-minus"></i></button>
							<input type="text" class="form-control form-control-noline quantity-product-oders p-0 pl-2" style="width:30px;"  name="" value="<?php echo $cthditem['Soluong']; ?>">
							<button class="input-group-prepend btn btn-style2" onclick="cms_select_menu('<?php echo $cthditem['MaSP'];?>')" ><i class="fa fas fa-plus"></i></button>
						</div></td>
					<td><input type="text" class="price-order text-right" style="width:70px;height: 25px;color:#FF3399" disabled="disabled" name="" value="<?php echo number_format($cthditem['GiaSP'],0,"",","); ?>"></td>
					<td class="text-right total-money"><?php echo number_format($rows['GiaSP'],0,"",","); ?></td>
					<td class="text-center p-0">
						<i class="fa fa-times-circle del-pro-order"></i>
					</td>
				</tr>
			<?php }
		}
		else{

		}
	} ?>
