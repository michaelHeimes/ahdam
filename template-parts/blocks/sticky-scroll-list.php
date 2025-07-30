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
$id = 'sticky-scroll-list-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-sticky-scroll-list';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$items = get_field('items') ?? null;

if( $items ):
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> has-bg">
    <div class="bg full-width"></div>
    <div class="grid-x grid-padding-x relative z-1">
        <div class="cell medium-4 nav-wrap nav-wrap" data-sticky-container data-magellan>
            <div class="sticky" data-sticky data-sticky-on="medium" data-anchor="block-<?=$id;?>" data-margin-top="10">
                <ul class="no-bullet" data-magellan data-offset="100">
                    <?php $i = 1; foreach( $items as $item ):
                        $title = $item['title'] ?? null;
                        $text = $item['text'] ?? null;
                        if( $title && $text ):
                    ?>
                        <li class="h2 link-wrap">
                            <a href="#row-<?=$id;?>-<?=$i;?>">
                                <b><?=wp_kses_post($title);?></b>
                            </a>
                        </li>
                    <?php endif; $i++; endforeach;?>
                </ul>
            </div>
        </div>
        <div class="cell medium-8" id="block-<?=$id;?>">
            <?php $i = 1; foreach( $items as $item ):
                $title = $item['title'] ?? null;
                $text = $item['text'] ?? null;
                if( $title && $text ):
            ?>
                <div class="section block grid-x align-right" id="row-<?=$id;?>-<?=$i;?>" data-magellan-target="row-<?=$id;?>-<?=$i;?>">
                    <div class="inner">
                        <?php if( $text ):?>
                            <div class="text-wrap color-white">
                                <?=wp_kses_post($text);?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            <?php endif; $i++; endforeach;?>
        </div>
    </div>
</section>
<?php endif;?>