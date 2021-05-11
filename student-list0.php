<?php
session_start();
if (!isset($_SESSION['username'])){
  header("location: dangnhap.php");die;}
if ($_SESSION['level']!=1){
  header("location: student-list_member2.php");die;}
require 'libs/students.php';
$students = get_all_students();
disconnect_db();
?>

<!DOCTYPE html>
<html>
        <meta charset="UTF-8"
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="plugins/js/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="plugins/css/bootstrap.min.css">
        <script src="plugins/js/bootstrap.min.js"></script>

        <script src="plugins/js/popper.min.js"></script>
        <link rel="stylesheet" type="text/css" href="include/css/style.css">


    </head>
    <body>
<header class="header-main">
  <nav class="navbar navbar-expand-lg header-main-ground" >
          <div class="container">
    <a class="navbar-brand" href="#" title='Cà phê Mê Trang'>
    <img width="160" height="130" src="logo3.jpg" class="header-logo-sticky" alt="Vườn Rau">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>
    <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active nav-top-active">
          <a class="nav-link" style="color:#FFFFFF"href="#">Bàn <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item ">
          <a class="nav-link nav-top-menu" href="#">Sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-top-menu" href="#">Thống kê</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-top-menu" href="#">Nhân viên</a>
        </li>
      </ul>
      <ul class="navbar-nav col-auto">
        <div class="dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php include('header.php') ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="emp.php">Trang cá nhân2</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Đăng xuất</a>
          </div>
        </div>
      </ul>
    </div>
  </div>
  </nav>
</header> <!-- End Header -->
<div class="container">
  <div class="my-3 p-1 bg-white rounded shadow-sm">
    <div class=row>
    <div class="col-lg-3">

        <h1>Danh sách sinh vien</h1>
        <?php include('header.php') ?> <a href="student-add.php">Thêm sinh viên</a> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10" class="table table-striped">
          <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Gender</td>
                <td>Birthday</td>
                <td>Options</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($students as $item){ ?>
            <tr>
                <td><?php echo $item['sv_id']; ?></td>
                <td><?php echo $item['sv_name']; ?></td>
                <td><?php echo $item['sv_sex']; ?></td>
                <td><?php echo $item['sv_birthday']; ?></td>
                <td>
                    <form method="post" action="student-delete.php">
                        <input onclick="window.location = 'student-edit.php?id=<?php echo $item['sv_id']; ?>'" type="button" style="background:blue ;color:White" value="Sửa"/>
                        <input type="hidden" name="id" value="<?php echo $item['sv_id']; ?>"/>
                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" style="background:Red ;color:white" value="Xóa"/>
                    </form>
                </td>
            </tr>
          </tbody>
            <?php } ?>
        </table>
</div>
</div> <!--End container>-->
</div>
</div>
    </body>
</html>
