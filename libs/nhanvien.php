<?php
function add_nhanvien($manv, $tennv,$username,$gioitinh, $sdt,$cccd, $diachi,$chucvu,$namvao,$birthday,$email,$trangthai,$hinhanh)
{
    $manv = addslashes($manv);
    $tennv = addslashes($tennv);
    $username = addslashes($username);
    $gioitinh = addslashes($gioitinh);
    $sdt = addslashes($sdt);
	$cccd = addslashes($cccd);
	$diachi = addslashes($diachi);
  $chucvu = addslashes($chucvu);
  $namvao = addslashes($namvao);
  $birthday = addslashes($birthday);
  $email = addslashes($email);
  $trangthai = addslashes($trangthai);
  $hinhanh = addslashes($hinhanh);
  if (($namvao!='NULL') && ($namvao!='now()')) $namvao="'$namvao'";
  if (($birthday!='NULL')) $birthday="'$birthday'";
  $sql = "
            INSERT INTO nhanvien(MaNV, TenNV,Username,Gioitinh,SDT,CCCD,Diachi,Chucvu,Namvao,Birthday,Email,Trangthai,Avatar) VALUES
            ('$manv','$tennv','$username','$gioitinh','$sdt','$cccd','$diachi','$chucvu',$namvao,$birthday,'$email','$trangthai','$hinhanh')
    ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}
function edit_nhanvien($manv, $tennv,$username,$gioitinh, $sdt,$cccd, $diachi,$chucvu,$namvao,$birthday,$email,$trangthai,$hinhanh)
{
    $manv = addslashes($manv);
    $tennv = addslashes($tennv);
    $username = addslashes($username);
    $gioitinh = addslashes($gioitinh);
    $sdt = addslashes($sdt);
    $cccd = addslashes($cccd);
    $diachi = addslashes($diachi);
    $chucvu = addslashes($chucvu);
    $namvao = addslashes($namvao);
    $birthday = addslashes($birthday);
    $email = addslashes($email);
    $trangthai = addslashes($trangthai);
    $hinhanh = addslashes($hinhanh);
    if (($namvao!='NULL') && ($namvao!='now()')) $namvao="'$namvao'";
    if (($birthday!='NULL')) $birthday="'$birthday'";
    if ($hinhanh!='') $sqlhinhanh="Avatar= '$hinhanh',"; else $sqlhinhanh='';
    $sql = "
            UPDATE nhanvien SET
  TenNV = '$tennv',
            Username= '$username',
            Gioitinh = '$gioitinh',
            SDT= '$sdt',
            CCCD = '$cccd',
            Diachi = '$diachi',
            Chucvu = '$chucvu',
            Namvao = $namvao,
            Birthday = $birthday,

            $sqlhinhanh
            Email = '$email',
            Trangthai = '$trangthai'
            WHERE MaNV = '$manv'
            ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}

?>
