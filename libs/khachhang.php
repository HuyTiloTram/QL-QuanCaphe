<?php
function add_khachhang($makh, $tenkh,$username,$password,$gioitinh, $sdt, $diachi,$capdo,$ngaytao,$birthday,$email,$diemthuong,$duno,$ghichu,$trangthai,$hinhanh)
{
    $makh = addslashes($makh);
    $tenkh = addslashes($tenkh);
    $username = addslashes($username);
    $password = addslashes($password);
    $gioitinh = addslashes($gioitinh);
    $sdt = addslashes($sdt);
	  $diachi = addslashes($diachi);
    $capdo = addslashes($capdo);
    $ngaytao = addslashes($ngaytao);
    $birthday = addslashes($birthday);
    $email = addslashes($email);
    $birthday = addslashes($birthday);
    $email = addslashes($email);
    $diemthuong = addslashes($diemthuong);
    $duno = addslashes($duno);
    $ghichu = addslashes($ghichu);
    $password=  md5($password);
  if (($ngaytao!='NULL') && ($ngaytao!='now()')) $ngaytao="'$ngaytao'";
  if (($birthday!='NULL')) $birthday="'$birthday'";
  $sql = "
            INSERT INTO khachhang(MaKH, TenKH,Username,Password,Gioitinh,SDT,Diachi,Capdo,Ngaytao,Birthday,Email,Diemthuong,Duno,Ghichu,Trangthai,Avatar) VALUES
            ('$makh','$tenkh','$username','$password','$gioitinh','$sdt','$diachi',$capdo,$ngaytao,$birthday,'$email',$diemthuong,$duno,'$ghichu','$trangthai','$hinhanh')
    ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}
function edit_khachhang($makh, $tenkh,$username,$password,$gioitinh, $sdt, $diachi,$capdo,$ngaytao,$birthday,$email,$diemthuong,$duno,$ghichu,$tonggiaodich,$trangthai,$hinhanh)
{
  $makh = addslashes($makh);
  $tenkh = addslashes($tenkh);
  $username = addslashes($username);
  $password = addslashes($password);
  $gioitinh = addslashes($gioitinh);
  $sdt = addslashes($sdt);
  $diachi = addslashes($diachi);
  $capdo = addslashes($capdo);
  $ngaytao = addslashes($ngaytao);
  $birthday = addslashes($birthday);
  $email = addslashes($email);
  $birthday = addslashes($birthday);
  $email = addslashes($email);
  $diemthuong = addslashes($diemthuong);
  $duno = addslashes($duno);
  $ghichu = addslashes($ghichu);
  $tonggiaodich = addslashes($tonggiaodich);
  $password=  md5($password);
  if (($ngaytao!='NULL') && ($ngaytao!='now()')) $ngaytao="'$ngaytao'";
  if (($birthday!='NULL')) $birthday="'$birthday'";
  if ($hinhanh!='') $sqlhinhanh="Avatar= '$hinhanh',"; else $sqlhinhanh='';
    $sql = "
            UPDATE khachhang SET
  TenKH = '$tenkh',
            Username= '$username',
            Password = '$password',
            Gioitinh = '$gioitinh',
            SDT= '$sdt',
            Diachi = '$diachi',
            Capdo= $capdo,
            Ngaytao = $ngaytao,
            Birthday = $birthday,
            Email = '$email',
            Diemthuong = $diemthuong,
            Duno = $duno,
            Ghichu = '$ghichu',
            Tonggiaodich = $tonggiaodich,
            $sqlhinhanh
            Trangthai = '$trangthai'
            WHERE MaKH = '$makh'
            ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}

?>
