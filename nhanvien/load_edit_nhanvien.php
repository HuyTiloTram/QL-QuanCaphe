<?php
if(isset($_POST['MaNV'])){
  include '../ketnoi.php';
  include '../libs/get-1condition.php';
  $manv=$_POST['MaNV'];
  $nhanvien= get_1condition('nhanvien','*',"MaNV= '$manv'"); foreach ($nhanvien as $nhanvienitem){ ?>
    <textarea class='d-none temp-textarea'><?php echo $nhanvienitem['Diachi']; ?></textarea>
  <script>
    var modalupdate = $('#Modal-update');
    modalupdate.find('.cldt-manv').val('<?php echo $nhanvienitem['MaNV']; ?>');
    modalupdate.find('.cldt-tennv').val('<?php echo $nhanvienitem['TenNV']; ?>');
    modalupdate.find('.cldt-chucvu').val('<?php echo $nhanvienitem['Chucvu']; ?>');
    modalupdate.find('.cldt-username').val('<?php echo $nhanvienitem['Username']; ?>');
    modalupdate.find('.cldt-gioitinh').val('<?php echo $nhanvienitem['Gioitinh']; ?>');
    modalupdate.find('.cldt-sdt').val('<?php echo $nhanvienitem['SDT']; ?>');
    modalupdate.find('.cldt-cccd').val('<?php echo $nhanvienitem['CCCD']; ?>');
    modalupdate.find('.cldt-email').val('<?php echo $nhanvienitem['Email']; ?>');
    modalupdate.find('.cldt-trangthai').val('<?php echo $nhanvienitem['Trangthai']; ?>');
    modalupdate.find('.cldt-birthday').val('<?php echo $nhanvienitem['Birthday']; ?>');
    modalupdate.find('.cldt-namvao').val('<?php echo $nhanvienitem['Namvao']; ?>');
    modalupdate.find('.cldt-hinhanh').attr('src','<?php echo '../images/nhanvien/'.$nhanvienitem['Avatar']; ?>');
    modalupdate.find('.cldt-hinhanh2').val('<?php echo '../images/nhanvien/'.$nhanvienitem['Avatar']; ?>');
    var diachi = $('#Script-hide-load .temp-textarea').text();
    modalupdate.find('.cldt-diachi').text(diachi);
  </script>;
<?php  }//end foreach sannpham
} ?>
