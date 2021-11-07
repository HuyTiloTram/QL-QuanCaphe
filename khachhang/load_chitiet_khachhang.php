<?php
if(isset($_POST['MaKH'])){
  include '../ketnoi.php';
  include '../libs/get-1condition.php';
  $manv=$_POST['MaKH'];
  $khachhang= get_1condition('khachhang','*',"MaKH= '$manv'"); foreach ($khachhang as $khachhangitem){ ?>
    <td class="" colspan="10">
        <ul class="nav nav-tabs">
          <li class="active" ><a>Chi tiết</a></li>
          <li><a>Lịch sử giao dịch</a></li>
          <li><a>Dư nợ</a></li>
          <li><a>Điểm thưởng</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane ng-scope active">
            <div class="inner-content ng-scope">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <td style="width:12%;"><strong>Mã khách hàng</strong></td>
                      <td width="100"><?php echo $khachhangitem['MaKH']; ?></td>
                      <td style="width:9%;"><strong>Username</strong></td>
                      <td width="80"><?php echo $khachhangitem['Username']; ?></td>
                      <td style="width:9%;"><strong>Địa chỉ</strong></td>
                      <td width="170"><?php echo $khachhangitem['Diachi']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Tên khách hàng</strong></td>
                      <td><?php echo $khachhangitem['TenKH']; ?></td>
                      <td><strong>Giới tính</strong></td>
                      <td><?php echo $khachhangitem['Gioitinh']; ?></td>
                      <td><strong>Email</strong></td>
                      <td><?php echo $khachhangitem['Email']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Ngày tạo</strong></td>
                      <td><?php echo $khachhangitem['Ngaytao']; ?></td>
                      <td><strong>Điện thoại</strong></td>
                      <td><?php echo $khachhangitem['SDT']; ?></td>
                      <td><strong>Ghi chú</strong></td>
                      <td><?php echo $khachhangitem['Ghichu']; ?></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="text-right">
              <button type="button" class="btn btn-primary btn-default"><span class="fa fa-plus"></span> Copy</button>
              <button type="button" class="btn btn-6 btn-suakh" temp-makh="<?php echo $khachhangitem['MaKH']; ?>" data-toggle="modal" data-target="#Modal-update" ><span class="fa fa-edit"></span> Cập nhật</button>
              <button type="button" class="btn btn-danger btn-default getdelete-makh" tempdata-manv="<?php echo $khachhangitem['MaKH']; ?>" data-toggle="modal" data-target="#Modal-delete"><span class="fa fa-times-circle"></span> Xóa</button>
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

  $sanpham= get_1condition('sanpham','*','MaSP',$_POST['MaSP'],1); foreach ($sanpham as $khachhangitem){ ?>

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
                      <?php echo $khachhangitem['MaSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Tên Sản phẩm:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $khachhangitem['TenSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Mô tả:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $khachhangitem['Mota'];?>
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
