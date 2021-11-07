<?php
if(isset($_POST['Childmenu'])){ ?>
  <div class="sidebar-menu__container">
    <div class="custom-menu">
    <button type="button" id="sidebarCollapse" class="btn toggle-sidebar-left"> <i class="fas fa-chevron-left"></i> <i class="fa fa-chevron-right d-none"></i></button>
    </div>
    <div class="navbar-header"><label>Quản lý hóa đơn</label></div>
    <div class="menu">
      <ul class="nav navbar-nav2">
        <li><a href="../hoadon" class="text-link-dark menu-item">Hóa đơn</a></li>
        <li id="sidebar-drop1" data-toggle="collapse" href="#dropdown-lvl1">
            <a class="main-drop">Sổ nợ<span class="fa fa-chevron-right float-right"></span></a>
        </li>
        <li>
          <div id="dropdown-lvl1" class="panel-collapse collapse">
              <ul class="nav navbar-nav2 navbar-nav " parent="sidebar-drop1" >
                <li><a class="menu-item" href="sono.php">Sổ nợ</a></li>
                <li><a href="#">Lịch sử trả nợ</a></li>
              </ul>
          </div>
        </li>
        <li><a class="menu-item">Lịch sử trả món</a></li>
      </ul>
    </div>
  </div><!-- end Thanh menu con bên trái -->
  <script>
    //Design Màu nâu cho menu con hiện tại + xóa href
    $('.sidebar-menu__container .menu-item').each(function () {
        var finding = $(this).text();
        if (finding.trim()== <?php echo "'".$_POST['Childmenu']."'"; ?>){
          var parent=$(this).parent('li');parent.addClass('sidebar-left-active');
          var parent0= parent.parent('ul').attr('parent');if( (parent0=='') || (parent0=='undefined') ) ; else $('#'+parent0).click();
          $(this).removeAttr('href');$(this).addClass('active');}
    });
  </script>
   <?php
} ?>
