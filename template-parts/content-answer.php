<?php if (have_posts()) :
    while (have_posts()) :
        the_post(); 
        $posttags = get_the_tags();
        
       
        $answers = get_comments(array( 'post_id' => get_the_ID()) ); 
        $s='s';     
        ?>
    <div class="answer-wrap">
        <?php the_content(); ?>
        <?php 
            if ($posttags) {
                echo '<p class = "answer-tags">';
                foreach($posttags as $tag) { 
                   echo '<a class= "answer-tag" href = "'.get_tag_link($tag ).'">'. $tag->name . ' </a>';
                } 
                echo '</p>';
            } ?>
        <p class='answer-info'> Asked <?php the_date(); if ( get_the_author() ){ echo ' by '.get_the_author();}?> </p>
        <!-- Answers -->
        <?php
            if(count($answers) > 0){
            $s = count($answers) > 1 ? 's' : '';
            echo '<h2>'.count($answers).' Answer'.$s.'</h2>';

            foreach ( $answers as $answer ) :
        ?>      <div class="answer-asnwers-wrap">
                <hr/>
                    <div class="answer-answer-content">
                        <?php echo '<p>'.$answer->comment_content.'</p>' ?>
                    </div> 
                    <div class="answer-answers-data">
                        <?php $author = $answer->comment_author ? $answer->comment_author : 'Anonymous' ?>
                        <p class="answer-info"> Answered <?php echo mysql2date( get_option( 'date_format' ), $answer->comment_date ) ?> by <?php echo $author ?> </p>
                    </div>
                </div>
        
        <?php  endforeach; ?> 
    <?php } ?>
    </div>
<?php
    endwhile;
endif;
