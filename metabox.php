<?php
function add_custom_meta_box_wow_block() {
    // IF EDIT 
    global $pagenow;
    if ( $pagenow == 'post.php' ) {
        add_meta_box(
            'wow_block_meta_box', // $id
            'Shortcode', // $title
            'display_custom_meta_box_wow_block', // $callback
            'wow_blocks', // $page
            'side', // $context
            'high'); // $priority
    }
}
add_action('add_meta_boxes', 'add_custom_meta_box_wow_block');

function display_custom_meta_box_wow_block() {
    global $post;
    $post_data = get_post(get_the_ID(), ARRAY_A);
    $slug = isset($post_data['post_name'] ) ? $post_data['post_name'] : '';
    ?>
    <p>
        <input type="text" class="sm" name="shortcode" value='[wow_blocks id="<?php echo $slug; ?>"]' readonly='readonly' style="width:100%" />
    </p>
    <?php
}