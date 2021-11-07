<?php
if(isset($_POST['Makh'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $makh=$_POST['Makh'];
  $tenkh=$_POST['Tenkh'];
  $capdo=$_POST['Capdo'];
  $username=$_POST['Username'];
  $gioitinh= $_POST['Gioitinh'];
  $sdt=$_POST['SDT'];
  $email=$_POST['Email'];
  $trangthai=$_POST['Trangthai'];
  $birthday=$_POST['Birthday'];
  $diemthuong=$_POST['Diemthuong'];
  $duno=$_POST['Duno'];
  $ghichu=$_POST['Ghichu'];
  $diachi=$_POST['Diachi'];
  $password=$_POST['Password'];
  $tonggiaodich=$_POST['Tonggiaodich'];
  if($birthday=='') $birthday='NULL';
  if($_POST['Namvao2']=='today') $ngaytao='now()';
  else { if($_POST['Ngaytao']=='') $ngaytao='NULL'; else $ngaytao=$_POST['Ngaytao'];}
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];}
  else $images='';
  include '../libs/khachhang.php';
  edit_khachhang($makh, $tenkh,$username,$password,$gioitinh, $sdt, $diachi,$capdo,$ngaytao,$birthday,$email,$diemthuong,$duno,$ghichu,$tonggiaodich,$trangthai,$images);
  //nếu đã chọn ảnh sẽ thêm ảnh và xóa ảnh hiện tại trong host
  if ($images!=''){
    $im= '../images/khachhang/';
    if (move_uploaded_file($hinhanh['tmp_name'],'../images/khachhang/'.$images))  {if ($_POST['Hinhanhhientai'] != $im) unlink($_POST['Hinhanhhientai']);}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Sửa khách hàng thành công</h3>';

}
    ?>
