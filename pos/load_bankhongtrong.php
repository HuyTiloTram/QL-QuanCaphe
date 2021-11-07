<?php
if(isset($_POST['id_table'])){
	include '../ketnoi.php';
	include '../libs/all-1table.php'; ?>
		<?php	$ban = get_all_1table('ban');
				foreach ($ban as $banitem){ ?>
					<p style="display: inline-block;cursor:pointer;margin:2px;border-radius:5px;font-size:16px;padding:8px;" <?php if($banitem['TinhTrang']=="trống") continue; else { if($banitem['TinhTrang']!="hoàn thành"){echo 'class="btn-action-2"'.'';} else {echo 'class="btn-action-3"'.'';}; } ?> id="<?php echo $banitem['MaBan']; ?>" onclick="cms_load_pos(<?php echo $banitem['MaBan'];?>,'<?php echo $banitem['TinhTrang'];?>')"> <?php echo $banitem['TenBan']; ?></p>
			<?php } ?>
<?php	} ?>
