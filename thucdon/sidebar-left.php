<?php
if(isset($_POST['Childmenu'])){ ?>
  <div class="sidebar-menu__container">
    <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn toggle-sidebar-left"> <i class="fas fa-chevron-left"></i> <i class="fa fa-chevron-right d-none"></i></button>
    </div>
    <div class="navbar-header"><label>Quản lý thực đơn</label></div>
    <div class="menu">
      <ul class="nav navbar-nav2">
        <li><a href="../thucdon" class="menu-item">Món ăn</a></li>
        <li><a href="nhommon.php" class=" menu-item">Nhóm món</a></li>
        <li><a href="combo.php" class="menu-item">Combo</a></li>
        <li><a class="menu-item">Thiết lập bảng giá</a></li>
        <li><a href="donvitinh.php" class="menu-item">Đơn vị tính</a></li>
        <li><a href="loaihanghoa.php" class="menu-item">Loại hàng hóa</a></li>
      </ul>
    </div>
  </div><!-- end Thanh menu con bên trái -->
  <script>
    //Design Màu nâu cho menu con hiện tại + xóa href
    $('.sidebar-menu__container .menu-item').each(function () {
        var finding = $(this).text();
        if (finding.trim()== <?php echo "'".$_POST['Childmenu']."'"; ?>){
        $(this).parent('li').addClass('sidebar-left-active');
        $(this).removeAttr('href');$(this).addClass('active');
      }
    });
  </script>
   <?php
} ?>
