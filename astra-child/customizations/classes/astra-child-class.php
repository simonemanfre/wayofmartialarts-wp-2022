<?php 

/**
 * 
 * Start Class 
 *
 */
class FABC_Astra_Customization {
	
	/**
	 * 
	 * Class Constructor
	 *
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_setup') );
		add_action( 'wp_head', array( $this, 'js_related_posts' ) );
	}


	/**
	 * 
	 * After theme setup
	 *
	 */
	function theme_setup(){
		add_image_size( 'fabc-related-posts', 145, 97, true );
		add_image_size( 'fabc-cat-box', 426, 280, true );
		add_image_size( 'fabc-trending-box', 426, 200, true );
	}


	/*
	* 
	* Get related posts for js
	*
	*/
	function js_related_posts(){
	   $FABC_Astra_Customization_Object = new FABC_Astra_Customization(); 
	   ?>
	   <script type="text/javascript">
	      fabc_rps = <?php echo json_encode( $FABC_Astra_Customization_Object::get_related_posts() ); ?>;
	   </script>
	   <?php
	}


	/**
	 * 
	 * js options
	 *
	 */
	public static function get_related_posts() {

		$options = [];

		if ( !is_single() ) {
			return $options;
		}

		global $post;
        $post_id = $post->ID;

		ob_start();
		/**
		 * 
		 * Get Related Posts
		 *
		 */
		$load_from = self::load_from( $post_id );
		$args      = array(
			'post_status' => 'publish',
			'post_type'   => 'post',
			'post__in'    => $load_from,
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
		    while ( $the_query->have_posts() ) {
		        $the_query->the_post();
		        ?>
		        <div class="fabc-blog-post" data-fabc-post-title="<?php echo esc_attr( get_the_title() ); ?>" data-fabc-post-url="<?php echo esc_attr( get_the_permalink() ); ?>">
			        <?php 
			        include( locate_template( 'template-parts/content-single.php' ) );
			        ?>
			    </div>
			    <?php 
		    }
		}
		/**
		 * 
		 * Reset post data
		 *
		 */
		wp_reset_postdata();


		/**
		 * 
		 * Send back response
		 *
		 */
		$html = ob_get_clean();
		$options['related_posts_html'] = $html;
		return $options;
	}


	/**
	 * 
	 * Load posts from?
	 * @return $posts_array
	 *
	 */
	public static function load_from( $post_id ){

		$args = array(
			'fields'         => 'ids',
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'post__not_in'   => array( $post_id ),
		);

		$tag_ids         = [];
		$post_cats       = [];
		$posts_per_page  = 3;

		$post_tags       = get_the_tags( $post_id );
		if ( !empty( $post_tags ) ) {
			foreach ( $post_tags as $post_tag ) {
				$tag_ids[] = $post_tag->term_id; 
			}
		}

		$load_posts_from = get_theme_mod( 'fabc_load_from' );
		$post_cats       = wp_get_post_categories( $post_id );

		if ( empty( $load_posts_from ) ) {
			$load_posts_from = 'category';
		}
		if ( empty( $post_tags ) && $load_posts_from == 'post_tag' ) {
			$load_posts_from = 'category';
		}


		if ( $load_posts_from == 'cat_tag' ) {

			$posts_by_tags = [];
			$posts_by_cats = [];
			$merged_ids    = [];
			$tags_args     = [];
			$cats_args     = [];

			$tags_args['posts_per_page'] = -1;
			$tags_args['tax_query'] = array(
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'term_id',
					'terms'    => $tag_ids,
				),
			);
			$tags_args = array_merge( $tags_args, $args );

			$cats_args['posts_per_page'] = -1;
			$cats_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $post_cats,
				),
			);
			$cats_args        = array_merge( $cats_args, $args );

			$posts_by_tags    = get_posts( $tags_args );
			$posts_by_cats    = get_posts( $cats_args );
			$merged_ids       = array_merge( $posts_by_tags, $posts_by_cats );
			$merged_ids       = array_unique( $merged_ids );

			$args['post__in'] = $merged_ids;
			$args['orderby']  = 'post__in';

			$post_ids         = get_posts( $args );

			$posts_array      = array_slice( $post_ids, 0, $posts_per_page );

		}else {

			if ( $load_posts_from == 'category' ) {
				$tax_args['tax_query'] = array(
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $post_cats,
					),
				);
			}elseif( $load_posts_from == 'post_tag' ){
				$tax_args['tax_query'] = array(
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'term_id',
						'terms'    => $tag_ids,
					),
				);
			}
			$args = array(
				'fields'         => 'ids',
				'post_status'    => 'publish',
				'post_type'      => 'post',
				'post__not_in'   => array( $post_id ),
				'posts_per_page' => $posts_per_page,
			);
			$final_args  = array_merge( $tax_args, $args );
			$posts_array = get_posts( $final_args );

		}


		/**
		 * 
		 * Reset post data
		 *
		 */
		if( count( $posts_array ) >= 1 ){
			wp_reset_postdata();
		}
		
		return $posts_array;
	}

}//End of class FABC_Astra_Customization


/*		
*
* FABC_Astra_Customization Object
*
*/
$FABC_Astra_Customization_Object = new FABC_Astra_Customization(); 
