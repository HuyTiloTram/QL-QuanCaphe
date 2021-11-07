<?php
function get_limit_1table($table,$limit,$page)
{
    global $conn;
    $page-=1;
    $page=$page*$limit;
    $sql = "select * from $table LIMIT $page,$limit" ;
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
