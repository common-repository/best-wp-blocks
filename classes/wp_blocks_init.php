<?php 
if (!class_exists('WP_Blocks_Core_Init')) {
    class WP_Blocks_Core_Init {
        function __construct()  {
            add_action( 'init', array($this, '___wp_blocks') );
            add_action( 'manage_wow_blocks_posts_custom_column',  array($this,'___wp_blocks_columns'), 10, 2 );
            add_filter( 'manage_edit-wow_blocks_columns',  array($this,'___wp_blocks_edit_columns') ) ;
            add_shortcode('wow_blocks',  array($this,'___wp_blocks_shortcode') );
            add_shortcode('blocks',  array($this,'___wp_blocks_shortcode') );
        }

        public function ___wp_blocks() {
            register_post_type('wow_blocks', 
                array(	
                    'label' => BEST_WP_BLOCKS_NICENAME,
                    'description' => 'Create content blocks which can be used in posts, pages and widgets.',
                    'public' => true,
                    'show_ui' => true,
                    'menu_icon' => 'dashicons-layout',
                    'show_in_menu' => true,
                    'capability_type' => 'page',
                    'hierarchical' => true,
                    'rewrite' => array('slug' => 'wow-blocks'),
                    'query_var' => true,
                    'has_archive' => true,
                    'exclude_from_search' => true,
                    'supports' => array(
                        'title',
                        'editor',
                        'custom-fields',
                        'revisions',
                        'author',
                        'thumbnail'
                        ),
                        'labels' => array (
                            'name' => BEST_WP_BLOCKS_NICENAME,
                            'singular_name' => BEST_WP_BLOCKS_NICENAME,
                            'menu_name' => BEST_WP_BLOCKS_NICENAME,
                            'add_new' => 'Add Block',
                            'add_new_item' => 'Add New Block',
                            'new_item' => 'New Block',
                            'edit' => 'Edit',
                            'edit_item' => 'Edit Block',
                            'view' => 'View Block',
                            'view_item' => 'View Block',
                            'search_items' => 'Search Blocks',
                            'not_found' => 'No Blocks Found',
                            'not_found_in_trash' => 'No Blocks Found in Trash',
                            'parent' => 'Parent Block'
                        )
                )
            );
        }
        // Hooking up our function to theme setup
        public function ___wp_blocks_columns( $column, $post_id ) {
            global $post;
            $post_data = get_post($post_id, ARRAY_A);
            $slug = isset($post_data['post_name'] ) ? $post_data['post_name'] : '';
        
            switch( $column ) {
                case 'shortcode' :
                    echo esc_html__('[wow_blocks id="'.$slug.'"]');
                break;
                case 'wow_thumbnail' :
                    echo get_the_post_thumbnail( $post_id, array(60,60) );
                break;
            }
        }
        public function ___wp_blocks_edit_columns( $columns ) {
        
            $columns = array(
                'cb' => '<input type="checkbox" />',
                'wow_thumbnail' => '<span class="dashicons dashicons-format-image"></span>',
                'title' => __( 'Title' ),
                'shortcode' => __( 'Shortcode' ),
                'author' => __( 'Author' ),
                'date' => __( 'Date' )
            );
        
            return $columns;
        }
        public function ___wp_blocks_shortcode($atts, $content = null) {	
            extract( shortcode_atts( array(
                'id' => ''
                ), $atts ) );
        
            // get content by slug
            global $wpdb;
            $post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$id'");
        
            if($post_id){
                $html =	get_post_field('post_content', $post_id);
                $html = "".do_shortcode( $html)."";
            } else{
                $html = 'WOW Block [wow_blocks id="'.$id.'"] not found! Wrong ID?';	
            }
        
            return $html;
        }
        
    }
}

new WP_Blocks_Core_Init();


