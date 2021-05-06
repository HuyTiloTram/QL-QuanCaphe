<?php
include('ketnoi.php');
//lấy về tất cả user
function get_all_users()
{
    // Gọi tới biến toàn cục $conn
    global $conn;
// Câu truy vấn lấy tất cả user
    $sql = "select * from users";

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

// Hàm lấy user theo user_id
function get_user_by_id($user_id)
{
// Gọi tới biến toàn cục $conn
    global $conn;
// Câu truy vấn lấy tất cả sinh viên
    $sql = "select * from users where id = $user_id";

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
// Hàm lấy user theo username
function get_member($username)
{
// Gọi tới biến toàn cục $conn
    global $conn;
// Câu truy vấn lấy tất cả user
    $sql = "select * from members where username = '{$username}'";

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
 // Hàm thêm user
function add_user($username, $password, $email,$fullname,$usertype_id)
{

    // Chống SQL Injection
    $username = addslashes($username);
    $password = addslashes($password);
    $email = addslashes($email);
    $fullname = addslashes($fullname);
    $usertype_id = addslashes($usertype_id);

    // Câu truy vấn thêm
    $sql = "
            INSERT INTO users(username, password, email,fullname,usertype_id) VALUES
            ('$username','$password','$email','$fullname','$usertype_id')
    ";

// Gọi tới biến toàn cục $conn
    global $conn;

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}
// Hàm sửa user
function edit_user($user_id,$username, $password, $email,$fullname,$usertype_id)
{

    // Chống SQL Injection

    $user_id = addslashes($user_id);
    $username = addslashes($username);
    $password=addslashes($password);
    $email = addslashes($email);
    $fullname= addslashes($fullname);
    $usertype_id=addslashes($usertype_id);

    // Câu truy vấn thêm
    $sql = "
            UPDATE users SET
username = '$username',
            password='$password',
            email = '$email',
            usertype_id = $usertype_id
            WHERE id = $user_id
            ";

// Gọi tới biến toàn cục $conn
    global $conn;
// Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    return $query;
}

// Hàm xóa user
function delete_user($user_id)
{
     // Gọi tới biến toàn cục $conn
    global $conn;
    $sql = "
            DELETE FROM users
            WHERE id= $user_id
    ";

    // Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);

    return $query;
}

//hàm lấy về tất cả user có phân trang từ trang from đến from+max_result
function get_users_from($from,$max_results){
    // Gọi tới biến toàn cục $conn
    global $conn;
// Câu truy vấn lấy tất cả người dùng

    $sql = "select * from users limit $from,$max_results";

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

// Hàm update new password cho user
function update_password_user($username, $new_password)
{

    // Chống SQL Injection
    $username = addslashes($username);
    $new_password=addslashes(md5($new_password));

    $sql = "
                UPDATE users SET
                password='$new_password'
                WHERE username = '$username'
           ";
// Gọi tới biến toàn cục $conn
    global $conn;
// Thực hiện câu truy vấn
    $query = mysqli_query($conn, $sql);
    return $query;
}
?>
