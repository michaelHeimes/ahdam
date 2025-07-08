<?php
/**
 * Template name: Members Only Content Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package trailhead
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                <div class="entry-content">
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x">
                            <div class="cell small-12">
                                <?php get_template_part('template-parts/part', 'members-only-content');?>
                            </div>
                        </div>
                    </div>
                </div><!-- .entry-content -->
            
            </article><!-- #post-<?php the_ID(); ?> -->

		<?php endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
