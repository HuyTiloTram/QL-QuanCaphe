<?php
	require_once('../ketnoi.php');
	 include('../libs/all-1table.php');
	 include('../libs/ban.php');
?>
<div class="row list-filter">
					<div class="col-md list-filter-content">
            <button class="btn btn-primary btn-action-1 " > Tất cả</button>
      <?php $ban=get_all_1table("ban"); $ban_vitri=get_ban_Vitri();
			foreach ($ban_vitri as $ban_vitriitem){ ?>
            <button class="btn btn-primary"><?php $timtrong=get_ban_trong_by_Vitri($ban_vitriitem['Vitri']);foreach ($timtrong as $key2){$key=$key2['asd'];};
               echo $ban_vitriitem['Vitri'].'('.$key.')'; ?></button>
      <?php } ?>
          </div>
        </div>
<div class="row table-list">
					<div class="col-md table-list-content">
						<ul>
						<?php	$ban=get_all_1table("ban");
								foreach ($ban as $banitem){ ?>
									<li <?php if($banitem['TinhTrang']=="Trống") echo 'class="get-data1"'.''; else { if($banitem['TinhTrang']!="hoàn thành"){echo 'class="btn-action-2 get-data1"'.'';} else {echo 'class="btn-action-3 get-data1"'.'';}; } ?> id="<?php echo $banitem['MaBan']; ?>" onclick="cms_load_pos(<?php echo $banitem['MaBan'];?>,'<?php echo $banitem['TinhTrang'];?>')"> <?php echo $banitem['TenBan']; ?></li>
							<?php }
							?>
						</ul>
					</div>
				</div>
