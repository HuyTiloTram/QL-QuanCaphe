<?php
session_start();
if (!isset($_SESSION['username'])){
  header("location: ../dangnhap.php");die;}
if ($_SESSION['level']!=1){
  header("location: ../index.php");die;}
include '../ketnoi.php';
include '../libs/all-1table.php';
include '../libs/get-1condition.php';
include '../libs/getlimit-1condition.php';
include '../head1.php';
?>
<script>
$(document).ready(function() {
  <?php include '../animate1.php'; ?>//thêm animate
  <?php include '../event-form-submit-noload.php'; ?> //thêm 2 event để form ko load lại trang

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

  //Gợi ý Tổng thanh toán (khi đang điền input lọc Tổng thanh toán)
  $("#myInput3").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    if (value=="") $('.btn-clear1').addClass('d-none');
    else{
      if( $('.btn-clear1').hasClass('d-none') ) $('.btn-clear1').removeClass('d-none');
    }
    $("#myDropdown3 div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

  // set value Tổng thanh toán vào input lọc Tổng thanh toán (khi đuợc chọn trong dropdown input)
  $(".get-text3").click(function(){
    var value = $(this).text();
    $("#myInput3").val(value);
    $("#myInput3").css("color", "#6495ED");
  });
  // set value giá sp vào input lọc giá sp (khi được chọn trong dropdown input)
  $(".get-text2").click(function(){
    var value = $(this).text();
    if (value.trim()=='Lựa chọn khác') $('.locngay').removeClass('d-none'); else $('.locngay').addClass('d-none');
    $("#myInput2").val(value);
    $("#myInput2").css("color", "#6495ED");
  });

  // Ẩn ngày khi nhấn OK
  $(".chossed").click(function(){
     $('.locngay').addClass('d-none');
  });

  // Tìm kiếm theo mã hd,mã kh, tên kh load vào table (khi click icon tìm kiếm)
  $(".btn-searchhd").click(function(){
    var searchhd = $('.input-searchhd').val();
    var sql = "SELECT h.MaHD,k.TenKH,h.NgayLap,h.Tien,h.Giamgia,h.Tongtien,h.Status FROM hoadon as h, khachhang as k  WHERE h.MaHD LIKE'%"+searchhd+"%' OR k.MaKH LIKE '%"+searchhd+"%' OR k.TenKH LIKE '%"+searchhd+"%' GROUP BY h.hoadon_id DESC" ;
    $.ajax({type: "POST", url: 'search_table_hoadon.php',data:{searchhd:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_hoadon').html(result);}
    });
    var count = "SELECT h.MaHD FROM hoadon as h, khachhang as k  WHERE h.MaHD LIKE'%"+searchhd+"%' OR k.MaKH LIKE '%"+searchhd+"%' OR k.TenKH LIKE '%"+searchhd+"%' GROUP BY h.MaHD" ;
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:count},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  // Lọc Tìm kiếm theo mã, tên , username  nếu có + theo Tổng thanh toán nếu có +  load vào table + Đếm và load số trang (khi click Lọc)
  $(".btn-loc").click(function(){
    var search= $('.input-searchhd').val();
    var ngay= $('#myInput2').val();ngay=ngay.trim();
    var tongthanhtoan= $('#myInput3').val();
    var where='';
    if (search!='') {search = "h.MaHD LIKE'%"+search+"%' OR k.MaKH LIKE '%"+search+"%' OR k.TenKH LIKE '%"+search+"%'" ; where+=search;}
    if ( (tongthanhtoan=='Tất cả tổng thanh toán') || (tongthanhtoan=='') ) tongthanhtoan='';
    else {tongthanhtoan="Tongtien"+tongthanhtoan; if(where=='') where+=tongthanhtoan; else where+=' AND '+tongthanhtoan; }
    if ( (ngay=='Tất cả các ngày') || (ngay=='') ) ngay='';
    else {
      switch(ngay) {
        case 'Hôm qua':
          ngay = 'DAY(h.NgayLap) = DAY(now())-1 AND MONTH(h.NgayLap) = MONTH(now()) AND YEAR(h.NgayLap) =YEAR(now())';break;
        case 'Hôm nay':
          ngay = 'DAY(h.NgayLap) = DAY(now()) AND MONTH(h.NgayLap) = MONTH(now()) AND YEAR(h.NgayLap) =YEAR(now())';break;
        case 'Lựa chọn khác':
          if ( ($('#inputday1').val()=='')|| ($('#inputday2').val()=='') ) {alert('Bạn chưa chọn ngày'); return ;}
          ngay = ' h.NgayLap BETWEEN '+$('#inputday1').val()+' AND '+$('#inputday2').val();break;
        case 'Tuần trước':
          $.ajax({type: "POST", url: 'math-date.php',data:{Finddate:'Tuantruoc'},async:false,success:function(result) {ngay=result;}
          });break;
        case 'Tuần này':
          $.ajax({type: "POST", url: 'math-date.php',data:{Finddate:'Tuannay'},async:false,success:function(result) {ngay=result;}
          });break;
        case 'Tháng trước':
          ngay = 'MONTH(h.NgayLap) = MONTH(now())-1 AND YEAR(h.NgayLap) =YEAR(now())';break;
        case 'Tháng này':
          ngay = 'MONTH(h.NgayLap) = MONTH(now()) AND YEAR(h.NgayLap) =YEAR(now())';break;
        default:
        ngay = '';
      }
      if(where=='') where+=ngay; else where+=' AND '+ngay;
    }
    if(where!='') where='WHERE '+where;
    var sql='SELECT h.MaHD,k.TenKH,h.NgayLap,h.Tien,h.Giamgia,h.Tongtien,h.Status FROM hoadon as h, khachhang as k '+where+' GROUP BY h.hoadon_id DESC';
    alert(sql);
    $.ajax({type: "POST", url: 'search_table_hoadon.php',data:{searchhd:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_hoadon').html(result);}
    });
    var count='SELECT h.MaHD FROM hoadon as h, khachhang as k '+where+' GROUP BY h.MaHD';
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:count},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  // Delete by MaHD in DATABASE + Thông báo (khi click xác nhận Xóa)
  $(".Delete-hoadon").click(function(){
    var mahdhientai= $('#Modal-delete').attr('temp-mahd');
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'chitiethoadon',condition1:"MaHD ='"+mahdhientai+"'"},success:function(result) {;}
    });
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'hoadon',condition1:"MaHD ='"+mahdhientai+"'"},success:function(result)
     {$('.alert-login').html('<h3 class="success1">Xóa hóa đơn thành công</h3>').fadeIn().delay(1500).fadeOut('slow').css('background-color','none');
     setTimeout('$(".alert-login h3").remove()',1500);
    $("tbody#tbody_hoadon tr").each(function() {
      if($(this).attr('temp-mahd')==mahdhientai) {$(this).remove();return ;}
    });
  	 }
    });
  });

  event_click1();
  function event_click1(){
    //Animate Toggle + load xem chi tiết hóa đơn (khi click vào các dòng đầu table hóa đơn)
    $('body').on('click', '.toggle-inforhd', function(){
      var mahdhientai= $(this).parent('.tr-content').attr('temp-mahd');
      var dropdownhientai= '#hoadon'+mahdhientai;
      $.ajax({type: "POST", url: 'load_chitiet_hoadon.php',data:{MaHD:mahdhientai},success:function(result) {$(dropdownhientai).html(result);}
      });
      $(dropdownhientai).toggleClass('d-none');
    });

    //Lưu tạm mã hd bạn chọn vào Modal-delete (khi click Xóa or icon thùng rác)
    $('body').on('click', '.getdelete-mahd', function () {
			var mahd =$(this).attr('tempdata-mahd');
			$("#Modal-delete").attr('temp-mahd',mahd);
    });

    //Ẩn thẻ thông báo update + load thông tin món vào #Modal-update + set nút not today(khi click icon edit)
    $('body').on('click', '.btn-suahd', function () {
      $('.Thongbao-update').addClass('d-none');
      var mahdhientai = $(this).attr("temp-mahd");
    });

    //Chuyển sang trang bạn chọn (khi click trang)
    $('body').on('click', '.change-page', function () {
      var number = $(this).text();
      number =new Number(number);number=(number-1)*20;
      limit=number+',20';
      var search= $('.input-searchhd').val();
      var ngay= $('#myInput2').val();ngay=ngay.trim();
      var tongthanhtoan= $('#myInput3').val();
      var where='';
      if (search!='') {search = "h.MaHD LIKE'%"+search+"%' OR k.MaKH LIKE '%"+search+"%' OR k.TenKH LIKE '%"+search+"%'" ; where+=search;}
      if ( (tongthanhtoan=='Tất cả tổng thanh toán') || (tongthanhtoan=='') ) tongthanhtoan='';
      else {tongthanhtoan="Tongtien"+tongthanhtoan; if(where=='') where+=tongthanhtoan; else where+=' AND '+tongthanhtoan; }
      if ( (ngay=='Tất cả các ngày') || (ngay=='') ) ngay='';
      else {
        switch(ngay) {
          case 'Hôm qua':
            ngay = 'DAY(h.NgayLap) = DAY(now())-1 AND MONTH(h.NgayLap) = MONTH(now()) AND YEAR(h.NgayLap) =YEAR(now())';break;
          case 'Hôm nay':
            ngay = 'DAY(h.NgayLap) = DAY(now()) AND MONTH(h.NgayLap) = MONTH(now()) AND YEAR(h.NgayLap) =YEAR(now())';break;
          case 'Lựa chọn khác':
            if ( ($('#inputday1').val()=='')|| ($('#inputday2').val()=='') ) {alert('Bạn chưa chọn ngày'); return ;}
            ngay = ' h.NgayLap BETWEEN '+$('#inputday1').val()+' AND '+$('#inputday2').val();break;
          case 'Tuần trước':
            $.ajax({type: "POST", url: 'math-date.php',data:{Finddate:'Tuantruoc'},async:false,success:function(result) {ngay=result;}
            });break;
          case 'Tuần này':
            $.ajax({type: "POST", url: 'math-date.php',data:{Finddate:'Tuannay'},async:false,success:function(result) {ngay=result;}
            });break;
          case 'Tháng trước':
            ngay = 'MONTH(h.NgayLap) = MONTH(now())-1 AND YEAR(h.NgayLap) =YEAR(now())';break;
          case 'Tháng này':
            ngay = 'MONTH(h.NgayLap) = MONTH(now()) AND YEAR(h.NgayLap) =YEAR(now())';break;
          default:
          ngay = '';
        }
        if(where=='') where+=ngay; else where+=' AND '+ngay;
      }
      if(where!='') where='WHERE '+where;
      var sql='SELECT h.MaHD,k.TenKH,h.NgayLap,h.Tien,h.Giamgia,h.Tongtien,h.Status FROM hoadon as h, khachhang as k '+where+' GROUP BY h.hoadon_id DESC';
      $.ajax({type: "POST", url: 'search_table_hoadon.php',data:{searchhd:sql,limit:limit,stt:number},success:function(result) {$('tbody#tbody_hoadon').html(result);}
      });
      $('.pagination .page-item').removeClass('page-active');
      $(this).parent('.page-item').addClass('page-active');
    });
  }
});
</script>
</head>
<body>
<header>
  <section id="navigation" class="st-navigation" style="overflow: visible">
    <script  class="willremove">
      // Thanh header-top navbar
      $.ajax({type: "POST", url: '../header-top.php',data:{Category:'Hóa đơn'},success:function(result) {$('#navigation').append(result);}
      });
      // Thanh Modal-Mainmenu (khi lick vào icon danh mục)
      $.ajax({type: "POST", url: '../main-menu.php',data:{Mainmenu:'Hóa đơn'},success:function(result) {$('#navigation').append(result);}
      });
    </script>
 </section>
</header>
<div class="Myground " id="myground" style="background-color:white" >
  <!-- Thanh menu con bên trái -->
  <div class="sidebar__container float-left active" style="float:left;padding:0;"></div>
  <script class="willremove">
    // load thanh menu con bên trái
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Hóa đơn'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>
  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    <div class="action-bar__container action-bar-border">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mr-3 action-bar__title ml-3">Hóa đơn</h3>
        <div class="flex-1">
          <div class="d-flex">
            <form >
              <div class="input-group ">
                <input type="text" placeholder="Tìm kiếm Mã HD, Tên KH, " class="form-control input-searchhd ">
                <div class="input-group-append "><span class="btn-searchhd cursor-pointer input-group-text" style="background:#3366FF;" ><i style="color:#fff" class="fas fa-search"></i></span>
                </div>
              </div>
            </form>
            <div class="border rounded d-flex ml-3">
              <div class="border-0 py-0 select-on-list kit-select__container input-box d-flex" name="city_name" placeholder="Chọn thành phố">
                <div class="kit-select d-flex align-items-center">
                  <div class="tags d-flex align-items-center justify-content-between " >
                    <div class="locngay d-none">
                      <input id="inputday1" type="text"  placeholder="Từ ngày" onclick="(this.type='date')" class="input-select border-0 dropbtn">
                      <input id="inputday2" type="text"  placeholder="Đến ngày" onclick="(this.type='date')" class="input-select border-0 dropbtn mt-1">
                      <button class="btn btn-primary chossed">OK</button>
                    </div>
                    <div class="dropdown2">
                      <input type="text" id="myInput2" placeholder="Chọn ngày" class="input-select border-0 dropbtn"/><i class="fas fa-caret-down text-link-blue dropbtn"></i>

                      <div class="dropdown-content2" style="z-index: 100;">
                        <div class=" text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tất cả các ngày</p></div>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Hôm nay </p></div>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Hôm qua </p></div>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Lựa chọn khác </p></div>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tuần này </p></div>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tuần trước </p></div>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tháng này </p></div>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tháng trước </p></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="border rounded d-flex ml-3">
              <div class="border-0 py-0 select-on-list kit-select__container input-box d-flex" name="city_name" placeholder="Chọn nhóm món">
                <div class="kit-select d-flex align-items-center">
                  <div class="tags d-flex align-items-center justify-content-between " >
                    <div class="dropdown2">
                      <input type="text" id="myInput3" placeholder="Chọn tổng thanh toán" class="input-select border-0 dropbtn" /><button class="border-0 hover-blue btn-clear1 d-none" onclick="document.getElementById('myInput3').value = '';$('#myInput3').keyup(); ">x</button><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div id="myDropdown3" class="dropdown-content2" style="z-index:100">
                        <div class="text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text3 ">Tất cả tổng thanh toán </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text3 "><=0</p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text3 ">>0</p></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="border rounded d-flex ml-3" ><button class="custom-btn btn-13 btn-loc" style="width:100px">Lọc</button></div>
          </div>
        </div>
        <div class="ml-auto mr-2 navbar p-0 m-0">
          <div class="dropdown">
            <button type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-blue dropdown-toggle">  Tiện ích</button>
            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-item cursor-pointer"><i class="fas fa-upload mr-2 p-1"></i>Thêm hóa đơn từ file</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-file-export mr-2 p-1"></i> Xuất danh sách hóa đơn</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sort-alpha-down mr-2 p-1"></i> Sắp xếp hóa đơn</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sync-alt mr-2 p-1"></i> Đồng bộ hóa đơn</div>
            </div>
          </div>
        </div>
        <a href="../pos" target="_blank"><button class="custom-btn2 btn-7 btn-themhd " data-toggle="modal" data-target="#Modal-insert">  Thêm HD</button></a>
      </div>
    </div>
  </div><!-- end thanh chức năng -->
  <!-- Ground chứa Table -->
  <div class="container-fluid" >
    <div class="row">
      <div class="col-12 list-view__table" style="min-height:75vh;">
        <table class="table mytable list-view__table hover-table-1" role="treegrid">
          <thead class="thead-light">
            <tr>
              <th style="width: 1%;">#</th>
              <th style="width: 12%;">Mã hóa đơn</th>
              <th style="width: 21%;">Tên khách hàng</th>
              <th style="width: 20%;"class="text-center">Ngày bán</th>
              <th style="width: 12%;"class="text-right">Tổng cộng<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 10%;"class="text-right">Giảm giá</th>
              <th style="width: 14%;"class="text-right">Tổng thanh toán</th>
              <th style="width: 18%;"class="text-center">Tình trạng</th>
              <th style="width: 10%;"class="text-nowrap">Thao tác</th>
            </tr>
          </thead>
          <tbody id="tbody_hoadon" class="border-bottom mysearch1" role="rowgroup">
    <?php function find_tenkh($find,$arr){ foreach($arr as $arritem){if($arritem['MaKH']==$find) return $arritem['TenKH']; }; }
        $khachhang=get_1condition('khachhang','MaKH,TenKH','1');
        $hoadon=getlimit_1condition('hoadon',20,1,'1 ORDER BY hoadon_id DESC');$stt=0;
        foreach ($hoadon as $hoadonitem){ ?>
            <tr id="tr-hoadon<?php echo $hoadonitem['MaHD']; ?>" temp-mahd="<?php echo $hoadonitem['MaHD']; ?>" class="tr-content ">
              <td class="toggle-inforhd "><?php $stt++; echo $stt; ?></td>
              <td class="toggle-inforhd cldt-mahd"><?php echo $hoadonitem['MaHD']; ?> </td>
              <td class="toggle-inforhd cldt-tenkh"><?php echo find_tenkh($hoadonitem['MaKH'],$khachhang); ?></td>
              <td class="toggle-inforhd text-center cldt-gioitinh"><?php echo $hoadonitem['NgayLap']; ?></td>
              <td  class="toggle-inforhd cldt-hoadon text-right"><?php echo number_format($hoadonitem['Tien'],0,"",","); ?></td>
              <td class="toggle-inforhd cldt-username text-right"><?php echo number_format($hoadonitem['Giamgia'],0,"",","); ?></td>
              <td class="toggle-inforhd cldt-username text-right"><?php echo number_format($hoadonitem['Tongtien'],0,"",","); ?></td>
              <td class="toggle-inforhd cldt-tinhtrang text-center <?php if($hoadonitem['Status']==0) echo 'color1'; else echo 'color2'; ?>"><?php if($hoadonitem['Status']==0) echo 'Đã Hoàn thành'; else echo 'Chưa Hoàn thành'; ?></td>
              <td>
                <form action="../pos/" method="post" enctype="multipart/form-data"  target="_blank">
                  <button style="border:none;padding:0px;background:none;"><img temp-manv="<?php echo $hoadonitem['MaHD']; ?>" class="mr-2 cursor-pointer btn-suahd" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/>
                  </button>
                  <i class="fas fa-trash-alt cursor-pointer getdelete-mahd" tempdata-mahd="<?php echo $hoadonitem['MaHD']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
                <input class="d-none" type="text" name="Mahd" value="<?php echo $hoadonitem['MaHD']; ?>">
                </form>

              </td>
            </tr>
            <tr class="detail-hoadon d-none" id="hoadon<?php echo $hoadonitem['MaHD']; ?>"></tr>
  <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- Số Trang-->
      <nav class="page-fixed">
        <script class="willremove">
          // load số trang
          $.ajax({type: "POST", url: '../count_page.php',data:{Sql:'SELECT MaHD FROM hoadon LIMIT 500'},success:function(result) {$('.page-fixed').html(result);}
          });
        </script>
      </nav>
    </div>
  </div><!-- end Ground chứa table-->

  <!--Modal-delete -->
  <div id="Modal-delete" temp-mahd="" role="dialog" class="modal fade kit-modal__container place-modal-center" style="background: rgba(0, 0, 0,.45);"  >
    <div role="document" class="modal-dialog modal-md mt-5">
      <div class="modal-content"><!---->
        <div class="modal-body" style="max-height: 100%;">
          <p class="text-center mx-auto">Bạn có muốn xoá ? </p>
          <div class="d-flex justify-content-betweeen">
            <button class="btn btn-outline-dark"  data-dismiss="modal">  Huỷ</button>
            <div class="ml-auto">
              <button class="btn btn-danger2 Delete-hoadon" data-dismiss="modal">Xoá
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end Modal-delete -->

  <div class="alert-login p-1"></div>
</div><!-- end MyGround-->
<div id="Script-hide-load" style="display:none"> </div>
<!-- Xóa Các thẻ script load html chỉ chạy 1 lần-->
<script> $('.willremove').remove(); </script>
</body>
</html>
