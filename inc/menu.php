<?php
// Register menus
register_nav_menus(
	array(
		'main-nav-non-member'		=> __( 'The Main Menu: Non-member', 'trailhead' ),		// Main nav in header
		'main-nav-member'		=> __( 'The Main Menu: Member', 'trailhead' ),		// Main nav in header
		// 'offcanvas-nav-non-member'	=> __( 'The Off-Canvas Menu: Non-member', 'trailhead' ),	// Off-Canvas nav
		// 'offcanvas-nav-member'	=> __( 'The Off-Canvas Menu: Member', 'trailhead' ),	// Off-Canvas nav
		'footer-navigation'	=> __( 'Footer Navigation', 'trailhead' ),		// Secondary nav in footer
	)
);


// The Top Menu
function trailhead_top_nav_non_member() {
	wp_nav_menu(array(
		'container'			=> false,						// Remove nav container
		'menu_class'		=> 'vertical xlarge-horizontal menu main-nav align-right',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion xlarge-dropdown" data-submenu-toggle="true" data-hover-delay="200" data-closing-time="200">%3$s</ul>',
		'theme_location'	=> 'main-nav-non-member',					// Where it's located in the theme
		'depth'				=> 2,							// Limit the depth of the nav
		'fallback_cb'		=> false,						// Fallback function (see below)
		'walker'			=> new Topbar_Menu_Walker(),
		'link_before'    => '<span>',
		'link_after'     => '</span>'	
	));
}

function trailhead_top_nav_member() {
	wp_nav_menu(array(
		'container'			=> false,						// Remove nav container
		'menu_class'		=> 'vertical xlarge-horizontal menu main-nav align-right',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion xlarge-dropdown" data-submenu-toggle="true" data-hover-delay="200" data-closing-time="200">%3$s</ul>',
		'theme_location'	=> 'main-nav-member',					// Where it's located in the theme
		'depth'				=> 2,							// Limit the depth of the nav
		'fallback_cb'		=> false,						// Fallback function (see below)
		'walker'			=> new Topbar_Menu_Walker(),
		'link_before'    => '<span>',
		'link_after'     => '</span>'	
	));
}


// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"menu\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat("\t", $depth) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		// ✅ Allow <br> in titles
		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = wp_kses( $title, array( 'br' => array() ) );

		$item_output  = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

// The Off Canvas Menu
function trailhead_off_canvas_nav_non_member() {
	wp_nav_menu(array(
		'container'			=> false,							// Remove nav container
		'menu_id'			=> 'offcanvas-nav',					// Adding custom nav id
		'menu_class'		=> 'vertical menu accordion-menu',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
		'theme_location'	=> 'offcanvas-nav-non-member',					// Where it's located in the theme
		'depth'				=> 2,								// Limit the depth of the nav
		'fallback_cb'		=> false,							// Fallback function (see below)
		'walker'			=> new Off_Canvas_Menu_Walker(),
		'link_before'    => '<span>',
		'link_after'     => '</span>'	
	));
}

function trailhead_off_canvas_nav_member() {
	wp_nav_menu(array(
		'container'			=> false,							// Remove nav container
		'menu_id'			=> 'offcanvas-nav',					// Adding custom nav id
		'menu_class'		=> 'vertical menu accordion-menu',	// Adding custom nav class
		'items_wrap'		=> '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
		'theme_location'	=> 'offcanvas-nav-member',					// Where it's located in the theme
		'depth'				=> 2,								// Limit the depth of the nav
		'fallback_cb'		=> false,							// Fallback function (see below)
		'walker'			=> new Off_Canvas_Menu_Walker(),
		'link_before'    => '<span>',
		'link_after'     => '</span>'	
	));
}

class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = Array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}

// The Footer Menu
function trailhead_footer_navigation() {
	wp_nav_menu(array(
		'container'			=> 'false',				// Remove nav container
		'menu_id'			=> 'footer-navigation',		// Adding custom nav id
		'menu_class'		=> 'menu',				// Adding custom nav class
		'theme_location'	=> 'footer-navigation',		// Where it's located in the theme
		'depth'				=> 0,					// Limit the depth of the nav
		'fallback_cb'		=> ''					// Fallback function
	));
} /* End Footer Menu */

// Header Fallback Menu
function trailhead_main_nav_fallback() {
	wp_page_menu( array(
		'show_home'		=> true,
		'menu_class'	=> '',		// Adding custom nav class
		'include'		=> '',
		'exclude'		=> '',
		'echo'			=> true,
		'link_before'	=> '',		// Before each link
		'link_after'	=> ''		// After each link
	));
}

// Footer Fallback Menu
function trailhead_footer_navigation_fallback() {
	/* You can put a default here if you like */
}

// Add Foundation active class to menu
function required_active_nav_class( $classes, $item ) {
	if ( $item->current == 1 || $item->current_item_ancestor == true ) {
		$classes[] = 'active';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
