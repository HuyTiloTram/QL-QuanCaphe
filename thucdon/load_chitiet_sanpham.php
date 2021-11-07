<?php
if(isset($_POST['MaSP'])){
  include '../ketnoi.php';
  include '../libs/get-1condition.php';
  $masp=$_POST['MaSP'];
  $sanpham= get_1condition('sanpham','*',"MaSP= '$masp'"); foreach ($sanpham as $sanphamitem){ ?>
    <td class="" colspan="11">
        <ul class="nav nav-tabs">
          <li class="active" ><a>Chi tiết</a></li>
          <li><a>Combo</a> </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane ng-scope active">
            <div class="inner-content ng-scope">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <td width="100"><strong>Mã món</strong></td>
                      <td width="170"><?php echo $sanphamitem['MaSP']; ?></td>
                      <td width="130"><strong>ĐVT</strong></td>
                      <td><?php if($sanphamitem['SLquydoi']==1) echo $sanphamitem['DVT']; else echo '('.$sanphamitem['SLquydoi'].') '.$sanphamitem['DVT']; ?></td>
                    </tr>
                    <tr>
                      <td><strong>Tên món</strong></td>
                      <td><?php echo $sanphamitem['TenSP']; ?></td>
                      <td><strong>Loại</strong></td>
                      <td><?php echo $sanphamitem['LoaiSP']; ?></td>
                    </tr>
                    <tr>
                      <td><strong> Mô tả</strong></td>
                      <td colspan="3"><textarea rows="3" style="width:100%;" readonly><?php echo $sanphamitem['Mota']; ?></textarea></td>
                    </tr>
                </tbody>
              </table>
            </div>
            <div class="text-right">
              <button type="button" class="btn btn-primary btn-default"><span class="fa fa-plus"></span> Copy</button>
              <button type="button" class="btn btn-6 btn-suamon" temp-masp="<?php echo $sanphamitem['MaSP']; ?>" data-toggle="modal" data-target="#Modal-update" ><span class="fa fa-edit"></span> Cập nhật</button>
              <button type="button" class="btn btn-danger btn-default getdelete-masp" tempdata-masp="<?php echo $sanphamitem['MaSP']; ?>" data-toggle="modal" data-target="#Modal-delete"><span class="fa fa-times-circle"></span> Xóa</button>
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

  $sanpham= get_1condition('sanpham','*','MaSP',$_POST['MaSP'],1); foreach ($sanpham as $sanphamitem){ ?>

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
                      <?php echo $sanphamitem['MaSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Tên Sản phẩm:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $sanphamitem['TenSP'];?>
                    </div>
                            </div>
                            <div class="row form-group">
                    <div class="col-md-2 col-lg-2">
                      Mô tả:
                    </div>
                    <div class="col-md-10 col-lg-2">
                      <?php echo $sanphamitem['Mota'];?>
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
