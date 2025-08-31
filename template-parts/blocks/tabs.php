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
$id = 'tabs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-tabs';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$tabs = get_field('tabs') ?? null;

if( $tabs ):
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

    <div class="grid-x bg-white box-shadow-5-15-10 br-10 overflow-hidden">
        <div class="cell medium-3 bg-light-gray">
            <ul class="tabs vertical" data-tabs id="tabs-<?=$id;?>">
                <?php $i = 1; foreach( $tabs as $tab ):
                    $title = $tab['title'] ?? null;
                    $text_content = $tab['text_content'] ?? null;
                    $link_rows = $tab['link_rows'] ?? null;
                    if( $title && $text_content || $title && $link_rows ):
                ?>
                    <li class="tabs-title p p-3<?php if( $i == 1):?> is-active<?php endif;?>">
                        <a href="#tab-<?=$id;?>-<?=$i;?>">
                            <b><?=wp_kses_post($title);?></b>
                        </a>
                    </li>
                <?php endif; $i++; endforeach;?>
            </ul>
        </div>
        <div class="cell medium-9">
            <div class="tabs-content vertical h-100" data-tabs-content="tabs-<?=$id;?>">
                <?php $i = 1; foreach( $tabs as $tab ):
                    $text_content = $tab['text_content'] ?? null;
                    $link_rows = $tab['link_rows'] ?? null;
                    if( $title && $text_content || $title && $link_rows ):
                ?>
                    <div class="tabs-panel<?php if( $i == 1):?> is-active<?php endif;?>" id="tab-<?=$id;?>-<?=$i;?>">
                        <div class="inner">
                            <?php if( $text_content ):?>
                                <div class="text-wrap<?php if( $link_rows ):?> has-link-rows<?php endif;?>">
                                    <?=wp_kses_post($text_content);?>
                                </div>
                            <?php endif;?>
                            <?php if($link_rows):?>
                                <ul class="link-rows no-bullet">
                                    <?php foreach($link_rows as $link_row ):
                                        if($link_row):    
                                            $link = $link_row['link_row']['link'] ?? null;
                                            $arrow_text = $link_row['link_row']['arrow_text'] ?? null;
                                    ?>
                                        <li>
                                            <?php if($link):
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';    
                                            ?>
                                                <a class="grid-x color-violet p p-2" href="<?php echo esc_url( $link_url ); ?>">
                                                    <?php if( $link_title):?>
                                                        <div class="cell auto">
                                                            <b><?=esc_html( $link_title );?></b>
                                                        </div>
                                                    <?php endif;?>
                                                    <div class="cell shrink">
                                                        <?php if($arrow_text):?>
                                                            <span class="uppercase">
                                                                <b><?=esc_html($arrow_text);?></b>
                                                            </span>
                                                        <?php endif;?>
                                                        <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M.5 5.998c0-.07.07-.17.206-.17h12.178l-.908-.864L7.574.783a.15.15 0 0 1 0-.226.234.234 0 0 1 .31 0l5.582 5.306.006.008v.004l.026.067v.016l-.005.06.005.036-.026.067v.004l-.002.003-5.586 5.312a.234.234 0 0 1-.31 0 .149.149 0 0 1-.038-.172l.038-.054 4.42-4.182.911-.863H.706C.57 6.17.5 6.068.5 6Z" fill="#C84DFF" stroke="#C84DFF"/></svg>
                                                    </div>
                                                </a>
                                            <?php endif;?>
                                            <div class="cell small-12">
                                                <hr>
                                            </div>
                                        </li>
                                    <?php endif; endforeach;?>
                                </ul>
                            <?php endif;?>
                        </div>
                    </div>
                <?php endif; $i++; endforeach;?>
            </div>
        </div>
    </div>
</section>
<?php endif;?>