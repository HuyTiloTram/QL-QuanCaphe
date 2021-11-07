<?php
if(isset($_POST['Masp'])){
  include '../ketnoi.php';
  $tensp=$_POST['Tensp'];$giasp=$_POST['Giasp'];$giavon=$_POST['Giavon'];$masp=$_POST['Masp'];$nhommon='';$loaisp='Combo';$dvt='';$slquydoi=1;$trangthai=$_POST['Trangthai'];$mota=$_POST['Mota'];
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];}
  else $images='';
  include '../libs/sanpham.php';
  edit_sanpham($masp,$tensp,$dvt,$giasp,$giavon,$loaisp,$nhommon,$trangthai,$images,$mota,$slquydoi);

  //nếu đã chọn ảnh sẽ thêm ảnh và xóa ảnh hiện tại trong host
  if ($images!=''){
    $im= '../images/sanpham/';
    if (move_uploaded_file($hinhanh['tmp_name'],'../images/sanpham/'.$images))  {if ($_POST['Hinhanhhientai'] != $im) unlink($_POST['Hinhanhhientai']);}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Sửa Combo thành công</h3>';

}
    ?>
