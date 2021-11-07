
<?php
if(isset($_POST['searchnv'])){
  include '../ketnoi.php';
  $sql= $_POST['searchnv'];
  $limit= $_POST['limit'];
  $sql =  $sql.' LIMIT '.$limit;
  $result =mysqli_query($conn,$sql);
  $count =mysqli_num_rows($result);
  if($count>0){
    $stt=$_POST['stt'];
    while ($membersitem = mysqli_fetch_array($result)) { ?>
      <tr id="tr-nhanvien<?php echo $membersitem['MaNV']; ?>" temp-manv="<?php echo $membersitem['MaNV']; ?>" class="tr-content ">
        <td><?php $stt++; echo $stt; ?></td>
        <td class="cldt-username"><?php echo $membersitem['username']; ?> </td>
        <td class="cldt-password"><p style="width: 80px;word-wrap:normal;overflow:auto;" ><?php echo $membersitem['password']; ?> </p></td>
        <td class="cldt-fullname"><?php echo $membersitem['fullname']; ?></td>
        <td class="cldt-sex"><?php echo $membersitem['sex']; ?></td>
        <td class="cldt-email"><?php echo $membersitem['email']; ?></td>
        <td class="cldt-phone"><?php echo $membersitem['phone']; ?></td>
        <td class="cldt-birthday"><?php echo $membersitem['birthday']; ?></td>
        <td class="cldt-level"><?php echo $membersitem['level']; ?></td>
        <td class="text-left">
          <img temp-manv="<?php echo $membersitem['username']; ?>" class="mr-2 cursor-pointer btn-suanv" src="../icon/edit.png" width="25x" data-toggle="modal" data-target="#Modal-update"/> <i class="fas fa-trash-alt cursor-pointer getdelete-manv" tempdata-manv="<?php echo $membersitem['username']; ?>" data-toggle="modal" data-target="#Modal-delete"></i>
        </td>
      </tr>

<?php }
} else{echo '<tr><td colspan="11">Không tìm thấy kết quả</td></tr>';}
} ?>
