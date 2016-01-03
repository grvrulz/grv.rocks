jQuery(function( $ ){

	$('.entry-background .wrap') .css({'height': (($(window).height()))+'px'});
	$(window).resize(function(){
		$('.entry-background .wrap') .css({'height': (($(window).height()))+'px'});
	});

//	$(".entry-background .entry-header .entry-meta").after('<p class="arrow"><a href="#site-inner"></a></p>');

//	$.localScroll({
//		duration: 750
//	});

});
