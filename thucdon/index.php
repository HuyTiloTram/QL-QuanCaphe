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

  //Gợi ý nhóm món (khi đang điền input lọc nhóm món)
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

  // set value nhóm món vào input lọc nhóm món (khi đuợc chọn trong dropdown input)
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

  // Tìm kiếm theo mã, tên món load vào table (khi click icon tìm kiếm)
  $(".btn-searchsp").click(function(){
    var searchsp = $('.input-searchsp').val();
    var sql = "SELECT * FROM sanpham WHERE MaSP LIKE'%"+searchsp+"%' OR TenSP LIKE '%"+searchsp+"%'";
    $.ajax({type: "POST", url: 'search_table_sanpham.php',data:{searchsp:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_sanpham').html(result);}
    });
    var count= "SELECT MaSP FROM sanpham WHERE (MaSP LIKE '%"+searchsp+"%' OR TenSP LIKE '%"+searchsp+"%') AND LoaiSP!='Combo'";
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:count},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  //Lọc Tìm kiếm theo mã, tên  nếu có + theo giá, theo nhóm món nếu có +  load vào table + Đếm và load số trang (khi click lọc)
  $(".btn-loc").click(function(){
    var search= $('.input-searchsp').val();
    var giamon= $('#myInput2').val();
    var nhommon= $('#myInput3').val();
    var loaisp="LoaiSP != 'Combo'";
    var where='';
    if (search!='') {search= "(MaSP LIKE '%"+search+"%' OR TenSP LIKE '%"+search+"%')"; where+=search;}
    if ( (giamon.trim()=='Tất cả giá món') || (giamon=='') ) giamon='';
    else {
      if(!/\d/.test(giamon.trim()))  {alert('Vui lòng không nhập chữ trong ô nhập giá món'); return ;};
      giamon='GiaSP'+giamon; if(where=='') where+=giamon; else where+=' AND '+giamon;}
    if ( (nhommon.trim()=='Tất cả nhóm món') || (nhommon=='') ) nhommon='';
    else {nhommon="NhomMon='"+nhommon+"'"; if(where=='') where+=nhommon; else where+=' AND '+nhommon;  }
    if(where=='') where+=loaisp; else where+=' AND '+loaisp;
    var sql= 'SELECT * FROM sanpham WHERE '+where;
    $.ajax({type: "POST", url: 'search_table_sanpham.php',data:{searchsp:sql,limit:20,stt:0},success:function(result) {$('tbody#tbody_sanpham').html(result);}
    });
    var count= 'SELECT MaSP FROM sanpham WHERE '+where;
    $.ajax({type: "POST", url: '../count_page.php',data:{Sql:sql},success:function(result) {$('.page-fixed').html(result);}
    });
  });

  // Delete by MaSP in DATABASE + Xóa ảnh trên host + Xóa dòng đó trên table + Thông báo (khi click xác nhận Xóa)
  $(".Delete-sanpham").click(function(){
    var masphientai= $('#Modal-delete').attr('temp-masp');
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'sanpham', masp:masphientai, condition1:"MaSP ='"+masphientai+"'", img:'Hinhanh', diachi:'../images/sanpham/'},success:function(result)
     {$('.alert-login').html(result).fadeIn().delay(5500).fadeOut('slow').css('background-color','none');
     setTimeout('$(".alert-login h3").remove()',5500);
  	 }
    });
  });

  // ẨN thẻ thông báo form khi click tạo nhóm
  $(".btn-taomon").click(function(){
      $('.Thongbao-insert').addClass('d-none');
  });
  var called = 1;
  event_click1();
  function event_click1(){

    //Animate Toggle + load xem chi tiết sản phẩm (khi click vào các dòng đầu table sản phẩm)
    $('body').on('click', '.toggle-inforsp', function(){
      var masphientai= $(this).parent('.tr-content').attr('temp-masp');
      var dropdownhientai= '#sanpham'+masphientai;
      $.ajax({type: "POST", url: 'load_chitiet_sanpham.php',data:{MaSP:masphientai},success:function(result) {$(dropdownhientai).html(result);}
      });
      $(dropdownhientai).toggleClass('d-none');
    });

    //Animate change trạng thái + Update trạng thái by MaSP in DATABASE (khi click icon tình trạng)
    $('body').on('click', '.jquery-switch', function (){ if(called==1){
    var masp= $(this).attr('temp-masp');
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
    $.ajax({type: "POST", url: '../update_trangthai.php',data:{table:'sanpham', obj1:'MaSP', newTrangthai:"'"+trangthai+"'", condition1:"MaSP= '"+masp+"'"},success:function(result) {
      $('.alert-login').append(result).fadeIn().delay(1200).fadeOut().css('background-color','none');setTimeout('$(".alert-login h3").remove()',5200);
    	 }
    });;
    called++;}else {called=1; return ;}
    });

    //Lưu tạm mã sp bạn chọn vào Modal-delete (khi click Xóa or icon thùng rác)
    $('body').on('click', '.getdelete-masp', function () {
			var masp =$(this).attr('tempdata-masp');
			$("#Modal-delete").attr('temp-masp',masp);
    });

    //Ẩn thẻ thông báo update + load thông tin món vào #Modal-update (khi click icon edit)
    $('body').on('click', '.btn-suamon', function () {
      $('.Thongbao-update').addClass('d-none');
      var masphientai = $(this).attr("temp-masp");
      $.ajax({type: "POST", url: 'load_edit_sanpham.php',data:{MaSP:masphientai},success:function(result) {$('#Script-hide-load').html(result);}
      });
    });

    //load ảnh vào img trong #Modal-hinhanh (khi click vào hình ảnh món)
    $('body').on('click', '.cldt-hinhanh', function () {
      var hinhanh = $(this).attr('src');
      $('#Modal-hinhanh .images').attr('src',hinhanh);
    });

    //Chuyển sang trang bạn chọn (khi click trang)
    $('body').on('click', '.change-page', function () {
      var number = $(this).text();
      number =new Number(number);number=(number-1)*20;
      limit=number+',20';
      var search= $('.input-searchsp').val();
      var giamon= $('#myInput2').val();
      var nhommon= $('#myInput3').val();
      var loaisp="LoaiSP != 'Combo'";
      var where='';
      if (search!='') {search= "(MaSP LIKE '%"+search+"%' OR TenSP LIKE '%"+search+"%')";where+=search}
      if ( (giamon.trim()=='Tất cả giá món') || (giamon=='') ) giamon='';
      else {giamon='GiaSP'+giamon; if(where=='') where+=giamon; else where+=' AND '+giamon;}
      if ( (nhommon.trim()=='Tất cả nhóm món') || (nhommon=='') ) nhommon='';
      else {nhommon="NhomMon='"+nhommon+"'"; if(where=='') where+=nhommon; else where+=' AND '+nhommon;  }
      if(where=='') where+=loaisp; else where+=' AND '+loaisp;
      var sql= 'SELECT * FROM sanpham WHERE '+where;
      $.ajax({type: "POST", url: 'search_table_sanpham.php',data:{searchsp:sql,limit:limit,stt:number},success:function(result) {$('tbody#tbody_sanpham').html(result);}
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
      $.ajax({type: "POST", url: '../header-top.php',data:{Category:'Thực đơn'},success:function(result) {$('#navigation').append(result);}
      });
      // Thanh Modal-Mainmenu (khi lick vào icon danh mục)
      $.ajax({type: "POST", url: '../main-menu.php',data:{Mainmenu:'Thực đơn'},success:function(result) {$('#navigation').append(result);}
      });
    </script>
 </section>
</header>
<div class="Myground " id="myground" style="background-color:white" >
  <!-- Thanh menu con bên trái -->
  <div class="sidebar__container float-left active" style="float:left"></div>
  <script class="willremove">
    // load thanh menu con bên trái
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Món ăn'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>


  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    <div class="action-bar__container action-bar-border">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mr-3 action-bar__title ml-3">Món ăn</h3>
        <div class="flex-1">
          <div class="d-flex">
            <form >
              <div class="input-group ">
                <input type="text" placeholder="Tìm kiếm món hoặc Mã món" class="form-control input-searchsp ">
                <div class="input-group-append "><span class="btn-searchsp cursor-pointer input-group-text" style="background:#3366FF;" ><i style="color:#fff" class="fas fa-search"></i></span>
                </div>
              </div>
            </form>
            <div class="border rounded d-flex ml-3">
              <div class="border-0 py-0 select-on-list kit-select__container input-box d-flex" name="city_name" placeholder="Chọn thành phố">
                <div class="kit-select d-flex align-items-center">
                  <div class="tags d-flex align-items-center justify-content-between " >
                    <div class="dropdown2">
                      <input type="text" id="myInput2" placeholder="Chọn giá món" class="input-select border-0 dropbtn"><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div class="dropdown-content2" style="z-index: 100;">
                        <div class=" text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text2 ">Tất cả giá món</p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2"><=12000 </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2"><=20000 </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2"><=30000 </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2"><=50000 </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2">>=20000 </p></div>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text2">>=50000 </p></div>
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
                      <input type="text" id="myInput3" placeholder="Chọn nhóm món" class="input-select border-0 dropbtn" /><button class="border-0 hover-blue btn-clear1 d-none" onclick="document.getElementById('myInput3').value = '';$('#myInput3').keyup(); ">x</button><i class="fas fa-caret-down text-link-blue dropbtn"></i>
                      <div id="myDropdown3" class="dropdown-content2" style="z-index:100">
                        <div class="text-selected"><p class="mb-0 w-100 text-truncate text-link-blue get-text3 ">Tất cả nhóm món </p></div>
                    <?php $nhommon= get_all_1table('nhommon');foreach ($nhommon as $nhommonitem){ ?>
                        <div class=""><p class="mb-0 w-100 text-truncate text-link-blue get-text3 "><?php echo $nhommonitem['TenNhomMon']; ?> </p></div>
                    <?php } ?>
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
              <div class="dropdown-item cursor-pointer"><i class="fas fa-upload mr-2 p-1"></i>Thêm món từ file</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-file-export mr-2 p-1"></i> Xuất thực đơn</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sort-alpha-down mr-2 p-1"></i> Sắp xếp thực đơn</div>
              <div class="dropdown-item cursor-pointer"><i class="fas fa-sync-alt mr-2 p-1"></i> Đồng bộ thực đơn</div>
            </div>
          </div>
        </div>
        <button class="custom-btn2 btn-7 btn-taomon " data-toggle="modal" data-target="#Modal-insert">  Tạo món</button>
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
              <th style="width: 4%;">#</th>
              <th style="width: 4%;">Mã món</th>
              <th style="width: 9%; "class="text-left">Hình ảnh</th>
              <th style="width: 23%;">Tên món</th>
              <th style="width: 9%;" class="text-right" >Giá vốn<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 9%;" class="text-right" >Giá bán<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 9%;">Đơn vị tính</th>
              <th style="width: 10%;"><div class="cursor-pointer d-flex align-items-center">Loại món  <i class="fas fa-sort ml-1"></i></div></th>
              <th style="width: 9%;">Nhóm món</th>
              <th style=" width: 14%;z-index: 3;" class="text-left">
                <div class="d-flex ">
                  <div class=" text-left cursor-pointer d-flex align-items-center">Thao tác <i class="fas fa-sort ml-1"></i>
                  </div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody id="tbody_sanpham" class="border-bottom mysearch1" role="rowgroup">
    <?php $sanpham=getlimit_1condition('sanpham',20,1,"LoaiSP!='Combo'");$stt=0;
        foreach ($sanpham as $sanphamitem){ ?>
            <tr id="tr-sanpham<?php echo $sanphamitem['MaSP']; ?>" temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="tr-content ">
              <td class="toggle-inforsp "><?php $stt++; echo $stt; ?></td>
              <td class="toggle-inforsp cldt-masp"><p style="width: 80px;word-wrap:break-word" ><?php echo $sanphamitem['MaSP']; ?> </p></td>
              <td class=" imgtable1-ground "><img class="cldt-hinhanh" src="../images/sanpham/<?php echo $sanphamitem['Hinhanh']; ?>" alt="ảnh" data-toggle="modal" data-target="#Modal-hinhanh"/></td>
              <td class="toggle-inforsp cldt-tensp"><?php echo $sanphamitem['TenSP']; ?></td>
              <td class="toggle-inforsp cldt-giavon text-right" id2="<?php echo $sanphamitem['Giavon']; ?>" ><?php echo number_format($sanphamitem['Giavon'],0,"",","); ?> đ</td>
              <td class="toggle-inforsp cldt-giasp text-right giamon" id2="<?php echo $sanphamitem['GiaSP']; ?>"><?php echo number_format($sanphamitem['GiaSP'],0,"",","); ?> đ</td>
              <td class="toggle-inforsp cldt-dvt"><?php if($sanphamitem['SLquydoi']==1) echo $sanphamitem['DVT']; else echo '('.$sanphamitem['SLquydoi'].') '.$sanphamitem['DVT']; ?></td>
              <td class="toggle-inforsp cldt-loaisp"><?php echo $sanphamitem['LoaiSP']; ?></td>
              <td class="nhommon cldt-nhommon"><?php echo $sanphamitem['NhomMon']; ?></td>
              <td class="text-left">
                <label temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="jquery-switch <?php if($sanphamitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
                  <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
                    <div  class="v-switch-button" <?php if($sanphamitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
                    </div>
                  </div>
                  <span class="v-switch-label cldt-trangthai update-trangthai <?php if($sanphamitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $sanphamitem['Trangthai']; ?>
                  </span>
                </label>
                <img temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="mr-2 cursor-pointer btn-suamon" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/>
                <i class="fas fa-trash-alt cursor-pointer getdelete-masp" tempdata-masp="<?php echo $sanphamitem['MaSP']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
              </td>
            </tr>
            <tr class="detail-sanpham d-none" id="sanpham<?php echo $sanphamitem['MaSP']; ?>"></tr>
  <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- Số Trang-->
      <nav class="page-fixed">
        <script class="willremove">
          // load số trang
          $.ajax({type: "POST", url: '../count_page.php',data:{Sql:"SELECT MaSP FROM sanpham WHERE LoaiSP!='Combo'"},success:function(result) {$('.page-fixed').html(result);}
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
	        	<h5 class="modal-title strong">Tạo Món</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      	</div>
          <form id='form-insert' onsubmit="return false" action="insert_sanpham.php" method="post" enctype="multipart/form-data" >
            <div class="modal-body">
	        	  <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Tên món <span style="color:red;">(*)</span></label></div>
	        		  <div class="col-md-8">
	        			<input type="text" name="Tensp" placeholder="Nhập tên món" class="form-control" required/>
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        	    <div class="col-md-4 strong"><label>Giá bán (VNĐ)</label></div>
	        		  <div class="col-md-8">
	        			  <input type="text" name="Giasp"  class="form-control" value="0" required >
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        	  	<div class="col-md-4 strong"><label>Giá vốn (VNĐ)</label></div>
	        		  <div class="col-md-8">
	        			  <input type="text" name="Giavon"  class="form-control" required value="0"/>
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Mã món</label></div>
	        		  <div class="col-md-8 ">
	        			  <input type="text" name="Masp" placeholder="Nếu để trống hệ thống sẽ tự tạo Mã món" class="form-control" >
	        	  	</div>
	          	</div>
	        	  <div class="row form-group">
	        	  	<div class="col-md-4 strong">	<label>Nhóm món</label></div>
	        	   	<div class="col-md-8">
	        	  		<select class="form-control" name="Nhommon">
                    <option value="">Chọn nhóm món</option>
                    <option value="">None</option>
              <?php $nhommon=get_all_1table('nhommon'); foreach ($nhommon as $nhommonitem){ ?>
                    <option value="<?php echo $nhommonitem['TenNhomMon']; ?>"><?php echo $nhommonitem['TenNhomMon']; ?></option>
              <?php } ?>
                  </select>
	        		  </div>
	          	</div>
              <div class="row form-group">
	        	  	<div class="col-md-4 strong">	<label>Loại món</label></div>
	        	   	<div class="col-md-8">
	        	  		<select class="form-control" name="Loaisp">
                    <option value="">Chọn loại</option>
                    <option value="">None</option>
              <?php $loaihanghoa=get_all_1table('loaihanghoa'); foreach ($loaihanghoa as $loaihhitem){ ?>
                    <option value="<?php echo $loaihhitem['TenLoai']; ?>"><?php echo $loaihhitem['TenLoai']; ?></option>
              <?php } ?>
                  </select>
	        		  </div>
	          	</div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Đơn vị tính</label></div>
	        		  <div class="col-md-4">
	        			  <select class="form-control " name="Dvt">
	        			  	<option value="">Chọn đơn vị tính</option>
                    <option value="">None</option>
              <?php $dvt=get_all_1table('dvt'); foreach ($dvt as $dvtitem){ ?>
                    <option value="<?php echo $dvtitem['TenDVT']; ?>"><?php echo $dvtitem['TenDVT']; ?></option>
              <?php } ?>
                  </select>
	        	   	</div>
                <div class="col-md-4">
                  <input type="text" name="Slquydoi" placeholder="Số lượng quy đổi" value="1" class="form-control"/>
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
                <div class="col-md-4 strong"><label>Mô tả</label></div>
  	        		<div class="col-md-8">
  	        			<textarea  name="Mota" class="form-control cldt-mota" rows="3"></textarea>
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
	        	<h5 class="modal-title strong" >Cập nhật Món</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      	</div>
          <form id='form-update' action="update_sanpham.php" onsubmit="return false" method="post" enctype="multipart/form-data" >
            <div class="modal-body">
              <ul class="nav nav-tabs" role="tablist"><li class="active"><a>Chi tiết</a></li></ul>
              <div class="row form-group">
  	        		<div class="col-md-4 strong"><label>Mã món</label></div>
  	        		<div class="col-md-8 ">
  	        			<input type="text" name="Masp" class="form-control cldt-masp" readonly >
  	        		</div>
  	        	</div>
	            <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Tên Món <span style="color:red;">(*)</span></label></div>
	        		<div class="col-md-8">
	        			<input type="text" name="Tensp" placeholder="Nhập tên món" class="form-control cldt-tensp" required/>
	        		</div>
	        	  </div>
              <div class="row form-group">
	        		  <div class="col-md-4 strong"><label>Giá bán (VNĐ)</label></div>
	        		  <div class="col-md-8">
	        			  <input type="text" name="Giasp"  class="form-control cldt-giasp" value="0" required/>
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        	  	<div class="col-md-4 strong">	<label>Giá vốn (VNĐ)</label></div>
	        		  <div class="col-md-8">
                  <input type="text" name="Giavon"  class="form-control cldt-giavon" required value="0">
	        		  </div>
              </div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Nhóm món</label></div>
	        		  <div class="col-md-8">
	        			  <select class="form-control cldt-nhommon" name="Nhommon">
                    <option value="">Chọn nhóm món</option>
                    <option value="">None</option>
              <?php $nhommon=get_all_1table('nhommon'); foreach ($nhommon as $nhommonitem){ ?>
                    <option value="<?php echo $nhommonitem['TenNhomMon']; ?>"><?php echo $nhommonitem['TenNhomMon']; ?></option>
              <?php } ?>
                  </select>
	        		  </div>
	        	  </div>
              <div class="row form-group">
	        	  	<div class="col-md-4 strong">	<label>Loại món</label></div>
	        	   	<div class="col-md-8">
	        	  		<select class="form-control cldt-loaisp" name="Loaisp">
                    <option value="">Chọn loại</option>
                    <option value="">None</option>
              <?php $loaihanghoa=get_all_1table('loaihanghoa'); foreach ($loaihanghoa as $loaihhitem){ ?>
                    <option value="<?php echo $loaihhitem['TenLoai']; ?>"><?php echo $loaihhitem['TenLoai']; ?></option>
              <?php } ?>
                  </select>
	        		  </div>
	          	</div>
              <div class="row form-group">
                <div class="col-md-4 strong"><label>Đơn vị tính</label></div>
	        		  <div class="col-md-4">
	        			  <select class="form-control cldt-dvt" name="Dvt">
	        				  <option value="">Chọn đơn vị tính</option>
                    <option value="">None</option>
              <?php $dvt=get_all_1table('dvt'); foreach ($dvt as $dvtitem){ ?>
                    <option value="<?php echo $dvtitem['TenDVT']; ?>"><?php echo $dvtitem['TenDVT']; ?></option>
              <?php } ?>
                  </select>
	        	 	 </div>
               <div class="col-md-4">
                 <input class="form-control cldt-slquydoi" type="text" name="Slquydoi" placeholder="Số lượng quy đổi" value="1"/>
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
              <div class="col-md-4 strong"><label>Mô tả</label></div>
	        		<div class="col-md-8">
	        			<textarea  name="Mota" type="text" class="form-control cldt-mota" multicolum=true rows="3"></textarea>
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
  <div id="Modal-delete" temp-masp="" tabindex="-1" role="dialog" class="modal fade kit-modal__container place-modal-center"style="background: rgba(0, 0, 0,.45);"  >
    <div role="document" class="modal-dialog modal-md mt-5">
      <div class="modal-content"><!---->
        <div class="modal-body" style="max-height: 100%;">
          <p class="text-center mx-auto">Bạn có muốn xoá ? </p>
          <div class="d-flex justify-content-betweeen">
            <button class="btn btn-outline-dark"  data-dismiss="modal">  Huỷ</button>
            <div class="ml-auto">
              <button class="btn btn-danger2 Delete-sanpham" data-dismiss="modal">Xoá
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end Modal-delete -->
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
