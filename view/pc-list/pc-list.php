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
                        <?php 
                            $content = get_the_content(); 
                            $content = explode(" ", $content );

                            if( is_array( $content  ) ) {
                                
                                if( count( $content ) > 10 ) {
                                    $content = array_slice( $content, 0, 20 );
                                    $content = implode( " ", $content );
                                }else {
                                    $content = implode( " ", $content );
                                }
                            }

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
                </div>
            <?php 

        }
        wp_reset_postdata();
    ?>
</div>