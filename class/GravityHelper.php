<?php

namespace GravityHelper;

use GFFormsModel;

class GravityHelper {

	protected $form_id      = false;
	protected $filter_affix = '';
	protected $options      = array();

	function __construct( $id = false ) {
		$this->switch_to_form( $id );
	}

	public function should_return( $form_id = false, $form_id_required = true ) {
		$should_return = false;

		if ( ! class_exists( 'GFFormsModel' ) ) {
			_e( 'Gravity Forms not active.', 'gh' );
			$should_return = true;
		}

		if ( $form_id_required && ! $this->form_id ) {
			_e( 'No form ID specified.', 'gh' );
			$should_return = true;
		}

		return $should_return;
	}

	public function switch_to_form( $form_id = false ) {
		$this->form_id      = false;
		$this->filter_affix = '';

		if ( $form_id ) {
			$this->form_id      = $form_id;
			$this->filter_affix = "_{$form_id}";
		}

		return $this;
	}

	public function reset_form() {
		$this->switch_to_form( false );

		return $this;
	}

	public function ajax_spinner( $spinner_url ) {
		$Elements = new Elements( $this->form_id );
		$Elements->ajax_spinner( $spinner_url );

		return $Elements;
	}

	public function button_submit() {
		$Elements = new Elements( $this->form_id );
		$Elements->button_submit();

		return $Elements;
	}

	public function get_entries() {
		$Entries = new Entries( $this->form_id );
		return $Entries->get_entries();
	}

	public function get_fields() {
		$Entries = new Entries( $this->form_id );
		return $Entries->get_fields();
	}

	public function get_entries_data() {
		$Entries = new Entries( $this->form_id );
		return $Entries->get_entries_data();
	}

}
