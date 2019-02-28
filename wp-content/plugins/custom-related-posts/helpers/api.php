<?php

class CRP_Api {

    public function __construct()
    {
        add_action( 'rest_api_init', array( $this, 'api_register_data' ) );
    }

    public function api_register_data() {
        if ( function_exists( 'register_rest_field' ) ) { // Prevent issue with Jetpack.
			register_rest_route( 'custom-related-posts/v1', '/relations/(?P<id>\d+)', array(
				'callback' => array( $this, 'api_get_relations' ),
				'methods' => 'GET',
				'args' => array(
					'id' => array(
						'validate_callback' => array( $this, 'api_validate_numeric' ),
					),
				),
            ));
            register_rest_route( 'custom-related-posts/v1', '/relations/(?P<id>\d+)', array(
				'callback' => array( $this, 'api_add_relation' ),
				'methods' => 'POST',
				'args' => array(
					'id' => array(
						'validate_callback' => array( $this, 'api_validate_numeric' ),
					),
                ),
            ));
            register_rest_route( 'custom-related-posts/v1', '/relations/(?P<id>\d+)', array(
				'callback' => array( $this, 'api_remove_relation' ),
				'methods' => 'DELETE',
				'args' => array(
					'id' => array(
						'validate_callback' => array( $this, 'api_validate_numeric' ),
					),
                ),
            ));
            register_rest_route( 'custom-related-posts/v1', '/search', array(
				'callback' => array( $this, 'api_search' ),
                'methods' => 'GET',
                'args' => array(
					'keyword' => array(
						'type' => 'string',
					),
				),
			));
		}
    }

    public function api_validate_numeric( $param, $request, $key ) {
		return is_numeric( $param );
	}

    public function api_add_relation( $request ) {
        $base_id = $request['id'];
        $type = $request['type'];

        if ( current_user_can( 'edit_post', $base_id ) ) {
            $target_id = $request['target'];
            $from = 'from' === $type || 'both' === $type ? true : false;
            $to = 'to' === $type || 'both' === $type ? true : false;

            CustomRelatedPosts::get()->helper( 'relations' )->add_relation( $base_id, $target_id, $from, $to );
        }

        return $this->api_get_relations( $request );
    }

    public function api_remove_relation( $request ) {
        $base_id = $request['id'];
        $type = $request['type'];

        if ( current_user_can( 'edit_post', $base_id ) ) {
            $target_id = $request['target'];
            $from = 'from' === $type || 'both' === $type ? true : false;
            $to = 'to' === $type || 'both' === $type ? true : false;

            CustomRelatedPosts::get()->helper( 'relations' )->remove_relation( $base_id, $target_id, $from, $to );
        }

        return $this->api_get_relations( $request );
	}

    public function api_get_relations( $request ) {
        return array(
            'from' => CustomRelatedPosts::get()->relations_from( $request['id'] ),
            'to' => CustomRelatedPosts::get()->relations_to( $request['id'] ),
        );
    }

    public function api_search( $request ) {
        $args = array(
            's' => $request['keyword'],
            'post_type' => CustomRelatedPosts::setting( 'general_post_types' ),
            'post_status' => CustomRelatedPosts::setting( 'search_post_status' ),
            'posts_per_page' => intval( CustomRelatedPosts::setting( 'search_number_of_posts' ) ),
            'orderby' => 'date',
            'order' => 'DESC',
        );

        $args = apply_filters( 'crp_search_args', $args );
        $query = new WP_Query( $args );

        $posts = array();
        if ( $query->have_posts() ) {
            $query_posts = $query->posts;

            foreach( $query_posts as $post ) {
                $post_type = get_post_type_object( $post->post_type );

                $posts[] = array(
                    'id' => $post->ID,
                    'title' => $post->post_title,
                    'permalink' => get_permalink( $post ),
                    'status' => $post->post_status,
                    'date' => $post->post_date,
                    'date_display' => mysql2date( "j M 'y", $post->post_date ),
                    'post_type' => $post_type->labels->singular_name,
                    
                );
            }
        }

        return $posts;
	}
}