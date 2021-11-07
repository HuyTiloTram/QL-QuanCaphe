<?php


include('../ketnoi.php');

function get_top_hoadon($number)
{
    // Gọi tới biến toàn cục $conn
    global $conn;


    // Câu truy vấn lấy tất cả bàn
    $sql = "select * from hoadon ORDER BY NgayLap DESC LIMIT 0,$number";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    // Mảng chứa kết quả
    $result = array();

    // Lặp qua từng record và đưa vào biến kết quả
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }

    // Trả kết quả về
    return $result;
}

function add_hoadon($mahd, $manv, $ngaylap, $tien, $giamgia, $tongtien, $thanhtoan, $maban, $status,$note,$customer)
{
    // Chống SQL Injection
    $mahd = addslashes($mahd);
    $manv = addslashes($manv);
    $ngaylap = addslashes($ngaylap);
    $tien = addslashes($tien);
    $giamgia = addslashes($giamgia);
	  $tongtien = addslashes($tongtien);
	  $thanhtoan = addslashes($thanhtoan);
    $maban = addslashes($maban);
    $status = addslashes($status);
    $note = addslashes($note);
    $customer = addslashes($customer);
    // Câu truy vấn thêm
    $sql = "
            INSERT INTO hoadon(MaHD,MaNV,NgayLap,Tien,Giamgia,Tongtien,HinhThucThanhToan,MaBan,Status,Note,MaKH) VALUES
            ('$mahd','$manv',$ngaylap,$tien,$giamgia,$tongtien,'$thanhtoan',$maban,$status,'$note','$customer')
    ";

// Gọi tới biến toàn cục $conn
    global $conn;

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}
function edit_hoadon_byMaHD($tien,$giamgia, $tongtien,$note,$makh,$mahd)
{
    $tien = addslashes($tien);
    $giamgia = addslashes($giamgia);
    $tongtien=addslashes($tongtien);
    $note = addslashes($note);
    $makh= addslashes($makh);
    $mahd= addslashes($mahd);
    // Câu truy vấn thêm
    $sql = "
            UPDATE hoadon SET
Tien = $tien,
            Giamgia = $giamgia,
            Tongtien = $tongtien,
            Note = '$note',
            MaKH = '$makh'
            WHERE MaHD = '$mahd'
            ";
// Gọi tới biến toàn cục $conn
    global $conn;
// Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    return $query;
}

?>
