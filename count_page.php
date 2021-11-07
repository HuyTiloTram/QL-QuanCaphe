<?php
if(isset($_POST['Sql'])){
  include 'ketnoi.php';
  $sql=$_POST['Sql'];
  $countpage = ceil(mysqli_num_rows(mysqli_query($conn,$sql))/20);
  if ($countpage>1) { ?>
    <ul class="pagination">
    <li class="page-item pl-1 page-active"><a class="page-link text-link-blue change-page">1</a></li>
<?php for($i=2;$i<=$countpage;$i++) {?>
      <li class="page-item pl-1" ><a  class="page-link text-link-blue change-page"><?php echo $i; ?></a></li>
<?php  } ?>
    </ul>
<?php  }else echo'';
} ?>
