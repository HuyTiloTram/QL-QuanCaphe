<?php
if(isset($_POST['Manv'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $manv=$_POST['Manv'];
  if (check_1condition('nhanvien','MaNV',"MaNV= '$manv'")==1) {echo '<h3 style="color: #721c24;background-color: #f8d7da;">Lỗi: Mã Nhân viên này đã tồn tại không thể thêm</h3>'; die;}
  $tennv=$_POST['Tennv'];
  $chucvu=$_POST['Chucvu'];
  $username=$_POST['Username'];
  $gioitinh= $_POST['Gioitinh'];
  $sdt=$_POST['SDT'];
  $cccd=$_POST['CCCD'];
  $email=$_POST['Email'];
  $trangthai=$_POST['Trangthai'];
  $birthday=$_POST['Birthday'];
  $diachi=$_POST['Diachi'];
  if($birthday=='') $birthday='NULL';
  if($_POST['Namvao2']=='today') $namvao='now()';
  else { if($_POST['Namvao']=='') $namvao='NULL'; else $namvao=$_POST['Namvao'];}
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];}
  else $images='';
  if( $manv=='') {  include '../libs/random-string.php';$manv=rand(1,12);$manv=str_rand($manv);};
  include '../libs/nhanvien.php';
  add_nhanvien($manv, $tennv,$username,$gioitinh, $sdt,$cccd, $diachi,$chucvu,$namvao,$birthday,$email,$trangthai,$images);
  if ($images!=''){
    if (move_uploaded_file($hinhanh['tmp_name'],'../images/nhanvien/'.$images))  {;}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Thêm Nhân viên thành công</h3>';
}
    ?>
