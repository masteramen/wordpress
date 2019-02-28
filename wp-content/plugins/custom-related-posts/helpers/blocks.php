<?php

class CRP_Blocks {

    public function __construct()
    {
        add_action('init', array( $this, 'init' ) );
    }

    public function init()
    {
        if ( function_exists( 'register_block_type' ) ) {
			$block_settings = array(
				'attributes' => array(
                    'title' => array(
                        'type' => 'string',
                        'default' => __( 'Related Posts', 'custom-related-posts' ),
                    ),
                    'order_by' => array(
                        'type' => 'string',
                        'default' => 'title',
                    ),
                    'order' => array(
                        'type' => 'string',
                        'default' => 'ASC',
                    ),
                    'none_text' => array(
                        'type' => 'string',
                        'default' => __( 'None found', 'custom-related-posts' ),
                    ),
				),
				'render_callback' => array( $this, 'custom_related_posts_block' ),
			);

            register_block_type( 'custom-related-posts/related-posts', $block_settings );
            
            $block_settings = array(
				'attributes' => array(
                    'relations' => array(
                        'type' => 'array',
                    ),
				),
				'render_callback' => array( $this, 'custom_related_posts_preview_block' ),
			);

			register_block_type( 'custom-related-posts/related-posts-preview', $block_settings );
        }
    }

    public function custom_related_posts_block( $atts )
    {
        $post_id = get_the_ID();
        return CustomRelatedPosts::get()->helper( 'output' )->output_list( $post_id, $atts );
    }

    public function custom_related_posts_preview_block( $atts )
    {
        return CustomRelatedPosts::get()->helper( 'output' )->output_relations( $atts['relations'] );
    }
}