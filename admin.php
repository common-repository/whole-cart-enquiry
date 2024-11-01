<?php

function woowhole_register_settings() {
   add_option( 'woowhole_to_emailaddress', get_bloginfo('admin_email'));
   register_setting( 'woowhole_options_group', 'woowhole_to_emailaddress', 'woowhole_callback' );
   
    add_option( 'woowhole_from_emailaddress', get_bloginfo('admin_email'));
   register_setting( 'woowhole_options_group', 'woowhole_from_emailaddress', 'woowhole_callback' );
   
    add_option( 'woowhole_from_name', '');
   register_setting( 'woowhole_options_group', 'woowhole_from_name', 'woowhole_callback' );
   
     add_option( 'woowhole_success_msg', 'Your Enquiry Sent Successfully!');
   register_setting( 'woowhole_options_group', 'woowhole_success_msg', 'woowhole_callback' );
   
    add_option( 'woowhole_failed_msg', 'Failed!, Please Contact Administrator.');
   register_setting( 'woowhole_options_group', 'woowhole_failed_msg', 'woowhole_callback' );
   
      add_option( 'woowhole_title', 'Send Your Cart Enquiry');
   register_setting( 'woowhole_options_group', 'woowhole_title', 'woowhole_callback' );
}
add_action( 'admin_init', 'woowhole_register_settings' );

function woowhole_register_options_page() {
  add_options_page('Page Title', 'Woo Whole Cart Enquiry', 'manage_options', 'woowhole', 'woowhole_option_page');
}
add_action('admin_menu', 'woowhole_register_options_page');

function woowhole_option_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>Woo Whole Cart Enquiry</h2>
  <form method="post" action="options.php">
  <?php settings_fields( 'woowhole_options_group' ); ?>
  <p>Please make sure from email address is having an email address from same domain as the website.</p>
  <table>
  <tr valign="top">
  <th scope="row"><label for="woowhole_to_emailaddress">To Email</label></th>
  <td><input type="text" id="woowhole_to_emailaddress" name="woowhole_to_emailaddress" value="<?php echo esc_attr(get_option('woowhole_to_emailaddress')); ?>" /></td>
  </tr>
   <tr valign="top">
  <th scope="row"><label for="woowhole_from_emailaddress">From Email</label></th>
  <td><input type="text" id="woowhole_from_emailaddress" name="woowhole_from_emailaddress" value="<?php echo esc_attr(get_option('woowhole_from_emailaddress')); ?>" /></td>
  </tr>
   <tr valign="top">
  <th scope="row"><label for="woowhole_from_name">From Name</label></th>
  <td><input type="text" id="woowhole_from_name" name="woowhole_from_name" value="<?php echo esc_attr(get_option('woowhole_from_name')); ?>" /></td>
  </tr>
   <tr valign="top">
  <th scope="row"><label for="woowhole_success_msg">Success Message</label></th>
  <td><textarea id="woowhole_success_msg" name="woowhole_success_msg" value="<?php echo esc_attr(get_option('woowhole_success_msg')); ?>" ><?php echo get_option('woowhole_success_msg'); ?></textarea></td>
  </tr>
    <tr valign="top">
  <th scope="row"><label for="woowhole_failed_msg">Failed Message</label></th>
  <td><textarea id="woowhole_failed_msg" name="woowhole_failed_msg" value="<?php echo esc_attr(get_option('woowhole_failed_msg')); ?>" ><?php echo esc_html(get_option('woowhole_failed_msg')); ?></textarea></td>
  </tr>
  
   <tr valign="top">
  <th scope="row"><label for="woowhole_title">Form Title</label></th>
  <td><input type="text" id="woowhole_title" name="woowhole_title" value="<?php echo esc_attr(get_option('woowhole_title')); ?>" /></td>
  </tr>
  </table>
  <?php  submit_button(); ?>
  </form>
  </div>
<?php
}