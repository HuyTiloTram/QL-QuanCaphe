<?php
if(isset($_POST['searchnv'])){
  include '../ketnoi.php';
  $sql= $_POST['searchnv'];
  $limit= $_POST['limit'];
  $sql =  $sql.' LIMIT '.$limit;
  $result =mysqli_query($conn,$sql);
  $count =mysqli_num_rows($result);
  if($count>0){
    $stt=$_POST['stt'];
    while ($nhanvienitem = mysqli_fetch_array($result)) { ?>
      <tr id="tr-nhanvien<?php echo $nhanvienitem['MaNV']; ?>" temp-manv="<?php echo $nhanvienitem['MaNV']; ?>" class="tr-content ">
        <td class="toggle-infornv "><?php $stt++; echo $stt; ?></td>
        <td class="toggle-infornv cldt-manv"><?php echo $nhanvienitem['MaNV']; ?> </td>
        <td class=" imgtable1-ground "><img class="cldt-hinhanh" src="../images/nhanvien/<?php echo $nhanvienitem['Avatar']; ?>" alt="ảnh" data-toggle="modal" data-target="#Modal-hinhanh"/></td>
        <td class="toggle-infornv cldt-tennv"><?php echo $nhanvienitem['TenNV']; ?></td>
        <td class="toggle-infornv text-center cldt-gioitinh"><?php echo $nhanvienitem['Gioitinh']; ?></td>
        <td  class="toggle-infornv cldt-chucvu"><?php echo $nhanvienitem['Chucvu']; ?></td>
        <td class="toggle-infornv cldt-username"><?php echo $nhanvienitem['Username']; ?></td>
        <td class="cldt-sdt"><?php echo $nhanvienitem['SDT']; ?></td>
        <td class="cldt-email"><?php echo $nhanvienitem['Email']; ?></td>
        <td class="text-left">
          <label temp-manv="<?php echo $nhanvienitem['MaNV']; ?>" class="jquery-switch <?php if($nhanvienitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
            <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
              <div  class="v-switch-button" <?php if($nhanvienitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
              </div>
            </div>
            <span class="v-switch-label cldt-trangthai update-trangthai <?php if($nhanvienitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $nhanvienitem['Trangthai']; ?>
            </span>
          </label>
          <img temp-manv="<?php echo $nhanvienitem['MaNV']; ?>" class="mr-2 cursor-pointer btn-suanv" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-manv" tempdata-manv="<?php echo $nhanvienitem['MaNV']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
        </td>
      </tr>
      <tr class="detail-nhanvien d-none" id="nhanvien<?php echo $nhanvienitem['MaNV']; ?>"></tr>

<?php }
} else{echo '<tr><td colspan="11">Không tìm thấy kết quả</td></tr>';}
} ?>
