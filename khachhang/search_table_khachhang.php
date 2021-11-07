<?php
if(isset($_POST['searchkh'])){
  include '../ketnoi.php';
  $sql= $_POST['searchkh'];
  $limit= $_POST['limit'];
  $sql =  $sql.' LIMIT '.$limit;
  $result =mysqli_query($conn,$sql);
  $count =mysqli_num_rows($result);
  if($count>0){
    $stt=$_POST['stt'];
    while ($khachhangitem = mysqli_fetch_array($result)) { ?>
      <tr id="tr-khachhang<?php echo $khachhangitem['MaKH']; ?>" temp-makh="<?php echo $khachhangitem['MaKH']; ?>" class="tr-content ">
        <td class="toggle-inforkh "><?php $stt++; echo $stt; ?></td>
        <td class="toggle-inforkh cldt-makh"><p style="width: 140px;word-wrap:break-word" ><?php echo $khachhangitem['MaKH']; ?></p> </td>
        <td class=" imgtable1-ground "><img class="cldt-hinhanh" src="../images/khachhang/<?php echo $khachhangitem['Avatar']; ?>"  data-toggle="modal" data-target="#Modal-hinhanh"/></td>
        <td class="toggle-inforkh cldt-tenkh"><?php echo $khachhangitem['TenKH']; ?></td>
        <td class="toggle-inforkh cldt-username"><?php echo $khachhangitem['Username']; ?></td>
        <td class="toggle-inforkh cldt-chucvu text-center"><?php echo $khachhangitem['Capdo']; ?></td>
        <td class="toggle-inforkh cldt-tonggiaodich text-right"><?php echo number_format($khachhangitem['Tonggiaodich'],0,"",","); ?></td>
        <td class="toggle-inforkh cldt-diemthuong text-right"><?php echo number_format($khachhangitem['Diemthuong'],0,"",","); ?></td>
        <td class="toggle-inforkh cldt-duno text-right"><?php echo number_format($khachhangitem['Duno'],0,"",","); ?></td>
        <td class="text-left">
          <label temp-makh="<?php echo $khachhangitem['MaKH']; ?>" class="jquery-switch <?php if($khachhangitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
            <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
              <div  class="v-switch-button" <?php if($khachhangitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
              </div>
            </div>
            <span class="v-switch-label cldt-trangthai update-trangthai <?php if($khachhangitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $khachhangitem['Trangthai']; ?>
            </span>
          </label>
          <img temp-makh="<?php echo $khachhangitem['MaKH']; ?>" class="mr-2 cursor-pointer btn-suakh" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-makh" tempdata-makh="<?php echo $khachhangitem['MaKH']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
        </td>
      </tr>
      <tr class="detail-khachhang d-none" id="khachhang<?php echo $khachhangitem['MaKH']; ?>"></tr>

<?php }
} else{echo '<tr><td colspan="10">Không tìm thấy kết quả</td></tr>';}
} ?>
