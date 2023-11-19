<div class="pc-container-wrapper">
    <?php 
        $args = [
            'post_type'         => 'political-corruption',
            'posts_per_page'    => -1
        ];

        $query = new WP_Query( $args );
        while( $query->have_posts() ) {
            $query->the_post();
            ?>
                <div class="pc-singler-pc-list">
                    <h2><?php the_title();?></h2>
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

        }
        wp_reset_postdata();
    ?>
</div>