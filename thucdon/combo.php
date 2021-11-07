<?php
session_start();
if (!isset($_SESSION['username'])){
  header("location: ../dangnhap.php");die;}
if ($_SESSION['level']!=1){
  header("location: ../index.php");die;}
include '../ketnoi.php';
include '../libs/all-1table.php';
include '../head1.php';
?>
<script>
$(document).ready(function() {
  <?php include '../animate1.php'; ?>//thêm animate
  <?php include '../event-form-submit-noload.php'; ?> //thêm 2 event để form ko load lại trang

  // Tìm kiếm theo mã, tên combo load vào table (khi click icon tìm kiếm)
  $(".btn-searchcombo").click(function(){
    var value = $('.input-searchcombo').val();
    $.ajax({type: "POST", url: 'search_table_combo.php',data:{searchcombo:value},success:function(result) {$('tbody#tbody_combo').html(result);}
    })
  });

  // Delete by MaSP in DATABASE + Xóa ảnh trên host + xóa dòng đó trên table (khi click xác nhận Xóa)
  $(".Delete-combo").click(function(){
    var Macombohientai= $('#Modal-delete').attr('temp-masp');
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'sanpham', condition1:"MaSP ='"+Macombohientai+"'",img:'Hinhanh',diachi:'../images/sanpham/'},success:function(result){
      $('.alert-login').html('<h3 class="success1">Xóa Combo thành công</h3>').fadeIn().delay(1500).fadeOut('slow').css('background-color','none');
      setTimeout('$(".alert-login h3").remove()',1500);
      $("tbody#tbody_combo tr").each(function() {
        if($(this).attr('temp-masp')==Macombohientai) {$(this).remove();return ;}
      });
  	  }
    });
  });

  // ẨN thẻ thông báo form khi click tạo Combo
  $(".btn-taocombo").click(function(){
      $('.Thongbao-insert').addClass('d-none');
  });
var called = 1;
  event_click1();
  function event_click1(){
    //Animate change trạng thái + Update trạng thái by MaSP in DATABASE (khi click icon tình trạng)
    $('body').on('click', '.jquery-switch',function (){ if(called==1){
      var Macombo= $(this).attr('temp-masp');
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

    //Lưu tạm mã Combo bạn chọn vào Modal-delete (khi click Xóa or icon thùng rác)
    $('body').on('click', '.getdelete-masp', function () {
			var Macombo =$(this).attr('tempdata-masp');
			$("#Modal-delete").attr('temp-masp',Macombo);
    });

    //Ẩn thẻ thông báo update + load thông tin Combo vào #Modal-update (khi click icon edit)
    $('body').on('click', '.btn-suacombo', function () {
      $('.Thongbao-update').addClass('d-none');
      var id = $(this).attr("temp-masp");var id2= '#tr-combo'+id;
      var trcombo = $(id2);
      var Macombo =trcombo.find('.cldt-masp').text();
      var Tencombo =trcombo.find('.cldt-tensp').text();
      var hinhanh =trcombo.find('.cldt-hinhanh').attr('src');
      var Giavon =trcombo.find('.cldt-giavon').attr('id2');
      var Giasp =trcombo.find('.cldt-giasp').attr('id2');
      var trangthai =trcombo.find('.cldt-trangthai').text();
      var Mota =trcombo.find('.cldt-Mota').text();
      var modalupdate = $('#Modal-update');
      modalupdate.find('.cldt-masp').val(Macombo);
      modalupdate.find('.cldt-tensp').val(Tencombo);
      modalupdate.find('.cldt-giavon').val(Giavon);
      modalupdate.find('.cldt-giasp').val(Giasp);
      modalupdate.find('.cldt-hinhanh').attr('src',hinhanh);
      modalupdate.find('.cldt-hinhanh2').val(hinhanh);
      modalupdate.find('.cldt-trangthai').val(trangthai.trim());
      modalupdate.find('.cldt-mota').val(Mota);
    });

    //load ảnh vào img trong #Modal-hinhanh (khi click vào hình ảnh Combo)
    $('body').on('click', '.cldt-hinhanh', function () {
      var hinhanh = $(this).attr('src');
      $('#Modal-hinhanh .images').attr('src',hinhanh);
    });
}//end event_click1()
});
</script>
</head>
<body>
<header>
  <section id="navigation" class="st-navigation" style="overflow: visible">
    <script  class="willremove">
    // Thanh header-top navbar
    $.ajax({type: "POST", url: '../header-top.php',data:{Category:'Quản lý thực đơn'},success:function(result) {$('#navigation').append(result);}
    });
    // Thanh Modal-Mainmenu (khi lick vào icon danh mục)
    $.ajax({type: "POST", url: '../main-menu.php',data:{Mainmenu:'Thực đơn'},success:function(result) {$('#navigation').append(result);}
    });
    </script>
 </section>
</header>
<div class="Myground" style="background-color:white" >
  <!-- Thanh menu con bên trái -->
  <div class="sidebar__container float-left active" style="float:left"></div>
  <script class="willremove">
    // load thanh menu con bên trái
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Combo'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>
  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    <div class="action-bar__container action-bar-border">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mr-3 action-bar__title ml-3">Combo</h3>
        <div class="flex-1">
          <div class="flex">
            <form class="d-lg-block d-md-none">
              <div class="input-group input-search">
                <input type="text" placeholder="Tìm kiếm mã hoặc tên Combo" class="form-control input-searchcombo">
                <div class="input-group-append "><span class="btn-searchcombo cursor-pointer input-group-text" style="background:#3366FF;" ><i style="color:#fff" class="fas fa-search"></i></span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="ml-auto mr-6 ">
          <button class="btn btn-outline-blue">  Thêm combo từ file
          </button>
          <button class="custom-btn2 btn-7 btn-taocombo" data-toggle="modal" data-target="#Modal-insert">Tạo Combo
          </button>
        </div>
      </div>
    </div>
  </div><!-- end thanh chức năng table-->
  <!-- Ground chứa Table -->
  <div class="container-fluid" style="min-height: 100vh;">
    <div class="row">
      <div class="col-12 list-view__table">
        <table class="table mytable list-view__table hover-table-1">
          <thead class="thead-light">
            <tr>
              <th style="width: 5%;">#</th>
              <th style="width: 10%;">Mã Combo</th>
              <th style="width: 9%;" class="text-left">Hình ảnh</th>
              <th style="width: 52%;">Tên Combo<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 9%;" class="text-right" >Giá vốn<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 9%;" class="text-right" >Giá bán<i class="fas fa-sort ml-1"></i></th>
              <th style=" width: 10%;z-index: 3;" class="text-left">
                <div class="d-flex ">
                  <div class=" text-left cursor-pointer d-flex align-items-center">
                    Thao tác <i class="fas fa-sort ml-1"></i>
                  </div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody id="tbody_combo" class="border-bottom mysearch1">
      <?php include '../libs/get-1condition.php'; $sanpham=get_1condition('sanpham','*',"LoaiSP= 'Combo'");$stt=0; foreach ($sanpham as $sanphamitem){ ?>
            <tr id="tr-combo<?php echo $sanphamitem['MaSP']; ?>" temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="tr-content ">
              <td><?php $stt++; echo $stt; ?></td>
              <td class="cldt-masp"><p style="width: 80px;word-wrap:break-word" ><?php echo $sanphamitem['MaSP']; ?> </p></td>
              <td class=" imgtable1-ground "><img class="cldt-hinhanh" src="../images/sanpham/<?php echo $sanphamitem['Hinhanh']; ?>"  data-toggle="modal" data-target="#Modal-hinhanh"/></td>
              <td class="cldt-tensp"><?php echo $sanphamitem['TenSP']; ?></td>
              <td class="cldt-giavon text-right" id2="<?php echo $sanphamitem['Giavon']; ?>" ><?php echo number_format($sanphamitem['Giavon'],0,"",","); ?> đ</td>
              <td class="cldt-giasp text-right giamon" id2="<?php echo $sanphamitem['GiaSP']; ?>"><?php echo number_format($sanphamitem['GiaSP'],0,"",","); ?> đ</td>
              <td class="text-left">
                <label temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="jquery-switch <?php if($sanphamitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
                  <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
                    <div  class="v-switch-button" <?php if($sanphamitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
                    </div>
                  </div>
                  <span class="v-switch-label cldt-trangthai update-trangthai <?php if($sanphamitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $sanphamitem['Trangthai']; ?>
                  </span>
                </label>
                <img temp-masp="<?php echo $sanphamitem['MaSP']; ?>" class="mr-2 cursor-pointer btn-suacombo" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-masp" tempdata-masp="<?php echo $sanphamitem['MaSP']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
                <textarea class="cldt-Mota d-none"><?php echo $sanphamitem['Mota']; ?> </textarea>
              </td>
            </tr>
      <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div><!-- end Ground chứa Table -->
  <!-- Modal-insert -->
  <div class="modal fade" id="Modal-insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="background: rgba(0, 0, 0,.45);" >
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
        <div class="Thongbao-insert p-2"></div>
	      <div class="modal-header">
	        <h5 class="modal-title strong">Thêm Combo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      </div>
        <div class="modal-body">
          <form id="form-insert" action="insert_combo.php" method="post" enctype="multipart/form-data" onsubmit="return false">
	           <div class="row form-group">
	              <div class="col-md-4 strong"><label>Tên Combo<span style="color:red;">(*)</span></label>	</div>
	        	    <div class="col-md-8">
                  <input type="text" name="Tensp" placeholder="Nhập tên Combo" class="form-control" required/>
	        	    </div>
	        	 </div>
             <div class="row form-group">
  	            <div class="col-md-4 strong"><label>Mã Combo</label></div>
	        		  <div class="col-md-8 ">
	        			<input type="text" name="Masp" placeholder="Nếu để trống hệ thống sẽ tự tạo mã combo" class="form-control" />
	        		  </div>
	        	 </div>
             <div class="row form-group">
               <div class="col-md-4 strong"><label>Giá bán (VNĐ)</label></div>
               <div class="col-md-8">
                 <input type="number" name="Giasp"  class="form-control cldt-giasp" value="0" required/>
               </div>
             </div>
             <div class="row form-group">
               <div class="col-md-4 strong">	<label>Giá vốn (VNĐ)</label></div>
               <div class="col-md-8">
                 <input type="number" name="Giavon"  class="form-control cldt-giavon" required value="0">
               </div>
             </div>
             <div class="row form-group">
	        		 <div class="col-md-4 strong">	<label>Hình ảnh</label></div>
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
 	        			<textarea  name="Mota" class="form-control cldt-mota" rows="4"></textarea>
 	        		</div>
 	        	</div>
	     </div>
	     <div class="modal-footer">
         <button name="Submit-insert" type="submit" class=" mr-auto custom-btn btn-9 Insert-sanpham"><span class="fa fa-plus mr-1"></span>Thêm</button>
         <button type="reset" class="custom-btn3 btn-5"><i class="fa fa-floppy-o" aria-hidden="true"></i> Nhập lại</button>
	        <button type="button" class="custom-btn btn-10" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	     </div>
        </form>
	    </div><!-- end Modal content-->
  	</div>
  </div><!-- end Modal insert -->
  <!-- Modal-update -->
  <div class="modal fade" id="Modal-update" tabindex="-1" role="dialog"  style="background: rgba(0, 0, 0,.45);" >
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
        <div class="Thongbao-update p-2"></div>
	      <div class="modal-header">
	        <h5 class="modal-title strong" >Cập nhật Combo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      </div>
        <form id="form-update" action="update_combo.php" method="post" enctype="multipart/form-data" onsubmit="return false">
          <div class="modal-body">
            <ul class="nav nav-tabs" role="tablist"><li class="active"><a>Chi tiết</a></li></ul>
            <div class="row form-group">
  	        	<div class="col-md-4 strong"><label>Mã Combo</label></div>
  	        	<div class="col-md-8 "><input type="text" name="Masp" class="form-control cldt-masp" readonly ></div>
  	        </div>
	        	<div class="row form-group">
	        		<div class="col-md-4 strong"><label>Tên Combo<span style="color:red;">(*)</span></label></div>
	        		<div class="col-md-8">
	        			<input type="text" name="Tensp" placeholder="Nhập tên Combo" class="form-control cldt-tensp" required>
	        		</div>
	        	</div>
            <div class="row form-group">
              <div class="col-md-4 strong"><label>Giá bán (VNĐ)</label></div>
              <div class="col-md-8">
                <input type="number" name="Giasp"  class="form-control cldt-giasp" value="0" required/>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-4 strong">	<label>Giá vốn (VNĐ)</label></div>
              <div class="col-md-8">
                <input type="number" name="Giavon"  class="form-control cldt-giavon" required value="0">
              </div>
            </div>
            <div class="row form-group">
	        		<div class="col-md-4 strong"><label>Hình ảnh</label></div>
	        		<div class="col-md-8 " style="overflow:visible;z-index:9000;">
                <label>Hình ảnh hiện tại: </label>
                <img  src="../images/sanpham/" style="width:40px;" class="cldt-hinhanh"  value="" data-toggle="modal" data-target="#Modal-hinhanh"/>
                <input type="file" name="Hinhanh" id="image_file2" class="form-control"/>
                <input type="text" name="Hinhanhhientai" class=" cldt-hinhanh2 d-none" value=""/>
	        		</div>
	        	</div>
            <div class="row form-group">
	        		<div class="col-md-4 strong"><label>Trạng thái</label></div>
	        		<div class="col-md-8">
                <select class="form-control cldt-trangthai" style="color:green" name="Trangthai">
	        				<option style="color:green" value="Active">Active</option>
                  <option selected="selected" style="color:red" value="Deactive">Deactive</option>
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
	        	<button name="Submit-update" type="submit" class="custom-btn btn-9 Update-combo"><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
	        	<button type="button" class="custom-btn btn-10" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	      	</div>
        </form>
	    </div><!-- end modal content-->
  	</div>
  </div><!-- end Modal-update-->
  <!-- Modal-delete-->
    <div id="Modal-delete" temp-masp="" tabindex="-1" role="dialog" class="modal fade kit-modal__container place-modal-center"style="background: rgba(0, 0, 0,.45);"  >
    <div role="document" class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-body" style="max-height: 100%;"><p class="text-center mx-auto">Bạn có muốn xoá ?</p>
          <div class="d-flex justify-content-betweeen">
            <button class="btn btn-outline-dark"  data-dismiss="modal">  Huỷ
            </button>
            <div class="ml-auto"><!-- justify-content-betweeen dont work -->
              <button class="btn btn-danger2 Delete-combo" data-dismiss="modal">Xoá
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end Modal-delete-->
  <!-- Modal-hinhanh-->
  <div id="Modal-hinhanh" temp-masp="" tabindex="-1" role="document" class="modal modal-xemanh" style="background: rgba(0, 0, 0,.88);z-index:99998;"  >
    <span class="close" data-dismiss="modal">&times;</span>
    <img class=" modal-content images"  src=""  />
    <div id="caption"> Modal Xem ảnh</div>
  </div><!-- end Modal-hinhanh-->
  <div class="alert-login"></div>
</div><!-- end My ground -->
<!-- Xóa Các thẻ script load html chỉ chạy 1 lần-->
<script> $('.willremove').remove(); </script>
</body>
</html>
