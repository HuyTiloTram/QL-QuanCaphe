<?php
	if(isset($_POST['menuname'])){
		require_once('../ketnoi.php');
		$menuname = $_POST['menuname'];
		$sql = "SELECT * FROM sanpham WHERE MaSP LIKE '%$menuname%' OR TenSP LIKE '%$menuname%'";
		$result =mysqli_query($conn,$sql);
		$count =mysqli_num_rows($result);
		if($count>0){
			echo '<ul class="list-group "> ';
			while ($rows= mysqli_fetch_array($result)) { ?>
				<li class="list-group-item list-group-item-action dropbtn data-menu-<?php echo $rows['MaSP'];?>" onclick="cms_select_menu('<?php echo $rows['MaSP'];?>')">
					<img src="../images/sanpham/<?php echo $rows['Hinhanh']; ?>" style="width:auto;height:40px">
					<?php echo $rows['TenSP']; ?>
				</li>
			<?php }
			echo '</ul>';
		}else{
			echo 'Không tìm thấy kết quả';
		}
	}
?>
