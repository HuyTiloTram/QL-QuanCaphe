<?php
// Biến kết nối toàn cục
global $conn;
 
// Hàm kết nối database

function connect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Nếu chưa kết nối thì thực hiện kết nối
    if (!$conn){
        $conn = mysqli_connect('localhost', 'root', '', 'qlquancaphe') or die ('Can\'t not connect to database');
        // Thiết lập font chữ kết nối
        mysqli_set_charset($conn, 'utf8');
    }
}
 
// Hàm ngắt kết nối
function disconnect_db()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Nếu đã kêt nối thì thực hiện ngắt kết nối
    if ($conn){
        mysqli_close($conn);
    }
}
 
// Hàm lấy tất cả bàn
function get_all_ban()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn lấy tất cả bàn
    $sql = "select * from ban";
     
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
 
// Hàm lấy bàn theo MaBan
function get_ban($ban_id)
{
    // Gọi tới biến toàn cục $conn
    global $conn;
     
    // Hàm kết nối
    connect_db();
     
    // Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from ban where MaBan = {$ban_id}";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
     
    // Mảng chứa kết quả
    $result = array();
     
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
     
    // Trả kết quả về
    return $result;
}
 
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
