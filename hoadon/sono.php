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
    $.ajax({type: "POST", url: 'sidebar-left.php',data:{Childmenu:'Sổ nợ'},success:function(result) {$('.sidebar__container').html(result);}
    });
  </script>
  <!-- thanh chức năng table -->
  <div class="p-0 w-auto" style="overflow:visible" >
    k có gì cả.
  </div><!-- end thanh chức năng -->
  <!-- Ground chứa Table -->
  <div class="container-fluid" >
    theo lý thuyết thì cũng dễ làm xíu là xong nhưng mà có thêm thời gian thì làm
  </div><!-- end Ground chứa table-->
  <div class="alert-login p-1"></div>
</div><!-- end MyGround-->
<div id="Script-hide-load" style="display:none"> </div>
<!-- Xóa Các thẻ script load html chỉ chạy 1 lần-->
<script> $('.willremove').remove(); </script>
</body>
</html>
