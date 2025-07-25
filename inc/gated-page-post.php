<?php
function redirect_if_gated_and_not_logged_in() {
	if ( is_singular() && ! is_user_logged_in() ) {

		global $post;

		// Get the value of the 'gated' field (works with ACF or native meta)
		$is_gated = get_post_meta( $post->ID, 'gated', true );

		// If gated is true/1/yes, redirect to your custom template page
		if ( $is_gated ) {
			// Replace with your actual redirect URL or template
			wp_redirect( home_url( '/members-only-content/' ) );
			exit;
		}
	}
}
add_action( 'template_redirect', 'redirect_if_gated_and_not_logged_in' );
