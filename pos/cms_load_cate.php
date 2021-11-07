<ul>
<?php
	include('../ketnoi.php');
	if(isset($_POST['id_cate'])){
		$idcate= $_POST['id_cate'];
		if($idcate==0){
			$sql = "SELECT * FROM sanpham";
			$result=mysqli_query($conn,$sql);
			while ($rowmenu= mysqli_fetch_array($result)) { ?>
				<li>
					<a href="#" onclick="cms_select_menu('<?php echo $rowmenu['MaSP'];?>')" title="<?php echo $rowmenu['TenSP'];?>">
						<div class="img-product">
							<img src="../images/sanpham/<?php echo $rowmenu['Hinhanh']; ?>">
						</div>
						<div class="product-info">
							<span class="product-name"><?php echo $rowmenu['TenSP'];?></span><br>
							<strong><?php echo number_format($rowmenu['GiaSP'],0,"",","); ?></strong>
						</div>
					</a>
				</li>
		<?php }
			}else {
			echo $idcate;
		}
	}
?>
</ul>
