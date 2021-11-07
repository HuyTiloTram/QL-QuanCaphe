<?php
session_start();
include '../ketnoi.php';
include '../libs/all-1table.php';
include '../libs/getlimit-1condition.php';
include '../head1.php';
?>
<script>
$(document).ready(function() {
  <?php include '../animate1.php'; ?>//thêm animate

  //Animate: hiện dropdown-content2 khi click vào dropdown
  $(".dropdown2").click(function(){
    var $dropdown = $(this).find('.dropdown-content2');
    $dropdown.toggleClass('show');
  });

  //Animate: đóng dropdown khi click ngoài .dropbtn
  window.addEventListener('click', click_out1, false);
  function click_out1(event){
    if (!event.target.matches('.dropbtn')) {
     var dropdowns = document.getElementsByClassName('dropdown-content2');
     var i;
     for (i = 0; i < dropdowns.length; i++) {
       var openDropdown = dropdowns[i];
       if (openDropdown.classList.contains('show')) {
         openDropdown.classList.remove('show');
       }
     }
   }
  }

});
</script>
</head>
<body>

<header>
  <section id="navigation" class="st-navigation" style="overflow: visible">
    <script  class="willremove">
      // Thanh header-top navbar
      $.ajax({type: "POST", url: '../header-top.php',data:{Category:'Tổng quan'},success:function(result) {$('#navigation').append(result);}
      });
      // Thanh Modal-Mainmenu (khi lick vào icon danh mục)
      $.ajax({type: "POST", url: '../main-menu.php',data:{Mainmenu:'Tổng quan'},success:function(result) {$('#navigation').append(result);}
      });
    </script>
 </section>
</header>
<div class="Myground " id="myground" style="background-color:white" >
  <div class="row" >
	<div class="col-md-12" style="overflow:visible">
		<h3 class="dashboard-title">BÁO CÁO KẾT QUẢ BÁN HÀNG HÔM NAY</h3>
	</div><?php
  $tongtien1=0;
  $sql= "SELECT Tongtien FROM hoadon WHERE YEAR(NgayLap)=YEAR(now()) AND Status=0 AND MONTH(NgayLap)=MONTH(now()) AND DAY(NgayLap)=DAY(now()) ";$query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)>0){
    $hddtt=mysqli_num_rows($query);
    while ($hditem = mysqli_fetch_assoc($query)){$tongtien1+=$hditem['Tongtien'];}
  } else $hddtt=0;
  $tongtien2=0;
  $sql= "SELECT Tongtien FROM hoadon WHERE YEAR(NgayLap)=YEAR(now()) AND Status=1 AND MONTH(NgayLap)=MONTH(now()) AND DAY(NgayLap)=DAY(now()) ";$query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)>0){
    $hddpv=mysqli_num_rows($query);
    while ($hditem = mysqli_fetch_assoc($query)){$tongtien2+=$hditem['Tongtien'];}
  } else $hddpv=0;
  $tongtien3=3;
  $sql= "SELECT Tongtien FROM hoadon WHERE YEAR(NgayLap)=YEAR(now()) AND Status=0 AND MONTH(NgayLap)=MONTH(now()) AND DAY(NgayLap)=DAY(now())-1";$query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)>0){
    while ($hditem = mysqli_fetch_assoc($query)){$tongtien3+=$hditem['Tongtien'];}
  } else $tongtien3=0;
  $sql= "SELECT MaKH FROM hoadon WHERE YEAR(NgayLap)=YEAR(now()) AND MaKH!='' AND MONTH(NgayLap)=MONTH(now()) AND DAY(NgayLap)=Day(now())  GROUP BY MaKH";$query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)>0){$khachhanghomnay=mysqli_num_rows($query);} else $khachhanghomnay=0;
  $sql= "SELECT MaKH FROM hoadon WHERE MaKH!='' AND DAY(NgayLap)=Day(now())-1 GROUP BY MaKH";$query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)>0){$khachhanghomqua=mysqli_num_rows($query);} else $khachhanghomqua=0;
  $sql= "SELECT MaBan FROM ban WHERE Tinhtrang!='trống'";$query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)>0){$bandangsudung=mysqli_num_rows($query);} else $bandangsudung=0;
  $sql= "SELECT MaBan FROM ban WHERE Trangthai='Active'";$query=mysqli_query($conn,$sql);
  if(mysqli_num_rows($query)>0){$maxban=mysqli_num_rows($query);} else $maxban=0;
  ?>
	<div class="col-md-2">
		<div class="resport-box resport-blue">
			<div class="resport-icon">
        <i class="fas fa-dollar-sign" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
								<p><?php echo $hddtt;?> Hóa đơn đã thanh toán</p>
				<h4><?php echo number_format($tongtien1,0,"",","); ?> đ</h4>
				<span>Hôm qua <?php echo number_format($tongtien3,0,"",","); ?> đ</span>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="resport-box resport-green">
			<div class="resport-icon">
        <i class="fas fa-pencil-alt" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p><?php echo $hddpv;?> Hóa đơn đang phục vụ</p>
				<h4><?php echo number_format($tongtien2,0,"",","); ?> đ</h4>
				<span>Hôm qua <?php echo number_format($tongtien3,0,"",","); ?> đ</span>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="resport-box resport-red">
			<div class="resport-icon">
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>Khách hàng</p>
				<h4><?php echo $khachhanghomnay;?></h4>
				<span>Hôm qua <?php echo $khachhanghomnay;?></span>
			</div>
		</div>
	</div>
  <div class="col-md-2">
		<div class="resport-box resport-blue2">
			<div class="resport-icon">
        <i class="fa fa-crosshairs"  aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>Bàn đang sử dụng</p>
				<h4><?php echo $bandangsudung.'/'.$maxban; ?></h4>
			</div>
		</div>
	</div>
  <div class="col-md-2">
		<div class="resport-box resport-red2">
			<div class="resport-icon">
        <i class="fa fa-reply" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>Hủy /trả đồ</p>
				<h4>0</h4>
				<span>Hôm qua 0</span>
			</div>
		</div>
	</div>
  <div class="col-md-2">
		<div class="resport-box resport-pink">
			<div class="resport-icon">
        <i class="fa fa-address-card" aria-hidden="true"></i>
			</div>
			<div class="resport-data">
				<p>Ghi nợ</p>
				<h4>0</h4>
				<span>Hôm qua 0</span>
			</div>
		</div>
	</div>
  </div>
  <div class="col-lg-12">
                                <div class="main-box">
                                    <header class="main-box-header clearfix dashboard">
                                        <h2 class="pull-left ng-binding">Lịch sử hoạt động</h2>
                                        <div class="pull-right">
                                        </div>
                                    </header>
                                </div>
                            </div>
  </div>

  <!-- Modal-hinhanh -->
  <div id="Modal-hinhanh" temp-masp="" tabindex="-1" role="dialog" class="modal modal-xemanh" style="background: rgba(0, 0, 0,.88);z-index:9999;"  >
    <span class="close" data-dismiss="modal">&times;</span>
    <img class=" modal-content images"  src=""  />
    <div id="caption"> Modal Xem ảnh</div>
  </div><!-- end Modal-hinhanh-->
  <div class="alert-login p-1"></div>

</div><!-- end MyGround-->
<div class="myhide d-none"><input type="text" class="hide-input1"></input></div>
<div id="Script-hide-load" style="display:none"> </div>
<!-- Xóa Các thẻ script load html chỉ chạy 1 lần-->
<script> $('.willremove').remove(); </script>
</body>
</html>
