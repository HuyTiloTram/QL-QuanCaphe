<?php
session_start();
if(isset($_POST['Category'])){ ?>
  <!--Thanh header-top navbar -->
  <nav class="navbar navbar-expand-lg header-main-ground st-navigation navbar-light" style="padding:0;border-bottom: 1px solid #eee">
    <div class="container"style="overflow: visible">
      <div class="text-link-dark h-100 d-flex align-items-center" data-toggle="modal" data-target="#Modal-Mainmenu">
        <div class="d-flex align-items-center logo-center"><a href="" class="router-link-active"><p class="mb-0 text-primary text-heading--small">Cà phê Ngọc Xanh</p></a></div>
        <i class="fas fa-bars pr-3 "> </i>
        <a class="navbar-brand nav-top-text" alt"" title='Cà phê Mê Trang' ><?php echo $_POST['Category']; ?></a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" ></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >  </ul>
        <ul class="navbar-nav col-auto">
          <li class="dropdown">
            <a class="nav-link dropdown-toggle" href="" id="<?php if (isset($_SESSION['username'])) echo "navbarDropdownMenuLink"; else echo "nobody"; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php include 'header-member.php';?>
            </a>
            <div class="dropdown-menu fix-top " aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../dangnhap.php"><?php if (isset($_SESSION['username'])) echo 'Trang cá nhân';else echo "Trang đăng nhập" ?> </a>
        <?php if (isset($_SESSION['username'])) { ?><div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../logout.php">Đăng xuất</a> <?php };?>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav> <?php
} ?>
