<?php

namespace GravityHelper;
use GFFormsModel;

class GravityHelper {

	private $form_id      = false;
	private $filter_affix = '';
	private $options      = array();

	function __construct( $id = false ) {
		if ( $id ) {
			$this->form_id      = $id;
			$this->filter_affix = "_{$id}";
		}
	}

	public function button_submits() {
		add_filter( "gform_submit_button{$this->filter_affix}", array( $this, 'form_submit_button' ), 10, 2 );

		return $this;
	}

	public function form_submit_button( $button, $form ) {
		$attributes = apply_filters( 'gh_button_atts', '' );
		return "<button {$attributes} id='gform_submit_button_{$form['id']}'>{$form['button']['text']}</button>";
	}

	public function button_atts( $attributes ) {
		$this->options['button_atts'] = $attributes;
		add_filter( 'gh_button_atts', array( $this, 'apply_button_atts' ) );

		return $this;
	}

	public function apply_button_atts() {
		$attributes = $this->options['button_atts'];

		$attributes_html = '';

		foreach ( $attributes as $attribute => $value ) {
			$attributes_html[] = "{$attribute}='{$value}'";
		}

		return implode( '', $attributes_html );
	}

	public function get_entries() {
		if ( ! class_exists( 'GFFormsModel' ) ) {
			_e( 'Gravity Forms not active.', 'gh' );
			return;
		}

		if ( ! $this->form_id ) {
			_e( 'No form ID specified.', 'gh' );
			return;
		}

		return GFFormsModel::get_leads( $this->form_id );
	}

	public function get_fields() {
		if ( ! class_exists( 'GFFormsModel' ) ) {
			_e( 'Gravity Forms not active.', 'gh' );
			return;
		}

		if ( ! $this->form_id ) {
			_e( 'No form ID specified.', 'gh' );
			return;
		}

		return GFFormsModel::get_form_meta( $this->form_id );
	}

}
