<?php

// Add back to store button on WooCommerce cart page
add_action('woocommerce_cart_coupon', 'woowhole_enquery_cart_button');

function woowhole_enquery_cart_button() { ?>
<button class="button wc-backward enquiryf"> <?php _e( 'Enquery Cart', 'woocommerce' ) ?> </button>

<?php
	global $woocommerce;
    $items = $woocommerce->cart->get_cart();
$cartitems = '';
        foreach($items as $item => $values) { 
            $_product =  wc_get_product( $values['data']->get_id()); 
            $cartitems .= "<b>".$_product->get_title().'</b>  <br> Quantity: '.$values['quantity'].'<br>'; 
            $price = get_post_meta($values['product_id'] , '_price', true);
            $cartitems .= "  Price: ".$price."<br><hr>";
        } 
		
        
        if(isset($_POST['submitx']))
	{
		
		//user posted variables
  $name = sanitize_text_field($_POST['cname']);
  $email = sanitize_email($_POST['cemail']);
		$contact = sanitize_text_field($_POST['ccont']);
		$femail =	get_option('woowhole_from_name').' <'.get_option('woowhole_from_emailaddress').'>';
	$message = 'You have new enqury request!<br><br>Name: '.$name;
	$message .= '<br>Email: '.$email;
	$message .= '<br>Contact Number: '.$contact;
  $message .= '<br>Message: '.sanitize_textarea_field($_POST['cmessage']);
$message .= '<h3>Cart Items</h3>'.$cartitems;
 $to = 	get_option('woowhole_to_emailaddress');
  $subject = "Enquery Request - ".$name;
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
  $headers .= 'From: '. $femail . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

// the message
$msg = $message; 

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,150);

// send email
$result = mail(get_option('woowhole_to_emailaddress'),$subject,$msg,$headers);
   if(!$result) {         	
$result = wp_mail(get_option('woowhole_to_emailaddress'),$subject,$msg,$headers);
		      }                 
                               
if(!$result) {   
    echo '<span class="failed_msg">'.esc_html(get_option('woowhole_failed_msg')).'<span>';
} else {
    echo '<span class="sucess_msg">'.esc_html(get_option('woowhole_success_msg')).'<span>';
}

   }
   
}



add_action( 'woocommerce_before_cart_totals', 'woowhole_htdat_content_after_addtocart_button' );
function woowhole_htdat_content_after_addtocart_button() {
 ?>
 <div class="woowholeover " style="display:none;">
<div class="woowholecont">
    <span class="woowholeclose">Close X</span>
    <h3><?php echo esc_html(get_option('woowhole_title')); ?></h3>
	<form action="" target="_self" method="post" name="former">
		<label>Name <input type="text" name="cname" required/></label>
		<label>Email <input type="email" name="cemail" required/></label>
		<label>Message <textarea name="cmessage"></textarea></label>
		<label>Contact Number <input type="tel" name="ccont" placeholder="0771234567" required pattern="[0-9]{10}" /></label>
		<button type="submit" name="submitx" value="submit">
			Submit
		</button>
	</form>

</div>
</div>
  <?php
}