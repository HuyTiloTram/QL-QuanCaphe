<?php
if(isset($_POST['MaNV'])){
  include '../ketnoi.php';
  include '../libs/get-1condition.php';
  $manv=$_POST['MaNV'];
  $nhanvien= get_1condition('nhanvien','*',"MaNV= '$manv'"); foreach ($nhanvien as $nhanvienitem){ ?>
    <td class="" colspan="10">
        <ul class="nav nav-tabs">
          <li class="active" ><a>Chi tiết</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane ng-scope active">
            <div class="inner-content ng-scope">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <td style="width:12%;"><strong>Mã nhân viên</strong></td>
                      <td width="100"><?php echo $nhanvienitem['MaNV']; ?></td>
                      <td style="width:9%;"><strong>Điện thoại</strong></td>
                      <td width="100"><?php echo $nhanvienitem['SDT']; ?></td>
                      <td style="width:9%;"><strong>Birthday</strong></td>
                      <td width="100"><?php echo $nhanvienitem['Birthday']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Tên nhân viên</strong></td>
                      <td><?php echo $nhanvienitem['TenNV']; ?></td>
                      <td><strong>Chức vụ</strong></td>
                      <td><?php echo $nhanvienitem['Chucvu']; ?></td>
                      <td><strong>Năm vào</strong></td>
                      <td><?php echo $nhanvienitem['Namvao']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Username</strong></td>
                      <td><?php echo $nhanvienitem['Username']; ?></td>
                      <td><strong>Địa chỉ</strong></td>
                      <td><?php echo $nhanvienitem['Diachi']; ?></td>
                      <td><strong>Email</strong></td>
                      <td><?php echo $nhanvienitem['Email']; ?></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="text-right">
              <button type="button" class="btn btn-primary btn-default"><span class="fa fa-plus"></span> Copy</button>
              <button type="button" class="btn btn-6 btn-suanv" temp-manv="<?php echo $nhanvienitem['MaNV']; ?>" data-toggle="modal" data-target="#Modal-update" ><span class="fa fa-edit"></span> Cập nhật</button>
              <button type="button" class="btn btn-danger btn-default getdelete-manv" tempdata-manv="<?php echo $nhanvienitem['MaNV']; ?>" data-toggle="modal" data-target="#Modal-delete"><span class="fa fa-times-circle"></span> Xóa</button>
            </div>
          </div>
        </div>
      </div>

  </td>


<?php  }
} ?>





















<?php
if(isset($_POST['MaSP'])){
  include '../libs/get-1condition.php';

  $sanpham= get_1condition('sanpham','*','MaSP',$_POST['MaSP'],1); foreach ($sanpham as $nhanvienitem){ ?>

      <td colspan="10">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
          <a class="nav-link active" aria-selected="true">Thông tin</a>
          </li>
        </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active">
                  <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Mã Sản phẩm:
                    </div>
                    <div class="col-md-10 ">
                      <?php echo $nhanvienitem['MaSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Tên Sản phẩm:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $nhanvienitem['TenSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Mô tả:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $nhanvienitem['Mota'];?>
                    </div>
                  </div>
                            <div class="row">
                              <div class="col-md-12 text-right">
                                <button class="btn btn-action-2 btn-suamon" ><i class="fa fa-check-square" aria-hidden="true"></i>Cập nhật</button>
                                <button class="btn btn-red getdelete-masp" ><i class="fa fa-trash-o" aria-hidden="true"></i>Xóa</button>
                              </div>
                            </div>
              </div>
            </div>

              </td>

<?php  }
} ?>
