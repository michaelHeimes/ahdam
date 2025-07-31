<?php 
$post_type = get_post_type();

if( $post_type == 'news' ) {
	get_template_part('template-parts/loop', 'news');
} else if( $post_type == 'podcast' ) {
	get_template_part('template-parts/loop', 'podcast');
} else if( $post_type == 'webinar' ) {
	get_template_part('template-parts/loop', 'webinar');
} else if( $post_type == 'tip-sheet' ) {
	get_template_part('template-parts/loop', 'tip-sheet');
} else {
	get_template_part('template-parts/loop', 'default');
}