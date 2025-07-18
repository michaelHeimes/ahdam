<?php
/**
* Filters the next, previous and submit buttons.
* Replaces the form's <input> buttons with <button> while maintaining attributes from original <input>.
*
* @param string $button Contains the <input> tag to be filtered.
* @param array  $form    Contains all the properties of the current form.
*
* @return string The filtered button.
*/
add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );

function input_to_button( $button, $form ) {
	$fragment = WP_HTML_Processor::create_fragment( $button );
	$fragment->next_token();

	$attributes      = array( 'id', 'type', 'class', 'onclick' );
	$data_attributes = $fragment->get_attribute_names_with_prefix( 'data-' );
	if ( ! empty( $data_attributes ) ) {
		$attributes = array_merge( $attributes, $data_attributes );
	}

	$new_attributes = array();
	foreach ( $attributes as $attribute ) {
		$value = $fragment->get_attribute( $attribute );

		if ( $attribute === 'class' ) {
			$value .= ' violet'; // Append violet class
		}

		if ( ! empty( $value ) ) {
			$new_attributes[] = sprintf( '%s="%s"', $attribute, esc_attr( $value ) );
		}
	}

	// Handle label transformation
	$label = $fragment->get_attribute( 'value' );
	$words = explode( ' ', $label );
	if ( count( $words ) > 1 ) {
		$last_word = array_pop( $words );
		$label = implode( ' ', $words ) . ' <span class="inline-icon-wrap">' . esc_html( $last_word ) . '
			<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#fff"/></svg>
		</span>';
	} else {
		$label = '<span class="inline-icon-wrap">' . esc_html( $label ) . '
			<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z"/></mask><path d="M0 3.999c0 .246.182.447.403.447h6.254L4.13 7.235a.484.484 0 0 0 0 .633.377.377 0 0 0 .571 0l3.203-3.554a.545.545 0 0 0 .05-.067V4.23l.029-.058v-.027A.316.316 0 0 0 7.998 4a.662.662 0 0 0 0-.09c-.002-.02-.008-.038-.014-.056v-.027l-.028-.058V3.75l-.05-.069L4.701.13a.377.377 0 0 0-.57 0 .484.484 0 0 0 0 .633l2.514 2.788H.403C.182 3.551 0 3.753 0 4Z" fill="#fff"/></svg>
		</span>';
	}

	return sprintf( '<button %s>%s</button>', implode( ' ', $new_attributes ), $label );
}