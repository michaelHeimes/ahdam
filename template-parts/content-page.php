<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php get_template_part('template-parts/part', 'page-banner');?>
		
	<div class="entry-content">
        <div class="grid-container">
            <div class="grid-x grid-padding-x align-center">
                <div class="cell small-12 xlarge-10">
		            <?php the_content();?>
                </div>
            </div>
        </div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
