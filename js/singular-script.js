jQuery(function( $ ){

//	$('.entry-background') .css({'height': (($(window).height()))+'px'});
//	$(window).resize(function(){
//		$('.entry-background') .css({'height': (($(window).height()))+'px'});
//	});

	$(window).scroll(function(){
		var header = $('.site-header'),
			scroll = $(window).scrollTop();

		if( scroll >= 300 ) {
			header.addClass('scrolled');
		} else {
			header.removeClass('scrolled');
		}

	});



//	$(".entry-background .entry-header .entry-meta").after('<p class="arrow"><a href="#site-inner"></a></p>');

//	$.localScroll({
//		duration: 750
//	});

});
