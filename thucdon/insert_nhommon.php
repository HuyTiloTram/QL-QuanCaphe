<?php
if(isset($_POST['Manhommon'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $tennhom=$_POST['Tennhommon'];
  $manhom=$_POST['Manhommon'];
  if (check_1condition('nhommon','MaNhomMon',"MaNhomMon= '$manhom'")==1) {echo '<h3 style="color: #721c24;background-color: #f8d7da;">Lỗi: Mã Nhóm Món này đã tồn tại không thể thêm nhóm món</h3>'; die;}
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];}
  else $images='';
  $trangthai=$_POST['Trangthai'];
  include '../libs/nhommon.php';
  if( $manhom=='') {include '../libs/random-string.php'; $manhom=rand(1,12);$manhom=str_rand($manhom);}
  add_nhommon($manhom,$tennhom,$images,$trangthai);
  if ($images!=""){
  if (move_uploaded_file($hinhanh['tmp_name'],'../images/nhommon/'.$images)) {;}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Thêm nhóm món thành công</h3>';
}
    ?>
