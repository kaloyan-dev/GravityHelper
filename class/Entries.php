<?php

namespace GravityHelper;
use GFFormsModel;

class Entries extends GravityHelper {

	public function get_entries() {
		if ( $this->should_return() ) return;

		return GFFormsModel::get_leads( $this->form_id );
	}

	public function get_fields() {
		if ( $this->should_return() ) return;

		return GFFormsModel::get_form_meta( $this->form_id );
	}

	public function get_entries_data() {
		if ( $this->should_return() ) return;

		$data    = array();
		$entries = $this->get_entries();
		$fields  = $this->get_fields();

		if ( ! $entries || empty( $fields['fields'] ) ) {
			_e( 'No entries found.' , 'gh' );
			return $data;
		}

		$field_data = array();

		foreach ( $fields['fields'] as $field ) {
			$field_data[$field->id] = $field->label;
		}

		foreach ( $entries as $entry ) {
			$entry_data = array();

			foreach ( $field_data as $id => $label ) {
				$entry_data[$label] = $entry[$id];
			}

			$data[] = $entry_data;
		}

		return array_reverse( $data );
	}

}
