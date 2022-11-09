<?php 

/**
 * 
 * Start Class 
 *
 */
class FABC_Astra_Customization_Ads {
	
	/**
	 * 
	 * Class Constructor
	 *
	 */
	public function __construct() {
	}


	/**
	 * 
	 * Insert ads after paragraphs
	 * https://stackoverflow.com/questions/48991557/adding-ads-after-first-and-second-paragraph-of-wordpress-post
	 *
	 */
	public static function insert_ads_after_paragraphs( $ads, $content ) {

		if ( !is_array( $ads ) ) {
			return $content;
		}

		$closing_p  = '</p>';
		$paragraphs = explode( $closing_p, $content );

		foreach ($paragraphs as $index => $paragraph) {
			if ( trim( $paragraph ) ) {
				$paragraphs[$index] .= $closing_p;
			}

			$n = $index + 1;
			if ( isset( $ads[ $n ] ) ) {
				$paragraphs[$index] .= $ads[ $n ];
			}
		}

		return implode( '', $paragraphs );
	}
	

}//End of class 


/*		
*
* Object
*
*/
$FABC_Astra_Customization_Ads_Object = new FABC_Astra_Customization_Ads(); 
