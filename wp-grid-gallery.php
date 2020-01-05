<?php 
/*
* Plugin Name: WP Grid Gallery
* Description: Simple plugin to show gallery on frontend with a shortcode
* Plugin URI: https://prakashverma.com/wp/plugins/
* Version: 1.0
* Author: Prakash Verma
* Author URI: https://prakashverma.com/
*/
require('libs/functions.php');

// function that runs when shortcode is called
function wp_grid_gallery_shortcode( $shortcodeArr ) { 
    
    extract( shortcode_atts( array(
        'id'        => '',
        'column'   => '3',
        'size'      => 'full',
    ), $shortcodeArr, 'wp_grid_gallery' ) );

    if( $id === '' || empty($id) ) {
        return 'Please provide ID to show gallery';
    }

    // Convert string IDs to Array
    $ids = extract_ids($id);

    // Store output in buffer to return
    $return = '';
    $return .= '<div class="wp_grid_gallery_container wp_grid_'.$column.'_cols" style="column-count: '.$column.';">';    
        foreach( $ids as $id ) {
            // Get image source with image ID
            $img = wp_get_attachment_image_src( $id, $size );      
            if( !empty($img) ) {
                $return .= '<img class="wp_grid_gallery_image" src="'. $img[0] .'" width="'. $img[1] .'" height="'. $img[2] .'" />';      
            }
        }
    $return .= '</div>';
    
    return $return;
} 
// register shortcode
add_shortcode('wp_grid_gallery', 'wp_grid_gallery_shortcode'); 


// Register Plugin CSS and JS files 
function wp_grid_gallery_assets() {   
    wp_enqueue_style( 'wp_grid_gallery_css', plugin_dir_url( __FILE__ ) . 'assets/css/wp_grid_gallery.css' );
    wp_enqueue_script( 'wp_grid_gallery_js', plugin_dir_url( __FILE__ ) . 'assets/js/wp_grid_gallery.js' );
}
add_action('wp_enqueue_scripts', 'wp_grid_gallery_assets');

?>