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

  // Delete by MaLoai in DATABASE + xóa dòng đó trên table (khi click xác nhận Xóa)
  $(".Delete-loai").click(function(){
    var Maloaihientai= $('#Modal-delete').attr('temp-maloai');
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'loaihanghoa',condition1:"MaLoai ='"+Maloaihientai+"'"},success:function(result){
      $('.alert-login').html('<h3 class="success1">Xóa loại hàng hóa thành công</h3>').fadeIn().delay(1500).fadeOut('slow').css('background-color','none');
      setTimeout('$(".alert-login h3").remove()',1500);
      $("tbody#tbody_loai tr").each(function() {
        if($(this).attr('temp-maloai')==Maloaihientai) {$(this).remove();return ;}
      });
  	  }
    });
  });

  // ẨN thẻ thông báo form (khi click Tạo Loại)
  $(".btn-taoloai").click(function(){
      $('.Thongbao-insert').addClass('d-none');
  });

  event_click1();
  function event_click1(){
    //Lưu tạm mã loại bạn chọn vào Modal-delete (khi click Xóa or icon thùng rác)
    $('body').on('click', '.getdelete-Maloai', function () {
			var Maloai =$(this).attr('tempdata-maloai');
			$("#Modal-delete").attr('temp-maloai',Maloai);
    });

    //Ẩn thẻ thông báo update + load thông tin Loại vào #Modal-update (khi click icon edit)
    $('body').on('click', '.btn-sualoai', function () {
      $('.Thongbao-update').addClass('d-none');
      var id = $(this).attr("temp-maloai");var id2= '#tr-loai'+id;
      var trloai = $(id2);
      var Maloai =trloai.find('.cldt-maloai').text();
      var Tenloai =trloai.find('.cldt-tenloai').text();
      var Mota =trloai.find('.cldt-mota').text();
      var modalupdate = $('#Modal-update');
      modalupdate.find('.cldt-maloai').val(Maloai);
      modalupdate.find('.cldt-tenloai').val(Tenloai);
      modalupdate.find('.cldt-mota').val(Mota);
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
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Loại hàng hóa'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>
  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    <div class="action-bar__container action-bar-border">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mr-3 action-bar__title ml-3">Loại hàng</h3>
        <div class="ml-auto mr-6 ">
          <button class="custom-btn2 btn-7 btn-taoloai" data-toggle="modal" data-target="#Modal-insert">Tạo Loại</button>
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
              <th style="width: 15%;">Mã loại</th>
              <th style="width: 30%;">Tên loại<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 40%;"class="text-left">Mô tả</th>
              <th style=" width:20%;z-index: 3;"class="text-left">
                <div class="d-flex ">
                  <div class=" text-left cursor-pointer d-flex align-items-center">Thao tác</div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody id="tbody_loai" class="border-bottom mysearch1">
      <?php $loaihanghoa=get_all_1table('loaihanghoa');$stt=0; foreach ($loaihanghoa as $loaihhitem){ ?>
            <tr id="tr-loai<?php echo $loaihhitem['MaLoai']; ?>" temp-maloai="<?php echo $loaihhitem['MaLoai']; ?>" class="tr-content ">
              <td ><?php $stt++; echo $stt; ?></td>
              <td class="cldt-maloai"  style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;"><?php echo $loaihhitem['MaLoai']; ?></td>
              <td class="cldt-tenloai"><?php echo $loaihhitem['TenLoai']; ?></td>
              <td class="cldt-mota"><?php echo $loaihhitem['Mota']; ?> </td>
              <td class="text-left">
                <img temp-maloai="<?php echo $loaihhitem['MaLoai']; ?>" class="mr-2 cursor-pointer btn-sualoai"src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-Maloai" tempdata-maloai="<?php echo $loaihhitem['MaLoai']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
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
	        <h5 class="modal-title strong">Thêm Loại</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      </div>
        <div class="modal-body">
          <form id="form-insert" action="insert_loai.php" method="post" enctype="multipart/form-data" onsubmit="return false">
	           <div class="row form-group">
	              <div class="col-md-4 strong"><label>Tên Loại <span style="color:red;">(*)</span></label>	</div>
	        	    <div class="col-md-8">
                  <input type="text" name="Tenloai" placeholder="Nhập tên loại hàng hóa" class="form-control" required/>
	        	    </div>
	        	 </div>
             <div class="row form-group">
  	            <div class="col-md-4 strong"><label>Mã Loại</label></div>
	        		  <div class="col-md-8 ">
	        			<input type="text" name="Maloai" placeholder="Nếu để trống hệ thống sẽ tự tạo mã Loại" class="form-control" />
	        		  </div>
	        	 </div>
             <div class="row form-group">
               <div class="col-md-4 strong"><label>Mô tả</label></div>
               <div class="col-md-8">
                 <textarea  name="Mota" class="form-control cldt-mota " rows="3"></textarea>
               </div>
             </div>
	     </div>
	     <div class="modal-footer">
         <button name="Submit-insert" type="submit" class=" mr-auto custom-btn btn-9 Insert-sanpham"><span class="fa fa-plus mr-1"></span>Thêm</button>
         <button type="reset" class="custom-btn3 btn-5"><i class="fa fa-floppy-o" aria-hidden="true"></i> Nhập lại</button>
	        <button type="button" class="custom-btn btn-10"  data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
	     </div>
        </form>
	    </div><!-- end Modal content-->
  	</div>
  </div><!-- end Modal insert -->
  <!-- Modal-update -->
  <div class="modal fade" id="Modal-update" temp-masp="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="background: rgba(0, 0, 0,.45);" >
    <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
        <div class="Thongbao-update p-2"></div>
	      <div class="modal-header">
	        <h5 class="modal-title strong" >Cập nhật Loại Hàng Hóa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      </div>
        <form id="form-update" action="update_loai.php" method="post" enctype="multipart/form-data" onsubmit="return false">
          <div class="modal-body">
            <ul class="nav nav-tabs" role="tablist"><li class="active"><a>Chi tiết</a></li></ul>
            <div class="row form-group">
  	        	<div class="col-md-4 strong"><label>Mã Loại</label></div>
  	        	<div class="col-md-8 "><input type="text" name="Maloai" class="form-control cldt-maloai" readonly ></div>
  	        </div>
	        	<div class="row form-group">
	        		<div class="col-md-4 strong"><label>Tên Loại <span style="color:red;">(*)</span></label></div>
	        		<div class="col-md-8">
	        			<input type="text" name="Tenloai" placeholder="Nhập tên loại hàng hóa" class="form-control cldt-tenloai" required>
	        		</div>
	        	</div>
            <div class="row form-group">
              <div class="col-md-4 strong"><label>Mô tả</label></div>
	        		<div class="col-md-8">
	        			<textarea  name="Mota" class="form-control cldt-mota" rows="5"></textarea>
	        		</div>
	        	</div>
	      	</div>
	      	<div class="modal-footer">
	        	<button name="Submit-update" type="submit" class="custom-btn btn-9 Update-loai"><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
	        	<button type="button" class="custom-btn btn-10" style="background-color:ORange;" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Bỏ qua</button>
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
              <button class="btn btn-danger2 Delete-loai" data-dismiss="modal">Xoá
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end Modal-delete-->
  <div class="alert-login"></div>
</div><!-- end My ground -->

<!-- Xóa Các thẻ script load html chỉ chạy 1 lần-->
<script> $('.willremove').remove(); </script>
</body>
</html>
