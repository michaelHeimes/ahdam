<?php
add_theme_support( 'editor-font-sizes', array(
	[
		'name' => __( 'Small', 'trailhead' ),
		'shortName' => __( 'S', 'trailhead' ),
		'slug' => 'small',
		'size' => '.875rem',
	],
	[
		'name' => __( 'Medium', 'trailhead' ),
		'shortName' => __( 'M', 'trailhead' ),
		'slug' => 'medium',
		'size' => 'clamp(1rem, 0.956rem + 0.188vw, 1.125rem)',
	],
	[
		'name' => __( 'Large', 'trailhead' ),
		'shortName' => __( 'L', 'trailhead' ),
		'slug' => 'large',
		'size' => 'clamp(1.063rem, 0.996rem + 0.282vw, 1.25rem)',
	],
) );

// add_filter('render_block', function($block_content, $block) {
	// if (!isset($block['blockName']) || $block['blockName'] !== 'core/button') {
	// 	return $block_content;
	// }
// 
	// // Load HTML
	// $doc = new DOMDocument();
	// libxml_use_internal_errors(true);
	// $doc->loadHTML(mb_convert_encoding($block_content, 'HTML-ENTITIES', 'UTF-8'));
// 
	// $links = $doc->getElementsByTagName('a');
	// foreach ($links as $link) {
	// 	if ($link->hasAttribute('class') && strpos($link->getAttribute('class'), 'wp-block-button__link') !== false) {
	// 		$text = $link->textContent;
	// 		$span = $doc->createElement('span', $text);
	// 		while ($link->firstChild) {
	// 			$link->removeChild($link->firstChild);
	// 		}
	// 		$link->appendChild($span);
	// 	}
	// }
// 
	// $body = $doc->getElementsByTagName('body')->item(0);
	// return $doc->saveHTML($body->firstChild);
// }, 10, 2);