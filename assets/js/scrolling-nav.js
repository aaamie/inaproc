//jQuery to collapse the navbar on scroll
$(window).bind('scroll', function() {
	//Nav
    if ($(document).height() > 1200 && $(window).scrollTop() > 42) {
        $(".rz_header").addClass("display-menu-top");
		$(".navbar").css({"background":"#E7EBEE","border-bottom":"1px solid #b5c1c1"});
		$(".top-header").fadeOut();
		$(".nav").removeClass("navbar-rz");
		$(".logo-inaproc").removeClass(".navbar-brand");
		$(".logo-inaproc").addClass("navbar-brand-small");
		$("#logo-inaproc").attr('src', logo1);
		
	} 
	else {
        $(".rz_header").removeClass("display-menu-top");
		$(".navbar").css({"background":"#FFF","border-bottom":"1px solid #E7EBEE"});
		$(".top-header").fadeIn();
		$(".nav").addClass("navbar-rz");
		$(".logo-inaproc").addClass("navbar-brand");
		$(".logo-inaproc").removeClass("navbar-brand-small");
		$("#logo-inaproc").attr('src',logo2);
    }
	
	if ($(document).height() > 1200 && $(window).scrollTop() > 100) {
		$(".pencarian_detail").addClass("pencarian-fly");
	}
	else {
		$(".pencarian_detail").removeClass("pencarian-fly");
	}
	//Search Home
	/*if ($(window).scrollTop() > 320) {
		$(".search-home").addClass("search-home-fly");
	}
	else {
		$(".search-home").removeClass("search-home-fly");
	}*/
	
});


