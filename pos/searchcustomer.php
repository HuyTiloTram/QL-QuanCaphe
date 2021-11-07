<?php
	if(isset($_POST['customer'])){
		require_once('../ketnoi.php');
		$customer = $_POST['customer'];
		$sql = "SELECT * FROM khachhang WHERE MaKH LIKE '%$customer%' OR TenKH LIKE '%$customer%'";
		$result =mysqli_query($conn,$sql);
		$count =mysqli_num_rows($result);
		if($count>0){
			echo '<ul class="list-group">';
			while ($rows= mysqli_fetch_array($result)) { ?>
				<li class="list-group-item list-group-item-action " onclick="cms_select_customer('<?php echo $rows['MaKH']; ?>','<?php echo $rows['Diemthuong']; ?>','<?php echo $rows['Duno']; ?>','<?php echo $rows['TenKH']; ?>',0) " ><?php echo '<span class="fontsize-10">'.$rows['MaKH'].'</span><span class="fontsize-12">|'.$rows['TenKH'].'</span>'; ?></li>
			<?php }
			echo '</ul>';
		}else{
			echo 'Không tìm thấy kết quả';
		}
	}
?>
