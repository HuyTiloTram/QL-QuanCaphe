<?php
if(isset($_POST['searchnhom'])){
  include '../ketnoi.php';
  $nhommon= $_POST['searchnhom'];
  $sql = "SELECT * FROM nhommon WHERE MaNhomMon LIKE '%$nhommon%' OR TenNhomMon LIKE '%$nhommon%'";
  $result =mysqli_query($conn,$sql);
  $count =mysqli_num_rows($result);
  if($count>0){
    $stt=0;;
    while ($nhommonitem = mysqli_fetch_array($result)) { ?>
      <tr id="tr-nhommon<?php echo $nhommonitem['MaNhomMon']; ?>" temp-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" class="tr-content ">
        <td><?php $stt++; echo $stt; ?></td>
        <td class="cldt-manhommon"> <p style="width: 194px;word-wrap:break-word"><?php echo $nhommonitem['MaNhomMon']; ?></p></td>
        <td class="cldt-tennhommon"><?php echo $nhommonitem['TenNhomMon']; ?></td>
        <td class=" imgtable1-ground "><img class="cldt-hinhanh" src="../images/nhommon/<?php echo $nhommonitem['Hinhanh']; ?>" alt="ảnh" data-toggle="modal" data-target="#Modal-hinhanh"/></td>
        <td class="text-left">
          <label temp-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" class="jquery-switch <?php if($nhommonitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
          <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
            <div  class="v-switch-button" <?php if($nhommonitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
            </div>
          </div>
          <span class="v-switch-label cldt-trangthai update-trangthai <?php if($nhommonitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $nhommonitem['Trangthai']; ?></span>

          </label>
          <img temp-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" class="mr-2 cursor-pointer btn-suanhommon"src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-MaNhomMon" tempdata-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
        </td>
      </tr>
<?php }
} else{echo '<tr><td colspan="11">Không tìm thấy kết quả</td></tr>';}
} ?>
