<?php
if(isset($_POST['user']))
{
 echo 'Bạn đã gửi dữ liệu của người dùng = '.$_POST['user'].' thành công';
}else{
 echo 'Không nhận được dữ liệu của người dùng nào';
}
?>
