
<?php
	include '../ketnoi.php';
	if(isset($_POST['Mahd'])){
		include '../libs/get-1condition.php';
		$idbill=$_POST['Mahd'];
		$hoadon= get_1condition('hoadon','*',"MaHD= '$idbill'");foreach($hoadon as $hoadonitem){$idtable=$hoadonitem['MaBan'];$idkh=$hoadonitem['MaKH'];$billnote=$hoadonitem['Note'];$tongtien=$hoadonitem['Tongtien'];}

		if ($idkh!=''){
			$khachhang= get_1condition('khachhang','*',"MaKH= '$idkh'");
			foreach ($khachhang as $khachhangitem){$customeritem1=$khachhangitem['MaKH'];$customeritem2=$khachhangitem['Diemthuong'];$customeritem3=$khachhangitem['Duno'];$customeritem4=$khachhangitem['TenKH'];}
		}
		else {$customeritem1='';$customeritem2='';$customeritem3='';$customeritem4='';}
	?> <div class="some-load d-none"><textarea id="load-ghichu"><?php echo $billnote?> </textarea>
			<div  id="load-customer" temp-makh="<?php echo $customeritem1; ?>" temp-diemthuong="<?php echo $customeritem2; ?>" temp-duno="<?php echo $customeritem3; ?>" temp-tenkh="<?php echo $customeritem4; ?>">
				<div id="load-hoadon" temp-mahd="<?php echo $idbill; ?>" ></div></div></div>
	<?php
			$selectoder = "SELECT * FROM chitiethoadon WHERE MaHD ='$idbill'";
			$chitiethoadon = mysqli_query($conn,$selectoder);
			$sanphamdvt= $khachhang=get_1condition('sanpham','MaSP,DVT,SLquydoi','1');
			function find_dvt($find,$arr){ foreach($arr as $arritem){if($arritem['MaSP']==$find) return $arritem['DVT']; }; }
			while ($cthditem = mysqli_fetch_array($chitiethoadon)) { ?>
				<tr temp-masp="<?php echo $cthditem['MaSP']; ?>" temp-tensp="<?php echo $cthditem['TenSP']; ?>">
					<td><i class="far fa-bell red has-pointer" title="Cập nhật số lượng đã hoàn thành"></i></td>
					<td class="text-left p-0">
						<div >
							<span  style="font-size: 14px;"><?php echo $cthditem['TenSP']; ?></span>
							<div style="white-space: pre-line;word-wrap:break-word;" tempdata-mahd="<?php echo $idbill; ?>" tempdata-masp="<?php echo $cthditem['MaSP']; ?>" class="gridNote get-ghichu has-pointer" data-toggle="modal" data-target="#Modal-ghichu" placeholder="Ghi chú" ><i class="fa fa-edit" ></i><?php
							 if ( ($cthditem['Note']=='') || (empty($cthditem['Note'])) ) echo "Ghi chú"; else echo ' '.$cthditem['Note']; ?></div>
						 </div>
					</td>
					<td><?php echo find_dvt($cthditem['MaSP'],$sanphamdvt); ?></td>
					<td><div class="input-group spinner">
							<button class="input-group-prepend btn btn-style2"><i class="fa fas fa-minus"></i></button>
							<input type="text" class="form-control form-control-noline quantity-product-oders p-0 pl-2" style="width:30px;"  name="" value="<?php echo $cthditem['Soluong']; ?>">
							<button class="input-group-prepend btn btn-style2" onclick="cms_select_menu('<?php echo $cthditem['MaSP'];?>')" ><i class="fa fas fa-plus"></i></button>
						</div></td>
					<td><input type="text" class="price-order text-right" style="width:70px;height: 25px;color:#FF3399" disabled="disabled" name="" value="<?php echo number_format($cthditem['GiaSP'],0,"",","); ?>"></td>
					<td class="text-right total-money"><?php echo number_format($tongtien,0,"",","); ?></td>
					<td class="text-center p-0">
						<i class="fa fa-times-circle del-pro-order"></i>
					</td>
				</tr>
			<?php } ?>
		<div class="willremove d-none">	<input id="phptemp-idtable" type="number" value="<?php echo $idtable;?>"/></div>
<?php
 } ?>
