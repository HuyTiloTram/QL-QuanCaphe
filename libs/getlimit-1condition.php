<?php
function getlimit_1condition($table,$limit,$page,$condition1)
{
    $page-=1;
    $page=$page*$limit;
    $sql = "select * from $table where $condition1 LIMIT $page,$limit" ;
    global $conn;
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
