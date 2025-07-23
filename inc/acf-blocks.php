<?php

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {

        acf_register_block_type(array(
            'name'              => 'Accordion Drawers',
            'title'             => __('Accordion Drawers'),
            'description'       => __('Accordion Drawers for several conent types.'),
            'render_template'   => 'template-parts/blocks/accordion.php',
            'mode'              => 'edit',
            'keywords'          => array( 'custom', 'ahdam', 'copy', 'text' ),
            'supports'          => array(
                'anchor' => true
            ),
        ));
    }
}