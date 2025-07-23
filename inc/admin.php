<?php
// This file handles the admin area and functions - You can use this file to make changes to the dashboard.

/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function trailhead_custom_admin_footer() {
// 	_e('<span id="footer-thankyou">Developed by <a href="https://proprdesign.com/" target="_blank">Propr Design</a></span>.', 'trailhead');
}

// adding it to the admin area
add_filter('admin_footer_text', 'trailhead_custom_admin_footer');

/* WP Editor
 */

	// Don't remove additional line breaks in editor
	// http://tinymce.moxiecode.com/wiki.php/Configuration
	function custom_tinymce_config( $init ) {
		$init['remove_linebreaks'] = false; 
		return $init;
	}
	add_filter('tiny_mce_before_init', 'custom_tinymce_config');

	function dg_tiny_mce_remove_h1( $in ) {
	        $in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
	    return $in;
	}
	add_filter( 'tiny_mce_before_init', 'dg_tiny_mce_remove_h1' );


/**
 * Misc edits to the Wordpress Admin
 */

	// Remove useless dashboard widgets
	function remove_dashboard_widgets() {
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
		remove_meta_box('dashboard_primary', 'dashboard', 'normal');
		remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
	}
	add_action('admin_init', 'remove_dashboard_widgets');


	// add styleselect to editor
	function add_styleselect($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	// add_filter('mce_buttons_2', 'add_styleselect');


	// add default styles to styleselect
	function add_styleselect_classes( $init_array ) {  
		// Define the style_formats array
		$style_formats = array(  
			// Each array child is a format with it's own settings
	        array(  
	            'title' => 'Large Blue Text',  
	            'block' => 'span',  
	            'classes' => 'large-blue-text',
	            'wrapper' => true,
	        ),
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		
		return $init_array;  
	} 
	// add_filter( 'tiny_mce_before_init', 'add_styleselect_classes' ); 


	// add editor-style.css
	function theme_editor_style() {
		add_editor_style( get_template_directory_uri() . '/assets/styles/style.min.css' );
	}
	add_action('init', 'theme_editor_style');


	// remove revisions meta box and recreate on right side for all post types
	function relocate_revisions_metabox() {
		$args = array(
		'public'   => true,
		'_builtin' => false
		); 
		$output = 'names'; // names or objects
		$post_types = get_post_types($args,$output); 
		foreach ($post_types  as $post_type) {
			remove_meta_box('revisionsdiv',$post_type,'normal'); 
			add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', $post_type, 'side', 'low');
		}
		
		// page 
		remove_meta_box('revisionsdiv','page','normal'); 
		add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'page', 'side', 'low');
		
		// post 
		remove_meta_box('revisionsdiv','post','normal'); 
		add_meta_box('revisionssidediv2', __('Revisions'), 'post_revisions_meta_box', 'post', 'side', 'low');
		
	}
	add_action('do_meta_boxes','relocate_revisions_metabox', 30);
	
	
	
	// 1. Add the new column to each post type admin list
	add_filter( 'manage_webinar_posts_columns', 'add_webinar_date_column' );
	add_filter( 'manage_event_posts_columns', 'add_event_date_column' );
	add_filter( 'manage_podcast_posts_columns', 'add_postcast_date_column' );
	function add_webinar_date_column( $columns ) {
		// Insert after title
		$new_columns = array();
		foreach ( $columns as $key => $value ) {
			$new_columns[ $key ] = $value;
			if ( $key == 'title' ) {
				$new_columns['webinar_date'] = 'Webinar Date';
			}
		}
		return $new_columns;
	}
	function add_event_date_column( $columns ) {
		// Insert after title
		$new_columns = array();
		foreach ( $columns as $key => $value ) {
			$new_columns[ $key ] = $value;
			if ( $key == 'title' ) {
				$new_columns['webinar_date'] = 'Event Date';
			}
		}
		return $new_columns;
	}
	function add_podcast_date_column( $columns ) {
		// Insert after title
		$new_columns = array();
		foreach ( $columns as $key => $value ) {
			$new_columns[ $key ] = $value;
			if ( $key == 'title' ) {
				$new_columns['webinar_date'] = 'Podcast Date';
			}
		}
		return $new_columns;
	}
	
	// 2. Populate the column with the appropriate date value
	add_action( 'manage_webinar_posts_custom_column', 'show_date_column', 10, 2 );
	add_action( 'manage_event_posts_custom_column', 'show_date_column', 10, 2 );
	add_action( 'manage_podcast_posts_custom_column', 'show_date_column', 10, 2 );
	function show_date_column( $column, $post_id ) {
		if ( $column == 'webinar_date' ) {
			$field_map = array(
				'webinar' => 'webinar_date',
				'event'   => 'cpt_event_date',
				'podcast' => 'podcast_date',
			);
	
			$post_type = get_post_type( $post_id );
			$field_key = isset( $field_map[ $post_type ] ) ? $field_map[ $post_type ] : '';
			$date = $field_key ? get_field( $field_key, $post_id ) : '';
	
			if ( $date ) {
				$date_obj = DateTime::createFromFormat( 'Ymd', $date );
				echo esc_html( $date_obj ? $date_obj->format( 'F j, Y' ) : $date );
			} else {
				echo '—';
			}
		}
	}
	
	// 3. Make the column sortable
	add_filter( 'manage_edit-webinar_sortable_columns', 'make_date_sortable' );
	add_filter( 'manage_edit-event_sortable_columns', 'make_date_sortable' );
	add_filter( 'manage_edit-podcast_sortable_columns', 'make_date_sortable' );
	function make_date_sortable( $columns ) {
		$columns['webinar_date'] = 'webinar_date';
		return $columns;
	}
	
	// 4. Handle sorting by date as a number
	add_action( 'pre_get_posts', 'date_column_orderby' );
	function date_column_orderby( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}
	
		$post_type = $query->get( 'post_type' );
		$meta_key = '';
	
		if ( $query->get( 'orderby' ) == 'webinar_date' ) {
			if ( $post_type == 'webinar' ) {
				$meta_key = 'webinar_date';
			} elseif ( $post_type == 'event' ) {
				$meta_key = 'cpt_event_date';
			} elseif ( $post_type == 'podcast' ) {
				$meta_key = 'podcast_date';
			}
	
			if ( $meta_key ) {
				$query->set( 'meta_key', $meta_key );
				$query->set( 'orderby', 'meta_value_num' ); // THIS LINE ensures numeric sorting
			}
		}
	}
	

	
	// 1. Add the "Gated Post" column to multiple post types
	add_filter( 'manage_post_posts_columns', 'add_gated_column' );
	add_filter( 'manage_appeal-writing-worship_posts_columns', 'add_gated_column' );
	add_filter( 'manage_newsletter_posts_columns', 'add_gated_column' );
	add_filter( 'manage_whitepaper_posts_columns', 'add_gated_column' );
	add_filter( 'manage_webinar_posts_columns', 'add_gated_column' );
	add_filter( 'manage_news_posts_columns', 'add_gated_column' );
	add_filter( 'manage_interview_posts_columns', 'add_gated_column' );
	
	function add_gated_column( $columns ) {
		$columns['gated_post'] = 'Gated Post';
		return $columns;
	}
	
	// 2. Display "Gated" if the ACF checkbox is checked
	add_action( 'manage_post_posts_custom_column', 'show_gated_column', 10, 2 );
	add_action( 'manage_appeal-writing-worship_posts_custom_column', 'show_gated_column', 10, 2 );
	add_action( 'manage_newsletter_posts_custom_column', 'show_gated_column', 10, 2 );
	add_action( 'manage_whitepaper_posts_custom_column', 'show_gated_column', 10, 2 );
	add_action( 'manage_webinar_posts_custom_column', 'show_gated_column', 10, 2 );
	add_action( 'manage_news_posts_custom_column', 'show_gated_column', 10, 2 );
	add_action( 'manage_interview_posts_custom_column', 'show_gated_column', 10, 2 );
	
	function show_gated_column( $column, $post_id ) {
		if ( $column === 'gated_post' ) {
			$gated = get_field('gated', $post_id);
			// ACF checkbox returns array or boolean, handle both
			if ( is_array($gated) && !empty($gated) ) {
				echo 'Gated';
			} elseif ( $gated ) {
				echo 'Gated';
			} else {
				echo '—';
			}
		}
	}
	
	