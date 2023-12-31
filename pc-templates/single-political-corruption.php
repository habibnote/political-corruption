<?php
get_header();
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();

    $title      = get_field( 'title', get_the_ID(), true );
    $date       = get_field( 'date', get_the_ID(), true );
    $state      = get_field( 'state', get_the_ID(), true );
    $city       = get_field( 'city', get_the_ID(), true );
    $country    = get_field( 'country', get_the_ID(), true );
    $urls       = get_field( 'url', get_the_ID(), true );

	?>

<main id="content" <?php post_class( 'site-main' ); ?>>

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<header class="page-header">
            <?php 

                $report_number = get_post_meta( get_the_ID(), 'pc_report_number', true );

                if( $report_number ) {
                    printf( '<p class="report-number">%s: #%s</p>', __( 'Report number', 'political-co' ), $report_number ); 
                }
            ?>

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>

	<div class="page-content">

        <?php the_post_thumbnail(); ?>

        <p> 
            <?php
                if( $title ) {
                    printf( "<span>Title: %s</span>", $title );
                }
                if( $date ) {
                    printf( "<span>Date: %s</span>", $date );
                }
                if( $state ) {
                    printf( "<span>State: %s</span>", $state );
                }
                if( $city ) {
                    printf( "<span>City: %s</span>", $city );
                }
                if( $country ) {
                    printf( "<span>Country: %s</span>", $country );
                }
                ?>
        </p>

		<?php the_content(); ?>

        <p>
            <?php 
                if( $urls ) {
                    $urls = explode( ",", $urls );

                    foreach( $urls as $url ) {
                        printf( "<a href='%s'>%s</a><br>", $url, $url );
                    }
                }
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

		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tagged ', 'hello-elementor' ), null, '</span>' ); ?>
		</div>
		<?php wp_link_pages(); ?>
	</div>

	<?php comments_template(); ?>

</main>

	<?php
endwhile;

get_footer();
