<?php

namespace GravityHelper;
use GFFormsModel;

class Elements extends GravityHelper {

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

}
