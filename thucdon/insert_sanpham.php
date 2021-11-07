<?php
if(isset($_POST['Masp'])){
  $err1='<h3 class="success1" style="background: rgba(255,106,106,.20);color:red;padding:7px;">';
  $err2=' </h3>';
  $chuanhap='';
  $masp=$_POST['Masp'];
  $tensp=$_POST['Tensp']; if($tensp=='') $chuanhap=$chuanhap.' Tên món,';
  $giasp=$_POST['Giasp']; if($giasp=='') $chuanhap=$chuanhap.' Giá món,';
  $giavon=$_POST['Giavon']; if($giavon=='') $chuanhap=$chuanhap.' Giá vốn,';
  $nhommon=$_POST['Nhommon']; if($nhommon=='') $chuanhap=$chuanhap.' Nhóm món,';
  $loaisp=$_POST['Loaisp']; if($loaisp=='') $chuanhap=$chuanhap.' Loại món,';
  $dvt=$_POST['Dvt']; if($dvt=='') $chuanhap=$chuanhap.' Đơn vị tính,';
  $slquydoi=$_POST['Slquydoi']; if($slquydoi=='') $chuanhap=$chuanhap.' Số lượng quy đổi';$chuanhap=rtrim($chuanhap, ",");
  if ($chuanhap!='') {echo $err1.'Bạn chưa nhập'.$chuanhap.$err2;die;};
  if (strpos($masp, ' ') !== false) {echo $err1.'Vui lòng không nhập khoảng trắng trong mã món'.$err2;die;};
  $nhapso='';
  if (!is_numeric($giasp)) $nhapso=$nhapso.' Giá bán,';
  if (!is_numeric($giavon)) $nhapso=$nhapso.' Giá vốn,';
  if (!is_numeric($slquydoi)) $nhapso=$nhapso.' Số lượng quy đổi';$nhapso=rtrim($nhapso, ",");
  if ($nhapso!='') {echo $err1.'Vui lòng Chỉ nhập số'.$nhapso.$err2;die;};
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  if (check_1condition('sanpham','MaSP',"MaSP= '$masp'")==1) {echo $err1.'Mã Món này đã tồn tại không thể thêm món ăn'.$err2; die;}
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];}
  else $images='';
  if ($images!=''){
    if (check_1condition('sanpham','Hinhanh',"Hinhanh='$images'")==1) {echo $err1.'Tên ảnh đã trùng trong cơ sở dữ liệu'.$err2; die;}
    if (move_uploaded_file($hinhanh['tmp_name'],'../images/sanpham/'.$images))  {;}
  };
  if( $masp=='') {  include '../libs/random-string.php';$masp=rand(1,12);$masp=str_rand($masp);};
  $trangthai=$_POST['Trangthai'];
  $mota=$_POST['Mota'];
  include '../libs/sanpham.php';
  add_sanpham($masp,$tensp,$dvt,$giasp,$giavon,$loaisp,$nhommon,$trangthai,$images,$mota,$slquydoi);
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Thêm món thành công</h3>';
}
    ?>
