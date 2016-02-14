<?php

namespace GravityHelper;
use GFFormsModel;

class GravityHelper {

	protected $form_id      = false;
	protected $filter_affix = '';
	protected $options      = array();

	function __construct( $id = false ) {
		if ( $id ) {
			$this->form_id      = $id;
			$this->filter_affix = "_{$id}";
		}
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

	public function button_submits() {
		$Elements = new Elements();
		$Elements->button_submits();

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
