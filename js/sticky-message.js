jQuery(function( $ ){

	// Add reveal class to sticky message after 100px
	$(document).on("scroll", function(){

		if($(document).scrollTop() > 100){

			$(".sticky-message").addClass("reveal");		

		} else {

			$(".sticky-message").removeClass("reveal");

		}

	});

});