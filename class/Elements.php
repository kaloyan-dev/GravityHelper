<?php

namespace GravityHelper;

use GFFormsModel;

class Elements extends GravityHelper {

	public function ajax_spinner( $spiner_url ) {
		$this->options['ajax_spinner_url'] = $spiner_url;
		add_filter( "gform_ajax_spinner_url{$this->filter_affix}", array( $this, 'apply_ajax_spinner_url' ) );
	}

	public function apply_ajax_spinner_url() {
		return $this->options['ajax_spinner_url'];
	}

	public function button_submit() {
		add_filter( "gform_submit_button{$this->filter_affix}", array( $this, 'form_submit_button' ), 10, 2 );

		return $this;
	}

	public function form_submit_button( $button, $form ) {
		$attributes = apply_filters( 'gh_button_atts', '' );
		$content    = apply_filters( 'gh_button_content', $form['button']['text'] );
		return "<button {$attributes} id='gform_submit_button_{$form['id']}'>{$content}</button>";
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

	public function button_content( $content ) {
		$this->options['button_content'] = $content;
		add_filter( 'gh_button_content', array( $this, 'apply_button_content' ) );
	}

	public function apply_button_content( $current_content ) {
		$content = str_replace( '{content}', $current_content, $this->options['button_content'] );

		return $content;
	}

}
