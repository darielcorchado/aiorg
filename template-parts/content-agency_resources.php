<?php get_template_part('template-parts/content', 'eat'); ?>
<?php
        $content = '[su_box title="' . get_the_title() . ' Details" style="default"]';
        ob_start();
?>
<div class="company-info">
    <?php if (get_field('logo_url')): ?>
    <img src='<?php echo get_field('logo_url'); ?>' />
    <?php endif; ?>
    <?php if (get_field('agency_resource_phone')): ?>
    <div><strong>Phone Number:</strong> <?php echo get_field('agency_resource_phone'); ?></div>
    <?php endif; ?>
    <?php if (get_field('agency_resource_website')): ?>
        <div><strong>Website:</strong> <a rel='nofollow noopener noreferrer' target='_blank' href='<?php echo get_field('agency_resource_website'); ?>'>Link</a></div>
    <?php endif; ?>
        <div><strong>Resources:</strong> <?php echo get_the_term_list(get_the_ID(), 'resource_type', '', ', ') ?></div>
</div>
<?php
        $content .= ob_get_contents();
        ob_end_clean();
        echo do_shortcode($content . '[/su_box]');
?>
  <?php if (have_posts()):
      while (have_posts()):
          the_post();
          the_content();
      endwhile;
  endif; ?>

