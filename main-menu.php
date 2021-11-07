<?php
if(isset($_POST['Mainmenu'])){ ?>
  <!--Thanh Modal-Mainmenu (khi lick vào icon danh mục) -->
  <div class="modal modal_outer left_modal fade" id="Modal-Mainmenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="background: rgba(0, 0, 0,.45);" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header p-0" >
          <button type="button w-100" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body ">
          <div class="menu">
            <div class="list-menu__container">
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><a href="../tongquan"><img  src="../images/main/tongquan.jpg" alt="Trang chủ" class="icon"> </a></div>
                <p class="mt-2 menu-label text-primary text-center">Tổng quan</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><a href="../pos"><img src="../images/main/order.png"alt="Chương trình" class="icon"> </a></div>
                <p class="mt-2 menu-label text-primary text-center">Order</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><a href="../thucdon"><img src="../images/main/thucdon.jpg" alt="Chương trình" class="icon"></a></div>
                <p class="mt-2 menu-label text-primary text-center">Thực đơn</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><a href="../hoadon"><img src="../images/main/hoadon.png" alt="Chương trình" class="icon"></a></div>
                <p class="mt-2 menu-label text-primary text-center large-title-menu">Hóa đơn</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><img src="../images/main/thongke.png" alt="Chương trình" class="icon"></div>
                <p class="mt-2 menu-label text-primary text-center large-title-menu">Thống kê</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><img src="../images/main/baocao.jpg" alt="Chương trình" class="icon"></div>
                <p class="mt-2 menu-label text-primary text-center large-title-menu">Báo cáo</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><a href="../nhanvien"><img src="../images/main/nhanvien.jpg"  alt="Chương trình" class="icon"/></a></div>
                <p class="mt-2 menu-label text-primary text-center large-title-menu">Nhân viên</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><img src="../images/main/ban.jpg" alt="Chương trình" class="icon"></div>
                <p class="mt-2 menu-label text-primary text-center large-title-menu">Bàn</p>
              </div>
              <div class="list-menu__item hover-zoom-images">
                <div class="d-block list-menu-item__icon cursor-pointer"><a href="../khachhang"><img src="../images/main/khachhang.png" alt="Chương trình" class="icon"> </a></div>
                <p class="mt-2 menu-label text-primary text-center large-title-menu">Khách hàng</p>
              </div>
            </div>
          </div>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div>
  </div><!-- end Modal-Mainmenu -->
  <script class="willremove">
    //Design Màu xanh cho menu chính hiện tại + xóa href
    $('.list-menu__container .list-menu__item').each(function () {
        var finding = $(this).find('.menu-label').text();
        if (finding.trim()== <?php echo "'".$_POST['Mainmenu']."'"; ?>){
        $(this).removeClass('hover-zoom-images');
        $(this).addClass('active');
        $(this).find('a').removeAttr('href');}
    });
    $('.willremove').remove();
  </script>
   <?php
} ?>
