<?php
if(isset($_POST['MaBan'])){
	include '../ketnoi.php';
	include '../libs/all-1table.php';
	include '../libs/get-1condition.php'; ?>
	<div class="room-list room2">
<?php $ban=get_all_1table('ban');
	foreach($ban as $banitem ){?>
		<div temp-maban2="<?php echo $banitem['MaBan']; ?>"
		style="width:70px;"<?php if($banitem['TinhTrang']=="trống") echo 'class="room'; else { if($banitem['TinhTrang']!="hoàn thành"){echo 'class=" room btn-action-2';} else echo 'class=" room btn-action-3'; };
		if ($_POST['MaBan']==$banitem['MaBan']) echo ' active"'; else echo '"';  ?> >
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
			<div class="roomname text-uppercase"> <?php echo $banitem['TenBan']; ?>
			</div>
		</div>

<?php } ?>
	</div>
	<div class="alert alert-danger "style="background-color:	#6699CC">
			<i class="fa fa-search-plus"></i> <input class="input-search2" type="text" placeholder="Tìm kiếm tên bàn" ></input>
	</div>
	<div class="form-group">
			<label >Vị trí</label>
			<select id="repeatSelect" ng-model="currentPosition" style="width:100%;height:30px;font-weight:bold" class="ng-pristine ng-untouched ng-valid ng-not-empty">
				<option value="Tất cả" selected="selected">Tất cả</option>
				<option value="Bàn Trong" >Bàn Trong</option>
				<option value="Mang Về" >Mang Về</option>
				<option value="Sân Vườn">Sân Vườn</option>
			</select>
	</div>
<?php	} ?>
