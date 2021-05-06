<!-- section tên đăng nhập và thoát -->
  <div class="user_info">
    <?php
        if(isset($_SESSION['username'])){
            if ($_SESSION['level'] == 1)
              echo "Xin chào admin ".$_SESSION['username']." | ";
            else
              echo "Xin chào khách ".$_SESSION['username']." | ";
    ?>     <input type="button" onclick="window.location='logout.php'" value="Thoát">
        <?php  }   ?>

  </div>
