<?php
function add_nhommon($manhom, $tennhom,$hinhanh,$trangthai)
{
    $manhom = addslashes($manhom);
    $tennhom = addslashes($tennhom);
    $hinhanh = addslashes($hinhanh);
    $trangthai = addslashes($trangthai);

  $sql = "
            INSERT INTO nhommon(MaNhomMon,TenNhomMon,Hinhanh,Trangthai) VALUES
            ('$manhom','$tennhom','$hinhanh','$trangthai')
    ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}
function edit_nhommon($manhom, $tennhom,$hinhanh,$trangthai)
{
  $manhom = addslashes($manhom);
  $tennhom = addslashes($tennhom);
  $hinhanh = addslashes($hinhanh);
  $trangthai = addslashes($trangthai);
  if ($hinhanh=="")
    $sql = "
            UPDATE nhommon SET
  TenNhomMon = '$tennhom',
            Trangthai = '$trangthai'
            WHERE MaNhomMon = '$manhom'
            ";

  else
    $sql = "
          UPDATE nhommon SET
TenNhomMon = '$tennhom',
          Trangthai = '$trangthai',
          Hinhanh='$hinhanh'
          WHERE MaNhomMon = '$manhom'
          ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return $query;
}

?>
