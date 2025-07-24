<?php 
$post_type = get_post_type();

if( $post_type == 'news' ) {
	get_template_part('template-parts/loop', 'news');
}

if( $post_type == 'webinar' ) {
	get_template_part('template-parts/loop', 'webinar');
}