<?php
if(isset($_POST['searchhd'])){
  include '../ketnoi.php';
  $sql= $_POST['searchhd'];
  $limit= $_POST['limit'];
  $sql =  $sql.' LIMIT '.$limit;
  $result =mysqli_query($conn,$sql);
  $count =mysqli_num_rows($result);
  if($count>0){
    $stt=$_POST['stt'];
    while ($hoadonitem = mysqli_fetch_array($result)) { ?>
      <tr id="tr-hoadon<?php echo $hoadonitem['MaHD']; ?>" temp-mahd="<?php echo $hoadonitem['MaHD']; ?>" class="tr-content ">
        <td class="toggle-inforhd "><?php $stt++; echo $stt; ?></td>
        <td class="toggle-inforhd cldt-mahd"><?php echo $hoadonitem['MaHD']; ?> </td>
        <td class="toggle-inforhd cldt-tenkh"><?php echo $hoadonitem['TenKH']; ?></td>
        <td class="toggle-inforhd text-center cldt-gioitinh"><?php echo $hoadonitem['NgayLap']; ?></td>
        <td  class="toggle-inforhd cldt-hoadon text-right"><?php echo number_format($hoadonitem['Tien'],0,"",","); ?></td>
        <td class="toggle-inforhd cldt-username text-right"><?php echo number_format($hoadonitem['Giamgia'],0,"",","); ?></td>
        <td class="toggle-inforhd cldt-username text-right"><?php echo number_format($hoadonitem['Tongtien'],0,"",","); ?></td>
        <td class="toggle-inforhd cldt-tinhtrang text-center <?php if($hoadonitem['Status']==0) echo 'color1'; else echo 'color2'; ?>"><?php if($hoadonitem['Status']==0) echo 'Đã Hoàn thành'; else echo 'Chưa Hoàn thành'; ?></td>
        <td>
          <form action="../pos/" method="post" enctype="multipart/form-data" target="_blank">
            <button style="border:none;padding:0px;background:none;"><img temp-manv="<?php echo $hoadonitem['MaHD']; ?>" class="mr-2 cursor-pointer btn-suahd" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/>
            </button>
            <i class="fas fa-trash-alt cursor-pointer getdelete-mahd" tempdata-mahd="<?php echo $hoadonitem['MaHD']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
            <div style="display:none"><input type="text" name="Mahd" value="<?php echo $hoadonitem['MaHD']; ?>"></div>
          </form>
        </td>
      </tr>
      <tr class="detail-hoadon d-none" id="hoadon<?php echo $hoadonitem['MaHD']; ?>"></tr>

<?php }
} else{echo '<tr><td colspan="9">không tìm thấy kết quả</td></tr>';}
} ?>
