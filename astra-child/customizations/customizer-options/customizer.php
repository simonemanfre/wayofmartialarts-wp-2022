<?php
/*		
*
* Add Customizer Settings
*
*/
add_action( 'customize_register', 'astra_child_customizer_options' );
function astra_child_customizer_options( $wp_customize ) {

	$wp_customize->add_section( 'fabc_options', 
		array(
			'title'       => __( 'FABC Theme Options', 'astra' ),
			'priority'    => 20, 
			'capability'  => 'edit_theme_options',
		) 
	);

	$wp_customize->add_setting( 
		'fabc_load_from', 
		array(
			'default'    => 'default',
			'type'       => 'theme_mod', 
			'capability' => 'edit_theme_options',
		) 
	);

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize, 
		'astra_theme_name', 
			array(
				'label'        => __( 'Loads Posts From?', 'astra' ), 
				'settings'     => 'fabc_load_from', 
				'priority'     => 10, 
				'section'      => 'fabc_options',
				'type'         => 'select',
				'choices'      => array(
					''         => 'Default',
					'category' => 'Load From Categories Only',
					'post_tag' => 'Load From Tags Only',
					'cat_tag'  => 'Load From Both Tags & Categories',
				)
			)
		) 
	);
	
}