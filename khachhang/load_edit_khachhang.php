<?php
if(isset($_POST['MaKH'])){
  include '../ketnoi.php';
  include '../libs/get-1condition.php';
  $makh=$_POST['MaKH'];
  $khachhang= get_1condition('khachhang','*',"MaKH= '$makh'"); foreach ($khachhang as $khachhangitem){ ?>
    <textarea class='d-none temp-textarea'><?php echo $khachhangitem['Diachi']; ?></textarea>
    <textarea class='d-none temp-textarea2'><?php echo $khachhangitem['Ghichu']; ?></textarea>
  <script>
    var modalupdate = $('#Modal-update');
    modalupdate.find('.cldt-makh').val('<?php echo $khachhangitem['MaKH']; ?>');
    modalupdate.find('.cldt-tenkh').val('<?php echo $khachhangitem['TenKH']; ?>');
    modalupdate.find('.cldt-username').val('<?php echo $khachhangitem['Username']; ?>');
    modalupdate.find('.cldt-gioitinh').val('<?php echo $khachhangitem['Gioitinh']; ?>');
    modalupdate.find('.cldt-sdt').val('<?php echo $khachhangitem['SDT']; ?>');
    modalupdate.find('.cldt-email').val('<?php echo $khachhangitem['Email']; ?>');
    modalupdate.find('.cldt-trangthai').val('<?php echo $khachhangitem['Trangthai']; ?>');
    modalupdate.find('.cldt-birthday').val('<?php echo $khachhangitem['Birthday']; ?>');
    modalupdate.find('.cldt-ngaytao').val('<?php echo $khachhangitem['Ngaytao']; ?>');
    modalupdate.find('.cldt-duno').val('<?php echo $khachhangitem['Duno']; ?>');
    modalupdate.find('.cldt-diemthuong').val('<?php echo $khachhangitem['Diemthuong']; ?>');
    modalupdate.find('.cldt-ngaytao').val('<?php echo $khachhangitem['Ngaytao']; ?>');
    modalupdate.find('.cldt-hinhanh').attr('src','<?php echo '../images/khachhang/'.$khachhangitem['Avatar']; ?>');
    modalupdate.find('.cldt-hinhanh2').val('<?php echo '../images/khachhang/'.$khachhangitem['Avatar']; ?>');
    modalupdate.find('.cldt-capdo').val('<?php echo $khachhangitem['Capdo']; ?>');
    modalupdate.find('.cldt-tonggiaodich').val('<?php echo $khachhangitem['Tonggiaodich']; ?>');
    var diachi = $('#Script-hide-load .temp-textarea').text();
    modalupdate.find('.cldt-diachi').text(diachi);
    var ghichu = $('#Script-hide-load .temp-textarea2').text();
    modalupdate.find('.cldt-ghichu').text(ghichu);
  </script>;
<?php  }//end foreach sannpham
} ?>
