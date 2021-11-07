//Submit ko load lại Form insert loại để thêm vào DATABASE + up ảnh host + Thông báo (khi click nút Thêm)
$("#form-insert").submit(function(){
	var form= $(this);
	var url2 = form.attr('action');
	$.ajax({  type: "POST",  url: url2,
		data: new FormData(form[0]),
		cache: false,
		contentType: false,
		processData: false,
		success: function(result) {
		$('.Thongbao-insert').html(result);
		$('.Thongbao-insert').removeClass('d-none');
		$('.alert-login').html(result).fadeIn().delay(1500).fadeOut().css('background-color','none');
		setTimeout('$(".alert-login h3").remove()',1500);}
	});
});

//Submit ko load lại Form update nhóm món để sửa trong Database + up, xóa ảnh host + Thông báo (khi click Cập nhật)
$("#form-update").submit(function(){
	var form= $(this);
	var url2 = form.attr('action');
	$.ajax({  type: "POST",  url: url2,
		data: new FormData(form[0]),
		cache: false,
		contentType: false,
		processData: false,
		success: function(result) {
		$('.Thongbao-update').html(result);
		$('.Thongbao-update').removeClass('d-none');
		$('.alert-login').html(result).fadeIn().delay(1500).fadeOut().css('background-color','none');
		setTimeout('$(".alert-login h3").remove()',1500);}
	});
});
