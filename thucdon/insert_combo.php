<?php
if(isset($_POST['Masp'])){
  include '../ketnoi.php';
  include '../libs/check-1condition.php';
  $masp=$_POST['Masp'];
  if (check_1condition('sanpham','MaSP',"MaSP= '$masp'")==1) {echo '<h3 style="color: #721c24;background-color: #f8d7da;">Lỗi: Mã Combo này đã tồn tại không thể thêm</h3>'; die;}
  $tensp=$_POST['Tensp'];$giasp=$_POST['Giasp'];$giavon=$_POST['Giavon'];$nhommon='';$loaisp='Combo';$dvt='';$mota=$_POST['Mota'];$slquydoi=1;$trangthai=$_POST['Trangthai'];
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];} else $images='';
  if( $masp=='') {  include '../libs/random-string.php';$masp=rand(1,12);$masp=str_rand($masp);};
  include '../libs/sanpham.php';
  add_sanpham($masp,$tensp,$dvt,$giasp,$giavon,$loaisp,$nhommon,$trangthai,$images,$mota,$slquydoi);
  if ($images!=''){
    if (move_uploaded_file($hinhanh['tmp_name'],'../images/sanpham/'.$images))  {;}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Thêm Combo thành công</h3>';

}
    ?>
