$(function() {

	// trarr = JSON.parse(trarr);	
	$('#main-slider').slick({
		autoplay: true,
		autoplaySpeed: 3500,
		infinite: true,
		speed: 500,
		fade: true,
		cssEase: 'linear',
		prevArrow: '<i class="fa fa-2x fa-chevron-left ms-left" aria-hidden="true"></i>',
		nextArrow: '<i class="fa fa-2x fa-chevron-right ms-right" aria-hidden="true"></i>',
	});

	// datepicker ----------------------------------- //

	$('.booking-day input').datepicker({
		todayHighlight: true,
		format: 'dd/mm/yyyy'
	});


	// main photo gallery ------------------------------ //

	var $gallery = $('.gallery').isotope({
	  // options
	});
	
	// filter items on button click
	$('.filter-button-group').on( 'click', 'button', function() {
	  var filterValue = $(this).attr('data-filter');
	  $gallery.isotope({ filter: filterValue });
	});



	// FeedBacks  slider ------------------------------ //	


	$('.feedback-gallery').slick({
		infinite: true,
		slidesToShow: 2,
		slidesToScroll: 2,
		autoplay: true,
		dots: true,		
	});
		
	// Leave feedback ---------------------------------- //

	$('.write-feedback span').on('click', function () {
		$('.feedback-area').slideToggle();	
	});


	// reservation ---------------------------------- //

	if ($('.reservation').length) {

		var WuBook= new _WuBook(1411547593);
		var wbparams= {
			lang: lang,
			layout: 'symfony',
			width: '100%',
			height: 'auto',
			mobile: 1,
		};
		WuBook.design_iframe("_wbord_", wbparams);
	}

	// Main Gallery ---------------------------------- //

	$(".main-gallery").fancybox({
		padding: 4,
	});

});




/* set/get cookie interface */	
function setCookie(c_name,value,exhours) {
	var exdate=new Date();
	exdate.setHours(exdate.getHours() + exhours);
	var c_value=escape(value) + ((exhours==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name){
	var i,x,y,ARRcookies=document.cookie.split(";");
	for (i=0;i<ARRcookies.length;i++){
		x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x=x.replace(/^\s+|\s+$/g,"");
		if (x==c_name){
			return unescape(y);
		}
	}
}

