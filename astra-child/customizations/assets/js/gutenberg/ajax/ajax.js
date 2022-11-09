(function($) {
	"use strict";

	$(document).ready(function(){
		/**
		 * 
		 * Get Related Posts
		 * 
		 */
		$('body').on('keypress', '.fabc-related-post .fabc-related-post-keywords input', function(e) {
			if( e.which == 13 ) {

				$(this).closest('.fabc-related-post').find('.fabc-related-post-keywords input').val();

				var keywords      = $(this).closest('.fabc-related-post').find('.fabc-related-post-keywords input').val();
				var parent_div_id = $(this).closest('.fabc-related-post').attr('id');

				$(this).closest('.fabc-related-post').find('.fabc-dynamic-results').show();
				$('#'+parent_div_id+' .fabc-loader').css('display', 'inline-block');;

				if ( keywords == '' ) {
					return;
				}

				var data = {
					'action':       'fabc_ajax_get_related_posts',
					'keywords':      keywords,
					'parent_div_id': parent_div_id,
				};

				$.ajax({ 
					type: 'POST', 
					url: ajaxurl, 
					data: data,
					success: function ( data ) {
						$('#'+data.parent_div_id+' select option').remove();
						$('#'+data.parent_div_id+' select').append( data.html );
						$('#'+data.parent_div_id+' .fabc-loader').hide();
					},//success
					error: function(XMLHttpRequest, textStatus, errorThrown) { 
					},//Error
				}); 

			}
		});



		/*		
		*
		* Update Related Post
		*
		*/
		$('body').on('click', '.fabc-related-posts-list li', function(event) {

			var title        = $(this).attr('data-fabc-post-title');
			var id           = $(this).attr('data-fabc-post-id');
			
			$(this).closest('.fabc-related-post').find('.fabc-related-post-title input').val( title );
			$(this).closest('.fabc-related-post').find('.fabc-related-post-id input').val( id  );

			//https://stackoverflow.com/questions/38495664/why-doesnt-the-change-event-in-jquery-fire-onchange-in-reactjs
		});


	});//Doc ready

})(jQuery);