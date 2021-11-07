<?php
// Biến kết nối toàn cục
global $conn;
include('ketnoi.php');

function get_top_lichsuhoatdong($number)
{
    // Gọi tới biến toàn cục $conn
    global $conn;


    // Câu truy vấn lấy tất cả bàn
    $sql = "select * from lichsuhoatdong ORDER BY Thoidiem DESC LIMIT 0,$number";

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
