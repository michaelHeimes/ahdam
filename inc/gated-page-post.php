<?php
function redirect_if_gated_and_not_logged_in() {
	if ( ! is_user_logged_in() ) {
		// Handle gated single posts
		if ( is_singular() ) {
			global $post;

			// Check if the post is gated
			$is_gated = get_post_meta( $post->ID, 'gated', true );

			if ( $is_gated ) {
				wp_redirect( home_url( '/members-only-content/' ) );
				exit;
			}
		}

		// Handle search results for expert-qa post type
		if ( is_search() && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'expert-qa' ) {
			wp_redirect( home_url( '/members-only-content/' ) );
			exit;
		}

		// Handle case where post_type is not set explicitly in query string
		if ( is_search() && get_query_var( 'post_type' ) === 'expert-qa' ) {
			wp_redirect( home_url( '/members-only-content/' ) );
			exit;
		}
	}
}
add_action( 'template_redirect', 'redirect_if_gated_and_not_logged_in' );
