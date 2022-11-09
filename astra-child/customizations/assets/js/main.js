(function($) {
	"use strict";

	$(document).ready(function(){


		/**
		 * 
		 * Add dynamic content
		 * 
		 */
		if ( fabc_rps.related_posts_html ) {
			setTimeout(function (){
				$('#primary').append( fabc_rps.related_posts_html );
            }, 5000);
		}
		

		/**
		 * 
		 * Change history and title
		 * 
		 */
		$(window).on('resize scroll', function() {


			/**
			 * 
			 * If element is in viewport, add active class
			 * If element is NOT in viewport, remove active class
			 * 
			 */
			$('.fabc-blog-post').each(function() {
				if ( $(this).isInViewport() && $(this).hasClass('fabc-active-post') == false ) {
					$(this).addClass('fabc-active-post');
					$(this).addClass('fabc-show-post');
				}else if ( !$(this).isInViewport() ) {
					$(this).removeClass('fabc-active-post');
				}
			});


			/**
			 * 
			 * Change history and title
			 * 
			 */
			var page_title = $('.fabc-active-post').first().attr('data-fabc-post-title');
			var page_url   = $('.fabc-active-post').first().attr('data-fabc-post-url');
			if ( page_url ) {
				if ( window.location.href.trim() != page_url.trim() ) {
					document.title = page_title;
					window.history.pushState( {}, page_title, page_url );
				}
			}

		});


		/**
		 * 
		 * Sticky Trending
		 * 
		 */
		if( $('.fabc-trending-sticky').length >= 1 ){
			$(window).scroll(function(){ 
			 	var offset = 0;
			 	var top    = $(window).scrollTop();
			 	if ($('.fabc-trending-sticky').offset().top < top) {
			 		$('.fabc-sticy-widget').addClass('fabc-sticy');
			 	} else {
			 		$('.fabc-sticy-widget').removeClass('fabc-sticy');
			 	}
			});
		}


		/**
		 * 
		 * Function, is the element in viewport?
		 * @link https://stackoverflow.com/questions/20791374/jquery-check-if-element-is-visible-in-viewport
		 * 
		 */
		$.fn.isInViewport = function() {
		    var elementTop     = $(this).offset().top-300;
		    var elementBottom  = elementTop + $(this).outerHeight();

		    var viewportTop    = $(window).scrollTop();
		    var viewportBottom = viewportTop + $(window).height();

		    return elementBottom > viewportTop && elementTop < viewportBottom;
		};


	});//Doc ready

})(jQuery);