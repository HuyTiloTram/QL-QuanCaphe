<?php
if(isset($_POST['Makh'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $makh=$_POST['Makh'];
  if (check_1condition('khachhang','MaKH',"MaKH= '$makh'")==1) {echo '<h3 style="color: #721c24;background-color: #f8d7da;">Lỗi: Mã Khách hàng này đã tồn tại không thể thêm</h3>'; die;}
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
  if($birthday=='') $birthday='NULL';
  if($_POST['Namvao2']=='today') $ngaytao='now()';
  else { if($_POST['Ngaytao']=='') $ngaytao='NULL'; else $ngaytao=$_POST['Ngaytao'];}
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];}
  else $images='';
  if( $makh=='') {  include '../libs/random-string.php';$makh=rand(1,12);$makh=str_rand($makh);};
  include '../libs/khachhang.php';
  add_khachhang($makh, $tenkh,$username,$password,$gioitinh, $sdt, $diachi,$capdo,$ngaytao,$birthday,$email,$diemthuong,$duno,$ghichu,$trangthai,$images);
  if ($images!=''){
    if (move_uploaded_file($hinhanh['tmp_name'],'../images/khachhang/'.$images))  {;}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Thêm khách hàng thành công</h3>';
}
    ?>
