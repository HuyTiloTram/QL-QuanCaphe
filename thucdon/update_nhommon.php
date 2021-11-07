<?php
if(isset($_POST['Manhommon'])){
  $tennhom=$_POST['Tennhommon'];
  $manhom=$_POST['Manhommon'];
  if(!empty($_FILES['Hinhanh'])) {$hinhanh=$_FILES['Hinhanh'];$images= $hinhanh['name'];}
  else $images='';
  $trangthai=$_POST['Trangthai'];
  include '../ketnoi.php';
  include '../libs/nhommon.php';
  edit_nhommon($manhom,$tennhom,$images,$trangthai);
  $im= "../images/nhommon/";
  if ($images!=""){
  if (move_uploaded_file($hinhanh['tmp_name'],'../images/nhommon/'.$images))  {if ($_POST['Hinhanhhientai'] != $im) unlink($_POST['Hinhanhhientai']);}
  };
  echo '<h3 class="success1" style="background-color:#0099FF;padding:7px;">Sửa nhóm món thành công</h3>';

}
    ?>
