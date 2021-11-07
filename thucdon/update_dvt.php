<?php
if(isset($_POST['Madvt'])){
  include '../ketnoi.php';
  $madvt=$_POST['Madvt'];
  $tendvt=$_POST['Tendvt'];
  $sql="  UPDATE dvt SET TenDVT = '$tendvt'
          WHERE MaDVT = '$madvt'";
  $query=mysqli_query($conn, $sql);
  if($query) echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Sửa đơn vị tính thành công</h3>';
  else echo '<h3 style="color:red">Lỗi:</h3>'.$query;
} ?>
