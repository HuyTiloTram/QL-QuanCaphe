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
if (isset($_POST['dangky']))
{
  function signup(){
    if ($_POST['Password'] != $_POST['Confirmpassword']) return 'Mật khẩu bạn nhập lại không trùng khớp với mật khẩu ban đầu';
    include 'ketnoi.php';

    $username = addslashes($_POST['Username']);
    $password = addslashes($_POST['Password']);
    $fullname = addslashes($_POST['Fullname']);
    $email    = addslashes($_POST['Email']);
    $sdt      = addslashes($_POST['Phone']);
    $birthday = addslashes($_POST['Birthday']);
    $sex      = addslashes($_POST['Sex']);

    if (mysqli_num_rows(mysqli_query($conn,"SELECT username FROM members WHERE username='$username'")) > 0)
      {$er= 'Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác'; return $er;}
    if (mysqli_num_rows(mysqli_query($conn,"SELECT email FROM members WHERE email='$email'")) > 0)
      {$er= 'Email này đã có người dùng. Vui lòng chọn Email khác'; return $er;}
    $password = md5($password);
    @$addmember = mysqli_query($conn,"
      INSERT INTO members (username, password, email, fullname, birthday, sex, phone, level)
                  VALUE   ('{$username}','{$password}','{$email}','{$fullname}','{$birthday}','{$sex}','{$sdt}','0')
    ");
    if ($addmember) $er = "Đăng ký thành công Username: $username. "; else $er='lỗi DATABASE'; return $er;
  } $check=signup();
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
  <div class="bg "></div> <!-- <div class="star-field"><div class="layer"></div><div class="layer"></div><div class="layer"></div> -->
  <div class="login-box">
      <div class="thongbao"><?php if(isset($check)) echo $check; ?></div>
			<h2>Sign up</h2>
			<form action='dangky.php' method='POST'>
        <div class="login-field">
					<input type="text" name="Fullname" required="" value="<?php if(isset($_POST['Fullname'])) echo $_POST['Fullname'] ?>" />
					<label>Your Name</label>
				</div>
				<div class="login-field">
					<input type="text" name="Username" required="" value="<?php if(isset($_POST['Username'])) echo $_POST['Username'] ?>" />
					<label>Username</label>
				</div>
				<div class="login-field">
					<input type="password" name="Password" required="" value="<?php if(isset($_POST['Password'])) echo $_POST['Password'] ?>" />
					<label >Password</label>
				</div>
        <div class="login-field">
					<input type="password" name="Confirmpassword" required="" value="<?php if(isset($_POST['Confirmpassword'])) echo $_POST['Confirmpassword'] ?>" />
					<label >Confirm Password</label>
				</div>
        <div class="login-field">
					<input type="email" name="Email" required="" value="<?php if(isset($_POST['Email'])) echo $_POST['Email'] ?>" />
					<label>Email</label>
				</div>
        <div class="login-field">
					<input type="number" name="Phone" required="" value="<?php if(isset($_POST['Phone'])) echo $_POST['Phone'] ?>" />
					<label>Phone</label>
				</div>
        <div class="login-field">
          <input type="text" name="Sex" required="" maxlength="5" value="<?php if(isset($_POST['Sex'])) echo $_POST['Sex'] ?>" />
          <label>Sex</label>
        </div>
        <div class="login-field">
          <input type="text" name="Birthday" onclick="(this.type='date')" required="" value="<?php if(isset($_POST['txtPassword'])) echo $_POST['txtPassword'] ?>" />
          <label>Birthday</label>
        </div>
				<button name="dangky" type="submit">Submit</button><button style="margin-left:145px;background-color:black;" type="reset">Nhập lại </button>
        <div style="margin-top:10px;"><span ><a href='dangnhap.php'>Sign in</a> <a style="margin-left:160px">Forgot Password </a></span></div>
			</form>
		</div>

</form>
</body>
</html>
