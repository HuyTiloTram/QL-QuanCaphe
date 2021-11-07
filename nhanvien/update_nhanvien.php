<?php
if(isset($_POST['Manv'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $manv=$_POST['Manv'];
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
  include '../libs/nhanvien.php';
  edit_nhanvien($manv, $tennv,$username,$gioitinh, $sdt,$cccd, $diachi,$chucvu,$namvao,$birthday,$email,$trangthai,$images);
  //nếu đã chọn ảnh sẽ thêm ảnh và xóa ảnh hiện tại trong host
  if ($images!=''){
    $im= '../images/nhanvien/';
    if (move_uploaded_file($hinhanh['tmp_name'],'../images/nhanvien/'.$images))  {if ($_POST['Hinhanhhientai'] != $im) unlink($_POST['Hinhanhhientai']);}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Sửa nhân viên thành công</h3>';

}
    ?>
