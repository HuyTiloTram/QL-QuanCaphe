<?php
if(isset($_POST['Maloai'])){
  include '../ketnoi.php';
  $maloai=$_POST['Maloai'];
  $tenloai=$_POST['Tenloai'];
  $mota=$_POST['Mota'];
  $sql="  UPDATE loaihanghoa SET TenLoai = '$tenloai', Mota = '$mota'
          WHERE MaLoai = '$maloai'";
  $query=mysqli_query($conn, $sql);
  if($query) echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Sửa loại thành công</h3>';
  else echo '<h3 style="color:red">Lỗi:</h3>'.$query;

}
    ?>
