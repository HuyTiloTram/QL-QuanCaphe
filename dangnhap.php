<?php
//Khai báo sử dụng session
session_start();
if  (isset($_SESSION['username']))  {
  if ($_SESSION['level']==1)
  {header("location: tongquan");die;}
  else
  {header("location: pos");die;}
}

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');

//Xử lý đăng nhập
if (isset($_POST['login']))
{
  function login(){
    if ( (isset($_POST['txtUsername'])) || (isset($_POST['txtPassword'])) ) ; else {$er= "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";return $er;}
    if (strpos($_POST['txtUsername'], ' ') !== false)  return $er= "Vui lòng không nhập khoảng trắng trong tên đăng nhập";

    include 'ketnoi.php';
    $username = addslashes($_POST['txtUsername']);
    $password = addslashes($_POST['txtPassword']);
    if (strpos($_POST['txtUsername'], '@') !== false){
      $query = mysqli_query($conn,"SELECT email FROM members WHERE email='$username'");
      if (mysqli_num_rows($query) == 0) {  $er= 'Email này không tồn tại. Vui lòng kiểm tra lại';return $er;}
      $query = mysqli_query($conn,"SELECT email,username,password,level FROM members WHERE email='$username'");
    }
    else{
      $query = mysqli_query($conn,"SELECT username FROM members WHERE username='$username'");
      if (mysqli_num_rows($query) == 0) {  $er= 'Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại';return $er;}
      $query = mysqli_query($conn,"SELECT username,password,level FROM members WHERE username='$username'");
    }
    $usersitem = mysqli_fetch_assoc($query);
    $password = md5($password);
    if ($password != $usersitem['password']) {$er= "Mật khẩu không đúng. Vui lòng nhập lại";return $er; }
    //Lưu tên đăng nhập và loại người dùng
    $_SESSION['username'] = $username;
    $_SESSION['level'] = $usersitem['level'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $_SESSION['time_login'] = time();
    return 'thanhcong';
  } $check=login();if($check=='thanhcong') {header("location: tongquan");die;}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login - Phần mềm quản lý quán cà phê</title>
  <link rel="stylesheet" type="text/css" href="include/css/styleLogin.css">
  <style type="text/css">
    .bg{background:url(images/background/bg2.jpg) no-repeat;background-size:cover;height:100%;width:100%;position:fixed;top:0;left:0;z-index:-3}
  </style>
</head>
<body>
  <div class="bg "></div> <!-- <div class="star-field"><div class="layer"></div><div class="layer"></div><div class="layer"></div>-->
  <form action='dangnhap.php' method='POST'>
	<div class="form-box"  >
    <div class="thongbao"><?php if(isset($check)) echo $check; ?> </div>
		<div class="header-text">Login Form</div>
    <input name='txtUsername' placeholder="Your Username or Email Address"  type='text' value="<?php if(isset($_POST['txtUsername'])) echo $_POST['txtUsername'] ?>">
    <input name='txtPassword' placeholder="Your Password" id="password-field" type="password" value="<?php if(isset($_POST['txtPassword'])) echo $_POST['txtPassword'] ?>">

    <input id="terms" type="checkbox"> <label for="terms"></label><span>Agree with <a>Terms & Conditions</a></span>
    <button name="login" type='submit'>login</button>
    <span><a href='dangky.php'>Sign up</a> <a style="margin-left:175px;white-space: nowrap;">Forgot Password </a></span>
	</div>
</form>
</body>
</html>
