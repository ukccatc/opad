<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Modern WP Themes
 */

get_header();
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
        	
           <?php if ( has_post_thumbnail() ) : ?>

        	<div class="entry-thumb-full">
					<?php the_post_thumbnail( 'thumb-full' ); ?>
			</div>
            
      	<?php endif; ?>

			<?php
			//Получение набора меток для каждого поста
			$metki = wp_get_post_terms($post->ID);
			if ($metki[0]->slug == 'private' && isset($_SESSION['userid'])) {
				get_template_part('content', 'single');
			}
			if ($metki[0]->slug == 'free') {
				get_template_part('content', 'single');
			}
			if ($metki[0]->slug == Null) {
				get_template_part('content', 'single');
			}
			?>


			<?php
				// If comments are open or we have at least one comment, load up the comment template
//				if ( comments_open() || '0' != get_comments_number() )
//					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>