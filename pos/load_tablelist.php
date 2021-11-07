<?php
if(isset($_POST['typeload'])){
	include '../ketnoi.php';
	include '../libs/all-1table.php';
	include '../libs/get-1condition.php';
	include '../libs/get-groupby.php';
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$ban_vitri=get_groupby('ban','Vitri','Vitri');?>
	<div class="row list-filter">
		<div class="col-md list-filter-content">
			<button class="btn btn-primary get-color btn-action-1 "  onclick="cms_find_vitri('Tất cả')" >Tất cả</button>
<?php foreach ($ban_vitri as $ban_vitriitem){ ?>
			<button class="btn btn-primary get-color" onclick="cms_find_vitri('<?php echo $ban_vitriitem['Vitri']; ?>');"><?php $vitri=$ban_vitriitem['Vitri'];$timtrong=get_1condition('ban','count(MaBan) as dangtrong',"Vitri= '$vitri' AND TinhTrang='trống'" );foreach ($timtrong as $key2){$key=$key2['dangtrong'];};
				 echo $ban_vitriitem['Vitri'].'('.$key.')'; ?></button>
<?php } ?>
		</div>
	</div>
	<div class="row table-list">
		<div class="col-md table-list-content">

			<?php
			$ban = get_all_1table('ban');$now=time();
					foreach ($ban as $banitem){ ?>
						<div  temp-vitri="<?php echo $banitem['Vitri']; ?>" <?php if($banitem['TinhTrang']=="trống") echo 'class="room"'.''; else { if($banitem['TinhTrang']!="hoàn thành"){echo 'class=" room btn-action-2"'.'';} else {echo 'class=" room btn-action-3 "'.'';}; } ?> id="<?php echo $banitem['MaBan']; ?>" onclick="cms_load_pos(<?php echo $banitem['MaBan'];?>,'<?php echo $banitem['TinhTrang'];?>')">
							<div class="time-tag">
				<?php if(empty($banitem['ThoigianDen'])) ;
								else{$newtime= strtotime($banitem['ThoigianDen']);$tinhtoan=time()-$newtime;$mydate=getdate($tinhtoan);
									if ( $mydate['hours']-8==0 ) echo $mydate['minutes'].'phút';
									else if($mydate['hours']-8>0) echo ($mydate['hours']-8).'giờ '.$mydate['minutes'].'phút';
									else echo ($mydate['hours']+24).'giờ '.$mydate['minutes'].'phút';
								}?>
							</div>
							<div class="bill-total" >
								<?php $maban=$banitem['MaBan']; $billtotal= get_1condition('hoadon','Tongtien',"Status= 1 AND MaBan= $maban");foreach ($billtotal as $billtotalitem){echo number_format($billtotalitem['Tongtien'],0,"",","); }  ?>
							</div>
							<div class="roomname text-uppercase">
									<?php echo $banitem['TenBan']; ?>
							</div>
						</div>
				<?php }
				?>

		</div>

	</div>

<?php	} ?>
