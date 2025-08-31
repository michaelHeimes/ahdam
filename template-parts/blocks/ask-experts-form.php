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
 
$login = get_field('header_login', 'option') ?? null;
$join = get_field('header_join', 'option') ?? null;

// Create id attribute allowing for custom "anchor" value.
$id = 'ask-experts-form-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wp-block-ask-experts-form';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
$title = get_field('title') ?? null;
$form_members_only_text = get_field('form_members_only_text') ?? null;
$form_cta_text = get_field('form_cta_text') ?? null;
$form_disclaimer_text = get_field('form_disclaimer_text') ?? null;
$copy = get_field('copy') ?? null;
$form_id = get_field('form_id') ?? null;

if( $title || $copy || $form_cta_text || $form_disclaimer_text || $form_id ):
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="inner overflow-hidden br-10 box-shadow-5-15-10">
        <div class="grid-x grid-padding-x">
            <?php if( $title || $copy ):?>
                <div class="left cell small-12 medium-6">
                    <div class="inner h-100 grid-x flex-dir-column align-justify">
                        <?php if( $title ):?>
                            <h2><?=wp_kses_post( $title );?></h2>
                        <?php endif;?>
                        <div>
                            <?php if( $copy ):?>
                                <div class="copy-wrap p p-3">
                                    <?=wp_kses_post( $copy );?>
                                </div>
                            <?php endif;?>
                            
                            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <label>
                                    <span class="screen-reader-text"><?php _e( 'Search Expert Q&A:', 'trailhead' ); ?></span>
                                    <input type="search" class="search-field" placeholder="Search questions from our members" value="<?php echo get_search_query(); ?>" name="s" />
                                </label>
                                <input type="hidden" name="post_type" value="expert-qa" />
                                <button type="submit" class="search-submit"><?php _e( 'Search', 'your-textdomain' ); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if( $form_cta_text || $form_members_only_text || $form_disclaimer_text || $form_id  ):?>
                <div class="right cell small-12 medium-6 bg-black">
                    <div class="inner">
                        <?php if( $form_cta_text && is_user_logged_in() ):?>
                            <div class="text-wrap">
                                <?php if( $form_cta_text ):?>
                                    <div class="p p-3">
                                        <b><?=wp_kses_post($form_cta_text);?></b>
                                    </div>
                                <?php endif;?>
                                <?php if( $form_disclaimer_text ):?>
                                    <div class="p">
                                        <b><?=wp_kses_post($form_disclaimer_text);?></b>
                                    </div>
                                <?php endif;?>
                            </div>
                            
                        <?php elseif($form_members_only_text && !is_user_logged_in()):?>
                            <div class="text-wrap">
                                <div class="p p-3">
                                    <b><?=wp_kses_post($form_members_only_text);?></b>
                                </div>
                                <?php if( $login || $join ):?>
                                    <div class="login-join-wrap cell small-12">
                                        <?php if( $login  || $join ) {
                                            get_template_part('template-parts/part', 'btn-group',
                                                array(
                                                    'btn1' => $login,
                                                    'btn1-classes' => 'white-outline',
                                                    'btn2' => $join,
                                                    'btn2-classes' => 'violet',
                                                ),
                                            );
                                        };?>
                                    </div>
                                <?php endif;?>
                            </div>
                        <?php endif;?>
                        <div class="form-wrap">
                            <?php if( is_user_logged_in() ):?>
                                <?=gravity_form( $form_id, false, false, false, '', true, '' ); ;?>
                            <?php else:?>
                                <svg class="dummy-form" width="100%" height="" viewBox="0 0 391 299" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="204" y="195" width="186" height="48" rx="9" stroke="#fff" stroke-width="2"/><rect x="1" y="1" width="389" height="176" rx="9" stroke="#fff" stroke-width="2"/><rect x="1" y="195" width="186" height="48" rx="9" stroke="#fff" stroke-width="2"/><rect y="264" width="391" height="35" rx="17.5" fill="#C84DFF"/><path d="M178.119 284.856c.39 0 .707-.043.951-.129.462-.165.693-.471.693-.918a.677.677 0 0 0-.344-.607c-.229-.14-.589-.264-1.08-.371l-.838-.188c-.823-.186-1.392-.388-1.708-.607-.533-.365-.8-.936-.8-1.713 0-.709.258-1.298.774-1.767.515-.469 1.273-.704 2.272-.704.834 0 1.545.222 2.132.666.591.44.9 1.081.929 1.923h-1.59c-.028-.476-.236-.815-.623-1.015-.258-.133-.578-.199-.961-.199-.426 0-.766.086-1.021.258a.822.822 0 0 0-.381.72.68.68 0 0 0 .376.633c.161.093.505.203 1.031.328l1.364.328c.598.143 1.05.334 1.354.574.473.373.709.912.709 1.617 0 .723-.278 1.325-.833 1.805-.551.476-1.332.714-2.341.714-1.032 0-1.843-.234-2.434-.704-.59-.472-.886-1.12-.886-1.944h1.579c.05.362.149.632.296.811.268.326.728.489 1.38.489Zm9.147-1.907v-4.866h1.681v4.866c0 .842-.13 1.497-.392 1.966-.487.859-1.416 1.289-2.787 1.289-1.372 0-2.303-.43-2.793-1.289-.262-.469-.392-1.124-.392-1.966v-4.866h1.681v4.866c0 .544.064.942.193 1.193.201.444.637.666 1.311.666.669 0 1.104-.222 1.305-.666.129-.251.193-.649.193-1.193Zm6.88 3.051h-3.587v-7.917h3.845c.971.014 1.658.295 2.063.843.243.337.365.74.365 1.209 0 .483-.122.872-.365 1.165-.136.165-.337.315-.602.451.405.147.709.38.913.699.208.318.312.705.312 1.16 0 .469-.118.89-.355 1.262-.15.247-.338.455-.564.623a2.212 2.212 0 0 1-.902.398 5.555 5.555 0 0 1-1.123.107Zm-.037-3.486h-1.971v2.111h1.944c.347 0 .618-.047.811-.14.351-.172.526-.501.526-.988 0-.412-.17-.695-.51-.849-.19-.086-.456-.13-.8-.134Zm.822-1.509c.215-.129.322-.36.322-.693 0-.369-.143-.612-.43-.73-.247-.083-.562-.124-.945-.124h-1.74v1.746h1.944c.347 0 .63-.067.849-.199Zm5.065 4.995h-1.542v-7.917h2.406l1.44 6.225 1.429-6.225h2.379V286h-1.542v-5.355c0-.154.002-.369.006-.645.003-.279.005-.494.005-.644L203.079 286h-1.606l-1.488-6.644c0 .15.002.365.005.644.004.276.006.491.006.645V286Zm7.519-7.917h1.644V286h-1.644v-7.917Zm8.943 0v1.402h-2.369V286h-1.665v-6.515h-2.379v-1.402h6.413Z" fill="#fff"/></svg>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</section>
<?php endif;?>