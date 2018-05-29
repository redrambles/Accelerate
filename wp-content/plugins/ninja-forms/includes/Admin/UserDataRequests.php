<?php if ( ! defined( 'ABSPATH' ) ) exit;

class NF_Admin_UserDataRequests {

	/** Class constructor */
	public function __construct() {
		add_filter( 'wp_privacy_personal_data_exporters', array(
			$this, 'plugin_register_exporters' ) );

		add_filter( 'wp_privacy_personal_data_erasers', array(
			$this, 'plugin_register_erasers' ) );
	}

	/**
	 * Register exporter for Plugin user data.
	 *
	 * @param array $exporters
	 *
	 * @return array
	 */
	function plugin_register_exporters( $exporters = array() ) {
		$exporters[] = array(
			'exporter_friendly_name' => __( 'Ninja Forms Submission Data', 'ninja-forms' ),
			'callback'               => array( $this, 'plugin_user_data_exporter' ),
		);
		return $exporters;
	}

	/**
	 * Register eraser for Plugin user data.
	 *
	 * @param array $erasers
	 *
	 * @return array
	 */
	function plugin_register_erasers( $erasers = array() ) {
		$erasers[] = array(
			'eraser_friendly_name' => __( 'Ninja Forms Submissions Data', 'ninja-forms' ),
			'callback'               => array( $this, 'plugin_user_data_eraser' ),
		);
		return $erasers;
	}

	/**
	 * Adds Ninja Forms Submission data to the default HTML export file that
	 * WordPress creates on converted request
	 *
	 * @param $email_address
	 * @param int $page
	 *
	 * @return array
	 */
	function plugin_user_data_exporter( $email_address, $page = 1 ) {
		$export_items = array();

		// get the user
		$user = get_user_by( 'email', $email_address );

		if ( $user && $user->ID ) {
			$item_id = "ninja-forms-" . $user->ID;

			$group_id = 'ninja-forms';

			$group_label = __( 'Ninja Forms Submission Data', 'ninja-forms' );

			// we get the submissions the old-fashioned way
			$subs = get_posts(
				array(
					'author' => $user->ID,
					'post_type' => 'nf_sub',
					'posts_per_page' => -1
				)
			);

			foreach($subs as $sub) {
				$data = array();
				// get the field values from postmeta
				$sub_meta = get_post_meta( $sub->ID );

				// make sure we have a form submission
				if ( isset( $sub_meta[ '_form_id' ] ) ) {
					$form = Ninja_Forms()->form( $sub_meta[ '_form_id' ][ 0 ] )
                        ->get();
					$fields = Ninja_Forms()->form( $sub_meta[ '_form_id' ][ 0 ] )
						->get_fields();

					foreach ( $fields as $field_id => $field ) {
						// we don't care about submit fields
						if ( 'submit' != $field->get_setting( 'type' ) ) {
							// make sure there is a value
							if ( isset( $sub_meta[ '_field_' . $field_id ] ) ) {

								//listcheckbox fields may need to be unserialized
								if( 'listcheckbox' == $field->get_setting( 'type' ) ) {

									//implode the unserialized array
									$value = implode( ',', maybe_unserialize(
										$sub_meta[	'_field_' . $field_id ][ 0 ] ));
								} else {
									$value = $sub_meta[	'_field_' . $field_id ][ 0 ];
								}
								// Add label/value pairs to data array
								$data[] = array(
									'name'  => $field->get_setting( 'label' ),
									'value' => $value
								);
							}
						}
					}

					// Add this group of items to the exporters data array.
					$export_items[] = array(
						'group_id'    => $group_id . '-' . $sub->ID,
						'group_label' => $group_label . '-' .
						                 $form->get_setting( 'title' ),
						'item_id'     => $item_id . '-' . $sub->ID,
						'data'        => $data,
					);
				}
			}
		}
		// Returns an array of exported items for this pass, but also a boolean whether this exporter is finished.
		//If not it will be called again with $page increased by 1.
		return array(
			'data' => $export_items,
			'done' => true,
		);
	}

	/**
	 * Eraser for Plugin user data. This will completely erase all Ninja Form
	 * submission data for the user when converted by the admin.
	 *
	 * @param $email_address
	 * @param int $page
	 *
	 * @return array
	 */
	function plugin_user_data_eraser( $email_address, $page = 1 ) {
		if ( empty( $email_address ) ) {
			return array(
				'items_removed'  => false,
				'items_retained' => false,
				'messages'       => array(),
				'done'           => true,
			);
		}

		// get the user
		$user = get_user_by( 'email', $email_address );
		$messages = array();
		$items_removed  = false;
		$items_retained = false;

		if ( $user && $user->ID ) {

			// get submissions the old-fashioned way
			$subs = get_posts(
				array(
					'author' => $user->ID,
					'post_type' => 'nf_sub',
					'posts_per_page' => -1
				)
			);
			if( 0 < sizeof( $subs ) ) {
				$items_removed = true;
			}

			// iterate and delete the submissions
			foreach($subs as $sub) {
				wp_delete_post( $sub->ID, true );
			}
		}

		// Returns an array of exported items for this pass, but also a boolean whether this exporter is finished.
		//If not it will be called again with $page increased by 1.
		return array(
			'items_removed'  => $items_removed,
			'items_retained' => $items_retained,
			'messages'       => $messages,
			'done'           => true,
		);
	}
}