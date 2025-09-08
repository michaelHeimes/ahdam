<?php
if(!defined('ABSPATH')) {
    exit;
}
/**
 * Accordion Drawers Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-drawers-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-accordion-drawers';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$login = get_field('header_login', 'option') ?? null;
$join = get_field('header_join', 'option') ?? null;

$content_source = get_field('content_source') ?? null;
$manual_content = get_field('manual_content') ?? null;
$expert_qas = get_field('expert_qas') ?? null;
$jobs = get_field('jobs') ?? null;

$rows = '';
if( $content_source == 'manual' ) {
    $rows = $manual_content['rows'] ?? null;
}
if( $content_source == 'expert-qas' ) {
    $non_member_cta_text = $expert_qas['non_member_cta_text'] ?? null;
    $non_member_posts_to_show = $expert_qas['non_member_posts_to_show'] ?? null;
    $expert_posts_to_show = $expert_qas['expert_posts_to_show'] ?? null;
    if( $non_member_posts_to_show  == 'all' || $expert_posts_to_show == 'all' ) {
        $posts_per_page = -1;
        if( !is_user_logged_in() ) {
            $posts_per_page = 2;
        }
        $rows = get_posts(array(
            'post_type'      => 'expert-qa',
            'posts_per_page' => $posts_per_page,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));
    }
    if( $non_member_posts_to_show  == 'picker' || $expert_posts_to_show == 'picker' ) {
        if( is_user_logged_in() ) {
            $rows = $expert_qas['expert_qa_posts'] ?? null;
        } else {
            $rows = $expert_qas['non_member_expert_qa_posts'] ?? null;
        }
    }
}
if( $content_source == 'jobs' ) {
    $job_posts_to_show = $jobs['job_posts_to_show'];
    if( $job_posts_to_show == 'all' ) {
        $rows = get_posts(array(
            'post_type'      => 'job',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));
    }
    if( $job_posts_to_show == 'picker' ) {
        $rows = $jobs['job_posts'] ?? null;
    }
}

$auto_open_first = get_field('auto_open_first');
$allow_multiple_expand = get_field('allow_multiple_expand');
$allow_all_closed = get_field('allow_all_closed');
$update_url_with_drawer_title = get_field('update_url_with_drawer_title');

if( $rows ):
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <ul class="accordion bg-white box-shadow-5-15-10 br-10" 
        data-deep-link-smudge-offset="12"
    <?php
        if($allow_multiple_expand) {
            echo 'data-multi-expand="true"';
        }
        if($allow_all_closed) {
            echo 'data-allow-all-closed="true"';
        } if($update_url_with_drawer_title) {
            echo 'data-deep-link="true"';
            echo 'data-deep-link-smudge="true"';
            echo 'data-update-history="true"';
        }
    ?>
    data-accordion>
        <?php $i = 1; foreach( $rows as $row ):
            if( $content_source == 'manual' ) {
                $title = $row['title'] ?? null;  
                $content = $row['content'] ?? null;
            }               
            if( $content_source == 'expert-qas' ) {
                $title = get_the_title($row);  
                $post = get_post($row);
                $content = apply_filters('the_content', $post->post_content);
            }
            if( $content_source == 'jobs' ) {
                $title = get_the_title($row);  
                $post = get_post($row);
                $content = apply_filters('the_content', $post->post_content);
            }   
            
            if( $title && $content ):
        ?>
            <li class="accordion-item<?php if($auto_open_first && $i == 1):?> is-active<?php endif;?>" data-accordion-item>
                <a class="p p-2 relative" href="#<?=sanitize_title($title);?>" class="accordion-title">
                    <?php if( $content_source == 'expert-qas' ):?>
                        <div class="grid-x">
                            <div class="cell shrink">
                                <strong>Q:</strong>
                            </div>
                            <div class="cell auto">
                    <?php endif;?>
                    
                                <?=wp_kses_post($title);?>
                    
                    <?php if( $content_source == 'expert-qas' ):?>
                            </div>
                        </div>
                    <?php endif;?>
                
                </a>
                <div class="accordion-content p" data-tab-content id="<?=sanitize_title($title);?>">
                    <?php if( $content_source == 'expert-qas' ):?>
                        <div class="grid-x">
                            <div class="cell shrink">
                                <strong>A:</strong>
                            </div>
                            <div class="cell auto">
                    <?php endif;?>
                    
                                <?=wp_kses_post($content);?>
                                
                    <?php if( $content_source == 'expert-qas' ):?>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </li>
        <?php endif; $i++; endforeach;?>
    </ul>
    <?php if( $content_source == 'expert-qas' && !is_user_logged_in() && $non_member_cta_text ):?>
        <div class="wp-block-non-member-cta">
            <?=wp_kses_post($non_member_cta_text);?>
            <?php if( $login || $join ) :?>
                <div class="wp-block-link-wrap">
                    <?php get_template_part('template-parts/part', 'btn-group',
                        array(
                            'flex-classes' => 'align-center',
                            'btn1' => $login,
                            'btn1-classes' => 'navy-outline',
                            'btn2' => $join,
                            'btn2-classes' => 'violet',
                        ),
                    );?>
                </div>
            <?php endif;?>
        </div>
    <?php endif;?>
</section>
<?php endif;?>