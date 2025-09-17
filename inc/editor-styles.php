<?php
// Adds your styles to the WordPress editor
add_action( 'after_setup_theme', 'trailhead_gutenberg_css' );

function trailhead_gutenberg_css() {
	// Enable support for editor styles
	add_theme_support( 'editor-styles' );

	// Add your editor stylesheet (relative to the theme root)
	add_editor_style( 'assets/styles/style.min.css' );
}