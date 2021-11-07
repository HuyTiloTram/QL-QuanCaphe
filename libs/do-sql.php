<?php
function do_sql($sql)
{
    global $conn;
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
?>
