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

  // Tìm kiếm theo mã, tên nhóm món load vào table (khi click icon tìm kiếm)
  $(".btn-searchnhom").click(function(){
    var value = $('.input-searchnhom').val();
    $.ajax({type: "POST", url: 'search_table_nhommon.php',data:{searchnhom:value},success:function(result) {$('tbody#tbody_nhommon').html(result);}
    })
  });

  // Delete by MaNhomMon in DATABASE + Xóa ảnh trên host + xóa dòng đó trên table (khi click xác nhận Xóa)
  $(".Delete-nhommon").click(function(){
    var MaNhomMonhientai= $('#Modal-delete').attr('temp-manhommon');
    $.ajax({type: "POST", url: '../libs/delete-1condition.php',data:{table:'nhommon',condition1:"MaNhomMon ='"+MaNhomMonhientai+"'",img:'Hinhanh',diachi:'../images/nhommon/'},success:function(result){
      $('.alert-login').html('<h3 class="success1">Xóa nhóm món thành công</h3>').fadeIn().delay(1500).fadeOut('slow').css('background-color','none');
      setTimeout('$(".alert-login h3").remove()',1500);
      $("tbody#tbody_nhommon tr").each(function() {
        if($(this).attr('temp-manhommon')==MaNhomMonhientai) {$(this).remove();return ;}
      });
  	  }
    });
  });

  // ẨN thẻ thông báo form khi click tạo nhóm
  $(".btn-taonhom").click(function(){
      $('.Thongbao-insert').addClass('d-none');
  });

var called = 1;
  event_click1();
  function event_click1(){
    //Animate change trạng thái + Update trạng thái by MaNhomMon in DATABASE (khi click icon tình trạng)
    $('body').on('click', '.jquery-switch',function (){ if(called==1){
      var MaNhomMon= $(this).attr('temp-manhommon');
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
      $.ajax({type: "POST", url: '../update_trangthai.php',data:{table:'nhommon',obj1:'MaNhomMon',newTrangthai:"'"+trangthai+"'", condition1:"MaNhomMon= '"+MaNhomMon+"'"},success:function(result) {
        $('.alert-login').append(result).fadeIn().delay(1200).fadeOut().css('background-color','none');setTimeout('$(".alert-login h3").remove()',5200);
      }
    });;
    called++;}else {called=1; return ;}
    });

    //Lưu tạm mã nhóm bạn chọn vào Modal-delete (khi click Xóa or icon thùng rác)
    $('body').on('click', '.getdelete-manhommon', function () {
			var MaNhomMon =$(this).attr('tempdata-manhommon');
			$("#Modal-delete").attr('temp-manhommon',MaNhomMon);
    });

    //Ẩn thẻ thông báo update + load thông tin nhóm món vào #Modal-update (khi click icon edit)
    $('body').on('click', '.btn-suanhommon', function () {
      $('.Thongbao-update').addClass('d-none');
      var id = $(this).attr("temp-manhommon");var id2= '#tr-nhommon'+id;
      var trnhommon = $(id2);
      var MaNhomMon =trnhommon.find('.cldt-manhommon').text();
      var TenNhomMon =trnhommon.find('.cldt-tennhommon').text();
      var hinhanh =trnhommon.find('.cldt-hinhanh').attr('src');
      var trangthai =trnhommon.find('.cldt-trangthai').text();
      var modalupdate = $('#Modal-update');
      modalupdate.find('.cldt-manhommon').val(MaNhomMon);
      modalupdate.find('.cldt-tennhommon').val(TenNhomMon);
      modalupdate.find('.cldt-hinhanh').attr('src',hinhanh);
      modalupdate.find('.cldt-hinhanh2').val(hinhanh);
      modalupdate.find('.cldt-trangthai').val(trangthai.trim());
    });

    //load ảnh vào img trong #Modal-hinhanh (khi click vào hình ảnh nhóm món)
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
    $.ajax({type: "POST", url: '../header-top.php',data:{Category:'Thực đơn'},success:function(result) {$('#navigation').append(result);}
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
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Nhóm món'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>
  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    <div class="action-bar__container action-bar-border">
      <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mr-3 action-bar__title ml-3">Nhóm món</h3>
        <div class="flex-1">
          <div class="flex">
            <form class="d-lg-block d-md-none">
              <div class="input-group input-search">
                <input type="text" placeholder="Tìm kiếm mã hoặc tên nhóm món" class="form-control input-searchnhom">
                <div class="input-group-append "><span class="btn-searchnhom cursor-pointer input-group-text" style="background:#3366FF;" ><i style="color:#fff" class="fas fa-search"></i></span>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="ml-auto mr-6 ">
          <button class="btn btn-outline-blue">  Thêm nhóm từ file
          </button>
          <button class="custom-btn2 btn-7 btn-taonhom"  data-toggle="modal" data-target="#Modal-insert">Tạo Nhóm
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
              <th style="width: 15%;">Mã nhóm</th>
              <th style="width: 45%;">Tên nhóm<i class="fas fa-sort ml-1"></i></th>
              <th style="width: 20%;"class="text-left">Hình ảnh</th>
              <th style=" width: 25%;z-index: 3;"class="text-left">
                <div class="d-flex ">
                  <div class=" text-left cursor-pointer d-flex align-items-center">
                    Thao tác <i class="fas fa-sort ml-1"></i>
                  </div>
                </div>
              </th>
            </tr>
          </thead>
          <tbody id="tbody_nhommon" class="border-bottom mysearch1">
      <?php $nhommon=get_all_1table('nhommon');$stt=0; foreach ($nhommon as $nhommonitem){ ?>
            <tr id="tr-nhommon<?php echo $nhommonitem['MaNhomMon']; ?>" temp-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" class="tr-content ">
              <td><?php $stt++; echo $stt; ?></td>
              <td class="cldt-manhommon"><p style="width: 194px;word-wrap:break-word"><?php echo $nhommonitem['MaNhomMon']; ?></p></td>
              <td class="cldt-tennhommon"><?php echo $nhommonitem['TenNhomMon']; ?></td>
              <td class=" imgtable1-ground "><img class="cldt-hinhanh" src="../images/nhommon/<?php echo $nhommonitem['Hinhanh']; ?>" data-toggle="modal" data-target="#Modal-hinhanh"/></td>
              <td class="text-left">
                <label temp-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" class="jquery-switch <?php if($nhommonitem['Trangthai']=="Active") echo 'toggled'; ?> status__toggle mb-0 mr-2" id2=""> <input type="checkbox" class="v-switch-input">
                  <div  class="v-switch-core" style="width: 66px; height: 22px; border-radius: 11px;">
                    <div  class="v-switch-button" <?php if($nhommonitem['Trangthai']=="Active") echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(47px, 3px, 0px);"'; else echo 'style="width: 16px; height: 16px; transition: transform 300ms ease 0s; transform: translate3d(3px, 3px, 0px);"'; ?> >
                    </div>
                  </div>
                  <span class="v-switch-label cldt-trangthai update-trangthai <?php if($nhommonitem['Trangthai']=="Active") echo 'v-left'; else echo'v-right'; ?>" style="line-height: 22px;"><?php echo $nhommonitem['Trangthai']; ?>
                  </span>
                </label>
                <img temp-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" class="mr-2 cursor-pointer btn-suanhommon"src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-manhommon" tempdata-manhommon="<?php echo $nhommonitem['MaNhomMon']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
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
	        <h5 class="modal-title strong">Thêm nhóm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      </div>
        <div class="modal-body">
          <form id="form-insert" action="insert_nhommon.php" method="post" enctype="multipart/form-data" onsubmit="return false">
	           <div class="row form-group">
	              <div class="col-md-4 strong"><label>Tên nhóm <span style="color:red;">(*)</span></label>	</div>
	        	    <div class="col-md-8">
                  <input type="text" name="Tennhommon" placeholder="Nhập tên nhóm món" class="form-control" required/>
	        	    </div>
	        	 </div>
             <div class="row form-group">
  	            <div class="col-md-4 strong"><label>Mã nhóm</label></div>
	        		  <div class="col-md-8 ">
	        			<input type="text" name="Manhommon" placeholder="Nếu để trống hệ thống sẽ tự tạo mã nhóm" class="form-control" />
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
  <div class="modal fade" id="Modal-update"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="background: rgba(0, 0, 0,.45);" >
  	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
        <div class="Thongbao-update p-2"></div>
	      <div class="modal-header">
	        <h5 class="modal-title strong" >Cập nhật Nhóm Món</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	      </div>
        <form id="form-update" action="update_nhommon.php" method="post" enctype="multipart/form-data" onsubmit="return false">
          <div class="modal-body">
            <ul class="nav nav-tabs" role="tablist"><li class="active"><a>Chi tiết</a></li></ul>
            <div class="row form-group">
  	        	<div class="col-md-4 strong"><label>Mã Nhóm món</label></div>
  	        	<div class="col-md-8 "><input type="text" name="Manhommon" class="form-control cldt-manhommon" readonly ></div>
  	        </div>
	        	<div class="row form-group">
	        		<div class="col-md-4 strong"><label>Tên Nhóm món <span style="color:red;">(*)</span></label></div>
	        		<div class="col-md-8">
	        			<input type="text" name="Tennhommon" placeholder="Nhập tên nhóm món" class="form-control cldt-tennhommon" required>
	        		</div>
	        	</div>
            <div class="row form-group">
	        		<div class="col-md-4 strong"><label>Hình ảnh</label></div>
	        		<div class="col-md-8 " style="overflow:visible;z-index:9000;">
                <label>Hình ảnh hiện tại: </label>
                <img  src="../images/nhommon/" style="width:40px;" class="cldt-hinhanh"  value="" data-toggle="modal" data-target="#Modal-hinhanh"/>
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
	      	</div>
	      	<div class="modal-footer">
	        	<button name="Submit-update" type="submit" class="custom-btn btn-9 Update-nhommon"><i class="fa fa-floppy-o" aria-hidden="true"></i> Cập nhật</button>
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
              <button class="btn btn-danger2 Delete-nhommon" data-dismiss="modal">Xoá
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
