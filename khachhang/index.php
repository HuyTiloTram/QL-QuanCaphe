<?php
session_start();
if (!isset($_SESSION['username'])){
  header("location: ../dangnhap.php");die;}
if ($_SESSION['level']!=1){
  header("location: ../index.php");die;}
include '../ketnoi.php';
include '../libs/all-1table.php';
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

  // set value cấp vip vào input lọc cấp vip (khi đuợc chọn trong dropdown input)
  $(".get-text2").click(function(){
    var value = $(this).text();
    $("#myInput2").val(value);
    $("#myInput2").css("color", "#6495ED");
  });
  // set value giới tính vào input lọc giới tính (khi được chọn trong dropdown input)
  $(".get-text3").click(function(){
    var value = $(this).text();
    $("#myInput3").val(value);
    $("#myInput3").css("color", "#6495ED");
  });
  // set value dư nợ vào input lọc dư nợ (khi đuợc chọn trong dropdown input)
  $(".get-text4").click(function(){
    var value = $(this).text();
    $("#myInput4").val(value);
    $("#myInput4").css("color", "#6495ED");
  });
  $(".get-text5").click(function(){
    var value = $(this).text();
    $("#myInput5").val(value);
    $("#myInput5").css("color", "#6495ED");
  });

  // Tìm kiếm theo mã, tên, username khách hàng load vào table (khi click icon tìm kiếm)
  $(".btn-searchkh").click(function(){
    var searchkh = $('.input-searchkh').val();
    var sql = "SELECT * FROM khachhang WHERE MaKH LIKE'%"+searchkh+"%' OR TenKH LIKE '%"+searchkh+"%' OR Username LIKE '%"+searchkh+"%'" ;
    $.ajax({type: "POST", url: 'search_table_khachhang.php',data:{searchkh:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_khachhang').html(result);}
    });
    var count = "SELECT MaKH FROM khachhang WHERE MaKH LIKE'%"+searchkh+"%' OR TenKH LIKE '%"+searchkh+"%' OR Username LIKE '%"+searchkh+"%'" ;
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:count},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  // Lọc Tìm kiếm theo mã, tên , username  nếu có + theo cấp vip nếu có +  load vào table + Đếm và load số trang (khi click Lọc)
  $(".btn-loc").click(function(){
    var search= $('.input-searchkh').val();
    var capdo= $('#myInput2').val();
    var gioitinh= $('#myInput3').val();
    var duno= $('#myInput4').val();
    var diemthuong= $('#myInput5').val();
    var where='';
    if (search!='') {search= "(MaKH LIKE'%"+search+"%' OR TenKH LIKE '%"+search+"%' OR Username LIKE '%"+search+"%')"; where+=search;}
    if ( (capdo.trim()=='Tất cả cấp vip') || (capdo=='') ) capdo='';
    else {capdo='Capdo='+capdo; if(where=='') where+=capdo; else where+=' AND '+capdo; }
    if ( (gioitinh.trim()=='Tất cả giới tính') || (gioitinh=='') ) gioitinh='';
    else {gioitinh="Gioitinh='"+gioitinh+"'"; if(where=='') where+=gioitinh; else where+=' AND '+gioitinh; }
    if ( (duno.trim()=='Tất cả dư nợ') || (duno=='') ) duno='';
    else {duno='Duno'+duno; if(where=='') where+=duno; else where+=' AND '+duno; }
    if ( (diemthuong.trim()=='Tất cả điểm thưởng') || (diemthuong=='') ) diemthuong='';
    else {diemthuong='Diemthuong'+diemthuong; if(where=='') where+=diemthuong; else where+=' AND '+diemthuong; }
    if(where=='') where=1;
    var sql= 'SELECT * FROM khachhang WHERE '+where;
    $.ajax({type: "POST", url: 'search_table_khachhang.php',data:{searchkh:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_khachhang').html(result);}
    });
    var count='SELECT MaKH FROM khahhang WHERE '+where;
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:count},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  // Delete by MaKH in DATABASE + Xóa ảnh trên host + Xóa dòng đó trên table + Thông báo (khi click xác nhận Xóa)
  $(".Delete-khachhang").click(function(){
    var makhhientai= $('#Modal-delete').attr('temp-makh');
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'khachhang',condition1:"MaKh ='"+makhhientai+"'",img:'Avatar',diachi:'../images/khachhang/'},success:function(result)
     {$('.alert-login').html('<h3 class="success1">Xóa khách hàng thành công</h3>').fadeIn().delay(1500).fadeOut('slow').css('background-color','none');
     setTimeout('$(".alert-login h3").remove()',1500);
    $("tbody#tbody_khachhang tr").each(function() {
      if($(this).attr('temp-makh')==makhhientai) {$(this).remove();return ;}
    });
  	 }
    });
  });

  // ẨN thẻ thông báo form (khi click thêm khách hàng)
  $(".btn-themkh").click(function(){
      $('.Thongbao-insert').addClass('d-none');
  });
  var called = 1;
  event_click1();
  function event_click1(){

    //Animate Toggle + load xem chi tiết khách hàng (khi click vào các dòng đầu table khách hàng)
    $('body').on('click', '.toggle-inforkh', function(){
      var makhhientai= $(this).parent('.tr-content').attr('temp-makh');
      var dropdownhientai= '#khachhang'+makhhientai;
      $.ajax({type: "POST", url: 'load_chitiet_khachhang.php',data:{MaKH:makhhientai},success:function(result) {$(dropdownhientai).html(result);}
      });
      $(dropdownhientai).toggleClass('d-none');
    });

    //Animate change trạng thái + Update trạng thái by MaKH in DATABASE (khi click icon tình trạng)
    $('body').on('click', '.jquery-switch', function (){ if(called==1){
    var makh= $(this).attr('temp-makh');
    var trangthai= $(this).find('.update-trangthai').text();
    if (trangthai.trim()== "Active") trangthai="Deactive"; else trangthai="Active";
    var coreswitch = $(this).find('.v-switch-core');
    var animateswitch = coreswitch.find('.v-switch-button');
    var textswitch = $(this).find('.v-switch-label');
    if ($(this).hasClass('toggled')){
      $(this).removeClass('toggled');
      textswitch.text("Deactive");
      textswitch.removeClass("v-left");
      textswitch.addClass("v-right");
      animateswitch.css("transform","translate3d(3px, 3px, 0px)");
    }
    else{
      $(this).addClass('toggled')
      textswitch.text("Active");
      textswitch.removeClass("v-right");
      textswitch.addClass("v-left");
      animateswitch.css("transform","translate3d(47px, 3px, 0px)");
    }
    $.ajax({type: "POST", url: '../update_trangthai.php',data:{table:'khachhang',obj1:'MaKH',newTrangthai:"'"+trangthai+"'",condition1:"MaKH= '"+makh+"'"},success:function(result) {
      $('.alert-login').append(result).fadeIn().delay(1200).fadeOut().css('background-color','none');setTimeout('$(".alert-login h3").remove()',5200);
    	 }
    });;
    called++;}else {called=1; return ;}
    });

    //Lưu tạm mã kh bạn chọn vào Modal-delete (khi click Xóa or icon thùng rác)
    $('body').on('click', '.getdelete-makh', function () {
			var makh =$(this).attr('tempdata-makh');
			$("#Modal-delete").attr('temp-makh',makh);
    });

    //Ẩn thẻ thông báo update + load thông tin khách hàng vào #Modal-update + set nút not today (khi click icon edit)
    $('body').on('click', '.btn-suakh', function () {
      $('.Thongbao-update').addClass('d-none');
      var makhhientai = $(this).attr("temp-makh");
      $.ajax({type: "POST", url: 'load_edit_khachhang.php',data:{MaKH:makhhientai},success:function(result) {$('#Script-hide-load').html(result);}
      });
      $('.btn-today').text('Not Today');$('.btn-today').addClass('nottoday');$('.value-btn-today').val('nottoday');$('.cldt-password').val('');
    });

    //load ảnh vào img trong #Modal-hinhanh (khi click vào hình ảnh khách hàng)
    $('body').on('click', '.cldt-hinhanh', function () {
      var hinhanh = $(this).attr('src');
      $('#Modal-hinhanh .images').attr('src',hinhanh);
    });

    //Chuyển sang trang bạn chọn (khi click trang)
    $('body').on('click', '.change-page', function () {
      var number = $(this).text();
      number =new Number(number);number=(number-1)*20;
      limit=number+',20';
      var search= $('.input-searchkh').val();
      var capdo= $('#myInput2').val();
      var gioitinh= $('#myInput3').val();
      var duno= $('#myInput4').val();
      var diemthuong= $('#myInput5').val();
      var where='';
      if (search!='') {search= "SELECT * FROM khachhang WHERE MaKH LIKE'%"+searchkh+"%' OR TenKH LIKE '%"+searchkh+"%' OR Username LIKE '%"+searchkh+"%'"; where+=search;}
      if ( (capdo.trim()=='Tất cả cấp độ') || (capdo=='') ) capdo='';
      else {capdo="Capdo='"+capdo+"'"; if(where=='') where+=capdo; else where+=' AND '+capdo; }
      if ( (gioitinh.trim()=='Tất cả giới tính') || (gioitinh=='') ) gioitinh='';
      else {gioitinh="Gioitinh='"+gioitinh+"'"; if(where=='') where+=gioitinh; else where+=' AND '+gioitinh; }
      if ( (duno.trim()=='Tất cả dư nợ') || (duno=='') ) duno='';
      else {duno="Duno='"+duno+"'"; if(where=='') where+=duno; else where+=' AND '+duno; }
      if ( (diemthuong.trim()=='Tất cả điểm thưởng') || (diemthuong=='') ) diemthuong='';
      else {diemthuong="Diemthuong='"+diemthuong+"'"; if(where=='') where+=diemthuong; else where+=' AND '+diemthuong; }
      if(where=='') where=1;
      var sql= 'SELECT * FROM khachhang WHERE '+where;
      $.ajax({type: "POST", url: 'search_table_khachhang.php',data:{searchkh:sql,limit:limit,stt:number},success:function(result) {$('tbody#tbody_khachhang').html(result);}
      });
      $('.pagination .page-item').removeClass('page-active');
      $(this).parent('.page-item').addClass('page-active');
    });
  }

  // mở cho phép nhập input ngày tạo + lưu sự lựa chọn vào input ẩn  (khi click Today)
  $(".btn-today").click(function(){
    var today=$(this);var value=$('.value-btn-today');var inputblock=$('.input-ngaytao');
      if(today.text().trim()=='Today') { today.text('Not Today');today.addClass('nottoday');value.val('nottoday');inputblock.attr('readonly', false);}
      else {today.html('<i class="fas fa-check mr-1"></i>Today');today.removeClass('nottoday');value.val('today');inputblock.attr('readonly', true);inputblock.val('');}
  });

  //Animate Ẩn hiện password
  $(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
  });

});
</script>
</head>
<body>

<header>
  <section id="navigation" class="st-navigation" style="overflow: visible">
    <script  class="willremove">
      // Thanh header-top navbar
      $.ajax({type: "POST", url: '../header-top.php',data:{Category:'Khách hàng'},success:function(result) {$('#navigation').append(result);}
      });
      // Thanh Modal-Mainmenu (khi lick vào icon danh mục)
      $.ajax({type: "POST", url: '../main-menu.php',data:{Mainmenu:'Khách hàng'},success:function(result) {$('#navigation').append(result);}
      });
    </script>
 </section>
</header>
<div class="Myground " id="myground" style="background-color:white;" >
  <!-- Thanh menu con bên trái -->
  <div class="sidebar__container float-left active" style="float:left"></div>
  <script class="willremove">
    // load thanh menu con bên trái
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Khách hàng'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>


  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    <div class="action-bar__container action-bar-border">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mr-3 ml-3">Khách hàng</h3>
        <div class="flex-1">
          <div class="d-flex">
            <form >
              <div class="input-group ">
                <input type="text" placeholder="Tìm kiếm mã, tên, username khách khàng" class="form-control input-searchkh ">
                <div class="input-group-append "><span class="btn-searchkh cursor-pointer input-group-text" style="background:#3366FF;" ><i style="color:#fff" class="fas fa-search"></i></span>
                </div>
              </div>
            </form>
            <div class="border rounded d-flex ml-3">
              <div class="border-0 py-0 select-on-list kit-select__container input-box d-flex" name="city_name" placeholder="Chọn thành phố" >
                <div class="d-flex align-items-center" >
                  <div class="tags d-flex align-items-center justify-content-between " >
                    <div class="dropdown2">
                      <input style="width:50px" type="text" id="myInput2" placeholder="Cấp độ" class="input-select border-0 dropbtn"><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div class="dropdown-content2" style="z-index: 100;">
                        <div class=" text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tất cả cấp vip</p></div>
                        <?php for($i=0;$i<9;$i++){ ?>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 "><?php echo $i; ?> </p></div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="border rounded d-flex ml-3" >
              <div class="border-0 py-0 select-on-list kit-select__container input-box d-flex" name="city_name" placeholder="Chọn nhóm món">
                <div class="kit-select d-flex align-items-center">
                  <div class="tags d-flex align-items-center justify-content-between " >
                    <div class="dropdown2">
                      <input style="width:58px" type="text" id="myInput3" placeholder="Giới tính" class="input-select border-0 dropbtn" /><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div id="myDropdown3" class="dropdown-content2" style="z-index:100">
                        <div class="text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text3 ">Tất cả giới tính </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text3 ">Nam</p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text3 ">Nữ</p></div>
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
                      <input style="width:90px" type="text" id="myInput4" placeholder="Dư nợ" class="input-select border-0 dropbtn" /><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div id="myDropdown4" class="dropdown-content2" style="z-index:100">
                        <div class="text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text4 ">Tất cả dư nợ </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text4 ">>0</p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text4 "><=-1</p></div>
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
                      <input style="width:90px" type="text" id="myInput5" placeholder="Điểm thưởng" class="input-select border-0 dropbtn" /><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div id="myDropdown5" class="dropdown-content2" style="z-index:100">
                        <div class="text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text5 ">Tất cả điểm thưởng</p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text5 ">>100</p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text5"> <100 </p></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="border rounded d-flex ml-3" >
                    <button class="custom-btn btn-13 btn-loc" style="width:100px">Lọc</button>
            </div>
          </div>
        </div>
        <div class="ml-auto mr-2 navbar p-0 m-0">
          <div class="dropdown" style="width:60px;">
            <button type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-blue dropdown-toggle">  Tiện ích</button>
            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-item cursor-pointer"><i class="fas fa-upload mr-2 p-1"></i>Thêm khách hàng từ file</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-file-export mr-2 p-1"></i> Xuất danh sách khách hàng</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sort-alpha-down mr-2 p-1"></i> Sắp xếp khách hàng</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sync-alt mr-2 p-1"></i> Đồng bộ khách hàng</div>
            </div>
          </div>
        </div>
        <button class="custom-btn2 btn-7 btn-themkh " style="width:150px" data-toggle="modal" data-target="#Modal-insert">  Thêm Khách hàng</button>
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
              <th style="width: 20px;">#</th>
              <th style="width: 10%;">Mã khách hàng</th>
              <th style="width: 10%;">Avatar</th>
              <th style="width: 35%;">Tên khách hàng</th>
              <th style="width: 10%;"class="text-left">Username</th>
              <th style="width: 5%;white-space: nowrap">Cấp độ<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 10%;white-space: nowrap" class="text-right">Tổng giao dịch</th>
              <th style="width: 10%;white-space: nowrap" class="text-right">Điểm thưởng</th>
              <th style="width: 10%;white-space: nowrap" class="text-right">Dư nợ</th>
              <th style=" width: 17%;z-index: 3;"class="text-left">
                <div class="d-flex ">
                  <div class=" text-left cursor-pointer d-flex align-items-center">Thao tác <i class="fas fa-sort ml-1"></i></div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody id="tbody_khachhang" class="border-bottom mysearch1" role="rowgroup">
    <?php $khachhang=getlimit_1condition('khachhang',20,1,'1');$stt=0;
        foreach ($khachhang as $khachhangitem){ ?>
            <tr id="tr-khachhang<?php echo $khachhangitem['MaKH']; ?>" temp-makh="<?php echo $khachhangitem['MaKH']; ?>" class="tr-content ">
              <td class="toggle-inforkh "><?php $stt++; echo $stt; ?></td>
              <td class="toggle-inforkh cldt-makh"><p style="width: 140px;word-wrap:break-word" ><?php echo $khachhangitem['MaKH']; ?></p> </td>
              <td class=" imgtable1-ground "><img  class="cldt-hinhanh" src="../images/khachhang/<?php echo $khachhangitem['Avatar']; ?>"  data-toggle="modal" data-target="#Modal-hinhanh"/></td>
              <td class="toggle-inforkh cldt-tenkh"><?php echo $khachhangitem['TenKH']; ?></td>
              <td class="toggle-inforkh cldt-username"><?php echo $khachhangitem['Username']; ?></td>
              <td class="toggle-inforkh cldt-chucvu text-center"><?php echo $khachhangitem['Capdo']; ?></td>
              <td class="toggle-inforkh cldt-tonggiaodich text-right"><?php echo number_format($khachhangitem['Tonggiaodich'],0,"",","); ?></td>
              <td class="toggle-inforkh cldt-diemthuong text-right"><?php echo number_format($khachhangitem['Diemthuong'],0,"",","); ?></td>
              <td class="toggle-inforkh cldt-duno text-right"><?php echo number_format($khachhangitem['Duno'],0,"",","); ?></td>
              <td class="text-left">
                <label temp-makh="<?php echo $khachhangitem['MaKH']; ?>" class="jquery-switch <?php if($khachhangitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
                  <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
                    <div  class="v-switch-button" <?php if($khachhangitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
                    </div>
                  </div>
                  <span class="v-switch-label cldt-trangthai update-trangthai <?php if($khachhangitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $khachhangitem['Trangthai']; ?>
                  </span>
                </label>
                <img temp-makh="<?php echo $khachhangitem['MaKH']; ?>" class="mr-2 cursor-pointer btn-suakh" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-makh" tempdata-makh="<?php echo $khachhangitem['MaKH']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
              </td>
            </tr>
            <tr class="detail-khachhang d-none" id="khachhang<?php echo $khachhangitem['MaKH']; ?>"></tr>
  <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- Số Trang-->
      <nav class="page-fixed">
        <script class="willremove">
          // load số trang
          $.ajax({type: "POST", url: '../count_page.php',data:{Sql:'SELECT MaKH FROM khachhang'},success:function(result) {$('.page-fixed').html(result);}
          });
        </script>
      </nav>
    </div>
  </div><!-- end Ground chứa table-->
  <!-- Modal-insert -->
  <div class="modal fade" id="Modal-insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="background: rgba(0, 0, 0,.45);" >
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content"  >
        <div class="Thongbao-insert p-2"></div>
	      	<div class="modal-header">
	        	<h5 class="modal-title strong">Thêm Khách hàng</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      	</div>
          <form id='form-insert' onsubmit="return false" action="insert_khachhang.php" method="post" enctype="multipart/form-data" >
            <div class="modal-body">
	        	  <div class="row form-group">
	        		  <div class="col-md-4 strong"style="white-space: nowrap" ><label>Tên khách hàng <span style="color:red;">(*)</span></label></div>
	        		  <div class="col-md-8">
	        			<input type="text" name="Tenkh" placeholder="Nhập tên khách hàng" class="form-control" required/>
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Mã khách hàng</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Makh" placeholder="Nếu để trống hệ thống sẽ tự tạo mã kh" class="form-control" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Username</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Username" class="form-control" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
                <label class="col-md-4 control-label strong">Password</label>
                <div class="col-md-8">
                  <input id="password-field" type="password" name="Password" class="form-control" name="password" value="">
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
              </div>
	        	  <div class="row form-group">
	        	  	<div class="col-md-4 strong">	<label>Cấp độ</label></div>
	        	   	<div class="col-md-8">
	        	  		<select class="form-control" name="Capdo">
                    <option value="0">Chọn cấp độ</option>
                    <option value="0">None</option>
                    <?php for($i=1;$i<9;$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
	        		  </div>
	          	</div>
              <div class="row form-group">
	        	    <div class="col-md-4 strong"><label>Điểm thưởng</label></div>
	        		  <div class="col-md-8">
	        			  <input type="number" name="Diemthuong"  class="form-control" value="0" required >
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        	    <div class="col-md-4 strong"><label>Dư nợ</label></div>
	        		  <div class="col-md-8">
	        			  <input type="number" name="Duno"  class="form-control" value="0" required >
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Giới tính</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Gioitinh" placeholder="tối đa 5 chữ" title="Tối đa 5 chữ không có số" class="form-control" maxlength="5" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Số điện thoại</label></div>
                <div class="col-md-8 ">
                  <input type="text" name="SDT" class="form-control" >
                </div>
              </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Email</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="email" name="Email" class="form-control" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Địa chỉ</label></div>
	        		  <div class="col-md-8 ">
	        			  <textarea  name="Diachi" type="text" class="form-control" multicolum=true rows="1"></textarea>
	        	  	</div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Hình ảnh</label></div>
	        	  	<div class="col-md-8">
                  <input type="file" name="Hinhanh" id="image_file" class="form-control"/>
	        	  	</div>
	          	</div>
              <div class="row form-group">
	        	  	<div class="col-md-4 strong"><label>Trạng thái</label></div>
	        		  <div class="col-md-8">
                  <select class="form-control " style="color:green" name="Trangthai">
	        				  <option style="color:green" value="Active">Active</option>
                    <option style="color:red" value="Deactive">Deactive</option>
                  </select>
	        		 </div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Ngày sinh</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="date" name="Birthday"  class="form-control" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Ngày tạo</label></div>
	        		  <div class="col-md-4 ">
	        			  <input type="date" name="Ngaytao"  class="form-control input-ngaytao" readonly>
	        	  	</div>
                <div class="col-md-4 ">
	        			  <button type="button" class="form-control cursor-pointer btn-today"><i class="fas fa-check mr-1"></i> Today</button>
                  <input class="value-btn-today d-none" type="text" name="Namvao2" value="today"/>
	        	  	</div>
	          	</div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Ghi chú</label></div>
  	        		<div class="col-md-8">
  	        			<textarea  name="Ghichu" class="form-control cldt-mota" multicolum=true rows="2"></textarea>
  	        		</div>
  	        	</div>
	      	  </div>
	      	  <div class="modal-footer">
              <button name="Submit-insert" type="submit" class=" mr-auto custom-btn btn-9 Insert-sanpham"><span class="fa fa-plus mr-1"></span>Thêm</button>
	        	  <button type="reset" class="custom-btn3 btn-5"><i class="fa fa-floppy-o" aria-hidden="true"></i> Nhập lại</button>
	          	<button type="button" class="custom-btn btn-10" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	  </div>
          </form>
	      </div><!-- end Modal-content -->
  	  </div>
    </div><!-- end Modal-insert -->
  <!-- Modal-update -->
  <div class="modal fade" id="Modal-update"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="background: rgba(0, 0, 0,.45);" >
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
        <div class="Thongbao-update p-2"></div>
	      	<div class="modal-header">
	        	<h5 class="modal-title strong" >Cập nhật Khách hàng</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      	</div>
          <form id='form-update' action="update_khachhang.php" onsubmit="return false" method="post" enctype="multipart/form-data" >
            <div class="modal-body">
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Mã khách hàng</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Makh" placeholder="Nếu để trống hệ thống sẽ tự tạo mã kh" class="form-control cldt-makh" readonly>
	        	  	</div>
	          	</div>
	        	  <div class="row form-group">
	        		  <div class="col-md-4 strong"style="white-space: nowrap" ><label>Tên khách hàng <span style="color:red;">(*)</span></label></div>
	        		  <div class="col-md-8">
	        			<input type="text" name="Tenkh" placeholder="Nhập tên khách hàng" class="form-control cldt-tenkh" required/>
	        		  </div>
	        	  </div>

              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Username</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Username" class="form-control cldt-username" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
                <label class="col-md-4 control-label strong">Password</label>
                <div class="col-md-8">
                  <input id="password-field2" type="password" name="Password" class="form-control" name="password" value="">
                  <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
              </div>
	        	  <div class="row form-group">
	        	  	<div class="col-md-4 strong">	<label>Cấp độ</label></div>
	        	   	<div class="col-md-8">
	        	  		<select class="form-control cldt-capdo" name="Capdo">
                    <option value="0">Chọn cấp độ</option>
                    <option value="0">None</option>
                    <?php for($i=1;$i<9;$i++){ ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  </select>
	        		  </div>
	          	</div>
              <div class="row form-group">
	        	    <div class="col-md-4 strong"><label>Tổng giao dịch</label></div>
	        		  <div class="col-md-8">
	        			  <input type="number" name="Tonggiaodich"  class="form-control cldt-tonggiaodich" value="0" required >
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        	    <div class="col-md-4 strong"><label>Điểm thưởng</label></div>
	        		  <div class="col-md-8">
	        			  <input type="number" name="Diemthuong"  class="form-control cldt-diemthuong" value="0" required >
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        	    <div class="col-md-4 strong"><label>Dư nợ</label></div>
	        		  <div class="col-md-8">
	        			  <input type="number" name="Duno"  class="form-control cldt-duno" value="0" required >
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Giới tính</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Gioitinh" placeholder="tối đa 5 chữ" title="Tối đa 5 chữ không có số" class="form-control cldt-gioitinh" maxlength="5" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Số điện thoại</label></div>
                <div class="col-md-8 ">
                  <input type="text" name="SDT" class="form-control cldt-sdt" >
                </div>
              </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Email</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="email" name="Email" class="form-control cldt-email" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Địa chỉ</label></div>
	        		  <div class="col-md-8 ">
	        			  <textarea  name="Diachi" type="text" class="form-control cldt-diachi" multicolum=true rows="1"></textarea>
	        	  	</div>
	          	</div>
              <div class="row form-group">
                	<div class="col-md-4 strong"><label>Hình ảnh</label></div>
  	        		  <div class="col-md-8 " style="overflow:visible;z-index:9000;">
                    Hình ảnh hiện tại: <img  src="../images/sanpham/" style="width:40px;" class="cldt-hinhanh"  value="" data-toggle="modal" data-target="#Modal-hinhanh"/> <input type="file" name="Hinhanh" id="image_file2" class="form-control"/>
                    <input type="text" name="Hinhanhhientai" class=" cldt-hinhanh2 d-none" value=""/>
  	        		  </div>
  	        	</div>
              <div class="row form-group">
	        	  	<div class="col-md-4 strong"><label>Trạng thái</label></div>
	        		  <div class="col-md-8">
                  <select class="form-control cldt-trangthai" style="color:green" name="Trangthai">
	        				  <option style="color:green" value="Active">Active</option>
                    <option style="color:red" value="Deactive">Deactive</option>
                  </select>
	        		 </div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Ngày sinh</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="date" name="Birthday"  class="form-control cldt-birthday" >
	        	  	</div>
	          	</div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Ngày tạo</label></div>
                <div class="col-md-4 ">
                  <input type="date" name="Ngaytao"  class="form-control cldt-ngaytao input-ngaytao">
                </div>
                <div class="col-md-4 ">
                  <button type="button" class="form-control cursor-pointer btn-today nottoday">Not Today</button>
                  <input class="value-btn-today d-none" type="text" name="Namvao2" value="nottoday"/>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Ghi chú</label></div>
  	        		<div class="col-md-8">
  	        			<textarea  name="Ghichu" class="form-control cldt-ghichu" multicolum=true rows="2"></textarea>
  	        		</div>
  	        	</div>
	      	  </div>
	      	<div class="modal-footer">
	        	<button name="Submit-update" type="submit" class="custom-btn btn-9 Update-sanpham"> <i class="fa fa-floppy-o" aria-hidden="true" ></i> Cập nhật</button>
	        	<button type="button" class="custom-btn btn-10" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
        </form>
	    </div>
  	</div>
  </div><!-- end Modal-update -->
  <!--Modal-delete -->
  <div id="Modal-delete" temp-makh="" role="dialog" class="modal fade kit-modal__container place-modal-center" style="background: rgba(0, 0, 0,.45);"  >
    <div role="document" class="modal-dialog modal-md mt-5">
      <div class="modal-content"><!---->
        <div class="modal-body" style="max-height: 100%;">
          <p class="text-center mx-auto">Bạn có muốn xoá ? </p>
          <div class="d-flex justify-content-betweeen">
            <button class="btn btn-outline-dark"  data-dismiss="modal">  Huỷ</button>
            <div class="ml-auto">
              <button class="btn btn-danger2 Delete-khachhang" data-dismiss="modal">Xoá
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end Modal-delete -->
  <!-- Modal-hinhanh -->
  <div id="Modal-hinhanh" temp-makh="" tabindex="-1" role="dialog" class="modal modal-xemanh" style="background: rgba(0, 0, 0,.88);z-index:9999;"  >
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
