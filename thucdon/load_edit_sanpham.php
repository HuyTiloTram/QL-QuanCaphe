<?php
if(isset($_POST['MaSP'])){
  include '../ketnoi.php';
  include '../libs/get-1condition.php';
  $masp=$_POST['MaSP'];
  $sanpham= get_1condition('sanpham','*',"MaSP= '$masp'"); foreach ($sanpham as $sanphamitem){ ?>
  <textarea class='d-none temp-textarea'><?php echo $sanphamitem['Mota']; ?></textarea>
  <script>
    var modalupdate = $('#Modal-update');
    modalupdate.find('.cldt-masp').val('<?php echo $sanphamitem['MaSP']; ?>');
    modalupdate.find('.cldt-tensp').val('<?php echo $sanphamitem['TenSP']; ?>');
    modalupdate.find('.cldt-giasp').val('<?php echo $sanphamitem['GiaSP']; ?>');
    modalupdate.find('.cldt-giavon').val('<?php echo $sanphamitem['Giavon']; ?>');
    modalupdate.find('.cldt-dvt').val('<?php echo $sanphamitem['DVT']; ?>');
    modalupdate.find('.cldt-slquydoi').val('<?php echo $sanphamitem['SLquydoi']; ?>');
    modalupdate.find('.cldt-hinhanh').attr('src','<?php echo '../images/sanpham/'.$sanphamitem['Hinhanh']; ?>');
    modalupdate.find('.cldt-hinhanh2').val('<?php echo '../images/sanpham/'.$sanphamitem['Hinhanh']; ?>');
    modalupdate.find('.cldt-loaisp').val('<?php echo $sanphamitem['LoaiSP']; ?>');
    modalupdate.find('.cldt-nhommon').val('<?php echo $sanphamitem['NhomMon']; ?>');
    modalupdate.find('.cldt-trangthai').val('<?php echo $sanphamitem['Trangthai']; ?>');
    var mota = $('#Script-hide-load .temp-textarea').text();
    modalupdate.find('.cldt-mota').text(mota);
  </script>;
<?php  }//end foreach sannpham
} ?>
