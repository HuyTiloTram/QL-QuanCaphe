<?php
if(isset($_POST['Maloai'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $tenloai=$_POST['Tenloai'];
  $maloai=$_POST['Maloai'];
  $mota=$_POST['Mota'];
  if (check_1condition('loaihanghoa','MaLoai',"MaLoai= '$maloai'")==1) {echo '<h3 style="color: #721c24;background-color: #f8d7da;">Lỗi: Mã Loại này đã tồn tại không thể thêm</h3>'; die;}
  if( $maloai=='') {  include '../libs/random-string.php'; $maloai=rand(1,12);$maloai=str_rand($maloai);}
  $sql="  INSERT INTO loaihanghoa(MaLoai,TenLoai,Mota) VALUES
          ('$maloai','$tenloai','$mota') ";
  $query = mysqli_query($conn, $sql);
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Thêm loại hàng hóa thành công</h3>';
}
    ?>
