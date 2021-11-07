<?php
session_start();
if (!isset($_SESSION['username'])){
  header("location: ../dangnhap.php");die;}
include '../header.php';
include '../libs/all-1table.php';
include '../libs/get-1condition.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

?>
        <link rel="stylesheet" type="text/css" href="../include/css/stylePos.css">
        <script type="text/javascript" src="../include/js/pos_event.js"></script>
</head>
  <body>
    <header>
  <div class="header-cashier">
    <div class="container-fluid">
      <div class="row ft-tabs">
        <div class="col-md-4"  >
      		<input type="text" name="txtnamemenu" id="search-menu" placeholder="tìm kiếm món hoặc mã"  class=" form-control  dropbtn"/>
      		<div id="result-menu-post" class="result-search-menu "></div>
      	</div>
        <div class=" table-infor2 dropdown" >
          Bàn 0
        </div>

        <div class="ml-auto mr-2 navbar">
        <div class="dropdown">
          <button type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-outline-blue dropdown-toggle">
        <?php include("../header-member.php") ?>
        </button>
        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right img-size-1" style="">
        <div class="dropdown-item cursor-pointer"><img src="../images/main/tongquan.jpg" class="mr-1"/><a href="../tongquan"> Quản lý</a></div>
        <div class="dropdown-item cursor-pointer"><img src="../icon/kitchen.png" class="mr-1"/> <a > Nhà Bếp</a></div>
        <div class="dropdown-item cursor-pointer"><img src="../icon/logout.png" class="mr-1"/> <a href="../logout.php"> Đăng xuất</a></div>
        </div>
        </div>

        </div>
      </div>
    </div>
  </div>
</header>
<?php include '../libs/get-groupby.php';$ban_vitri=get_groupby('ban','Vitri','Vitri');include '../libs/nhommon.php'; include '../libs/sanpham.php';
 ?>
<div class="container-fluid">
		<div class="row content">
      <div class="col-md-7 content-listmenu" id="content-listmenu">
				<div class="row" id="bill-info">
					<div class="col-md-2 table-infor ">
					</div>
					<div class="col-md-5" >
            <div class="customer-found invoice-summary-item d-none"  style="height:32px;font-size:9px" >
              <span class="invoice-summary-title" >
                <span class="label del-customer" style=" cursor: pointer; font-size: 20px; position: absolute; top: 5px; right: 16px;">
                  <i class="fas fa-user-times"></i>
                </span>
                <span id="customer-infor2" temp-makh=""  style="cursor:pointer" class="text-uppercase"></span>
              </span>
              <div >
                <span style="cursor:pointer" class=""> <i class="fa fa-gift"></i> <label id="customer-diemthuong"> </label>  &nbsp;&nbsp;  Dư nợ : <label id="customer-duno">0</label></span>
              </div>
            </div>
			         <div class="customer-find col-md-12 p-0  input-group " >
							<input  id="customer-infor" type="text" temp-makh=""  placeholder="Tìm khách hàng" class="form-control">

							<div class="input-group-append">
    							<button class="btn btn-primary" data-toggle="modal" data-target="#ModelAddcustomer"><i class="fa fa-plus" aria-hidden="true"></i></button>
  							</div>
							<div id="result-customer"></div>
							<span class="del-customer"></span>
						</div>
					</div>
					<div class="col-md-5">
						<select class="form-control">
							<option value="1">Bảng giá chung</option>
						</select>
					</div>
				</div>
				<div class="row bill-detail">
					<div class="col-md-12 bill-detail-content">
						<table class="table table-bordered mythread">
						  <thead class="thead-light">
						    <tr>
						      <th scope="col" style="width:10px">#</th>
						      <th scope="col">Tên sản phẩm</th>
                  <th scope="col" style="width:85px" >ĐVT</th>
						      <th scope="col" style="width:123px">SL</th>
						      <th scope="col" style="width:73px">Gía bán</th>
						      <th scope="col" style="width:90px;font-size:13px;overflow: visible;">Thành Tiền</th>
						      <th scope="col" style="width:10px"></th>
						    </tr>
						  </thead>
						  <tbody id="pro_search_append">

						  </tbody>
						</table>
					</div>
				</div>
				<div class="row bill-action">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12 p-1">
								<textarea class="form-control" id="note-order" placeholder="Nhập ghi chú hóa đơn" rows="3"></textarea>
							</div>
						</div>
						<div class="row p-0">

							<div class="col-md-7 col-xs-6 p-1 m-0 row " style="overflow:hidden">
                <div class="col-md-6 p-0 ">
                  <button type="button" class="btn btn-primary bgbutton1 load-chuyenban" data-toggle="modal" data-target="#Modal-chuyenban"  style="width:100%;"   >
                    <span class="fa fa-retweet"></span> Chuyển bàn &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </button>
                  <button type="button" class="btn btn-primary bgbutton1" style="margin-top:5px;width:100%;" n>
                    <span class="fa fa-cut"></span> Tách bàn&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </button>
                </div>
                <div class="col-md-6 p-0 pl-1">
                  <button type="button" class="btn btn-primary bgbutton2" onclick="cms_print_table()"  style="width:100%">
                    <span class="fa fa-print"></span> In hóa đơn&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </button>
                  <button type="button" class="btn btn-primary bgbutton2 updatetrangthai " style="margin-top:5px;width:100%;" >
                    <span class="far fa-bell"></span> Hoàn thành&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </button>
                </div>


							</div>
							<div class="col-md-5 col-xs-6 p-1 ml-auto " >
                <button type="button" class="btn-print mb-2" onclick="cms_save_table()"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh Toán (F9)</button>
								<button type="button" class="btn-pay " onclick="cms_save_oder()"><i class="fas fa-save" aria-hidden="true"></i> Lưu (F10)</button>
							</div>
						</div>
 					</div>
 					<div class="col-md-5">
 						<div class="row ">
							<label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
							<div class="col-md-8">
								<input type="text" value="0" class="form-control total-pay" disabled="disabled">
							</div>
						</div>
            <div class="row mt-2 ">
							<label class="col-form-label col-md-4"><b>Giảm giá</b></label>
							<div class="col-md-8">
								<input type="text" class="form-control reduce-pay" value="0" placeholder="Số tiền giảm giá">
							</div>
						</div>
						<div class="row mt-2">
							<label class="col-form-label col-md-4"><b>Khách Đưa</b></label>
							<div class="col-md-8">
								<input type="text" class="form-control customer-pay" value="0" placeholder="Nhập số điền khách đưa">
							</div>
						</div>
						<div class="row mt-3">
							<label class="col-form-label col-md-4"><b>Tiền thừa</b></label>
							<div class="col-md-8 excess-cash">
								0
							</div>
						</div>

 					</div>
				</div>
			</div>

			<div class="col-md-5" >
        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;margin-top:11px">
                        <tbody class="tabs-list"><tr>
                            <td width="50%" data="listtable">
                                <div style="width:100%">
                                    <button type="button" class="btn btn-default btn-lg Status" style="width:100%;" >
                                        <span class="fa fa-crosshairs"></span> BÀN
                                        <br>
                                        <span  class="table-infor"><b>B.0</b></span>
                                    </button>
                                </div>
                            </td>
                            <td width="50%" data="pos" >
                                <div class=" btn-group bullethalf dropdown" style="width:100%;padding-left: 5px;">
                                    <button type="button" class="btn  btn-default btn-lg dropdown-toggle Status "   style="width:100%;border-top-left-radius:3px;border-bottom-left-radius:3px;border-top-right-radius:3px;border-bottom-right-radius:3px;" >
                                        <span class="fa fa-cutlery"></span> THỰC ĐƠN
                                        <span class="fa fa-arrow-circle-o-down pull-right" style="padding-top:5px"></span>
                                        <br>
                                        <strong><span style="font-size:15px;font-weight:bold;" class="menu-infor text-uppercase">TẤT CẢ</span><strong>
                                    </button>
                                    <div class="dropdown-content2">
                                    <div class="bullet pull-right" role="menu" style="padding-left: 10px;">
                                        <div class="row pos" style="width:100%;">
                                            <div class="product" onclick="cms_find_cate('TẤT CẢ')" style="margin-right: 4px;">
                                                <div class="product-img">
                                                    <img src="">
                                                </div>
                                                <div class="product-name text-uppercase">
                                                    Tất cả
                                                </div>
                                            </div>
                                            <?php $nhommon=get_all_1table('nhommon');
                                      						foreach ($nhommon as $nhommonitem){ ?>
                                            <div class="product " onclick="cms_find_cate('<?php echo $nhommonitem['TenNhomMon']; ?>');">
                                                <div class="product-img" >
                                                    <img  src="../images/nhommon/<?php echo $nhommonitem['Hinhanh']; ?>">
                                                </div>
                                                <div class="product-name">
                                                    <?php echo $nhommonitem['TenNhomMon']; ?>
                                                </div>
                                            </div>
                                          <?php }; ?>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
        <div class="pos" id="table-list">

        <script>cms_load_table_list();</script>

      </div> <!-- End Ground Table-list -->
      <div class="pos" id="pos" hidden="true" style="height:calc(100vh - 111px);overflow-y:auto;-webkit-overflow-scrolling:touch;" >
        <div class="product-list mysearch1">

            <?php $sanpham=get_1condition('sanpham','*',"Trangthai != 'Deactive'");
                  foreach ($sanpham as $sanphamitem){ ?>
            <div class="product productbg " style="height:115px;" onclick="cms_select_menu('<?php echo $sanphamitem['MaSP'];?>')" >
            <div data-nhommon="<?php echo $sanphamitem['NhomMon']; ?>" class="product-img"  >
              <img  src="../images/sanpham/<?php echo $sanphamitem['Hinhanh']; ?>">
              <span class="price-tag"><?php echo number_format($sanphamitem['GiaSP'],0,"",","); ?></span>
            </div><div  class="product-name"><?php echo $sanphamitem['TenSP']; ?><br>  <span class="current-tag"></span></div></div><!--sds-->
            <?php };?>

      </div>
</div><!-- End pos range -->


    </div>
</div>
<div id="Modal-ghichu" temp-mahd="2" temp-masp="3" class="modal modal_outer fade " style="width:100%;" role="dialog" aria-labelledby="myModalLabel" placeholder"Ghi chú">
  <div class="modal-dialog" role="document">
  <div class="modal-content" style="top: 116.885px; right:68%; ">
    <div class="modal-body ">
      <div class="form-group ng-scope">
        <button type="button" class="btn btn-primary Save-ghichu" data-dismiss="modal" style="width:100%">Save Ghi chú & Out Form</button>
        <textarea class="form-control form-textarea get-value" rows="4" style="width:380px; height:200px" placeholder="Ghi chú"></textarea>


      </div>
  </div>
</div>
</div>
</div>
<div id="Modal-chuyenban" temp-maban="" temp-maban2="" class="modal   fade" >
  <div class="modal-content modal-dialog" style="max-width:800px; width:800px;" >
    <div class="md-content ng-scope">
    <div class="modal-header">
        <h4 class="modal-title" >Chuyển bàn đến</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12 pos loaddt-chuyenban">

                <div class="alert alert-danger "style="background-color:	#6699CC">
                    <i class="fa fa-search-plus"></i> <input class="input-search2" type="text" placeholder="Tìm kiếm tên bàn" ></input>
                </div>
                <div class="form-group">
                    <label >Vị trí</label>
                    <select id="repeatSelect" ng-model="currentPosition" style="width:100%;height:30px;font-weight:bold" class="ng-pristine ng-untouched ng-valid ng-not-empty">
                      <option value="Tất cả" selected="selected">Tất cả</option>
                      <option value="Bàn Trong" >Bàn Trong</option>
                      <option value="Mang Về" >Mang Về</option>
                      <option value="Sân Vườn">Sân Vườn</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row control-panel">
            <div class="col-lg-12">
                <div class="pull-left">
                    <button type="button" class="btn btn-warning btn-default " data-dismiss="modal"><span class="fa fa-backward"></span> Thoát</button>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-default update-chuyenban" onclick="cms_move_bill()" ><span class="fa fa-floppy-o"></span> Lưu</button>
                </div>
            </div>
        </div>
    </div>
<?php if(isset($_POST['Mahd'])){ ?>
  <script class='willremove' >
load_hoadon('<?php echo $_POST['Mahd']; ?>');
  </script>

<?php } ?>
</div></div></div>
<div class="alert-login" style="z-index-99999; position:fixed"> </div>
<div class="myhide1 d-none">
  <input type="text" class="temp1"/>
</div>
<script> $('.willremove').remove(); </script>
    </body>

</html>
