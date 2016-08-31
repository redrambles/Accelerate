<?php
/**************************************************************************
Add theme customizer controls, settings etc.
**************************************************************************/
function accelerate_customize_register( $wp_customize ) {
	
	/*******************************************
	Sections
	********************************************/
	
	// contact details section
	$wp_customize->add_section( 'accelerate_contact' , array(
		'title' => __( 'Contact Details', 'accelerate-theme-child')
	) );
	
	// footer details section
	$wp_customize->add_section( 'accelerate_footer' , array(
		'title' => __( 'Footer Details', 'accelerate-theme-child')
	) );
	
	
	/********************
	Define generic controls
	*********************/
	
	// create class to define textarea controls in Customizer
	class accelerate_Customize_Textarea_Control_Address extends WP_Customize_Control {
		
		public $type = 'textarea';
		public function render_content() {
			
			echo '<label>';
				echo '<span class="customize-control-title">' . esc_html( $this-> label ) . '</span>';
				echo '<textarea rows="2" style ="width: 100%;"';
				$this->link();
				echo '>' . esc_textarea( $this->value() ) . '</textarea>';
			echo '</label>';
			
		}
	}	
	
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
	
	
	/*******************************************
	Contact details in header
	********************************************/

	// address
	$wp_customize->add_setting( 'accelerate_address_setting', array (
		'default' => __( 'Your address', 'accelerate-theme-child' )
	) );
	$wp_customize->add_control( new accelerate_Customize_Textarea_Control_Address(
		$wp_customize,
		'accelerate_address_setting',
		array( 
			'label' => __( 'Address', 'accelerate-theme-child' ),
			'section' => 'accelerate_contact',
			'settings' => 'accelerate_address_setting'
	)));
	
	// phone number
	$wp_customize->add_setting( 'accelerate_telephone_setting', array (
		'default' => __( 'Your phone number', 'accelerate-theme-child' )
	) );
	$wp_customize->add_control( new accelerate_Customize_Textarea_Control_Address(
		$wp_customize,
		'accelerate_telephone_setting',
		array( 
			'label' => __( 'Phone Number', 'accelerate-theme-child' ),
			'section' => 'accelerate_contact',
			'settings' => 'accelerate_telephone_setting'
	)));
	
	// email
	$wp_customize->add_setting( 'accelerate_email_setting', array (
		'default' => __( 'Your email address', 'accelerate-theme-child' )
	) );
	$wp_customize->add_control( new accelerate_Customize_Textarea_Control_Address(
		$wp_customize,
		'accelerate_email_setting',
		array( 
			'label' => __( 'Email', 'accelerate-theme-child' ),
			'section' => 'accelerate_contact',
			'settings' => 'accelerate_email_setting'
	)));
	
	/*******************************************
	Contact details in footer
	********************************************/

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
/**********************************************************************
Add controls / content to theme
**********************************************************************/
function accelerate_display_contact_details_in_header() { ?>
	
	<address>
		
		<p class="address">
			<?php echo get_theme_mod( 'accelerate_address_setting', 'Your address' ); ?>
		</p>
		
		<p class="tel">
			<?php echo get_theme_mod( 'accelerate_telephone_setting', 'Your telephone number' ); ?>
		</p>
		
		<?php $email = get_theme_mod( 'accelerate_email_setting', 'Your email address' ); ?>
		<p class="email">
			<a href="<?php echo $email; ?>">
				<?php echo $email; ?>
			</a>
		</p>
	
	</address>
	
<?php }
add_action( 'accelerate_in_header', 'accelerate_display_contact_details_in_header' );

// Give option to display custom footer details - called in footer.php
function accelerate_display_footer_details() { ?>
	
	<p>
			<?php echo get_theme_mod( 'accelerate_footer_message', 'Your footer message' ); ?>	
	</p>
	
<?php }
add_action( 'accelerate_footer', 'accelerate_display_footer_details' );
