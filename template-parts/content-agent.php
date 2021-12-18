  <?php get_template_part('template-parts/content', 'eat'); ?>

  <?php
        $content = '[su_box title="Agent Details" style="default"]';
        ob_start();
    ?>
<div class="company-info">
    <?php if (get_field('agency_name')): ?>
        <div><strong>Agency Name: </strong> <?php echo get_field('agency_name'); ?></div>
    <?php endif; ?>
    <?php if (get_field('company_name')): ?>
        <div><strong>Company: </strong> <?php echo get_field('company_name'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agentsince')): ?>
        <div><strong>Agency Since: </strong> <?php echo get_field('agentsince'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agent_phone')): ?>
        <div><strong>Phone Number: </strong> <?php echo get_field('agent_phone'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agent_fax')): ?>
        <div><strong>Fax: </strong> <?php echo get_field('agent_fax'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agent_email')): ?>
        <div><strong>Email: </strong> <?php echo get_field('agent_email'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agent_website')): ?>
        <div><strong>Website: </strong> <a rel='nofollow noopener noreferrer' target='_blank' href='<?php echo get_field('agent_website'); ?>'>Link</a></div>
    <?php endif; ?>
    <?php if (get_field('agent_street_address')): ?>
        <div><strong>Address: </strong> <?php echo get_field('agent_street_address'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agent_city')): ?>
        <div><strong>City: </strong> <?php echo get_field('agent_city'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agent_state')): ?>
        <div><strong>State: </strong> <?php echo get_field('agent_state'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agent_zip')): ?>
        <div><strong>Zip Code: </strong> <?php echo get_field('agent_zip'); ?></div>
    <?php endif; ?>
     <?php if(get_the_terms(get_the_ID(), 'agent_insurance_type')): ?>
      <div><strong>Coverage Options:</strong> <?php echo str_replace('condo', 'Condo', implode(', ', wp_get_post_terms(get_the_ID(), 'agent_insurance_type', array('fields'=>'names')))) ?></div>
      <?php endif; ?>
    
    <div class="stars-only"><?php echo do_shortcode(
        '[wp-review-comments-rating]'
    ); ?></div>
</div>
<?php
    $content .= ob_get_contents();
    ob_end_clean();
    echo do_shortcode($content . '[/su_box]');

    if( get_field('monday_hours') || get_field('tuesday_hours') || get_field('wednesday_hours') || 
        get_field('thursday_hours') || get_field('friday_hours') || get_field('saturday_hours') || get_field('sunday_hours') ){
?>

<?php if (have_posts()): ?>
    <h2>Overview</h2>
    <?php
      while (have_posts()):
          the_post();
          if(get_the_content()) {
            the_content();
          } else {
            echo '<p>Get reviews, agent information and more for ' . get_the_title() . ' and ' . get_field('agency_name') . ' in ' . get_field('agent_city') . ', ' . get_field('agent_state') . '. Compare ' . get_the_title() . ' to other local insurance agents now!</p>';
          }
      endwhile;
  endif; ?>

        <div class="office-hours-wrap">
            <h2>Office Hours</h2>
            <p>
            <?php 
                $dow = [ "monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "Sunday"];
                $office_hours = [];
                foreach ($dow as $day) {
                    $hour = get_field($day."_hours") ? get_field($day."_hours") . '<br/>' : 'Closed' . '<br/>';
                    echo '<strong>' .ucfirst($day).': </strong>'. $hour;
                } 
            ?>
        </p>             
<?php } ?>