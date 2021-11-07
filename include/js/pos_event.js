$(document).ready(function(){
	cms_del_pro_order();
	event_click1();
	var wait=0;

	$(".dropdown").click(function(){
		var $dropdown = $(this).find('.dropdown-content1');
		$dropdown.toggleClass('show');
	});
	// update trạng thái hoàn thành (khi click hoàn thành)
	$(".updatetrangthai").click(function () {
		var table_id = typeof $('#table_id').attr('temp-maban') === 'undefined' ? '' : $('#table_id').attr('temp-maban');
		if (table_id=='') {$('.alert-login').html('<h3>Thông báo !</h3><p> Không tìm thấy bàn! Vui lòng chọn bàn</p>').fadeIn().delay(2000).fadeOut('slow').css('background-color','red'); return ;};
		var table_name = $('#table_id').attr('temp-tenban');
		$.ajax({type: "POST", url: 'update_tinhtrang.php',data:{newTinhtrang:'hoàn thành',MaBan:table_id,TenBan:table_name},success:function(result) {
			$('.alert-login').html(result).fadeIn().delay(2300).fadeOut('slow').css('background-color','#CC66FF')	;cms_load_table_list();	 }
			});
		});

	// load bàn (khi click chuyển bàn)
	$(".load-chuyenban").click(function () {
		$('#Modal-chuyenban').attr('temp-maban2','');
		var table_id = typeof $('#table_id').attr('temp-maban') === 'undefined' ? '' : $('#table_id').attr('temp-maban');
		if (table_id=='') {$('.alert-login').html('<h3>Thông báo !</h3><p> Không tìm thấy bàn! Vui lòng chọn bàn</p>').fadeIn().delay(2000).fadeOut('slow').css('background-color','red'); return ;};
		var table_tinhtrang = $('#table_id').attr('temp-tinhtrang');
		if (table_tinhtrang!="trống"){
		$.ajax({type: "POST", url: 'load_chuyenban.php',data:{MaBan:table_id},success:function(result) {
		$('#Modal-chuyenban').attr('temp-maban',table_id);
		$('#Modal-chuyenban .loaddt-chuyenban').html(result);
		$('#Modal-chuyenban .modal-header .modal-title').html('Chuyển bàn '+table_id+' đến');
		cms_load_table_list();	 }
		});
	}
	else{		if(table_tinhtrang=="Đã Hoàn thành") var tb='hóa đơn đã hoàn thành'; else var tb='bàn trống';	$('.alert-login').html('<h3>Thông báo !</h3><p>Đây là '+tb+' </p>').fadeIn().delay(1600).fadeOut('slow').css('background-color','red'); };
	});



	// event đóng  mở giá trị tìm kiếm món ắn (khi click ngoài thì đống, trong thì hiện)
	function click_out1(event){
		if (!event.target.matches('.dropbtn')) {
 		 var dropdowns = document.getElementsByClassName('result-search-menu');
 		 var i;
 		 for (i = 0; i < dropdowns.length; i++) {
 			 var openDropdown = dropdowns[i];
 			 if (openDropdown.classList.contains('show')) {
 				 openDropdown.classList.remove('show');
 			 }
 		 }
 	 }
	}

	$('.tabs-list tr td').click(function(){
		var addstatus= $(this).find('.Status');
		if (addstatus.hasClass('my-background1')) wait=1; else wait=0;
		$('.tabs-list tr td .Status').removeClass('my-background1');
		addstatus.addClass('my-background1');
		var tab = $(this).attr('data');
		if(tab=='listtable'){
			$('#table-list').attr('hidden',false);
			$('#pos').attr('hidden',true);

		}
		else if( (tab=='pos') && (wait==0) ){
			$('#table-list').attr('hidden',true);
			$('#pos').attr('hidden',false);
		}
		else {
			if( $('.dropdown .dropdown-content2').css('display') == 'block' ) {
    $('.dropdown .dropdown-content2').css("display","none");
} else {
    $('.dropdown .dropdown-content2').css("display","block");
}
		}
	});
	$('#search-menu').click(function(){
		window.addEventListener('click', click_out1, false);
		$('#result-menu-post').addClass('show');
});
	$('#search-menu').keyup(function(){
		var menuname = $(this).val();
		if(menuname==''){
			$('#result-menu-post').removeClass('show');
		}
		else{
			$param = {
			type:'POST',
			url:'searchmenu.php',
			dataType:'html',
			data:
			{
				menuname:menuname
			},
			callback: function(data){
					$('#result-menu-post').html(data);
					$('#result-menu-post').addClass('show');
				}
			}
			ajax_adapter($param);
		}
	});
	$('.customer-pay').keyup(function(){
		var customer_pay;
		if($(this).val()==''){
			customer_pay=0;
		}else{
			customer_pay = cms_decode_currency_format($(this).val());
		}
		var total_pay = cms_decode_currency_format($('.total-pay').val());
		var reduce_pay = cms_decode_currency_format($('.reduce-pay').val());
		var debt = customer_pay - total_pay + reduce_pay;
		$(this).val(cms_encode_currency_format(customer_pay));
		$('.excess-cash').html(cms_encode_currency_format(debt));
	});
	$('.reduce-pay').keyup(function(){
		var customer_pay;
		if($(this).val()==''){
			customer_pay=0;
		}else{
			customer_pay = cms_decode_currency_format($(this).val());
		}
		var total_pay = cms_decode_currency_format($('.total-pay').val());
		var reduce_pay = cms_decode_currency_format($('.customer-pay').val());
		var debt = customer_pay - total_pay + reduce_pay;
		$(this).val(cms_encode_currency_format(customer_pay));
		$('.excess-cash').html(cms_encode_currency_format(debt));
	});
	$('#customer-infor').keyup(function(){
		var customer = $(this).val();
		if(customer==''){
			$('#result-customer').css('display','none');
		}else{
			$param = {
			type:'POST',
			url:'searchcustomer.php',
			dataType:'html',
			data:
			{
				customer:customer
			},
			callback: function(data){
				$('#result-customer').html(data);
				$('#result-customer').css('display','block');
				}
			}
			ajax_adapter($param);
		}
	});
	$('.del-customer').click(function(){
		$('.customer-find').removeClass('d-none');
		$('.customer-found').addClass('d-none');
		var table_id = $('#table_id').attr('temp-maban');
		$.ajax({type: "POST", url: 'update_khachhang.php',data:{newCustomer:'',MaBan:table_id},success:function(result) { ;	 }
		});
	/*	$('#customer-infor').val('');
		$('#customer-infor').attr('disabled',false);
		$('#customer-infor').removeAttr('data-id');
		$(this).html(''); */
	});
});
function ajax_adapter($param){
	$.ajax({
            type:$param.type,
            url:$param.url,
            data:$param.data,
            dataType:$param.dataType,
            async:true,
            success:$param.callback
    });
}
function load_hoadon($mahd){
	$param={
		type:'POST',
		url:'load_hoadon.php',
		dataType:'html',
		data:
		{
			Mahd:$mahd,
		},
		callback: function(data){
			$('#pro_search_append').html(data);
			cms_load_infor_order();
			var loadghichu = document.getElementById("load-ghichu").value;
			if (loadghichu==" ") $('body .bill-action textarea#note-order').val(''); else $('body .bill-action textarea#note-order').val(loadghichu);
			var loadcustomer=document.getElementById("load-customer").getAttribute('temp-makh');
			if (loadcustomer=="") {$('#customer-infor2').attr('temp-makh','');$('.customer-found').addClass('d-none'); $('.customer-find').removeClass('d-none');}
			else {
				var load2=document.getElementById("load-customer").getAttribute('temp-diemthuong');load3=document.getElementById("load-customer").getAttribute('temp-duno');load4=document.getElementById("load-customer").getAttribute('temp-tenkh');
				cms_select_customer(loadcustomer,load2,load3,load4,1);
			}
			var $id_table=$('#phptemp-idtable').val();
			$(".table-infor2").css("background-color","blue");
		  $('.table-infor2').html('<strong id="table_id" temp-maban="'+$id_table+'" temp-tinhtrang="Đã Hoàn thành" >Bàn '+$id_table+'</strong>'+'<div  class=" ban-khongtrong dropdown-content1"></div></div></div>');
			$('.table-infor').html('<strong temp-maban="'+$id_table+'" >Bàn '+$id_table+' Mã HD:'+$mahd+'</strong>');

		}
	}
ajax_adapter($param);
}
function cms_load_pos($id_table,$tinhtrang){
	$param={
		type:'POST',
		url:'cms_load_pos.php',
		dataType:'html',
		data:
		{
			id_table:$id_table,
		},
		callback: function(data){
			$('#pro_search_append').html(data);
			cms_load_infor_order();
			var loadghichu = document.getElementById("load-ghichu").value;
			if (loadghichu==" ") $('body .bill-action textarea#note-order').val(''); else $('body .bill-action textarea#note-order').val(loadghichu);
			var loadcustomer=document.getElementById("load-customer").getAttribute('temp-makh');
			if (loadcustomer=="") {$('#customer-infor2').attr('temp-makh','');$('.customer-found').addClass('d-none'); $('.customer-find').removeClass('d-none');}
			else {
				var load2=document.getElementById("load-customer").getAttribute('temp-diemthuong');load3=document.getElementById("load-customer").getAttribute('temp-duno');load4=document.getElementById("load-customer").getAttribute('temp-tenkh');
				cms_select_customer(loadcustomer,load2,load3,load4,1);
			}


		}
	}
	ajax_adapter($param);

/*$('#table-list').attr('hidden',true);
	$('#pos').attr('hidden',false);*/
	if($tinhtrang=="hoàn thành")
		$(".table-infor2").css("background-color","#00BB00");
	else if ($tinhtrang=="yêu cầu")
		$(".table-infor2").css("background-color","#FF9900");
	else
	 $(".table-infor2").css("background-color","gray");
	$('.table-infor2').html('<strong id="table_id" temp-maban="'+$id_table+'" temp-tinhtrang="'+$tinhtrang+'" >Bàn '+$id_table+'</strong>'+'<div  class=" ban-khongtrong dropdown-content1"></div></div></div>');
	$('.table-infor').html('<strong temp-maban="'+$id_table+'" >Bàn '+$id_table+'</strong>');

	$param2={
		type:'POST',
		url:'load_bankhongtrong.php',
		dataType:'html',
		data:
		{
			id_table:$id_table
		},
		callback: function(data){
			$('.ban-khongtrong').html(data);
		}
	}
	ajax_adapter($param2);
}
function cms_load_table_list(){
	$.ajax({type: "POST", url: 'load_tablelist.php',data:{typeload:'1'},success:function(result) {
	 	$("#table-list").html(result);}
	});
}
function clear_pay(){
	$('.customer_pay').val('0');
	$('.reduce_pay').val('0');
}
function cms_find_cate(sanpham_name){
	$('.menu-infor').text(sanpham_name);
	if (sanpham_name=="TẤT CẢ")
		$(".mysearch1 .product").removeClass('d-none');
	else{$(".mysearch1 .product").addClass('d-none');
		$(".mysearch1 .product-img").filter(function() {
			var find= $(this).attr('data-nhommon');
			if(	find.toLowerCase()==sanpham_name.toLowerCase() )
				$(this).parent('.product').removeClass('d-none');
		});
	}
}
function cms_find_vitri(table_vitri){

	if (table_vitri=="Tất cả")
		$("#table-list .room").removeClass('d-none');
	else{$("#table-list .room").addClass('d-none');
		$("#table-list .room").filter(function() {
			var find= $(this).attr('temp-vitri');
			if(	find==table_vitri )
				$(this).removeClass('d-none');
		});
	}
}
function cms_select_menu($id_menu){
	if($('#pro_search_append tr').length != 0){
		var flag= 0;
		$('#pro_search_append tr').each(function(){
			var id_temp = $(this).attr('temp-masp');
			if($id_menu==id_temp){
				var value_input = $(this).find('input.quantity-product-oders');
				value_input.val(parseInt(value_input.val()) + 1);
				flag = 1;
				cms_load_infor_order();
			}
		});
		if(flag==0){
			var table_id = $('#table_id').attr('temp-maban');
			var $param={
				type:'POST',
				url:'appendproduct.php',
				dataType:'html',
					data:
						{
							id_menu:$id_menu,
							id_table:table_id
						},
						callback: function(data){
							$('#pro_search_append').append(data);
							cms_load_infor_order();
						}
				}
			ajax_adapter($param);
		}
	}else{
		var table_id = $('#table_id').attr('temp-maban');
		var $param={
		type:'POST',
		url:'appendproduct.php',
		dataType:'html',
		data:
			{
				id_menu:$id_menu,
				id_table:table_id
			},
			callback: function(data){
				$('#pro_search_append').append(data);
				cms_load_infor_order();
			}
		}
		ajax_adapter($param);
	}
}
function cms_select_customer($idcustomer,$diemthuong,$duno,$tenkh,type){
	/* var customer_name=$('li.data-cus-'+$idcustomer).text(); */
	$('#customer-infor2').text($tenkh);
	$('#customer-infor2').attr('temp-makh',$idcustomer);
	/* $('.del-customer').html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
	$('#customer-infor').attr('disabled',true); */
	$('#customer-diemthuong').text($diemthuong);
	$('#customer-duno').text($duno);
	$('#customer-infor').val('');
	var table_id = $('#table_id').attr('temp-maban');
  if(type==0){
	$.ajax({type: "POST", url: 'update_khachhang.php',data:{newCustomer:$idcustomer,MaBan:table_id},success:function(result) { ;	 }
	});};
	$('#result-customer').css('display','none');
	$('.customer-find').addClass('d-none');
	$('.customer-found').removeClass('d-none');

}
function cms_decode_currency_format(obs) {
    if (obs == '')
        return 0;
    else
        return parseInt(obs.replace(/,/g, ''));
}
function cms_encode_currency_format(obs) {
    return obs.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function cms_load_infor_order(){
	var $total_money=0;
	$('tbody#pro_search_append tr').each(function () {
        $quantity_product = $(this).find('input.quantity-product-oders').val();
        $price = cms_decode_currency_format($(this).find('input.price-order').val());
        $total = $price * $quantity_product;
        $total_money += $total;
				$(this).find('td.total-money').html(cms_encode_currency_format($total));
    });
		$('input.total-pay').val(cms_encode_currency_format($total_money));
		$('input.customer-pay').val(cms_encode_currency_format($total_money));
		$('input.reduce-pay').val(cms_encode_currency_format(0));
		$('input.reduce-pay').val(cms_encode_currency_format($('.reduce-pay2').val()));
		$('.excess-cash').text('0');
}
function cms_del_pro_order(){
    $('body').on('click', '.del-pro-order', function () {
        $(this).parents('tr').remove();
        cms_load_infor_order();
    });
}
function event_click1(){
    $('body').on('click', '.get-ghichu', function () {
			var ghichu_hientai =$(this).text();
      var mahd=  $(this).attr('tempdata-mahd');
			var masp=$(this).attr('tempdata-masp');
			$("#Modal-ghichu").attr('temp-mahd',mahd);
			$("#Modal-ghichu").attr('temp-masp',masp);
			if (ghichu_hientai != "Ghi chú") $("#Modal-ghichu .form-textarea").val(ghichu_hientai);
			else {$("#Modal-ghichu .form-textarea").val("");$("#Modal-ghichu .form-textarea").attr('placeholder','Ghi chú'); }
			$('#pro_search_append .get-ghichu').removeClass('chosing');
			$(this).addClass('chosing');
    });
		$('body').on('click', '.Save-ghichu', function () {
			var mahd = $('#Modal-ghichu').attr('temp-mahd');
			var masp = $('#Modal-ghichu').attr('temp-masp');
			var value_textarea= $("#Modal-ghichu .modal-body .get-value").text();
			$.ajax({type: "POST", url: 'update_ghichu.php',data:{newNote:value_textarea,MaHD:mahd,MaSP:masp},success:function(result) {
	$('#pro_search_append').find('.chosing').text(value_textarea);	 }
			});
		});
		$('body').on('click', '.get-color', function () {

			$("#table-list .get-color").removeClass('btn-action-1');
			$(this).addClass('btn-action-1');
		});
		$('body').on('click', '#Modal-chuyenban .room-list .room', function () {

			$('#Modal-chuyenban').attr('temp-maban2',$(this).attr('temp-maban2'));
			$('.room-list .room').removeClass('select-ban');
			$(this).addClass('select-ban');
		});

}
function cms_save_table(){
	if($('tbody#pro_search_append tr').length !=0){
		var table_tinhtrang = $('#table_id').attr('temp-tinhtrang');
		if (table_tinhtrang=="trống") {$('.alert-login').html('<h3>Thông báo !</h3><p>Đây là bàn trống không thể thanh toán!. Hãy thử Lưu hóa đơn trước </p>').fadeIn().delay(2000).fadeOut('slow');return ;}
		var hoadon_mahd = document.getElementById("load-hoadon").getAttribute('temp-mahd');
		var customer_id = $('#customer-infor2').attr('temp-makh');
		var table_id = $('#table_id').attr('temp-maban');
		var note = $('#note-order').val();
		var customer_total = cms_decode_currency_format($('input.total-pay').val());
			var customer_pay = cms_decode_currency_format($('input.customer-pay').val());
				var customer_reduce = cms_decode_currency_format($('input.reduce-pay').val());
        var $data ={
        	'data':{
						'action':'Thanh toán',
						'hoadon_mahd':hoadon_mahd,
	        	'table_id':table_id,
	        	'customer_id':customer_id,
	        	'note':note,
	        	'customer_total':customer_total,
						'customer_reduce':customer_reduce,
						'customer_pay':customer_pay
        	}
        }
        var $param={
		type:'POST',
		url:'paymentbill.php',
		dataType:'html',
		data:$data,
		callback: function(data){
				var mywindow = window.open('', 'In hóa đơn', 'height=500,width=1000');
			    if (mywindow == null) {
			        alert('Trình duyệt đã ngăn không cho phần mềm In. Vui lòng mở khóa hiển thị In ở góc phải phía trên của trình duyệt');
			    } else {
			        mywindow.document.writeln(data);
			        mywindow.document.close();
			        mywindow.focus();
			        mywindow.print();
			        mywindow.close();
							cms_load_table_list();
				}
			}
		}
		ajax_adapter($param);

	}else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng chọn ít nhất 1 sản phẩm trước khi thanh toán</p>').fadeIn().delay(1400).fadeOut('slow');
	}
}
function cms_print_table(){
	if($('tbody#pro_search_append tr').length !=0){
		var table_tinhtrang = $('#table_id').attr('temp-tinhtrang');
		if (table_tinhtrang=="trống") {$('.alert-login').html('<h3>Lỗi !</h3><p>Hóa đơn không được tìm thấy</p>').fadeIn().delay(2000).fadeOut('slow');return ;}
		var hoadon_mahd = document.getElementById("load-hoadon").getAttribute('temp-mahd');
		var customer_id = $('#customer-infor2').attr('temp-makh');
		var table_id = $('#table_id').attr('temp-maban');
		var note = $('#note-order').val();
		var customer_total = cms_decode_currency_format($('input.total-pay').val());
			var customer_pay = cms_decode_currency_format($('input.customer-pay').val());
				var customer_reduce = cms_decode_currency_format($('input.reduce-pay').val());
        var $data ={
        	'data':{
						'action':'In',
						'hoadon_mahd':hoadon_mahd,
	        	'table_id':table_id,
	        	'customer_id':customer_id,
	        	'note':note,
	        	'customer_total':customer_total,
						'customer_reduce':customer_reduce,
						'customer_pay':customer_pay
        	}
        }
        var $param={
		type:'POST',
		url:'paymentbill.php',
		dataType:'html',
		data:$data,
		callback: function(data){
				var mywindow = window.open('', 'In hóa đơn', 'height=500,width=1000');
			    if (mywindow == null) {
			        alert('Trình duyệt đã ngăn không cho phần mềm In. Vui lòng mở khóa hiển thị In ở góc phải phía trên của trình duyệt');
			    } else {
			        mywindow.document.writeln(data);
			        mywindow.document.close();
			        mywindow.focus();
			        mywindow.print();
			        mywindow.close();
				}
			}
		}
		ajax_adapter($param);
	}else{
		$('.alert-login').html('<h3>Lỗi !</h3><p>Không tìm thấy hóa đơn</p>').fadeIn().delay(1400).fadeOut('slow').css('background-color','red');
	}
}
function cms_save_oder(){
	if($('tbody#pro_search_append tr').length !=0){
		var table_id = $('#table_id').attr('temp-maban');
		var table_tinhtrang = $('#table_id').attr('temp-tinhtrang');
		var note = $('#note-order').val();
		var customer_id = $('#customer-infor2').attr('temp-makh');
		var customer_id = typeof $('#customer-infor2').attr('temp-makh') === 'undefined' ? 0 : $('#customer-infor2').attr('temp-makh');
		var customer_pay = cms_decode_currency_format($('input.total-pay').val());
		var reduce_pay = cms_decode_currency_format($('input.reduce-pay').val());
		if (table_tinhtrang=="trống"){
		var detail = [];
        $('tbody#pro_search_append tr').each(function () {
            var id = $(this).attr('temp-masp');
						var name = $(this).attr('temp-tensp');
            var quantity = $(this).find('input.quantity-product-oders').val();
            var price = cms_decode_currency_format($(this).find('input.price-order').val());
						var noteproduct = $(this).find('.gridNote').text();
            detail.push(
                {id: id,name: name, quantity: quantity, price: price, note:noteproduct}
            );
        });
        var $data ={
        	'data':{
	        	'table_id':table_id,
	        	'customer_id':customer_id,
	        	'note':note,
	        	'customer_pay':customer_pay,
						'reduce_pay':reduce_pay,
	        	'detail_oder':detail
        	}
        }
        var $param={
		type:'POST',
		url:'savebill.php',
		dataType:'html',
		data:$data,
		callback: function(data){
				$('.alert-login').html(data).fadeIn().delay(1400).fadeOut('slow').css('background-color','#599130');
				cms_load_table_list();
				cms_load_pos( table_id,'yêu cầu')
			}
		}
		ajax_adapter($param);
	}
		else{
			var hoadon_mahd = document.getElementById("load-hoadon").getAttribute('temp-mahd');
			var detail = [];
	        $('tbody#pro_search_append tr').each(function () {
						var id = $(this).attr('temp-masp');
						var name = $(this).attr('temp-tensp');
	            var quantity = $(this).find('input.quantity-product-oders').val();
	            var price = cms_decode_currency_format($(this).find('input.price-order').val());
							var noteproduct = $(this).find('.gridNote').text();
	            detail.push(
	                {id: id,name: name, quantity: quantity, price: price, note:noteproduct}
	            );
	        });
	        var $data ={
	        	'data':{
							'hoadon_mahd':hoadon_mahd,
		        	'table_id':table_id,
							'status':table_tinhtrang,
		        	'customer_id':customer_id,
		        	'note':note,
							'customer_pay':customer_pay,
							'reduce_pay':reduce_pay,
		        	'detail_oder':detail
	        	}
	        }
	        var $param={
			type:'POST',
			url:'updatebill.php',
			dataType:'html',
			data:$data,
			callback: function(data){
					$('.alert-login').html(data).fadeIn().delay(1400).fadeOut('slow').css('background','#599130');
					cms_load_table_list();
				}
			}
			ajax_adapter($param);

		}
	}else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng chọn ít nhất 1 sản phẩm trước khi lưu</p>').fadeIn().delay(1000).fadeOut('slow');
	}
}

//
function cms_move_bill(){
	if($('tbody#pro_search_append tr').length !=0){
		var table_id = $('#Modal-chuyenban').attr('temp-maban');
		var table_id2 = $('#Modal-chuyenban').attr('temp-maban2');
		if (table_id2=='') {$('.alert-login').html('<h3>Lỗi !</h3><p>Bạn chưa chọn bàn muốn chuyển</p>').fadeIn().delay(1400).fadeOut('slow');return ;};
		var table_tinhtrang = $('#table_id').attr('temp-tinhtrang');
		var note = $('#note-order').val();
		var customer_id = $('#customer-infor2').attr('temp-makh');
		var customer_id = typeof $('#customer-infor2').attr('temp-makh') === 'undefined' ? 0 : $('#customer-infor2').attr('temp-makh');
		var customer_pay = cms_decode_currency_format($('input.total-pay').val());

		if (table_tinhtrang=="trống"){
			$('.alert-login').html('<h3>Lỗi !</h3><p>Bạn đang chọn bàn trống</p>').fadeIn().delay(1400).fadeOut('slow');
	}
		else{
			$.ajax({type: "POST", url: 'movebill.php',data:{table_id:table_id,table_id2:table_id2},success:function(result) {
				$('.alert-login').html(result).fadeIn().delay(1800).fadeOut('slow').css('background-color','#599130');
			cms_load_table_list();  }
			});

		}
	}else{
		$('.alert-login').html('<h3>Lỗi !</h3><p>Vui lòng chọn ít nhất 1 sản phẩm trước khi lưu</p>').fadeIn().delay(1000).fadeOut('slow');
	}
}
