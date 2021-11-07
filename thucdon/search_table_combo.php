<?php
if(isset($_POST['searchcombo'])){
  include '../ketnoi.php';
  $sanpham= $_POST['searchcombo'];
  $sql = "SELECT * FROM sanpham WHERE LoaiSP='Combo' AND (MaSP LIKE '%$sanpham%' OR TenSP LIKE '%$sanpham%')";
  $result =mysqli_query($conn,$sql);
  $count =mysqli_num_rows($result);
  if($count>0){
    $stt=0;;
    while ($sanphamitem = mysqli_fetch_array($result)) { ?>
      <tr id="tr-combo<?php echo $sanphamitem['MaSP']; ?>" temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="tr-content ">
        <td><?php $stt++; echo $stt; ?></td>
        <td class="cldt-masp"><p style="width: 80px;word-wrap:break-word" ><?php echo $sanphamitem['MaSP']; ?> </p></td>
        <td class=" imgtable1-ground "><img class="cldt-hinhanh" src="../images/sanpham/<?php echo $sanphamitem['Hinhanh']; ?>" alt="ảnh" data-toggle="modal" data-target="#Modal-hinhanh"/></td>
        <td class="cldt-tensp"><?php echo $sanphamitem['TenSP']; ?></td>
        <td class="cldt-giavon text-right" id2="<?php echo $sanphamitem['Giavon']; ?>" ><?php echo number_format($sanphamitem['Giavon'],0,"",","); ?> đ</td>
        <td class="cldt-giasp text-right giamon" id2="<?php echo $sanphamitem['GiaSP']; ?>"><?php echo number_format($sanphamitem['GiaSP'],0,"",","); ?> đ</td>
        <td class="text-left">
          <label temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="jquery-switch <?php if($sanphamitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
            <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
              <div  class="v-switch-button" <?php if($sanphamitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
              </div>
            </div>
            <span class="v-switch-label cldt-trangthai update-trangthai <?php if($sanphamitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $sanphamitem['Trangthai']; ?>
            </span>
          </label>
          <img temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="mr-2 cursor-pointer btn-suacombo" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-masp" tempdata-masp="<?php echo $sanphamitem['MaSP']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
          <textarea class="cldt-Mota d-none"><?php echo $sanphamitem['Mota']; ?> </textarea>
        </td>
      </tr>
<?php }
} else{echo '<tr><td colspan="11">Không tìm thấy kết quả</td></tr>';}
} ?>
