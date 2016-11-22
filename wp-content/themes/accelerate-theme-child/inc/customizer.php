<?php
function accelerate_customize_register( $wp_customize ) {
	
	/* Sections */

	// footer details section
	$wp_customize->add_section( 'accelerate_footer' , array(
		'title' => __( 'Footer Details', 'accelerate-theme-child')
	) );
	
	/* Define generic controls */
	
	// create class to define textarea controls in Customizer
	class accelerate_Customize_Textarea_Control_Footer extends WP_Customize_Control {
		
		public $type = 'textarea';
		public function render_content() {
			
			echo '<label>';
				echo '<span class="customize-control-title">' . esc_html( $this-> label ) . '</span>';
				echo '<textarea rows="6" style ="width: 100%;"';
				$this->link();
				echo '>' . esc_textarea( $this->value() ) . '</textarea>';
			echo '</label>';
			
		}
	}	
	
	/* Contact details in footer */

	// footer message
	$wp_customize->add_setting( 'accelerate_footer_message', array (
		'default' => __( 'Your footer message', 'accelerate-theme-child' )
	) );
	$wp_customize->add_control( new accelerate_Customize_Textarea_Control_Footer(
		$wp_customize,
		'accelerate_footer_message',
		array( 
			'label' => __( 'Footer Message', 'accelerate-theme-child' ),
			'section' => 'accelerate_footer',
			'settings' => 'accelerate_footer_message'
	)));
	
}
add_action( 'customize_register', 'accelerate_customize_register' );

/* Add to theme */

// Give option to display custom footer details - called in footer.php
function accelerate_display_footer_details() { 
	echo "<p>" .get_theme_mod( 'accelerate_footer_message', 'Your footer message' ) . "</p>";
}
add_action( 'accelerate_footer_customizer', 'accelerate_display_footer_details' );
