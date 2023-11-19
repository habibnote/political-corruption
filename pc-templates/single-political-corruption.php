<?php 
get_header();
the_post();
?>  

<div class="cp-single-post-container">
    
    <h1><?php the_title();?></h1>

    <p> 
        <?php printf( "<span>State: %s</span>", get_field( 'state', get_the_ID(), true ) ); ?>,
        <?php printf( "<span>City: %s</span>", get_field( 'city', get_the_ID(), true ) ); ?>,
        <?php printf( "<span>Country: %s</span>", get_field( 'country', get_the_ID(), true ) ); ?> 
    </p>

    <p>
        <?php the_content(); ?>
    </p>

    <p>
        <audio controls>
            <source src="<?php echo get_field( 'audio', get_the_ID(), true ); ?>" type="audio/mpeg">
            <source src="<?php echo get_field( 'audio', get_the_ID(), true ); ?>" type="audio/wav">
        </audio>
    </p>
    <p>
        <video controls width="320" height="240">
            <source src="<?php echo get_field( 'video', get_the_ID(), true ); ?>" type="video/mp4">
            <source src="<?php echo get_field( 'video', get_the_ID(), true ); ?>" type="video/webm">
        </video>
    </p>
    <p>
        <a href="<?php echo get_field( 'document', get_the_ID(), true ); ?>" download="<?php echo get_field( 'document', get_the_ID(), true ); ?>">Download Document</a>
    </p>

</div>

<?php
get_footer();