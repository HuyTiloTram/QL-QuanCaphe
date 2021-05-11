<!-- section tên đăng nhập và thoát -->

    <?php
        if(isset($_SESSION['username'])){
            if ($_SESSION['level'] == 1)
              echo "Xin chào admin ".$_SESSION['username'];
            else
              echo "Xin chào khách ".$_SESSION['username'];
    ?>    
        <?php  }   ?>
