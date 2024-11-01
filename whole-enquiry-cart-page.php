<?php
/**
* Plugin Name: Whole Cart Enquiry
* Plugin URI: https://idealwebdesign.lk/
* Description: Simple way to enable send an enquiry to all the products inside cart.
* Version: 1.2.1
* Author: Ideal Web Design
* Author URI: https://idealwebdesign.lk/about-us
**/

require_once dirname( __FILE__ ) .'/admin.php';
require_once dirname( __FILE__ ) .'/frontend.php';

function woowholeinit() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'woowholeinitcss', $plugin_url . 'assets/style.css' );
    wp_enqueue_script( 'woowholeinitjs', $plugin_url . 'assets/script.js' );
}
add_action( 'wp_enqueue_scripts', 'woowholeinit' );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'woowhole_settings_link' );
function woowhole_settings_link( array $links ) {
    $url = get_admin_url() . "options-general.php?page=woowhole";
    $settings_link = '<a href="' . $url . '">' . __('Settings', 'woowhole') . '</a> ';
      $support_link = '<a href="https://idealwebdesign.lk" target="_blank">' . __('Documentation', 'woowhole') . '</a> ';
      $links[] = $settings_link;
      $links[] = $support_link;
    return $links;
  }