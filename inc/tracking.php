<?php 

add_action('wp_head', 'aiorg_facebook_pixel');
function aiorg_facebook_pixel() {
  if (get_page_template_slug() == 'page-templates/fb-landing.php') {
      // Moving FB Tracking to Google Tag Manager: GTM-N2PVKQ
    ?>
    <?php
  }
}
