<?php
if(isset($_POST['Madvt'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $tendvt=$_POST['Tendvt'];
  $madvt=$_POST['Madvt'];
  if (check_1condition('dvt','MaDVT',"MaDVT= '$madvt'")==1) {echo '<h3 style="color: #721c24;background-color: #f8d7da;">Lỗi: Mã đơn vị tính này đã tồn tại không thể thêm</h3>'; die;}
  if( $madvt=='') {include '../libs/random-string.php'; $madvt=rand(1,12);$madvt=str_rand($madvt);}
  $sql="  INSERT INTO dvt(MaDVT,TenDVT) VALUES
          ('$madvt','$tendvt') ";
  $query = mysqli_query($conn, $sql);
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Thêm đơn vị tính thành công</h3>';
}
    ?>
