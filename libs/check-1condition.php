<?php
function check_1condition($table,$needcheck,$condition1)
{
    // Câu truy vấn lấy giá trị cần kiểm tra
    $sql = "SELECT $needcheck FROM $table WHERE $condition1 ";
    // Gọi tới biến toàn cục $conn
    global $conn;
    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    // Biến chứa kết quả 1:yes 0:no
    $matchFound = mysqli_num_rows($query) > 0 ? 1 : 0;
    // Trả kết quả về
    return $matchFound;
}
?>
