<?php
// Biến kết nối toàn cục
global $conn;
include('ketnoi.php');

function get_ban_Vitri()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
// Câu truy vấn lấy tất cả user
    $sql = "SELECT Vitri FROM ban GROUP BY Vitri";

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
// Hàm lấy tất cả bàn



// Hàm thêm bàn
function add_ban($maban, $tenban, $tinhtrangchongoi, $size, $hinhanh)
{
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
    $maban = addslashes($maban);
    $tenban = addslashes($tenban);
    $tinhtrangchongoi = addslashes($tinhtrangchongoi);
	$size = addslashes($size);
	$hinhanh = addslashes($hinhanh);

    // Câu truy vấn thêm
    $sql = "
            INSERT INTO ban(MaBan,TenBan,SizeBan,Hinhanh) VALUES
            ('$maban','$tenban','$size','$hinhanh')
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}


// Hàm sửa bàn
function edit_ban($maban, $tenban, $tinhtrangchongoi, $size, $hinhanh)
{
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Chống SQL Injection
   $maban = addslashes($maban);
    $tenban = addslashes($tenban);
    $tinhtrangchongoi = addslashes($tinhtrangchongoi);
	$size = addslashes($size);
	$hinhanh = addslashes($hinhanh);
    // Câu truy sửa
    $sql = "
            UPDATE ban SET
            MaBan = '$maban',
            TenBan = '$tenban',
            TinhTrangChoNgoi = '$tinhtrangchongoi'
			SizeBan = '$size'
			Hinhanh = '$hinhanh'
            WHERE MaBan = $maban
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}


// Hàm xóa sinh viên
function delete_ban($ban_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;

    // Hàm kết nối
    connect_db();

    // Câu truy sửa
    $sql = "
            DELETE FROM babn
            WHERE MaBan = $ban_id
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}
