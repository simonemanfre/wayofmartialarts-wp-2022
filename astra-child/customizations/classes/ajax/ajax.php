<?php 

/**
 * 
 * Start Class 
 *
 */
class FABC_AJAX {
	
	/**
	 * 
	 * Class Constructor
	 *
	 */
	public function __construct() {
	    add_action( 'wp_ajax_fabc_ajax_get_related_posts', array( $this, 'get_related_posts' ) ); 
		add_action( 'wp_ajax_nopriv_fabc_ajax_get_related_posts', array( $this, 'get_related_posts' ) );
	}
	

	/**
	 * 
	 * Get related posts
	 *
	 */
	public static function get_related_posts() {

		$data['parent_div_id'] = sanitize_text_field( $_POST['parent_div_id'] );
		$keywords              = sanitize_text_field( $_POST['keywords'] );
		
		$args = array(
			's'              => $keywords,
			'orderby'        => 'relevance',
			'post_status'    => 'publish',
		    'post_type'      => 'post',
		    'posts_per_page' => -1,
		); 

		ob_start();
		$query = new WP_Query( $args ); 
		if ( $query->have_posts() ) {
			
			while ( $query->have_posts() ) {
			    $query->the_post();
		    	?>
		    	<?php
		    		$post_data          = [];
		    		$post_data['value'] = get_the_ID();
		    		$post_data['label'] = get_the_title();
		    	?>
	    		<option value='<?php echo json_encode( $post_data ); ?>'>
	    			<?php echo get_the_title(); ?>
	    		</option>
		    	<?php 
		   	}
		}else {
			?>
				<option value=''>
					<?php esc_html_e( 'Sorry, no posts found.' ); ?>
				</option>
			<?php 
		}
		wp_reset_postdata();

		$data['html'] = ob_get_clean();
		wp_send_json( $data );
	}

}//End of class FABC_AJAX


/*		
*
* FABC_AJAX Object
*
*/
$FABC_FABC_AJAX_Object = new FABC_AJAX(); 