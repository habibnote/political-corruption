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
	?>

<main id="content" <?php post_class( 'site-main' ); ?>>

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<header class="page-header">
            <?php 
                printf( '<p class="report-number">%s: #%s</p>', __e( 'Report number', 'political-co' ), get_post_meta( get_the_ID(), 'pc_report_number', true ) ); 
            ?>
            
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>

	<div class="page-content">

        <p> 
            <?php printf( "<span>State: %s</span>", get_field( 'state', get_the_ID(), true ) ); ?>,
            <?php printf( "<span>City: %s</span>", get_field( 'city', get_the_ID(), true ) ); ?>,
            <?php printf( "<span>Country: %s</span>", get_field( 'country', get_the_ID(), true ) ); ?> 
        </p>

		<?php the_content(); ?>

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
