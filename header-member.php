<!-- section tên đăng nhập và thoát -->
    <?php
        if(isset($_SESSION['username'])){
            if ($_SESSION['level'] == 1)
              echo "Xin chào admin ".$_SESSION['username'];
            else if ($_SESSION['level'] == 3)
              echo "Xin chào quản lý ".$_SESSION['username'];
            else if ($_SESSION['level'] == 0)
              echo "Xin chào nhân viên ".$_SESSION['username'];
            else
              ;
        }
        else echo "Bạn chưa đăng nhập";

    ?>
