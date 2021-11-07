<?php
if(isset($_POST['MaHD'])){
  include '../ketnoi.php';
  include '../libs/get-1condition.php';
  $mahd=$_POST['MaHD'];
  $hoadon= get_1condition('hoadon','*',"MaHD= '$mahd'"); foreach ($hoadon as $hoadonitem){ ?>
    <td class="" colspan="10">
        <ul class="nav nav-tabs">
          <li class="active" ><a>Chi tiết</a></li>
          <li><a>Lịch sử sửa đổi</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane ng-scope active">
            <div class="inner-content ng-scope">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <td style="width:12%;"><strong>Mã hóa đơn</strong></td>
                      <td width="60"><?php echo $hoadonitem['MaHD']; ?></td>
                      <td style="width:12%;"><strong>Mã khách hàng  </strong></td>
                      <td width="80"><?php echo $hoadonitem['MaKH']; ?></td>
                      <td style="width:13%;"><strong>Ghi chú</strong></td>
                      <td width="120"><?php echo $hoadonitem['Note']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Người lập</strong></td>
                      <td><?php echo $hoadonitem['MaNV']; ?></td>
                      <td><strong>Mã Bàn</strong></td>
                      <td><?php echo $hoadonitem['MaBan']; ?></td>
                      <td><strong>Ngày lập</strong></td>
                      <td><?php echo $hoadonitem['NgayLap']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Thanh toán</strong></td>
                      <td><?php echo $hoadonitem['HinhThucThanhToan']; ?></td>
                      <td><strong>Ngày sửa</strong></td>
                      <td><?php echo $hoadonitem['Ngaysua']; ?></td>
                      <td><strong>Tổng thanh toán</strong></td>
                      <td><?php echo $hoadonitem['Tongtien']; ?></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="text-right">
              <form action="../pos/" method="post" enctype="multipart/form-data"  target="_blank">
              <button type="submit" class="btn btn-6 btn-suakh" temp-makh="<?php echo $hoadonitem['MaKH']; ?>" data-toggle="modal" data-target="#Modal-update" ><span class="fa fa-edit"></span> Cập nhật</button>
              <button type="button" class="btn btn-danger btn-default getdelete-makh" tempdata-manv="<?php echo $hoadonitem['MaKH']; ?>" data-toggle="modal" data-target="#Modal-delete"><span class="fa fa-times-circle"></span> Xóa</button>
              <input class='d-none' type="text" name="Mahd" value="<?php echo $hoadonitem['MaHD']; ?>">
            </form>
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

  $sanpham= get_1condition('sanpham','*','MaSP',$_POST['MaSP'],1); foreach ($sanpham as $hoadonitem){ ?>

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
                      <?php echo $hoadonitem['MaSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Tên Sản phẩm:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $hoadonitem['TenSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Mô tả:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $hoadonitem['Mota'];?>
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
