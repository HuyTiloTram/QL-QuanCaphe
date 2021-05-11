<?php
session_start();
if (!isset($_SESSION['username'])){
  header("location: dangnhap.php");die;}
if ($_SESSION['level']!=1){
  header("location: student-list_member2.php");die;}
include 'libs/ban.php';
include 'libs/sanpham.php';
include 'libs/loaisanpham.php';
$ban = get_all_ban();
$sanpham = get_all_sanpham();
$loaisanpham = get_all_loaisanpham();
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

<script>
$(document).ready(function() {
$('#searchbox').on("keyup", function (){
   $('.col-lg-4').removeClass('d-none');
   var filter = $(this).val();
   if (filter && filter.length>0){
       $('.search-sanpham-range').find('.col-lg-4 .info-sanpham h5:contains("'+filter+'")').parentsUntil('.col-lg-4').parent().removeClass('d-none');
       $('.search-sanpham-range').find('.col-lg-4 .info-sanpham h5:not(:contains("'+filter+'"))').parentsUntil('.col-lg-4').parent().addClass('d-none');
   }
   else{
   $('.search-sanpham').find('.col-lg-4 .card-body h5:contains("'+filter+'")').parentsUntil('.col-lg-4').parent().removeClass('d-none');
   }
});
});
</script>

    </head>
    <body>
<div class="header-main"style="height:88px;background-color:white;width:100%;overflow: visible" >
  <nav class="navbar navbar-expand-lg header-main-ground fixed-top navbar-light" style="opacity: 0.96">
          <div class="container"style="overflow: visible">
    <a class="navbar-brand nav-top-logo" href="#" title='Cà phê Mê Trang'>
    <img width="160" height="130" src="logo3.jpg" class="" alt="Cà phê mê trang">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" ></span>

   </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
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
          <div class="dropdown-menu" style="z-index:1000" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="emp.php">Trang cá nhân2</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Đăng xuất</a>
          </div>
        </div>
      </ul>
    </div>
  </div>
  </nav>
</div> <!-- End Header -->
<?php $tongtienhientai=0;$thoigianbatdaungoi="10:37:04"; $timedatbatketiep="10:50:00";?>
<div class="container ">
  <div class="my-3 pl-4 pr-4 pt-2 bg-white rounded shadow-sm">
    <div class="row">
      <?php foreach ($ban as $banitem){ ?>
      <div class="<?php echo 'col-lg-3 p-2' ?>" >
        <div class="card mb1 shadow-sm hoverimage" style="width: 16rem ">
          <img class="card-img-top " style="transition-duration: 0.7s; height:260px;"src="<?php echo "images/ban/".$banitem['Hinhanh']?>"  alt="table picture" title="Order"  data-toggle="modal" data-target="#ban<?php echo $banitem['MaBan'] ?>">
          <div class="card-body">
            <?php if ($banitem['TinhTrangChoNgoi']=="Trống") $mautemp="green"; else $mautemp="#EE0000" ?>
            <h5 class="card-title" style="color:<?php echo $mautemp ?>"><b><?php echo $banitem['TinhTrangChoNgoi'] ?></b></h5>
            <p class="card-text" style="color:#3366CC"> <?php echo 'Tổng tiền hiện tại:'.$tongtienhientai ?> </p>
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-mute" style="color:secondary;">Bàn <?php echo $banitem['SizeBan'].' người. Bàn số '.$banitem['MaBan'].'.' ?><br>
                Time bắt đầu: <?php if($banitem['TinhTrangChoNgoi']) echo "0"; else echo $timedatbanketiep;?> <br>
                Time kế tiếp đặt: <?php echo $timedatbatketiep ?> <br>Tên KH: </p>
            </div>
              <div class="dropup">
  <button class="dropbtn" style="width:185px;background-color:#3399FF;color:white;border-radius: 5px; font-size:18px; ">Thao tác</button>
  <div class="dropup-content">
    <div class="dropup-conten-item"><a class="info-ban-title" style="color:red" href="#" >Thông tin chi tiết:</a></br>
    <h5 class="info-ban-item">Tên bàn: <?php echo $banitem['TenBan'] ?></h5>
    <h5 class="info-ban-item">Mã bàn: <?php echo $banitem['MaBan'] ?> </h5>
    </div  >
    <div class="dropup-conten-item">
    <button class="btn default" type="submit"><img src="icon/Sua-ban.png"width="35px" height="0px" style="" >Sửa bàn  </button>
    <button class="btn default" type="submit"><img src="icon/Xoa-ban.png" width="35px" height="0px">Xóa bàn  </button>
  </div>
  </div>
            </div>
<div class="modal fade" id="ban<?php echo $banitem['MaBan']; ?>" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" style="max-width:1112px; width:1112px;">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="modal-body " style="height:600px">
          <div class="container-fluid">
            <div class="row">
              	<div class="col-lg-7" style="height:580px;background-color:gray">
                  <div class="container mt-3">
                      <input class="form-control"  type="search" placeholder="Type to search Sản phẩm" id="searchbox">
                        <div class="row search-sanpham-range mt-3 ">
                          <div class="col-lg-4 pb-4" id="recipe-card1">
                            <div class="info-sanpham">
                              <img style="float:left;height:160px;overflow:hidden; transition-duration: 0.7s; "src="images/sanpham/capheden.jpg" width="100px" />
                              <h5 style=""><a href="">cà phê sữa</a><br> giá 1000đ; ?> <br></h5>
                            </div>
                          </div>
                          <div class="col-lg-4 pb-4" id="recipe-card1">
                            <div class="info-sanpham">
                              <img style="float:left;height:160px;overflow:hidden; transition-duration: 0.7s; "src="images/sanpham/caphedensaigon.jpg" width="100px" />
                              <h5 style=""><a href="">phê đen</a><br> giá 9900đ; ?> <br></h5>
                            </div>
                          </div>
                          <div class="col-lg-4 pb-4" id="recipe-card1">
                            <div class="info-sanpham">
                              <img style="float:left;height:160px;overflow:hidden; transition-duration: 0.7s; "src="images/sanpham/caphedensaigon.jpg" width="100px" />
                              <h5 style=""><a href="">Trà sữa</a><br> giá 15000đ; ?> <br></h5>
                            </div>
                          </div>
                        </div> <!-- End range search -->
                  </div>
                </div>
                <div class="col-lg-4 ml-auto" style="background-color:green">2
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

      </div><!-- End Card Body-->
    </div><!-- End Card>-->
      </div><!--Ground 1 item-->
  <?php } ?>


</div> <!--End 3-->
</div>
</div>
    </body>
</html>
