<?php if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class NF_Action_Save
 */
final class NF_Actions_Save extends NF_Abstracts_Action
{
    /**
    * @var string
    */
    protected $_name  = 'save';

    /**
    * @var array
    */
    protected $_tags = array();

    /**
    * @var string
    */
    protected $_timing = 'late';

    /**
    * @var int
    */
    protected $_priority = '-1';

    /**
    * Constructor
    */
    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Store Submission', 'ninja-forms' );

        $settings = Ninja_Forms::config( 'ActionSaveSettings' );

        $this->_settings = array_merge( $this->_settings, $settings );
    }

    /*
    * PUBLIC METHODS
    */

    public function save( $action_settings )
    {

    }

    public function process( $action_settings, $form_id, $data )
    {
        if( isset( $data['settings']['is_preview'] ) && $data['settings']['is_preview'] ){
            return $data;
        }

        if( ! apply_filters ( 'ninja_forms_save_submission', true, $form_id ) ) return $data;

        $sub = Ninja_Forms()->form( $form_id )->sub()->get();

        $hidden_field_types = apply_filters( 'nf_sub_hidden_field_types', array() );

        // For each field on the form...
        foreach( $data['fields'] as $field ){

            // If this is a "hidden" field type.
            if( in_array( $field[ 'type' ], array_values( $hidden_field_types ) ) ) {
                // Do not save it.
                $data[ 'actions' ][ 'save' ][ 'hidden' ][] = $field[ 'type' ];
                continue;
            }

            $field[ 'value' ] = apply_filters( 'nf_save_sub_user_value', $field[ 'value' ], $field[ 'id' ] );

            $save_all_none = $action_settings[ 'fields-save-toggle' ];
            $save_field = true;

            // If we were told to save all fields...
            if( 'save_all' == $save_all_none ) {
            	$save_field = true;
                // For each exception to that rule...
            	foreach( $action_settings[ 'exception_fields' ] as
		            $exception_field ) {
                    // Remove it from the list.
            		if( $field[ 'key' ] == $exception_field[ 'field'] ) {
            			$save_field = false;
            			break;
		            }
	            }
            } // Otherwise... (We were told to save no fields.)
            else if( 'save_none' == $save_all_none ) {
            	$save_field = false;
                // For each exception to that rule...
	            foreach( $action_settings[ 'exception_fields' ] as
		            $exception_field ) {
                    // Add it to the list.
		            if( $field[ 'key' ] == $exception_field[ 'field'] ) {
			            $save_field = true;
			            break;
		            }
	            }
            }

            // If we're supposed to save this field...
            if( $save_field ) {
                // Do so.
	            $sub->update_field_value( $field['id'], $field['value'] );
            }
        }

        // If we have extra data...
        if( isset( $data[ 'extra' ] ) ) {
            // Save that.
            $sub->update_extra_values( $data[ 'extra' ] );
        }

        do_action( 'nf_before_save_sub', $sub->get_id() );

        $sub->save();

        do_action( 'nf_save_sub', $sub->get_id() );
        do_action( 'nf_create_sub', $sub->get_id() );
        do_action( 'ninja_forms_save_sub', $sub->get_id() );

        $data[ 'actions' ][ 'save' ][ 'sub_id' ] = $sub->get_id();

        return $data;
    }
}
