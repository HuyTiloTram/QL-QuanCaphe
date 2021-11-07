//Animate: Khi kéo 1 đoạn thanh header chuyển thành fixed in top của stackoverflower
window.onscroll = function () { myFunction() };
 var header = document.getElementById("navigation");
 var sticky = header.offsetTop;
 function myFunction() {
		 if (window.pageYOffset > 100) {
				 header.classList.add("sticky");
		 } else {
				 header.classList.remove("sticky");
		 }
 }

//Animate: dropdown xuất hiện từ dưới lên stackoverflower
$('.dropdown').on('show.bs.dropdown', function(e){
	 var $dropdown = $(this).find('.dropdown-menu');
	 var orig_margin_top = parseInt($dropdown.css('margin-top'));
	 $dropdown.css({'margin-top': (orig_margin_top + 20) + 'px', opacity: 0}).animate({'margin-top': orig_margin_top + 'px', opacity: 1}, 400, function(){
			$(this).css({'margin-top':''});
	 });
});
$('.dropdown').on('hide.bs.dropdown', function(e){
	 var $dropdown = $(this).find('.dropdown-menu');
	 var orig_margin_top = parseInt($dropdown.css('margin-top'));
	 $dropdown.css({'margin-top': orig_margin_top + 'px', opacity: 1, display: 'block'}).animate({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}, 300, function(){
			$(this).css({'margin-top':'', display:''});
	 });
});

//Animate: Toggle sidebar_left
$(".toggle-sidebar-left").click(function(){
	$('.sidebar__container').toggleClass('active');
	$(this).find('i').toggleClass('d-none');
  $(this).toggleClass('opacity04');
});
