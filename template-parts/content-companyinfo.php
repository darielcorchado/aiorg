<?php
    if (get_field('field_5f0c8eb03dec8')):
        $content = '[su_box title="Company Details" style="default"]';
        ob_start();
?>
<div class="company-info">
    <?php if (get_field('logo_url')): ?>
    <img src='<?php echo get_field('logo_url'); ?>' />
    <?php endif; ?>
    <?php if (get_field('street_address')): ?>
    <div><strong>Address:</strong> <?php echo get_field('street_address'); ?></div>
    <?php endif; ?>
    <?php if (get_field('city')): ?>
        <div><strong>City:</strong> <?php echo get_field('city'); ?></div>
    <?php endif; ?>
    <?php if (get_field('state')): ?>
        <div><strong>State:</strong> <?php echo get_field('state'); ?></div>
    <?php endif; ?>
    <?php if (get_field('zip')): ?>
        <div><strong>ZIP Code:</strong> <?php echo get_field('zip'); ?></div>
    <?php endif; ?>
    <?php if (get_field('phone_number')): ?>
        <div><strong>Phone Number:</strong> <?php echo preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', get_field('phone_number')); ?></div>
    <?php endif; ?>
    <?php if (get_field('fax')): ?>
        <div><strong>Fax:</strong> <?php echo preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', get_field('fax')); ?></div>
    <?php endif; ?>
    <?php if (get_field('url')):
        $url = str_replace( ["http://", "https://"],"", get_field('url'));
    ?>
        <div><strong>Website:</strong> <a rel='nofollow noopener noreferrer' target='_blank' href='https://<?php echo $url ?>'> <?php echo $url; ?></a></div>
    <?php endif; ?>
    <?php if (get_field('year_founded')): ?>
        <div><strong>Year Founded:</strong> <?php echo get_field('year_founded'); ?></div>
    <?php endif; ?>
    <?php if (get_field('ama')): ?>
        <div><strong>AM Best Rating:</strong> <?php echo get_field('ama'); ?></div>
    <?php endif; ?>
    <?php if (get_field('sandprating') && get_field('sandprating') != 'N/A'): ?>
        <div><strong>S&P Global Ratings:</strong> <?php echo get_field('sandprating'); ?></div>
    <?php endif; ?>
    <?php if (get_field('moodysrating') && get_field('moodysrating') != 'N/A'): ?>
        <div><strong>Moody's Rating:</strong> <?php echo get_field('moodysrating'); ?></div>
    <?php endif; ?>
    <?php if (get_field('fitchrating') && get_field('fitchrating') != 'N/A'): ?>
        <div><strong>Fitch Rating:</strong> <?php echo get_field('fitchrating'); ?></div>
    <?php endif; ?>
    <div class="stars-only"><?php echo do_shortcode(
        '[wp-review-comments-rating]'
    ); ?></div>
</div>
<?php
        $content .= ob_get_contents();
        ob_end_clean();
        echo do_shortcode($content . '[/su_box]');
    endif;
?>
