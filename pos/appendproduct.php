<?php
	require_once('../ketnoi.php');
	if(isset($_POST['id_menu'])){
		if(isset($_POST['id_table'])) ; else {echo '<h3 style="color:red">chưa chọn bàn</h3>';die;};
		include '../libs/get-1condition.php';
		$idbill= $_POST['id_table'];
		$id = $_POST['id_menu'];
		$sanpham= get_1condition('sanpham','*',"MaSP= '$id'");
	 	foreach ($sanpham as $sanphamitem){?>
		<tr temp-masp="<?php echo $sanphamitem['MaSP']; ?>" temp-tensp="<?php echo $sanphamitem['TenSP']; ?>">
			<td><i class="far fa-bell red has-pointer" title="Số lượng pha chế đã hoàn thành"></i></td>
			<td class="text-left p-0">
				<div>
					<span  style="font-size: 14px;"><?php echo $sanphamitem['TenSP']; ?></span>
					<div style="white-space: pre-line;word-wrap:break-word;" tempdata-mahd="<?php echo $idbill; ?>" tempdata-masp="<?php echo $sanphamitem['MaSP']; ?>" class="gridNote get-ghichu has-pointer" data-toggle="modal" data-target="#Modal-ghichu" placeholder="Ghi chú" ><i class="fa fa-edit" ></i>Ghi chú</div>
				</div>
			</td>
			<td><?php if($sanphamitem['SLquydoi']==1) echo $sanphamitem['DVT']; else echo '('.$sanphamitem['SLquydoi'].') '.$sanphamitem['DVT']; ?></td>
			<td><div class="input-group spinner">
					<button class="input-group-prepend btn btn-style2"><i class="fa fas fa-minus"></i></button>
					<input type="text" class="form-control form-control-noline quantity-product-oders p-0 pl-2" style="width:30px;"  name="" value="1">
					<button class="input-group-prepend btn btn-style2" onclick="cms_select_menu('<?php echo $sanphamitem['MaSP'];?>')" ><i class="fa fas fa-plus"></i></button>
				</div></td>
			<td><input type="text" class="price-order text-right" style="width:70px;height: 25px;color:#FF3399" disabled="disabled" name="" value="<?php echo number_format($sanphamitem['GiaSP'],0,"",","); ?>"></td>
			<td class="text-right total-money"><?php echo number_format($sanphamitem['GiaSP'],0,"",","); ?></td>
			<td class="text-center p-0">
				<i class="fa fa-times-circle del-pro-order"></i>
			</td>
		</tr>

<?php }
} ?>
