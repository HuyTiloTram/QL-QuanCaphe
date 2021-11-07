<?php

function update_1condition($table,$needupdate,$willupdate,$condition1)
{
    $sql = "
            UPDATE $table SET
$needupdate = $willupdate
            WHERE $condition1
            ";
    global $conn;
    $query = mysqli_query($conn, $sql);
    return ;

}
?>
