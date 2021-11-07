<?php
function get_all_1table($table)
{
    global $conn;
    $sql = "select * from $table";
    $query = mysqli_query($conn, $sql);
    $result = array();
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    return $result;
}

?>
