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
            'keywords'          => array( 'custom', 'ahdam', 'accordion', 'jobs', 'q&a' ),
            'supports'          => array(
                'anchor' => true
            ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'Ask The Experts Form',
            'title'             => __('Ask The Experts Form'),
            'description'       => __('A form for submitting questions to Ask The Experts'),
            'render_template'   => 'template-parts/blocks/ask-experts-form.php',
            'mode'              => 'edit',
            'keywords'          => array( 'custom', 'ahdam', 'ask', 'experts', 'q&a' ),
            'supports'          => array(
                'anchor' => true
            ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'Sticky Scroll List',
            'title'             => __('Sticky Scroll List'),
            'description'       => __('Sticky Element with a Scroll List'),
            'render_template'   => 'template-parts/blocks/sticky-scroll-list.php',
            'mode'              => 'edit',
            'keywords'          => array( 'custom', 'ahdam', 'sticky', 'scroll', 'list' ),
            'supports'          => array(
                'anchor' => true
            ),
        ));
        
        acf_register_block_type(array(
            'name'              => 'Tabs',
            'title'             => __('Tabs'),
            'description'       => __('Tabs'),
            'render_template'   => 'template-parts/blocks/tabs.php',
            'mode'              => 'edit',
            'keywords'          => array( 'custom', 'ahdam', 'ask', 'tabs', 'link' ),
            'supports'          => array(
                'anchor' => true
            ),
        ));
        
    }
}