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

  //Gợi ý chức vụ (khi đang điền input lọc chức vụ)
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

  // set value chức vụ vào input lọc chức vụ (khi đuợc chọn trong dropdown input)
  $(".get-text3").click(function(){
    var value = $(this).text();
    $("#myInput3").val(value);
    $("#myInput3").css("color", "#6495ED");
  });
  // set value giá sp vào input lọc giá sp (khi được chọn trong dropdown input)
  $(".get-text2").click(function(){
    var value = $(this).text();
    $("#myInput2").val(value);
    $("#myInput2").css("color", "#6495ED");
  });

  // Tìm kiếm theo mã, tên, username nhân viên load vào table (khi click icon tìm kiếm)
  $(".btn-searchnv").click(function(){
    var searchnv = $('.input-searchnv').val();
    var sql = "SELECT * FROM nhanvien WHERE MaNV LIKE'%"+searchnv+"%' OR TenNV LIKE '%"+searchnv+"%' OR Username LIKE '%"+searchnv+"%'" ;
    $.ajax({type: "POST", url: 'search_table_nhanvien.php',data:{searchnv:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_nhanvien').html(result);}
    });
    var count = "SELECT MaNV FROM nhanvien WHERE MaNV LIKE'%"+searchnv+"%' OR TenNV LIKE '%"+searchnv+"%' OR Username LIKE '%"+searchnv+"%'" ;
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:count},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  // Lọc Tìm kiếm theo mã, tên , username  nếu có + theo chức vụ nếu có +  load vào table + Đếm và load số trang (khi click Lọc)
  $(".btn-loc").click(function(){
    var search= $('.input-searchnv').val();
    var chucvu= $('#myInput2').val();
    var gioitinh= $('#myInput3').val();
    var where='';
    if (search!='') {search= "(MaNV LIKE '%"+search+"%' OR TenNV LIKE '%"+search+"%' OR Username LIKE '%"+search+"%')"; where+=search;}
    if ( (chucvu.trim()=='Tất cả chức vụ') || (chucvu=='') ) chucvu='';
    else {chucvu="Chucvu='"+chucvu+"'"; if(where=='') where+=chucvu; else where+=' AND '+chucvu; }
    if ( (gioitinh.trim()=='Tất cả giới tính') || (gioitinh=='') ) gioitinh='';
    else {gioitinh="Gioitinh='"+gioitinh+"'"; if(where=='') where+=gioitinh; else where+=' AND '+gioitinh; }
    if(where=='') where=1;
    var sql= 'SELECT * FROM nhanvien WHERE '+where;
    $.ajax({type: "POST", url: 'search_table_nhanvien.php',data:{searchnv:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_nhanvien').html(result);}
    });
    var count='SELECT MaNV FROM nhanvien WHERE '+where;
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:count},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  // Delete by MaNV in DATABASE + Xóa ảnh trên host + Xóa dòng đó trên table + Thông báo (khi click xác nhận Xóa)
  $(".Delete-nhanvien").click(function(){
    var manvhientai= $('#Modal-delete').attr('temp-manv');
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'nhanvien',condition1:"MaNV ='"+manvhientai+"'",img:'Avatar',diachi:'../images/nhanvien/'},success:function(result)
     {$('.alert-login').html('<h3 class="success1">Xóa nhân viên thành công</h3>').fadeIn().delay(1500).fadeOut('slow').css('background-color','none');
     setTimeout('$(".alert-login h3").remove()',1500);
    $("tbody#tbody_nhanvien tr").each(function() {
      if($(this).attr('temp-manv')==manvhientai) {$(this).remove();return ;}
    });
  	 }
    });
  });

  // ẨN thẻ thông báo form (khi click thêm nhân viên)
  $(".btn-themnv").click(function(){
      $('.Thongbao-insert').addClass('d-none');
  });
  var called = 1;
  event_click1();
  function event_click1(){

    //Animate Toggle + load xem chi tiết nhân viên (khi click vào các dòng đầu table nhân viên)
    $('body').on('click', '.toggle-infornv', function(){
      var manvhientai= $(this).parent('.tr-content').attr('temp-manv');
      var dropdownhientai= '#nhanvien'+manvhientai;
      $.ajax({type: "POST", url: 'load_chitiet_nhanvien.php',data:{MaNV:manvhientai},success:function(result) {$(dropdownhientai).html(result);}
      });
      $(dropdownhientai).toggleClass('d-none');
    });

    //Animate change trạng thái + Update trạng thái by MaNV in DATABASE (khi click icon tình trạng)
    $('body').on('click', '.jquery-switch', function (){ if(called==1){
    var manv= $(this).attr('temp-manv');
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
    $.ajax({type: "POST", url: '../update_trangthai.php',data:{table:'nhanvien',obj1:'MaNV',newTrangthai:"'"+trangthai+"'",condition1:"MaNV= '"+manv+"'"},success:function(result) {
      $('.alert-login').append(result).fadeIn().delay(1200).fadeOut().css('background-color','none');setTimeout('$(".alert-login h3").remove()',5200);
    	 }
    });;
    called++;}else {called=1; return ;}
    });

    //Lưu tạm mã nv bạn chọn vào Modal-delete (khi click Xóa or icon thùng rác)
    $('body').on('click', '.getdelete-manv', function () {
			var manv =$(this).attr('tempdata-manv');
			$("#Modal-delete").attr('temp-manv',manv);
    });

    //Ẩn thẻ thông báo update + load thông tin món vào #Modal-update + set nút not today(khi click icon edit)
    $('body').on('click', '.btn-suanv', function () {
      $('.Thongbao-update').addClass('d-none');
      var manvhientai = $(this).attr("temp-manv");
      $.ajax({type: "POST", url: 'load_edit_nhanvien.php',data:{MaNV:manvhientai},success:function(result) {$('#Script-hide-load').html(result);}
      });
      $('.btn-today').text('Not Today');$('.btn-today').addClass('nottoday');$('.value-btn-today').val('nottoday');
    });

    //load ảnh vào img trong #Modal-hinhanh (khi click vào hình ảnh nhân viên)
    $('body').on('click', '.cldt-hinhanh', function () {
      var hinhanh = $(this).attr('src');
      $('#Modal-hinhanh .images').attr('src',hinhanh);
    });

    //Chuyển sang trang bạn chọn (khi click trang)
    $('body').on('click', '.change-page', function () {
      var number = $(this).text();
      number =new Number(number);number=(number-1)*20;
      limit=number+',20';
      var search= $('.input-searchnv').val();
      var chucvu= $('#myInput2').val();
      var gioitinh= $('#myInput3').val();
      var where='';
      if (search!='') {search= "(MaNV LIKE '%"+search+"%' OR TenNV LIKE '%"+search+"%' OR Username LIKE '%"+search+"%')"; where+=search;}
      if ( (chucvu.trim()=='Tất cả chức vụ') || (chucvu=='') ) chucvu='';
      else {chucvu="Chucvu='"+chucvu+"'"; if(where=='') where+=chucvu; else where+=' AND '+chucvu; }
      if ( (gioitinh.trim()=='Tất cả giới tính') || (gioitinh=='') ) gioitinh='';
      else {gioitinh="Gioitinh='"+gioitinh+"'"; if(where=='') where+=gioitinh; else where+=' AND '+gioitinh; }
      if(where=='') where=1;
      var sql= 'SELECT * FROM nhanvien WHERE '+where;
      $.ajax({type: "POST", url: 'search_table_nhanvien.php',data:{searchnv:sql,limit:limit,stt:number},success:function(result) {$('tbody#tbody_nhanvien').html(result);}
      });
      $('.pagination .page-item').removeClass('page-active');
      $(this).parent('.page-item').addClass('page-active');
    });
  }
  // mở cho phép nhập input năm vào + lưu sự lựa chọn vào input ẩn  (khi click Today)
  $(".btn-today").click(function(){
    var today=$(this);var value=$('.value-btn-today');var inputblock=$('.input-namvao');
      if(today.text().trim()=='Today') { today.text('Not Today');today.addClass('nottoday');value.val('nottoday');inputblock.attr('readonly', false);}
      else {today.html('<i class="fas fa-check mr-1"></i>Today');today.removeClass('nottoday');value.val('today');inputblock.attr('readonly', true);inputblock.val('');}
  });

});
</script>
</head>
<body>

<header>
  <section id="navigation" class="st-navigation" style="overflow: visible">
    <script  class="willremove">
      // Thanh header-top navbar
      $.ajax({type: "POST", url: '../header-top.php',data:{Category:'Nhân viên'},success:function(result) {$('#navigation').append(result);}
      });
      // Thanh Modal-Mainmenu (khi lick vào icon danh mục)
      $.ajax({type: "POST", url: '../main-menu.php',data:{Mainmenu:'Nhân viên'},success:function(result) {$('#navigation').append(result);}
      });
    </script>
 </section>
</header>
<div class="Myground " id="myground" style="background-color:white" >
  <!-- Thanh menu con bên trái -->
  <div class="sidebar__container float-left active" style="float:left"></div>
  <script class="willremove">
    // load thanh menu con bên trái
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Danh sách Nhân viên'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>


  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    <div class="action-bar__container action-bar-border">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mr-3 action-bar__title ml-3">Nhân viên</h3>
        <div class="flex-1">
          <div class="d-flex">
            <form >
              <div class="input-group ">
                <input type="text" placeholder="Tìm kiếm Mã, Tên, Username nhân viên" class="form-control input-searchnv ">
                <div class="input-group-append "><span class="btn-searchnv cursor-pointer input-group-text" style="background:#3366FF;" ><i style="color:#fff" class="fas fa-search"></i></span>
                </div>
              </div>
            </form>
            <div class="border rounded d-flex ml-3">
              <div class="border-0 py-0 select-on-list kit-select__container input-box d-flex" name="city_name" placeholder="Chọn thành phố">
                <div class="kit-select d-flex align-items-center">
                  <div class="tags d-flex align-items-center justify-content-between " >
                    <div class="dropdown2">
                      <input type="text" id="myInput2" placeholder="Chọn chức vụ" class="input-select border-0 dropbtn"><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div class="dropdown-content2" style="z-index: 100;">
                        <div class=" text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tất cả chức vụ</p></div>
                        <?php $chucvu= get_all_1table('chucvu');foreach ($chucvu as $chucvuitem){ ?>
                            <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2 "><?php echo $chucvuitem['TenChucVu']; ?> </p></div>
                        <?php } ?>
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
                      <input type="text" id="myInput3" placeholder="Chọn giới tính" class="input-select border-0 dropbtn" /><button class="border-0 hover-blue btn-clear1 d-none" onclick="document.getElementById('myInput3').value = '';$('#myInput3').keyup(); ">x</button><i class="fas fa-caret-down text-link-blue dropbtn"></i>
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
            <div class="border rounded d-flex ml-3" >
                    <button class="custom-btn btn-13 btn-loc" style="width:100px">Lọc</button>
            </div>
          </div>
        </div>
        <div class="ml-auto mr-2 navbar p-0 m-0">
          <div class="dropdown">
            <button type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-blue dropdown-toggle">  Tiện ích</button>
            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-item cursor-pointer"><i class="fas fa-upload mr-2 p-1"></i>Thêm nhân viên từ file</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-file-export mr-2 p-1"></i> Xuất danh sách nhân viên</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sort-alpha-down mr-2 p-1"></i> Sắp xếp nhân viên</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sync-alt mr-2 p-1"></i> Đồng bộ nhân viên</div>
            </div>
          </div>
        </div>
        <button class="custom-btn2 btn-7 btn-themnv " data-toggle="modal" data-target="#Modal-insert">  Thêm NV</button>
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
              <th style="width: 10%;">Mã</th>
              <th style="width: 12%;">Avatar</th>
              <th style="width: 35%;">Tên nhân viên</th>
              <th style="width: 9%;" class="text-nowrap" >Giới tính</th>
              <th style="width: 25%;">Chức vụ<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 8%;"class="text-left">Username</th>
              <th style="width: 6%;">Điện thoại</th>
              <th style="width: 6%;">Email</th>
              <th style=" width: 17%;z-index: 3;"class="text-left">
                <div class="d-flex ">
                  <div class=" text-left cursor-pointer d-flex align-items-center">Thao tác <i class="fas fa-sort ml-1"></i></div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody id="tbody_nhanvien" class="border-bottom mysearch1" role="rowgroup">
    <?php $nhanvien=getlimit_1condition('nhanvien',20,1,'1');$stt=0;
        foreach ($nhanvien as $nhanvienitem){ ?>
            <tr id="tr-nhanvien<?php echo $nhanvienitem['MaNV']; ?>" temp-manv="<?php echo $nhanvienitem['MaNV']; ?>" class="tr-content ">
              <td class="toggle-infornv "><?php $stt++; echo $stt; ?></td>
              <td class="toggle-infornv cldt-manv"><?php echo $nhanvienitem['MaNV']; ?> </td>
              <td class=" imgtable1-ground "><img class="cldt-hinhanh"  src="../images/nhanvien/<?php echo $nhanvienitem['Avatar']; ?>"  data-toggle="modal" data-target="#Modal-hinhanh"/></td>
              <td class="toggle-infornv cldt-tennv"><?php echo $nhanvienitem['TenNV']; ?></td>
              <td class="toggle-infornv text-center cldt-gioitinh"><?php echo $nhanvienitem['Gioitinh']; ?></td>
              <td  class="toggle-infornv cldt-chucvu"><?php echo $nhanvienitem['Chucvu']; ?></td>
              <td class="toggle-infornv cldt-username"><?php echo $nhanvienitem['Username']; ?></td>
              <td class="cldt-sdt"><?php echo $nhanvienitem['SDT']; ?></td>
              <td class="cldt-email"><?php echo $nhanvienitem['Email']; ?></td>
              <td class="text-left">
                <label temp-manv="<?php echo $nhanvienitem['MaNV']; ?>" class="jquery-switch <?php if($nhanvienitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
                  <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
                    <div  class="v-switch-button" <?php if($nhanvienitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
                    </div>
                  </div>
                  <span class="v-switch-label cldt-trangthai update-trangthai <?php if($nhanvienitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $nhanvienitem['Trangthai']; ?>
                  </span>
                </label>
                <img temp-manv="<?php echo $nhanvienitem['MaNV']; ?>" class="mr-2 cursor-pointer btn-suanv" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-manv" tempdata-manv="<?php echo $nhanvienitem['MaNV']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
              </td>
            </tr>
            <tr class="detail-nhanvien d-none" id="nhanvien<?php echo $nhanvienitem['MaNV']; ?>"></tr>
  <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- Số Trang-->
      <nav class="page-fixed">
        <script class="willremove">
          // load số trang
          $.ajax({type: "POST", url: '../count_page.php',data:{Sql:'SELECT MaNV FROM nhanvien'},success:function(result) {$('.page-fixed').html(result);}
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
	        	<h5 class="modal-title">Thêm NV</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      	</div>
          <form id='form-insert' onsubmit="return false" action="insert_nhanvien.php" method="post" enctype="multipart/form-data" >
            <div class="modal-body">
	        	  <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Tên nhân viên <span style="color:red;">(*)</span></label></div>
	        		  <div class="col-md-8">
	        			<input type="text" name="Tennv" placeholder="Nhập tên nhân viên" class="form-control" required/>
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Mã nhân viên</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Manv" placeholder="Nếu để trống hệ thống sẽ tự tạo mã nv" class="form-control" >
	        	  	</div>
	          	</div>
	        	  <div class="row form-group">
	        	  	<div class="col-md-4 strong">	<label>Chức vụ</label></div>
	        	   	<div class="col-md-8">
	        	  		<select class="form-control" name="Chucvu">
                    <option value="">Chọn chức vụ</option>
                    <option value="">None</option>
              <?php $chucvu=get_all_1table('chucvu'); foreach ($chucvu as $chucvuitem){ ?>
                    <option value="<?php echo $chucvuitem['TenChucVu']; ?>"><?php echo $chucvuitem['TenChucVu']; ?></option>
              <?php } ?>
                  </select>
	        		  </div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Username</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Username" class="form-control" >
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
                <div class="col-md-4 strong"><label>CCCD</label></div>
                <div class="col-md-8 ">
                  <input type="text" name="CCCD" placeholder="chỉ nhập số không ghi chữ" title="Nhập số không quá 15 kí tự"  class="form-control" pattern="[0-9]{0,15}" >
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
	        		  <div class="col-md-4 strong"><label>Năm vào</label></div>
	        		  <div class="col-md-4 ">
	        			  <input type="date" name="Namvao"  class="form-control input-namvao" readonly>
	        	  	</div>
                <div class="col-md-4">
	        			  <button type="button" class="form-control cursor-pointer btn-today"><i class="fas fa-check mr-1"></i> Today</button>
                  <input class="value-btn-today d-none" type="text" name="Namvao2" value="today"/>
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
	        	<h5 class="modal-title" >Cập nhật Nhân viên</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      	</div>
          <form id='form-update' action="update_nhanvien.php" onsubmit="return false" method="post" enctype="multipart/form-data" >
            <div class="modal-body">
              <ul class="nav nav-tabs" role="tablist"><li class="active"><a>Chi tiết</a></li></ul>
              <div class="row form-group">
  	        		<div class="col-md-4 strong"><label>Mã Nhân viên</label></div>
  	        		<div class="col-md-8 ">
  	        			<input type="text" name="Manv" class="form-control cldt-manv" readonly >
  	        		</div>
  	        	</div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Tên nhân viên <span style="color:red;">(*)</span></label></div>
                <div class="col-md-8">
                <input type="text" name="Tennv" placeholder="Nhập tên nhân viên" class="form-control cldt-tennv" required/>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 strong">	<label>Chức vụ</label></div>
                <div class="col-md-8">
                  <select class="form-control cldt-chucvu" name="Chucvu">
                    <option value="">Chọn chức vụ</option>
                    <option value="">None</option>
              <?php $chucvu=get_all_1table('chucvu'); foreach ($chucvu as $chucvuitem){ ?>
                    <option value="<?php echo $chucvuitem['TenChucVu']; ?>"><?php echo $chucvuitem['TenChucVu']; ?></option>
              <?php } ?>
                  </select>
                </div>
              </div>
              <div class="row form-group ">
                <div class="col-md-4 strong"><label>Username</label></div>
                <div class="col-md-8 ">
                  <input type="text" name="Username" class="form-control cldt-username" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Giới tính</label></div>
                <div class="col-md-8 ">
                  <input type="text" name="Gioitinh" placeholder="tối đa 5 chữ" title="Tối đa 5 chữ không có số" class="form-control cldt-gioitinh"  maxlength="5"  >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Số điện thoại</label></div>
                <div class="col-md-8 ">
                  <input type="text" name="SDT" class="form-control cldt-sdt" >
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>CCCD</label></div>
                <div class="col-md-8 ">
                  <input type="text" name="CCCD" placeholder="Nhập số không nhập chữ" title="Nhập số không quá 15 kí tự"  class="form-control cldt-cccd" pattern="[0-9]{0,15}" >
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
                  <select class="form-control cldt-trangthai " style="color:green" name="Trangthai">
                    <option style="color:green" value="Active">Active</option>
                    <option style="color:red" value="Deactive">Deactive</option>
                  </select>
               </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Ngày sinh</label></div>
                <div class="col-md-8 ">
                  <input type="date" name="Birthday"  class="form-control cldt-birthday " >
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-4 strong"><label>Năm vào</label></div>
                <div class="col-md-4 ">
                  <input type="date" name="Namvao"  class="form-control cldt-namvao input-namvao">
                </div>
                <div class="col-md-4 ">
                  <button type="button" class="form-control cursor-pointer btn-today nottoday">Not Today</button>
                  <input class="value-btn-today d-none" type="text" name="Namvao2" value="nottoday"/>
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
  <div id="Modal-delete" temp-manv="" role="dialog" class="modal fade kit-modal__container place-modal-center" style="background: rgba(0, 0, 0,.45);"  >
    <div role="document" class="modal-dialog modal-md mt-5">
      <div class="modal-content"><!---->
        <div class="modal-body" style="max-height: 100%;">
          <p class="text-center mx-auto">Bạn có muốn xoá ? </p>
          <div class="d-flex justify-content-betweeen">
            <button class="btn btn-outline-dark"  data-dismiss="modal">  Huỷ</button>
            <div class="ml-auto">
              <button class="btn btn-danger2 Delete-nhanvien" data-dismiss="modal">Xoá
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end Modal-delete -->
  <!-- Modal-hinhanh -->
  <div id="Modal-hinhanh" temp-manv="" tabindex="-1" role="dialog" class="modal modal-xemanh" style="background: rgba(0, 0, 0,.88);z-index:9999;"  >
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
