<?php
function add_sanpham($masp, $tensp,$dvt, $giasp,$giavon, $loaisp,$nhommon,$trangthai,$hinhanh,$mota,$slquydoi)
{
    $masp = addslashes($masp);
    $tensp = addslashes($tensp);
    $dvt = addslashes($dvt);
    $giasp = addslashes($giasp);
    $giavon = addslashes($giavon);
	$loaisp = addslashes($loaisp);
	$nhommon = addslashes($nhommon);
  $trangthai = addslashes($trangthai);
  $hinhanh = addslashes($hinhanh);
  $mota = addslashes($mota);
  $slquydoi = addslashes($slquydoi);
  $sql = "
            INSERT INTO sanpham(MaSP, TenSP,DVT,GiaSP,Giavon,LoaiSP,NhomMon,Trangthai,Hinhanh,Mota,SLquydoi) VALUES
            ('$masp','$tensp','$dvt',$giasp,$giavon,'$loaisp','$nhommon','$trangthai','$hinhanh','$mota',$slquydoi)
    ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}
function edit_sanpham($masp, $tensp,$dvt, $giasp,$giavon, $loaisp,$nhommon,$trangthai,$hinhanh,$mota,$slquydoi)
{
    $masp = addslashes($masp);
    $tensp = addslashes($tensp);
    $dvt = addslashes($dvt);
    $giasp = addslashes($giasp);
    $giavon = addslashes($giavon);
	$loaisp = addslashes($loaisp);
	$nhommon = addslashes($nhommon);
  $trangthai = addslashes($trangthai);
  $hinhanh = addslashes($hinhanh);
  $mota = addslashes($mota);
  $slquydoi = addslashes($slquydoi);
  if ($hinhanh!='') $sqlhinhanh="Hinhanh='$hinhanh',"; else $sqlhinhanh='';
    $sql = "
            UPDATE sanpham SET
  TenSP = '$tensp',
            DVT='$dvt',
            GiaSP = $giasp,
            Giavon=$giavon,
            LoaiSP = '$loaisp',
            NhomMon = '$nhommon',
            $sqlhinhanh
            Trangthai = '$trangthai',
            Mota = '$mota',
            SLquydoi = $slquydoi
            WHERE MaSP = '$masp'
            ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}
?>
