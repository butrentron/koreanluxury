
var $ = jQuery.noConflict();
$(window).load(function() {
    $('.flexslider').flexslider({
          animation: "fade"
    });
	
	$(function() {
		$('.show_menu').click(function(){
			$('.menu').fadeIn();
			$('.show_menu').fadeOut();
			$('.hide_menu').fadeIn();
		});
		$('.hide_menu').click(function(){
			$('.menu').fadeOut();
			$('.show_menu').fadeIn();
			$('.hide_menu').fadeOut();
		});
	});
});

$('.carousel[data-type="multi"] .item').each(function(){
	var next = $(this).next(); // grabs the next sibling of the carouselGrid
	if (!next.length) { // if ther isn't a next
	    next = $(this).siblings(':first'); // this is the first
	}
	next.children(':first-child').clone().appendTo($(this)); // put the next ones on the array
	 


	for (var i=0;i<3;i++) { // THIS LOOP SPITS OUT EXTRA ITEMS TO THE CAROUSEL
	    next=next.next(); 
	    if (!next.length) {
	      next = $(this).siblings(':first');
	}
	    next.children(':first-child').clone().appendTo($(this));
	}
});

jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});

//menu
$(function() {
			$('#main-menu').smartmenus({
				mainMenuSubOffsetX: 1,
				mainMenuSubOffsetY: -8,
				subMenusSubOffsetX: 1,
				subMenusSubOffsetY: -8
			});
		});

		$(function(){
		   $(".carouselGrid-inner > .item:first-child").addClass("active");
		});
//# sourceMappingURL=main.js.map
