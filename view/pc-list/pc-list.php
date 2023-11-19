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
                    <h2> <a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                    <p> 
                        <?php printf( "<span>State: %s</span>", get_field( 'state', get_the_ID(), true ) ); ?>,
                        <?php printf( "<span>City: %s</span>", get_field( 'city', get_the_ID(), true ) ); ?>,
                        <?php printf( "<span>Country: %s</span>", get_field( 'country', get_the_ID(), true ) ); ?> 
                    </p>
                    <p>
                        <?php 
                            $content = get_the_content(); 
                            $content = explode(" ", $string);

                            if( count( $content ) > 10 ) {
                                
                                $content = array_slice( $words, 0, 20 );
                                $content = implode( " ", $content );
                            }

                            $content = implode( " ", $content );

                            printf( 
                                "%1s 
                                <a href='%2s'>%3s</a>
                                ", 
                                $content,
                                get_the_permalink(),
                                __( 'Read More', 'political-co' )
                            );
                        ?>
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