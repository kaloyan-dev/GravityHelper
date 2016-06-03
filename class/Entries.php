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

		$field_data     = array();
		$complex_fields = array();

		foreach ( $fields['fields'] as $field ) {
			$field_data[$field->id] = $field->label;

			if ( ! empty( $field['inputs'] ) ) {
				$complex_field_inputs = array();

				foreach ( $field['inputs'] as $field_input ) {
					$complex_field_inputs[] = array(
						'id'    => $field_input['id'],
						'label' => $field_input['label'],
					);
				}

				$complex_fields[$field->id] = $complex_field_inputs;
			}
		}

		foreach ( $entries as $entry ) {
			$entry_data = array();

			foreach ( $field_data as $id => $label ) {

				$entry_content = $entry[$id];
				
				if ( in_array( $id, array_keys( $complex_fields ) ) ) {
					$entry_content = array();

					foreach ( $complex_fields[$id] as $input_data ) {

						$input_checked = empty( $entry[ $input_data['id'] ] ) ? 0 : 1;

						$entry_content[] = array(
							'label'   => $input_data['label'],
							'checked' => $input_checked,
						);
					}
				}

				$entry_data[$label] = $entry_content;
			}

			$data[$entry['id']] = $entry_data;
		}

		return array_reverse( $data, true );
	}

}
